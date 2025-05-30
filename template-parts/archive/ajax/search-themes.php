<?php
/**
 * معالج AJAX للبحث السريع
 * بحث مباشر مع اقتراحات ذكية
 * 
 * @package ArabicThemes
 * @author Tahactw
 * @date 2025-05-30
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

// التحقق من الأمان
if (!wp_verify_nonce($_POST['nonce'], 'archive_themes_nonce')) {
    wp_die('خطأ في الأمان');
}

// الحصول على استعلام البحث
$search_query = sanitize_text_field($_POST['query'] ?? '');
$search_type = sanitize_text_field($_POST['type'] ?? 'suggestions'); // suggestions, search, instant
$limit = intval($_POST['limit'] ?? 8);

// التحقق من طول الاستعلام
if (strlen($search_query) < 2) {
    wp_send_json([
        'success' => false,
        'message' => 'يجب أن يكون البحث أطول من حرفين'
    ]);
}

$response = [
    'success' => true,
    'query' => $search_query,
    'type' => $search_type,
    'data' => []
];

switch ($search_type) {
    case 'suggestions':
        $response['data'] = get_search_suggestions($search_query, $limit);
        break;
    
    case 'instant':
        $response['data'] = get_instant_search_results($search_query, $limit);
        break;
    
    case 'search':
        $response['data'] = get_full_search_results($search_query, $limit * 2);
        break;
    
    default:
        $response['data'] = get_search_suggestions($search_query, $limit);
        break;
}

/**
 * الحصول على اقتراحات البحث
 */
function get_search_suggestions($query, $limit) {
    global $wpdb;
    
    $suggestions = [
        'themes' => [],
        'categories' => [],
        'tags' => [],
        'popular_searches' => []
    ];
    
    // اقتراحات القوالب
    $themes_query = new WP_Query([
        'post_type' => 'wp_themes',
        'post_status' => 'publish',
        's' => $query,
        'posts_per_page' => $limit,
        'fields' => 'ids'
    ]);
    
    if ($themes_query->have_posts()) {
        foreach ($themes_query->posts as $theme_id) {
            $suggestions['themes'][] = [
                'id' => $theme_id,
                'title' => get_the_title($theme_id),
                'url' => get_permalink($theme_id),
                'thumbnail' => get_the_post_thumbnail_url($theme_id, 'thumbnail'),
                'type' => 'theme'
            ];
        }
    }
    
    // اقتراحات التصنيفات
    $categories = get_terms([
        'taxonomy' => 'theme_category',
        'name__like' => $query,
        'number' => 5,
        'hide_empty' => true
    ]);
    
    if (!is_wp_error($categories)) {
        foreach ($categories as $category) {
            $suggestions['categories'][] = [
                'id' => $category->term_id,
                'name' => $category->name,
                'slug' => $category->slug,
                'count' => $category->count,
                'url' => get_term_link($category),
                'type' => 'category'
            ];
        }
    }
    
    // اقتراحات الكلمات المفتاحية
    $tags = get_terms([
        'taxonomy' => 'theme_tags',
        'name__like' => $query,
        'number' => 5,
        'hide_empty' => true
    ]);
    
    if (!is_wp_error($tags)) {
        foreach ($tags as $tag) {
            $suggestions['tags'][] = [
                'id' => $tag->term_id,
                'name' => $tag->name,
                'slug' => $tag->slug,
                'count' => $tag->count,
                'type' => 'tag'
            ];
        }
    }
    
    // البحثات الشائعة
    $popular_searches = [
        'مجاني', 'أعمال', 'مدونة', 'متجر', 'شركات', 'إبداعي', 'بسيط', 'احترافي'
    ];
    
    foreach ($popular_searches as $popular) {
        if (stripos($popular, $query) !== false) {
            $suggestions['popular_searches'][] = [
                'term' => $popular,
                'type' => 'popular'
            ];
        }
    }
    
    return $suggestions;
}

/**
 * البحث الفوري السريع
 */
function get_instant_search_results($query, $limit) {
    $results_query = new WP_Query([
        'post_type' => 'wp_themes',
        'post_status' => 'publish',
        's' => $query,
        'posts_per_page' => $limit,
        'meta_query' => [
            [
                'key' => '_theme_rating',
                'value' => 4.0,
                'type' => 'DECIMAL',
                'compare' => '>='
            ]
        ],
        'orderby' => ['meta_value_num' => 'DESC', 'date' => 'DESC'],
        'meta_key' => '_download_count'
    ]);
    
    $results = [
        'themes' => [],
        'total_found' => $results_query->found_posts,
        'has_more' => $results_query->found_posts > $limit
    ];
    
    if ($results_query->have_posts()) {
        while ($results_query->have_posts()) {
            $results_query->the_post();
            $theme_id = get_the_ID();
            
            $results['themes'][] = [
                'id' => $theme_id,
                'title' => get_the_title(),
                'excerpt' => wp_trim_words(get_the_excerpt(), 15),
                'url' => get_permalink(),
                'thumbnail' => get_the_post_thumbnail_url($theme_id, 'medium'),
                'rating' => get_post_meta($theme_id, '_theme_rating', true) ?: 4.5,
                'downloads' => get_post_meta($theme_id, '_download_count', true) ?: 0,
                'price' => get_post_meta($theme_id, '_theme_price', true) ?: 'مجاني',
                'is_featured' => get_post_meta($theme_id, '_is_featured', true) ?: false
            ];
        }
        wp_reset_postdata();
    }
    
    return $results;
}

/**
 * نتائج البحث الكاملة
 */
function get_full_search_results($query, $limit) {
    // بحث متقدم في عدة حقول
    $search_args = [
        'post_type' => 'wp_themes',
        'post_status' => 'publish',
        'posts_per_page' => $limit,
        'meta_query' => [
            'relation' => 'OR',
            [
                'key' => '_theme_description',
                'value' => $query,
                'compare' => 'LIKE'
            ],
            [
                'key' => '_theme_tags',
                'value' => $query,
                'compare' => 'LIKE'
            ]
        ]
    ];
    
    // البحث في العنوان والمحتوى
    $title_search = new WP_Query(array_merge($search_args, [
        's' => $query,
        'orderby' => 'relevance'
    ]));
    
    $results = [
        'themes' => [],
        'categories' => [],
        'total_found' => $title_search->found_posts,
        'search_time' => 0
    ];
    
    $start_time = microtime(true);
    
    if ($title_search->have_posts()) {
        while ($title_search->have_posts()) {
            $title_search->the_post();
            $theme_id = get_the_ID();
            
            $categories = get_the_terms($theme_id, 'theme_category');
            $category_names = $categories ? wp_list_pluck($categories, 'name') : [];
            
            $results['themes'][] = [
                'id' => $theme_id,
                'title' => get_the_title(),
                'excerpt' => wp_trim_words(get_the_excerpt(), 20),
                'content' => wp_trim_words(get_the_content(), 30),
                'url' => get_permalink(),
                'featured_image' => get_the_post_thumbnail_url($theme_id, 'medium'),
                'categories' => $category_names,
                'date' => get_the_date('c'),
                'author' => get_the_author(),
                'rating' => get_post_meta($theme_id, '_theme_rating', true) ?: 4.5,
                'downloads' => get_post_meta($theme_id, '_download_count', true) ?: 0,
                'price' => get_post_meta($theme_id, '_theme_price', true) ?: 'مجاني',
                'version' => get_post_meta($theme_id, '_theme_version', true) ?: '1.0',
                'demo_url' => get_post_meta($theme_id, '_demo_url', true),
                'relevance_score' => calculate_relevance_score($query, get_the_title(), get_the_content())
            ];
        }
        wp_reset_postdata();
        
        // ترتيب حسب الصلة
        usort($results['themes'], function($a, $b) {
            return $b['relevance_score'] - $a['relevance_score'];
        });
    }
    
    // البحث في التصنيفات ذات الصلة
    $related_categories = get_terms([
        'taxonomy' => 'theme_category',
        'name__like' => $query,
        'hide_empty' => true,
        'number' => 5
    ]);
    
    if (!is_wp_error($related_categories)) {
        foreach ($related_categories as $category) {
            $results['categories'][] = [
                'id' => $category->term_id,
                'name' => $category->name,
                'slug' => $category->slug,
                'description' => $category->description,
                'count' => $category->count,
                'url' => get_term_link($category)
            ];
        }
    }
    
    $results['search_time'] = round((microtime(true) - $start_time) * 1000, 2);
    
    return $results;
}

/**
 * حساب نقاط الصلة
 */
function calculate_relevance_score($query, $title, $content) {
    $score = 0;
    $query_lower = strtolower($query);
    $title_lower = strtolower($title);
    $content_lower = strtolower($content);
    
    // العنوان له وزن أكبر
    if (strpos($title_lower, $query_lower) !== false) {
        $score += 10;
        if (strpos($title_lower, $query_lower) === 0) {
            $score += 5; // بداية العنوان
        }
    }
    
    // المحتوى
    $content_matches = substr_count($content_lower, $query_lower);
    $score += $content_matches * 2;
    
    // طول المحتوى (المحتوى الأطول قد يكون أقل صلة)
    $content_length = strlen($content);
    if ($content_length > 1000) {
        $score -= 1;
    }
    
    return $score;
}

// حفظ إحصائيات البحث
if (!empty($search_query)) {
    $search_stats = get_option('theme_search_stats', []);
    $search_key = md5($search_query);
    
    if (!isset($search_stats[$search_key])) {
        $search_stats[$search_key] = [
            'query' => $search_query,
            'count' => 0,
            'last_search' => current_time('mysql')
        ];
    }
    
    $search_stats[$search_key]['count']++;
    $search_stats[$search_key]['last_search'] = current_time('mysql');
    
    // الاحتفاظ بآخر 1000 بحث فقط
    if (count($search_stats) > 1000) {
        $search_stats = array_slice($search_stats, -1000, null, true);
    }
    
    update_option('theme_search_stats', $search_stats);
}

// إرسال الاستجابة
wp_send_json($response);
?>

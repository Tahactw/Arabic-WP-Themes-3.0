<?php
/**
 * معالج AJAX للفلترة المتقدمة
 * فلترة القوالب حسب التصنيف والنوع والسعر
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

// الحصول على المعاملات
$filters = [
    'category' => sanitize_text_field($_POST['category'] ?? ''),
    'sort' => sanitize_text_field($_POST['sort'] ?? 'date-desc'),
    'type' => sanitize_text_field($_POST['type'] ?? ''),
    'price' => sanitize_text_field($_POST['price'] ?? ''),
    'search' => sanitize_text_field($_POST['search'] ?? ''),
    'page' => intval($_POST['page'] ?? 1),
    'per_page' => intval($_POST['per_page'] ?? 12)
];

// بناء استعلام WP_Query
$query_args = [
    'post_type' => 'wp_themes',
    'post_status' => 'publish',
    'posts_per_page' => $filters['per_page'],
    'paged' => $filters['page'],
    'meta_query' => [],
    'tax_query' => []
];

// فلتر التصنيف
if (!empty($filters['category'])) {
    $query_args['tax_query'][] = [
        'taxonomy' => 'theme_category',
        'field' => 'slug',
        'terms' => $filters['category']
    ];
}

// فلتر النوع
if (!empty($filters['type'])) {
    $query_args['meta_query'][] = [
        'key' => '_theme_type',
        'value' => $filters['type'],
        'compare' => '='
    ];
}

// فلتر السعر
if (!empty($filters['price'])) {
    switch ($filters['price']) {
        case 'free':
            $query_args['meta_query'][] = [
                'relation' => 'OR',
                [
                    'key' => '_theme_price',
                    'value' => 'مجاني',
                    'compare' => '='
                ],
                [
                    'key' => '_theme_price',
                    'value' => '0',
                    'compare' => '='
                ],
                [
                    'key' => '_theme_price',
                    'compare' => 'NOT EXISTS'
                ]
            ];
            break;
        case 'premium':
            $query_args['meta_query'][] = [
                'key' => '_theme_price',
                'value' => ['مجاني', '0', ''],
                'compare' => 'NOT IN'
            ];
            break;
        case 'under-50':
            $query_args['meta_query'][] = [
                'key' => '_theme_price',
                'value' => 50,
                'type' => 'NUMERIC',
                'compare' => '<'
            ];
            break;
        case 'over-50':
            $query_args['meta_query'][] = [
                'key' => '_theme_price',
                'value' => 50,
                'type' => 'NUMERIC',
                'compare' => '>='
            ];
            break;
    }
}

// البحث النصي
if (!empty($filters['search'])) {
    $query_args['s'] = $filters['search'];
    
    // البحث في الحقول المخصصة أيضاً
    $query_args['meta_query'][] = [
        'relation' => 'OR',
        [
            'key' => '_theme_description',
            'value' => $filters['search'],
            'compare' => 'LIKE'
        ],
        [
            'key' => '_theme_tags',
            'value' => $filters['search'],
            'compare' => 'LIKE'
        ]
    ];
}

// ترتيب النتائج
switch ($filters['sort']) {
    case 'title-asc':
        $query_args['orderby'] = 'title';
        $query_args['order'] = 'ASC';
        break;
    case 'title-desc':
        $query_args['orderby'] = 'title';
        $query_args['order'] = 'DESC';
        break;
    case 'date-asc':
        $query_args['orderby'] = 'date';
        $query_args['order'] = 'ASC';
        break;
    case 'downloads-desc':
        $query_args['meta_key'] = '_download_count';
        $query_args['orderby'] = 'meta_value_num';
        $query_args['order'] = 'DESC';
        break;
    case 'downloads-asc':
        $query_args['meta_key'] = '_download_count';
        $query_args['orderby'] = 'meta_value_num';
        $query_args['order'] = 'ASC';
        break;
    case 'rating-desc':
        $query_args['meta_key'] = '_theme_rating';
        $query_args['orderby'] = 'meta_value_num';
        $query_args['order'] = 'DESC';
        break;
    case 'price-asc':
        $query_args['meta_key'] = '_theme_price';
        $query_args['orderby'] = 'meta_value_num';
        $query_args['order'] = 'ASC';
        break;
    case 'price-desc':
        $query_args['meta_key'] = '_theme_price';
        $query_args['orderby'] = 'meta_value_num';
        $query_args['order'] = 'DESC';
        break;
    default: // date-desc
        $query_args['orderby'] = 'date';
        $query_args['order'] = 'DESC';
        break;
}

// تنفيذ الاستعلام
$themes_query = new WP_Query($query_args);

// تحضير النتائج
$response = [
    'success' => true,
    'data' => [
        'themes' => [],
        'pagination' => [
            'current_page' => $filters['page'],
            'total_pages' => $themes_query->max_num_pages,
            'total_posts' => $themes_query->found_posts,
            'per_page' => $filters['per_page'],
            'has_next' => $filters['page'] < $themes_query->max_num_pages,
            'has_prev' => $filters['page'] > 1
        ],
        'stats' => [
            'total_found' => $themes_query->found_posts,
            'showing_from' => (($filters['page'] - 1) * $filters['per_page']) + 1,
            'showing_to' => min($filters['page'] * $filters['per_page'], $themes_query->found_posts)
        ]
    ]
];

// جمع بيانات القوالب
if ($themes_query->have_posts()) {
    while ($themes_query->have_posts()) {
        $themes_query->the_post();
        $theme_id = get_the_ID();
        
        // جمع البيانات
        $theme_data = [
            'id' => $theme_id,
            'title' => get_the_title(),
            'excerpt' => get_the_excerpt(),
            'permalink' => get_permalink(),
            'featured_image' => get_the_post_thumbnail_url($theme_id, 'large'),
            'date' => get_the_date('c'),
            'modified' => get_the_modified_date('c'),
            'author' => get_the_author(),
            'download_count' => get_post_meta($theme_id, '_download_count', true) ?: 0,
            'rating' => get_post_meta($theme_id, '_theme_rating', true) ?: 4.5,
            'price' => get_post_meta($theme_id, '_theme_price', true) ?: 'مجاني',
            'version' => get_post_meta($theme_id, '_theme_version', true) ?: '1.0',
            'is_featured' => get_post_meta($theme_id, '_is_featured', true) ?: false,
            'demo_url' => get_post_meta($theme_id, '_demo_url', true),
            'download_url' => get_post_meta($theme_id, '_download_url', true),
            'theme_type' => get_post_meta($theme_id, '_theme_type', true) ?: 'business',
            'primary_color' => get_post_meta($theme_id, '_theme_primary_color', true) ?: 'blue'
        ];
        
        // الحصول على التصنيفات
        $categories = get_the_terms($theme_id, 'theme_category');
        $theme_data['categories'] = [];
        if ($categories && !is_wp_error($categories)) {
            foreach ($categories as $category) {
                $theme_data['categories'][] = [
                    'name' => $category->name,
                    'slug' => $category->slug,
                    'url' => get_term_link($category)
                ];
            }
        }
        
        // الحصول على الكلمات المفتاحية
        $tags = get_the_terms($theme_id, 'theme_tags');
        $theme_data['tags'] = [];
        if ($tags && !is_wp_error($tags)) {
            foreach ($tags as $tag) {
                $theme_data['tags'][] = [
                    'name' => $tag->name,
                    'slug' => $tag->slug
                ];
            }
        }
        
        // حساب الشارات
        $theme_data['badges'] = [];
        if ($theme_data['is_featured']) {
            $theme_data['badges'][] = [
                'type' => 'featured',
                'label' => 'مميز',
                'icon' => 'fas fa-star'
            ];
        }
        
        if ($theme_data['price'] === 'مجاني' || $theme_data['price'] == 0) {
            $theme_data['badges'][] = [
                'type' => 'free',
                'label' => 'مجاني',
                'icon' => 'fas fa-gift'
            ];
        }
        
        $days_since_publish = floor((time() - get_the_time('U')) / (60 * 60 * 24));
        if ($days_since_publish <= 7) {
            $theme_data['badges'][] = [
                'type' => 'new',
                'label' => 'جديد',
                'icon' => 'fas fa-plus'
            ];
        }
        
        $response['data']['themes'][] = $theme_data;
    }
    wp_reset_postdata();
}

// إرسال الاستجابة
wp_send_json($response);
?>

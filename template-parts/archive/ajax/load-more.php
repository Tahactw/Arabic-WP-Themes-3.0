<?php
/**
 * معالج AJAX لتحميل المزيد من القوالب
 * نظام Infinite Scroll والتحميل التدريجي
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
$page = intval($_POST['page'] ?? 1);
$per_page = intval($_POST['per_page'] ?? 12);
$current_filters = $_POST['filters'] ?? [];

// تنظيف الفلاتر
$clean_filters = [
    'category' => sanitize_text_field($current_filters['category'] ?? ''),
    'sort' => sanitize_text_field($current_filters['sort'] ?? 'date-desc'),
    'type' => sanitize_text_field($current_filters['type'] ?? ''),
    'price' => sanitize_text_field($current_filters['price'] ?? ''),
    'search' => sanitize_text_field($current_filters['search'] ?? '')
];

// بناء استعلام مماثل لفلتر القوالب
$query_args = [
    'post_type' => 'wp_themes',
    'post_status' => 'publish',
    'posts_per_page' => $per_page,
    'paged' => $page,
    'meta_query' => [],
    'tax_query' => []
];

// تطبيق نفس منطق الفلترة
if (!empty($clean_filters['category'])) {
    $query_args['tax_query'][] = [
        'taxonomy' => 'theme_category',
        'field' => 'slug',
        'terms' => $clean_filters['category']
    ];
}

if (!empty($clean_filters['type'])) {
    $query_args['meta_query'][] = [
        'key' => '_theme_type',
        'value' => $clean_filters['type'],
        'compare' => '='
    ];
}

if (!empty($clean_filters['price'])) {
    switch ($clean_filters['price']) {
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

if (!empty($clean_filters['search'])) {
    $query_args['s'] = $clean_filters['search'];
}

// تطبيق الترتيب
switch ($clean_filters['sort']) {
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
    default:
        $query_args['orderby'] = 'date';
        $query_args['order'] = 'DESC';
        break;
}

// تنفيذ الاستعلام
$themes_query = new WP_Query($query_args);

// تحضير الاستجابة
$response = [
    'success' => true,
    'data' => [
        'themes' => [],
        'has_more' => false,
        'next_page' => $page + 1,
        'total_pages' => $themes_query->max_num_pages,
        'current_page' => $page,
        'loaded_count' => 0
    ]
];

// جمع HTML للقوالب الجديدة
if ($themes_query->have_posts()) {
    ob_start();
    
    while ($themes_query->have_posts()) {
        $themes_query->the_post();
        
        // تضمين مكون بطاقة القالب
        include get_template_directory() . '/template-parts/archive/components/theme-card.php';
    }
    
    $themes_html = ob_get_clean();
    wp_reset_postdata();
    
    // تحديث بيانات الاستجابة
    $response['data']['themes_html'] = $themes_html;
    $response['data']['loaded_count'] = $themes_query->post_count;
    $response['data']['has_more'] = $page < $themes_query->max_num_pages;
    
    // إحصائيات إضافية
    $response['data']['stats'] = [
        'total_found' => $themes_query->found_posts,
        'loaded_so_far' => $page * $per_page,
        'remaining' => max(0, $themes_query->found_posts - ($page * $per_page))
    ];
} else {
    $response['data']['themes_html'] = '';
    $response['data']['message'] = 'لا توجد قوالب إضافية للتحميل';
}

// معلومات الأداء
$response['data']['performance'] = [
    'execution_time' => round((microtime(true) - $_SERVER['REQUEST_TIME_FLOAT']) * 1000, 2) . 'ms',
    'memory_usage' => round(memory_get_peak_usage(true) / 1024 / 1024, 2) . 'MB',
    'query_count' => get_num_queries()
];

// إرسال الاستجابة
wp_send_json($response);
?>

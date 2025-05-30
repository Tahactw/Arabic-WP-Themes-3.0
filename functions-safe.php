<?php
/**
 * ملف الوظائف الآمن - قوالب عربية ووردبريس
 * نسخة آمنة بدون أخطاء
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

// تحديد الثوابت
define('ARABIC_THEMES_VERSION', '1.0.0');
define('ARABIC_THEMES_PATH', get_template_directory());
define('ARABIC_THEMES_URL', get_template_directory_uri());

/**
 * إعداد القالب الأساسي
 */
function arabic_themes_setup() {
    // دعم الترجمة
    load_theme_textdomain('arabic-themes', ARABIC_THEMES_PATH . '/languages');
    
    // دعم العناوين التلقائية
    add_theme_support('title-tag');
    
    // دعم الصور المميزة
    add_theme_support('post-thumbnails');
    
    // دعم HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption'
    ));
    
    // تسجيل قوائم التنقل
    register_nav_menus(array(
        'primary' => 'القائمة الرئيسية',
        'footer'  => 'قائمة التذييل'
    ));
    
    // أحجام الصور المخصصة
    add_image_size('theme-thumbnail', 400, 300, true);
    add_image_size('theme-large', 800, 600, true);
}
add_action('after_setup_theme', 'arabic_themes_setup');

/**
 * تحميل الملفات الأساسية فقط
 */
function arabic_themes_scripts() {
    // CSS الأساسي
    wp_enqueue_style('arabic-themes-style', get_stylesheet_uri(), array(), ARABIC_THEMES_VERSION);
    
    // Font Awesome - نسخة آمنة
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css', array(), '6.0.0');
    
    // jQuery (مضمن في ووردبريس)
    wp_enqueue_script('jquery');
    
    // متغيرات JavaScript أساسية
    wp_localize_script('jquery', 'ArabicThemes', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('arabic_themes_nonce'),
        'strings' => array(
            'loading' => 'جاري التحميل...',
            'error'   => 'حدث خطأ'
        )
    ));
}
add_action('wp_enqueue_scripts', 'arabic_themes_scripts');

/**
 * تسجيل نوع محتوى القوالب
 */
function arabic_themes_register_post_types() {
    register_post_type('wp_themes', array(
        'labels' => array(
            'name' => 'القوالب',
            'singular_name' => 'قالب',
            'add_new' => 'إضافة جديد',
            'add_new_item' => 'إضافة قالب جديد',
            'edit_item' => 'تحرير القالب',
            'new_item' => 'قالب جديد',
            'view_item' => 'عرض القالب',
            'search_items' => 'البحث في القوالب',
            'not_found' => 'لا توجد قوالب',
            'not_found_in_trash' => 'لا توجد قوالب في المهملات'
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-admin-appearance',
        'rewrite' => array('slug' => 'themes'),
        'show_in_rest' => true
    ));
}
add_action('init', 'arabic_themes_register_post_types');

/**
 * تسجيل مناطق الودجت
 */
function arabic_themes_widgets_init() {
    register_sidebar(array(
        'name' => 'الشريط الجانبي',
        'id' => 'sidebar-1',
        'before_widget' => '<div class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}
add_action('widgets_init', 'arabic_themes_widgets_init');

/**
 * دوال مساعدة آمنة
 */
function arabic_themes_get_theme_meta($post_id, $meta_key, $default = '') {
    $meta_value = get_post_meta($post_id, $meta_key, true);
    return !empty($meta_value) ? $meta_value : $default;
}

function arabic_themes_rating_stars($rating, $max_rating = 5) {
    $stars_html = '';
    for ($i = 1; $i <= $max_rating; $i++) {
        if ($i <= $rating) {
            $stars_html .= '<i class="fas fa-star"></i>';
        } else {
            $stars_html .= '<i class="far fa-star"></i>';
        }
    }
    return $stars_html;
}

/**
 * تخصيص طول المقتطف
 */
function arabic_themes_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'arabic_themes_excerpt_length');

/**
 * تحسين الاستعلامات
 */
function arabic_themes_modify_main_query($query) {
    if (!is_admin() && $query->is_main_query()) {
        if (is_post_type_archive('wp_themes')) {
            $query->set('posts_per_page', 12);
        }
    }
}
add_action('pre_get_posts', 'arabic_themes_modify_main_query');

// نهاية الملف
?>
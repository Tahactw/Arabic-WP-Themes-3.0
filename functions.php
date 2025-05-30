<?php
/**
 * ملف الوظائف المحسن - قوالب عربية ووردبريس
 * إصدار محسن مع إصلاح الصفحات البيضاء + المميزات التدريجية
 * 
 * @package ArabicThemes
 * @version 1.0.1-enhanced
 * @author Tahactw
 * @date 2025-05-28
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

// تحديد الثوابت الأساسية
define('ARABIC_THEMES_VERSION', '1.0.1');
define('ARABIC_THEMES_PATH', get_template_directory());
define('ARABIC_THEMES_URL', get_template_directory_uri());
define('ARABIC_THEMES_ASSETS', ARABIC_THEMES_URL . '/assets');

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
        'caption',
        'script',
        'style'
    ));
    
    // دعم شعار مخصص
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    
    // دعم خلاصات RSS
    add_theme_support('automatic-feed-links');
    
    // دعم Gutenberg
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    add_theme_support('editor-styles');
    
    // تسجيل قوائم التنقل
    register_nav_menus(array(
        'primary' => __('القائمة الرئيسية', 'arabic-themes'),
        'footer'  => __('قائمة التذييل', 'arabic-themes'),
        'social'  => __('القائمة الاجتماعية', 'arabic-themes'),
    ));
    
    // أحجام الصور المخصصة
    add_image_size('theme-thumbnail', 400, 300, true);
    add_image_size('theme-large', 800, 600, true);
    add_image_size('theme-hero', 1200, 800, true);
    add_image_size('theme-preview', 600, 450, true);
}
add_action('after_setup_theme', 'arabic_themes_setup');

/**
 * تسجيل وتحميل الملفات - المرحلة 1
 */
function arabic_themes_scripts() {
    // CSS الأساسي
    wp_enqueue_style('arabic-themes-style', get_stylesheet_uri(), array(), ARABIC_THEMES_VERSION);
    
    // Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');
    
    // Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900&family=Tajawal:wght@200;300;400;500;700;800;900&display=swap', array(), null);
    
    // إضافة GSAP - المرحلة 1
    wp_enqueue_script('gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js', array(), '3.12.2', true);
    
    // AOS للحركات - المرحلة 1
    wp_enqueue_style('aos-css', 'https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css', array(), '2.3.4');
    wp_enqueue_script('aos-js', 'https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js', array(), '2.3.4', true);
    
    // jQuery (مضمن في ووردبريس)
    wp_enqueue_script('jquery');
    
    // السكريبت الرئيسي للقالب
    wp_enqueue_script('arabic-themes-main', ARABIC_THEMES_ASSETS . '/js/main.js', array('jquery', 'gsap'), ARABIC_THEMES_VERSION, true);
    
    // تمرير متغيرات JavaScript محسنة
    wp_localize_script('arabic-themes-main', 'ArabicThemes', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('arabic_themes_nonce'),
        'homeurl' => home_url(),
        'themeurl' => ARABIC_THEMES_URL,
        'assetsurl' => ARABIC_THEMES_ASSETS,
        'is_rtl'  => is_rtl(),
        'strings' => array(
            'loading'           => __('جاري التحميل...', 'arabic-themes'),
            'error'            => __('حدث خطأ، يرجى المحاولة مرة أخرى', 'arabic-themes'),
            'success'          => __('تم بنجاح!', 'arabic-themes'),
            'download_started' => __('بدأ التحميل...', 'arabic-themes'),
            'rate_first'       => __('يرجى تقييم القالب أولاً', 'arabic-themes'),
            'thank_you'        => __('شكراً لك!', 'arabic-themes'),
            'copied'           => __('تم النسخ!', 'arabic-themes'),
            'search_placeholder' => __('ابحث عن القوالب...', 'arabic-themes'),
        )
    ));
    
    // دعم التعليقات
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'arabic_themes_scripts');

/**
 * تسجيل نوع محتوى مخصص للقوالب
 */
function arabic_themes_register_post_types() {
    $labels = array(
        'name'                  => _x('قوالب ووردبريس', 'Post type general name', 'arabic-themes'),
        'singular_name'         => _x('قالب ووردبريس', 'Post type singular name', 'arabic-themes'),
        'menu_name'             => _x('القوالب', 'Admin Menu text', 'arabic-themes'),
        'name_admin_bar'        => _x('قالب', 'Add New on Toolbar', 'arabic-themes'),
        'add_new'               => __('إضافة جديد', 'arabic-themes'),
        'add_new_item'          => __('إضافة قالب جديد', 'arabic-themes'),
        'new_item'              => __('قالب جديد', 'arabic-themes'),
        'edit_item'             => __('تحرير القالب', 'arabic-themes'),
        'view_item'             => __('عرض القالب', 'arabic-themes'),
        'all_items'             => __('جميع القوالب', 'arabic-themes'),
        'search_items'          => __('البحث في القوالب', 'arabic-themes'),
        'parent_item_colon'     => __('القالب الأب:', 'arabic-themes'),
        'not_found'             => __('لم يتم العثور على قوالب.', 'arabic-themes'),
        'not_found_in_trash'    => __('لم يتم العثور على قوالب في سلة المهملات.', 'arabic-themes'),
        'featured_image'        => _x('صورة القالب', 'Overrides the "Featured Image" phrase', 'arabic-themes'),
        'set_featured_image'    => _x('تعيين صورة القالب', 'Overrides the "Set featured image" phrase', 'arabic-themes'),
        'remove_featured_image' => _x('إزالة صورة القالب', 'Overrides the "Remove featured image" phrase', 'arabic-themes'),
        'use_featured_image'    => _x('استخدام كصورة القالب', 'Overrides the "Use as featured image" phrase', 'arabic-themes'),
        'archives'              => _x('أرشيف القوالب', 'The post type archive label used in nav menus', 'arabic-themes'),
        'insert_into_item'      => _x('إدراج في القالب', 'Overrides the "Insert into post"/"Insert into page" phrase', 'arabic-themes'),
        'uploaded_to_this_item' => _x('رُفع إلى هذا القالب', 'Overrides the "Uploaded to this post"/"Uploaded to this page" phrase', 'arabic-themes'),
        'filter_items_list'     => _x('فلترة قائمة القوالب', 'Screen reader text for the filter links', 'arabic-themes'),
        'items_list_navigation' => _x('تنقل قائمة القوالب', 'Screen reader text for the pagination', 'arabic-themes'),
        'items_list'            => _x('قائمة القوالب', 'Screen reader text for the items list', 'arabic-themes'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'themes'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-admin-appearance',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'comments', 'custom-fields'),
        'taxonomies'         => array('theme_category', 'theme_tag'),
    );

    register_post_type('wp_themes', $args);
}
add_action('init', 'arabic_themes_register_post_types');

/**
 * تسجيل التصنيفات المخصصة
 */
function arabic_themes_register_taxonomies() {
    // تصنيفات القوالب
    register_taxonomy('theme_category', 'wp_themes', array(
        'labels' => array(
            'name'              => _x('تصنيفات القوالب', 'taxonomy general name', 'arabic-themes'),
            'singular_name'     => _x('تصنيف القالب', 'taxonomy singular name', 'arabic-themes'),
            'search_items'      => __('البحث في التصنيفات', 'arabic-themes'),
            'all_items'         => __('جميع التصنيفات', 'arabic-themes'),
            'parent_item'       => __('التصنيف الأب', 'arabic-themes'),
            'parent_item_colon' => __('التصنيف الأب:', 'arabic-themes'),
            'edit_item'         => __('تحرير التصنيف', 'arabic-themes'),
            'update_item'       => __('تحديث التصنيف', 'arabic-themes'),
            'add_new_item'      => __('إضافة تصنيف جديد', 'arabic-themes'),
            'new_item_name'     => __('اسم التصنيف الجديد', 'arabic-themes'),
            'menu_name'         => __('التصنيفات', 'arabic-themes'),
        ),
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'show_in_rest'      => true,
        'rewrite'           => array('slug' => 'theme-category'),
    ));

    // وسوم القوالب
    register_taxonomy('theme_tag', 'wp_themes', array(
        'labels' => array(
            'name'                       => _x('وسوم القوالب', 'taxonomy general name', 'arabic-themes'),
            'singular_name'              => _x('وسم القالب', 'taxonomy singular name', 'arabic-themes'),
            'search_items'               => __('البحث في الوسوم', 'arabic-themes'),
            'popular_items'              => __('الوسوم الشائعة', 'arabic-themes'),
            'all_items'                  => __('جميع الوسوم', 'arabic-themes'),
            'parent_item'                => null,
            'parent_item_colon'          => null,
            'edit_item'                  => __('تحرير الوسم', 'arabic-themes'),
            'update_item'                => __('تحديث الوسم', 'arabic-themes'),
            'add_new_item'               => __('إضافة وسم جديد', 'arabic-themes'),
            'new_item_name'              => __('اسم الوسم الجديد', 'arabic-themes'),
            'separate_items_with_commas' => __('فصل الوسوم بفواصل', 'arabic-themes'),
            'add_or_remove_items'        => __('إضافة أو إزالة وسوم', 'arabic-themes'),
            'choose_from_most_used'      => __('اختر من الأكثر استخداماً', 'arabic-themes'),
            'not_found'                  => __('لم يتم العثور على وسوم.', 'arabic-themes'),
            'menu_name'                  => __('الوسوم', 'arabic-themes'),
        ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'query_var'             => true,
        'show_in_rest'          => true,
        'rewrite'               => array('slug' => 'theme-tag'),
    ));
}
add_action('init', 'arabic_themes_register_taxonomies');

/**
 * تسجيل مناطق الودجت
 */
function arabic_themes_widgets_init() {
    register_sidebar(array(
        'name'          => __('الشريط الجانبي الرئيسي', 'arabic-themes'),
        'id'            => 'sidebar-1',
        'description'   => __('إضافة ودجت إلى الشريط الجانبي الرئيسي', 'arabic-themes'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    // تذييل الصفحة
    for ($i = 1; $i <= 4; $i++) {
        register_sidebar(array(
            'name'          => sprintf(__('تذييل %d', 'arabic-themes'), $i),
            'id'            => 'footer-' . $i,
            'description'   => sprintf(__('إضافة ودجت إلى العمود %d في التذييل', 'arabic-themes'), $i),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ));
    }
}
add_action('widgets_init', 'arabic_themes_widgets_init');

/**
 * إضافة Meta Boxes للقوالب - المرحلة 2
 */
function arabic_themes_add_theme_meta_boxes() {
    add_meta_box(
        'theme_details',
        __('تفاصيل القالب', 'arabic-themes'),
        'arabic_themes_theme_details_callback',
        'wp_themes',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'arabic_themes_add_theme_meta_boxes');

/**
 * عرض حقول تفاصيل القالب
 */
function arabic_themes_theme_details_callback($post) {
    wp_nonce_field('arabic_themes_save_theme_details', 'theme_details_nonce');
    
    $demo_url = get_post_meta($post->ID, '_theme_demo_url', true);
    $download_url = get_post_meta($post->ID, '_theme_download_url', true);
    $version = get_post_meta($post->ID, '_theme_version', true);
    $compatibility = get_post_meta($post->ID, '_theme_compatibility', true);
    $price = get_post_meta($post->ID, '_theme_price', true);
    $features = get_post_meta($post->ID, '_theme_features', true);
    
    ?>
    <table class="form-table">
        <tr>
            <th scope="row">
                <label for="theme_demo_url"><?php _e('رابط المعاينة', 'arabic-themes'); ?></label>
            </th>
            <td>
                <input type="url" id="theme_demo_url" name="theme_demo_url" value="<?php echo esc_attr($demo_url); ?>" class="regular-text" />
                <p class="description"><?php _e('رابط معاينة القالب المباشرة', 'arabic-themes'); ?></p>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="theme_download_url"><?php _e('رابط التحميل', 'arabic-themes'); ?></label>
            </th>
            <td>
                <input type="url" id="theme_download_url" name="theme_download_url" value="<?php echo esc_attr($download_url); ?>" class="regular-text" />
                <p class="description"><?php _e('رابط تحميل ملف القالب', 'arabic-themes'); ?></p>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="theme_version"><?php _e('إصدار القالب', 'arabic-themes'); ?></label>
            </th>
            <td>
                <input type="text" id="theme_version" name="theme_version" value="<?php echo esc_attr($version); ?>" class="small-text" />
                <p class="description"><?php _e('رقم إصدار القالب (مثال: 1.0.0)', 'arabic-themes'); ?></p>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="theme_compatibility"><?php _e('توافق ووردبريس', 'arabic-themes'); ?></label>
            </th>
            <td>
                <input type="text" id="theme_compatibility" name="theme_compatibility" value="<?php echo esc_attr($compatibility); ?>" class="small-text" />
                <p class="description"><?php _e('أدنى إصدار ووردبريس مدعوم (مثال: 5.0+)', 'arabic-themes'); ?></p>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="theme_price"><?php _e('السعر', 'arabic-themes'); ?></label>
            </th>
            <td>
                <input type="text" id="theme_price" name="theme_price" value="<?php echo esc_attr($price); ?>" class="small-text" />
                <p class="description"><?php _e('سعر القالب (اتركه فارغاً للقوالب المجانية)', 'arabic-themes'); ?></p>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="theme_features"><?php _e('المميزات', 'arabic-themes'); ?></label>
            </th>
            <td>
                <textarea id="theme_features" name="theme_features" rows="5" class="large-text"><?php echo esc_textarea($features); ?></textarea>
                <p class="description"><?php _e('قائمة مميزات القالب (ميزة واحدة في كل سطر)', 'arabic-themes'); ?></p>
            </td>
        </tr>
    </table>
    <?php
}

/**
 * حفظ حقول تفاصيل القالب
 */
function arabic_themes_save_theme_details($post_id) {
    if (!isset($_POST['theme_details_nonce']) || !wp_verify_nonce($_POST['theme_details_nonce'], 'arabic_themes_save_theme_details')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (isset($_POST['post_type']) && 'wp_themes' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return;
        }
    } else {
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
    }
    
    $fields = array(
        'theme_demo_url',
        'theme_download_url',
        'theme_version',
        'theme_compatibility',
        'theme_price',
        'theme_features'
    );
    
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            $value = sanitize_text_field($_POST[$field]);
            if ($field === 'theme_features') {
                $value = sanitize_textarea_field($_POST[$field]);
            }
            update_post_meta($post_id, '_' . $field, $value);
        }
    }
}
add_action('save_post', 'arabic_themes_save_theme_details');

/**
 * إنشاء جدول التقييمات البسيط - المرحلة 2
 */
function arabic_themes_create_simple_ratings_table() {
    global $wpdb;
    
    $table_name = $wpdb->prefix . 'theme_ratings';
    $charset_collate = $wpdb->get_charset_collate();
    
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        theme_id bigint(20) NOT NULL,
        rating tinyint(1) NOT NULL,
        user_ip varchar(45) NOT NULL,
        created_at datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        KEY theme_id (theme_id),
        KEY user_ip (user_ip)
    ) $charset_collate;";
    
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

/**
 * تخصيص طول المقتطف
 */
function arabic_themes_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'arabic_themes_excerpt_length');

/**
 * تخصيص نص "المزيد" في المقتطف
 */
function arabic_themes_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'arabic_themes_excerpt_more');

/**
 * إضافة فئة CSS للصفحة الرئيسية
 */
function arabic_themes_body_classes($classes) {
    if (is_front_page()) {
        $classes[] = 'home-page';
    }
    
    if (is_rtl()) {
        $classes[] = 'rtl-layout';
    }
    
    if (is_post_type_archive('wp_themes')) {
        $classes[] = 'themes-archive';
    }
    
    if (is_singular('wp_themes')) {
        $classes[] = 'single-theme';
    }
    
    return $classes;
}
add_filter('body_class', 'arabic_themes_body_classes');

/**
 * دوال مساعدة محسنة
 */
function arabic_themes_get_theme_meta($post_id, $meta_key, $default = '') {
    $meta_value = get_post_meta($post_id, $meta_key, true);
    return !empty($meta_value) ? $meta_value : $default;
}

/**
 * دالة لعرض نجوم التقييم
 */
function arabic_themes_rating_stars($rating, $max_rating = 5) {
    $stars_html = '';
    
    for ($i = 1; $i <= $max_rating; $i++) {
        if ($i <= $rating) {
            $stars_html .= '<i class="fas fa-star active"></i>';
        } elseif ($i - 0.5 <= $rating) {
            $stars_html .= '<i class="fas fa-star-half-alt active"></i>';
        } else {
            $stars_html .= '<i class="far fa-star"></i>';
        }
    }
    
    return $stars_html;
}

/**
 * دالة لحساب متوسط التقييم - مبسطة
 */
function arabic_themes_calculate_average_rating($post_id) {
    global $wpdb;
    
    $table_name = $wpdb->prefix . 'theme_ratings';
    
    // التحقق من وجود الجدول
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        return 0;
    }
    
    $average = $wpdb->get_var($wpdb->prepare(
        "SELECT AVG(rating) FROM $table_name WHERE theme_id = %d",
        $post_id
    ));
    
    return $average ? round($average, 1) : 0;
}

/**
 * دالة للحصول على عدد التحميلات
 */
function arabic_themes_get_download_count($post_id) {
    $count = get_post_meta($post_id, '_download_count', true);
    return $count ? intval($count) : 0;
}

/**
 * دالة لزيادة عداد التحميلات
 */
function arabic_themes_increment_download_count($post_id) {
    $current_count = arabic_themes_get_download_count($post_id);
    $new_count = $current_count + 1;
    update_post_meta($post_id, '_download_count', $new_count);
    return $new_count;
}

/**
 * دالة لتنسيق أرقام التحميلات
 */
function arabic_themes_format_number($number) {
    if ($number >= 1000000) {
        return number_format($number / 1000000, 1) . 'M';
    } elseif ($number >= 1000) {
        return number_format($number / 1000, 1) . 'K';
    }
    return number_format($number);
}

/**
 * AJAX: تحميل القالب مع التقييم - مبسط
 */
function arabic_themes_download_theme() {
    // التحقق من الأمان
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'arabic_themes_nonce')) {
        wp_send_json_error(__('فشل التحقق من الأمان', 'arabic-themes'));
        return;
    }
    
    $theme_id = intval($_POST['theme_id'] ?? 0);
    $rating = intval($_POST['rating'] ?? 0);
    $user_ip = $_SERVER['REMOTE_ADDR'];
    
    // التحقق من وجود القالب
    if (!get_post($theme_id) || get_post_type($theme_id) !== 'wp_themes') {
        wp_send_json_error(__('القالب غير موجود', 'arabic-themes'));
        return;
    }
    
    // التحقق من صحة التقييم
    if ($rating < 1 || $rating > 5) {
        wp_send_json_error(__('التقييم غير صحيح', 'arabic-themes'));
        return;
    }
    
    global $wpdb;
    $table_name = $wpdb->prefix . 'theme_ratings';
    
    // التحقق من عدم تقييم المستخدم مسبقاً (24 ساعة)
    $existing_rating = $wpdb->get_var($wpdb->prepare(
        "SELECT id FROM $table_name WHERE theme_id = %d AND user_ip = %s AND created_at > DATE_SUB(NOW(), INTERVAL 24 HOUR)",
        $theme_id,
        $user_ip
    ));
    
    if (!$existing_rating) {
        // إدراج التقييم الجديد
        $wpdb->insert(
            $table_name,
            array(
                'theme_id' => $theme_id,
                'rating' => $rating,
                'user_ip' => $user_ip,
                'created_at' => current_time('mysql')
            ),
            array('%d', '%d', '%s', '%s')
        );
    }
    
    // زيادة عداد التحميلات
    $download_count = arabic_themes_increment_download_count($theme_id);
    
    // الحصول على رابط التحميل
    $download_url = get_post_meta($theme_id, '_theme_download_url', true);
    
    if (empty($download_url)) {
        // رابط افتراضي للتجربة
        $download_url = '#';
    }
    
    // إرسال الاستجابة
    wp_send_json_success(array(
        'download_url' => $download_url,
        'download_count' => arabic_themes_format_number($download_count),
        'average_rating' => arabic_themes_calculate_average_rating($theme_id),
        'message' => __('شكراً لتقييمك! بدأ التحميل...', 'arabic-themes')
    ));
}
add_action('wp_ajax_download_theme', 'arabic_themes_download_theme');
add_action('wp_ajax_nopriv_download_theme', 'arabic_themes_download_theme');

/**
 * AJAX: إرسال نموذج التواصل
 */
function arabic_themes_submit_contact_form() {
    // التحقق من الأمان
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'arabic_themes_nonce')) {
        wp_send_json_error(__('فشل التحقق من الأمان', 'arabic-themes'));
        return;
    }
    
    // تنظيف البيانات
    $name = sanitize_text_field($_POST['name'] ?? '');
    $email = sanitize_email($_POST['email'] ?? '');
    $subject = sanitize_text_field($_POST['subject'] ?? '');
    $message = sanitize_textarea_field($_POST['message'] ?? '');
    
    // التحقق من البيانات
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        wp_send_json_error(__('جميع الحقول مطلوبة', 'arabic-themes'));
        return;
    }
    
    if (!is_email($email)) {
        wp_send_json_error(__('البريد الإلكتروني غير صحيح', 'arabic-themes'));
        return;
    }
    
    // إعداد البريد الإلكتروني
    $to = get_option('admin_email');
    $email_subject = sprintf(__('رسالة جديدة من %s: %s', 'arabic-themes'), $name, $subject);
    $email_message = sprintf(
        __("اسم المرسل: %s\nالبريد الإلكتروني: %s\nالموضوع: %s\n\nالرسالة:\n%s", 'arabic-themes'),
        $name,
        $email,
        $subject,
        $message
    );
    
    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: ' . $name . ' <' . $email . '>',
        'Reply-To: ' . $email
    );
    
    // إرسال البريد
    $sent = wp_mail($to, $email_subject, $email_message, $headers);
    
    if ($sent) {
        wp_send_json_success(__('تم إرسال رسالتك بنجاح! سنتواصل معك قريباً.', 'arabic-themes'));
    } else {
        wp_send_json_error(__('فشل في إرسال الرسالة، يرجى المحاولة مرة أخرى', 'arabic-themes'));
    }
}
add_action('wp_ajax_submit_contact_form', 'arabic_themes_submit_contact_form');
add_action('wp_ajax_nopriv_submit_contact_form', 'arabic_themes_submit_contact_form');

/**
 * تخصيص الاستعلامات الرئيسية
 */
function arabic_themes_modify_main_query($query) {
    if (!is_admin() && $query->is_main_query()) {
        if (is_home()) {
            $query->set('posts_per_page', 8);
        }
        
        if (is_post_type_archive('wp_themes')) {
            $query->set('posts_per_page', 12);
        }
    }
}
add_action('pre_get_posts', 'arabic_themes_modify_main_query');

/**
 * إضافة أعمدة مخصصة لجدول القوالب في الإدارة
 */
function arabic_themes_add_theme_columns($columns) {
    $new_columns = array();
    
    foreach ($columns as $key => $value) {
        $new_columns[$key] = $value;
        
        if ($key === 'title') {
            $new_columns['theme_preview'] = __('معاينة', 'arabic-themes');
            $new_columns['downloads'] = __('التحميلات', 'arabic-themes');
            $new_columns['rating'] = __('التقييم', 'arabic-themes');
        }
    }
    
    return $new_columns;
}
add_filter('manage_wp_themes_posts_columns', 'arabic_themes_add_theme_columns');

/**
 * عرض محتوى الأعمدة المخصصة
 */
function arabic_themes_theme_column_content($column, $post_id) {
    switch ($column) {
        case 'theme_preview':
            if (has_post_thumbnail($post_id)) {
                echo get_the_post_thumbnail($post_id, array(80, 60));
            } else {
                echo '<span class="dashicons dashicons-format-image" style="font-size: 40px; color: #ccc;"></span>';
            }
            break;
            
        case 'downloads':
            $count = arabic_themes_get_download_count($post_id);
            echo arabic_themes_format_number($count);
            break;
            
        case 'rating':
            $rating = arabic_themes_calculate_average_rating($post_id);
            if ($rating > 0) {
                echo arabic_themes_rating_stars($rating) . ' (' . $rating . ')';
            } else {
                echo __('لا توجد تقييمات', 'arabic-themes');
            }
            break;
    }
}
add_action('manage_wp_themes_posts_custom_column', 'arabic_themes_theme_column_content', 10, 2);

/**
 * إضافة CSS أساسي إضافي للصفحات
 */
function arabic_themes_inline_styles() {
    ?>
    <style>
    /* أنماط أساسية لحل مشكلة الصفحات البيضاء */
    body {
        background: linear-gradient(135deg, #0a0a0f 0%, #1a1a2e 50%, #16213e 100%);
        color: #ffffff;
        min-height: 100vh;
    }
    
    .main-content {
        min-height: 60vh;
        padding: 2rem 0;
    }
    
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1rem;
    }
    
    /* أنماط النصوص الأساسية */
    h1, h2, h3, h4, h5, h6 {
        color: #ffffff;
        font-family: 'Cairo', 'Tajawal', sans-serif;
    }
    
    p {
        color: #b8b9ba;
        line-height: 1.6;
    }
    
    /* أنماط الروابط */
    a {
        color: #3b82f6;
        text-decoration: none;
        transition: color 0.3s ease;
    }
    
    a:hover {
        color: #8b5cf6;
    }
    
    /* أنماط الأزرار الأساسية */
    .btn {
        display: inline-block;
        padding: 0.75rem 1.5rem;
        background: linear-gradient(45deg, #3b82f6, #8b5cf6);
        color: white;
        border: none;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(59, 130, 246, 0.3);
        color: white;
    }
    
    .btn-secondary {
        background: transparent;
        border: 2px solid #3b82f6;
        color: #3b82f6;
    }
    
    .btn-secondary:hover {
        background: #3b82f6;
        color: white;
    }
    
    /* شبكة أساسية */
    .grid {
        display: grid;
        gap: 2rem;
    }
    
    .grid-2 {
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    }
    
    .grid-3 {
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    }
    
    /* بطاقات أساسية */
    .card {
        background: rgba(26, 26, 46, 0.8);
        border: 1px solid rgba(59, 130, 246, 0.2);
        border-radius: 15px;
        padding: 1.5rem;
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        border-color: #3b82f6;
        box-shadow: 0 15px 40px rgba(59, 130, 246, 0.1);
    }
    
    /* تحسين الاستجابة */
    @media (max-width: 768px) {
        .container {
            padding: 0 0.5rem;
        }
        
        .main-content {
            padding: 1rem 0;
        }
        
        h1 {
            font-size: 2rem;
        }
        
        h2 {
            font-size: 1.5rem;
        }
    }
    </style>
    <?php
}
add_action('wp_head', 'arabic_themes_inline_styles');

/**
 * تحسين الأداء - إزالة العناصر غير الضرورية
 */
function arabic_themes_clean_head() {
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wp_shortlink_wp_head');
}
add_action('init', 'arabic_themes_clean_head');

/**
 * دالة التفعيل - تشغيل عند تفعيل القالب
 */
function arabic_themes_activation() {
    // إنشاء جدول التقييمات
    arabic_themes_create_simple_ratings_table();
    
    // تحديث قواعد إعادة الكتابة
    flush_rewrite_rules();
    
    // إضافة بيانات تجريبية بسيطة
    arabic_themes_add_sample_data();
}
add_action('after_switch_theme', 'arabic_themes_activation');

/**
 * إضافة بيانات تجريبية أساسية
 */
function arabic_themes_add_sample_data() {
    // إنشاء صفحات أساسية إذا لم تكن موجودة
    $pages = array(
        'contact' => array(
            'title' => 'اتصل بنا',
            'content' => '<h2>تواصل معنا</h2><p>نحن هنا لمساعدتك! تواصل معنا عبر النموذج أدناه.</p>'
        ),
        'about' => array(
            'title' => 'من نحن',
            'content' => '<h2>من نحن</h2><p>نحن فريق متخصص في تطوير قوالب ووردبريس العربية المتطورة.</p>'
        ),
        'privacy-policy' => array(
            'title' => 'سياسة الخصوصية',
            'content' => '<h2>سياسة الخصوصية</h2><p>نحن نحترم خصوصيتك ونحمي بياناتك الشخصية.</p>'
        )
    );
    
    foreach ($pages as $slug => $page_data) {
        if (!get_page_by_path($slug)) {
            wp_insert_post(array(
                'post_title' => $page_data['title'],
                'post_content' => $page_data['content'],
                'post_status' => 'publish',
                'post_type' => 'page',
                'post_name' => $slug
            ));
        }
    }
}

// نهاية الملف - لا تضع أي كود بعد هذا السطر
?>
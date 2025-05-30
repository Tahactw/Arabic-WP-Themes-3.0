<?php
// أضف هذا الكود في نهاية ملف functions.php

/**
 * تأكيد تفعيل نوع المحتوى والتصنيفات
 */
function arabic_themes_ensure_post_type_activation() {
    // إعادة تسجيل نوع المحتوى
    arabic_themes_register_post_types();
    arabic_themes_register_taxonomies();
    
    // تحديث قواعد الروابط
    flush_rewrite_rules();
}
add_action('init', 'arabic_themes_ensure_post_type_activation', 20);

/**
 * إضافة رسالة في لوحة التحكم
 */
function arabic_themes_admin_notice() {
    $screen = get_current_screen();
    
    if ($screen->id === 'themes') {
        $themes_count = wp_count_posts('wp_themes');
        
        if ($themes_count->publish == 0) {
            echo '<div class="notice notice-warning is-dismissible">';
            echo '<p><strong>قوالب عربية ووردبريس:</strong> لا توجد قوالب منشورة بعد. ';
            echo '<a href="' . admin_url('post-new.php?post_type=wp_themes') . '" class="button button-primary">إضافة قالب جديد</a>';
            echo '</p></div>';
        }
    }
}
add_action('admin_notices', 'arabic_themes_admin_notice');

/**
 * إضافة بيانات تجريبية سريعة
 */
function arabic_themes_quick_sample_data() {
    if (isset($_GET['create_sample_themes']) && current_user_can('manage_options')) {
        
        // إنشاء قالب تجريبي واحد سريع
        $sample_post = array(
            'post_title' => 'قالب تجريبي - ' . date('Y-m-d H:i:s'),
            'post_content' => 'هذا قالب تجريبي لاختبار النظام. يمكنك حذفه لاحقاً وإضافة قوالبك الحقيقية.',
            'post_excerpt' => 'قالب تجريبي لاختبار النظام',
            'post_status' => 'publish',
            'post_type' => 'wp_themes',
            'post_author' => get_current_user_id()
        );
        
        $post_id = wp_insert_post($sample_post);
        
        if ($post_id) {
            // إضافة بيانات مخصصة
            update_post_meta($post_id, '_theme_demo_url', 'https://example.com/demo');
            update_post_meta($post_id, '_theme_download_url', 'https://example.com/download.zip');
            update_post_meta($post_id, '_theme_version', '1.0.0');
            update_post_meta($post_id, '_theme_compatibility', '6.0+');
            update_post_meta($post_id, '_theme_features', "تصميم متجاوب\nسهل التخصيص\nدعم فني");
            update_post_meta($post_id, '_download_count', rand(10, 100));
            
            wp_redirect(admin_url('edit.php?post_type=wp_themes&message=تم إنشاء قالب تجريبي'));
            exit;
        }
    }
}
add_action('admin_init', 'arabic_themes_quick_sample_data');
?>
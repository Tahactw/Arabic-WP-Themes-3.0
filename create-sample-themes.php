<?php
/**
 * ملف إنشاء قوالب تجريبية
 * ضعه في مجلد القالب وقم بتشغيله مرة واحدة
 */

// التأكد من أن هذا ووردبريس
if (!defined('ABSPATH')) {
    require_once('../../../wp-load.php');
}

// التحقق من الصلاحيات
if (!current_user_can('manage_options')) {
    die('غير مسموح بالوصول');
}

echo "<h1>إنشاء قوالب تجريبية...</h1>";

// بيانات القوالب التجريبية
$sample_themes = array(
    array(
        'title' => 'قالب الشركات الحديث',
        'content' => 'قالب احترافي مخصص للشركات والمؤسسات التجارية. يتميز بتصميم عصري وواجهة مستخدم سهلة الاستخدام.',
        'excerpt' => 'قالب احترافي للشركات بتصميم عصري ومتجاوب',
        'meta' => array(
            '_theme_demo_url' => 'https://demo.example.com/corporate',
            '_theme_download_url' => 'https://downloads.example.com/corporate.zip',
            '_theme_version' => '1.2.0',
            '_theme_compatibility' => '6.0+',
            '_theme_price' => '',
            '_theme_features' => "تصميم متجاوب بالكامل\nدعم الووكومرس\nتحسين لمحركات البحث\nلوحة خيارات متقدمة\nدعم فني مجاني"
        ),
        'categories' => array('شركات', 'أعمال'),
        'tags' => array('متجاوب', 'حديث', 'احترافي')
    ),
    array(
        'title' => 'قالب المتجر الإلكتروني',
        'content' => 'قالب متخصص للمتاجر الإلكترونية مع دعم كامل للووكومرس وتصميم محسن للمبيعات.',
        'excerpt' => 'قالب متجر إلكتروني متكامل مع ووكومرس',
        'meta' => array(
            '_theme_demo_url' => 'https://demo.example.com/shop',
            '_theme_download_url' => 'https://downloads.example.com/shop.zip',
            '_theme_version' => '2.1.0',
            '_theme_compatibility' => '5.8+',
            '_theme_price' => '49',
            '_theme_features' => "دعم ووكومرس كامل\nصفحات منتجات محسنة\nعربة تسوق متقدمة\nنظام دفع متعدد\nتتبع الطلبات"
        ),
        'categories' => array('متاجر', 'ووكومرس'),
        'tags' => array('تجارة', 'متجر', 'مبيعات')
    ),
    array(
        'title' => 'قالب المدونة الشخصية',
        'content' => 'قالب أنيق للمدونات الشخصية والكتاب مع تركيز على القراءة والمحتوى.',
        'excerpt' => 'قالب مدونة شخصية أنيق ومحسن للقراءة',
        'meta' => array(
            '_theme_demo_url' => 'https://demo.example.com/blog',
            '_theme_download_url' => 'https://downloads.example.com/blog.zip',
            '_theme_version' => '1.0.5',
            '_theme_compatibility' => '6.0+',
            '_theme_price' => '',
            '_theme_features' => "تصميم نظيف للقراءة\nدعم التصنيفات\nشريط جانبي قابل للتخصيص\nتحسين السرعة\nدعم التعليقات"
        ),
        'categories' => array('مدونات', 'شخصي'),
        'tags' => array('مدونة', 'كتابة', 'شخصي')
    ),
    array(
        'title' => 'قالب البورتفوليو الإبداعي',
        'content' => 'قالب مذهل لعرض الأعمال الإبداعية والمشاريع الفنية بطريقة احترافية.',
        'excerpt' => 'قالب بورتفوليو إبداعي لعرض الأعمال الفنية',
        'meta' => array(
            '_theme_demo_url' => 'https://demo.example.com/portfolio',
            '_theme_download_url' => 'https://downloads.example.com/portfolio.zip',
            '_theme_version' => '1.5.2',
            '_theme_compatibility' => '5.9+',
            '_theme_price' => '35',
            '_theme_features' => "معرض صور متقدم\nعرض فيديوهات\nفلاتر المشاريع\nصفحة اتصال متقدمة\nتأثيرات بصرية"
        ),
        'categories' => array('بورتفوليو', 'إبداعي'),
        'tags' => array('فني', 'إبداعي', 'معرض')
    ),
    array(
        'title' => 'قالب الأخبار الإخباري',
        'content' => 'قالب شامل للمواقع الإخبارية والمجلات الرقمية مع إدارة محتوى متقدمة.',
        'excerpt' => 'قالب إخباري شامل للمواقع الإعلامية',
        'meta' => array(
            '_theme_demo_url' => 'https://demo.example.com/news',
            '_theme_download_url' => 'https://downloads.example.com/news.zip',
            '_theme_version' => '2.0.1',
            '_theme_compatibility' => '6.0+',
            '_theme_price' => '59',
            '_theme_features' => "تخطيطات متعددة\nويدجت الأخبار العاجلة\nنظام التصنيفات المتقدم\nتحسين للسرعة\nدعم الإعلانات"
        ),
        'categories' => array('أخبار', 'مجلات'),
        'tags' => array('إخباري', 'صحافة', 'مجلة')
    ),
    array(
        'title' => 'قالب المطعم والكافيه',
        'content' => 'قالب مصمم خصيصاً للمطاعم والكافيهات مع قوائم طعام تفاعلية ونظام حجوزات.',
        'excerpt' => 'قالب مطعم تفاعلي مع قوائم طعام ونظام حجوزات',
        'meta' => array(
            '_theme_demo_url' => 'https://demo.example.com/restaurant',
            '_theme_download_url' => 'https://downloads.example.com/restaurant.zip',
            '_theme_version' => '1.3.0',
            '_theme_compatibility' => '5.8+',
            '_theme_price' => '45',
            '_theme_features' => "قوائم طعام تفاعلية\nنظام حجوزات\nمعرض صور الطعام\nصفحة الطهاة\nخرائط جوجل"
        ),
        'categories' => array('مطاعم', 'خدمات'),
        'tags' => array('طعام', 'مطعم', 'حجوزات')
    )
);

// إنشاء التصنيفات أولاً
$categories_created = array();
$tags_created = array();

echo "<h2>إنشاء التصنيفات...</h2>";
$all_categories = array('شركات', 'أعمال', 'متاجر', 'ووكومرس', 'مدونات', 'شخصي', 'بورتفوليو', 'إبداعي', 'أخبار', 'مجلات', 'مطاعم', 'خدمات');

foreach ($all_categories as $cat_name) {
    $term = wp_insert_term($cat_name, 'theme_category');
    if (!is_wp_error($term)) {
        $categories_created[$cat_name] = $term['term_id'];
        echo "✅ تم إنشاء تصنيف: $cat_name<br>";
    } else {
        $existing = get_term_by('name', $cat_name, 'theme_category');
        if ($existing) {
            $categories_created[$cat_name] = $existing->term_id;
            echo "ℹ️ التصنيف موجود: $cat_name<br>";
        }
    }
}

echo "<h2>إنشاء الوسوم...</h2>";
$all_tags = array('متجاوب', 'حديث', 'احترافي', 'تجارة', 'متجر', 'مبيعات', 'مدونة', 'كتابة', 'شخصي', 'فني', 'إبداعي', 'معرض', 'إخباري', 'صحافة', 'مجلة', 'طعام', 'مطعم', 'حجوزات');

foreach ($all_tags as $tag_name) {
    $term = wp_insert_term($tag_name, 'theme_tag');
    if (!is_wp_error($term)) {
        $tags_created[$tag_name] = $term['term_id'];
        echo "✅ تم إنشاء وسم: $tag_name<br>";
    } else {
        $existing = get_term_by('name', $tag_name, 'theme_tag');
        if ($existing) {
            $tags_created[$tag_name] = $existing->term_id;
            echo "ℹ️ الوسم موجود: $tag_name<br>";
        }
    }
}

echo "<h2>إنشاء القوالب...</h2>";

// إنشاء القوالب
foreach ($sample_themes as $index => $theme_data) {
    // التحقق من عدم وجود القالب
    $existing = get_page_by_title($theme_data['title'], OBJECT, 'wp_themes');
    if ($existing) {
        echo "ℹ️ القالب موجود: " . $theme_data['title'] . "<br>";
        continue;
    }
    
    // إنشاء القالب
    $post_data = array(
        'post_title' => $theme_data['title'],
        'post_content' => $theme_data['content'],
        'post_excerpt' => $theme_data['excerpt'],
        'post_status' => 'publish',
        'post_type' => 'wp_themes',
        'post_author' => get_current_user_id()
    );
    
    $post_id = wp_insert_post($post_data);
    
    if (!is_wp_error($post_id) && $post_id > 0) {
        echo "✅ تم إنشاء القالب: " . $theme_data['title'] . " (ID: $post_id)<br>";
        
        // إضافة البيانات المخصصة
        foreach ($theme_data['meta'] as $meta_key => $meta_value) {
            update_post_meta($post_id, $meta_key, $meta_value);
        }
        echo "&nbsp;&nbsp;&nbsp;✅ تم إضافة البيانات المخصصة<br>";
        
        // إضافة عداد تحميلات عشوائي
        $random_downloads = rand(50, 1000);
        update_post_meta($post_id, '_download_count', $random_downloads);
        echo "&nbsp;&nbsp;&nbsp;✅ تم إضافة عداد التحميلات: $random_downloads<br>";
        
        // إضافة التصنيفات
        $category_ids = array();
        foreach ($theme_data['categories'] as $cat_name) {
            if (isset($categories_created[$cat_name])) {
                $category_ids[] = $categories_created[$cat_name];
            }
        }
        if (!empty($category_ids)) {
            wp_set_post_terms($post_id, $category_ids, 'theme_category');
            echo "&nbsp;&nbsp;&nbsp;✅ تم إضافة التصنيفات<br>";
        }
        
        // إضافة الوسوم
        $tag_ids = array();
        foreach ($theme_data['tags'] as $tag_name) {
            if (isset($tags_created[$tag_name])) {
                $tag_ids[] = $tags_created[$tag_name];
            }
        }
        if (!empty($tag_ids)) {
            wp_set_post_terms($post_id, $tag_ids, 'theme_tag');
            echo "&nbsp;&nbsp;&nbsp;✅ تم إضافة الوسوم<br>";
        }
        
        // إضافة صورة مميزة (placeholder)
        $placeholder_image = create_placeholder_image($theme_data['title'], $post_id);
        if ($placeholder_image) {
            set_post_thumbnail($post_id, $placeholder_image);
            echo "&nbsp;&nbsp;&nbsp;✅ تم إضافة صورة مميزة<br>";
        }
        
        echo "<br>";
    } else {
        echo "❌ فشل في إنشاء القالب: " . $theme_data['title'] . "<br>";
    }
}

// دالة إنشاء صورة placeholder
function create_placeholder_image($title, $post_id) {
    // إنشاء صورة placeholder بسيطة
    $upload_dir = wp_upload_dir();
    
    // إنشاء صورة بسيطة باستخدام GD إذا كانت متاحة
    if (function_exists('imagecreate')) {
        $width = 800;
        $height = 600;
        
        $image = imagecreate($width, $height);
        
        // ألوان
        $bg_color = imagecolorallocate($image, 26, 26, 46);
        $text_color = imagecolorallocate($image, 59, 130, 246);
        $border_color = imagecolorallocate($image, 139, 92, 246);
        
        // رسم إطار
        imagerectangle($image, 10, 10, $width-10, $height-10, $border_color);
        
        // إضافة نص
        $font_size = 5;
        $text = mb_substr($title, 0, 20, 'UTF-8');
        imagestring($image, $font_size, 50, $height/2 - 20, $text, $text_color);
        imagestring($image, 3, 50, $height/2 + 20, "Theme Preview", $text_color);
        
        // حفظ الصورة
        $filename = 'theme-preview-' . $post_id . '.png';
        $filepath = $upload_dir['path'] . '/' . $filename;
        
        if (imagepng($image, $filepath)) {
            imagedestroy($image);
            
            // إضافة الصورة لمكتبة الوسائط
            $attachment = array(
                'post_mime_type' => 'image/png',
                'post_title' => $title . ' - معاينة',
                'post_content' => '',
                'post_status' => 'inherit'
            );
            
            $attachment_id = wp_insert_attachment($attachment, $filepath, $post_id);
            
            if (!is_wp_error($attachment_id)) {
                require_once(ABSPATH . 'wp-admin/includes/image.php');
                $attachment_data = wp_generate_attachment_metadata($attachment_id, $filepath);
                wp_update_attachment_metadata($attachment_id, $attachment_data);
                
                return $attachment_id;
            }
        }
        
        imagedestroy($image);
    }
    
    return false;
}

// إضافة تقييمات عشوائية
echo "<h2>إضافة تقييمات تجريبية...</h2>";

global $wpdb;
$table_name = $wpdb->prefix . 'theme_ratings';

// التحقق من وجود الجدول
if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name) {
    $themes = get_posts(array(
        'post_type' => 'wp_themes',
        'posts_per_page' => -1,
        'post_status' => 'publish'
    ));
    
    foreach ($themes as $theme) {
        // إضافة 3-10 تقييمات عشوائية لكل قالب
        $num_ratings = rand(3, 10);
        
        for ($i = 0; $i < $num_ratings; $i++) {
            $rating = rand(3, 5); // تقييمات جيدة فقط
            $fake_ip = rand(1, 255) . '.' . rand(1, 255) . '.' . rand(1, 255) . '.' . rand(1, 255);
            
            $wpdb->insert(
                $table_name,
                array(
                    'theme_id' => $theme->ID,
                    'rating' => $rating,
                    'user_ip' => $fake_ip,
                    'created_at' => date('Y-m-d H:i:s', strtotime('-' . rand(1, 30) . ' days'))
                ),
                array('%d', '%d', '%s', '%s')
            );
        }
        
        echo "✅ تم إضافة $num_ratings تقييم للقالب: " . $theme->post_title . "<br>";
    }
} else {
    echo "❌ جدول التقييمات غير موجود<br>";
}

echo "<h2>✅ تم الانتهاء من إنشاء القوالب التجريبية!</h2>";
echo "<p><strong>الآن يمكنك:</strong></p>";
echo "<ul>";
echo "<li>الذهاب إلى <a href='" . admin_url('edit.php?post_type=wp_themes') . "'>لوحة التحكم > القوالب</a></li>";
echo "<li>زيارة <a href='" . get_post_type_archive_link('wp_themes') . "'>صفحة القوالب</a></li>";
echo "<li>حذف هذا الملف من الخادم</li>";
echo "</ul>";

echo "<p><strong>تم إنشاء " . count($sample_themes) . " قوالب بنجاح!</strong></p>";
?>
<?php
/**
 * أرشيف القوالب السينمائي - قوالب عربية ووردبريس
 * نظام متكامل ومنظم للتصفح الغامر
 * 
 * @package ArabicThemes
 * @author Tahactw
 * @date 2025-05-29
 */

// تحديد المسارات
$template_dir = get_template_directory_uri();
$archive_dir = $template_dir . '/template-parts/archive';

// تحميل الملفات المطلوبة
wp_enqueue_style('archive-base', $archive_dir . '/styles/archive-base.css', [], '1.0.0');
wp_enqueue_style('archive-components', $archive_dir . '/styles/archive-components.css', [], '1.0.0');
wp_enqueue_style('archive-animations', $archive_dir . '/styles/archive-animations.css', [], '1.0.0');

wp_enqueue_script('archive-core', $archive_dir . '/scripts/archive-core.js', [], '1.0.0', true);
wp_enqueue_script('archive-filters', $archive_dir . '/scripts/archive-filters.js', [], '1.0.0', true);
wp_enqueue_script('archive-effects', $archive_dir . '/scripts/archive-effects.js', [], '1.0.0', true);

// تمرير البيانات للـ JavaScript
wp_localize_script('archive-core', 'ArchiveData', [
    'ajaxUrl' => admin_url('admin-ajax.php'),
    'nonce' => wp_create_nonce('archive_themes_nonce'),
    'homeUrl' => home_url(),
    'loading' => 'جاري التحميل...',
    'noResults' => 'لم يتم العثور على نتائج',
]);

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>أرشيف القوالب | <?php bloginfo('name'); ?></title>
    <meta name="description" content="تصفح مجموعة رائعة من قوالب ووردبريس العربية المتطورة والاحترافية">
    
    <!-- الخطوط -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <?php wp_head(); ?>
</head>
<body <?php body_class('archive-themes-page'); ?>>

<!-- شاشة التحميل -->
<div id="archive-loader" class="archive-loader">
    <div class="loader-content">
        <div class="loader-spinner"></div>
        <h3>جاري تحميل مكتبة القوالب...</h3>
    </div>
</div>

<!-- Canvas للجسيمات المتحركة -->
<canvas id="particles-canvas"></canvas>

<!-- خلفية الـ Parallax -->
<div class="parallax-background">
    <div class="parallax-layer" data-speed="0.1"></div>
    <div class="parallax-layer" data-speed="0.3"></div>
    <div class="parallax-layer" data-speed="0.5"></div>
</div>

<!-- أيقونة Dark/Light Mode -->
<div class="theme-toggle-sidebar">
    <button id="theme-toggle" class="theme-toggle-btn" title="تغيير المظهر">
        <div class="toggle-icon">
            <i class="fas fa-sun sun-icon"></i>
            <i class="fas fa-moon moon-icon"></i>
        </div>
        <div class="toggle-ripple"></div>
    </button>
</div>

<!-- زر العودة للرئيسية -->
<div class="back-to-home">
    <a href="<?php echo home_url(); ?>" class="back-btn">
        <i class="fas fa-home"></i>
        <span>العودة للرئيسية</span>
    </a>
</div>

<!-- المحتوى الرئيسي -->
<main class="archive-main" id="archive-main">
    
    <!-- Header الأرشيف -->
    <section class="archive-header">
        <div class="container-fluid">
            <div class="header-content">
                <h1 class="archive-title">
                    <span class="title-line">مكتبة</span>
                    <span class="title-line animated-gradient">القوالب العربية</span>
                </h1>
                <p class="archive-subtitle">
                    اكتشف أجمل وأحدث قوالب ووردبريس المصممة خصيصاً للمواقع العربية
                </p>
                <div class="header-stats">
                    <div class="stat-item">
                        <span class="stat-number" data-target="<?php echo wp_count_posts('wp_themes')->publish; ?>">0</span>
                        <span class="stat-label">قالب</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number" data-target="100">0</span>
                        <span class="stat-label">% مجاني</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- شريط الفلاتر -->
    <?php include get_template_directory() . '/template-parts/archive/components/filters-bar.php'; ?>

    <!-- عرض القوالب -->
    <section class="themes-section" id="themes-section">
        <div class="container-fluid">
            
            <!-- تبديل أنماط العرض -->
            <div class="view-controls">
                <div class="view-toggle">
                    <button class="view-btn active" data-view="grid">
                        <i class="fas fa-th-large"></i>
                        <span>شبكة</span>
                    </button>
                    <button class="view-btn" data-view="list">
                        <i class="fas fa-list"></i>
                        <span>قائمة</span>
                    </button>
                    <button class="view-btn" data-view="masonry">
                        <i class="fas fa-th"></i>
                        <span>بناء</span>
                    </button>
                </div>
                
                <div class="results-info">
                    <span id="results-count">جاري العد...</span>
                </div>
            </div>

            <!-- حاوي القوالب -->
            <div class="themes-container">
                <div class="themes-grid" id="themes-grid">
                    <?php
                    // استعلام القوالب الرئيسي
                    $themes_query = new WP_Query([
                        'post_type' => 'wp_themes',
                        'posts_per_page' => 12,
                        'post_status' => 'publish',
                        'orderby' => 'date',
                        'order' => 'DESC',
                        'meta_query' => [
                            [
                                'key' => '_thumbnail_id',
                                'compare' => 'EXISTS'
                            ]
                        ]
                    ]);

                    if ($themes_query->have_posts()) :
                        while ($themes_query->have_posts()) : $themes_query->the_post();
                            // تضمين مكون بطاقة القالب
                            include get_template_directory() . '/template-parts/archive/components/theme-card.php';
                        endwhile;
                        wp_reset_postdata();
                    else :
                        echo '<div class="no-themes">لم يتم العثور على قوالب</div>';
                    endif;
                    ?>
                </div>
                
                <!-- تحميل المزيد -->
                <div class="load-more-section">
                    <button id="load-more-btn" class="load-more-btn">
                        <span class="btn-text">تحميل المزيد</span>
                        <div class="btn-loader"></div>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- قسم الإحصائيات -->
    <?php include get_template_directory() . '/template-parts/archive/components/stats-section.php'; ?>

</main>

<!-- رسائل Toast -->
<div id="toast-container" class="toast-container"></div>

<!-- تهيئة البيانات -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // إخفاء شاشة التحميل
    setTimeout(() => {
        const loader = document.getElementById('archive-loader');
        if (loader) {
            loader.classList.add('fade-out');
            setTimeout(() => loader.remove(), 500);
        }
    }, 1000);
    
    // تهيئة النظام
    if (typeof ArchiveCore !== 'undefined') {
        ArchiveCore.init();
    }
});
</script>

<?php wp_footer(); ?>
</body>
</html>
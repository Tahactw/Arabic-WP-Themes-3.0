<?php
/**
 * الأرشيف المتكامل للقوالب العربية - ووردبريس
 * تجربة سينمائية مع جميع التأثيرات المدمجة
 * 
 * @package ArabicThemes
 * @author Tahactw
 * @date 2025-05-30
 */

get_header();

// منع تحميل الملفات الرئيسية للثيم
wp_dequeue_style('arabic-themes-style');
wp_dequeue_style('arabic-themes-interactive');
wp_dequeue_style('theme-cards');
wp_dequeue_script('arabic-themes-interactive');
wp_dequeue_script('arabic-themes-performance');
wp_dequeue_script('arabic-themes-main');

// تمرير البيانات للجافا سكريبت
wp_localize_script('jquery', 'ArchiveData', [
    'ajaxUrl' => admin_url('admin-ajax.php'),
    'nonce' => wp_create_nonce('arabic_themes_nonce'),
    'homeUrl' => home_url(),
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

<!-- أيقونة Dark/Light Mode في الجانب -->
<div class="theme-toggle-sidebar">
    <button id="theme-toggle" class="theme-toggle-btn" title="تغيير المظهر">
        <div class="toggle-icon">
            <i class="fas fa-sun sun-icon"></i>
            <i class="fas fa-moon moon-icon"></i>
        </div>
        <div class="toggle-ripple"></div>
    </button>
</div>

<!-- Canvas للجسيمات المتحركة -->
<canvas id="particles-canvas"></canvas>

<!-- خلفية الـ Parallax -->
<div class="parallax-background">
    <div class="parallax-layer" data-speed="0.1"></div>
    <div class="parallax-layer" data-speed="0.3"></div>
    <div class="parallax-layer" data-speed="0.5"></div>
</div>

<!-- شاشة التحميل -->
<div id="archive-loader" class="archive-loader">
    <div class="loader-content">
        <div class="loader-spinner"></div>
        <h3>جاري تحميل مكتبة القوالب...</h3>
    </div>
</div>

<!-- المحتوى الرئيسي -->
<main class="archive-main" id="archive-main">
    
    <!-- البحث الرئيسي -->
    <section class="search-section">
        <div class="container-fluid">
            <div class="search-container-main">
                <div class="search-box-enhanced">
                    <i class="fas fa-search search-icon"></i>
                    <input 
                        type="text" 
                        id="theme-search" 
                        placeholder="ابحث في مكتبة القوالب العربية..." 
                        autocomplete="off"
                    >
                    <button type="button" class="search-clear" id="search-clear">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- شريط التحكم -->
    <section class="controls-section">
        <div class="container-fluid">
            <div class="controls-wrapper">
                
                <!-- فلاتر سريعة -->
                <div class="quick-filters">
                    <button class="filter-btn active" data-filter="all">
                        <i class="fas fa-th"></i>
                        جميع القوالب
                    </button>
                    <button class="filter-btn" data-filter="featured">
                        <i class="fas fa-star"></i>
                        مميزة
                    </button>
                    <button class="filter-btn" data-filter="new">
                        <i class="fas fa-plus"></i>
                        جديدة
                    </button>
                    <button class="filter-btn" data-filter="popular">
                        <i class="fas fa-fire"></i>
                        شائعة
                    </button>
                </div>
                
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
                    </div>
                    
                    <div class="results-info">
                        <span id="results-count">جاري العد...</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- عرض القوالب -->
    <section class="themes-section" id="themes-section">
        <div class="container-fluid">
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
                            
                            // الحصول على بيانات القالب
                            $theme_id = get_the_ID();
                            $download_count = 0;
                            $theme_rating = 0;
                            
                            // الحصول على عدد التحميلات
                            if (function_exists('arabic_themes_get_download_count')) {
                                $download_count = arabic_themes_get_download_count($theme_id);
                            } else {
                                $download_count = get_post_meta($theme_id, '_download_count', true) ?: 0;
                            }
                            
                            // الحصول على التقييم
                            if (function_exists('arabic_themes_calculate_average_rating')) {
                                $theme_rating = arabic_themes_calculate_average_rating($theme_id);
                            } else {
                                $theme_rating = get_post_meta($theme_id, '_theme_rating', true) ?: 0;
                            }
                            
                            $is_featured = get_post_meta($theme_id, '_is_featured', true);
                            $theme_version = get_post_meta($theme_id, '_theme_version', true) ?: '1.0';
                            $last_updated = get_the_modified_date('c');
                            
                            // الحصول على التصنيفات
                            $categories = get_the_terms($theme_id, 'theme_category');
                            $category_names = $categories ? wp_list_pluck($categories, 'name') : [];
                            $category_slugs = $categories ? wp_list_pluck($categories, 'slug') : [];
                            
                            // تحديد نوعية القالب
                            $theme_type = 'normal';
                            $days_since_publish = floor((time() - get_the_time('U')) / (60 * 60 * 24));
                            if ($is_featured) $theme_type = 'featured';
                            elseif ($days_since_publish <= 7) $theme_type = 'new';
                            elseif ($download_count > 100) $theme_type = 'popular';
                    ?>
                        <div class="theme-card-wrapper" 
                             data-theme-id="<?php echo $theme_id; ?>"
                             data-title="<?php echo esc_attr(get_the_title()); ?>"
                             data-categories="<?php echo esc_attr(implode(',', $category_slugs)); ?>"
                             data-date="<?php echo get_the_date('c'); ?>"
                             data-downloads="<?php echo $download_count; ?>"
                             data-rating="<?php echo $theme_rating; ?>"
                             data-featured="<?php echo $is_featured ? 'true' : 'false'; ?>"
                             data-type="<?php echo $theme_type; ?>">
                             
                            <article class="theme-card">
                                
                                <!-- شارات القالب -->
                                <div class="theme-badges">
                                    <?php if ($is_featured) : ?>
                                        <span class="badge badge-featured">
                                            <i class="fas fa-star"></i>
                                            مميز
                                        </span>
                                    <?php endif; ?>
                                    
                                    <?php if ($days_since_publish <= 7) : ?>
                                        <span class="badge badge-new">
                                            <i class="fas fa-plus"></i>
                                            جديد
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <!-- معاينة القالب -->
                                <div class="theme-preview">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>" 
                                             alt="<?php echo esc_attr(get_the_title()); ?>">
                                    <?php else : ?>
                                        <div class="no-image">
                                            <i class="fas fa-image"></i>
                                            <span>لا توجد صورة</span>
                                        </div>
                                    <?php endif; ?>
                                    <div class="theme-preview-overlay"></div>
                                </div>

                                <!-- محتوى القالب -->
                                <div class="theme-content">
                                    <h3 class="theme-title">
                                        <a href="<?php echo get_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>
                                    
                                    <!-- تقييم النجوم -->
                                    <div class="theme-rating">
                                        <div class="rating-stars">
                                            <?php
                                            if ($theme_rating > 0) {
                                                // عرض النجوم بناءً على التقييم الفعلي
                                                if (function_exists('arabic_themes_rating_stars')) {
                                                    echo arabic_themes_rating_stars($theme_rating);
                                                } else {
                                                    for ($i = 1; $i <= 5; $i++) {
                                                        if ($i <= $theme_rating) {
                                                            echo '<i class="fas fa-star"></i>';
                                                        } else {
                                                            echo '<i class="far fa-star"></i>';
                                                        }
                                                    }
                                                }
                                                echo '<span class="rating-value">(' . $theme_rating . ')</span>';
                                            } else {
                                                echo '<span class="no-rating">لا توجد تقييمات</span>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    
                                    <div class="theme-meta">
                                        <div class="theme-downloads">
                                            <i class="fas fa-download"></i>
                                            <span><?php echo number_format($download_count); ?> تحميل</span>
                                        </div>
                                        
                                        <div class="theme-categories">
                                            <?php foreach (array_slice($category_names, 0, 2) as $category) : ?>
                                                <span class="category-tag"><?php echo esc_html($category); ?></span>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    <?php 
                        endwhile;
                        wp_reset_postdata();
                    else : 
                    ?>
                        <div class="no-themes">
                            <div class="no-themes-content">
                                <i class="fas fa-search"></i>
                                <h3>لم يتم العثور على قوالب</h3>
                                <p>جرب البحث بكلمة مختلفة أو تحقق من الفلاتر المطبقة</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- تحميل المزيد -->
                <?php if ($themes_query->max_num_pages > 1) : ?>
                <div class="load-more-section">
                    <button id="load-more-btn" class="load-more-btn" data-page="1" data-max-pages="<?php echo $themes_query->max_num_pages; ?>">
                        <span class="btn-text">تحميل المزيد</span>
                        <div class="btn-loader">
                            <i class="fas fa-spinner fa-spin"></i>
                        </div>
                    </button>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

</main>

<!-- رسائل Toast -->
<div id="toast-container" class="toast-container"></div>

<style>
/* ================================
   أنماط الأرشيف المتكاملة
================================ */

/* إعادة تعيين أساسية */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* المتغيرات الأساسية */
:root {
    --primary-color: #3b82f6;
    --secondary-color: #8b5cf6;
    --accent-color: #10b981;
    --warning-color: #f59e0b;
    --error-color: #ef4444;
    --success-color: #22c55e;
    
    --dark-900: #0f172a;
    --dark-800: #1e293b;
    --dark-700: #334155;
    --dark-600: #475569;
    --dark-500: #64748b;
    --dark-400: #94a3b8;
    --dark-300: #cbd5e1;
    --dark-200: #e2e8f0;
    --dark-100: #f1f5f9;
    --white: #ffffff;
    
    --font-family: 'Cairo', -apple-system, BlinkMacSystemFont, sans-serif;
    --spacing-xs: 0.25rem;
    --spacing-sm: 0.5rem;
    --spacing-md: 1rem;
    --spacing-lg: 1.5rem;
    --spacing-xl: 2rem;
    --spacing-2xl: 3rem;
    --spacing-3xl: 4rem;
    
    --border-radius-sm: 0.375rem;
    --border-radius-md: 0.5rem;
    --border-radius-lg: 0.75rem;
    --border-radius-xl: 1rem;
    --border-radius-2xl: 1.5rem;
    
    --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    --shadow-2xl: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    
    --transition-fast: 0.15s ease;
    --transition-normal: 0.3s ease;
    --transition-slow: 0.5s ease;
}

/* الصفحة الأساسية */
body.archive-themes-page {
    font-family: var(--font-family);
    background: var(--dark-900);
    color: var(--white);
    min-height: 100vh;
    direction: rtl;
    overflow-x: hidden;
}

/* 🌓 تبديل المظهر */
.theme-toggle-sidebar {
    position: fixed;
    right: 30px;
    top: 50%;
    transform: translateY(-50%);
    z-index: 9999;
}

.theme-toggle-btn {
    width: 60px;
    height: 60px;
    border: none;
    border-radius: 50%;
    background: rgba(26, 26, 46, 0.9);
    border: 2px solid rgba(59, 130, 246, 0.3);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
    backdrop-filter: blur(20px);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
}

.theme-toggle-btn:hover {
    transform: scale(1.1);
    border-color: #3b82f6;
    box-shadow: 0 12px 40px rgba(59, 130, 246, 0.4);
}

.toggle-icon {
    position: relative;
    width: 24px;
    height: 24px;
}

.sun-icon,
.moon-icon {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 18px;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.sun-icon {
    color: #fbbf24;
    opacity: 1;
    transform: translate(-50%, -50%) rotate(0deg) scale(1);
}

.moon-icon {
    color: #60a5fa;
    opacity: 0;
    transform: translate(-50%, -50%) rotate(180deg) scale(0);
}

/* Dark mode */
body.dark-mode .sun-icon {
    opacity: 0;
    transform: translate(-50%, -50%) rotate(-180deg) scale(0);
}

body.dark-mode .moon-icon {
    opacity: 1;
    transform: translate(-50%, -50%) rotate(0deg) scale(1);
}

.toggle-ripple {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    background: radial-gradient(circle, rgba(59, 130, 246, 0.3) 0%, transparent 70%);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    transition: all 0.6s ease;
    pointer-events: none;
}

/* Canvas الجسيمات */
#particles-canvas {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
    pointer-events: none;
}

/* خلفية Parallax */
.parallax-background {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 2;
    pointer-events: none;
}

.parallax-layer {
    position: absolute;
    width: 120%;
    height: 120%;
    background: radial-gradient(circle, rgba(59, 130, 246, 0.1) 1px, transparent 1px);
    background-size: 50px 50px;
    opacity: 0.3;
    animation: parallaxFloat 20s ease-in-out infinite;
}

.parallax-layer:nth-child(1) { animation-delay: 0s; }
.parallax-layer:nth-child(2) { animation-delay: -7s; }
.parallax-layer:nth-child(3) { animation-delay: -14s; }

@keyframes parallaxFloat {
    0%, 100% { transform: translate(0, 0) rotate(0deg); }
    25% { transform: translate(-10px, -10px) rotate(1deg); }
    50% { transform: translate(10px, -5px) rotate(-1deg); }
    75% { transform: translate(-5px, 10px) rotate(0.5deg); }
}

/* شاشة التحميل */
.archive-loader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(15, 23, 42, 0.95);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10000;
    transition: opacity 0.5s ease;
}

.archive-loader.fade-out {
    opacity: 0;
}

.loader-content {
    text-align: center;
}

.loader-spinner {
    width: 60px;
    height: 60px;
    border: 3px solid rgba(59, 130, 246, 0.3);
    border-top: 3px solid #3b82f6;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin: 0 auto 1rem;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* المحتوى الرئيسي */
.archive-main {
    position: relative;
    z-index: 10;
    min-height: 100vh;
    padding-top: 2rem;
}

.container-fluid {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 var(--spacing-lg);
}

/* قسم البحث */
.search-section {
    padding: var(--spacing-3xl) 0 var(--spacing-xl);
    text-align: center;
}

.search-container-main {
    max-width: 800px;
    margin: 0 auto;
}

.search-box-enhanced {
    position: relative;
    background: rgba(26, 26, 46, 0.8);
    border-radius: 50px;
    padding: 4px;
    border: 2px solid rgba(59, 130, 246, 0.3);
    backdrop-filter: blur(20px);
    transition: all var(--transition-normal);
}

.search-box-enhanced:focus-within {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
}

.search-box-enhanced input {
    width: 100%;
    padding: 20px 60px;
    border: none;
    background: transparent;
    color: var(--white);
    font-size: 1.2rem;
    outline: none;
    font-family: var(--font-family);
}

.search-box-enhanced input::placeholder {
    color: rgba(255, 255, 255, 0.6);
}

.search-icon {
    position: absolute;
    right: 25px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--primary-color);
    font-size: 1.3rem;
}

.search-clear {
    position: absolute;
    left: 20px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: rgba(255, 255, 255, 0.6);
    font-size: 1.2rem;
    cursor: pointer;
    padding: 8px;
    border-radius: 50%;
    transition: all var(--transition-fast);
    opacity: 0;
    visibility: hidden;
}

.search-clear.visible {
    opacity: 1;
    visibility: visible;
}

.search-clear:hover {
    color: var(--error-color);
    background: rgba(239, 68, 68, 0.1);
}

/* قسم التحكم */
.controls-section {
    padding: var(--spacing-xl) 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.controls-wrapper {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: var(--spacing-lg);
}

/* الفلاتر السريعة */
.quick-filters {
    display: flex;
    gap: var(--spacing-sm);
    flex-wrap: wrap;
}

.filter-btn {
    display: flex;
    align-items: center;
    gap: var(--spacing-sm);
    padding: 12px 20px;
    background: rgba(26, 26, 46, 0.7);
    border: 2px solid rgba(59, 130, 246, 0.3);
    border-radius: 50px;
    color: rgba(255, 255, 255, 0.7);
    cursor: pointer;
    transition: all var(--transition-normal);
    font-weight: 600;
    backdrop-filter: blur(20px);
}

.filter-btn.active,
.filter-btn:hover {
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    color: var(--white);
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
}

/* تبديل أنماط العرض */
.view-controls {
    display: flex;
    align-items: center;
    gap: var(--spacing-lg);
}

.view-toggle {
    display: flex;
    background: rgba(26, 26, 46, 0.7);
    border-radius: 50px;
    padding: 4px;
    border: 2px solid rgba(59, 130, 246, 0.3);
    backdrop-filter: blur(20px);
}

.view-btn {
    display: flex;
    align-items: center;
    gap: var(--spacing-sm);
    padding: 12px 20px;
    background: transparent;
    border: none;
    color: rgba(255, 255, 255, 0.7);
    border-radius: 50px;
    cursor: pointer;
    transition: all var(--transition-normal);
    font-weight: 600;
}

.view-btn.active,
.view-btn:hover {
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    color: var(--white);
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.results-info {
    color: rgba(255, 255, 255, 0.7);
    font-weight: 600;
}

/* قسم القوالب */
.themes-section {
    padding: var(--spacing-3xl) 0;
}

.themes-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
    gap: var(--spacing-xl);
    margin-bottom: var(--spacing-3xl);
}

.themes-grid.list-view {
    grid-template-columns: 1fr;
    gap: var(--spacing-lg);
}

/* بطاقة القالب */
.theme-card-wrapper {
    opacity: 0;
    transform: translateY(30px);
    transition: all 0.6s ease;
}

.theme-card-wrapper.animate-in {
    opacity: 1;
    transform: translateY(0);
}

.theme-card {
    background: rgba(26, 26, 46, 0.8);
    border-radius: var(--border-radius-2xl);
    overflow: hidden;
    box-shadow: var(--shadow-lg);
    transition: all var(--transition-normal);
    border: 1px solid rgba(59, 130, 246, 0.2);
    position: relative;
    height: 100%;
    display: flex;
    flex-direction: column;
    backdrop-filter: blur(20px);
    cursor: pointer;
}

.theme-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-2xl);
    border-color: var(--primary-color);
    background: rgba(26, 26, 46, 0.9);
}

/* شارات القالب */
.theme-badges {
    position: absolute;
    top: var(--spacing-md);
    right: var(--spacing-md);
    z-index: 5;
    display: flex;
    flex-direction: column;
    gap: var(--spacing-sm);
}

.badge {
    display: flex;
    align-items: center;
    gap: var(--spacing-xs);
    padding: var(--spacing-xs) var(--spacing-sm);
    border-radius: var(--border-radius-lg);
    font-size: 0.8rem;
    font-weight: 700;
    text-transform: uppercase;
    backdrop-filter: blur(20px);
}

.badge-featured {
    background: rgba(245, 158, 11, 0.9);
    color: var(--white);
    border: 1px solid rgba(245, 158, 11, 0.3);
}

.badge-new {
    background: rgba(16, 185, 129, 0.9);
    color: var(--white);
    border: 1px solid rgba(16, 185, 129, 0.3);
}

/* معاينة القالب */
.theme-preview {
    position: relative;
    height: 240px;
    overflow: hidden;
    background: var(--dark-800);
}

.theme-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform var(--transition-slow);
}

.theme-card:hover .theme-preview img {
    transform: scale(1.05);
}

.no-image {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100%;
    color: var(--dark-400);
    font-size: 1.2rem;
    gap: var(--spacing-sm);
}

.theme-preview-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(
        45deg,
        rgba(0, 0, 0, 0.1) 0%,
        transparent 50%,
        rgba(59, 130, 246, 0.1) 100%
    );
    opacity: 0;
    transition: opacity var(--transition-normal);
}

.theme-card:hover .theme-preview-overlay {
    opacity: 1;
}

/* محتوى القالب */
.theme-content {
    padding: var(--spacing-lg);
    flex: 1;
    display: flex;
    flex-direction: column;
}

.theme-title {
    margin-bottom: var(--spacing-md);
    font-size: 1.3rem;
    font-weight: 700;
    line-height: 1.4;
}

.theme-title a {
    color: var(--white);
    text-decoration: none;
    transition: color var(--transition-fast);
}

.theme-title a:hover {
    color: var(--primary-color);
}

/* تقييم النجوم */
.theme-rating {
    margin-bottom: var(--spacing-md);
}

.rating-stars {
    display: flex;
    align-items: center;
    gap: var(--spacing-xs);
}

.rating-stars .fas,
.rating-stars .far {
    color: #fbbf24;
    font-size: 1rem;
    transition: all var(--transition-fast);
    filter: drop-shadow(0 0 3px rgba(251, 191, 36, 0.5));
}

.rating-value {
    color: var(--dark-400);
    font-size: 0.9rem;
    font-weight: 600;
    margin-right: var(--spacing-sm);
}

.no-rating {
    color: var(--dark-400);
    font-size: 0.9rem;
    font-style: italic;
}

/* بيانات القالب */
.theme-meta {
    margin-top: auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: var(--spacing-sm);
}

.theme-downloads {
    display: flex;
    align-items: center;
    gap: var(--spacing-sm);
    color: var(--accent-color);
    font-weight: 600;
    font-size: 0.9rem;
}

.theme-categories {
    display: flex;
    gap: var(--spacing-xs);
    flex-wrap: wrap;
}

.category-tag {
    padding: var(--spacing-xs) var(--spacing-sm);
    background: rgba(59, 130, 246, 0.2);
    color: var(--primary-color);
    border-radius: var(--border-radius-sm);
    font-size: 0.8rem;
    font-weight: 600;
    border: 1px solid rgba(59, 130, 246, 0.3);
}

/* عرض القائمة */
.themes-grid.list-view .theme-card {
    flex-direction: row;
    height: auto;
}

.themes-grid.list-view .theme-preview {
    width: 300px;
    height: 200px;
    flex-shrink: 0;
}

.themes-grid.list-view .theme-content {
    flex: 1;
}

/* تحميل المزيد */
.load-more-section {
    text-align: center;
    padding: var(--spacing-2xl) 0;
}

.load-more-btn {
    display: inline-flex;
    align-items: center;
    gap: var(--spacing-sm);
    padding: 18px 40px;
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    border: none;
    border-radius: 50px;
    color: var(--white);
    font-size: 1.1rem;
    font-weight: 700;
    cursor: pointer;
    transition: all var(--transition-normal);
    position: relative;
    overflow: hidden;
}

.load-more-btn:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-xl);
}

.load-more-btn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
}

.load-more-btn .btn-loader {
    display: none;
}

.load-more-btn.loading .btn-text {
    display: none;
}

.load-more-btn.loading .btn-loader {
    display: block;
}

/* رسائل خاصة */
.no-themes {
    grid-column: 1 / -1;
    text-align: center;
    padding: var(--spacing-3xl);
}

.no-themes-content {
    background: rgba(26, 26, 46, 0.5);
    padding: var(--spacing-3xl);
    border-radius: var(--border-radius-2xl);
    border: 2px dashed rgba(59, 130, 246, 0.3);
}

.no-themes-content i {
    font-size: 4rem;
    color: var(--dark-400);
    margin-bottom: var(--spacing-lg);
}

.no-themes-content h3 {
    font-size: 1.5rem;
    margin-bottom: var(--spacing-md);
    color: var(--dark-300);
}

.no-themes-content p {
    color: var(--dark-400);
    font-size: 1.1rem;
}

/* رسائل Toast */
.toast-container {
    position: fixed;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 10001;
}

.toast {
    background: rgba(26, 26, 46, 0.95);
    color: var(--white);
    padding: var(--spacing-md) var(--spacing-lg);
    border-radius: var(--border-radius-lg);
    margin-bottom: var(--spacing-sm);
    border: 1px solid rgba(59, 130, 246, 0.3);
    backdrop-filter: blur(20px);
    animation: toastSlideIn 0.3s ease;
}

.toast.success {
    border-color: var(--success-color);
    background: rgba(34, 197, 94, 0.1);
}

.toast.error {
    border-color: var(--error-color);
    background: rgba(239, 68, 68, 0.1);
}

@keyframes toastSlideIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Dark Mode Styles */
body.dark-mode {
    background: #000000;
}

body.dark-mode .theme-card {
    background: rgba(10, 10, 20, 0.9);
    border-color: rgba(139, 92, 246, 0.3);
}

body.dark-mode .search-box-enhanced {
    background: rgba(10, 10, 20, 0.8);
    border-color: rgba(139, 92, 246, 0.4);
}

/* Light Mode Styles */
body.light-mode {
    background: #f8fafc;
    color: #1e293b;
}

body.light-mode .archive-main {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
}

body.light-mode .theme-card {
    background: rgba(255, 255, 255, 0.95);
    border-color: rgba(59, 130, 246, 0.2);
    color: #1e293b;
}

body.light-mode .theme-title a {
    color: #1e293b;
}

body.light-mode .search-box-enhanced {
    background: rgba(255, 255, 255, 0.9);
    border-color: rgba(59, 130, 246, 0.3);
}

body.light-mode .search-box-enhanced input {
    color: #1e293b;
}

body.light-mode .search-box-enhanced input::placeholder {
    color: rgba(30, 41, 59, 0.6);
}

body.light-mode .filter-btn,
body.light-mode .view-btn {
    background: rgba(255, 255, 255, 0.8);
    color: #1e293b;
    border-color: rgba(59, 130, 246, 0.3);
}

body.light-mode .no-themes-content {
    background: rgba(255, 255, 255, 0.8);
    color: #1e293b;
}

body.light-mode .parallax-layer {
    background: radial-gradient(circle, rgba(59, 130, 246, 0.05) 1px, transparent 1px);
}

/* التصميم المتجاوب */
@media (max-width: 1024px) {
    .themes-grid {
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: var(--spacing-lg);
    }
    
    .controls-wrapper {
        flex-direction: column;
        align-items: stretch;
    }
    
    .quick-filters {
        justify-content: center;
    }
    
    .view-controls {
        justify-content: center;
    }
}

@media (max-width: 768px) {
    .container-fluid {
        padding: 0 var(--spacing-md);
    }
    
    .themes-grid {
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: var(--spacing-md);
    }
    
    .themes-grid.list-view .theme-card {
        flex-direction: column;
    }
    
    .themes-grid.list-view .theme-preview {
        width: 100%;
        height: 200px;
    }
    
    .search-box-enhanced input {
        padding: 16px 50px;
        font-size: 1rem;
    }
    
    .theme-toggle-sidebar {
        right: 15px;
    }
    
    .theme-toggle-btn {
        width: 50px;
        height: 50px;
    }
    
    .quick-filters {
        justify-content: flex-start;
        overflow-x: auto;
        padding-bottom: var(--spacing-sm);
    }
    
    .filter-btn {
        white-space: nowrap;
        flex-shrink: 0;
    }
}

@media (max-width: 480px) {
    .themes-grid {
        grid-template-columns: 1fr;
        gap: var(--spacing-md);
    }
    
    .search-box-enhanced input {
        padding: 14px 45px;
        font-size: 0.9rem;
    }
    
    .theme-toggle-btn {
        width: 45px;
        height: 45px;
    }
    
    .toggle-icon {
        width: 20px;
        height: 20px;
    }
    
    .sun-icon,
    .moon-icon {
        font-size: 16px;
    }
}

/* تحسينات الأداء */
.theme-card,
.filter-btn,
.view-btn,
.load-more-btn {
    will-change: transform, box-shadow;
}

/* تأثيرات خاصة للمس */
@media (hover: none) {
    .theme-card:hover {
        transform: translateY(-4px);
    }
    
    .filter-btn:hover,
    .view-btn:hover {
        transform: translateY(-1px);
    }
}
</style>

<script>
// 🎬 JavaScript متكامل للأرشيف
document.addEventListener('DOMContentLoaded', function() {
    console.log('🎬 أرشيف القوالب العربية جاهز!');
    
    // إخفاء شاشة التحميل
    setTimeout(() => {
        const loader = document.getElementById('archive-loader');
        if (loader) {
            loader.classList.add('fade-out');
            setTimeout(() => loader.remove(), 500);
        }
    }, 1000);
    
    // تهيئة جميع الأنظمة
    initParticles();
    initThemeToggle();
    initSearch();
    initFilters();
    initViewToggle();
    initLoadMore();
    initThemeCards();
    initAnimations();
    updateResultsCount();
});

// 🌓 نظام تبديل المظهر
function initThemeToggle() {
    const themeToggle = document.getElementById('theme-toggle');
    if (!themeToggle) return;
    
    // قراءة المظهر المحفوظ
    const savedTheme = localStorage.getItem('theme') || 'dark';
    applyTheme(savedTheme);
    
    // معالج النقر
    themeToggle.addEventListener('click', function() {
        const currentTheme = document.body.classList.contains('dark-mode') ? 'dark' : 'light';
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        
        // تأثير انتقالي سلس
        document.body.style.transition = 'all 0.5s cubic-bezier(0.4, 0, 0.2, 1)';
        
        applyTheme(newTheme);
        localStorage.setItem('theme', newTheme);
        
        // تأثير ريبل للزر
        const ripple = this.querySelector('.toggle-ripple');
        ripple.style.width = '120px';
        ripple.style.height = '120px';
        
        setTimeout(() => {
            ripple.style.width = '0';
            ripple.style.height = '0';
        }, 600);
        
        // إزالة التأثير الانتقالي
        setTimeout(() => {
            document.body.style.transition = '';
        }, 500);
    });
    
    function applyTheme(theme) {
        document.body.classList.remove('dark-mode', 'light-mode');
        document.body.classList.add(theme + '-mode');
        
        // تحديث meta theme-color
        let metaThemeColor = document.querySelector('meta[name="theme-color"]');
        if (!metaThemeColor) {
            metaThemeColor = document.createElement('meta');
            metaThemeColor.name = 'theme-color';
            document.head.appendChild(metaThemeColor);
        }
        metaThemeColor.content = theme === 'dark' ? '#0f172a' : '#f8fafc';
    }
}

// 🔍 نظام البحث
function initSearch() {
    const searchInput = document.getElementById('theme-search');
    const searchClear = document.getElementById('search-clear');
    
    if (!searchInput) return;
    
    let searchTimeout;
    
    // البحث الفوري
    searchInput.addEventListener('input', function() {
        const query = this.value.trim();
        
        // إظهار/إخفاء زر المسح
        if (query) {
            searchClear.classList.add('visible');
        } else {
            searchClear.classList.remove('visible');
        }
        
        // البحث مع تأخير
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            performSearch(query);
        }, 300);
    });
    
    // مسح البحث
    if (searchClear) {
        searchClear.addEventListener('click', function() {
            searchInput.value = '';
            searchInput.focus();
            this.classList.remove('visible');
            performSearch('');
        });
    }
    
    // البحث باستخدام Enter
    searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            clearTimeout(searchTimeout);
            performSearch(this.value.trim());
        }
    });
}

// تنفيذ البحث
function performSearch(query) {
    const cards = document.querySelectorAll('.theme-card-wrapper');
    let visibleCount = 0;
    
    cards.forEach(card => {
        const title = card.dataset.title.toLowerCase();
        const categories = card.dataset.categories.toLowerCase();
        const searchTerm = query.toLowerCase();
        
        if (!query || title.includes(searchTerm) || categories.includes(searchTerm)) {
            card.style.display = 'block';
            visibleCount++;
        } else {
            card.style.display = 'none';
        }
    });
    
    updateResultsCount(visibleCount);
    showSearchResults(query, visibleCount);
}

// 🔗 نظام الفلاتر
function initFilters() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // إزالة الحالة النشطة من جميع الأزرار
            filterBtns.forEach(b => b.classList.remove('active'));
            
            // تفعيل الزر المحدد
            this.classList.add('active');
            
            // تطبيق الفلتر
            const filter = this.dataset.filter;
            applyFilter(filter);
        });
    });
}

// تطبيق الفلتر
function applyFilter(filter) {
    const cards = document.querySelectorAll('.theme-card-wrapper');
    let visibleCount = 0;
    
    cards.forEach(card => {
        let shouldShow = false;
        
        switch (filter) {
            case 'all':
                shouldShow = true;
                break;
            case 'featured':
                shouldShow = card.dataset.featured === 'true';
                break;
            case 'new':
                shouldShow = card.dataset.type === 'new';
                break;
            case 'popular':
                shouldShow = card.dataset.type === 'popular';
                break;
        }
        
        if (shouldShow) {
            card.style.display = 'block';
            visibleCount++;
        } else {
            card.style.display = 'none';
        }
    });
    
    updateResultsCount(visibleCount);
    
    // إضافة تأثير
    showNotification(`تم تطبيق فلتر: ${getFilterName(filter)} (${visibleCount} قالب)`, 'success');
}

function getFilterName(filter) {
    const names = {
        'all': 'جميع القوالب',
        'featured': 'القوالب المميزة',
        'new': 'القوالب الجديدة',
        'popular': 'القوالب الشائعة'
    };
    return names[filter] || filter;
}

// 👁️ نظام تبديل العرض
function initViewToggle() {
    const viewBtns = document.querySelectorAll('.view-btn');
    const themesGrid = document.getElementById('themes-grid');
    
    viewBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // إزالة الحالة النشطة
            viewBtns.forEach(b => b.classList.remove('active'));
            
            // تفعيل الزر المحدد
            this.classList.add('active');
            
            // تطبيق طريقة العرض
            const view = this.dataset.view;
            applyView(view);
        });
    });
}

// تطبيق طريقة العرض
function applyView(view) {
    const themesGrid = document.getElementById('themes-grid');
    
    if (view === 'list') {
        themesGrid.classList.add('list-view');
    } else {
        themesGrid.classList.remove('list-view');
    }
    
    // إعادة تطبيق الحركات
    setTimeout(() => {
        initAnimations();
    }, 100);
}

// 📄 تحميل المزيد
function initLoadMore() {
    const loadMoreBtn = document.getElementById('load-more-btn');
    
    if (!loadMoreBtn) return;
    
    loadMoreBtn.addEventListener('click', function() {
        if (this.classList.contains('loading')) return;
        
        const currentPage = parseInt(this.dataset.page);
        const maxPages = parseInt(this.dataset.maxPages);
        const nextPage = currentPage + 1;
        
        if (nextPage > maxPages) {
            this.style.display = 'none';
            return;
        }
        
        // إظهار حالة التحميل
        this.classList.add('loading');
        
        // محاكاة AJAX
        loadMoreThemes(nextPage).then(success => {
            this.classList.remove('loading');
            
            if (success) {
                this.dataset.page = nextPage;
                
                if (nextPage >= maxPages) {
                    this.style.display = 'none';
                    showNotification('تم تحميل جميع القوالب', 'success');
                }
            } else {
                showNotification('حدث خطأ في التحميل', 'error');
            }
        });
    });
}

// تحميل قوالب إضافية
function loadMoreThemes(page) {
    return new Promise((resolve) => {
        // محاكاة طلب AJAX
        if (typeof jQuery !== 'undefined' && typeof ArchiveData !== 'undefined') {
            jQuery.ajax({
                url: ArchiveData.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'load_more_themes',
                    page: page,
                    nonce: ArchiveData.nonce
                },
                success: function(response) {
                    if (response.success && response.data.html) {
                        const themesGrid = document.getElementById('themes-grid');
                        const loadMoreSection = document.querySelector('.load-more-section');
                        
                        // إضافة القوالب الجديدة
                        loadMoreSection.insertAdjacentHTML('beforebegin', response.data.html);
                        
                        // إعادة تهيئة الحركات
                        initAnimations();
                        initThemeCards();
                        
                        resolve(true);
                    } else {
                        resolve(false);
                    }
                },
                error: function() {
                    resolve(false);
                }
            });
        } else {
            // محاكاة بسيطة
            setTimeout(() => {
                resolve(Math.random() > 0.2); // نجاح 80%
            }, 1000);
        }
    });
}

// 🎨 بطاقات القوالب التفاعلية
function initThemeCards() {
    const cards = document.querySelectorAll('.theme-card');
    
    cards.forEach(card => {
        // إزالة معالجات الأحداث السابقة
        card.replaceWith(card.cloneNode(true));
    });
    
    // إعادة الحصول على البطاقات بعد النسخ
    const newCards = document.querySelectorAll('.theme-card');
    
    newCards.forEach(card => {
        // النقر للانتقال للصفحة
        card.addEventListener('click', function(e) {
            // تجاهل النقر على الروابط
            if (e.target.tagName === 'A' || e.target.closest('a')) {
                return;
            }
            
            const link = this.querySelector('.theme-title a');
            if (link) {
                // تأثير انتقالي
                this.style.transform = 'scale(0.95)';
                this.style.opacity = '0.8';
                
                setTimeout(() => {
                    window.location.href = link.href;
                }, 200);
            }
        });
        
        // تأثيرات الماوس
        card.addEventListener('mouseenter', function() {
            this.style.zIndex = '10';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.zIndex = '';
        });
    });
}

// ✨ نظام الحركات
function initAnimations() {
    const cards = document.querySelectorAll('.theme-card-wrapper');
    
    // مراقب التقاطع للحركات
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.classList.add('animate-in');
                }, index * 100);
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '50px'
    });
    
    cards.forEach(card => {
        card.classList.remove('animate-in');
        observer.observe(card);
    });
}

// ⭐ نظام الجسيمات
function initParticles() {
    const canvas = document.getElementById('particles-canvas');
    if (!canvas) return;
    
    const ctx = canvas.getContext('2d');
    let particles = [];
    let animationId;
    
    // تحديد حجم Canvas
    function resizeCanvas() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
    }
    
    resizeCanvas();
    window.addEventListener('resize', resizeCanvas);
    
    // فئة الجسيم
    class Particle {
        constructor() {
            this.reset();
        }
        
        reset() {
            this.x = Math.random() * canvas.width;
            this.y = Math.random() * canvas.height;
            this.size = Math.random() * 3 + 1;
            this.speedX = (Math.random() - 0.5) * 0.8;
            this.speedY = (Math.random() - 0.5) * 0.8;
            this.color = this.getRandomColor();
            this.opacity = Math.random() * 0.5 + 0.2;
            this.pulse = Math.random() * 0.02 + 0.01;
        }
        
        getRandomColor() {
            const isDark = document.body.classList.contains('dark-mode');
            if (isDark) {
                const colors = ['#3b82f6', '#8b5cf6', '#ec4899', '#f59e0b'];
                return colors[Math.floor(Math.random() * colors.length)];
            } else {
                const colors = ['#3b82f6', '#8b5cf6', '#ec4899', '#10b981'];
                return colors[Math.floor(Math.random() * colors.length)];
            }
        }
        
        update() {
            this.x += this.speedX;
            this.y += this.speedY;
            
            // إعادة تدوير
            if (this.x > canvas.width) this.x = 0;
            if (this.x < 0) this.x = canvas.width;
            if (this.y > canvas.height) this.y = 0;
            if (this.y < 0) this.y = canvas.height;
            
            // نبض
            this.opacity += this.pulse;
            if (this.opacity > 0.7 || this.opacity < 0.1) {
                this.pulse *= -1;
            }
        }
        
        draw() {
            ctx.save();
            ctx.globalAlpha = this.opacity;
            ctx.fillStyle = this.color;
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.size, 0, Math.PI * 

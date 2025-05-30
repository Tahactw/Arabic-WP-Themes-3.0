<?php
/**
 * صفحة أرشيف القوالب المدمجة - قوالب عربية ووردبريس
 * تدمج جميع ملفات الأرشيف في ملف واحد متكامل
 * 
 * @package ArabicThemes
 * @author Tahactw
 * @date 2025-05-30
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

//get_header(); ?>

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


<!-- زر العودة للصفحة الرئيسية -->
<div class="home-button-sidebar">
    <button id="home-button" class="home-btn" title="العودة للصفحة الرئيسية" onclick="window.location.href='<?php echo home_url(); ?>'">
        <div class="home-icon">
            <i class="fas fa-home"></i>
        </div>
        <div class="home-ripple"></div>
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

<!-- البوابة السينمائية -->
<div id="cinematic-portal" class="cinematic-portal">
    <div class="portal-background"></div>
    <div class="portal-wave"></div>
    <div class="floating-elements">
        <!-- عناصر متحركة -->
        <div class="floating-icon" data-icon="🎨"></div>
        <div class="floating-icon" data-icon="📱"></div>
        <div class="floating-icon" data-icon="💻"></div>
        <div class="floating-icon" data-icon="🚀"></div>
        <div class="floating-icon" data-icon="⭐"></div>
        <div class="floating-icon" data-icon="🎯"></div>
        
        <!-- حروف عربية -->
        <div class="floating-letter">ق</div>
        <div class="floating-letter">و</div>
        <div class="floating-letter">ا</div>
        <div class="floating-letter">ل</div>
        <div class="floating-letter">ب</div>
    </div>
    <div class="portal-center">
        <div class="portal-rings">
            <div class="ring ring-1"></div>
            <div class="ring ring-2"></div>
            <div class="ring ring-3"></div>
            <div class="ring ring-4"></div>
        </div>
        <div class="portal-core">
            <i class="fas fa-rocket"></i>
        </div>
    </div>
</div>

<!-- المحتوى الرئيسي -->
<main class="archive-main" id="archive-main">
    
    <!-- البحث الرئيسي -->
    <section class="main-search-section">
        <div class="container-fluid">
            <div class="search-wrapper">
                <div class="search-container">
                    <div class="search-box">
                        <i class="fas fa-search search-icon"></i>
                        <input 
                            type="text" 
                            id="theme-search" 
                            placeholder="ابحث في مكتبة القوالب..." 
                            autocomplete="off"
                            data-search="themes"
                        >
                        <button type="button" class="search-clear" id="search-clear">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="search-suggestions" id="search-suggestions"></div>
                </div>
                
                <!-- فلاتر متقدمة -->
                <div class="filters-row">
                    
                    <!-- فلتر التصنيفات -->
                    <div class="filter-group">
                        <label for="category-filter" class="filter-label">
                            <i class="fas fa-tags"></i>
                            التصنيف
                        </label>
                        <select id="category-filter" class="filter-select">
                            <option value="">جميع التصنيفات</option>
                            <?php
                            $categories = get_terms([
                                'taxonomy' => 'theme_category',
                                'hide_empty' => true,
                                'orderby' => 'count',
                                'order' => 'DESC'
                            ]);
                            
                            if (!is_wp_error($categories) && !empty($categories)) :
                                foreach ($categories as $category) :
                            ?>
                                <option value="<?php echo esc_attr($category->slug); ?>">
                                    <?php echo esc_html($category->name); ?> 
                                    (<?php echo $category->count; ?>)
                                </option>
                            <?php 
                                endforeach;
                            endif;
                            ?>
                        </select>
                    </div>

                    <!-- فلتر الترتيب -->
                    <div class="filter-group">
                        <label for="sort-filter" class="filter-label">
                            <i class="fas fa-sort"></i>
                            الترتيب
                        </label>
                        <select id="sort-filter" class="filter-select">
                            <option value="date-desc">الأحدث أولاً</option>
                            <option value="date-asc">الأقدم أولاً</option>
                            <option value="title-asc">الاسم (أ-ي)</option>
                            <option value="title-desc">الاسم (ي-أ)</option>
                            <option value="downloads-desc">الأكثر تحميلاً</option>
                            <option value="rating-desc">الأعلى تقييماً</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
                            
                            // الحصول على بيانات القالب
                            $theme_id = get_the_ID();
                            $download_count = get_post_meta($theme_id, '_download_count', true) ?: 0;
                            $theme_rating = get_post_meta($theme_id, '_theme_rating', true) ?: 0;
                            $is_featured = get_post_meta($theme_id, '_is_featured', true);
                            
                            // حساب التقييم من التقييمات الفعلية
                            if (function_exists('arabic_themes_calculate_average_rating')) {
                                $theme_rating = arabic_themes_calculate_average_rating($theme_id);
                            }
                            
                            // الحصول على التصنيفات
                            $categories = get_the_terms($theme_id, 'theme_category');
                            $category_names = $categories ? wp_list_pluck($categories, 'name') : [];
                            $category_slugs = $categories ? wp_list_pluck($categories, 'slug') : [];
                            
                            ?>
                            <div class="theme-card-wrapper" 
                                 data-theme-id="<?php echo $theme_id; ?>"
                                 data-title="<?php echo esc_attr(get_the_title()); ?>"
                                 data-categories="<?php echo esc_attr(implode(',', $category_slugs)); ?>"
                                 data-date="<?php echo get_the_date('c'); ?>"
                                 data-downloads="<?php echo $download_count; ?>"
                                 data-rating="<?php echo $theme_rating; ?>"
                                 data-featured="<?php echo $is_featured ? 'true' : 'false'; ?>">
                                 
                                <article class="theme-card" onclick="window.location.href='<?php echo get_permalink(); ?>'">
                                    
                                    <!-- شارات القالب -->
                                    <div class="theme-badges">
                                        <?php if ($is_featured) : ?>
                                            <span class="badge badge-featured">
                                                <i class="fas fa-star"></i>
                                                مميز
                                            </span>
                                        <?php endif; ?>
                                        
                                        <?php
                                        $days_since_publish = floor((time() - get_the_time('U')) / (60 * 60 * 24));
                                        if ($days_since_publish <= 7) :
                                        ?>
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
                                                 alt="<?php echo esc_attr(get_the_title()); ?>"
                                                 loading="lazy">
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
                                                        $full_stars = floor($theme_rating);
                                                        $has_half = ($theme_rating - $full_stars) >= 0.5;
                                                        
                                                        for ($i = 1; $i <= 5; $i++) {
                                                            if ($i <= $full_stars) {
                                                                echo '<i class="fas fa-star"></i>';
                                                            } elseif ($i == $full_stars + 1 && $has_half) {
                                                                echo '<i class="fas fa-star-half-alt"></i>';
                                                            } else {
                                                                echo '<i class="far fa-star"></i>';
                                                            }
                                                        }
                                                    }
                                                    echo '<span class="rating-value">(' . number_format($theme_rating, 1) . ')</span>';
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
                                                <?php if (!empty($category_names)) : ?>
                                                    <span class="category-tag"><?php echo esc_html($category_names[0]); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                        echo '<div class="no-themes">لم يتم العثور على قوالب</div>';
                    endif;
                    ?>
                </div>
        
            </div>
        </div>
    </section>

</main>

<!-- رسائل Toast -->
<div id="toast-container" class="toast-container"></div>

<style>
/* ========================
   الأساسيات والمتغيرات
======================== */
:root {
    /* الألوان الأساسية */
    --primary-color: #3b82f6;
    --secondary-color: #8b5cf6;
    --accent-color: #10b981;
    --warning-color: #f59e0b;
    --error-color: #ef4444;
    --success-color: #22c55e;
    
    /* الألوان المحايدة */
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
    
    /* التدرجات */
    --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --gradient-secondary: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    --gradient-accent: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    --gradient-dark: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
    
    /* الخطوط */
    --font-family: 'Cairo', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    --font-size-xs: 0.75rem;
    --font-size-sm: 0.875rem;
    --font-size-base: 1rem;
    --font-size-lg: 1.125rem;
    --font-size-xl: 1.25rem;
    --font-size-2xl: 1.5rem;
    --font-size-3xl: 1.875rem;
    --font-size-4xl: 2.25rem;
    --font-size-5xl: 3rem;
    
    /* المسافات */
    --spacing-xs: 0.25rem;
    --spacing-sm: 0.5rem;
    --spacing-md: 1rem;
    --spacing-lg: 1.5rem;
    --spacing-xl: 2rem;
    --spacing-2xl: 3rem;
    --spacing-3xl: 4rem;
    
    /* الحدود والزوايا */
    --border-radius-sm: 0.375rem;
    --border-radius-md: 0.5rem;
    --border-radius-lg: 0.75rem;
    --border-radius-xl: 1rem;
    --border-radius-2xl: 1.5rem;
    --border-radius-full: 9999px;
    
    /* الظلال */
    --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
    --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.07);
    --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1);
    --shadow-xl: 0 20px 25px rgba(0, 0, 0, 0.1);
    --shadow-2xl: 0 25px 50px rgba(0, 0, 0, 0.25);
    
    /* الانتقالات */
    --transition-fast: 0.15s ease;
    --transition-normal: 0.3s ease;
    --transition-slow: 0.5s ease;
}

/* إعادة تعيين وإيقاف التمرير */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

html, body {
    font-family: var(--font-family);
    background: #000011;
    color: #ffffff;
    overflow-x: hidden;
}

/* الصفحة المحتوى */
.archive-themes-page {
    min-height: 100vh;
    background: linear-gradient(135deg, #000011 0%, #1a1a2e 50%, #16213e 100%);
    position: relative;
}

/* أيقونة Dark/Light Mode */
/* أيقونة Dark/Light Mode - محدثة ومحسنة */
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

.theme-toggle-btn:active {
    transform: scale(0.95);
}

.toggle-icon {
    position: relative;
    width: 24px;
    height: 24px;
    transition: all 0.3s ease;
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



/* زر العودة للصفحة الرئيسية */
.home-button-sidebar {
    position: fixed;
    left: 30px;
    top: 50%;
    transform: translateY(-50%);
    z-index: 9999;
}

.home-btn {
    width: 60px;
    height: 60px;
    border: none;
    border-radius: 50%;
    background: rgba(26, 26, 46, 0.9);
    border: 2px solid rgba(16, 185, 129, 0.3);
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

.home-btn:hover {
    transform: scale(1.1);
    border-color: #10b981;
    box-shadow: 0 12px 40px rgba(16, 185, 129, 0.4);
}

.home-btn:active {
    transform: scale(0.95);
}

.home-icon {
    position: relative;
    width: 24px;
    height: 24px;
    transition: all 0.3s ease;
}

.home-icon i {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 18px;
    color: #10b981;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.home-btn:hover .home-icon i {
    color: #ffffff;
    transform: translate(-50%, -50%) scale(1.1);
    filter: drop-shadow(0 0 8px rgba(16, 185, 129, 0.6));
}

.home-ripple {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    background: radial-gradient(circle, rgba(16, 185, 129, 0.3) 0%, transparent 70%);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    transition: all 0.6s ease;
    pointer-events: none;
}

.home-btn:active .home-ripple {
    width: 120px;
    height: 120px;
}

/* Dark mode للزر الرئيسي */
body.dark-mode .home-btn {
    background: rgba(15, 23, 42, 0.9);
    border-color: rgba(16, 185, 129, 0.4);
}

body.light-mode .home-btn {
    background: rgba(255, 255, 255, 0.9);
    border-color: rgba(16, 185, 129, 0.5);
    box-shadow: 0 8px 32px rgba(16, 185, 129, 0.2);
}

body.light-mode .home-btn:hover {
    box-shadow: 0 12px 40px rgba(16, 185, 129, 0.3);
}

/* تأثيرات إضافية للزر */
.home-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    border-radius: 50%;
    background: linear-gradient(45deg, transparent, rgba(16, 185, 129, 0.1), transparent);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.home-btn:hover::before {
    opacity: 1;
    animation: shimmer 1.5s ease-in-out infinite;
}

@keyframes shimmer {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* تحسينات للهواتف المحمولة */
@media (max-width: 768px) {
    .home-button-sidebar {
        left: 15px;
        top: calc(50% + 80px); /* تحت زر تغيير المظهر */
    }
    
    .home-btn {
        width: 50px;
        height: 50px;
    }
    
    .home-icon i {
        font-size: 16px;
    }
}

@media (max-width: 480px) {
    .home-button-sidebar {
        left: 10px;
        top: calc(50% + 70px);
    }
    
    .home-btn {
        width: 45px;
        height: 45px;
    }
    
    .home-icon i {
        font-size: 14px;
    }
}

/* تأثيرات خاصة للمس */
@media (hover: none) {
    .home-btn:hover {
        transform: scale(1.05);
    }
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

/* البوابة السينمائية */
.cinematic-portal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 17, 0.95);
    display: none;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    z-index: 10000;
    backdrop-filter: blur(0px);
    transition: backdrop-filter 2s ease;
}

.cinematic-portal.active {
    display: flex;
    backdrop-filter: blur(20px);
}

.portal-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: radial-gradient(circle at center, rgba(59, 130, 246, 0.1) 0%, transparent 70%);
    animation: portalPulse 4s ease-in-out infinite;
}

.portal-wave {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 300px;
    height: 300px;
    border: 2px solid rgba(59, 130, 246, 0.3);
    border-radius: 50%;
    animation: portalExpand 3s ease-out infinite;
}

.floating-elements {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
}

.floating-icon,
.floating-letter {
    position: absolute;
    font-size: 2rem;
    color: rgba(59, 130, 246, 0.6);
    animation: floatAround 15s linear infinite;
}

.floating-icon:nth-child(1) { left: 10%; top: 20%; animation-delay: 0s; }
.floating-icon:nth-child(2) { left: 80%; top: 10%; animation-delay: -2s; }
.floating-icon:nth-child(3) { left: 90%; top: 70%; animation-delay: -4s; }
.floating-icon:nth-child(4) { left: 20%; top: 80%; animation-delay: -6s; }
.floating-icon:nth-child(5) { left: 60%; top: 15%; animation-delay: -8s; }
.floating-icon:nth-child(6) { left: 15%; top: 60%; animation-delay: -10s; }

.floating-letter:nth-child(7) { left: 30%; top: 30%; animation-delay: -1s; }
.floating-letter:nth-child(8) { left: 70%; top: 40%; animation-delay: -3s; }
.floating-letter:nth-child(9) { left: 50%; top: 80%; animation-delay: -5s; }
.floating-letter:nth-child(10) { left: 25%; top: 15%; animation-delay: -7s; }
.floating-letter:nth-child(11) { left: 85%; top: 55%; animation-delay: -9s; }

.portal-center {
    position: relative;
    z-index: 2;
}

.portal-rings {
    position: relative;
    width: 200px;
    height: 200px;
    margin: 0 auto;
}

.ring {
    position: absolute;
    border: 2px solid rgba(59, 130, 246, 0.4);
    border-radius: 50%;
    animation: ringRotate 8s linear infinite;
}

.ring-1 { width: 50px; height: 50px; top: 75px; left: 75px; }
.ring-2 { width: 100px; height: 100px; top: 50px; left: 50px; animation-direction: reverse; }
.ring-3 { width: 150px; height: 150px; top: 25px; left: 25px; }
.ring-4 { width: 200px; height: 200px; top: 0; left: 0; animation-direction: reverse; }

.portal-core {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 60px;
    height: 60px;
    background: linear-gradient(45deg, #3b82f6, #8b5cf6);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 24px;
    animation: coreGlow 2s ease-in-out infinite alternate;
    box-shadow: 0 0 30px rgba(59, 130, 246, 0.6);
}

@keyframes portalPulse {
    0%, 100% { opacity: 0.5; }
    50% { opacity: 1; }
}

@keyframes portalExpand {
    0% { width: 0; height: 0; opacity: 1; }
    100% { width: 600px; height: 600px; opacity: 0; }
}

@keyframes floatAround {
    0% { transform: translate(0, 0) rotate(0deg); }
    25% { transform: translate(50px, -30px) rotate(90deg); }
    50% { transform: translate(0, -60px) rotate(180deg); }
    75% { transform: translate(-50px, -30px) rotate(270deg); }
    100% { transform: translate(0, 0) rotate(360deg); }
}

@keyframes ringRotate {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

@keyframes coreGlow {
    0% { box-shadow: 0 0 20px rgba(59, 130, 246, 0.4); }
    100% { box-shadow: 0 0 40px rgba(59, 130, 246, 0.8); }
}

/* المحتوى الرئيسي */
.archive-main {
    position: relative;
    z-index: 10;
    padding: 2rem 0;
}

.container-fluid {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 2rem;
}

/* قسم البحث الرئيسي */
.main-search-section {
    padding: var(--spacing-3xl) 0;
    background: rgba(26, 26, 46, 0.3);
    backdrop-filter: blur(20px);
    border-bottom: 1px solid rgba(59, 130, 246, 0.2);
    margin-bottom: var(--spacing-3xl);
}

.search-wrapper {
    max-width: 800px;
    margin: 0 auto;
    text-align: center;
}

.search-container {
    position: relative;
    margin-bottom: var(--spacing-xl);
}

.search-box {
    position: relative;
    background: rgba(26, 26, 46, 0.8);
    border: 2px solid rgba(59, 130, 246, 0.3);
    border-radius: var(--border-radius-2xl);
    padding: 1.5rem 3rem 1.5rem 3.5rem;
    backdrop-filter: blur(20px);
    transition: all var(--transition-normal);
}

.search-box:hover {
    border-color: var(--primary-color);
    box-shadow: 0 0 30px rgba(59, 130, 246, 0.2);
}

.search-icon {
    position: absolute;
    left: 1.5rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--primary-color);
    font-size: 1.2rem;
}

#theme-search {
    width: 100%;
    background: transparent;
    border: none;
    outline: none;
    color: var(--white);
    font-size: var(--font-size-lg);
    font-weight: 500;
    placeholder-color: var(--dark-400);
}

#theme-search::placeholder {
    color: var(--dark-400);
}

.search-clear {
    position: absolute;
    right: 1.5rem;
    top: 50%;
    transform: translateY(-50%);
    background: transparent;
    border: none;
    color: var(--dark-400);
    cursor: pointer;
    font-size: 1.2rem;
    opacity: 0;
    transition: all var(--transition-normal);
}

.search-clear.show {
    opacity: 1;
}

.search-suggestions {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: rgba(26, 26, 46, 0.95);
    border: 1px solid rgba(59, 130, 246, 0.3);
    border-radius: var(--border-radius-lg);
    backdrop-filter: blur(20px);
    margin-top: 0.5rem;
    max-height: 200px;
    overflow-y: auto;
    display: none;
    z-index: 100;
}

.search-suggestions.show {
    display: block;
}

.suggestion-item {
    padding: 0.75rem 1rem;
    cursor: pointer;
    transition: background-color var(--transition-fast);
    border-bottom: 1px solid rgba(59, 130, 246, 0.1);
}

.suggestion-item:last-child {
    border-bottom: none;
}

.suggestion-item:hover {
    background: rgba(59, 130, 246, 0.1);
}

.filters-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: var(--spacing-lg);
    margin-top: var(--spacing-xl);
}

.filter-group {
    position: relative;
}

.filter-label {
    display: flex;
    align-items: center;
    gap: var(--spacing-sm);
    margin-bottom: var(--spacing-sm);
    color: var(--dark-300);
    font-weight: 600;
    font-size: var(--font-size-sm);
}

.filter-select {
    width: 100%;
    background: rgba(26, 26, 46, 0.8);
    border: 2px solid rgba(59, 130, 246, 0.3);
    border-radius: var(--border-radius-lg);
    padding: 1rem 1.5rem;
    color: var(--white);
    font-size: var(--font-size-base);
    backdrop-filter: blur(20px);
    transition: all var(--transition-normal);
    cursor: pointer;
}

.filter-select:hover,
.filter-select:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 20px rgba(59, 130, 246, 0.2);
}

.filter-select option {
    background: var(--dark-800);
    color: var(--white);
    padding: 0.5rem;
}

/* قسم عرض القوالب */
.themes-section {
    padding: var(--spacing-3xl) 0;
}

.view-controls {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: var(--spacing-2xl);
    padding: var(--spacing-lg);
    background: rgba(26, 26, 46, 0.6);
    border: 1px solid rgba(59, 130, 246, 0.2);
    border-radius: var(--border-radius-xl);
    backdrop-filter: blur(20px);
}

.view-toggle {
    display: flex;
    gap: var(--spacing-sm);
    background: rgba(15, 23, 42, 0.8);
    padding: var(--spacing-xs);
    border-radius: var(--border-radius-lg);
    border: 1px solid rgba(59, 130, 246, 0.2);
}

.view-btn {
    display: flex;
    align-items: center;
    gap: var(--spacing-sm);
    padding: var(--spacing-sm) var(--spacing-md);
    background: transparent;
    border: none;
    border-radius: var(--border-radius-md);
    color: var(--dark-400);
    font-size: var(--font-size-sm);
    font-weight: 600;
    cursor: pointer;
    transition: all var(--transition-normal);
}

.view-btn.active,
.view-btn:hover {
    background: var(--primary-color);
    color: var(--white);
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
}

.results-info {
    color: var(--dark-300);
    font-size: var(--font-size-sm);
    font-weight: 600;
}

/* شبكة القوالب */
.themes-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: var(--spacing-xl);
    margin-bottom: var(--spacing-3xl);
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
    cursor: pointer;
    backdrop-filter: blur(20px);
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
    display: flex;
    flex-direction: column;
    gap: var(--spacing-xs);
    z-index: 2;
}

.badge {
    display: flex;
    align-items: center;
    gap: var(--spacing-xs);
    padding: var(--spacing-xs) var(--spacing-sm);
    border-radius: var(--border-radius-full);
    font-size: var(--font-size-xs);
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    backdrop-filter: blur(10px);
}

.badge-featured {
    background: rgba(239, 68, 68, 0.9);
    color: var(--white);
    border: 1px solid rgba(239, 68, 68, 0.3);
}

.badge-new {
    background: rgba(59, 130, 246, 0.9);
    color: var(--white);
    border: 1px solid rgba(59, 130, 246, 0.3);
}

/* معاينة القالب */
.theme-preview {
    position: relative;
    height: 220px;
    overflow: hidden;
    background: var(--dark-800);
    border-bottom: 1px solid rgba(59, 130, 246, 0.2);
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
    background: linear-gradient(135deg, var(--dark-800), var(--dark-700));
}

.no-image i {
    font-size: 3rem;
    margin-bottom: var(--spacing-sm);
    opacity: 0.5;
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
        rgba(255, 255, 255, 0.1) 100%
    );
    opacity: 0;
    transition: opacity var(--transition-normal);
}

.theme-card:hover .theme-preview-overlay {
    opacity: 1;
}

/* محتوى القالب */
.theme-content {
    padding: var(--spacing-xl);
    flex: 1;
    display: flex;
    flex-direction: column;
}

.theme-title {
    margin-bottom: var(--spacing-lg);
    flex-grow: 1;
}

.theme-title a {
    color: var(--white);
    text-decoration: none;
    font-size: var(--font-size-xl);
    font-weight: 700;
    transition: all var(--transition-normal);
    display: block;
    background: linear-gradient(45deg, #ffffff, #3b82f6);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    background-size: 200% 200%;
    animation: gradientShift 3s ease infinite;
    line-height: 1.4;
}

.theme-title a:hover {
    background-position: 100% 100%;
}

@keyframes gradientShift {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* تقييم القالب */
.theme-rating {
    margin-bottom: var(--spacing-lg);
}

.rating-stars {
    display: flex;
    align-items: center;
    gap: var(--spacing-sm);
}

.rating-stars .fas,
.rating-stars .far,
.rating-stars .fa-star-half-alt {
    color: #fbbf24;
    font-size: 1rem;
    transition: all var(--transition-normal);
    filter: drop-shadow(0 0 3px rgba(251, 191, 36, 0.5));
}

.rating-value {
    color: var(--dark-300);
    font-size: var(--font-size-sm);
    font-weight: 600;
    background: rgba(107, 114, 128, 0.1);
    padding: 0.25rem 0.5rem;
    border-radius: var(--border-radius-full);
    margin-left: var(--spacing-sm);
}

.no-rating {
    color: var(--dark-400);
    font-size: var(--font-size-sm);
    font-style: italic;
}

/* معلومات القالب */
.theme-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: var(--spacing-md);
    background: rgba(59, 130, 246, 0.05);
    border-radius: var(--border-radius-lg);
    border: 1px solid rgba(59, 130, 246, 0.1);
}

.theme-downloads {
    display: flex;
    align-items: center;
    gap: var(--spacing-sm);
    color: var(--accent-color);
    font-weight: 600;
    font-size: var(--font-size-sm);
}

.theme-downloads i {
    animation: bounce 2s infinite;
}

@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-3px); }
}

.category-tag {
    background: rgba(139, 92, 246, 0.2);
    color: var(--secondary-color);
    padding: 0.25rem 0.75rem;
    border-radius: var(--border-radius-full);
    font-size: var(--font-size-xs);
    font-weight: 600;
    border: 1px solid rgba(139, 92, 246, 0.3);
}

/* عرض القائمة */
.themes-grid.view-list {
    display: flex;
    flex-direction: column;
    gap: var(--spacing-xl);
}

.view-list .theme-card {
    display: flex;
    flex-direction: row;
    height: auto;
    min-height: 200px;
}

.view-list .theme-preview {
    width: 300px;
    height: auto;
    flex-shrink: 0;
    border-bottom: none;
    border-left: 1px solid rgba(59, 130, 246, 0.2);
}

.view-list .theme-content {
    flex: 1;
    padding: var(--spacing-xl);
}

.view-list .theme-title a {
    font-size: var(--font-size-2xl);
}

/* رسالة عدم وجود قوالب */
.no-themes {
    grid-column: 1 / -1;
    text-align: center;
    padding: var(--spacing-3xl);
    color: var(--dark-400);
    font-size: var(--font-size-xl);
    background: rgba(26, 26, 46, 0.3);
    border-radius: var(--border-radius-xl);
    border: 2px dashed rgba(59, 130, 246, 0.3);
}

/* تحميل المزيد */
.load-more-section {
    text-align: center;
    margin-top: var(--spacing-3xl);
}

.load-more-btn {
    position: relative;
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    border: none;
    border-radius: var(--border-radius-full);
    padding: var(--spacing-lg) var(--spacing-2xl);
    color: var(--white);
    font-size: var(--font-size-lg);
    font-weight: 700;
    cursor: pointer;
    transition: all var(--transition-normal);
    overflow: hidden;
}

.load-more-btn:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-xl);
}

.load-more-btn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}

.btn-loader {
    display: none;
    width: 20px;
    height: 20px;
    border: 2px solid transparent;
    border-top: 2px solid var(--white);
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin-left: var(--spacing-sm);
}

.load-more-btn.loading .btn-loader {
    display: inline-block;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* رسائل Toast */
.toast-container {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 10000;
    display: flex;
    flex-direction: column;
    gap: var(--spacing-sm);
}

.toast {
    background: rgba(26, 26, 46, 0.95);
    border: 1px solid rgba(59, 130, 246, 0.3);
    border-radius: var(--border-radius-lg);
    padding: var(--spacing-lg);
    color: var(--white);
    backdrop-filter: blur(20px);
    transform: translateX(100%);
    transition: transform var(--transition-normal);
    min-width: 300px;
    max-width: 400px;
}

.toast.show {
    transform: translateX(0);
}

.toast.success {
    border-color: var(--success-color);
}

.toast.error {
    border-color: var(--error-color);
}

/* حركة ظهور رسائل Toast */
@keyframes toastFadeIn {
    from { opacity: 0; transform: translateX(100%); }
    to { opacity: 1; transform: translateX(0); }
}

@keyframes trailFade {
    0% { opacity: 1; transform: translate(-50%, -50%) scale(1); }
    100% { opacity: 0; transform: translate(-50%, -50%) scale(0); }
}

/* Dark Mode و Light Mode */
body.dark-mode {
    background: #000000;
}

body.dark-mode .archive-themes-page {
    background: linear-gradient(135deg, #000000 0%, #1a1a2e 50%, #16213e 100%);
}

body.light-mode {
    background: #f8fafc;
    color: #1e293b;
}

body.light-mode .archive-themes-page {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
}

body.light-mode .theme-card {
    background: rgba(255, 255, 255, 0.9);
    border-color: rgba(59, 130, 246, 0.3);
}

body.light-mode .search-box,
body.light-mode .filter-select {
    background: rgba(255, 255, 255, 0.9);
    color: #1e293b;
}

body.light-mode .view-controls {
    background: rgba(255, 255, 255, 0.8);
}

body.light-mode .theme-title a {
    color: #1e293b;
}

body.light-mode .main-search-section {
    background: rgba(255, 255, 255, 0.3);
}

/* التصميم المتجاوب */
@media (max-width: 1024px) {
    .themes-grid {
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: var(--spacing-lg);
    }
    
    .theme-toggle-sidebar {
        right: 20px;
    }
    
    .container-fluid {
        padding: 0 var(--spacing-lg);
    }
}

@media (max-width: 768px) {
    .themes-grid {
        grid-template-columns: 1fr;
        gap: var(--spacing-lg);
    }
    
    .filters-row {
        grid-template-columns: 1fr;
        gap: var(--spacing-md);
    }
    
    .view-controls {
        flex-direction: column;
        align-items: stretch;
        gap: var(--spacing-md);
    }
    
    .view-toggle {
        justify-content: center;
    }
    
    .search-box {
        padding: 1.2rem 2.5rem 1.2rem 3rem;
    }
    
    .theme-toggle-sidebar {
        right: 15px;
    }
    
    .theme-toggle-btn {
        width: 50px;
        height: 50px;
    }
    
    .view-list .theme-card {
        flex-direction: column;
    }
    
    .view-list .theme-preview {
        width: 100%;
        height: 200px;
        border-left: none;
        border-bottom: 1px solid rgba(59, 130, 246, 0.2);
    }
}

@media (max-width: 480px) {
    .container-fluid {
        padding: 0 var(--spacing-md);
    }
    
    .main-search-section {
        padding: var(--spacing-xl) 0;
    }
    
    .search-box {
        padding: 1rem 2rem 1rem 2.5rem;
    }
    
    .theme-content {
        padding: var(--spacing-lg);
    }
    
    .theme-preview {
        height: 180px;
    }
    
    .theme-toggle-btn {
        width: 45px;
        height: 45px;
    }
    
    .load-more-btn {
        padding: var(--spacing-md) var(--spacing-xl);
        font-size: var(--font-size-base);
    }
}

/* تحسينات الأداء */
.theme-card,
.search-box,
.filter-select,
.view-btn,
.load-more-btn {
    will-change: transform, box-shadow;
    contain: layout style paint;
}

/* تأثيرات خاصة للمس */
@media (hover: none) {
    .theme-card:hover {
        transform: translateY(-4px);
    }
    
    .theme-toggle-btn:hover {
        transform: scale(1.05);
    }
}
</style>

<script>
// JavaScript مدمج للأرشيف
document.addEventListener('DOMContentLoaded', function() {
    console.log('🎬 صفحة أرشيف القوالب جاهزة!');
    
    // تهيئة جميع التأثيرات
    initParticles();
    initHomeButton(); // إضافة هذا السطر
    initSearchAndFilters();
    initViewToggle();
    initLoadMore();
    initMouseEffects();
    initAnimations();
    initToastSystem();
});

// نظام الجسيمات المتحركة
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
            this.life = 1.0;
            this.decay = Math.random() * 0.003 + 0.001;
        }
        
        getRandomColor() {
            const colors = [
                '#3b82f6',
                '#8b5cf6', 
                '#ec4899',
                '#10b981'
            ];
            return colors[Math.floor(Math.random() * colors.length)];
        }
        
        update() {
            this.x += this.speedX;
            this.y += this.speedY;
            
            // إعادة تدوير الجسيمات
            if (this.x > canvas.width) this.x = 0;
            if (this.x < 0) this.x = canvas.width;
            if (this.y > canvas.height) this.y = 0;
            if (this.y < 0) this.y = canvas.height;
            
            // دورة الحياة
            this.life -= this.decay;
            if (this.life <= 0) {
                this.reset();
            }
        }
        
        draw() {
            ctx.save();
            ctx.globalAlpha = this.opacity * this.life;
            ctx.fillStyle = this.color;
            
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
            ctx.fill();
            
            ctx.restore();
        }
    }
    
    // إنشاء الجسيمات
    for (let i = 0; i < 100; i++) {
        particles.push(new Particle());
    }
    
    // حلقة الرسم
    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        
        particles.forEach(particle => {
            particle.update();
            particle.draw();
        });
        
        animationId = requestAnimationFrame(animate);
    }
    
    animate();
}


// تهيئة زر العودة للصفحة الرئيسية
function initHomeButton() {
    const homeButton = document.getElementById('home-button');
    if (!homeButton) return;
    
    // معالج النقر
    homeButton.addEventListener('click', function(e) {
        e.preventDefault();
        
        // تأثير ريبل
        const ripple = this.querySelector('.home-ripple');
        ripple.style.width = '120px';
        ripple.style.height = '120px';
        
        setTimeout(() => {
            ripple.style.width = '0';
            ripple.style.height = '0';
        }, 600);
        
        // إظهار toast
        showToast('جاري الانتقال للصفحة الرئيسية...', 'info', 1500);
        
        // تأخير قصير للسماح برؤية التأثير
        setTimeout(() => {
            window.location.href = homeButton.getAttribute('onclick').match(/'([^']+)'/)[1];
        }, 300);
    });
    
    // تأثير hover إضافي
    homeButton.addEventListener('mouseenter', function() {
        this.style.transform = 'scale(1.1) rotate(5deg)';
    });
    
    homeButton.addEventListener('mouseleave', function() {
        this.style.transform = 'scale(1) rotate(0deg)';
    });
}



// نظام البحث والفلاتر
function initSearchAndFilters() {
    const searchInput = document.getElementById('theme-search');
    const searchClear = document.getElementById('search-clear');
    const categoryFilter = document.getElementById('category-filter');
    const sortFilter = document.getElementById('sort-filter');
    const searchSuggestions = document.getElementById('search-suggestions');
    
    let searchTimeout;
    
    // البحث
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const query = this.value.trim();
            
            if (query.length > 0) {
                searchClear.classList.add('show');
                generateSearchSuggestions(query);
            } else {
                searchClear.classList.remove('show');
                hideSearchSuggestions();
            }
            
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                performSearch(query);
            }, 300);
        });

                // البحث بالضغط على Enter
        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                performSearch(this.value.trim());
                hideSearchSuggestions();
            }
        });
        
        // إخفاء الاقتراحات عند النقر خارجها
        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !searchSuggestions.contains(e.target)) {
                hideSearchSuggestions();
            }
        });
    }
    
    // مسح البحث
    if (searchClear) {
        searchClear.addEventListener('click', function() {
            searchInput.value = '';
            this.classList.remove('show');
            performSearch('');
            hideSearchSuggestions();
            searchInput.focus();
        });
    }
    
    // فلاتر
    if (categoryFilter) {
        categoryFilter.addEventListener('change', function() {
            applyFilters();
            showToast('تم تطبيق فلتر التصنيف', 'success');
        });
    }
    
    if (sortFilter) {
        sortFilter.addEventListener('change', function() {
            applyFilters();
            showToast('تم تطبيق الترتيب', 'success');
        });
    }
    
    // إنشاء اقتراحات البحث
    function generateSearchSuggestions(query) {
        const allThemes = document.querySelectorAll('.theme-card-wrapper');
        const suggestions = new Set();
        
        allThemes.forEach(card => {
            const title = card.dataset.title.toLowerCase();
            const categories = card.dataset.categories.toLowerCase();
            
            if (title.includes(query.toLowerCase())) {
                suggestions.add(card.dataset.title);
            }
            
            if (categories.includes(query.toLowerCase())) {
                const categoryArray = categories.split(',');
                categoryArray.forEach(cat => {
                    if (cat.includes(query.toLowerCase())) {
                        suggestions.add(cat.charAt(0).toUpperCase() + cat.slice(1));
                    }
                });
            }
        });
        
        displaySearchSuggestions(Array.from(suggestions).slice(0, 5));
    }
    
    // عرض اقتراحات البحث
    function displaySearchSuggestions(suggestions) {
        if (suggestions.length === 0) {
            hideSearchSuggestions();
            return;
        }
        
        searchSuggestions.innerHTML = '';
        
        suggestions.forEach(suggestion => {
            const item = document.createElement('div');
            item.className = 'suggestion-item';
            item.textContent = suggestion;
            item.addEventListener('click', function() {
                searchInput.value = suggestion;
                performSearch(suggestion);
                hideSearchSuggestions();
            });
            searchSuggestions.appendChild(item);
        });
        
        searchSuggestions.classList.add('show');
    }
    
    // إخفاء اقتراحات البحث
    function hideSearchSuggestions() {
        searchSuggestions.classList.remove('show');
    }
    
    function performSearch(query) {
        const cards = document.querySelectorAll('.theme-card-wrapper');
        let visibleCount = 0;
        
        cards.forEach(card => {
            const title = card.dataset.title.toLowerCase();
            const categories = card.dataset.categories.toLowerCase();
            
            if (query === '' || title.includes(query.toLowerCase()) || categories.includes(query.toLowerCase())) {
                card.style.display = 'block';
                visibleCount++;
                
                // تأثير ظهور البطاقة
                setTimeout(() => {
                    card.classList.add('animate-in');
                }, Math.random() * 200);
            } else {
                card.style.display = 'none';
                card.classList.remove('animate-in');
            }
        });
        
        updateResultsCount(visibleCount);
        
        if (visibleCount === 0) {
            showToast('لم يتم العثور على نتائج للبحث المطلوب', 'error');
        }
    }
    
    function applyFilters() {
        const category = categoryFilter ? categoryFilter.value : '';
        const sort = sortFilter ? sortFilter.value : '';
        const searchQuery = searchInput ? searchInput.value.toLowerCase() : '';
        
        let cards = Array.from(document.querySelectorAll('.theme-card-wrapper'));
        let visibleCards = [];
        
        // تطبيق الفلاتر
        cards.forEach(card => {
            let show = true;
            
            // فلتر التصنيف
            if (category && !card.dataset.categories.includes(category)) {
                show = false;
            }
            
            // فلتر البحث
            if (searchQuery) {
                const title = card.dataset.title.toLowerCase();
                const categories = card.dataset.categories.toLowerCase();
                if (!title.includes(searchQuery) && !categories.includes(searchQuery)) {
                    show = false;
                }
            }
            
            if (show) {
                card.style.display = 'block';
                visibleCards.push(card);
                
                // تأثير ظهور البطاقة
                setTimeout(() => {
                    card.classList.add('animate-in');
                }, Math.random() * 200);
            } else {
                card.style.display = 'none';
                card.classList.remove('animate-in');
            }
        });
        
        // تطبيق الترتيب
        if (sort && visibleCards.length > 0) {
            visibleCards.sort((a, b) => {
                switch (sort) {
                    case 'title-asc':
                        return a.dataset.title.localeCompare(b.dataset.title, 'ar');
                    case 'title-desc':
                        return b.dataset.title.localeCompare(a.dataset.title, 'ar');
                    case 'date-asc':
                        return new Date(a.dataset.date) - new Date(b.dataset.date);
                    case 'date-desc':
                        return new Date(b.dataset.date) - new Date(a.dataset.date);
                    case 'downloads-asc':
                        return parseInt(a.dataset.downloads) - parseInt(b.dataset.downloads);
                    case 'downloads-desc':
                        return parseInt(b.dataset.downloads) - parseInt(a.dataset.downloads);
                    case 'rating-desc':
                        return parseFloat(b.dataset.rating) - parseFloat(a.dataset.rating);
                    default:
                        return 0;
                }
            });
            
            // إعادة ترتيب العناصر في DOM
            const grid = document.getElementById('themes-grid');
            visibleCards.forEach((card, index) => {
                card.style.order = index;
                grid.appendChild(card);
            });
        }
        
        updateResultsCount(visibleCards.length);
    }
    
    function updateResultsCount(count) {
        const resultsCount = document.getElementById('results-count');
        if (resultsCount) {
            resultsCount.textContent = `تم العثور على ${count} قالب`;
        }
    }
    
    // التهيئة الأولية
    updateResultsCount(document.querySelectorAll('.theme-card-wrapper:not([style*="display: none"])').length);
}

// نظام تبديل طرق العرض
function initViewToggle() {
    const viewBtns = document.querySelectorAll('.view-btn');
    const themesGrid = document.getElementById('themes-grid');
    
    if (!viewBtns.length || !themesGrid) return;
    
    viewBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const view = this.dataset.view;
            
            // تحديث الأزرار
            viewBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            // تحديث الشبكة
            themesGrid.classList.remove('view-grid', 'view-list');
            themesGrid.classList.add(`view-${view}`);
            
            // حفظ التفضيل
            localStorage.setItem('preferred-view', view);
            
            // إظهار toast
            showToast(view === 'grid' ? 'تم التبديل إلى عرض الشبكة' : 'تم التبديل إلى عرض القائمة', 'success');
        });
    });
    
    // تطبيق التفضيل المحفوظ
    const savedView = localStorage.getItem('preferred-view') || 'grid';
    const savedViewBtn = document.querySelector(`[data-view="${savedView}"]`);
    if (savedViewBtn) {
        savedViewBtn.click();
    }
}

// نظام تحميل المزيد
function initLoadMore() {
    const loadMoreBtn = document.getElementById('load-more-btn');
    if (!loadMoreBtn) return;
    
    let currentPage = 1;
    let isLoading = false;
    
    loadMoreBtn.addEventListener('click', function() {
        if (isLoading) return;
        
        isLoading = true;
        currentPage++;
        
        // تأثير التحميل
        this.classList.add('loading');
        this.querySelector('.btn-text').textContent = 'جاري التحميل...';
        
        // محاكاة تحميل البيانات عبر AJAX
        setTimeout(() => {
            // إضافة قوالب جديدة (محاكاة)
            loadMoreThemes().then(newThemes => {
                if (newThemes.length > 0) {
                    appendNewThemes(newThemes);
                    showToast(`تم تحميل ${newThemes.length} قالب جديد`, 'success');
                } else {
                    showToast('لا توجد قوالب إضافية للتحميل', 'info');
                    this.style.display = 'none';
                }
                
                isLoading = false;
                this.classList.remove('loading');
                this.querySelector('.btn-text').textContent = 'تحميل المزيد';
                
                // إخفاء الزر إذا لم تعد هناك نتائج
                if (currentPage >= 5) { // محاكاة نهاية النتائج
                    this.style.display = 'none';
                    showToast('تم عرض جميع القوالب المتاحة', 'info');
                }
            });
        }, 2000);
    });
    
    // دالة محاكاة تحميل المزيد من القوالب
    async function loadMoreThemes() {
        // في التطبيق الحقيقي، هذه ستكون استدعاء AJAX
        return new Promise(resolve => {
            setTimeout(() => {
                // محاكاة بيانات قوالب جديدة
                const mockThemes = [];
                for (let i = 0; i < 6; i++) {
                    mockThemes.push({
                        id: Date.now() + i,
                        title: `قالب جديد ${currentPage}-${i + 1}`,
                        image: 'https://via.placeholder.com/400x300',
                        rating: Math.random() * 5,
                        downloads: Math.floor(Math.random() * 10000),
                        categories: ['جديد'],
                        featured: Math.random() > 0.7
                    });
                }
                resolve(mockThemes);
            }, 1000);
        });
    }
    
    // إضافة القوالب الجديدة إلى الشبكة
    function appendNewThemes(themes) {
        const grid = document.getElementById('themes-grid');
        
        themes.forEach((theme, index) => {
            const themeHtml = createThemeCardHTML(theme);
            const wrapper = document.createElement('div');
            wrapper.innerHTML = themeHtml;
            const card = wrapper.firstElementChild;
            
            // تأثير ظهور متتالي
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            grid.appendChild(card);
            
            setTimeout(() => {
                card.classList.add('animate-in');
            }, index * 100);
        });
        
        // تحديث عداد النتائج
        const visibleCards = document.querySelectorAll('.theme-card-wrapper:not([style*="display: none"])');
        const resultsCount = document.getElementById('results-count');
        if (resultsCount) {
            resultsCount.textContent = `تم العثور على ${visibleCards.length} قالب`;
        }
    }
    
    // إنشاء HTML لبطاقة قالب جديد
    function createThemeCardHTML(theme) {
        const stars = generateStarsHTML(theme.rating);
        
        return `
            <div class="theme-card-wrapper animate-in" 
                 data-theme-id="${theme.id}"
                 data-title="${theme.title}"
                 data-categories="${theme.categories.join(',')}"
                 data-date="${new Date().toISOString()}"
                 data-downloads="${theme.downloads}"
                 data-rating="${theme.rating}"
                 data-featured="${theme.featured}">
                 
                <article class="theme-card">
                    <div class="theme-badges">
                        ${theme.featured ? '<span class="badge badge-featured"><i class="fas fa-star"></i> مميز</span>' : ''}
                        <span class="badge badge-new"><i class="fas fa-plus"></i> جديد</span>
                    </div>

                    <div class="theme-preview">
                        <img src="${theme.image}" alt="${theme.title}" loading="lazy">
                        <div class="theme-preview-overlay"></div>
                    </div>

                    <div class="theme-content">
                        <h3 class="theme-title">
                            <a href="#">${theme.title}</a>
                        </h3>
                        
                        <div class="theme-rating">
                            <div class="rating-stars">
                                ${stars}
                                <span class="rating-value">(${theme.rating.toFixed(1)})</span>
                            </div>
                        </div>
                        
                        <div class="theme-meta">
                            <div class="theme-downloads">
                                <i class="fas fa-download"></i>
                                <span>${theme.downloads.toLocaleString()} تحميل</span>
                            </div>
                            
                            <div class="theme-categories">
                                <span class="category-tag">${theme.categories[0]}</span>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        `;
    }
    
    // إنشاء نجوم التقييم
    function generateStarsHTML(rating) {
        let html = '';
        const fullStars = Math.floor(rating);
        const hasHalf = (rating - fullStars) >= 0.5;
        
        for (let i = 1; i <= 5; i++) {
            if (i <= fullStars) {
                html += '<i class="fas fa-star"></i>';
            } else if (i === fullStars + 1 && hasHalf) {
                html += '<i class="fas fa-star-half-alt"></i>';
            } else {
                html += '<i class="far fa-star"></i>';
            }
        }
        
        return html;
    }
}

// تأثيرات الماوس
function initMouseEffects() {
    let mouseX = 0;
    let mouseY = 0;
    
    document.addEventListener('mousemove', function(e) {
        mouseX = e.clientX;
        mouseY = e.clientY;
        
        // تأثير تتبع الماوس
        if (Math.random() < 0.05) { // تقليل التكرار
            createMouseTrail(mouseX, mouseY);
        }
        
        // تأثير parallax للطبقات
        updateParallaxLayers(mouseX, mouseY);
    });
    
    function createMouseTrail(x, y) {
        const trail = document.createElement('div');
        const size = Math.random() * 8 + 4;
        const colors = ['#3b82f6', '#8b5cf6', '#ec4899', '#10b981'];
        const color = colors[Math.floor(Math.random() * colors.length)];
        
        trail.style.cssText = `
            position: fixed;
            left: ${x}px;
            top: ${y}px;
            width: ${size}px;
            height: ${size}px;
            background: ${color};
            border-radius: 50%;
            pointer-events: none;
            z-index: 9999;
            transform: translate(-50%, -50%);
            animation: trailFade 1.5s ease-out forwards;
        `;
        
        document.body.appendChild(trail);
        
        setTimeout(() => trail.remove(), 1500);
    }
    
    function updateParallaxLayers(mouseX, mouseY) {
        const centerX = window.innerWidth / 2;
        const centerY = window.innerHeight / 2;
        const deltaX = (mouseX - centerX) / centerX;
        const deltaY = (mouseY - centerY) / centerY;
        
        const layers = document.querySelectorAll('.parallax-layer');
        layers.forEach((layer, index) => {
            const speed = parseFloat(layer.dataset.speed) || 0.1;
            const x = deltaX * speed * 20;
            const y = deltaY * speed * 20;
            
            layer.style.transform = `translate(${x}px, ${y}px)`;
        });
    }
}

// تأثيرات الحركة والانيميشن
function initAnimations() {
    // مراقبة ظهور العناصر
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
            }
        });
    }, observerOptions);
    
    // مراقبة بطاقات القوالب
    document.querySelectorAll('.theme-card-wrapper').forEach(card => {
        observer.observe(card);
    });
    
    // تأثيرات التمرير
    window.addEventListener('scroll', throttle(handleScroll, 16));
    
    function handleScroll() {
        const scrolled = window.pageYOffset;
        const rate = scrolled * -0.5;
        
        // تأثير parallax للخلفية
        const parallaxBg = document.querySelector('.parallax-background');
        if (parallaxBg) {
            parallaxBg.style.transform = `translateY(${rate}px)`;
        }
        
        // إظهار/إخفاء زر العودة للأعلى
        toggleBackToTop(scrolled);
    }
    
    // زر العودة للأعلى
    function toggleBackToTop(scrolled) {
        let backToTopBtn = document.getElementById('back-to-top');
        
        if (!backToTopBtn) {
            backToTopBtn = createBackToTopButton();
        }
        
        if (scrolled > 500) {
            backToTopBtn.classList.add('show');
        } else {
            backToTopBtn.classList.remove('show');
        }
    }
    
    function createBackToTopButton() {
        const btn = document.createElement('button');
        btn.id = 'back-to-top';
        btn.innerHTML = '<i class="fas fa-arrow-up"></i>';
        btn.className = 'back-to-top-btn';
        btn.title = 'العودة للأعلى';
        
        btn.style.cssText = `
            position: fixed;
            bottom: 80px;
            right: 30px;
            width: 50px;
            height: 50px;
            border: none;
            border-radius: 50%;
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            color: white;
            cursor: pointer;
            z-index: 9998;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.3s ease;
            font-size: 18px;
            box-shadow: 0 4px 20px rgba(59, 130, 246, 0.3);
        `;
        
        btn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
        
        document.body.appendChild(btn);
        return btn;
    }
    
    // تحسين الأداء مع throttle
    function throttle(func, limit) {
        let inThrottle;
        return function() {
            const args = arguments;
            const context = this;
            if (!inThrottle) {
                func.apply(context, args);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        }
    }
}

// نظام رسائل Toast
function initToastSystem() {
    // إضافة CSS للزر back-to-top
    const style = document.createElement('style');
    style.textContent = `
        .back-to-top-btn.show {
            opacity: 1 !important;
            transform: translateY(0) !important;
        }
        
        .back-to-top-btn:hover {
            transform: translateY(-3px) scale(1.1) !important;
            box-shadow: 0 6px 25px rgba(59, 130, 246, 0.4) !important;
        }
    `;
    document.head.appendChild(style);
}

// دالة إظهار رسائل Toast
function showToast(message, type = 'info', duration = 3000) {
    const container = document.getElementById('toast-container');
    if (!container) return;
    
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    
    const icon = getToastIcon(type);
    toast.innerHTML = `
        <div style="display: flex; align-items: center; gap: 10px;">
            <i class="${icon}" style="font-size: 18px;"></i>
            <span>${message}</span>
        </div>
    `;
    
    container.appendChild(toast);
    
    // إظهار الرسالة
    setTimeout(() => toast.classList.add('show'), 100);
    
    // إخفاء الرسالة
    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 300);
    }, duration);
}

function getToastIcon(type) {
    switch (type) {
        case 'success': return 'fas fa-check-circle';
        case 'error': return 'fas fa-exclamation-circle';
        case 'warning': return 'fas fa-exclamation-triangle';
        case 'info': 
        default: return 'fas fa-info-circle';
    }
}

// معالجة الأخطاء العامة
window.addEventListener('error', function(e) {
    console.error('خطأ في JavaScript:', e.error);
    showToast('حدث خطأ غير متوقع', 'error');
});

// تحسين الأداء
document.addEventListener('visibilitychange', function() {
    if (document.hidden) {
        // إيقاف الأنيميشن عند إخفاء الصفحة
        const canvas = document.getElementById('particles-canvas');
        if (canvas) {
            canvas.style.display = 'none';
        }
    } else {
        // استئناف الأنيميشن عند إظهار الصفحة
        const canvas = document.getElementById('particles-canvas');
        if (canvas) {
            canvas.style.display = 'block';
        }
    }
});

// تهيئة البوابة السينمائية (اختيارية)
function showCinematicPortal() {
    const portal = document.getElementById('cinematic-portal');
    if (!portal) return;
    
    portal.classList.add('active');
    
    setTimeout(() => {
        portal.classList.remove('active');
    }, 3000);
}

// استدعاء البوابة عند التحميل (اختيارية)
// setTimeout(showCinematicPortal, 1000);

</script>

<?php get_footer(); ?>

<?php
/**
 * أرشيف القوالب - قوالب عربية ووردبريس
 * صفحة عرض القوالب بنفس أسلوب الصفحة الرئيسية
 * 
 * @package ArabicThemes
 * @author Tahactw
 * @date 2025-05-30
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit;
}

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>مكتبة القوالب | <?php bloginfo('name'); ?></title>
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

<!-- زر العودة للرئيسية -->
<div class="back-to-home">
    <a href="<?php echo home_url(); ?>" class="back-btn">
        <i class="fas fa-home"></i>
        <span>العودة للرئيسية</span>
    </a>
</div>

<!-- المحتوى الرئيسي -->
<main class="archive-main" id="archive-main">
    
    <!-- Header الأرشيف بنفس أسلوب الصفحة الرئيسية -->
    <section class="archive-header-fullscreen">
        <div class="hero-cosmic-bg">
            <div class="cosmic-stars"></div>
            <div class="cosmic-nebula"></div>
            <div class="cosmic-portal"></div>
        </div>
        
        <div class="container-centered">
            <div class="archive-header-content">
                <!-- العنوان المتحرك بنفس أسلوب الصفحة الرئيسية -->
                <div class="animated-title-container">
                    <h1 class="hero-title-mega">
                        <span class="title-static">مكتبة</span>
                        <span class="title-animated" id="animated-text">القوالب العربية</span>
                        <span class="title-cursor">|</span>
                    </h1>
                </div>
                
                <p class="hero-description-enhanced magic-text">
                    <span class="magic-word">اكتشف</span> 
                    <span class="magic-word">أجمل</span> 
                    <span class="magic-word">وأحدث</span> 
                    <span class="magic-word">قوالب</span> 
                    <span class="magic-word">ووردبريس</span>
                    <span class="magic-word">المصممة</span> 
                    <span class="magic-word">خصيصاً</span>
                    <br>
                    <span class="magic-word">للمواقع</span> 
                    <span class="magic-word">العربية</span> 
                    <span class="magic-word">الاحترافية</span>
                </p>
                
                <!-- إحصائيات متحركة -->
                <div class="hero-stats-enhanced floating-stats">
                    <div class="stat-item-mega">
                        <div class="stat-icon-enhanced">
                            <i class="fas fa-palette"></i>
                        </div>
                        <span class="stat-number-huge" data-target="<?php
                            $themes_count = wp_count_posts('wp_themes');
                            echo $themes_count ? $themes_count->publish : '25';
                        ?>">0</span>
                        <span class="stat-label-enhanced">قالب متاح</span>
                        <div class="stat-glow"></div>
                    </div>
                    
                    <div class="stat-item-mega">
                        <div class="stat-icon-enhanced">
                            <i class="fas fa-download"></i>
                        </div>
                        <span class="stat-number-huge" data-target="<?php
                            global $wpdb;
                            $total_downloads = $wpdb->get_var("
                                SELECT SUM(meta_value) 
                                FROM {$wpdb->postmeta} 
                                WHERE meta_key = '_download_count'
                            ");
                            echo $total_downloads ? $total_downloads : '1250';
                        ?>">0</span>
                        <span class="stat-label-enhanced">تحميل</span>
                        <div class="stat-glow"></div>
                    </div>
                    
                    <div class="stat-item-mega">
                        <div class="stat-icon-enhanced">
                            <i class="fas fa-gift"></i>
                        </div>
                        <span class="stat-number-huge" data-target="100">0</span>
                        <span class="stat-label-enhanced">% مجاني</span>
                        <div class="stat-glow"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- أشكال خلفية إضافية -->
        <div class="floating-shapes-enhanced">
            <div class="shape-1"></div>
            <div class="shape-2"></div>
            <div class="shape-3"></div>
            <div class="shape-4"></div>
        </div>
    </section>

    <!-- شريط الفلاتر والبحث -->
    <section class="filters-section">
        <div class="container-fluid">
            <div class="filters-wrapper">
                
                <!-- البحث الرئيسي -->
                <div class="search-container">
                    <div class="search-box">
                        <i class="fas fa-search search-icon"></i>
                        <input 
                            type="text" 
                            id="theme-search" 
                            placeholder="ابحث في مكتبة القوالب..." 
                            autocomplete="off"
                        >
                        <button type="button" class="search-clear" id="search-clear">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
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
                            <option value="downloads-asc">الأقل تحميلاً</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- عرض القوالب -->
    <section class="themes-section" id="themes-section">
        <div class="container-fluid">
            
            <!-- تبديل أنماط العرض (شبكة/قائمة فقط) -->
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
                            $theme_rating = get_post_meta($theme_id, '_theme_rating', true) ?: 4.5;
                            $is_featured = get_post_meta($theme_id, '_is_featured', true);
                            $theme_version = get_post_meta($theme_id, '_theme_version', true) ?: '1.0';
                            $last_updated = get_the_modified_date('c');
                            
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
                             
                            <article class="theme-card">
                                
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
                                        <img src="<?php echo get_the_post_thumbnail_url($theme_id, 'large'); ?>" 
                                             alt="<?php echo esc_attr(get_the_title()); ?>"
                                             loading="lazy">
                                    <?php else : ?>
                                        <div class="no-preview">
                                            <i class="fas fa-image"></i>
                                            <span>لا توجد معاينة</span>
                                        </div>
                                    <?php endif; ?>
                                    <div class="theme-preview-overlay"></div>
                                </div>

                                <!-- محتوى البطاقة -->
                                <div class="theme-content">
                                    
                                    <!-- معلومات أساسية -->
                                    <div class="theme-header">
                                        <h3 class="theme-title">
                                            <a href="<?php echo get_permalink(); ?>">
                                                <?php echo get_the_title(); ?>
                                            </a>
                                        </h3>
                                        
                                        <?php if (!empty($category_names)) : ?>
                                            <div class="theme-categories">
                                                <?php foreach (array_slice($category_names, 0, 2) as $cat_name) : ?>
                                                    <span class="category-tag"><?php echo esc_html($cat_name); ?></span>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- إحصائيات بسيطة -->
                                    <div class="theme-stats">
                                        <div class="stat-item">
                                            <i class="fas fa-download"></i>
                                            <span><?php echo number_format($download_count); ?></span>
                                        </div>
                                        
                                        <div class="stat-item">
                                            <i class="fas fa-star"></i>
                                            <span><?php echo $theme_rating; ?></span>
                                        </div>
                                        
                                        <div class="stat-item">
                                            <i class="fas fa-clock"></i>
                                            <span><?php echo get_the_date('M Y'); ?></span>
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
                                <p>جرب تغيير معايير البحث أو الفلترة</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- تحميل المزيد -->
                <?php if ($themes_query->max_num_pages > 1) : ?>
                <div class="load-more-section">
                    <button id="load-more-btn" class="load-more-btn">
                        <span class="btn-text">تحميل المزيد</span>
                        <div class="btn-loader"></div>
                    </button>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

</main>

<style>
/* 🎬 أنماط أرشيف القوالب بنفس تصميم الصفحة الرئيسية */

/* إعادة تعيين وإعدادات عامة */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

html, body {
    height: 100%;
    width: 100%;
    scroll-behavior: smooth;
    font-family: 'Cairo', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

/* متغيرات اللون */
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
    
    --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --gradient-secondary: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    
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
    --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    --shadow-2xl: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    
    --transition-fast: 0.15s ease;
    --transition-normal: 0.3s ease;
    --transition-slow: 0.5s ease;
}

/* الصفحة الرئيسية */
.archive-themes-page {
    background: #000011;
    color: #ffffff;
    min-height: 100vh;
}

/* أيقونة Dark/Light Mode - نفس التصميم */
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

.theme-toggle-btn:active .toggle-ripple {
    width: 120px;
    height: 120px;
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

/* زر العودة للرئيسية */
.back-to-home {
    position: fixed;
    top: 30px;
    left: 30px;
    z-index: 9998;
}

.back-btn {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 12px 20px;
    background: rgba(26, 26, 46, 0.9);
    border: 2px solid rgba(59, 130, 246, 0.3);
    border-radius: 50px;
    color: #ffffff;
    text-decoration: none;
    backdrop-filter: blur(20px);
    transition: all 0.3s ease;
    font-weight: 600;
}

.back-btn:hover {
    transform: translateY(-2px);
    border-color: #3b82f6;
    box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
    color: #ffffff;
    text-decoration: none;
}

/* Header الأرشيف - نفس تصميم الصفحة الرئيسية */
.archive-header-fullscreen {
    position: relative;
    height: 80vh;
    width: 100vw;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10;
    text-align: center;
    overflow: hidden;
    margin-bottom: var(--spacing-3xl);
}

.hero-cosmic-bg {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    overflow: hidden;
}

.cosmic-stars {
    position: absolute;
    width: 100%;
    height: 100%;
    background: 
        radial-gradient(2px 2px at 20px 30px, #ffffff, transparent),
        radial-gradient(2px 2px at 40px 70px, rgba(59, 130, 246, 0.8), transparent),
        radial-gradient(1px 1px at 90px 40px, rgba(139, 92, 246, 0.6), transparent),
        radial-gradient(1px 1px at 130px 80px, rgba(236, 72, 153, 0.4), transparent);
    background-repeat: repeat;
    background-size: 200px 200px;
    animation: starsFloat 20s linear infinite;
}

.cosmic-nebula {
    position: absolute;
    width: 100%;
    height: 100%;
    background: 
        radial-gradient(ellipse at center, rgba(59, 130, 246, 0.1) 0%, transparent 70%),
        radial-gradient(ellipse at 30% 40%, rgba(139, 92, 246, 0.08) 0%, transparent 60%),
        radial-gradient(ellipse at 70% 60%, rgba(236, 72, 153, 0.06) 0%, transparent 50%);
    animation: nebulaShift 30s ease-in-out infinite;
}

.cosmic-portal {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 800px;
    height: 800px;
    margin: -400px 0 0 -400px;
    background: radial-gradient(circle, transparent 30%, rgba(59, 130, 246, 0.05) 31%, transparent 32%);
    border-radius: 50%;
    animation: portalSpin 60s linear infinite;
}

.container-centered {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 2rem;
    position: relative;
    z-index: 10;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.archive-header-content {
    width: 100%;
    max-width: 1200px;
}

/* العنوان المتحرك - نفس تصميم الصفحة الرئيسية */
.animated-title-container {
    margin-bottom: 2.5rem;
}

.hero-title-mega {
    font-size: 5rem;
    font-weight: 800;
    line-height: 1.2;
    margin-bottom: 0;
}

.title-static {
    display: block;
    color: #b8b9ba;
    font-size: 2.5rem;
    font-weight: 400;
    margin-bottom: 0.5rem;
    animation: fadeInUp 1s ease 0.5s both;
}

.title-animated {
    display: inline-block;
    background: linear-gradient(45deg, #3b82f6, #8b5cf6, #ec4899, #f59e0b);
    background-size: 400% 400%;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: gradientShift 3s ease infinite, typewriter 4s steps(25) 1s both;
    border-right: 2px solid transparent;
}

.title-cursor {
    color: #3b82f6;
    animation: blink 1s infinite;
    margin-left: 5px;
}

/* النص السحري */
.hero-description-enhanced {
    font-size: 1.5rem;
    line-height: 1.8;
    margin-bottom: 4rem;
    max-width: 800px;
    margin-left: auto;
    margin-right: auto;
}

.magic-word {
    display: inline-block;
    opacity: 0;
    animation: magicAppear 0.8s ease forwards;
    margin: 0 0.4rem;
    position: relative;
}

.magic-word:nth-child(1) { animation-delay: 2s; }
.magic-word:nth-child(2) { animation-delay: 2.2s; }
.magic-word:nth-child(3) { animation-delay: 2.4s; }
.magic-word:nth-child(4) { animation-delay: 2.6s; }
.magic-word:nth-child(5) { animation-delay: 2.8s; }
.magic-word:nth-child(6) { animation-delay: 3s; }
.magic-word:nth-child(7) { animation-delay: 3.2s; }
.magic-word:nth-child(8) { animation-delay: 3.4s; }
.magic-word:nth-child(9) { animation-delay: 3.6s; }
.magic-word:nth-child(10) { animation-delay: 3.8s; }

.magic-word::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, transparent, rgba(59, 130, 246, 0.3), transparent);
    transform: translateX(-100%);
    animation: shimmer 2s ease infinite;
    animation-delay: inherit;
}

/* إحصائيات ضخمة - نفس تصميم الصفحة الرئيسية */
.hero-stats-enhanced {
    display: flex;
    justify-content: center;
    gap: 3rem;
    margin-bottom: 3rem;
    flex-wrap: wrap;
}

.stat-item-mega {
    text-align: center;
    background: rgba(26, 26, 46, 0.7);
    padding: 2.5rem 2rem;
    border-radius: 25px;
    border: 2px solid rgba(59, 130, 246, 0.3);
    backdrop-filter: blur(20px);
    position: relative;
    overflow: hidden;
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    min-width: 180px;
}

.stat-item-mega:hover {
    transform: translateY(-15px) scale(1.05);
    box-shadow: 0 30px 80px rgba(59, 130, 246, 0.4);
    border-color: #3b82f6;
}

.stat-icon-enhanced {
    font-size: 3rem;
    margin-bottom: 1.5rem;
    background: linear-gradient(45deg, #3b82f6, #8b5cf6);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: iconPulse 2s ease-in-out infinite;
}

.stat-number-huge {
    display: block;
    font-size: 3.5rem;
    font-weight: 900;
    background: linear-gradient(45deg, #3b82f6, #8b5cf6);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    line-height: 1;
    margin-bottom: 0.8rem;
}

.stat-label-enhanced {
    display: block;
    color: #b8b9ba;
    font-weight: 600;
    font-size: 1.2rem;
}

.stat-glow {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    background: radial-gradient(circle, rgba(59, 130, 246, 0.3) 0%, transparent 70%);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    transition: all 0.5s ease;
    opacity: 0;
}

.stat-item-mega:hover .stat-glow {
    width: 200px;
    height: 200px;
    opacity: 1;
}

/* أشكال خلفية إضافية */
.floating-shapes-enhanced {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: 3;
}

.shape-1,
.shape-2,
.shape-3,
.shape-4 {
    position: absolute;
    border-radius: 50%;
    background: linear-gradient(45deg, rgba(59, 130, 246, 0.1), rgba(139, 92, 246, 0.1));
    animation: shapeFloat 15s ease-in-out infinite;
}

.shape-1 {
    width: 200px;
    height: 200px;
    top: 10%;
    left: 5%;
    animation-delay: 0s;
}

.shape-2 {
    width: 150px;
    height: 150px;
    top: 20%;
    right: 10%;
    animation-delay: -5s;
}

.shape-3 {
    width: 180px;
    height: 180px;
    bottom: 15%;
    left: 8%;
    animation-delay: -10s;
}

.shape-4 {
    width: 120px;
    height: 120px;
    bottom: 10%;
    right: 15%;
    animation-delay: -15s;
}

/* قسم الفلاتر */
.filters-section {
    padding: var(--spacing-2xl) 0;
    background: rgba(26, 26, 46, 0.7);
    backdrop-filter: blur(20px);
    margin-bottom: var(--spacing-2xl);
    position: relative;
    z-index: 15;
}

.container-fluid {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 var(--spacing-lg);
}

.filters-wrapper {
    max-width: 800px;
    margin: 0 auto;
}

.search-container {
    margin-bottom: var(--spacing-xl);
}

.search-box {
    position: relative;
    display: flex;
    align-items: center;
    background: rgba(255, 255, 255, 0.1);
    border: 2px solid rgba(59, 130, 246, 0.3);
    border-radius: 50px;
    padding: 0 20px;
    transition: all 0.3s ease;
}

.search-box:focus-within {
    border-color: #3b82f6;
    box-shadow: 0 0 30px rgba(59, 130, 246, 0.3);
}

.search-icon {
    color: #8b5cf6;
    font-size: 1.2rem;
    margin-right: 15px;
}

#theme-search {
    flex: 1;
    padding: 20px 0;
    background: transparent;
    border: none;
    color: #ffffff;
    font-size: 1.1rem;
    outline: none;
}

#theme-search::placeholder {
    color: rgba(255, 255, 255, 0.6);
}

.search-clear {
    background: none;
    border: none;
    color: rgba(255, 255, 255, 0.6);
    cursor: pointer;
    padding: 8px;
    border-radius: 50%;
    transition: all 0.3s ease;
    margin-left: 10px;
}

.search-clear:hover {
    color: #ef4444;
    background: rgba(239, 68, 68, 0.1);
}

.filters-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: var(--spacing-lg);
}

.filter-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.filter-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #b8b9ba;
    font-weight: 600;
    font-size: 0.9rem;
}

.filter-select {
    background: rgba(255, 255, 255, 0.1);
    border: 2px solid rgba(59, 130, 246, 0.3);
    border-radius: 15px;
    padding: 15px 20px;
    color: #ffffff;
    font-size: 1rem;
    transition: all 0.3s ease;
    cursor: pointer;
}

.filter-select:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 20px rgba(59, 130, 246, 0.2);
}

.filter-select option {
    background: #1e293b;
    color: #ffffff;
    padding: 10px;
}

/* قسم عرض القوالب */
.themes-section {
    padding: var(--spacing-2xl) 0;
    position: relative;
    z-index: 15;
}

.view-controls {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: var(--spacing-2xl);
    flex-wrap: wrap;
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
    gap: 0.5rem;
    padding: 12px 20px;
    background: transparent;
    border: none;
    color: rgba(255, 255, 255, 0.7);
    border-radius: 50px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: 600;
}

.view-btn.active,
.view-btn:hover {
    background: linear-gradient(45deg, #3b82f6, #8b5cf6);
    color: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
}

.results-info {
    color: #b8b9ba;
    font-weight: 600;
}

/* شبكة القوالب */
.themes-container {
    position: relative;
}

.themes-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: var(--spacing-2xl);
    transition: all 0.5s ease;
}

.themes-grid.list-view {
    grid-template-columns: 1fr;
    gap: var(--spacing-lg);
}

.theme-card-wrapper {
    opacity: 0;
    transform: translateY(30px);
    animation: slideInUp 0.6s ease forwards;
}

.theme-card-wrapper:nth-child(1) { animation-delay: 0.1s; }
.theme-card-wrapper:nth-child(2) { animation-delay: 0.2s; }
.theme-card-wrapper:nth-child(3) { animation-delay: 0.3s; }
.theme-card-wrapper:nth-child(4) { animation-delay: 0.4s; }
.theme-card-wrapper:nth-child(5) { animation-delay: 0.5s; }
.theme-card-wrapper:nth-child(6) { animation-delay: 0.6s; }

/* بطاقة القالب */
.theme-card {
    background: rgba(26, 26, 46, 0.8);
    border-radius: var(--border-radius-2xl);
    overflow: hidden;
    box-shadow: var(--shadow-xl);
    transition: all var(--transition-normal);
    border: 2px solid rgba(59, 130, 246, 0.2);
    position: relative;
    height: 100%;
    display: flex;
    flex-direction: column;
    backdrop-filter: blur(20px);
}

.theme-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 25px 50px rgba(59, 130, 246, 0.3);
    border-color: #3b82f6;
}

.themes-grid.list-view .theme-card {
    flex-direction: row;
    height: auto;
}

/* شارات القالب */
.theme-badges {
    position: absolute;
    top: 15px;
    right: 15px;
    z-index: 10;
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.badge {
    display: flex;
    align-items: center;
    gap: 4px;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    backdrop-filter: blur(10px);
    border: 1px solid;
}

.badge-featured {
    background: rgba(239, 68, 68, 0.9);
    border-color: #ef4444;
    color: #ffffff;
}

.badge-new {
    background: rgba(34, 197, 94, 0.9);
    border-color: #22c55e;
    color: #ffffff;
}

/* معاينة القالب */
.theme-preview {
    position: relative;
    height: 220px;
    overflow: hidden;
    background: var(--dark-800);
    flex-shrink: 0;
}

.themes-grid.list-view .theme-preview {
    width: 300px;
    height: 200px;
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

.no-preview {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100%;
    color: var(--dark-400);
    font-size: 0.9rem;
}

.no-preview i {
    font-size: 2rem;
    margin-bottom: 0.5rem;
}

/* محتوى البطاقة */
.theme-content {
    padding: var(--spacing-lg);
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: var(--spacing-md);
}

.theme-header {
    flex: 1;
}

.theme-title {
    margin-bottom: var(--spacing-sm);
}

.theme-title a {
    color: #ffffff;
    text-decoration: none;
    font-size: 1.3rem;
    font-weight: 700;
    line-height: 1.3;
    transition: all 0.3s ease;
    background: linear-gradient(45deg, #ffffff, #ffffff);
    background-size: 200% 200%;
    -webkit-background-clip: text;
    background-clip: text;
}

.theme-title a:hover {
    background: linear-gradient(45deg, #3b82f6, #8b5cf6);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.theme-categories {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    margin-top: 8px;
}

.category-tag {
    background: rgba(59, 130, 246, 0.2);
    color: #60a5fa;
    padding: 4px 10px;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 500;
    border: 1px solid rgba(59, 130, 246, 0.3);
}

/* إحصائيات القالب */
.theme-stats {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: var(--spacing-md);
    border-top: 1px solid rgba(59, 130, 246, 0.2);
    margin-top: auto;
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 6px;
    color: var(--dark-300);
    font-size: 0.9rem;
    font-weight: 500;
}

.stat-item i {
    color: #8b5cf6;
    font-size: 0.8rem;
}

/* عدم وجود قوالب */
.no-themes {
    grid-column: 1 / -1;
    text-align: center;
    padding: var(--spacing-3xl);
    background: rgba(26, 26, 46, 0.5);
    border-radius: var(--border-radius-2xl);
    border: 2px dashed rgba(59, 130, 246, 0.3);
}

.no-themes-content i {
    font-size: 4rem;
    color: var(--dark-400);
    margin-bottom: var(--spacing-lg);
    opacity: 0.7;
}

.no-themes-content h3 {
    font-size: 1.5rem;
    color: #ffffff;
    margin-bottom: var(--spacing-sm);
}

.no-themes-content p {
    color: var(--dark-300);
    font-size: 1rem;
}

/* تحميل المزيد */
.load-more-section {
    text-align: center;
    margin-top: var(--spacing-3xl);
    padding-top: var(--spacing-2xl);
    border-top: 1px solid rgba(59, 130, 246, 0.2);
}

.load-more-btn {
    display: inline-flex;
    align-items: center;
    gap: var(--spacing-sm);
    padding: 18px 40px;
    background: linear-gradient(45deg, #3b82f6, #8b5cf6);
    border: none;
    border-radius: 50px;
    color: #ffffff;
    font-size: 1.1rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.load-more-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 40px rgba(59, 130, 246, 0.4);
}

.load-more-btn:active {
    transform: translateY(-1px);
}

.btn-loader {
    width: 20px;
    height: 20px;
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-top-color: #ffffff;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    display: none;
}

.load-more-btn.loading .btn-text {
    opacity: 0.7;
}

.load-more-btn.loading .btn-loader {
    display: block;
}

/* الحركات والتأثيرات */
@keyframes parallaxFloat {
    0%, 100% { transform: translate(0, 0) rotate(0deg); }
    25% { transform: translate(-10px, -10px) rotate(1deg); }
    50% { transform: translate(10px, -5px) rotate(-1deg); }
    75% { transform: translate(-5px, 10px) rotate(0.5deg); }
}

@keyframes starsFloat {
    0% { transform: translate(0, 0) rotate(0deg); }
    25% { transform: translate(-5px, -5px) rotate(90deg); }
    50% { transform: translate(5px, -3px) rotate(180deg); }
    75% { transform: translate(-3px, 5px) rotate(270deg); }
    100% { transform: translate(0, 0) rotate(360deg); }
}

@keyframes nebulaShift {
    0%, 100% { transform: scale(1) rotate(0deg); }
    50% { transform: scale(1.1) rotate(180deg); }
}

@keyframes portalSpin {
    0% { transform: translate(-50%, -50%) rotate(0deg); }
    100% { transform: translate(-50%, -50%) rotate(360deg); }
}

@keyframes gradientShift {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

@keyframes typewriter {
    from { width: 0; }
    to { width: 100%; }
}

@keyframes blink {
    0%, 50% { opacity: 1; }
    51%, 100% { opacity: 0; }
}

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes magicAppear {
    0% { opacity: 0; transform: translateY(20px) scale(0.8); }
    50% { transform: translateY(-5px) scale(1.1); }
    100% { opacity: 1; transform: translateY(0) scale(1); }
}

@keyframes shimmer {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

@keyframes iconPulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
}

@keyframes shapeFloat {
    0%, 100% { transform: translate(0, 0) scale(1) rotate(0deg); }
    25% { transform: translate(-20px, -20px) scale(1.1) rotate(90deg); }
    50% { transform: translate(20px, -10px) scale(0.9) rotate(180deg); }
    75% { transform: translate(-10px, 20px) scale(1.05) rotate(270deg); }
}

@keyframes slideInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

/* التصميم المتجاوب */
@media (max-width: 1024px) {
    .hero-title-mega { font-size: 4rem; }
    .title-static { font-size: 2rem; }
    .hero-stats-enhanced { gap: 2rem; }
    .stat-item-mega { min-width: 160px; padding: 2rem 1.5rem; }
    .theme-toggle-sidebar { right: 20px; }
    .theme-toggle-btn { width: 50px; height: 50px; }
    .container-centered { padding: 0 1rem; }
    .themes-grid { grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); }
}

@media (max-width: 768px) {
    .hero-title-mega { font-size: 3rem; }
    .title-static { font-size: 1.5rem; }
    .hero-description-enhanced { font-size: 1.2rem; margin-bottom: 3rem; }
    .hero-stats-enhanced { 
        flex-direction: column; 
        align-items: center; 
        gap: 1.5rem; 
        margin-bottom: 2rem;
    }
    .stat-item-mega { width: 220px; min-width: auto; }
    .themes-grid { 
        grid-template-columns: 1fr;
        gap: var(--spacing-lg);
    }
    .view-controls { 
        flex-direction: column; 
        text-align: center;
    }
    .filters-row { 
        grid-template-columns: 1fr;
        gap: var(--spacing-md);
    }
    .back-to-home { 
        top: 15px; 
        left: 15px;
    }
    .back-btn { 
        padding: 10px 16px;
        font-size: 0.9rem;
    }
    .archive-header-fullscreen {
        height: 70vh;
    }
    .floating-shapes-enhanced { display: none; }
}

@media (max-width: 480px) {
    .hero-title-mega { font-size: 2.5rem; }
    .title-static { font-size: 1.2rem; }
    .hero-description-enhanced { font-size: 1rem; }
    .stat-item-mega { width: 180px; padding: 1.5rem; }
    .stat-number-huge { font-size: 2.8rem; }
    .stat-icon-enhanced { font-size: 2.5rem; }
    .theme-toggle-sidebar { right: 10px; }
    .theme-toggle-btn { width: 40px; height: 40px; }
    .toggle-icon { width: 18px; height: 18px; }
    .sun-icon, .moon-icon { font-size: 14px; }
    .container-centered { padding: 0 0.5rem; }
    .themes-grid.list-view .theme-card {
        flex-direction: column;
    }
    .themes-grid.list-view .theme-preview {
        width: 100%;
        height: 200px;
    }
}

/* Dark Mode Styles */
body.dark-mode {
    background: #000000;
}

body.dark-mode .stat-item-mega {
    background: rgba(10, 10, 20, 0.8);
    border-color: rgba(139, 92, 246, 0.4);
}

body.dark-mode .theme-toggle-btn {
    background: rgba(10, 10, 20, 0.95);
    border-color: rgba(139, 92, 246, 0.4);
}

body.dark-mode .theme-card {
    background: rgba(10, 10, 20, 0.9);
    border-color: rgba(139, 92, 246, 0.3);
}

body.dark-mode .filters-section {
    background: rgba(10, 10, 20, 0.8);
}

/* Light Mode Styles */
body.light-mode {
    background: #f8fafc;
    color: #1e293b;
}

body.light-mode .archive-themes-page {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
}

body.light-mode .cosmic-stars {
    background: 
        radial-gradient(2px 2px at 20px 30px, #3b82f6, transparent),
        radial-gradient(2px 2px at 40px 70px, rgba(59, 130, 246, 0.6), transparent),
        radial-gradient(1px 1px at 90px 40px, rgba(139, 92, 246, 0.4), transparent),
        radial-gradient(1px 1px at 130px 80px, rgba(236, 72, 153, 0.3), transparent);
}

body.light-mode .stat-item-mega {
    background: rgba(255, 255, 255, 0.9);
    border-color: rgba(59, 130, 246, 0.3);
    color: #1e293b;
}

body.light-mode .theme-toggle-btn {
    background: rgba(255, 255, 255, 0.95);
    border-color: rgba(59, 130, 246, 0.3);
}

body.light-mode .theme-card {
    background: rgba(255, 255, 255, 0.95);
    border-color: rgba(59, 130, 246, 0.2);
}

body.light-mode .theme-title a {
    color: #1e293b;
}

body.light-mode .filters-section {
    background: rgba(255, 255,

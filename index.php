<?php
/**
 * الصفحة الرئيسية الشاملة - قوالب عربية ووردبريس
 * تجربة سينمائية متكاملة مع جميع المكونات المطلوبة
 * 
 * @package ArabicThemes
 * @author Tahactw
 * @date 2025-05-30
 * @version 3.0.0-complete
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
    <meta name="description" content="اكتشف أجمل وأحدث قوالب ووردبريس العربية المجانية والاحترافية. تصاميم حديثة ومتجاوبة لجميع أنواع المواقع العربية.">
    <meta name="keywords" content="قوالب ووردبريس, قوالب عربية, تصاميم ووردبريس, مواقع عربية, قوالب مجانية">
    <meta name="author" content="Tahactw">
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="قوالب عربية ووردبريس - مستقبل الويب العربي">
    <meta property="og:description" content="اكتشف أجمل وأحدث قوالب ووردبريس العربية المجانية والاحترافية">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo home_url(); ?>">
    <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/assets/images/og-image.jpg">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="قوالب عربية ووردبريس">
    <meta name="twitter:description" content="اكتشف أجمل وأحدث قوالب ووردبريس العربية">
    
    <title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
    
    <!-- Preload critical resources -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900&family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" as="style">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" as="style">
    
    <!-- DNS Prefetch -->
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//cdnjs.cloudflare.com">
    
    <?php wp_head(); ?>
    
    <!-- Critical CSS للتحميل السريع -->
    <style id="critical-css">
        /* Critical CSS للتحميل الفوري */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Cairo', 'Tajawal', sans-serif;
            background: #000011;
            color: #ffffff;
            overflow-x: hidden;
        }
        
        .loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #000011 0%, #1a1a2e 50%, #16213e 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 999999;
            transition: opacity 1s ease, visibility 1s ease;
        }
        
        .loading-screen.hidden {
            opacity: 0;
            visibility: hidden;
        }
        
        .loader {
            width: 80px;
            height: 80px;
            border: 4px solid rgba(59, 130, 246, 0.2);
            border-left: 4px solid #3b82f6;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body <?php body_class('homepage-cinematic'); ?>>

<!-- شاشة التحميل -->
<div id="loading-screen" class="loading-screen">
    <div class="loader-container">
        <div class="loader"></div>
        <div class="loading-text">
            <h3>جاري التحميل...</h3>
            <p>مرحباً بك في قوالب عربية ووردبريس</p>
        </div>
    </div>
</div>

<!-- Canvas للجسيمات المتحركة -->
<canvas id="particles-canvas"></canvas>

<!-- خلفية الـ Parallax المتقدمة -->
<div class="parallax-background">
    <div class="parallax-layer" data-speed="0.1"></div>
    <div class="parallax-layer" data-speed="0.3"></div>
    <div class="parallax-layer" data-speed="0.5"></div>
    <div class="cosmic-grid"></div>
</div>

<!-- البوابة السينمائية المحسنة -->
<div id="cinematic-portal" class="cinematic-portal">
    <div class="portal-background">
        <div class="energy-waves"></div>
        <div class="plasma-field"></div>
    </div>
    
    <div class="portal-wave"></div>
    
    <div class="floating-elements">
        <!-- أيقونات تقنية -->
        <div class="floating-icon tech-icon" data-icon="🎨" data-delay="0.1"></div>
        <div class="floating-icon tech-icon" data-icon="📱" data-delay="0.2"></div>
        <div class="floating-icon tech-icon" data-icon="💻" data-delay="0.3"></div>
        <div class="floating-icon tech-icon" data-icon="🚀" data-delay="0.4"></div>
        <div class="floating-icon tech-icon" data-icon="⭐" data-delay="0.5"></div>
        <div class="floating-icon tech-icon" data-icon="🎯" data-delay="0.6"></div>
        <div class="floating-icon tech-icon" data-icon="💎" data-delay="0.7"></div>
        <div class="floating-icon tech-icon" data-icon="🌟" data-delay="0.8"></div>
        
        <!-- حروف عربية -->
        <div class="floating-letter arabic-letter" data-delay="0.9">ق</div>
        <div class="floating-letter arabic-letter" data-delay="1.0">و</div>
        <div class="floating-letter arabic-letter" data-delay="1.1">ا</div>
        <div class="floating-letter arabic-letter" data-delay="1.2">ل</div>
        <div class="floating-letter arabic-letter" data-delay="1.3">ب</div>
        <div class="floating-letter arabic-letter" data-delay="1.4">ع</div>
        <div class="floating-letter arabic-letter" data-delay="1.5">ر</div>
        <div class="floating-letter arabic-letter" data-delay="1.6">ب</div>
        <div class="floating-letter arabic-letter" data-delay="1.7">ي</div>
        <div class="floating-letter arabic-letter" data-delay="1.8">ة</div>
    </div>
    
    <div class="portal-center">
        <div class="portal-rings">
            <div class="ring ring-1"></div>
            <div class="ring ring-2"></div>
            <div class="ring ring-3"></div>
            <div class="ring ring-4"></div>
            <div class="ring ring-5"></div>
        </div>
        <div class="portal-core">
            <div class="core-inner">
                <i class="fas fa-rocket"></i>
                <div class="energy-pulse"></div>
            </div>
        </div>
    </div>
    
    <div class="portal-text">
        <h2 class="portal-title">جاري فتح بوابة القوالب...</h2>
        <div class="loading-progress">
            <div class="progress-bar"></div>
            <div class="progress-glow"></div>
        </div>
        <div class="portal-subtitle">مستقبل الويب العربي يبدأ الآن</div>
    </div>
    
    <!-- تأثيرات إضافية -->
    <div class="portal-effects">
        <div class="lightning-effect"></div>
        <div class="stardust-trail"></div>
        <div class="quantum-field"></div>
    </div>
</div>

<!-- التنقل العلوي الثابت -->
<nav id="main-navigation" class="main-navigation">
    <div class="nav-container">
        <div class="nav-brand">
            <a href="<?php echo home_url(); ?>" class="brand-link">
                <div class="brand-icon">
                    <i class="fas fa-palette"></i>
                </div>
                <div class="brand-text">
                    <span class="brand-name">قوالب عربية</span>
                    <span class="brand-tagline">ووردبريس</span>
                </div>
            </a>
        </div>
        
        <div class="nav-menu">
            <ul class="nav-list">
                <li class="nav-item active">
                    <a href="<?php echo home_url(); ?>" class="nav-link">
                        <i class="fas fa-home"></i>
                        <span>الرئيسية</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo home_url('/themes/'); ?>" class="nav-link">
                        <i class="fas fa-th-large"></i>
                        <span>القوالب</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo home_url('/categories/'); ?>" class="nav-link">
                        <i class="fas fa-tags"></i>
                        <span>التصنيفات</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo home_url('/about/'); ?>" class="nav-link">
                        <i class="fas fa-info-circle"></i>
                        <span>من نحن</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo home_url('/contact/'); ?>" class="nav-link">
                        <i class="fas fa-envelope"></i>
                        <span>اتصل بنا</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <div class="nav-actions">
            <button class="search-toggle" id="search-toggle" title="البحث">
                <i class="fas fa-search"></i>
            </button>
            <button class="menu-toggle" id="menu-toggle" title="القائمة">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>
    
    <!-- قائمة البحث المخفية -->
    <div class="search-overlay" id="search-overlay">
        <div class="search-container">
            <form class="search-form" role="search" method="get" action="<?php echo home_url('/'); ?>">
                <input type="search" name="s" placeholder="ابحث عن القوالب..." class="search-input" autocomplete="off">
                <button type="submit" class="search-submit">
                    <i class="fas fa-search"></i>
                </button>
            </form>
            <button class="search-close" id="search-close">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
</nav>

<!-- الصفحة الرئيسية المركزة -->
<main class="main-content homepage-focused">
    <!-- Hero Section الشاشة الكاملة -->
    <section class="hero-section-fullscreen" id="hero-section">
        <div class="hero-cosmic-bg">
            <div class="cosmic-stars"></div>
            <div class="cosmic-nebula"></div>
            <div class="cosmic-portal"></div>
            <div class="meteor-shower"></div>
        </div>
        
        <div class="container-centered">
            <div class="hero-content-main">
                <!-- العنوان المتحرك المحسن -->
                <div class="animated-title-container">
                    <div class="title-decoration">
                        <div class="title-line"></div>
                        <div class="title-spark"></div>
                    </div>
                    
                    <h1 class="hero-title-mega">
                        <span class="title-static">مرحباً بك في</span>
                        <span class="title-animated" id="animated-text">قوالب عربية ووردبريس</span>
                        <span class="title-cursor">|</span>
                    </h1>
                    
                    <div class="title-decoration bottom">
                        <div class="title-line"></div>
                        <div class="title-spark"></div>
                    </div>
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
                    <span class="magic-word">والحديثة</span>
                </p>
                
                <!-- الأزرار المتطورة -->
                <div class="hero-actions-enhanced">
                    <button class="cinematic-portal-btn-main" id="portal-trigger">
                        <div class="btn-background">
                            <div class="btn-gradient"></div>
                            <div class="btn-particles-bg"></div>
                            <div class="btn-energy-field"></div>
                        </div>
                        <div class="btn-content">
                            <div class="btn-icon">
                                <i class="fas fa-rocket"></i>
                            </div>
                            <span class="btn-text">استكشاف القوالب الآن</span>
                            <div class="btn-ripple-effect"></div>
                        </div>
                        <div class="btn-aura"></div>
                        <div class="btn-glow"></div>
                    </button>
                    
                    <a href="<?php echo home_url('/about/'); ?>" class="btn-secondary-cosmic">
                        <div class="btn-secondary-bg"></div>
                        <div class="btn-secondary-text">
                            <i class="fas fa-info-circle"></i>
                            <span>تعرف علينا</span>
                        </div>
                        <div class="btn-secondary-ripple"></div>
                    </a>
                </div>
                
                <!-- إحصائيات متحركة محسنة -->
                <div class="hero-stats-enhanced floating-stats">
                    <div class="stat-item-mega" data-aos="flip-left" data-aos-delay="100">
                        <div class="stat-background">
                            <div class="stat-glow-bg"></div>
                            <div class="stat-particle-field"></div>
                        </div>
                        <div class="stat-content">
                            <div class="stat-icon-enhanced">
                                <i class="fas fa-palette"></i>
                            </div>
                            <span class="stat-number-huge" data-target="<?php
                                $themes_count = wp_count_posts('wp_themes');
                                echo $themes_count ? $themes_count->publish : '50';
                            ?>">0</span>
                            <span class="stat-label-enhanced">قالب متاح</span>
                        </div>
                        <div class="stat-glow"></div>
                    </div>
                    
                    <div class="stat-item-mega" data-aos="flip-left" data-aos-delay="200">
                        <div class="stat-background">
                            <div class="stat-glow-bg"></div>
                            <div class="stat-particle-field"></div>
                        </div>
                        <div class="stat-content">
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
                                echo $total_downloads ? $total_downloads : '15000';
                            ?>">0</span>
                            <span class="stat-label-enhanced">تحميل</span>
                        </div>
                        <div class="stat-glow"></div>
                    </div>
                    
                    <div class="stat-item-mega" data-aos="flip-left" data-aos-delay="300">
                        <div class="stat-background">
                            <div class="stat-glow-bg"></div>
                            <div class="stat-particle-field"></div>
                        </div>
                        <div class="stat-content">
                            <div class="stat-icon-enhanced">
                                <i class="fas fa-gift"></i>
                            </div>
                            <span class="stat-number-huge" data-target="100">0</span>
                            <span class="stat-label-enhanced">% مجاني</span>
                        </div>
                        <div class="stat-glow"></div>
                    </div>
                    
                    <div class="stat-item-mega" data-aos="flip-left" data-aos-delay="400">
                        <div class="stat-background">
                            <div class="stat-glow-bg"></div>
                            <div class="stat-particle-field"></div>
                        </div>
                        <div class="stat-content">
                            <div class="stat-icon-enhanced">
                                <i class="fas fa-users"></i>
                            </div>
                            <span class="stat-number-huge" data-target="2500">0</span>
                            <span class="stat-label-enhanced">مستخدم راضٍ</span>
                        </div>
                        <div class="stat-glow"></div>
                    </div>
                </div>
                
                <!-- ميزات سريعة -->
                <div class="quick-features">
                    <div class="feature-item" data-aos="fade-up" data-aos-delay="500">
                        <div class="feature-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <span class="feature-text">متجاوب تماماً</span>
                    </div>
                    <div class="feature-item" data-aos="fade-up" data-aos-delay="600">
                        <div class="feature-icon">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <span class="feature-text">سريع التحميل</span>
                    </div>
                    <div class="feature-item" data-aos="fade-up" data-aos-delay="700">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <span class="feature-text">آمن ومحدث</span>
                    </div>
                    <div class="feature-item" data-aos="fade-up" data-aos-delay="800">
                        <div class="feature-icon">
                            <i class="fas fa-language"></i>
                        </div>
                        <span class="feature-text">دعم كامل للعربية</span>
                    </div>
                </div>
                
                <!-- شعار أو نص إضافي -->
                <div class="hero-footer-text">
                    <div class="slogan-container">
                        <div class="slogan-decoration">
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="slogan-text">
                            مستقبل الويب العربي يبدأ من هنا
                        </p>
                        <div class="slogan-decoration">
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    
                    <div class="scroll-indicator" id="scroll-indicator">
                        <div class="scroll-arrow">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <span class="scroll-text">اكتشف المزيد</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- عناصر خلفية إضافية متطورة -->
        <div class="floating-shapes-enhanced">
            <div class="shape-1 floating-shape"></div>
            <div class="shape-2 floating-shape"></div>
            <div class="shape-3 floating-shape"></div>
            <div class="shape-4 floating-shape"></div>
            <div class="shape-5 floating-shape"></div>
            <div class="shape-6 floating-shape"></div>
        </div>
    </section>

    <!-- قسم القوالب المميزة -->
    <section class="featured-themes-section" id="featured-themes">
        <div class="container">
            <div class="section-header">
                <div class="section-badge">
                    <i class="fas fa-star"></i>
                    <span>مميز</span>
                </div>
                <h2 class="section-title">القوالب المميزة</h2>
                <p class="section-description">اكتشف أحدث وأجمل قوالب ووردبريس العربية</p>
                <div class="section-decoration">
                    <div class="decoration-line"></div>
                    <div class="decoration-dot"></div>
                    <div class="decoration-line"></div>
                </div>
            </div>
            
            <div class="themes-grid">
                <?php
                // جلب القوالب المميزة
                $featured_themes = new WP_Query(array(
                    'post_type' => 'wp_themes',
                    'posts_per_page' => 6,
                    'meta_query' => array(
                        array(
                            'key' => '_featured_theme',
                            'value' => 'yes',
                            'compare' => '='
                        )
                    )
                ));
                
                if ($featured_themes->have_posts()) :
                    $delay = 0;
                    while ($featured_themes->have_posts()) : $featured_themes->the_post();
                        $theme_id = get_the_ID();
                        $demo_url = get_post_meta($theme_id, '_theme_demo_url', true);
                        $download_url = get_post_meta($theme_id, '_theme_download_url', true);
                        $version = get_post_meta($theme_id, '_theme_version', true);
                        $price = get_post_meta($theme_id, '_theme_price', true);
                        $downloads = get_post_meta($theme_id, '_download_count', true) ?: 0;
                        $rating = 4.5; // يمكن حسابه من قاعدة البيانات
                        $delay += 100;
                ?>
                <article class="theme-card featured-card" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
                    <div class="card-background">
                        <div class="card-glow"></div>
                        <div class="card-particles"></div>
                    </div>
                    
                    <div class="theme-badges">
                        <span class="badge badge-featured">
                            <i class="fas fa-star"></i>
                            مميز
                        </span>
                        <?php if (empty($price)) : ?>
                        <span class="badge badge-free">
                            <i class="fas fa-gift"></i>
                            مجاني
                        </span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="theme-preview">
                        <div class="preview-container">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('theme-preview', array('class' => 'theme-image', 'loading' => 'lazy')); ?>
                            <?php else : ?>
                                <div class="no-image">
                                    <i class="fas fa-image"></i>
                                    <span>لا توجد صورة</span>
                                </div>
                            <?php endif; ?>
                            <div class="preview-overlay">
                                <div class="preview-actions">
                                    <?php if ($demo_url) : ?>
                                    <a href="<?php echo esc_url($demo_url); ?>" class="preview-btn demo-btn" target="_blank" title="معاينة مباشرة">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <?php endif; ?>
                                    <button class="preview-btn download-btn" data-theme-id="<?php echo $theme_id; ?>" title="تحميل القالب">
                                        <i class="fas fa-download"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="theme-content">
                        <h3 class="theme-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                        
                        <div class="theme-meta">
                            <div class="theme-rating">
                                <div class="rating-stars">
                                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                                        <i class="<?php echo $i <= $rating ? 'fas' : 'far'; ?> fa-star"></i>
                                    <?php endfor; ?>
                                    <span class="rating-value">(<?php echo number_format($rating, 1); ?>)</span>
                                </div>
                            </div>
                            
                            <div class="theme-stats">
                                <div class="stat-item">
                                    <i class="fas fa-download"></i>
                                    <span><?php echo number_format($downloads); ?></span>
                                </div>
                                <?php if ($version) : ?>
                                <div class="stat-item">
                                    <i class="fas fa-tag"></i>
                                    <span>v<?php echo esc_html($version); ?></span>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="theme-excerpt">
                            <?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?>
                        </div>
                        
                        <div class="theme-categories">
                            <?php
                            $categories = get_the_terms($theme_id, 'theme_category');
                            if ($categories && !is_wp_error($categories)) :
                                foreach (array_slice($categories, 0, 2) as $category) :
                            ?>
                                <span class="category-tag"><?php echo esc_html($category->name); ?></span>
                            <?php endforeach; endif; ?>
                        </div>
                    </div>
                    
                    <div class="theme-actions">
                        <button class="btn-primary download-theme-btn" data-theme-id="<?php echo $theme_id; ?>">
                            <i class="fas fa-download"></i>
                            <span>تحميل مجاني</span>
                            <div class="btn-ripple"></div>
                        </button>
                        
                        <a href="<?php the_permalink(); ?>" class="btn-secondary">
                            <i class="fas fa-info-circle"></i>
                            <span>التفاصيل</span>
                        </a>
                    </div>
                </article>
                <?php endwhile; wp_reset_postdata(); endif; ?>
            </div>
            
            <div class="section-footer">
                <a href="<?php echo home_url('/themes/'); ?>" class="btn-view-all">
                    <span>عرض جميع القوالب</span>
                    <i class="fas fa-arrow-left"></i>
                    <div class="btn-glow"></div>
                </a>
            </div>
        </div>
    </section>

    <!-- قسم التصنيفات -->
    <section class="categories-section" id="categories">
        <div class="container">
            <div class="section-header">
                <div class="section-badge">
                    <i class="fas fa-tags"></i>
                    <span>تصنيفات</span>
                </div>
                <h2 class="section-title">تصفح حسب النوع</h2>
                <p class="section-description">اختر التصنيف المناسب لموقعك</p>
            </div>
            
            <div class="categories-grid">
                <?php
                $categories = get_terms(array(
                    'taxonomy' => 'theme_category',
                    'hide_empty' => true,
                    'number' => 8
                ));
                
                if ($categories && !is_wp_error($categories)) :
                    $delay = 0;
                    foreach ($categories as $category) :
                        $category_icon = get_term_meta($category->term_id, '_category_icon', true) ?: 'fas fa-folder';
                        $category_color = get_term_meta($category->term_id, '_category_color', true) ?: '#3b82f6';
                        $delay += 100;
                ?>
                <div class="category-card" data-aos="zoom-in" data-aos-delay="<?php echo $delay; ?>">
                    <div class="category-background" style="--category-color: <?php echo esc_attr($category_color); ?>">
                        <div class="category-glow"></div>
                    </div>
                    
                    <div class="category-icon">
                        <i class="<?php echo esc_attr($category_icon); ?>"></i>
                    </div>
                    
                    <div class="category-content">
                        <h3 class="category-name"><?php echo esc_html($category->name); ?></h3>
                        <p class="category-count"><?php echo $category->count; ?> قالب</p>
                        <?php if ($category->description) : ?>
                        <p class="category-description"><?php echo esc_html($category->description); ?></p>
                        <?php endif; ?>
                    </div>
                    
                    <a href="<?php echo get_term_link($category); ?>" class="category-link">
                        <span>استكشاف</span>
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
                <?php endforeach; endif; ?>
            </div>
        </div>
    </section>

    <!-- قسم المزايا -->
    <section class="features-section" id="features">
        <div class="container">
            <div class="section-header">
                <div class="section-badge">
                    <i class="fas fa-star"></i>
                    <span>مزايا</span>
                </div>
                <h2 class="section-title">لماذا تختار قوالبنا؟</h2>
                <p class="section-description">مزايا استثنائية تجعل موقعك يتميز</p>
            </div>
            
            <div class="features-grid">
                <div class="feature-item" data-aos="fade-right" data-aos-delay="100">
                    <div class="feature-icon">
                        <i class="fas fa-rocket"></i>
                    </div>
                    <div class="feature-content">
                        <h3 class="feature-title">أداء فائق</h3>
                        <p class="feature-description">قوالب محسنة للسرعة والأداء مع تحميل سريع وتجربة مستخدم ممتازة</p>
                    </div>
                </div>
                
                <div class="feature-item" data-aos="fade-right" data-aos-delay="200">
                    <div class="feature-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <div class="feature-content">
                        <h3 class="feature-title">تصميم متجاوب</h3>
                        <p class="feature-description">يعمل بشكل مثالي على جميع الأجهزة من الهواتف إلى أجهزة الكمبيوتر المكتبية</p>
                    </div>
                </div>
                
                <div class="feature-item" data-aos="fade-right" data-aos-delay="300">
                    <div class="feature-icon">
                        <i class="fas fa-language"></i>
                    </div>
                    <div class="feature-content">
                        <h3 class="feature-title">دعم كامل للعربية</h3>
                        <p class="feature-description">مصمم خصيصاً للمحتوى العربي مع دعم الكتابة من اليمين إلى اليسار</p>
                    </div>
                </div>
                
                <div class="feature-item" data-aos="fade-left" data-aos-delay="100">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="feature-content">
                        <h3 class="feature-title">أمان متقدم</h3>
                        <p class="feature-description">كود نظيف وآمن يتبع أفضل معايير الأمان والحماية في ووردبريس</p>
                    </div>
                </div>
                
                <div class="feature-item" data-aos="fade-left" data-aos-delay="200">
                    <div class="feature-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <div class="feature-content">
                        <h3 class="feature-title">محسن للSEO</h3>
                        <p class="feature-description">مبني وفقاً لأفضل ممارسات SEO لضمان ظهور موقعك في نتائج البحث</p>
                    </div>
                </div>
                
                <div class="feature-item" data-aos="fade-left" data-aos-delay="300">
                    <div class="feature-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <div class="feature-content">
                        <h3 class="feature-title">دعم فني مجاني</h3>
                        <p class="feature-description">فريق دعم متخصص جاهز لمساعدتك في أي وقت وحل جميع استفساراتك</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- قسم الشهادات -->
    <section class="testimonials-section" id="testimonials">
        <div class="container">
            <div class="section-header">
                <div class="section-badge">
                    <i class="fas fa-quote-left"></i>
                    <span>آراء العملاء</span>
                </div>
                <h2 class="section-title">ماذا يقول عملاؤنا؟</h2>
                <p class="section-description">تجارب حقيقية من مستخدمين راضين</p>
            </div>
            
            <div class="testimonials-slider" id="testimonials-slider">
                <div class="testimonial-item active" data-aos="fade-up">
                    <div class="testimonial-content">
                        <div class="testimonial-text">
                            "قوالب رائعة وسهلة الاستخدام. ساعدتني في إنشاء موقع احترافي بسرعة مذهلة. التصميم جميل والأداء ممتاز."
                        </div>
                        <div class="testimonial-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <img src="https://via.placeholder.com/60x60/3b82f6/ffffff?text=أ" alt="أحمد محمد" loading="lazy">
                        </div>
                        <div class="author-info">
                            <h4 class="author-name">أحمد محمد</h4>
                            <p class="author-title">مطور ويب</p>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial-item" data-aos="fade-up">
                    <div class="testimonial-content">
                        <div class="testimonial-text">
                            "تجربة ممتازة مع قوالب عربية. الدعم الفني سريع ومفيد، والقوالب محسنة بشكل رائع للمحتوى العربي."
                        </div>
                        <div class="testimonial-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <img src="https://via.placeholder.com/60x60/8b5cf6/ffffff?text=ف" alt="فاطمة أحمد" loading="lazy">
                        </div>
                        <div class="author-info">
                            <h4 class="author-name">فاطمة أحمد</h4>
                            <p class="author-title">مصممة جرافيك</p>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial-item" data-aos="fade-up">
                    <div class="testimonial-content">
                        <div class="testimonial-text">
                            "أفضل مصدر للقوالب العربية. تصاميم حديثة وعصرية تواكب أحدث الاتجاهات في تصميم المواقع."
                        </div>
                        <div class="testimonial-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <img src="https://via.placeholder.com/60x60/ec4899/ffffff?text=م" alt="محمد علي" loading="lazy">
                        </div>
                        <div class="author-info">
                            <h4 class="author-name">محمد علي</h4>
                            <p class="author-title">صاحب متجر إلكتروني</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="testimonials-navigation">
                <button class="nav-btn prev-btn" id="testimonials-prev">
                    <i class="fas fa-chevron-right"></i>
                </button>
                <div class="testimonials-dots" id="testimonials-dots">
                    <span class="dot active"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                </div>
                <button class="nav-btn next-btn" id="testimonials-next">
                    <i class="fas fa-chevron-left"></i>
                </button>
            </div>
        </div>
    </section>

    <!-- قسم الاشتراك في النشرة البريدية -->
    <section class="newsletter-section" id="newsletter">
        <div class="newsletter-background">
            <div class="newsletter-particles"></div>
            <div class="newsletter-glow"></div>
        </div>
        
        <div class="container">
            <div class="newsletter-content">
                <div class="newsletter-text" data-aos="fade-right">
                    <h2 class="newsletter-title">ابق على اطلاع</h2>
                    <p class="newsletter-description">
                        احصل على أحدث القوالب والتحديثات مباشرة في بريدك الإلكتروني
                    </p>
                    <div class="newsletter-features">
                        <div class="feature">
                            <i class="fas fa-check"></i>
                            <span>قوالب جديدة أسبوعياً</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-check"></i>
                            <span>نصائح وإرشادات مفيدة</span>
                        </div>
                        <div class="feature">
                            <i class="fas fa-check"></i>
                            <span>عروض حصرية للمشتركين</span>
                        </div>
                    </div>
                </div>
                
                <div class="newsletter-form-container" data-aos="fade-left">
                    <form class="newsletter-form" id="newsletter-form">
                        <div class="form-group">
                            <input type="email" name="email" placeholder="أدخل بريدك الإلكتروني" required class="newsletter-input">
                            <button type="submit" class="newsletter-btn">
                                <span class="btn-text">اشترك الآن</span>
                                <i class="fas fa-paper-plane"></i>
                                <div class="btn-loading">
                                    <i class="fas fa-spinner fa-spin"></i>
                                </div>
                            </button>
                        </div>
                        <div class="form-privacy">
                            <i class="fas fa-shield-alt"></i>
                            <span>نحن نحترم خصوصيتك ولن نرسل لك رسائل غير مرغوب فيها</span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- التذييل -->
<footer class="main-footer" id="main-footer">
    <div class="footer-background">
        <div class="footer-particles"></div>
        <div class="footer-glow"></div>
    </div>
    
    <div class="container">
        <div class="footer-content">
            <div class="footer-section footer-about">
                <div class="footer-logo">
                    <div class="logo-icon">
                        <i class="fas fa-palette"></i>
                    </div>
                    <div class="logo-text">
                        <h3>قوالب عربية</h3>
                        <span>ووردبريس</span>
                    </div>
                </div>
                <p class="footer-description">
                    منصة متخصصة في تطوير وتوفير أجمل وأحدث قوالب ووردبريس المصممة خصيصاً للمواقع العربية الاحترافية.
                </p>
                <div class="social-links">
                    <a href="#" class="social-link" title="فيسبوك">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-link" title="تويتر">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="social-link" title="إنستغرام">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="social-link" title="لينكد إن">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="#" class="social-link" title="يوتيوب">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
            
            <div class="footer-section footer-links">
                <h4 class="footer-title">روابط سريعة</h4>
                <ul class="footer-menu">
                    <li><a href="<?php echo home_url(); ?>">الرئيسية</a></li>
                    <li><a href="<?php echo home_url('/themes/'); ?>">القوالب</a></li>
                    <li><a href="<?php echo home_url('/categories/'); ?>">التصنيفات</a></li>
                    <li><a href="<?php echo home_url('/about/'); ?>">من نحن</a></li>
                    <li><a href="<?php echo home_url('/contact/'); ?>">اتصل بنا</a></li>
                </ul>
            </div>
            
            <div class="footer-section footer-categories">
                <h4 class="footer-title">التصنيفات الشائعة</h4>
                <ul class="footer-menu">
                    <?php
                    $popular_categories = get_terms(array(
                        'taxonomy' => 'theme_category',
                        'number' => 5,
                        'orderby' => 'count',
                        'order' => 'DESC'
                    ));
                    
                    if ($popular_categories && !is_wp_error($popular_categories)) :
                        foreach ($popular_categories as $category) :
                    ?>
                    <li><a href="<?php echo get_term_link($category); ?>"><?php echo esc_html($category->name); ?></a></li>
                    <?php endforeach; endif; ?>
                </ul>
            </div>
            
            <div class="footer-section footer-contact">
                <h4 class="footer-title">تواصل معنا</h4>
                <div class="contact-info">
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <span>info@arabicthemes.com</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <span>+966 50 123 4567</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>الرياض، المملكة العربية السعودية</span>
                    </div>
                </div>
                
                <div class="footer-newsletter">
                    <h5>النشرة البريدية</h5>
                    <form class="mini-newsletter-form">
                        <input type="email" placeholder="بريدك الإلكتروني" required>
                        <button type="submit">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="footer-bottom-content">
                <div class="copyright">
                    <p>&copy; <?php echo date('Y'); ?> قوالب عربية ووردبريس. جميع الحقوق محفوظة.</p>
                </div>
                <div class="footer-bottom-links">
                    <a href="<?php echo home_url('/privacy-policy/'); ?>">سياسة الخصوصية</a>
                    <a href="<?php echo home_url('/terms/'); ?>">شروط الاستخدام</a>
                    <a href="<?php echo home_url('/sitemap/'); ?>">خريطة الموقع</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- زر العودة للأعلى -->
<button id="back-to-top" class="back-to-top-btn" title="العودة للأعلى">
    <i class="fas fa-arrow-up"></i>
    <div class="btn-glow"></div>
</button>

<!-- نافذة التقييم والتحميل -->
<div id="rating-modal" class="rating-modal">
    <div class="modal-background"></div>
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">تقييم القالب</h3>
            <button class="modal-close" id="modal-close">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="modal-body">
            <div class="theme-info">
                <div class="theme-preview-small">
                    <img src="" alt="" id="modal-theme-image">
                </div>
                <div class="theme-details">
                    <h4 id="modal-theme-title"></h4>
                    <p id="modal-theme-description"></p>
                </div>
            </div>
            
            <div class="rating-section">
                <p class="rating-label">قيم هذا القالب:</p>
                <div class="rating-stars" id="rating-stars">
                    <i class="far fa-star" data-rating="1"></i>
                    <i class="far fa-star" data-rating="2"></i>
                    <i class="far fa-star" data-rating="3"></i>
                    <i class="far fa-star" data-rating="4"></i>
                    <i class="far fa-star" data-rating="5"></i>
                </div>
                <p class="rating-text" id="rating-text">اختر تقييمك</p>
            </div>
        </div>
        
        <div class="modal-footer">
            <button class="btn-secondary" id="skip-rating">تخطي التقييم</button>
            <button class="btn-primary" id="submit-rating" disabled>
                <i class="fas fa-download"></i>
                <span>تقييم وتحميل</span>
            </button>
        </div>
    </div>
</div>

<!-- Toast Notifications Container -->
<div id="toast-container" class="toast-container"></div>

<style>
/* 🎨 أنماط الصفحة الرئيسية الشاملة */

/* إعادة تعيين وإعدادات أساسية */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

html {
    scroll-behavior: smooth;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

body {
    font-family: 'Cairo', 'Tajawal', sans-serif;
    line-height: 1.6;
    color: #ffffff;
    background: #000011;
    overflow-x: hidden;
    position: relative;
}

/* متغيرات CSS */
:root {
    --primary-color: #3b82f6;
    --secondary-color: #8b5cf6;
    --accent-color: #ec4899;
    --success-color: #10b981;
    --warning-color: #f59e0b;
    --danger-color: #ef4444;
    --dark-bg: #000011;
    --dark-surface: #1a1a2e;
    --light-bg: #f8fafc;
    --light-surface: #ffffff;
    --text-light: #ffffff;
    --text-dark: #1e293b;
    --border-light: rgba(255, 255, 255, 0.1);
    --border-dark: rgba(0, 0, 0, 0.1);
    --shadow-light: rgba(59, 130, 246, 0.2);
    --shadow-dark: rgba(0, 0, 0, 0.3);
}

/* شاشة التحميل المحسنة */
.loading-screen {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #000011 0%, #1a1a2e 50%, #16213e 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    z-index: 999999;
    transition: opacity 1s ease, visibility 1s ease;
}

.loading-screen.hidden {
    opacity: 0;
    visibility: hidden;
}

.loader-container {
    text-align: center;
}

.loader {
    width: 80px;
    height: 80px;
    border: 4px solid rgba(59, 130, 246, 0.2);
    border-left: 4px solid var(--primary-color);
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin-bottom: 2rem;
}

.loading-text h3 {
    font-size: 1.5rem;
    margin-bottom: 0.5rem;
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.loading-text p {
    color: #b8b9ba;
    font-size: 1rem;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
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

/* خلفية Parallax المتقدمة */
.parallax-background {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 2;
    pointer-events: none;
    overflow: hidden;
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

.parallax-layer:nth-child(1) { animation-delay: 0s; background-size: 30px 30px; }
.parallax-layer:nth-child(2) { animation-delay: -7s; background-size: 45px 45px; }
.parallax-layer:nth-child(3) { animation-delay: -14s; background-size: 60px 60px; }

.cosmic-grid {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: 
        linear-gradient(rgba(59, 130, 246, 0.05) 1px, transparent 1px),
        linear-gradient(90deg, rgba(59, 130, 246, 0.05) 1px, transparent 1px);
    background-size: 100px 100px;
    animation: gridMove 30s linear infinite;
}

@keyframes parallaxFloat {
    0%, 100% { transform: translate(0, 0) rotate(0deg); }
    25% { transform: translate(-10px, -10px) rotate(1deg); }
    50% { transform: translate(10px, -5px) rotate(-1deg); }
    75% { transform: translate(-5px, 10px) rotate(0.5deg); }
}

@keyframes gridMove {
    0% { transform: translate(0, 0); }
    100% { transform: translate(100px, 100px); }
}

/* البوابة السينمائية المحسنة */
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
    background: radial-gradient(circle at center, transparent 0%, rgba(0, 0, 17, 0.8) 70%);
    animation: portalBackgroundPulse 2s ease-in-out infinite alternate;
    overflow: hidden;
}

.energy-waves {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 200px;
    height: 200px;
    margin: -100px 0 0 -100px;
    border: 2px solid rgba(59, 130, 246,0.3);
    border-radius: 50%;
    animation: energyWaves 3s ease-in-out infinite;
}

.plasma-field {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: radial-gradient(circle, rgba(139, 92, 246, 0.1) 0%, transparent 50%);
    animation: plasmaField 4s ease-in-out infinite alternate;
}

@keyframes energyWaves {
    0%, 100% { transform: scale(1); opacity: 0.3; }
    50% { transform: scale(1.5); opacity: 0.7; }
}

@keyframes plasmaField {
    0% { opacity: 0.1; }
    100% { opacity: 0.3; }
}

.portal-wave {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    background: radial-gradient(circle, rgba(59, 130, 246, 0.3) 0%, rgba(139, 92, 246, 0.2) 50%, transparent 100%);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    transition: all 2s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.portal-wave.expanding {
    width: 300vw;
    height: 300vw;
}

/* العناصر العائمة المحسنة */
.floating-elements {
    position: absolute;
    width: 100%;
    height: 100%;
    pointer-events: none;
}

.floating-icon,
.floating-letter {
    position: absolute;
    font-size: 2rem;
    color: rgba(59, 130, 246, 0.7);
    animation: floatToCenter 3s ease-in-out;
    opacity: 0;
    pointer-events: none;
    text-shadow: 0 0 20px currentColor;
}

.floating-letter {
    font-family: 'Cairo', sans-serif;
    font-weight: 800;
    color: rgba(139, 92, 246, 0.6);
}

.tech-icon:nth-child(1) { top: 20%; left: 10%; }
.tech-icon:nth-child(2) { top: 30%; right: 15%; }
.tech-icon:nth-child(3) { bottom: 20%; left: 20%; }
.tech-icon:nth-child(4) { bottom: 30%; right: 10%; }
.tech-icon:nth-child(5) { top: 15%; left: 50%; }
.tech-icon:nth-child(6) { bottom: 15%; left: 50%; }
.tech-icon:nth-child(7) { top: 25%; right: 30%; }
.tech-icon:nth-child(8) { bottom: 25%; right: 40%; }

.arabic-letter:nth-child(9) { top: 25%; left: 30%; }
.arabic-letter:nth-child(10) { top: 35%; right: 25%; }
.arabic-letter:nth-child(11) { bottom: 25%; left: 35%; }
.arabic-letter:nth-child(12) { bottom: 35%; right: 30%; }
.arabic-letter:nth-child(13) { top: 10%; right: 50%; }
.arabic-letter:nth-child(14) { top: 45%; left: 15%; }
.arabic-letter:nth-child(15) { bottom: 45%; right: 15%; }
.arabic-letter:nth-child(16) { top: 60%; left: 60%; }
.arabic-letter:nth-child(17) { bottom: 60%; left: 40%; }
.arabic-letter:nth-child(18) { top: 70%; right: 60%; }

/* مركز البوابة المحسن */
.portal-center {
    position: relative;
    z-index: 10;
    opacity: 0;
    transform: scale(0);
    animation: portalCenterAppear 2s ease-out 0.5s forwards;
}

.portal-rings {
    position: relative;
    width: 350px;
    height: 350px;
}

.ring {
    position: absolute;
    border: 2px solid;
    border-radius: 50%;
    animation: ringRotate linear infinite;
    box-shadow: 0 0 20px currentColor;
}

.ring-1 {
    width: 80px;
    height: 80px;
    top: 50%;
    left: 50%;
    margin: -40px 0 0 -40px;
    border-color: #3b82f6;
    animation-duration: 2s;
}

.ring-2 {
    width: 120px;
    height: 120px;
    top: 50%;
    left: 50%;
    margin: -60px 0 0 -60px;
    border-color: #8b5cf6;
    animation-duration: 3s;
    animation-direction: reverse;
}

.ring-3 {
    width: 160px;
    height: 160px;
    top: 50%;
    left: 50%;
    margin: -80px 0 0 -80px;
    border-color: #ec4899;
    animation-duration: 4s;
}

.ring-4 {
    width: 200px;
    height: 200px;
    top: 50%;
    left: 50%;
    margin: -100px 0 0 -100px;
    border-color: #f59e0b;
    animation-duration: 5s;
    animation-direction: reverse;
}

.ring-5 {
    width: 240px;
    height: 240px;
    top: 50%;
    left: 50%;
    margin: -120px 0 0 -120px;
    border-color: #10b981;
    animation-duration: 6s;
}

.portal-core {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 80px;
    height: 80px;
    margin: -40px 0 0 -40px;
    background: linear-gradient(45deg, #3b82f6, #8b5cf6);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2rem;
    animation: portalCorePulse 1s ease-in-out infinite alternate;
    box-shadow: 0 0 40px rgba(59, 130, 246, 0.8);
    overflow: hidden;
}

.core-inner {
    position: relative;
    z-index: 2;
}

.energy-pulse {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.3) 0%, transparent 70%);
    border-radius: 50%;
    animation: energyPulse 2s ease-in-out infinite;
}

@keyframes energyPulse {
    0%, 100% { transform: scale(0.8); opacity: 0.3; }
    50% { transform: scale(1.2); opacity: 0.7; }
}

/* نص البوابة المحسن */
.portal-text {
    margin-top: 3rem;
    text-align: center;
    opacity: 0;
    animation: portalTextAppear 1s ease-out 1s forwards;
}

.portal-title {
    font-size: 2rem;
    margin-bottom: 1.5rem;
    background: linear-gradient(45deg, #3b82f6, #8b5cf6);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    text-shadow: 0 0 30px rgba(59, 130, 246, 0.5);
}

.loading-progress {
    width: 350px;
    height: 6px;
    background: rgba(59, 130, 246, 0.2);
    border-radius: 3px;
    margin: 0 auto 1rem;
    overflow: hidden;
    position: relative;
}

.progress-bar {
    width: 0%;
    height: 100%;
    background: linear-gradient(90deg, #3b82f6, #8b5cf6);
    border-radius: 3px;
    animation: progressLoad 2s ease-out;
    position: relative;
}

.progress-glow {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    animation: progressGlow 1.5s ease-in-out infinite;
}

@keyframes progressGlow {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

.portal-subtitle {
    color: #b8b9ba;
    font-size: 1.1rem;
    font-weight: 500;
}

/* التأثيرات الإضافية */
.portal-effects {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
}

.lightning-effect {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 2px;
    height: 100px;
    background: linear-gradient(to bottom, transparent, #3b82f6, transparent);
    transform: translate(-50%, -50%);
    animation: lightning 4s ease-in-out infinite;
}

.stardust-trail {
    position: absolute;
    top: 30%;
    left: 20%;
    width: 200px;
    height: 2px;
    background: linear-gradient(to right, transparent, #8b5cf6, transparent);
    animation: stardustTrail 3s ease-in-out infinite;
}

.quantum-field {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: 
        radial-gradient(circle at 20% 50%, rgba(59, 130, 246, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(139, 92, 246, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 40% 80%, rgba(236, 72, 153, 0.1) 0%, transparent 50%);
    animation: quantumField 5s ease-in-out infinite;
}

@keyframes lightning {
    0%, 90%, 100% { opacity: 0; }
    5%, 85% { opacity: 1; transform: translate(-50%, -50%) scaleY(1); }
    10%, 80% { opacity: 0.5; transform: translate(-50%, -50%) scaleY(1.2); }
}

@keyframes stardustTrail {
    0% { transform: translateX(-100%) rotate(-15deg); opacity: 0; }
    50% { opacity: 1; }
    100% { transform: translateX(300px) rotate(-15deg); opacity: 0; }
}

@keyframes quantumField {
    0%, 100% { opacity: 0.3; }
    50% { opacity: 0.6; }
}

/* التنقل العلوي */
.main-navigation {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    background: rgba(26, 26, 46, 0.9);
    backdrop-filter: blur(20px);
    border-bottom: 1px solid rgba(59, 130, 246, 0.2);
    z-index: 1000;
    transition: all 0.3s ease;
    padding: 1rem 0;
}

.main-navigation.scrolled {
    padding: 0.5rem 0;
    background: rgba(26, 26, 46, 0.95);
}

.nav-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 2rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.nav-brand {
    display: flex;
    align-items: center;
}

.brand-link {
    display: flex;
    align-items: center;
    text-decoration: none;
    color: #ffffff;
    transition: all 0.3s ease;
}

.brand-link:hover {
    transform: scale(1.05);
}

.brand-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-left: 1rem;
    box-shadow: 0 5px 15px rgba(59, 130, 246, 0.3);
}

.brand-icon i {
    font-size: 1.5rem;
    color: white;
}

.brand-text h3 {
    font-size: 1.3rem;
    font-weight: 700;
    margin: 0;
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.brand-name {
    display: block;
}

.brand-tagline {
    display: block;
    font-size: 0.8rem;
    color: #b8b9ba;
    font-weight: 400;
}

.nav-menu {
    display: flex;
    align-items: center;
}

.nav-list {
    display: flex;
    list-style: none;
    margin: 0;
    padding: 0;
    gap: 2rem;
}

.nav-item {
    position: relative;
}

.nav-link {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    text-decoration: none;
    color: #b8b9ba;
    font-weight: 500;
    padding: 0.5rem 1rem;
    border-radius: 25px;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.nav-link::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.2), transparent);
    transition: left 0.5s ease;
}

.nav-link:hover::before {
    left: 100%;
}

.nav-link:hover,
.nav-item.active .nav-link {
    color: #ffffff;
    background: rgba(59, 130, 246, 0.1);
    border: 1px solid rgba(59, 130, 246, 0.3);
}

.nav-actions {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.search-toggle,
.menu-toggle {
    width: 45px;
    height: 45px;
    background: rgba(59, 130, 246, 0.1);
    border: 1px solid rgba(59, 130, 246, 0.3);
    border-radius: 50%;
    color: #ffffff;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.search-toggle:hover,
.menu-toggle:hover {
    background: rgba(59, 130, 246, 0.2);
    transform: scale(1.1);
}

.menu-toggle {
    flex-direction: column;
    gap: 3px;
    padding: 0;
}

.menu-toggle span {
    width: 18px;
    height: 2px;
    background: #ffffff;
    border-radius: 1px;
    transition: all 0.3s ease;
}

.menu-toggle.active span:nth-child(1) {
    transform: translateY(5px) rotate(45deg);
}

.menu-toggle.active span:nth-child(2) {
    opacity: 0;
}

.menu-toggle.active span:nth-child(3) {
    transform: translateY(-5px) rotate(-45deg);
}

/* قائمة البحث */
.search-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 17, 0.95);
    backdrop-filter: blur(20px);
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.search-overlay.active {
    opacity: 1;
    visibility: visible;
}

.search-container {
    position: relative;
    max-width: 600px;
    width: 90%;
}

.search-form {
    position: relative;
}

.search-input {
    width: 100%;
    padding: 1.5rem 5rem 1.5rem 2rem;
    font-size: 1.5rem;
    background: rgba(26, 26, 46, 0.9);
    border: 2px solid rgba(59, 130, 246, 0.3);
    border-radius: 50px;
    color: #ffffff;
    outline: none;
    transition: all 0.3s ease;
}

.search-input:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 30px rgba(59, 130, 246, 0.3);
}

.search-input::placeholder {
    color: #b8b9ba;
}

.search-submit {
    position: absolute;
    left: 10px;
    top: 50%;
    transform: translateY(-50%);
    width: 50px;
    height: 50px;
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    border: none;
    border-radius: 50%;
    color: white;
    cursor: pointer;
    transition: all 0.3s ease;
}

.search-submit:hover {
    transform: translateY(-50%) scale(1.1);
}

.search-close {
    position: absolute;
    top: -60px;
    left: 20px;
    width: 50px;
    height: 50px;
    background: transparent;
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    color: #ffffff;
    cursor: pointer;
    transition: all 0.3s ease;
}

.search-close:hover {
    background: rgba(255, 255, 255, 0.1);
    transform: scale(1.1);
}

/* الصفحة الرئيسية */
.main-content {
    position: relative;
    z-index: 10;
}

.homepage-focused {
    min-height: 100vh;
    background: linear-gradient(135deg, #000011 0%, #1a1a2e 50%, #16213e 100%);
    color: #ffffff;
}

/* Hero Section المحسن */
.hero-section-fullscreen {
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    overflow: hidden;
    padding-top: 100px;
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
        radial-gradient(1px 1px at 130px 80px, rgba(236, 72, 153, 0.4), transparent),
        radial-gradient(1px 1px at 160px 30px, rgba(245, 158, 11, 0.3), transparent);
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

.meteor-shower {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.meteor-shower::before,
.meteor-shower::after {
    content: '';
    position: absolute;
    width: 2px;
    height: 80px;
    background: linear-gradient(to bottom, rgba(59, 130, 246, 0.8), transparent);
    animation: meteorFall 8s linear infinite;
}

.meteor-shower::before {
    top: -80px;
    left: 20%;
    animation-delay: 0s;
}

.meteor-shower::after {
    top: -80px;
    left: 80%;
    animation-delay: 4s;
}

@keyframes meteorFall {
    0% { transform: translateY(-80px) translateX(0); opacity: 1; }
    100% { transform: translateY(100vh) translateX(-100px); opacity: 0; }
}

/* Container مركز */
.container-centered {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 2rem;
    position: relative;
    z-index: 10;
}

.hero-content-main {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
}

/* العنوان المتحرك المحسن */
.animated-title-container {
    margin-bottom: 3rem;
    position: relative;
}

.title-decoration {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1rem;
}

.title-decoration.bottom {
    margin-bottom: 0;
    margin-top: 1rem;
}

.title-line {
    width: 100px;
    height: 2px;
    background: linear-gradient(90deg, transparent, var(--primary-color), transparent);
    position: relative;
}

.title-spark {
    width: 8px;
    height: 8px;
    background: var(--primary-color);
    border-radius: 50%;
    margin: 0 1rem;
    box-shadow: 0 0 20px var(--primary-color);
    animation: sparkle 2s ease-in-out infinite;
}

@keyframes sparkle {
    0%, 100% { transform: scale(1); opacity: 0.5; }
    50% { transform: scale(1.5); opacity: 1; }
}

.hero-title-mega {
    font-size: clamp(3rem, 8vw, 6rem);
    font-weight: 800;
    line-height: 1.2;
    margin-bottom: 0;
    position: relative;
}

.title-static {
    display: block;
    color: #b8b9ba;
    font-size: clamp(1.5rem, 4vw, 2.5rem);
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
    border-left: 2px solid transparent;
    text-shadow: 0 0 30px rgba(59, 130, 246, 0.3);
}

.title-cursor {
    color: var(--primary-color);
    animation: blink 1s infinite;
    margin-right: 5px;
    text-shadow: 0 0 10px currentColor;
}

/* النص السحري المحسن */
.hero-description-enhanced {
    font-size: clamp(1.2rem, 3vw, 1.8rem);
    line-height: 1.8;
    margin-bottom: 4rem;
    max-width: 900px;
    margin-left: auto;
    margin-right: auto;
}

.magic-word {
    display: inline-block;
    opacity: 0;
    animation: magicAppear 0.8s ease forwards;
    margin: 0 0.4rem;
    position: relative;
    transition: all 0.3s ease;
}

.magic-word:hover {
    color: var(--primary-color);
    transform: scale(1.1);
    text-shadow: 0 0 10px currentColor;
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
.magic-word:nth-child(11) { animation-delay: 4s; }

.magic-word::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, transparent, rgba(59, 130, 246, 0.3), transparent);
    transform: translateX(-100%);
    animation: shimmer 3s ease infinite;
    animation-delay: inherit;
    border-radius: 4px;
}

/* الأزرار المحسنة */
.hero-actions-enhanced {
    display: flex;
    gap: 2rem;
    justify-content: center;
    align-items: center;
    margin-bottom: 5rem;
    flex-wrap: wrap;
}

.cinematic-portal-btn-main {
    position: relative;
    background: transparent;
    border: none;
    padding: 0;
    cursor: pointer;
    border-radius: 50px;
    overflow: hidden;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    outline: none;
}

.btn-background {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    border-radius: 50px;
    overflow: hidden;
}

.btn-gradient {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, #3b82f6, #8b5cf6, #ec4899, #f59e0b);
    background-size: 400% 400%;
    animation: gradientShift 4s ease infinite;
}

.btn-particles-bg {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: radial-gradient(circle at 50% 50%, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
    background-size: 20px 20px;
    animation: particlesBgMove 10s linear infinite;
}

.btn-energy-field {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
    animation: energyField 3s ease-in-out infinite;
}

@keyframes energyField {
    0%, 100% { opacity: 0.1; transform: scale(1); }
    50% { opacity: 0.3; transform: scale(1.05); }
}

.btn-content {
    position: relative;
    z-index: 2;
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 2rem 4rem;
    background: rgba(0, 0, 17, 0.9);
    margin: 3px;
    border-radius: 47px;
    transition: all 0.3s ease;
    font-size: 1.4rem;
    font-weight: 700;
    color: #ffffff;
}

.btn-icon {
    font-size: 1.8rem;
    animation: iconFloat 2s ease-in-out infinite alternate;
}

.btn-ripple-effect {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.3) 0%, transparent 70%);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    transition: all 0.6s ease;
    pointer-events: none;
}

.btn-aura {
    position: absolute;
    top: -15px;
    left: -15px;
    right: -15px;
    bottom: -15px;
    background: radial-gradient(circle, rgba(59, 130, 246, 0.3) 0%, transparent 70%);
    border-radius: 50px;
    opacity: 0;
    animation: auraGlow 3s ease-in-out infinite;
}

.btn-glow {
    position: absolute;
    top: -20px;
    left: -20px;
    right: -20px;
    bottom: -20px;
    background: conic-gradient(from 0deg, rgba(59, 130, 246, 0.2), rgba(139, 92, 246, 0.2), rgba(236, 72, 153, 0.2), rgba(59, 130, 246, 0.2));
    border-radius: 50px;
    opacity: 0;
    animation: glowRotate 4s linear infinite;
}

@keyframes glowRotate {
    0% { transform: rotate(0deg); opacity: 0; }
    50% { opacity: 0.3; }
    100% { transform: rotate(360deg); opacity: 0; }
}

/* الزر الثانوي */
.btn-secondary-cosmic {
    position: relative;
    display: inline-flex;
    align-items: center;
    gap: 0.8rem;
    padding: 0;
    text-decoration: none;
    color: #ffffff;
    font-weight: 600;
    font-size: 1.2rem;
    border-radius: 50px;
    overflow: hidden;
    transition: all 0.3s ease;
    border: 2px solid rgba(59, 130, 246, 0.3);
}

.btn-secondary-bg {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(59, 130, 246, 0.1);
    transition: all 0.3s ease;
}

.btn-secondary-text {
    position: relative;
    z-index: 2;
    display: flex;
    align-items: center;
    gap: 0.8rem;
    padding: 1.5rem 3rem;
    transition: all 0.3s ease;
}

.btn-secondary-ripple {
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

.btn-secondary-cosmic:hover {
    transform: translateY(-5px);
    border-color: var(--primary-color);
    box-shadow: 0 20px 40px rgba(59, 130, 246, 0.3);
}

.btn-secondary-cosmic:hover .btn-secondary-bg {
    background: rgba(59, 130, 246, 0.2);
}

/* تأثيرات هوفر الزر الرئيسي */
.cinematic-portal-btn-main:hover {
    transform: translateY(-10px) scale(1.05);
    box-shadow: 0 30px 80px rgba(59, 130, 246, 0.4);
}

.cinematic-portal-btn-main:hover .btn-content {
    background: rgba(0, 0, 17, 0.7);
}

.cinematic-portal-btn-main:hover .btn-aura {
    opacity: 1;
}

.cinematic-portal-btn-main:active .btn-ripple-effect {
    width: 400px;
    height: 400px;
}

/* إحصائيات ضخمة محسنة */
.hero-stats-enhanced {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 2rem;
    margin-bottom: 4rem;
    max-width: 1000px;
    margin-left: auto;
    margin-right: auto;
}

.stat-item-mega {
    text-align: center;
    background: rgba(26, 26, 46, 0.7);
    padding: 3rem 2rem;
    border-radius: 25px;
    border: 2px solid rgba(59, 130, 246, 0.3);
    backdrop-filter: blur(20px);
    position: relative;
    overflow: hidden;
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
}

.stat-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.stat-glow-bg {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 100px;
    height: 100px;
    background: radial-gradient(circle, rgba(59, 130, 246, 0.1) 0%, transparent 70%);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    transition: all 0.5s ease;
}

.stat-particle-field {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: radial-gradient(circle at 30% 40%, rgba(59, 130, 246, 0.05) 1px, transparent 1px);
    background-size: 20px 20px;
    animation: particleFieldMove 20s linear infinite;
}

@keyframes particleFieldMove {
    0% { transform: translate(0, 0); }
    100% { transform: translate(20px, 20px); }
}

.stat-content {
    position: relative;
    z-index: 2;
}

.stat-item-mega::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.1), transparent);
    transition: left 1s ease;
}

.stat-item-mega:hover::before {
    left: 100%;
}

.stat-item-mega:hover {
    transform: translateY(-20px) scale(1.05);
    box-shadow: 0 40px 100px rgba(59, 130, 246, 0.4);
    border-color: var(--primary-color);
}

.stat-item-mega:hover .stat-glow-bg {
    width: 200px;
    height: 200px;
    opacity: 0.3;
}

.stat-icon-enhanced {
    font-size: 3.5rem;
    margin-bottom: 1.5rem;
    background: linear-gradient(45deg, #3b82f6, #8b5cf6);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: iconPulse 3s ease-in-out infinite;
    filter: drop-shadow(0 0 10px rgba(59, 130, 246, 0.3));
}

.stat-number-huge {
    display: block;
    font-size: 4rem;
    font-weight: 900;
    background: linear-gradient(45deg, #3b82f6, #8b5cf6);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    line-height: 1;
    margin-bottom: 1rem;
    text-shadow: 0 0 20px rgba(59, 130, 246, 0.3);
}

.stat-label-enhanced {
    display: block;
    color: #b8b9ba;
    font-weight: 600;
    font-size: 1.3rem;
    text-transform: uppercase;
    letter-spacing: 1px;
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
    width: 300px;
    height: 300px;
    opacity: 1;
}

/* الميزات السريعة */
.quick-features {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 3rem;
    margin-bottom: 4rem;
    flex-wrap: wrap;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 0.8rem;
    padding: 1rem 1.5rem;
    background: rgba(26, 26, 46, 0.5);
    border: 1px solid rgba(59, 130, 246, 0.2);
    border-radius: 50px;
    backdrop-filter: blur(10px);
    transition: all 0.3s ease;
    cursor: pointer;
}

.feature-item:hover {
    transform: translateY(-5px);
    border-color: var(--primary-color);
    box-shadow: 0 10px 30px rgba(59, 130, 246, 0.2);
}

.feature-icon {
    width: 40px;
    height: 40px;
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
}

.feature-text {
    font-weight: 600;
    color: #ffffff;
    white-space: nowrap;
}

/* نص التذييل المحسن */
.hero-footer-text {
    margin-top: 4rem;
    opacity: 0;
    animation: fadeInUp 1s ease 5s both;
}

.slogan-container {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1.5rem;
    margin-bottom: 3rem;
}

.slogan-decoration {
    color: #fbbf24;
    font-size: 1.5rem;
    animation: starTwinkle 2s ease-in-out infinite alternate;
}

.slogan-text {
    font-size: 1.5rem;
    color: #b8b9ba;
    font-weight: 600;
    text-align: center;
    background: linear-gradient(45deg, #b8b9ba, #ffffff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.scroll-indicator {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

.scroll-indicator:hover {
    transform: translateY(-5px);
}

.scroll-arrow {
    width: 50px;
    height: 50px;
    border: 2px solid rgba(59, 130, 246, 0.5);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary-color);
    animation: scrollBounce 2s ease-in-out infinite;
}

.scroll-text {
    color: #b8b9ba;
    font-size: 0.9rem;
    font-weight: 500;
}

@keyframes scrollBounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

/* أشكال خلفية إضافية متطورة */
.floating-shapes-enhanced {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: 3;
}

.floating-shape {
    position: absolute;
    border-radius: 50%;
    background: linear-gradient(45deg, rgba(59, 130, 246, 0.1), rgba(139, 92, 246, 0.1));
    animation: shapeFloat 20s ease-in-out infinite;
    filter: blur(1px);
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

.shape-5 {
    width: 100px;
    height: 100px;
    top: 50%;
    left: 20%;
    animation-delay: -20s;
}

.shape-6 {
    width: 140px;
    height: 140px;
    top: 60%;
    right: 25%;
    animation-delay: -25s;
}

/* القوالب المميزة */
.featured-themes-section {
    padding: 8rem 0;
    position: relative;
    background: linear-gradient(135deg, rgba(26, 26, 46, 0.5) 0%, rgba(16, 21, 62, 0.5) 100%);
}

.container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 2rem;
}

.section-header {
    text-align: center;
    margin-bottom: 5rem;
}

.section-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    background: rgba(59, 130, 246, 0.1);
    border: 1px solid rgba(59, 130, 246, 0.3);
    border-radius: 50px;
    color: var(--primary-color);
    font-weight: 600;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 1.5rem;
}

.section-title {
    font-size: clamp(2.5rem, 5vw, 4rem);
    font-weight: 800;
    margin-bottom: 1rem;
    background: linear-gradient(45deg, #ffffff, #b8b9ba);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.section-description {
    font-size: 1.3rem;
    color: #b8b9ba;
    max-width: 600px;
    margin: 0 auto 2rem;
    line-height: 1.6;
}

.section-decoration {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
}

.decoration-line {
    width: 60px;
    height: 2px;
    background: linear-gradient(90deg, transparent, var(--primary-color), transparent);
}

.decoration-dot {
    width: 8px;
    height: 8px;
    background: var(--primary-color);
    border-radius: 50%;
    box-shadow: 0 0 20px var(--primary-color);
}

.themes-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 3rem;
    margin-bottom: 4rem;
}

.theme-card {
    background: rgba(26, 26, 46, 0.8);
    border: 1px solid rgba(59, 130, 246, 0.2);
    border-radius: 20px;
    overflow: hidden;
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    backdrop-filter: blur(20px);
}

.featured-card {
    border: 2px solid rgba(59, 130, 246, 0.4);
}

.card-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.card-glow {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 100px;
    height: 100px;
    background: radial-gradient(circle, rgba(59, 130, 246, 0.1) 0%, transparent 70%);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    transition: all 0.5s ease;
}

.card-particles {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: radial-gradient(circle at 20% 30%, rgba(59, 130, 246, 0.03) 1px, transparent 1px);
    background-size: 30px 30px;
    animation: cardParticles 15s linear infinite;
}

@keyframes cardParticles {
    0% { transform: translate(0, 0); }
    100% { transform: translate(30px, 30px); }
}

.theme-card:hover {
    transform: translateY(-10px) scale(1.02);
    border-color: var(--primary-color);
    box-shadow: 0 30px 80px rgba(59, 130, 246, 0.3);
}

.theme-card:hover .card-glow {
    width: 200px;
    height: 200px;
    opacity: 0.3;
}

.theme-badges {
    position: absolute;
    top: 1rem;
    right: 1rem;
    z-index: 10;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.badge {
    display: flex;
    align-items: center;
    gap: 0.3rem;
    padding: 0.4rem 0.8rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.badge-featured {
    background: linear-gradient(45deg, #f59e0b, #d97706);
    color: white;
    box-shadow: 0 5px 15px rgba(245, 158, 11, 0.3);
}

.badge-free {
    background: linear-gradient(45deg, #10b981, #059669);
    color: white;
    box-shadow: 0 5px 15px rgba(16, 185, 129, 0.3);
}

.theme-preview {
    position: relative;
    overflow: hidden;
    height: 250px;
}

.preview-container {
    position: relative;
    width: 100%;
    height: 100%;
}

.theme-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: all 0.5s ease;
}

.no-image {
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(139, 92, 246, 0.1));
    color: #b8b9ba;
}

.no-image i {
    font-size: 3rem;
    margin-bottom: 0.5rem;
    opacity: 0.5;
}

.preview-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.8), rgba(139, 92, 246, 0.8));
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: all 0.3s ease;
}

.theme-card:hover .preview-overlay {
    opacity: 1;
}

.theme-card:hover .theme-image {
    transform: scale(1.1);
}

.preview-actions {
    display: flex;
    gap: 1rem;
}

.preview-btn {
    width: 50px;
    height: 50px;
    background: rgba(255, 255, 255, 0.2);
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.preview-btn:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: scale(1.1);
    border-color: rgba(255, 255, 255, 0.5);
}

.theme-content {
    padding: 2rem;
    position: relative;
    z-index: 2;
}

.theme-title {
    margin-bottom: 1rem;
}

.theme-title a {
    color: #ffffff;
    text-decoration: none;
    font-size: 1.4rem;
    font-weight: 700;
    transition: all 0.3s ease;
    background: linear-gradient(45deg, #ffffff, #b8b9ba);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.theme-title a:hover {
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.theme-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
    gap: 1rem;
}

.theme-rating {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.rating-stars {
    display: flex;
    gap: 0.2rem;
}

.rating-stars i {
    color: #fbbf24;
    font-size: 0.9rem;
}

.rating-value {
    color: #b8b9ba;
    font-size: 0.9rem;
    font-weight: 500;
}

.theme-stats {
    display: flex;
    gap: 1rem;
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 0.3rem;
    color: #b8b9ba;
    font-size: 0.9rem;
}

.stat-item i {
    color: var(--primary-color);
}

.theme-excerpt {
    color: #b8b9ba;
    line-height: 1.5;
    margin-bottom: 1rem;
    font-size: 0.95rem;
}

.theme-categories {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
}

.category-tag {
    padding: 0.3rem 0.8rem;
    background: rgba(59, 130, 246, 0.1);
    border: 1px solid rgba(59, 130, 246, 0.3);
    border-radius: 15px;
    color: var(--primary-color);
    font-size: 0.8rem;
    font-weight: 500;
}

.theme-actions {
    display: flex;
    gap: 1rem;
    align-items: center;
}

.btn-primary {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 1rem 2rem;
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    border: none;
    border-radius: 25px;
    color: white;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 15px 40px rgba(59, 130, 246, 0.4);
}

.btn-secondary {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 1rem 1.5rem;
    background: transparent;
    border: 2px solid rgba(59, 130, 246, 0.3);
    border-radius: 25px;
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-secondary:hover {
    background: rgba(59, 130, 246, 0.1);
    border-color: var(--primary-color);
    transform: translateY(-2px);
}

.btn-ripple {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.3) 0%, transparent 70%);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    transition: all 0.6s ease;
    pointer-events: none;
}

.btn-primary:active .btn-ripple {
    width: 300px;
    height: 300px;
}

.section-footer {
    text-align: center;
}

.btn-view-all {
    display: inline-flex;
    align-items: center;
    gap: 1rem;
    padding: 1.5rem 3rem;
    background: rgba(26, 26, 46, 0.8);
    border: 2px solid rgba(59, 130, 246, 0.3);
    border-radius: 50px;
    color: #ffffff;
    text-decoration: none;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    backdrop-filter: blur(20px);
}

.btn-view-all:hover {
    transform: translateY(-5px);
    border-color: var(--primary-color);
    box-shadow: 0 20px 60px rgba(59, 130, 246, 0.3);
}

.btn-view-all .btn-glow {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, transparent, rgba(59, 130, 246, 0.1), transparent);
    transform: translateX(-100%);
    transition: transform 0.6s ease;
}

.btn-view-all:hover .btn-glow {
    transform: translateX(100%);
}

/* قسم التصنيفات */
.categories-section {
    padding: 8rem 0;
    position: relative;
}

.categories-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 

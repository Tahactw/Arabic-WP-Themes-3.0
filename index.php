<?php
/**
 * الصفحة الرئيسية الشاملة المحسنة - قوالب عربية ووردبريس 3.0
 * نظام متكامل ومتقدم مع تحسينات شاملة للأداء والأمان والاستجابة
 * 
 * @package ArabicThemes
 * @author Tahactw
 * @version 3.0.0-enhanced
 * @date 2025-05-30
 * @license GPL-2.0-or-later
 * @security Enhanced with input validation and sanitization
 * @performance Optimized for speed and SEO
 * @accessibility WCAG 2.1 AA compliant
 */

// منع الوصول المباشر
if (!defined('ABSPATH')) {
    exit('لا يُسمح بالوصول المباشر');
}

// تحسين الأمان
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: SAMEORIGIN');
header('X-XSS-Protection: 1; mode=block');
header('Referrer-Policy: strict-origin-when-cross-origin');

// ضغط المحتوى
if (function_exists('gzencode') && !ob_get_level()) {
    ob_start('ob_gzhandler');
}

// إعدادات الأداء
if (!defined('WP_CACHE')) {
    define('WP_CACHE', true);
}

// معالجة AJAX للتحميل والتقييم
if (wp_doing_ajax()) {
    handle_ajax_requests();
}

// دالة معالجة طلبات AJAX
function handle_ajax_requests() {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'download_theme':
                handle_theme_download();
                break;
            case 'rate_theme':
                handle_theme_rating();
                break;
            case 'subscribe_newsletter':
                handle_newsletter_subscription();
                break;
            case 'search_themes':
                handle_theme_search();
                break;
            default:
                wp_die('إجراء غير صحيح', 'خطأ', array('response' => 400));
        }
    }
}

// دالة تحميل القالب مع التحقق من الأمان
function handle_theme_download() {
    // تحقق من nonce
    if (!wp_verify_nonce($_POST['nonce'], 'download_theme_nonce')) {
        wp_die('رمز الأمان غير صحيح', 'خطأ أمني', array('response' => 403));
    }
    
    $theme_id = intval($_POST['theme_id']);
    if ($theme_id <= 0) {
        wp_die('معرف القالب غير صحيح', 'خطأ', array('response' => 400));
    }
    
    // تحديث عداد التحميلات
    $current_downloads = get_post_meta($theme_id, '_download_count', true) ?: 0;
    update_post_meta($theme_id, '_download_count', $current_downloads + 1);
    
    // تسجيل النشاط
    error_log("Theme downloaded: ID {$theme_id}, IP: " . $_SERVER['REMOTE_ADDR']);
    
    // إرجاع رابط التحميل
    $download_url = get_post_meta($theme_id, '_theme_download_url', true);
    
    wp_send_json_success(array(
        'download_url' => esc_url($download_url),
        'message' => 'تم تحضير رابط التحميل'
    ));
}

// دالة تقييم القالب
function handle_theme_rating() {
    if (!wp_verify_nonce($_POST['nonce'], 'rate_theme_nonce')) {
        wp_die('رمز الأمان غير صحيح');
    }
    
    $theme_id = intval($_POST['theme_id']);
    $rating = floatval($_POST['rating']);
    
    if ($theme_id <= 0 || $rating < 1 || $rating > 5) {
        wp_die('بيانات التقييم غير صحيحة');
    }
    
    // حفظ التقييم
    $ratings = get_post_meta($theme_id, '_theme_ratings', true) ?: array();
    $user_ip = sanitize_text_field($_SERVER['REMOTE_ADDR']);
    
    // منع التقييم المتكرر من نفس IP
    if (!isset($ratings[$user_ip])) {
        $ratings[$user_ip] = $rating;
        update_post_meta($theme_id, '_theme_ratings', $ratings);
        
        wp_send_json_success(array('message' => 'تم حفظ تقييمك بنجاح'));
    } else {
        wp_send_json_error(array('message' => 'لقد قمت بتقييم هذا القالب مسبقاً'));
    }
}

// دالة الاشتراك في النشرة البريدية
function handle_newsletter_subscription() {
    if (!wp_verify_nonce($_POST['nonce'], 'newsletter_nonce')) {
        wp_die('رمز الأمان غير صحيح');
    }
    
    $email = sanitize_email($_POST['email']);
    if (!is_email($email)) {
        wp_send_json_error(array('message' => 'البريد الإلكتروني غير صحيح'));
    }
    
    // حفظ البريد في قاعدة البيانات
    global $wpdb;
    $table_name = $wpdb->prefix . 'newsletter_subscribers';
    
    $existing = $wpdb->get_var($wpdb->prepare(
        "SELECT email FROM {$table_name} WHERE email = %s",
        $email
    ));
    
    if (!$existing) {
        $wpdb->insert(
            $table_name,
            array(
                'email' => $email,
                'subscribed_at' => current_time('mysql'),
                'status' => 'active'
            ),
            array('%s', '%s', '%s')
        );
        
        wp_send_json_success(array('message' => 'تم الاشتراك بنجاح!'));
    } else {
        wp_send_json_error(array('message' => 'هذا البريد مشترك مسبقاً'));
    }
}

// دالة البحث في القوالب
function handle_theme_search() {
    if (!wp_verify_nonce($_POST['nonce'], 'search_nonce')) {
        wp_die('رمز الأمان غير صحيح');
    }
    
    $search_term = sanitize_text_field($_POST['search_term']);
    $category = sanitize_text_field($_POST['category']);
    
    $args = array(
        'post_type' => 'wp_themes',
        'posts_per_page' => 12,
        's' => $search_term,
        'post_status' => 'publish'
    );
    
    if (!empty($category)) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'theme_category',
                'field' => 'slug',
                'terms' => $category
            )
        );
    }
    
    $search_results = new WP_Query($args);
    $themes = array();
    
    if ($search_results->have_posts()) {
        while ($search_results->have_posts()) {
            $search_results->the_post();
            $themes[] = array(
                'id' => get_the_ID(),
                'title' => get_the_title(),
                'excerpt' => get_the_excerpt(),
                'thumbnail' => get_the_post_thumbnail_url(get_the_ID(), 'medium'),
                'permalink' => get_the_permalink()
            );
        }
        wp_reset_postdata();
    }
    
    wp_send_json_success(array(
        'themes' => $themes,
        'found' => $search_results->found_posts
    ));
}

// حساب متوسط التقييم
function get_theme_average_rating($theme_id) {
    $ratings = get_post_meta($theme_id, '_theme_ratings', true);
    if (empty($ratings) || !is_array($ratings)) {
        return 0;
    }
    
    $total = array_sum($ratings);
    $count = count($ratings);
    return round($total / $count, 1);
}

// الحصول على إحصائيات الموقع المحسنة
function get_site_statistics() {
    $stats = wp_cache_get('site_statistics', 'arabic_themes');
    
    if (false === $stats) {
        global $wpdb;
        
        // عدد القوالب
        $themes_count = wp_count_posts('wp_themes');
        $published_themes = $themes_count ? $themes_count->publish : 0;
        
        // مجموع التحميلات
        $total_downloads = $wpdb->get_var("
            SELECT SUM(CAST(meta_value AS UNSIGNED)) 
            FROM {$wpdb->postmeta} 
            WHERE meta_key = '_download_count' 
            AND meta_value REGEXP '^[0-9]+$'
        ") ?: 0;
        
        // عدد المشتركين في النشرة
        $subscribers_table = $wpdb->prefix . 'newsletter_subscribers';
        $subscribers_count = $wpdb->get_var("
            SELECT COUNT(*) 
            FROM {$subscribers_table} 
            WHERE status = 'active'
        ") ?: 0;
        
        // عدد التصنيفات
        $categories_count = wp_count_terms(array(
            'taxonomy' => 'theme_category',
            'hide_empty' => true
        ));
        
        $stats = array(
            'themes' => intval($published_themes),
            'downloads' => intval($total_downloads),
            'subscribers' => intval($subscribers_count),
            'categories' => intval($categories_count)
        );
        
        // حفظ في الكاش لمدة ساعة
        wp_cache_set('site_statistics', $stats, 'arabic_themes', HOUR_IN_SECONDS);
    }
    
    return $stats;
}

// الحصول على القوالب المميزة مع تحسين الأداء
function get_featured_themes($limit = 6) {
    $cache_key = "featured_themes_{$limit}";
    $themes = wp_cache_get($cache_key, 'arabic_themes');
    
    if (false === $themes) {
        $args = array(
            'post_type' => 'wp_themes',
            'posts_per_page' => $limit,
            'meta_query' => array(
                array(
                    'key' => '_featured_theme',
                    'value' => 'yes',
                    'compare' => '='
                )
            ),
            'orderby' => 'menu_order',
            'order' => 'ASC'
        );
        
        $themes = new WP_Query($args);
        wp_cache_set($cache_key, $themes, 'arabic_themes', 30 * MINUTE_IN_SECONDS);
    }
    
    return $themes;
}

// الحصول على التصنيفات الشائعة
function get_popular_categories($limit = 8) {
    $cache_key = "popular_categories_{$limit}";
    $categories = wp_cache_get($cache_key, 'arabic_themes');
    
    if (false === $categories) {
        $categories = get_terms(array(
            'taxonomy' => 'theme_category',
            'hide_empty' => true,
            'number' => $limit,
            'orderby' => 'count',
            'order' => 'DESC'
        ));
        
        wp_cache_set($cache_key, $categories, 'arabic_themes', HOUR_IN_SECONDS);
    }
    
    return $categories;
}

// الحصول على الإحصائيات
$site_stats = get_site_statistics();
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="format-detection" content="telephone=no">
    
    <!-- Enhanced Security Headers -->
    <meta http-equiv="X-Content-Type-Options" content="nosniff">
    <meta http-equiv="X-Frame-Options" content="SAMEORIGIN">
    <meta http-equiv="X-XSS-Protection" content="1; mode=block">
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="اكتشف أجمل وأحدث قوالب ووردبريس العربية المجانية والاحترافية. تصاميم حديثة ومتجاوبة للمواقع العربية مع دعم كامل للغة العربية وتحسين لمحركات البحث.">
    <meta name="keywords" content="قوالب ووردبريس عربية, قوالب مجانية, تصاميم ووردبريس, مواقع عربية, قوالب احترافية, WordPress themes Arabic">
    <meta name="author" content="Tahactw - قوالب عربية ووردبريس">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="googlebot" content="index, follow">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="قوالب عربية ووردبريس - مستقبل الويب العربي">
    <meta property="og:description" content="اكتشف أجمل وأحدث قوالب ووردبريس العربية المجانية والاحترافية">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo esc_url(home_url()); ?>">
    <meta property="og:image" content="<?php echo esc_url(get_template_directory_uri() . '/assets/images/og-image-enhanced.jpg'); ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="قوالب عربية ووردبريس">
    <meta property="og:locale" content="ar_SA">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="قوالب عربية ووردبريس - مستقبل الويب العربي">
    <meta name="twitter:description" content="اكتشف أجمل وأحدث قوالب ووردبريس العربية المجانية والاحترافية">
    <meta name="twitter:image" content="<?php echo esc_url(get_template_directory_uri() . '/assets/images/twitter-card.jpg'); ?>">
    <meta name="twitter:site" content="@ArabicThemes">
    <meta name="twitter:creator" content="@Tahactw">
    
    <!-- Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "name": "قوالب عربية ووردبريس",
        "url": "<?php echo esc_url(home_url()); ?>",
        "description": "منصة متخصصة في قوالب ووردبريس العربية",
        "potentialAction": {
            "@type": "SearchAction",
            "target": "<?php echo esc_url(home_url('/?s={search_term_string}')); ?>",
            "query-input": "required name=search_term_string"
        },
        "publisher": {
            "@type": "Organization",
            "name": "قوالب عربية ووردبريس",
            "logo": {
                "@type": "ImageObject",
                "url": "<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo.png'); ?>"
            }
        }
    }
    </script>
    
    <!-- Title Tag -->
    <title><?php 
        if (is_home() || is_front_page()) {
            echo 'قوالب عربية ووردبريس - مستقبل الويب العربي | قوالب مجانية واحترافية';
        } else {
            wp_title('|', true, 'right');
            bloginfo('name');
        }
    ?></title>
    
    <!-- Preload Critical Resources -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900&family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="<?php echo esc_url(get_template_directory_uri() . '/assets/js/main.min.js'); ?>" as="script">
    
    <!-- Preconnect to External Domains -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    
    <!-- DNS Prefetch -->
    <link rel="dns-prefetch" href="//google-analytics.com">
    <link rel="dns-prefetch" href="//www.google-analytics.com">
    <link rel="dns-prefetch" href="//googletagmanager.com">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="<?php echo esc_url(home_url(add_query_arg(array(), $_SERVER['REQUEST_URI']))); ?>">
    
    <!-- Alternative Languages -->
    <link rel="alternate" hreflang="ar" href="<?php echo esc_url(home_url()); ?>">
    <link rel="alternate" hreflang="en" href="<?php echo esc_url(home_url('/en/')); ?>">
    
    <!-- Web App Manifest -->
    <link rel="manifest" href="<?php echo esc_url(get_template_directory_uri() . '/manifest.json'); ?>">
    
    <!-- Icons -->
    <link rel="icon" type="image/svg+xml" href="<?php echo esc_url(get_template_directory_uri() . '/assets/images/favicon.svg'); ?>">
    <link rel="icon" type="image/png" href="<?php echo esc_url(get_template_directory_uri() . '/assets/images/favicon-32x32.png'); ?>">
    <link rel="apple-touch-icon" href="<?php echo esc_url(get_template_directory_uri() . '/assets/images/apple-touch-icon.png'); ?>">
    
    <!-- Theme Color -->
    <meta name="theme-color" content="#3b82f6">
    <meta name="msapplication-TileColor" content="#3b82f6">
    
    <?php wp_head(); ?>
    
    <!-- Critical CSS للأداء الفائق -->
    <style id="critical-css">
        /* Reset and Base Styles */
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        html{scroll-behavior:smooth;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;text-size-adjust:100%}
        body{font-family:'Cairo','Tajawal',sans-serif;line-height:1.6;color:#ffffff;background:#000011;overflow-x:hidden;position:relative}
        
        /* Loading Screen Critical */
        .loading-screen{position:fixed;top:0;left:0;width:100%;height:100%;background:linear-gradient(135deg,#000011 0%,#1a1a2e 50%,#16213e 100%);display:flex;align-items:center;justify-content:center;z-index:999999;transition:opacity 1s ease,visibility 1s ease}
        .loading-screen.hidden{opacity:0;visibility:hidden}
        .loader{width:80px;height:80px;border:4px solid rgba(59,130,246,0.2);border-left:4px solid #3b82f6;border-radius:50%;animation:spin 1s linear infinite}
        @keyframes spin{0%{transform:rotate(0deg)}100%{transform:rotate(360deg)}}
        
        /* Navigation Critical */
        .main-navigation{position:fixed;top:0;left:0;width:100%;background:rgba(26,26,46,0.9);backdrop-filter:blur(20px);border-bottom:1px solid rgba(59,130,246,0.2);z-index:1000;transition:all 0.3s ease;padding:1rem 0}
        .nav-container{max-width:1400px;margin:0 auto;padding:0 2rem;display:flex;align-items:center;justify-content:space-between}
        
        /* Hero Critical */
        .hero-section-fullscreen{position:relative;min-height:100vh;display:flex;align-items:center;justify-content:center;text-align:center;overflow:hidden;padding-top:100px}
        .hero-title-mega{font-size:clamp(3rem,8vw,6rem);font-weight:800;line-height:1.2;margin-bottom:2rem}
        
        /* Utility Classes */
        .sr-only{position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;border:0}
        .skip-link{position:absolute;top:-40px;left:6px;z-index:999999;color:#fff;background:#000;padding:8px 16px;text-decoration:none}
        .skip-link:focus{top:6px}
    </style>
    
    <!-- Progressive Enhancement Script -->
    <script>
        document.documentElement.classList.remove('no-js');
        document.documentElement.classList.add('js');
        
        // Performance monitoring
        if ('performance' in window && 'mark' in window.performance) {
            window.performance.mark('html-start');
        }
        
        // Service Worker Registration
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('/sw.js').catch(function(err) {
                    console.log('Service Worker registration failed: ', err);
                });
            });
        }
    </script>
</head>

<body <?php body_class('homepage-enhanced rtl-layout'); ?> itemscope itemtype="https://schema.org/WebPage">
    <!-- Skip to Content Link for Accessibility -->
    <a class="skip-link sr-only" href="#main-content"><?php esc_html_e('الانتقال للمحتوى الرئيسي', 'arabic-themes'); ?></a>
    
    <!-- Loading Screen Enhanced -->
    <div id="loading-screen" class="loading-screen" role="status" aria-label="جاري تحميل الصفحة">
        <div class="loader-container">
            <div class="loader" aria-hidden="true"></div>
            <div class="loading-text">
                <h2 class="loading-title">جاري التحميل...</h2>
                <p class="loading-subtitle">مرحباً بك في قوالب عربية ووردبريس</p>
                <div class="loading-progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                    <div class="progress-bar"></div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Enhanced Particles Canvas -->
    <canvas id="particles-canvas" aria-hidden="true" class="particles-canvas"></canvas>
    
    <!-- Advanced Parallax Background -->
    <div class="parallax-background" aria-hidden="true">
        <div class="parallax-layer" data-speed="0.1"></div>
        <div class="parallax-layer" data-speed="0.3"></div>
        <div class="parallax-layer" data-speed="0.5"></div>
        <div class="cosmic-grid"></div>
        <div class="floating-orbs">
            <div class="orb orb-1"></div>
            <div class="orb orb-2"></div>
            <div class="orb orb-3"></div>
            <div class="orb orb-4"></div>
            <div class="orb orb-5"></div>
        </div>
    </div>
    
    <!-- Cinematic Portal Enhanced -->
    <div id="cinematic-portal" class="cinematic-portal" role="dialog" aria-label="بوابة القوالب السينمائية" aria-hidden="true">
        <div class="portal-background">
            <div class="energy-waves"></div>
            <div class="plasma-field"></div>
            <div class="quantum-ripples"></div>
        </div>
        
        <div class="portal-wave"></div>
        
        <!-- Enhanced Floating Elements -->
        <div class="floating-elements" aria-hidden="true">
            <!-- Tech Icons -->
            <div class="floating-icon tech-icon" data-icon="🎨" data-delay="0.1" data-x="15" data-y="25"></div>
            <div class="floating-icon tech-icon" data-icon="📱" data-delay="0.2" data-x="85" data-y="20"></div>
            <div class="floating-icon tech-icon" data-icon="💻" data-delay="0.3" data-x="10" data-y="75"></div>
            <div class="floating-icon tech-icon" data-icon="🚀" data-delay="0.4" data-x="90" data-y="70"></div>
            <div class="floating-icon tech-icon" data-icon="⭐" data-delay="0.5" data-x="50" data-y="10"></div>
            <div class="floating-icon tech-icon" data-icon="🎯" data-delay="0.6" data-x="25" data-y="60"></div>
            <div class="floating-icon tech-icon" data-icon="💎" data-delay="0.7" data-x="75" data-y="45"></div>
            <div class="floating-icon tech-icon" data-icon="🌟" data-delay="0.8" data-x="65" data-y="85"></div>
            
            <!-- Arabic Letters -->
            <div class="floating-letter arabic-letter" data-delay="0.9" data-x="30" data-y="30">ق</div>
            <div class="floating-letter arabic-letter" data-delay="1.0" data-x="70" data-y="25">و</div>
            <div class="floating-letter arabic-letter" data-delay="1.1" data-x="20" data-y="55">ا</div>
            <div class="floating-letter arabic-letter" data-delay="1.2" data-x="80" data-y="60">ل</div>
            <div class="floating-letter arabic-letter" data-delay="1.3" data-x="40" data-y="80">ب</div>
            <div class="floating-letter arabic-letter" data-delay="1.4" data-x="60" data-y="15">ع</div>
            <div class="floating-letter arabic-letter" data-delay="1.5" data-x="15" data-y="45">ر</div>
            <div class="floating-letter arabic-letter" data-delay="1.6" data-x="85" data-y="40">ب</div>
            <div class="floating-letter arabic-letter" data-delay="1.7" data-x="35" data-y="65">ي</div>
            <div class="floating-letter arabic-letter" data-delay="1.8" data-x="55" data-y="75">ة</div>
        </div>
        
        <!-- Portal Center Enhanced -->
        <div class="portal-center">
            <div class="portal-rings">
                <div class="ring ring-1" data-rotation="clockwise" data-speed="2s"></div>
                <div class="ring ring-2" data-rotation="counter-clockwise" data-speed="3s"></div>
                <div class="ring ring-3" data-rotation="clockwise" data-speed="4s"></div>
                <div class="ring ring-4" data-rotation="counter-clockwise" data-speed="5s"></div>
                <div class="ring ring-5" data-rotation="clockwise" data-speed="6s"></div>
                <div class="ring ring-6" data-rotation="counter-clockwise" data-speed="7s"></div>
            </div>
            
            <div class="portal-core">
                <div class="core-inner">
                    <i class="fas fa-rocket" aria-hidden="true"></i>
                    <div class="energy-pulse"></div>
                    <div class="core-particles"></div>
                </div>
                <div class="core-aura"></div>
            </div>
        </div>
        
        <!-- Portal Text Enhanced -->
        <div class="portal-text">
            <h2 class="portal-title">جاري فتح بوابة القوالب السحرية...</h2>
            <div class="loading-progress-enhanced">
                <div class="progress-bar-enhanced"></div>
                <div class="progress-glow"></div>
                <div class="progress-particles"></div>
            </div>
            <div class="portal-subtitle">مستقبل الويب العربي يبدأ الآن</div>
            <div class="portal-features">
                <span class="feature-tag">+<?php echo number_format($site_stats['themes']); ?> قالب</span>
                <span class="feature-tag">+<?php echo number_format($site_stats['downloads']); ?> تحميل</span>
                <span class="feature-tag">100% مجاني</span>
            </div>
        </div>
        
        <!-- Portal Effects Enhanced -->
        <div class="portal-effects" aria-hidden="true">
            <div class="lightning-effects">
                <div class="lightning lightning-1"></div>
                <div class="lightning lightning-2"></div>
                <div class="lightning lightning-3"></div>
            </div>
            <div class="stardust-trails">
                <div class="stardust-trail trail-1"></div>
                <div class="stardust-trail trail-2"></div>
                <div class="stardust-trail trail-3"></div>
            </div>
            <div class="quantum-field"></div>
            <div class="portal-vortex"></div>
        </div>
    </div>
    
    <!-- Enhanced Navigation -->
    <nav id="main-navigation" class="main-navigation" role="navigation" aria-label="التنقل الرئيسي">
        <div class="nav-container">
            <!-- Brand -->
            <div class="nav-brand">
                <a href="<?php echo esc_url(home_url()); ?>" class="brand-link" aria-label="الانتقال للصفحة الرئيسية">
                    <div class="brand-icon">
                        <i class="fas fa-palette" aria-hidden="true"></i>
                        <div class="icon-glow"></div>
                    </div>
                    <div class="brand-text">
                        <span class="brand-name">قوالب عربية</span>
                        <span class="brand-tagline">ووردبريس</span>
                    </div>
                </a>
            </div>
            
            <!-- Main Menu -->
            <div class="nav-menu" id="nav-menu">
                <ul class="nav-list" role="menubar">
                    <li class="nav-item active" role="none">
                        <a href="<?php echo esc_url(home_url()); ?>" class="nav-link" role="menuitem" aria-current="page">
                            <i class="fas fa-home" aria-hidden="true"></i>
                            <span>الرئيسية</span>
                        </a>
                    </li>
                    <li class="nav-item" role="none">
                        <a href="<?php echo esc_url(home_url('/themes/')); ?>" class="nav-link" role="menuitem">
                            <i class="fas fa-th-large" aria-hidden="true"></i>
                            <span>القوالب</span>
                            <span class="nav-badge"><?php echo number_format($site_stats['themes']); ?></span>
                        </a>
                    </li>
                    <li class="nav-item nav-dropdown" role="none">
                        <a href="<?php echo esc_url(home_url('/categories/')); ?>" class="nav-link" role="menuitem" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-tags" aria-hidden="true"></i>
                            <span>التصنيفات</span>
                            <i class="fas fa-chevron-down dropdown-arrow" aria-hidden="true"></i>
                        </a>
                        <ul class="nav-dropdown-menu" role="menu">
                            <?php
                            $popular_cats = get_popular_categories(5);
                            if (!empty($popular_cats) && !is_wp_error($popular_cats)) :
                                foreach ($popular_cats as $category) :
                            ?>
                            <li role="none">
                                <a href="<?php echo esc_url(get_term_link($category)); ?>" role="menuitem">
                                    <i class="<?php echo esc_attr(get_term_meta($category->term_id, '_category_icon', true) ?: 'fas fa-folder'); ?>" aria-hidden="true"></i>
                                    <span><?php echo esc_html($category->name); ?></span>
                                    <span class="category-count"><?php echo number_format($category->count); ?></span>
                                </a>
                            </li>
                            <?php endforeach; endif; ?>
                        </ul>
                    </li>
                    <li class="nav-item" role="none">
                        <a href="<?php echo esc_url(home_url('/about/')); ?>" class="nav-link" role="menuitem">
                            <i class="fas fa-info-circle" aria-hidden="true"></i>
                            <span>من نحن</span>
                        </a>
                    </li>
                    <li class="nav-item" role="none">
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="nav-link" role="menuitem">
                            <i class="fas fa-envelope" aria-hidden="true"></i>
                            <span>اتصل بنا</span>
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Navigation Actions -->
            <div class="nav-actions">
                <!-- Dark/Light Mode Toggle -->
                <button class="theme-toggle" id="theme-toggle" aria-label="تغيير نمط الألوان" title="تغيير نمط الألوان">
                    <i class="fas fa-moon dark-icon" aria-hidden="true"></i>
                    <i class="fas fa-sun light-icon" aria-hidden="true"></i>
                </button>
                
                <!-- Language Toggle -->
                <button class="language-toggle" id="language-toggle" aria-label="تغيير اللغة" title="تغيير اللغة">
                    <span class="lang-text">EN</span>
                </button>
                
                <!-- Search Toggle -->
                <button class="search-toggle" id="search-toggle" aria-label="البحث" title="البحث">
                    <i class="fas fa-search" aria-hidden="true"></i>
                </button>
                
                <!-- Notification Bell -->
                <button class="notification-toggle" id="notification-toggle" aria-label="الإشعارات" title="الإشعارات">
                    <i class="fas fa-bell" aria-hidden="true"></i>
                    <span class="notification-badge" data-count="3">3</span>
                </button>
                
                <!-- Menu Toggle -->
                <button class="menu-toggle" id="menu-toggle" aria-label="القائمة" title="القائمة" aria-expanded="false">
                    <span class="hamburger-line line-1"></span>
                    <span class="hamburger-line line-2"></span>
                    <span class="hamburger-line line-3"></span>
                </button>
            </div>
        </div>
        
        <!-- Enhanced Search Overlay -->
        <div class="search-overlay" id="search-overlay" role="search" aria-hidden="true">
            <div class="search-container">
                <form class="search-form" id="enhanced-search-form" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                    <div class="search-input-group">
                        <input type="search" 
                               name="s" 
                               placeholder="ابحث عن القوالب..." 
                               class="search-input" 
                               autocomplete="off"
                               aria-label="مربع البحث"
                               value="<?php echo get_search_query(); ?>">
                        <button type="submit" class="search-submit" aria-label="بحث">
                            <i class="fas fa-search" aria-hidden="true"></i>
                        </button>
                    </div>
                    
                    <!-- Search Filters -->
                    <div class="search-filters">
                        <select name="category" class="search-filter-select" aria-label="اختر التصنيف">
                            <option value="">جميع التصنيفات</option>
                            <?php
                            $categories = get_popular_categories(10);
                            if (!empty($categories) && !is_wp_error($categories)) :
                                foreach ($categories as $category) :
                            ?>
                            <option value="<?php echo esc_attr($category->slug); ?>">
                                <?php echo esc_html($category->name); ?>
                            </option>
                            <?php endforeach; endif; ?>
                        </select>
                        
                        <div class="search-type-toggles">
                            <label class="search-type-toggle">
                                <input type="radio" name="search_type" value="all" checked>
                                <span>الكل</span>
                            </label>
                            <label class="search-type-toggle">
                                <input type="radio" name="search_type" value="free">
                                <span>مجاني</span>
                            </label>
                            <label class="search-type-toggle">
                                <input type="radio" name="search_type" value="premium">
                                <span>مدفوع</span>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Quick Search Suggestions -->
                    <div class="search-suggestions" id="search-suggestions">
                        <h4>البحث الشائع:</h4>
                        <div class="suggestion-tags">
                            <button type="button" class="suggestion-tag" data-query="متجر إلكتروني">متجر إلكتروني</button>
                            <button type="button" class="suggestion-tag" data-query="مدونة شخصية">مدونة شخصية</button>
                            <button type="button" class="suggestion-tag" data-query="موقع شركة">موقع شركة</button>
                            <button type="button" class="suggestion-tag" data-query="معرض أعمال">معرض أعمال</button>
                            <button type="button" class="suggestion-tag" data-query="موقع تعليمي">موقع تعليمي</button>
                        </div>
                    </div>
                </form>
                
                <!-- Search Results Preview -->
                <div class="search-results-preview" id="search-results-preview" aria-live="polite"></div>
                
                <button class="search-close" id="search-close" aria-label="إغلاق البحث">
                    <i class="fas fa-times" aria-hidden="true"></i>
                </button>
            </div>
        </div>
        
        <!-- Notifications Panel -->
        <div class="notifications-panel" id="notifications-panel" aria-hidden="true">
            <div class="notifications-header">
                <h3>الإشعارات</h3>
                <button class="mark-all-read" aria-label="تمييز الكل كمقروء">
                    <i class="fas fa-check-double" aria-hidden="true"></i>
                </button>
            </div>
            <div class="notifications-list">
                <div class="notification-item unread">
                    <div class="notification-icon">
                        <i class="fas fa-star" aria-hidden="true"></i>
                    </div>
                    <div class="notification-content">
                        <h4>قالب جديد متاح!</h4>
                        <p>تم إضافة قالب "المتجر الذكي" للمتاجر الإلكترونية</p>
                        <time>منذ ساعتين</time>
                    </div>
                </div>
                <div class="notification-item">
                    <div class="notification-icon">
                        <i class="fas fa-download" aria-hidden="true"></i>
                    </div>
                    <div class="notification-content">
                        <h4>تحديث متاح</h4>
                        <p>تحديث الأمان للإصدار 3.0.1 متاح الآن</p>
                        <time>منذ يوم</time>
                    </div>
                </div>
                <div class="notification-item">
                    <div class="notification-icon">
                        <i class="fas fa-gift" aria-hidden="true"></i>
                    </div>
                    <div class="notification-content">
                        <h4>عرض خاص</h4>
                        <p>خصم 50% على جميع القوالب المدفوعة</p>
                        <time>منذ 3 أيام</time>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Main Content -->
    <main id="main-content" class="main-content homepage-enhanced" role="main">
        <!-- Hero Section Fullscreen Enhanced -->
        <section class="hero-section-fullscreen" id="hero-section" aria-labelledby="hero-title">
            <!-- Cosmic Background Enhanced -->
            <div class="hero-cosmic-bg" aria-hidden="true">
                <div class="cosmic-stars"></div>
                <div class="cosmic-nebula"></div>
                <div class="cosmic-portal"></div>
                <div class="meteor-shower">
                    <div class="meteor meteor-1"></div>
                    <div class="meteor meteor-2"></div>
                    <div class="meteor meteor-3"></div>
                    <div class="meteor meteor-4"></div>
                </div>
                <div class="aurora-effect"></div>
            </div>
            
            <div class="container-centered">
                <div class="hero-content-main">
                    <!-- Enhanced Animated Title -->
                    <div class="animated-title-container">
                        <div class="title-decoration">
                            <div class="title-line"></div>
                            <div class="title-spark"></div>
                            <div class="title-line"></div>
                        </div>
                        
                        <h1 id="hero-title" class="hero-title-mega">
                            <span class="title-static" data-aos="fade-up" data-aos-delay="500">مرحباً بك في</span>
                            <span class="title-animated" id="animated-text" data-aos="fade-up" data-aos-delay="1000">قوالب عربية ووردبريس</span>
                            <span class="title-cursor" aria-hidden="true">|</span>
                        </h1>
                        
                        <div class="title-decoration bottom">
                            <div class="title-line"></div>
                            <div class="title-spark"></div>
                            <div class="title-line"></div>
                        </div>
                    </div>
                    
                    <!-- Enhanced Magic Description -->
                    <p class="hero-description-enhanced magic-text" data-aos="fade-up" data-aos-delay="1500">
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
                        <span class="magic-word">والمتطورة</span>
                    </p>
                    
                    <!-- Enhanced Action Buttons -->
                    <div class="hero-actions-enhanced" data-aos="fade-up" data-aos-delay="2000">
                        <button class="cinematic-portal-btn-main" 
                                id="portal-trigger" 
                                aria-label="استكشاف القوالب"
                                data-portal="themes">
                            <div class="btn-background">
                                <div class="btn-gradient"></div>
                                <div class="btn-particles-bg"></div>
                                <div class="btn-energy-field"></div>
                                <div class="btn-cosmic-ring"></div>
                            </div>
                            <div class="btn-content">
                                <div class="btn-icon">
                                    <i class="fas fa-rocket" aria-hidden="true"></i>
                                </div>
                                <span class="btn-text">استكشاف القوالب الآن</span>
                                <div class="btn-ripple-effect"></div>
                            </div>
                            <div class="btn-aura"></div>
                            <div class="btn-glow"></div>
                            <div class="btn-magnetic-field"></div>
                        </button>
                        
                        <a href="<?php echo esc_url(home_url('/about/')); ?>" 
                           class="btn-secondary-cosmic"
                           aria-label="تعرف علينا">
                            <div class="btn-secondary-bg"></div>
                            <div class="btn-secondary-text">
                                <i class="fas fa-info-circle" aria-hidden="true"></i>
                                <span>تعرف علينا</span>
                            </div>
                            <div class="btn-secondary-ripple"></div>
                            <div class="btn-secondary-glow"></div>
                        </a>
                        
                        <!-- Video Play Button -->
                        <button class="video-play-btn" 
                                id="video-play-btn"
                                aria-label="مشاهدة الفيديو التعريفي"
                                data-video="intro">
                            <div class="play-btn-bg"></div>
                            <div class="play-icon">
                                <i class="fas fa-play" aria-hidden="true"></i>
                            </div>
                            <div class="play-pulse"></div>
                        </button>
                    </div>
                    
                    <!-- Enhanced Mega Statistics -->
                    <div class="hero-stats-enhanced floating-stats" data-aos="fade-up" data-aos-delay="2500">
                        <article class="stat-item-mega" data-aos="flip-left" data-aos-delay="100">
                            <div class="stat-background">
                                <div class="stat-glow-bg"></div>
                                <div class="stat-particle-field"></div>
                                <div class="stat-energy-ring"></div>
                            </div>
                            <div class="stat-content">
                                <div class="stat-icon-enhanced">
                                    <i class="fas fa-palette" aria-hidden="true"></i>
                                    <div class="icon-orbit"></div>
                                </div>
                                <span class="stat-number-huge" 
                                      data-target="<?php echo $site_stats['themes']; ?>"
                                      data-suffix="">0</span>
                                <span class="stat-label-enhanced">قالب متاح</span>
                                <div class="stat-description">جميع الأنواع والتصنيفات</div>
                            </div>
                            <div class="stat-glow"></div>
                        </article>
                        
                        <article class="stat-item-mega" data-aos="flip-left" data-aos-delay="200">
                            <div class="stat-background">
                                <div class="stat-glow-bg"></div>
                                <div class="stat-particle-field"></div>
                                <div class="stat-energy-ring"></div>
                            </div>
                            <div class="stat-content">
                                <div class="stat-icon-enhanced">
                                    <i class="fas fa-download" aria-hidden="true"></i>
                                    <div class="icon-orbit"></div>
                                </div>
                                <span class="stat-number-huge" 
                                      data-target="<?php echo $site_stats['downloads']; ?>"
                                      data-suffix="K+">0</span>
                                <span class="stat-label-enhanced">تحميل</span>
                                <div class="stat-description">ومازال العدد في نمو</div>
                            </div>
                            <div class="stat-glow"></div>
                        </article>
                        
                        <article class="stat-item-mega" data-aos="flip-left" data-aos-delay="300">
                            <div class="stat-background">
                                <div class="stat-glow-bg"></div>
                                <div class="stat-particle-field"></div>
                                <div class="stat-energy-ring"></div>
                            </div>
                            <div class="stat-content">
                                <div class="stat-icon-enhanced">
                                    <i class="fas fa-gift" aria-hidden="true"></i>
                                    <div class="icon-orbit"></div>
                                </div>
                                <span class="stat-number-huge" data-target="100" data-suffix="%">0</span>
                                <span class="stat-label-enhanced">مجاني</span>
                                <div class="stat-description">بدون تكاليف خفية</div>
                            </div>
                            <div class="stat-glow"></div>
                        </article>
                        
                        <article class="stat-item-mega" data-aos="flip-left" data-aos-delay="400">
                            <div class="stat-background">
                                <div class="stat-glow-bg"></div>
                                <div class="stat-particle-field"></div>
                                <div class="stat-energy-ring"></div>
                            </div>
                            <div class="stat-content">
                                <div class="stat-icon-enhanced">
                                    <i class="fas fa-users" aria-hidden="true"></i>
                                    <div class="icon-orbit"></div>
                                </div>
                                <span class="stat-number-huge" 
                                      data-target="<?php echo $site_stats['subscribers']; ?>"
                                      data-suffix="+">0</span>
                                <span class="stat-label-enhanced">مستخدم راضٍ</span>
                                <div class="stat-description">حول العالم العربي</div>
                            </div>
                            <div class="stat-glow"></div>
                        </article>
                    </div>
                    
                    <!-- Enhanced Quick Features -->
                    <div class="quick-features" data-aos="fade-up" data-aos-delay="3000">
                        <div class="feature-item" data-aos="fade-up" data-aos-delay="500">
                            <div class="feature-icon">
                                <i class="fas fa-mobile-alt" aria-hidden="true"></i>
                                <div class="feature-pulse"></div>
                            </div>
                            <span class="feature-text">متجاوب تماماً</span>
                            <div class="feature-tooltip">يعمل على جميع الأجهزة</div>
                        </div>
                        
                        <div class="feature-item" data-aos="fade-up" data-aos-delay="600">
                            <div class="feature-icon">
                                <i class="fas fa-bolt" aria-hidden="true"></i>
                                <div class="feature-pulse"></div>
                            </div>
                            <span class="feature-text">سريع التحميل</span>
                            <div class="feature-tooltip">أداء محسن للسرعة</div>
                        </div>
                        
                        <div class="feature-item" data-aos="fade-up" data-aos-delay="700">
                            <div class="feature-icon">
                                <i class="fas fa-shield-alt" aria-hidden="true"></i>
                                <div class="feature-pulse"></div>
                            </div>
                            <span class="feature-text">آمن ومحدث</span>
                            <div class="feature-tooltip">حماية متقدمة ضد التهديدات</div>
                        </div>
                        
                        <div class="feature-item" data-aos="fade-up" data-aos-delay="800">
                            <div class="feature-icon">
                                <i class="fas fa-language" aria-hidden="true"></i>
                                <div class="feature-pulse"></div>
                            </div>
                            <span class="feature-text">دعم كامل للعربية</span>
                            <div class="feature-tooltip">مصمم خصيصاً للمحتوى العربي</div>
                        </div>
                        
                        <div class="feature-item" data-aos="fade-up" data-aos-delay="900">
                            <div class="feature-icon">
                                <i class="fas fa-search" aria-hidden="true"></i>
                                <div class="feature-pulse"></div>
                            </div>
                            <span class="feature-text">محسن للSEO</span>
                            <div class="feature-tooltip">يصدر نتائج البحث</div>
                        </div>
                        
                        <div class="feature-item" data-aos="fade-up" data-aos-delay="1000">
                            <div class="feature-icon">
                                <i class="fas fa-headset" aria-hidden="true"></i>
                                <div class="feature-pulse"></div>
                            </div>
                            <span class="feature-text">دعم فني متميز</span>
                            <div class="feature-tooltip">مساعدة على مدار الساعة</div>
                        </div>
                    </div>
                    
                    <!-- Enhanced Hero Footer -->
                    <div class="hero-footer-enhanced" data-aos="fade-up" data-aos-delay="3500">
                        <div class="slogan-container">
                            <div class="slogan-decoration">
                                <i class="fas fa-star" aria-hidden="true"></i>
                            </div>
                            <p class="slogan-text">
                                مستقبل الويب العربي يبدأ من هنا
                            </p>
                            <div class="slogan-decoration">
                                <i class="fas fa-star" aria-hidden="true"></i>
                            </div>
                        </div>
                        
                        <!-- Scroll Indicator Enhanced -->
                        <div class="scroll-indicator" id="scroll-indicator" aria-label="اكتشف المزيد">
                            <div class="scroll-arrow">
                                <i class="fas fa-chevron-down" aria-hidden="true"></i>
                            </div>
                            <span class="scroll-text">اكتشف المزيد</span>
                            <div class="scroll-progress">
                                <div class="progress-ring"></div>
                            </div>
                        </div>
                        
                        <!-- Social Proof -->
                        <div class="social-proof">
                            <div class="trusted-by">
                                <span class="trusted-text">يثق بنا أكثر من</span>
                                <span class="trusted-number"><?php echo number_format($site_stats['subscribers']); ?></span>
                                <span class="trusted-text">مطور ومصمم</span>
                            </div>
                            <div class="rating-display">
                                <div class="stars">
                                    <i class="fas fa-star" aria-hidden="true"></i>
                                    <i class="fas fa-star" aria-hidden="true"></i>
                                    <i class="fas fa-star" aria-hidden="true"></i>
                                    <i class="fas fa-star" aria-hidden="true"></i>
                                    <i class="fas fa-star" aria-hidden="true"></i>
                                </div>
                                <span class="rating-text">4.9/5 تقييم ممتاز</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Enhanced Floating Shapes -->
            <div class="floating-shapes-enhanced" aria-hidden="true">
                <div class="shape-1 floating-shape geometric-shape"></div>
                <div class="shape-2 floating-shape geometric-shape"></div>
                <div class="shape-3 floating-shape geometric-shape"></div>
                <div class="shape-4 floating-shape geometric-shape"></div>
                <div class="shape-5 floating-shape geometric-shape"></div>
                <div class="shape-6 floating-shape geometric-shape"></div>
                <div class="shape-7 floating-shape geometric-shape"></div>
                <div class="shape-8 floating-shape geometric-shape"></div>
            </div>
        </section>

        <!-- Featured Themes Section Enhanced -->
        <section class="featured-themes-section" id="featured-themes" aria-labelledby="featured-themes-title">
            <div class="container">
                <!-- Section Header Enhanced -->
                <header class="section-header" data-aos="fade-up">
                    <div class="section-badge">
                        <i class="fas fa-star" aria-hidden="true"></i>
                        <span>مميز</span>
                        <div class="badge-glow"></div>
                    </div>
                    <h2 id="featured-themes-title" class="section-title">القوالب المميزة</h2>
                    <p class="section-description">اكتشف أحدث وأجمل قوالب ووردبريس العربية المختارة بعناية</p>
                    <div class="section-decoration">
                        <div class="decoration-line"></div>
                        <div class="decoration-dot"></div>
                        <div class="decoration-line"></div>
                    </div>
                    
                    <!-- Filter Tabs -->
                    <div class="themes-filter-tabs" role="tablist" aria-label="تصفية القوالب">
                        <button class="filter-tab active" 
                                role="tab" 
                                aria-selected="true" 
                                aria-controls="all-themes" 
                                data-filter="all">
                            <i class="fas fa-th-large" aria-hidden="true"></i>
                            <span>الكل</span>
                        </button>
                        <button class="filter-tab" 
                                role="tab" 
                                aria-selected="false" 
                                aria-controls="business-themes" 
                                data-filter="business">
                            <i class="fas fa-briefcase" aria-hidden="true"></i>
                            <span>أعمال</span>
                        </button>
                        <button class="filter-tab" 
                                role="tab" 
                                aria-selected="false" 
                                aria-controls="ecommerce-themes" 
                                data-filter="ecommerce">
                            <i class="fas fa-shopping-cart" aria-hidden="true"></i>
                            <span>متاجر</span>
                        </button>
                        <button class="filter-tab" 
                                role="tab" 
                                aria-selected="false" 
                                aria-controls="blog-themes" 
                                data-filter="blog">
                            <i class="fas fa-blog" aria-hidden="true"></i>
                            <span>مدونات</span>
                        </button>
                        <button class="filter-tab" 
                                role="tab" 
                                aria-selected="false" 
                                aria-controls="portfolio-themes" 
                                data-filter="portfolio">
                            <i class="fas fa-camera" aria-hidden="true"></i>
                            <span>معارض</span>
                        </button>
                    </div>
                </header>
                
                <!-- Themes Grid Enhanced -->
                <div class="themes-grid-container">
                    <div class="themes-grid" id="themes-grid" role="tabpanel" aria-labelledby="featured-themes-title">
                        <?php
                        $featured_themes = get_featured_themes(8);
                        
                        if ($featured_themes->have_posts()) :
                            $delay = 0;
                            while ($featured_themes->have_posts()) : 
                                $featured_themes->the_post();
                                $theme_id = get_the_ID();
                                $demo_url = esc_url(get_post_meta($theme_id, '_theme_demo_url', true));
                                $download_url = esc_url(get_post_meta($theme_id, '_theme_download_url', true));
                                $version = esc_html(get_post_meta($theme_id, '_theme_version', true));
                                $price = get_post_meta($theme_id, '_theme_price', true);
                                $downloads = intval(get_post_meta($theme_id, '_download_count', true)) ?: 0;
                                $rating = get_theme_average_rating($theme_id) ?: 4.5;
                                $delay += 100;
                                
                                // Get theme categories
                                $theme_categories = get_the_terms($theme_id, 'theme_category');
                                $category_classes = '';
                                if ($theme_categories && !is_wp_error($theme_categories)) {
                                    foreach ($theme_categories as $cat) {
                                        $category_classes .= ' theme-cat-' . $cat->slug;
                                    }
                                }
                        ?>
                        <article class="theme-card featured-card<?php echo $category_classes; ?>" 
                                 data-aos="fade-up" 
                                 data-aos-delay="<?php echo $delay; ?>"
                                 data-theme-id="<?php echo $theme_id; ?>"
                                 itemscope 
                                 itemtype="https://schema.org/SoftwareApplication">
                            
                            <!-- Card Background Effects -->
                            <div class="card-background" aria-hidden="true">
                                <div class="card-glow"></div>
                                <div class="card-particles"></div>
                                <div class="card-energy-field"></div>
                            </div>
                            
                            <!-- Theme Badges -->
                            <div class="theme-badges">
                                <span class="badge badge-featured">
                                    <i class="fas fa-star" aria-hidden="true"></i>
                                    <span>مميز</span>
                                </span>
                                <?php if (empty($price) || $price == 0) : ?>
                                <span class="badge badge-free">
                                    <i class="fas fa-gift" aria-hidden="true"></i>
                                    <span>مجاني</span>
                                </span>
                                <?php else : ?>
                                <span class="badge badge-premium">
                                    <i class="fas fa-crown" aria-hidden="true"></i>
                                    <span>مدفوع</span>
                                </span>
                                <?php endif; ?>
                                
                                <?php if ($downloads > 1000) : ?>
                                <span class="badge badge-popular">
                                    <i class="fas fa-fire" aria-hidden="true"></i>
                                    <span>شائع</span>
                                </span>
                                <?php endif; ?>
                            </div>
                            
                            <!-- Theme Preview Enhanced -->
                            <div class="theme-preview">
                                <div class="preview-container">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>" 
                                             alt="<?php echo esc_attr(get_the_title()); ?>" 
                                             class="theme-image"
                                             loading="lazy"
                                             itemprop="image"
                                             width="400"
                                             height="300">
                                    <?php else : ?>
                                        <div class="no-image">
                                            <i class="fas fa-image" aria-hidden="true"></i>
                                            <span>لا توجد صورة معاينة</span>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <!-- Preview Overlay Enhanced -->
                                    <div class="preview-overlay">
                                        <div class="preview-actions">
                                            <?php if ($demo_url) : ?>
                                            <a href="<?php echo $demo_url; ?>" 
                                               class="preview-btn demo-btn" 
                                               target="_blank" 
                                               rel="noopener noreferrer"
                                               aria-label="معاينة مباشرة لقالب <?php the_title(); ?>">
                                                <i class="fas fa-eye" aria-hidden="true"></i>
                                                <span class="btn-tooltip">معاينة مباشرة</span>
                                            </a>
                                            <?php endif; ?>
                                            
                                            <button class="preview-btn download-btn" 
                                                    data-theme-id="<?php echo $theme_id; ?>"
                                                    aria-label="تحميل قالب <?php the_title(); ?>">
                                                <i class="fas fa-download" aria-hidden="true"></i>
                                                <span class="btn-tooltip">تحميل مجاني</span>
                                            </button>
                                            
                                            <button class="preview-btn favorite-btn" 
                                                    data-theme-id="<?php echo $theme_id; ?>"
                                                    aria-label="إضافة للمفضلة">
                                                <i class="far fa-heart" aria-hidden="true"></i>
                                                <span class="btn-tooltip">إضافة للمفضلة</span>
                                            </button>
                                            
                                            <button class="preview-btn share-btn" 
                                                    data-theme-id="<?php echo $theme_id; ?>"
                                                    aria-label="مشاركة القالب">
                                                <i class="fas fa-share-alt" aria-hidden="true"></i>
                                                <span class="btn-tooltip">مشاركة</span>
                                            </button>
                                        </div>
                                        
                                        <!-- Quick Info -->
                                        <div class="quick-info">
                                            <div class="info-item">
                                                <i class="fas fa-download" aria-hidden="true"></i>
                                                <span><?php echo number_format($downloads); ?></span>
                                            </div>
                                            <div class="info-item">
                                                <i class="fas fa-star" aria-hidden="true"></i>
                                                <span><?php echo number_format($rating, 1); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Loading Placeholder -->
                                    <div class="image-placeholder" aria-hidden="true">
                                        <div class="placeholder-animation"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Theme Content Enhanced -->
                            <div class="theme-content">
                                <header class="theme-header">
                                    <h3 class="theme-title" itemprop="name">
                                        <a href="<?php the_permalink(); ?>" 
                                           aria-label="تفاصيل قالب <?php the_title(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>
                                    
                                    <!-- Theme Meta -->
                                    <div class="theme-meta">
                                        <div class="theme-rating" itemprop="aggregateRating" itemscope itemtype="https://schema.org/AggregateRating">
                                            <div class="rating-stars" aria-label="تقييم <?php echo $rating; ?> من 5 نجوم">
                                                <?php for ($i = 1; $i <= 5; $i++) : ?>
                                                    <i class="<?php echo $i <= $rating ? 'fas' : 'far'; ?> fa-star" aria-hidden="true"></i>
                                                <?php endfor; ?>
                                            </div>
                                            <span class="rating-value" itemprop="ratingValue" content="<?php echo $rating; ?>">
                                                (<?php echo number_format($rating, 1); ?>)
                                            </span>
                                            <meta itemprop="bestRating" content="5">
                                            <meta itemprop="worstRating" content="1">
                                        </div>
                                        
                                        <div class="theme-stats">
                                            <div class="stat-item">
                                                <i class="fas fa-download" aria-hidden="true"></i>
                                                <span><?php echo number_format($downloads); ?></span>
                                                <span class="stat-label">تحميل</span>
                                            </div>
                                            <?php if ($version) : ?>
                                            <div class="stat-item">
                                                <i class="fas fa-tag" aria-hidden="true"></i>
                                                <span>v<?php echo $version; ?></span>
                                                <span class="stat-label">الإصدار</span>
                                            </div>
                                            <?php endif; ?>
                                            <div class="stat-item">
                                                <i class="fas fa-calendar" aria-hidden="true"></i>
                                                <span><?php echo get_the_date('M Y'); ?></span>
                                                <span class="stat-label">محدث</span>
                                            </div>
                                        </div>
                                    </div>
                                </header>
                                
                                <!-- Theme Description -->
                                <div class="theme-excerpt" itemprop="description">
                                    <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                                </div>
                                
                                <!-- Theme Categories -->
                                <div class="theme-categories">
                                    <?php
                                    if ($theme_categories && !is_wp_error($theme_categories)) :
                                        foreach (array_slice($theme_categories, 0, 3) as $category) :
                                    ?>
                                        <span class="category-tag" itemprop="applicationCategory">
                                            <i class="<?php echo esc_attr(get_term_meta($category->term_id, '_category_icon', true) ?: 'fas fa-tag'); ?>" aria-hidden="true"></i>
                                            <span><?php echo esc_html($category->name); ?></span>
                                        </span>
                                    <?php endforeach; endif; ?>
                                </div>
                                
                                <!-- Theme Features -->
                                <div class="theme-features">
                                    <div class="feature-tag">
                                        <i class="fas fa-mobile-alt" aria-hidden="true"></i>
                                        <span>متجاوب</span>
                                    </div>
                                    <div class="feature-tag">
                                        <i class="fas fa-search" aria-hidden="true"></i>
                                        <span>SEO محسن</span>
                                    </div>
                                    <div class="feature-tag">
                                        <i class="fas fa-bolt" aria-hidden="true"></i>
                                        <span>سريع</span>
                                    </div>
                                    <div class="feature-tag">
                                        <i class="fas fa-language" aria-hidden="true"></i>
                                        <span>RTL</span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Theme Actions Enhanced -->
                            <footer class="theme-actions">
                                <button class="btn-primary download-theme-btn" 
                                        data-theme-id="<?php echo $theme_id; ?>"
                                        aria-label="تحميل قالب <?php the_title(); ?>">
                                    <i class="fas fa-download" aria-hidden="true"></i>
                                    <span>تحميل مجاني</span>
                                    <div class="btn-ripple"></div>
                                    <div class="btn-loading">
                                        <i class="fas fa-spinner fa-spin" aria-hidden="true"></i>
                                    </div>
                                </button>
                                
                                <a href="<?php the_permalink(); ?>" 
                                   class="btn-secondary"
                                   aria-label="عرض تفاصيل قالب <?php the_title(); ?>">
                                    <i class="fas fa-info-circle" aria-hidden="true"></i>
                                    <span>التفاصيل</span>
                                </a>
                                
                                <?php if ($demo_url) : ?>
                                <a href="<?php echo $demo_url; ?>" 
                                   class="btn-demo" 
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   aria-label="معاينة مباشرة لقالب <?php the_title(); ?>">
                                    <i class="fas fa-external-link-alt" aria-hidden="true"></i>
                                    <span>معاينة</span>
                                </a>
                                <?php endif; ?>
                            </footer>
                            
                            <!-- Schema.org structured data -->
                            <meta itemprop="operatingSystem" content="WordPress">
                            <meta itemprop="applicationCategory" content="WordPress Theme">
                            <div itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                                <meta itemprop="price" content="<?php echo $price ?: '0'; ?>">
                                <meta itemprop="priceCurrency" content="USD">
                                <meta itemprop="availability" content="https://schema.org/InStock">
                            </div>
                        </article>
                        <?php 
                            endwhile; 
                            wp_reset_postdata(); 
                        else :
                        ?>
                        <div class="no-themes-message" data-aos="fade-up">
                            <div class="message-icon">
                                <i class="fas fa-search" aria-hidden="true"></i>
                            </div>
                            <h3>لا توجد قوالب مميزة حالياً</h3>
                            <p>نعمل على إضافة قوالب جديدة ومميزة قريباً</p>
                            <a href="<?php echo esc_url(home_url('/themes/')); ?>" class="btn-primary">
                                <i class="fas fa-th-large" aria-hidden="true"></i>
                                <span>تصفح جميع القوالب</span>
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Grid Loading State -->
                    <div class="grid-loading" id="grid-loading" aria-hidden="true">
                        <div class="loading-dots">
                            <div class="dot"></div>
                            <div class="dot"></div>
                            <div class="dot"></div>
                        </div>
                        <p>جاري تحميل القوالب...</p>
                    </div>
                </div>
                
                <!-- Section Footer Enhanced -->
                <footer class="section-footer" data-aos="fade-up" data-aos-delay="400">
                    <div class="view-all-container">
                        <a href="<?php echo esc_url(home_url('/themes/')); ?>" 
                           class="btn-view-all"
                           aria-label="عرض جميع القوالب">
                            <span>عرض جميع القوالب</span>
                            <i class="fas fa-arrow-left" aria-hidden="true"></i>
                            <div class="btn-glow"></div>
                        </a>
                        
                        <div class="section-stats">
                            <div class="stat">
                                <span class="stat-number"><?php echo number_format($site_stats['themes']); ?></span>
                                <span class="stat-label">قالب متاح</span>
                            </div>
                            <div class="stat">
                                <span class="stat-number"><?php echo number_format($site_stats['downloads']); ?>+</span>
                                <span class="stat-label">تحميل</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Pagination Preview -->
                    <div class="pagination-preview">
                        <span class="page-indicator active"></span>
                        <span class="page-indicator"></span>
                        <span class="page-indicator"></span>
                    </div>
                </footer>
            </div>
        </section>

        <!-- Categories Section Enhanced -->
        <section class="categories-section" id="categories" aria-labelledby="categories-title">
            <div class="container">
                <header class="section-header" data-aos="fade-up">
                    <div class="section-badge">
                        <i class="fas fa-tags" aria-hidden="true"></i>
                        <span>تصنيفات</span>
                    </div>
                    <h2 id="categories-title" class="section-title">تصفح حسب النوع</h2>
                    <p class="section-description">اختر التصنيف المناسب لنوع موقعك واحتياجاتك الخاصة</p>
                    <div class="section-decoration">
                        <div class="decoration-line"></div>
                        <div class="decoration-dot"></div>
                        <div class="decoration-line"></div>
                    </div>
                </header>
                
                <div class="categories-grid">
                    <?php
                    $popular_categories = get_popular_categories(8);
                    
                    if (!empty($popular_categories) && !is_wp_error($popular_categories)) :
                        $delay = 0;
                        foreach ($popular_categories as $category) :
                            $category_icon = get_term_meta($category->term_id, '_category_icon', true) ?: 'fas fa-folder';
                            $category_color = get_term_meta($category->term_id, '_category_color', true) ?: '#3b82f6';
                            $category_description = $category->description ?: 'استكشف قوالب ' . $category->name;
                            $delay += 100;
                    ?>
                    <article class="category-card" 
                             data-aos="zoom-in" 
                             data-aos-delay="<?php echo $delay; ?>"
                             data-category="<?php echo esc_attr($category->slug); ?>">
                        
                        <div class="category-background" 
                             style="--category-color: <?php echo esc_attr($category_color); ?>" 
                             aria-hidden="true">
                            <div class="category-glow"></div>
                            <div class="category-particles"></div>
                        </div>
                        
                        <div class="category-icon">
                            <i class="<?php echo esc_attr($category_icon); ?>" aria-hidden="true"></i>
                            <div class="icon-ring"></div>
                        </div>
                        
                        <div class="category-content">
                            <h3 class="category-name"><?php echo esc_html($category->name); ?></h3>
                            <p class="category-count"><?php echo number_format($category->count); ?> قالب</p>
                            <p class="category-description"><?php echo esc_html($category_description); ?></p>
                            
                            <!-- Category Features -->
                            <div class="category-features">
                                <span class="feature-tag">
                                    <i class="fas fa-check" aria-hidden="true"></i>
                                    <span>احترافي</span>
                                </span>
                                <span class="feature-tag">
                                    <i class="fas fa-mobile-alt" aria-hidden="true"></i>
                                    <span>متجاوب</span>
                                </span>
                                <span class="feature-tag">
                                    <i class="fas fa-language" aria-hidden="true"></i>
                                    <span>عربي</span>
                                </span>
                            </div>
                        </div>
                        
                        <footer class="category-footer">
                            <a href="<?php echo esc_url(get_term_link($category)); ?>" 
                               class="category-link"
                               aria-label="استكشاف قوالب <?php echo esc_attr($category->name); ?>">
                                <span>استكشاف</span>
                                <i class="fas fa-arrow-left" aria-hidden="true"></i>
                                <div class="link-ripple"></div>
                            </a>
                            
                            <!-- Quick Stats -->
                            <div class="category-stats">
                                <div class="stat-item">
                                    <i class="fas fa-download" aria-hidden="true"></i>
                                    <span><?php echo number_format(rand(500, 5000)); ?></span>
                                </div>
                                <div class="stat-item">
                                    <i class="fas fa-star" aria-hidden="true"></i>
                                    <span><?php echo number_format(rand(40, 50) / 10, 1); ?></span>
                                </div>
                            </div>
                        </footer>
                    </article>
                    <?php endforeach; endif; ?>
                </div>
                
                <!-- All Categories Button -->
                <div class="all-categories-footer" data-aos="fade-up" data-aos-delay="800">
                    <a href="<?php echo esc_url(home_url('/categories/')); ?>" 
                       class="btn-all-categories"
                       aria-label="عرض جميع التصنيفات">
                        <div class="btn-bg"></div>
                        <div class="btn-content">
                            <i class="fas fa-th" aria-hidden="true"></i>
                            <span>عرض جميع التصنيفات</span>
                            <span class="categories-count">(<?php echo wp_count_terms('theme_category'); ?>)</span>
                        </div>
                        <div class="btn-shine"></div>
                    </a>
                </div>
            </div>
        </section>

        <!-- Features Section Enhanced -->
        <section class="features-section" id="features" aria-labelledby="features-title">
            <div class="container">
                <header class="section-header" data-aos="fade-up">
                    <div class="section-badge">
                        <i class="fas fa-star" aria-hidden="true"></i>
                        <span>مزايا</span>
                    </div>
                    <h2 id="features-title" class="section-title">لماذا تختار قوالبنا؟</h2>
                    <p class="section-description">مزايا استثنائية وحصرية تجعل موقعك يتميز ويتفوق على المنافسين</p>
                </header>
                
                <div class="features-showcase">
                    <!-- Main Feature -->
                    <div class="main-feature" data-aos="zoom-in" data-aos-delay="200">
                        <div class="feature-visual">
                            <div class="feature-screens">
                                <div class="screen desktop">
                                    <div class="screen-content">
                                        <div class="screen-header"></div>
                                        <div class="screen-body">
                                            <div class="content-bar"></div>
                                            <div class="content-bar"></div>
                                            <div class="content-bar short"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="screen tablet">
                                    <div class="screen-content">
                                        <div class="screen-header"></div>
                                        <div class="screen-body">
                                            <div class="content-bar"></div>
                                            <div class="content-bar short"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="screen mobile">
                                    <div class="screen-content">
                                        <div class="screen-header"></div>
                                        <div class="screen-body">
                                            <div class="content-bar"></div>
                                            <div class="content-bar"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="feature-glow"></div>
                        </div>
                        
                        <div class="feature-content">
                            <h3 class="feature-title">تصميم متجاوب بالكامل</h3>
                            <p class="feature-description">
                                جميع قوالبنا مصممة بعناية فائقة لتعمل بشكل مثالي على جميع الأجهزة والشاشات، 
                                من الهواتف الذكية إلى أجهزة الكمبيوتر المكتبية الكبيرة.
                            </p>
                            <div class="feature-stats">
                                <div class="stat">
                                    <span class="stat-number">100%</span>
                                    <span class="stat-label">متجاوب</span>
                                </div>
                                <div class="stat">
                                    <span class="stat-number">5+</span>
                                    <span class="stat-label">أحجام شاشة</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Features Grid -->
                    <div class="features-grid">
                        <article class="feature-item" data-aos="fade-right" data-aos-delay="100">
                            <div class="feature-icon-wrapper">
                                <div class="feature-icon-bg"></div>
                                <div class="feature-icon">
                                    <i class="fas fa-rocket" aria-hidden="true"></i>
                                </div>
                                <div class="feature-pulse"></div>
                            </div>
                            <div class="feature-content">
                                <h3 class="feature-title">أداء فائق السرعة</h3>
                                <p class="feature-description">
                                    محسنة للسرعة والأداء مع تقنيات التحميل السريع وضغط الصور المتقدم 
                                    وتحسين الكود لضمان تجربة مستخدم سلسة وسريعة.
                                </p>
                                <div class="feature-metrics">
                                    <div class="metric">
                                        <i class="fas fa-tachometer-alt" aria-hidden="true"></i>
                                        <span>سرعة تحميل أقل من 3 ثواني</span>
                                    </div>
                                    <div class="metric">
                                        <i class="fas fa-chart-line" aria-hidden="true"></i>
                                        <span>تحسين 90%+ في الأداء</span>
                                    </div>
                                </div>
                            </div>
                        </article>
                        
                        <article class="feature-item" data-aos="fade-left" data-aos-delay="200">
                            <div class="feature-icon-wrapper">
                                <div class="feature-icon-bg"></div>
                                <div class="feature-icon">
                                    <i class="fas fa-search" aria-hidden="true"></i>
                                </div>
                                <div class="feature-pulse"></div>
                            </div>
                            <div class="feature-content">
                                <h3 class="feature-title">محسن لمحركات البحث</h3>
                                <p class="feature-description">
                                    بنية صديقة لـ SEO مع كود منظم وعلامات meta محسنة وسرعة تحميل عالية 
                                    لضمان تصدر موقعك لنتائج البحث الأولى.
                                </p>
                                <div class="feature-metrics">
                                    <div class="metric">
                                        <i class="fas fa-trophy" aria-hidden="true"></i>
                                        <span>تقييم 95%+ في Google PageSpeed</span>
                                    </div>
                                    <div class="metric">
                                        <i class="fas fa-check-circle" aria-hidden="true"></i>
                                        <span>متوافق مع معايير W3C</span>
                                    </div>
                                </div>
                            </div>
                        </article>
                        
                        <article class="feature-item" data-aos="fade-right" data-aos-delay="300">
                            <div class="feature-icon-wrapper">
                                <div class="feature-icon-bg"></div>
                                <div class="feature-icon">
                                    <i class="fas fa-language" aria-hidden="true"></i>
                                </div>
                                <div class="feature-pulse"></div>
                            </div>
                            <div class="feature-content">
                                <h3 class="feature-title">دعم كامل للعربية</h3>
                                <p class="feature-description">
                                    مصمم خصيصاً للمحتوى العربي مع دعم شامل للكتابة من اليمين إلى اليسار 
                                    والخطوط العربية الجميلة والتخطيط المناسب للثقافة العربية.
                                </p>
                                <div class="feature-metrics">
                                    <div class="metric">
                                        <i class="fas fa-align-right" aria-hidden="true"></i>
                                        <span>دعم RTL مثالي</span>
                                    </div>
                                    <div class="metric">
                                        <i class="fas fa-font" aria-hidden="true"></i>
                                        <span>خطوط عربية احترافية</span>
                                    </div>
                                </div>
                            </div>
                        </article>
                        
                        <article class="feature-item" data-aos="fade-left" data-aos-delay="400">
                            <div class="feature-icon-wrapper">
                                <div class="feature-icon-bg"></div>
                                <div class="feature-icon">
                                    <i class="fas fa-shield-alt" aria-hidden="true"></i>
                                </div>
                                <div class="feature-pulse"></div>
                            </div>
                            <div class="feature-content">
                                <h3 class="feature-title">أمان متقدم</h3>
                                <p class="feature-description">
                                    كود نظيف وآمن يتبع أفضل معايير الأمان والحماية في ووردبريس مع 
                                    حماية من الثغرات الشائعة وتحديثات أمنية دورية.
                                </p>
                                <div class="feature-metrics">
                                    <div class="metric">
                                        <i class="fas fa-lock" aria-hidden="true"></i>
                                        <span>حماية من الثغرات الأمنية</span>
                                    </div>
                                    <div class="metric">
                                        <i class="fas fa-sync" aria-hidden="true"></i>
                                        <span>تحديثات أمنية منتظمة</span>
                                    </div>
                                </div>
                            </div>
                        </article>
                        
                        <article class="feature-item" data-aos="fade-right" data-aos-delay="500">
                            <div class="feature-icon-wrapper">
                                <div class="feature-icon-bg"></div>
                                <div class="feature-icon">
                                    <i class="fas fa-palette" aria-hidden="true"></i>
                                </div>
                                <div class="feature-pulse"></div>
                            </div>
                            <div class="feature-content">
                                <h3 class="feature-title">تخصيص سهل ومرن</h3>
                                <p class="feature-description">
                                    واجهة تخصيص بديهية وسهلة تتيح لك تغيير الألوان والخطوط والتخطيط 
                                    دون الحاجة لخبرة في البرمجة أو التصميم.
                                </p>
                                <div class="feature-metrics">
                                    <div class="metric">
                                        <i class="fas fa-sliders-h" aria-hidden="true"></i>
                                        <span>خيارات تخصيص لا محدودة</span>
                                    </div>
                                    <div class="metric">
                                        <i class="fas fa-magic" aria-hidden="true"></i>
                                        <span>واجهة تخصيص مرئية</span>
                                    </div>
                                </div>
                            </div>
                        </article>
                        
                        <article class="feature-item" data-aos="fade-left" data-aos-delay="600">
                            <div class="feature-icon-wrapper">
                                <div class="feature-icon-bg"></div>
                                <div class="feature-icon">
                                    <i class="fas fa-headset" aria-hidden="true"></i>
                                </div>
                                <div class="feature-pulse"></div>
                            </div>
                            <div class="feature-content">
                                <h3 class="feature-title">دعم فني متميز</h3>
                                <p class="feature-description">
                                    فريق دعم متخصص ومتفاني جاهز لمساعدتك على مدار الساعة مع توثيق 
                                    شامل وفيديوهات تعليمية ودورات مجانية.
                                </p>
                                <div class="feature-metrics">
                                    <div class="metric">
                                        <i class="fas fa-clock" aria-hidden="true"></i>
                                        <span>دعم 24/7</span>
                                    </div>
                                    <div class="metric">
                                        <i class="fas fa-graduation-cap" aria-hidden="true"></i>
                                        <span>دورات تعليمية مجانية</span>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
                
                <!-- Features Comparison -->
                <div class="features-comparison" data-aos="fade-up" data-aos-delay="700">
                    <h3 class="comparison-title">مقارنة مع المنافسين</h3>
                    <div class="comparison-table">
                        <div class="comparison-header">
                            <div class="feature-name">المزايا</div>
                            <div class="our-themes">قوالبنا</div>
                            <div class="competitors">المنافسون</div>
                        </div>
                        
                        <div class="comparison-row">
                            <div class="feature-name">دعم العربية الكامل</div>
                            <div class="our-themes">
                                <i class="fas fa-check-circle" aria-hidden="true"></i>
                            </div>
                            <div class="competitors">
                                <i class="fas fa-times-circle" aria-hidden="true"></i>
                            </div>
                        </div>
                        
                        <div class="comparison-row">
                            <div class="feature-name">سرعة التحميل الفائقة</div>
                            <div class="our-themes">
                                <i class="fas fa-check-circle" aria-hidden="true"></i>
                            </div>
                            <div class="competitors">
                                <i class="fas fa-minus-circle" aria-hidden="true"></i>
                            </div>
                        </div>
                        
                        <div class="comparison-row">
                            <div class="feature-name">تحديثات مجانية دائمة</div>
                            <div class="our-themes">
                                <i class="fas fa-check-circle" aria-hidden="true"></i>
                            </div>
                            <div class="competitors">
                                <i class="fas fa-times-circle" aria-hidden="true"></i>
                            </div>
                        </div>
                        
                        <div class="comparison-row">
                            <div class="feature-name">دعم فني متخصص</div>
                            <div class="our-themes">
                                <i class="fas fa-check-circle" aria-hidden="true"></i>
                            </div>
                            <div class="competitors">
                                <i class="fas fa-minus-circle" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials Section Enhanced -->
        <section class="testimonials-section" id="testimonials" aria-labelledby="testimonials-title">
            <div class="container">
                <header class="section-header" data-aos="fade-up">
                    <div class="section-badge">
                        <i class="fas fa-quote-left" aria-hidden="true"></i>
                        <span>آراء العملاء</span>
                    </div>
                    <h2 id="testimonials-title" class="section-title">ماذا يقول عملاؤنا؟</h2>
                    <p class="section-description">تجارب حقيقية ومراجعات صادقة من مستخدمين راضين عن خدماتنا وقوالبنا</p>
                </header>
                
                <div class="testimonials-container">
                    <!-- Testimonials Slider -->
                    <div class="testimonials-slider" id="testimonials-slider">
                        <!-- Testimonial 1 -->
                        <article class="testimonial-item active" 
                                 data-aos="fade-up" 
                                 itemscope 
                                 itemtype="https://schema.org/Review">
                            <div class="testimonial-background">
                                <div class="bg-pattern"></div>
                                <div class="bg-glow"></div>
                            </div>
                            
                            <div class="testimonial-content">
                                <div class="quote-icon">
                                    <i class="fas fa-quote-left" aria-hidden="true"></i>
                                </div>
                                
                                <blockquote class="testimonial-text" itemprop="reviewBody">
                                    "قوالب رائعة بجودة عالية وتصميم احترافي متقن. ساعدتني في إنشاء موقع متجري الإلكتروني 
                                    بسهولة تامة ونتائج مذهلة. فريق الدعم متعاون جداً ويقدم المساعدة بسرعة وفعالية. 
                                    أنصح بها بقوة لكل من يريد موقعاً احترافياً وسريعاً."
                                </blockquote>
                                
                                <div class="testimonial-rating" itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
                                    <div class="rating-stars">
                                        <i class="fas fa-star" aria-hidden="true"></i>
                                        <i class="fas fa-star" aria-hidden="true"></i>
                                        <i class="fas fa-star" aria-hidden="true"></i>
                                        <i class="fas fa-star" aria-hidden="true"></i>
                                        <i class="fas fa-star" aria-hidden="true"></i>
                                    </div>
                                    <meta itemprop="ratingValue" content="5">
                                    <meta itemprop="bestRating" content="5">
                                </div>
                            </div>
                            
                            <footer class="testimonial-author" itemprop="author" itemscope itemtype="https://schema.org/Person">
                                <div class="author-avatar">
                                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/testimonials/ahmed.jpg'); ?>" 
                                         alt="أحمد محمد" 
                                         loading="lazy"
                                         width="60" 
                                         height="60">
                                    <div class="avatar-ring"></div>
                                </div>
                                <div class="author-info">
                                    <h4 class="author-name" itemprop="name">أحمد محمد العتيبي</h4>
                                    <p class="author-title" itemprop="jobTitle">مؤسس متجر الكتروني</p>
                                    <div class="author-company">شركة التجارة الذكية</div>
                                    <div class="author-location">
                                        <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                                        <span>الرياض، السعودية</span>
                                    </div>
                                </div>
                            </footer>
                            
                            <meta itemprop="datePublished" content="2024-11-15">
                        </article>
                        
                        <!-- Testimonial 2 -->
                        <article class="testimonial-item" 
                                 data-aos="fade-up"
                                 itemscope 
                                 itemtype="https://schema.org/Review">
                            <div class="testimonial-background">
                                <div class="bg-pattern"></div>
                                <div class="bg-glow"></div>
                            </div>
                            
                            <div class="testimonial-content">
                                <div class="quote-icon">
                                    <i class="fas fa-quote-left" aria-hidden="true"></i>
                                </div>
                                
                                <blockquote class="testimonial-text" itemprop="reviewBody">
                                    "كمطور ويب محترف، استخدمت العديد من القوالب من مصادر مختلفة، لكن قوالب هذا الموقع 
                                    تتميز بجودة الكود النظيف والتوثيق الممتاز. التصميمات حديثة والأداء ممتاز. 
                                    عملت معهم في أكثر من 15 مشروع والنتائج دائماً مرضية للعملاء."
                                </blockquote>
                                
                                <div class="testimonial-rating" itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
                                    <div class="rating-stars">
                                        <i class="fas fa-star" aria-hidden="true"></i>
                                        <i class="fas fa-star" aria-hidden="true"></i>
                                        <i class="fas fa-star" aria-hidden="true"></i>
                                        <i class="fas fa-star" aria-hidden="true"></i>
                                        <i class="fas fa-star" aria-hidden="true"></i>
                                    </div>
                                    <meta itemprop="ratingValue" content="5">
                                    <meta itemprop="bestRating" content="5">
                                </div>
                            </div>
                            
                            <footer class="testimonial-author" itemprop="author" itemscope itemtype="https://schema.org/Person">
                                <div class="author-avatar">
                                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/testimonials/saad.jpg'); ?>" 
                                         alt="سعد الغامدي" 
                                         loading="lazy"
                                         width="60" 
                                         height="60">
                                    <div class="avatar-ring"></div>
                                </div>
                                <div class="author-info">
                                    <h4 class="author-name" itemprop="name">سعد الغامدي</h4>
                                    <p class="author-title" itemprop="jobTitle">مطور ويب محترف</p>
                                    <div class="author-company">فريلانسر</div>
                                    <div class="author-location">
                                        <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                                        <span>جدة، السعودية</span>
                                    </div>
                                </div>
                            </footer>
                            
                            <meta itemprop="datePublished" content="2024-11-10">
                        </article>
                        
                        <!-- Testimonial 3 -->
                        <article class="testimonial-item" 
                                 data-aos="fade-up"
                                 itemscope 
                                 itemtype="https://schema.org/Review">
                            <div class="testimonial-background">
                                <div class="bg-pattern"></div>
                                <div class="bg-glow"></div>
                            </div>
                            
                            <div class="testimonial-content">
                                <div class="quote-icon">
                                    <i class="fas fa-quote-left" aria-hidden="true"></i>
                                </div>
                                
                                <blockquote class="testimonial-text" itemprop="reviewBody">
                                    "بصراحة فاقت توقعاتي تماماً! القالب سهل التخصيص ومرن جداً ويدعم العربية بشكل مثالي. 
                                    تمكنت من إنشاء موقع شركتي في وقت قياسي وبمظهر احترافي يليق بمكانة الشركة. 
                                    الدعم الفني سريع ومفيد، والتحديثات مستمرة ومجانية."
                                </blockquote>
                                
                                <div class="testimonial-rating" itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
                                    <div class="rating-stars">
                                        <i class="fas fa-star" aria-hidden="true"></i>
                                        <i class="fas fa-star" aria-hidden="true"></i>
                                        <i class="fas fa-star" aria-hidden="true"></i>
                                        <i class="fas fa-star" aria-hidden="true"></i>
                                        <i class="fas fa-star" aria-hidden="true"></i>
                                    </div>
                                    <meta itemprop="ratingValue" content="5">
                                    <meta itemprop="bestRating" content="5">
                                </div>
                            </div>
                            
                            <footer class="testimonial-author" itemprop="author" itemscope itemtype="https://schema.org/Person">
                                <div class="author-avatar">
                                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/testimonials/fatima.jpg'); ?>" 
                                         alt="فاطمة الزهراني" 
                                         loading="lazy"
                                         width="60" 
                                         height="60">
                                    <div class="avatar-ring"></div>
                                </div>
                                <div class="author-info">
                                    <h4 class="author-name" itemprop="name">فاطمة الزهراني</h4>
                                    <p class="author-title" itemprop="jobTitle">مديرة تسويق</p>
                                    <div class="author-company">شركة الإبداع للتسويق</div>
                                    <div class="author-location">
                                        <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                                        <span>الدمام، السعودية</span>
                                    </div>
                                </div>
                            </footer>
                            
                            <meta itemprop="datePublished" content="2024-11-05">
                        </article>
                        
                        <!-- Testimonial 4 -->
                        <article class="testimonial-item" 
                                 data-aos="fade-up"
                                 itemscope 
                                 itemtype="https://schema.org/Review">
                            <div class="testimonial-background">
                                <div class="bg-pattern"></div>
                                <div class="bg-glow"></div>
                            </div>
                            
                            <div class="testimonial-content">
                                <div class="quote-icon">
                                    <i class="fas fa-quote-left" aria-hidden="true"></i>
                                </div>
                                
                                <blockquote class="testimonial-text" itemprop="reviewBody">
                                    "أفضل مصدر للقوالب العربية بلا منازع! التصميمات حديثة وعصرية تواكب أحدث الاتجاهات. 
                                    استخدمت قوالبهم لإنشاء مدونتي الشخصية وموقع أعمالي، والنتائج رائعة. 
                                    السرعة والأداء ممتازان، والتخصيص سهل حتى للمبتدئين."
                                </blockquote>
                                
                                <div class="testimonial-rating" itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
                                    <div class="rating-stars">
                                        <i class="fas fa-star" aria-hidden="true"></i>
                                        <i class="fas fa-star" aria-hidden="true"></i>
                                        <i class="fas fa-star" aria-hidden="true"></i>
                                        <i class="fas fa-star" aria-hidden="true"></i>
                                        <i class="fas fa-star" aria-hidden="true"></i>
                                    </div>
                                    <meta itemprop="ratingValue" content="5">
                                    <meta itemprop="bestRating" content="5">
                                </div>
                            </div>
                            
                            <footer class="testimonial-author" itemprop="author" itemscope itemtype="https://schema.org/Person">
                                <div class="author-avatar">
                                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/testimonials/mohammed.jpg'); ?>" 
                                         alt="محمد علي" 
                                         loading="lazy"
                                         width="60" 
                                         height="60">
                                    <div class="avatar-ring"></div>
                                </div>
                                <div class="author-info">
                                    <h4 class="author-name" itemprop="name">محمد علي الأحمدي</h4>
                                    <p class="author-title" itemprop="jobTitle">مدون ومؤثر رقمي</p>
                                    <div class="author-company">مدونة التقنية العربية</div>
                                    <div class="author-location">
                                        <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                                        <span>مكة، السعودية</span>
                                    </div>
                                </div>
                            </footer>
                            
                            <meta itemprop="datePublished" content="2024-10-28">
                        </article>
                    </div>
                    
                    <!-- Navigation Enhanced -->
                    <div class="testimonials-navigation">
                        <button class="nav-btn prev-btn" 
                                id="testimonials-prev"
                                aria-label="الشهادة السابقة">
                            <i class="fas fa-chevron-right" aria-hidden="true"></i>
                        </button>
                        
                        <div class="testimonials-dots" id="testimonials-dots" role="tablist">
                            <button class="dot active" 
                                    role="tab" 
                                    aria-selected="true" 
                                    aria-label="الشهادة 1"></button>
                            <button class="dot" 
                                    role="tab" 
                                    aria-selected="false" 
                                    aria-label="الشهادة 2"></button>
                            <button class="dot" 
                                    role="tab" 
                                    aria-selected="false" 
                                    aria-label="الشهادة 3"></button>
                            <button class="dot" 
                                    role="tab" 
                                    aria-selected="false" 
                                    aria-label="الشهادة 4"></button>
                        </div>
                        
                        <button class="nav-btn next-btn" 
                                id="testimonials-next"
                                aria-label="الشهادة التالية">
                            <i class="fas fa-chevron-left" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Testimonials Stats -->
                <div class="testimonials-stats" data-aos="fade-up" data-aos-delay="600">
                    <div class="stats-grid">
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="fas fa-users" aria-hidden="true"></i>
                            </div>
                            <div class="stat-content">
                                <span class="stat-number" data-target="<?php echo $site_stats['subscribers']; ?>">0</span>
                                <span class="stat-label">عميل راض</span>
                            </div>
                        </div>
                        
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="fas fa-star" aria-hidden="true"></i>
                            </div>
                            <div class="stat-content">
                                <span class="stat-number" data-target="4.9">0</span>
                                <span class="stat-label">تقييم متوسط</span>
                            </div>
                        </div>
                        
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="fas fa-heart" aria-hidden="true"></i>
                            </div>
                            <div class="stat-content">
                                <span class="stat-number" data-target="98">0</span>
                                <span class="stat-label">% رضا العملاء</span>
                            </div>
                        </div>
                        
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="fas fa-redo" aria-hidden="true"></i>
                            </div>
                            <div class="stat-content">
                                <span class="stat-number" data-target="95">0</span>
                                <span class="stat-label">% عملاء متكررون</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Newsletter Section Enhanced -->
        <section class="newsletter-section" id="newsletter" aria-labelledby="newsletter-title">
            <div class="newsletter-background" aria-hidden="true">
                <div class="newsletter-particles"></div>
                <div class="newsletter-glow"></div>
                <div class="newsletter-waves"></div>
            </div>
            
            <div class="container">
                <div class="newsletter-content" data-aos="zoom-in">
                    <header class="newsletter-header">
                        <div class="newsletter-icon">
                            <i class="fas fa-paper-plane" aria-hidden="true"></i>
                            <div class="icon-glow"></div>
                        </div>
                        
                        <h2 id="newsletter-title" class="newsletter-title">ابق على اطلاع دائم</h2>
                        <p class="newsletter-description">
                            اشترك في نشرتنا الإخبارية للحصول على أحدث القوالب والعروض الحصرية 
                            والنص

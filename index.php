<?php
/**
 * الصفحة الرئيسية السينمائية - قوالب عربية ووردبريس
 * تجربة مركزة بدون تمرير - شاشة واحدة فقط
 * 
 * @package ArabicThemes
 * @author Tahactw
 * @date 2025-05-28
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title('|', true, 'right'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

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
    <div class="portal-text">
        <h2>جاري فتح بوابة القوالب...</h2>
        <div class="loading-progress">
            <div class="progress-bar"></div>
        </div>
    </div>
</div>

<!-- الصفحة الرئيسية المركزة -->
<main class="main-content homepage-focused">
    <!-- Hero Section الوحيد -->
    <section class="hero-section-fullscreen" id="hero-section">
        <div class="hero-cosmic-bg">
            <div class="cosmic-stars"></div>
            <div class="cosmic-nebula"></div>
            <div class="cosmic-portal"></div>
        </div>
        
        <div class="container-centered">
            <div class="hero-content-main">
                <!-- العنوان المتحرك -->
                <div class="animated-title-container">
                    <h1 class="hero-title-mega">
                        <span class="title-static">مرحباً بك في</span>
                        <span class="title-animated" id="animated-text">قوالب عربية ووردبريس</span>
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
                
                <!-- الأزرار المتطورة -->
                <div class="hero-actions-enhanced">
                    <button class="cinematic-portal-btn-main" id="portal-trigger">
                        <div class="btn-background">
                            <div class="btn-gradient"></div>
                            <div class="btn-particles-bg"></div>
                        </div>
                        <div class="btn-content">
                            <div class="btn-icon">
                                <i class="fas fa-rocket"></i>
                            </div>
                            <span class="btn-text">استكشاف القوالب الآن</span>
                            <div class="btn-ripple-effect"></div>
                        </div>
                        <div class="btn-aura"></div>
                    </button>
                    

                </div>
                
                <!-- إحصائيات متحركة محسنة -->
                <div class="hero-stats-enhanced floating-stats">
                    <div class="stat-item-mega" data-aos="flip-left" data-aos-delay="100">
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
                    
                    <div class="stat-item-mega" data-aos="flip-left" data-aos-delay="200">
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
                    
                    <div class="stat-item-mega" data-aos="flip-left" data-aos-delay="300">
                        <div class="stat-icon-enhanced">
                            <i class="fas fa-gift"></i>
                        </div>
                        <span class="stat-number-huge" data-target="100">0</span>
                        <span class="stat-label-enhanced">% مجاني</span>
                        <div class="stat-glow"></div>
                    </div>
                    
                    <div class="stat-item-mega" data-aos="flip-left" data-aos-delay="400">
                        <div class="stat-icon-enhanced">
                            <i class="fas fa-users"></i>
                        </div>
                        <span class="stat-number-huge" data-target="500">0</span>
                        <span class="stat-label-enhanced">مستخدم راضٍ</span>
                        <div class="stat-glow"></div>
                    </div>
                </div>
                
                <!-- شعار أو نص إضافي -->
                <div class="hero-footer-text">
                    <p class="slogan-text">
                        <i class="fas fa-star"></i>
                        مستقبل الويب العربي يبدأ من هنا
                        <i class="fas fa-star"></i>
                    </p>
                </div>
            </div>
        </div>
        
        <!-- عناصر خلفية إضافية -->
        <div class="floating-shapes-enhanced">
            <div class="shape-1"></div>
            <div class="shape-2"></div>
            <div class="shape-3"></div>
            <div class="shape-4"></div>
        </div>
    </section>
</main>

<style>
/* 🎬 الصفحة المركزة بدون تمرير */

/* إعادة تعيين وإيقاف التمرير */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

html, body {
    height: 100vh;
    width: 100vw;
    overflow: hidden !important; /* منع التمرير نهائياً */
    scroll-behavior: smooth;
    position: fixed; /* تثبيت المحتوى */
    top: 0;
    left: 0;
}

/* إخفاء جميع scroll bars */
::-webkit-scrollbar {
    display: none !important;
    width: 0 !important;
    height: 0 !important;
}

html {
    -ms-overflow-style: none !important;
    scrollbar-width: none !important;
}

/* 🌓 أيقونة Dark/Light Mode في الجانب */
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

.theme-toggle-btn:active .toggle-ripple {
    width: 120px;
    height: 120px;
}

/* تأثير الهالة */
.theme-toggle-btn::before {
    content: '';
    position: absolute;
    top: -5px;
    left: -5px;
    right: -5px;
    bottom: -5px;
    background: conic-gradient(from 0deg, transparent, rgba(59, 130, 246, 0.4), transparent);
    border-radius: 50%;
    opacity: 0;
    animation: toggleAura 3s ease-in-out infinite;
}

@keyframes toggleAura {
    0%, 100% { opacity: 0; transform: rotate(0deg); }
    50% { opacity: 1; transform: rotate(180deg); }
}

/* الصفحة الرئيسية المركزة */
.homepage-focused {
    height: 100vh;
    width: 100vw;
    background: #000011;
    color: #ffffff;
    position: fixed;
    top: 0;
    left: 0;
    overflow: hidden;
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

/* 🌀 البوابة السينمائية */
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

/* 🎪 العناصر العائمة */
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
}

.floating-letter {
    font-family: 'Cairo', sans-serif;
    font-weight: 800;
    color: rgba(139, 92, 246, 0.6);
}

.floating-icon:nth-child(1) { top: 20%; left: 10%; animation-delay: 0.2s; }
.floating-icon:nth-child(2) { top: 30%; right: 15%; animation-delay: 0.4s; }
.floating-icon:nth-child(3) { bottom: 20%; left: 20%; animation-delay: 0.6s; }
.floating-icon:nth-child(4) { bottom: 30%; right: 10%; animation-delay: 0.8s; }
.floating-icon:nth-child(5) { top: 15%; left: 50%; animation-delay: 1s; }
.floating-icon:nth-child(6) { bottom: 15%; left: 50%; animation-delay: 1.2s; }

.floating-letter:nth-child(7) { top: 25%; left: 30%; animation-delay: 0.3s; }
.floating-letter:nth-child(8) { top: 35%; right: 25%; animation-delay: 0.5s; }
.floating-letter:nth-child(9) { bottom: 25%; left: 35%; animation-delay: 0.7s; }
.floating-letter:nth-child(10) { bottom: 35%; right: 30%; animation-delay: 0.9s; }
.floating-letter:nth-child(11) { top: 10%; right: 50%; animation-delay: 1.1s; }

/* ⚙️ مركز البوابة */
.portal-center {
    position: relative;
    z-index: 10;
    opacity: 0;
    transform: scale(0);
    animation: portalCenterAppear 2s ease-out 0.5s forwards;
}

.portal-rings {
    position: relative;
    width: 300px;
    height: 300px;
}

.ring {
    position: absolute;
    border: 2px solid;
    border-radius: 50%;
    animation: ringRotate linear infinite;
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

.portal-core {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 60px;
    height: 60px;
    margin: -30px 0 0 -30px;
    background: linear-gradient(45deg, #3b82f6, #8b5cf6);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    animation: portalCorePulse 1s ease-in-out infinite alternate;
    box-shadow: 0 0 30px rgba(59, 130, 246, 0.8);
}

/* 📝 نص البوابة */
.portal-text {
    margin-top: 3rem;
    text-align: center;
    opacity: 0;
    animation: portalTextAppear 1s ease-out 1s forwards;
}

.portal-text h2 {
    font-size: 1.8rem;
    margin-bottom: 1rem;
    background: linear-gradient(45deg, #3b82f6, #8b5cf6);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.loading-progress {
    width: 300px;
    height: 4px;
    background: rgba(59, 130, 246, 0.2);
    border-radius: 2px;
    margin: 0 auto;
    overflow: hidden;
}

.progress-bar {
    width: 0%;
    height: 100%;
    background: linear-gradient(90deg, #3b82f6, #8b5cf6);
    border-radius: 2px;
    animation: progressLoad 2s ease-out;
}

/* 🌌 Hero Section الشاشة الكاملة */
.hero-section-fullscreen {
    position: relative;
    height: 100vh;
    width: 100vw;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10;
    text-align: center;
    overflow: hidden;
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

/* 📦 Container مركز */
.container-centered {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 2rem;
    position: relative;
    z-index: 10;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.hero-content-main {
    width: 100%;
    max-width: 1200px;
}

/* ✨ العنوان الضخم */
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

/* 🪄 النص السحري المحسن */
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

/* 🚀 الأزرار المحسنة */
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

.btn-content {
    position: relative;
    z-index: 2;
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.8rem 4rem;
    background: rgba(0, 0, 17, 0.9);
    margin: 2px;
    border-radius: 48px;
    transition: all 0.3s ease;
    font-size: 1.3rem;
    font-weight: 700;
    color: #ffffff;
}

.btn-icon {
    font-size: 1.5rem;
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
    top: -10px;
    left: -10px;
    right: -10px;
    bottom: -10px;
    background: radial-gradient(circle, rgba(59, 130, 246, 0.3) 0%, transparent 70%);
    border-radius: 50px;
    opacity: 0;
    animation: auraGlow 3s ease-in-out infinite;
}

/* الزر الثانوي */
.btn-secondary-cosmic {
    position: relative;
    display: inline-block;
    padding: 0;
    text-decoration: none;
    color: #ffffff;
    font-weight: 600;
    font-size: 1.1rem;
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
    padding: 1.2rem 2.5rem;
    transition: all 0.3s ease;
}

.btn-secondary-cosmic:hover {
    transform: translateY(-3px);
    border-color: #3b82f6;
    box-shadow: 0 15px 40px rgba(59, 130, 246, 0.3);
}

.btn-secondary-cosmic:hover .btn-secondary-bg {
    background: rgba(59, 130, 246, 0.2);
}

/* تأثيرات هوفر الزر الرئيسي */
.cinematic-portal-btn-main:hover {
    transform: translateY(-8px) scale(1.05);
    box-shadow: 0 25px 70px rgba(59, 130, 246, 0.4);
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

/* 📊 إحصائيات ضخمة */
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

/* 🌟 نص التذييل */
.hero-footer-text {
    margin-top: 3rem;
    opacity: 0;
    animation: fadeInUp 1s ease 4s both;
}

.slogan-text {
    font-size: 1.3rem;
    color: #b8b9ba;
    font-weight: 500;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
}

.slogan-text i {
    color: #fbbf24;
    animation: starTwinkle 2s ease-in-out infinite alternate;
}

/* 🎨 أشكال خلفية إضافية */
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

/* 🎭 الحركات والتأثيرات */
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

@keyframes starTwinkle {
    0% { transform: scale(1) rotate(0deg); }
    100% { transform: scale(1.2) rotate(180deg); }
}

@keyframes shapeFloat {
    0%, 100% { transform: translate(0, 0) scale(1) rotate(0deg); }
    25% { transform: translate(-20px, -20px) scale(1.1) rotate(90deg); }
    50% { transform: translate(20px, -10px) scale(0.9) rotate(180deg); }
    75% { transform: translate(-10px, 20px) scale(1.05) rotate(270deg); }
}

/* حركات البوابة السينمائية */
@keyframes portalBackgroundPulse {
    0% { opacity: 0.8; }
    100% { opacity: 1; }
}

@keyframes floatToCenter {
    0% { opacity: 0; transform: scale(0.5) translate(0, 0); }
    30% { opacity: 1; transform: scale(1) translate(0, -20px); }
    70% { opacity: 1; transform: scale(1.2) translate(calc(50vw - 50%), calc(50vh - 50%)); }
    100% { opacity: 0; transform: scale(0) translate(calc(50vw - 50%), calc(50vh - 50%)); }
}

@keyframes portalCenterAppear {
    0% { opacity: 0; transform: scale(0) rotate(0deg); }
    50% { opacity: 0.5; transform: scale(0.5) rotate(180deg); }
    100% { opacity: 1; transform: scale(1) rotate(360deg); }
}

@keyframes ringRotate {
    0% { transform: rotate(0deg); border-color: currentColor; }
    25% { border-color: #8b5cf6; }
    50% { transform: rotate(180deg); border-color: #ec4899; }
    75% { border-color: #f59e0b; }
    100% { transform: rotate(360deg); border-color: currentColor; }
}

@keyframes portalCorePulse {
    0% { transform: scale(1); box-shadow: 0 0 30px rgba(59, 130, 246, 0.8); }
    100% { transform: scale(1.1); box-shadow: 0 0 50px rgba(59, 130, 246, 1), 0 0 80px rgba(139, 92, 246, 0.5); }
}

@keyframes portalTextAppear {
    0% { opacity: 0; transform: translateY(20px); }
    100% { opacity: 1; transform: translateY(0); }
}

@keyframes progressLoad {
    0% { width: 0%; }
    100% { width: 100%; }
}

@keyframes iconFloat {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-8px); }
}

@keyframes particlesBgMove {
    0% { background-position: 0 0; }
    100% { background-position: 20px 20px; }
}

@keyframes auraGlow {
    0%, 100% { opacity: 0; transform: scale(0.8); }
    50% { opacity: 1; transform: scale(1.2); }
}

@keyframes buttonPulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); filter: brightness(1.3); }
    100% { transform: scale(1); }
}

/* 📱 التصميم المتجاوب للشاشة الواحدة */
@media (max-width: 1024px) {
    .hero-title-mega { font-size: 4rem; }
    .title-static { font-size: 2rem; }
    .hero-stats-enhanced { gap: 2rem; }
    .stat-item-mega { min-width: 160px; padding: 2rem 1.5rem; }
    .theme-toggle-sidebar { right: 20px; }
    .theme-toggle-btn { width: 50px; height: 50px; }
    .container-centered { padding: 0 1rem; }
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
    .hero-actions-enhanced { 
        flex-direction: column; 
        gap: 1.5rem; 
        margin-bottom: 3rem;
    }
    .btn-content { padding: 1.5rem 3rem; font-size: 1.1rem; }
    .theme-toggle-sidebar { right: 15px; }
    .theme-toggle-btn { width: 45px; height: 45px; }
    .floating-shapes-enhanced { display: none; }
}

@media (max-width: 480px) {
    .hero-title-mega { font-size: 2.5rem; }
    .title-static { font-size: 1.2rem; }
    .hero-description-enhanced { font-size: 1rem; }
    .stat-item-mega { width: 180px; padding: 1.5rem; }
    .stat-number-huge { font-size: 2.8rem; }
    .stat-icon-enhanced { font-size: 2.5rem; }
    .btn-content { padding: 1.2rem 2rem; font-size: 1rem; }
    .btn-secondary-text { padding: 1rem 2rem; font-size: 1rem; }
    .theme-toggle-sidebar { right: 10px; }
    .theme-toggle-btn { width: 40px; height: 40px; }
    .toggle-icon { width: 18px; height: 18px; }
    .sun-icon, .moon-icon { font-size: 14px; }
    .container-centered { padding: 0 0.5rem; }
}

/* 🌐 دعم RTL */
[dir="rtl"] .title-cursor { margin-left: 0; margin-right: 5px; }
[dir="rtl"] .hero-actions-enhanced { flex-direction: row-reverse; }
[dir="rtl"] .btn-content, [dir="rtl"] .btn-secondary-text { flex-direction: row-reverse; }
[dir="rtl"] .theme-toggle-sidebar { right: auto; left: 30px; }
[dir="rtl"] .slogan-text { flex-direction: row-reverse; }

/* 🌓 Dark Mode Styles */
body.dark-mode {
    background: #000000;
}

body.dark-mode .homepage-focused {
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

/* Light Mode Styles */
body.light-mode {
    background: #f8fafc;
}

body.light-mode .homepage-focused {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    color: #1e293b;
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

body.light-mode .slogan-text {
    color: #64748b;
}

body.light-mode .parallax-layer {
    background: radial-gradient(circle, rgba(59, 130, 246, 0.05) 1px, transparent 1px);
}

/* ⚡ تحسينات الأداء */
.stat-item-mega, .cinematic-portal-btn-main, .btn-secondary-cosmic, .theme-toggle-btn {
    will-change: transform, box-shadow;
    contain: layout style paint;
}

.cosmic-stars, .cosmic-nebula, .floating-shapes-enhanced {
    will-change: transform;
}

/* 📱 تأثيرات خاصة للمس */
@media (hover: none) {
    .stat-item-mega:hover { transform: translateY(-8px) scale(1.02); }
    .cinematic-portal-btn-main:hover { transform: translateY(-4px) scale(1.02); }
    .theme-toggle-btn:hover { transform: scale(1.05); }
}

/* 🖥️ تحسينات للعرض الكامل */
@media (min-width: 1440px) {
    .container-centered { max-width: 1600px; }
    .hero-title-mega { font-size: 6rem; }
    .title-static { font-size: 3rem; }
    .theme-toggle-sidebar { right: 50px; }
    .theme-toggle-btn { width: 70px; height: 70px; }
}

@media (min-width: 2560px) {
    .container-centered { max-width: 2000px; }
    .hero-title-mega { font-size: 7rem; }
    .cinematic-portal-btn-main { transform: scale(1.2); }
    .theme-toggle-sidebar { right: 80px; }
    .theme-toggle-btn { width: 80px; height: 80px; }
}

/* 🎛️ تحسينات للأجهزة الضعيفة */
@media (max-width: 768px) {
    #particles-canvas { opacity: 0.5; }
    .theme-toggle-btn::before { display: none; }
    .floating-shapes-enhanced { display: none; }
}

@media (prefers-reduced-motion: reduce) {
    * { animation-duration: 0.1s !important; animation-iteration-count: 1 !important; transition-duration: 0.1s !important; }
    .cinematic-portal { animation: none !important; }
    .theme-toggle-btn::before { animation: none !important; }
}
</style>

<script>
// 🎬 JavaScript السينمائي للصفحة المركزة
document.addEventListener('DOMContentLoaded', function() {
    console.log('🎬 الصفحة المركزة جاهزة!');
    
    // منع التمرير نهائياً
    disableScrolling();
    
    // تهيئة جميع التأثيرات
    initParticles();
    initAnimatedText();
    initCinematicPortal();
    initCounters();
    initCosmicEffects();
    initThemeToggle();
    initMouseEffects();
    initAOS();
});

// 🚫 منع التمرير نهائياً
function disableScrolling() {
    // منع التمرير بالعجلة
    window.addEventListener('wheel', preventDefault, { passive: false });
    
    // منع التمرير باللمس
    window.addEventListener('touchmove', preventDefault, { passive: false });
    
    // منع مفاتيح التمرير
    window.addEventListener('keydown', preventDefaultForScrollKeys, false);
    
    function preventDefault(e) {
        e.preventDefault();
    }
    
    function preventDefaultForScrollKeys(e) {
        const scrollKeys = [32, 33, 34, 35, 36, 37, 38, 39, 40];
        if (scrollKeys.includes(e.keyCode)) {
            preventDefault(e);
            return false;
        }
    }
    
    // منع التمرير في CSS
    document.body.style.overflow = 'hidden';
    document.documentElement.style.overflow = 'hidden';
}

// 🌓 نظام تبديل المظهر المحسن
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
        triggerToggleRipple(this);
        
        // إزالة التأثير الانتقالي بعد اكتماله
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
        
        metaThemeColor.content = theme === 'dark' ? '#000011' : '#f8fafc';
        
        // تحديث الجسيمات لتتناسب مع المظهر
        updateParticlesForTheme(theme);
    }
    
    function triggerToggleRipple(button) {
        const ripple = button.querySelector('.toggle-ripple');
        ripple.style.width = '120px';
        ripple.style.height = '120px';
        
        setTimeout(() => {
            ripple.style.width = '0';
            ripple.style.height = '0';
        }, 600);
    }
    
    function updateParticlesForTheme(theme) {
        if (window.particleSystem) {
            window.particleSystem.updateTheme(theme);
        }
    }
}

// 🔤 النص المتحرك المحدث
function initAnimatedText() {
    const animatedText = document.getElementById('animated-text');
    if (!animatedText) return;
    
    const phrases = [
        'قوالب عربية ووردبريس',
        'تصاميم حديثة ومبتكرة',
        'إبداع لا محدود',
        'جودة احترافية عالية',
        'مستقبل الويب العربي'
    ];
    
    let currentPhrase = 0;
    let currentChar = 0;
    let isDeleting = false;
    let isWaiting = false;
    
    function typeText() {
        const current = phrases[currentPhrase];
        
        if (isWaiting) {
            setTimeout(() => {
                isWaiting = false;
                isDeleting = true;
                typeText();
            }, 2000);
            return;
        }
        
        if (isDeleting) {
            animatedText.textContent = current.substring(0, currentChar - 1);
            currentChar--;
            
            if (currentChar === 0) {
                isDeleting = false;
                currentPhrase = (currentPhrase + 1) % phrases.length;
            }
        } else {
            animatedText.textContent = current.substring(0, currentChar + 1);
            currentChar++;
            
            if (currentChar === current.length) {
                isWaiting = true;
            }
        }
        
        const speed = isDeleting ? 50 : 100;
        setTimeout(typeText, speed);
    }
    
    // بدء التأثير بعد 4 ثوانٍ
    setTimeout(typeText, 4000);
}

// 🌀 البوابة السينمائية المتطورة
function initCinematicPortal() {
    const portalTrigger = document.getElementById('portal-trigger');
    const cinematicPortal = document.getElementById('cinematic-portal');
    
    if (!portalTrigger || !cinematicPortal) return;
    
    // معالج النقر على الزر
    portalTrigger.addEventListener('click', function(e) {
        e.preventDefault();
        
        // منع النقرات المتعددة
        if (this.classList.contains('disabled')) return;
        this.classList.add('disabled');
        
        // تشغيل تأثير الزر
        triggerButtonEffects(this);
        
        // تشغيل البوابة السينمائية
        setTimeout(() => {
            activateCinematicPortal();
        }, 300);
    });
    
    // 💥 تأثيرات الزر
    function triggerButtonEffects(button) {
        // نبضة الزر
        button.style.animation = 'buttonPulse 0.3s ease-out';
        
        // تأثير الريبل
        const ripple = button.querySelector('.btn-ripple-effect');
        ripple.style.width = '400px';
        ripple.style.height = '400px';
        
        // إضافة جسيمات متفجرة
        createButtonExplosion(button);
        
        setTimeout(() => {
            button.style.opacity = '0';
            button.style.transform = 'scale(0.8)';
        }, 200);
    }
    
    // 🎆 انفجار الجسيمات من الزر
    function createButtonExplosion(button) {
        const rect = button.getBoundingClientRect();
        const centerX = rect.left + rect.width / 2;
        const centerY = rect.top + rect.height / 2;
        
        for (let i = 0; i < 25; i++) {
            const particle = document.createElement('div');
            particle.style.cssText = `
                position: fixed;
                left: ${centerX}px;
                top: ${centerY}px;
                width: 8px;
                height: 8px;
                background: linear-gradient(45deg, #3b82f6, #8b5cf6);
                border-radius: 50%;
                pointer-events: none;
                z-index: 9999;
                transform: translate(-50%, -50%);
            `;
            
            document.body.appendChild(particle);
            
            const angle = (Math.PI * 2 * i) / 25;
            const velocity = 120 + Math.random() * 120;
            const endX = centerX + Math.cos(angle) * velocity;
            const endY = centerY + Math.sin(angle) * velocity;
            
            particle.animate([
                { 
                    left: centerX + 'px', 
                    top: centerY + 'px', 
                    opacity: 1, 
                    transform: 'translate(-50%, -50%) scale(1)' 
                },
                { 
                    left: endX + 'px', 
                    top: endY + 'px', 
                    opacity: 0, 
                    transform: 'translate(-50%, -50%) scale(0)' 
                }
            ], {
                duration: 1200,
                easing: 'cubic-bezier(0.25, 0.46, 0.45, 0.94)'
            }).onfinish = () => particle.remove();
        }
    }
    
    // 🎬 تفعيل البوابة السينمائية
    function activateCinematicPortal() {
        // إظهار البوابة
        cinematicPortal.classList.add('active');
        
        // تعتيم الخلفية
        document.body.style.transition = 'filter 0.5s ease';
        document.body.style.filter = 'blur(4px) brightness(0.2)';
        
        // بدء تسلسل التأثيرات
        setTimeout(() => startPortalSequence(), 200);
    }
    
    // 🎭 تسلسل تأثيرات البوابة
    function startPortalSequence() {
        const portalWave = cinematicPortal.querySelector('.portal-wave');
        const floatingElements = cinematicPortal.querySelectorAll('.floating-icon, .floating-letter');
        
        // المرحلة 1: إطلاق الموجة
        cinematicPortal.classList.add('portal-expanding');
        portalWave.classList.add('expanding');
        
        // المرحلة 2: تحريك العناصر العائمة
        setTimeout(() => {
            floatingElements.forEach((element, index) => {
                element.style.opacity = '1';
                element.style.animation = `floatToCenter 3s ease-in-out ${index * 0.1}s forwards`;
            });
        }, 300);
        
        // المرحلة 3: إظهار مركز البوابة
        setTimeout(() => {
            const portalCenter = cinematicPortal.querySelector('.portal-center');
            portalCenter.style.opacity = '1';
            portalCenter.style.transform = 'scale(1)';
        }, 800);
        
        // المرحلة 4: النص والتقدم
        setTimeout(() => {
            const portalText = cinematicPortal.querySelector('.portal-text');
            portalText.style.opacity = '1';
            
            // بدء شريط التقدم
            const progressBar = cinematicPortal.querySelector('.progress-bar');
            progressBar.style.width = '100%';
        }, 1200);
        
        // المرحلة 5: التكبير النهائي والانتقال
        setTimeout(() => {
            startFinalTransition();
        }, 3500);
    }
    
    // 🚀 الانتقال النهائي
    function startFinalTransition() {
        const portalCenter = cinematicPortal.querySelector('.portal-center');
        
        // تكبير مركز البوابة
        portalCenter.style.animation += ', finalZoomEffect 1s ease-in forwards';
        
        // تأثير التكبير العام
        cinematicPortal.style.animation = 'portalZoomIn 1s ease-in forwards';
        
        // انتقال الصفحة
        setTimeout(() => {
            document.body.style.animation = 'pageTransition 1s ease-in-out forwards';
            
            // الانتقال الفعلي
            setTimeout(() => {
                // الحصول على رابط القوالب
                const themesLink = document.querySelector('[href*="wp_themes"]')?.href || 
                                  document.querySelector('.btn-quantum')?.href ||
                                  '/wp_themes/';
                
                window.location.href = '/themes/';

            }, 1000);
        }, 500);
    }
}

// ⭐ نظام الجسيمات المتحركة المحسن
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
    
    // 🌟 فئة الجسيم المحسنة
    class Particle {
        constructor() {
            this.reset();
        }
        
        reset() {
            this.x = Math.random() * canvas.width;
            this.y = Math.random() * canvas.height;
            this.size = Math.random() * 4 + 1;
            this.speedX = (Math.random() - 0.5) * 1;
            this.speedY = (Math.random() - 0.5) * 1;
            this.color = this.getRandomColor();
            this.opacity = Math.random() * 0.6 + 0.3;
            this.pulse = Math.random() * 0.02 + 0.01;
            this.life = 1.0;
            this.decay = Math.random() * 0.005 + 0.001;
            this.angle = Math.random() * Math.PI * 2;
            this.angleSpeed = (Math.random() - 0.5) * 0.02;
        }
        
        getRandomColor() {
            const isDark = document.body.classList.contains('dark-mode');
            if (isDark) {
                const colors = [
                    `hsl(${200 + Math.random() * 60}, 80%, 65%)`,
                    `hsl(${250 + Math.random() * 60}, 80%, 65%)`,
                    `hsl(${300 + Math.random() * 60}, 80%, 65%)`
                ];
                return colors[Math.floor(Math.random() * colors.length)];
            } else {
                const colors = [
                    `hsl(${200 + Math.random() * 60}, 70%, 55%)`,
                    `hsl(${250 + Math.random() * 60}, 70%, 55%)`,
                    `hsl(${300 + Math.random() * 60}, 70%, 55%)`
                ];
                return colors[Math.floor(Math.random() * colors.length)];
            }
        }
        
        update() {
            this.x += this.speedX;
            this.y += this.speedY;
            this.angle += this.angleSpeed;
            
            // إعادة تدوير الجسيمات
            if (this.x > canvas.width) this.x = 0;
            if (this.x < 0) this.x = canvas.width;
            if (this.y > canvas.height) this.y = 0;
            if (this.y < 0) this.y = canvas.height;
            
            // تأثير النبض
            this.opacity += this.pulse;
            if (this.opacity > 0.8 || this.opacity < 0.2) {
                this.pulse *= -1;
            }
            
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
            
            // رسم جسيم مع دوران
            ctx.translate(this.x, this.y);
            ctx.rotate(this.angle);
            
            ctx.beginPath();
            ctx.arc(0, 0, this.size, 0, Math.PI * 2);
            ctx.fill();
            
            // تأثير الهالة المحسن
            ctx.shadowBlur = 20;
            ctx.shadowColor = this.color;
            ctx.fill();
            
            ctx.restore();
        }
        
        updateTheme(theme) {
            this.color = this.getRandomColor();
        }
    }
    
    // إنشاء الجسيمات
    for (let i = 0; i < 150; i++) {
        particles.push(new Particle());
    }
    
    // نظام الجسيمات العالمي
    window.particleSystem = {
        updateTheme: function(theme) {
            particles.forEach(particle => particle.updateTheme(theme));
        }
    };
    
    // حلقة الرسم المحسنة
    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        
        particles.forEach(particle => {
            particle.update();
            particle.draw();
        });
        
        // رسم خطوط الاتصال المحسنة
        drawAdvancedConnections();
        
        animationId = requestAnimationFrame(animate);
    }
    
    // 🌐 رسم خطوط الاتصال المتقدمة
    function drawAdvancedConnections() {
        for (let i = 0; i < particles.length; i++) {
            for (let j = i + 1; j < particles.length; j++) {
                const dx = particles[i].x - particles[j].x;
                const dy = particles[i].y - particles[j].y;
                const distance = Math.sqrt(dx * dx + dy * dy);
                
                if (distance < 180) {
                    ctx.save();
                    const opacity = (180 - distance) / 180 * 0.5;
                    ctx.globalAlpha = opacity;
                    
                    // تدرج لوني للخط
                    const gradient = ctx.createLinearGradient(
                        particles[i].x, particles[i].y,
                        particles[j].x, particles[j].y
                    );
                    gradient.addColorStop(0, '#3b82f6');
                    gradient.addColorStop(0.5, '#8b5cf6');
                    gradient.addColorStop(1, '#ec4899');
                    
                    ctx.strokeStyle = gradient;
                    ctx.lineWidth = 1.5;
                    ctx.beginPath();
                    ctx.moveTo(particles[i].x, particles[i].y);
                    ctx.lineTo(particles[j].x, particles[j].y);
                    ctx.stroke();
                    ctx.restore();
                }
            }
        }
    }
    
    animate();
    
    // تنظيف الذاكرة عند إلغاء تحميل الصفحة
    window.addEventListener('beforeunload', () => {
        if (animationId) {
            cancelAnimationFrame(animationId);
        }
    });
}

// 📊 العدادات المتحركة المحسنة
function initCounters() {
    const counters = document.querySelectorAll('.stat-number-huge[data-target]');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.3 });
    
    counters.forEach(counter => observer.observe(counter));
    
    function animateCounter(element) {
        const target = parseInt(element.dataset.target);
        const duration = 3000;
        const startTime = performance.now();
        
        function updateCounter(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            
            // تأثير Easing متقدم
            const easeOutElastic = progress === 1 ? 1 : 
                1 - Math.pow(2, -10 * progress) * Math.sin((progress * 10 - 0.75) * (2 * Math.PI) / 3);
            
            const current = Math.floor(target * easeOutElastic);
            
            element.textContent = current.toLocaleString('ar');
            
            // تأثير لوني أثناء العد
            const hue = 200 + (progress * 120);
            element.style.filter = `hue-rotate(${hue}deg)`;
            
            // تأثير التكبير أثناء العد
            const scale = 1 + (Math.sin(progress * Math.PI * 4) * 0.1);
            element.style.transform = `scale(${scale})`;
            
            if (progress < 1) {
                requestAnimationFrame(updateCounter);
            } else {
                element.textContent = target.toLocaleString('ar');
                element.style.filter = '';
                element.style.transform = 'scale(1)';
                
                // تأثير نهائي محسن
                element.style.animation = 'counterFinish 1s ease, counterGlow 3s ease-in-out infinite';
                
                // تفعيل الهالة
                const statGlow = element.parentElement.querySelector('.stat-glow');
                if (statGlow) {
                    statGlow.style.opacity = '1';
                    statGlow.style.width = '250px';
                    statGlow.style.height = '250px';
                }
            }
        }
        
        requestAnimationFrame(updateCounter);
    }
}

// 🌌 التأثيرات الكونية المحسنة
function initCosmicEffects() {
    // تأثير النجوم المتلألئة المحسن
    createAdvancedStars();
    
    // تأثير الأشكال العائمة
    animateFloatingShapes();
    
    // تأثير التحريك التلقائي للخلفية
    animateCosmicBackground();
}

// ⭐ إنشاء نجوم متقدمة
function createAdvancedStars() {
    const container = document.querySelector('.hero-section-fullscreen');
    if (!container) return;
    
    for (let i = 0; i < 50; i++) {
        const star = document.createElement('div');
        star.className = 'advanced-floating-star';
        
        const size = Math.random() * 4 + 1;
        const x = Math.random() * 100;
        const y = Math.random() * 100;
        const delay = Math.random() * 10;
        const duration = 6 + Math.random() * 8;
        const color = `hsl(${200 + Math.random() * 120}, 80%, ${70 + Math.random() * 20}%)`;
        
        star.style.cssText = `
            position: absolute;
            width: ${size}px;
            height: ${size}px;
            background: ${color};
            border-radius: 50%;
            left: ${x}%;
            top: ${y}%;
            opacity: 0;
            pointer-events: none;
            z-index: 4;
            box-shadow: 0 0 ${size * 4}px ${color}, 0 0 ${size * 8}px ${color};
            animation: advancedStarFloat ${duration}s ease-in-out infinite ${delay}s;
        `;
        
        container.appendChild(star);
    }
}

// 🎨 تحريك الأشكال العائمة
function animateFloatingShapes() {
    const shapes = document.querySelectorAll('.floating-shapes-enhanced > div');
    
    shapes.forEach((shape, index) => {
        let angle = 0;
        const radius = 50 + index * 20;
        const speed = 0.01 + index * 0.005;
        
        function animate() {
            angle += speed;
            const x = Math.cos(angle) * radius;
            const y = Math.sin(angle) * radius;
            
            shape.style.transform = `translate(${x}px, ${y}px) rotate(${angle * 57.3}deg)`;
            
            requestAnimationFrame(animate);
        }
        
        animate();
    });
}

// 🌌 تحريك الخلفية الكونية
function animateCosmicBackground() {
    const cosmicPortal = document.querySelector('.cosmic-portal');
    const cosmicNebula = document.querySelector('.cosmic-nebula');
    
    if (cosmicPortal || cosmicNebula) {
        let time = 0;
        
        function animate() {
            time += 0.01;
            
            if (cosmicPortal) {
                const rotate = Math.sin(time) * 5;
                const scale = 1 + Math.sin(time * 0.5) * 0.1;
                cosmicPortal.style.transform = `translate(-50%, -50%) rotate(${rotate}deg) scale(${scale})`;
            }
            
            if (cosmicNebula) {
                const opacity = 0.8 + Math.sin(time * 2) * 0.2;
                cosmicNebula.style.opacity = opacity;
            }
            
            requestAnimationFrame(animate);
        }
        
        animate();
    }
}

// 🖱️ تأثيرات الماوس المحسنة
function initMouseEffects() {
    let mouseX = 0;
    let mouseY = 0;
    
    document.addEventListener('mousemove', function(e) {
        mouseX = e.clientX / window.innerWidth;
        mouseY = e.clientY / window.innerHeight;
        
        // تحديث موقع الخلفية الكونية
        const cosmicPortal = document.querySelector('.cosmic-portal');
        if (cosmicPortal) {
            const moveX = (mouseX - 0.5) * 40;
            const moveY = (mouseY - 0.5) * 40;
            cosmicPortal.style.transform += ` translate(${moveX}px, ${moveY}px)`;
        }
        
        // تأثير الشعاع المتبع المحسن
        if (Math.random() < 0.15) {
            createEnhancedMouseTrail(e.clientX, e.clientY);
        }
        
        // تأثير الإضاءة على البطاقات
        updateStatsLighting(e.clientX, e.clientY);
    });
    
    // تحديث إضاءة الإحصائيات
    function updateStatsLighting(mouseX, mouseY) {
        const statItems = document.querySelectorAll('.stat-item-mega');
        
        statItems.forEach(item => {
            const rect = item.getBoundingClientRect();
            const centerX = rect.left + rect.width / 2;
            const centerY = rect.top + rect.height / 2;
            
            const distance = Math.sqrt(
                Math.pow(mouseX - centerX, 2) + Math.pow(mouseY - centerY, 2)
            );
            
            if (distance < 200) {
                const intensity = (200 - distance) / 200;
                item.style.boxShadow = `0 0 ${30 * intensity}px rgba(59, 130, 246, ${0.5 * intensity})`;
            } else {
                item.style.boxShadow = '';
            }
        });
    }
}

// ✨ شعاع متبع محسن للماوس
function createEnhancedMouseTrail(x, y) {
    const trail = document.createElement('div');
    const size = Math.random() * 12 + 6;
    const colors = ['#3b82f6', '#8b5cf6', '#ec4899', '#f59e0b'];
    const color = colors[Math.floor(Math.random() * colors.length)];
    
    trail.style.cssText = `
        position: fixed;
        left: ${x}px;
        top: ${y}px;
        width: ${size}px;
        height: ${size}px;
        background: radial-gradient(circle, ${color}, transparent);
        border-radius: 50%;
        pointer-events: none;
        z-index: 9999;
        transform: translate(-50%, -50%);
        animation: enhancedTrailFade 2s ease-out forwards;
    `;
    
    document.body.appendChild(trail);
    
    setTimeout(() => trail.remove(), 2000);
}

// 🎬 تهيئة AOS محسن
function initAOS() {
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 1500,
            easing: 'ease-out-cubic',
            once: true,
            offset: 50,
            delay: 200,
            anchorPlacement: 'top-bottom'
        });
    }
}

// 🚀 تأثير تحميل الصفحة محسن
window.addEventListener('load', function() {
    document.body.classList.remove('page-loading');
    document.body.classList.add('page-loaded');
    
    // تأثير الترحيب المحسن
    setTimeout(() => {
        const title = document.querySelector('.title-animated');
        if (title) {
            title.style.animation += ', welcomePulse 4s ease-in-out';
        }
        
        // إضافة تأثير خاص للصفحة
        document.body.style.animation = 'pageWelcome 3s ease-out';
        
        // تفعيل التأثيرات التلقائية
        startAutoEffects();
    }, 4000);
});

// 🎯 تأثيرات تلقائية
function startAutoEffects() {
    // تأثير نبضة دورية للأزرار
    setInterval(() => {
        const mainButton = document.querySelector('.cinematic-portal-btn-main');
        if (mainButton && !mainButton.classList.contains('disabled')) {
            mainButton.style.animation = 'buttonPulse 2s ease-in-out';
            setTimeout(() => {
                mainButton.style.animation = '';
            }, 2000);
        }
    }, 10000);
    
    // تأثير وميض دوري للإحصائيات
    setInterval(() => {
        const stats = document.querySelectorAll('.stat-item-mega');
        stats.forEach((stat, index) => {
            setTimeout(() => {
                stat.style.animation = 'iconPulse 1s ease-in-out';
                setTimeout(() => {
                    stat.style.animation = '';
                }, 1000);
            }, index * 200);
        });
    }, 15000);
}

// 🎯 CSS إضافي للتأثيرات الجديدة
const enhancedAnimations = `
<style>
@keyframes counterFinish {
    0% { transform: scale(1); }
    50% { transform: scale(1.3); color: #3b82f6; }
    100% { transform: scale(1); }
}

@keyframes counterGlow {
    0%, 100% { text-shadow: 0 0 15px rgba(59, 130, 246, 0.6); }
    50% { text-shadow: 0 0 30px rgba(59, 130, 246, 1), 0 0 50px rgba(139, 92, 246, 0.7); }
}

@keyframes advancedStarFloat {
    0% { opacity: 0; transform: translateY(30px) scale(0) rotate(0deg); }
    15% { opacity: 1; transform: translateY(0) scale(1) rotate(180deg); }
    85% { opacity: 1; transform: translateY(-40px) scale(1.3) rotate(360deg); }
    100% { opacity: 0; transform: translateY(-70px) scale(0) rotate(540deg); }
}

@keyframes enhancedTrailFade {
    0% { opacity: 1; transform: translate(-50%, -50%) scale(1); filter: blur(0px); }
    100% { opacity: 0; transform: translate(-50%, -50%) scale(3); filter: blur(8px); }
}

@keyframes finalZoomEffect {
    0% { transform: scale(1); border-radius: 50%; }
    100% { transform: scale(15); border-radius: 0%; }
}

@keyframes portalZoomIn {
    0% { transform: scale(1); opacity: 1; }
    100% { transform: scale(3); opacity: 0; }
}

@keyframes pageTransition {
    0% { transform: scale(1) rotate(0deg); opacity: 1; filter: blur(0px); }
    50% { transform: scale(0.7) rotate(8deg); opacity: 0.3; filter: blur(8px); }
    100% { transform: scale(0.2) rotate(20deg); opacity: 0; filter: blur(25px); }
}

@keyframes pageWelcome {
    0% { filter: hue-rotate(0deg) brightness(1); }
    25% { filter: hue-rotate(90deg) brightness(1.1); }
    50% { filter: hue-rotate(180deg) brightness(1.2); }
    75% { filter: hue-rotate(270deg) brightness(1.1); }
    100% { filter: hue-rotate(360deg) brightness(1); }
}

@keyframes welcomePulse {
    0%, 100% { transform: scale(1); }
    20% { transform: scale(1.05); filter: brightness(1.2); }
    40% { transform: scale(1.08); filter: brightness(1.4); }
    60% { transform: scale(1.05); filter: brightness(1.2); }
    80% { transform: scale(1.02); filter: brightness(1.1); }
}

.advanced-floating-star {
    will-change: transform, opacity;
}

.stat-item-mega {
    will-change: transform, box-shadow;
}
</style>
`;

// إضافة الأنماط المحسنة
document.head.insertAdjacentHTML('beforeend', enhancedAnimations);

// 🎨 رسائل الطباعة للمطورين
console.log('🎬 الصفحة المركزة جاهزة!');
console.log('✨ تأثيرات متقدمة مُفعلة!');
console.log('🌓 نظام تبديل المظهر نشط!');
console.log('🚫 التمرير مُعطل نهائياً!');
console.log('🎯 تجربة مركزة 100%!');
console.log('🚀 الأداء محسن للجميع!');
console.log('🎨 إبداع لا محدود!');
console.log('🌟 قوالب عربية ووردبريس - مستقبل الويب العربي!');
console.log('👨‍💻 تم التطوير بواسطة: Tahactw');
console.log('📅 تاريخ التطوير: 2025-05-28');
</script>

<?php wp_footer(); ?>
</body>
</html>
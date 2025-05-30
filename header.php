<?php
/**
 * رأس الصفحة - قوالب عربية ووردبريس
 * إصدار محسن ومبسط
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
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <!-- Header مبسط -->
    <header id="masthead" class="site-header">
    </header>

    <div id="content" class="site-content">

<style>
/* أنماط الـ Header المبسط */
.site-header {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000;
    background: rgba(10, 10, 15, 0.9);
    backdrop-filter: blur(20px);
    border-bottom: 1px solid rgba(59, 130, 246, 0.1);
    padding: 0;
    height: 70px;
    display: flex;
    align-items: center;
    justify-content: flex-end;
    padding-right: 2rem;
    transition: all 0.3s ease;
}

/* زر تغيير المظهر */
.theme-switcher {
    position: relative;
}

.theme-toggle-btn {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    border: 2px solid rgba(59, 130, 246, 0.3);
    background: rgba(26, 26, 46, 0.8);
    color: #3b82f6;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    position: relative;
    overflow: hidden;
    backdrop-filter: blur(10px);
}

.theme-toggle-btn:hover {
    border-color: #3b82f6;
    background: rgba(59, 130, 246, 0.1);
    transform: scale(1.1);
    box-shadow: 0 10px 30px rgba(59, 130, 246, 0.3);
}

.theme-toggle-btn .dark-icon,
.theme-toggle-btn .light-icon {
    position: absolute;
    transition: all 0.3s ease;
}

.theme-toggle-btn .light-icon {
    opacity: 0;
    transform: rotate(180deg) scale(0);
}

/* حالة المظهر الفاتح */
body.light-theme .theme-toggle-btn .dark-icon {
    opacity: 0;
    transform: rotate(-180deg) scale(0);
}

body.light-theme .theme-toggle-btn .light-icon {
    opacity: 1;
    transform: rotate(0deg) scale(1);
}

/* تعديل المحتوى للـ header */
.site-content {
    padding-top: 0;
}

.homepage .hero-section {
    padding-top: 0;
}

/* إخفاء الـ header في الصفحة الرئيسية عند التمرير لأعلى */
.homepage .site-header {
    transform: translateY(-100%);
    transition: transform 0.3s ease;
}

.homepage.scrolled .site-header {
    transform: translateY(0);
}

/* التصميم المتجاوب */
@media (max-width: 768px) {
    .site-header {
        padding-right: 1rem;
        height: 60px;
    }
    
    .theme-toggle-btn {
        width: 45px;
        height: 45px;
        font-size: 1.1rem;
    }
}

/* دعم RTL */
[dir="rtl"] .site-header {
    padding-right: 0;
    padding-left: 2rem;
    justify-content: flex-start;
}

[dir="rtl"] .theme-toggle-btn {
    direction: ltr;
}

@media (max-width: 768px) {
    [dir="rtl"] .site-header {
        padding-left: 1rem;
    }
}

/* أنماط المظهر الفاتح */
body.light-theme {
    --bg-primary: #ffffff;
    --bg-secondary: #f8fafc;
    --text-primary: #1f2937;
    --text-secondary: #6b7280;
    --border-color: rgba(0, 0, 0, 0.1);
}

body.light-theme .site-header {
    background: rgba(255, 255, 255, 0.9);
    border-bottom-color: rgba(0, 0, 0, 0.1);
}

body.light-theme .theme-toggle-btn {
    background: rgba(248, 250, 252, 0.8);
    border-color: rgba(59, 130, 246, 0.3);
    color: #f59e0b;
}

body.light-theme .theme-toggle-btn:hover {
    background: rgba(59, 130, 246, 0.1);
    border-color: #f59e0b;
}

/* تطبيق متغيرات المظهر الفاتح */
body.light-theme .homepage {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 50%, #cbd5e1 100%);
    color: var(--text-primary);
}

body.light-theme .hero-content {
    color: var(--text-primary);
}

body.light-theme .hero-description {
    color: var(--text-secondary);
}

body.light-theme .title-sub {
    color: var(--text-secondary);
}

body.light-theme .latest-themes-section {
    background: rgba(248, 250, 252, 0.8);
}

body.light-theme .theme-card-simple {
    background: rgba(255, 255, 255, 0.9);
    border-color: var(--border-color);
    color: var(--text-primary);
}

body.light-theme .theme-title a {
    color: var(--text-primary);
}

body.light-theme .theme-excerpt {
    color: var(--text-secondary);
}

body.light-theme .section-title {
    color: var(--text-primary);
}

body.light-theme .section-description {
    color: var(--text-secondary);
}
</style>

<script>
// سكريبت تغيير المظهر
document.addEventListener('DOMContentLoaded', function() {
    const themeToggle = document.getElementById('theme-toggle');
    const body = document.body;
    
    // تحديد المظهر المحفوظ
    const savedTheme = localStorage.getItem('theme') || 'dark';
    body.classList.toggle('light-theme', savedTheme === 'light');
    
    // معالج النقر على زر تغيير المظهر
    if (themeToggle) {
        themeToggle.addEventListener('click', function() {
            body.classList.toggle('light-theme');
            const currentTheme = body.classList.contains('light-theme') ? 'light' : 'dark';
            localStorage.setItem('theme', currentTheme);
            
            // تأثير النقر
            this.style.transform = 'scale(0.9)';
            setTimeout(() => {
                this.style.transform = 'scale(1.1)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 150);
            }, 100);
        });
    }
    
    // إظهار/إخفاء الـ header في الصفحة الرئيسية
    if (body.classList.contains('home-page')) {
        let lastScrollTop = 0;
        
        window.addEventListener('scroll', function() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            if (scrollTop > 100) {
                body.classList.add('scrolled');
            } else {
                body.classList.remove('scrolled');
            }
            
            lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
        });
    }
});
</script>

<?php
/**
 * صفحة 404 - الصفحة غير موجودة
 * قوالب عربية ووردبريس
 * 
 * @package ArabicThemes
 */

get_header();
?>

<main class="main-content error-404-page">
    <!-- خلفية فضائية -->
    <div class="space-bg">
        <div class="stars"></div>
        <div class="floating-astronaut">
            <div class="astronaut">
                <div class="helmet">
                    <div class="face">
                        <div class="eyes">
                            <div class="eye"></div>
                            <div class="eye"></div>
                        </div>
                        <div class="mouth"></div>
                    </div>
                </div>
                <div class="body">
                    <div class="chest"></div>
                    <div class="arms">
                        <div class="arm left"></div>
                        <div class="arm right"></div>
                    </div>
                    <div class="legs">
                        <div class="leg left"></div>
                        <div class="leg right"></div>
                    </div>
                </div>
            </div>
            <div class="rope"></div>
        </div>
    </div>

    <div class="container">
        <div class="error-content">
            <div class="error-animation">
                <div class="error-number">
                    <span class="digit">4</span>
                    <span class="digit">0</span>
                    <span class="digit">4</span>
                </div>
                <div class="error-glitch">
                    <span>ERROR</span>
                    <span>ERROR</span>
                    <span>ERROR</span>
                </div>
            </div>
            
            <div class="error-message">
                <h1 class="error-title">عذراً، الصفحة غير موجودة!</h1>
                <p class="error-description">
                    يبدو أن الصفحة التي تبحث عنها قد ضاعت في الفضاء السيبراني. 
                    ربما تم حذفها أو تغيير رابطها، أو ربما كان هناك خطأ في كتابة العنوان.
                </p>
                
                <div class="error-suggestions">
                    <h3>ما يمكنك فعله:</h3>
                    <ul>
                        <li>
                            <i class="fas fa-home"></i>
                            العودة إلى <a href="<?php echo esc_url(home_url('/')); ?>">الصفحة الرئيسية</a>
                        </li>
                        <li>
                            <i class="fas fa-search"></i>
                            البحث عن القالب المطلوب في <a href="<?php echo esc_url(get_post_type_archive_link('wp_themes')); ?>">مكتبة القوالب</a>
                        </li>
                        <li>
                            <i class="fas fa-envelope"></i>
                            <a href="<?php echo esc_url(home_url('/contact')); ?>">تواصل معنا</a> إذا كنت تواجه مشكلة
                        </li>
                        <li>
                            <i class="fas fa-arrow-left"></i>
                            استخدام زر الرجوع في المتصفح
                        </li>
                    </ul>
                </div>

                <div class="error-actions">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                        <i class="fas fa-home"></i>
                        العودة للرئيسية
                    </a>
                    <a href="<?php echo esc_url(get_post_type_archive_link('wp_themes')); ?>" class="btn btn-secondary">
                        <i class="fas fa-th"></i>
                        تصفح القوالب
                    </a>
                </div>
            </div>
        </div>

        <!-- قوالب مقترحة -->
        <section class="suggested-themes">
            <h2 class="section-title">
                <i class="fas fa-lightbulb"></i>
                قوالب قد تهمك
            </h2>
            
            <div class="themes-grid">
                <?php
                $suggested_themes = new WP_Query(array(
                    'post_type' => 'wp_themes',
                    'posts_per_page' => 3,
                    'post_status' => 'publish',
                    'orderby' => 'rand'
                ));
                
                if ($suggested_themes->have_posts()):
                    while ($suggested_themes->have_posts()): $suggested_themes->the_post();
                        get_template_part('template-parts/theme-card');
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </section>
    </div>
</main>

<style>
/* أنماط صفحة 404 */
.error-404-page {
    min-height: 100vh;
    position: relative;
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 2rem 0;
}

/* الخلفية الفضائية */
.space-bg {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #0c0c0c 0%, #1a1a2e 50%, #0f0f23 100%);
    z-index: -1;
}

.stars {
    position: absolute;
    width: 100%;
    height: 100%;
    background-image: 
        radial-gradient(2px 2px at 20px 30px, rgba(255,255,255,0.8), transparent),
        radial-gradient(2px 2px at 40px 70px, rgba(255,255,255,0.6), transparent),
        radial-gradient(1px 1px at 90px 40px, rgba(255,255,255,0.9), transparent),
        radial-gradient(1px 1px at 130px 80px, rgba(255,255,255,0.7), transparent),
        radial-gradient(2px 2px at 160px 30px, rgba(255,255,255,0.8), transparent);
    background-repeat: repeat;
    background-size: 200px 100px;
    animation: sparkle 3s linear infinite;
}

@keyframes sparkle {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

/* رائد الفضاء العائم */
.floating-astronaut {
    position: absolute;
    top: 10%;
    right: 5%;
    animation: float 6s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(10deg); }
}

.astronaut {
    width: 100px;
    height: 120px;
    position: relative;
}

.helmet {
    width: 60px;
    height: 60px;
    background: linear-gradient(145deg, rgba(255,255,255,0.8), rgba(200,200,200,0.3));
    border-radius: 50%;
    position: relative;
    margin: 0 auto 10px;
    border: 3px solid rgba(255,255,255,0.3);
}

.face {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.eyes {
    display: flex;
    gap: 8px;
    margin-bottom: 5px;
}

.eye {
    width: 6px;
    height: 6px;
    background: #333;
    border-radius: 50%;
    animation: blink 3s infinite;
}

@keyframes blink {
    0%, 90%, 100% { transform: scaleY(1); }
    95% { transform: scaleY(0.1); }
}

.mouth {
    width: 8px;
    height: 4px;
    background: #333;
    border-radius: 0 0 8px 8px;
    margin: 0 auto;
}

.body {
    width: 50px;
    height: 60px;
    background: linear-gradient(145deg, #ddd, #bbb);
    border-radius: 25px;
    margin: 0 auto;
    position: relative;
}

.chest {
    width: 30px;
    height: 30px;
    background: linear-gradient(145deg, #4CAF50, #45a049);
    border-radius: 15px;
    position: absolute;
    top: 10px;
    left: 50%;
    transform: translateX(-50%);
}

.arms {
    position: absolute;
    top: 15px;
    width: 100%;
}

.arm {
    width: 20px;
    height: 35px;
    background: linear-gradient(145deg, #ddd, #bbb);
    border-radius: 10px;
    position: absolute;
}

.arm.left {
    left: -15px;
    transform: rotate(-30deg);
}

.arm.right {
    right: -15px;
    transform: rotate(30deg);
}

.legs {
    position: absolute;
    bottom: -10px;
    width: 100%;
}

.leg {
    width: 15px;
    height: 30px;
    background: linear-gradient(145deg, #ddd, #bbb);
    border-radius: 7px;
    position: absolute;
}

.leg.left {
    left: 10px;
}

.leg.right {
    right: 10px;
}

.rope {
    width: 2px;
    height: 100px;
    background: rgba(255,255,255,0.6);
    position: absolute;
    top: 130px;
    left: 50%;
    transform: translateX(-50%);
    animation: wave 2s ease-in-out infinite;
}

@keyframes wave {
    0%, 100% { transform: translateX(-50%) rotate(0deg); }
    50% { transform: translateX(-50%) rotate(10deg); }
}

/* محتوى الخطأ */
.error-content {
    text-align: center;
    margin-bottom: 4rem;
}

.error-animation {
    margin-bottom: 3rem;
}

.error-number {
    display: flex;
    justify-content: center;
    gap: 2rem;
    margin-bottom: 2rem;
}

.digit {
    font-size: 8rem;
    font-weight: 900;
    color: var(--neon-blue);
    text-shadow: 
        0 0 20px var(--neon-blue),
        0 0 40px var(--neon-blue),
        0 0 60px var(--neon-blue);
    animation: glow 2s ease-in-out infinite alternate;
}

.digit:nth-child(2) {
    animation-delay: 0.5s;
    color: var(--neon-purple);
    text-shadow: 
        0 0 20px var(--neon-purple),
        0 0 40px var(--neon-purple),
        0 0 60px var(--neon-purple);
}

.digit:nth-child(3) {
    animation-delay: 1s;
    color: var(--neon-pink);
    text-shadow: 
        0 0 20px var(--neon-pink),
        0 0 40px var(--neon-pink),
        0 0 60px var(--neon-pink);
}

@keyframes glow {
    0% { opacity: 1; transform: scale(1); }
    100% { opacity: 0.8; transform: scale(1.05); }
}

.error-glitch {
    position: relative;
    font-size: 2rem;
    font-weight: 700;
    color: var(--neon-red);
    height: 2.5rem;
    overflow: hidden;
}

.error-glitch span {
    position: absolute;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 100%;
    text-align: center;
}

.error-glitch span:nth-child(1) {
    animation: glitch1 2s infinite;
}

.error-glitch span:nth-child(2) {
    animation: glitch2 2s infinite;
    color: var(--neon-blue);
}

.error-glitch span:nth-child(3) {
    animation: glitch3 2s infinite;
    color: var(--neon-green);
}

@keyframes glitch1 {
    0%, 100% { transform: translateX(-50%) translateY(0); opacity: 1; }
    20% { transform: translateX(-48%) translateY(-2px); opacity: 0.8; }
    40% { transform: translateX(-52%) translateY(1px); opacity: 0.9; }
    60% { transform: translateX(-49%) translateY(-1px); opacity: 0.7; }
    80% { transform: translateX(-51%) translateY(0); opacity: 1; }
}

@keyframes glitch2 {
    0%, 100% { transform: translateX(-50%) translateY(0); opacity: 0; }
    25% { transform: translateX(-48%) translateY(2px); opacity: 0.8; }
    50% { transform: translateX(-52%) translateY(-1px); opacity: 0.9; }
    75% { transform: translateX(-49%) translateY(1px); opacity: 0.7; }
}

@keyframes glitch3 {
    0%, 100% { transform: translateX(-50%) translateY(0); opacity: 0; }
    33% { transform: translateX(-52%) translateY(-2px); opacity: 0.6; }
    66% { transform: translateX(-48%) translateY(2px); opacity: 0.8; }
}

/* رسالة الخطأ */
.error-message {
    max-width: 800px;
    margin: 0 auto;
}

.error-title {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 2rem;
    color: var(--text-primary);
    background: linear-gradient(45deg, var(--text-primary), var(--neon-blue));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.error-description {
    font-size: 1.3rem;
    line-height: 1.7;
    color: var(--text-secondary);
    margin-bottom: 3rem;
}

.error-suggestions {
    background: var(--bg-glass);
    border: 1px solid var(--border-color);
    border-radius: 20px;
    padding: 2.5rem;
    margin-bottom: 3rem;
    backdrop-filter: blur(20px);
    text-align: right;
}

.error-suggestions h3 {
    color: var(--text-primary);
    font-size: 1.5rem;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.error-suggestions ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.error-suggestions li {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    margin-bottom: 1rem;
    background: var(--bg-tertiary);
    border-radius: 12px;
    transition: all var(--transition-normal);
}

.error-suggestions li:hover {
    background: rgba(59, 130, 246, 0.1);
    transform: translateX(-5px);
}

.error-suggestions li:last-child {
    margin-bottom: 0;
}

.error-suggestions i {
    color: var(--neon-blue);
    font-size: 1.2rem;
    width: 20px;
    text-align: center;
    flex-shrink: 0;
}

.error-suggestions a {
    color: var(--neon-blue);
    text-decoration: none;
    font-weight: 600;
    transition: color var(--transition-normal);
}

.error-suggestions a:hover {
    color: var(--neon-purple);
    text-decoration: underline;
}

.error-actions {
    display: flex;
    justify-content: center;
    gap: 2rem;
    flex-wrap: wrap;
}

/* القوالب المقترحة */
.suggested-themes {
    margin-top: 4rem;
}

.suggested-themes .section-title {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
    font-size: 2rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 3rem;
}

.suggested-themes .section-title i {
    color: var(--neon-orange);
    font-size: 1.5rem;
}

.themes-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
}

/* التصميم المتجاوب */
@media (max-width: 1200px) {
    .floating-astronaut {
        right: 2%;
        top: 5%;
        transform: scale(0.8);
    }
}

@media (max-width: 768px) {
    .error-number {
        gap: 1rem;
    }
    
    .digit {
        font-size: 6rem;
    }
    
    .error-title {
        font-size: 2.5rem;
    }
    
    .error-description {
        font-size: 1.1rem;
    }
    
    .error-suggestions {
        padding: 2rem;
        text-align: center;
    }
    
    .error-suggestions li {
        flex-direction: column;
        text-align: center;
        gap: 0.75rem;
    }
    
    .error-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .themes-grid {
        grid-template-columns: 1fr;
    }
    
    .floating-astronaut {
        display: none;
    }
}

@media (max-width: 480px) {
    .digit {
        font-size: 4rem;
    }
    
    .error-glitch {
        font-size: 1.5rem;
    }
    
    .error-title {
        font-size: 2rem;
    }
    
    .error-suggestions {
        padding: 1.5rem;
    }
    
    .suggested-themes .section-title {
        font-size: 1.5rem;
        flex-direction: column;
    }
}

/* دعم RTL */
[dir="rtl"] .error-suggestions li:hover {
    transform: translateX(5px);
}

[dir="rtl"] .floating-astronaut {
    right: auto;
    left: 5%;
}

[dir="rtl"] .arm.left {
    left: auto;
    right: -15px;
    transform: rotate(30deg);
}

[dir="rtl"] .arm.right {
    right: auto;
    left: -15px;
    transform: rotate(-30deg);
}

[dir="rtl"] .leg.left {
    left: auto;
    right: 10px;
}

[dir="rtl"] .leg.right {
    right: auto;
    left: 10px;
}

@media (max-width: 768px) {
    [dir="rtl"] .error-suggestions li:hover {
        transform: none;
    }
}
</style>

<script>
// سكريبت صفحة 404
document.addEventListener('DOMContentLoaded', function() {
    initGlitchEffect();
    initStarsAnimation();
    initScrollAnimations();
    trackErrorEvent();
});

// تأثير الخلل
function initGlitchEffect() {
    const glitchElement = document.querySelector('.error-glitch');
    if (!glitchElement) return;
    
    setInterval(() => {
        if (Math.random() > 0.8) {
            glitchElement.style.transform = `translateX(${Math.random() * 4 - 2}px)`;
            
            setTimeout(() => {
                glitchElement.style.transform = 'translateX(0)';
            }, 100);
        }
    }, 500);
}

// تحريك النجوم
function initStarsAnimation() {
    const starsElement = document.querySelector('.stars');
    if (!starsElement) return;
    
    // إضافة نجوم عشوائية
    for (let i = 0; i < 50; i++) {
        const star = document.createElement('div');
        star.style.cssText = `
            position: absolute;
            width: ${Math.random() * 3 + 1}px;
            height: ${Math.random() * 3 + 1}px;
            background: white;
            border-radius: 50%;
            top: ${Math.random() * 100}%;
            left: ${Math.random() * 100}%;
            animation: twinkle ${Math.random() * 3 + 2}s infinite;
            opacity: ${Math.random() * 0.8 + 0.2};
        `;
        starsElement.appendChild(star);
    }
    
    // إضافة أنماط الوميض
    const style = document.createElement('style');
    style.textContent = `
        @keyframes twinkle {
            0%, 100% { opacity: 0.2; transform: scale(1); }
            50% { opacity: 1; transform: scale(1.2); }
        }
    `;
    document.head.appendChild(style);
}

// تأثيرات التمرير
function initScrollAnimations() {
    const animatedElements = document.querySelectorAll('.error-suggestions, .suggested-themes');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.1 });
    
    animatedElements.forEach(element => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(50px)';
        element.style.transition = 'all 0.8s ease';
        observer.observe(element);
    });
}

// تتبع حدث الخطأ
function trackErrorEvent() {
    const currentUrl = window.location.href;
    const referrer = document.referrer;
    
    // يمكن إضافة تتبع Google Analytics هنا
    if (typeof gtag !== 'undefined') {
        gtag('event', '404_error', {
            'page_location': currentUrl,
            'page_referrer': referrer
        });
    }
    
    // إرسال تقرير الخطأ للخادم
    if (window.ArabicThemes && window.ArabicThemes.ajaxurl) {
        fetch(window.ArabicThemes.ajaxurl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({
                action: 'log_404_error',
                url: currentUrl,
                referrer: referrer,
                user_agent: navigator.userAgent,
                nonce: window.ArabicThemes.nonce || ''
            })
        }).catch(error => {
            console.log('Error logging 404:', error);
        });
    }
}

// تأثيرات إضافية للأزرار
document.querySelectorAll('.btn').forEach(btn => {
    btn.addEventListener('mouseenter', function() {
        this.style.boxShadow = '0 0 30px rgba(59, 130, 246, 0.5)';
    });
    
    btn.addEventListener('mouseleave', function() {
        this.style.boxShadow = '';
    });
});

// تأثير
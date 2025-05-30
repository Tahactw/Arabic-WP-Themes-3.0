<?php
/**
 * تذييل الصفحة - قوالب عربية ووردبريس
 * إصدار محسن ومبسط
 * 
 * @package ArabicThemes
 * @author Tahactw
 * @date 2025-05-28
 */
?>

    </div><!-- #content -->

    <footer id="colophon" class="site-footer">
        <div class="container">
            <div class="footer-content">
                <!-- معلومات الموقع -->
                <div class="footer-info">
                    <h3 class="footer-title">قوالب عربية ووردبريس</h3>
                    <p class="footer-description">
                        مجموعة حصرية من أجمل قوالب ووردبريس العربية المجانية
                    </p>
                </div>
                
                <!-- روابط اجتماعية -->
                <div class="footer-social">
                    <h4>تابعنا</h4>
                    <div class="social-links">
                        <a href="#" class="social-link youtube" title="يوتيوب">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- حقوق النشر -->
            <div class="footer-bottom">
                <div class="copyright">
                    <p>&copy; <?php echo date('Y'); ?> قوالب عربية ووردبريس. جميع الحقوق محفوظة.</p>
                </div>
            </div>
        </div>
    </footer>

</div><!-- #page -->

<style>
/* أنماط التذييل المبسط */
.site-footer {
    background: linear-gradient(135deg, #0a0a0f 0%, #1a1a2e 100%);
    color: #ffffff;
    padding: 3rem 0 1rem;
    margin-top: auto;
    border-top: 1px solid rgba(59, 130, 246, 0.2);
}

.footer-content {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 3rem;
    margin-bottom: 2rem;
    align-items: start;
}

.footer-info {
    max-width: 400px;
}

.footer-title {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    background: linear-gradient(45deg, #3b82f6, #8b5cf6);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.footer-description {
    color: #b8b9ba;
    line-height: 1.6;
    margin: 0;
}

.footer-social h4 {
    font-size: 1.2rem;
    margin-bottom: 1rem;
    color: #ffffff;
}

.social-links {
    display: flex;
    gap: 1rem;
}

.social-link {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
    text-decoration: none;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.social-link.youtube {
    background: linear-gradient(45deg, #ff0000, #cc0000);
    box-shadow: 0 5px 20px rgba(255, 0, 0, 0.3);
}

.social-link:hover {
    transform: translateY(-3px) scale(1.1);
    box-shadow: 0 15px 40px rgba(255, 0, 0, 0.4);
}

.social-link::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s ease;
}

.social-link:hover::before {
    left: 100%;
}

.footer-bottom {
    text-align: center;
    padding-top: 2rem;
    border-top: 1px solid rgba(59, 130, 246, 0.1);
}

.copyright p {
    color: #6b7280;
    margin: 0;
    font-size: 0.9rem;
}

/* التصميم المتجاوب */
@media (max-width: 768px) {
    .footer-content {
        grid-template-columns: 1fr;
        gap: 2rem;
        text-align: center;
    }
    
    .footer-info {
        max-width: none;
    }
    
    .social-links {
        justify-content: center;
    }
}

/* دعم RTL */
[dir="rtl"] .footer-content {
    text-align: right;
}

[dir="rtl"] .social-links {
    justify-content: flex-start;
}

@media (max-width: 768px) {
    [dir="rtl"] .footer-content {
        text-align: center;
    }
    
    [dir="rtl"] .social-links {
        justify-content: center;
    }
}

/* أنماط المظهر الفاتح */
body.light-theme .site-footer {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    color: #1f2937;
    border-top-color: rgba(0, 0, 0, 0.1);
}

body.light-theme .footer-description {
    color: #6b7280;
}

body.light-theme .footer-social h4 {
    color: #1f2937;
}

body.light-theme .footer-bottom {
    border-top-color: rgba(0, 0, 0, 0.1);
}

body.light-theme .copyright p {
    color: #6b7280;
}

/* تحسينات الأداء */
.social-link {
    will-change: transform, box-shadow;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1rem;
}

@media (max-width: 768px) {
    .container {
        padding: 0 0.5rem;
    }
}
</style>

<?php wp_footer(); ?>

</body>
</html>
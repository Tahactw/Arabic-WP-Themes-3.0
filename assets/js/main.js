/**
 * السكريبت الرئيسي - قوالب عربية ووردبريس
 * إصدار محسن مع إصلاح الأخطاء
 */

(function($) {
    'use strict';
    
    // التأكد من تحميل الـ DOM
    $(document).ready(function() {
        initTheme();
    });
    
    /**
     * تهيئة القالب الأساسية
     */
    function initTheme() {
        console.log('Arabic Themes: تم تحميل القالب بنجاح');
        
        // تهيئة المكونات الأساسية
        initScrollEffects();
        initContactForm();
        initDownloadSystem();
        initSearchFeatures();
        initAnimations();
        
        // إضافة classes للتحكم
        $('body').addClass('theme-loaded');
    }
    
    /**
     * تأثيرات التمرير الأساسية
     */
    function initScrollEffects() {
        // Smooth scroll للروابط الداخلية
        $('a[href^="#"]').on('click', function(e) {
            e.preventDefault();
            
            const target = $(this.getAttribute('href'));
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top - 100
                }, 800);
            }
        });
        
        // إظهار/إخفاء زر العودة للأعلى
        const backToTop = $('<button class="back-to-top"><i class="fas fa-arrow-up"></i></button>');
        $('body').append(backToTop);
        
        $(window).scroll(function() {
            if ($(this).scrollTop() > 500) {
                backToTop.addClass('show');
            } else {
                backToTop.removeClass('show');
            }
        });
        
        backToTop.on('click', function() {
            $('html, body').animate({scrollTop: 0}, 800);
        });
    }
    
    /**
     * نظام التواصل
     */
    function initContactForm() {
        $('#contact-form').on('submit', function(e) {
            e.preventDefault();
            
            const form = $(this);
            const submitBtn = form.find('button[type="submit"]');
            const originalText = submitBtn.text();
            
            // تعطيل الزر أثناء الإرسال
            submitBtn.prop('disabled', true).text(ArabicThemes.strings.loading);
            
            $.ajax({
                url: ArabicThemes.ajaxurl,
                type: 'POST',
                data: {
                    action: 'submit_contact_form',
                    nonce: ArabicThemes.nonce,
                    name: form.find('input[name="name"]').val(),
                    email: form.find('input[name="email"]').val(),
                    subject: form.find('input[name="subject"]').val(),
                    message: form.find('textarea[name="message"]').val()
                },
                success: function(response) {
                    if (response.success) {
                        showNotification(response.data, 'success');
                        form[0].reset();
                    } else {
                        showNotification(response.data, 'error');
                    }
                },
                error: function() {
                    showNotification(ArabicThemes.strings.error, 'error');
                },
                complete: function() {
                    submitBtn.prop('disabled', false).text(originalText);
                }
            });
        });
    }
    
    /**
     * نظام التحميل مع التقييم
     */
    function initDownloadSystem() {
        $('.download-btn').on('click', function(e) {
            e.preventDefault();
            
            const themeId = $(this).data('theme-id');
            showRatingModal(themeId);
        });
    }
    
    /**
     * عرض نافذة التقييم
     */
    function showRatingModal(themeId) {
        const modal = $(`
            <div class="rating-modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3>قيم هذا القالب</h3>
                        <button class="close-modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>يرجى تقييم القالب قبل التحميل:</p>
                        <div class="rating-stars">
                            <i class="far fa-star" data-rating="1"></i>
                            <i class="far fa-star" data-rating="2"></i>
                            <i class="far fa-star" data-rating="3"></i>
                            <i class="far fa-star" data-rating="4"></i>
                            <i class="far fa-star" data-rating="5"></i>
                        </div>
                        <button class="btn submit-rating" data-theme-id="${themeId}" disabled>
                            تحميل القالب
                        </button>
                    </div>
                </div>
            </div>
        `);
        
        $('body').append(modal);
        modal.fadeIn();
        
        // تفاعل النجوم
        let selectedRating = 0;
        modal.find('.rating-stars i').on('mouseenter', function() {
            const rating = $(this).data('rating');
            highlightStars(modal, rating);
        }).on('click', function() {
            selectedRating = $(this).data('rating');
            modal.find('.submit-rating').prop('disabled', false);
        });
        
        modal.find('.rating-stars').on('mouseleave', function() {
            highlightStars(modal, selectedRating);
        });
        
        // إرسال التقييم والتحميل
        modal.find('.submit-rating').on('click', function() {
            if (selectedRating > 0) {
                downloadTheme(themeId, selectedRating);
                modal.fadeOut(function() {
                    $(this).remove();
                });
            }
        });
        
        // إغلاق النافذة
        modal.find('.close-modal').on('click', function() {
            modal.fadeOut(function() {
                $(this).remove();
            });
        });
    }
    
    /**
     * تمييز النجوم
     */
    function highlightStars(modal, rating) {
        modal.find('.rating-stars i').each(function(index) {
            if (index < rating) {
                $(this).removeClass('far').addClass('fas');
            } else {
                $(this).removeClass('fas').addClass('far');
            }
        });
    }
    
    /**
     * تحميل القالب
     */
    function downloadTheme(themeId, rating) {
        $.ajax({
            url: ArabicThemes.ajaxurl,
            type: 'POST',
            data: {
                action: 'download_theme',
                nonce: ArabicThemes.nonce,
                theme_id: themeId,
                rating: rating
            },
            success: function(response) {
                if (response.success) {
                    showNotification(response.data.message, 'success');
                    
                    // تحديث عداد التحميلات
                    $(`.theme-card[data-theme-id="${themeId}"] .download-count`).text(response.data.download_count);
                    
                    // فتح رابط التحميل
                    if (response.data.download_url && response.data.download_url !== '#') {
                        window.open(response.data.download_url, '_blank');
                    }
                } else {
                    showNotification(response.data, 'error');
                }
            },
            error: function() {
                showNotification(ArabicThemes.strings.error, 'error');
            }
        });
    }
    
    /**
     * مميزات البحث
     */
    function initSearchFeatures() {
        // البحث المباشر
        $('#search-input').on('input', function() {
            const query = $(this).val();
            
            if (query.length > 2) {
                // تأخير البحث قليلاً
                clearTimeout(window.searchTimeout);
                window.searchTimeout = setTimeout(function() {
                    performSearch(query);
                }, 500);
            }
        });
    }
    
    /**
     * تنفيذ البحث
     */
    function performSearch(query) {
        console.log('البحث عن:', query);
        // يمكن إضافة AJAX search هنا لاحقاً
    }
    
    /**
     * الحركات والتأثيرات
     */
    function initAnimations() {
        // تهيئة AOS إذا كان متاحاً
        if (typeof AOS !== 'undefined') {
            AOS.init({
                duration: 800,
                easing: 'ease-out-cubic',
                once: true,
                offset: 100
            });
        }
        
        // تأثيرات GSAP إذا كانت متاحة
        if (typeof gsap !== 'undefined') {
            // تحريك العناصر عند التحميل
            gsap.from('.hero-content', {
                duration: 1,
                y: 50,
                opacity: 0,
                ease: 'power3.out'
            });
            
            gsap.from('.theme-card', {
                duration: 0.8,
                y: 30,
                opacity: 0,
                stagger: 0.1,
                ease: 'power2.out',
                delay: 0.3
            });
        }
        
        // تأثيرات التمرير البسيطة
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });
        
        // مراقبة العناصر
        document.querySelectorAll('.card, .theme-card, .section').forEach(el => {
            observer.observe(el);
        });
    }
    
    /**
     * عرض الإشعارات
     */
    function showNotification(message, type = 'info') {
        const notification = $(`
            <div class="notification ${type}">
                <span>${message}</span>
                <button class="close-notification">&times;</button>
            </div>
        `);
        
        $('body').append(notification);
        
        setTimeout(() => {
            notification.addClass('show');
        }, 100);
        
        // إزالة تلقائية بعد 5 ثوانٍ
        setTimeout(() => {
            notification.removeClass('show');
            setTimeout(() => notification.remove(), 300);
        }, 5000);
        
        // إزالة عند النقر
        notification.find('.close-notification').on('click', function() {
            notification.removeClass('show');
            setTimeout(() => notification.remove(), 300);
        });
    }
    
    /**
     * تحسينات الأداء
     */
    function initPerformanceOptimizations() {
        // lazy loading للصور
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                        imageObserver.unobserve(img);
                    }
                });
            });
            
            document.querySelectorAll('img[data-src]').forEach(img => {
                imageObserver.observe(img);
            });
        }
    }
    
    // تهيئة تحسينات الأداء
    initPerformanceOptimizations();
    
})(jQuery);

// CSS للمكونات الجديدة
const additionalCSS = `
<style>
/* أنماط زر العودة للأعلى */
.back-to-top {
    position: fixed;
    bottom: 20px;
    left: 20px;
    background: linear-gradient(45deg, #3b82f6, #8b5cf6);
    color: white;
    border: none;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    cursor: pointer;
    opacity: 0;
    visibility: hidden;
    transform: translateY(20px);
    transition: all 0.3s ease;
    z-index: 1000;
    display: flex;
    align-items: center;
    justify-content: center;
}

.back-to-top.show {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.back-to-top:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(59, 130, 246, 0.4);
}

/* أنماط نافذة التقييم */
.rating-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8);
    display: none;
    z-index: 10000;
    align-items: center;
    justify-content: center;
}

.modal-content {
    background: linear-gradient(135deg, #1a1a2e, #16213e);
    border: 1px solid rgba(59, 130, 246, 0.3);
    border-radius: 20px;
    padding: 2rem;
    max-width: 400px;
    width: 90%;
    text-align: center;
    position: relative;
}

.modal-header {
    margin-bottom: 1.5rem;
}

.modal-header h3 {
    color: #ffffff;
    margin-bottom: 0;
}

.close-modal {
    position: absolute;
    top: 15px;
    right: 20px;
    background: none;
    border: none;
    color: #ffffff;
    font-size: 1.5rem;
    cursor: pointer;
    opacity: 0.7;
    transition: opacity 0.3s ease;
}

.close-modal:hover {
    opacity: 1;
}

.rating-stars {
    margin: 1.5rem 0;
}

.rating-stars i {
    font-size: 2rem;
    color: #fbbf24;
    margin: 0 0.25rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

.rating-stars i:hover {
    transform: scale(1.2);
}

/* أنماط الإشعارات */
.notification {
    position: fixed;
    top: 20px;
    right: 20px;
    background: #1f2937;
    color: white;
    padding: 1rem 1.5rem;
    border-radius: 10px;
    border-left: 4px solid #3b82f6;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 
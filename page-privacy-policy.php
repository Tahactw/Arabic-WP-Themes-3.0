                // التمرير السلس مع تأثير
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
                
                // تأثير تمييز القسم
                targetElement.style.transition = 'all 0.3s ease';
                targetElement.style.borderColor = 'var(--neon-blue)';
                targetElement.style.boxShadow = '0 0 30px rgba(59, 130, 246, 0.3)';
                
                setTimeout(() => {
                    targetElement.style.borderColor = '';
                    targetElement.style.boxShadow = '';
                }, 2000);
                
                // تأثير صوتي
                if (window.ArabicThemes) {
                    window.ArabicThemes.playClickSound();
                }
            }
        });
    });
}

// تمييز القسم النشط عند التمرير
function initSectionHighlighting() {
    const sections = document.querySelectorAll('.legal-section');
    const tocLinks = document.querySelectorAll('.toc-link');
    
    const observerOptions = {
        threshold: 0.3,
        rootMargin: '-100px 0px -50% 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const sectionId = entry.target.id;
                
                // تحديث جدول المحتويات
                tocLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === `#${sectionId}`) {
                        link.classList.add('active');
                    }
                });
            }
        });
    }, observerOptions);
    
    sections.forEach(section => {
        observer.observe(section);
    });
}

// تحريك العناصر عند الظهور
function initAnimatedElements() {
    const animatedElements = document.querySelectorAll(
        '.data-type-card, .purpose-item, .scenario-card, .security-item, .right-item, .summary-item'
    );
    
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.classList.contains('animated')) {
                const element = entry.target;
                const delay = Array.from(element.parentNode.children).indexOf(element) * 0.1;
                
                gsap.fromTo(element, 
                    { y: 50, opacity: 0 },
                    { 
                        y: 0, 
                        opacity: 1, 
                        duration: 0.6,
                        delay: delay,
                        ease: "back.out(1.7)"
                    }
                );
                
                element.classList.add('animated');
            }
        });
    }, observerOptions);
    
    animatedElements.forEach(element => {
        observer.observe(element);
    });
}

// إعدادات ملفات تعريف الارتباط
function initCookieSettings() {
    const cookieBtn = document.querySelector('.cookie-settings-btn');
    
    if (cookieBtn) {
        cookieBtn.addEventListener('click', function() {
            showCookiePreferences();
        });
    }
}

function showCookiePreferences() {
    // إنشاء نافذة إعدادات ملفات تعريف الارتباط
    const modal = document.createElement('div');
    modal.className = 'cookie-preferences-modal';
    modal.innerHTML = `
        <div class="modal-overlay"></div>
        <div class="modal-content">
            <div class="modal-header">
                <h3>إعدادات ملفات تعريف الارتباط</h3>
                <button class="modal-close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="modal-body">
                <p>يمكنكم التحكم في أنواع ملفات تعريف الارتباط التي تريدون قبولها:</p>
                
                <div class="cookie-preferences">
                    <div class="preference-item">
                        <div class="preference-header">
                            <label class="preference-label">
                                <input type="checkbox" checked disabled>
                                <span class="checkbox-custom"></span>
                                <span class="preference-title">ملفات تعريف الارتباط الضرورية</span>
                            </label>
                            <span class="required-badge">مطلوبة</span>
                        </div>
                        <p class="preference-description">
                            ضرورية لتشغيل الموقع بشكل صحيح ولا يمكن تعطيلها.
                        </p>
                    </div>
                    
                    <div class="preference-item">
                        <div class="preference-header">
                            <label class="preference-label">
                                <input type="checkbox" id="analytics-cookies" checked>
                                <span class="checkbox-custom"></span>
                                <span class="preference-title">ملفات تعريف الارتباط التحليلية</span>
                            </label>
                        </div>
                        <p class="preference-description">
                            تساعدنا في فهم كيفية استخدام الموقع لتحسين الأداء والمحتوى.
                        </p>
                    </div>
                    
                    <div class="preference-item">
                        <div class="preference-header">
                            <label class="preference-label">
                                <input type="checkbox" id="functional-cookies" checked>
                                <span class="checkbox-custom"></span>
                                <span class="preference-title">ملفات تعريف الارتباط الوظيفية</span>
                            </label>
                        </div>
                        <p class="preference-description">
                            تحفظ تفضيلاتكم مثل اللغة والمظهر لتحسين تجربتكم.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <button class="btn btn-secondary" onclick="this.closest('.cookie-preferences-modal').remove()">
                    إلغاء
                </button>
                <button class="btn btn-primary" onclick="saveCookiePreferences()">
                    حفظ الإعدادات
                </button>
            </div>
        </div>
    `;
    
    // إضافة الأنماط
    modal.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 3000;
        display: flex;
        align-items: center;
        justify-content: center;
    `;
    
    document.body.appendChild(modal);
    
    // تأثير ظهور
    gsap.fromTo(modal, 
        { opacity: 0 },
        { opacity: 1, duration: 0.3 }
    );
    
    gsap.fromTo(modal.querySelector('.modal-content'),
        { scale: 0.8, y: -50 },
        { scale: 1, y: 0, duration: 0.4, delay: 0.1, ease: "back.out(1.7)" }
    );
    
    // إغلاق النافذة
    modal.querySelector('.modal-close').addEventListener('click', () => {
        modal.remove();
    });
    
    modal.querySelector('.modal-overlay').addEventListener('click', () => {
        modal.remove();
    });
}

function saveCookiePreferences() {
    const analyticsCookies = document.getElementById('analytics-cookies')?.checked;
    const functionalCookies = document.getElementById('functional-cookies')?.checked;
    
    // حفظ التفضيلات في localStorage
    localStorage.setItem('cookie-preferences', JSON.stringify({
        necessary: true,
        analytics: analyticsCookies,
        functional: functionalCookies,
        timestamp: Date.now()
    }));
    
    // إغلاق النافذة
    document.querySelector('.cookie-preferences-modal')?.remove();
    
    // إظهار رسالة تأكيد
    if (window.ArabicThemes) {
        window.ArabicThemes.showNotification('تم حفظ إعدادات ملفات تعريف الارتباط بنجاح', 'success');
    }
    
    // تطبيق الإعدادات (هنا يمكن إضافة الكود الخاص بتطبيق الإعدادات)
    applyCookiePreferences({
        necessary: true,
        analytics: analyticsCookies,
        functional: functionalCookies
    });
}

function applyCookiePreferences(preferences) {
    // تطبيق إعدادات ملفات تعريف الارتباط
    if (!preferences.analytics) {
        // تعطيل Google Analytics أو أي أدوات تحليل أخرى
        console.log('تم تعطيل ملفات تعريف الارتباط التحليلية');
    }
    
    if (!preferences.functional) {
        // تعطيل الميزات الوظيفية التي تعتمد على ملفات تعريف الارتباط
        console.log('تم تعطيل ملفات تعريف الارتباط الوظيفية');
    }
}

// تحميل التفضيلات المحفوظة عند تحميل الصفحة
function loadSavedPreferences() {
    const saved = localStorage.getItem('cookie-preferences');
    if (saved) {
        try {
            const preferences = JSON.parse(saved);
            applyCookiePreferences(preferences);
        } catch (error) {
            console.error('خطأ في تحميل تفضيلات ملفات تعريف الارتباط:', error);
        }
    }
}

// تحميل التفضيلات عند بدء تشغيل الصفحة
loadSavedPreferences();

// إضافة أنماط CSS للنافذة المنبثقة
const cookieModalStyles = `
<style>
.cookie-preferences-modal .modal-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8);
    backdrop-filter: blur(10px);
}

.cookie-preferences-modal .modal-content {
    background: var(--bg-secondary);
    border: 1px solid var(--border-color);
    border-radius: 20px;
    max-width: 600px;
    width: 90%;
    max-height: 90vh;
    overflow-y: auto;
    position: relative;
    z-index: 1;
}

.cookie-preferences-modal .modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 2rem;
    border-bottom: 1px solid var(--border-color);
}

.cookie-preferences-modal .modal-header h3 {
    color: var(--text-primary);
    font-size: 1.5rem;
    font-weight: 700;
    margin: 0;
}

.cookie-preferences-modal .modal-close {
    background: none;
    border: none;
    color: var(--text-secondary);
    font-size: 1.5rem;
    cursor: pointer;
    padding: 0.5rem;
    border-radius: 50%;
    transition: all var(--transition-normal);
}

.cookie-preferences-modal .modal-close:hover {
    background: var(--bg-tertiary);
    color: var(--text-primary);
}

.cookie-preferences-modal .modal-body {
    padding: 2rem;
}

.cookie-preferences-modal .modal-body p {
    color: var(--text-secondary);
    margin-bottom: 2rem;
    line-height: 1.6;
}

.cookie-preferences {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.preference-item {
    border: 1px solid var(--border-color);
    border-radius: 12px;
    padding: 1.5rem;
    background: var(--bg-tertiary);
}

.preference-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.75rem;
}

.preference-label {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    cursor: pointer;
    flex: 1;
}

.preference-label input[type="checkbox"] {
    display: none;
}

.preference-label .checkbox-custom {
    width: 20px;
    height: 20px;
    border: 2px solid var(--border-color);
    border-radius: 4px;
    background: var(--bg-secondary);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all var(--transition-normal);
    position: relative;
}

.preference-label .checkbox-custom::after {
    content: '✓';
    color: white;
    font-size: 0.8rem;
    font-weight: bold;
    opacity: 0;
    transform: scale(0);
    transition: all var(--transition-normal);
}

.preference-label input:checked + .checkbox-custom {
    background: var(--neon-blue);
    border-color: var(--neon-blue);
}

.preference-label input:checked + .checkbox-custom::after {
    opacity: 1;
    transform: scale(1);
}

.preference-label input:disabled + .checkbox-custom {
    background: var(--text-muted);
    border-color: var(--text-muted);
    cursor: not-allowed;
}

.preference-title {
    color: var(--text-primary);
    font-weight: 600;
    flex: 1;
}

.required-badge {
    background: var(--neon-green);
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 600;
}

.preference-description {
    color: var(--text-secondary);
    font-size: 0.9rem;
    line-height: 1.5;
    margin: 0;
}

.cookie-preferences-modal .modal-footer {
    padding: 2rem;
    border-top: 1px solid var(--border-color);
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
}

.cookie-preferences-modal .btn {
    padding: 0.75rem 2rem;
    border-radius: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: all var(--transition-normal);
    border: none;
    font-family: inherit;
}

.cookie-preferences-modal .btn-secondary {
    background: var(--bg-tertiary);
    color: var(--text-primary);
    border: 1px solid var(--border-color);
}

.cookie-preferences-modal .btn-secondary:hover {
    background: var(--bg-secondary);
    border-color: var(--neon-blue);
}

.cookie-preferences-modal .btn-primary {
    background: linear-gradient(45deg, var(--neon-blue), var(--neon-green));
    color: white;
}

.cookie-preferences-modal .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(59, 130, 246, 0.4);
}

@media (max-width: 768px) {
    .cookie-preferences-modal .modal-content {
        margin: 1rem;
        width: calc(100% - 2rem);
    }
    
    .cookie-preferences-modal .modal-header,
    .cookie-preferences-modal .modal-body,
    .cookie-preferences-modal .modal-footer {
        padding: 1.5rem;
    }
    
    .cookie-preferences-modal .modal-footer {
        flex-direction: column;
    }
    
    .preference-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.75rem;
    }
}
</style>
`;

// إضافة الأنماط للرأس
if (!document.querySelector('#cookie-modal-styles')) {
    const styleElement = document.createElement('div');
    styleElement.id = 'cookie-modal-styles';
    styleElement.innerHTML = cookieModalStyles;
    document.head.appendChild(styleElement);
}
</script>

<?php get_footer(); ?>
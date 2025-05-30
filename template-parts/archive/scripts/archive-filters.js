/**
 * تأثيرات وحركات الأرشيف
 * التأثيرات البصرية والتفاعلية
 * 
 * @package ArabicThemes
 * @author Tahactw
 * @date 2025-05-30
 */

const ArchiveEffects = {
    // إعدادات التأثيرات
    settings: {
        particleCount: 50,
        animationSpeed: 1,
        parallaxStrength: 0.3,
        glowIntensity: 0.5,
        rippleCount: 3
    },

    // حالة التأثيرات
    state: {
        isInitialized: false,
        animationFrame: null,
        particles: [],
        mousePosition: { x: 0, y: 0 },
        isReducedMotion: false
    },

    // التهيئة الرئيسية
    init() {
        this.detectMotionPreference();
        this.initializeParticles();
        this.setupParallaxEffects();
        this.setupHoverEffects();
        this.setupScrollEffects();
        this.setupLoadingEffects();
        this.setupTransitionEffects();
        this.setupMouseEffects();
        
        this.state.isInitialized = true;
        console.log('✅ تم تهيئة نظام التأثيرات');
    },

    // كشف تفضيل الحركة
    detectMotionPreference() {
        this.state.isReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        
        if (this.state.isReducedMotion) {
            document.documentElement.classList.add('reduced-motion');
            this.settings.animationSpeed *= 0.5;
            this.settings.particleCount *= 0.3;
        }
    },

    // تهيئة نظام الجسيمات
    initializeParticles() {
        const canvas = document.getElementById('particles-canvas');
        if (!canvas || this.state.isReducedMotion) return;

        const ctx = canvas.getContext('2d');
        this.resizeCanvas(canvas);

        // إنشاء الجسيمات
        this.createParticles();
        
        // بدء الحركة
        this.animateParticles(ctx, canvas);

        // معالجة تغيير حجم النافذة
        window.addEventListener('resize', () => {
            this.resizeCanvas(canvas);
        });
    },

    // تغيير حجم Canvas
    resizeCanvas(canvas) {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
    },

    // إنشاء الجسيمات
    createParticles() {
        this.state.particles = [];
        
        for (let i = 0; i < this.settings.particleCount; i++) {
            this.state.particles.push({
                x: Math.random() * window.innerWidth,
                y: Math.random() * window.innerHeight,
                vx: (Math.random() - 0.5) * 2,
                vy: (Math.random() - 0.5) * 2,
                size: Math.random() * 3 + 1,
                opacity: Math.random() * 0.5 + 0.1,
                color: this.getRandomParticleColor(),
                life: Math.random() * 100,
                maxLife: Math.random() * 200 + 100
            });
        }
    },

    // لون جسيم عشوائي
    getRandomParticleColor() {
        const colors = [
            'rgba(59, 130, 246, 0.3)',
            'rgba(139, 92, 246, 0.3)',
            'rgba(16, 185, 129, 0.3)',
            'rgba(245, 158, 11, 0.3)',
            'rgba(239, 68, 68, 0.3)'
        ];
        return colors[Math.floor(Math.random() * colors.length)];
    },

    // حركة الجسيمات
    animateParticles(ctx, canvas) {
        const animate = () => {
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            this.state.particles.forEach(particle => {
                // تحديث الموقع
                particle.x += particle.vx * this.settings.animationSpeed;
                particle.y += particle.vy * this.settings.animationSpeed;
                
                // تحديث العمر
                particle.life++;
                
                // إعادة تدوير الجسيم
                if (particle.life > particle.maxLife || 
                    particle.x < 0 || particle.x > canvas.width ||
                    particle.y < 0 || particle.y > canvas.height) {
                    
                    particle.x = Math.random() * canvas.width;
                    particle.y = Math.random() * canvas.height;
                    particle.life = 0;
                }

                // رسم الجسيم
                this.drawParticle(ctx, particle);
            });

            this.state.animationFrame = requestAnimationFrame(animate);
        };

        animate();
    },

    // رسم جسيم
    drawParticle(ctx, particle) {
        ctx.save();
        ctx.globalAlpha = particle.opacity;
        ctx.fillStyle = particle.color;
        ctx.beginPath();
        ctx.arc(particle.x, particle.y, particle.size, 0, Math.PI * 2);
        ctx.fill();
        ctx.restore();
    },

    // تأثيرات Parallax
    setupParallaxEffects() {
        if (this.state.isReducedMotion) return;

        const parallaxLayers = document.querySelectorAll('.parallax-layer');
        
        window.addEventListener('scroll', () => {
            const scrollY = window.pageYOffset;
            
            parallaxLayers.forEach(layer => {
                const speed = parseFloat(layer.dataset.speed) || 0.1;
                const yPos = -(scrollY * speed * this.settings.parallaxStrength);
                layer.style.transform = `translateY(${yPos}px)`;
            });
        });
    },

    // تأثيرات التحويم
    setupHoverEffects() {
        // بطاقات القوالب
        this.setupThemeCardHover();
        
        // أزرار التفاعل
        this.setupButtonHover();
        
        // عناصر التصفية
        this.setupFilterHover();
    },

    // تحويم بطاقات القوالب
    setupThemeCardHover() {
        document.querySelectorAll('.theme-card').forEach(card => {
            card.addEventListener('mouseenter', (e) => {
                if (this.state.isReducedMotion) return;
                
                this.createRippleEffect(e.target, e);
                this.addGlowEffect(e.target);
                this.animateCardEntrance(e.target);
            });

            card.addEventListener('mouseleave', (e) => {
                this.removeGlowEffect(e.target);
            });

            card.addEventListener('mousemove', (e) => {
                if (this.state.isReducedMotion) return;
                this.updateCardTilt(e.target, e);
            });
        });
    },

    // تأثير التموج
    createRippleEffect(element, event) {
        const ripple = document.createElement('div');
        ripple.className = 'ripple-effect';
        
        const rect = element.getBoundingClientRect();
        const x = event.clientX - rect.left;
        const y = event.clientY - rect.top;
        
        ripple.style.left = `${x}px`;
        ripple.style.top = `${y}px`;
        
        element.appendChild(ripple);
        
        setTimeout(() => {
            ripple.remove();
        }, 600);
    },

    // تأثير التوهج
    addGlowEffect(element) {
        element.style.boxShadow = `
            0 0 20px rgba(59, 130, 246, ${this.settings.glowIntensity}),
            0 10px 40px rgba(0, 0, 0, 0.1)
        `;
    },

    // إزالة تأثير التوهج
    removeGlowEffect(element) {
        element.style.boxShadow = '';
    },

    // تحديث ميلان البطاقة
    updateCardTilt(element, event) {
        const rect = element.getBoundingClientRect();
        const centerX = rect.left + rect.width / 2;
        const centerY = rect.top + rect.height / 2;
        
        const mouseX = event.clientX - centerX;
        const mouseY = event.clientY - centerY;
        
        const rotateX = (mouseY / rect.height) * 10;
        const rotateY = (mouseX / rect.width) * -10;
        
        element.style.transform = `
            perspective(1000px) 
            rotateX(${rotateX}deg) 
            rotateY(${rotateY}deg) 
            translateZ(20px)
        `;

        element.addEventListener('mouseleave', () => {
            element.style.transform = '';
        }, { once: true });
    },

    // حركة دخول البطاقة
    animateCardEntrance(element) {
        element.style.animation = 'cardFloat 2s ease-in-out infinite';
    },

    // تحويم الأزرار
    setupButtonHover() {
        document.querySelectorAll('.btn, .view-btn, .filter-select').forEach(btn => {
            btn.addEventListener('mouseenter', (e) => {
                this.createButtonWave(e.target);
            });
        });
    },

    // تأثير موجة الزر
    createButtonWave(button) {
        const wave = document.createElement('div');
        wave.className = 'button-wave';
        button.appendChild(wave);
        
        setTimeout(() => {
            wave.remove();
        }, 500);
    },

    // تحويم عناصر التصفية
    setupFilterHover() {
        document.querySelectorAll('.filter-group').forEach(group => {
            group.addEventListener('mouseenter', () => {
                if (this.state.isReducedMotion) return;
                group.style.transform = 'translateY(-2px)';
                group.style.transition = 'transform 0.3s ease';
            });

            group.addEventListener('mouseleave', () => {
                group.style.transform = '';
            });
        });
    },

    // تأثيرات التمرير
    setupScrollEffects() {
        // إنشاء مراقب التقاطع
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '50px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    this.animateElementEntry(entry.target);
                }
            });
        }, observerOptions);

        // مراقبة العناصر
        document.querySelectorAll('.theme-card, .stat-card, .filter-group').forEach(el => {
            observer.observe(el);
        });

        // تأثير تمرير الهيدر
        this.setupHeaderScrollEffect();
        
        // تأثير شريط التقدم
        this.setupScrollProgressBar();
    },

    // تحريك دخول العنصر
    animateElementEntry(element) {
        if (this.state.isReducedMotion) return;

        element.style.animation = 'slideInUp 0.6s ease-out forwards';
        element.style.opacity = '1';
        element.style.transform = 'translateY(0)';
    },

    // تأثير تمرير الهيدر
    setupHeaderScrollEffect() {
        const header = document.querySelector('.archive-header');
        if (!header) return;

        let lastScrollY = window.scrollY;

        window.addEventListener('scroll', () => {
            const scrollY = window.scrollY;
            const scrollDirection = scrollY > lastScrollY ? 'down' : 'up';
            
            if (scrollY > 100) {
                header.classList.add('scrolled');
                
                if (scrollDirection === 'down' && scrollY > 200) {
                    header.classList.add('hidden');
                } else if (scrollDirection === 'up') {
                    header.classList.remove('hidden');
                }
            } else {
                header.classList.remove('scrolled', 'hidden');
            }

            lastScrollY = scrollY;
        });
    },

    // شريط تقدم التمرير
    setupScrollProgressBar() {
        const progressBar = document.createElement('div');
        progressBar.className = 'scroll-progress-bar';
        document.body.appendChild(progressBar);

        window.addEventListener('scroll', () => {
            const scrollTop = window.pageYOffset;
            const docHeight = document.documentElement.scrollHeight - window.innerHeight;
            const scrollPercent = (scrollTop / docHeight) * 100;
            
            progressBar.style.width = `${Math.min(scrollPercent, 100)}%`;
        });
    },

    // تأثيرات التحميل
    setupLoadingEffects() {
        // شاشة التحميل الرئيسية
        this.setupMainLoader();
        
        // تحميل المحتوى
        this.setupContentLoading();
        
        // تحميل الصور
        this.setupImageLoading();
    },

    // شاشة التحميل الرئيسية
    setupMainLoader() {
        const loader = document.getElementById('archive-loader');
        if (!loader) return;

        // إضافة تأثيرات للشاشة
        const spinner = loader.querySelector('.loader-spinner');
        if (spinner) {
            spinner.style.animation = 'loaderSpin 2s linear infinite';
        }

        // إخفاء تدريجي
        setTimeout(() => {
            loader.classList.add('fade-out');
            setTimeout(() => {
                loader.remove();
                this.triggerPageEntryAnimation();
            }, 500);
        }, 1500);
    },

    // حركة دخول الصفحة
    triggerPageEntryAnimation() {
        if (this.state.isReducedMotion) return;

        const elements = document.querySelectorAll('.archive-header, .filters-section, .theme-card');
        
        elements.forEach((el, index) => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            
            setTimeout(() => {
                el.style.transition = 'all 0.6s ease-out';
                el.style.opacity = '1';
                el.style.transform = 'translateY(0)';
            }, index * 100);
        });
    },

    // تحميل المحتوى
    setupContentLoading() {
        const loadMoreBtn = document.getElementById('load-more-btn');
        if (!loadMoreBtn) return;

        loadMoreBtn.addEventListener('click', () => {
            this.animateContentLoading();
        });
    },

    // حركة تحميل المحتوى
    animateContentLoading() {
        const newCards = document.querySelectorAll('.theme-card:not(.loaded)');
        
        newCards.forEach((card, index) => {
            card.classList.add('loading');
            
            setTimeout(() => {
                card.classList.remove('loading');
                card.classList.add('loaded');
                this.animateElementEntry(card);
            }, index * 150);
        });
    },

    // تحميل الصور
    setupImageLoading() {
        const images = document.querySelectorAll('.theme-preview img');
        
        images.forEach(img => {
            if (img.complete) {
                this.handleImageLoad(img);
            } else {
                img.addEventListener('load', () => this.handleImageLoad(img));
                img.addEventListener('error', () => this.handleImageError(img));
            }
        });
    },

    // معالجة تحميل الصورة
    handleImageLoad(img) {
        img.style.opacity = '0';
        img.style.transition = 'opacity 0.5s ease';
        
        setTimeout(() => {
            img.style.opacity = '1';
        }, 100);
    },

    // معالجة خطأ الصورة
    handleImageError(img) {
        const placeholder = document.createElement('div');
        placeholder.className = 'image-placeholder';
        placeholder.innerHTML = '<i class="fas fa-image"></i>';
        
        img.parentNode.replaceChild(placeholder, img);
    },

    // تأثيرات الانتقال
    setupTransitionEffects() {
        // انتقال أنماط العرض
        this.setupViewTransitions();
        
        // انتقال الفلاتر
        this.setupFilterTransitions();
        
        // انتقال المودال
        this.setupModalTransitions();
    },

    // انتقال أنماط العرض
    setupViewTransitions() {
        document.querySelectorAll('.view-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const viewType = e.target.dataset.view;
                this.animateViewChange(viewType);
            });
        });
    },

    // حركة تغيير العرض
    animateViewChange(viewType) {
        const grid = document.getElementById('themes-grid');
        if (!grid) return;

        // إخفاء تدريجي
        grid.style.opacity = '0.3';
        grid.style.transform = 'scale(0.95)';
        
        setTimeout(() => {
            // تطبيق النمط الجديد
            grid.className = `themes-grid view-${viewType}`;
            
            // إظهار تدريجي
            grid.style.transition = 'all 0.4s ease';
            grid.style.opacity = '1';
            grid.style.transform = 'scale(1)';
            
            // تحريك البطاقات الفردية
            this.animateCardsReorder();
        }, 200);
    },

    // تحريك إعادة ترتيب البطاقات
    animateCardsReorder() {
        const cards = document.querySelectorAll('.theme-card');
        
        cards.forEach((card, index) => {
            card.style.animation = `cardReorder 0.5s ease-out ${index * 50}ms forwards`;
        });
    },

    // انتقال الفلاتر
    setupFilterTransitions() {
        const filterSelects = document.querySelectorAll('.filter-select');
        
        filterSelects.forEach(select => {
            select.addEventListener('change', () => {
                this.animateFilterChange();
            });
        });
    },

    // حركة تغيير الفلتر
    animateFilterChange() {
        const grid = document.getElementById('themes-grid');
        if (!grid) return;

        // تأثير تموج
        grid.style.animation = 'filterRipple 0.6s ease-out';
        
        setTimeout(() => {
            grid.style.animation = '';
        }, 600);
    },

    // تأثيرات الماوس
    setupMouseEffects() {
        // تتبع موقع الماوس
        this.trackMousePosition();
        
        // تأثير المتابعة
        this.setupMouseFollower();
        
        // تأثير المغناطيس
        this.setupMagneticEffect();
    },

    // تتبع موقع الماوس
    trackMousePosition() {
        document.addEventListener('mousemove', (e) => {
            this.state.mousePosition.x = e.clientX;
            this.state.mousePosition.y = e.clientY;
            
            // تحديث متغيرات CSS
            document.documentElement.style.setProperty('--mouse-x', e.clientX + 'px');
            document.documentElement.style.setProperty('--mouse-y', e.clientY + 'px');
        });
    },

    // متابع الماوس
    setupMouseFollower() {
        if (this.state.isReducedMotion) return;

        const follower = document.createElement('div');
        follower.className = 'mouse-follower';
        document.body.appendChild(follower);

        let mouseX = 0, mouseY = 0;
        let followerX = 0, followerY = 0;

        const updateFollower = () => {
            followerX += (mouseX - followerX) * 0.1;
            followerY += (mouseY - followerY) * 0.1;
            
            follower.style.transform = `translate(${followerX}px, ${followerY}px)`;
            requestAnimationFrame(updateFollower);
        };

        document.addEventListener('mousemove', (e) => {
            mouseX = e.clientX;
            mouseY = e.clientY;
        });

        updateFollower();
    },

    // تأثير المغناطيس
    setupMagneticEffect() {
        if (this.state.isReducedMotion) return;

        document.querySelectorAll('.magnetic').forEach(element => {
            element.addEventListener('mouseenter', () => {
                element.style.transition = 'transform 0.3s ease';
            });

            element.addEventListener('mousemove', (e) => {
                const rect = element.getBoundingClientRect();
                const centerX = rect.left + rect.width / 2;
                const centerY = rect.top + rect.height / 2;
                
                const deltaX = (e.clientX - centerX) * 0.15;
                const deltaY = (e.clientY - centerY) * 0.15;
                
                element.style.transform = `translate(${deltaX}px, ${deltaY}px)`;
            });

            element.addEventListener('mouseleave', () => {
                element.style.transform = '';
            });
        });
    },

    // إنشاء كيفرايمات ديناميكية
    createDynamicKeyframes() {
        const style = document.createElement('style');
        style.textContent = `
            @keyframes loaderSpin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }

            @keyframes cardFloat {
                0%, 100% { transform: translateY(0); }
                50% { transform: translateY(-10px); }
            }

            @keyframes cardReorder {
                0% { 
                    opacity: 0.5; 
                    transform: scale(0.9) translateY(20px); 
                }
                100% { 
                    opacity: 1; 
                    transform: scale(1) translateY(0); 
                }
            }

            @keyframes filterRipple {
                0% { transform: scale(1); }
                50% { transform: scale(1.02); }
                100% { transform: scale(1); }
            }

            @keyframes slideInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .ripple-effect {
                position: absolute;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.6);
                pointer-events: none;
                width: 20px;
                height: 20px;
                animation: rippleExpand 0.6s ease-out;
            }

            @keyframes rippleExpand {
                to {
                    width: 200px;
                    height: 200px;
                    opacity: 0;
                    transform: translate(-50%, -50%);
                }
            }

            .button-wave {
                position: absolute;
                top: 50%;
                left: 50%;
                width: 0;
                height: 0;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.3);
                transform: translate(-50%, -50%);
                animation: waveExpand 0.5s ease-out;
            }

            @keyframes waveExpand {
                to {
                    width: 100%;
                    height: 100%;
                    opacity: 0;
                }
            }

            .scroll-progress-bar {
                position: fixed;
                top: 0;
                left: 0;
                height: 3px;
                background: linear-gradient(90deg, #3b82f6, #8b5cf6);
                z-index: 10000;
                transition: width 0.1s ease;
            }

            .mouse-follower {
                position: fixed;
                width: 20px;
                height: 20px;
                border: 2px solid rgba(59, 130, 246, 0.5);
                border-radius: 50%;
                pointer-events: none;
                z-index: 9999;
                mix-blend-mode: difference;
            }

            .archive-header.scrolled {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
                border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            }

            .archive-header.hidden {
                transform: translateY(-100%);
            }

            .reduced-motion * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        `;
        
        document.head.appendChild(style);
    },

    // تنظيف التأثيرات
    cleanup() {
        if (this.state.animationFrame) {
            cancelAnimationFrame(this.state.animationFrame);
        }

        // إزالة مستمعي الأحداث
        const mouseFollower = document.querySelector('.mouse-follower');
        if (mouseFollower) {
            mouseFollower.remove();
        }

        const progressBar = document.querySelector('.scroll-progress-bar');
        if (progressBar) {
            progressBar.remove();
        }

        this.state.isInitialized = false;
        console.log('🧹 تم تنظيف نظام التأثيرات');
    },

    // إعادة تهيئة
    reinit() {
        this.cleanup();
        setTimeout(() => {
            this.init();
        }, 100);
    }
};

// إنشاء الكيفرايمات عند التحميل
document.addEventListener('DOMContentLoaded', () => {
    ArchiveEffects.createDynamicKeyframes();
    
    // انتظار تهيئة الأنظمة الأخرى
    setTimeout(() => {
        ArchiveEffects.init();
    }, 200);
});

// تنظيف عند إغلاق الصفحة
window.addEventListener('beforeunload', () => {
    ArchiveEffects.cleanup();
});

// تصدير للاستخدام العام
window.ArchiveEffects = ArchiveEffects;

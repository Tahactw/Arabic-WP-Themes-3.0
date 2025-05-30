/**
 * التفاعلات المتقدمة والتأثيرات ثلاثية الأبعاد
 * قوالب عربية ووردبريس
 */

(function() {
    'use strict';

    let scene, camera, renderer, particles = [];
    let mouseX = 0, mouseY = 0;
    let downloadModal, countdownInterval;
    let currentVisitors = 25;
    let totalDownloads = 1247;

    // تهيئة التطبيق عند تحميل الصفحة
    document.addEventListener('DOMContentLoaded', function() {
        init3DBackground();
        initParticleSystem();
        initInteractiveElements();
        initDownloadSystem();
        initLiveStats();
        initTypeWriter();
        initScrollAnimations();
        initSoundEffects();
        addFloatingParticles();
    });

    /**
     * خلفية ثلاثية الأبعاد خرافية
     */
    function init3DBackground() {
        const container = document.getElementById('three-container');
        if (!container) return;

        // إعداد المشهد
        scene = new THREE.Scene();
        camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true });
        
        renderer.setSize(window.innerWidth, window.innerHeight);
        renderer.setClearColor(0x000000, 0);
        container.appendChild(renderer.domElement);

        // إضافة الأشكال الهندسية المتحركة
        createFloatingGeometry();
        
        // إضافة الإضاءة
        const ambientLight = new THREE.AmbientLight(0x00ffff, 0.3);
        scene.add(ambientLight);
        
        const directionalLight = new THREE.DirectionalLight(0x8b5cf6, 0.8);
        directionalLight.position.set(1, 1, 1);
        scene.add(directionalLight);

        camera.position.z = 5;

        // تتبع حركة الماوس
        document.addEventListener('mousemove', onMouseMove);
        window.addEventListener('resize', onWindowResize);

        // بدء الرسم
        animate();
    }

    function createFloatingGeometry() {
        // إنشاء أشكال هندسية مختلفة
        const geometries = [
            new THREE.BoxGeometry(0.5, 0.5, 0.5),
            new THREE.SphereGeometry(0.3, 32, 32),
            new THREE.ConeGeometry(0.3, 0.8, 8),
            new THREE.TorusGeometry(0.3, 0.1, 16, 100),
            new THREE.OctahedronGeometry(0.4),
            new THREE.TetrahedronGeometry(0.5)
        ];

        const materials = [
            new THREE.MeshLambertMaterial({ 
                color: 0x00ffff, 
                transparent: true, 
                opacity: 0.7,
                wireframe: false
            }),
            new THREE.MeshLambertMaterial({ 
                color: 0x8b5cf6, 
                transparent: true, 
                opacity: 0.6,
                wireframe: true
            }),
            new THREE.MeshLambertMaterial({ 
                color: 0xec4899, 
                transparent: true, 
                opacity: 0.5
            })
        ];

        // إنشاء 50 شكل عشوائي
        for (let i = 0; i < 50; i++) {
            const geometry = geometries[Math.floor(Math.random() * geometries.length)];
            const material = materials[Math.floor(Math.random() * materials.length)];
            const mesh = new THREE.Mesh(geometry, material);

            // موضع عشوائي
            mesh.position.x = (Math.random() - 0.5) * 20;
            mesh.position.y = (Math.random() - 0.5) * 20;
            mesh.position.z = (Math.random() - 0.5) * 20;

            // سرعة دوران عشوائية
            mesh.userData = {
                rotationSpeed: {
                    x: (Math.random() - 0.5) * 0.02,
                    y: (Math.random() - 0.5) * 0.02,
                    z: (Math.random() - 0.5) * 0.02
                },
                floatSpeed: Math.random() * 0.01 + 0.005,
                originalY: mesh.position.y
            };

            scene.add(mesh);
            particles.push(mesh);
        }
    }

    function onMouseMove(event) {
        mouseX = (event.clientX / window.innerWidth) * 2 - 1;
        mouseY = -(event.clientY / window.innerHeight) * 2 + 1;
    }

    function onWindowResize() {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(window.innerWidth, window.innerHeight);
    }

    function animate() {
        requestAnimationFrame(animate);

        // تحريك الأشكال
        particles.forEach((particle, index) => {
            const userData = particle.userData;
            
            // دوران
            particle.rotation.x += userData.rotationSpeed.x;
            particle.rotation.y += userData.rotationSpeed.y;
            particle.rotation.z += userData.rotationSpeed.z;
            
            // حركة عائمة
            particle.position.y = userData.originalY + Math.sin(Date.now() * userData.floatSpeed + index) * 2;
            
            // تفاعل مع الماوس
            particle.position.x += (mouseX * 2 - particle.position.x) * 0.01;
            particle.position.z += (mouseY * 2 - particle.position.z) * 0.01;
        });

        // تحريك الكاميرا
        camera.position.x += (mouseX * 0.5 - camera.position.x) * 0.02;
        camera.position.y += (mouseY * 0.5 - camera.position.y) * 0.02;

        renderer.render(scene, camera);
    }

    /**
     * نظام الجسيمات المتطايرة
     */
    function initParticleSystem() {
        if (typeof particlesJS !== 'undefined') {
            particlesJS('particles-js', {
                particles: {
                    number: { value: 80 },
                    color: { value: '#00ffff' },
                    shape: { type: 'circle' },
                    opacity: { 
                        value: 0.5,
                        random: true,
                        animation: { enable: true, speed: 1 }
                    },
                    size: { 
                        value: 3,
                        random: true,
                        animation: { enable: true, speed: 2 }
                    },
                    line_linked: {
                        enable: true,
                        distance: 150,
                        color: '#00ffff',
                        opacity: 0.2,
                        width: 1
                    },
                    move: {
                        enable: true,
                        speed: 2,
                        direction: 'none',
                        random: false,
                        straight: false,
                        out_mode: 'out',
                        attract: { enable: false }
                    }
                },
                interactivity: {
                    detect_on: 'canvas',
                    events: {
                        onhover: { enable: true, mode: 'repulse' },
                        onclick: { enable: true, mode: 'push' }
                    }
                }
            });
        }
    }

    /**
     * العناصر التفاعلية
     */
    function initInteractiveElements() {
        // تأثيرات الأزرار
        document.querySelectorAll('.btn, .theme-card').forEach(element => {
            element.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px) scale(1.02)';
                addGlowEffect(this);
            });

            element.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
                removeGlowEffect(this);
            });

            element.addEventListener('click', function(e) {
                createRippleEffect(e, this);
            });
        });

        // تأثير المرور على النجوم
        document.querySelectorAll('.star-rating').forEach(star => {
            star.addEventListener('mouseenter', function() {
                const rating = parseInt(this.dataset.rating);
                highlightStars(rating);
                playClickSound();
            });
        });
    }

    function addGlowEffect(element) {
        element.style.boxShadow = '0 0 30px rgba(0, 255, 255, 0.5)';
        element.style.borderColor = '#00ffff';
    }

    function removeGlowEffect(element) {
        element.style.boxShadow = '';
        element.style.borderColor = '';
    }

    function createRippleEffect(event, element) {
        const ripple = document.createElement('span');
        const rect = element.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = event.clientX - rect.left - size / 2;
        const y = event.clientY - rect.top - size / 2;

        ripple.style.width = ripple.style.height = size + 'px';
        ripple.style.left = x + 'px';
        ripple.style.top = y + 'px';
        ripple.classList.add('ripple');

        element.appendChild(ripple);

        setTimeout(() => ripple.remove(), 600);
    }

    /**
     * نظام التحميل المتقدم
     */
    function initDownloadSystem() {
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('download-theme') || 
                e.target.closest('.download-theme')) {
                
                e.preventDefault();
                const button = e.target.classList.contains('download-theme') ? 
                    e.target : e.target.closest('.download-theme');
                
                const themeId = button.getAttribute('data-theme-id');
                if (themeId) {
                    startDownloadProcess(themeId);
                }
            }
        });
    }

    function startDownloadProcess(themeId) {
        // إنشاء نموذج التقييم
        createRatingModal(themeId);
        
        // عرض العداد التنازلي
        showCountdown(5, function() {
            // إظهار نموذج التقييم بعد العداد
            document.getElementById('rating-modal').style.display = 'flex';
            
            // تأثير انزلاق
            gsap.fromTo('.modal-content', {
                scale: 0.8,
                opacity: 0,
                y: -50
            }, {
                scale: 1,
                opacity: 1,
                y: 0,
                duration: 0.5,
                ease: "back.out(1.7)"
            });
        });
    }

    function createRatingModal(themeId) {
        if (document.getElementById('rating-modal')) {
            document.getElementById('rating-modal').remove();
        }

        const modal = document.createElement('div');
        modal.id = 'rating-modal';
        modal.className = 'rating-modal';
        modal.innerHTML = `
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">قيم هذا القالب</h3>
                    <button class="close-modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>ساعد الآخرين في اكتشاف القوالب الرائعة بتقييم هذا القالب!</p>
                    
                    <div class="countdown-container" id="countdown-container">
                        <div class="countdown-circle">
                            <span class="countdown-number" id="countdown-number">5</span>
                        </div>
                        <p class="countdown-text">ثانية لإظهار نموذج التقييم</p>
                    </div>
                    
                    <div class="rating-form" id="rating-form" style="display: none;">
                        <div class="form-group">
                            <label>تقييمك:</label>
                            <div class="stars">
                                ${Array.from({length: 5}, (_, i) => 
                                    `<button type="button" class="star-rating" data-rating="${i + 1}">★</button>`
                                ).join('')}
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="user-email">بريدك الإلكتروني:</label>
                            <input type="email" id="user-email" class="form-control" required 
                                   placeholder="your@email.com">
                        </div>
                        
                        <div class="form-group">
                            <label for="review-text">مراجعتك (اختياري):</label>
                            <textarea id="review-text" class="form-control" 
                                      placeholder="شاركنا رأيك في هذا القالب..."></textarea>
                        </div>
                        
                        <div class="modal-actions">
                            <button type="button" id="submit-rating" class="btn btn-primary" data-theme-id="${themeId}">
                                <i class="fas fa-download"></i>
                                تقييم وتحميل
                            </button>
                            <button type="button" id="skip-rating" class="btn btn-secondary">
                                تخطي التقييم
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;

        document.body.appendChild(modal);

        // ربط الأحداث
        bindModalEvents(modal, themeId);
    }

    function showCountdown(seconds, callback) {
        const countdownContainer = document.getElementById('countdown-container');
        const countdownNumber = document.getElementById('countdown-number');
        const countdownCircle = countdownContainer.querySelector('.countdown-circle');
        
        let currentSecond = seconds;
        
        countdownInterval = setInterval(() => {
            currentSecond--;
            countdownNumber.textContent = currentSecond;
            
            // تحديث الدائرة
            const percentage = ((seconds - currentSecond) / seconds) * 360;
            countdownCircle.style.background = 
                `conic-gradient(#00ffff ${percentage}deg, transparent ${percentage}deg)`;
            
            // تأثير نبضة
            gsap.to(countdownNumber, {
                scale: 1.2,
                duration: 0.1,
                yoyo: true,
                repeat: 1
            });
            
            if (currentSecond <= 0) {
                clearInterval(countdownInterval);
                countdownContainer.style.display = 'none';
                document.getElementById('rating-form').style.display = 'block';
                
                // تأثير ظهور النموذج
                gsap.fromTo('#rating-form', {
                    opacity: 0,
                    y: 20
                }, {
                    opacity: 1,
                    y: 0,
                    duration: 0.5
                });
                
                if (callback) callback();
            }
        }, 1000);
    }

    function bindModalEvents(modal, themeId) {
        // إغلاق النموذج
        modal.querySelector('.close-modal').addEventListener('click', closeModal);
        modal.addEventListener('click', function(e) {
            if (e.target === modal) closeModal();
        });

        // تقييم النجوم
        const stars = modal.querySelectorAll('.star-rating');
        let selectedRating = 0;

        stars.forEach(star => {
            star.addEventListener('click', function() {
                selectedRating = parseInt(this.dataset.rating);
                highlightStars(selectedRating);
                playClickSound();
            });

            star.addEventListener('mouseenter', function() {
                const rating = parseInt(this.dataset.rating);
                highlightStars(rating);
            });
        });

        modal.addEventListener('mouseleave', function() {
            highlightStars(selectedRating);
        });

        // إرسال التقييم
        modal.querySelector('#submit-rating').addEventListener('click', function() {
            submitRating(themeId, selectedRating);
        });

        modal.querySelector('#skip-rating').addEventListener('click', function() {
            submitRating(themeId, 0);
        });
    }

    function highlightStars(rating) {
        document.querySelectorAll('.star-rating').forEach((star, index) => {
            if (index < rating) {
                star.classList.add('active');
                star.style.color = '#fbbf24';
                star.style.textShadow = '0 0 10px rgba(251, 191, 36, 0.8)';
            } else {
                star.classList.remove('active');
                star.style.color = '#374151';
                star.style.textShadow = 'none';
            }
        });
    }

    function submitRating(themeId, rating) {
        const email = document.getElementById('user-email').value;
        const review = document.getElementById('review-text').value;
        const submitBtn = document.getElementById('submit-rating');

        if (rating > 0 && !email) {
            showNotification('يرجى إدخال بريدك الإلكتروني', 'error');
            return;
        }

        // إظهار حالة التحميل
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري المعالجة...';

        // محاكاة AJAX
        const formData = new FormData();
        formData.append('action', 'theme_download');
        formData.append('theme_id', themeId);
        formData.append('rating', rating);
        formData.append('review', review);
        formData.append('email', email);
        formData.append('nonce', ajax_object.nonce);

        fetch(ajax_object.ajax_url, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // تأثير انفجار الجسيمات
                createParticleExplosion();
                
                // تشغيل صوت النجاح
                playSuccessSound();
                
                // إظهار رسالة النجاح
                showNotification('شكراً لك! جاري تحويلك لصفحة التحميل...', 'success');
                
                // تحديث الإحصائيات
                updateStats();
                
                // توجيه للرابط
                setTimeout(() => {
                    window.open(data.download_url, '_blank');
                    closeModal();
                }, 2000);
                
            } else {
                showNotification(data.message || 'حدث خطأ، يرجى المحاولة مرة أخرى', 'error');
            }
        })
        .catch(error => {
            console.error('خطأ:', error);
            showNotification('خطأ في الشبكة، يرجى التحقق من اتصالك', 'error');
        })
        .finally(() => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fas fa-download"></i> تقييم وتحميل';
        });
    }

    function closeModal() {
        const modal = document.getElementById('rating-modal');
        if (modal) {
            if (countdownInterval) {
                clearInterval(countdownInterval);
            }
            
            gsap.to(modal, {
                opacity: 0,
                duration: 0.3,
                onComplete: () => modal.remove()
            });
        }
    }

    /**
     * الإحصائيات المباشرة
     */
    function initLiveStats() {
        updateVisitorCount();
        setInterval(updateVisitorCount, 30000); // تحديث كل 30 ثانية
        
        createLiveStatsWidget();
    }

    function createLiveStatsWidget() {
        const widget = document.createElement('div');
        widget.className = 'live-stats';
        widget.innerHTML = `
            <div class="stat-item">
                <span class="stat-label">الزوار الآن</span>
                <span class="stat-value" id="current-visitors">${currentVisitors}</span>
            </div>
            <div class="stat-item">
                <span class="stat-label">إجمالي التحميلات</span>
                <span class="stat-value" id="total-downloads">${totalDownloads.toLocaleString()}</span>
            </div>
        `;
        
        document.body.appendChild(widget);
        
        // تأثير ظهور تدريجي
        gsap.fromTo(widget, {
            x: -200,
            opacity: 0
        }, {
            x: 0,
            opacity: 1,
            duration: 1,
            delay: 1
        });
    }

    function updateVisitorCount() {
        // محاكاة تحديث عدد الزوار
        currentVisitors += Math.floor(Math.random() * 3) - 1;
        if (currentVisitors < 15) currentVisitors = 15;
        if (currentVisitors > 45) currentVisitors = 45;
        
        const element = document.getElementById('current-visitors');
        if (element) {
            // تأثير الانتقال
            gsap.to(element, {
                scale: 1.2,
                duration: 0.2,
                yoyo: true,
                repeat: 1,
                onComplete: () => {
                    element.textContent = currentVisitors;
                }
            });
        }
    }

    function updateStats() {
        totalDownloads++;
        const element = document.getElementById('total-downloads');
        if (element) {
            gsap.to(element, {
                scale: 1.3,
                color: '#00ffff',
                duration: 0.3,
                yoyo: true,
                repeat: 1,
                onComplete: () => {
                    element.textContent = totalDownloads.toLocaleString();
                }
            });
        }
    }

    /**
     * كاتب النص التلقائي
     */
    function initTypeWriter() {
        const titleElement = document.querySelector('.hero-title');
        if (!titleElement) return;

        const text = titleElement.textContent;
        titleElement.textContent = '';
        titleElement.style.opacity = '1';

        let i = 0;
        const typeWriter = () => {
            if (i < text.length) {
                titleElement.textContent += text.charAt(i);
                i++;
                setTimeout(typeWriter, 100);
            }
        };

        setTimeout(typeWriter, 1000);
    }

    /**
     * تأثيرات التمرير
     */
    function initScrollAnimations() {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                    
                    // تأثيرات خاصة لبطاقات القوالب
                    if (entry.target.classList.contains('theme-card')) {
                        gsap.fromTo(entry.target, {
                            y: 50,
                            opacity: 0,
                            rotationX: -15
                        }, {
                            y: 0,
                            opacity: 1,
                            rotationX: 0,
                            duration: 0.8,
                            ease: "back.out(1.7)"
                        });
                    }
                }
            });
        }, observerOptions);

        // مراقبة العناصر
        document.querySelectorAll('.theme-card, .section-header, .btn').forEach(el => {
            observer.observe(el);
        });
    }

    /**
     * تأثيرات الصوت
     */
    function initSoundEffects() {
        // تحميل الأصوات مسبقاً
        window.clickSound = new Audio(ajax_object.sounds?.click || '');
        window.successSound = new Audio(ajax_object.sounds?.success || '');
        
        // كتم الأصوات افتراضياً
        window.clickSound.volume = 0.3;
        window.successSound.volume = 0.5;
    }

    function playClickSound() {
        if (window.clickSound) {
            window.clickSound.currentTime = 0;
            window.clickSound.play().catch(() => {});
        }
    }

    function playSuccessSound() {
        if (window.successSound) {
            window.successSound.currentTime = 0;
            window.successSound.play().catch(() => {});
        }
        
        // تأثير موجة صوتية مرئية
        createSoundWave();
    }

    function createSoundWave() {
        const wave = document.createElement('div');
        wave.className = 'sound-wave';
        document.body.appendChild(wave);
        
        setTimeout(() => wave.remove(), 600);
    }

    /**
     * انفجار الجسيمات
     */
    function createParticleExplosion() {
        const explosion = document.createElement('div');
        explosion.className = 'particles-explosion';
        document.body.appendChild(explosion);

        // إنشاء 30 جسيم
        for (let i = 0; i < 30; i++) {
            const particle = document.createElement('div');
            particle.className = 'particle';
            
            const angle = (i / 30) * Math.PI * 2;
            const velocity = Math.random() * 200 + 100;
            const x = Math.cos(angle) * velocity;
            const y = Math.sin(angle) * velocity;
            
            particle.style.setProperty('--random-x', x + 'px');
            particle.style.setProperty('--random-y', y + 'px');
            particle.style.backgroundColor = ['#00ffff', '#8b5cf6', '#ec4899', '#10b981'][Math.floor(Math.random() * 4)];
            
            explosion.appendChild(particle);
        }

        setTimeout(() => explosion.remove(), 1000);
    }

    /**
     * جسيمات عائمة في الخلفية
     */
    function addFloatingParticles() {
        const container = document.createElement('div');
        container.className = 'floating-particles';
        document.body.appendChild(container);

        for (let i = 0; i < 20; i++) {
            const particle = document.createElement('div');
            particle.className = 'particle-dot';
            particle.style.left = Math.random() * 100 + '%';
            particle.style.top = Math.random() * 100 + '%';
            particle.style.animationDelay = Math.random() * 6 + 's';
            particle.style.animationDuration = (Math.random() * 3 + 3) + 's';
            
            container.appendChild(particle);
        }
    }

    /**
     * نظام الإشعارات
     */
    function showNotification(message, type = 'info') {
        // إزالة الإشعارات الموجودة
        document.querySelectorAll('.notification').forEach(n => n.remove());

        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.innerHTML = `
            <span class="notification-message">${message}</span>
            <button class="notification-close">&times;</button>
        `;

        document.body.appendChild(notification);

        // تأثير ظهور
        gsap.fromTo(notification, {
            x: 300,
            opacity: 0
        }, {
            x: 0,
            opacity: 1,
            duration: 0.5
        });

        // إزالة تلقائية
        setTimeout(() => {
            gsap.to(notification, {
                x: 300,
                opacity: 0,
                duration: 0.3,
                onComplete: () => notification.remove()
            });
        }, 5000);

        // إزالة عند النقر
        notification.querySelector('.notification-close').addEventListener('click', () => {
            notification.remove();
        });
    }

    /**
     * تعريض الوظائف للاستخدام العام
     */
    window.ArabicThemes = {
        showNotification,
        playClickSound,
        playSuccessSound,
        createParticleExplosion,
        updateStats
    };

})();
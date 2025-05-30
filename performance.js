/**
 * تحسينات الأداء المتقدمة
 * قوالب عربية ووردبريس
 */

class PerformanceOptimizer {
    constructor() {
        this.init();
    }

    init() {
        this.optimizeImages();
        this.implementLazyLoading();
        this.optimizeAnimations();
        this.cacheManagement();
        this.networkOptimization();
        this.memoryManagement();
    }

    // تحسين الصور
    optimizeImages() {
        // تحميل الصور الكسول
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        this.loadImage(img);
                        imageObserver.unobserve(img);
                    }
                });
            }, {
                rootMargin: '50px 0px',
                threshold: 0.01
            });

            document.querySelectorAll('img[data-src]').forEach(img => {
                imageObserver.observe(img);
            });
        }

        // ضغط الصور بعد التحميل
        this.compressImages();
    }

    loadImage(img) {
        const src = img.getAttribute('data-src');
        if (!src) return;

        // إضافة تأثير ضبابي أثناء التحميل
        img.style.filter = 'blur(10px)';
        img.style.transition = 'filter 0.3s ease';

        const tempImg = new Image();
        tempImg.onload = () => {
            img.src = src;
            img.removeAttribute('data-src');
            img.style.filter = 'none';
            img.classList.add('loaded');
        };
        tempImg.onerror = () => {
            img.src = 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjIwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZGRkIi8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzk5OSIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9Ii4zZW0iPtmu2YTZhyDZitmKINmF2KrZiNmB2LHYqDwvdGV4dD48L3N2Zz4=';
            img.style.filter = 'none';
        };
        tempImg.src = src;
    }

    compressImages() {
        const images = document.querySelectorAll('img');
        images.forEach(img => {
            img.addEventListener('load', () => {
                if (img.naturalWidth > 800) {
                    this.resizeImage(img, 800);
                }
            });
        });
    }

    resizeImage(img, maxWidth) {
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');
        
        const ratio = Math.min(maxWidth / img.naturalWidth, maxWidth / img.naturalHeight);
        canvas.width = img.naturalWidth * ratio;
        canvas.height = img.naturalHeight * ratio;
        
        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
        
        canvas.toBlob(blob => {
            if (blob.size < img.src.length * 0.8) {
                img.src = URL.createObjectURL(blob);
            }
        }, 'image/jpeg', 0.8);
    }

    // تحميل كسول للمحتوى
    implementLazyLoading() {
        // تحميل كسول للبطاقات
        if ('IntersectionObserver' in window) {
            const cardObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const card = entry.target;
                
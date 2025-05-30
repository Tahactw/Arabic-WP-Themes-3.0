/**
 * نواة أرشيف القوالب
 * الوظائف الأساسية والتهيئة
 * 
 * @package ArabicThemes
 * @author Tahactw
 * @date 2025-05-30
 */

const ArchiveCore = {
    // الإعدادات
    settings: {
        itemsPerPage: 12,
        loadingDelay: 300,
        animationDuration: 500,
        searchDelay: 300
    },

    // العناصر
    elements: {
        grid: null,
        searchInput: null,
        loadMoreBtn: null,
        resultCount: null,
        filters: {}
    },

    // البيانات
    data: {
        allThemes: [],
        filteredThemes: [],
        currentPage: 1,
        totalPages: 1,
        activeFilters: {
            search: '',
            category: '',
            sort: 'date-desc',
            type: '',
            price: ''
        }
    },

    // التهيئة الرئيسية
    init() {
        console.log('🚀 تهيئة نظام أرشيف القوالب...');
        
        this.cacheElements();
        this.bindEvents();
        this.initializeData();
        this.setupThemeToggle();
        this.initializeAnimations();
        this.setupTooltips();
        
        console.log('✅ تم تهيئة النظام بنجاح');
    },

    // تخزين مؤقت للعناصر
    cacheElements() {
        this.elements.grid = document.getElementById('themes-grid');
        this.elements.searchInput = document.getElementById('theme-search');
        this.elements.loadMoreBtn = document.getElementById('load-more-btn');
        this.elements.resultCount = document.getElementById('results-count');
        
        // فلاتر
        this.elements.filters = {
            category: document.getElementById('category-filter'),
            sort: document.getElementById('sort-filter'),
            type: document.getElementById('type-filter'),
            price: document.getElementById('price-filter')
        };
    },

    // ربط الأحداث
    bindEvents() {
        // البحث
        if (this.elements.searchInput) {
            let searchTimeout;
            this.elements.searchInput.addEventListener('input', (e) => {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    this.handleSearch(e.target.value);
                }, this.settings.searchDelay);
            });
        }

        // الفلاتر
        Object.entries(this.elements.filters).forEach(([key, element]) => {
            if (element) {
                element.addEventListener('change', (e) => {
                    this.handleFilterChange(key, e.target.value);
                });
            }
        });

        // تحميل المزيد
        if (this.elements.loadMoreBtn) {
            this.elements.loadMoreBtn.addEventListener('click', () => {
                this.loadMoreThemes();
            });
        }

        // تبديل أنماط العرض
        document.querySelectorAll('.view-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                this.handleViewChange(e.target.dataset.view);
            });
        });

        // إغلاق البحث
        const searchClear = document.getElementById('search-clear');
        if (searchClear) {
            searchClear.addEventListener('click', () => {
                this.clearSearch();
            });
        }

        // أحداث النوافذ
        window.addEventListener('scroll', this.throttle(this.handleScroll.bind(this), 100));
        window.addEventListener('resize', this.throttle(this.handleResize.bind(this), 250));
    },

    // تهيئة البيانات
    initializeData() {
        const themeCards = document.querySelectorAll('.theme-card-wrapper');
        this.data.allThemes = Array.from(themeCards).map(card => ({
            element: card,
            title: card.dataset.title?.toLowerCase() || '',
            categories: card.dataset.categories?.split(',') || [],
            tags: card.dataset.tags?.split(',') || [],
            date: new Date(card.dataset.date || Date.now()),
            modified: new Date(card.dataset.modified || Date.now()),
            downloads: parseInt(card.dataset.downloads) || 0,
            rating: parseFloat(card.dataset.rating) || 0,
            price: card.dataset.price || '',
            color: card.dataset.color || '',
            type: card.dataset.type || '',
            featured: card.dataset.featured === 'true'
        }));

        this.data.filteredThemes = [...this.data.allThemes];
        this.updateResultCount();
        this.calculatePagination();
    },

    // معالجة البحث
    handleSearch(query) {
        this.data.activeFilters.search = query.toLowerCase().trim();
        this.applyFilters();
        this.showToast(query ? `البحث عن: ${query}` : 'تم مسح البحث', 'info');
    },

    // معالجة تغيير الفلاتر
    handleFilterChange(filterType, value) {
        this.data.activeFilters[filterType] = value;
        this.applyFilters();
        this.showToast(`تم تطبيق فلتر ${this.getFilterName(filterType)}`, 'success');
    },

    // تطبيق الفلاتر
    applyFilters() {
        let filtered = [...this.data.allThemes];
        const filters = this.data.activeFilters;

        // فلتر البحث
        if (filters.search) {
            filtered = filtered.filter(theme => 
                theme.title.includes(filters.search) ||
                theme.categories.some(cat => cat.includes(filters.search)) ||
                theme.tags.some(tag => tag.includes(filters.search))
            );
        }

        // فلتر التصنيف
        if (filters.category) {
            filtered = filtered.filter(theme => 
                theme.categories.includes(filters.category)
            );
        }

        // فلتر النوع
        if (filters.type) {
            filtered = filtered.filter(theme => theme.type === filters.type);
        }

        // فلتر السعر
        if (filters.price) {
            if (filters.price === 'free') {
                filtered = filtered.filter(theme => 
                    theme.price === 'مجاني' || theme.price === '0'
                );
            } else if (filters.price === 'premium') {
                filtered = filtered.filter(theme => 
                    theme.price !== 'مجاني' && theme.price !== '0'
                );
            }
        }

        // ترتيب النتائج
        this.sortThemes(filtered, filters.sort);

        this.data.filteredThemes = filtered;
        this.data.currentPage = 1;
        this.calculatePagination();
        this.renderThemes();
        this.updateResultCount();
    },

    // ترتيب القوالب
    sortThemes(themes, sortType) {
        switch (sortType) {
            case 'date-desc':
                themes.sort((a, b) => b.date - a.date);
                break;
            case 'date-asc':
                themes.sort((a, b) => a.date - b.date);
                break;
            case 'title-asc':
                themes.sort((a, b) => a.title.localeCompare(b.title, 'ar'));
                break;
            case 'title-desc':
                themes.sort((a, b) => b.title.localeCompare(a.title, 'ar'));
                break;
            case 'downloads-desc':
                themes.sort((a, b) => b.downloads - a.downloads);
                break;
            case 'downloads-asc':
                themes.sort((a, b) => a.downloads - b.downloads);
                break;
            case 'rating-desc':
                themes.sort((a, b) => b.rating - a.rating);
                break;
            case 'featured':
                themes.sort((a, b) => b.featured - a.featured);
                break;
        }
    },

    // عرض القوالب
    renderThemes() {
        if (!this.elements.grid) return;

        const startIndex = 0;
        const endIndex = this.data.currentPage * this.settings.itemsPerPage;
        const themesToShow = this.data.filteredThemes.slice(startIndex, endIndex);

        // إخفاء جميع القوالب
        this.data.allThemes.forEach(theme => {
            theme.element.style.display = 'none';
            theme.element.classList.remove('animate-in');
        });

        // إظهار القوالب المفلترة
        let delay = 0;
        themesToShow.forEach((theme, index) => {
            setTimeout(() => {
                theme.element.style.display = 'block';
                theme.element.classList.add('animate-in');
            }, delay);
            delay += 50;
        });

        // تحديث زر تحميل المزيد
        this.updateLoadMoreButton();
    },

    // تحميل المزيد من القوالب
    loadMoreThemes() {
        if (this.data.currentPage >= this.data.totalPages) return;

        this.showLoadingState(true);
        
        setTimeout(() => {
            this.data.currentPage++;
            this.renderThemes();
            this.showLoadingState(false);
            this.showToast('تم تحميل المزيد من القوالب', 'success');
        }, this.settings.loadingDelay);
    },

    // حساب الترقيم
    calculatePagination() {
        this.data.totalPages = Math.ceil(
            this.data.filteredThemes.length / this.settings.itemsPerPage
        );
    },

    // تحديث عدد النتائج
    updateResultCount() {
        if (!this.elements.resultCount) return;

        const count = this.data.filteredThemes.length;
        const total = this.data.allThemes.length;
        
        this.elements.resultCount.textContent = 
            `عرض ${count} من أصل ${total} قالب`;
    },

    // تحديث زر تحميل المزيد
    updateLoadMoreButton() {
        if (!this.elements.loadMoreBtn) return;

        const hasMore = this.data.currentPage < this.data.totalPages;
        this.elements.loadMoreBtn.style.display = hasMore ? 'block' : 'none';
    },

    // تغيير نمط العرض
    handleViewChange(viewType) {
        const grid = this.elements.grid;
        if (!grid) return;

        // تحديث الأزرار
        document.querySelectorAll('.view-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        document.querySelector(`[data-view="${viewType}"]`)?.classList.add('active');

        // تطبيق نمط العرض
        grid.className = `themes-grid view-${viewType}`;
        
        this.showToast(`تم تغيير العرض إلى: ${this.getViewName(viewType)}`, 'info');
    },

    // مسح البحث
    clearSearch() {
        if (this.elements.searchInput) {
            this.elements.searchInput.value = '';
            this.handleSearch('');
        }
    },

    // إعداد تبديل المظهر
    setupThemeToggle() {
        const themeToggle = document.getElementById('theme-toggle');
        if (!themeToggle) return;

        // تحميل المظهر المحفوظ
        const savedTheme = localStorage.getItem('archive-theme') || 'light';
        document.documentElement.setAttribute('data-theme', savedTheme);

        themeToggle.addEventListener('click', () => {
            const currentTheme = document.documentElement.getAttribute('data-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            
            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('archive-theme', newTheme);
            
            this.showToast(`تم التبديل إلى المظهر ${newTheme === 'dark' ? 'الداكن' : 'المضيء'}`, 'info');
        });
    },

    // تهيئة الحركات
    initializeAnimations() {
        // مراقبة العناصر للحركات
        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-in');
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '50px'
            });

            // مراقبة بطاقات القوالب
            document.querySelectorAll('.theme-card-wrapper').forEach(card => {
                observer.observe(card);
            });
        }

        // تحريك الأرقام
        this.animateCounters();
    },

    // تحريك العدادات
    animateCounters() {
        const counters = document.querySelectorAll('.stat-number[data-target]');
        
        counters.forEach(counter => {
            const target = parseInt(counter.dataset.target);
            const isDecimal = counter.dataset.target.includes('.');
            let current = 0;
            const increment = target / 100;
            
            const updateCounter = () => {
                if (current < target) {
                    current += increment;
                    counter.textContent = isDecimal ? 
                        current.toFixed(1) : 
                        Math.floor(current).toLocaleString('ar');
                    requestAnimationFrame(updateCounter);
                } else {
                    counter.textContent = isDecimal ? 
                        target.toFixed(1) : 
                        target.toLocaleString('ar');
                }
            };
            
            updateCounter();
        });
    },

    // إعداد التلميحات
    setupTooltips() {
        const tooltips = document.querySelectorAll('[data-tooltip]');
        
        tooltips.forEach(element => {
            element.addEventListener('mouseenter', (e) => {
                this.showTooltip(e.target, e.target.dataset.tooltip);
            });
            
            element.addEventListener('mouseleave', () => {
                this.hideTooltip();
            });
        });
    },

    // إظهار التلميح
    showTooltip(element, text) {
        const tooltip = document.createElement('div');
        tooltip.className = 'custom-tooltip';
        tooltip.textContent = text;
        
        document.body.appendChild(tooltip);
        
        const rect = element.getBoundingClientRect();
        tooltip.style.left = `${rect.left + rect.width / 2}px`;
        tooltip.style.top = `${rect.top - 10}px`;
        
        setTimeout(() => tooltip.classList.add('show'), 10);
    },

    // إخفاء التلميح
    hideTooltip() {
        const tooltip = document.querySelector('.custom-tooltip');
        if (tooltip) {
            tooltip.classList.remove('show');
            setTimeout(() => tooltip.remove(), 300);
        }
    },

    // إظهار حالة التحميل
    showLoadingState(show) {
        if (!this.elements.loadMoreBtn) return;
        
        const btnText = this.elements.loadMoreBtn.querySelector('.btn-text');
        const btnLoader = this.elements.loadMoreBtn.querySelector('.btn-loader');
        
        if (show) {
            btnText.style.opacity = '0';
            btnLoader.style.display = 'block';
            this.elements.loadMoreBtn.disabled = true;
        } else {
            btnText.style.opacity = '1';
            btnLoader.style.display = 'none';
            this.elements.loadMoreBtn.disabled = false;
        }
    },

    // معالجة التمرير
    handleScroll() {
        const scrollTop = window.pageYOffset;
        
        // تأثير الـ Parallax
        document.querySelectorAll('.parallax-layer').forEach(layer => {
            const speed = parseFloat(layer.dataset.speed) || 0.1;
            layer.style.transform = `translateY(${scrollTop * speed}px)`;
        });

        // إظهار/إخفاء زر العودة للأعلى
        const backToTop = document.querySelector('.back-to-top');
        if (backToTop) {
            backToTop.classList.toggle('visible', scrollTop > 500);
        }
    },

    // معالجة تغيير حجم النافذة
    handleResize() {
        // إعادة حساب تخطيط الشبكة إذا لزم الأمر
        this.calculateGridLayout();
    },

    // حساب تخطيط الشبكة
    calculateGridLayout() {
        const grid = this.elements.grid;
        if (!grid) return;

        const containerWidth = grid.offsetWidth;
        const cardMinWidth = 300;
        const gap = 20;
        
        const columns = Math.floor((containerWidth + gap) / (cardMinWidth + gap));
        grid.style.setProperty('--grid-columns', columns);
    },

    // إظهار رسالة Toast
    showToast(message, type = 'info', duration = 3000) {
        const container = document.getElementById('toast-container') || this.createToastContainer();
        
        const toast = document.createElement('div');
        toast.className = `toast toast-${type}`;
        toast.innerHTML = `
            <div class="toast-content">
                <i class="toast-icon ${this.getToastIcon(type)}"></i>
                <span class="toast-message">${message}</span>
                <button class="toast-close" onclick="this.parentElement.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        
        container.appendChild(toast);
        
        // حركة الدخول
        setTimeout(() => toast.classList.add('show'), 10);
        
        // إزالة تلقائية
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => toast.remove(), 300);
        }, duration);
    },

    // إنشاء حاوي Toast
    createToastContainer() {
        const container = document.createElement('div');
        container.id = 'toast-container';
        container.className = 'toast-container';
        document.body.appendChild(container);
        return container;
    },

    // الحصول على أيقونة Toast
    getToastIcon(type) {
        const icons = {
            success: 'fas fa-check-circle',
            error: 'fas fa-exclamation-circle',
            warning: 'fas fa-exclamation-triangle',
            info: 'fas fa-info-circle'
        };
        return icons[type] || icons.info;
    },

    // الحصول على اسم الفلتر
    getFilterName(filterType) {
        const names = {
            category: 'التصنيف',
            sort: 'الترتيب',
            type: 'النوع',
            price: 'السعر'
        };
        return names[filterType] || filterType;
    },

    // الحصول على اسم نمط العرض
    getViewName(viewType) {
        const names = {
            grid: 'الشبكة',
            list: 'القائمة',
            masonry: 'البناء'
        };
        return names[viewType] || viewType;
    },

    // دالة التقليل (Throttle)
    throttle(func, limit) {
        let inThrottle;
        return function() {
            const args = arguments;
            const context = this;
            if (!inThrottle) {
                func.apply(context, args);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        };
    },

    // دالة التأخير (Debounce)
    debounce(func, wait, immediate) {
        let timeout;
        return function() {
            const context = this, args = arguments;
            const later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            const callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    }
};

// تهيئة النظام عند تحميل الصفحة
document.addEventListener('DOMContentLoaded', () => {
    ArchiveCore.init();
});

// تصدير للاستخدام العام
window.ArchiveCore = ArchiveCore;

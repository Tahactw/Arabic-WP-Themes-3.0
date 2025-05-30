/**
 * نظام الفلاتر المتقدم
 * معالجة البحث والفلترة
 * 
 * @package ArabicThemes
 * @author Tahactw
 * @date 2025-05-30
 */

const ArchiveFilters = {
    // إعدادات الفلاتر
    settings: {
        searchDelay: 300,
        animationDuration: 400,
        maxSuggestions: 8,
        minSearchLength: 2
    },

    // كاش البيانات
    cache: {
        searchSuggestions: new Map(),
        filterCounts: new Map(),
        recentSearches: []
    },

    // حالة الفلاتر
    state: {
        activeFilters: new Map(),
        searchQuery: '',
        isFiltering: false,
        lastFilterTime: 0
    },

    // التهيئة
    init() {
        this.setupAdvancedSearch();
        this.setupFilterGroups();
        this.setupSearchSuggestions();
        this.setupFilterHistory();
        this.setupKeyboardShortcuts();
        this.loadFilterPreferences();
        
        console.log('✅ تم تهيئة نظام الفلاتر المتقدم');
    },

    // إعداد البحث المتقدم
    setupAdvancedSearch() {
        const searchInput = document.getElementById('theme-search');
        if (!searchInput) return;

        let searchTimeout;
        let isComposing = false;

        // معالجة الكتابة
        searchInput.addEventListener('input', (e) => {
            if (isComposing) return;

            clearTimeout(searchTimeout);
            const query = e.target.value.trim();

            searchTimeout = setTimeout(() => {
                this.handleAdvancedSearch(query);
            }, this.settings.searchDelay);

            // إظهار اقتراحات فورية
            if (query.length >= this.settings.minSearchLength) {
                this.showSearchSuggestions(query);
            } else {
                this.hideSearchSuggestions();
            }
        });

        // معالجة الكتابة المركبة (للغة العربية)
        searchInput.addEventListener('compositionstart', () => {
            isComposing = true;
        });

        searchInput.addEventListener('compositionend', (e) => {
            isComposing = false;
            this.handleAdvancedSearch(e.target.value.trim());
        });

        // معالجة لوحة المفاتيح
        searchInput.addEventListener('keydown', (e) => {
            this.handleSearchKeyboard(e);
        });
    },

    // معالجة البحث المتقدم
    handleAdvancedSearch(query) {
        this.state.searchQuery = query;
        this.state.lastFilterTime = Date.now();

        // حفظ البحث الأخير
        if (query && !this.cache.recentSearches.includes(query)) {
            this.cache.recentSearches.unshift(query);
            this.cache.recentSearches = this.cache.recentSearches.slice(0, 10);
            this.saveSearchHistory();
        }

        // تطبيق البحث
        this.applyAdvancedFilters();

        // تحديث URL
        this.updateURLParams();
    },

    // إعداد مجموعات الفلاتر
    setupFilterGroups() {
        const filterGroups = document.querySelectorAll('.filter-group');
        
        filterGroups.forEach(group => {
            const select = group.querySelector('.filter-select');
            const label = group.querySelector('.filter-label');

            if (select && label) {
                this.enhanceFilterSelect(select, label, group);
            }
        });

        // إعداد فلاتر مخصصة
        this.setupCustomFilters();
        this.setupFilterCombinations();
    },

    // تحسين قوائم الفلاتر
    enhanceFilterSelect(select, label, group) {
        // إضافة عداد للخيارات
        const options = select.querySelectorAll('option');
        options.forEach(option => {
            if (option.value) {
                const count = this.getFilterCount(select.id, option.value);
                if (count !== null) {
                    option.textContent += ` (${count})`;
                }
            }
        });

        // إضافة مؤشر التحميل
        const loadingIndicator = document.createElement('div');
        loadingIndicator.className = 'filter-loading';
        loadingIndicator.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        group.appendChild(loadingIndicator);

        // معالجة التغيير
        select.addEventListener('change', (e) => {
            this.handleFilterChange(select.id, e.target.value);
            this.showFilterLoading(group, true);
            
            setTimeout(() => {
                this.showFilterLoading(group, false);
            }, 200);
        });
    },

    // إعداد الفلاتر المخصصة
    setupCustomFilters() {
        // فلتر نطاق التاريخ
        this.setupDateRangeFilter();
        
        // فلتر التقييم
        this.setupRatingFilter();
        
        // فلتر الألوان
        this.setupColorFilter();
        
        // فلتر السعر
        this.setupPriceRangeFilter();
    },

    // فلتر نطاق التاريخ
    setupDateRangeFilter() {
        const dateFilter = document.createElement('div');
        dateFilter.className = 'filter-group date-range-filter';
        dateFilter.innerHTML = `
            <label class="filter-label">
                <i class="fas fa-calendar"></i>
                فترة النشر
            </label>
            <div class="date-range-inputs">
                <input type="date" id="date-from" class="date-input" placeholder="من">
                <span class="date-separator">إلى</span>
                <input type="date" id="date-to" class="date-input" placeholder="إلى">
            </div>
        `;

        const filtersRow = document.querySelector('.filters-row');
        if (filtersRow) {
            filtersRow.appendChild(dateFilter);
        }

        // ربط الأحداث
        const dateFrom = dateFilter.querySelector('#date-from');
        const dateTo = dateFilter.querySelector('#date-to');

        [dateFrom, dateTo].forEach(input => {
            input.addEventListener('change', () => {
                this.handleDateRangeFilter(dateFrom.value, dateTo.value);
            });
        });
    },

    // فلتر التقييم
    setupRatingFilter() {
        const ratingFilter = document.createElement('div');
        ratingFilter.className = 'filter-group rating-filter';
        ratingFilter.innerHTML = `
            <label class="filter-label">
                <i class="fas fa-star"></i>
                التقييم
            </label>
            <div class="rating-options">
                ${[5, 4, 3, 2, 1].map(rating => `
                    <label class="rating-option">
                        <input type="radio" name="rating-filter" value="${rating}">
                        <span class="rating-stars">
                            ${'★'.repeat(rating)}${'☆'.repeat(5-rating)}
                        </span>
                        <span class="rating-text">${rating} فأكثر</span>
                    </label>
                `).join('')}
            </div>
        `;

        const filtersRow = document.querySelector('.filters-row');
        if (filtersRow) {
            filtersRow.appendChild(ratingFilter);
        }

        // ربط الأحداث
        ratingFilter.querySelectorAll('input[name="rating-filter"]').forEach(input => {
            input.addEventListener('change', (e) => {
                if (e.target.checked) {
                    this.handleRatingFilter(parseFloat(e.target.value));
                }
            });
        });
    },

    // فلتر الألوان
    setupColorFilter() {
        const colors = [
            { name: 'أزرق', value: 'blue', hex: '#3b82f6' },
            { name: 'أخضر', value: 'green', hex: '#10b981' },
            { name: 'أحمر', value: 'red', hex: '#ef4444' },
            { name: 'بنفسجي', value: 'purple', hex: '#8b5cf6' },
            { name: 'برتقالي', value: 'orange', hex: '#f59e0b' },
            { name: 'وردي', value: 'pink', hex: '#ec4899' }
        ];

        const colorFilter = document.createElement('div');
        colorFilter.className = 'filter-group color-filter';
        colorFilter.innerHTML = `
            <label class="filter-label">
                <i class="fas fa-palette"></i>
                اللون الأساسي
            </label>
            <div class="color-options">
                ${colors.map(color => `
                    <button class="color-option" 
                            data-color="${color.value}" 
                            style="background-color: ${color.hex}"
                            title="${color.name}">
                    </button>
                `).join('')}
            </div>
        `;

        const filtersRow = document.querySelector('.filters-row');
        if (filtersRow) {
            filtersRow.appendChild(colorFilter);
        }

        // ربط الأحداث
        colorFilter.querySelectorAll('.color-option').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                this.handleColorFilter(e.target.dataset.color);
                
                // تحديث حالة الأزرار
                colorFilter.querySelectorAll('.color-option').forEach(b => 
                    b.classList.remove('active'));
                e.target.classList.add('active');
            });
        });
    },

    // إعداد اقتراحات البحث
    setupSearchSuggestions() {
        const searchContainer = document.querySelector('.search-container');
        if (!searchContainer) return;

        // إنشاء حاوي الاقتراحات
        let suggestionsContainer = document.getElementById('search-suggestions');
        if (!suggestionsContainer) {
            suggestionsContainer = document.createElement('div');
            suggestionsContainer.id = 'search-suggestions';
            suggestionsContainer.className = 'search-suggestions';
            searchContainer.appendChild(suggestionsContainer);
        }

        // تحضير البيانات للاقتراحات
        this.prepareSuggestionsData();
    },

    // تحضير بيانات الاقتراحات
    prepareSuggestionsData() {
        const themes = ArchiveCore?.data?.allThemes || [];
        const suggestions = new Set();

        themes.forEach(theme => {
            // إضافة العنوان
            suggestions.add(theme.title);
            
            // إضافة التصنيفات
            theme.categories.forEach(cat => suggestions.add(cat));
            
            // إضافة الكلمات المفتاحية
            theme.tags.forEach(tag => suggestions.add(tag));
        });

        this.cache.searchSuggestions = Array.from(suggestions);
    },

    // إظهار اقتراحات البحث
    showSearchSuggestions(query) {
        const suggestionsContainer = document.getElementById('search-suggestions');
        if (!suggestionsContainer) return;

        const suggestions = this.getSearchSuggestions(query);
        
        if (suggestions.length === 0) {
            this.hideSearchSuggestions();
            return;
        }

        const html = suggestions.map(suggestion => `
            <div class="suggestion-item" data-suggestion="${suggestion}">
                <i class="fas fa-search suggestion-icon"></i>
                <span class="suggestion-text">${this.highlightMatch(suggestion, query)}</span>
            </div>
        `).join('');

        // إضافة البحثات الأخيرة
        if (this.cache.recentSearches.length > 0) {
            const recentHtml = this.cache.recentSearches.slice(0, 3).map(search => `
                <div class="suggestion-item recent-search" data-suggestion="${search}">
                    <i class="fas fa-history suggestion-icon"></i>
                    <span class="suggestion-text">${search}</span>
                </div>
            `).join('');

            suggestionsContainer.innerHTML = html + 
                '<div class="suggestion-divider">البحثات الأخيرة</div>' + recentHtml;
        } else {
            suggestionsContainer.innerHTML = html;
        }

        // ربط الأحداث
        suggestionsContainer.querySelectorAll('.suggestion-item').forEach(item => {
            item.addEventListener('click', () => {
                const suggestion = item.dataset.suggestion;
                document.getElementById('theme-search').value = suggestion;
                this.handleAdvancedSearch(suggestion);
                this.hideSearchSuggestions();
            });
        });

        suggestionsContainer.classList.add('show');
    },

    // إخفاء اقتراحات البحث
    hideSearchSuggestions() {
        const suggestionsContainer = document.getElementById('search-suggestions');
        if (suggestionsContainer) {
            suggestionsContainer.classList.remove('show');
        }
    },

    // الحصول على اقتراحات البحث
    getSearchSuggestions(query) {
        const normalizedQuery = query.toLowerCase().trim();
        
        return this.cache.searchSuggestions
            .filter(suggestion => 
                suggestion.toLowerCase().includes(normalizedQuery))
            .slice(0, this.settings.maxSuggestions)
            .sort((a, b) => {
                // ترتيب حسب التطابق
                const aIndex = a.toLowerCase().indexOf(normalizedQuery);
                const bIndex = b.toLowerCase().indexOf(normalizedQuery);
                
                if (aIndex !== bIndex) {
                    return aIndex - bIndex;
                }
                
                return a.length - b.length;
            });
    },

    // تمييز التطابق في النص
    highlightMatch(text, query) {
        const regex = new RegExp(`(${query})`, 'gi');
        return text.replace(regex, '<mark>$1</mark>');
    },

    // تطبيق الفلاتر المتقدمة
    applyAdvancedFilters() {
        this.state.isFiltering = true;
        
        // دمج جميع الفلاتر
        const combinedFilters = {
            search: this.state.searchQuery,
            ...Object.fromEntries(this.state.activeFilters)
        };

        // تطبيق الفلاتر باستخدام النواة
        if (ArchiveCore && ArchiveCore.data) {
            ArchiveCore.data.activeFilters = combinedFilters;
            ArchiveCore.applyFilters();
        }

        this.state.isFiltering = false;
        
        // تحليلات الفلاتر
        this.trackFilterUsage(combinedFilters);
    },

    // معالجة تغيير الفلتر
    handleFilterChange(filterType, value) {
        if (value) {
            this.state.activeFilters.set(filterType, value);
        } else {
            this.state.activeFilters.delete(filterType);
        }

        this.applyAdvancedFilters();
        this.saveFilterPreferences();
    },

    // معالجة فلتر نطاق التاريخ
    handleDateRangeFilter(fromDate, toDate) {
        if (fromDate || toDate) {
            this.state.activeFilters.set('dateRange', { from: fromDate, to: toDate });
        } else {
            this.state.activeFilters.delete('dateRange');
        }

        this.applyAdvancedFilters();
    },

    // معالجة فلتر التقييم
    handleRatingFilter(minRating) {
        this.state.activeFilters.set('rating', minRating);
        this.applyAdvancedFilters();
    },

    // معالجة فلتر الألوان
    handleColorFilter(color) {
        if (this.state.activeFilters.get('color') === color) {
            this.state.activeFilters.delete('color');
        } else {
            this.state.activeFilters.set('color', color);
        }

        this.applyAdvancedFilters();
    },

    // إعداد تاريخ الفلاتر
    setupFilterHistory() {
        const historyBtn = document.createElement('button');
        historyBtn.className = 'filter-history-btn';
        historyBtn.innerHTML = '<i class="fas fa-history"></i> سجل الفلاتر';
        
        const filtersRow = document.querySelector('.filters-row');
        if (filtersRow) {
            filtersRow.appendChild(historyBtn);
        }

        historyBtn.addEventListener('click', () => {
            this.showFilterHistory();
        });
    },

    // إظهار سجل الفلاتر
    showFilterHistory() {
        const history = this.getFilterHistory();
        
        const modal = document.createElement('div');
        modal.className = 'filter-history-modal';
        modal.innerHTML = `
            <div class="modal-content">
                <div class="modal-header">
                    <h3>سجل الفلاتر</h3>
                    <button class="modal-close">&times;</button>
                </div>
                <div class="modal-body">
                    ${history.length === 0 ? 
                        '<p>لا يوجد سجل فلاتر بعد</p>' :
                        history.map(item => `
                            <div class="history-item" data-filters='${JSON.stringify(item.filters)}'>
                                <div class="history-filters">${this.formatFilters(item.filters)}</div>
                                <div class="history-date">${this.formatDate(item.date)}</div>
                            </div>
                        `).join('')
                    }
                </div>
            </div>
        `;

        document.body.appendChild(modal);

        // ربط الأحداث
        modal.querySelector('.modal-close').addEventListener('click', () => {
            modal.remove();
        });

        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.remove();
            }
        });

        modal.querySelectorAll('.history-item').forEach(item => {
            item.addEventListener('click', () => {
                const filters = JSON.parse(item.dataset.filters);
                this.applyFilterSet(filters);
                modal.remove();
            });
        });
    },

    // إعداد اختصارات لوحة المفاتيح
    setupKeyboardShortcuts() {
        document.addEventListener('keydown', (e) => {
            // Ctrl/Cmd + K للبحث
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                const searchInput = document.getElementById('theme-search');
                if (searchInput) {
                    searchInput.focus();
                }
            }

            // Escape لمسح البحث
            if (e.key === 'Escape') {
                this.clearAllFilters();
            }

            // Enter لتطبيق الفلاتر
            if (e.key === 'Enter' && e.target.classList.contains('filter-select')) {
                this.applyAdvancedFilters();
            }
        });
    },

    // معالجة لوحة مفاتيح البحث
    handleSearchKeyboard(e) {
        const suggestionsContainer = document.getElementById('search-suggestions');
        if (!suggestionsContainer || !suggestionsContainer.classList.contains('show')) {
            return;
        }

        const suggestions = suggestionsContainer.querySelectorAll('.suggestion-item');
        let activeIndex = Array.from(suggestions).findIndex(item => 
            item.classList.contains('active'));

        switch (e.key) {
            case 'ArrowDown':
                e.preventDefault();
                activeIndex = Math.min(activeIndex + 1, suggestions.length - 1);
                this.updateActiveSuggestion(suggestions, activeIndex);
                break;

            case 'ArrowUp':
                e.preventDefault();
                activeIndex = Math.max(activeIndex - 1, -1);
                this.updateActiveSuggestion(suggestions, activeIndex);
                break;

            case 'Enter':
                e.preventDefault();
                if (activeIndex >= 0 && suggestions[activeIndex]) {
                    suggestions[activeIndex].click();
                }
                break;

            case 'Escape':
                this.hideSearchSuggestions();
                break;
        }
    },

    // تحديث الاقتراح النشط
    updateActiveSuggestion(suggestions, activeIndex) {
        suggestions.forEach((item, index) => {
            item.classList.toggle('active', index === activeIndex);
        });
    },

    // مسح جميع الفلاتر
    clearAllFilters() {
        // مسح البحث
        const searchInput = document.getElementById('theme-search');
        if (searchInput) {
            searchInput.value = '';
        }

        // مسح الفلاتر
        document.querySelectorAll('.filter-select').forEach(select => {
            select.value = '';
        });

        // مسح الفلاتر المخصصة
        document.querySelectorAll('.color-option').forEach(btn => {
            btn.classList.remove('active');
        });

        document.querySelectorAll('input[name="rating-filter"]').forEach(input => {
            input.checked = false;
        });

        // إعادة تعيين الحالة
        this.state.activeFilters.clear();
        this.state.searchQuery = '';

        this.applyAdvancedFilters();
        this.hideSearchSuggestions();

        ArchiveCore?.showToast('تم مسح جميع الفلاتر', 'info');
    },

    // حفظ تفضيلات الفلاتر
    saveFilterPreferences() {
        const preferences = {
            activeFilters: Object.fromEntries(this.state.activeFilters),
            recentSearches: this.cache.recentSearches,
            timestamp: Date.now()
        };

        localStorage.setItem('archive-filter-preferences', JSON.stringify(preferences));
    },

    // تحميل تفضيلات الفلاتر
    loadFilterPreferences() {
        try {
            const saved = localStorage.getItem('archive-filter-preferences');
            if (saved) {
                const preferences = JSON.parse(saved);
                
                // تحميل البحثات الأخيرة
                this.cache.recentSearches = preferences.recentSearches || [];
                
                // تطبيق الفلاتر المحفوظة (اختياري)
                // this.applyFilterSet(preferences.activeFilters);
            }
        } catch (error) {
            console.error('خطأ في تحميل تفضيلات الفلاتر:', error);
        }
    },

    // حفظ سجل البحث
    saveSearchHistory() {
        localStorage.setItem('archive-search-history', 
            JSON.stringify(this.cache.recentSearches));
    },

    // الحصول على سجل الفلاتر
    getFilterHistory() {
        try {
            const history = localStorage.getItem('archive-filter-history');
            return history ? JSON.parse(history) : [];
        } catch (error) {
            return [];
        }
    },

    // تنسيق الفلاتر للعرض
    formatFilters(filters) {
        const formatted = Object.entries(filters)
            .filter(([key, value]) => value)
            .map(([key, value]) => `${this.getFilterDisplayName(key)}: ${value}`)
            .join(', ');
        
        return formatted || 'بدون فلاتر';
    },

    // تنسيق التاريخ
    formatDate(timestamp) {
        return new Date(timestamp).toLocaleDateString('ar-SA', {
            year: 'numeric',
            month: 'short',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
    },

    // الحصول على اسم الفلتر للعرض
    getFilterDisplayName(key) {
        const names = {
            search: 'البحث',
            category: 'التصنيف',
            sort: 'الترتيب',
            type: 'النوع',
            price: 'السعر',
            color: 'اللون',
            rating: 'التقييم',
            dateRange: 'فترة التاريخ'
        };
        return names[key] || key;
    },

    // تطبيق مجموعة فلاتر
    applyFilterSet(filters) {
        this.state.activeFilters.clear();
        
        Object.entries(filters).forEach(([key, value]) => {
            if (value) {
                this.state.activeFilters.set(key, value);
            }
        });

        this.applyAdvancedFilters();
    },

    // الحصول على عدد الفلتر
    getFilterCount(filterType, value) {
        // يمكن تحسين هذا بحساب العدد الفعلي
        return null;
    },

    // إظهار تحميل الفلتر
    showFilterLoading(group, show) {
        const loading = group.querySelector('.filter-loading');
        if (loading) {
            loading.style.display = show ? 'block' : 'none';
        }
    },

    // تتبع استخدام الفلاتر
    trackFilterUsage(filters) {
        // يمكن إضافة تحليلات هنا
        console.log('استخدام الفلاتر:', filters);
    },

    // تحديث معاملات URL
    updateURLParams() {
        const url = new URL(window.location);
        
        // مسح المعاملات القديمة
        url.searchParams.delete('search');
        url.searchParams.delete('filters');

        // إضافة المعاملات الجديدة
        if (this.state.searchQuery) {
            url.searchParams.set('search', this.state.searchQuery);
        }

        if (this.state.activeFilters.size > 0) {
            const filtersParam = btoa(JSON.stringify(Object.fromEntries(this.state.activeFilters)));
            url.searchParams.set('filters', filtersParam);
        }

        // تحديث URL بدون إعادة تحميل
        window.history.replaceState({}, '', url);
    }
};

// تهيئة نظام الفلاتر
document.addEventListener('DOMContentLoaded', () => {
    // انتظار تهيئة النواة أولاً
    setTimeout(() => {
        ArchiveFilters.init();
    }, 100);
});

// تصدير للاستخدام العام
window.ArchiveFilters = ArchiveFilters;

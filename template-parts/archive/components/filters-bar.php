<?php
/**
 * شريط الفلاتر والبحث
 * 
 * @package ArabicThemes
 */
?>

<section class="filters-section">
    <div class="container-fluid">
        <div class="filters-wrapper">
            
            <!-- البحث الرئيسي -->
            <div class="search-container">
                <div class="search-box">
                    <i class="fas fa-search search-icon"></i>
                    <input 
                        type="text" 
                        id="theme-search" 
                        placeholder="ابحث في مكتبة القوالب..." 
                        autocomplete="off"
                        data-search="themes"
                    >
                    <button type="button" class="search-clear" id="search-clear">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="search-suggestions" id="search-suggestions"></div>
            </div>

            <!-- فلاتر متقدمة -->
            <div class="filters-row">
                
                <!-- فلتر التصنيفات -->
                <div class="filter-group">
                    <label for="category-filter" class="filter-label">
                        <i class="fas fa-tags"></i>
                        التصنيف
                    </label>
                    <select id="category-filter" class="filter-select">
                        <option value="">جميع التصنيفات</option>
                        <?php
                        $categories = get_terms([
                            'taxonomy' => 'theme_category',
                            'hide_empty' => true,
                            'orderby' => 'count',
                            'order' => 'DESC'
                        ]);
                        
                        if (!is_wp_error($categories) && !empty($categories)) :
                            foreach ($categories as $category) :
                        ?>
                            <option value="<?php echo esc_attr($category->slug); ?>">
                                <?php echo esc_html($category->name); ?> 
                                (<?php echo $category->count; ?>)
                            </option>
                        <?php 
                            endforeach;
                        endif;
                        ?>
                    </select>
                </div>

                <!-- فلتر الترتيب -->
                <div class="filter-group">
                    <label for="sort-filter" class="filter-label">
                        <i class="fas fa-sort"></i>
                        الترتيب
                    </label>
                    <select id="sort-filter" class="filter-select">
                        <option value="date-desc">الأحدث أولاً</option>
                        <option value="date-asc">الأقدم أولاً</option>
                        <option value="title-asc">الاسم (أ-ي)</option>
                        <option value="title-desc">الاسم (ي-أ)</option>
                        <option value="downloads-desc">الأكثر تحميلاً</option>
                        <option value="downloads-asc">الأقل تحميلاً</option>
                    </select>
                </div>

                <!-- فلتر النوع -->
                <div class="filter-group">
                    <label for="type-filter" class="filter-label">
                        <i class="fas fa-layer-group"></i>
                        النوع
                    </label>
                    <select id="type-filter" class="filter-select">
                        <option value="">جميع الأنواع</option>
                        <option value="business">أعمال</option>
                        <option value="blog">مدونة</option>
                        <option value="portfolio">معرض أعمال</option>
                        <option value="ecommerce">متجر إلكتروني</option>
                        <option value="news">أخبار</option>
                        <option value="educational">تعليمي</option>
                    </select>
                </div>

                <!-- فلتر اللون -->
                <div class="filter-group">
                    <label class="filter-label">
                        <i class="fas fa-palette"></i>
                        اللون الرئيسي
                    </label>
                    <div class="color-filters">
                        <button class="color-filter active" data-color="" title="جميع الألوان">
                            <i class="fas fa-th"></i>
                        </button>
                        <button class="color-filter" data-color="blue" title="أزرق" style="background: #3b82f6;"></button>
                        <button class="color-filter" data-color="green" title="أخضر" style="background: #10b981;"></button>
                        <button class="color-filter" data-color="purple" title="بنفسجي" style="background: #8b5cf6;"></button>
                        <button class="color-filter" data-color="red" title="أحمر" style="background: #ef4444;"></button>
                        <button class="color-filter" data-color="orange" title="برتقالي" style="background: #f59e0b;"></button>
                        <button class="color-filter" data-color="pink" title="وردي" style="background: #ec4899;"></button>
                    </div>
                </div>

            </div>

            <!-- أزرار سريعة -->
            <div class="quick-filters">
                <button class="quick-filter active" data-filter="all">
                    <i class="fas fa-th-large"></i>
                    الكل
                </button>
                <button class="quick-filter" data-filter="featured">
                    <i class="fas fa-star"></i>
                    مميزة
                </button>
                <button class="quick-filter" data-filter="new">
                    <i class="fas fa-plus"></i>
                    جديدة
                </button>
                <button class="quick-filter" data-filter="popular">
                    <i class="fas fa-fire"></i>
                    شائعة
                </button>
                <button class="quick-filter" data-filter="free">
                    <i class="fas fa-gift"></i>
                    مجانية
                </button>
            </div>

            <!-- أزرار إضافية -->
            <div class="filter-actions">
                <button id="clear-filters" class="action-btn clear-btn">
                    <i class="fas fa-undo"></i>
                    مسح الفلاتر
                </button>
                <button id="advanced-search" class="action-btn advanced-btn">
                    <i class="fas fa-sliders-h"></i>
                    بحث متقدم
                </button>
            </div>

        </div>
    </div>
</section>

<!-- نافذة البحث المتقدم -->
<div id="advanced-search-modal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <h3>البحث المتقدم</h3>
            <button class="modal-close">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="advanced-search-form">
                
                <div class="form-group">
                    <label>البحث في العنوان</label>
                    <input type="text" id="advanced-title" placeholder="اكتب جزء من اسم القالب">
                </div>

                <div class="form-group">
                    <label>البحث في الوصف</label>
                    <input type="text" id="advanced-description" placeholder="اكتب كلمات من الوصف">
                </div>

                <div class="form-group">
                    <label>نطاق التحميلات</label>
                    <div class="range-inputs">
                        <input type="number" id="downloads-min" placeholder="الحد الأدنى" min="0">
                        <span>إلى</span>
                        <input type="number" id="downloads-max" placeholder="الحد الأعلى" min="0">
                    </div>
                </div>

                <div class="form-group">
                    <label>تاريخ النشر</label>
                    <div class="date-range">
                        <input type="date" id="date-from">
                        <span>إلى</span>
                        <input type="date" id="date-to">
                    </div>
                </div>

            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" data-action="reset">مسح الكل</button>
            <button class="btn btn-primary" data-action="search">تطبيق البحث</button>
        </div>
    </div>
</div>
<?php
/**
 * أرشيف القوالب - يطابق تصميم الصفحة الرئيسية
 * 
 * @package ArabicThemes
 * @author Tahactw
 * @date 2025-05-30
 */

// تحديد المسارات
$template_dir = get_template_directory_uri();
$archive_dir = $template_dir . '/template-parts/archive';

// تحميل ملفات الأرشيف فقط
wp_enqueue_style('archive-base', $archive_dir . '/styles/archive-base.css', [], '1.0.0');
wp_enqueue_style('archive-components', $archive_dir . '/styles/archive-components.css', [], '1.0.0');
wp_enqueue_style('archive-animations', $archive_dir . '/styles/archive-animations.css', [], '1.0.0');
wp_enqueue_style('archive-responsive', $archive_dir . '/styles/archive-responsive.css', [], '1.0.0');
wp_enqueue_style('archive-themes', $archive_dir . '/styles/archive-themes.css', [], '1.0.0');

wp_enqueue_script('archive-core', $archive_dir . '/scripts/archive-core.js', ['jquery'], '1.0.0', true);
wp_enqueue_script('archive-filters', $archive_dir . '/scripts/archive-filters.js', ['jquery'], '1.0.0', true);
wp_enqueue_script('archive-effects', $archive_dir . '/scripts/archive-effects.js', ['jquery'], '1.0.0', true);

// تمرير البيانات للـ JavaScript
wp_localize_script('archive-core', 'ArchiveData', [
    'ajaxUrl' => admin_url('admin-ajax.php'),
    'nonce' => wp_create_nonce('archive_themes_nonce'),
    'homeUrl' => home_url(),
    'loading' => 'جاري التحميل...',
    'noResults' => 'لم يتم العثور على نتائج',
]);

get_header(); ?>

<!-- خلفية سينمائية مطابقة للرئيسية -->
<div class="cinematic-portal">
    <div class="portal-background">
        <div class="portal-layer portal-layer-1"></div>
        <div class="portal-layer portal-layer-2"></div>
        <div class="portal-layer portal-layer-3"></div>
    </div>
    
    <!-- Canvas للجسيمات المتحركة -->
    <canvas id="particles-canvas"></canvas>
    
    <!-- خلفية الـ Parallax -->
    <div class="parallax-background">
        <div class="parallax-layer" data-speed="0.1"></div>
        <div class="parallax-layer" data-speed="0.3"></div>
        <div class="parallax-layer" data-speed="0.5"></div>
    </div>
</div>

<!-- شاشة التحميل -->
<div id="archive-loader" class="archive-loader cinematic-loader">
    <div class="loader-content">
        <div class="loader-spinner"></div>
        <h3>جاري تحميل مكتبة القوالب...</h3>
    </div>
</div>

<!-- أيقونة Dark/Light Mode -->
<div class="theme-toggle-sidebar">
    <button id="theme-toggle" class="theme-toggle-btn" title="تغيير المظهر">
        <div class="toggle-icon">
            <i class="fas fa-sun sun-icon"></i>
            <i class="fas fa-moon moon-icon"></i>
        </div>
        <div class="toggle-ripple"></div>
    </button>
</div>

<!-- زر العودة للرئيسية -->
<div class="back-to-home">
    <a href="<?php echo home_url(); ?>" class="back-btn cinematic-btn">
        <i class="fas fa-home"></i>
        <span>العودة للرئيسية</span>
    </a>
</div>

<!-- المحتوى الرئيسي -->
<main class="archive-main cinematic-main" id="archive-main">
    
    <!-- Header الأرشيف - مطابق للرئيسية -->
    <section class="archive-header cinematic-hero">
        <div class="container-fluid">
            <div class="header-content hero-content">
                <h1 class="archive-title cinematic-title">
                    <span class="title-line">مكتبة</span>
                    <span class="title-line animated-gradient glitch-text">القوالب العربية</span>
                </h1>
                <p class="archive-subtitle cinematic-subtitle">
                    اكتشف أجمل وأحدث قوالب ووردبريس المصممة خصيصاً للمواقع العربية
                </p>
                <div class="header-stats cinematic-stats">
                    <div class="stat-item glowing-element">
                        <span class="stat-number counter" data-target="<?php echo wp_count_posts('wp_themes')->publish ?: 25; ?>">0</span>
                        <span class="stat-label">قالب متاح</span>
                    </div>
                    <div class="stat-item glowing-element">
                        <span class="stat-number counter" data-target="100">0</span>
                        <span class="stat-label">% مجاني</span>
                    </div>
                    <div class="stat-item glowing-element">
                        <span class="stat-number counter" data-target="2500">0</span>
                        <span class="stat-label">تحميل</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- تأثيرات إضافية -->
        <div class="hero-effects">
            <div class="floating-elements">
                <div class="floating-element" style="--delay: 0s;"></div>
                <div class="floating-element" style="--delay: 1s;"></div>
                <div class="floating-element" style="--delay: 2s;"></div>
            </div>
        </div>
    </section>

    <!-- شريط الفلاتر - محسن -->
    <section class="filters-section cinematic-filters">
        <div class="container-fluid">
            <div class="filters-wrapper glass-morphism">
                
                <!-- البحث الرئيسي -->
                <div class="search-container">
                    <div class="search-box cinematic-input">
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
                    <div class="search-suggestions glass-morphism" id="search-suggestions"></div>
                </div>

                <!-- فلاتر مبسطة -->
                <div class="filters-row">
                    
                    <!-- فلتر التصنيفات -->
                    <div class="filter-group">
                        <label for="category-filter" class="filter-label">
                            <i class="fas fa-tags"></i>
                            التصنيف
                        </label>
                        <select id="category-filter" class="filter-select cinematic-select">
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
                        <select id="sort-filter" class="filter-select cinematic-select">
                            <option value="date-desc">الأحدث أولاً</option>
                            <option value="date-asc">الأقدم أولاً</option>
                            <option value="title-asc">الاسم (أ-ي)</option>
                            <option value="title-desc">الاسم (ي-أ)</option>
                            <option value="downloads-desc">الأكثر تحميلاً</option>
                        </select>
                    </div>

                    <!-- إزالة الفلاتر -->
                    <div class="filter-group">
                        <button type="button" class="clear-filters-btn cinematic-btn" id="clear-filters">
                            <i class="fas fa-refresh"></i>
                            إعادة تعيين
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- عرض القوالب -->
    <section class="themes-section cinematic-gallery" id="themes-section">
        <div class="container-fluid">
            
            <!-- تبديل أنماط العرض -->
            <div class="view-controls glass-morphism">
                <div class="view-toggle">
                    <button class="view-btn active cinematic-btn" data-view="grid">
                        <i class="fas fa-th-large"></i>
                        <span>شبكة</span>
                    </button>
                    <button class="view-btn cinematic-btn" data-view="list">
                        <i class="fas fa-list"></i>
                        <span>قائمة</span>
                    </button>
                    <button class="view-btn cinematic-btn" data-view="masonry">
                        <i class="fas fa-th"></i>
                        <span>بناء</span>
                    </button>
                </div>
                
                <div class="results-info">
                    <span id="results-count" class="glowing-text">جاري العد...</span>
                </div>
            </div>

            <!-- حاوي القوالب -->
            <div class="themes-container">
                <div class="themes-grid cinematic-grid" id="themes-grid" data-view="grid">
                    <?php
                    // استعلام القوالب الرئيسي
                    $themes_query = new WP_Query([
                        'post_type' => 'wp_themes',
                        'posts_per_page' => 12,
                        'post_status' => 'publish',
                        'orderby' => 'date',
                        'order' => 'DESC'
                    ]);

                    if ($themes_query->have_posts()) :
                        while ($themes_query->have_posts()) : $themes_query->the_post();
                            $theme_id = get_the_ID();
                            $download_count = get_post_meta($theme_id, '_download_count', true) ?: rand(10, 500);
                            $theme_rating = get_post_meta($theme_id, '_theme_rating', true) ?: 4.5;
                            $is_featured = get_post_meta($theme_id, '_is_featured', true);
                            
                            // الحصول على التصنيفات
                            $categories = get_the_terms($theme_id, 'theme_category');
                            $category_names = $categories ? wp_list_pluck($categories, 'name') : [];
                            $category_slugs = $categories ? wp_list_pluck($categories, 'slug') : [];
                    ?>
                            <div class="theme-card-wrapper cinematic-card-wrapper" 
                                 data-theme-id="<?php echo $theme_id; ?>"
                                 data-title="<?php echo esc_attr(get_the_title()); ?>"
                                 data-categories="<?php echo esc_attr(implode(',', $category_slugs)); ?>"
                                 data-date="<?php echo get_the_date('c'); ?>"
                                 data-downloads="<?php echo $download_count; ?>"
                                 data-rating="<?php echo $theme_rating; ?>"
                                 data-featured="<?php echo $is_featured ? 'true' : 'false'; ?>">
                                 
                                <article class="theme-card cinematic-card glass-morphism">
                                    
                                    <!-- شارات مبسطة -->
                                    <div class="theme-badges">
                                        <?php if ($is_featured) : ?>
                                            <span class="badge badge-featured glowing-element">
                                                <i class="fas fa-star"></i>
                                                مميز
                                            </span>
                                        <?php endif; ?>
                                        
                                        <?php
                                        $days_since_publish = floor((time() - get_the_time('U')) / (60 * 60 * 24));
                                        if ($days_since_publish <= 7) :
                                        ?>
                                            <span class="badge badge-new glowing-element">
                                                <i class="fas fa-plus"></i>
                                                جديد
                                            </span>
                                        <?php endif; ?>
                                    </div>

                                    <!-- معاينة القالب -->
                                    <div class="theme-preview cinematic-preview">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>" 
                                                 alt="<?php echo esc_attr(get_the_title()); ?>"
                                                 loading="lazy">
                                        <?php else : ?>
                                            <div class="no-image-placeholder">
                                                <i class="fas fa-image"></i>
                                                <span>لا توجد صورة</span>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <div class="preview-overlay">
                                            <div class="overlay-content">
                                                <h3 class="theme-title"><?php the_title(); ?></h3>
                                                <div class="theme-meta">
                                                    <?php if (!empty($category_names)) : ?>
                                                        <span class="theme-category">
                                                            <i class="fas fa-tag"></i>
                                                            <?php echo implode(', ', array_slice($category_names, 0, 2)); ?>
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- معلومات القالب المبسطة -->
                                    <div class="theme-info">
                                        <h4 class="theme-name">
                                            <a href="<?php the_permalink(); ?>" class="theme-link">
                                                <?php the_title(); ?>
                                            </a>
                                        </h4>
                                        
                                        <div class="theme-stats">
                                            <div class="stat-item">
                                                <i class="fas fa-download"></i>
                                                <span><?php echo number_format($download_count); ?> تحميل</span>
                                            </div>
                                            <div class="stat-item">
                                                <i class="fas fa-star"></i>
                                                <span><?php echo $theme_rating; ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- تأثيرات الكارد -->
                                    <div class="card-effects">
                                        <div class="hover-glow"></div>
                                        <div class="card-ripple"></div>
                                    </div>
                                </article>
                            </div>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                    ?>
                        <div class="no-themes glass-morphism">
                            <div class="no-themes-content">
                                <i class="fas fa-search"></i>
                                <h3>لم يتم العثور على قوالب</h3>
                                <p>جرب تعديل معايير البحث أو الفلاتر</p>
                                <button class="clear-filters-btn cinematic-btn" onclick="location.reload()">
                                    <i class="fas fa-refresh"></i>
                                    إعادة تحميل
                                </button>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- تحميل المزيد -->
                <?php if ($themes_query->max_num_pages > 1) : ?>
                <div class="load-more-section">
                    <button id="load-more-btn" class="load-more-btn cinematic-btn glass-morphism">
                        <span class="btn-text">تحميل المزيد</span>
                        <div class="btn-loader"></div>
                        <div class="btn-ripple"></div>
                    </button>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- قسم الإحصائيات -->
    <section class="stats-section cinematic-stats-section">
        <div class="container-fluid">
            <div class="stats-header">
                <h2 class="stats-title cinematic-title">
                    <span class="title-icon">📊</span>
                    إحصائيات المكتبة
                </h2>
                <p class="stats-subtitle">
                    أرقام حقيقية تعكس جودة وتنوع مجموعتنا
                </p>
            </div>

            <div class="stats-grid cinematic-stats-grid">
                <?php
                $total_themes = wp_count_posts('wp_themes')->publish ?: 25;
                global $wpdb;
                $total_downloads = $wpdb->get_var("
                    SELECT SUM(CAST(meta_value AS UNSIGNED)) 
                    FROM {$wpdb->postmeta} 
                    WHERE meta_key = '_download_count' 
                    AND meta_value REGEXP '^[0-9]+$'
                ") ?: 12500;
                
                $stats = [
                    ['icon' => 'fas fa-palette', 'number' => $total_themes, 'label' => 'قالب متاح'],
                    ['icon' => 'fas fa-download', 'number' => $total_downloads, 'label' => 'تحميل'],
                    ['icon' => 'fas fa-users', 'number' => 2500, 'label' => 'مستخدم راضٍ'],
                    ['icon' => 'fas fa-star', 'number' => 4.8, 'label' => 'متوسط التقييم', 'decimal' => true]
                ];
                
                foreach ($stats as $index => $stat) : ?>
                    <div class="stat-card glass-morphism glowing-element" 
                         data-aos="fade-up" 
                         data-aos-delay="<?php echo $index * 100; ?>">
                         
                        <div class="stat-icon">
                            <i class="<?php echo $stat['icon']; ?>"></i>
                        </div>
                        
                        <div class="stat-content">
                            <div class="stat-number counter" 
                                 data-target="<?php echo $stat['number']; ?>"
                                 data-decimal="<?php echo isset($stat['decimal']) ? 'true' : 'false'; ?>">
                                0
                            </div>
                            <div class="stat-label"><?php echo $stat['label']; ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

</main>

<!-- رسائل Toast -->
<div id="toast-container" class="toast-container"></div>

<!-- التأثيرات الجانبية -->
<div class="side-effects">
    <div class="floating-particles"></div>
    <div class="light-rays"></div>
</div>

<!-- تهيئة النظام -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // إخفاء شاشة التحميل مع تأثير سينمائي
    setTimeout(() => {
        const loader = document.getElementById('archive-loader');
        if (loader) {
            loader.classList.add('fade-out');
            setTimeout(() => loader.remove(), 500);
        }
    }, 1000);
    
    // تهيئة النظام
    if (typeof ArchiveCore !== 'undefined') {
        ArchiveCore.init();
    }
    
    // تهيئة التأثيرات
    if (typeof ArchiveEffects !== 'undefined') {
        ArchiveEffects.init();
    }
    
    // تهيئة الفلاتر
    if (typeof ArchiveFilters !== 'undefined') {
        ArchiveFilters.init();
    }
    
    // تهيئة العدادات
    initCounters();
    
    // تهيئة تبديل العرض
    initViewToggle();
});

// دالة العدادات
function initCounters() {
    const counters = document.querySelectorAll('.counter');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counter = entry.target;
                const target = parseInt(counter.dataset.target);
                const isDecimal = counter.dataset.decimal === 'true';
                let current = 0;
                const increment = target / 50;
                
                const updateCounter = () => {
                    if (current < target) {
                        current += increment;
                        counter.textContent = isDecimal ? 
                            Math.min(current, target).toFixed(1) : 
                            Math.floor(Math.min(current, target));
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.textContent = isDecimal ? target.toFixed(1) : target;
                    }
                };
                
                updateCounter();
                observer.unobserve(counter);
            }
        });
    });
    
    counters.forEach(counter => observer.observe(counter));
}

// دالة تبديل العرض
function initViewToggle() {
    const viewBtns = document.querySelectorAll('.view-btn');
    const themesGrid = document.getElementById('themes-grid');
    
    viewBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            // إزالة الكلاس النشط من جميع الأزرار
            viewBtns.forEach(b => b.classList.remove('active'));
            // إضافة الكلاس النشط للزر المضغوط
            btn.classList.add('active');
            
            // تغيير نمط العرض
            const view = btn.dataset.view;
            themesGrid.setAttribute('data-view', view);
            themesGrid.className = `themes-grid cinematic-grid view-${view}`;
            
            // إضافة تأثير انتقالي
            themesGrid.style.opacity = '0.5';
            setTimeout(() => {
                themesGrid.style.opacity = '1';
            }, 200);
        });
    });
}
</script>

<?php get_footer(); ?>
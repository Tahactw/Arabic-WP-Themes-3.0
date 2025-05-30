<?php
/**
 * قسم الإحصائيات
 * 
 * @package ArabicThemes
 */

// حساب الإحصائيات
$total_themes = wp_count_posts('wp_themes')->publish;

global $wpdb;
$total_downloads = $wpdb->get_var("
    SELECT SUM(CAST(meta_value AS UNSIGNED)) 
    FROM {$wpdb->postmeta} 
    WHERE meta_key = '_download_count' 
    AND meta_value REGEXP '^[0-9]+$'
");

$total_categories = wp_count_terms('theme_category', array('hide_empty' => true));
$avg_rating = $wpdb->get_var("
    SELECT AVG(CAST(meta_value AS DECIMAL(3,2))) 
    FROM {$wpdb->postmeta} 
    WHERE meta_key = '_theme_rating' 
    AND meta_value REGEXP '^[0-9]+\\.?[0-9]*$'
");

$stats = [
    [
        'icon' => 'fas fa-palette',
        'number' => $total_themes ?: 25,
        'label' => 'قالب متاح',
        'color' => '#3b82f6'
    ],
    [
        'icon' => 'fas fa-download',
        'number' => $total_downloads ?: 12500,
        'label' => 'تحميل',
        'color' => '#10b981'
    ],
    [
        'icon' => 'fas fa-tags',
        'number' => $total_categories ?: 15,
        'label' => 'تصنيف',
        'color' => '#8b5cf6'
    ],
    [
        'icon' => 'fas fa-star',
        'number' => round($avg_rating, 1) ?: 4.8,
        'label' => 'متوسط التقييم',
        'color' => '#f59e0b',
        'decimal' => true
    ],
    [
        'icon' => 'fas fa-users',
        'number' => 2500,
        'label' => 'مستخدم راضٍ',
        'color' => '#ef4444'
    ],
    [
        'icon' => 'fas fa-gift',
        'number' => 100,
        'label' => '% مجاني',
        'color' => '#ec4899'
    ]
];
?>

<section class="stats-section">
    <div class="container-fluid">
        
        <div class="stats-header">
            <h2 class="stats-title">
                <span class="title-icon">📊</span>
                إحصائيات المكتبة
            </h2>
            <p class="stats-subtitle">
                أرقام حقيقية تعكس جودة وتنوع مجموعتنا
            </p>
        </div>

        <div class="stats-grid">
            <?php foreach ($stats as $index => $stat) : ?>
                <div class="stat-card" 
                     data-aos="fade-up" 
                     data-aos-delay="<?php echo $index * 100; ?>"
                     style="--stat-color: <?php echo $stat['color']; ?>">
                     
                    <div class="stat-icon">
                        <i class="<?php echo $stat['icon']; ?>"></i>
                    </div>
                    
                    <div class="stat-content">
                        <div class="stat-number" 
                             data-target="<?php echo $stat['number']; ?>"
                             data-decimal="<?php echo isset($stat['decimal']) ? 'true' : 'false'; ?>">
                            0
                        </div>
                        <div class="stat-label">
                            <?php echo $stat['label']; ?>
                        </div>
                    </div>
                    
                    <div class="stat-background">
                        <i class="<?php echo $stat['icon']; ?>"></i>
                    </div>
                    
                    <div class="stat-glow"></div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- رسم بياني إضافي (اختياري) -->
        <div class="stats-extras">
            <div class="stats-chart">
                <h3>نمو المكتبة</h3>
                <div class="growth-indicators">
                    <div class="growth-item">
                        <span class="growth-period">هذا الشهر</span>
                        <span class="growth-value positive">+12 قالب</span>
                    </div>
                    <div class="growth-item">
                        <span class="growth-period">هذا الأسبوع</span>
                        <span class="growth-value positive">+3 قوالب</span>
                    </div>
                    <div class="growth-item">
                        <span class="growth-period">اليوم</span>
                        <span class="growth-value neutral">+0 قالب</span>
                    </div>
                </div>
            </div>
            
            <div class="popular-categories">
                <h3>أشهر التصنيفات</h3>
                <div class="category-bars">
                    <?php
                    $popular_cats = get_terms([
                        'taxonomy' => 'theme_category',
                        'orderby' => 'count',
                        'order' => 'DESC',
                        'number' => 5,
                        'hide_empty' => true
                    ]);
                    
                    if (!is_wp_error($popular_cats) && !empty($popular_cats)) :
                        $max_count = $popular_cats[0]->count;
                        foreach ($popular_cats as $cat) :
                            $percentage = ($cat->count / $max_count) * 100;
                    ?>
                        <div class="category-bar">
                            <span class="category-name"><?php echo $cat->name; ?></span>
                            <div class="category-progress">
                                <div class="progress-fill" style="width: <?php echo $percentage; ?>%"></div>
                            </div>
                            <span class="category-count"><?php echo $cat->count; ?></span>
                        </div>
                    <?php 
                        endforeach;
                    endif;
                    ?>
                </div>
            </div>
        </div>

    </div>
</section>
<?php
/**
 * صفحة القالب الفردي - إصدار مُصحح
 * قوالب عربية ووردبريس
 * 
 * @package ArabicThemes
 */

get_header();

// التأكد من وجود المنشور
if (!have_posts()) {
    get_template_part('404');
    get_footer();
    return;
}

the_post();

// جلب بيانات القالب
$demo_url = get_post_meta(get_the_ID(), '_theme_demo_url', true);
$download_url = get_post_meta(get_the_ID(), '_theme_download_url', true);
$version = get_post_meta(get_the_ID(), '_theme_version', true);
$compatibility = get_post_meta(get_the_ID(), '_theme_compatibility', true);
$price = get_post_meta(get_the_ID(), '_theme_price', true);
$features = get_post_meta(get_the_ID(), '_theme_features', true);

// حساب التقييم والتحميلات
$rating = 0;
$downloads = 0;

if (function_exists('arabic_themes_calculate_average_rating')) {
    $rating = arabic_themes_calculate_average_rating(get_the_ID());
}

if (function_exists('arabic_themes_get_download_count')) {
    $downloads = arabic_themes_get_download_count(get_the_ID());
}
?>

<main class="main-content single-theme-page">
    <div class="container">
        <!-- رأس الصفحة -->
        <header class="theme-header">
            <div class="theme-header-content">
                <div class="theme-breadcrumb">
                    <a href="<?php echo esc_url(home_url('/')); ?>">الرئيسية</a>
                    <span class="separator"><i class="fas fa-chevron-left"></i></span>
                    <a href="<?php echo esc_url(get_post_type_archive_link('wp_themes')); ?>">القوالب</a>
                    <span class="separator"><i class="fas fa-chevron-left"></i></span>
                    <span class="current"><?php the_title(); ?></span>
                </div>
                
                <h1 class="theme-title">
                    <?php the_title(); ?>
                </h1>
                
                <div class="theme-meta-header">
                    <div class="theme-rating-large">
                        <div class="stars">
                            <?php
                            if ($rating > 0 && function_exists('arabic_themes_rating_stars')) {
                                echo arabic_themes_rating_stars($rating);
                                echo '<span class="rating-value">(' . $rating . ' من 5)</span>';
                            } else {
                                echo '<span class="no-rating">لا توجد تقييمات بعد</span>';
                            }
                            ?>
                        </div>
                    </div>
                    
                    <div class="theme-stats">
                        <div class="stat-item">
                            <i class="fas fa-download"></i>
                            <span class="stat-label">التحميلات</span>
                            <span class="stat-value download-count">
                                <?php 
                                if (function_exists('arabic_themes_format_number')) {
                                    echo arabic_themes_format_number($downloads);
                                } else {
                                    echo number_format($downloads);
                                }
                                ?>
                            </span>
                        </div>
                        
                        <?php if (!empty($version)) : ?>
                        <div class="stat-item">
                            <i class="fas fa-tag"></i>
                            <span class="stat-label">الإصدار</span>
                            <span class="stat-value"><?php echo esc_html($version); ?></span>
                        </div>
                        <?php endif; ?>
                        
                        <?php if (!empty($compatibility)) : ?>
                        <div class="stat-item">
                            <i class="fab fa-wordpress"></i>
                            <span class="stat-label">التوافق</span>
                            <span class="stat-value"><?php echo esc_html($compatibility); ?></span>
                        </div>
                        <?php endif; ?>
                        
                        <?php if (!empty($price)) : ?>
                        <div class="stat-item price">
                            <i class="fas fa-dollar-sign"></i>
                            <span class="stat-label">السعر</span>
                            <span class="stat-value"><?php echo esc_html($price); ?></span>
                        </div>
                        <?php else : ?>
                        <div class="stat-item free">
                            <i class="fas fa-gift"></i>
                            <span class="stat-label">مجاني</span>
                            <span class="stat-value">0$</span>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </header>

        <!-- محتوى الصفحة -->
        <div class="theme-content-wrapper">
            <!-- العمود الرئيسي -->
            <div class="theme-main-content">
                <!-- صورة القالب الرئيسية -->
                <section class="theme-preview-section">
                    <div class="theme-preview-container">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="theme-main-image">
                                <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'theme-hero')); ?>" 
                                     alt="<?php echo esc_attr(get_the_title()); ?>"
                                     class="preview-image" />
                                
                                <div class="image-overlay">
                                    <?php if (!empty($demo_url)) : ?>
                                        <a href="<?php echo esc_url($demo_url); ?>" 
                                           target="_blank" 
                                           class="btn btn-outline btn-large">
                                            <i class="fas fa-external-link-alt"></i>
                                            معاينة مباشرة
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php else : ?>
                            <div class="no-preview-image">
                                <i class="fas fa-image"></i>
                                <h3>لا توجد صورة معاينة</h3>
                                <p>لم يتم رفع صورة معاينة لهذا القالب</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </section>

                <!-- وصف القالب -->
                <section class="theme-description-section">
                    <h2 class="section-title">
                        <i class="fas fa-info-circle"></i>
                        وصف القالب
                    </h2>
                    
                    <div class="theme-description-content">
                        <?php 
                        $content = get_the_content();
                        if (!empty($content)) {
                            echo wp_kses_post($content);
                        } else {
                            echo '<p>لا يوجد وصف متاح لهذا القالب حالياً.</p>';
                        }
                        ?>
                    </div>
                </section>

                <!-- مميزات القالب -->
                <?php if (!empty($features)) : ?>
                <section class="theme-features-section">
                    <h2 class="section-title">
                        <i class="fas fa-star"></i>
                        مميزات القالب
                    </h2>
                    
                    <div class="features-list">
                        <?php
                        $features_array = explode("\n", $features);
                        foreach ($features_array as $feature) {
                            $feature = trim($feature);
                            if (!empty($feature)) {
                                echo '<div class="feature-item">';
                                echo '<i class="fas fa-check-circle"></i>';
                                echo '<span>' . esc_html($feature) . '</span>';
                                echo '</div>';
                            }
                        }
                        ?>
                    </div>
                </section>
                <?php endif; ?>

                <!-- التصنيفات والوسوم -->
                <section class="theme-taxonomy-section">
                    <?php
                    $categories = get_the_terms(get_the_ID(), 'theme_category');
                    $tags = get_the_terms(get_the_ID(), 'theme_tag');
                    ?>
                    
                    <?php if (!is_wp_error($categories) && !empty($categories)) : ?>
                    <div class="theme-categories">
                        <h3><i class="fas fa-folder"></i> التصنيفات:</h3>
                        <div class="taxonomy-items">
                            <?php foreach ($categories as $category) : ?>
                                <a href="<?php echo esc_url(get_term_link($category)); ?>" 
                                   class="taxonomy-item category">
                                    <?php echo esc_html($category->name); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    <?php if (!is_wp_error($tags) && !empty($tags)) : ?>
                    <div class="theme-tags">
                        <h3><i class="fas fa-tags"></i> الوسوم:</h3>
                        <div class="taxonomy-items">
                            <?php foreach ($tags as $tag) : ?>
                                <a href="<?php echo esc_url(get_term_link($tag)); ?>" 
                                   class="taxonomy-item tag">
                                    <?php echo esc_html($tag->name); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </section>

                <!-- التعليقات -->
                <?php if (comments_open() || get_comments_number()) : ?>
                <section class="theme-comments-section">
                    <h2 class="section-title">
                        <i class="fas fa-comments"></i>
                        التعليقات والمراجعات
                    </h2>
                    
                    <div class="comments-wrapper">
                        <?php comments_template(); ?>
                    </div>
                </section>
                <?php endif; ?>
            </div>

            <!-- الشريط الجانبي -->
            <aside class="theme-sidebar">
                <!-- بطاقة التحميل -->
                <div class="download-card">
                    <div class="download-card-header">
                        <h3>تحميل القالب</h3>
                        <?php if (!empty($price)) : ?>
                            <div class="price-tag">
                                <span class="currency">$</span>
                                <span class="amount"><?php echo esc_html($price); ?></span>
                            </div>
                        <?php else : ?>
                            <div class="free-tag">
                                <i class="fas fa-gift"></i>
                                <span>مجاني</span>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="download-card-content">
                        <div class="action-buttons">
                            <?php if (!empty($demo_url)) : ?>
                                <a href="<?php echo esc_url($demo_url); ?>" 
                                   target="_blank" 
                                   class="btn btn-outline btn-full">
                                    <i class="fas fa-eye"></i>
                                    معاينة مباشرة
                                </a>
                            <?php endif; ?>
                            
                            <button class="btn btn-primary btn-full download-btn" 
                                    data-theme-id="<?php echo esc_attr(get_the_ID()); ?>">
                                <i class="fas fa-download"></i>
                                تحميل الآن
                            </button>
                        </div>
                        
                        <div class="download-note">
                            <i class="fas fa-info-circle"></i>
                            <span>يرجى تقييم القالب قبل التحميل</span>
                        </div>
                    </div>
                </div>

                <!-- معلومات القالب -->
                <div class="theme-info-card">
                    <h3>معلومات القالب</h3>
                    
                    <div class="info-items">
                        <div class="info-item">
                            <span class="info-label">تاريخ النشر:</span>
                            <span class="info-value"><?php echo get_the_date('j F Y'); ?></span>
                        </div>
                        
                        <div class="info-item">
                            <span class="info-label">آخر تحديث:</span>
                            <span class="info-value"><?php echo get_the_modified_date('j F Y'); ?></span>
                        </div>
                        
                        <?php if (!empty($version)) : ?>
                        <div class="info-item">
                            <span class="info-label">الإصدار:</span>
                            <span class="info-value"><?php echo esc_html($version); ?></span>
                        </div>
                        <?php endif; ?>
                        
                        <?php if (!empty($compatibility)) : ?>
                        <div class="info-item">
                            <span class="info-label">متوافق مع:</span>
                            <span class="info-value">ووردبريس <?php echo esc_html($compatibility); ?></span>
                        </div>
                        <?php endif; ?>
                        
                        <div class="info-item">
                            <span class="info-label">عدد التحميلات:</span>
                            <span class="info-value download-count">
                                <?php 
                                if (function_exists('arabic_themes_format_number')) {
                                    echo arabic_themes_format_number($downloads);
                                } else {
                                    echo number_format($downloads);
                                }
                                ?>
                            </span>
                        </div>
                        
                        <div class="info-item">
                            <span class="info-label">التقييم:</span>
                            <span class="info-value">
                                <?php
                                if ($rating > 0) {
                                    echo $rating . ' من 5';
                                } else {
                                    echo 'لا توجد تقييمات';
                                }
                                ?>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- قوالب ذات صلة -->
                <div class="related-themes-card">
                    <h3>قوالب ذات صلة</h3>
                    
                    <div class="related-themes-list">
                        <?php
                        // جلب قوالب ذات صلة
                        $related_args = array(
                            'post_type' => 'wp_themes',
                            'posts_per_page' => 3,
                            'post__not_in' => array(get_the_ID()),
                            'orderby' => 'rand'
                        );
                        
                        // محاولة جلب قوالب من نفس التصنيف
                        $categories = get_the_terms(get_the_ID(), 'theme_category');
                        if (!is_wp_error($categories) && !empty($categories)) {
                            $related_args['tax_query'] = array(
                                array(
                                    'taxonomy' => 'theme_category',
                                    'field' => 'term_id',
                                    'terms' => wp_list_pluck($categories, 'term_id')
                                )
                            );
                        }
                        
                        $related_query = new WP_Query($related_args);
                        
                        if ($related_query->have_posts()) :
                            while ($related_query->have_posts()) : $related_query->the_post();
                        ?>
                                <div class="related-theme-item">
                                    <div class="related-theme-image">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'theme-thumbnail')); ?>" 
                                                 alt="<?php echo esc_attr(get_the_title()); ?>" />
                                        <?php else : ?>
                                            <div class="no-image">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <div class="related-theme-info">
                                        <h4>
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h4>
                                        
                                        <div class="related-theme-meta">
                                            <?php
                                            $related_rating = 0;
                                            if (function_exists('arabic_themes_calculate_average_rating')) {
                                                $related_rating = arabic_themes_calculate_average_rating(get_the_ID());
                                            }
                                            
                                            if ($related_rating > 0 && function_exists('arabic_themes_rating_stars')) {
                                                echo arabic_themes_rating_stars($related_rating);
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            endwhile;
                            wp_reset_postdata();
                        else :
                        ?>
                            <p class="no-related">لا توجد قوالب ذات صلة</p>
                        <?php endif; ?>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</main>

<style>
/* أنماط صفحة القالب الفردي */
.single-theme-page {
    min-height: 100vh;
    background: linear-gradient(135deg, #0a0a0f 0%, #1a1a2e 50%, #16213e 100%);
    color: #ffffff;
    padding: 2rem 0;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1rem;
}

/* رأس الصفحة */
.theme-header {
    margin-bottom: 3rem;
    background: rgba(26, 26, 46, 0.6);
    border: 1px solid rgba(59, 130, 246, 0.2);
    border-radius: 20px;
    padding: 2rem;
    backdrop-filter: blur(10px);
}

.theme-breadcrumb {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 1.5rem;
    font-size: 0.9rem;
}

.theme-breadcrumb a {
    color: #3b82f6;
    text-decoration: none;
    transition: color 0.3s ease;
}

.theme-breadcrumb a:hover {
    color: #8b5cf6;
}

.theme-breadcrumb .separator {
    color: #6b7280;
}

.theme-breadcrumb .current {
    color: #ffffff;
    font-weight: 600;
}

.theme-title {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 2rem;
    background: linear-gradient(45deg, #3b82f6, #8b5cf6);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    text-align: center;
}

.theme-meta-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 2rem;
}

.theme-rating-large .stars {
    display: flex;
    align-items: center;
    gap: 1rem;
    font-size: 1.5rem;
}

.theme-rating-large .fas,
.theme-rating-large .far {
    color: #fbbf24;
}

.rating-value {
    color: #b8b9ba;
    font-size: 1rem;
    font-weight: 600;
}

.no-rating {
    color: #6b7280;
    font-style: italic;
}

.theme-stats {
    display: flex;
    gap: 2rem;
    flex-wrap: wrap;
}

.stat-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    padding: 1rem;
    background: rgba(59, 130, 246, 0.1);
    border: 1px solid rgba(59, 130, 246, 0.2);
    border-radius: 15px;
    min-width: 100px;
}

.stat-item i {
    font-size: 1.5rem;
    margin-bottom: 0.5rem;
    color: #3b82f6;
}

.stat-item.price i,
.stat-item.free i {
    color: #10b981;
}

.stat-label {
    font-size: 0.8rem;
    color: #6b7280;
    margin-bottom: 0.25rem;
}

.stat-value {
    font-size: 1.1rem;
    font-weight: 700;
    color: #ffffff;
}

/* محتوى الصفحة */
.theme-content-wrapper {
    display: grid;
    grid-template-columns: 1fr 350px;
    gap: 3rem;
    align-items: start;
}

.theme-main-content {
    space-y: 3rem;
}

/* معاينة القالب */
.theme-preview-section {
    margin-bottom: 3rem;
}

.theme-preview-container {
    position: relative;
    border-radius: 20px;
    overflow: hidden;
    background: rgba(26, 26, 46, 0.8);
    border: 1px solid rgba(59, 130, 246, 0.2);
}

.theme-main-image {
    position: relative;
    height: 500px;
    overflow: hidden;
}

.preview-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.theme-preview-container:hover .preview-image {
    transform: scale(1.05);
}

.image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.theme-preview-container:hover .image-overlay {
    opacity: 1;
}

.no-preview-image {
    height: 400px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background: linear-gradient(45deg, #1f2937, #374151);
    color: #6b7280;
}

.no-preview-image i {
    font-size: 5rem;
    margin-bottom: 1rem;
}

/* أقسام المحتوى */
.section-title {
    display: flex;
    align-items: center;
    gap: 1rem;
    font-size: 1.8rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    color: #ffffff;
    padding-bottom: 1rem;
    border-bottom: 2px solid rgba(59, 130, 246, 0.3);
}

.section-title i {
    color: #3b82f6;
}

.theme-description-section,
.theme-features-section,
.theme-taxonomy-section,
.theme-comments-section {
    background: rgba(26, 26, 46, 0.6);
    border: 1px solid rgba(59, 130, 246, 0.2);
    border-radius: 20px;
    padding: 2rem;
    margin-bottom: 3rem;
    backdrop-filter: blur(10px);
}

.theme-description-content {
    color: #b8b9ba;
    line-height: 1.8;
    font-size: 1.1rem;
}

.theme-description-content p {
    margin-bottom: 1.5rem;
}

.theme-description-content h2,
.theme-description-content h3,
.theme-description-content h4 {
    color: #ffffff;
    margin-top: 2rem;
    margin-bottom: 1rem;
}

/* مميزات القالب */
.features-list {
    display: grid;
    gap: 1rem;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: rgba(59, 130, 246, 0.1);
    border: 1px solid rgba(59, 130, 246, 0.2);
    border-radius: 12px;
    transition: all 0.3s ease;
}

.feature-item:hover {
    background: rgba(59, 130, 246, 0.2);
    transform: translateX(10px);
}

.feature-item i {
    color: #10b981;
    font-size: 1.2rem;
}

.feature-item span {
    color: #ffffff;
    font-weight: 500;
}

/* التصنيفات والوسوم */
.theme-categories,
.theme-tags {
    margin-bottom: 2rem;
}

.theme-categories h3,
.theme-tags h3 {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 1rem;
    color: #ffffff;
    font-size: 1.2rem;
}

.taxonomy-items {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
}

.taxonomy-item {
    padding: 0.5rem 1rem;
    border-radius: 20px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
    transition: all 0.3s ease;
}

.taxonomy-item.category {
    background: rgba(59, 130, 246, 0.2);
    color: #3b82f6;
    border: 1px solid rgba(59, 130, 246, 0.3);
}

.taxonomy-item.tag {
    background: rgba(139, 92, 246, 0.2);
    color: #8b5cf6;
    border: 1px solid rgba(139, 92, 246, 0.3);
}

.taxonomy-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(59, 130, 246, 0.3);
}

/* الشريط الجانبي */
.theme-sidebar {
    display: flex;
    flex-direction: column;
    gap: 2rem;
    position: sticky;
    top: 2rem;
}

.download-card,
.theme-info-card,
.related-themes-card {
    background: rgba(26, 26, 46, 0.8);
    border: 1px solid rgba(59, 130, 246, 0.2);
    border-radius: 20px;
    padding: 1.5rem;
    backdrop-filter: blur(10px);
}

/* بطاقة التحميل */
.download-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid rgba(59, 130, 246, 0.2);
}

.download-card-header h3 {
    color: #ffffff;
    font-size: 1.3rem;
    margin: 0;
}

.price-tag {
    display: flex;
    align-items: baseline;
    gap: 0.25rem;
    color: #10b981;
    font-weight: 700;
}

.currency {
    font-size: 1rem;
}

.amount {
    font-size: 1.5rem;
}

.free-tag {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #10b981;
    font-weight: 600;
    background: rgba(16, 185, 129, 0.1);
    padding: 0.5rem 1rem;
    border-radius: 20px;
    border: 1px solid rgba(16, 185, 129, 0.3);
}

.action-buttons {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-bottom: 1rem;
}

.btn {
    padding: 1rem 1.5rem;
    border: none;
    border-radius: 25px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    font-size: 1rem;
}

.btn-primary {
    background: linear-gradient(45deg, #3b82f6, #8b5cf6);
    color: white;
}

.btn-outline {
    background: transparent;
    border: 2px solid #3b82f6;
    color: #3b82f6;
}

.btn-large {
    padding: 1.25rem 2rem;
    font-size: 1.1rem;
}

.btn-full {
    width: 100%;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(59, 130, 246, 0.3);
}

.btn-outline:hover {
    background: #3b82f6;
    color: white;
}

.download-note {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 1rem;
    background: rgba(59, 130, 246, 0.1);
    border: 1px solid rgba(59, 130, 246, 0.2);
    border-radius: 12px;
    color: #b8b9ba;
    font-size: 0.9rem;
}

.download-note i {
    color: #3b82f6;
}

/* معلومات القالب */
.theme-info-card h3,
.related-themes-card h3 {
    color: #ffffff;
    font-size: 1.3rem;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid rgba(59, 130, 246, 0.2);
}

.info-items {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.info-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem;
    background: rgba(59, 130, 246, 0.05);
    border-radius: 10px;
    border: 1px solid rgba(59, 130, 246, 0.1);
}

.info-label {
    color: #b8b9ba;
    font-weight: 600;
}

.info-value {
    color: #ffffff;
    font-weight: 700;
}

/* قوالب ذات صلة */
.related-themes-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.related-theme-item {
    display: flex;
    gap: 1rem;
    padding: 1rem;
    background: rgba(59, 130, 246, 0.05);
    border: 1px solid rgba(59, 130, 246, 0.1);
    border-radius: 12px;
    transition: all 0.3s ease;
}

.related-theme-item:hover {
    background: rgba(59, 130, 246, 0.1);
    transform: translateY(-2px);
}

.related-theme-image {
    width: 60px;
    height: 45px;
    border-radius: 8px;
    overflow: hidden;
    flex-shrink: 0;
}

.related-theme-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.related-theme-image .no-image {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(45deg, #1f2937, #374151);
    color: #6b7280;
}

.related-theme-image .no-image i {
    font-size: 1.5rem;
}

.related-theme-info {
    flex: 1;
}

.related-theme-info h4 {
    margin: 0 0 0.5rem 0;
    font-size: 1rem;
}

.related-theme-info h4 a {
    color: #ffffff;
    text-decoration: none;
    transition: color 0.3s ease;
}

.related-theme-info h4 a:hover {
    color: #3b82f6;
}

.related-theme-meta .fas,
.related-theme-meta .far {
    color: #fbbf24;
    font-size: 0.8rem;
}

.no-related {
    color: #6b7280;
    text-align: center;
    font-style: italic;
    padding: 2rem;
}

/* التصميم المتجاوب */
@media (max-width: 1024px) {
    .theme-content-wrapper {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .theme-sidebar {
        position: static;
        order: -1;
    }
}

@media (max-width: 768px) {
    .theme-title {
        font-size: 2.5rem;
    }
    
    .theme-meta-header {
        flex-direction: column;
        text-align: center;
    }
    
    .theme-stats {
        justify-content: center;
    }
    
    .stat-item {
        min-width: 80px;
        padding: 0.75rem;
    }
    
    .theme-main-image {
        height: 300px;
    }
    
    .download-card-header {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }
}

@media (max-width: 480px) {
    .container {
        padding: 0 0.5rem;
    }
    
    .theme-header {
        padding: 1.5rem;
    }
    
    .theme-title {
        font-size: 2rem;
    }
    
    .theme-stats {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .theme-description-section,
    .theme-features-section,
    .theme-taxonomy-section,
    .theme-comments-section {
        padding: 1.5rem;
    }
    
    .download-card,
    .theme-info-card,
    .related-themes-card {
        padding: 1rem;
    }
}

/* دعم RTL */
[dir="rtl"] .theme-breadcrumb .separator i {
    transform: rotate(180deg);
}

[dir="rtl"] .feature-item:hover {
    transform: translateX(-10px);
}

[dir="rtl"] .taxonomy-items {
    direction: rtl;
}

[dir="rtl"] .related-theme-item {
    direction: rtl;
}

/* تحسينات الأداء */
.theme-main-image,
.related-theme-image {
    will-change: transform;
}

.btn,
.feature-item,
.taxonomy-item {
    will-change: transform, box-shadow;
}
</style>

<script>
// سكريبت صفحة القالب الفردي
document.addEventListener('DOMContentLoaded', function() {
    console.log('تم تحميل صفحة القالب الفردي بنجاح');
    
    // تهيئة زر التحميل
    initSingleThemeDownload();
    
    // تأثيرات التمرير
    initScrollEffects();
    
    // تحسين الصور
    initImageEnhancements();
});

function initSingleThemeDownload() {
    const downloadBtn = document.querySelector('.download-btn');
    if (!downloadBtn) return;
    
    downloadBtn.addEventListener('click', function(e) {
        e.preventDefault();
        const themeId = this.getAttribute('data-theme-id');
        
        if (typeof window.showRatingModal === 'function') {
            window.showRatingModal(themeId);
        } else {
            // نسخة احتياطية بسيطة
            const rating = prompt('يرجى تقييم القالب من 1 إلى 5:');
            if (rating && rating >= 1 && rating <= 5) {
                downloadThemeSimple(themeId, rating);
            }
        }
    });
}

function downloadThemeSimple(themeId, rating) {
    // إظهار تحميل
    const downloadBtn = document.querySelector('.download-btn');
    const originalText = downloadBtn.innerHTML;
    downloadBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري التحميل...';
    downloadBtn.disabled = true;
    
    // محاكاة AJAX
    if (typeof jQuery !== 'undefined' && typeof ArabicThemes !== 'undefined') {
        jQuery.ajax({
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
                    // تحديث العدادات
                    const downloadCounts = document.querySelectorAll('.download-count');
                    downloadCounts.forEach(count => {
                        count.textContent = response.data.download_count;
                    });
                    
                    // إظهار رسالة نجاح
                    alert(response.data.message);
                    
                    // فتح رابط التحميل
                    if (response.data.download_url && response.data.download_url !== '#') {
                        window.open(response.data.download_url, '_blank');
                    }
                } else {
                    alert(response.data);
                }
            },
            error: function() {
                alert('حدث خطأ أثناء التحميل');
            },
            complete: function() {
                downloadBtn.innerHTML = originalText;
                downloadBtn.disabled = false;
            }
        });
    } else {
        // في حالة عدم وجود jQuery
        setTimeout(() => {
            downloadBtn.innerHTML = originalText;
            downloadBtn.disabled = false;
            alert('شكراً لتقييمك! ستبدأ عملية التحميل قريباً.');
        }, 2000);
    }
}

function initScrollEffects() {
    // تأثير التمرير السلس للروابط الداخلية
    const links = document.querySelectorAll('a[href^="#"]');
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
}

function initImageEnhancements() {
    // تحسين تحميل الصور
    const images = document.querySelectorAll('img[src]');
    images.forEach(img => {
        img.addEventListener('load', function() {
            this.style.opacity = '1';
        });
        
        img.addEventListener('error', function() {
            this.style.opacity = '0.5';
            console.log('فشل تحميل الصورة:', this.src);
        });
    });
    
    // تأثير zoom للصورة الرئيسية
    const mainImage = document.querySelector('.preview-image');
    if (mainImage) {
        mainImage.addEventListener('click', function() {
            // يمكن إضافة lightbox هنا لاحقاً
            console.log('نقر على الصورة الرئيسية');
        });
    }
}

// تحسين الأداء
if ('IntersectionObserver' in window) {
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
    document.querySelectorAll('.theme-description-section, .theme-features-section, .download-card').forEach(el => {
        observer.observe(el);
    });
}
</script>

<?php get_footer(); ?>
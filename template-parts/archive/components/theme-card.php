<?php
/**
 * مكون بطاقة القالب
 * 
 * @package ArabicThemes
 */

// الحصول على بيانات القالب
$theme_id = get_the_ID();
$download_count = get_post_meta($theme_id, '_download_count', true) ?: 0;
$theme_rating = get_post_meta($theme_id, '_theme_rating', true) ?: 4.5;
$is_featured = get_post_meta($theme_id, '_is_featured', true);
$theme_price = get_post_meta($theme_id, '_theme_price', true) ?: 'مجاني';
$theme_version = get_post_meta($theme_id, '_theme_version', true) ?: '1.0';
$last_updated = get_the_modified_date('c');

// الحصول على التصنيفات
$categories = get_the_terms($theme_id, 'theme_category');
$category_names = $categories ? wp_list_pluck($categories, 'name') : [];
$category_slugs = $categories ? wp_list_pluck($categories, 'slug') : [];

// الحصول على الكلمات المفتاحية
$tags = get_the_terms($theme_id, 'theme_tags');
$tag_names = $tags ? wp_list_pluck($tags, 'name') : [];

// معلومات إضافية للفلترة
$theme_color = get_post_meta($theme_id, '_theme_primary_color', true) ?: 'blue';
$theme_type = get_post_meta($theme_id, '_theme_type', true) ?: 'business';
$demo_url = get_post_meta($theme_id, '_demo_url', true);
?>

<div class="theme-card-wrapper" 
     data-theme-id="<?php echo $theme_id; ?>"
     data-title="<?php echo esc_attr(get_the_title()); ?>"
     data-categories="<?php echo esc_attr(implode(',', $category_slugs)); ?>"
     data-tags="<?php echo esc_attr(implode(',', $tag_names)); ?>"
     data-date="<?php echo get_the_date('c'); ?>"
     data-modified="<?php echo $last_updated; ?>"
     data-downloads="<?php echo $download_count; ?>"
     data-rating="<?php echo $theme_rating; ?>"
     data-price="<?php echo esc_attr($theme_price); ?>"
     data-color="<?php echo esc_attr($theme_color); ?>"
     data-type="<?php echo esc_attr($theme_type); ?>"
     data-featured="<?php echo $is_featured ? 'true' : 'false'; ?>">
     
    <article class="theme-card">
        
        <!-- شارات القالب -->
        <div class="theme-badges">
            <?php if ($is_featured) : ?>
                <span class="badge badge-featured">
                    <i class="fas fa-star"></i>
                    مميز
                </span>
            <?php endif; ?>
            
            <?php if ($theme_price === 'مجاني' || $theme_price == 0) : ?>
                <span class="badge badge-free">
                    <i class="fas fa-gift"></i>
                    مجاني
                </span>
            <?php endif; ?>
            
            <?php
            $days_since_publish = floor((time() - get_the_time('U')) / (60 * 60 * 24));
            if ($days_since_publish <= 7) :
            ?>
                <span class="badge badge-new">
                    <i class="fas fa-plus"></i>
                    جديد
                </span>
            <?php endif; ?>
        </div>

        <!-- صورة القالب -->
        <div class="theme-image">
            <?php if (has_post_thumbnail()) : ?>
                <img src="<?php the_post_thumbnail_url('large'); ?>" 
                     alt="<?php the_title(); ?>" 
                     loading="lazy"
                     class="theme-thumbnail">
            <?php else : ?>
                <div class="theme-placeholder">
                    <i class="fas fa-image"></i>
                    <span>لا توجد صورة</span>
                </div>
            <?php endif; ?>
            
            <!-- تراكب التفاعل -->
            <div class="theme-overlay">
                <div class="overlay-actions">
                    <button class="action-btn preview-btn" 
                            data-theme-id="<?php echo $theme_id; ?>"
                            data-demo-url="<?php echo esc_url($demo_url); ?>"
                            title="معاينة مباشرة">
                        <i class="fas fa-eye"></i>
                        <span>معاينة</span>
                    </button>
                    
                    <button class="action-btn favorite-btn" 
                            data-theme-id="<?php echo $theme_id; ?>"
                            title="إضافة للمفضلة">
                        <i class="far fa-heart"></i>
                        <span>مفضلة</span>
                    </button>
                    
                    <button class="action-btn share-btn" 
                            data-theme-id="<?php echo $theme_id; ?>"
                            data-url="<?php the_permalink(); ?>"
                            data-title="<?php the_title(); ?>"
                            title="مشاركة">
                        <i class="fas fa-share-alt"></i>
                        <span>مشاركة</span>
                    </button>
                </div>
                
                <div class="overlay-info">
                    <div class="theme-rating">
                        <div class="stars">
                            <?php
                            $full_stars = floor($theme_rating);
                            $has_half = ($theme_rating - $full_stars) >= 0.5;
                            
                            for ($i = 1; $i <= 5; $i++) :
                                if ($i <= $full_stars) :
                                    echo '<i class="fas fa-star"></i>';
                                elseif ($i == $full_stars + 1 && $has_half) :
                                    echo '<i class="fas fa-star-half-alt"></i>';
                                else :
                                    echo '<i class="far fa-star"></i>';
                                endif;
                            endfor;
                            ?>
                        </div>
                        <span class="rating-value"><?php echo $theme_rating; ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- محتوى البطاقة -->
        <div class="theme-content">
            
            <!-- العنوان والوصف -->
            <div class="theme-header">
                <h3 class="theme-title">
                    <a href="<?php the_permalink(); ?>" class="theme-link">
                        <?php the_title(); ?>
                    </a>
                </h3>
                
                <?php if (get_the_excerpt()) : ?>
                    <p class="theme-excerpt">
                        <?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?>
                    </p>
                <?php endif; ?>
            </div>

            <!-- التصنيفات -->
            <?php if (!empty($category_names)) : ?>
                <div class="theme-categories">
                    <?php foreach (array_slice($category_names, 0, 2) as $category) : ?>
                        <span class="category-tag">
                            <i class="fas fa-tag"></i>
                            <?php echo esc_html($category); ?>
                        </span>
                    <?php endforeach; ?>
                    
                    <?php if (count($category_names) > 2) : ?>
                        <span class="category-more">
                            +<?php echo count($category_names) - 2; ?>
                        </span>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <!-- الإحصائيات -->
            <div class="theme-stats">
                <div class="stat-item">
                    <i class="fas fa-download"></i>
                    <span><?php echo number_format($download_count); ?></span>
                </div>
                
                <div class="stat-item">
                    <i class="fas fa-calendar"></i>
                    <span><?php echo get_the_date('M Y'); ?></span>
                </div>
                
                <div class="stat-item">
                    <i class="fas fa-code-branch"></i>
                    <span>v<?php echo $theme_version; ?></span>
                </div>
                
                <?php if ($theme_price !== 'مجاني' && $theme_price != 0) : ?>
                    <div class="stat-item price">
                        <i class="fas fa-tag"></i>
                        <span><?php echo $theme_price; ?></span>
                    </div>
                <?php endif; ?>
            </div>

            <!-- أزرار العمل -->
            <div class="theme-actions">
                <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-details">
                    <i class="fas fa-info-circle"></i>
                    <span>التفاصيل</span>
                </a>
                
                <?php if ($demo_url) : ?>
                    <a href="<?php echo esc_url($demo_url); ?>" 
                       target="_blank" 
                       rel="noopener" 
                       class="btn btn-secondary btn-demo">
                        <i class="fas fa-external-link-alt"></i>
                        <span>ديمو</span>
                    </a>
                <?php endif; ?>
            </div>

        </div>

        <!-- تأثيرات البطاقة -->
        <div class="card-effects">
            <div class="card-glow"></div>
            <div class="card-particles"></div>
            <div class="card-shimmer"></div>
        </div>
        
        <!-- Loading overlay -->
        <div class="card-loading">
            <div class="loading-spinner"></div>
        </div>

    </article>
</div>
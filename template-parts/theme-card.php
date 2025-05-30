<?php
/**
 * بطاقة القالب - إصدار مُصحح
 * قوالب عربية ووردبريس
 * 
 * @package ArabicThemes
 */

// التأكد من وجود المنشور
if (!isset($post) || !$post) {
    global $post;
}

if (!$post) {
    return;
}
?>

<div class="theme-card" data-theme-id="<?php echo esc_attr(get_the_ID()); ?>">
    <div class="theme-image">
        <?php if (has_post_thumbnail()) : ?>
            <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'theme-large')); ?>" 
                 alt="<?php echo esc_attr(get_the_title()); ?>"
                 loading="lazy" />
        <?php else : ?>
            <div class="no-image">
                <i class="fas fa-image"></i>
                <span>لا توجد صورة</span>
            </div>
        <?php endif; ?>
        
        <div class="theme-overlay">
            <div class="theme-actions">
                <?php 
                $demo_url = get_post_meta(get_the_ID(), '_theme_demo_url', true);
                if (!empty($demo_url)) :
                ?>
                    <a href="<?php echo esc_url($demo_url); ?>" 
                       target="_blank" 
                       class="btn btn-outline preview-btn">
                        <i class="fas fa-eye"></i>
                        معاينة
                    </a>
                <?php endif; ?>
                
                <button class="btn btn-primary download-btn" 
                        data-theme-id="<?php echo esc_attr(get_the_ID()); ?>">
                    <i class="fas fa-download"></i>
                    تحميل
                </button>
            </div>
        </div>
    </div>
    
    <div class="theme-info">
        <h3 class="theme-title">
            <a href="<?php echo esc_url(get_permalink()); ?>">
                <?php echo esc_html(get_the_title()); ?>
            </a>
        </h3>
        
        <div class="theme-meta">
            <div class="theme-rating">
                <?php
                $rating = 0;
                if (function_exists('arabic_themes_calculate_average_rating')) {
                    $rating = arabic_themes_calculate_average_rating(get_the_ID());
                }
                
                if ($rating > 0) {
                    if (function_exists('arabic_themes_rating_stars')) {
                        echo arabic_themes_rating_stars($rating);
                    }
                    echo '<span class="rating-number">(' . esc_html($rating) . ')</span>';
                } else {
                    echo '<span class="no-rating">لا توجد تقييمات</span>';
                }
                ?>
            </div>
            
            <div class="theme-downloads">
                <i class="fas fa-download"></i>
                <span class="download-count">
                    <?php
                    $downloads = 0;
                    if (function_exists('arabic_themes_get_download_count')) {
                        $downloads = arabic_themes_get_download_count(get_the_ID());
                    }
                    if (function_exists('arabic_themes_format_number')) {
                        echo esc_html(arabic_themes_format_number($downloads));
                    } else {
                        echo esc_html(number_format($downloads));
                    }
                    ?>
                </span>
            </div>
        </div>
        
        <div class="theme-excerpt">
            <?php 
            $excerpt = get_the_excerpt();
            if (empty($excerpt)) {
                $excerpt = wp_trim_words(get_the_content(), 15, '...');
            }
            echo esc_html(wp_trim_words($excerpt, 15, '...'));
            ?>
        </div>
        
        <div class="theme-tags">
            <?php
            $tags = get_the_terms(get_the_ID(), 'theme_tag');
            if (!is_wp_error($tags) && !empty($tags)) {
                $tag_count = 0;
                foreach ($tags as $tag) {
                    if ($tag_count >= 3) break;
                    echo '<span class="theme-tag">' . esc_html($tag->name) . '</span>';
                    $tag_count++;
                }
            }
            ?>
        </div>
        
        <div class="theme-footer">
            <a href="<?php echo esc_url(get_permalink()); ?>" class="view-details">
                عرض التفاصيل
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
    </div>
</div>

<style>
/* أنماط بطاقة القالب */
.theme-card {
    background: rgba(26, 26, 46, 0.8);
    border: 1px solid rgba(59, 130, 246, 0.2);
    border-radius: 20px;
    overflow: hidden;
    backdrop-filter: blur(20px);
    transition: all 0.4s ease;
    position: relative;
    height: fit-content;
}

.theme-card:hover {
    transform: translateY(-10px);
    border-color: #3b82f6;
    box-shadow: 0 20px 50px rgba(59, 130, 246, 0.2);
}

.theme-image {
    position: relative;
    height: 250px;
    overflow: hidden;
}

.theme-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.theme-card:hover .theme-image img {
    transform: scale(1.1);
}

.no-image {
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background: linear-gradient(45deg, #1f2937, #374151);
    color: #6b7280;
}

.no-image i {
    font-size: 3rem;
    margin-bottom: 0.5rem;
}

.theme-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.8);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.theme-card:hover .theme-overlay {
    opacity: 1;
}

.theme-actions {
    display: flex;
    gap: 1rem;
}

.btn {
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: 25px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
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

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(59, 130, 246, 0.3);
}

.btn-outline:hover {
    background: #3b82f6;
    color: white;
}

.theme-info {
    padding: 1.5rem;
}

.theme-title {
    margin-bottom: 1rem;
}

.theme-title a {
    color: #ffffff;
    text-decoration: none;
    font-size: 1.3rem;
    font-weight: 600;
    transition: color 0.3s ease;
    display: block;
}

.theme-title a:hover {
    color: #3b82f6;
}

.theme-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
    font-size: 0.9rem;
}

.theme-rating {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.theme-rating .fas,
.theme-rating .far {
    color: #fbbf24;
    font-size: 1rem;
}

.theme-rating .active {
    color: #fbbf24;
}

.rating-number {
    color: #6b7280;
    font-size: 0.8rem;
}

.no-rating {
    color: #6b7280;
    font-size: 0.9rem;
}

.theme-downloads {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #10b981;
    font-weight: 600;
}

.theme-excerpt {
    color: #b8b9ba;
    line-height: 1.6;
    margin-bottom: 1rem;
    font-size: 0.95rem;
}

.theme-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-bottom: 1rem;
}

.theme-tag {
    background: rgba(59, 130, 246, 0.2);
    color: #3b82f6;
    padding: 0.25rem 0.75rem;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 500;
}

.theme-footer {
    text-align: center;
    padding-top: 1rem;
    border-top: 1px solid rgba(59, 130, 246, 0.2);
}

.view-details {
    color: #3b82f6;
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.view-details:hover {
    color: #8b5cf6;
}

/* التصميم المتجاوب */
@media (max-width: 768px) {
    .theme-actions {
        flex-direction: column;
        gap: 0.75rem;
    }
    
    .btn {
        justify-content: center;
    }
    
    .theme-meta {
        flex-direction: column;
        gap: 0.5rem;
        align-items: flex-start;
    }
}

/* دعم RTL */
[dir="rtl"] .view-details {
    flex-direction: row-reverse;
}

[dir="rtl"] .theme-actions {
    direction: ltr;
}
</style>
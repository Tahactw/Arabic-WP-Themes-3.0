<?php
/**
 * صفحة البحث - قوالب عربية ووردبريس
 * نتائج البحث مع فلاتر متقدمة
 * 
 * @package ArabicThemes
 */

get_header();

$search_query = get_search_query();
$search_results = $wp_query->found_posts;
?>

<main class="main-content search-page">
    <!-- خلفية البحث -->
    <div class="search-bg-effects">
        <div class="search-particles">
            <?php for($i = 0; $i < 20; $i++): ?>
                <div class="particle" style="--delay: <?php echo $i * 0.1; ?>s;"></div>
            <?php endfor; ?>
        </div>
    </div>

    <div class="container">
        <!-- رأس البحث -->
        <header class="search-header">
            <div class="search-info">
                <h1 class="search-title">
                    <i class="fas fa-search"></i>
                    نتائج البحث
                </h1>
                
                <?php if (!empty($search_query)): ?>
                    <p class="search-query">
                        البحث عن: <span class="query-highlight">"<?php echo esc_html($search_query); ?>"</span>
                    </p>
                    
                    <div class="search-stats">
                        <span class="results-count">
                            <?php echo number_format($search_results); ?> نتيجة
                        </span>
                        <span class="search-time">
                            في <?php echo number_format(timer_stop(), 3); ?> ثانية
                        </span>
                    </div>
                <?php else: ?>
                    <p class="no-query">لم يتم إدخال كلمة بحث</p>
                <?php endif; ?>
            </div>

            <!-- نموذج البحث المتقدم -->
            <div class="advanced-search">
                <form class="search-form" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                    <div class="search-input-group">
                        <input type="search" 
                               name="s" 
                               value="<?php echo esc_attr($search_query); ?>" 
                               placeholder="ابحث عن القوالب..."
                               class="search-input"
                               autocomplete="off">
                        <button type="submit" class="search-btn">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    
                    <div class="search-filters">
                        <select name="post_type" class="filter-select">
                            <option value="">جميع المحتويات</option>
                            <option value="wp_themes" <?php selected(get_query_var('post_type'), 'wp_themes'); ?>>
                                القوالب فقط
                            </option>
                            <option value="post" <?php selected(get_query_var('post_type'), 'post'); ?>>
                                المقالات فقط
                            </option>
                        </select>
                        
                        <select name="orderby" class="filter-select">
                            <option value="relevance">الأكثر صلة</option>
                            <option value="date" <?php selected(get_query_var('orderby'), 'date'); ?>>
                                الأحدث
                            </option>
                            <option value="title" <?php selected(get_query_var('orderby'), 'title'); ?>>
                                الاسم
                            </option>
                            <option value="modified" <?php selected(get_query_var('orderby'), 'modified'); ?>>
                                آخر تحديث
                            </option>
                        </select>
                    </div>
                </form>
            </div>
        </header>

        <!-- محتوى النتائج -->
        <div class="search-content">
            <?php if (have_posts()): ?>
                <div class="search-results">
                    <div class="results-grid">
                        <?php while (have_posts()): the_post(); ?>
                            <?php if (get_post_type() === 'wp_themes'): ?>
                                <!-- بطاقة قالب -->
                                <?php get_template_part('template-parts/theme-card'); ?>
                            <?php else: ?>
                                <!-- بطاقة مقال -->
                                <article class="search-result-card">
                                    <div class="result-meta">
                                        <span class="result-type">
                                            <i class="fas fa-file-alt"></i>
                                            مقال
                                        </span>
                                        <time class="result-date">
                                            <?php echo get_the_date('j F Y'); ?>
                                        </time>
                                    </div>
                                    
                                    <h3 class="result-title">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>
                                    
                                    <div class="result-excerpt">
                                        <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                                    </div>
                                    
                                    <div class="result-footer">
                                        <a href="<?php the_permalink(); ?>" class="read-more">
                                            اقرأ المزيد
                                            <i class="fas fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </article>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </div>

                    <!-- ترقيم الصفحات -->
                    <div class="search-pagination">
                        <?php
                        echo paginate_links(array(
                            'prev_text' => '<i class="fas fa-chevron-right"></i> السابق',
                            'next_text' => 'التالي <i class="fas fa-chevron-left"></i>',
                            'before_page_number' => '<span>',
                            'after_page_number' => '</span>'
                        ));
                        ?>
                    </div>
                </div>

            <?php else: ?>
                <!-- لا توجد نتائج -->
                <div class="no-results">
                    <div class="no-results-icon">
                        <i class="fas fa-search-minus"></i>
                    </div>
                    
                    <h2>لم يتم العثور على نتائج</h2>
                    
                    <?php if (!empty($search_query)): ?>
                        <p>لم نتمكن من العثور على أي نتائج لـ <strong>"<?php echo esc_html($search_query); ?>"</strong></p>
                    <?php else: ?>
                        <p>يرجى إدخال كلمة أو عبارة للبحث</p>
                    <?php endif; ?>
                    
                    <div class="search-suggestions">
                        <h3>اقتراحات للبحث:</h3>
                        <ul>
                            <li>تأكد من كتابة الكلمات بشكل صحيح</li>
                            <li>جرب كلمات أخرى أو مرادفات</li>
                            <li>استخدم كلمات أقل أو أكثر عمومية</li>
                            <li>تصفح <a href="<?php echo esc_url(get_post_type_archive_link('wp_themes')); ?>">جميع القوالب</a></li>
                        </ul>
                    </div>

                    <!-- قوالب مقترحة -->
                    <div class="suggested-content">
                        <h3>قوالب قد تهمك:</h3>
                        <div class="suggestions-grid">
                            <?php
                            $suggested_themes = new WP_Query(array(
                                'post_type' => 'wp_themes',
                                'posts_per_page' => 3,
                                'post_status' => 'publish',
                                'orderby' => 'rand'
                            ));
                            
                            if ($suggested_themes->have_posts()):
                                while ($suggested_themes->have_posts()): $suggested_themes->the_post();
                                    get_template_part('template-parts/theme-card');
                                endwhile;
                                wp_reset_postdata();
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<style>
/* أنماط صفحة البحث */
.search-page {
    min-height: 100vh;
    padding: 2rem 0;
    position: relative;
}

/* خلفية البحث */
.search-bg-effects {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
    pointer-events: none;
}

.search-particles {
    position: absolute;
    width: 100%;
    height: 100%;
}

.particle {
    position: absolute;
    width: 6px;
    height: 6px;
    background: var(--neon-blue);
    border-radius: 50%;
    opacity: 0.4;
    animation: searchFloat 12s infinite linear;
    animation-delay: var(--delay);
}

.particle:nth-child(even) {
    background: var(--neon-purple);
    animation-duration: 15s;
}

.particle:nth-child(3n) {
    background: var(--neon-green);
    animation-duration: 18s;
}

@keyframes searchFloat {
    0% {
        transform: translateY(100vh) translateX(0) rotate(0deg);
        opacity: 0;
    }
    10% {
        opacity: 0.4;
    }
    90% {
        opacity: 0.4;
    }
    100% {
        transform: translateY(-100px) translateX(100px) rotate(360deg);
        opacity: 0;
    }
}

/* رأس البحث */
.search-header {
    background: var(--bg-glass);
    border: 1px solid var(--border-color);
    border-radius: 25px;
    padding: 3rem;
    margin-bottom: 3rem;
    backdrop-filter: blur(20px);
    text-align: center;
}

.search-title {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 1rem;
}

.search-title i {
    color: var(--neon-blue);
    font-size: 2rem;
}

.search-query {
    font-size: 1.2rem;
    color: var(--text-secondary);
    margin-bottom: 1rem;
}

.query-highlight {
    color: var(--neon-blue);
    font-weight: 600;
    background: rgba(59, 130, 246, 0.1);
    padding: 0.25rem 0.5rem;
    border-radius: 8px;
}

.search-stats {
    display: flex;
    justify-content: center;
    gap: 2rem;
    margin-bottom: 2rem;
    font-size: 0.95rem;
    color: var(--text-muted);
}

.results-count {
    color: var(--neon-green);
    font-weight: 600;
}

.no-query {
    color: var(--text-muted);
    font-size: 1.1rem;
    margin-bottom: 2rem;
}

/* البحث المتقدم */
.advanced-search {
    max-width: 600px;
    margin: 0 auto;
}

.search-input-group {
    display: flex;
    margin-bottom: 1.5rem;
    background: var(--bg-tertiary);
    border: 2px solid var(--border-color);
    border-radius: 25px;
    overflow: hidden;
    transition: border-color var(--transition-normal);
}

.search-input-group:focus-within {
    border-color: var(--neon-blue);
    box-shadow: 0 0 30px rgba(59, 130, 246, 0.3);
}

.search-input {
    flex: 1;
    padding: 1rem 1.5rem;
    border: none;
    background: transparent;
    color: var(--text-primary);
    font-size: 1.1rem;
    outline: none;
}

.search-input::placeholder {
    color: var(--text-muted);
}

.search-btn {
    padding: 1rem 1.5rem;
    background: linear-gradient(45deg, var(--neon-blue), var(--neon-purple));
    color: white;
    border: none;
    cursor: pointer;
    transition: all var(--transition-normal);
}

.search-btn:hover {
    background: linear-gradient(45deg, var(--neon-purple), var(--neon-pink));
    transform: scale(1.05);
}

.search-filters {
    display: flex;
    gap: 1rem;
    justify-content: center;
}

.filter-select {
    padding: 0.75rem 1rem;
    background: var(--bg-tertiary);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    color: var(--text-primary);
    cursor: pointer;
    transition: all var(--transition-normal);
}

.filter-select:focus {
    border-color: var(--neon-blue);
    box-shadow: 0 0 20px rgba(59, 130, 246, 0.3);
}

/* نتائج البحث */
.search-results {
    margin-bottom: 3rem;
}

.results-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

/* بطاقة نتيجة البحث */
.search-result-card {
    background: var(--bg-glass);
    border: 1px solid var(--border-color);
    border-radius: 20px;
    padding: 2rem;
    backdrop-filter: blur(20px);
    transition: all var(--transition-elastic);
    position: relative;
    overflow: hidden;
}

.search-result-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.1), transparent);
    transition: left 0.8s ease;
}

.search-result-card:hover::before {
    left: 100%;
}

.search-result-card:hover {
    transform: translateY(-10px);
    border-color: var(--neon-blue);
    box-shadow: 0 20px 50px rgba(59, 130, 246, 0.2);
}

.result-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
    font-size: 0.9rem;
}

.result-type {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--neon-green);
    font-weight: 600;
}

.result-date {
    color: var(--text-muted);
}

.result-title {
    margin-bottom: 1rem;
}

.result-title a {
    color: var(--text-primary);
    text-decoration: none;
    font-size: 1.3rem;
    font-weight: 600;
    transition: color var(--transition-normal);
}

.result-title a:hover {
    color: var(--neon-blue);
}

.result-excerpt {
    color: var(--text-secondary);
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.result-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.read-more {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--neon-blue);
    text-decoration: none;
    font-weight: 600;
    transition: all var(--transition-normal);
}

.read-more:hover {
    color: var(--neon-purple);
    transform: translateX(-5px);
}

/* ترقيم الصفحات */
.search-pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 1rem;
    margin-top: 3rem;
}

.search-pagination .page-numbers {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 50px;
    height: 50px;
    background: var(--bg-tertiary);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    color: var(--text-primary);
    text-decoration: none;
    font-weight: 600;
    transition: all var(--transition-normal);
}

.search-pagination .page-numbers:hover,
.search-pagination .page-numbers.current {
    background: var(--neon-blue);
    color: white;
    border-color: var(--neon-blue);
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(59, 130, 246, 0.3);
}

.search-pagination .prev,
.search-pagination .next {
    width: auto;
    padding: 0 1.5rem;
    gap: 0.5rem;
}

/* عدم وجود نتائج */
.no-results {
    text-align: center;
    padding: 4rem 2rem;
}

.no-results-icon {
    font-size: 5rem;
    color: var(--text-muted);
    margin-bottom: 2rem;
    opacity: 0.5;
}

.no-results h2 {
    font-size: 2.5rem;
    color: var(--text-primary);
    margin-bottom: 1rem;
}

.no-results p {
    font-size: 1.2rem;
    color: var(--text-secondary);
    margin-bottom: 3rem;
}

.search-suggestions {
    background: var(--bg-glass);
    border: 1px solid var(--border-color);
    border-radius: 20px;
    padding: 2rem;
    margin-bottom: 3rem;
    backdrop-filter: blur(20px);
    text-align: right;
}

.search-suggestions h3 {
    color: var(--text-primary);
    margin-bottom: 1rem;
    text-align: center;
}

.search-suggestions ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.search-suggestions li {
    padding: 0.5rem 0;
    color: var(--text-secondary);
    border-bottom: 1px solid var(--border-color);
}

.search-suggestions li:last-child {
    border-bottom: none;
}

.search-suggestions a {
    color: var(--neon-blue);
    text-decoration: none;
    font-weight: 600;
}

.search-suggestions a:hover {
    text-decoration: underline;
}

/* المحتوى المقترح */
.suggested-content {
    margin-top: 3rem;
}

.suggested-content h3 {
    color: var(--text-primary);
    text-align: center;
    margin-bottom: 2rem;
    font-size: 1.5rem;
}

.suggestions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
}

/* التصميم المتجاوب */
@media (max-width: 768px) {
    .search-header {
        padding: 2rem;
    }
    
    .search-title {
        font-size: 2rem;
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .search-stats {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .search-filters {
        flex-direction: column;
    }
    
    .results-grid {
        grid-template-columns: 1fr;
    }
    
    .search-pagination {
        flex-wrap: wrap;
    }
    
    .search-pagination .prev,
    .search-pagination .next {
        order: -1;
        width: 100%;
        margin-bottom: 1rem;
    }
    
    .suggestions-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 480px) {
    .search-header {
        padding: 1.5rem;
    }
    
    .search-input-group {
        flex-direction: column;
    }
    
    .search-btn {
        border-radius: 0 0 23px 23px;
    }
    
    .search-result-card {
        padding: 1.5rem;
    }
    
    .no-results {
        padding: 2rem 1rem;
    }
    
    .no-results h2 {
        font-size: 2rem;
    }
    
    .search-suggestions {
        padding: 1.5rem;
        text-align: center;
    }
}

/* دعم RTL */
[dir="rtl"] .read-more:hover {
    transform: translateX(5px);
}

[dir="rtl"] .search-pagination .prev {
    order: 1;
}

[dir="rtl"] .search-pagination .next {
    order: -1;
}

@media (max-width: 768px) {
    [dir="rtl"] .search-pagination .prev,
    [dir="rtl"] .search-pagination .next {
        order: 0;
    }
}
</style>

<script>
// سكريبت صفحة البحث
document.addEventListener('DOMContentLoaded', function() {
    initSearchEffects();
    initFilterAnimation();
    initScrollAnimations();
    highlightSearchTerms();
});

// تأثيرات البحث
function initSearchEffects() {
    const searchInput = document.querySelector('.search-input');
    const searchBtn = document.querySelector('.search-btn');
    
    if (searchInput && searchBtn) {
        // تأثير التركيز
        searchInput.addEventListener('focus', function() {
            this.parentElement.style.borderColor = 'var(--neon-blue)';
            this.parentElement.style.boxShadow = '0 0 30px rgba(59, 130, 246, 0.3)';
        });
        
        searchInput.addEventListener('blur', function() {
            if (!this.value) {
                this.parentElement.style.borderColor = 'var(--border-color)';
                this.parentElement.style.boxShadow = 'none';
            }
        });
        
        // تأثير الإرسال
        searchBtn.addEventListener('click', function() {
            createSearchRipple(this);
        });
        
        // البحث بالضغط على Enter
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                createSearchRipple(searchBtn);
            }
        });
    }
}

function createSearchRipple(button) {
    const ripple = document.createElement('div');
    ripple.style.cssText = `
        position: absolute;
        background: rgba(255, 255, 255, 0.6);
        border-radius: 50%;
        pointer-events: none;
        transform: scale(0);
        animation: ripple 0.6s ease-out;
        top: 50%;
        left: 50%;
        width: 20px;
        height: 20px;
        margin-top: -10px;
        margin-left: -10px;
    `;
    
    button.style.position = 'relative';
    button.appendChild(ripple);
    
    setTimeout(() => ripple.remove(), 600);
}

// تحريك الفلاتر
function initFilterAnimation() {
    const filterSelects = document.querySelectorAll('.filter-select');
    
    filterSelects.forEach(select => {
        select.addEventListener('change', function() {
            this.style.transform = 'scale(1.05)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 150);
        });
    });
}

// تأثيرات التمرير
function initScrollAnimations() {
    const animatedElements = document.querySelectorAll('.search-result-card, .no-results');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.classList.contains('animated')) {
                const delay = Array.from(entry.target.parentNode.children).indexOf(entry.target) * 0.1;
                
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, delay * 100);
                
                entry.target.classList.add('animated');
            }
        });
    }, { threshold: 0.1 });
    
    animatedElements.forEach(element => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(50px)';
        element.style.transition = 'all 0.6s ease';
        observer.observe(element);
    });
}

// تمييز كلمات البحث
function highlightSearchTerms() {
    const searchQuery = new URLSearchParams(window.location.search).get('s');
    if (!searchQuery) return;
    
    const searchTerms = searchQuery.toLowerCase().split(' ').filter(term => term.length > 2);
    
    document.querySelectorAll('.result-title a, .result-excerpt').forEach(element => {
        let content = element.innerHTML;
        
        searchTerms.forEach(term => {
            const regex = new RegExp(`(${term})`, 'gi');
            content = content.replace(regex, '<mark class="search-highlight">$1</mark>');
        });
        
        element.innerHTML = content;
    });
}

// إضافة أنماط التمييز
const highlightStyles = document.createElement('style');
highlightStyles.textContent = `
    .search-highlight {
        background: linear-gradient(45deg, var(--neon-yellow), var(--neon-orange));
        color: var(--bg-primary);
        padding: 0.1em 0.2em;
        border-radius: 3px;
        font-weight: 600;
        animation: highlight-pulse 2s ease-in-out infinite;
    }
    
    @keyframes highlight-pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.8; }
    }
    
    @keyframes ripple {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
`;
document.head.appendChild(highlightStyles);

// تتبع إحصائيات البحث
if (window.ArabicThemes && window.ArabicThemes.ajaxurl) {
    const searchQuery = new URLSearchParams(window.location.search).get('s');
    const resultsCount = document.querySelector('.results-count')?.textContent;
    
    if (searchQuery) {
        fetch(window.ArabicThemes.ajaxurl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({
                action: 'track_search',
                query: searchQuery,
                results: resultsCount || '0',
                nonce: window.ArabicThemes.nonce || ''
            })
        }).catch(error => {
            console.log('Search tracking error:', error);
        });
    }
}
</script>

<?php get_footer(); ?>
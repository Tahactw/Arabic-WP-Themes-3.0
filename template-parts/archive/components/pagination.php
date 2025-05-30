<?php
/**
 * مكون الترقيم
 * 
 * @package ArabicThemes
 */

// الحصول على معلومات الترقيم
global $wp_query;

$current_page = max(1, get_query_var('paged'));
$total_pages = $wp_query->max_num_pages;

// إذا لم يكن هناك أكثر من صفحة واحدة، لا نعرض الترقيم
if ($total_pages <= 1) {
    return;
}

// حساب نطاق الصفحات للعرض
$range = 2; // عدد الصفحات قبل وبعد الصفحة الحالية
$start_page = max(1, $current_page - $range);
$end_page = min($total_pages, $current_page + $range);

// تعديل النطاق للحفاظ على عدد ثابت من الصفحات
if ($end_page - $start_page < $range * 2) {
    if ($start_page == 1) {
        $end_page = min($total_pages, $start_page + $range * 2);
    } else {
        $start_page = max(1, $end_page - $range * 2);
    }
}
?>

<nav class="pagination-wrapper" role="navigation" aria-label="ترقيم الصفحات">
    <div class="pagination-container">
        
        <!-- معلومات الصفحة الحالية -->
        <div class="pagination-info">
            <span class="current-info">
                صفحة <strong><?php echo $current_page; ?></strong> من <strong><?php echo $total_pages; ?></strong>
            </span>
        </div>

        <!-- أزرار الترقيم -->
        <ul class="pagination-list">
            
            <!-- زر الصفحة الأولى -->
            <?php if ($current_page > 1) : ?>
                <li class="pagination-item first">
                    <a href="<?php echo get_pagenum_link(1); ?>" 
                       class="pagination-link" 
                       title="الصفحة الأولى"
                       aria-label="انتقال إلى الصفحة الأولى">
                        <i class="fas fa-angle-double-right"></i>
                        <span class="sr-only">الأولى</span>
                    </a>
                </li>
            <?php endif; ?>

            <!-- زر الصفحة السابقة -->
            <?php if ($current_page > 1) : ?>
                <li class="pagination-item prev">
                    <a href="<?php echo get_pagenum_link($current_page - 1); ?>" 
                       class="pagination-link" 
                       title="الصفحة السابقة"
                       aria-label="انتقال إلى الصفحة السابقة">
                        <i class="fas fa-angle-right"></i>
                        <span class="link-text">السابقة</span>
                    </a>
                </li>
            <?php endif; ?>

            <!-- نقاط البداية -->
            <?php if ($start_page > 1) : ?>
                <li class="pagination-item">
                    <a href="<?php echo get_pagenum_link(1); ?>" 
                       class="pagination-link"
                       aria-label="انتقال إلى الصفحة 1">1</a>
                </li>
                <?php if ($start_page > 2) : ?>
                    <li class="pagination-item dots">
                        <span class="pagination-dots">...</span>
                    </li>
                <?php endif; ?>
            <?php endif; ?>

            <!-- أرقام الصفحات -->
            <?php for ($i = $start_page; $i <= $end_page; $i++) : ?>
                <li class="pagination-item <?php echo ($i == $current_page) ? 'active' : ''; ?>">
                    <?php if ($i == $current_page) : ?>
                        <span class="pagination-current" aria-current="page">
                            <?php echo $i; ?>
                        </span>
                    <?php else : ?>
                        <a href="<?php echo get_pagenum_link($i); ?>" 
                           class="pagination-link"
                           aria-label="انتقال إلى الصفحة <?php echo $i; ?>">
                            <?php echo $i; ?>
                        </a>
                    <?php endif; ?>
                </li>
            <?php endfor; ?>

            <!-- نقاط النهاية -->
            <?php if ($end_page < $total_pages) : ?>
                <?php if ($end_page < $total_pages - 1) : ?>
                    <li class="pagination-item dots">
                        <span class="pagination-dots">...</span>
                    </li>
                <?php endif; ?>
                <li class="pagination-item">
                    <a href="<?php echo get_pagenum_link($total_pages); ?>" 
                       class="pagination-link"
                       aria-label="انتقال إلى الصفحة الأخيرة (<?php echo $total_pages; ?>)">
                        <?php echo $total_pages; ?>
                    </a>
                </li>
            <?php endif; ?>

            <!-- زر الصفحة التالية -->
            <?php if ($current_page < $total_pages) : ?>
                <li class="pagination-item next">
                    <a href="<?php echo get_pagenum_link($current_page + 1); ?>" 
                       class="pagination-link" 
                       title="الصفحة التالية"
                       aria-label="انتقال إلى الصفحة التالية">
                        <span class="link-text">التالية</span>
                        <i class="fas fa-angle-left"></i>
                    </a>
                </li>
            <?php endif; ?>

            <!-- زر الصفحة الأخيرة -->
            <?php if ($current_page < $total_pages) : ?>
                <li class="pagination-item last">
                    <a href="<?php echo get_pagenum_link($total_pages); ?>" 
                       class="pagination-link" 
                       title="الصفحة الأخيرة"
                       aria-label="انتقال إلى الصفحة الأخيرة">
                        <i class="fas fa-angle-double-left"></i>
                        <span class="sr-only">الأخيرة</span>
                    </a>
                </li>
            <?php endif; ?>

        </ul>

        <!-- انتقال سريع -->
        <div class="pagination-jump">
            <form class="jump-form" method="get">
                <label for="page-jump" class="jump-label">انتقال إلى:</label>
                <input type="number" 
                       id="page-jump" 
                       name="paged" 
                       min="1" 
                       max="<?php echo $total_pages; ?>" 
                       value="<?php echo $current_page; ?>"
                       class="jump-input">
                <button type="submit" class="jump-btn" title="انتقال">
                    <i class="fas fa-arrow-left"></i>
                </button>
                
                <!-- المحافظة على معاملات البحث -->
                <?php foreach ($_GET as $key => $value) : ?>
                    <?php if ($key !== 'paged' && !empty($value)) : ?>
                        <input type="hidden" name="<?php echo esc_attr($key); ?>" value="<?php echo esc_attr($value); ?>">
                    <?php endif; ?>
                <?php endforeach; ?>
            </form>
        </div>

    </div>
</nav>

<style>
/* أنماط مكون الترقيم */
.pagination-wrapper {
    margin: var(--spacing-3xl) 0;
    padding: var(--spacing-xl) 0;
    border-top: 1px solid var(--dark-200);
}

.pagination-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: var(--spacing-lg);
    flex-wrap: wrap;
}

.pagination-info {
    color: var(--dark-600);
    font-size: var(--font-size-sm);
}

.pagination-list {
    display: flex;
    align-items: center;
    gap: var(--spacing-sm);
    list-style: none;
    margin: 0;
    padding: 0;
}

.pagination-item {
    margin: 0;
}

.pagination-link,
.pagination-current {
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 40px;
    height: 40px;
    padding: var(--spacing-sm);
    border-radius: var(--border-radius-md);
    text-decoration: none;
    font-weight: 500;
    transition: all var(--transition-fast);
    border: 1px solid var(--dark-200);
}

.pagination-link {
    background: var(--white);
    color: var(--dark-700);
}

.pagination-link:hover {
    background: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.pagination-current {
    background: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
    cursor: default;
}

.pagination-item.active .pagination-current {
    box-shadow: var(--shadow-lg);
}

.pagination-dots {
    color: var(--dark-400);
    padding: var(--spacing-sm);
}

.pagination-item.first .pagination-link,
.pagination-item.last .pagination-link {
    min-width: 35px;
}

.pagination-item.prev .pagination-link,
.pagination-item.next .pagination-link {
    gap: var(--spacing-xs);
    padding: var(--spacing-sm) var(--spacing-md);
}

.pagination-jump {
    display: flex;
    align-items: center;
}

.jump-form {
    display: flex;
    align-items: center;
    gap: var(--spacing-sm);
}

.jump-label {
    font-size: var(--font-size-sm);
    color: var(--dark-600);
    white-space: nowrap;
}

.jump-input {
    width: 60px;
    padding: var(--spacing-sm);
    border: 1px solid var(--dark-200);
    border-radius: var(--border-radius-sm);
    text-align: center;
    font-size: var(--font-size-sm);
}

.jump-input:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.1);
}

.jump-btn {
    padding: var(--spacing-sm);
    background: var(--primary-color);
    color: white;
    border: none;
    border-radius: var(--border-radius-sm);
    cursor: pointer;
    transition: all var(--transition-fast);
}

.jump-btn:hover {
    background: var(--dark-700);
    transform: translateY(-1px);
}

.sr-only {
    position: absolute;
    width: 1px;
    height: 1px;
    padding: 0;
    margin: -1px;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    white-space: nowrap;
    border: 0;
}

/* استجابة */
@media (max-width: 767px) {
    .pagination-container {
        flex-direction: column;
        gap: var(--spacing-md);
    }

    .pagination-list {
        gap: var(--spacing-xs);
        flex-wrap: wrap;
        justify-content: center;
    }

    .pagination-link,
    .pagination-current {
        min-width: 35px;
        height: 35px;
        font-size: var(--font-size-sm);
    }

    .link-text {
        display: none;
    }

    .pagination-jump {
        order: -1;
    }

    .jump-label {
        font-size: var(--font-size-xs);
    }
}

@media (max-width: 480px) {
    .pagination-item.first,
    .pagination-item.last {
        display: none;
    }

    .pagination-info {
        font-size: var(--font-size-xs);
    }
}
</style>

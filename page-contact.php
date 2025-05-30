<?php
/**
 * صفحة اتصل بنا - قوالب عربية ووردبريس
 * تصميم مستقبلي مع نماذج تفاعلية
 * 
 * @package ArabicThemes
 */

get_header();
?>

<main class="main-content contact-page">
    <!-- خلفية ديناميكية -->
    <div class="contact-bg-effects">
        <div class="mesh-gradient"></div>
        <div class="floating-orbs">
            <?php for($i = 0; $i < 8; $i++): ?>
                <div class="orb orb-<?php echo ($i % 4) + 1; ?>" style="--delay: <?php echo $i * 0.3; ?>s;"></div>
            <?php endfor; ?>
        </div>
    </div>

    <div class="container">
        <!-- رأس الصفحة -->
        <header class="contact-header">
            <div class="header-content">
                <h1 class="page-title">
                    <span class="title-icon">
                        <i class="fas fa-envelope"></i>
                    </span>
                    تواصل معنا
                </h1>
                <p class="page-subtitle">
                    نحن هنا لمساعدتك! تواصل معنا لأي استفسار أو طلب دعم فني
                </p>
                
                <!-- إحصائيات التواصل -->
                <div class="contact-stats">
                    <div class="stat-item">
                        <div class="stat-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-info">
                            <span class="stat-number">24</span>
                            <span class="stat-label">ساعة استجابة</span>
                        </div>
                    </div>
                    
                    <div class="stat-item">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-info">
                            <span class="stat-number">2,847</span>
                            <span class="stat-label">عميل راضٍ</span>
                        </div>
                    </div>
                    
                    <div class="stat-item">
                        <div class="stat-icon">
                            <i class="fas fa-thumbs-up"></i>
                        </div>
                        <div class="stat-info">
                            <span class="stat-number">98%</span>
                            <span class="stat-label">معدل الرضا</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- محتوى الصفحة -->
        <div class="contact-content">
            
            <!-- نموذج التواصل -->
            <section class="contact-form-section">
                <div class="form-container">
                    <div class="form-header">
                        <h2>
                            <i class="fas fa-paper-plane"></i>
                            أرسل لنا رسالة
                        </h2>
                        <p>املأ النموذج أدناه وسنرد عليك في أقرب وقت ممكن</p>
                    </div>

                    <form class="contact-form" id="contact-form" novalidate>
                        <div class="form-grid">
                            <!-- الاسم -->
                            <div class="form-group">
                                <label for="contact-name" class="form-label">
                                    <i class="fas fa-user"></i>
                                    الاسم الكامل
                                    <span class="required">*</span>
                                </label>
                                <div class="input-wrapper">
                                    <input type="text" 
                                           id="contact-name" 
                                           name="name" 
                                           class="form-input" 
                                           placeholder="أدخل اسمك الكامل"
                                           required>
                                    <div class="input-highlight"></div>
                                </div>
                                <div class="field-error"></div>
                            </div>

                            <!-- البريد الإلكتروني -->
                            <div class="form-group">
                                <label for="contact-email" class="form-label">
                                    <i class="fas fa-envelope"></i>
                                    البريد الإلكتروني
                                    <span class="required">*</span>
                                </label>
                                <div class="input-wrapper">
                                    <input type="email" 
                                           id="contact-email" 
                                           name="email" 
                                           class="form-input" 
                                           placeholder="example@domain.com"
                                           required>
                                    <div class="input-highlight"></div>
                                </div>
                                <div class="field-error"></div>
                            </div>

                            <!-- الهاتف -->
                            <div class="form-group">
                                <label for="contact-phone" class="form-label">
                                    <i class="fas fa-phone"></i>
                                    رقم الهاتف
                                </label>
                                <div class="input-wrapper">
                                    <input type="tel" 
                                           id="contact-phone" 
                                           name="phone" 
                                           class="form-input" 
                                           placeholder="+966 50 123 4567">
                                    <div class="input-highlight"></div>
                                </div>
                                <div class="field-error"></div>
                            </div>

                            <!-- الموضوع -->
                            <div class="form-group">
                                <label for="contact-subject" class="form-label">
                                    <i class="fas fa-tag"></i>
                                    موضوع الرسالة
                                    <span class="required">*</span>
                                </label>
                                <div class="input-wrapper">
                                    <select id="contact-subject" name="subject" class="form-select" required>
                                        <option value="">اختر موضوع الرسالة</option>
                                        <option value="support">دعم فني</option>
                                        <option value="bug">الإبلاغ عن خطأ</option>
                                        <option value="feature">طلب ميزة جديدة</option>
                                        <option value="custom">طلب قالب مخصص</option>
                                        <option value="business">استفسار تجاري</option>
                                        <option value="other">أخرى</option>
                                    </select>
                                    <div class="select-arrow">
                                        <i class="fas fa-chevron-down"></i>
                                    </div>
                                    <div class="input-highlight"></div>
                                </div>
                                <div class="field-error"></div>
                            </div>
                        </div>

                        <!-- الرسالة -->
                        <div class="form-group full-width">
                            <label for="contact-message" class="form-label">
                                <i class="fas fa-comment"></i>
                                نص الرسالة
                                <span class="required">*</span>
                            </label>
                            <div class="textarea-wrapper">
                                <textarea id="contact-message" 
                                          name="message" 
                                          class="form-textarea" 
                                          placeholder="اكتب رسالتك هنا... يُرجى تقديم أكبر قدر من التفاصيل لنتمكن من مساعدتك بشكل أفضل"
                                          rows="6"
                                          required></textarea>
                                <div class="textarea-highlight"></div>
                                <div class="character-count">
                                    <span id="char-count">0</span> / 1000 حرف
                                </div>
                            </div>
                            <div class="field-error"></div>
                        </div>

                        <!-- اتفاقية الخصوصية -->
                        <div class="form-group checkbox-group">
                            <label class="checkbox-label">
                                <input type="checkbox" id="privacy-agree" name="privacy" required class="checkbox-input">
                                <span class="checkbox-custom">
                                    <i class="fas fa-check"></i>
                                </span>
                                <span class="checkbox-text">
                                    أوافق على 
                                    <a href="<?php echo esc_url(home_url('/privacy-policy')); ?>" target="_blank">سياسة الخصوصية</a>
                                    وأتفهم أن بياناتي ستُستخدم للرد على استفساري
                                    <span class="required">*</span>
                                </span>
                            </label>
                            <div class="field-error"></div>
                        </div>

                        <!-- زر الإرسال -->
                        <div class="form-submit">
                            <button type="submit" class="submit-btn" id="submit-btn">
                                <span class="btn-content">
                                    <i class="fas fa-paper-plane"></i>
                                    إرسال الرسالة
                                </span>
                                <div class="btn-loading" style="display: none;">
                                    <i class="fas fa-spinner fa-spin"></i>
                                    جاري الإرسال...
                                </div>
                                <div class="btn-ripple"></div>
                            </button>
                        </div>
                    </form>
                </div>
            </section>

            <!-- معلومات التواصل -->
            <aside class="contact-info-section">
                
                <!-- معلومات مباشرة -->
                <div class="contact-info-card">
                    <h3>
                        <i class="fas fa-info-circle"></i>
                        معلومات التواصل
                    </h3>
                    
                    <div class="contact-methods">
                        <div class="contact-method">
                            <div class="method-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="method-details">
                                <h4>البريد الإلكتروني</h4>
                                <a href="mailto:Tahactw@gmail.com">Tahactw@gmail.com</a>
                                <p>نرد خلال 24 ساعة</p>
                            </div>
                        </div>

                        <div class="contact-method">
                            <div class="method-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="method-details">
                                <h4>ساعات العمل</h4>
                                <p>الأحد - الخميس</p>
                                <p>9:00 ص - 6:00 م (التوقيت المحلي)</p>
                            </div>
                        </div>

                        <div class="contact-method">
                            <div class="method-icon">
                                <i class="fas fa-headset"></i>
                            </div>
                            <div class="method-details">
                                <h4>الدعم الفني</h4>
                                <p>متوفر عبر البريد الإلكتروني</p>
                                <p>استجابة سريعة ومضمونة</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- الأسئلة الشائعة -->
                <div class="faq-card">
                    <h3>
                        <i class="fas fa-question-circle"></i>
                        أسئلة شائعة
                    </h3>
                    
                    <div class="faq-list">
                        <details class="faq-item">
                            <summary class="faq-question">
                                <i class="fas fa-plus"></i>
                                كيف يمكنني تحميل القوالب؟
                            </summary>
                            <div class="faq-answer">
                                <p>يمكنك تحميل أي قالب مجاناً بالضغط على زر "تحميل مجاني" بعد تقديم تقييم للقالب. التحميل فوري ومباشر.</p>
                            </div>
                        </details>

                        <details class="faq-item">
                            <summary class="faq-question">
                                <i class="fas fa-plus"></i>
                                هل القوالب متوافقة مع أحدث إصدار من ووردبريس؟
                            </summary>
                            <div class="faq-answer">
                                <p>نعم، جميع قوالبنا محدثة ومتوافقة مع أحدث إصدارات ووردبريس ونختبرها بانتظام.</p>
                            </div>
                        </details>

                        <details class="faq-item">
                            <summary class="faq-question">
                                <i class="fas fa-plus"></i>
                                هل يمكنني طلب تخصيص قالب؟
                            </summary>
                            <div class="faq-answer">
                                <p>بالطبع! يمكنك طلب تخصيص أي قالب أو تطوير قالب جديد حسب احتياجاتك. تواصل معنا للحصول على عرض سعر.</p>
                            </div>
                        </details>

                        <details class="faq-item">
                            <summary class="faq-question">
                                <i class="fas fa-plus"></i>
                                ما هو وقت الاستجابة للدعم الفني؟
                            </summary>
                            <div class="faq-answer">
                                <p>نستجيب لجميع الاستفسارات خلال 24 ساعة كحد أقصى، وعادة ما نرد في نفس اليوم.</p>
                            </div>
                        </details>
                    </div>
                </div>

                <!-- وسائل التواصل الاجتماعي -->
                <div class="social-card">
                    <h3>
                        <i class="fas fa-share-alt"></i>
                        تابعنا على وسائل التواصل
                    </h3>
                    
                    <div class="social-links">
                        <a href="#" class="social-link facebook" title="فيسبوك">
                            <i class="fab fa-facebook-f"></i>
                            <span>فيسبوك</span>
                        </a>
                        <a href="#" class="social-link twitter" title="تويتر">
                            <i class="fab fa-twitter"></i>
                            <span>تويتر</span>
                        </a>
                        <a href="#" class="social-link instagram" title="إنستغرام">
                            <i class="fab fa-instagram"></i>
                            <span>إنستغرام</span>
                        </a>
                        <a href="#" class="social-link youtube" title="يوتيوب">
                            <i class="fab fa-youtube"></i>
                            <span>يوتيوب</span>
                        </a>
                        <a href="#" class="social-link telegram" title="تليجرام">
                            <i class="fab fa-telegram"></i>
                            <span>تليجرام</span>
                        </a>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</main>

<style>
/* أنماط صفحة اتصل بنا */
.contact-page {
    min-height: 100vh;
    position: relative;
    padding: 2rem 0;
}

/* الخلفية الديناميكية */
.contact-bg-effects {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
    pointer-events: none;
}

.mesh-gradient {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: 
        radial-gradient(circle at 20% 80%, rgba(0, 255, 255, 0.08) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(139, 92, 246, 0.08) 0%, transparent 50%),
        radial-gradient(circle at 40% 40%, rgba(236, 72, 153, 0.05) 0%, transparent 50%);
    animation: meshFloat 12s ease-in-out infinite;
}

@keyframes meshFloat {
    0%, 100% { transform: scale(1) rotate(0deg); }
    50% { transform: scale(1.1) rotate(2deg); }
}

.floating-orbs {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

.orb {
    position: absolute;
    border-radius: 50%;
    opacity: 0.3;
    animation: orbFloat 8s ease-in-out infinite;
    animation-delay: var(--delay, 0s);
}

.orb-1 {
    width: 60px;
    height: 60px;
    top: 20%;
    left: 10%;
    background: radial-gradient(circle, var(--neon-blue), transparent);
}

.orb-2 {
    width: 80px;
    height: 80px;
    top: 60%;
    right: 15%;
    background: radial-gradient(circle, var(--neon-purple), transparent);
}

.orb-3 {
    width: 40px;
    height: 40px;
    bottom: 30%;
    left: 60%;
    background: radial-gradient(circle, var(--neon-pink), transparent);
}

.orb-4 {
    width: 70px;
    height: 70px;
    top: 40%;
    left: 80%;
    background: radial-gradient(circle, var(--neon-green), transparent);
}

@keyframes orbFloat {
    0%, 100% { transform: translateY(0) scale(1); }
    50% { transform: translateY(-30px) scale(1.2); }
}

/* رأس الصفحة */
.contact-header {
    text-align: center;
    margin-bottom: 4rem;
}

.page-title {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
    font-size: clamp(2.5rem, 5vw, 4rem);
    font-weight: 900;
    color: var(--text-primary);
    margin-bottom: 1rem;
    background: linear-gradient(45deg, var(--text-primary), var(--neon-blue), var(--neon-purple));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.title-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(45deg, var(--neon-blue), var(--neon-purple));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: white;
    animation: iconPulse 2s ease-in-out infinite;
}

@keyframes iconPulse {
    0%, 100% { transform: scale(1); box-shadow: 0 0 20px rgba(0, 255, 255, 0.3); }
    50% { transform: scale(1.1); box-shadow: 0 0 40px rgba(139, 92, 246, 0.5); }
}

.page-subtitle {
    font-size: 1.3rem;
    color: var(--text-secondary);
    margin-bottom: 3rem;
    line-height: 1.6;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

/* إحصائيات التواصل */
.contact-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 2rem;
    max-width: 800px;
    margin: 0 auto;
}

.stat-item {
    background: var(--bg-glass);
    border: 1px solid var(--border-color);
    border-radius: 20px;
    padding: 2rem;
    text-align: center;
    backdrop-filter: blur(20px);
    transition: all var(--transition-elastic);
    position: relative;
    overflow: hidden;
}

.stat-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(0, 255, 255, 0.1), transparent);
    transition: left 0.8s ease;
}

.stat-item:hover::before {
    left: 100%;
}

.stat-item:hover {
    transform: translateY(-10px);
    border-color: var(--neon-blue);
    box-shadow: 0 20px 60px rgba(0, 255, 255, 0.2);
}

.stat-icon {
    width: 60px;
    height: 60px;
    margin: 0 auto 1rem;
    background: linear-gradient(45deg, var(--neon-green), var(--neon-blue));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
}

.stat-number {
    display: block;
    font-size: 2.5rem;
    font-weight: 900;
    color: var(--neon-blue);
    margin-bottom: 0.5rem;
}

.stat-label {
    color: var(--text-secondary);
    font-weight: 600;
}

/* محتوى الصفحة */
.contact-content {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 4rem;
    align-items: start;
}

/* قسم النموذج */
.contact-form-section {
    background: var(--bg-glass);
    border: 1px solid var(--border-color);
    border-radius: 25px;
    padding: 3rem;
    backdrop-filter: blur(20px);
    position: relative;
    overflow: hidden;
}

.contact-form-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg, var(--neon-blue), var(--neon-purple), var(--neon-pink));
}

.form-header {
    text-align: center;
    margin-bottom: 3rem;
}

.form-header h2 {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    font-size: 2rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 1rem;
}

.form-header h2 i {
    color: var(--neon-blue);
}

.form-header p {
    color: var(--text-secondary);
    font-size: 1.1rem;
    line-height: 1.6;
}

/* شبكة النموذج */
.form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 2rem;
    margin-bottom: 2rem;
}

.form-group {
    position: relative;
}

.form-group.full-width {
    grid-column: 1 / -1;
}

.form-group.checkbox-group {
    grid-column: 1 / -1;
    margin-top: 1rem;
}

/* تسميات الحقول */
.form-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 0.75rem;
    font-size: 0.95rem;
}

.form-label i {
    color: var(--neon-blue);
    font-size: 0.9rem;
}

.required {
    color: #ef4444;
    font-weight: 700;
}

/* حاويات الحقول */
.input-wrapper,
.textarea-wrapper {
    position: relative;
}

.form-input,
.form-select,
.form-textarea {
    width: 100%;
    padding: 1rem 1.25rem;
    border: 2px solid var(--border-color);
    border-radius: 15px;
    background: var(--bg-tertiary);
    color: var(--text-primary);
    font-family: inherit;
    font-size: 1rem;
    transition: all var(--transition-normal);
    resize: none;
}

.form-input:focus,
.form-select:focus,
.form-textarea:focus {
    outline: none;
    border-color: var(--neon-blue);
    background: var(--bg-secondary);
    box-shadow: 0 0 30px rgba(0, 255, 255, 0.2);
}

.form-input::placeholder,
.form-textarea::placeholder {
    color: var(--text-muted);
    transition: opacity var(--transition-normal);
}

.form-input:focus::placeholder,
.form-textarea:focus::placeholder {
    opacity: 0.7;
}

/* تأثير التمييز */
.input-highlight,
.textarea-highlight {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 2px;
    background: linear-gradient(90deg, var(--neon-blue), var(--neon-purple));
    transition: width 0.3s ease;
}

.form-input:focus + .input-highlight,
.form-textarea:focus + .textarea-highlight {
    width: 100%;
}

/* قائمة منسدلة مخصصة */
.input-wrapper {
    position: relative;
}

.form-select {
    appearance: none;
    cursor: pointer;
    padding-left: 3rem;
}

.select-arrow {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-muted);
    pointer-events: none;
    transition: transform var(--transition-normal);
}

.form-select:focus + .select-arrow {
    transform: translateY(-50%) rotate(180deg);
    color: var(--neon-blue);
}

/* عداد الأحرف */
.character-count {
    position: absolute;
    bottom: 0.5rem;
    left: 1rem;
    font-size: 0.8rem;
    color: var(--text-muted);
    background: var(--bg-tertiary);
    padding: 0.25rem 0.5rem;
    border-radius: 10px;
}

/* صندوق اختيار مخصص */
.checkbox-label {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    cursor: pointer;
    line-height: 1.6;
}

.checkbox-input {
    display: none;
}

.checkbox-custom {
    flex-shrink: 0;
    width: 24px;
    height: 24px;
    border: 2px solid var(--border-color);
    border-radius: 6px;
    background: var(--bg-tertiary);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all var(--transition-normal);
    margin-top: 0.1rem;
}

.checkbox-custom i {
    color: white;
    font-size: 0.8rem;
    opacity: 0;
    transform: scale(0);
    transition: all var(--transition-normal);
}

.checkbox-input:checked + .checkbox-custom {
    background: var(--neon-blue);
    border-color: var(--neon-blue);
}

.checkbox-input:checked + .checkbox-custom i {
    opacity: 1;
    transform: scale(1);
}

.checkbox-text {
    color: var(--text-secondary);
    font-size: 0.95rem;
}

.checkbox-text a {
    color: var(--neon-blue);
    text-decoration: none;
    font-weight: 600;
}

.checkbox-text a:hover {
    text-decoration: underline;
}

/* رسائل الخطأ */
.field-error {
    color: #ef4444;
    font-size: 0.8rem;
    margin-top: 0.5rem;
    display: none;
    align-items: center;
    gap: 0.25rem;
}

.field-error::before {
    content: '⚠️';
    font-size: 0.9rem;
}

.form-group.error .field-error {
    display: flex;
}

.form-group.error .form-input,
.form-group.error .form-select,
.form-group.error .form-textarea {
    border-color: #ef4444;
    background-color: rgba(239, 68, 68, 0.05);
}

/* زر الإرسال */
.form-submit {
    text-align: center;
    margin-top: 2rem;
}

.submit-btn {
    background: linear-gradient(45deg, var(--neon-blue), var(--neon-purple));
    border: none;
    color: white;
    padding: 1.25rem 3rem;
    border-radius: 25px;
    font-size: 1.1rem;
    font-weight: 700;
    cursor: pointer;
    transition: all var(--transition-elastic);
    position: relative;
    overflow: hidden;
    min-width: 200px;
    font-family: inherit;
}

.submit-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 40px rgba(0, 255, 255, 0.4);
}

.submit-btn:active {
    transform: translateY(-1px);
}

.submit-btn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

.btn-content,
.btn-loading {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.btn-ripple {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.3) 0%, transparent 70%);
    transform: scale(0);
    transition: transform 0.6s ease;
}

.submit-btn:active .btn-ripple {
    transform: scale(1);
}

/* معلومات التواصل */
.contact-info-section {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.contact-info-card,
.faq-card,
.social-card {
    background: var(--bg-glass);
    border: 1px solid var(--border-color);
    border-radius: 20px;
    padding: 2rem;
    backdrop-filter: blur(20px);
    transition: all var(--transition-normal);
}

.contact-info-card:hover,
.faq-card:hover,
.social-card:hover {
    border-color: var(--neon-blue);
    box-shadow: 0 10px 30px rgba(0, 255, 255, 0.1);
}

.contact-info-card h3,
.faq-card h3,
.social-card h3 {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 1.3rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 2rem;
}

.contact-info-card h3 i,
.faq-card h3 i,
.social-card h3 i {
    color: var(--neon-blue);
}

/* طرق التواصل */
.contact-methods {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.contact-method {
    display: flex;
    gap: 1.5rem;
    padding: 1.5rem;
    background: var(--bg-tertiary);
    border-radius: 15px;
    transition: all var(--transition-normal);
}

.contact-method:hover {
    background: rgba(0, 255, 255, 0.05);
    transform: translateX(5px);
}

.method-icon {
    flex-shrink: 0;
    width: 50px;
    height: 50px;
    background: linear-gradient(45deg, var(--neon-green), var(--neon-blue));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
}

.method-details h4 {
    color: var(--text-primary);
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.method-details a {
    color: var(--neon-blue);
    text-decoration: none;
    font-weight: 600;
}

.method-details a:hover {
    text-decoration: underline;
}

.method-details p {
    color: var(--text-secondary);
    font-size: 0.9rem;
    margin: 0.25rem 0;
}

/* الأسئلة الشائعة */
.faq-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.faq-item {
    border: 1px solid var(--border-color);
    border-radius: 12px;
    overflow: hidden;
    transition: all var(--transition-normal);
}

.faq-item:hover {
    border-color: var(--neon-blue);
}

.faq-question {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.25rem;
    background: var(--bg-tertiary);
    cursor: pointer;
    font-weight: 600;
    color: var(--text-primary);
    transition: all var(--transition-normal);
    list-style: none;
}

.faq-question:hover {
    background: rgba(0, 255, 255, 0.05);
}

.faq-question i {
    color: var(--neon-blue);
    font-size: 0.9rem;
    transition: transform var(--transition-normal);
}

.faq-item[open] .faq-question i {
    transform: rotate(45deg);
}

.faq-answer {
    padding: 0 1.25rem 1.25rem;
    background: var(--bg-secondary);
}

.faq-answer p {
    color: var(--text-secondary);
    line-height: 1.6;
    margin: 0;
}

/* روابط اجتماعية */
.social-links {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
    gap: 1rem;
}

.social-link {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem;
    background: var(--bg-tertiary);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    text-decoration: none;
    color: var(--text-primary);
    transition: all var(--transition-elastic);
    font-weight: 600;
}

.social-link:hover {
    transform: translateY(-5px);
    border-color: var(--neon-blue);
}

.social-link i {
    font-size: 1.2rem;
    width: 24px;
    text-align: center;
}

.social-link.facebook:hover {
    background: #1877f2;
    color: white;
    border-color: #1877f2;
}

.social-link.twitter:hover {
    background: #1da1f2;
    color: white;
    border-color: #1da1f2;
}

.social-link.instagram:hover {
    background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);
    color: white;
    border-color: #bc1888;
}

.social-link.youtube:hover {
    background: #ff0000;
    color: white;
    border-color: #ff0000;
}

.social-link.telegram:hover {
    background: #0088cc;
    color: white;
    border-color: #0088cc;
}

/* التصميم المتجاوب */
@media (max-width: 1200px) {
    .contact-content {
        grid-template-columns: 1fr;
        gap: 3rem;
    }
    
    .contact-stats {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 768px) {
    .contact-page {
        padding: 1rem 0;
    }
    
    .contact-form-section {
        padding: 2rem;
    }
    
    .form-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .contact-stats {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .title-icon {
        width: 60px;
        height: 60px;
        font-size: 1.5rem;
    }
    
    .page-title {
        font-size: 2.5rem;
        flex-direction: column;
    }
    
    .contact-method {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
    }
    
    .social-links {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 480px) {
    .contact-form-section {
        padding: 1.5rem;
    }
    
    .form-header h2 {
        font-size: 1.5rem;
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .submit-btn {
        width: 100%;
        padding: 1rem 2rem;
    }
    
    .page-subtitle {
        font-size: 1.1rem;
    }
    
    .stat-item {
        padding: 1.5rem;
    }
    
    .stat-number {
        font-size: 2rem;
    }
}

/* دعم RTL */
[dir="rtl"] .contact-method:hover {
    transform: translateX(-5px);
}

[dir="rtl"] .form-select {
    padding-left: 1.25rem;
    padding-right: 3rem;
}

[dir="rtl"] .select-arrow {
    left: auto;
    right: 1rem;
}

[dir="rtl"] .character-count {
    left: auto;
    right: 1rem;
}

[dir="rtl"] .checkbox-label {
    flex-direction: row-reverse;
    text-align: right;
}

[dir="rtl"] .faq-question {
    flex-direction: row-reverse;
}

[dir="rtl"] .method-details {
    text-align: right;
}

[dir="rtl"] .social-link {
    flex-direction: row-reverse;
}
</style>

<script>
// سكريبت صفحة اتصل بنا المتقدم
document.addEventListener('DOMContentLoaded', function() {
    initContactForm();
    initFormValidation();
    initCharacterCounter();
    initFAQAccordion();
    initAnimatedCounters();
    initScrollAnimations();
});

// تهيئة نموذج التواصل
function initContactForm() {
    const form = document.getElementById('contact-form');
    const submitBtn = document.getElementById('submit-btn');
    
    if (!form || !submitBtn) return;
    
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        // التحقق من صحة البيانات
        if (!validateForm()) {
            return;
        }
        
        // بدء عملية الإرسال
        setFormLoading(true);
        
        try {
            // جمع بيانات النموذج
            const formData = new FormData(form);
            const data = {
                action: 'send_contact_message',
                nonce: window.ArabicThemes?.nonce || '',
                name: formData.get('name'),
                email: formData.get('email'),
                phone: formData.get('phone'),
                subject: formData.get('subject'),
                message: formData.get('message'),
                privacy: formData.get('privacy') ? 'yes' : 'no'
            };
            
            // إرسال البيانات
            const response = await fetch(window.ArabicThemes?.ajaxurl || '/wp-admin/admin-ajax.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams(data)
            });
            
            const result = await response.json();
            
            if (result.success) {
                // نجح الإرسال
                showSuccessMessage();
                form.reset();
                clearValidationErrors();
                
                // تأثير احتفالي
                if (window.ArabicThemes) {
                    window.ArabicThemes.createParticleExplosion();
                    window.ArabicThemes.showNotification('تم إرسال رسالتك بنجاح! سنرد عليك قريباً', 'success');
                }
            } else {
                throw new Error(result.data?.message || 'فشل في إرسال الرسالة');
            }
            
        } catch (error) {
            console.error('خطأ في إرسال النموذج:', error);
            
            if (window.ArabicThemes) {
                window.ArabicThemes.showNotification('حدث خطأ في إرسال الرسالة. يرجى المحاولة مرة أخرى', 'error');
            }
        } finally {
            setFormLoading(false);
        }
    });
}

// تعيين حالة التحميل
function setFormLoading(loading) {
    const submitBtn = document.getElementById('submit-btn');
    const btnContent = submitBtn?.querySelector('.btn-content');
    const btnLoading = submitBtn?.querySelector('.btn-loading');
    
    if (!submitBtn || !btnContent || !btnLoading) return;
    
    submitBtn.disabled = loading;
    
    if (loading) {
        btnContent.style.display = 'none';
        btnLoading.style.display = 'flex';
        
        // تأثير تموج
        const ripple = submitBtn.querySelector('.btn-ripple');
        if (ripple) {
            ripple.style.transform = 'scale(1)';
            setTimeout(() => {
                ripple.style.transform = 'scale(0)';
            }, 600);
        }
    } else {
        btnContent.style.display = 'flex';
        btnLoading.style.display = 'none';
    }
}

// التحقق من صحة النموذج
function initFormValidation() {
    const inputs = document.querySelectorAll('.form-input, .form-select, .form-textarea');
    const checkboxes = document.querySelectorAll('.checkbox-input');
    
    // التحقق في الوقت الفعلي
    inputs.forEach(input => {
        input.addEventListener('blur', () => validateField(input));
        input.addEventListener('input', () => {
            if (input.closest('.form-group').classList.contains('error')) {
                validateField(input);
            }
        });
    });
    
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => validateField(checkbox));
    });
}

function validateField(field) {
    const formGroup = field.closest('.form-group');
    const errorElement = formGroup?.querySelector('.field-error');
    
    if (!formGroup || !errorElement) return true;
    
    let isValid = true;
    let errorMessage = '';
    
    // التحقق من الحقول المطلوبة
    if (field.hasAttribute('required') && !field.value.trim()) {
        isValid = false;
        errorMessage = 'هذا الحقل مطلوب';
    }
    
    // التحقق من البريد الإلكتروني
    if (field.type === 'email' && field.value.trim()) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(field.value.trim())) {
            isValid = false;
            errorMessage = 'يرجى إدخال بريد إلكتروني صحيح';
        }
    }
    
    // التحقق من الهاتف
    if (field.type === 'tel' && field.value.trim()) {
        const phoneRegex = /^[\+]?[0-9\s\-\(\)]{10,}$/;
        if (!phoneRegex.test(field.value.trim())) {
            isValid = false;
            errorMessage = 'يرجى إدخال رقم هاتف صحيح';
        }
    }
    
    // التحقق من صندوق الاختيار
    if (field.type === 'checkbox' && field.hasAttribute('required') && !field.checked) {
        isValid = false;
        errorMessage = 'يجب الموافقة على سياسة الخصوصية';
    }
    
    // عرض أو إخفاء رسالة الخطأ
    if (isValid) {
        formGroup.classList.remove('error');
        errorElement.textContent = '';
    } else {
        formGroup.classList.add('error');
        errorElement.textContent = errorMessage;
        
        // تأثير اهتزاز
        gsap.fromTo(formGroup, 
            { x: -10 },
            { x: 0, duration: 0.1, repeat: 5, yoyo: true }
        );
    }
    
    return isValid;
}

function validateForm() {
    const fields = document.querySelectorAll('.form-input[required], .form-select[required], .form-textarea[required], .checkbox-input[required]');
    let isFormValid = true;
    
    fields.forEach(field => {
        if (!validateField(field)) {
            isFormValid = false;
        }
    });
    
    return isFormValid;
}

function clearValidationErrors() {
    const errorGroups = document.querySelectorAll('.form-group.error');
    errorGroups.forEach(group => {
        group.classList.remove('error');
        const errorElement = group.querySelector('.field-error');
        if (errorElement) {
            errorElement.textContent = '';
        }
    });
}

// عداد الأحرف
function initCharacterCounter() {
    const textarea = document.getElementById('contact-message');
    const counter = document.getElementById('char-count');
    const maxLength = 1000;
    
    if (!textarea || !counter) return;
    
    textarea.addEventListener('input', function() {
        const currentLength = this.value.length;
        counter.textContent = currentLength;
        
        // تغيير لون العداد حسب الطول
        const percentage = (currentLength / maxLength) * 100;
        
        if (percentage > 90) {
            counter.style.color = '#ef4444';
        } else if (percentage > 75) {
            counter.style.color = '#f59e0b';
        } else {
            counter.style.color = 'var(--text-muted)';
        }
        
        // منع الكتابة بعد الحد الأقصى
        if (currentLength > maxLength) {
            this.value = this.value.substring(0, maxLength);
            counter.textContent = maxLength;
        }
    });
}

// الأسئلة الشائعة
function initFAQAccordion() {
    const faqItems = document.querySelectorAll('.faq-item');
    
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        const answer = item.querySelector('.faq-answer');
        
        if (!question || !answer) return;
        
        // إغلاق جميع العناصر في البداية
        item.removeAttribute('open');
        
        question.addEventListener('click', function(e) {
            e.preventDefault();
            
            const isOpen = item.hasAttribute('open');
            
            // إغلاق جميع العناصر الأخرى
            faqItems.forEach(otherItem => {
                if (otherItem !== item) {
                    otherItem.removeAttribute('open');
                }
            });
            
            // تبديل العنصر الحالي
            if (isOpen) {
                item.removeAttribute('open');
            } else {
                item.setAttribute('open', '');
                
                // تأثير انزلاق سلس
                gsap.fromTo(answer, 
                    { height: 0, opacity: 0 },
                    { height: 'auto', opacity: 1, duration: 0.3, ease: "power2.out" }
                );
            }
            
            // تأثير صوتي
            if (window.ArabicThemes) {
                window.ArabicThemes.playClickSound();
            }
        });
    });
}

// العدادات المتحركة
function initAnimatedCounters() {
    const counters = document.querySelectorAll('.stat-number');
    
    const observerOptions = {
        threshold: 0.5,
        rootMargin: '0px 0px -100px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.classList.contains('animated')) {
                animateCounter(entry.target);
                entry.target.classList.add('animated');
            }
        });
    }, observerOptions);
    
    counters.forEach(counter => {
        observer.observe(counter);
    });
}

function animateCounter(element) {
    const text = element.textContent;
    const hasPercent = text.includes('%');
    const finalValue = parseInt(text.replace(/[^\d]/g, '')) || 0;
    
    const duration = 2000;
    const increment = finalValue / (duration / 16);
    let currentValue = 0;
    
    const timer = setInterval(() => {
        currentValue += increment;
        
        if (currentValue >= finalValue) {
            currentValue = finalValue;
            clearInterval(timer);
        }
        
        const displayValue = Math.floor(currentValue);
        element.textContent = hasPercent ? displayValue + '%' : displayValue.toLocaleString();
    }, 16);
}

// تأثيرات التمرير
function initScrollAnimations() {
    const animatedElements = document.querySelectorAll('.stat-item, .contact-method, .faq-item, .social-link');
    
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.classList.contains('animated')) {
                const element = entry.target;
                const delay = Array.from(element.parentNode.children).indexOf(element) * 0.1;
                
                gsap.fromTo(element, 
                    { y: 30, opacity: 0 },
                    { 
                        y: 0, 
                        opacity: 1, 
                        duration: 0.6,
                        delay: delay,
                        ease: "back.out(1.7)"
                    }
                );
                
                element.classList.add('animated');
            }
        });
    }, observerOptions);
    
    animatedElements.forEach(element => {
        observer.observe(element);
    });
}

// رسالة النجاح
function showSuccessMessage() {
    const formContainer = document.querySelector('.form-container');
    if (!formContainer) return;
    
    const successMessage = document.createElement('div');
    successMessage.className = 'success-message';
    successMessage.innerHTML = `
        <div class="success-content">
            <div class="success-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h3>تم إرسال رسالتك بنجاح!</h3>
            <p>شكراً لك على تواصلك معنا. سنرد على رسالتك في أقرب وقت ممكن خلال 24 ساعة.</p>
            <button class="btn btn-primary" onclick="this.parentElement.parentElement.remove()">
                <i class="fas fa-times"></i>
                إغلاق
            </button>
        </div>
    `;
    
    successMessage.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 3000;
        backdrop-filter: blur(10px);
    `;
    
    const content = successMessage.querySelector('.success-content');
    content.style.cssText = `
        background: var(--bg-secondary);
        border: 1px solid var(--border-color);
        border-radius: 20px;
        padding: 3rem;
        text-align: center;
        max-width: 400px;
        width: 90%;
    `;
    
    const icon = successMessage.querySelector('.success-icon');
    icon.style.cssText = `
        width: 80px;
        height: 80px;
        background: var(--neon-green);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 2rem;
        color: white;
    `;
    
    document.body.appendChild(successMessage);
    
    // تأثير ظهور
    gsap.fromTo(successMessage, 
        { opacity: 0 },
        { opacity: 1, duration: 0.3 }
    );
    
    gsap.fromTo(content, 
        { scale: 0.8, y: -50 },
        { scale: 1, y: 0, duration: 0.4, delay: 0.1, ease: "back.out(1.7)" }
    );
}

// إزالة رسالة النجاح عند النقر خارجها
document.addEventListener('click', function(e) {
    const successMessage = document.querySelector('.success-message');
    if (successMessage && e.target === successMessage) {
        successMessage.remove();
    }
});
</script>

<?php get_footer(); ?>
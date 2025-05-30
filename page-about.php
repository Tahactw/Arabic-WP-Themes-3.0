    margin-bottom: 2rem;
}

.mission-points {
    list-style: none;
    padding: 0;
    margin: 0;
}

.mission-points li {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 0.75rem 0;
    color: var(--text-secondary);
    border-bottom: 1px solid var(--border-color);
}

.mission-points li:last-child {
    border-bottom: none;
}

.mission-points i {
    color: var(--neon-green);
    font-size: 1.2rem;
    flex-shrink: 0;
}

.vision-goals {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.goal-item {
    display: flex;
    gap: 1.5rem;
    padding: 1.5rem;
    background: var(--bg-tertiary);
    border-radius: 15px;
    transition: all var(--transition-normal);
}

.goal-item:hover {
    background: rgba(139, 92, 246, 0.05);
    transform: translateX(10px);
}

.goal-icon {
    flex-shrink: 0;
    width: 50px;
    height: 50px;
    background: linear-gradient(45deg, var(--neon-purple), var(--neon-pink));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    color: white;
}

.goal-content h4 {
    color: var(--text-primary);
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.goal-content p {
    color: var(--text-secondary);
    margin: 0;
    font-size: 0.95rem;
    line-height: 1.6;
}

/* قسم الفريق */
.team-section {
    margin-bottom: 6rem;
}

.team-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 3rem;
}

.team-member {
    background: var(--bg-glass);
    border: 1px solid var(--border-color);
    border-radius: 25px;
    padding: 2.5rem;
    text-align: center;
    backdrop-filter: blur(20px);
    transition: all var(--transition-elastic);
    position: relative;
    overflow: hidden;
}

.team-member::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.1), transparent);
    transition: left 0.8s ease;
}

.team-member:hover::before {
    left: 100%;
}

.team-member:hover {
    transform: translateY(-15px);
    border-color: var(--neon-blue);
    box-shadow: 0 25px 60px rgba(59, 130, 246, 0.2);
}

.member-avatar {
    position: relative;
    width: 120px;
    height: 120px;
    margin: 0 auto 2rem;
    border-radius: 50%;
    overflow: hidden;
}

.avatar-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, var(--neon-blue), var(--neon-purple));
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    color: white;
    transition: all var(--transition-normal);
}

.member-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: all var(--transition-normal);
}

.member-avatar:hover .member-overlay {
    opacity: 1;
}

.social-links {
    display: flex;
    gap: 1rem;
}

.social-links a {
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-decoration: none;
    transition: all var(--transition-normal);
    backdrop-filter: blur(10px);
}

.social-links a:hover {
    background: var(--neon-blue);
    transform: scale(1.2);
}

.member-info h4 {
    color: var(--text-primary);
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.member-role {
    color: var(--neon-blue);
    font-weight: 600;
    margin-bottom: 1rem;
    font-size: 1.1rem;
}

.member-bio {
    color: var(--text-secondary);
    line-height: 1.6;
    font-size: 0.95rem;
    margin: 0;
}

/* قسم القيم */
.values-section {
    margin-bottom: 6rem;
}

.values-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
}

.value-card {
    background: var(--bg-glass);
    border: 1px solid var(--border-color);
    border-radius: 20px;
    padding: 2.5rem;
    text-align: center;
    backdrop-filter: blur(20px);
    transition: all var(--transition-elastic);
    position: relative;
    overflow: hidden;
}

.value-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg, var(--neon-blue), var(--neon-green), var(--neon-purple));
    transform: scaleX(0);
    transition: transform 0.6s ease;
}

.value-card:hover::before {
    transform: scaleX(1);
}

.value-card:hover {
    transform: translateY(-10px);
    border-color: var(--neon-blue);
    box-shadow: 0 20px 50px rgba(59, 130, 246, 0.2);
}

.value-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 1.5rem;
    background: linear-gradient(45deg, var(--neon-blue), var(--neon-green));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: white;
    transition: all var(--transition-normal);
}

.value-card:hover .value-icon {
    transform: scale(1.1) rotate(10deg);
}

.value-card h3 {
    color: var(--text-primary);
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.value-card p {
    color: var(--text-secondary);
    line-height: 1.7;
    margin: 0;
}

/* قسم الإنجازات */
.achievements-section {
    margin-bottom: 6rem;
}

.achievements-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

.achievement-card {
    background: var(--bg-glass);
    border: 1px solid var(--border-color);
    border-radius: 20px;
    padding: 2.5rem 2rem;
    text-align: center;
    backdrop-filter: blur(20px);
    transition: all var(--transition-elastic);
    position: relative;
    overflow: hidden;
}

.achievement-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, transparent, rgba(16, 185, 129, 0.05), transparent);
    transform: translateX(-100%);
    transition: transform 0.8s ease;
}

.achievement-card:hover::before {
    transform: translateX(100%);
}

.achievement-card:hover {
    transform: translateY(-15px);
    border-color: var(--neon-green);
    box-shadow: 0 25px 60px rgba(16, 185, 129, 0.2);
}

.achievement-icon {
    width: 70px;
    height: 70px;
    margin: 0 auto 1.5rem;
    background: linear-gradient(45deg, var(--neon-green), var(--neon-blue));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
    color: white;
    animation: achievementPulse 3s ease-in-out infinite;
}

@keyframes achievementPulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

.achievement-number {
    font-size: 3rem;
    font-weight: 900;
    color: var(--neon-green);
    margin-bottom: 0.5rem;
    display: block;
}

.achievement-label {
    color: var(--text-primary);
    font-weight: 700;
    font-size: 1.2rem;
    margin-bottom: 1rem;
}

.achievement-description {
    color: var(--text-secondary);
    font-size: 0.9rem;
    line-height: 1.6;
}

/* قسم الانضمام */
.join-us-section {
    background: var(--bg-glass);
    border: 1px solid var(--border-color);
    border-radius: 30px;
    padding: 4rem;
    backdrop-filter: blur(20px);
    position: relative;
    overflow: hidden;
}

.join-us-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: 
        radial-gradient(circle at 20% 80%, rgba(59, 130, 246, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(16, 185, 129, 0.1) 0%, transparent 50%);
    pointer-events: none;
}

.join-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: center;
    position: relative;
    z-index: 1;
}

.join-text h2 {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 1.5rem;
    background: linear-gradient(45deg, var(--text-primary), var(--neon-blue));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.join-text p {
    color: var(--text-secondary);
    font-size: 1.2rem;
    line-height: 1.7;
    margin-bottom: 3rem;
}

.join-actions {
    display: flex;
    gap: 2rem;
    flex-wrap: wrap;
}

.btn {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1.25rem 2.5rem;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 700;
    font-size: 1.1rem;
    transition: all var(--transition-elastic);
    position: relative;
    overflow: hidden;
}

.btn-primary {
    background: linear-gradient(45deg, var(--neon-blue), var(--neon-purple));
    color: white;
    border: none;
}

.btn-primary:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(59, 130, 246, 0.4);
}

.btn-secondary {
    background: transparent;
    color: var(--text-primary);
    border: 2px solid var(--border-color);
}

.btn-secondary:hover {
    background: var(--neon-blue);
    color: white;
    border-color: var(--neon-blue);
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(59, 130, 246, 0.3);
}

.join-visual {
    display: flex;
    justify-content: center;
    align-items: center;
}

.community-icons {
    position: relative;
    width: 300px;
    height: 300px;
}

.community-icon {
    position: absolute;
    width: 60px;
    height: 60px;
    background: linear-gradient(45deg, var(--neon-blue), var(--neon-green));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    animation: communityFloat 8s ease-in-out infinite;
}

.icon-1 { top: 0; left: 50%; transform: translateX(-50%); animation-delay: 0s; }
.icon-2 { top: 25%; right: 10%; animation-delay: 1.3s; }
.icon-3 { top: 75%; right: 10%; animation-delay: 2.6s; }
.icon-4 { bottom: 0; left: 50%; transform: translateX(-50%); animation-delay: 4s; }
.icon-5 { top: 75%; left: 10%; animation-delay: 5.3s; }
.icon-6 { top: 25%; left: 10%; animation-delay: 6.6s; }

@keyframes communityFloat {
    0%, 100% { transform: translateY(0) scale(1); }
    50% { transform: translateY(-20px) scale(1.1); }
}

.community-center {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 100px;
    height: 100px;
    background: linear-gradient(45deg, var(--neon-pink), var(--neon-purple));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2.5rem;
    animation: heartBeat 2s ease-in-out infinite;
    z-index: 2;
}

/* التصميم المتجاوب */
@media (max-width: 1200px) {
    .hero-section {
        grid-template-columns: 1fr;
        gap: 3rem;
        text-align: center;
    }
    
    .hero-visual {
        height: 400px;
    }
    
    .mission-vision-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .join-content {
        grid-template-columns: 1fr;
        gap: 3rem;
        text-align: center;
    }
}

@media (max-width: 768px) {
    .about-page {
        padding: 1rem 0;
    }
    
    .hero-title {
        font-size: 2.5rem;
    }
    
    .hero-subtitle {
        font-size: 1.1rem;
    }
    
    .hero-stats {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .section-title {
        font-size: 2rem;
        flex-direction: column;
        gap: 1rem;
    }
    
    .title-icon {
        width: 50px;
        height: 50px;
        font-size: 1.2rem;
    }
    
    .story-timeline::before {
        left: 2rem;
    }
    
    .timeline-item:nth-child(odd) .timeline-content,
    .timeline-item:nth-child(even) .timeline-content {
        margin-left: 4rem;
        margin-right: 0;
        text-align: left;
    }
    
    .timeline-icon {
        left: 2rem;
        transform: translateY(-50%);
    }
    
    .timeline-content::before {
        left: 1rem !important;
        right: auto !important;
    }
    
    .team-grid {
        grid-template-columns: 1fr;
    }
    
    .values-grid {
        grid-template-columns: 1fr;
    }
    
    .achievements-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .join-us-section {
        padding: 2.5rem;
    }
    
    .join-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .btn {
        width: 100%;
        justify-content: center;
        max-width: 300px;
    }
    
    .community-icons {
        width: 250px;
        height: 250px;
    }
    
    .community-center {
        width: 80px;
        height: 80px;
        font-size: 2rem;
    }
    
    .community-icon {
        width: 50px;
        height: 50px;
        font-size: 1.2rem;
    }
}

@media (max-width: 480px) {
    .hero-title {
        font-size: 2rem;
    }
    
    .section-title {
        font-size: 1.8rem;
    }
    
    .mission-card,
    .vision-card,
    .team-member,
    .value-card,
    .achievement-card {
        padding: 2rem;
    }
    
    .timeline-content {
        padding: 1.5rem;
    }
    
    .achievements-grid {
        grid-template-columns: 1fr;
    }
    
    .achievement-number {
        font-size: 2.5rem;
    }
    
    .join-text h2 {
        font-size: 2rem;
    }
    
    .join-text p {
        font-size: 1.1rem;
    }
    
    .floating-card {
        padding: 1rem;
        min-width: 100px;
    }
    
    .floating-card span {
        font-size: 0.8rem;
    }
}

/* دعم RTL */
[dir="rtl"] .timeline-item:nth-child(odd) .timeline-content {
    margin-left: calc(50% + 2rem);
    margin-right: 0;
    text-align: left;
}

[dir="rtl"] .timeline-item:nth-child(even) .timeline-content {
    margin-right: calc(50% + 2rem);
    margin-left: 0;
    text-align: right;
}

[dir="rtl"] .timeline-item:nth-child(odd) .timeline-content::before {
    left: 2rem;
    right: auto;
}

[dir="rtl"] .timeline-item:nth-child(even) .timeline-content::before {
    right: 2rem;
    left: auto;
}

[dir="rtl"] .goal-item:hover {
    transform: translateX(-10px);
}

[dir="rtl"] .join-actions {
    flex-direction: row-reverse;
}

@media (max-width: 768px) {
    [dir="rtl"] .timeline-item:nth-child(odd) .timeline-content,
    [dir="rtl"] .timeline-item:nth-child(even) .timeline-content {
        margin-right: 4rem;
        margin-left: 0;
        text-align: right;
    }
    
    [dir="rtl"] .timeline-icon {
        right: 2rem;
        left: auto;
    }
    
    [dir="rtl"] .timeline-content::before {
        right: 1rem !important;
        left: auto !important;
    }
    
    [dir="rtl"] .join-actions {
        flex-direction: column;
    }
}
</style>

<script>
// سكريبت صفحة من نحن المتقدم
document.addEventListener('DOMContentLoaded', function() {
    initAnimatedCounters();
    initScrollAnimations();
    initTimelineAnimations();
    initParallaxEffects();
    initTeamHoverEffects();
    initAchievementCounters();
});

// العدادات المتحركة للقسم البطولي
function initAnimatedCounters() {
    const counters = document.querySelectorAll('.stat-number[data-count]');
    
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
    const finalValue = parseInt(element.getAttribute('data-count'));
    const duration = 2000;
    const increment = finalValue / (duration / 16);
    let currentValue = 0;
    
    const timer = setInterval(() => {
        currentValue += increment;
        
        if (currentValue >= finalValue) {
            currentValue = finalValue;
            clearInterval(timer);
        }
        
        element.textContent = Math.floor(currentValue).toLocaleString();
    }, 16);
}

// تأثيرات التمرير
function initScrollAnimations() {
    const animatedElements = document.querySelectorAll(
        '.value-card, .team-member, .mission-card, .vision-card'
    );
    
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
                    { y: 50, opacity: 0, scale: 0.9 },
                    { 
                        y: 0, 
                        opacity: 1, 
                        scale: 1,
                        duration: 0.8,
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

// تأثيرات الخط الزمني
function initTimelineAnimations() {
    const timelineItems = document.querySelectorAll('.timeline-item');
    
    const observerOptions = {
        threshold: 0.3,
        rootMargin: '0px 0px -100px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.classList.contains('animated')) {
                const timelineContent = entry.target.querySelector('.timeline-content');
                const timelineIcon = entry.target.querySelector('.timeline-icon');
                
                // تأثير المحتوى
                gsap.fromTo(timelineContent, 
                    { x: entry.target.matches(':nth-child(odd)') ? -100 : 100, opacity: 0 },
                    { 
                        x: 0, 
                        opacity: 1, 
                        duration: 0.8,
                        ease: "power3.out"
                    }
                );
                
                // تأثير الأيقونة
                gsap.fromTo(timelineIcon,
                    { scale: 0, rotation: -180 },
                    {
                        scale: 1,
                        rotation: 0,
                        duration: 0.6,
                        delay: 0.3,
                        ease: "back.out(1.7)"
                    }
                );
                
                entry.target.classList.add('animated');
            }
        });
    }, observerOptions);
    
    timelineItems.forEach(item => {
        observer.observe(item);
    });
}

// تأثيرات المنظور
function initParallaxEffects() {
    const shapes = document.querySelectorAll('.creative-shape');
    const floatingCards = document.querySelectorAll('.floating-card');
    
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const rate = scrolled * -0.5;
        
        shapes.forEach((shape, index) => {
            const speed = (index + 1) * 0.3;
            shape.style.transform = `translateY(${rate * speed}px) rotate(${scrolled * 0.05}deg)`;
        });
        
        floatingCards.forEach((card, index) => {
            const speed = (index + 1) * 0.2;
            card.style.transform = `translateY(${rate * speed}px)`;
        });
    });
}

// تأثيرات تمرير الفريق
function initTeamHoverEffects() {
    const teamMembers = document.querySelectorAll('.team-member');
    
    teamMembers.forEach(member => {
        const avatar = member.querySelector('.avatar-placeholder');
        const info = member.querySelector('.member-info');
        
        member.addEventListener('mouseenter', function() {
            gsap.to(avatar, {
                scale: 1.1,
                rotation: 5,
                duration: 0.3,
                ease: "back.out(1.7)"
            });
            
            gsap.to(info, {
                y: -10,
                duration: 0.3
            });
            
            // تأثير الجسيمات
            createMemberParticles(this);
        });
        
        member.addEventListener('mouseleave', function() {
            gsap.to(avatar, {
                scale: 1,
                rotation: 0,
                duration: 0.3
            });
            
            gsap.to(info, {
                y: 0,
                duration: 0.3
            });
        });
    });
}

function createMemberParticles(memberElement) {
    const rect = memberElement.getBoundingClientRect();
    const centerX = rect.left + rect.width / 2;
    const centerY = rect.top + rect.height / 2;
    
    for (let i = 0; i < 6; i++) {
        const particle = document.createElement('div');
        particle.style.cssText = `
            position: fixed;
            left: ${centerX}px;
            top: ${centerY}px;
            width: 6px;
            height: 6px;
            background: var(--neon-blue);
            border-radius: 50%;
            pointer-events: none;
            z-index: 3000;
        `;
        
        document.body.appendChild(particle);
        
        const angle = (i / 6) * Math.PI * 2;
        const distance = 80 + Math.random() * 40;
        const endX = centerX + Math.cos(angle) * distance;
        const endY = centerY + Math.sin(angle) * distance;
        
        gsap.to(particle, {
            x: endX - centerX,
            y: endY - centerY,
            scale: 0,
            opacity: 0,
            duration: 1.5,
            ease: "power2.out",
            onComplete: () => particle.remove()
        });
    }
}

// عدادات الإنجازات
function initAchievementCounters() {
    const achievementNumbers = document.querySelectorAll('.achievement-number[data-count]');
    
    const observerOptions = {
        threshold: 0.5,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.classList.contains('animated')) {
                animateAchievement(entry.target);
                entry.target.classList.add('animated');
            }
        });
    }, observerOptions);
    
    achievementNumbers.forEach(number => {
        observer.observe(number);
    });
}

function animateAchievement(element) {
    const finalValue = parseFloat(element.getAttribute('data-count'));
    const isDecimal = finalValue % 1 !== 0;
    const duration = 2500;
    const increment = finalValue / (duration / 16);
    let currentValue = 0;
    
    // تأثير اهتزاز البطاقة
    const card = element.closest('.achievement-card');
    gsap.fromTo(card, 
        { scale: 1 },
        { 
            scale: 1.05, 
            duration: 0.3, 
            yoyo: true, 
            repeat: 1,
            ease: "power2.inOut"
        }
    );
    
    const timer = setInterval(() => {
        currentValue += increment;
        
        if (currentValue >= finalValue) {
            currentValue = finalValue;
            clearInterval(timer);
        }
        
        if (isDecimal) {
            element.textContent = currentValue.toFixed(1);
        } else {
            element.textContent = Math.floor(currentValue).toLocaleString();
        }
    }, 16);
    
    // تأثير الألعاب النارية عند الانتهاء
    setTimeout(() => {
        createAchievementFireworks(element);
    }, duration);
}

function createAchievementFireworks(element) {
    const rect = element.getBoundingClientRect();
    const centerX = rect.left + rect.width / 2;
    const centerY = rect.top + rect.height / 2;
    
    for (let i = 0; i < 12; i++) {
        const firework = document.createElement('div');
        firework.innerHTML = '✨';
        firework.style.cssText = `
            position: fixed;
            left: ${centerX}px;
            top: ${centerY}px;
            font-size: 1.5rem;
            pointer-events: none;
            z-index: 3000;
        `;
        
        document.body.appendChild(firework);
        
        const angle = (i / 12) * Math.PI * 2;
        const distance = 60 + Math.random() * 40;
        const endX = centerX + Math.cos(angle) * distance;
        const endY = centerY + Math.sin(angle) * distance;
        
        gsap.to(firework, {
            x: endX - centerX,
            y: endY - centerY,
            scale: 0,
            rotation: 360,
            duration: 1.2,
            ease: "power2.out",
            onComplete: () => firework.remove()
        });
    }
}

// تأثيرات تفاعلية إضافية
function initInteractiveEffects() {
    // تأثير المؤشر المخصص
    const cursor = document.createElement('div');
    cursor.className = 'custom-cursor';
    cursor.style.cssText = `
        position: fixed;
        width: 20px;
        height: 20px;
        background: var(--neon-blue);
        border-radius: 50%;
        pointer-events: none;
        z-index: 9999;
        opacity: 0;
        transition: all 0.1s ease;
        mix-blend-mode: difference;
    `;
    document.body.appendChild(cursor);
    
    document.addEventListener('mousemove', (e) => {
        cursor.style.left = e.clientX + 'px';
        cursor.style.top = e.clientY + 'px';
        cursor.style.opacity = '1';
    });
    
    document.addEventListener('mouseleave', () => {
        cursor.style.opacity = '0';
    });
    
    // تأثيرات التمرير للأزرار
    const buttons = document.querySelectorAll('.btn');
    buttons.forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            cursor.style.transform = 'scale(2)';
            
            gsap.to(this, {
                scale: 1.05,
                duration: 0.3,
                ease: "back.out(1.7)"
            });
        });
        
        btn.addEventListener('mouseleave', function() {
            cursor.style.transform = 'scale(1)';
            
            gsap.to(this, {
                scale: 1,
                duration: 0.3
            });
        });
        
        btn.addEventListener('click', function(e) {
            // تأثير النقر
            const ripple = document.createElement('div');
            ripple.style.cssText = `
                position: absolute;
                background: rgba(255, 255, 255, 0.6);
                border-radius: 50%;
                pointer-events: none;
                transform: scale(0);
                animation: ripple 0.6s ease-out;
            `;
            
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = e.clientX - rect.left - size / 2 + 'px';
            ripple.style.top = e.clientY - rect.top - size / 2 + 'px';
            
            this.appendChild(ripple);
            
            setTimeout(() => ripple.remove(), 600);
        });
    });
}

// تشغيل التأثيرات التفاعلية
setTimeout(initInteractiveEffects, 1000);

// إضافة أنماط التأثيرات
const rippleStyles = document.createElement('style');
rippleStyles.textContent = `
    @keyframes ripple {
        to {
            transform: scale(2);
            opacity: 0;
        }
    }
    
    .btn {
        position: relative;
        overflow: hidden;
    }
`;
document.head.appendChild(rippleStyles);
</script>

<?php get_footer(); ?>
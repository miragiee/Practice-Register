<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Global Tech Solutions — Практикум</title>
    @vite(['resources/js/student-profile.js', 'resources/css/student-profile.css'])
</head>
<body>

    <header class="header">
        <div class="header-logo">Практикум</div>
        <nav class="header-nav">
            <a href="#">Студентам</a>
            <a href="#">Университетам</a>
            <a href="#" class="active">Компаниям</a>
            <a href="#">Тарифы</a>
        </nav>
    </header>

    <div class="main-container">
        <!-- COMPANY HEADER -->
        <div class="company-header fade-in">
            <div class="company-header-left">
                <div class="company-logo">
                    <svg viewBox="0 0 24 24">
                        <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/>
                    </svg>
                </div>
                <div class="company-info">
                    <h1>Global Tech Solutions</h1>
                    <p>Разработка ПО и AI-решения</p>
                </div>
            </div>
            <button class="add-vacancy-btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                </svg>
                Добавить вакансию
            </button>
        </div>

        <div class="about-section">
            <div class="content-card fade-in">
                <h2 class="section-title">О компании</h2>
                <p class="about-text">
                    Мы — ведущая технологическая компания, специализирующаяся на разработке сложных системных решений для финансового сектора и ритейла. Наша миссия заключается в трансформации традиционного бизнеса через внедрение передовых алгоритмов машинного обучения и облачных инфраструктур.
                </p>
                <br>
                <p class="about-text">
                    С 2012 года мы выросли из небольшого стартапа до международного холдинга с 500+ экспертиз. Мы ценим свежий взгляд и инновационный подход, поэтому активно развиваем программы стажировок и практики для талантливых студентов.
                </p>
            </div>

            <div class="stats-card fade-in">
                <div class="stat-item">
                    <div class="stat-icon">
                        <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <div>
                        <div class="stat-value" data-target="500">500+</div>
                        <div class="stat-label">сотрудников</div>
                    </div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon">
                        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                    </div>
                    <div>
                        <div class="stat-value" data-target="12">12</div>
                        <div class="stat-label">стран присутствия</div>
                    </div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon">
                        <svg viewBox="0 0 24 24"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                    </div>
                    <div>
                        <div class="stat-value" data-target="150">150+</div>
                        <div class="stat-label">выпускников практик</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ADVANTAGES -->
        <div class="advantages-section fade-in">
            <h2 class="section-title">Наши преимущества для стажёров</h2>
            <div class="advantages-grid">
                <div class="advantage-card">
                    <div class="advantage-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
                        </svg>
                    </div>
                    <div class="advantage-title">Быстрый старт</div>
                    <div class="advantage-desc">Реальные задачи с первого дня и полное погружение в производственный цикл разработки продукта.</div>
                </div>
                <div class="advantage-card">
                    <div class="advantage-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 20V10"/><path d="M18 20V4"/><path d="M6 20v-4"/>
                        </svg>
                    </div>
                    <div class="advantage-title">Менторство</div>
                    <div class="advantage-desc">За каждым стажёром закрепляется Senior-специалист для регулярных созвонов и карьерных консультаций.</div>
                </div>
                <div class="advantage-card">
                    <div class="advantage-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 8h1a4 4 0 0 1 0 8h-1"/><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/><line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/>
                        </svg>
                    </div>
                    <div class="advantage-title">Культура и быт</div>
                    <div class="advantage-desc">Современный офис в центре города, гибкий график, бесплатные обеды и доступ к корпоративной библиотеке.</div>
                </div>
            </div>
        </div>

        <div class="vacancies-section fade-in">
            <div class="vacancies-header">
                <h2 class="section-title">Активные вакансии практики</h2>
                <span class="vacancies-badge">3 активно</span>
            </div>
            <div class="vacancies-grid">
                <div class="vacancy-card">
                    <div class="vacancy-top">
                        <span class="vacancy-type type-remote">REMOTE</span>
                        <div class="vacancy-bookmark tooltip-wrapper" onclick="toggleBookmark(this)">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/>
                            </svg>
                            <span class="tooltip-text">Сохранить</span>
                        </div>
                    </div>
                    <div class="vacancy-title">Frontend Developer Intern (React)</div>
                    <div class="vacancy-desc">Разработка пользовательских интерфейсов для платформы анализа больших данных.</div>
                    <div class="vacancy-tags">
                        <span class="vacancy-tag">React</span>
                        <span class="vacancy-tag">TypeScript</span>
                        <span class="vacancy-tag">Redux</span>
                    </div>
                    <div class="vacancy-footer">
                        <span class="vacancy-format">Онлайн</span>
                        <a href="#" class="vacancy-detail-link">
                            Детали
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="vacancy-card">
                    <div class="vacancy-top">
                        <span class="vacancy-type type-office">OFFICE</span>
                        <div class="vacancy-bookmark tooltip-wrapper" onclick="toggleBookmark(this)">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/>
                            </svg>
                            <span class="tooltip-text">Сохранить</span>
                        </div>
                    </div>
                    <div class="vacancy-title">QA Automation Intern (Python)</div>
                    <div class="vacancy-desc">Автоматизация тестирования API и UI компонентов банковского приложения.</div>
                    <div class="vacancy-tags">
                        <span class="vacancy-tag">Python</span>
                        <span class="vacancy-tag">Pytest</span>
                        <span class="vacancy-tag">Selenium</span>
                    </div>
                    <div class="vacancy-footer">
                        <span class="vacancy-format">Оплачиваемая</span>
                        <a href="#" class="vacancy-detail-link">
                            Детали
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="vacancy-card">
                    <div class="vacancy-top">
                        <span class="vacancy-type type-hybrid">HYBRID</span>
                        <div class="vacancy-bookmark tooltip-wrapper" onclick="toggleBookmark(this)">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/>
                            </svg>
                            <span class="tooltip-text">Сохранить</span>
                        </div>
                    </div>
                    <div class="vacancy-title">UI/UX Designer Trainee</div>
                    <div class="vacancy-desc">Создание прототипов и работа над дизайн-системой внутренних сервисов компании.</div>
                    <div class="vacancy-tags">
                        <span class="vacancy-tag">Figma</span>
                        <span class="vacancy-tag">UI/UX</span>
                        <span class="vacancy-tag">Prototyping</span>
                    </div>
                    <div class="vacancy-footer">
                        <span class="vacancy-format">Практика</span>
                        <a href="#" class="vacancy-detail-link">
                            Детали
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="bottom-section">
            <div class="fade-in">
                <h2 class="section-title-large">Галерея офиса</h2>
                <div class="gallery-grid">
                    <div class="gallery-item">
                        <div class="gallery-placeholder gallery-placeholder-1">🏢</div>
                    </div>
                    <div class="gallery-item">
                        <div class="gallery-placeholder gallery-placeholder-2">🛋️</div>
                    </div>
                    <div class="gallery-item">
                        <div class="gallery-placeholder gallery-placeholder-3"></div>
                    </div>
                </div>
            </div>

            <div class="fade-in">
                <h2 class="section-title-large">Контакты HR</h2>
                <div class="hr-card">
                    <div class="hr-person">
                        <div class="hr-avatar">
                            <svg viewBox="0 0 24 24" fill="white" width="28" height="28">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="hr-name">Анна Петрова</div>
                            <div class="hr-role">Head of Talent Acquisition</div>
                        </div>
                    </div>
                    <div class="hr-contact-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/>
                        </svg>
                        hr@globaltech.com
                    </div>
                    <div class="hr-contact-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                        </svg>
                        +7 (900) 123-45-67
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-inner">
            <div class="footer-brand">
                <div class="footer-brand-name">Практикум</div>
                <div class="footer-brand-desc">Платформа для развития карьерного потенциала и связи образования с бизнесом.</div>
            </div>
            <div class="footer-links">
                <div>
                    <div class="footer-col-title">Ресурс</div>
                    <div class="footer-col">
                        <a href="#">О платформе</a>
                        <a href="#">Центр помощи</a>
                    </div>
                </div>
                <div>
                    <div class="footer-col-title">Компания</div>
                    <div class="footer-col">
                        <a href="#">Карьера</a>
                        <a href="#">Партнёрам</a>
                    </div>
                </div>
                <div>
                    <div class="footer-col-title">Право</div>
                    <div class="footer-col">
                        <a href="#">Конфиденциальность</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>

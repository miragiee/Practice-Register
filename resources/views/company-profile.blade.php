<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль студента — Практикум</title>
    @vite([
        'resources/css/company-profile.css', 'resources/js/company-profile.js'
    ])
</head>
<body>

    <header class="header">
        <div class="header-logo">Практикум</div>
        <nav class="header-nav">
            <a href="#">Студентам</a>
            <a href="#">Университетам</a>
            <a href="#">Компаниям</a>
            <a href="#">Тарифы</a>
        </nav>
    </header>

    <div class="main-container">
        <aside class="sidebar">
            <div class="profile-card fade-in">
                <div class="avatar-wrapper">
                    <div class="avatar">
                        <svg viewBox="0 0 24 24" fill="white" width="48" height="48">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    </div>
                    <div class="verified-badge">
                        <svg viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                    </div>
                </div>
                <div class="profile-name">Алексей Иванов</div>
                <div class="profile-university">
                    МГУ им. М.В. Ломоносова
                    <span class="university-verified">
                        <svg viewBox="0 0 16 16" fill="currentColor" width="14" height="14">
                            <path d="M8 0a8 8 0 100 16A8 8 0 008 0zm3.5 6.5l-4 4a.75.75 0 01-1.06 0L4.5 8.56l.71-.7 1.29 1.29 3.29-3.35.71.7z"/>
                        </svg>
                    </span>
                </div>
                <div class="profile-status">3 курс • Факультет ВМК</div>
            </div>

            <div class="menu-list fade-in">
                <div class="menu-item active">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                    </svg>
                    Профиль
                </div>
                <div class="menu-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/>
                    </svg>
                    Мои отклики
                </div>
                <div class="menu-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/>
                    </svg>
                    Настройки
                </div>
            </div>

            <button class="edit-btn fade-in">Редактировать</button>

            <div class="contacts-card fade-in">
                <div class="card-title">Контакты</div>
                <div class="contact-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/>
                    </svg>
                    a.ivanov@edu.msu.ru
                </div>
                <div class="contact-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                    </svg>
                    +7 (900) 123-45-67
                </div>
                <div class="contact-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>
                    </svg>
                    Москва, Россия
                </div>
            </div>

            <div class="university-card fade-in">
                <div class="card-title">Мой Университет</div>
                <div class="university-status">
                    <span class="status-dot"></span>
                    Подтверждён вузом
                </div>
                <a href="#" class="university-link">
                    Страница вуза
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9 18 15 12 9 6"/>
                    </svg>
                </a>
            </div>
        </aside>

        <main class="content">

            <div class="content-card fade-in">
                <h2 class="section-title">О себе</h2>
                <p class="about-text">
                    Студент 3-го курса ВМК МГУ, специализируюсь на анализе данных и машинном обучении. Активно участвую в хакатонах и исследовательских проектах кафедры. Ищу возможности для стажировок в финтех-компаниях, где смогу применить свои знания Python и SQL для решения реальных бизнес-задач. Свободно владею английским языком и увлекаюсь спортивным программированием.
                </p>
            </div>

            <div class="content-card fade-in">
                <h2 class="section-title">Навыки</h2>
                <div class="skills-list">
                    <span class="skill-tag skill-blue">Python</span>
                    <span class="skill-tag skill-blue">Data Analysis</span>
                    <span class="skill-tag skill-blue">Machine Learning</span>
                    <span class="skill-tag skill-blue">SQL</span>
                    <span class="skill-tag skill-blue">PyTorch</span>
                    <span class="skill-tag skill-green">Git</span>
                    <span class="skill-tag skill-orange">Tableau</span>
                    <span class="skill-tag skill-orange">English C1</span>
                </div>
            </div>

            <div class="content-card fade-in">
                <h2 class="section-title">Опыт</h2>

                <div class="experience-item">
                    <div class="timeline-dot"></div>
                    <div class="experience-info">
                        <div class="experience-header">
                            <span class="experience-role">Стажёр Data Scientist</span>
                            <span class="experience-date">ИЮЛЬ 202 — АВГУСТ 2024</span>
                        </div>
                        <div class="experience-company">Яндекс.Поиск</div>
                        <p class="experience-desc">
                            Участвовал в разработке алгоритмов ранжирования поисковой выдачи. Оптимизировал скрипты предобработки данных, что позволило сократить время обучения моделей на 15%. Работал в команде из 12 человек в рамках летней стажировки.
                        </p>
                    </div>
                </div>

                <div class="experience-item">
                    <div class="timeline-dot secondary"></div>
                    <div class="experience-info">
                        <div class="experience-header">
                            <span class="experience-role">Лаборант-исследователь</span>
                            <span class="experience-date">ЯНВАРЬ 2026 — МАЙ 2026</span>
                        </div>
                        <div class="experience-company">НИИ Системных Исследований РАН</div>
                        <p class="experience-desc">
                            Ассистировал в проведении численных экспериментов для моделирования газодинамических процессов. Занимался визуализацией результатов исследований с использованием Matplotlib и Plotly.
                        </p>
                    </div>
                </div>
            </div>

            <div class="content-card fade-in">
                <h2 class="section-title">Документы</h2>
                <div class="documents-grid">
                    <div class="doc-item">
                        <div class="doc-icon doc-icon-pdf">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zm-1 2l5 5h-5V4zM8.5 13.5v1.5H11v-1.5H8.5zm0 3v1.5H11v-1.5H8.5zM12 12h4v1h-4v-1zm0 3h4v1h-4v-1z"/>
                            </svg>
                        </div>
                        <div class="doc-details">
                            <div class="doc-name">Резюме_Иванов_DS.pdf</div>
                            <div class="doc-meta">PDF • 1.2 MB</div>
                        </div>
                        <div class="doc-download">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/>
                            </svg>
                        </div>
                    </div>

                    <div class="doc-item">
                        <div class="doc-icon doc-icon-zip">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/>
                            </svg>
                        </div>
                        <div class="doc-details">
                            <div class="doc-name">Портфолио_Проекты.zip</div>
                            <div class="doc-meta">ZIP • 45 MB</div>
                        </div>
                        <div class="doc-download">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <footer class="footer">
        <div class="footer-inner">
            <div class="footer-brand">
                <div class="footer-brand-name">Практикум</div>
                <div class="footer-brand-desc">© 2026 Практикум. Платформа для развития карьерного потенциала.</div>
            </div>
            <div class="footer-links">
                <div class="footer-col">
                    <a href="#">О платформе</a>
                    <a href="#">Карьера</a>
                    <a href="#">Конфиденциальность</a>
                </div>
                <div class="footer-col">
                    <a href="#">Центр помощи</a>
                    <a href="#">Партнёрам</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Global Tech Solutions — Практикум</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f2f0eb;
            color: #333;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .header {
            background-color: #2c2c2e;
            padding: 0 40px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-logo {
            font-size: 20px;
            font-weight: 700;
            color: #0f66be;
            letter-spacing: -0.3px;
            cursor: pointer;
            transition: opacity 0.2s ease;
        }

        .header-logo:hover {
            opacity: 0.8;
        }

        .header-nav {
            display: flex;
            gap: 32px;
        }

        .header-nav a {
            color: #ccc;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            padding: 6px 0;
            position: relative;
            transition: color 0.25s ease;
        }

        .header-nav a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: #fff;
            transition: width 0.3s ease;
        }

        .header-nav a:hover {
            color: #fff;
        }

        .header-nav a:hover::after {
            width: 100%;
        }

        .header-nav a.active {
            color: #fff;
        }

        .header-nav a.active::after {
            width: 100%;
        }

        .main-container {
            flex: 1;
            max-width: 1200px;
            width: 100%;
            margin: 32px auto;
            padding: 0 32px;
        }

        .company-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .company-header-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .company-logo {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            background: linear-gradient(135deg, #4A6CF7, #7c3aed);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .company-logo:hover {
            transform: scale(1.08) rotate(5deg);
            box-shadow: 0 4px 16px rgba(74, 108, 247, 0.4);
        }

        .company-logo svg {
            width: 32px;
            height: 32px;
            fill: #fff;
        }

        .company-info h1 {
            font-size: 24px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 2px;
        }

        .company-info p {
            font-size: 14px;
            color: #777;
        }

        .add-vacancy-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 12px;
            padding: 12px 20px;
            font-size: 14px;
            font-weight: 500;
            color: #333;
            cursor: pointer;
            transition: all 0.25s ease;
        }

        .add-vacancy-btn:hover {
            border-color: #4A6CF7;
            color: #4A6CF7;
            box-shadow: 0 2px 12px rgba(74, 108, 247, 0.15);
            transform: translateY(-2px);
        }

        .add-vacancy-btn:active {
            transform: translateY(0);
        }

        .add-vacancy-btn svg {
            width: 18px;
            height: 18px;
            transition: transform 0.3s ease;
        }

        .add-vacancy-btn:hover svg {
            transform: rotate(90deg);
        }

        .about-section {
            display: grid;
            grid-template-columns: 1fr 320px;
            gap: 20px;
            margin-bottom: 40px;
        }

        .content-card {
            background: #fff;
            border-radius: 16px;
            padding: 28px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.06);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .content-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(0,0,0,0.1);
        }

        .section-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 14px;
            color: #1a1a1a;
        }

        .about-text {
            font-size: 14px;
            line-height: 1.7;
            color: #666;
        }

        .stats-card {
            background: linear-gradient(135deg, #4A6CF7, #6366f1);
            border-radius: 16px;
            padding: 28px;
            color: #fff;
            display: flex;
            flex-direction: column;
            gap: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(74, 108, 247, 0.35);
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 4px 0;
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.2);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: background 0.25s ease, transform 0.25s ease;
        }

        .stat-item:hover .stat-icon {
            background: rgba(255,255,255,0.3);
            transform: scale(1.1);
        }

        .stat-icon svg {
            width: 20px;
            height: 20px;
            fill: #fff;
        }

        .stat-value {
            font-size: 22px;
            font-weight: 700;
        }

        .stat-label {
            font-size: 12px;
            opacity: 0.85;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .advantages-section {
            margin-bottom: 40px;
        }

        .advantages-section > .section-title {
            margin-bottom: 16px;
        }

        .advantages-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        .advantage-card {
            background: #fff;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.06);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: default;
        }

        .advantage-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        }

        .advantage-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: #f0f4ff;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            transition: transform 0.3s ease, background 0.3s ease;
        }

        .advantage-card:hover .advantage-icon {
            transform: scale(1.1) rotate(5deg);
            background: #e0e8ff;
        }

        .advantage-icon svg {
            width: 24px;
            height: 24px;
            color: #4A6CF7;
        }

        .advantage-title {
            font-size: 15px;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 6px;
        }

        .advantage-desc {
            font-size: 13px;
            color: #888;
            line-height: 1.5;
        }

        .vacancies-section {
            margin-bottom: 40px;
        }

        .vacancies-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .vacancies-header > .section-title {
            margin-bottom: 0;
        }

        .vacancies-badge {
            background: #fff3e0;
            color: #E65100;
            font-size: 13px;
            font-weight: 600;
            padding: 6px 16px;
            border-radius: 20px;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .vacancies-badge:hover {
            transform: scale(1.05);
            box-shadow: 0 2px 8px rgba(230, 81, 0, 0.2);
        }

        .vacancies-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        .vacancy-card {
            background: #fff;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.06);
            transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
            border: 1px solid transparent;
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: hidden;
        }

        .vacancy-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #4A6CF7, #6366f1);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }

        .vacancy-card:hover::before {
            transform: scaleX(1);
        }

        .vacancy-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
            border-color: #e0e8ff;
        }

        .vacancy-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
        }

        .vacancy-type {
            font-size: 11px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 6px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .type-remote {
            background: #e8eeff;
            color: #4A6CF7;
        }

        .type-office {
            background: #f0f0f0;
            color: #666;
        }

        .type-hybrid {
            background: #e0f2f1;
            color: #00695C;
        }

        .vacancy-bookmark {
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #ccc;
            transition: color 0.2s ease, transform 0.2s ease;
        }

        .vacancy-bookmark:hover {
            color: #E65100;
            transform: scale(1.15);
        }

        .vacancy-bookmark.bookmarked {
            color: #E65100;
        }

        .vacancy-bookmark svg {
            width: 18px;
            height: 18px;
        }

        .vacancy-title {
            font-size: 16px;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 8px;
            transition: color 0.2s ease;
        }

        .vacancy-card:hover .vacancy-title {
            color: #4A6CF7;
        }

        .vacancy-desc {
            font-size: 13px;
            color: #888;
            line-height: 1.5;
            margin-bottom: 16px;
            flex: 1;
        }

        .vacancy-tags {
            display: flex;
            gap: 6px;
            margin-bottom: 16px;
            flex-wrap: wrap;
        }

        .vacancy-tag {
            font-size: 12px;
            padding: 4px 10px;
            border-radius: 6px;
            background: #f5f5f5;
            color: #666;
            transition: background 0.2s ease, color 0.2s ease;
        }

        .vacancy-card:hover .vacancy-tag {
            background: #f0f4ff;
            color: #4A6CF7;
        }

        .vacancy-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 12px;
            border-top: 1px solid #f0f0f0;
        }

        .vacancy-format {
            font-size: 13px;
            font-weight: 500;
            color: #4A6CF7;
            transition: color 0.2s ease;
        }

        .vacancy-detail-link {
            font-size: 13px;
            font-weight: 500;
            color: #4A6CF7;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 4px;
            transition: gap 0.25s ease, color 0.2s ease;
        }

        .vacancy-detail-link:hover {
            gap: 8px;
        }

        .vacancy-detail-link svg {
            width: 14px;
            height: 14px;
            transition: transform 0.2s ease;
        }

        .vacancy-card:hover .vacancy-detail-link svg {
            transform: translateX(2px);
        }

        .bottom-section {
            display: grid;
            grid-template-columns: 1fr 360px;
            gap: 20px;
            margin-bottom: 40px;
        }

        .section-title-large {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 16px;
            color: #1a1a1a;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }

        .gallery-item {
            border-radius: 12px;
            overflow: hidden;
            aspect-ratio: 4/3;
            position: relative;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .gallery-item:hover {
            transform: scale(1.03);
            box-shadow: 0 8px 24px rgba(0,0,0,0.2);
        }

        .gallery-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .gallery-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            transition: transform 0.3s ease;
        }

        .gallery-item:hover .gallery-placeholder {
            transform: scale(1.1);
        }

        .gallery-placeholder-1 {
            background: linear-gradient(135deg, #a8c0ff, #3f2b96);
        }

        .gallery-placeholder-2 {
            background: linear-gradient(135deg, #f5af19, #f12711);
        }

        .gallery-placeholder-3 {
            background: linear-gradient(135deg, #00c6ff, #0072ff);
        }

        .hr-card {
            background: #fff;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.06);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hr-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
        }

        .hr-person {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 20px;
        }

        .hr-avatar {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: linear-gradient(135deg, #f093fb, #f5576c);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: #fff;
            flex-shrink: 0;
            transition: transform 0.3s ease;
        }

        .hr-person:hover .hr-avatar {
            transform: scale(1.1);
        }

        .hr-name {
            font-size: 16px;
            font-weight: 600;
            color: #1a1a1a;
        }

        .hr-role {
            font-size: 13px;
            color: #999;
        }

        .hr-contact-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 0;
            font-size: 13px;
            color: #666;
            cursor: pointer;
            transition: color 0.2s ease, transform 0.2s ease;
        }

        .hr-contact-item:hover {
            color: #4A6CF7;
            transform: translateX(4px);
        }

        .hr-contact-item svg {
            width: 16px;
            height: 16px;
            color: #999;
            flex-shrink: 0;
            transition: color 0.2s ease;
        }

        .hr-contact-item:hover svg {
            color: #4A6CF7;
        }

        .footer {
            background: #1a1a1a;
            color: #999;
            padding: 40px;
            margin-top: auto;
        }

        .footer-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .footer-brand {
            max-width: 360px;
        }

        .footer-brand-name {
            font-size: 18px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 8px;
        }

        .footer-brand-desc {
            font-size: 13px;
            line-height: 1.6;
            color: #777;
        }

        .footer-links {
            display: flex;
            gap: 60px;
        }

        .footer-col-title {
            font-size: 13px;
            font-weight: 600;
            color: #fff;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .footer-col a {
            display: block;
            color: #777;
            text-decoration: none;
            font-size: 13px;
            padding: 4px 0;
            transition: color 0.2s ease, transform 0.2s ease;
        }

        .footer-col a:hover {
            color: #fff;
            transform: translateX(3px);
        }

        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.5s ease forwards;
        }

        .fade-in:nth-child(1) { animation-delay: 0.05s; }
        .fade-in:nth-child(2) { animation-delay: 0.1s; }
        .fade-in:nth-child(3) { animation-delay: 0.15s; }
        .fade-in:nth-child(4) { animation-delay: 0.2s; }
        .fade-in:nth-child(5) { animation-delay: 0.25s; }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 900px) {
            .about-section {
                grid-template-columns: 1fr;
            }

            .advantages-grid {
                grid-template-columns: 1fr;
            }

            .vacancies-grid {
                grid-template-columns: 1fr;
            }

            .bottom-section {
                grid-template-columns: 1fr;
            }

            .footer-inner {
                flex-direction: column;
                gap: 24px;
            }
        }

        .header {
            transition: box-shadow 0.3s ease;
        }

        .stat-value {
            display: inline-block;
        }

        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }

        .tooltip-wrapper {
            position: relative;
        }

        .tooltip-wrapper .tooltip-text {
            visibility: hidden;
            opacity: 0;
            background: #333;
            color: #fff;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 12px;
            position: absolute;
            bottom: calc(100% + 8px);
            left: 50%;
            transform: translateX(-50%) translateY(4px);
            white-space: nowrap;
            transition: opacity 0.2s ease, transform 0.2s ease, visibility 0.2s ease;
            z-index: 10;
        }

        .tooltip-wrapper:hover .tooltip-text {
            visibility: visible;
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }

        .vacancy-card:active {
            transform: translateY(-2px) scale(0.98);
        }
    </style>
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

    <script>
        window.addEventListener('scroll', () => {
            const header = document.querySelector('.header');
            if (window.scrollY > 10) {
                header.style.boxShadow = '0 2px 20px rgba(0,0,0,0.15)';
            } else {
                header.style.boxShadow = 'none';
            }
        });

        function toggleBookmark(el) {
            el.classList.toggle('bookmarked');
            const svg = el.querySelector('svg');
            if (el.classList.contains('bookmarked')) {
                svg.setAttribute('fill', '#E65100');
                // Add pop animation
                el.style.transform = 'scale(1.3)';
                setTimeout(() => {
                    el.style.transform = 'scale(1)';
                }, 200);
            } else {
                svg.setAttribute('fill', 'none');
            }
        }

        function animateCounters() {
            document.querySelectorAll('.stat-value[data-target]').forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target'));
                const duration = 1500;
                const startTime = performance.now();
                const suffix = counter.textContent.includes('+') ? '+' : '';

                function updateCounter(currentTime) {
                    const elapsed = currentTime - startTime;
                    const progress = Math.min(elapsed / duration, 1);

                    const eased = 1 - Math.pow(1 - progress, 3);
                    const current = Math.floor(eased * target);

                    counter.textContent = current + suffix;

                    if (progress < 1) {
                        requestAnimationFrame(updateCounter);
                    }
                }

                requestAnimationFrame(updateCounter);
            });
        }

        setTimeout(animateCounters, 300);

        document.querySelector('.add-vacancy-btn').addEventListener('click', function() {
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
        });

        document.querySelectorAll('.gallery-item').forEach(item => {
            item.addEventListener('click', function() {
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 200);
            });
        });

        document.querySelectorAll('.vacancy-card').forEach(card => {
            card.addEventListener('click', function(e) {
                if (e.target.closest('.vacancy-bookmark') || e.target.closest('.vacancy-detail-link')) return;

                this.style.transform = 'translateY(-2px) scale(0.98)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 200);
            });
        });

        const statsCard = document.querySelector('.stats-card');
        statsCard.addEventListener('mousemove', (e) => {
            const rect = statsCard.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            const rotateX = (y - centerY) / 15;
            const rotateY = (centerX - x) / 15;

            statsCard.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-3px)`;
        });

        statsCard.addEventListener('mouseleave', () => {
            statsCard.style.transform = '';
        });

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.fade-in').forEach(el => {
            el.style.animationPlayState = 'running';
        });

        document.querySelectorAll('.advantage-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                const icon = this.querySelector('.advantage-icon svg');
                icon.style.color = '#fff';
                this.querySelector('.advantage-icon').style.background = '#4A6CF7';
            });
            card.addEventListener('mouseleave', function() {
                const icon = this.querySelector('.advantage-icon svg');
                icon.style.color = '#4A6CF7';
                this.querySelector('.advantage-icon').style.background = '#f0f4ff';
            });
        });

        document.querySelectorAll('.header-nav a, .footer-col a, .vacancy-detail-link').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
            });
        });
    </script>
</body>
</html>
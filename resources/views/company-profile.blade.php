<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль студента — Практикум</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f3f0;
            color: #333;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .header {
            background-color: #18181a;
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
            color: #145aaf;
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
            color: #ded1d1;
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

        .main-container {
            flex: 1;
            max-width: 1200px;
            width: 100%;
            margin: 32px auto;
            padding: 0 32px;
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 24px;
            align-items: start;
        }

        .sidebar {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .profile-card {
            background: #fff;
            border-radius: 16px;
            padding: 28px 24px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.06);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .profile-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(0,0,0,0.1);
        }

        .avatar-wrapper {
            position: relative;
            width: 100px;
            height: 100px;
            margin: 0 auto 16px;
        }

        .avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            color: #fff;
            cursor: pointer;
            transition: transform 0.3s ease, filter 0.3s ease;
        }

        .avatar:hover {
            transform: scale(1.05);
            filter: brightness(1.05);
        }

        .verified-badge {
            position: absolute;
            bottom: 2px;
            right: 2px;
            width: 24px;
            height: 24px;
            background: #4A90D9;
            border-radius: 50%;
            border: 3px solid #fff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .verified-badge svg {
            width: 12px;
            height: 12px;
            fill: #fff;
        }

        .profile-name {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .profile-university {
            font-size: 13px;
            color: #777;
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
        }

        .university-verified {
            color: #4A90D9;
            display: inline-flex;
        }

        .profile-status {
            font-size: 12px;
            color: #999;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .menu-list {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.06);
            overflow: hidden;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 20px;
            cursor: pointer;
            transition: background 0.2s ease, padding-left 0.2s ease;
            border-bottom: 1px solid #f0f0f0;
            font-size: 14px;
            color: #555;
        }

        .menu-item:last-child {
            border-bottom: none;
        }

        .menu-item:hover {
            background: #f8f8f8;
            padding-left: 26px;
        }

        .menu-item.active {
            background: #f0f4ff;
            color: #4A6CF7;
            font-weight: 500;
        }

        .menu-item.active:hover {
            padding-left: 26px;
            background: #e8eeff;
        }

        .menu-item svg {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
            transition: transform 0.2s ease;
        }

        .menu-item:hover svg {
            transform: scale(1.1);
        }

        .edit-btn {
            background: linear-gradient(135deg, #4A6CF7, #6366f1);
            color: #fff;
            border: none;
            border-radius: 12px;
            padding: 14px 24px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.25s ease, box-shadow 0.25s ease, filter 0.25s ease;
            box-shadow: 0 2px 8px rgba(74, 108, 247, 0.3);
        }

        .edit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(74, 108, 247, 0.4);
            filter: brightness(1.08);
        }

        .edit-btn:active {
            transform: translateY(0);
            box-shadow: 0 2px 8px rgba(74, 108, 247, 0.3);
        }

        .contacts-card,
        .university-card {
            background: #fff;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.06);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .contacts-card:hover,
        .university-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(0,0,0,0.1);
        }

        .card-title {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 12px;
            color: #333;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            color: #666;
            padding: 6px 0;
            transition: color 0.2s ease, transform 0.2s ease;
            cursor: pointer;
        }

        .contact-item:hover {
            color: #4A6CF7;
            transform: translateX(4px);
        }

        .contact-item svg {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
            color: #999;
            transition: color 0.2s ease;
        }

        .contact-item:hover svg {
            color: #4A6CF7;
        }

        .university-status {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: #555;
            margin-bottom: 8px;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #4CAF50;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .university-link {
            font-size: 13px;
            color: #4A6CF7;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 6px 0;
            transition: color 0.2s ease;
        }

        .university-link:hover {
            color: #3451c7;
        }

        .university-link svg {
            width: 16px;
            height: 16px;
            transition: transform 0.2s ease;
        }

        .university-link:hover svg {
            transform: translateX(3px);
        }

        .content {
            display: flex;
            flex-direction: column;
            gap: 20px;
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
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 14px;
            color: #1a1a1a;
        }

        .about-text {
            font-size: 14px;
            line-height: 1.7;
            color: #666;
        }

        .skills-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .skill-tag {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
            cursor: default;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            user-select: none;
        }

        .skill-tag:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 3px 10px rgba(0,0,0,0.12);
        }

        .skill-blue {
            background: #e8eeff;
            color: #E65100;
        }

        .skill-orange {
            background: #fff3e0;
            color: #E65100;
        }

        .skill-green {
            background: #e8f5e9;
            color: #E65100;
        }

        .skill-purple {
            background: #f3e5f5;
            color: #E65100;
        }

        .skill-teal {
            background: #e0f2f1;
            color: #E65100;
        }

        .skill-red {
            background: #fce4ec;
            color: #E65100;
        }

        .experience-item {
            display: flex;
            gap: 16px;
            padding: 16px 0;
            position: relative;
            transition: background 0.2s ease;
            border-radius: 12px;
            padding-left: 16px;
            padding-right: 16px;
            margin: 0 -16px;
        }

        .experience-item:hover {
            background: #fafafa;
        }

        .timeline-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #4A6CF7;
            flex-shrink: 0;
            margin-top: 6px;
            position: relative;
            z-index: 1;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .experience-item:hover .timeline-dot {
            transform: scale(1.3);
            box-shadow: 0 0 0 4px rgba(74, 108, 247, 0.15);
        }

        .timeline-dot.secondary {
            background: #ccc;
        }

        .experience-item:hover .timeline-dot.secondary {
            box-shadow: 0 0 0 4px rgba(0,0,0,0.08);
        }

        .experience-info {
            flex: 1;
        }

        .experience-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 6px;
        }

        .experience-role {
            font-size: 16px;
            font-weight: 600;
            color: #1a1a1a;
        }

        .experience-date {
            font-size: 12px;
            color: #999;
            background: #f5f5f5;
            padding: 4px 10px;
            border-radius: 8px;
            white-space: nowrap;
        }

        .experience-company {
            font-size: 13px;
            color: #4A6CF7;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .experience-desc {
            font-size: 13px;
            color: #888;
            line-height: 1.6;
        }

        .documents-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .doc-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 16px;
            border: 1px solid #eee;
            border-radius: 12px;
            cursor: pointer;
            transition: border-color 0.25s ease, background 0.25s ease, transform 0.25s ease, box-shadow 0.25s ease;
        }

        .doc-item:hover {
            border-color: #4A6CF7;
            background: #fafbff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(74, 108, 247, 0.1);
        }

        .doc-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: transform 0.25s ease;
        }

        .doc-item:hover .doc-icon {
            transform: scale(1.1);
        }

        .doc-icon-pdf {
            background: #fce4ec;
            color: #C62828;
        }

        .doc-icon-zip {
            background: #e3f2fd;
            color: #1565C0;
        }

        .doc-icon svg {
            width: 22px;
            height: 22px;
        }

        .doc-details {
            flex: 1;
            min-width: 0;
        }

        .doc-name {
            font-size: 14px;
            font-weight: 500;
            color: #333;
            margin-bottom: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .doc-meta {
            font-size: 12px;
            color: #999;
        }

        .doc-download {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #999;
            transition: color 0.2s ease, background 0.2s ease;
            flex-shrink: 0;
        }

        .doc-download:hover {
            color: #4A6CF7;
            background: #f0f4ff;
        }

        .doc-download svg {
            width: 18px;
            height: 18px;
        }

        .footer {
            background: #1a1a1a;
            color: #999;
            padding: 40px 40px;
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

        @media (max-width: 768px) {
            .main-container {
                grid-template-columns: 1fr;
                padding: 0 16px;
            }

            .header {
                padding: 0 16px;
            }

            .header-nav {
                gap: 16px;
            }

            .documents-grid {
                grid-template-columns: 1fr;
            }

            .footer-inner {
                flex-direction: column;
                gap: 24px;
            }
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

        .sidebar .fade-in:nth-child(1) { animation-delay: 0.05s; }
        .sidebar .fade-in:nth-child(2) { animation-delay: 0.1s; }
        .sidebar .fade-in:nth-child(3) { animation-delay: 0.15s; }
        .sidebar .fade-in:nth-child(4) { animation-delay: 0.2s; }
        .sidebar .fade-in:nth-child(5) { animation-delay: 0.25s; }

        .skill-tag::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255,255,255,0.3);
            transform: translate(-50%, -50%);
            transition: width 0.4s ease, height 0.4s ease;
        }

        .skill-tag {
            position: relative;
            overflow: hidden;
        }

        .tooltip {
            position: relative;
        }

        .tooltip::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: calc(100% + 8px);
            left: 50%;
            transform: translateX(-50%) translateY(4px);
            background: #333;
            color: #fff;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 12px;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s ease, transform 0.2s ease;
        }

        .tooltip:hover::after {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }
    </style>
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

    <script>
        document.querySelectorAll('.header-nav a, .footer-col a').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
            });
        });

        const editBtn = document.querySelector('.edit-btn');
        editBtn.addEventListener('click', function() {
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
        });

        document.querySelectorAll('.menu-item').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.menu-item').forEach(i => i.classList.remove('active'));
                this.classList.add('active');
            });
        });

        document.querySelectorAll('.doc-item').forEach(doc => {
            doc.addEventListener('click', function() {
                this.style.transform = 'scale(0.98)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
            });
        });

        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);


        document.querySelectorAll('.fade-in').forEach(el => {
            el.style.animationPlayState = 'running';
            // observer.observe(el); // Uncomment if you want scroll-triggered animations
        });

        const profileCard = document.querySelector('.profile-card');
        profileCard.addEventListener('mousemove', (e) => {
            const rect = profileCard.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            const rotateX = (y - centerY) / 20;
            const rotateY = (centerX - x) / 20;

            profileCard.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-2px)`;
        });

        profileCard.addEventListener('mouseleave', () => {
            profileCard.style.transform = '';
        });

        const skillColors = [
            { bg: '#e8eeff', color: '#4A6CF7' },
            { bg: '#fff3e0', color: '#E65100' },
            { bg: '#e8f5e9', color: '#2E7D32' },
            { bg: '#f3e5f5', color: '#7B1FA2' },
            { bg: '#e0f2f1', color: '#00695C' },
            { bg: '#fce4ec', color: '#C62828' },
            { bg: '#e3f2fd', color: '#1565C0' },
            { bg: '#fff8e1', color: '#F57F17' },
        ];

        document.querySelectorAll('.skill-tag').forEach(tag => {
            tag.addEventListener('mouseenter', function() {
                const randomColor = skillColors[Math.floor(Math.random() * skillColors.length)];
                this.style.background = randomColor.bg;
                this.style.color = randomColor.color;
            });

            tag.addEventListener('mouseleave', function() {
                this.style.background = '';
                this.style.color = '';
            });
        });

        window.addEventListener('scroll', () => {
            const header = document.querySelector('.header');
            if (window.scrollY > 10) {
                header.style.boxShadow = '0 2px 20px rgba(0,0,0,0.15)';
            } else {
                header.style.boxShadow = 'none';
            }
        });
    </script>
</body>
</html>
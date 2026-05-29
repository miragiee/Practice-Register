<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Детали заявки</title>

    @vite([
        'resources/css/company-request.css',
        'resources/js/company-request.js'
    ])

    <style>
        body {
            background: linear-gradient(180deg, #f8f9fd 0%, #ffffff 100%);
        }

        .detail-shell {
            max-width: 880px;
            margin: 24px auto 36px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .detail-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 20px;
            background: white;
            border-radius: 26px;
            border: 1px solid #e6e8f0;
            box-shadow: 0 12px 30px rgba(45, 74, 192, 0.08);
            padding: 28px;
        }

        .detail-title h1 {
            margin: 0 0 10px;
            font-size: 30px;
            color: #111827;
        }

        .detail-subtitle {
            margin: 0;
            color: #6b7280;
            line-height: 1.5;
        }

        .detail-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .detail-meta span {
            border-radius: 999px;
            background: #eef2ff;
            color: #4a6cf7;
            padding: 8px 12px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .detail-card {
            background: white;
            border-radius: 26px;
            border: 1px solid #e6e8f0;
            box-shadow: 0 12px 30px rgba(31, 41, 55, 0.08);
            padding: 26px;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .detail-item {
            padding: 18px 18px 16px;
            border-radius: 20px;
            background: #f9fafb;
            border: 1px solid #edf0f7;
        }

        .detail-label {
            display: block;
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #8b92a6;
            margin-bottom: 10px;
        }

        .detail-value {
            font-size: 18px;
            font-weight: 700;
            color: #1f2937;
            line-height: 1.4;
        }

        .detail-description {
            margin-top: 0;
            color: #4b5563;
            line-height: 1.7;
            white-space: pre-line;
        }

        .detail-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .detail-actions a,
        .detail-actions form button {
            border-radius: 999px;
            padding: 12px 16px;
            text-decoration: none;
            border: none;
            font-weight: 700;
            cursor: pointer;
        }

        .detail-back {
            background: #e5e7eb;
            color: #1f2937;
        }

        .detail-edit {
            background: #4a6cf7;
            color: white;
        }

        @media (max-width: 640px) {
            .detail-grid {
                grid-template-columns: 1fr;
            }

            .detail-header {
                padding: 22px;
            }
        }
    </style>
</head>
<body>

<header>
    <div class="header-nav">
        <div class="header-left-side">
            <div class="logo">Практикум</div>
            <div class="link-list">
                <a href="#">Студентам</a>
                <a href="#">Университетам</a>
                <a href="#" class="active">Компаниям</a>
            </div>
        </div>

        <div class="profile-link">Профиль</div>
    </div>
</header>

<main>
    <div class="container detail-shell">
        <section class="detail-header">
            <div class="detail-title">
                <p class="detail-subtitle">Детали заявки</p>
                <h1>Заявка #{{ $request->id }}</h1>
                <p class="detail-subtitle">
                    Компания: {{ $request->company->name ?? 'Компания' }}<br>
                    Создана: {{ $request->created_at->format('d.m.Y H:i') }}
                </p>
            </div>

            <div class="detail-meta">
                <span>{{ $request->direction->name ?? 'Направление не указано' }}</span>
                <span>{{ $request->internship->title ?? 'Стажировка не указана' }}</span>
            </div>
        </section>

        <section class="detail-card">
            <div class="detail-grid">
                <div class="detail-item">
                    <span class="detail-label">Направление</span>
                    <div class="detail-value">{{ $request->direction->name ?? 'Не указано' }}</div>
                </div>

                <div class="detail-item">
                    <span class="detail-label">Стажировка</span>
                    <div class="detail-value">{{ $request->internship->title ?? 'Не указано' }}</div>
                </div>

                <div class="detail-item">
                    <span class="detail-label">Требуется студентов</span>
                    <div class="detail-value">{{ $request->required_count }}</div>
                </div>

                <div class="detail-item">
                    <span class="detail-label">Компания</span>
                    <div class="detail-value">{{ $request->company->name ?? 'Компания' }}</div>
                </div>
            </div>
        </section>

        <section class="detail-card">
            <div class="detail-label">Требования</div>
            <p class="detail-description">{{ $request->requirements_text }}</p>
        </section>

        <section class="detail-card detail-actions">
            <a class="detail-back" href="{{ route('profile.company-requests.index') }}">← К списку заявок</a>
            <a class="detail-edit" href="{{ route('profile.company-requests.edit', $request->id) }}">Редактировать</a>
        </section>
    </div>
</main>

</body>
</html>

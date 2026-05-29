<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Календарь практик</title>
    @vite(['resources/js/app.js','resources/css/admin.css'])

    <style>
        body {
            background:
                radial-gradient(circle at top, rgba(74, 108, 247, 0.12), transparent 28%),
                #f6f8fc;
            min-height: 100vh;
        }

        .calendar-shell {
            padding: 26px 0 36px;
        }

        .calendar-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 20px;
        }

        .calendar-copy h1 {
            margin: 0;
            font-size: 32px;
            color: #1b1d29;
        }

        .calendar-copy p {
            margin: 10px 0 0;
            color: #5c6480;
            max-width: 720px;
            line-height: 1.55;
        }

        .calendar-summary {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 18px;
        }

        .calendar-summary-item {
            background: rgba(255,255,255,0.82);
            border: 1px solid rgba(74, 108, 247, 0.16);
            border-radius: 999px;
            padding: 10px 14px;
            font-size: 12px;
            color: #4b5a7a;
            font-weight: 700;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
            gap: 16px;
        }

        .calendar-card {
            background: rgba(255,255,255,0.9);
            border-radius: 22px;
            border: 1px solid rgba(74, 108, 247, 0.14);
            box-shadow: 0 16px 34px rgba(31, 41, 55, 0.08);
            padding: 20px;
        }

        .calendar-card h3 {
            margin: 0 0 12px;
            color: #1b1d29;
            font-size: 20px;
        }

        .calendar-card p {
            margin: 8px 0;
            color: #5b6482;
            line-height: 1.45;
        }

        .calendar-card .kicker {
            display: inline-flex;
            align-items: center;
            padding: 6px 10px;
            border-radius: 999px;
            background: #edf1ff;
            color: #4a6cf7;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            margin-bottom: 12px;
        }

        .calendar-actions .back-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 40px;
            padding: 0 14px;
            border-radius: 999px;
            background: #1f2937;
            color: white;
            text-decoration: none;
            font-weight: 700;
        }
    </style>
</head>
<body>
<div class="container calendar-shell">
    <div class="calendar-header">
        <div class="calendar-copy">
            <h1>Календарь практик</h1>
            <p>Просматривайте активные практики, сроки и доступные слоты по направлениям. Карточки оформлены так, чтобы быстро находить нужные записи.</p>
        </div>
        <div class="calendar-actions" style="display:flex; gap:12px; align-items:center;">
            <a href="{{ route('internships.create') }}" class="back-btn">➕ Создать практику</a>
            <a href="{{ route('university-profile') }}" class="back-btn">← Назад</a>
        </div>
    </div>

    <div class="calendar-summary">
        <div class="calendar-summary-item">Всего записей: {{ $internships->count() }}</div>
        <div class="calendar-summary-item">Режим просмотра: сводный календарь</div>
    </div>

    <div class="calendar-grid">
        @foreach($internships as $i)
            @php
                $qualities = is_array($i['qualities']) ? $i['qualities'] : json_decode($i['qualities'], true);
                $qualities = is_array($qualities) ? $qualities : [];
            @endphp
            <article class="calendar-card">
                <div class="kicker">{{ $i['direction_name'] ?? 'Направление' }}</div>
                <h3>{{ $i['direction_name'] ?? '—' }} (ID {{ $i['id'] }})</h3>
                <p><strong>Период:</strong> {{ $i['start_date'] }} — {{ $i['end_date'] }}</p>
                <p><strong>Вместимость:</strong> {{ $i['capacity'] }}</p>
                <p><strong>Зарезервировано:</strong> {{ $i['reserved_count'] }} · <strong>Доступно:</strong> {{ $i['available'] }}</p>
                <p><strong>Качества:</strong> {{ $qualities ? implode(', ', $qualities) : '—' }}</p>
                <div class="internship-actions" style="display:flex; gap:10px; margin-top:12px;">
                    <a href="{{ route('internships.create') }}" class="back-btn">Редактировать практику</a>
                    <a href="{{ route('internships.index') }}" class="back-btn">Список практик</a>
                </div>
            </article>
        @endforeach
    </div>
</div>
</body>
</html>

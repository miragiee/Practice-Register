<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Календарь практик</title>
    @vite(['resources/js/app.js','resources/css/admin.css'])
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Календарь практик</h1>
        <div class="calendar-actions" style="display:flex; gap:12px; align-items:center;">
            <a href="{{ route('internships.create') }}" class="back-btn">➕ Создать практику</a>
            <a href="{{ route('university-profile') }}" class="back-btn">← Назад</a>
        </div>
    </div>

    <div class="data-panel">
        @foreach($internships as $i)
            @php
                $qualities = is_array($i['qualities']) ? $i['qualities'] : json_decode($i['qualities'], true);
                $qualities = is_array($qualities) ? $qualities : [];
            @endphp
            <div class="internship-item">
                <h3>{{ $i['direction_name'] ?? '—' }} (ID {{ $i['id'] }})</h3>
                <p>Период: {{ $i['start_date'] }} — {{ $i['end_date'] }}</p>
                <p>Вместимость: {{ $i['capacity'] }}; Зарезервировано: {{ $i['reserved_count'] }}; Доступно: {{ $i['available'] }}</p>
                <p>Качества: {{ $qualities ? implode(', ', $qualities) : '—' }}</p>
                <div class="internship-actions" style="display:flex; gap:10px; margin-top:12px;">
                    <a href="{{ route('internships.create') }}" class="back-btn">Редактировать практику</a>
                    <a href="{{ route('internships.index') }}" class="back-btn">Список практик</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
</body>
</html>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Календарь практик вузов</title>
    @vite(['resources/js/app.js','resources/css/admin.css'])
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Календарь практик вузов</h1>
        <div class="calendar-actions" style="display:flex; gap:12px; align-items:center;">
            <a href="{{ route('company-profile') }}" class="back-btn">← Назад в профиль</a>
        </div>
    </div>

    <div class="data-panel">
        @forelse($internships as $i)
            @php
                $qualities = is_array($i['qualities']) ? $i['qualities'] : json_decode($i['qualities'], true);
                $qualities = is_array($qualities) ? $qualities : [];
            @endphp
            <div class="internship-item">
                <h3>{{ $i['direction_name'] ?? '—' }} / {{ $i['university_name'] ?? '—' }} (ID {{ $i['id'] }})</h3>
                <p>Период: {{ $i['start_date'] }} — {{ $i['end_date'] }}</p>
                <p>Вместимость: {{ $i['capacity'] }}; Зарезервировано: {{ $i['reserved_count'] }}; Доступно: {{ $i['available'] }}</p>
                <p>Качества: {{ $qualities ? implode(', ', $qualities) : '—' }}</p>
            </div>
        @empty
            <div class="internship-item">
                <p>Календарь практик пока пуст. Уточните данные у университета или создайте первую практику через админку.</p>
            </div>
        @endforelse
    </div>
</div>
</body>
</html>

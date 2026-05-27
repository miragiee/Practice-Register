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
        <a href="{{ route('university-profile') }}" class="back-btn">← Назад</a>
    </div>

    <div class="data-panel">
        @foreach($internships as $i)
            <div class="internship-item">
                <h3>{{ $i['direction_name'] ?? '—' }} (ID {{ $i['id'] }})</h3>
                <p>Период: {{ $i['start_date'] }} — {{ $i['end_date'] }}</p>
                <p>Вместимость: {{ $i['capacity'] }}; Зарезервировано: {{ $i['reserved_count'] }}; Доступно: {{ $i['available'] }}</p>
                <p>Качества: {{ $i['qualities'] ? implode(', ', $i['qualities']) : '—' }}</p>
            </div>
        @endforeach
    </div>
</div>
</body>
</html>
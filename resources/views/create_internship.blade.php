<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создание практики</title>

    @vite([
        'resources/css/create_internship.css',
        'resources/js/create_internship.js'
    ])
</head>
<body>

<div class="layout">

    {{-- CONTENT --}}
    <main class="content">

        <div class="breadcrumbs">
            ГЛАВНАЯ > СОЗДАНИЕ ПРАКТИКИ
        </div>

        <section class="page-heading">

            <div>

                <h1>Создание практики</h1>

            </div>

        </section>

        @if(session('success'))

            <div class="success-message">
                {{ session('success') }}
            </div>

        @endif

        @if(session('error'))

            <div class="error-message">
                {{ session('error') }}
            </div>

        @endif

        <section class="form-wrapper">

            <form action="{{ route('internships.store') }}" method="POST">

                @csrf

                <div class="form-group">

                    <label>University ID</label>

                    <input
                        type="number"
                        name="university_id"
                        required
                    >

                </div>

                <div class="form-group">

                    <label>ID направления</label>

                    <input
                        type="number"
                        name="direction_id"
                    >

                </div>

                <div class="form-row">

                    <div class="form-group">

                        <label>Дата начала</label>

                        <input
                            type="date"
                            name="start_date"
                            required
                        >

                    </div>

                    <div class="form-group">

                        <label>Дата окончания</label>

                        <input
                            type="date"
                            name="end_date"
                            required
                        >

                    </div>

                </div>

                <div class="form-group">

                    <label>Вместимость</label>

                    <input
                        type="number"
                        name="capacity"
                        min="0"
                        value="0"
                    >

                </div>

                <div class="form-group">

                    <label>Качества (JSON или список через запятую)</label>

                    <textarea
                        name="qualities"
                        rows="4"
                        placeholder='["PHP","Laravel"]'
                    ></textarea>

                </div>

                <div class="form-group">

                    <label>Описание практики</label>

                    <textarea
                        name="description"
                        rows="8"
                        required
                    ></textarea>

                </div>

                <button type="submit" class="primary-btn">
                    Создать практику
                </button>

            </form>

        </section>

        <section class="existing-internships">

    <h2>Существующие практики</h2>

    @foreach($internships as $internship)

       <div class="internship-card">

    <div class="internship-header" onclick="toggleCard(this)">
        <div>
            <strong>{{ $internship->description }}</strong>
        </div>

        <div class="arrow">▼</div>
    </div>

    <div class="internship-body hidden">

        {{-- UPDATE --}}
        <form action="{{ route('internships.update', $internship->id) }}" method="POST">
            @csrf
            @method('PUT')

            <input type="number" name="university_id" value="{{ $internship->university_id }}">

            <input type="date" name="start_date" value="{{ $internship->start_date }}">

            <input type="date" name="end_date" value="{{ $internship->end_date }}">

            <textarea name="description">{{ $internship->description }}</textarea>

            <button type="submit">💾 Обновить</button>
        </form>

        {{-- DELETE --}}
        <form action="{{ route('internships.destroy', $internship->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <button onclick="return confirm('Удалить?')">
                🗑 Удалить
            </button>
        </form>

    </div>
</div>

    @endforeach


    </main>

</div>

</body>
</html>

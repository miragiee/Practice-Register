<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создание практики</title>

    @vite([
        'resources/css/create_internship.css'
    ])
</head>
<body>

<div class="layout">

    {{-- SIDEBAR --}}
    <aside class="sidebar">

        <div>

            <div class="logo">

                <div class="logo-icon">
                    ✦
                </div>

                <div>
                    <h2>Global Network</h2>
                    <p>Enterprise Admin</p>
                </div>

            </div>

            <nav class="sidebar-nav">

                <a href="#" class="nav-item">
                    ◈ Профиль
                </a>

                <a href="#" class="nav-item active">
                    ◈ Создание практики
                </a>

                <a href="#" class="nav-item">
                    ◉ Практики
                </a>

            </nav>

        </div>

    </aside>

    {{-- CONTENT --}}
    <main class="content">

        <div class="breadcrumbs">
            ГЛАВНАЯ > СОЗДАНИЕ ПРАКТИКИ
        </div>

        <section class="page-heading">

            <div>

                <h1>Создание практики</h1>

                <p>
                    Добавьте новую программу стажировки.
                </p>

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

    </main>

</div>

</body>
</html>

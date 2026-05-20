{{-- resources/views/company/register-step-2.blade.php --}}

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация компании</title>

    @vite([
        'resources/js/register.js',
        'resources/css/register-step-2.css',
    ])
</head>
<body>

<header class="header">
    <div class="container header-inner">
        <div class="logo">
            Практикум
        </div>

        <nav class="nav">
            <a href="#">Студентам</a>
            <a href="#">Университетам</a>
            <a href="#" class="active">Компаниям</a>
            <a href="#">Тарифы</a>
        </nav>
    </div>
</header>

<main class="main">

    <section class="register-card">

        <div class="steps">

            <div class="step completed">
                <div class="step-circle">
                    ✓
                </div>

                <div class="step-label">
                    Роль
                </div>
            </div>

            <div class="step-line active"></div>

            <div class="step current">
                <div class="step-circle">
                    2
                </div>

                <div class="step-label">
                    Данные
                </div>
            </div>

            <div class="step-line"></div>

            <div class="step">
                <div class="step-circle">
                    3
                </div>

                <div class="step-label">
                    Готово
                </div>
            </div>

        </div>

        <h1 class="title">
            Регистрация <br>
            компании
        </h1>

        <p class="subtitle">
            Заполните данные вашей организации, чтобы начать поиск лучших стажеров.
        </p>

        <form
            class="register-form"
            action="{{ route('company.register') }}"
            method="POST"
        >
            @csrf

            <div class="form-group">
                <label>Название компании</label>

                <input
                    type="text"
                    name="name"
                    placeholder="ООО «Инновации»"
                    required
                >
            </div>

            <div class="form-group">
                <label>ИНН / ОГРН</label>

                <input
                    type="text"
                    name="inn"
                    placeholder="10 цифр ИНН или 13 цифр ОГРН"
                    required
                >
            </div>

            <div class="form-group">
                <label>Сайт компании</label>

                <div class="input-icon">

                    <span class="icon">
                        🌐
                    </span>

                    <input
                        type="text"
                        name="website"
                        placeholder="https://example.com"
                    >

                </div>
            </div>

            <div class="row">

                <div class="form-group half">

                    <label>Email HR</label>

                    <input
                        type="email"
                        name="contact_info"
                        placeholder="hr@company.ru"
                        required
                    >

                </div>

                <div class="form-group half">

                    <label>Сфера деятельности</label>

                    <input
                        type="text"
                        name="description"
                        placeholder="IT, Финансы, Дизайн..."
                        required
                    >

                </div>

            </div>

            <div class="form-group">

                <label>Пароль</label>

                <div class="input-icon password">

                    <input
                        type="password"
                        name="password"
                        placeholder="••••••••"
                        required
                    >

                    <span class="icon">
                        👁
                    </span>

                </div>

            </div>

            <div class="form-group">

                <label>ФИО контактного лица</label>

                <input
                    type="text"
                    name="full_name"
                    placeholder="Иванов Иван Иванович"
                    required
                >

            </div>

            <button
                type="submit"
                class="submit-btn"
            >
                Создать аккаунт
            </button>

            <div class="login-link">

                Уже есть аккаунт?

                <a href="{{ route('auth') }}">
                    Войти
                </a>

            </div>

        </form>

    </section>

</main>

<footer class="footer">

    <div class="container footer-inner">

        <div class="footer-left">
            <div class="footer-logo">
                Практикум
            </div>

            <p>
                © 2024 Практикум. Платформа для развития кадрового потенциала.
            </p>
        </div>

        <div class="footer-links">
            <a href="#">О платформе</a>
            <a href="#">Карьера</a>
            <a href="#">Конфиденциальность</a>
            <a href="#">Центр помощи</a>
            <a href="#">Партнерам</a>
        </div>

    </div>

</footer>

</body>
</html>

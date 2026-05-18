{{-- resources/views/company/register-step-2.blade.php --}}

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация компании</title>

    @vite([
        'resources/js/app.js',
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

        <form class="register-form">

            <div class="form-group">
                <label>Название компании</label>

                <input
                    type="text"
                    placeholder="ООО «Инновации»"
                >
            </div>

            <div class="form-group">
                <label>ИНН / ОГРН</label>

                <input
                    type="text"
                    placeholder="10 цифр ИНН или 13 цифр ОГРН"
                >
            </div>

            <div class="form-group">
                <label>Сайт компании</label>

                <div class="input-icon">
                    <span class="icon">🌐</span>

                    <input
                        type="text"
                        placeholder="https://example.com"
                    >
                </div>
            </div>

            <div class="row">
                <div class="form-group half">
                    <label>Email HR</label>

                    <input
                        type="email"
                        placeholder="hr@company.ru"
                    >
                </div>

                <div class="form-group half">
                    <label>Сфера деятельности</label>

                    <select>
                        <option>Выберите сферу</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>Пароль</label>

                <div class="input-icon password">
                    <input
                        type="password"
                        placeholder="••••••••"
                    >

                    <span class="icon">👁</span>
                </div>
            </div>

            <div class="form-group">
                <label>ФИО контактного лица</label>

                <input
                    type="text"
                    placeholder="Иванов Иван Иванович"
                >
            </div>

            <button type="submit" class="submit-btn" id="register-submit" data-url="{{ route('register-step-3') }}">
                Создать аккаунт
            </button>

            <div class="login-link">
                Уже есть аккаунт?
                <a href="#">Войти</a>
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

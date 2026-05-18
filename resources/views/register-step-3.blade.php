{{-- resources/views/register-step-3.blade.php --}}

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Подтверждение регистрации</title>

    @vite([
        'resources/css/register-step-2.css',
        'resources/js/app.js'
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
            <a href="#">Компаниям</a>
            <a href="#">Тарифы</a>
        </nav>

    </div>
</header>

<main class="main">

    <section class="register-card confirmation-card">

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

            <div class="step completed">
                <div class="step-circle">
                    ✓
                </div>

                <div class="step-label">
                    Данные
                </div>
            </div>

            <div class="step-line"></div>

            <div class="step current">
                <div class="step-circle">
                    •
                </div>

                <div class="step-label">
                    Готово
                </div>
            </div>

        </div>

        <div class="confirmation-icon">
            ✉
        </div>

        <h1 class="title confirmation-title">
            Почти готово!
        </h1>

        <p class="subtitle confirmation-subtitle">
            Мы отправили письмо на your@email.com.
            Перейдите по ссылке для подтверждения аккаунта.
        </p>

        <button class="submit-btn confirmation-btn">
            Открыть почту ↗
        </button>

        <button class="resend-btn">
            Отправить повторно
        </button>

        <div class="confirmation-divider"></div>

        <a href="/" class="back-link">
            ← Вернуться на главную
        </a>

        <div class="confirmation-dots">
            <span></span>
            <span></span>
            <span></span>
        </div>

    </section>

</main>

<footer class="footer">

    <div class="container footer-inner">

        <div class="footer-left">

            <div class="footer-logo">
                Практикум
            </div>

            <p>
                Платформа для развития кадрового потенциала.
                Соединяем образование и карьеру в единую экосистему.
            </p>

            <p class="copyright">
                © 2024 Практикум. Платформа для развития кадрового потенциала.
            </p>

        </div>

        <div class="footer-links">

            <div>
                <h4>Навигация</h4>

                <a href="#">О платформе</a>
                <a href="#">Центр помощи</a>
            </div>

            <div>
                <h4>Для бизнеса</h4>

                <a href="#">Карьера</a>
                <a href="#">Партнерам</a>
            </div>

            <div>
                <h4>Юридическая часть</h4>

                <a href="#">Конфиденциальность</a>
            </div>

        </div>

    </div>

</footer>

</body>
</html>

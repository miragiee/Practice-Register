{{-- resources/views/register-step-2-university.blade.php --}}

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация университета</title>

    @vite([
        'resources/css/register-step-2.css',
        'resources/js/register.js'
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
            <a href="#" class="active">Университетам</a>
            <a href="#">Компаниям</a>
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

        <h1 class="title university-title">
            Регистрация университета
        </h1>

        <p class="subtitle university-subtitle">
            Заполните данные для создания профиля учебного заведения.
            Проверка займет 1–2 рабочих дня.
        </p>

        <form class="register-form">

            <div class="form-group">
                <label>Полное название ВУЗа</label>

                <input
                    type="text"
                    placeholder="Напр. МГТУ им. Н.Э. Баумана"
                >
            </div>

            <div class="row">

                <div class="form-group half">
                    <label>ИНН</label>

                    <input
                        type="text"
                        placeholder="10 или 12 цифр"
                    >
                </div>

                <div class="form-group half">
                    <label>Email ответственного</label>

                    <input
                        type="email"
                        placeholder="edu@university.ru"
                    >
                </div>

            </div>

            <div class="row">

                <div class="form-group half">
                    <label>Пароль</label>

                    <div class="input-icon password">

                        <input
                            type="password"
                            placeholder="••••••••"
                        >

                        <span class="icon">👁</span>

                    </div>
                </div>

            </div>

            <div class="form-group">
                <label>ФИО контактного лица</label>

                <input
                    type="text"
                    placeholder="Иванов Иван Иванович"
                >
            </div>

            <div class="row">

                <div class="form-group half">
                    <label>Должность</label>

                    <input
                        type="text"
                        placeholder="Напр. Декан факультета"
                    >
                </div>

                <div class="form-group half">
                    <label>Телефон</label>

                    <input
                        type="text"
                        placeholder="+7 (___) ___-__-__"
                    >
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

            <button type="submit" class="submit-btn">
                Отправить заявку
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
            <a href="#">Поддержка</a>
            <a href="#">Юридическая часть</a>
            <a href="#">Карьера</a>
            <a href="#">Партнерам</a>
            <a href="#">Конфиденциальность</a>
        </div>

    </div>

</footer>

</body>
</html>

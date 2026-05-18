<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Регистрация</title>
    @vite(['resources/js/register.js', 'resources/css/register.css'])
</head>
<body>

    <header>
        <div class="container">
            <h2>Практикум</h2>
        </div>
    </header>

    <main>
        <div class="container">

            <div class="main-text">
                <h1>Кто вы?</h1>
                <p class="tiny-text">Это поможет нам настроить платформу под вас</p>
            </div>

            <div class="buttons">

                <button class="button" id="login-button-student" data-url="{{ route('auth')}}">
                    <img src="{{ asset("storage/icons/student-icon.svg") }}" alt="Студент">
                    <h3>Студент</h3>
                    <p class="tiny-text">Ищу место для прохождения практики</p>
                </button>

                <button class="button" id="register-button-univ" data-url="{{ route('register-step-2-university') }}">
                    <img src="{{ asset('storage/icons/university-icon.svg') }}" alt="Университет">
                    <h3>Университет</h3>
                    <p class="tiny-text">Управляю практикой студентов</p>
                </button>

                <button class="button" id="register-button-company" data-url="{{ route('register-step-2-company') }}">
                    <img src="{{ asset('storage/icons/company-icon.svg') }}" alt="Компания">
                    <h3>Компания</h3>
                    <p class="tiny-text">Принимаю студентов на практику</p>
                </button>

            </div>
        </div>

        <div class="bg-container">
                    <div class="circle blue-circle-1"></div>
                    <div class="circle blue-circle-2"></div>
                    <div class="circle blue-circle-3"></div>
                </div>
    </main>

    <footer>
        <p class="tiny-text">Уже есть аккаунт?</p>
        <a href="{{ route('auth') }}" class="login-link">Войти</a>
    </footer>

</body>
</html>

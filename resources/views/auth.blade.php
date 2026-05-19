<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация | Практикум</title>

    @vite([
        'resources/css/auth.css',
        'resources/js/auth.js',
    ])
</head>
<body>

<div class="auth-wrapper fade-in">

    <div class="auth-card">

        <div class="auth-header">
            <div class="logo">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M12 2L22 12L12 22L2 12L12 2Z"
                          stroke="currentColor"
                          stroke-width="2"/>
                </svg>

                <span>Практикум</span>
            </div>

            <h1>Войти в платформу</h1>
        </div>

        <div class="role-switcher">
            <button class="active">Студент</button>
            <button>Университет</button>
            <button>Компания</button>
        </div>

        <div class="login-role">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                <path d="M12 3L1 9L12 15L21 10.09V17H23V9L12 3ZM5 12.18V16.18L12 20L19 16.18V12.18L12 16L5 12.18Z"
                      fill="currentColor"/>
            </svg>

            <span>Войти как студент</span>
        </div>

        <form class="auth-form" method="POST" action="{{ route('auth.student') }}" id="auth-form">
            @csrf
            <input type="hidden" name="role" id="role-input" value="student">

            @if ($errors->any())
                <div class="form-errors">
                    @foreach ($errors->all() as $error)
                        <p class="form-error">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <div class="form-group">
                <label>EMAIL</label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="example@student.edu"
                    autocomplete="email"
                >
            </div>

            <div class="form-group">
                <label>ПАРОЛЬ</label>

                <div class="password-wrapper">
                    <input
                        type="password"
                        name="password"
                        placeholder="••••••••"
                        autocomplete="current-password"
                    >

                    <button
                        type="button"
                        class="password-toggle"
                    >
                        <svg width="20"
                             height="20"
                             viewBox="0 0 24 24"
                             fill="none">
                            <path d="M1 12C1 12 5 5 12 5C19 5 23 12 23 12C23 12 19 19 12 19C5 19 1 12 1 12Z"
                                  stroke="currentColor"
                                  stroke-width="2"/>
                            <circle cx="12"
                                    cy="12"
                                    r="3"
                                    stroke="currentColor"
                                    stroke-width="2"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="form-options">
                <label class="checkbox">
                    <input type="checkbox" name="remember">
                    <span>Запомнить меня</span>
                </label>

                <a href="#">Забыли пароль?</a>
            </div>

            <button class="submit-btn" type="submit">
                Войти
            </button>

            <div class="divider">
                <span>или</span>
            </div>

        </form>

        <div class="auth-footer">
            <span>Нет аккаунта?</span>

            <a href="#">
                Зарегистрироваться
            </a>
        </div>

    </div>

</div>
<script type="module" src="{{ Vite::asset('resources/js/auth.js') }}"></script>
</body>
</html>

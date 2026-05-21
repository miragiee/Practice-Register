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

<main class="main">

    <section class="register-card">

        <h1 class="title">
            Регистрация университета
        </h1>

        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())

            <div class="error-message">

                @foreach($errors->all() as $error)

                    <div>
                        {{ $error }}
                    </div>

                @endforeach

            </div>

        @endif

        <form
            class="register-form"
            method="POST"
            action="{{ route('university.store') }}"
        >

            @csrf

            <div class="form-group">

                <label>
                    Полное название ВУЗа
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="МГТУ им. Баумана"
                    required
                >

            </div>

            <div class="row">

                <div class="form-group half">

                    <label>
                        ИНН
                    </label>

                    <input
                        type="text"
                        name="inn"
                        value="{{ old('inn') }}"
                        placeholder="10 или 12 цифр"
                        required
                    >

                </div>

                <div class="form-group half">

                    <label>
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="edu@university.ru"
                        required
                    >

                </div>

            </div>

            <div class="form-group">

                <label>
                    ФИО контактного лица
                </label>

                <input
                    type="text"
                    name="contact_person"
                    value="{{ old('contact_person') }}"
                    placeholder="Иванов Иван Иванович"
                    required
                >

            </div>

            <div class="row">

                <div class="form-group half">

                    <label>
                        Должность
                    </label>

                    <input
                        type="text"
                        name="position"
                        value="{{ old('position') }}"
                        placeholder="Декан"
                        required
                    >

                </div>

                <div class="form-group half">

                    <label>
                        Телефон
                    </label>

                    <input
                        type="text"
                        name="phone"
                        value="{{ old('phone') }}"
                        placeholder="+7 (999) 999-99-99"
                        required
                    >

                </div>

            </div>

            <div class="form-group">

                <label>
                    Пароль
                </label>

                <div class="input-icon password">

                    <input
                        type="password"
                        name="password"
                        id="password"
                        placeholder="••••••••"
                        required
                    >

                    <span
                        class="icon"
                        id="toggle-password"
                    >
                        👁
                    </span>

                </div>

            </div>

            <button
                type="submit"
                class="submit-btn"
            >
                Зарегистрироваться
            </button>

        </form>

    </section>

</main>

</body>
</html>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>
<body>
    {{-- Это ссылки на тестовые страницы.
     <h2>Сделано</h2>
    <a href="{{ route('companies.index') }}">Перейти к демонстрации CRUD операций с компаниями</a> <br>
    <a href="{{ route('universities.index') }}">Перейти к демонстрации CRUD операций с университетами</a> <br>
    <a href="{{ route('students.index')}}">Перейти к демонстрации CRUD операций со студентами</a> <br>
    <a href="{{ route('directions.index')}}">Перейти к демонстрации CRUD операций с направлениями</a> <br>
    <a href="{{ route('internships.index')}}"">Перейти к демонстрации CRUD операций с практиками</a> <br>
    <a href="{{ route('reservations.index')}}">Перейти к демонстрации CRUD операций с бронированием студентов</a> <br>
    <a href="{{ route('contracts.index')}}">Перейти к демонстрации CRUD операций с контрактами</a> <br>
    <a href="{{ route('documents.index')}}">Перейти к демонстрации CRUD операций с документами</a> <br>
    <a href="{{ route('student-internships.index')}}">Перейти к демонстрации CRUD операций с распределением студентов на практики</a> <br>     --}}
    <div class="container">

        <header>
            <nav>
                <li><a href="{{ route('main.page') }}" class="logo">Практикум</a></li>
                <ul class="link-list">
                    <li><a href="">Студентам</a></li>
                    <li><a href="">Университетам</a></li>
                    <li><a href="">Компаниям</a></li>
                    <li><a href="">Тарифы</a></li>
                </ul>
                <ul class="button-list">
                    <li><button class="small-dark-button">Войти</button></li>
                    <li><button class="small-accent-button-">Регистрация</button></li>
                </ul>
            </nav>
        </header>

        <main>

            <div class="hero">
                <div>
                    <h1>Где студенты, вузы и компании встречаются</h1>
                    <p class="tiny-text">
                        Найди практику, управляй студентами, привлекай лучших стажёров — всё в одном месте. 
                        Самая масштабная экосистема для профессионального старта.
                    </p>
                </div>

                <div>
                    <button class="big-accent-button">Найти практику</button>
                    <button class="big-dark-button">Разместить вакансию</button>
                </div>

                <div>
                    <div>
                        <img src="{{ asset('storage/avatars/male-avatar-1.png') }}" alt="" style="width: 40px; height:40px;">
                        <img src="{{ asset('storage/avatars/female-avatar.png') }}" alt="">
                        <img src="{{ asset('storage/avatars/male-avatar-2.png') }}" alt="">
                    </div>
                    <div class="tiny-text">2400+ студентов уже нашли практику</div>
                </div>
            </div>

            <div class="stats">
                <div class="stats-card">
                    <p class="small-blue-text">Студентов</p>
                    <h2 class="stats-card-header">12400+</h2>
                    <div class="line"></div>
                </div>

                <div class="stats-card">
                    <p class="small-blue-text">Университетов</p>
                    <h2 class="stats-card-header">380</h2>
                    <div class="line"></div>
                </div>

                <div class="stats-card">
                    <p class="small-blue-text">Компаний</p>
                    <h2 class="stats-card-header">1200</h2>
                    <div class="line"></div>
                </div>

                <div class="stats-card">
                    <p class="small-blue-text">Успеха</p>
                    <h2 class="stats-card-header">94%</h2>
                    <div class="line"></div>
                </div>
            </div>

            <div class="how-it-works">
                <h2>Как это работает</h2>
                <div>
                    <button>Студент</button>
                    <button>Университет</button>
                    <button>Компания</button>
                </div>

                <div class="hiw-cards">
                    <div class="hiw-card">
                        <img src="{{ asset('storage/icons/magnif-glass-icon.svg') }}" alt="Найди место">
                        <h3>Найди место</h3>
                        <p>Выбирай из сотен предложений от ведущих компаний страны по твоему профилю.</p>
                    </div>

                    <div class="hiw-card">
                        <img src="{{ asset('storage/icons/document-icon.svg') }}" alt="Подай заявку">
                        <h3>Подай заявку</h3>
                        <p>Загрузи резюме, пройди отбор и получи подтверждение прямо в приложении.</p>
                    </div>

                    <div class="hiw-card">
                        <img src="{{ asset('storage/icons/medal-icon.svg') }}" alt="Начни практику">
                        <h3>Начни практику</h3>
                        <p>Получай задачи, общайся с ментором и закрывай практику официально через вуз.</p>
                    </div>
                </div>

            </div>

            <div class="pricing-section">

            </div>

            <div class="partners">
                <img src="{{ asset('storage/icons/yandex.svg') }}" alt="">
                <img src="{{ asset('storage/icons/vk.svg') }}" alt="">
                <img src="{{ asset('storage/icons/sber.svg') }}" alt="">
                <img src="{{ asset('storage/icons/t-bank.svg') }}" alt="">
                <img src="{{ asset('storage/icons/avito.svg') }}" alt="">
                <img src="{{ asset('storage/icons/ozon.svg') }}" alt="">
                <img src="{{ asset('storage/icons/gazprom.svg') }}" alt="">
            </div>

            <div class="reviews">
                <h2>Отзывы участников</h2>

                <div class="review-cards">

                    <div class="review-card">
                        <img src="{{ asset('storage/icons/star.svg') }}" alt="">
                        <img src="{{ asset('storage/icons/star.svg') }}" alt="">
                        <img src="{{ asset('storage/icons/star.svg') }}" alt="">
                        <img src="{{ asset('storage/icons/star.svg') }}" alt="">
                        <img src="{{ asset('storage/icons/star.svg') }}" alt="">
                        <p>
                            "Нашел стажировку в Яндексе за 2 недели. 
                            Платформа очень удобная, всё оформление документов прошло онлайн через универ."
                        </p>
                        <div class="client">
                            <img src="{{ asset('storage/avatars/student-avatar.png') }}" alt="">
                            <p>Артем К.</p>
                            <p>Студент, МГТУ им. Баумана</p>
                        </div>
                    </div>

                    <div class="review-card">
                        <img src="{{ asset('storage/icons/star.svg') }}" alt="">
                        <img src="{{ asset('storage/icons/star.svg') }}" alt="">
                        <img src="{{ asset('storage/icons/star.svg') }}" alt="">
                        <img src="{{ asset('storage/icons/star.svg') }}" alt="">
                        <img src="{{ asset('storage/icons/star.svg') }}" alt="">
                        <p>
                            "Практикум разгрузил наш деканат на 70%. 
                            Раньше мы тонули в бумагах, теперь все договора и отчеты подписываются в один клик."
                        </p>
                        <div class="client">
                            <img src="{{ asset('storage/avatars/hr-avatar.png') }}" alt="">
                            <p>Елена Васильевна</p>
                            <p>Координатор практик, ВШЭ</p>
                        </div>
                    </div>

                    <div class="review-card">
                        <img src="{{ asset('storage/icons/star.svg') }}" alt="">
                        <img src="{{ asset('storage/icons/star.svg') }}" alt="">
                        <img src="{{ asset('storage/icons/star.svg') }}" alt="">
                        <img src="{{ asset('storage/icons/star.svg') }}" alt="">
                        <img src="{{ asset('storage/icons/star.svg') }}" alt="">
                        <p>
                            "Лучший инструмент для найма джунов. 
                            Мы видим успеваемость студентов еще до собеседования. Наняли уже более 40 человек."
                        </p>
                        <div class="client">
                            <img src="{{ asset('storage/avatars/coordinator-avatar.png') }}" alt="">
                            <p>Дмитрий М.</p>
                            <p>HR Lead, VK</p>
                        </div>
                    </div>

                </div>

            </div>

        </main>

        <footer>

        </footer>
    </div>

</body>
</html>

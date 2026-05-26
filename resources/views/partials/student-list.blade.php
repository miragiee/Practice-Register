{{-- resources/views/partials/student/student-list.blade.php --}}

@php
    $students = [
        [
            'name' => 'Александр Волков',
            'student_id' => '482931',
            'speciality' => 'Кибербезопасность',
            'course' => '4 курс',
            'gpa' => '4.8',
            'status' => 'Завершена',
            'status_class' => 'success',
            'avatar' => asset('images/students/student-1.jpg'),
        ],
        [
            'name' => 'Мария Иванова',
            'student_id' => '591022',
            'speciality' => 'Информационные технологии',
            'course' => '3 курс',
            'gpa' => '4.5',
            'status' => 'В процессе',
            'status_class' => 'warning',
            'avatar' => asset('images/students/student-2.jpg'),
        ],
        [
            'name' => 'Дмитрий Петров',
            'student_id' => '334190',
            'speciality' => 'Промышленный дизайн',
            'course' => '2 курс',
            'gpa' => '3.9',
            'status' => 'Не начата',
            'status_class' => 'inactive',
            'avatar' => asset('images/students/student-3.jpg'),
        ],
        [
            'name' => 'Елена Соколова',
            'student_id' => '772109',
            'speciality' => 'Менеджмент',
            'course' => 'Магистратура',
            'gpa' => '5.0',
            'status' => 'Завершена',
            'status_class' => 'success',
            'avatar' => asset('images/students/student-4.jpg'),
        ],
    ];
@endphp

<section class="student-page">
    <div class="student-page__top">
        <div>
            <div class="breadcrumbs">
                ГЛАВНАЯ > СТУДЕНТЫ
            </div>

            <h1 class="student-page__title">
                Список студентов
            </h1>

            <p class="student-page__description">
                Управляйте профилями студентов и отслеживайте их прогресс.
            </p>
        </div>

        <div class="student-page__header-actions">
            <button class="student-button student-button--light">
                Экспорт
            </button>

            <button class="student-button student-button--accent">
                + Добавить
            </button>
        </div>
    </div>

    <div class="student-toolbar">
        <div class="student-search">
            <input
                type="text"
                placeholder="Поиск по имени или ID..."
            >
        </div>

        <select class="student-select">
            <option>Все специальности</option>
        </select>

        <select class="student-select student-select--small">
            <option>Курс</option>
        </select>

        <button class="student-filter">
            Фильтры
        </button>

        <button class="student-reset">
            Сбросить
        </button>
    </div>


    <div class="student-list">
        <table>
            <thead>
                <tr>
                    <th><input type="checkbox"></th>
                    <th>ФИО студента</th>
                    <th>Специальность</th>
                    <th>Курс</th>
                    <th>GPA</th>
                    <th>Статус практики</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @forelse($students as $student)
                    <tr>
                        <td><input type="checkbox"></td>

                        <td>
                            <div class="student-profile">
                                <img src="{{ $student['avatar'] }}" alt="{{ $student['name'] }}">

                                <div>
                                    <h4>{{ $student['name'] }}</h4>
                                    <p>ID: {{ $student['student_id'] }}</p>
                                </div>
                            </div>
                        </td>

                        <td>{{ $student['speciality'] }}</td>

                        <td>
                            <span class="student-badge">
                                {{ $student['course'] }}
                            </span>
                        </td>

                        <td>
                            <span class="student-gpa">
                                {{ $student['gpa'] }}
                            </span>
                        </td>

                        <td>
                            <span class="student-status student-status--{{ $student['status_class'] }}">
                                {{ $student['status'] }}
                            </span>
                        </td>

                        <td>
                            <button class="student-more">⋮</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <div class="student-list__empty">
                                Нет студентов.
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="student-list__footer">
            <p>Показано 1-4 из 1,284 студентов</p>

            <div class="students-pagination">
                <button>‹</button>
                <button class="active">1</button>
                <button>2</button>
                <button>3</button>
                <button>›</button>
            </div>
        </div>
    </div>
</section>

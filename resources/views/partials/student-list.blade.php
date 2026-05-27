{{-- resources/views/partials/student-list.blade.php --}}

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
                id="student-search-input"
                placeholder="Поиск по имени или ID..."
            >
        </div>

        <select id="speciality-filter" class="student-select">
            <option value="">Все специальности</option>
        </select>

        <select id="course-filter" class="student-select student-select--small">
            <option value="">Курс</option>
        </select>

        <button id="filter-button" class="student-filter">
            Фильтры
        </button>

        <button id="reset-button" class="student-reset">
            Сбросить
        </button>
    </div>

    <div class="student-list">
        <table class="students-table">
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
                    <tr data-student-id="{{ $student->id }}">
                        <td><input type="checkbox"></td>
                        <td>
                            <div class="student-profile">
                                <div class="student-avatar-text">{{ mb_substr($student->full_name, 0, 1) }}</div>
                                <div>
                                    <h4>{{ $student->full_name }}</h4>
                                    <p>ID: {{ $student->id }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="student-speciality">{{ $student->direction->name ?? '—' }}</td>
                        <td>
                            <span class="student-badge">
                                {{ $student->course }} курс
                            </span>
                        </td>
                        <td>
                            <span class="student-gpa">—</span>
                        </td>
                        <td>
                            @php
                                $status = $student->internship_status ?? 'Не начата';
                                $class = match($status) {
                                    'Завершена', 'completed' => 'success',
                                    'В процессе', 'active'   => 'warning',
                                    default                  => 'inactive',
                                };
                            @endphp
                            <span class="student-status student-status--{{ $class }}">
                                {{ $status }}
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
    </div>
</section>
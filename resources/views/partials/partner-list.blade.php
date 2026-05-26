{{-- resources/views/partials/partner/partner-list.blade.php --}}

@php
    $partners = [
        [
            'name' => 'ТехноЛогика Групп',
            'id' => 'TL-2024-001',
            'industry' => 'IT и Разработка',
            'status' => 'Генеральный партнер',
            'status_class' => 'success',
            'contracts' => '12 активных',
        ],
        [
            'name' => 'ЭкоЭнерго Системы',
            'id' => 'EE-2023-452',
            'industry' => 'Энергетика',
            'status' => 'Пролонгация',
            'status_class' => 'warning',
            'contracts' => '4 активных',
        ],
        [
            'name' => 'МедТех Инновации',
            'id' => 'MT-2024-089',
            'industry' => 'Биотехнологии',
            'status' => 'Действующий',
            'status_class' => 'success',
            'contracts' => '8 активных',
        ],
        [
            'name' => 'ФинТраст Банк',
            'id' => 'FT-2022-112',
            'industry' => 'Финтех',
            'status' => 'Архив',
            'status_class' => 'archive',
            'contracts' => '0 активных',
        ],
    ];
@endphp

{{-- Breadcrumbs --}}
<div class="breadcrumbs">
    ГЛАВНАЯ > ПАРТНЁРЫ
</div>

{{-- Heading --}}
<section class="page-heading">

    <div>
        <h1>Партнёрская сеть</h1>

        <p>
            Управление стратегическими альянсами и академическим сотрудничеством.
        </p>
    </div>

    <div class="actions">
        <button class="secondary-btn">
            Фильтры
        </button>

        <button class="primary-btn">
            Новый партнер
        </button>
    </div>

</section>

{{-- Table --}}
<section class="table-wrapper">

    <div class="table-header">
        <h2>Список партнёров</h2>

        <div class="table-count">
            Показывать по:
            <strong>10</strong>
        </div>
    </div>

    <table>

        <thead>
            <tr>
                <th>Организация</th>
                <th>Индустрия</th>
                <th>Статус</th>
                <th>Контракты</th>
                <th>Действия</th>
            </tr>
        </thead>

        <tbody>
            @forelse($partners as $partner)
                <tr>

                    <td>
                        <div class="company">

                            <div class="company-logo"></div>

                            <div>
                                <h4>{{ $partner['name'] }}</h4>
                                <p>ID: {{ $partner['id'] }}</p>
                            </div>

                        </div>
                    </td>

                    <td>
                        {{ $partner['industry'] }}
                    </td>

                    <td>
                        <span class="status {{ $partner['status_class'] }}">
                            {{ $partner['status'] }}
                        </span>
                    </td>

                    <td>
                        <span class="contracts {{ $partner['contracts'] === '0 активных' ? 'inactive' : '' }}">
                            {{ $partner['contracts'] }}
                        </span>
                    </td>

                    <td>
                        ⋮
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="5">
                        <div class="table-footer">
                            Нет партнёров.
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>

    </table>

</section>

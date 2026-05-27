{{-- resources/views/partials/partner-list.blade.php --}}

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
        <button class="secondary-btn">Фильтры</button>
        <button class="primary-btn">Новый партнер</button>
    </div>

</section>

{{-- ========================= --}}
{{-- PARTNERS --}}
{{-- ========================= --}}

<section class="table-wrapper">

    <div class="table-header">
        <h2>Список партнёров</h2>

        <div class="table-count">
            Всего: <strong>{{ $partners->count() }}</strong>
        </div>
    </div>

    <table>

        <thead>
        <tr>
            <th>ID</th>
            <th>Компания</th>
            <th>Университет</th>
            <th>Дата начала</th>
            <th>Дата окончания</th>
            <th>Статус</th>
        </tr>
        </thead>

        <tbody>

        @forelse($partners as $partner)

            <tr>
                <td>#{{ $partner->id }}</td>
                <td>{{ $partner->company_id }}</td>
                <td>{{ $partner->university_id }}</td>
                <td>{{ $partner->start_date }}</td>
                <td>{{ $partner->end_date }}</td>

                <td>
                    @if($partner->status === 'active')
                        <span class="status success">Активный партнёр</span>
                    @else
                        <span class="status archive">Неактивен</span>
                    @endif
                </td>
            </tr>

        @empty
            <tr>
                <td colspan="6">
                    <div class="table-footer">Нет партнёров</div>
                </td>
            </tr>
        @endforelse

        </tbody>

    </table>

</section>

{{-- ========================= --}}
{{-- REQUESTS --}}
{{-- ========================= --}}

<section class="requests-wrapper">

    <div class="table-header">
        <h2>Входящие заявки</h2>

        <div class="table-count">
            Всего: <strong>{{ $requests->count() }}</strong>
        </div>
    </div>

    <table>

        <thead>
        <tr>
            <th>ID</th>
            <th>Компания</th>
            <th>Университет</th>
            <th>Компания</th>
            <th>Университет</th>
            <th>Статус</th>
            <th>Действия</th>
        </tr>
        </thead>

        <tbody>

        @forelse($requests as $request)

            <tr>
                <td>#{{ $request->id }}</td>

                <td>{{ $request->company_id }}</td>
                <td>{{ $request->university_id }}</td>

                {{-- COMPANY STATUS --}}
                <td>
                    @if($request->company_accept)
                        <span class="status success">Подтверждено</span>
                    @else
                        <span class="status archive">Ожидание</span>
                    @endif
                </td>

                {{-- UNIVERSITY STATUS --}}
                <td>
                    @if($request->university_accept)
                        <span class="status success">Подтверждено</span>
                    @else
                        <span class="status archive">Ожидание</span>
                    @endif
                </td>

                {{-- OVERALL STATUS --}}
                <td>
                    @if($request->company_accept && $request->university_accept)
                        <span class="status success">Партнёрство активно</span>

                    @elseif(!$request->company_accept && !$request->university_accept)
                        <span class="status warning">Новая заявка</span>

                    @else
                        <span class="status warning">Ожидает подтверждения</span>
                    @endif
                </td>

                {{-- ACTIONS --}}
                <td class="actions-cell">

                    {{-- COMPANY ACCEPT: только для роли "Работодатель" (id = 4) --}}
                    @if(!$request->company_accept && auth()->check() && auth()->user()->role_id == 4)
                        <form method="POST"
                              action="{{ route('contract-requests.accept-company', $request->id) }}"
                              style="display:inline;">
                            @csrf
                            @method('PUT')

                            <button class="btn-success" type="submit">
                                Принять (компания)
                            </button>
                        </form>
                    @endif


                    {{-- UNIVERSITY ACCEPT: только для роли "ВУЗ" (id = 2) --}}
                    @if(!$request->university_accept && auth()->check() && auth()->user()->role_id == 2)
                        <form method="POST"
                              action="{{ route('contract-requests.accept-university', $request->id) }}"
                              style="display:inline;">
                            @csrf
                            @method('PUT')

                            <button class="btn-success" type="submit">
                                Принять (университет)
                            </button>
                        </form>
                    @endif


                    {{-- REJECT --}}
                    @if(!($request->company_accept && $request->university_accept))
                        <form method="POST"
                              action="{{ route('contract-requests.reject', $request->id) }}"
                              style="display:inline;">
                            @csrf
                            @method('PUT')

                            <button class="btn-danger" type="submit">
                                Отклонить
                            </button>
                        </form>
                    @endif

                </td>

            </tr>

        @empty
            <tr>
                <td colspan="7">
                    <div class="table-footer">Нет заявок</div>
                </td>
            </tr>
        @endforelse

        </tbody>

    </table>

</section>
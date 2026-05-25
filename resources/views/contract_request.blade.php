<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CRUD Заявки на договор</title>
    @vite(['resources/js/app.js', 'resources/css/admin.css'])
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Заявки на договор</h1>
        <p>Управление заявками между компаниями и университетами</p>
        <a href="{{ route('admin') }}" class="back-btn">← Назад в админ панель</a>
    </div>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif
    @if(session('warning'))
        <div class="alert-warning">{{ session('warning') }}</div>
    @endif
    @if(session('error'))
        <div class="alert-error">{{ session('error') }}</div>
    @endif

    <h2 class="section-title">Список заявок</h2>
    <div class="data-panel" id="contract-requests-list">Загрузка...</div>

    <h2 class="section-title">Добавление заявки</h2>
    <div class="form-panel">
        <form action="{{ route('contract-requests.store') }}" method="POST">
            @csrf
            <p>
                <label for="company_id">Компания</label>
                <select name="company_id" id="company_id" required>
                    <option value="">-- Выберите компанию --</option>
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                </select>
            </p>
            <p>
                <label for="university_id">Университет</label>
                <select name="university_id" id="university_id" required>
                    <option value="">-- Выберите университет --</option>
                    @foreach($universities as $university)
                        <option value="{{ $university->id }}">{{ $university->name }}</option>
                    @endforeach
                </select>
            </p>
            <p>
                <label><input type="checkbox" name="company_accept" value="1"> Принято компанией</label>
            </p>
            <p>
                <label><input type="checkbox" name="university_accept" value="1"> Принято университетом</label>
            </p>
            <button type="submit">Добавить заявку</button>
        </form>
    </div>

    <h2 class="section-title">Обновление заявки</h2>
    <div class="form-panel">
        <form id="update-form" method="POST">
            @csrf
            @method('PUT')
            <p>
                <label for="update-contract-select">Выберите заявку</label>
                <select name="contract_request_id" id="update-contract-select" required>
                    <option value="">-- Выберите --</option>
                    @foreach($contractRequests as $req)
                        <option value="{{ $req->id }}">ID {{ $req->id }}: {{ $req->company->name ?? '?' }} → {{ $req->university->name ?? '?' }}</option>
                    @endforeach
                </select>
            </p>
            <p>
                <label for="update-company_id">Новая компания (оставить пустым, если не менять)</label>
                <select name="company_id" id="update-company_id">
                    <option value="">-- Не менять --</option>
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                </select>
            </p>
            <p>
                <label for="update-university_id">Новый университет</label>
                <select name="university_id" id="update-university_id">
                    <option value="">-- Не менять --</option>
                    @foreach($universities as $university)
                        <option value="{{ $university->id }}">{{ $university->name }}</option>
                    @endforeach
                </select>
            </p>
            <p>
                <label><input type="checkbox" name="company_accept" value="1"> Принято компанией</label>
                <small>Если не отмечено — останется как есть</small>
            </p>
            <p>
                <label><input type="checkbox" name="university_accept" value="1"> Принято университетом</label>
            </p>
            <button type="submit">Обновить заявку</button>
        </form>
    </div>

    <h2 class="section-title">Удаление заявки</h2>
    <div class="form-panel">
        <form id="delete-form" method="POST">
            @csrf
            @method('DELETE')
            <p>
                <label for="delete-contract-select">Выберите заявку для удаления</label>
                <select name="contract_request_id" id="delete-contract-select" required>
                    <option value="">-- Выберите --</option>
                    @foreach($contractRequests as $req)
                        <option value="{{ $req->id }}">ID {{ $req->id }}: {{ $req->company->name ?? '?' }} → {{ $req->university->name ?? '?' }}</option>
                    @endforeach
                </select>
            </p>
            <button type="submit" class="danger-btn">Удалить заявку</button>
        </form>
    </div>
</div>
</body>
</html>
<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Company;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContractController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX (ПАРТНЁРЫ ДЛЯ ТЕКУЩЕГО ПОЛЬЗОВАТЕЛЯ)
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $user = Auth::user();

        $company = Company::where('user_id', $user->id)->first();
        $university = University::where('user_id', $user->id)->first();

        $query = Contract::query();

        // показываем только активные партнёрства
        $query->where('status', 'active');

        // если пользователь — компания
        if ($company) {
            $query->where('company_id', $company->id);
        }

        // если пользователь — университет
        if ($university) {
            $query->where('university_id', $university->id);
        }

        $contracts = $query
            ->orderByDesc('id')
            ->get();

        if ($request->wantsJson()) {
            return response()->json($contracts);
        }

        return view('contracts', compact('contracts', 'user'));
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'university_id' => 'required|integer|exists:universities,id',
            'company_id'    => 'required|integer|exists:companies,id',
            'start_date'    => 'required|date',
            'end_date'      => 'required|date|after_or_equal:start_date',
            'status'        => 'required|string|max:50',
        ]);

        $exists = Contract::where('university_id', $validated['university_id'])
            ->where('company_id', $validated['company_id'])
            ->where('start_date', $validated['start_date'])
            ->where('end_date', $validated['end_date'])
            ->where('status', $validated['status'])
            ->exists();

        if ($exists) {
            return back()->with('error', 'Такие данные уже есть в таблице');
        }

        Contract::create($validated);

        return back()->with('success', 'Контракт успешно добавлен');
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $contract = Contract::findOrFail($id);

        $validated = $request->validate([
            'university_id' => 'nullable|integer|exists:universities,id',
            'company_id'    => 'nullable|integer|exists:companies,id',
            'start_date'    => 'nullable|date',
            'end_date'      => 'nullable|date|after_or_equal:start_date',
            'status'        => 'nullable|string|max:50',
        ]);

        // убираем пустые значения
        $data = array_filter($validated, fn ($v) => $v !== null && $v !== '');

        if (empty($data)) {
            return back()->with('warning', 'Нет данных для обновления');
        }

        // итоговое состояние записи
        $final = [
            'university_id' => $data['university_id'] ?? $contract->university_id,
            'company_id'    => $data['company_id'] ?? $contract->company_id,
            'start_date'    => $data['start_date'] ?? $contract->start_date,
            'end_date'      => $data['end_date'] ?? $contract->end_date,
            'status'        => $data['status'] ?? $contract->status,
        ];

        // проверка дубля
        $duplicate = Contract::where('id', '!=', $id)
            ->where('university_id', $final['university_id'])
            ->where('company_id', $final['company_id'])
            ->where('start_date', $final['start_date'])
            ->where('end_date', $final['end_date'])
            ->where('status', $final['status'])
            ->exists();

        if ($duplicate) {
            return back()->with('error', 'Такие данные уже есть в таблице');
        }

        $contract->update($data);

        return back()->with('success', 'Контракт обновлён');
    }

    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        Contract::destroy($id);

        return back()->with('success', 'Контракт удалён');
    }
}
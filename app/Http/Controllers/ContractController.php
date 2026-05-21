<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function main()
    {
        $contracts = Contract::all();
        return view('contracts', compact('contracts'));
    }

    public function index(Request $request)
    {
        $contracts = Contract::all();

        if ($request->wantsJson()) {
            return response()->json($contracts);
        }

        return view('contracts', compact('contracts'));
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

        // ❗ Проверка на дубликат
        $exists = Contract::where('university_id', $validated['university_id'])
            ->where('company_id', $validated['company_id'])
            ->where('start_date', $validated['start_date'])
            ->where('end_date', $validated['end_date'])
            ->where('status', $validated['status'])
            ->exists();

        if ($exists) {
            return redirect()
                ->back()
                ->with('error', 'Такие данные уже есть в таблице');
        }

        Contract::create($validated);

        return redirect()
            ->back()
            ->with('success', 'Контракт успешно добавлен');
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'university_id' => 'nullable|integer|exists:universities,id',
            'company_id'    => 'nullable|integer|exists:companies,id',
            'start_date'    => 'nullable|date',
            'end_date'      => 'nullable|date|after_or_equal:start_date',
            'status'        => 'nullable|string|max:50',
        ]);

        $data = array_filter($validated, function ($value) {
            return $value !== null && $value !== "";
        });

        if (empty($data)) {
            return redirect()
                ->back()
                ->with('warning', 'Нет данных для обновления');
        }

        $contract = Contract::findOrFail($id);

        // итоговые значения (старые + новые)
        $final = [
            'university_id' => $data['university_id'] ?? $contract->university_id,
            'company_id'    => $data['company_id'] ?? $contract->company_id,
            'start_date'    => $data['start_date'] ?? $contract->start_date,
            'end_date'      => $data['end_date'] ?? $contract->end_date,
            'status'        => $data['status'] ?? $contract->status,
        ];

        // ❗ Проверка на дубликат (исключая текущий контракт)
        $duplicate = Contract::where('id', '!=', $id)
            ->where('university_id', $final['university_id'])
            ->where('company_id', $final['company_id'])
            ->where('start_date', $final['start_date'])
            ->where('end_date', $final['end_date'])
            ->where('status', $final['status'])
            ->exists();

        if ($duplicate) {
            return redirect()
                ->back()
                ->with('error', 'Такие данные уже есть в таблице');
        }

        $contract->update($data);

        return redirect()
            ->back()
            ->with('success', 'Данные контракта обновлены');
    }

    public function destroy($id)
    {
        Contract::destroy($id);

        return redirect()
            ->back()
            ->with('success', 'Контракт удален');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\ContractRequest;
use Illuminate\Http\Request;

class ContractRequestController extends Controller
{
    public function main()
    {
        $contractRequests = ContractRequest::with(['company', 'university'])->get();

        return view('contract_requests', compact('contractRequests'));
    }

    public function index(Request $request)
    {
        $contractRequests = ContractRequest::with(['company', 'university'])->get();

        if ($request->wantsJson()) {
            return response()->json($contractRequests);
        }

        return view('contract_requests', compact('contractRequests'));
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_id'        => 'required|integer|exists:companies,id',
            'university_id'     => 'required|integer|exists:universities,id',
            'company_accept'    => 'nullable|boolean',
            'university_accept' => 'nullable|boolean',
        ]);

        // Значения по умолчанию для булевых полей
        $validated['company_accept']    = $validated['company_accept'] ?? false;
        $validated['university_accept'] = $validated['university_accept'] ?? false;

        // ❗ Проверка на дубликат (уникальность по всем полям)
        $exists = ContractRequest::where('company_id', $validated['company_id'])
            ->where('university_id', $validated['university_id'])
            ->where('company_accept', $validated['company_accept'])
            ->where('university_accept', $validated['university_accept'])
            ->exists();

        if ($exists) {
            return redirect()
                ->back()
                ->with('error', 'Такая заявка уже существует');
        }

        ContractRequest::create($validated);

        return redirect()
            ->back()
            ->with('success', 'Заявка успешно добавлена');
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'company_id'        => 'nullable|integer|exists:companies,id',
            'university_id'     => 'nullable|integer|exists:universities,id',
            'company_accept'    => 'nullable|boolean',
            'university_accept' => 'nullable|boolean',
        ]);

        // Удаляем null и пустые строки
        $data = array_filter($validated, function ($value) {
            return $value !== null && $value !== "";
        });

        if (empty($data)) {
            return redirect()
                ->back()
                ->with('warning', 'Нет данных для обновления');
        }

        $contractRequest = ContractRequest::findOrFail($id);

        // Итоговые значения (старые + новые)
        $final = [
            'company_id'        => $data['company_id']        ?? $contractRequest->company_id,
            'university_id'     => $data['university_id']     ?? $contractRequest->university_id,
            'company_accept'    => $data['company_accept']    ?? $contractRequest->company_accept,
            'university_accept' => $data['university_accept'] ?? $contractRequest->university_accept,
        ];

        // Преобразуем булевы значения к типу bool (на случай, если пришли как строка)
        $final['company_accept']    = (bool) $final['company_accept'];
        $final['university_accept'] = (bool) $final['university_accept'];

        // ❗ Проверка на дубликат (кроме текущей записи)
        $duplicate = ContractRequest::where('id', '!=', $id)
            ->where('company_id', $final['company_id'])
            ->where('university_id', $final['university_id'])
            ->where('company_accept', $final['company_accept'])
            ->where('university_accept', $final['university_accept'])
            ->exists();

        if ($duplicate) {
            return redirect()
                ->back()
                ->with('error', 'Такая заявка уже существует');
        }

        $contractRequest->update($data);

        return redirect()
            ->back()
            ->with('success', 'Заявка обновлена');
    }

    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        ContractRequest::destroy($id);

        return redirect()
            ->back()
            ->with('success', 'Заявка удалена');
    }
}
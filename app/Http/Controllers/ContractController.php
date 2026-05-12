<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'university_id' => 'required|integer|exists:universities,id',
            'company_id'    => 'required|integer|exists:companies,id',
            'start_date'    => 'required|date',
            'end_date'      => 'required|date|after_or_equal:start_date',
            'status'        => 'required|string|max:50',
        ]);

        Contract::create($validated);

        return redirect()->back()->with('success', 'Контракт успешно добавлен');
    }

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
            return redirect()->back()->with('warning', 'Нет данных для обновления');
        }

        $contract = Contract::findOrFail($id);
        $contract->update($data);

        return redirect()->back()->with('success', 'Данные контракта обновлены');
    }

    public function destroy($id)
    {
        Contract::destroy($id);
        return redirect()->back()->with('success', 'Контракт удален');
    }
}

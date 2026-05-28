<?php

namespace App\Http\Controllers;

use App\Models\ContractRequest;
use App\Models\Contract;
use App\Models\Company;
use App\Models\University;
use App\Notifications\ContractActivated;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ContractRequestController extends Controller
{
    public function acceptCompany($id)
    {
        $request = ContractRequest::findOrFail($id);

        $request->update([
            'company_accept' => true,
        ]);

        Log::info('ACCEPT COMPANY', $request->toArray());

        $this->syncContract($request);

        return back()->with('success', 'Компания приняла заявку');
    }

    public function acceptUniversity($id)
    {
        $request = ContractRequest::findOrFail($id);

        $request->update([
            'university_accept' => true,
        ]);

        Log::info('ACCEPT UNIVERSITY', $request->toArray());

        $this->syncContract($request);

        return back()->with('success', 'Университет принял заявку');
    }

    public function reject($id)
    {
        $request = ContractRequest::findOrFail($id);

        Log::warning('REJECT REQUEST', $request->toArray());

        $request->delete();

        return back()->with('success', 'Заявка удалена');
    }

    /*
    |
    | ADMIN CRUD
    |
    */

    public function index()
    {
        $contractRequests = ContractRequest::with(['company', 'university'])
            ->orderByDesc('id')
            ->get();

        $companies = Company::orderBy('name')->get();
        $universities = University::orderBy('name')->get();

        return view('contract_request', compact('contractRequests', 'companies', 'universities'));
    }

    public function create()
    {
        return redirect()->route('contract-requests.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'university_id' => 'required|exists:universities,id',
            'company_accept' => 'nullable|in:1',
            'university_accept' => 'nullable|in:1',
        ]);

        $cr = ContractRequest::create([
            'company_id' => $validated['company_id'],
            'university_id' => $validated['university_id'],
            'company_accept' => isset($validated['company_accept']) && $validated['company_accept'] == 1,
            'university_accept' => isset($validated['university_accept']) && $validated['university_accept'] == 1,
        ]);

        $this->syncContract($cr);

        return redirect()->route('contract-requests.index')->with('success', 'Заявка добавлена');
    }

    public function show($id)
    {
        $req = ContractRequest::with(['company', 'university'])->findOrFail($id);
        return response()->json($req);
    }

    public function edit($id)
    {
        return redirect()->route('contract-requests.index');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'company_id' => 'nullable|exists:companies,id',
            'university_id' => 'nullable|exists:universities,id',
            'company_accept' => 'nullable|in:1',
            'university_accept' => 'nullable|in:1',
        ]);

        $cr = ContractRequest::findOrFail($id);

        $data = [];
        if (isset($validated['company_id'])) $data['company_id'] = $validated['company_id'];
        if (isset($validated['university_id'])) $data['university_id'] = $validated['university_id'];
        if (array_key_exists('company_accept', $validated)) $data['company_accept'] = $validated['company_accept'] == 1;
        if (array_key_exists('university_accept', $validated)) $data['university_accept'] = $validated['university_accept'] == 1;

        if (!empty($data)) {
            $cr->update($data);
        }

        $this->syncContract($cr);

        return redirect()->route('contract-requests.index')->with('success', 'Заявка обновлена');
    }

    public function destroy($id)
    {
        $cr = ContractRequest::findOrFail($id);
        $cr->delete();

        return redirect()->route('contract-requests.index')->with('success', 'Заявка удалена');
    }

    /*
    |--------------------------------------------------------------------------
    | SYNC CONTRACT (ключевая логика)
    |--------------------------------------------------------------------------
    */
    private function syncContract(ContractRequest $request)
    {
        Log::info('SYNC CONTRACT CHECK', [
            'id' => $request->id,
            'company_accept' => $request->company_accept,
            'university_accept' => $request->university_accept,
        ]);

        // ❗ пока не оба true — ничего не делаем
        if (! $request->company_accept || ! $request->university_accept) {
            return;
        }

        $contract = Contract::where('company_id', $request->company_id)
            ->where('university_id', $request->university_id)
            ->first();

        if ($contract) {
            $contract->update([
                'status' => 'active',
            ]);

            Log::info('CONTRACT UPDATED TO ACTIVE', $contract->toArray());
        } else {
            $contract = Contract::create([
                'company_id'    => $request->company_id,
                'university_id' => $request->university_id,
                'start_date'    => now(),
                'end_date'      => now()->addYear(),
                'status'        => 'active',
            ]);

            Log::info('CONTRACT CREATED', $contract->toArray());
        }

        $companyUser = $contract->company->user ?? null;
        $universityUser = $contract->university->user ?? null;

        if ($companyUser && method_exists($companyUser, 'notify')) {
            $companyUser->notify(new ContractActivated($contract));
        }

        if ($universityUser && method_exists($universityUser, 'notify')) {
            $universityUser->notify(new ContractActivated($contract));
        }

        // ❗ ВАЖНО: удаляем заявку после успешного создания/активации контракта
        $request->delete();

        Log::info('REQUEST DELETED AFTER CONTRACT SYNC', [
            'request_id' => $request->id,
        ]);
    }
}

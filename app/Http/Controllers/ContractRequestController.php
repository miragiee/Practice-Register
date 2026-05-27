<?php

namespace App\Http\Controllers;

use App\Models\ContractRequest;
use App\Models\Contract;
use Illuminate\Support\Facades\Log;

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

        // ❗ ВАЖНО: удаляем заявку после успешного создания/активации контракта
        $request->delete();

        Log::info('REQUEST DELETED AFTER CONTRACT SYNC', [
            'request_id' => $request->id,
        ]);
    }
}
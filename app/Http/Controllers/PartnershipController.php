<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\ContractRequest;
use Illuminate\Support\Facades\Auth;

class PartnershipController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | Определяем роль
        |--------------------------------------------------------------------------
        */

        $companyId = null;
        $universityId = null;

        if ($user->role_id === 4) {
            $companyId = $user->company?->id;
        }

        if ($user->role_id === 2) {
            $universityId = $user->university?->id;
        }

        /*
        |--------------------------------------------------------------------------
        | ПАРТНЁРЫ (contracts)
        |--------------------------------------------------------------------------
        */

        $partnersQuery = Contract::where('status', 'active');

        if ($companyId) {
            $partnersQuery->where('company_id', $companyId);
        }

        if ($universityId) {
            $partnersQuery->where('university_id', $universityId);
        }

        $partners = $partnersQuery
            ->orderBy('id', 'desc')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | ЗАЯВКИ (contract_requests)
        |--------------------------------------------------------------------------
        */

        $requestsQuery = ContractRequest::query();

        if ($companyId) {
            $requestsQuery->where('company_id', $companyId);
        }

        if ($universityId) {
            $requestsQuery->where('university_id', $universityId);
        }

        $requests = $requestsQuery
            ->orderBy('id', 'desc')
            ->get();

        return view('partnerships', compact(
            'user',
            'partners',
            'requests'
        ));
    }
}
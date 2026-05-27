<?php

namespace App\Http\Controllers;

use App\Models\ContractRequest;
use Illuminate\Support\Facades\Auth;

class PartnershipController extends Controller
{
    public function index()
    {
        $requests = ContractRequest::latest()->get();

        $user = Auth::user();

        return view('partnerships', compact(
            'requests',
            'user'
        ));
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\ContractRequest;

class PartnershipController extends Controller
{
    public function index()
    {
        $requests = ContractRequest::latest()->get();

        return view('partnerships', compact('requests'));
    }
}

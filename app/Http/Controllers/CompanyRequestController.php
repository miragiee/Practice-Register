<?php

namespace App\Http\Controllers;

use App\Models\CompanyRequest;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class CompanyRequestController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | REQUESTS LIST
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $company = Auth::user()->company;

        if (!$company) {
            abort(403, "Компания не найдена");
        }

        $requests = CompanyRequest::with(["company", "direction", "internship"])
            ->where("company_id", $company->id)
            ->latest()
            ->paginate(10);

        return view("company-request", compact("requests"));
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW REQUEST
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        $company = Auth::user()->company;

        if (!$company) {
            abort(403, "Компания не найдена");
        }

        $request = CompanyRequest::with(["company", "direction", "internship"])
            ->where("company_id", $company->id)
            ->findOrFail($id);

        return view("company-request-show", compact("request"));
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE REQUEST
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $company = Auth::user()->company;

        if (!$company) {
            abort(403, "Компания не найдена");
        }

        $request = CompanyRequest::where(
            "company_id",
            $company->id,
        )->findOrFail($id);

        $request->delete();

        return redirect()
            ->route("company-requests.index")
            ->with("success", "Заявка удалена");
    }
}

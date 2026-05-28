<?php

namespace App\Http\Controllers;

use App\Models\CompanyRequest;
use App\Models\Direction;
use App\Models\Internship;

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
    | CREATE FORM
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $company = Auth::user()->company;

        if (!$company) {
            abort(403, "Компания не найдена");
        }

        $directions = Direction::all();
        $internships = Internship::all();

        return view(
            "company-request-create",
            compact("directions", "internships"),
        );
    }

    /*
    |--------------------------------------------------------------------------
    | STORE REQUEST
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $company = Auth::user()->company;

        if (!$company) {
            abort(403, "Компания не найдена");
        }

        $validated = $request->validate([
            "direction_id" => "required|exists:directions,id",
            "internship_id" => "required|exists:internships,id",
            "required_count" => "required|integer|min:1",
            "requirements_text" => "required|string|max:3000",
        ]);

        CompanyRequest::create([
            "company_id" => $company->id,
            "direction_id" => $validated["direction_id"],
            "internship_id" => $validated["internship_id"],
            "required_count" => $validated["required_count"],
            "requirements_text" => $validated["requirements_text"],
        ]);

        return redirect()
            ->route("company-requests.index")
            ->with("success", "Заявка успешно создана");
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
    | EDIT FORM
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $company = Auth::user()->company;

        if (!$company) {
            abort(403, "Компания не найдена");
        }

        $request = CompanyRequest::with(["company", "direction", "internship"])
            ->where("company_id", $company->id)
            ->findOrFail($id);

        $directions = Direction::all();
        $internships = Internship::all();

        return view(
            "company-request-edit",
            compact("request", "directions", "internships"),
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE REQUEST
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $company = Auth::user()->company;

        if (!$company) {
            abort(403, "Компания не найдена");
        }

        $companyRequest = CompanyRequest::where(
            "company_id",
            $company->id,
        )->findOrFail($id);

        $validated = $request->validate([
            "direction_id" => "required|exists:directions,id",
            "internship_id" => "required|exists:internships,id",
            "required_count" => "required|integer|min:1",
            "requirements_text" => "required|string|max:3000",
        ]);

        $companyRequest->update([
            "direction_id" => $validated["direction_id"],
            "internship_id" => $validated["internship_id"],
            "required_count" => $validated["required_count"],
            "requirements_text" => $validated["requirements_text"],
        ]);

        return redirect()
            ->route("company-requests.index")
            ->with("success", "Заявка успешно обновлена");
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

<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\ContractRequest;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class PartnershipController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $companyId = null;
        $universityId = null;

        if ($user->role_id === 4) {
            $companyId = $user->company?->id;
        }
        if ($user->role_id === 2) {
            $universityId = $user->university?->id;
        }

        // Партнёры
        $partnersQuery = Contract::where('status', 'active');
        if ($companyId) {
            $partnersQuery->where('company_id', $companyId);
        }
        if ($universityId) {
            $partnersQuery->where('university_id', $universityId);
        }
        $partners = $partnersQuery->orderBy('id', 'desc')->get();

        // Заявки
        $requestsQuery = ContractRequest::query();
        if ($companyId) {
            $requestsQuery->where('company_id', $companyId);
        }
        if ($universityId) {
            $requestsQuery->where('university_id', $universityId);
        }
        $requests = $requestsQuery->orderBy('id', 'desc')->get();

        // Студенты
        $students = collect();
        if ($companyId) {
            $students = Student::whereHas('studentInternships', function ($q) use ($companyId) {
                    $q->where('company_id', $companyId);
                })
                ->with([
                    'direction',
                    'studentInternships' => function ($q) use ($companyId) {
                        $q->where('company_id', $companyId);
                    }
                ])
                ->get();

            $students->each(function ($student) use ($companyId) {
                $internship = $student->studentInternships->firstWhere('company_id', $companyId);
                $student->internship_status = $internship ? $internship->status : 'Не начата';
            });
        } elseif ($universityId) {
            $students = Student::with('direction')
                ->where('university_id', $universityId)
                ->get();

            $students->each(function ($student) {
                $lastInternship = $student->studentInternships()->latest()->first();
                $student->internship_status = $lastInternship ? $lastInternship->status : 'Не начата';
            });
        }

        // Ссылка на профиль
        $profileUrl = url('/'); // fallback
        if ($user->role_id === 4) {
            $profileUrl = route('company-profile');
        } elseif ($user->role_id === 2) {
            $profileUrl = route('university-profile');
        }

        return view('partnerships', compact('user', 'partners', 'requests', 'students', 'profileUrl'));
    }
}
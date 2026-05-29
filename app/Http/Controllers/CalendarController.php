<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Internship;
use App\Models\StudentInternship;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $university = $user?->university;

        if (! $university) {
            abort(403, 'Доступ только для пользователей-вузов');
        }

        $internships = Internship::with('direction')
            ->where('university_id', $university->id)
            ->orderBy('start_date')
            ->get()
            ->map(function ($i) {
                $reserved = StudentInternship::where('internship_id', $i->id)->count();

                return [
                    'id' => $i->id,
                    'direction_id' => $i->direction_id,
                    'direction_name' => $i->direction?->name,
                    'start_date' => $i->start_date?->toDateString(),
                    'end_date' => $i->end_date?->toDateString(),
                    'capacity' => $i->capacity,
                    'qualities' => $i->qualities,
                    'reserved_count' => $reserved,
                    'available' => max(0, ($i->capacity ?? 0) - $reserved),
                ];
            });

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json($internships);
        }

        return view('university.calendar', compact('internships'));
    }

    public function company(Request $request)
    {
        $user = Auth::user();
        $company = $user?->company;

        if (! $company) {
            abort(403, 'Доступ только для пользователей-компаний');
        }

        $internships = Internship::with(['direction', 'university'])
            ->orderBy('start_date')
            ->get()
            ->map(function ($i) {
                $reserved = StudentInternship::where('internship_id', $i->id)->count();

                return [
                    'id' => $i->id,
                    'university_name' => $i->university?->name,
                    'direction_id' => $i->direction_id,
                    'direction_name' => $i->direction?->name,
                    'start_date' => $i->start_date?->toDateString(),
                    'end_date' => $i->end_date?->toDateString(),
                    'capacity' => $i->capacity,
                    'qualities' => $i->qualities,
                    'reserved_count' => $reserved,
                    'available' => max(0, ($i->capacity ?? 0) - $reserved),
                ];
            });

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json($internships);
        }

        return view('company.calendar', compact('internships'));
    }
}

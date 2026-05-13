<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class DocumentController extends Controller
{
    public function main()
    {
        $documents = Document::all();
        return view('documents', compact('documents'));
    }

    public function index(Request $request)
    {
        $documents = Document::all();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json($documents);
        }
        return view('documents', compact('documents'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_internship_id' => 'required|integer',
            'file_path'             => 'required|string|max:255',
            'type'                  => 'required|string|max:100',
        ]);

        Document::create($validated);

        return redirect()->back()->with('success', 'Документ успешно добавлен');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'student_internship_id' => 'nullable|integer',
            'file_path'             => 'nullable|string|max:255',
            'type'                  => 'nullable|string|max:100',
        ]);

        $data = array_filter($validated, function ($value) {
            return $value !== null && $value !== "";
        });

        if (empty($data)) {
            return redirect()->back()->with('warning', 'Нет данных для обновления');
        }

        $document = Document::findOrFail($id);
        $document->update($data);

        return redirect()->back()->with('success', 'Данные документа обновлены');
    }

    public function destroy($id)
    {
        Document::destroy($id);
        return redirect()->back()->with('success', 'Документ удален');
    }
}

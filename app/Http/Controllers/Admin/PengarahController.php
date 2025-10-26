<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengarah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PengarahController extends Controller
{
    /**
     * Display the pengarah page.
     */
    public function index()
    {
        return view('Admin.pengarah');
    }

    /**
     * Get data for DataTables.
     */
    public function getData(Request $request)
    {
        $query = Pengarah::with('user')->select('pengarah.*');

        // Apply date filters if provided
        if ($request->has('date_from') && $request->date_from != '') {
            $query->whereDate('tarikh', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to != '') {
            $query->whereDate('tarikh', '<=', $request->date_to);
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action_buttons', function ($row) {
                $viewBtn = '<button class="btn btn-info btn-sm view-btn" data-id="' . $row->id . '" title="Lihat"><i class="fas fa-eye"></i></button>';
                $editBtn = '<button class="btn btn-primary btn-sm edit-btn" data-id="' . $row->id . '" title="Edit"><i class="fas fa-edit"></i></button>';
                $deleteBtn = '<button class="btn btn-danger btn-sm delete-btn" data-id="' . $row->id . '" title="Padam"><i class="fas fa-trash"></i></button>';
                return $viewBtn . ' ' . $editBtn . ' ' . $deleteBtn;
            })
            ->rawColumns(['action_buttons'])
            ->make(true);
    }

    /**
     * Store a newly created pengarah.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tajuk' => 'required|string|max:255',
            'perkara' => 'required|string',
            'tarikh' => 'required|date',
            'status' => 'required|string|max:255',
        ]);

        $validated['user_id'] = Auth::id();

        Pengarah::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data berjaya disimpan.'
        ]);
    }

    /**
     * Get pengarah for editing.
     */
    public function edit($id)
    {
        $pengarah = Pengarah::findOrFail($id);
        return response()->json($pengarah);
    }

    /**
     * Update the specified pengarah.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tajuk' => 'required|string|max:255',
            'perkara' => 'required|string',
            'tarikh' => 'required|date',
            'status' => 'required|string|max:255',
        ]);

        $pengarah = Pengarah::findOrFail($id);
        $pengarah->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data berjaya dikemaskini.'
        ]);
    }

    /**
     * Remove the specified pengarah.
     */
    public function destroy($id)
    {
        $pengarah = Pengarah::findOrFail($id);
        $pengarah->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berjaya dipadam.'
        ]);
    }
}

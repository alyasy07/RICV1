<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeranIndustri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class GeranIndustriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Admin.granindustri');
    }

    /**
     * Get data for DataTables
     */
    public function getData(Request $request)
    {
        $query = GeranIndustri::query();

        return DataTables::of($query)
            ->addColumn('action_buttons', function ($row) {
                $viewBtn = '<button class="btn btn-sm btn-primary view-geran-btn" data-id="' . $row->id . '" title="Lihat Butiran">
                    <i class="fas fa-eye"></i>
                </button>';
                $editBtn = '<button class="btn btn-sm btn-info edit-geran-btn" data-id="' . $row->id . '" title="Edit">
                    <i class="fas fa-edit"></i>
                </button>';
                $deleteBtn = '<button class="btn btn-sm btn-danger delete-geran-btn" data-id="' . $row->id . '" title="Padam">
                    <i class="fas fa-trash"></i>
                </button>';
                return $viewBtn . ' ' . $editBtn . ' ' . $deleteBtn;
            })
            ->editColumn('jumlah_dana_dipohon', function ($row) {
                return $row->jumlah_dana_dipohon;
            })
            ->rawColumns(['action_buttons'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pemohon' => 'required|string|max:255',
            'institusi_terlibat' => 'required|string|max:255',
            'tajuk_penyelidikan' => 'required|string',
            'jumlah_dana_dipohon' => 'required|numeric|min:0',
            'tempoh_penyelidikan' => 'required|string|max:255',
            'status_permohonan' => 'required|in:Tidak Berjaya,Dalam Proses,Lulus'
        ]);

        $validated['user_id'] = Auth::id();

        GeranIndustri::create($validated);

        return response()->json(['success' => true, 'message' => 'Permohonan berjaya disimpan.']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $geran = GeranIndustri::findOrFail($id);
        return response()->json($geran->toArray());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $geran = GeranIndustri::findOrFail($id);

        $validated = $request->validate([
            'nama_pemohon' => 'required|string|max:255',
            'institusi_terlibat' => 'required|string|max:255',
            'tajuk_penyelidikan' => 'required|string',
            'jumlah_dana_dipohon' => 'required|numeric|min:0',
            'tempoh_penyelidikan' => 'required|string|max:255',
            'status_permohonan' => 'required|in:Tidak Berjaya,Dalam Proses,Lulus'
        ]);

        $geran->update($validated);

        return response()->json(['success' => true, 'message' => 'Permohonan berjaya dikemaskini.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $geran = GeranIndustri::findOrFail($id);
        $geran->delete();

        return response()->json(['success' => true, 'message' => 'Permohonan berjaya dipadam.']);
    }
}

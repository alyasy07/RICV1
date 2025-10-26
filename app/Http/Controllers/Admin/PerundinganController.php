<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Perundingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PerundinganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Admin.perundingan');
    }

    /**
     * Get data for DataTables
     */
    public function getData(Request $request)
    {
        $query = Perundingan::query();

        return DataTables::of($query)
            ->addColumn('action_buttons', function ($row) {
                $viewBtn = '<button class="btn btn-sm btn-primary view-perundingan-btn" data-id="' . $row->id . '" title="Lihat Butiran">
                    <i class="fas fa-eye"></i>
                </button>';
                $editBtn = '<button class="btn btn-sm btn-info edit-perundingan-btn" data-id="' . $row->id . '" title="Edit">
                    <i class="fas fa-edit"></i>
                </button>';
                $deleteBtn = '<button class="btn btn-sm btn-danger delete-perundingan-btn" data-id="' . $row->id . '" title="Padam">
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
            'nama_ketua_penyelidik' => 'required|string|max:255',
            'penyelidik_bersama' => 'nullable|string',
            'nama_pelanggan' => 'required|string|max:255',
            'bidang_projek' => 'required|string|max:255',
            'lokasi_projek' => 'required|string|max:255',
            'tajuk_penyelidikan' => 'required|string',
            'jumlah_dana_dipohon' => 'required|numeric|min:0',
            'tempoh_penyelidikan' => 'required|string|max:255',
            'status_permohonan' => 'required|in:Tidak Berjaya,Dalam Proses,Lulus'
        ]);

        $validated['user_id'] = Auth::id();

        Perundingan::create($validated);

        return response()->json(['success' => true, 'message' => 'Permohonan berjaya disimpan.']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $perundingan = Perundingan::findOrFail($id);
        return response()->json($perundingan->toArray());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $perundingan = Perundingan::findOrFail($id);

        $validated = $request->validate([
            'nama_ketua_penyelidik' => 'required|string|max:255',
            'penyelidik_bersama' => 'nullable|string',
            'nama_pelanggan' => 'required|string|max:255',
            'bidang_projek' => 'required|string|max:255',
            'lokasi_projek' => 'required|string|max:255',
            'tajuk_penyelidikan' => 'required|string',
            'jumlah_dana_dipohon' => 'required|numeric|min:0',
            'tempoh_penyelidikan' => 'required|string|max:255',
            'status_permohonan' => 'required|in:Tidak Berjaya,Dalam Proses,Lulus'
        ]);

        $perundingan->update($validated);

        return response()->json(['success' => true, 'message' => 'Permohonan berjaya dikemaskini.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $perundingan = Perundingan::findOrFail($id);
        $perundingan->delete();

        return response()->json(['success' => true, 'message' => 'Permohonan berjaya dipadam.']);
    }
}

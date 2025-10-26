<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MoaMou;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class MoaMouController extends Controller
{
    public function index()
    {
        return view('Admin.moamou');
    }

    public function getData()
    {
        $moamou = MoaMou::select(['id', 'jenis_perundingan', 'agensi_terlibat', 'tajuk_penyelidikan', 'status_permohonan']);

        return DataTables::of($moamou)
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                return '
                    <button class="btn btn-info btn-sm view-moa-btn" data-id="'.$row->id.'">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button class="btn btn-warning btn-sm edit-moa-btn" data-id="'.$row->id.'">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn btn-danger btn-sm delete-moa-btn" data-id="'.$row->id.'">
                        <i class="fas fa-trash"></i>
                    </button>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_perundingan' => 'required|string|max:255',
            'agensi_terlibat' => 'required|string|max:255',
            'tajuk_penyelidikan' => 'required|string',
            'status_permohonan' => 'required|in:Tidak Berjaya,Dalam Proses,Lulus',
        ]);

        $validated['user_id'] = Auth::id();

        MoaMou::create($validated);

        return response()->json(['success' => true, 'message' => 'Data berjaya disimpan!']);
    }

    public function edit($id)
    {
        $moamou = MoaMou::findOrFail($id);
        return response()->json($moamou);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'jenis_perundingan' => 'required|string|max:255',
            'agensi_terlibat' => 'required|string|max:255',
            'tajuk_penyelidikan' => 'required|string',
            'status_permohonan' => 'required|in:Tidak Berjaya,Dalam Proses,Lulus',
        ]);

        $moamou = MoaMou::findOrFail($id);
        $moamou->update($validated);

        return response()->json(['success' => true, 'message' => 'Data berjaya dikemaskini!']);
    }

    public function destroy($id)
    {
        $moamou = MoaMou::findOrFail($id);
        $moamou->delete();

        return response()->json(['success' => true, 'message' => 'Data berjaya dihapus!']);
    }
}

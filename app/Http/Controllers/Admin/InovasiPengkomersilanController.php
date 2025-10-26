<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InovasiPengkomersilan;
use App\Models\Pelaporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class InovasiPengkomersilanController extends Controller
{
    /**
     * Display the Inovasi dan Pengkomersilan page
     */
    public function index()
    {
        return view('Admin.inovasipengkomersilan');
    }

    /**
     * Get data for DataTables
     */
    public function getData(Request $request)
    {
        $inovasi = Pelaporan::where('jenis', 'inovasi_pengkomersilan')
            ->select([
                'pelaporan.id', 
                'title as pelaporan',
                'pemberi_dana',
                'tarikh_tutup', 
                'jumlah_dana',
                'status',
                'pelaporan.created_at',
                'pelaporan.updated_at'
            ]);
        
        // Apply date filters if provided
        if ($request->filled('date_from')) {
            $inovasi->whereDate('tarikh_tutup', '>=', $request->date_from);
        }
        
        if ($request->filled('date_to')) {
            $inovasi->whereDate('tarikh_tutup', '<=', $request->date_to);
        }

        return DataTables::of($inovasi)
            ->addIndexColumn()
            ->addColumn('action_buttons', function ($row) {
                $viewBtn = '<button class="btn btn-sm btn-primary view-btn" data-id="' . $row->id . '" title="Lihat Butiran">
                    <i class="fas fa-eye"></i>
                </button>';
                $editBtn = '<button class="btn btn-sm btn-info edit-btn" data-id="' . $row->id . '" title="Edit">
                    <i class="fas fa-edit"></i>
                </button>';
                $deleteBtn = '<button class="btn btn-sm btn-danger delete-btn" data-id="' . $row->id . '" title="Padam">
                    <i class="fas fa-trash"></i>
                </button>';
                return $viewBtn . ' ' . $editBtn . ' ' . $deleteBtn;
            })
            ->rawColumns(['action_buttons'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pelaporan' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        // Create the main pelaporan record
        $pelaporan = new Pelaporan();
        $pelaporan->user_id = Auth::id(); // Use authenticated user's ID
        $pelaporan->title = $request->pelaporan;
        $pelaporan->pemberi_dana = $request->pemberi_dana;
        $pelaporan->tarikh_tutup = $request->tarikh_tutup;
        $pelaporan->jumlah_dana = $request->jumlah_dana;
        $pelaporan->status = $request->status;
        $pelaporan->jenis = 'inovasi_pengkomersilan';
        $pelaporan->save();
        
        // Create the related inovasi_pengkomersilan record (only with ID)
        $inovasi = new InovasiPengkomersilan();
        $inovasi->pelaporan_id = $pelaporan->id;
        $inovasi->save();
        
        return response()->json(['success' => true]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pelaporan = Pelaporan::findOrFail($id);
        
        // Return only pelaporan data
        $data = [
            'id' => $pelaporan->id,
            'pelaporan' => $pelaporan->title,
            'pemberi_dana' => $pelaporan->pemberi_dana,
            'tarikh_tutup' => $pelaporan->tarikh_tutup,
            'jumlah_dana' => $pelaporan->jumlah_dana,
            'status' => $pelaporan->status,
        ];
        
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'pelaporan' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        // Update the main pelaporan record
        $pelaporan = Pelaporan::findOrFail($id);
        $pelaporan->title = $request->pelaporan;
        $pelaporan->pemberi_dana = $request->pemberi_dana;
        $pelaporan->tarikh_tutup = $request->tarikh_tutup;
        $pelaporan->jumlah_dana = $request->jumlah_dana;
        $pelaporan->status = $request->status;
        $pelaporan->save();
        
        // Ensure related record exists
        $inovasi = InovasiPengkomersilan::where('pelaporan_id', $id)->first();
        
        if (!$inovasi) {
            $inovasi = new InovasiPengkomersilan();
            $inovasi->pelaporan_id = $id;
            $inovasi->save();
        }
        
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Deleting the pelaporan will cascade delete the related inovasi
        $pelaporan = Pelaporan::findOrFail($id);
        $pelaporan->delete();
        
        return response()->json(['success' => true]);
    }
}
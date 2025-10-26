<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GlobalAntarabangsa;
use App\Models\Pelaporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class GlobalAntarabangsaController extends Controller
{
    /**
     * Display the Global dan Pengantarabangsaan page
     */
    public function index()
    {
        return view('Admin.globalantarabangsa');
    }

    /**
     * Get data for DataTables
     */
    public function getData(Request $request)
    {
        $globalAntarabangsa = Pelaporan::where('jenis', 'global_antarabangsa')
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
            $globalAntarabangsa->whereDate('tarikh_tutup', '>=', $request->date_from);
        }
        
        if ($request->filled('date_to')) {
            $globalAntarabangsa->whereDate('tarikh_tutup', '<=', $request->date_to);
        }

        return DataTables::of($globalAntarabangsa)
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
        $pelaporan->jenis = 'global_antarabangsa';
        $pelaporan->save();
        
        // Create empty related record just for foreign key relationship
        $globalAntarabangsa = new GlobalAntarabangsa();
        $globalAntarabangsa->pelaporan_id = $pelaporan->id;
        $globalAntarabangsa->save();
        
        return response()->json(['success' => true]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pelaporan = Pelaporan::findOrFail($id);
        $globalAntarabangsa = GlobalAntarabangsa::where('pelaporan_id', $id)->first();
        
        // Combine data from both models for the response
        $data = [
            'id' => $pelaporan->id,
            'pelaporan' => $pelaporan->title,
            'pemberi_dana' => $pelaporan->pemberi_dana,
            'tarikh_tutup' => $pelaporan->tarikh_tutup,
            'jumlah_dana' => $pelaporan->jumlah_dana,
            'status' => $pelaporan->status,
        ];
        
        // Add details if available
        if ($globalAntarabangsa) {
            $data['kategori_kerjasama'] = $globalAntarabangsa->kategori_kerjasama;
            $data['skop_kerjasama'] = $globalAntarabangsa->skop_kerjasama;
            $data['negara'] = $globalAntarabangsa->negara;
            $data['institusi'] = $globalAntarabangsa->institusi;
            $data['impak_kerjasama'] = $globalAntarabangsa->impak_kerjasama;
        }
        
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
        $globalAntarabangsa = GlobalAntarabangsa::where('pelaporan_id', $id)->first();
        
        if (!$globalAntarabangsa) {
            $globalAntarabangsa = new GlobalAntarabangsa();
            $globalAntarabangsa->pelaporan_id = $id;
            $globalAntarabangsa->save();
        }
        
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Deleting the pelaporan will cascade delete the related global_antarabangsa
        $pelaporan = Pelaporan::findOrFail($id);
        $pelaporan->delete();
        
        return response()->json(['success' => true]);
    }
}
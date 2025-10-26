<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PenyelidikanKeusahawanan;
use App\Models\Pelaporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PenyelidikanKeusahawananController extends Controller
{
    /**
     * Display the Penyelidikan dan Keusahawanan page
     */
    public function index()
    {
        return view('Admin.penyelidikankeusahawanan');
    }

    /**
     * Get data for DataTables
     */
    public function getData(Request $request)
    {
        // Add debug logging
        \Log::info('PenyelidikanKeusahawanan getData called with:', [
            'request' => $request->all(),
            'date_from' => $request->date_from,
            'date_to' => $request->date_to
        ]);
        
        $penyelidikan = Pelaporan::where('jenis', 'penyelidikan_keusahawanan')
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
            $penyelidikan->whereDate('tarikh_tutup', '>=', $request->date_from);
        }
        
        if ($request->filled('date_to')) {
            $penyelidikan->whereDate('tarikh_tutup', '<=', $request->date_to);
        }

        // Debug the SQL query
        \Log::info('PenyelidikanKeusahawanan SQL query: ' . $penyelidikan->toSql());
        
        // Debug the query results
        $results = $penyelidikan->get();
        \Log::info('PenyelidikanKeusahawanan query results:', ['count' => $results->count(), 'results' => $results->toArray()]);
        
        $dt = DataTables::of($penyelidikan)
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
            ->rawColumns(['action_buttons']);
            
        // Debug the DataTables response before sending
        $response = $dt->make(true);
        \Log::info('DataTables response:', [
            'recordsTotal' => $response->getData()->recordsTotal,
            'recordsFiltered' => $response->getData()->recordsFiltered,
            'data' => count($response->getData()->data)
        ]);
        
        return $response;
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
        $pelaporan->jenis = 'penyelidikan_keusahawanan';
        $pelaporan->save();
            
        // Create empty related record just for foreign key relationship
        $penyelidikan = new PenyelidikanKeusahawanan();
        $penyelidikan->pelaporan_id = $pelaporan->id;
        $penyelidikan->save();
        
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
        $penyelidikan = PenyelidikanKeusahawanan::where('pelaporan_id', $id)->first();
        
        if (!$penyelidikan) {
            $penyelidikan = new PenyelidikanKeusahawanan();
            $penyelidikan->pelaporan_id = $id;
            $penyelidikan->save();
        }
        
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Deleting the pelaporan will cascade delete the related penyelidikan
        $pelaporan = Pelaporan::findOrFail($id);
        $pelaporan->delete();
        
        return response()->json(['success' => true]);
    }
}
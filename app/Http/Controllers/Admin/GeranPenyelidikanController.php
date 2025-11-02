<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeranPenyelidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class GeranPenyelidikanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Admin.geranpenyelidikan');
    }

    /**
     * Get data for DataTables
     */
    public function getData(Request $request)
    {
        try {
            $query = GeranPenyelidikan::query();

            // Filter by date range if provided
            if ($request->has('date_from') && $request->date_from != '') {
                $query->whereDate('tarikh_tutup_permohonan', '>=', $request->date_from);
            }

            if ($request->has('date_to') && $request->date_to != '') {
                $query->whereDate('tarikh_tutup_permohonan', '<=', $request->date_to);
            }

            return DataTables::of($query)
                ->addColumn('nama_penyelidik', function ($row) {
                    return $row->nama_ketua_penyelidik;
                })
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
                ->editColumn('tarikh_tutup_permohonan', function ($row) {
                    return $row->tarikh_tutup_permohonan ? $row->tarikh_tutup_permohonan->format('d/m/Y') : '-';
                })
                ->editColumn('jumlah_dana', function ($row) {
                    return $row->jumlah_dana;
                })
                ->rawColumns(['action_buttons'])
                ->make(true);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error in GeranPenyelidikanController@getData', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'error' => 'Database error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Log the incoming request for debugging
            \Illuminate\Support\Facades\Log::info('GeranPenyelidikan store request', $request->all());
            
            // Validate the input
            $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
                'nama_ketua_penyelidik' => 'required|string|max:255',
                'penyelidik_bersama' => 'nullable|string',
                'nama_geran' => 'required|string|max:255',
                'pemberi_dana' => 'required|string|max:255',
                'tarikh_tutup_permohonan' => 'required|date',
                'tajuk_penyelidikan' => 'required|string',
                'jumlah_dana' => 'required|numeric|min:0',
                'status_permohonan' => 'required|in:Tidak Berjaya,Dalam Proses,Lulus'
            ]);
            
            if ($validator->fails()) {
                \Illuminate\Support\Facades\Log::warning('GeranPenyelidikan validation failed', [
                    'errors' => $validator->errors()->toArray()
                ]);
                
                return response()->json([
                    'success' => false,
                    'message' => 'Sila perbaiki ralat berikut:',
                    'errors' => $validator->errors()
                ], 422);
            }
            
            $validated = $validator->validated();
            
            // Map the authenticated user's string ID to an integer for compatibility
            $userId = 1; // Default for admin
            $authId = Auth::id();
            
            \Illuminate\Support\Facades\Log::info('Current user ID', ['user_id' => $authId]);
            
            // Map string user IDs to integers
            if (is_string($authId) && !is_numeric($authId)) {
                $userIdMap = [
                    'ADMIN001' => 1,
                    'PKA001' => 2
                    // Add more mappings as needed
                ];
                
                if (isset($userIdMap[$authId])) {
                    $userId = $userIdMap[$authId];
                }
            } elseif (is_numeric($authId)) {
                $userId = (int)$authId;
            }
            
            \Illuminate\Support\Facades\Log::info('Mapped user ID for database', ['mapped_id' => $userId]);
            
            $validated['user_id'] = $userId;
            
            // Create and save the model
            $geran = GeranPenyelidikan::create($validated);
            \Illuminate\Support\Facades\Log::info('GeranPenyelidikan created successfully', ['id' => $geran->id]);

            return response()->json(['success' => true, 'message' => 'Permohonan berjaya disimpan.']);
        } catch (\Exception $e) {
            // Log the error for debugging
            \Illuminate\Support\Facades\Log::error('Error in GeranPenyelidikanController@store', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false, 
                'message' => 'Ralat sistem: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $geran = GeranPenyelidikan::findOrFail($id);
            $data = $geran->toArray();
            // Format date for HTML date input (YYYY-MM-DD)
            $data['tarikh_tutup_permohonan'] = $geran->tarikh_tutup_permohonan->format('Y-m-d');
            // Format date for display (d/m/Y)
            $data['tarikh_tutup_permohonan_formatted'] = $geran->tarikh_tutup_permohonan->format('d/m/Y');
            return response()->json($data);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error in GeranPenyelidikanController@edit', [
                'id' => $id,
                'error' => $e->getMessage()
            ]);
            
            return response()->json([
                'success' => false, 
                'message' => 'Ralat berlaku: ' . $e->getMessage()
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            // Log the incoming request for debugging
            \Illuminate\Support\Facades\Log::info('GeranPenyelidikan update request', array_merge(['id' => $id], $request->all()));
            
            $geran = GeranPenyelidikan::findOrFail($id);

            // Validate the input
            $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
                'nama_ketua_penyelidik' => 'required|string|max:255',
                'penyelidik_bersama' => 'nullable|string',
                'nama_geran' => 'required|string|max:255',
                'pemberi_dana' => 'required|string|max:255',
                'tarikh_tutup_permohonan' => 'required|date',
                'tajuk_penyelidikan' => 'required|string',
                'jumlah_dana' => 'required|numeric|min:0',
                'status_permohonan' => 'required|in:Tidak Berjaya,Dalam Proses,Lulus'
            ]);
            
            if ($validator->fails()) {
                \Illuminate\Support\Facades\Log::warning('GeranPenyelidikan validation failed on update', [
                    'id' => $id,
                    'errors' => $validator->errors()->toArray()
                ]);
                
                return response()->json([
                    'success' => false,
                    'message' => 'Sila perbaiki ralat berikut:',
                    'errors' => $validator->errors()
                ], 422);
            }
            
            $validated = $validator->validated();
            
            // We don't update user_id during updates to preserve original creator
            // If we needed to update it, we would apply the same logic as in store()

            $geran->update($validated);
            \Illuminate\Support\Facades\Log::info('GeranPenyelidikan updated successfully', ['id' => $id]);

            return response()->json(['success' => true, 'message' => 'Permohonan berjaya dikemaskini.']);
        } catch (\Exception $e) {
            // Log the error for debugging
            \Illuminate\Support\Facades\Log::error('Error in GeranPenyelidikanController@update', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false, 
                'message' => 'Ralat sistem: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $geran = GeranPenyelidikan::findOrFail($id);
            $geran->delete();
            \Illuminate\Support\Facades\Log::info('GeranPenyelidikan deleted successfully', ['id' => $id]);

            return response()->json(['success' => true, 'message' => 'Permohonan berjaya dipadam.']);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error in GeranPenyelidikanController@destroy', [
                'id' => $id,
                'error' => $e->getMessage()
            ]);
            
            return response()->json([
                'success' => false, 
                'message' => 'Ralat berlaku: ' . $e->getMessage()
            ], 500);
        }
    }
}

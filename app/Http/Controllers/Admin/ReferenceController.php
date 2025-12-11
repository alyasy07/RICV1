<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ReferenceController extends Controller
{
    public function index(Request $request)
    {
        $query = Reference::with('uploader')->latest();

        // filter by type
        if ($request->filled('type') && $request->type !== 'all') {
            $type = $request->type;
            if ($type === 'link') {
                $query->where('reference_type', 'link');
            } elseif ($type === 'doc') {
                $query->where('reference_type', 'file')->whereIn('file_type', ['doc', 'docx']);
            } elseif ($type === 'ppt') {
                $query->where('reference_type', 'file')->whereIn('file_type', ['ppt', 'pptx']);
            } else {
                $query->where('reference_type', 'file')->where('file_type', $type);
            }
        }

        // simple search on title and description
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $references = $query->paginate(20)->appends($request->only(['type','search']));

        return view('admin.references.index', compact('references'));
    }

    public function create()
    {
        return view('admin.references.create');
    }

    public function store(Request $request)
    {
        // Validate based on reference type
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'reference_type' => 'required|in:file,link',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        if ($request->reference_type === 'file') {
            $rules['file'] = 'required|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx|max:10240';
        } else {
            $rules['url'] = 'required|url|max:255';
        }

        $validated = $request->validate($rules);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailFile = $request->file('thumbnail');
            if ($thumbnailFile->isValid()) {
                $thumbnailName = time() . '_thumb_' . $thumbnailFile->getClientOriginalName();
                $thumbnailPath = $thumbnailFile->storeAs('references/thumbnails', $thumbnailName, 'public');
            }
        }

        if ($request->reference_type === 'file' && $request->hasFile('file')) {
            $file = $request->file('file');

            // ensure uploaded file is valid (not a failed/empty upload)
            if (! $file->isValid()) {
                $err = $file->getError();
                Log::warning('Uploaded file is not valid', ['error' => $err]);
                return back()->with('error', 'Uploaded file is invalid or failed to upload. Check file size and try again.');
            }

            // ensure we have a temporary path to read from
            if (empty($file->getRealPath())) {
                Log::warning('Uploaded file real path is empty', ['name' => $file->getClientOriginalName(), 'error' => $file->getError()]);
                return back()->with('error', 'Uploaded file failed to save temporarily. This may be due to server upload limits.');
            }

            $filename = time() . '_' . $file->getClientOriginalName();

            try {
                $path = $file->storeAs('references', $filename, 'public');
            } catch (\Throwable $e) {
                Log::error('Reference upload failed', ['exception' => $e, 'name' => $file->getClientOriginalName(), 'tmp' => $file->getRealPath(), 'size' => $file->getSize(), 'error' => $file->getError()]);
                return back()->with('error', 'File upload failed.');
            }

            Reference::create([
                'title' => $validated['title'],
                'description' => $validated['description'] ?? null,
                'reference_type' => 'file',
                'file_path' => $path,
                'thumbnail_path' => $thumbnailPath,
                'file_type' => $file->getClientOriginalExtension(),
                'file_size' => $file->getSize(),
                'uploaded_by' => Auth::user()->userID,
            ]);

        } elseif ($request->reference_type === 'link') {
            Reference::create([
                'title' => $validated['title'],
                'description' => $validated['description'] ?? null,
                'reference_type' => 'link',
                'url' => $validated['url'],
                'thumbnail_path' => $thumbnailPath,
                'file_type' => 'link',
                'uploaded_by' => Auth::user()->userID,
            ]);
        } else {
            return back()->with('error', 'Please provide either a file or a valid URL.');
        }

        return redirect()->route('admin.references.index')
            ->with('success', 'Reference saved successfully.');
    }

    public function show(Reference $reference)
    {
        // If it's a link and accessed directly, redirect to the URL
        if ($reference->reference_type === 'link' && !request()->has('modal')) {
            return redirect($reference->url);
        }
        
        return view('admin.references.show', compact('reference'));
    }

    public function edit(Reference $reference)
    {
        return view('admin.references.edit', compact('reference'));
    }

    public function update(Request $request, Reference $reference)
    {
        // Determine validation rules based on reference type
        if ($reference->reference_type === 'link') {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'url' => 'required|url|max:500',
                'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
        } else {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx|max:10240',
                'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
        }

        $reference->title = $validated['title'];
        $reference->description = $validated['description'] ?? null;

        // Handle URL update for links
        if ($reference->reference_type === 'link' && isset($validated['url'])) {
            $reference->url = $validated['url'];
        }

        // Handle file update for file references
        if ($reference->reference_type === 'file' && $request->hasFile('file')) {
            // delete old file only if path is present
            if (! empty($reference->file_path)) {
                Storage::disk('public')->delete($reference->file_path);
            }

            $file = $request->file('file');

            if (! $file->isValid()) {
                Log::warning('Update: uploaded file invalid', ['error' => $file->getError()]);
                return back()->with('error', 'Uploaded file is invalid or failed to upload.');
            }

            if (empty($file->getRealPath())) {
                Log::warning('Update: uploaded file real path empty', ['name' => $file->getClientOriginalName(), 'error' => $file->getError()]);
                return back()->with('error', 'Uploaded file failed to save temporarily. This may be due to server upload limits.');
            }

            $filename = time() . '_' . $file->getClientOriginalName();

            try {
                $path = $file->storeAs('references', $filename, 'public');
            } catch (\Throwable $e) {
                Log::error('Reference update upload failed', ['exception' => $e, 'name' => $file->getClientOriginalName(), 'tmp' => $file->getRealPath(), 'size' => $file->getSize(), 'error' => $file->getError()]);
                return back()->with('error', 'File upload failed.');
            }

            $reference->file_path = $path;
            $reference->file_type = $file->getClientOriginalExtension();
            $reference->file_size = $file->getSize();
        }

        // Handle thumbnail update
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail if exists
            if ($reference->thumbnail_path) {
                Storage::disk('public')->delete($reference->thumbnail_path);
            }
            
            $thumbnailFile = $request->file('thumbnail');
            if ($thumbnailFile->isValid()) {
                $thumbnailName = time() . '_thumb_' . $thumbnailFile->getClientOriginalName();
                $reference->thumbnail_path = $thumbnailFile->storeAs('references/thumbnails', $thumbnailName, 'public');
            }
        }

        $reference->save();

        return redirect()->route('admin.references.index')
            ->with('success', 'Reference updated successfully.');
    }

    public function destroy(Reference $reference)
    {
        if (! empty($reference->file_path)) {
            Storage::disk('public')->delete($reference->file_path);
        }
        if (! empty($reference->thumbnail_path)) {
            Storage::disk('public')->delete($reference->thumbnail_path);
        }
        $reference->delete();

        return redirect()->route('admin.references.index')
            ->with('success', 'Reference deleted successfully.');
    }

    public function download(Reference $reference)
    {
        $filePath = storage_path('app/public/' . $reference->file_path);

        if (file_exists($filePath)) {
            // Handle preflight CORS requests
            if (request()->getMethod() === 'OPTIONS') {
                return response('', 200)->withHeaders([
                    'Access-Control-Allow-Origin' => '*',
                    'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE, OPTIONS',
                    'Access-Control-Allow-Headers' => 'Content-Type, Authorization, X-Requested-With, Range',
                    'Access-Control-Max-Age' => '86400',
                ]);
            }

            // Serve file inline with comprehensive CORS headers
            return response()->file($filePath)->withHeaders([
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET, OPTIONS',
                'Access-Control-Allow-Headers' => 'Content-Type, Range',
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . basename($reference->file_path) . '"',
            ]);
        }

        return back()->with('error', 'File not found.');
    }

    /**
     * Serve PDF for public viewing (without auth middleware)
     */
    public function servePdf(Reference $reference)
    {
        $filePath = storage_path('app/public/' . $reference->file_path);

        if (file_exists($filePath)) {
            return response()->file($filePath, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . basename($reference->file_path) . '"',
                'Access-Control-Allow-Origin' => '*',
                'Cache-Control' => 'public, max-age=3600',
            ]);
        }

        abort(404, 'File not found');
    }

    /**
     * User-facing index page (read-only access)
     */
    public function userIndex(Request $request)
    {
        $query = Reference::with('uploader')->latest();

        // filter by type
        if ($request->filled('type') && $request->type !== 'all') {
            $type = $request->type;
            if ($type === 'link') {
                $query->where('reference_type', 'link');
            } elseif ($type === 'doc') {
                $query->where('reference_type', 'file')->whereIn('file_type', ['doc', 'docx']);
            } elseif ($type === 'ppt') {
                $query->where('reference_type', 'file')->whereIn('file_type', ['ppt', 'pptx']);
            } else {
                $query->where('reference_type', 'file')->where('file_type', $type);
            }
        }

        // simple search on title and description
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $references = $query->paginate(20)->appends($request->only(['type','search']));

        return view('user.references.index', compact('references'));
    }

    /**
     * User-facing show page (read-only access)
     */
    public function userShow(Reference $reference)
    {
        return view('user.references.show', compact('reference'));
    }
}

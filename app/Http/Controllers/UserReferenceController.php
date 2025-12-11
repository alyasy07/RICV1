<?php

namespace App\Http\Controllers;

use App\Models\Reference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserReferenceController extends Controller
{
    /**
     * User-facing index page (read-only access)
     */
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

        return view('User.references.index', compact('references'));
    }

    /**
     * User-facing show page (read-only access)
     */
    public function show(Reference $reference)
    {
        return view('User.references.show', compact('reference'));
    }

    /**
     * Download reference file for users
     */
    public function download(Reference $reference)
    {
        if ($reference->reference_type === 'link') {
            return redirect($reference->url);
        }

        $filePath = storage_path('app/public/' . $reference->file_path);

        if (!file_exists($filePath)) {
            return back()->with('error', 'File not found.');
        }

        return response()->download($filePath, $reference->title . '.' . $reference->file_type);
    }
}
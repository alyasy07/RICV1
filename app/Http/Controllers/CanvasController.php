<?php

namespace App\Http\Controllers;

use App\Models\Canvas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CanvasController extends Controller
{
    use AuthorizesRequests;
    public function index(Request $request)
    {
        $query = Canvas::where('user_id', Auth::id())
            ->orderBy('updated_at', 'desc');

        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('research_working_title', 'like', "%{$searchTerm}%")
                  ->orWhere('abstract', 'like', "%{$searchTerm}%");
            });
        }

        $canvases = $query->paginate(5);

        return view('canvas.my-canvas', compact('canvases'));
    }

    public function create()
    {
        return view('canvas.create');
    }

    public function store(Request $request)
    {
        try {
            $messages = [
                'research_working_title.required' => 'The research working title field is required.',
                'research_working_title.max' => 'The research working title must not exceed 255 characters.',
            ];

            $validated = $request->validate([
                'research_working_title' => 'required|string|max:255',
                'thesis_title' => 'nullable|string|max:255',
                'abstract' => 'nullable|array',
                'abstract.*' => 'nullable|string',
                'results_summary' => 'nullable|string',
                'background_items' => 'nullable|array',
                'background_items.*' => 'nullable|string',
                'flows' => 'nullable|array',
                'flows.*.problem' => 'nullable|string',
                'flows.*.objective' => 'nullable|string',
                'flows.*.methodology' => 'nullable|string',
                'flows.*.discussion' => 'nullable|string',
                'flows.*.conclusion' => 'nullable|string',
            ], $messages);

            $canvas = Canvas::create([
                'user_id' => Auth::id(),
                'research_working_title' => $validated['research_working_title'],
                'thesis_title' => $validated['thesis_title'] ?? null,
                'abstract' => !empty($validated['abstract']) ? json_encode($validated['abstract']) : null,
                'results_summary' => $validated['results_summary'] ?? null,
            ]);

            if (!empty($validated['background_items'])) {
                foreach ($validated['background_items'] as $index => $content) {
                    if (!empty(trim($content))) {  // Only save non-empty items
                        $canvas->backgroundItems()->create([
                            'content' => $content,
                            'order' => $index,
                        ]);
                    }
                }
            }

            if (!empty($validated['flows'])) {
                foreach ($validated['flows'] as $index => $flow) {
                    $canvas->flows()->create([
                        'problem' => $flow['problem'] ?? null,
                        'objective' => $flow['objective'] ?? null,
                        'methodology' => $flow['methodology'] ?? null,
                        'discussion' => $flow['discussion'] ?? null,
                        'conclusion' => $flow['conclusion'] ?? null,
                        'order' => $index,
                    ]);
                }
            }

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'message' => 'Canvas created successfully',
                    'id' => $canvas->id,
                    'redirect' => route('canvas.index')
                ], 200);
            }

            return redirect()->route('canvas.index')
                ->with('success', 'Canvas created successfully.');

        } catch (\Exception $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'message' => 'Failed to save canvas: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Failed to save canvas: ' . $e->getMessage()]);
        }
    }

    public function show(Canvas $canvas)
    {
        $this->authorize('view', $canvas);
        
        $canvas->load(['backgroundItems', 'flows']);
        
        return view('canvas.show', compact('canvas'));
    }

    public function edit(Canvas $canvas)
    {
        $this->authorize('update', $canvas);
        
        $canvas->load(['backgroundItems', 'flows']);
        
        return view('canvas.edit', compact('canvas'));
    }

    public function update(Request $request, Canvas $canvas)
    {
        $this->authorize('update', $canvas);

        $messages = [
            'research_working_title.required' => 'The research working title field is required.',
            'research_working_title.max' => 'The research working title must not exceed 255 characters.',
        ];

        $validated = $request->validate([
            'research_working_title' => 'required|string|max:255',
            'thesis_title' => 'nullable|string|max:255',
            'abstract' => 'nullable|array',
            'abstract.*' => 'nullable|string',
            'results_summary' => 'nullable|string',
            'background_items' => 'array',
            'background_items.*' => 'string',
            'flows' => 'array',
            'flows.*.problem' => 'nullable|string',
            'flows.*.objective' => 'nullable|string',
            'flows.*.methodology' => 'nullable|string',
            'flows.*.discussion' => 'nullable|string',
            'flows.*.conclusion' => 'nullable|string',
        ]);

        $canvas->update([
            'research_working_title' => $validated['research_working_title'],
            'thesis_title' => $validated['thesis_title'] ?? null,
            'abstract' => !empty($validated['abstract']) ? json_encode($validated['abstract']) : null,
            'results_summary' => $validated['results_summary'] ?? null,
        ]);

        // Update background items
        $canvas->backgroundItems()->delete();
        if (!empty($validated['background_items'])) {
            foreach ($validated['background_items'] as $index => $content) {
                if (!empty(trim($content))) {  // Only save non-empty items
                    $canvas->backgroundItems()->create([
                        'content' => $content,
                        'order' => $index,
                    ]);
                }
            }
        }

        // Update flows
        $canvas->flows()->delete();
        if (!empty($validated['flows'])) {
            foreach ($validated['flows'] as $index => $flow) {
                $canvas->flows()->create([
                    'problem' => $flow['problem'] ?? null,
                    'objective' => $flow['objective'] ?? null,
                    'methodology' => $flow['methodology'] ?? null,
                    'discussion' => $flow['discussion'] ?? null,
                    'conclusion' => $flow['conclusion'] ?? null,
                    'order' => $index,
                ]);
            }
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'message' => 'Canvas updated successfully',
                'redirect' => route('canvas.index')
            ], 200);
        }

        return redirect()->route('canvas.index')
            ->with('success', 'Canvas updated successfully.');
    }

    public function destroy(Canvas $canvas)
    {
        $this->authorize('delete', $canvas);
        
        $canvas->delete();
        
        return redirect()->route('canvas.index')
            ->with('success', 'Canvas deleted successfully.');
    }

    public function export(Canvas $canvas)
    {
        $this->authorize('view', $canvas);
        
        $canvas->load(['backgroundItems', 'flows']);
        
        $pdf = PDF::loadView('canvas.pdf', compact('canvas'));
        
        return $pdf->download($canvas->research_working_title . '.pdf');
    }
}
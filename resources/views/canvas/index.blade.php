<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Canvases</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; padding: 20px; }
        .container { max-width: 1200px; margin: 0 auto; }
        .header { background: white; padding: 30px; margin-bottom: 30px; border-radius: 8px; }
        .header h1 { font-size: 28px; margin-bottom: 10px; }
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px; }
        .card { background: white; padding: 20px; border-radius: 8px; border: 2px solid #ddd; }
        .card h3 { font-size: 20px; margin-bottom: 10px; color: #333; }
        .card p { color: #666; margin-bottom: 15px; font-size: 14px; }
        .badge { display: inline-block; background: #3b82f6; color: white; padding: 5px 15px; border-radius: 20px; font-size: 12px; margin-bottom: 15px; }
        .buttons { margin-top: 20px; }
        .buttons a, .buttons button { 
            display: inline-block; 
            padding: 12px 24px; 
            margin-right: 10px; 
            margin-bottom: 10px;
            text-decoration: none; 
            border-radius: 5px; 
            font-weight: bold;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }
        .btn-view { background: #3b82f6; color: white; }
        .btn-edit { background: #10b981; color: white; }
        .btn-delete { background: #ef4444; color: white; }
        .btn-view:hover { background: #2563eb; }
        .btn-edit:hover { background: #059669; }
        .btn-delete:hover { background: #dc2626; }
        .btn-create { background: #3b82f6; color: white; padding: 12px 24px; text-decoration: none; border-radius: 5px; display: inline-block; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>My Research Canvases</h1>
            <p>All your research ideas and projects in one place.</p>
            <a href="{{ route('canvas.create') }}" class="btn-create">+ Create New Canvas</a>
        </div>

        @if($canvases->isEmpty())
            <div class="card">
                <h3>No Canvases Yet</h3>
                <p>Create your first canvas to get started.</p>
                <a href="{{ route('canvas.create') }}" class="btn-create">Create Your First Canvas</a>
            </div>
        @else
            <div class="grid">
                @foreach($canvases as $canvas)
                    <div class="card">
                        <h3>{{ $canvas->research_working_title }}</h3>
                        @if($canvas->thesis_title)
                            <p>{{ $canvas->thesis_title }}</p>
                        @endif
                        <span class="badge">Canvas</span>
                        <p><small>Last Updated: {{ $canvas->updated_at->diffForHumans() }}</small></p>
                        
                        <div class="buttons">
                            <a href="{{ route('canvas.show', $canvas) }}" class="btn-view">VIEW</a>
                            <a href="{{ route('canvas.edit', $canvas) }}" class="btn-edit">EDIT</a>
                            <form action="{{ route('canvas.destroy', $canvas) }}" method="POST" style="display: inline;" class="delete-form" data-canvas-title="{{ $canvas->thesis_title }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="showDeleteModal(this)" class="btn-delete">DELETE</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <div style="margin-top: 30px;">
                {{ $canvases->links() }}
            </div>
        @endif
    </div>
</body>
</html>
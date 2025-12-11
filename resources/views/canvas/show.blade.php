@extends('layouts.canvas')

@section('content')
<style>
    .canvas-view-container {
        background: white;
        max-width: 100%;
        margin: 0 auto;
        padding: 20px;
    }
    
    .canvas-header {
        background: linear-gradient(to right, #1e3a8a 0%, #1e40af 50%, #7c2d12 100%);
        color: white;
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    
    .canvas-header-content {
        flex: 1;
        text-align: center;
    }
    
    .canvas-logo {
        width: 60px;
        height: 60px;
        object-fit: contain;
    }
    
    .canvas-title {
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 5px;
    }
    
    .canvas-subtitle {
        font-size: 14px;
        font-style: italic;
        color: #fed7aa;
    }
    
    .title-section {
        margin-bottom: 10px;
        padding: 8px 12px;
        background-color: #f3f4f6;
        border-left: 3px solid #1e40af;
        border-radius: 4px;
    }
    
    .section-title {
        font-size: 13px;
        font-weight: bold;
        margin-bottom: 5px;
        color: #1e3a8a;
    }
    
    .section-content {
        font-size: 12px;
        color: #374151;
        line-height: 1.5;
    }
    
    .abstract-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 8px;
        margin-bottom: 15px;
    }
    
    .abstract-box {
        border: 1px solid #999;
        padding: 8px;
        border-radius: 4px;
        min-height: 80px;
    }
    
    .abstract-box-title {
        font-weight: bold;
        margin-bottom: 5px;
        font-size: 11px;
        text-transform: uppercase;
    }
    
    .abstract-box-content {
        font-size: 10px;
        line-height: 1.3;
    }
    
    .main-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 15px;
    }
    
    .main-table th {
        border: 1px solid black;
        padding: 8px;
        text-align: center;
        font-weight: bold;
        font-size: 13px;
        background-color: #dbeafe;
        color: #1e3a8a;
    }
    
    .main-table td {
        border: 1px solid black;
        padding: 10px;
        vertical-align: top;
        font-size: 12px;
        min-height: 200px;
        white-space: pre-line;
    }
    
    .vertical-f-content {
        writing-mode: vertical-lr;
        text-orientation: upright;
        font-size: 10px;
        font-weight: bold;
        background-color: #1e40af;
        color: white;
        text-align: center;
        padding: 5px 0;
    }
    
    .canvas-footer {
        text-align: center;
        margin-top: 15px;
        font-size: 10px;
        color: white;
        background-color: #7c2d12;
        padding: 10px;
        border-radius: 4px;
    }
    
    .action-buttons {
        position: fixed;
        top: 80px;
        right: 20px;
        display: flex;
        gap: 10px;
        z-index: 1000;
    }
    
    .btn {
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }
    
    .btn-primary {
        background-color: #4f46e5;
        color: white;
    }
    
    .btn-primary:hover {
        background-color: #4338ca;
    }
    
    .btn-secondary {
        background-color: #6b7280;
        color: white;
    }
    
    .btn-secondary:hover {
        background-color: #4b5563;
    }
    
    @media (max-width: 768px) {
        .abstract-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .action-buttons {
            position: static;
            margin-bottom: 15px;
            justify-content: center;
        }
    }
</style>

<div class="action-buttons">
    <a href="{{ route('canvas.edit', $canvas) }}" class="btn btn-primary">
        <i class="fas fa-edit"></i>
        Edit Canvas
    </a>
    <a href="{{ route('canvas.export', $canvas->id) }}" class="btn btn-secondary">
        <i class="fas fa-download"></i>
        Export PDF
    </a>
</div>

<div class="canvas-view-container">
    <!-- Header -->
    <div class="canvas-header">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="canvas-logo" onerror="this.style.display='none'">
        <div class="canvas-header-content">
            <div class="canvas-title">RESEARCH IDEATION CANVAS ©</div>
            <div class="canvas-subtitle">Visualizing Research Ideas from Strategic Perspectives</div>
        </div>
    </div>
    
    <!-- Research Working Title -->
    <div class="title-section">
        <div class="section-title">RESEARCH WORKING TITLE (NANO-IDEAS)</div>
        <div class="section-content">{{ $canvas->research_working_title }}</div>
    </div>
    
    <!-- Thesis Title -->
    <div class="title-section">
        <div class="section-title">THESIS / RESEARCH REPORT TITLE (FINAL)</div>
        <div class="section-content">{{ $canvas->thesis_title }}</div>
    </div>
    
    <!-- Abstract: 7SEAS -->
    <div class="title-section">
        <div class="section-title">ABSTRACT : 7SEAS (MICRO-IDEAS)</div>
    </div>
    <div class="abstract-grid">
        @php
            $abstractLabels = ['Statement', 'Evidence', 'Approach', 'Solution', 'Expected', 'Advantage', 'Summary'];
            $abstractColors = ['#fef3c7', '#dbeafe', '#e0e7ff', '#fce7f3', '#dcfce7', '#fed7aa', '#e9d5ff'];
            $abstractData = is_array($canvas->abstract) ? $canvas->abstract : json_decode($canvas->abstract, true) ?? [];
        @endphp
        @for($i = 0; $i < 7; $i++)
            <div class="abstract-box" style="background-color: {{ $abstractColors[$i] }};">
                <div class="abstract-box-title">{{ $abstractLabels[$i] }}</div>
                <div class="abstract-box-content">{{ $abstractData[$i] ?? '' }}</div>
            </div>
        @endfor
    </div>
    
    <!-- Main Table -->
    <table class="main-table">
        <thead>
            <tr>
                <th style="width: 15%;">RESEARCH BACKGROUND</th>
                <th style="width: 20px;">F I</th>
                <th style="width: 15%;">PROBLEMS</th>
                <th style="width: 20px;">F II</th>
                <th style="width: 15%;">OBJECTIVES</th>
                <th style="width: 15%;">METHODOLOGY</th>
                <th style="width: 20px;">F III</th>
                <th style="width: 11%;">RESULTS</th>
                <th style="width: 11%;">DISCUSSION</th>
                <th style="width: 11%;">CONCLUSION</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    @if($canvas->backgroundItems)
                        @foreach($canvas->backgroundItems as $index => $item)
                            @if(!empty($item->content))
                                <strong>Nano-Idea {{ $index + 1 }}:</strong><br>
                                {{ $item->content }}
                                @if(!$loop->last)<br><br>@endif
                            @endif
                        @endforeach
                    @endif
                </td>
                <td class="vertical-f-content">LITERATURE</td>
                <td>{{ isset($canvas->flows[0]) ? $canvas->flows[0]['problem'] : '' }}</td>
                <td class="vertical-f-content">RESEARCH</td>
                <td>{{ isset($canvas->flows[0]) ? $canvas->flows[0]['objective'] : '' }}</td>
                <td>{{ isset($canvas->flows[0]) ? $canvas->flows[0]['methodology'] : '' }}</td>
                <td class="vertical-f-content">ANALYSIS↓DATA↓LR</td>
                <td>{{ $canvas->results_summary ?? '' }}</td>
                <td>{{ isset($canvas->flows[0]) ? $canvas->flows[0]['discussion'] : '' }}</td>
                <td>{{ isset($canvas->flows[0]) ? $canvas->flows[0]['conclusion'] : '' }}</td>
            </tr>
        </tbody>
    </table>
    
    <!-- Footer -->
    <div class="canvas-footer">
        <p>Copyright © {{ date('Y') }} v 3 Nik Zulkarnaen Khidzir (zulkarnaen.k@umk.edu.mv) & Khairul Azhar Mat Daud, Universiti Malaysia Kelantan (azhar.md@umk.edu.mv)</p>
    </div>
</div>
@endsection
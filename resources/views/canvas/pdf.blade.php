<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Research Ideation Canvas</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 0;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        
        html, body {
            width: 297mm;
            height: 210mm;
            overflow: hidden;
        }
        
        body {
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 0;
        }
        
        .a4-landscape {
            width: 297mm;
            height: 210mm;
            background: white;
            padding: 3mm;
            display: flex;
            flex-direction: column;
            margin: 0;
            page-break-after: avoid;
            position: relative;
            transform: scale(0.98);
            transform-origin: top left;
        }
        
        .header {
            width: 100%;
            margin-bottom: 5px;
            border-top: 3px solid #1e40af;
            border-bottom: 3px solid #1e40af;
            background-color: #ffffff !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        
        .header-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .header-table td {
            vertical-align: middle;
            padding: 10px;
        }
        
        .header-table td.logo-cell {
            width: 120px;
            text-align: center;
        }
        
        .header-table td.content-cell {
            text-align: center;
        }
        
        .logo {
            width: 100px;
            height: auto;
            max-height: 60px;
            display: inline-block;
        }
        
        h1 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
            color: #1e40af !important;
            letter-spacing: 1px;
        }
        
        .subtitle {
            font-size: 12px;
            font-style: italic;
            color: #dc2626 !important;
        }
        
        .title-section {
            margin-bottom: 1px;
            padding: 3px 5px;
            background-color: #f3f4f6;
            border-left: 3px solid #9ca3af;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        
        .section-title {
            font-size: 11px;
            font-weight: bold;
            margin-bottom: 1px;
            color: #6b7280;
        }
        
        .section-subtitle {
            font-size: 9px;
            font-style: italic;
            margin-bottom: 2px;
            letter-spacing: 0.5px;
        }
        
        .section-content {
            font-size: 9px;
            margin-bottom: 2px;
            line-height: 1.2;
        }
        
        .abstract-grid {
            display: table;
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
            margin-bottom: 2px;
        }
        
        .abstract-box {
            display: table-cell;
            border: 1px solid #999;
            padding: 2px 3px;
            font-size: 6px;
            height: 25px;
            vertical-align: top;
            line-height: 1.1;
            width: 14.28%; /* 100% / 7 boxes */
            background-color: #f9fafb;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        
        .abstract-box-title {
            font-weight: bold;
            margin-bottom: 1px;
            font-size: 6px;
            text-transform: uppercase;
            display: block;
            color: #6b7280;
        }
        
        .main-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            border: 1px solid black;
        }
        
        .main-table th {
            border: 1px solid black;
            padding: 4px;
            text-align: center;
            font-weight: bold;
            font-size: 11px;
            background-color: #f3f4f6;
            height: 25px;
            color: #6b7280;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        
        .main-table td {
            border: 1px solid black;
            padding: 4px;
            vertical-align: top;
            height: 70mm;
            font-size: 8px;
            word-break: break-word;
            white-space: pre-line;
            line-height: 1.3;
        }

        /* Specific column handling */
        .main-table td:first-child,
        .main-table td:nth-child(8) {
            word-break: break-word;
            white-space: pre-line;
            font-size: 7px;
            line-height: 1.2;
        }
        
        .main-table td:first-child strong {
            font-size: 7px;
            margin-bottom: 2px;
        }

        .main-table th.f-column,
        .main-table td.f-column {
            width: 20px;
            max-width: 20px;
            min-width: 20px;
            padding: 4px 0;
            text-align: center;
            font-size: 8px;
            background-color: #0e7490;
            color: white;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        
        /* Column widths */
        .main-table th:first-child,
        .main-table td:first-child { width: 15%; }
        .main-table th:nth-child(3),
        .main-table td:nth-child(3) { width: 15%; }
        .main-table th:nth-child(5),
        .main-table td:nth-child(5) { width: 15%; }
        .main-table th:nth-child(6),
        .main-table td:nth-child(6) { width: 15%; }
        .main-table th:nth-child(8),
        .main-table td:nth-child(8) { width: 11%; }
        .main-table th:nth-child(9),
        .main-table td:nth-child(9) { width: 11%; }
        .main-table th:nth-child(10),
        .main-table td:nth-child(10) { width: 11%; }
        
        .main-table {
            width: 100%;
            margin: 0;
            table-layout: fixed;
        }
        
        .research-bg-cell {
            width: 120px;
        }
        .vertical-f-content {
            writing-mode: vertical-lr;
            text-orientation: upright;
            font-size: 8px;
            font-weight: bold;
            line-height: 1;
            letter-spacing: 0;
            display: block;
        }
        
        .footer {
            text-align: center;
            margin-top: 8px;
            font-size: 8px;
            color: white;
            background-color: #6b21a8;
            padding: 4px 8px;
            line-height: 1.2;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        
        @media print {
            @page {
                size: A4 landscape;
                margin: 0;
            }
            
            html, body {
                margin: 0 !important;
                padding: 0 !important;
                background: white !important;
                width: 297mm !important;
                height: 210mm !important;
                overflow: visible !important;
            }
            
            .a4-landscape {
                width: 297mm !important;
                height: 210mm !important;
                padding: 5mm !important;
                margin: 0 !important;
                transform: none !important;
                overflow: visible !important;
            }

            .main-table {
                width: 100% !important;
                border-collapse: collapse !important;
                table-layout: fixed !important;
                display: table !important;
                visibility: visible !important;
                overflow: visible !important;
            }

            .main-table td {
                font-size: 8pt !important;
                padding: 2mm !important;
                height: 60mm !important;
                vertical-align: top !important;
                word-break: break-word !important;
                overflow: visible !important;
                display: table-cell !important;
                visibility: visible !important;
                position: relative !important;
                z-index: 1 !important;
            }

            /* Target specific columns */
            .main-table td:first-child, /* Research Background */
            .main-table td:nth-child(8) /* Results */ {
                display: table-cell !important;
                visibility: visible !important;
                font-size: 8pt !important;
                position: relative !important;
                z-index: 2 !important;
                background-color: white !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            
            /* Force content visibility */
            @-moz-document url-prefix() {
                .main-table td:first-child,
                .main-table td:nth-child(8) {
                    display: block !important;
                }
            }
            
            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
                color-adjust: exact !important;
            }
            
            .main-table {
                page-break-inside: avoid;
                table-layout: fixed;
            }

            .title-section {
                margin-bottom: 3mm;
                padding: 2mm;
            }

            .header {
                margin-bottom: 5mm;
                padding: 8px 15px;
                background-color: #ffffff !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            
            .logo {
                width: 80px;
                height: auto;
                max-height: 50px;
            }

            h1 {
                font-size: 20px;
                margin-bottom: 2mm;
                color: #1e40af !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .subtitle {
                font-size: 10px;
                color: #dc2626 !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .title-section {
                margin-bottom: 1mm;
                padding: 1mm;
                background-color: #f3f4f6 !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .section-title {
                font-size: 10px;
                color: #6b7280 !important;
            }
            
            .section-content {
                font-size: 8px;
                margin-bottom: 1mm;
            }
            
            .abstract-grid {
                display: table;
                width: 100%;
                table-layout: fixed;
                border-collapse: collapse;
                margin-bottom: 2mm;
            }
            
            .abstract-box {
                display: table-cell;
                border: 1px solid #000;
                padding: 1mm 2mm;
                font-size: 5px;
                height: 22px;
                vertical-align: top;
                line-height: 1.1;
                width: 14.28%; /* 100% / 7 boxes */
                background-color: #f9fafb !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            
            .abstract-box-title {
                font-weight: bold;
                margin-bottom: 0.5mm;
                font-size: 5px;
                display: block;
                color: #6b7280 !important;
            }

            .main-table th {
                padding: 2mm;
                font-size: 11px;
                background-color: #f3f4f6 !important;
                color: #6b7280 !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .main-table {
                margin: 0 auto;
                width: 100%;
                table-layout: fixed;
            }

            .main-table td {
                padding: 1.5mm !important;
                height: 60mm;
                font-size: 7pt !important;
                word-wrap: break-word;
                overflow-wrap: break-word;
                white-space: pre-wrap;
                line-height: 1.3 !important;
            }

            .main-table th {
                padding: 2mm;
                font-size: 10px;
                white-space: normal;
            }

            /* Ensure specific columns show content in print */
            .main-table td:first-child,  /* Research Background */
            .main-table td:nth-child(8) { /* Results */
                word-break: break-word !important;
                overflow-wrap: break-word !important;
                white-space: pre-wrap !important;
                padding: 1.5mm !important;
                min-width: 0 !important;
                font-size: 6pt !important;
                line-height: 1.2 !important;
                display: table-cell !important;
                visibility: visible !important;
                color: black !important;
            }
            
            .main-table td:first-child strong {
                display: block !important;
                margin-bottom: 0.5mm !important;
                font-weight: bold !important;
                color: black !important;
                font-size: 6pt !important;
            }
            
            .main-table th.f-column,
            .main-table td.f-column {
                width: 20px;
                padding: 4px 0;
                background-color: #0e7490 !important;
                color: white !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            
            .vertical-f-content {
                font-size: 8px;
                line-height: 1.1;
                display: block !important;
            }

            .main-table th {
                padding: 1mm;
                font-size: 9px;
            }
            
            .footer {
                margin-top: 2mm;
                font-size: 6px;
                padding: 2px 8px;
                line-height: 1.1;
                background-color: #6b21a8 !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }
    </style>
</head>
<body>
    <div class="a4-landscape">
        <div class="header">
            <table class="header-table">
                <tr>
                    <td class="logo-cell">
                        <img src="{{ public_path('images/creative_logo.png') }}" alt="Creative Logo" class="logo" onerror="this.style.display='none'">
                    </td>
                    <td class="content-cell">
                        <h1>RESEARCH IDEATION CANVAS ©</h1>
                        <div class="subtitle">Visualizing Research Ideas from Strategic Perspectives</div>
                    </td>
                    <td class="logo-cell">
                        <img src="{{ public_path('images/umk-logo.png') }}" alt="UMK Logo" class="logo" onerror="this.style.display='none'">
                    </td>
                </tr>
            </table>
        </div>
        
        <div class="title-section">
            <div class="section-title">RESEARCH WORKING TITLE (NANO-IDEAS)</div>
            <div class="section-content">{{ $canvas->research_working_title }}</div>
        </div>
        
        <div class="title-section">
            <div class="section-title">THESIS / RESEARCH REPORT TITLE (FINAL)</div>
            <div class="section-content">{{ $canvas->thesis_title }}</div>
        </div>
        
        <div class="title-section">
            <div class="section-title">ABSTRACT : 7SEAS (MICRO-IDEAS)</div>
            <div class="abstract-grid">
                @php
                    $abstractLabels = ['Statement', 'Evidence', 'Approach', 'Solution', 'Expected', 'Advantage', 'Summary'];
                    $abstractColors = ['#fef3c7', '#dbeafe', '#e0e7ff', '#fce7f3', '#dcfce7', '#fed7aa', '#e9d5ff']; // yellow, blue, purple, pink, green, orange, violet
                    $abstractData = is_array($canvas->abstract) ? $canvas->abstract : json_decode($canvas->abstract, true) ?? [];
                @endphp
                @for($i = 0; $i < 7; $i++)
                    <div class="abstract-box">
                        <div class="abstract-box-title">{{ $abstractLabels[$i] }}</div>
                        <div>{{ $abstractData[$i] ?? '' }}</div>
                    </div>
                @endfor
            </div>
        </div>
        
        <table class="main-table">
            <thead>
                <tr>
                    <th class="research-bg-cell">RESEARCH BACKGROUND</th>
                    <th class="f-column">F I</th>
                    <th>PROBLEMS</th>
                    <th class="f-column">F II</th>
                    <th>OBJECTIVES</th>
                    <th>METHODOLOGY</th>
                    <th class="f-column">F III</th>
                    <th>RESULTS</th>
                    <th>DISCUSSION</th>
                    <th>CONCLUSION</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        @if($canvas->backgroundItems)
                            @foreach($canvas->backgroundItems as $index => $item)
                                @if(!empty($item->content))
                                    <strong>Nano-Idea {{ $index + 1 }}:</strong><br>
                                    {!! nl2br(e($item->content)) !!}
                                    @if(!$loop->last)<br><br>@endif
                                @endif
                            @endforeach
                        @endif
                    </td>
                    <td class="f-column"><div class="vertical-f-content">L<br>I<br>T<br>E<br>R<br>A<br>T<br>U<br>R<br>E</div></td>
                    <td>{!! nl2br(e(isset($canvas->flows[0]) ? $canvas->flows[0]['problem'] : '')) !!}</td>
                    <td class="f-column"><div class="vertical-f-content">R<br>E<br>S<br>E<br>A<br>R<br>C<br>H</div></td>
                    <td>{!! nl2br(e(isset($canvas->flows[0]) ? $canvas->flows[0]['objective'] : '')) !!}</td>
                    <td>{!! nl2br(e(isset($canvas->flows[0]) ? $canvas->flows[0]['methodology'] : '')) !!}</td>
                    <td class="f-column"><div class="vertical-f-content">A<br>N<br>A<br>L<br>Y<br>S<br>I<br>S<br>|<br>v<br>D<br>A<br>T<br>A<br>|<br>v<br>L<br>R</div></td>
                    <td>{!! nl2br(e($canvas->results_summary ?? '')) !!}</td>
                    <td>{!! nl2br(e(isset($canvas->flows[0]) ? $canvas->flows[0]['discussion'] : '')) !!}</td>
                    <td>{!! nl2br(e(isset($canvas->flows[0]) ? $canvas->flows[0]['conclusion'] : '')) !!}</td>
                </tr>
            </tbody>
        </table>
        
        <div class="footer">
            <p>Copyright © {{ date('Y') }} v 3 Nik Zulkarnaen Khidzir (zulkarnaen.k@umk.edu.mv) & Khairul Azhar Mat Daud, Universiti Malaysia Kelantan (azhar.md@umk.edu.mv)</p>
        </div>
    </div>
</body>
</html>
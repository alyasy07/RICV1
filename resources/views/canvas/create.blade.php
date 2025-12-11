@extends('layouts.canvas')

@section('styles')
<link href="{{ asset('css/reference-theme.css') }}?v={{ time() }}" rel="stylesheet">
<style>
/* Canvas Form Specific Styles */
.form-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
}

.section {
    margin-bottom: 1rem;
    background: white;
    border-radius: 12px;
    padding: 2rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.grid-3 {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
}

.grid-2 {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 1.5rem;
}

/* Sticky Note Styles */
.sticky-note {
    position: relative;
    padding: 1.5rem;
    border-radius: 8px;
    min-height: 200px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s ease;
}

.sticky-note:hover {
    transform: scale(1.02);
    z-index: 10;
}

.sticky-yellow { background: linear-gradient(135deg, #fff3cd, #ffeaa7); }
.sticky-blue { background: linear-gradient(135deg, #cce5ff, #74b9ff); }
.sticky-purple { background: linear-gradient(135deg, #e6ccff, #a29bfe); }
.sticky-pink { background: linear-gradient(135deg, #ffccdd, #fd79a8); }
.sticky-green { background: linear-gradient(135deg, #ccffcc, #00b894); }

.pin {
    position: absolute;
    top: -5px;
    left: 50%;
    width: 20px;
    height: 20px;
    background: radial-gradient(circle, #ff6b6b, #e55656);
    border-radius: 50%;
    transform: translateX(-50%);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.pin::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 6px;
    height: 6px;
    background: #333;
    border-radius: 50%;
    transform: translate(-50%, -50%);
}

.sticky-note .label {
    display: block;
    font-weight: 600;
    color: #333;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
}

.sticky-note textarea {
    width: 100%;
    border: none;
    background: transparent;
    resize: none;
    min-height: 100px;
    font-size: 0.9rem;
    line-height: 1.4;
    color: #333;
    outline: none;
    font-family: inherit;
}

.delete-btn {
    position: absolute;
    top: 5px;
    right: 5px;
    background: #ff4757;
    color: white;
    border: none;
    border-radius: 50%;
    width: 24px;
    height: 24px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    opacity: 0.7;
    transition: opacity 0.2s ease;
}

.delete-btn:hover {
    opacity: 1;
}

.hint {
    font-size: 0.75rem;
    color: #666;
    margin-bottom: 0.5rem;
    line-height: 1.3;
}

/* Button Styles */
.btn {
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    text-decoration: none;
}

.btn {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.btn.secondary {
    background: #6b7280;
    color: white;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}

.button-group {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid #e5e7eb;
}

/* Message Styles */
.message {
    padding: 1rem;
    border-radius: 8px;
    margin: 1rem 0;
    display: flex;
    align-items: center;
}

.message.success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.message.error {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.message.warning {
    background: #fff3cd;
    color: #856404;
    border: 1px solid #ffeaa7;
}

/* Form Elements */
.form-textarea {
    width: 100%;
    padding: 0.75rem;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    font-size: 0.9rem;
    line-height: 1.5;
    transition: border-color 0.3s ease;
}

.form-textarea:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

/* Research Flow Individual Boxes */
.flow-box {
    background: white;
    border-radius: 8px;
    padding: 1rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    border-left: 4px solid #667eea;
}

.flow-box.problem {
    background: linear-gradient(135deg, #fff5f5, #fed7d7);
    border-left-color: #e53e3e;
}

.flow-box.objective {
    background: linear-gradient(135deg, #f0fff4, #c6f6d5);
    border-left-color: #38a169;
}

.flow-box.methodology {
    background: linear-gradient(135deg, #fffaf0, #feebc8);
    border-left-color: #dd6b20;
}

.flow-box.discussion {
    background: linear-gradient(135deg, #f7fafc, #e2e8f0);
    border-left-color: #4a5568;
}

.flow-box.conclusion {
    background: linear-gradient(135deg, #f0f4ff, #ddd6fe);
    border-left-color: #7c3aed;
}

.flow-box textarea {
    width: 100%;
    border: none;
    background: transparent;
    resize: vertical;
    min-height: 100px;
    font-size: 0.9rem;
    line-height: 1.4;
    color: #333;
    outline: none;
    font-family: inherit;
}

.form-hint {
    font-size: 0.8rem;
    color: #6b7280;
    margin-bottom: 0.5rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .grid-3 {
        grid-template-columns: 1fr;
    }
    
    .grid-2 {
        grid-template-columns: 1fr;
    }
    
    .button-group {
        flex-direction: column;
        align-items: stretch;
    }
    
    .form-container {
        padding: 1rem;
    }
}
</style>
@endsection

@section('content')
    @include('canvas.form')
@endsection
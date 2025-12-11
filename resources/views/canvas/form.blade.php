@extends('layouts.app')

@section('content')
<link href="{{ asset('css/reference-theme.css') }}?v={{ time() }}" rel="stylesheet">

<div class="main-content">
    <div class="content-container" style="max-width: 1300px; margin: 0 auto;">
        <x-hero-section 
            :title="isset($canvas) ? 'Edit Canvas' : 'Create New Canvas'" 
            :subtitle="isset($canvas) ? 'Update your research canvas details' : 'Start building your research ideas with our interactive canvas'" 
        />

        <div class="form-container">
    <form method="POST" action="{{ isset($canvas) ? route('canvas.update', $canvas->id) : route('canvas.store') }}" style="margin-top: 0;">
        @csrf
        @if(isset($canvas))
            @method('PUT')
        @endif

        <!-- Basic Information -->
        <div class="content-section">
            <h2 class="section-title">Basic Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Working Title -->
                <div class="form-group">
                    <label class="form-label">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Research Working Title
                    </label>
                    <p class="form-hint">Enter your initial research idea (nano-ideas)</p>
                    <textarea name="research_working_title" class="form-textarea" rows="4" required>{{ $canvas->research_working_title ?? '' }}</textarea>
                </div>

                <!-- Final Title -->
                <div class="form-group">
                    <label class="form-label">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                        </svg>
                        Thesis / Research Report Title
                    </label>
                    <p class="form-hint">Final title for your research (optional)</p>
                    <textarea name="thesis_title" class="form-textarea" rows="4">{{ $canvas->thesis_title ?? '' }}</textarea>
                </div>
            </div>

            <!-- Abstract -->
            <div class="section">
                <h3 class="label" style="font-size: 20px; margin-bottom: 15px;">
                    <i class="fas fa-file-alt"></i> Abstract: 7SEAS (MICRO-IDEAS)
                    <span id="microIdeasCounter" style="font-weight: 400; font-size: 0.9rem; color: #64748b;">(0/7 filled)</span>
                </h3>
                <div class="grid grid-3" style="margin-bottom: 20px;">
                    <!-- Box 1 -->
                    <div class="sticky-note sticky-yellow">
                        <div class="pin"></div>
                        <label class="label">Statement</label>
                        <textarea name="abstract[0]" placeholder="Statement of the problem">{{ isset($canvas) && isset($canvas->abstract[0]) ? $canvas->abstract[0] : '' }}</textarea>
                    </div>

                    <!-- Box 2 -->
                    <div class="sticky-note sticky-blue">
                        <div class="pin"></div>
                        <label class="label">Evidence</label>
                        <textarea name="abstract[1]" placeholder="Evidence supporting the problem">{{ isset($canvas) && isset($canvas->abstract[1]) ? $canvas->abstract[1] : '' }}</textarea>
                    </div>

                    <!-- Box 3 -->
                    <div class="sticky-note sticky-purple">
                        <div class="pin"></div>
                        <label class="label">Approach</label>
                        <textarea name="abstract[2]" placeholder="Research approach">{{ isset($canvas) && isset($canvas->abstract[2]) ? $canvas->abstract[2] : '' }}</textarea>
                    </div>

                    <!-- Box 4 -->
                    <div class="sticky-note sticky-pink">
                        <div class="pin"></div>
                        <label class="label">Solution</label>
                        <textarea name="abstract[3]" placeholder="Proposed solution">{{ isset($canvas) && isset($canvas->abstract[3]) ? $canvas->abstract[3] : '' }}</textarea>
                    </div>

                    <!-- Box 5 -->
                    <div class="sticky-note sticky-green">
                        <div class="pin"></div>
                        <label class="label">Expected</label>
                        <textarea name="abstract[4]" placeholder="Expected outcomes">{{ isset($canvas) && isset($canvas->abstract[4]) ? $canvas->abstract[4] : '' }}</textarea>
                    </div>

                    <!-- Box 6 -->
                    <div class="sticky-note sticky-yellow">
                        <div class="pin"></div>
                        <label class="label">Advantage</label>
                        <textarea name="abstract[5]" placeholder="Advantages/Benefits">{{ isset($canvas) && isset($canvas->abstract[5]) ? $canvas->abstract[5] : '' }}</textarea>
                    </div>

                    <!-- Box 7 -->
                    <div class="sticky-note sticky-blue">
                        <div class="pin"></div>
                        <label class="label">Summary</label>
                        <textarea name="abstract[6]" placeholder="Summary/Conclusion">{{ isset($canvas) && isset($canvas->abstract[6]) ? $canvas->abstract[6] : '' }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Research Background -->
        <div class="section">
            <h2 class="section-title">Research Background</h2>
            <div class="grid grid-3" id="backgroundContainer">
                <!-- Nano-Idea 1 -->
                <div class="sticky-note sticky-yellow">
                    <div class="pin"></div>
                    <label class="label">
                        <i class="fas fa-lightbulb"></i> Nano-Idea 1
                    </label>
                    <textarea name="background_items[]">{{ isset($canvas->backgroundItems[0]) ? $canvas->backgroundItems[0]->content : '' }}</textarea>
                </div>

                <!-- Nano-Idea 2 -->
                <div class="sticky-note sticky-blue">
                    <div class="pin"></div>
                    <label class="label">
                        <i class="fas fa-lightbulb"></i> Nano-Idea 2
                    </label>
                    <textarea name="background_items[]">{{ isset($canvas->backgroundItems[1]) ? $canvas->backgroundItems[1]->content : '' }}</textarea>
                </div>

                <!-- Nano-Idea 3 -->
                <div class="sticky-note sticky-purple">
                    <div class="pin"></div>
                    <label class="label">
                        <i class="fas fa-lightbulb"></i> Nano-Idea 3
                    </label>
                    <textarea name="background_items[]">{{ isset($canvas->backgroundItems[2]) ? $canvas->backgroundItems[2]->content : '' }}</textarea>
                    <button type="button" class="delete-btn" onclick="this.parentElement.remove()"><i class="fas fa-times"></i></button>
                </div>

                @if(isset($canvas->backgroundItems))
                    @foreach($canvas->backgroundItems as $index => $item)
                        @if($index >= 3)
                            @php
                                $colors = ['yellow', 'blue', 'purple', 'pink', 'green'];
                                $colorClass = 'sticky-' . $colors[$index % 5];
                            @endphp
                            <div class="sticky-note {{ $colorClass }}">
                                <div class="pin"></div>
                                <label class="label">
                                    <i class="fas fa-lightbulb"></i> Nano-Idea {{ $index + 1 }}
                                </label>
                                <textarea name="background_items[]">{{ $item->content }}</textarea>
                                <button type="button" class="delete-btn" onclick="this.parentElement.remove()"><i class="fas fa-times"></i></button>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
            <div id="backgroundWarning" class="message warning" style="display: none;">
                <i class="fas fa-exclamation-triangle" style="margin-right: 10px;"></i>
                <span>Maximum 10 background items allowed</span>
            </div>
            <button type="button" class="btn" style="width: 100%; margin-top: 20px;" onclick="addBackgroundItem()">
                <i class="fas fa-plus"></i> Add New Background Item
            </button>
        </div>

        <!-- Research Flow -->
        <div class="section">
            <h2 class="section-title">Research Flow</h2>
            
            <!-- Research Flow 1 -->
            <div class="sticky-note sticky-yellow" style="margin-bottom: 30px;">
                <div class="pin"></div>
                <h3 class="label">Research Flow</h3>
                <div class="grid grid-3">
                    <!-- Problem -->
                    <div class="flow-box problem">
                        <label class="label">Problem</label>
                        <div class="hint">• Derive From LR<br>• Research Background<br>• Critical Issues</div>
                        <textarea name="flows[0][problem]">{{ isset($canvas->flows[0]) ? $canvas->flows[0]['problem'] : '' }}</textarea>
                    </div>

                    <!-- Objective -->
                    <div class="flow-box objective">
                        <label class="label">Objective</label>
                        <div class="hint">• S.M.A.R.T<br>• Relate to Title<br>• Problem Basis</div>
                        <textarea name="flows[0][objective]">{{ isset($canvas->flows[0]) ? $canvas->flows[0]['objective'] : '' }}</textarea>
                    </div>

                    <!-- Methodology -->
                    <div class="flow-box methodology">
                        <label class="label">Methodology</label>
                        <div class="hint">• Meet Objectives<br>• Logic / Achievable<br>• Manageable</div>
                        <textarea name="flows[0][methodology]">{{ isset($canvas->flows[0]) ? $canvas->flows[0]['methodology'] : '' }}</textarea>
                    </div>
                </div>
                <div class="grid grid-2" style="margin-top: 20px;">
                    <!-- Discussion -->
                    <div class="flow-box discussion">
                        <label class="label">Discussion</label>
                        <div class="hint">• Relate to Objectives<br>• Alignment<br>• Towards Conclusion</div>
                        <textarea name="flows[0][discussion]">{{ isset($canvas->flows[0]) ? $canvas->flows[0]['discussion'] : '' }}</textarea>
                    </div>

                    <!-- Conclusion -->
                    <div class="flow-box conclusion">
                        <label class="label">Conclusion</label>
                        <div class="hint">• Mapping to Objectives<br>• Significant Contribution<br>• Benefits</div>
                        <textarea name="flows[0][conclusion]">{{ isset($canvas->flows[0]) ? $canvas->flows[0]['conclusion'] : '' }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Expected Results -->
        <div class="section">
            <h2 class="section-title">Expected Results</h2>
            <div class="sticky-note sticky-green">
                <div class="pin"></div>
                <label class="label">
                    <i class="fas fa-chart-line"></i> Expected Results
                </label>
                <div class="hint">
                    • Report Findings • Empirical • Explanatory/Design/Model/Framework<br>
                    • Guidelines / Best Practices • Theory/Concept/Philosophy<br>
                    • Quantitative, Qualitative, Mixed / Hybrid
                </div>
                <textarea name="results_summary">{{ $canvas->results_summary ?? '' }}</textarea>
            </div>
        </div>

        <!-- Form Messages -->
        @if(session('success'))
        <div class="message success">
            <i class="fas fa-check-circle" style="margin-right: 10px;"></i>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        @if($errors->any())
        <div class="message error">
            <i class="fas fa-exclamation-circle" style="margin-right: 10px;"></i>
            <span>{{ $errors->first() }}</span>
        </div>
        @endif

        <!-- Action Buttons -->
        <div class="button-group" style="text-align: right;">
            <a href="{{ route('canvas.index') }}" class="btn secondary">Cancel</a>
            @if(isset($canvas))
            <a href="{{ route('canvas.export', $canvas->id) }}" class="btn secondary"><i class="fas fa-download"></i> Export</a>
            @endif
            <button type="submit" class="btn">Save Canvas</button>
        </div>
    </form>
</div>

<script>
    function addBackgroundItem() {
        const container = document.getElementById('backgroundContainer');
        const warning = document.getElementById('backgroundWarning');
        const count = container.children.length;
        
        if (count >= 10) {
            warning.style.display = 'flex';
            setTimeout(() => {
                warning.style.display = 'none';
            }, 3000);
            return;
        }

        // Hide warning if visible
        warning.style.display = 'none';

        const colors = ['yellow', 'blue', 'purple', 'pink', 'green'];
        const div = document.createElement('div');
        div.className = `sticky-note sticky-${colors[count % 5]}`;
        div.innerHTML = `
            <div class="pin"></div>
            <label class="label">
                <i class="fas fa-lightbulb"></i> Nano-Idea ${count + 1}
            </label>
            <textarea name="background_items[]"></textarea>
            <button type="button" class="delete-btn" onclick="removeBackgroundItem(this)">
                <i class="fas fa-times"></i>
            </button>
        `;
        container.appendChild(div);
    }

    function removeBackgroundItem(button) {
        const warning = document.getElementById('backgroundWarning');
        button.closest('.sticky-note').remove();
        // Hide warning when an item is deleted
        warning.style.display = 'none';
    }

    function updateMicroIdeasCounter() {
        const textareas = document.querySelectorAll('.sticky-note textarea[name^="abstract"]');
        let filledCount = 0;
        textareas.forEach(textarea => {
            if (textarea.value.trim() !== '') {
                filledCount++;
            }
        });
        const counterElement = document.getElementById('microIdeasCounter');
        if (counterElement) {
            counterElement.textContent = `(${filledCount}/7 filled)`;
        }
    }

    // Add event listeners for delete buttons
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                this.closest('.sticky-note').remove();
            });
        });

        const abstractTextareas = document.querySelectorAll('.sticky-note textarea[name^="abstract"]');
        abstractTextareas.forEach(textarea => {
            textarea.addEventListener('input', updateMicroIdeasCounter);
        });

        updateMicroIdeasCounter(); // Initial count on page load
    });
</script>
        </form>
    </div>
    </div>
</div>
@endsection
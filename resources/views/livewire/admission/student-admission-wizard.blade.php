<div class="max-w-6xl mx-auto p-4 space-y-4">

    {{-- Header --}}
    <div class="bg-white border rounded-2xl p-4">
        <div class="flex items-start justify-between gap-4">
            <div>
                <flux:heading size="lg" level="2">Student Admission Wizard</flux:heading>

                <flux:subheading>
                    Student: <span class="font-semibold">{{ $student->name_en }}</span>
                    <span class="mx-2">•</span>
                    Status: <span class="font-semibold">{{ $student->status }}</span>

                    @if($this->locked)
                        <span class="ml-2 text-red-600 font-semibold">Locked (No Edit)</span>
                    @endif
                </flux:subheading>
            </div>

            <div class="flex gap-2">
                <a class="px-3 py-2 rounded-xl border text-sm" href="{{ route('student.index') }}">
                    Back to List
                </a>
            </div>
        </div>

        {{-- Step Nav --}}
        @php
            $firstStep = 2;
            $lastStep  = 8;
        @endphp

        <div class="mt-4 flex flex-wrap gap-2">
            @for($i = $firstStep; $i <= $lastStep; $i++)
                <button
                    type="button"
                    class="px-3 py-2 rounded-xl border text-sm
                           {{ $step === $i ? 'bg-gray-50 font-semibold' : 'hover:bg-gray-50' }}
                           {{ $this->locked ? 'opacity-60 cursor-not-allowed' : '' }}"
                    @if($this->locked) disabled @endif
                    wire:click="goToStep({{ $i }})"
                >
                    Step {{ $i }}
                </button>
            @endfor
        </div>
    </div>

    {{-- Body --}}
    <div class="bg-white border rounded-2xl p-5">
        @switch($step)

            @case(2)
                <livewire:admission.steps.step2-guardian
                    :studentId="$student->id"
                    :locked="$this->locked"
                    wire:key="s2-{{ $student->id }}" />
                @break

            @case(3)
                <livewire:admission.steps.step3-category
                    :studentId="$student->id"
                    :locked="$this->locked"
                    wire:key="s3-{{ $student->id }}" />
                @break

            @case(4)
                <livewire:admission.steps.step4-previous-education
                    :studentId="$student->id"
                    :locked="$this->locked"
                    wire:key="s4-{{ $student->id }}" />
                @break

            @case(5)
                <livewire:admission.steps.step5-declaration
                    :studentId="$student->id"
                    :locked="$this->locked"
                    wire:key="s5-{{ $student->id }}" />
                @break

            @case(6)
                <livewire:admission.steps.step6-pdf
                    :studentId="$student->id"
                    :locked="$this->locked"
                    wire:key="s6-{{ $student->id }}" />
                @break

            @case(7)
                <livewire:admission.steps.step7-office
                    :studentId="$student->id"
                    :locked="$this->locked"
                    wire:key="s7-{{ $student->id }}" />
                @break

            @case(8)
                <livewire:admission.steps.step8-documents
                    :studentId="$student->id"
                    :locked="$this->locked"
                    wire:key="s8-{{ $student->id }}" />
                @break

            @default
                <div class="text-sm text-slate-600">Invalid step.</div>
        @endswitch
    </div>

    {{-- Footer Actions --}}
    <div class="bg-white border rounded-2xl p-4 flex flex-wrap items-center justify-between gap-3">
        <div class="text-sm text-slate-500">
            @if($this->locked)
                Locked — Final submit করা হয়েছে। এডিট করা যাবে না।
            @else
                Step {{ $step }} of {{ $lastStep }}
            @endif
        </div>

        <div class="flex gap-2">
            {{-- Back --}}
            <flux:button
                type="button"
                variant="ghost"
                wire:click="back"
                :disabled="$this->locked || $step === $firstStep"
            >
                Back
            </flux:button>

            {{-- Step 2-7: Save & Next --}}
            @if($step < $lastStep)
                <flux:button
                    type="button"
                    variant="primary"
                    wire:click="requestSave('next')"
                    :disabled="$this->locked"
                    wire:loading.attr="disabled"
                >
                    <span wire:loading.remove>Save & Next</span>
                    <span wire:loading>Saving...</span>
                </flux:button>
            @endif

            {{-- Step 8: Draft + Final Submit --}}
            @if($step === $lastStep)
                <flux:button
                    type="button"
                    variant="ghost"
                    class="border border-slate-200"
                    wire:click="requestSave('draft')"
                    :disabled="$this->locked"
                    wire:loading.attr="disabled"
                >
                    <span wire:loading.remove>Save as Draft</span>
                    <span wire:loading>Saving...</span>
                </flux:button>

                <flux:button
                    type="button"
                    variant="primary"
                    wire:click="finalSubmit"
                    :disabled="$this->locked"
                    wire:loading.attr="disabled"
                >
                    <span wire:loading.remove>Final Submit</span>
                    <span wire:loading>Submitting...</span>
                </flux:button>
            @endif
        </div>
    </div>

</div>

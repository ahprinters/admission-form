<div class="max-w-6xl mx-auto space-y-4">

    {{-- Header --}}
    <flux:card>
        <flux:header title="Student Admission Wizard" subtitle="Student: {{ $student->name_en }} • Status: {{ $student->status }}">
            @if($this->locked)
                <span class="ml-2 text-red-600 font-semibold">Locked (No Edit)</span>
            @endif

            <flux:actions>
                <flux:button href="{{ route('student.index') }}" variant="outline">Back to List</flux:button>
            </flux:actions>
        </flux:header>

        {{-- Step Nav --}}
        <flux:nav>
            @for($i = 2; $i <= 8; $i++)
                <flux:button
                    wire:click="goToStep({{ $i }})"
                    :disabled="$this->locked"
                    :variant="$step === $i ? 'secondary' : 'ghost'"
                >
                    Step {{ $i }}
                </flux:button>
            @endfor
        </flux:nav>
    </flux:card>

    {{-- Body --}}
    <flux:card>
        @switch($step)
            @case(2) <livewire:admission.steps.step2-guardian :studentId="$student->id" :locked="$this->locked" /> @break
            @case(3) <livewire:admission.steps.step3-category :studentId="$student->id" :locked="$this->locked" /> @break
            @case(4) <livewire:admission.steps.step4-previous-education :studentId="$student->id" :locked="$this->locked" /> @break
            @case(5) <livewire:admission.steps.step5-declaration :studentId="$student->id" :locked="$this->locked" /> @break
            @case(6) <livewire:admission.steps.step6-pdf :studentId="$student->id" :locked="$this->locked" /> @break
            @case(7) <livewire:admission.steps.step7-office :studentId="$student->id" :locked="$this->locked" /> @break
            @case(8) <livewire:admission.steps.step8-documents :studentId="$student->id" :locked="$this->locked" /> @break
            @default <flux:text muted>Invalid step.</flux:text>
        @endswitch
    </flux:card>

    {{-- Footer Actions --}}
    <flux:card class="flex items-center justify-between">
        <flux:text muted>
            @if($this->locked)
                Locked — Final submit করা হয়েছে। এডিট করা যাবে না।
            @else
                Step {{ $step }} of 8
            @endif
        </flux:text>

        <flux:actions>
            <flux:button wire:click="back" variant="ghost" :disabled="$this->locked || $step === 2">Back</flux:button>

            @if($step < 8)
                <flux:button wire:click="requestSave('next')" variant="primary" :disabled="$this->locked" wire:loading.attr="disabled">
                    <span wire:loading.remove>Save & Next</span>
                    <span wire:loading>Saving...</span>
                </flux:button>
            @endif

            @if($step === 8)
                <flux:button wire:click="requestSave('draft')" variant="ghost" :disabled="$this->locked" wire:loading.attr="disabled">
                    <span wire:loading.remove>Save as Draft</span>
                    <span wire:loading>Saving...</span>
                </flux:button>

                <flux:button wire:click="finalSubmit" variant="primary" :disabled="$this->locked" wire:loading.attr="disabled">
                    <span wire:loading.remove>Final Submit</span>
                    <span wire:loading>Submitting...</span>
                </flux:button>
            @endif
        </flux:actions>
    </flux:card>

</div>

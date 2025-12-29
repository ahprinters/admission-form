<div class="space-y-6">
    <div>
        <flux:heading size="lg" level="2">Step 7: অফিস কর্তৃক পূরণীয়</flux:heading>
        <flux:subheading>শিক্ষক/হিসাব/অধ্যক্ষের তথ্য ও স্বাক্ষর।</flux:subheading>
    </div>

    <flux:separator variant="subtle" />

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 space-y-5">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <flux:field>
                    <flux:label class="font-semibold text-slate-700">শ্রেণি শিক্ষকের নাম</flux:label>
                    <flux:input wire:model.defer="class_teacher_name" @disabled($locked) />
                    <flux:error name="class_teacher_name" />
                </flux:field>

                <flux:field>
                    <flux:label class="font-semibold text-slate-700">হিসাব রক্ষকের নাম</flux:label>
                    <flux:input wire:model.defer="accountant_name" @disabled($locked) />
                    <flux:error name="accountant_name" />
                </flux:field>

                <flux:field>
                    <flux:label class="font-semibold text-slate-700">Session Fee</flux:label>
                    <flux:input type="number" wire:model.defer="session_fee" @disabled($locked) />
                    <flux:error name="session_fee" />
                </flux:field>

                <flux:field>
                    <flux:label class="font-semibold text-slate-700">Admission Fee</flux:label>
                    <flux:input type="number" wire:model.defer="admission_fee" @disabled($locked) />
                    <flux:error name="admission_fee" />
                </flux:field>

                <flux:field>
                    <flux:label class="font-semibold text-slate-700">বেতন (January)</flux:label>
                    <flux:input type="number" wire:model.defer="monthly_fee_jan" @disabled($locked) />
                    <flux:error name="monthly_fee_jan" />
                </flux:field>

                <flux:field>
                    <flux:label class="font-semibold text-slate-700">বিবিধ</flux:label>
                    <flux:input type="number" wire:model.defer="misc_fee" @disabled($locked) />
                    <flux:error name="misc_fee" />
                </flux:field>
            </div>

            <flux:field>
                <flux:label class="font-semibold text-slate-700">অধ্যক্ষের মন্তব্য</flux:label>
                <flux:textarea rows="3" wire:model.defer="principal_comment" @disabled($locked) />
                <flux:error name="principal_comment" />
            </flux:field>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="rounded-xl border p-4 space-y-2">
                    <div class="text-sm font-semibold">শ্রেণি শিক্ষক স্বাক্ষর</div>
                    @if($class_teacher_signature_path)
                        <img class="h-20 object-contain border rounded-lg p-2"
                             src="{{ asset('storage/'.$class_teacher_signature_path) }}">
                    @endif
                    <input type="file" wire:model="class_teacher_signature" @disabled($locked) class="block w-full text-sm">
                    <flux:error name="class_teacher_signature" />
                </div>

                <div class="rounded-xl border p-4 space-y-2">
                    <div class="text-sm font-semibold">হিসাব রক্ষক স্বাক্ষর</div>
                    @if($accountant_signature_path)
                        <img class="h-20 object-contain border rounded-lg p-2"
                             src="{{ asset('storage/'.$accountant_signature_path) }}">
                    @endif
                    <input type="file" wire:model="accountant_signature" @disabled($locked) class="block w-full text-sm">
                    <flux:error name="accountant_signature" />
                </div>

                <div class="rounded-xl border p-4 space-y-2">
                    <div class="text-sm font-semibold">অধ্যক্ষ স্বাক্ষর</div>
                    @if($principal_signature_path)
                        <img class="h-20 object-contain border rounded-lg p-2"
                             src="{{ asset('storage/'.$principal_signature_path) }}">
                    @endif
                    <input type="file" wire:model="principal_signature" @disabled($locked) class="block w-full text-sm">
                    <flux:error name="principal_signature" />
                </div>
            </div>

        </div>
    </div>
</div>

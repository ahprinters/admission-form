<div class="space-y-6">
    <div>
        <flux:heading size="lg" level="2">Step 4: পূর্ব অধ্যয়নের বিবরণ</flux:heading>
        <flux:subheading>একাধিক পূর্ব প্রতিষ্ঠানের তথ্য যোগ করতে পারবেন।</flux:subheading>
    </div>

    <flux:separator variant="subtle" />

    @error('rows_error')
        <div class="p-3 rounded-xl border border-red-200 bg-red-50 text-red-700 text-sm">
            {{ $message }}
        </div>
    @enderror

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 space-y-4">

            <div class="flex items-center justify-between">
                <div class="text-sm text-slate-600">
                    মোট রেকর্ড: <span class="font-semibold">{{ count($rows) }}</span>
                </div>

                <flux:button
                    type="button"
                    variant="ghost"
                    wire:click="addRow"
                    :disabled="$locked"
                >
                    + Add Row
                </flux:button>
            </div>

            <div class="space-y-4">
                @foreach($rows as $i => $row)
                    <div class="rounded-xl border border-gray-100 p-4 space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="text-sm font-semibold text-slate-700">
                                Record #{{ $i + 1 }}
                            </div>

                            <flux:button
                                type="button"
                                variant="ghost"
                                wire:click="removeRow({{ $i }})"
                                :disabled="$locked"
                            >
                                Remove
                            </flux:button>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                            <flux:field>
                                <flux:label class="font-semibold text-slate-700">প্রতিষ্ঠানের নাম</flux:label>
                                <flux:input
                                    wire:model.defer="rows.{{ $i }}.institution_name"
                                    placeholder="যেমন: ABC School/মাদ্রাসা"
                                    :disabled="$locked"
                                />
                                <flux:error name="rows.{{ $i }}.institution_name" />
                            </flux:field>

                            <flux:field>
                                <flux:label class="font-semibold text-slate-700">শ্রেণি</flux:label>
                                <flux:input
                                    wire:model.defer="rows.{{ $i }}.class_name"
                                    placeholder="যেমন: ৫ম / ৬ষ্ঠ / দাখিল"
                                    :disabled="$locked"
                                />
                                <flux:error name="rows.{{ $i }}.class_name" />
                            </flux:field>

                            <flux:field>
                                <flux:label class="font-semibold text-slate-700">পাসের সন</flux:label>
                                <flux:input
                                    type="number"
                                    wire:model.defer="rows.{{ $i }}.pass_year"
                                    placeholder="যেমন: 2022"
                                    :disabled="$locked"
                                />
                                <flux:error name="rows.{{ $i }}.pass_year" />
                            </flux:field>

                            <flux:field>
                                <flux:label class="font-semibold text-slate-700">প্রাপ্ত GPA</flux:label>
                                <flux:input
                                    wire:model.defer="rows.{{ $i }}.gpa"
                                    placeholder="যেমন: 5.00 / A+"
                                    :disabled="$locked"
                                />
                                <flux:error name="rows.{{ $i }}.gpa" />
                            </flux:field>

                            <flux:field>
                                <flux:label class="font-semibold text-slate-700">ছাড়পত্র নম্বর</flux:label>
                                <flux:input
                                    wire:model.defer="rows.{{ $i }}.transfer_certificate_no"
                                    placeholder="TC No / ছাড়পত্র নম্বর"
                                    :disabled="$locked"
                                />
                                <flux:error name="rows.{{ $i }}.transfer_certificate_no" />
                            </flux:field>

                            <flux:field>
                                <flux:label class="font-semibold text-slate-700">তারিখ</flux:label>
                                <flux:input
                                    type="date"
                                    wire:model.defer="rows.{{ $i }}.transfer_certificate_date"
                                    :disabled="$locked"
                                />
                                <flux:error name="rows.{{ $i }}.transfer_certificate_date" />
                            </flux:field>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

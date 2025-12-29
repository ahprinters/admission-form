<div class="space-y-6">
    <div>
        <flux:heading size="lg" level="2">Step 5: শিক্ষার্থীর অঙ্গীকার ও অভিভাবকের ঘোষণা</flux:heading>
        <flux:subheading>স্বাক্ষর ছবি আপলোড করতে পারবেন (ঐচ্ছিক)।</flux:subheading>
    </div>

    <flux:separator variant="subtle" />

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 space-y-5">

            <flux:field>
                <flux:label class="font-semibold text-slate-700">শিক্ষার্থীর অঙ্গীকার</flux:label>
                <flux:textarea wire:model.defer="student_commitment" rows="4" @disabled($locked)
                    placeholder="শিক্ষার্থীর অঙ্গীকার লিখুন..." />
                <flux:error name="student_commitment" />
            </flux:field>

            <flux:field>
                <flux:label class="font-semibold text-slate-700">অভিভাবকের ঘোষণা</flux:label>
                <flux:textarea wire:model.defer="guardian_declaration" rows="4" @disabled($locked)
                    placeholder="অভিভাবকের ঘোষণা লিখুন..." />
                <flux:error name="guardian_declaration" />
            </flux:field>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="rounded-xl border p-4 space-y-2">
                    <div class="font-semibold text-slate-700 text-sm">শিক্ষার্থীর স্বাক্ষর</div>

                    @if($student_signature_path)
                        <img class="h-24 object-contain border rounded-lg p-2"
                             src="{{ asset('storage/'.$student_signature_path) }}" alt="Student Signature">
                    @endif

                    <input type="file" wire:model="student_signature" @disabled($locked)
                           class="block w-full text-sm" />
                    <flux:error name="student_signature" />
                </div>

                <div class="rounded-xl border p-4 space-y-2">
                    <div class="font-semibold text-slate-700 text-sm">অভিভাবকের স্বাক্ষর</div>

                    @if($guardian_signature_path)
                        <img class="h-24 object-contain border rounded-lg p-2"
                             src="{{ asset('storage/'.$guardian_signature_path) }}" alt="Guardian Signature">
                    @endif

                    <input type="file" wire:model="guardian_signature" @disabled($locked)
                           class="block w-full text-sm" />
                    <flux:error name="guardian_signature" />
                </div>
            </div>

        </div>
    </div>
</div>

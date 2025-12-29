<div class="space-y-6">
    <div>
        <flux:heading size="lg" level="2">Step 8: ডকুমেন্টস আপলোড</flux:heading>
        <flux:subheading>প্রয়োজনীয় কাগজপত্র আপলোড করুন।</flux:subheading>
    </div>

    <flux:separator variant="subtle" />

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 space-y-4">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                @php
                    $items = [
                        ['type'=>'birth_cert','label'=>'Online Birth Certificate','model'=>'birth_cert'],
                        ['type'=>'nid','label'=>'NID (if any)','model'=>'nid'],
                        ['type'=>'tc','label'=>'Previous Institution Transfer Certificate','model'=>'tc'],
                        ['type'=>'certificate','label'=>'Certificate','model'=>'certificate'],
                        ['type'=>'fee_slip','label'=>'Admission Fee Slip','model'=>'fee_slip'],
                    ];
                @endphp

                @foreach($items as $it)
                    <div class="rounded-xl border p-4 space-y-2">
                        <div class="text-sm font-semibold text-slate-700">{{ $it['label'] }}</div>

                        @if(isset($existing[$it['type']]))
                            <a class="text-sm underline text-blue-600"
                               href="{{ asset('storage/'.$existing[$it['type']]['path']) }}" target="_blank">
                                View Uploaded
                            </a>
                        @endif

                        <input type="file" wire:model="{{ $it['model'] }}" @disabled($locked) class="block w-full text-sm">
                        <flux:error name="{{ $it['model'] }}" />
                    </div>
                @endforeach

            </div>

            <div class="text-xs text-slate-500">
                নোট: সর্বশেষ “Final Submit” করলে আর এডিট করা যাবে না।
            </div>

        </div>
    </div>
</div>

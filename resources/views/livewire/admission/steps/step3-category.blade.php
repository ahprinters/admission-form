<div class="space-y-6">
    {{-- Header --}}
    <div class="flex items-start justify-between gap-4">
        <div>
            <flux:heading size="lg" level="2">Step-3: ক্যাটাগরি (শিক্ষার্থী)</flux:heading>
            <flux:subheading>প্রযোজ্য ক্যাটাগরিগুলোতে টিক চিহ্ন দিন। “কোনটিই নয়” দিলে বাকিগুলো বন্ধ হয়ে যাবে।</flux:subheading>

            @if($locked)
                <div class="mt-2 text-sm font-semibold text-red-600">
                    Locked (Final Submitted) — এডিট করা যাবে না।
                </div>
            @endif
        </div>
    </div>

    <flux:separator variant="subtle" />

    {{-- Body --}}
    <div class="bg-white border rounded-2xl p-5 space-y-5">

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">

            {{-- None --}}
            <label class="flex items-center gap-3 p-3 rounded-xl border border-gray-100 bg-gray-50">
                <flux:checkbox wire:model="is_none" :disabled="$locked" />
                <span class="text-sm font-medium text-slate-700">কোনটিই নয়</span>
            </label>

            <label class="flex items-center gap-3 p-3 rounded-xl border border-gray-100">
                <flux:checkbox wire:model="is_working" :disabled="$locked || $is_none" />
                <span class="text-sm font-medium text-slate-700">কর্মজীবী</span>
            </label>

            <label class="flex items-center gap-3 p-3 rounded-xl border border-gray-100">
                <flux:checkbox wire:model="is_landless" :disabled="$locked || $is_none" />
                <span class="text-sm font-medium text-slate-700">ভূমিহীন</span>
            </label>

            <label class="flex items-center gap-3 p-3 rounded-xl border border-gray-100">
                <flux:checkbox wire:model="is_foster" :disabled="$locked || $is_none" />
                <span class="text-sm font-medium text-slate-700">পোষ্য</span>
            </label>

            <label class="flex items-center gap-3 p-3 rounded-xl border border-gray-100">
                <flux:checkbox wire:model="is_freedom_fighter_child" :disabled="$locked || $is_none" />
                <span class="text-sm font-medium text-slate-700">মুক্তিযোদ্ধা পোষ্য</span>
            </label>

            <label class="flex items-center gap-3 p-3 rounded-xl border border-gray-100">
                <flux:checkbox wire:model="is_disabled" :disabled="$locked || $is_none" />
                <span class="text-sm font-medium text-slate-700">প্রতিবন্ধী</span>
            </label>

            <label class="flex items-center gap-3 p-3 rounded-xl border border-gray-100">
                <flux:checkbox wire:model="is_orphan" :disabled="$locked || $is_none" />
                <span class="text-sm font-medium text-slate-700">এতিম</span>
            </label>

            <label class="flex items-center gap-3 p-3 rounded-xl border border-gray-100">
                <flux:checkbox wire:model="is_indigenous" :disabled="$locked || $is_none" />
                <span class="text-sm font-medium text-slate-700">উপজাতি</span>
            </label>

        </div>

    </div>
</div>

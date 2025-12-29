@php
    use Illuminate\Support\Facades\Storage;

    $generatedUrl = $generated_pdf_path
        ? Storage::disk('public')->url($generated_pdf_path)
        : null;
@endphp

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-semibold text-slate-800">Step 6: Admission Form PDF</h2>
            <p class="text-sm text-slate-500">সকল তথ্য যাচাই করে ফাইনাল পিডিএফ তৈরি করুন।</p>
        </div>

        <div class="flex gap-2">
            <button
                wire:click="back"
                class="px-4 py-2 rounded-md border text-sm text-slate-600 hover:bg-slate-100">
                ← Back
            </button>
        </div>
    </div>

    {{-- Info Box --}}
    <div class="bg-blue-50 border border-blue-200 rounded-md p-4 text-sm text-blue-800">
        নিচের তথ্যসমূহ যাচাই করে “Generate PDF” বাটনে ক্লিক করুন। একবার ফাইনাল সাবমিট করলে আর এডিট করা যাবে না।
    </div>

    {{-- Student Summary --}}
    <div class="bg-white border rounded-lg p-5 space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-gray-500">Student Name</p>
                <p class="font-medium">{{ $student?->name_en ?? '-' }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Class</p>
                <p class="font-medium">{{ $student?->class ?? '-' }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Roll</p>
                <p class="font-medium">{{ $student?->roll_number ?? '-' }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Mobile</p>
                <p class="font-medium">{{ $student?->phone ?? '-' }}</p>
            </div>
        </div>

        <div class="pt-4 border-t text-sm text-slate-600">
            নিশ্চিত করুন যে উপরের তথ্যগুলো সঠিক। ফাইনাল সাবমিটের পর আর পরিবর্তন করা যাবে না।
        </div>
    </div>

    {{-- Action Buttons --}}
    <div class="flex justify-between items-center pt-6 border-t">

        <button
            wire:click="back"
            class="px-4 py-2 rounded-md border text-gray-700 hover:bg-gray-100">
            ← আগের ধাপে ফিরে যান
        </button>

        <div class="flex gap-3">
            {{-- Generate PDF --}}
            <button
                wire:click="generatePdf"
                wire:loading.attr="disabled"
                class="px-5 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 flex items-center gap-2">
                <span wire:loading.remove>Generate PDF</span>
                <span wire:loading>Processing...</span>
            </button>

            {{-- Download/Open Generated PDF --}}
            @if($generatedUrl)
                <a
                    href="{{ $generatedUrl }}"
                    target="_blank"
                    class="px-5 py-2 bg-green-600 text-white rounded-md hover:bg-green-700"
                >
                    Open / Download PDF
                </a>
            @endif
        </div>
    </div>

    @if(session()->has('success'))
        <div class="mt-4 p-3 bg-green-50 text-green-700 border border-green-200 rounded">
            {{ session('success') }}
        </div>
    @endif

</div>

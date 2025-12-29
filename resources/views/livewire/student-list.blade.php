<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <flux:heading size="xl" level="1">শিক্ষার্থী তালিকা</flux:heading>
            <flux:subheading>প্রতিষ্ঠানের সকল নিবন্ধিত শিক্ষার্থীদের তালিকা এখানে দেখা যাবে।</flux:subheading>
        </div>

        <div class="flex items-center gap-3">
            <flux:button href="/dashboard" wire:navigate variant="ghost" icon="arrow-left">
                ড্যাশবোর্ড
            </flux:button>

            <flux:button href="/student/create" wire:navigate variant="primary" icon="plus">
                নতুন শিক্ষার্থী
            </flux:button>
        </div>
    </div>

    <flux:separator variant="subtle" />

    {{-- Filters --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 items-center">
            <div class="md:col-span-2">
                <flux:field>
                    <flux:label class="font-semibold text-slate-700">Search</flux:label>
                    <flux:input
                        wire:model.live.debounce.300ms="search"
                        placeholder="নাম / ফোন / ইমেইল / রোল / ক্লাস লিখে সার্চ করুন..."
                    />
                </flux:field>
            </div>

            <div>
                <flux:field>
                    <flux:label class="font-semibold text-slate-700">Per page</flux:label>
                    <flux:select wire:model.live="perPage">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                    </flux:select>
                </flux:field>
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">

        {{-- Success Message --}}
        @if (session()->has('message'))
            <div class="m-4 p-3 bg-green-50 border-l-4 border-green-500 text-green-700 text-sm flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.74-5.24z" clip-rule="evenodd" />
                </svg>
                {{ session('message') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">নাম</th>
                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">ক্লাস</th>
                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">রোল</th>
                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">মোবাইল</th>
                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">স্ট্যাটাস</th>
                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500 text-right">অ্যাকশন</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse($students as $student)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4">
                                <div class="text-sm font-semibold text-slate-800">{{ $student->name_en }}</div>
                                <div class="text-xs text-slate-500">{{ $student->email }}</div>
                            </td>

                            <td class="px-6 py-4 text-sm">
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                    Class {{ $student->class }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-sm text-slate-600">{{ $student->roll_number }}</td>
                            <td class="px-6 py-4 text-sm text-slate-600">{{ $student->phone }}</td>

                            <td class="px-6 py-4 text-sm">
                                @php
                                    $status = $student->status ?? 'draft';
                                @endphp

                                @if($status === 'submitted')
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                        Submitted
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-100">
                                        Draft
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-sm text-right">
                                <div class="flex justify-end gap-3" x-data="{ open:false }">

                                    {{-- Edit Step-1 --}}
                                    <a href="{{ route('student.edit', $student->id) }}"
                                       wire:navigate
                                       class="text-blue-600 hover:text-blue-800 transition p-1"
                                       title="Edit (Step-1)">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </a>

                                    {{-- Admission Wizard Step-2..8 --}}
                                    <a href="{{ route('students.admission', $student->id) }}"
                                       wire:navigate
                                       class="text-emerald-600 hover:text-emerald-800 transition p-1"
                                       title="Admission Wizard (Step-2..8)">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M9 12h6m-6 4h6M9 8h6M5.25 6.75A2.25 2.25 0 017.5 4.5h9A2.25 2.25 0 0118.75 6.75v10.5A2.25 2.25 0 0116.5 19.5h-9A2.25 2.25 0 01 5.25 17.25V6.75z" />
                                        </svg>
                                    </a>

                                    {{-- Delete --}}
                                    <button type="button"
                                            class="text-red-500 hover:text-red-700 transition p-1"
                                            title="Delete"
                                            @click="open=true"
                                            @disabled(($student->status ?? 'draft') === 'submitted')>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>

                                    {{-- Confirm Modal --}}
                                    <div x-show="open" x-cloak
                                         class="fixed inset-0 z-50 flex items-center justify-center"
                                         @keydown.escape.window="open=false">
                                        <div class="absolute inset-0 bg-black/40" @click="open=false"></div>

                                        <div class="relative w-full max-w-md bg-white rounded-2xl shadow-lg border p-5">
                                            <div class="text-lg font-semibold text-slate-800">Delete Student?</div>
                                            <div class="mt-1 text-sm text-slate-600">
                                                আপনি কি নিশ্চিত? এই কাজটি ফিরিয়ে আনা যাবে না।
                                            </div>

                                            <div class="mt-4 flex justify-end gap-2">
                                                <flux:button type="button" variant="ghost" @click="open=false">
                                                    Cancel
                                                </flux:button>

                                                <flux:button type="button" variant="primary"
                                                    class="bg-red-600 hover:bg-red-700"
                                                    @click="open=false; $wire.delete({{ $student->id }})">
                                                    Confirm Delete
                                                </flux:button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="text-slate-600 font-semibold">কোনো শিক্ষার্থী খুঁজে পাওয়া যায়নি।</div>
                                <div class="text-sm text-slate-500 mt-1">সার্চ পরিবর্তন করে আবার চেষ্টা করুন।</div>

                                <div class="mt-4">
                                    <flux:button href="/student/create" wire:navigate variant="primary" icon="plus">
                                        নতুন শিক্ষার্থী যোগ করুন
                                    </flux:button>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="p-4 border-t border-slate-100 bg-slate-50/50">
            {{ $students->links() }}
        </div>
    </div>
</div>

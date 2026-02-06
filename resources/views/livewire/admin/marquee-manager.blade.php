<div class="p-6 bg-gray-50 min-h-screen">

    <div class="max-w-7xl mx-auto">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">Marquee Manager</h1>

            <button wire:click="openCreate"
                class="px-4 py-2 bg-green-700 text-white rounded hover:bg-green-800 transition">
                + Add Marquee
            </button>
        </div>

        {{-- Flash Message --}}
        @if (session('success'))
            <div class="mb-4 p-3 rounded bg-green-100 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        {{-- Table --}}
        <div class="bg-white shadow rounded overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-100 border-b">
                    <tr>
                        <th class="p-3 text-left w-20">Order</th>
                        <th class="p-3 text-left">Title</th>
                        <th class="p-3 text-left">Message</th>
                        <th class="p-3 text-center">Status</th>
                        <th class="p-3 text-center">Schedule</th>
                        <th class="p-3 text-right">Action</th>
                    </tr>
                </thead>

                {{-- Drag & Drop Body --}}
                <tbody wire:sortable="updateOrder">
                    @forelse($items as $item)
                        <tr wire:sortable.item="{{ $item->id }}"
                            wire:key="marquee-{{ $item->id }}"
                            class="border-b hover:bg-gray-50">

                            {{-- Order --}}
                            <td class="p-3">
                                <div class="flex items-center gap-2">
                                    <span class="text-gray-600">#{{ $item->position }}</span>
                                    <button
                                        wire:sortable.handle
                                        class="cursor-move text-gray-500 hover:text-black"
                                        title="Drag to reorder">
                                        ☰
                                    </button>
                                </div>
                            </td>

                            {{-- Title --}}
                            <td class="p-3">
                                {{ $item->title ?? '-' }}
                            </td>

                            {{-- Message --}}
                            <td class="p-3 max-w-md truncate" title="{{ $item->message }}">
                                {{ $item->message }}
                            </td>

                            {{-- Status --}}
                            <td class="p-3 text-center">
                                <button
                                    wire:click="toggleStatus({{ $item->id }})"
                                    class="px-3 py-1 rounded text-sm
                                    {{ $item->status ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $item->status ? 'ON' : 'OFF' }}
                                </button>
                            </td>

                            {{-- Schedule --}}
                            <td class="p-3 text-xs text-gray-600">
                                <div>Start: {{ $item->starts_at ? $item->starts_at->format('d M Y H:i') : '-' }}</div>
                                <div>End: {{ $item->ends_at ? $item->ends_at->format('d M Y H:i') : '-' }}</div>
                            </td>

                            {{-- Actions --}}
                            <td class="p-3 text-right space-x-2">
                                <button wire:click="openEdit({{ $item->id }})"
                                    class="px-3 py-1 border rounded text-blue-600 hover:bg-blue-50">
                                    Edit
                                </button>

                                <button wire:click="delete({{ $item->id }})"
                                    onclick="return confirm('Are you sure?')"
                                    class="px-3 py-1 border rounded text-red-600 hover:bg-red-50">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center p-6 text-gray-500">
                                No marquee items found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Modal --}}
        @if($isModalOpen)
            <div class="fixed inset-0 bg-black/40 flex items-center justify-center z-50">
                <div class="bg-white w-full max-w-xl rounded shadow-lg p-6">
                    <h2 class="text-lg font-semibold mb-4">
                        {{ $marqueeId ? 'Edit Marquee' : 'Add Marquee' }}
                    </h2>

                    <div class="space-y-4">
                        <div>
                            <label class="text-sm font-medium">Title</label>
                            <input type="text" wire:model.defer="title"
                                class="w-full border rounded px-3 py-2">
                        </div>

                        <div>
                            <label class="text-sm font-medium">Message *</label>
                            <textarea wire:model.defer="message"
                                class="w-full border rounded px-3 py-2"
                                rows="3"></textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="text-sm">Status</label>
                                <select wire:model.defer="status" class="w-full border rounded px-3 py-2">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                            <div>
                                <label class="text-sm">Position</label>
                                <input type="number" wire:model.defer="position"
                                    class="w-full border rounded px-3 py-2">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="text-sm">Start At</label>
                                <input type="datetime-local" wire:model.defer="starts_at"
                                    class="w-full border rounded px-3 py-2">
                            </div>

                            <div>
                                <label class="text-sm">End At</label>
                                <input type="datetime-local" wire:model.defer="ends_at"
                                    class="w-full border rounded px-3 py-2">
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end gap-3">
                        <button wire:click="closeModal"
                            class="px-4 py-2 border rounded">Cancel</button>

                        <button wire:click="save"
                            class="px-4 py-2 bg-green-700 text-white rounded">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>

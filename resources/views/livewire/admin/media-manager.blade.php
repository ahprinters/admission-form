<div class="max-w-6xl mx-auto p-6 space-y-6">
    <h1 class="text-2xl font-bold">Media Management</h1>

    @if (session()->has('success'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded p-6">
        <form wire:submit.prevent="{{ $editId ? 'update' : 'save' }}" class="space-y-4">
            <div>
                <label class="block mb-1 font-medium">Title</label>
                <input type="text" wire:model="title" class="w-full border rounded px-3 py-2">
                @error('title')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block mb-1 font-medium">Image</label>
                <input type="file" wire:model="image" class="w-full border rounded px-3 py-2">
                @error('image')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            @if($existingImage)
                <div>
                    <img src="{{ asset('storage/' . $existingImage) }}" class="w-32 h-20 object-cover rounded">
                </div>
            @endif

            <div>
                <label class="block mb-1 font-medium">Sort Order</label>
                <input type="number" wire:model="sort_order" class="w-full border rounded px-3 py-2">
                @error('sort_order')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-wrap gap-6">
                <label class="flex items-center gap-2">
                    <input type="checkbox" wire:model="show_in_carousel">
                    <span>Show in Carousel</span>
                </label>

                <label class="flex items-center gap-2">
                    <input type="checkbox" wire:model="show_in_gallery">
                    <span>Show in Gallery</span>
                </label>

                <label class="flex items-center gap-2">
                    <input type="checkbox" wire:model="is_active">
                    <span>Active</span>
                </label>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                    {{ $editId ? 'Update Image' : 'Upload Image' }}
                </button>

                @if($editId)
                    <button type="button" wire:click="resetForm" class="bg-gray-500 text-white px-4 py-2 rounded">
                        Cancel
                    </button>
                @endif
            </div>
        </form>
    </div>

    <div class="bg-white shadow rounded p-6">
        <h2 class="text-xl font-semibold mb-4">All Media</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse($items as $item)
                <div class="border rounded overflow-hidden bg-white">
                    <img
                        src="{{ asset('storage/' . $item->image_path) }}"
                        alt="{{ $item->title }}"
                        class="w-full h-48 object-cover"
                    >

                    <div class="p-4 space-y-2">
                        <h3 class="font-semibold">{{ $item->title ?: 'No title' }}</h3>
                        <p class="text-sm">Carousel: {{ $item->show_in_carousel ? 'Yes' : 'No' }}</p>
                        <p class="text-sm">Gallery: {{ $item->show_in_gallery ? 'Yes' : 'No' }}</p>
                        <p class="text-sm">Active: {{ $item->is_active ? 'Yes' : 'No' }}</p>
                        <p class="text-sm">Sort: {{ $item->sort_order }}</p>

                        <div class="flex gap-2 pt-2">
                            <button
                                type="button"
                                wire:click="edit({{ $item->id }})"
                                class="bg-yellow-500 text-white px-3 py-1 rounded"
                            >
                                Edit
                            </button>

                            <button
                                type="button"
                                wire:click="delete({{ $item->id }})"
                                wire:confirm="Are you sure you want to delete this image?"
                                class="bg-red-600 text-white px-3 py-1 rounded"
                            >
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 col-span-full text-center">No media found.</p>
            @endforelse
        </div>
    </div>
</div>

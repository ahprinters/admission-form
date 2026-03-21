<div class="max-w-7xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Gallery</h1>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @forelse($galleryImages as $item)
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <img
                    src="{{ asset('storage/' . $item->image_path) }}"
                    alt="{{ $item->title }}"
                    class="w-full h-48 object-cover"
                >

                @if($item->title)
                    <div class="p-3 text-sm font-medium">
                        {{ $item->title }}
                    </div>
                @endif
            </div>
        @empty
            <p class="text-gray-500 col-span-full text-center">No gallery images found.</p>
        @endforelse
    </div>
</div>

<div
    x-data="{
        interval: null,
        start() {
            this.interval = setInterval(() => {
                $wire.call('next')
            }, 3000)
        },
        stop() {
            clearInterval(this.interval)
        }
    }"
    x-init="start()"
    @mouseenter="stop()"
    @mouseleave="start()"
    class="md:col-span-2 bg-white shadow rounded p-4"
>
    <div class="space-y-8">


        {{-- Carousel --}}
        @if(count($slides) > 0)
            <div class="relative max-w-3xl mx-auto">
                <img
                    src="{{ asset('storage/' . $slides[$current]['image_path']) }}"
                    alt="{{ $slides[$current]['title'] ?? 'Slide Image' }}"
                    class="w-full h-[400px] object-cover rounded-lg shadow"
                >

                <button
                    type="button"
                    wire:click="previous"
                    class="absolute left-3 top-1/2 -translate-y-1/2 bg-black/50 text-white px-3 py-2 rounded"
                >
                    Prev
                </button>

                <button
                    type="button"
                    wire:click="next"
                    class="absolute right-3 top-1/2 -translate-y-1/2 bg-black/50 text-white px-3 py-2 rounded"
                >
                    Next
                </button>
            </div>
        @else
            <p class="text-center text-gray-500">No carousel images found.</p>
        @endif

    </div>
</div>

@if(!empty($text))
    <div class="bg-green-700 text-white py-2 overflow-hidden">
        <marquee behavior="{{ $behavior }}" direction="{{ $direction }}" scrollamount="{{ $speed }}">
            {{ $text }}
        </marquee>
    </div>
@endif

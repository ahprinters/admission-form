<div class="min-h-screen bg-gray-100">

    {{-- 🔶 Marquee Section --}}
    <x-marquee />

    {{-- 🔶 Header Section --}}
    <div class="bg-white shadow py-4 text-center">
        <h1 class="text-2xl font-bold text-green-800">
            আপনার প্রতিষ্ঠানের নাম
        </h1>
        <p class="text-sm text-gray-600">Official Website</p>
    </div>

    {{-- 🔶 Main Content --}}
    <div class="container mx-auto px-4 py-6 grid grid-cols-1 md:grid-cols-3 gap-6">

        {{-- Left: Carousel --}}
        <div class="md:col-span-2 bg-white shadow rounded p-4">
            <div class="relative overflow-hidden">
                <img src="/images/slide1.jpg" class="rounded w-full">
            </div>
        </div>

        {{-- Right: Quick Actions --}}
        <div class="bg-white shadow rounded p-4">
            <h3 class="text-lg font-semibold mb-4">দ্রুত সেবা</h3>
            <ul class="space-y-3">
                <li><a href="#" class="block bg-green-100 p-3 rounded hover:bg-green-200">অনলাইন আবেদন</a></li>
                <li><a href="#" class="block bg-green-100 p-3 rounded hover:bg-green-200">নোটিশ বোর্ড</a></li>
                <li><a href="#" class="block bg-green-100 p-3 rounded hover:bg-green-200">যোগাযোগ</a></li>
                <li><a href="#" class="block bg-green-100 p-3 rounded hover:bg-green-200">ফলাফল</a></li>
            </ul>
        </div>

    </div>
</div>

<div class="min-h-screen bg-gray-100">

    {{-- 🔶 Marquee Section --}}
    <x-marquee />

    {{-- 🔶 Header Section --}}
    <div class="bg-white shadow py-4 text-center">
        <h1 class="text-2xl font-bold text-green-800">
            দ্বীনি সিনিয়র ফাজিল মাদ্রাসা, সুনামগঞ্জ
        </h1>
        <p class="text-sm text-gray-600">ষোলঘর, সুনামগঞ্জ সদর, সুনামগঞ্জ</p>
        <p class="text-sm text-gray-600">EIIN: 130048, Phone: 01710984683, Email: infodeeni74@gmail.com</p>
    </div>

    {{-- 🔶 Main Content --}}
    <div class="container mx-auto px-4 py-6 grid grid-cols-1 md:grid-cols-3 gap-6">

        {{-- Left: Carousel Component --}}
        <livewire:carousel />

        {{-- Right: Quick Actions --}}
        <div class="bg-white shadow rounded p-4">
            <h3 class="text-lg font-semibold mb-4">দ্রুত সেবা</h3>
            <ul class="space-y-3">
                <li>
                    <a href="#" class="block bg-green-100 p-3 rounded hover:bg-green-200">
                        অনলাইন আবেদন
                    </a>
                </li>
                <li>
                    <a href="#" class="block bg-green-100 p-3 rounded hover:bg-green-200">
                        নোটিশ বোর্ড
                    </a>
                </li>
                <li>
                    <a href="#" class="block bg-green-100 p-3 rounded hover:bg-green-200">
                        যোগাযোগ
                    </a>
                </li>
                <li>
                    <a href="#" class="block bg-green-100 p-3 rounded hover:bg-green-200">
                        ফলাফল
                    </a>
                </li>
            </ul>
        </div>

    </div>
</div>

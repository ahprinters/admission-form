<x-layouts.admin>
<div class="space-y-6">
    <div class="flex flex-col md:flex-row items-center justify-between gap-4">
        <div class="relative w-full max-w-md">
            <input type="text" placeholder="Search students..."
                   class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 outline-none" />
            <div class="absolute left-3 top-2.5 text-gray-400">
                <flux:icon.magnifying-glass variant="mini" />
            </div>
        </div>

        <div class="flex items-center gap-4">
            <a href="/student/create" wire:navigate class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition flex items-center gap-2">
                <flux:icon.plus variant="mini" />
                Add Student
            </a>
            <div class="flex items-center gap-3 border-l pl-4">
                <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" class="w-10 h-10 rounded-full" />
                <div class="hidden sm:block">
                    <p class="text-sm font-bold leading-none">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-500">Administrator</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <div class="lg:col-span-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
                    <p class="text-gray-500 text-sm font-medium">Total Students</p>
                    {{-- <h2 class="text-3xl font-bold text-slate-800">{{ $totalStudents }}</h2> --}}
                    <div class="mt-2 text-xs text-blue-600 font-semibold">↑ 12% from last month</div>
                </div>

                <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
                    <p class="text-gray-500 text-sm font-medium">Total Teachers</p>
                    {{-- <h2 class="text-3xl font-bold text-slate-800">{{ $totalTeachers }}</h2> --}}
                    <div class="mt-2 text-xs text-green-600 font-semibold">Active Staff</div>
                </div>

                <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
                    <p class="text-gray-500 text-sm font-medium">Today's Fees</p>
                    {{-- <h2 class="text-3xl font-bold text-slate-800">{{ $todayFees }} BDT</h2> --}}
                    <div class="mt-2 text-xs text-orange-600 font-semibold">Processing</div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <h3 class="font-bold text-lg mb-4 flex items-center gap-2">
                    <flux:icon.chart-bar variant="mini" /> Attendance Report
                </h3>
                <div class="h-64 flex items-center justify-center bg-gray-50 rounded-lg border-dashed border-2 border-gray-200">
                   <p class="text-gray-400">Chart data loading...</p>
                </div>
            </div>
        </div>

        <div class="lg:col-span-4 space-y-6">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <h3 class="font-bold text-lg mb-4">Recent Activities</h3>
                <ul class="space-y-4">
                    <li class="flex gap-3 items-start">
                        <span class="w-2 h-2 mt-1.5 rounded-full bg-green-500"></span>
                        {{-- <p class="text-sm text-gray-600">{{ $newStudentsToday }} new students joined today</p> --}}
                    </li>
                    <li class="flex gap-3 items-start">
                        <span class="w-2 h-2 mt-1.5 rounded-full bg-blue-500"></span>
                        <p class="text-sm text-gray-600">Fee collection updated</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</x-layouts.admin>

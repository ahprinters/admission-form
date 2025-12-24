<div class="space-y-6">
    <div class="flex flex-col md:flex-row items-center justify-between gap-4">
        <div class="relative w-full max-w-md">
            <input type="text" placeholder="Search students..."
                   class="w-full pl-10 pr-4 py-2 border border-slate-200 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 outline-none transition-all" />
            <div class="absolute left-3 top-2.5 text-gray-400">
                <flux:icon.magnifying-glass variant="mini" />
            </div>
        </div>

        <div class="flex items-center gap-4">
            <flux:button href="/student/create" wire:navigate variant="primary" icon="plus">
                Add Student
            </flux:button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

        <div class="lg:col-span-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                <x-dashboard.card icon="academic-cap" label="Total Students" :value="$totalStudents" status="info" />
                <x-dashboard.card icon="users" label="Active Students" :value="$activeStudents" status="success" />
                <x-dashboard.card icon="users" label="Total Teachers" :value="$totalTeachers" status="success" />

                <x-dashboard.card icon="chart-bar" label="Attendance Rate" :value="$attendanceRate . '%'" status="info" :progress="$attendanceRate" description="Overall records" />
                <x-dashboard.card icon="chart-bar" label="Today's Attendance" :value="$todayRate . '%'" status="success" :progress="$todayRate" description="Based on {{ $todayTotal }} records" />

                <x-dashboard.card icon="currency-bangladeshi" label="Monthly Fees" :value="$monthlyFees . ' ৳'" status="warning" />
                <x-dashboard.card icon="currency-bangladeshi" label="Today's Fees" :value="$todayFees . ' ৳'" status="danger" />

                <x-dashboard.card icon="academic-cap" label="New Students Today" :value="$newStudentsToday" status="info" />
                <x-dashboard.card icon="users" label="New Teachers Today" :value="$newTeachersToday" status="success" />
            </div>

            <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                <h3 class="font-bold text-slate-800 mb-4 flex items-center gap-2">
                    <flux:icon.chart-bar variant="mini" class="text-blue-500" /> Attendance Report
                </h3>
                <div class="h-64 flex items-center justify-center bg-slate-50 rounded-lg border-dashed border-2 border-slate-200">
                   <p class="text-slate-400 italic">Attendance chart data loading...</p>
                </div>
            </div>
        </div>

        <div class="lg:col-span-4 space-y-6">
            <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm h-full">
                <h3 class="font-bold text-slate-800 mb-6 flex items-center gap-2">
                    <flux:icon.clock variant="mini" class="text-slate-400" /> Recent Activities
                </h3>

                <ul class="space-y-6 relative">
                    <div class="absolute left-1 top-2 bottom-2 w-0.5 bg-slate-100"></div>

                    <li class="relative flex gap-4 items-start pl-6">
                        <span class="absolute left-0 w-2.5 h-2.5 mt-1.5 rounded-full bg-green-500 ring-4 ring-green-50"></span>
                        <div>
                            <p class="text-sm font-medium text-slate-700">{{ $newStudentsToday }} New students joined</p>
                            <p class="text-xs text-slate-400">Updated just now</p>
                        </div>
                    </li>

                    <li class="relative flex gap-4 items-start pl-6">
                        <span class="absolute left-0 w-2.5 h-2.5 mt-1.5 rounded-full bg-blue-500 ring-4 ring-blue-50"></span>
                        <div>
                            <p class="text-sm font-medium text-slate-700">Fee collection updated</p>
                            <p class="text-xs text-slate-400">2 hours ago</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</div>

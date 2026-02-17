<div class="w-64 shrink-0 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 flex flex-col">

    {{-- Logo --}}
    <div class="h-16 flex items-center px-6 font-semibold text-lg border-b dark:border-gray-700">
        <a href="/dashboard">Admin Panel</a>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 px-4 py-6 space-y-6 overflow-y-auto">

        {{-- ===================== --}}
        {{-- Main --}}
        {{-- ===================== --}}
        <div class="space-y-2">
            <x-sidebar.link href="/dashboard" :active="request()->is('dashboard')">
                Dashboard
            </x-sidebar.link>
        </div>

        {{-- ===================== --}}
        {{-- Student Management --}}
        {{-- ===================== --}}
        <div>
            <div class="px-2 text-xs uppercase text-gray-400 mb-2">
                Student Management
            </div>

            <div class="space-y-2">
                <x-sidebar.link href="{{ route('student.index') }}"
                    :active="request()->routeIs('student.index')">
                    Students
                </x-sidebar.link>

                <x-sidebar.link href="{{ route('admin.classes.index') }}"
                    :active="request()->routeIs('admin.classes.index')">
                    Classes
                </x-sidebar.link>

                <x-sidebar.link href="/attendance"
                    :active="request()->is('attendance')">
                    Attendance
                </x-sidebar.link>
            </div>
        </div>

        {{-- ===================== --}}
        {{-- Academic --}}
        {{-- ===================== --}}
        <div>
            <div class="px-2 text-xs uppercase text-gray-400 mb-2">
                Academic
            </div>

            <div class="space-y-2">
                <x-sidebar.link href="{{ route('exam.index') }}"
                    :active="request()->routeIs('exam.index')">
                    Exam Manager
                </x-sidebar.link>

                <x-sidebar.link href="{{ route('academic-sessions.index') }}"
                    :active="request()->routeIs('academic-sessions.index')">
                    Academic Sessions
                </x-sidebar.link>

                <x-sidebar.link href="{{ route('courses.index') }}"
                    :active="request()->routeIs('courses.index')">
                    Courses
                </x-sidebar.link>

                <x-sidebar.link href="{{ route('semesters.index') }}"
                    :active="request()->routeIs('semesters.index')">
                    Semesters
                </x-sidebar.link>
            </div>
        </div>

        {{-- ===================== --}}
        {{-- Fee Management --}}
        {{-- ===================== --}}
        <div>
            <div class="px-2 text-xs uppercase text-gray-400 mb-2">
                Fee Management
            </div>

            <div class="space-y-2">
                <x-sidebar.link href="{{ route('admin.fees.index') }}"
                    :active="request()->routeIs('admin.fees.index')">
                    Fee Collection
                </x-sidebar.link>

                <x-sidebar.link href="{{ route('admin.fees.assign') }}"
                    :active="request()->routeIs('admin.fees.assign')">
                    Assign Fee
                </x-sidebar.link>
            </div>
        </div>

        {{-- ===================== --}}
        {{-- Website Settings --}}
        {{-- ===================== --}}
        <div>
            <div class="px-2 text-xs uppercase text-gray-400 mb-2">
                Website Settings
            </div>

            <div class="space-y-2">
                <x-sidebar.link href="{{ route('admin.marquees') }}"
                    :active="request()->routeIs('admin.marquees')">
                    Marquee Manager
                </x-sidebar.link>
            </div>
        </div>

    </nav>

    {{-- Profile / Logout --}}
    <div class="border-t dark:border-gray-700 p-4">
        <div class="text-sm text-gray-600 dark:text-gray-300 mb-3">
            {{ auth()->user()->name }}
        </div>

        <button wire:click="logout"
            class="w-full bg-red-500 hover:bg-red-600 text-white text-sm py-2 rounded-lg">
            Logout
        </button>
    </div>

</div>

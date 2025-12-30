<div class="contents">
    {{-- সাইডবার মেইন কন্টেইনার --}}
    <flux:sidebar sticky collapsible="mobile" class="bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
        <flux:sidebar.header>
            <flux:sidebar.brand
                href="/dashboard"
                logo="https://fluxui.dev/img/demo/logo.png"
                name="Admin Panel"
            />

            <flux:sidebar.collapse class="lg:hidden" />
        </flux:sidebar.header>

        {{-- ডাইনামিক সার্চ বার --}}
        <flux:sidebar.search placeholder="খুঁজুন..." />

        <flux:sidebar.nav>
            {{-- ড্যাশবোর্ড লিঙ্ক --}}
            <flux:sidebar.item
                icon="home"
                href="/dashboard"
                wire:navigate
                :current="request()->is('dashboard')"
            >
                Dashboard
            </flux:sidebar.item>

            {{-- শিক্ষার্থী ব্যবস্থাপনা গ্রুপ --}}
            <x-student-management />
            {{-- ক্লাস ম্যানেজমেন্ট কম্পোনেন্ট --}}
            <x-class-management />
            {{-- এক্সাম ম্যানেজমেন্ট --}}
            <flux:sidebar.item
                icon="clipboard-document"
                href="{{ route('livewire.exam-manager') }}"
                :current="request()->routeIs('livewire.exam-manager')"
            >
                Exam Manager
            </flux:sidebar.item>

            <flux:sidebar.item
                icon="academic-cap"
                href="{{ route('academic-sessions.index') }}"
                :current="request()->routeIs('academic-sessions.index')"
            >
                Academic Sessions
            </flux:sidebar.item>

            <flux:sidebar.item
                icon="book-open"
                href="{{ route('courses.index') }}"
                :current="request()->routeIs('courses.index')"
            >
                Courses
            </flux:sidebar.item>


            {{-- সিমেস্টার ম্যানেজার --}}
            <flux:sidebar.item
                icon="calendar-days"
                href="{{ route('semesters.index') }}"
                :current="request()->routeIs('semesters.index')"
            >
                Semesters
            </flux:sidebar.item>

            {{-- একাডেমিক সেকশন --}}
            <flux:sidebar.group heading="একাডেমিক">
                <flux:sidebar.item icon="clipboard-document-list" href="/attendance" wire:navigate :current="request()->is('attendance')">
                    Attendance
                </flux:sidebar.item>
                <flux:sidebar.item icon="calendar-days" href="#">ক্যালেন্ডার</flux:sidebar.item>
                <flux:sidebar.item icon="clipboard-document-check" href="#">ফলাফল</flux:sidebar.item>
            </flux:sidebar.group>
        </flux:sidebar.nav>

        <flux:sidebar.spacer />

        {{-- সেটিংস এবং ডার্ক মোড অপশন --}}
        <flux:sidebar.nav>
            <flux:sidebar.item icon="cog-8-tooth" href="#">সেটিংস</flux:sidebar.item>

            {{-- ডার্ক মোড টগল (যদি অ্যাপে সেটআপ থাকে) --}}
            <flux:sidebar.item icon="moon" @click="$flux.dark = ! $flux.dark">থিম পরিবর্তন</flux:sidebar.item>
        </flux:sidebar.nav>

        {{-- প্রোফাইল সেকশন --}}
        <flux:dropdown position="top" align="start" class="max-lg:hidden">
            <flux:sidebar.profile
                avatar="https://ui-avatars.com/api/?background=random&name={{ urlencode(auth()->user()->name) }}"
                name="{{ auth()->user()->name }}"
                description="Administrator"
            />

            <flux:menu>
                <flux:menu.item icon="user-circle">প্রোফাইল</flux:menu.item>
                <flux:menu.item icon="shield-check">নিরাপত্তা</flux:menu.item>

                <flux:menu.separator />

                <flux:menu.item
                    wire:click="logout"
                    icon="power"
                    variant="danger"
                >
                    লগআউট করুন
                </flux:menu.item>
            </flux:menu>
        </flux:dropdown>
    </flux:sidebar>

    {{-- মোবাইল ভিউ হেডার --}}
    <flux:header class="lg:hidden border-b border-zinc-200 dark:border-zinc-700">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-3" inset="left" />

        <flux:brand href="/dashboard" logo="https://fluxui.dev/img/demo/logo.png" name="Admin" class="ml-2" />

        <flux:spacer />

        <flux:dropdown position="top" align="end">
            <flux:profile avatar="https://ui-avatars.com/api/?background=random&name={{ urlencode(auth()->user()->name) }}" />
            <flux:menu>
                <flux:menu.item wire:click="logout" icon="power">Logout</flux:menu.item>
            </flux:menu>
        </flux:dropdown>
    </flux:header>
</div>

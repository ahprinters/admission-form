<div class="contents">
    {{-- ফ্লাক্সের অ্যাপিয়ারেন্স ডিরেক্টিভ লেআউটে না থাকলে এখানেও রাখা যায় --}}

    <flux:sidebar sticky collapsible="mobile" class="bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
        <flux:sidebar.header>
            <flux:sidebar.brand
                href="/dashboard"
                logo="https://fluxui.dev/img/demo/logo.png"
                name="Admin Panel"
            />

            <flux:sidebar.collapse class="lg:hidden" />
        </flux:sidebar.header>

        {{-- সার্চ বার --}}
        <flux:sidebar.search placeholder="Search menu..." />

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

            {{-- শিক্ষার্থী ব্যবস্থাপনা গ্রুপ (Expandable) --}}
            <flux:sidebar.group expandable heading="শিক্ষার্থী ব্যবস্থাপনা" :expanded="request()->is('student*')">
                <flux:sidebar.item
                    icon="users"
                    href="/students"
                    wire:navigate
                    :current="request()->is('students')"
                >
                    শিক্ষার্থী তালিকা
                </flux:sidebar.item>

                <flux:sidebar.item
                    icon="plus-circle"
                    href="/student/create"
                    wire:navigate
                    :current="request()->is('student/create')"
                >
                    নতুন শিক্ষার্থী
                </flux:sidebar.item>
            </flux:sidebar.group>

            {{-- অন্যান্য মেনু --}}
            <flux:sidebar.item icon="calendar" href="#">একাডেমিক ক্যালেন্ডার</flux:sidebar.item>
        </flux:sidebar.nav>

        <flux:sidebar.spacer />

        {{-- সেটিংস ও হেল্প --}}
        <flux:sidebar.nav>
            <flux:sidebar.item icon="cog-6-tooth" href="#">সেটিংস</flux:sidebar.item>
            <flux:sidebar.item icon="information-circle" href="#">হেল্প</flux:sidebar.item>
        </flux:sidebar.nav>

        {{-- প্রোফাইল এবং লগআউট ড্রপডাউন (ডেস্কটপ) --}}
        <flux:dropdown position="top" align="start" class="max-lg:hidden">
            <flux:sidebar.profile
                avatar="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}"
                name="{{ auth()->user()->name }}"
            />

            <flux:menu>
                <flux:menu.item icon="user">প্রোফাইল</flux:menu.item>

                <flux:menu.separator />

                {{-- লগআউট বাটন --}}
                <flux:menu.item
                    wire:click="logout"
                    icon="arrow-right-start-on-rectangle"
                    variant="danger"
                >
                    Logout
                </flux:menu.item>
            </flux:menu>
        </flux:dropdown>
    </flux:sidebar>

    {{-- মোবাইল ভিউ এর জন্য হেডার (যখন সাইডবার হাইড থাকে) --}}
    <flux:header class="lg:hidden">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
        <flux:spacer />
        <flux:dropdown position="top" align="end">
            <flux:profile avatar="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}" />
            <flux:menu>
                <flux:menu.item wire:click="logout" icon="arrow-right-start-on-rectangle">Logout</flux:menu.item>
            </flux:menu>
        </flux:dropdown>
    </flux:header>
</div>

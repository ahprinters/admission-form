<flux:header class="bg-white dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">
    {{-- সাইডবার টগল বাটন (মোবাইল এবং ডেস্কটপ উভয় ক্ষেত্রেই কাজ করবে) --}}
    <flux:sidebar.toggle icon="bars-2" inset="left" class="text-zinc-500 hover:text-zinc-900 dark:hover:text-white" />

    {{-- ব্র্যান্ড বা প্রজেক্টের নাম --}}
    <flux:brand href="/dashboard" name="SMS" class="ml-4 font-bold text-xl tracking-tight text-blue-600" />

    <flux:spacer />

    {{-- ডান পাশের অপশনসমূহ (সার্চ, নোটিফিকেশন বা প্রোফাইল) --}}
    <flux:navbar class="-mr-2">
        <flux:navbar.item icon="magnifying-glass" href="#" label="Search" />
        <flux:navbar.item icon="bell" href="#" label="Notifications" />

        {{-- ইউজার ড্রপডাউন --}}
        <flux:dropdown position="bottom" align="end">
            <flux:profile avatar="https://ui-avatars.com/api/?background=0D8ABC&color=fff&name={{ urlencode(auth()->user()->name) }}" />

            <flux:menu>
                <flux:menu.item icon="user-circle">আমার প্রোফাইল</flux:menu.item>
                <flux:menu.item icon="cog-6-tooth">সেটিংস</flux:menu.item>
                <flux:menu.separator />
                <flux:menu.item wire:click="logout" icon="power" variant="danger">লগআউট</flux:menu.item>
            </flux:menu>
        </flux:dropdown>
    </flux:navbar>
</flux:header>

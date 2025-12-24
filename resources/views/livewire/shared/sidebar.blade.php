<aside class="w-64 bg-slate-800 text-white flex-shrink-0 hidden md:flex flex-col">
    <div class="p-6 text-2xl font-bold border-b border-slate-700">
        Admin Panel
    </div>

    <nav class="flex-1 p-4 space-y-2">
        <a href="/dashboard" wire:navigate class="flex items-center space-x-3 py-2.5 px-4 rounded transition {{ request()->is('dashboard') ? 'bg-slate-700 text-white' : 'text-zinc-400 hover:bg-slate-700 hover:text-white' }}">
            <flux:icon.home variant="mini" />
            <span class="text-sm font-medium">Dashboard</span>
        </a>

        <flux:navlist.group expandable :expanded="request()->is('student*')" heading="শিক্ষার্থী ব্যবস্থাপনা">
            <a href="/students" wire:navigate class="flex items-center space-x-3 py-2 px-4 rounded transition {{ request()->is('students') ? 'text-white' : 'text-zinc-400 hover:text-white' }}">
                <flux:icon.users variant="mini" />
                <span class="text-sm">শিক্ষার্থী তালিকা</span>
            </a>
            <a href="/student/create" wire:navigate class="flex items-center space-x-3 py-2 px-4 rounded transition {{ request()->is('student/create') ? 'text-white' : 'text-zinc-400 hover:text-white' }}">
                <flux:icon.plus variant="mini" />
                <span class="text-sm">নতুন শিক্ষার্থী</span>
            </a>
        </flux:navlist.group>
    </nav>

    <div class="p-4 border-t border-slate-700">
        <button wire:click="logout" class="flex items-center space-x-3 w-full text-left py-2 px-4 text-red-400 hover:bg-red-500/10 hover:text-red-300 rounded transition">
            <flux:icon.arrow-right-on-rectangle variant="mini" />
            <span class="text-sm font-medium">Logout</span>
        </button>
    </div>
</aside>

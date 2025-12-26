<flux:sidebar.group expandable heading="ক্লাস ম্যানেজমেন্ট" icon="building-library" :expanded="request()->is('admin/class*')">
    <flux:sidebar.item
        icon="plus-circle"
        href="{{ route('admin.class.create') }}"
        wire:navigate
        :current="request()->is('admin/class/create')"
    >
        নতুন ক্লাস তৈরি
    </flux:sidebar.item>

    <flux:sidebar.item
        icon="list-bullet"
        href="{{ route('admin.classes.index') }}"
        wire:navigate
        :current="request()->is('admin/classes')"
    >
        সব ক্লাস তালিকা
    </flux:sidebar.item>
</flux:sidebar.group>

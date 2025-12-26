<flux:sidebar.group expandable heading="শিক্ষার্থী ব্যবস্থাপনা" icon="academic-cap" :expanded="request()->is('student*')">
    <flux:sidebar.item
        icon="user-group"
        href="{{ route('student.index') }}"
        wire:navigate
        :current="request()->is('students')"
    >
        শিক্ষার্থী তালিকা
    </flux:sidebar.item>

    <flux:sidebar.item
        icon="user-plus"
        href="{{ route('student.create') }}"
        wire:navigate
        :current="request()->is('student/create')"
    >
        নতুন শিক্ষার্থী
    </flux:sidebar.item>
</flux:sidebar.group>

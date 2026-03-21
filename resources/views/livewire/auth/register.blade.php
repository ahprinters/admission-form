<x-ui.card class="space-y-6">

    <div class="text-center">
        <h2 class="text-2xl font-bold">রেজিস্টার</h2>
    </div>

    <form wire:submit.prevent="register" class="space-y-5">

        <x-ui.input label="নাম" wire:model.defer="name" />
        <x-ui.input label="ইমেইল" type="email" wire:model.defer="email" />
        <x-ui.input label="পাসওয়ার্ড" type="password" wire:model.defer="password" />
        <x-ui.input label="কনফার্ম পাসওয়ার্ড" type="password" wire:model.defer="password_confirmation" />

        {{-- <!-- রোল সিলেক্ট ফিল্ড -->
        <x-ui.select
            label="রোল"
            wire:model.defer="role"
            :options="['user' => 'User', 'admin' => 'Admin']"
            placeholder="রোল নির্বাচন করুন"
        /> --}}

        <x-ui.button type="submit">
            রেজিস্টার করুন
        </x-ui.button>

    </form>

</x-ui.card>

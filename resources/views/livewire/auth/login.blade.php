<x-ui.card class="space-y-6">

    {{-- ✅ Success Message --}}
    @if (session()->has('success'))
        <div
            x-data="{ show: true }"
            x-show="show"
            x-init="setTimeout(() => show = false, 4000)"
            class="p-3 rounded-lg bg-green-100 text-green-700 border border-green-300 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="text-center space-y-2">
        <h2 class="text-2xl font-bold">অ্যাডমিন লগইন</h2>
        <p class="text-sm text-gray-600">Secure Admission Panel</p>
    </div>

    <form wire:submit.prevent="login" class="space-y-5">

        <x-ui.input label="ইমেইল" type="email" wire:model.defer="email" />
        <x-ui.input label="পাসওয়ার্ড" type="password" wire:model.defer="password" />

        <div class="flex justify-between items-center text-sm">
            <x-ui.checkbox wire:model.defer="remember" label="মনে রাখুন" />
            <a href="#" class="text-blue-600 hover:underline">
                Forgot?
            </a>
        </div>

        <x-ui.button type="submit">
            প্রবেশ করুন
        </x-ui.button>

        <div class="text-center">
            <a href="{{ route('auth.register') }}"
               class="text-blue-600 hover:underline text-sm">
                রেজিস্টার
            </a>
        </div>

    </form>

</x-ui.card>



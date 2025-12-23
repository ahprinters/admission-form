<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center mb-6">অ্যাডমিন লগইন</h2>
        <form wire:submit.prevent="login">
            <div class="mb-4">
                <label class="block text-gray-700">ইমেইল</label>
                <input type="email" wire:model="email" class="w-full border p-2 rounded mt-1">
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">পাসওয়ার্ড</label>
                <input type="password" wire:model="password" class="w-full border p-2 rounded mt-1">
            </div>
            <div class="mb-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" wire:model="remember" class="form-checkbox">
                    <span class="ml-2 text-sm text-gray-600">মনে রাখুন</span>
                </label>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">প্রবেশ করুন</button>
        </form>
    </div>
</div>

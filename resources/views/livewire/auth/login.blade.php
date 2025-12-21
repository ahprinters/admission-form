<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-6 bg-white p-8 rounded-2xl shadow-xl border border-gray-100">
        <div class="text-center">
           <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Login</h2>
           <p class="mt-2 text-sm text-gray-500">Don't have an account?
            {{-- route('/register' --}}
            <a href="#" class="font-semibold text-blue-600 hover:text-blue-500 underline-offset-4 hover:underline">Sign up
                </a>
            </p>
        </div>

    @if(session()->has('error'))
        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 rounded-md text-sm">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

        <form class="space-y-5" wire:submit.prevent="login">

            // Username Field
            <div class="mb-4">
                <label for="username" class="block text-sm font-semibold text-gray-700">Username</label>
                <input type="text" id="username" wire:model.live.deffer="username" class="w-full px-3 py-2 border rounded">
                @error('username') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            // Password Field
            <div class="mb-4">
                <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                <input type="password" id="password" wire:model.live="password" class="w-full px-3 py-2 border rounded">
                @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            // Remember Me Checkbox
            <div class="mb-4">
                <input type="checkbox" id="remember" wire:model.live="remember">
                <label for="remember" class="ml-2 text-gray-700">Remember me</label>
            </div>

            @if(session()->has('error'))
                <div class="text-red-500 mb-4">{{ session('error') }}</div>
            @endif

            //forgot password link
            <div class="mb-4 text-sm">
                <a href="#" class="font-semibold text-blue-600 hover:text-blue-500 underline-offset-4 hover:underline">Forgot your password?</a>
            </div>
            // Submit Button
            <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="login">Login</span>
                <span wire:loading wire:target="login">Logging in...</span>
                <svg class="animate-spin h-5 w-5 text-white mr-2" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
                Authenticating...
            </button>
            </div>
        </form>
    </div>
</div>

<div>


  <form wire:submit.prevent="submit" class="space-y-4">
    @if (session()->has('message'))
    <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 shadow-sm rounded">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            <span>{{ session('message') }}</span>
        </div>
    </div>
    @endif
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Name (English)</label>
            <input type="text" wire:model="name_en" placeholder="Enter name in English"
                   class="w-full border rounded text-gray-900 px-3 py-2 @error('name_en') border-red-500 @enderror">
            @error('name_en') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Name (Bangla)</label>
            <input type="text" wire:model="name_bn" placeholder="Enter name in Bangla"
                   class="w-full border rounded text-gray-900 px-3 py-2">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" wire:model="email" placeholder="Enter email"
                   class="w-full border rounded text-gray-900 px-3 py-2">
            @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Class</label>
            <input type="text" wire:model="class" placeholder="Enter class"
                   class="w-full border rounded text-gray-900 px-3 py-2">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Roll Number</label>
            <input type="text" wire:model="roll_number" placeholder="Enter roll number"
                   class="w-full border rounded text-gray-900 px-3 py-2">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Gender</label>
            <select wire:model="gender" class="w-full border rounded text-gray-900 px-3 py-2">
                <option value="">Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Phone</label>
            <input type="text" wire:model="phone" placeholder="Enter phone"
                   class="w-full border rounded text-gray-900 px-3 py-2">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Date of Birth</label>
            <input type="date" wire:model="date_of_birth" class="w-full border rounded text-gray-900 px-3 py-2">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Blood Group</label>
            <select wire:model="blood_group" class="w-full border rounded text-gray-900 px-3 py-2">
                <option value="">Select Blood Group</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Religion</label>
            <select wire:model="religion" class="w-full border rounded text-gray-900 px-3 py-2">
                <option value="">Select Religion</option>
                <option value="Islam">Islam</option>
                <option value="Hinduism">Hinduism</option>
                <option value="Christianity">Christianity</option>
                <option value="Buddhism">Buddhism</option>
                <option value="Other">Other</option>
            </select>
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Address</label>
        <input type="text" wire:model="address" placeholder="Enter address"
               class="w-full border rounded text-gray-900 px-3 py-2">
    </div>

    <div class="flex items-center">
        <input type="checkbox" wire:model="is_active" class="mr-2">
        <label class="text-sm text-gray-700">Active</label>
    </div>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        Save Student
    </button>
</form>
</div>

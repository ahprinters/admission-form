<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <flux:heading size="xl" level="1">নতুন শিক্ষার্থী নিবন্ধন</flux:heading>
            <flux:subheading>শিক্ষার্থীর সঠিক তথ্য দিয়ে ফরমটি পূরণ করুন।</flux:subheading>
        </div>

        <a href="/dashboard" wire:navigate class="flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-blue-600 transition">
            <flux:icon.arrow-left variant="mini" />
            ড্যাশবোর্ডে ফিরুন
        </a>
    </div>

    <flux:separator variant="subtle" />

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6">
            <form wire:submit.prevent="submit" class="space-y-6">

                {{-- Success Message --}}
                @if (session()->has('message'))
                    <div class="p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-md flex items-center gap-3">
                        <flux:icon.check-circle variant="mini" class="text-green-500" />
                        <span class="text-sm font-medium">{{ session('message') }}</span>
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                    <flux:field>
                        <flux:label>Name (English)</flux:label>
                        <flux:input wire:model="name_en" placeholder="Enter name in English" icon="user" />
                        <flux:error name="name_en" />
                    </flux:field>

                    <flux:field>
                        <flux:label>Name (Bangla)</flux:label>
                        <flux:input wire:model="name_bn" placeholder="শিক্ষার্থীর নাম বাংলায় লিখুন" icon="user-circle" />
                    </flux:field>

                    <flux:field>
                        <flux:label>Email Address</flux:label>
                        <flux:input type="email" wire:model="email" placeholder="example@mail.com" icon="envelope" />
                        <flux:error name="email" />
                    </flux:field>

                    <flux:field>
                        <flux:label>Class</flux:label>
                        <flux:select wire:model="class" placeholder="Select Class">
                            <option value="1">Class One</option>
                            <option value="2">Class Two</option>
                            <option value="3">Class Three</option>
                            </flux:select>
                    </flux:field>

                    <flux:field>
                        <flux:label>Roll Number</flux:label>
                        <flux:input wire:model="roll_number" placeholder="e.g. 101" icon="identification" />
                    </flux:field>

                    <flux:field>
                        <flux:label>Gender</flux:label>
                        <flux:select wire:model="gender">
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </flux:select>
                    </flux:field>

                    <flux:field>
                        <flux:label>Phone Number</flux:label>
                        <flux:input wire:model="phone" placeholder="017XXXXXXXX" icon="phone" />
                    </flux:field>

                    <flux:field>
                        <flux:label>Date of Birth</flux:label>
                        <flux:input type="date" wire:model="date_of_birth" />
                    </flux:field>

                    <flux:field>
                        <flux:label>Blood Group</flux:label>
                        <flux:select wire:model="blood_group">
                            <option value="">Select Blood Group</option>
                            <option value="A+">A+</option>
                            <option value="B+">B+</option>
                            <option value="O+">O+</option>
                            <option value="AB+">AB+</option>
                        </flux:select>
                    </flux:field>

                    <flux:field>
                        <flux:label>Religion</flux:label>
                        <flux:select wire:model="religion">
                            <option value="">Select Religion</option>
                            <option value="Islam">Islam</option>
                            <option value="Hinduism">Hinduism</option>
                        </flux:select>
                    </flux:field>
                </div>

                <flux:field>
                    <flux:label>Full Address</flux:label>
                    <flux:textarea wire:model="address" placeholder="Enter full address..." rows="2" />
                </flux:field>

                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                    <flux:checkbox wire:model="is_active" label="বর্তমানে সক্রিয় শিক্ষার্থী" />

                    <div class="flex gap-3">
                        <flux:button href="/dashboard" wire:navigate variant="ghost">Cancel</flux:button>
                        <flux:button type="submit" variant="primary" class="px-8">
                            Save Student Information
                        </flux:button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

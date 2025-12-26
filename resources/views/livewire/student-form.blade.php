<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <flux:heading size="xl" level="1">নতুন শিক্ষার্থী নিবন্ধন</flux:heading>
            <flux:subheading>শিক্ষার্থীর সঠিক তথ্য দিয়ে ফরমটি পূরণ করুন।</flux:subheading>
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

                {{-- ২ কলাম বিশিষ্ট গ্রিড --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                    <x-form-input name="name_en" label="Name (English)" placeholder="Enter name in English" icon="user-circle" />
                    <x-form-input name="name_bn" label="Name (Bangla)" placeholder="শিক্ষার্থীর নাম বাংলায় লিখুন" icon="user-circle" />
                    <x-form-input name="email" type="email" label="Email Address" placeholder="student@example.com" icon="envelope" />

                    <x-form-input name="father_name" label="Father's Name" placeholder="Enter father's name" icon="user" />
                    <x-form-input name="mother_name" label="Mother's Name" placeholder="Enter mother's name" icon="user" />

                    <x-form-input name="roll_number" label="Roll Number" placeholder="e.g. 101" icon="identification" />
                    <x-form-select name="class" label="Select Class" :options="$classes" placeholder="Choose a class..." icon="academic-cap" />

                    <x-form-input name="phone" type="tel" label="Phone Number" placeholder="017XXXXXXXX" icon="phone" />
                    <x-form-input name="date_of_birth" type="date" label="Date of Birth" icon="calendar" />

                    <x-form-select name="gender" label="Gender" :options="$genders" placeholder="Choose a gender..." icon="users" />
                    <x-form-select name="blood_group" label="Blood Group" :options="$bloodGroups" placeholder="Choose a blood group..." icon="heart" />

                    <x-form-select name="religion" label="Religion" :options="$religions" placeholder="Choose a religion..." icon="user-group" />
                </div>

                {{-- ফুল উইথ অ্যাড্রেস ফিল্ড (গ্রিডের বাইরে) --}}
                <div class="w-full">
                    <flux:field>
                        <flux:label class="font-semibold text-slate-700">Full Address</flux:label>
                        <flux:textarea
                            wire:model="address"
                            placeholder="গ্রাম, পোস্ট অফিস, উপজেলা, জেলা..."
                            icon="map-pin"
                            rows="3"
                        />
                        <flux:error name="address" />
                    </flux:field>
                </div>

                {{-- ফুটার সেকশন --}}
                <div class="flex items-center justify-between pt-6 border-t border-gray-100">
                    <flux:checkbox wire:model="is_active" label="বর্তমানে সক্রিয় শিক্ষার্থী" />

                    <div class="flex gap-3">
                        <flux:button href="/dashboard" wire:navigate variant="ghost">Cancel</flux:button>
                        <flux:button type="submit" variant="primary" class="px-8" wire:loading.attr="disabled">
                            <span wire:loading.remove>Save Student Information</span>
                            <span wire:loading>Saving...</span>
                        </flux:button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

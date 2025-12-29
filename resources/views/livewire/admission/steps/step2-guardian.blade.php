<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <flux:heading size="xl" level="1">Step 2: অভিভাবক তথ্য</flux:heading>
            <flux:subheading>পিতা/মাতা ও অভিভাবকের তথ্য সঠিকভাবে পূরণ করুন।</flux:subheading>
        </div>

        @if($locked)
            <div class="text-sm font-semibold text-red-600">Locked — Final submit করা হয়েছে</div>
        @endif
    </div>

    <flux:separator variant="subtle" />

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 space-y-8">

            {{-- বাবা-মা তথ্য --}}
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div class="font-semibold text-slate-800">বাবা-মা তথ্য</div>
                    <div class="text-xs text-slate-500">(*) চিহ্নিত ফিল্ড বাধ্যতামূলক</div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                    <x-form-input name="father_name_en" label="পিতার নাম (English) *" placeholder="Enter father's name" icon="user" :disabled="$this->locked" />
                    <x-form-input name="father_name_bn" label="পিতার নাম (বাংলা)" placeholder="বাংলায় লিখুন" icon="user" :disabled="$this->locked" />
                    <x-form-input name="father_mobile" label="পিতার মোবাইল নম্বর *" placeholder="01XXXXXXXXX" icon="phone" :disabled="$this->locked" />

                    <x-form-input name="mother_name_en" label="মাতার নাম (English) *" placeholder="Enter mother's name" icon="user" :disabled="$this->locked" />
                    <x-form-input name="mother_name_bn" label="মাতার নাম (বাংলা)" placeholder="বাংলায় লিখুন" icon="user" :disabled="$this->locked" />
                    <x-form-input name="mother_mobile" label="মাতার মোবাইল নম্বর *" placeholder="01XXXXXXXXX" icon="phone" :disabled="$this->locked" />
                </div>
            </div>

            <flux:separator variant="subtle" />

            {{-- বিকল্প অভিভাবক (বাবা/মা মৃত হলে) --}}
            <div class="space-y-4">
                <div class="font-semibold text-slate-800">অভিভাবক তথ্য (বাবা/মা মৃত হলে)</div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                    <x-form-input name="guardian_name" label="অভিভাবকের নাম" placeholder="অভিভাবকের নাম লিখুন" icon="user-circle" :disabled="$this->locked" />
                    <x-form-input name="guardian_relation" label="সম্পর্ক" placeholder="যেমন: চাচা/খালা/দাদা" icon="users" :disabled="$this->locked" />
                    <x-form-input name="guardian_mobile" label="অভিভাবকের মোবাইল" placeholder="01XXXXXXXXX" icon="phone" :disabled="$this->locked" />
                    <x-form-input name="whatsapp" label="WhatsApp নম্বর" placeholder="01XXXXXXXXX" icon="chat-bubble-left-right" :disabled="$this->locked" />
                </div>
            </div>

            <flux:separator variant="subtle" />

            {{-- সামাজিক ও অর্থনৈতিক তথ্য --}}
            <div class="space-y-4">
                <div class="font-semibold text-slate-800">সামাজিক ও অর্থনৈতিক তথ্য</div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                    <x-form-select
                        name="occupation"
                        label="পিতা/অভিভাবকের পেশা"
                        :options="$occupationOptions"
                        placeholder="পেশা নির্বাচন করুন"
                        icon="briefcase"
                        :disabled="$this->locked"
                    />

                    <x-form-input name="annual_income" type="number" label="বার্ষিক আয়" placeholder="যেমন: 200000" icon="banknotes" :disabled="$this->locked" />
                    <x-form-input name="land_amount" label="জমির পরিমাণ" placeholder="যেমন: ৫ শতক / ১ বিঘা" icon="map" :disabled="$this->locked" />
                    <x-form-input name="family_members" type="number" label="পরিবারের সদস্য সংখ্যা" placeholder="যেমন: ৫" icon="users" :disabled="$this->locked" />
                    <x-form-input name="children_in_madrasa" type="number" label="অত্র মাদ্রাসায় তার সন্তান সংখ্যা" placeholder="যেমন: ১" icon="academic-cap" :disabled="$this->locked" />
                </div>
            </div>

            <flux:separator variant="subtle" />

            {{-- ঠিকানা --}}
            <div class="space-y-4">
                <div class="font-semibold text-slate-800">ঠিকানা</div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                    <x-form-textarea name="permanent_address" label="স্থায়ী ঠিকানা" rows="3" placeholder="গ্রাম, পোস্ট অফিস, উপজেলা, জেলা" :disabled="$this->locked" />
                    <x-form-textarea name="present_address" label="বর্তমান ঠিকানা" rows="3" placeholder="গ্রাম, পোস্ট অফিস, উপজেলা, জেলা" :disabled="$this->locked" />
                </div>
            </div>
        </div>
    </div>
</div>

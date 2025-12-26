<div class="p-4 space-y-4">
    <x-toast />

    {{-- Toolbar --}}
    <div class="flex flex-wrap items-center gap-3">
        <x-attendance.mode-tabs :mode="$mode" />

        <div class="flex flex-wrap items-end gap-3">
            <div class="min-w-[220px]">
                <x-form-select
                    name="classId"
                    label="Class"
                    :options="$classOptions"
                    wire:model.live="classId"
                />
            </div>

            <div class="w-[200px]">
                <x-form-input
                    name="date"
                    label="Date"
                    type="date"
                    wire:model.live="date"
                />
            </div>

            <div class="w-[200px]">
                <x-form-input
                    name="studentId"
                    label="Student ID"
                    type="number"
                    placeholder="e.g. 12"
                    wire:model.live="studentId"
                />
            </div>
        </div>
    </div>

    {{-- CLASS MODE --}}
    @if($mode === 'class')
        <div class="rounded-2xl border bg-white p-4 space-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-lg font-semibold">Class Attendance</div>
                    <div class="text-sm text-gray-600">Toggle করে Present/Absent সেট করো, তারপর Save</div>
                </div>

                <x-button
                    type="button"
                    variant="primary"
                    loadingTarget="saveClassAttendance"
                    wire:click="saveClassAttendance"
                >
                    Save
                </x-button>
            </div>

            @if(empty($students))
                <div class="text-sm text-gray-600">No students found for this class.</div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="text-left text-gray-600">
                                <th class="py-2 pr-4">ID</th>
                                <th class="py-2 pr-4">Name</th>
                                <th class="py-2 pr-4">Roll</th>
                                <th class="py-2 pr-4">Status</th>
                                <th class="py-2 pr-4">Remarks</th>
                                <th class="py-2 pr-4">Action</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y">
                            @foreach($students as $s)
                                <x-attendance.student-row :student="$s" />
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    @endif

    {{-- STUDENT MODE --}}
    @if($mode === 'student')
        <div class="rounded-2xl border bg-white p-4 space-y-3">
            <div class="text-lg font-semibold">Student Attendance</div>

            @if(empty($attendances))
                <div class="text-sm text-gray-600">No attendance data found.</div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="text-left text-gray-600">
                                <th class="py-2 pr-4">Date</th>
                                <th class="py-2 pr-4">Status</th>
                                <th class="py-2 pr-4">Remarks</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y">
                            @foreach($attendances as $a)
                                <tr>
                                    <td class="py-3 pr-4">{{ $a['date'] ?? '-' }}</td>
                                    <td class="py-3 pr-4">
                                        <span class="px-2 py-1 rounded-full border text-xs">
                                            {{ !empty($a['status']) ? 'Present' : 'Absent' }}
                                        </span>
                                    </td>
                                    <td class="py-3 pr-4">{{ $a['remarks'] ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            @endif
        </div>
    @endif

    {{-- ADJUST MODE --}}
    @if($mode === 'adjust')
        <div class="rounded-2xl border bg-white p-4 space-y-4" x-data="{ openConfirm:false }">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-lg font-semibold">Adjust Absent Rows</div>
                    <div class="text-sm text-gray-600">Absent rows select করে Present করতে পারো</div>
                </div>

                <div class="flex items-center gap-2">
                    <x-button type="button" variant="secondary" wire:click="load">Refresh</x-button>
                    <x-button type="button" variant="primary" @click="openConfirm=true">Apply</x-button>
                </div>
            </div>

            @if(empty($attendances))
                <div class="text-sm text-gray-600">Nothing to adjust.</div>
            @else
                <div class="space-y-2">
                    @foreach($attendances as $a)
                        <x-attendance.adjust-item :item="$a" />
                    @endforeach
                </div>
            @endif

            <x-ui.confirm-modal
                open="openConfirm"
                title="Confirm Adjust"
                message="Selected items Present করতে চান?"
                confirmText="Confirm"
                cancelText="Cancel"
                confirmAction="applyAdjust"
                loadingTarget="applyAdjust"
            />
        </div>
    @endif
</div>

<div class="p-4">
    <h3 class="text-lg font-bold mb-4">Semesters</h3>

    @if (session()->has('message'))
        <div class="alert alert-success mb-3">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">

            <x-form-input
                label="Semester Name"
                name="semester_name"
                placeholder="e.g. 1st Semester"
                type="text"
                wire:model="semester_name"
                class="form-control"
            />

            <x-form-select
                label="Session"
                name="session_id"
                wire:model="session_id"
                :options="$academicSessions"
                placeholder="Select a session..."
                icon="calendar-days"
            />

            <x-form-input
                label="Start Date"
                name="start_date"
                type="date"
                wire:model="start_date"
                class="form-control"
            />

            <x-form-input
                label="End Date"
                name="end_date"
                type="date"
                wire:model="end_date"
                class="form-control"
            />

        </div>

        <div class="mt-4">
            <flux:button type="submit" variant="primary" wire:loading.attr="disabled">
                <span wire:loading.remove>Add Semester</span>
                <span wire:loading>Saving...</span>
            </flux:button>
        </div>
    </form>

    <h4 class="font-semibold mb-3">Semester List</h4>

    <table class="table table-bordered w-full">
        <thead>
            <tr>
                <th>#</th>
                <th>Semester</th>
                <th>Session</th>
                <th>Start</th>
                <th>End</th>
                <th class="w-32">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($semesters as $s)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $s->semester_name }}</td>
                    <td>{{ $s->academicSession->name ?? $s->session_id }}</td>
                    <td>{{ $s->start_date }}</td>
                    <td>{{ $s->end_date }}</td>
                    <td>
                        <flux:button
                            variant="danger"
                            size="sm"
                            wire:click="delete({{ $s->id }})"
                            wire:confirm="Are you sure?"
                        >
                            Delete
                        </flux:button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4">No semesters found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

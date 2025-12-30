<div class="p-4">
    <h3 class="text-lg font-bold mb-4">Courses</h3>

    @if (session()->has('message'))
        <div class="alert alert-success mb-3">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">

            <x-form-input
                label="Course Name"
                name="course_name"
                placeholder="e.g. English"
                type="text"
                wire:model="course_name"
                class="form-control"
            />

            <x-form-input
                label="Course Type"
                name="course_type"
                placeholder="e.g. Theory / Practical"
                type="text"
                wire:model="course_type"
                class="form-control"
            />

            <x-form-select
                label="Class"
                name="class_id"
                wire:model="class_id"
                :options="$classes"
                placeholder="Select a class..."
                icon="building-library"
            />

            <x-form-select
                label="Semester"
                name="semester_id"
                wire:model="semester_id"
                :options="$semesters"
                placeholder="Select a semester..."
                icon="calendar"
            />

            <x-form-select
                label="Session"
                name="session_id"
                wire:model="session_id"
                :options="$academicSessions"
                placeholder="Select a session..."
                icon="calendar-days"
            />
        </div>

        <div class="mt-4">
            <flux:button type="submit" variant="primary" wire:loading.attr="disabled">
                <span wire:loading.remove>Add Course</span>
                <span wire:loading>Saving...</span>
            </flux:button>
        </div>
    </form>

    <h4 class="font-semibold mb-3">Course List</h4>

    <table class="table table-bordered w-full">
        <thead>
            <tr>
                <th>#</th>
                <th>Course</th>
                <th>Type</th>
                <th>Class</th>
                <th>Semester</th>
                <th>Session</th>
                <th class="w-32">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($courses as $c)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $c->course_name }}</td>
                    <td>{{ $c->course_type }}</td>
                    <td>{{ $c->studentClass->name ?? $c->class_id }}</td>
                    <td>{{ $c->semester->name ?? $c->semester_id }}</td>
                    <td>{{ $c->academicSession->name ?? $c->session_id }}</td>
                    <td>
                        <flux:button
                            variant="danger"
                            size="sm"
                            wire:click="delete({{ $c->id }})"
                            wire:confirm="Are you sure?"
                        >
                            Delete
                        </flux:button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-4">No courses found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

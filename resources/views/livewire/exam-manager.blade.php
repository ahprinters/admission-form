<div class="p-4">

    <h3 class="text-lg font-bold mb-4">Create New Exam</h3>

    @if (session()->has('message'))
        <div class="alert alert-success mb-3">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="saveExam">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
            <x-form-input
                label="Exam Name"
                name="exam_name"
                placeholder="e.g. Midterm, Final"
                type="text"
                wire:model="exam_name"
                class="form-control"
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

            {{-- Semester --}}
            <x-form-select
                label="Semester"
                name="semester_id"
                wire:model="semester_id"
                :options="$semesters"
                placeholder="Select a semester..."
                icon="calendar"
            />

            {{-- Course --}}
            <x-form-select
                label="Course"
                name="course_id"
                wire:model="course_id"
                :options="$courses"
                placeholder="Select a course..."
                icon="book-open"
            />

            {{-- Academic Session --}}
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
                <span wire:loading.remove>Save Exam</span>
                <span wire:loading>Saving...</span>
            </flux:button>
        </div>

    </form>

    <hr class="my-6">

    <h4 class="font-semibold mb-3">Exam List</h4>

    <table class="table table-bordered w-full">
        <thead>
            <tr>
                <th>#</th>
                <th>Exam</th>
                <th>Course</th>
                <th>Semester</th>
                <th>Session</th>
                <th>Dates</th>
            </tr>
        </thead>
        <tbody>
            @forelse($exams as $exam)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $exam->exam_name }}</td>
                    <td>{{ $exam->course->course_name ?? '' }}</td>
                    <td>{{ $exam->semester->name ?? '' }}</td>
                    <td>{{ $exam->academicSession->name ?? '' }}</td>
                    <td>{{ $exam->start_date }} → {{ $exam->end_date }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4">No exams found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

<div class="max-w-2xl mx-auto p-6 bg-white shadow rounded">
    <h2 class="text-2xl font-bold mb-4">➕ Add New Class</h2>

    <!-- Toast Alert -->
    <x-toast />

    <form wire:submit.prevent="submit" class="space-y-4">
        <!-- Grade -->
        <x-form-select
            name="grade"
            label="Grade"
            :options="$grades->pluck('name','id')"
            placeholder="নির্বাচন করুন"
        />

        <!-- Class Name -->
        <x-form-input
            name="class_name"
            label="Class Name"
            placeholder="Enter class name"
        />
        <!-- Class Code -->
        <x-form-input
            name="class_code"
            label="Class Code"
            placeholder="Enter class code"
        />
        <!-- Subject Stream -->
        <x-form-select
            name="stream"
            label="Subject Stream"
            :options="$streams->pluck('stream_name','id')"
            placeholder="নির্বাচন করুন"
        />

        <!-- Teacher -->
        <x-form-select
            name="teacher"
            label="Teacher"
            :options="$teachers->pluck('name','id')"
            placeholder="নির্বাচন করুন"
        />

        <!-- Year -->
        <x-form-select
            name="year"
            label="Year"
            :options="collect(range(date('Y')-3, date('Y')+3))->mapWithKeys(fn($y) => [$y => $y])"
            placeholder="নির্বাচন করুন"
        />

        <!-- Submit Button -->
        <x-submit-button target="submit" text="Add Class" />
    </form>
</div>

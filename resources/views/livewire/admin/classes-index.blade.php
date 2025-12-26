<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">All Classes</h2>

    <!-- Back to Dashboard button -->
    <a href="{{ route('dashboard') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4 inline-block">
       ← Back to Dashboard
    </a>

    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2">Class Name</th>
                <th class="border px-4 py-2">Class Code</th>
                <th class="border px-4 py-2">Grade</th>
                <th class="border px-4 py-2">Stream</th>
                <th class="border px-4 py-2">Teacher</th>
                <th class="border px-4 py-2">Year</th>
            </tr>
        </thead>
        <tbody>
            @forelse($classes as $class)
                <tr>
                    <td class="border px-4 py-2">{{ $class->class_name }}</td>
                    <td class="border px-4 py-2">{{ $class->class_code }}</td>
                    <td class="border px-4 py-2">{{ $class->grade->name ?? '-' }}</td>
                    <td class="border px-4 py-2">{{ $class->stream->stream_name ?? '-' }}</td>
                    <td class="border px-4 py-2">{{ $class->teacher->name ?? '-' }}</td>
                    <td class="border px-4 py-2">{{ $class->year }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4">No classes found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

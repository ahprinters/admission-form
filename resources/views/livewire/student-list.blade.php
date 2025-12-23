<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold text-gray-800">শিক্ষার্থী তালিকা</h2>
        <a href="/student/create" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">নতুন শিক্ষার্থী যোগ করুন</a>
    </div>

    @if (session()->has('message'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">{{ session('message') }}</div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="p-3">নাম (English)</th>
                    <th class="p-3">ক্লাস</th>
                    <th class="p-3">রোল</th>
                    <th class="p-3">মোবাইল</th>
                    <th class="p-3 text-center">অ্যাকশন</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="p-3">{{ $student->name_en }}</td>
                    <td class="p-3">{{ $student->class }}</td>
                    <td class="p-3">{{ $student->roll_number }}</td>
                    <td class="p-3">{{ $student->phone }}</td>
                    <td class="p-3 text-center space-x-2">
                        <a href="{{ route('student.edit', $student->id) }}" class="text-blue-500 hover:underline">Edit</a>
                        <button wire:click="delete({{ $student->id }})"
                                wire:confirm="আপনি কি নিশ্চিতভাবে এটি মুছতে চান?"
                                class="text-red-500 hover:underline">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $students->links() }}
    </div>
</div>

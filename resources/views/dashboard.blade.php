<x-layouts.admin>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-xl font-semibold">
                    স্বাগতম, {{ auth()->user()->name }}! আপনি ড্যাশবোর্ডে লগইন করেছেন।
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                <div class="bg-blue-500 p-6 rounded-lg text-white shadow-lg">
                    <h3 class="text-lg">মোট শিক্ষার্থী</h3>
                    <p class="text-3xl font-bold">{{ \App\Models\Student::count() }}</p>
                </div>
                </div>
        </div>
    </div>
</x-layouts.admin>

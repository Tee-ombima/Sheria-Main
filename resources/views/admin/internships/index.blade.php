<!-- resources/views/admin/internships/index.blade.php -->
<x-layout>
    <x-card class="p-10 max-w-6xl mx-auto mt-24 bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-center mb-8 text-gray-800">Manage Internship Applications</h1>

        <div class="flex justify-between items-center mb-8">
            <a href="{{ route('admin.departments.create') }}" class="bg-indigo-500 text-white px-4 py-2 rounded-lg shadow hover:bg-indigo-600 transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Post a Department
            </a>
        </div>

        @foreach ($departments as $department)
            <div class="mb-6 p-4 bg-gray-100 rounded-lg shadow">
                <h2 class="text-2xl font-semibold text-gray-700">{{ $department->name }} 
                    <span class="text-gray-500">({{ $department->applications->count() }} Submissions)</span>
                </h2>

                @if ($department->applications->isEmpty())
                    <p class="text-gray-600 mt-2">No submissions yet.</p>
                @else
                    <a href="{{ route('admin.internships.show', $department->id) }}" class="mt-4 inline-block bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-green-500">
                        View Applications
                    </a>
                @endif
            </div>
        @endforeach

    </x-card>
</x-layout>

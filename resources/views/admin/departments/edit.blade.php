<!-- resources/views/admin/departments/edit.blade.php -->

<x-layout>
    <x-card class="p-10 max-w-lg mx-auto mt-24">
    <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 bg-gray-500 text-white font-semibold text-sm rounded-lg hover:bg-gray-700">
    ← Back
</a>
        <h1 class="text-3xl font-bold mb-6">Edit Department</h1>

        <form action="{{ route('admin.departments.update', $department->id) }}" method="POST">
            @csrf
            @method('PATCH')
            
            <!-- Department Name Input -->
            <div class="mb-6">
                <label for="name" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                    Department Name
                </label>
                <input type="text" name="name" id="name" value="{{ $department->name }}" required
                    class="border border-gray-400 p-2 w-full">
            </div>
            <!-- Department Email Input -->
            <div class="mb-6">
                <label for="email" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                    Department Email
                </label>
                <input type="email" name="email" id="email" value="{{ $department->email }}" required
                    class="border border-gray-400 p-2 w-full">
            </div>


            <!-- Submit Button -->
            <div class="mb-6">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">
                    Update Department
                </button>
            </div>
        </form>
    </x-card>
</x-layout>

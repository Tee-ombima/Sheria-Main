<!-- resources/views/admin/departments/index.blade.php -->

<x-layout>
    <x-card class="p-10 max-w-6xl mx-auto mt-24">
        <h1 class="text-3xl font-bold mb-6">Departments</h1>

        <!-- Success message -->
        @if(session('success'))
            <div class="mb-4 text-green-600 font-semibold">
                {{ session('success') }}
            </div>
        @endif

        <!-- List of departments -->
        <table class="min-w-full bg-white border-collapse">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-bold text-gray-600 border-b">Department Name</th>
                    <th class="px-6 py-3 text-left text-sm font-bold text-gray-600 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($departments as $department)
                    <tr>
                        <td class="px-6 py-4 border-b">{{ $department->name }}</td>
                        <td class="px-6 py-4 border-b space-x-2">
                            <!-- Edit department -->
                            <a href="{{ route('admin.departments.edit', $department->id) }}" class="text-blue-500 hover:underline">Edit</a>

                            <!-- Archive/Unarchive department -->
                            @if ($department->archived)
                                <form action="{{ route('admin.departments.unarchive', $department->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-green-500 hover:underline">Unarchive</button>
                                </form>
                            @else
                                <form action="{{ route('admin.departments.archive', $department->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-yellow-500 hover:underline">Archive</button>
                                </form>
                            @endif

                            <!-- Delete department -->
                            <form action="{{ route('admin.departments.destroy', $department->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Are you sure you want to delete this department?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Link to create a new department -->
        <div class="mt-6">
            <a href="{{ route('admin.departments.create') }}" class="bg-indigo-600 text-white py-2 px-4 rounded">Create New Department</a>
        </div>
    </x-card>
</x-layout>

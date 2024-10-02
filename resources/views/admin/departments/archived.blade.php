<!-- resources/views/admin/departments/archived.blade.php -->
<x-layout>
    <x-card class="p-10 max-w-6xl mx-auto mt-24">
        <h1>Archived Departments</h1>

        @foreach ($departments as $department)
            <h2>{{ $department->name }}</h2>
            
            <form action="{{ route('admin.departments.unarchive', $department->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="text-green-500 hover:underline">Unarchive</button>
            </form>
        @endforeach
    </x-card>
</x-layout>

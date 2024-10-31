<!-- resources/views/pupillages/index.blade.php -->
<x-layout>
    <x-card class="p-10 max-w-4xl mx-auto mt-24 bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-center mb-8 text-gray-800">Your Pupillage Applications</h1>

        @if (session('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('message') }}</span>
            </div>
        @endif

        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2">Full Name</th>
                    <th class="py-2">Status</th>
                    <th class="py-2">Remarks</th>
                    <th class="py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pupillages as $application)
                    <tr>
                        <td class="border px-4 py-2">{{ $application->full_name }}</td>
                        <td class="border px-4 py-2">{{ $application->status }}</td>
                        <td class="border px-4 py-2">{{ $application->remarks ?? 'N/A' }}</td>
                        <td class="border px-4 py-2">
    <a href="{{ route('pupillages.edit', $application->id) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
    <!-- Delete Button -->
    <form action="{{ route('pupillages.destroy', $application->id) }}" method="POST" style="display:inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-red-600 hover:text-red-800 ml-2" onclick="return confirm('Are you sure you want to delete this application?');">
            Delete
        </button>
    </form>
</td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4">No applications found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination Links -->
<div class="mt-4">
    {{ $pupillages->links() }}
</div>
    </x-card>
</x-layout>

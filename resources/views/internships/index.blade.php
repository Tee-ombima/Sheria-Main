<x-layout>
    <x-card class="p-10 max-w-lg mx-auto mt-24">
        <header class="text-center mb-6">
            <h2 class="text-2xl font-bold uppercase">Your Attachment Applications</h2>
        </header>

          <!-- Simple paragraph for Pupillage Programs -->
<p class="text-center text-gray-600 mb-4">
    KSL students only:
    <a href="{{ route('pupillages.create') }}" class="text-blue-600 hover:text-blue-800">
        Pupillage Programs Instead
    </a>
</p>


        @if ($internships->isEmpty())
            <p class="text-center text-gray-600">Regular Attachee?You have not applied for any 3 months internships yet.
            <a href="{{ route('internships.create') }}" class="text-blue-600 hover:text-blue-800 ml-2">
            APPLY
        </a>
            </p>
        @else
            <table class="min-w-full bg-white border-collapse">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-600 border-b">Full Name</th>
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-600 border-b">Status</th>
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-600 border-b">Actions</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($internships as $application)
                        <tr>
                            <td class="px-6 py-4 border-b">{{ $application->full_name }}</td>
                            <td class="px-6 py-4 border-b">{{ $application->status }}</td>
                            <td class="border px-4 py-2">
    <a href="{{ route('internships.edit', $application->id) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
    <!-- Delete Button -->
    <form action="{{ route('internships.destroy', $application->id) }}" method="POST" style="display:inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-red-600 hover:text-red-800 ml-2" onclick="return confirm('Are you sure you want to delete this application?');">
            Delete
        </button>
    </form>
</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination Links -->
<div class="mt-4">
    {{ $internships->links() }}
</div>
        @endif
        
    </x-card>
</x-layout>

<x-layout>
    <x-card class="p-10 max-w-6xl mx-auto mt-24 bg-white rounded-lg shadow-lg">
        <h1 class="text-2xl font-semibold mb-4">Archived Program Applications</h1>

        @forelse ($archivedApplications as $application)
            <div class="mb-4 p-4 bg-gray-200 rounded-lg shadow">
                <p><strong>Full Name:</strong> {{ $application->full_name }}</p>
                <p><strong>Department:</strong> {{ $application->department->name }}</p>
                <p><strong>Phone Number:</strong> {{ $application->phone }}</p>
                <p><strong>Institution:</strong> {{ $application->institution }}</p>
                <p><strong>Email:</strong> {{ $application->email }}</p>
                <p><strong>Status:</strong> {{ $application->status }}</p>
                <p><strong>Remarks:</strong> {{ $application->remarks ?? 'None' }}</p>

                <!-- File Fields -->
                <p><strong>ID File:</strong> 
                    @if($application->id_file)
                        <a href="{{ Storage::url($application->id_file) }}" class="text-blue-500 underline" target="_blank">Download</a>
                    @else
                        N/A
                    @endif
                </p>
                
                <p><strong>University Letter:</strong> 
                    @if($application->university_letter)
                        <a href="{{ Storage::url($application->university_letter) }}" class="text-blue-500 underline" target="_blank">Download</a>
                    @else
                        N/A
                    @endif
                </p>

                <p><strong>Own Application Letter:</strong> 
                    @if($application->application_letter)
                        <a href="{{ Storage::url($application->application_letter) }}" class="text-blue-500 underline" target="_blank">Download</a>
                    @else
                        N/A
                    @endif
                </p>

                <p><strong>Insurance:</strong> 
                    @if($application->insurance)
                        <a href="{{ Storage::url($application->insurance) }}" class="text-blue-500 underline" target="_blank">Download</a>
                    @else
                        N/A
                    @endif
                </p>

                <p><strong>Good Conduct:</strong> 
                    @if($application->good_conduct)
                        <a href="{{ Storage::url($application->good_conduct) }}" class="text-blue-500 underline" target="_blank">Download</a>
                    @else
                        N/A
                    @endif
                </p>

                <p><strong>CV:</strong> 
                    @if($application->cv)
                        <a href="{{ Storage::url($application->cv) }}" class="text-blue-500 underline" target="_blank">Download</a>
                    @else
                        N/A
                    @endif
                </p>

                <!-- Unarchive Button -->
                <form action="{{ route('admin.internships.unarchive', $application->id) }}" method="POST" class="mt-4">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Unarchive
                    </button>
                </form>
            </div>
        @empty
            <p>No archived applications found.</p>
        @endforelse

        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $archivedApplications->links() }}
        </div>
    </x-card>
</x-layout>

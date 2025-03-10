<!-- resources/views/admin/post_pupillages/archived.blade.php -->
<x-layout>
    <x-card class="p-10 max-w-6xl mx-auto mt-24 bg-white rounded-lg shadow-lg">
    <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 bg-gray-500 text-white font-semibold text-sm rounded-lg hover:bg-gray-700">
    ← Back
</a>
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Archived Post Pupillage Applications</h1>
            <div class="flex space-x-2">
                <!-- Button to View Pending Applications -->
                <a href="{{ route('admin.postPupillages.index') }}" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                    View Pending Post Pupillage Applications
                </a>
                <!-- Button to View Processed Applications -->
                <a href="{{ route('admin.postPupillages.nonPending') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                    View Processed Post Pupillage Applications
                </a>
                <!-- Button to View Program Applications -->
                <a href="{{ route('admin.internships.index') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                    View Attachee Applications
                </a>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg mb-6">
            <div class="p-4">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left">Email</th>
                            <th class="px-6 py-3 text-left">Status</th>
                            <th class="px-6 py-3 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($applications as $application)
                        <tr>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.postPupillages.show', $application->id) }}" class="text-blue-600">
                                    {{ $application->email_address }}
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                {{ $application->status }}
                            </td>
                            <td class="px-6 py-4">
                                <!-- Unarchive Button -->
                                <form action="{{ route('admin.postPupillages.unarchive', $application->id) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg shadow">
                                        Unarchive
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $applications->links() }}
            </div>
        </div>
    </x-card>
</x-layout>

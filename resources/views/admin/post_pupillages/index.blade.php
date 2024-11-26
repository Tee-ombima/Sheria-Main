<!-- resources/views/admin/post_pupillages/index.blade.php -->
<x-layout>
    <x-card class="p-10 max-w-6xl mx-auto mt-24 bg-white rounded-lg shadow-lg">
    <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 bg-gray-500 text-white font-semibold text-sm rounded-lg hover:bg-gray-700">
    ← Back
</a>
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Post Pupillage Applications</h1>
            <div class="flex space-x-2">
                

                

                <!-- View Accepted Applications Button -->
                <a href="{{ route('admin.postPupillages.accepted') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                    View Accepted Applications
                </a>

                <!-- View Not Accepted Applications Button -->
                <a href="{{ route('admin.postPupillages.not_accepted') }}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                    View Not Accepted Applications
                </a>
            </div>
        </div>

        <!-- Post Pupillage Applications Table -->
        <div class="bg-white shadow-md rounded-lg mb-6">
            <div class="p-4">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left">Full Name</th>
                            <th class="px-6 py-3 text-left">Email</th>
                            <th class="px-6 py-3 text-left">Status</th>
                            <th class="px-6 py-3 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($applications as $application)
                        <tr>
                            <td class="px-6 py-4">{{ $application->full_name }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.postPupillages.show', $application->id) }}" class="text-blue-600">
                                    {{ $application->email_address }}
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                {{ $application->status }}
                            </td>
                            <td class="px-6 py-4">
                                <!-- View Details Button -->
                                <a href="{{ route('admin.postPupillages.show', $application->id) }}" class="text-blue-600 hover:text-blue-800">
                                    View Details
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
<!-- Download Excel Button -->
                <a href="{{ route('admin.postPupillages.export') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                    Download All Applications Excel
                </a>
                <!-- Pagination Links -->
                {{ $applications->links() }}
            </div>
        </div>
    </x-card>
</x-layout>

<!-- resources/views/admin/postpupillages/accepted.blade.php -->
<x-layout>
    <x-card class="p-10 max-w-6xl mx-auto mt-24 bg-white rounded-lg shadow-lg">
        <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 bg-gray-500 text-white font-semibold text-sm rounded-lg hover:bg-gray-700">
            ← Back
        </a>

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Accepted PostPupillage Applications</h1>
            <div class="flex space-x-2">
                <!-- Additional controls if needed -->
            </div>
        </div>

        <!-- Applications Table -->
        <div class="bg-white shadow-md rounded-lg mb-6">
            <div class="p-4">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <!-- Include all relevant headers -->
                            <th class="px-6 py-3 text-left">Full Name</th>
                            <th class="px-6 py-3 text-left">Email</th>
                            <th class="px-6 py-3 text-left">Phone</th>
                            <th class="px-6 py-3 text-left">Status</th>
                            <th class="px-6 py-3 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($applications as $application)
                        <tr>
                            <!-- Display application data -->
                            <td class="px-6 py-4">{{ $application->full_name }}</td>
                            <td class="px-6 py-4">{{ $application->email_address }}</td>
                            <td class="px-6 py-4">{{ $application->mobile_number }}</td>
                            <td class="px-6 py-4">{{ $application->status }}</td>
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

                <!-- Pagination Links -->
                {{ $applications->links() }}
            </div>
        </div>

        <!-- Download Excel Button -->
        <a href="{{ route('admin.postPupillages.export') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow">
            Download Excel
        </a>
    </x-card>
</x-layout>

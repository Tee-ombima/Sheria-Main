<!-- resources/views/admin/post_pupillages/nonPending.blade.php -->
<x-layout>
    <x-card class="p-10 max-w-6xl mx-auto mt-24 bg-white rounded-lg shadow-lg">

    <!-- Download Excel Button -->
                <a href="{{ route('admin.postPupillages.export') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                    Download All Applications Excel
                </a>
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Processed Post Pupillage Applications</h1>
            <div class="flex space-x-2">
                <!-- Button to View Pending Applications -->
                <a href="{{ route('admin.postPupillages.index') }}" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                    View Pending Post Pupillage Applications
                </a>

                <!-- Button to View Program Applications -->
                <a href="{{ route('admin.internships.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow">
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
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $applications->links() }}
            </div>
        </div>
    </x-card>
</x-layout>

<!-- resources/views/admin/pupillages/index.blade.php -->
<x-layout>
    <x-card class="p-10 max-w-6xl mx-auto mt-24 bg-white rounded-lg shadow-lg">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Pupillage Applications</h1>
            <div class="flex space-x-2">
                <!-- Manage Departments Button -->
                <a href="{{ route('admin.departments.index') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                    Manage Departments
                </a>

                <!-- View Internship Applications Button -->
                <a href="{{ route('admin.internships.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                    View Attachee Applications
                </a>

                <!-- View Processed Applications Button -->
                <a href="{{ route('admin.pupillages.nonPending') }}" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                    View Processed Pupillage Applications
                </a>
            </div>
        </div>

        <!-- Filter Form -->
        <div class="mb-4">
            <form method="GET" action="{{ route('admin.pupillages.index') }}" class="flex items-center">
                <label for="assignment_filter" class="mr-2">Filter by Assignment:</label>
                <select name="assignment_filter" id="assignment_filter" class="border border-gray-300 rounded-md p-2 mr-4">
                    <option value="">All</option>
                    <option value="assigned" {{ request('assignment_filter') == 'assigned' ? 'selected' : '' }}>Assigned to Department</option>
                    <option value="not_assigned" {{ request('assignment_filter') == 'not_assigned' ? 'selected' : '' }}>Not Assigned to Department</option>
                </select>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                    Filter
                </button>
            </form>
        </div>

        <div class="bg-white shadow-md rounded-lg mb-6">
            <div class="p-4">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left">Email</th>
                            <th class="px-6 py-3 text-left">Status</th>
                            <th class="px-6 py-3 text-left">Assigned Department</th> <!-- New Column -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($applications as $application)
                        <tr>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.pupillages.show', $application->id) }}" class="text-blue-600">
                                    {{ $application->user->email }}
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                {{ $application->status }}
                            </td>
                            <td class="px-6 py-4">
                                @if($application->department)
                                    {{ $application->department->name }}
                                @else
                                    Not Assigned
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $applications->appends(request()->query())->links() }}
            </div>
        </div>
    </x-card>
</x-layout>

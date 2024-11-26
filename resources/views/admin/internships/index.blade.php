<!-- resources/views/admin/internships/index.blade.php -->
<x-layout>
    <x-card class="p-10 max-w-6xl mx-auto mt-24 bg-white rounded-lg shadow-lg">
    <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 bg-gray-500 text-white font-semibold text-sm rounded-lg hover:bg-gray-700">
    ← Back
</a>
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Attachee Applications</h1>
            <div class="flex space-x-2">
                <!-- Back to Dashboard Button -->
                <a href="{{ route('admin.dashboard') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                    Back to Dashboard
                </a>

                <!-- Manage Departments Button -->
                @if(isset($department))
                    <a href="{{ route('admin.departments.show', $department->id) }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                        View Department
                    </a>
                @else
                    <a href="{{ route('admin.departments.index') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                        Manage Departments
                    </a>
                @endif

                <!-- View Accepted Applications Button -->
                <a href="{{ route('admin.internships.accepted') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                    View Accepted Applications
                </a>

                <!-- View Not Accepted Applications Button -->
                <a href="{{ route('admin.internships.not_accepted') }}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                    View Not Accepted Applications
                </a>
            </div>
        </div>

        <!-- Filter Form -->
        <div class="mb-4">
            <form method="GET" action="{{ route('admin.internships.index') }}" class="flex items-center">
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
                            <th class="px-6 py-3 text-left">Assigned Department</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($applications as $application)
                        <tr>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.internships.show', $application->id) }}" class="text-blue-600">
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

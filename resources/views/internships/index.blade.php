<x-layout>
    <x-card class="p-8 max-w-7xl mx-auto mt-12">
        <!-- Back Button -->
        <a href="{{ url()->previous() }}" class="mb-6 inline-flex items-center px-4 py-2 bg-[#D68C3C] text-white rounded-md hover:bg-[#bf7a2e] transition-colors">
            <!-- SVG arrow -->
            Back
        </a>

        <!-- Header -->
        <header class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900">Your Program Applications</h2>
        </header>

        <!-- Program Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Attachment Program Card -->
            <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
                <h3 class="text-xl font-semibold text-[#D68C3C] mb-4">Attachment Program</h3>
                
                @if($internshipApplicationsEnabled)
                    @if ($internships->isEmpty())
                        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-4">
                            <p class="text-gray-700">
                                Apply as an Attachee for your Institution/University/College Attachment
                                <a href="{{ route('internships.create') }}" class="ml-2 text-[#D68C3C] hover:text-[#bf7a2e] font-medium">
                                    Apply Now →
                                </a>
                            </p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Full Name</th>
                                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Status</th>
                                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">State</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach ($internships as $application)
                                    <tr class="{{ $application->trashed() ? 'bg-gray-50' : '' }}">
                                        <td class="px-4 py-3 text-sm text-gray-900">
                                            {{ $application->full_name }}
                                           
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="px-2 py-1 text-xs font-medium rounded-full 
                                                {{ $application->status === 'approved' ? 'bg-green-100 text-green-800' : 
                                                   ($application->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                                   'bg-red-100 text-red-800') }}">
                                                {{ ucfirst($application->status) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-sm text-gray-500">
                                            @if($application->trashed())
                                                Already Processed
                                            @else
                                                Active
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $internships->links() }}
                        </div>
                    @endif
                @else
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-gray-600 text-sm">Attachment program is currently unavailable</p>
                    </div>
                @endif
            </div>

            <!-- Pupillage Program Card -->
            <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
                <h3 class="text-xl font-semibold text-[#D68C3C] mb-4">Pupillage Program</h3>
                
                @if($pupillageApplicationsEnabled)
                    @if ($pupillages->isEmpty())
                        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-4">
                            <p class="text-gray-700">
                                Apply for a law student's Pupillage Program
                                <a href="{{ route('pupillages.create') }}" class="ml-2 text-[#D68C3C] hover:text-[#bf7a2e] font-medium">
                                    Apply Now →
                                </a>
                            </p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Full Name</th>
                                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Status</th>
                                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">State</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach ($pupillages as $application)
                                    <tr class="{{ $application->trashed() ? 'bg-gray-50' : '' }}">
                                        <td class="px-4 py-3 text-sm text-gray-900">
                                            {{ $application->full_name }}
                                           
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="px-2 py-1 text-xs font-medium rounded-full 
                                                {{ $application->status === 'approved' ? 'bg-green-100 text-green-800' : 
                                                   ($application->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                                   'bg-red-100 text-red-800') }}">
                                                {{ ucfirst($application->status) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-sm text-gray-500">
                                            @if($application->trashed())
                                                Already Processed
                                            @else
                                                Active
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $pupillages->links() }}
                        </div>
                    @endif
                @else
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-gray-600 text-sm">Pupillage program is currently unavailable</p>
                    </div>
                @endif
            </div>

            <!-- Post Pupillage Program Card -->
            <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
                <h3 class="text-xl font-semibold text-[#D68C3C] mb-4">Post Pupillage Program</h3>
                
                @if($postPupillageApplicationsEnabled)
                    @if ($postpupillages->isEmpty())
                        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-4">
                            <p class="text-gray-700">
                                Apply for a law student's Post Pupillage Program
                                <a href="{{ route('postPupillages.create') }}" class="ml-2 text-[#D68C3C] hover:text-[#bf7a2e] font-medium">
                                    Apply Now →
                                </a>
                            </p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Full Name</th>
                                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Status</th>
                                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">State</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach ($postpupillages as $application)
                                    <tr class="{{ $application->trashed() ? 'bg-gray-50' : '' }}">
                                        <td class="px-4 py-3 text-sm text-gray-900">
                                            {{ $application->full_name }}
                                           
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="px-2 py-1 text-xs font-medium rounded-full 
                                                {{ $application->status === 'approved' ? 'bg-green-100 text-green-800' : 
                                                   ($application->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                                   'bg-red-100 text-red-800') }}">
                                                {{ ucfirst($application->status) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-sm text-gray-500">
                                            @if($application->trashed())
                                                Already Processed
                                            @else
                                                Active
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $postpupillages->links() }}
                        </div>
                    @endif
                @else
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-gray-600 text-sm">Post Pupillage program is currently unavailable</p>
                    </div>
                @endif
            </div>
        </div>
    </x-card>

    <!-- Pagination style remains same -->

    <style>
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 1rem;
        }
        
        .pagination li {
            margin: 0 0.25rem;
        }
        
        .pagination a,
        .pagination span {
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            border: 1px solid #e5e7eb;
            color: #4b5563;
        }
        
        .pagination a:hover {
            background-color: #f3f4f6;
        }
        
        .pagination .active span {
            background-color: #D68C3C;
            border-color: #D68C3C;
            color: white;
        }
    </style>
</x-layout>
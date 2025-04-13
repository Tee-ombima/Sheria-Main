<x-layout>
  <!-- Main card with creamy background -->
  <x-card class="p-8 max-w-6xl mx-auto mt-24 bg-[#FFF5E6] rounded-lg shadow-lg">
    <!-- Back Button -->
    <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 bg-[#D68C3C] text-white rounded-md hover:bg-[#bf7a2e] transition-colors shadow-sm mb-6">
      <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
      </svg>
      Back
    </a>

    <!-- Header Section -->
    <div class="flex justify-between items-center mb-8">
      <h1 class="text-3xl font-bold text-gray-900">Attachee Applications</h1>
      <div class="flex space-x-4">
        <!-- Manage Departments Button -->
        @if(isset($department))
          <a href="{{ route('admin.departments.show', $department->id) }}" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors shadow-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
            View Department
          </a>
        @else
          <a href="{{ route('admin.departments.index') }}" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors shadow-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
            Manage Departments
          </a>
        @endif
      </div>
    </div>

    <!-- Total Applications & Search Bar -->
    <div class="flex justify-between items-center mb-6">
      @if($showTotal)
    <span class="px-3 py-1 bg-[#D68C3C] text-white rounded-full text-sm">
        Total Applications: {{ number_format($totalApplications) }}
    </span>
@endif
      
      <!-- Search Form -->
      <form method="GET" action="{{ route('admin.internships.index') }}" class="flex items-center gap-4">
        <div class="relative">
        
          <input type="text" 
                 name="search_email" 
                 placeholder="Search by Email" 
                 class="pl-10 pr-4 py-2 border rounded-md focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                 value="{{ request('search_email') }}">
          <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
          </div>
        </div>
        <button type="submit" class="px-4 py-2 bg-[#D68C3C] text-white rounded-md hover:bg-[#bf7a2e] transition-colors shadow-sm">
          Search
        </button>
      </form>
    </div>

<!-- Filter Form -->
<div class="mb-6 bg-white p-4 rounded-lg shadow-sm">
  <form method="GET" action="{{ route('admin.internships.index') }}" class="flex flex-wrap items-center gap-4">
    <!-- Assignment Filter -->
    <div class="flex items-center space-x-2">
      <label for="assignment_filter" class="text-sm font-medium text-gray-700">Assignment:</label>
      <select name="assignment_filter" id="assignment_filter" class="border border-gray-300 rounded-md p-2 focus:border-[#D68C3C] focus:ring-[#D68C3C]">
        <option value="">All</option>
        <option value="assigned" {{ request('assignment_filter') == 'assigned' ? 'selected' : '' }}>Assigned</option>
        <option value="not_assigned" {{ request('assignment_filter') == 'not_assigned' ? 'selected' : '' }}>Not Assigned</option>
      </select>
    </div>

    <!-- Status Filter -->
    <div class="flex items-center space-x-2">
      <label for="status_filter" class="text-sm font-medium text-gray-700">Status:</label>
      <select name="status_filter" id="status_filter" class="border border-gray-300 rounded-md p-2 focus:border-[#D68C3C] focus:ring-[#D68C3C]">
        <option value="">All</option>
        <option value="Pending" {{ request('status_filter') == 'Pending' ? 'selected' : '' }}>Pending</option>
        <option value="Accepted" {{ request('status_filter') == 'Accepted' ? 'selected' : '' }}>Accepted</option>
        <option value="Not_Successful" {{ request('status_filter') == 'Not_Successful' ? 'selected' : '' }}>Not Successful</option>
      </select>
    </div>

    <button type="submit" class="px-4 py-2 bg-[#D68C3C] text-white rounded-md hover:bg-[#bf7a2e] transition-colors shadow-sm">
      Filter
    </button>
  </form>
</div>
    <!-- Applications Table -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-[#F4EDE4]">
          <tr>
            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Email</th>
            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Department</th>
            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @foreach($applications as $application)
          <tr class="hover:bg-gray-50 transition-colors">
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
              <a href="{{ route('admin.internships.show', $application->id) }}" class="text-[#D68C3C] hover:underline">
                {{ $application->user->email }}
              </a>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
              <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $application->status === 'accepted' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                {{ $application->status }}
              </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
              {{ $application->department->name ?? 'Not Assigned' }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm">
  @if($application->status !== 'Pending')
  <form action="{{ route('admin.internships.destroy', $application->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">
      Delete
    </button>
  </form>
  @endif
  <a href="{{ route('admin.internships.show', $application->id) }}" class="ml-2 text-[#D68C3C] hover:text-[#bf7a2e]">
    View
  </a>
</td>

          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
      {{ $applications->appends(request()->query())->links() }}
    </div>
  </x-card>
</x-layout>
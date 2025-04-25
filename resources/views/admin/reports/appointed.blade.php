<x-layout>
  <x-card class="p-8 max-w-6xl mx-auto mt-24 bg-[#FFF5E6] rounded-lg shadow-lg">
    <!-- Header Section -->
    <div class="mb-6">
      <div class="flex justify-between items-start mb-6">
        <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 bg-[#D68C3C] text-white rounded-md hover:bg-[#bf7a2e] transition-colors shadow-sm">
          <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
          </svg>
          Back
        </a>
        <a href="{{ route('export.csv', ['type' => 'appointed', 'job_title' => $jobTitle]) }}" 
           class="inline-flex items-center px-4 py-2 bg-[#D68C3C] text-white rounded-md hover:bg-[#bf7a2e] transition-colors shadow-sm">
          <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
          </svg>
          Export CSV
        </a>
      </div>

      <div class="flex flex-wrap justify-between items-center gap-4 mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Appointed</h1>
        <div class="text-sm text-gray-500">
          Showing {{ $applications->firstItem() }} - {{ $applications->lastItem() }} of {{ $applications->total() }} results
        </div>
      </div>
    </div>

    <!-- Filter Form -->
    <form method="GET" action="{{ url()->current() }}" class="mb-6 bg-white p-4 rounded-lg shadow-sm">
      <div class="flex flex-wrap items-center gap-4">
        <label for="job_title" class="block text-sm font-medium text-gray-700">Filter by Job Title:</label>
        <select name="job_title" id="job_title" class="p-2 border border-gray-300 rounded-md shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]">
          <option value="">All Jobs</option>
          @foreach($jobs as $job)
            <option value="{{ $job->title }}" {{ request('job_title') == $job->title ? 'selected' : '' }}>
              {{ $job->title }}
            </option>
          @endforeach
        </select>
        <button type="submit" class="bg-[#D68C3C] hover:bg-[#bf7a2e] text-white px-4 py-2 rounded-md shadow-sm">
          Filter
        </button>
      </div>
    </form>

    <!-- Table Container -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
      <div class="overflow-x-auto">
        <table class="w-full border-collapse">
          <thead class="bg-gray-50">
            <tr>
              <th class="p-3 text-left text-sm font-semibold text-gray-700">ID Number</th>
              <th class="p-3 text-left text-sm font-semibold text-gray-700">Name</th>
              <th class="p-3 text-left text-sm font-semibold text-gray-700">Gender</th>
              <th class="p-3 text-left text-sm font-semibold text-gray-700">County</th>
              <th class="p-3 text-left text-sm font-semibold text-gray-700">Subcounty</th>
              <th class="p-3 text-left text-sm font-semibold text-gray-700">Constituency</th>
              <th class="p-3 text-left text-sm font-semibold text-gray-700">Email</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200">
            @foreach($applications as $application)
              <tr class="hover:bg-gray-50 transition-colors">
                <td class="p-3 text-gray-700">{{ $application->user->personalInfo->idno }}</td>
                <td class="p-3 text-gray-700">{{ $application->user->personalInfo->firstname }} {{ $application->user->personalInfo->lastname }}</td>
                <td class="p-3 text-gray-700">{{ $application->user->personalInfo->gender ?? 'N/A' }}</td>
                <td class="p-3 text-gray-700">{{ $application->user->personalInfo->homecounty->name ?? 'N/A' }}</td>
                <td class="p-3 text-gray-700">{{ $application->user->personalInfo->subcounty->name ?? 'N/A' }}</td>
                <td class="p-3 text-gray-700">{{ $application->user->personalInfo->constituency->name ?? 'N/A' }}</td>
                <td class="p-3 text-gray-700 truncate max-w-[200px]" title="{{ $application->user->email }}">{{ $application->user->email }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
        
      </div>

      @if($applications->hasPages())
    <div class="p-4 border-t">
        {{ $applications->appends(request()->query())->links() }}
    </div>
@endif
    </div>
  </x-card>
</x-layout>
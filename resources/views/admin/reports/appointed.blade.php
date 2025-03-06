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

    <!-- Page Title -->
    <h1 class="text-3xl font-bold mb-8 text-gray-900">Appointed</h1>

    <!-- Filter Form -->
    <form method="GET" action="{{ url()->current() }}" class="mb-8 bg-white p-6 rounded-lg shadow-sm">
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

    <!-- Applications Table -->
    <div class="bg-white p-6 rounded-lg shadow-sm mb-8">
      <table class="w-full border-collapse">
        <thead class="bg-gray-50">
          <tr>
            <th class="p-4 text-left text-sm font-semibold text-gray-700 border-b">ID Number</th>
            <th class="p-4 text-left text-sm font-semibold text-gray-700 border-b">Name</th>
            <th class="p-4 text-left text-sm font-semibold text-gray-700 border-b">Email</th>
            <th class="p-4 text-left text-sm font-semibold text-gray-700 border-b">Mobile Number</th>
            <th class="p-4 text-left text-sm font-semibold text-gray-700 border-b">Alternate Contact</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          @foreach($applications as $application)
            <tr class="hover:bg-gray-50 transition-colors">
              <td class="p-4 text-gray-700">{{ $application->user->personalInfo->idno }}</td>
              <td class="p-4 text-gray-700">{{ $application->user->personalInfo->firstname }} {{ $application->user->personalInfo->lastname }}</td>
              <td class="p-4 text-gray-700">{{ $application->user->email }}</td>
              <td class="p-4 text-gray-700">{{ $application->user->personalInfo->mobile_num }}</td>
              <td class="p-4 text-gray-700">
                {{ $application->user->personalInfo->alt_contact_person }}: {{ $application->user->personalInfo->alt_contact_telephone_num }}
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <!-- Export Buttons -->
    <div class="flex gap-4 mt-8">
      <a href="{{ route('export.csv', ['type' => 'appointed', 'job_title' => $jobTitle]) }}" 
         class="inline-flex items-center px-4 py-2 bg-[#D68C3C] text-white rounded-md hover:bg-[#bf7a2e] transition-colors shadow-sm">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
        </svg>
        Export CSV
      </a>
      
      <a href="{{ route('export.pdf', ['type' => 'appointed', 'job_title' => $jobTitle]) }}" 
         class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors shadow-sm">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
        </svg>
        Download PDF
      </a>
    </div>
  </x-card>
</x-layout>
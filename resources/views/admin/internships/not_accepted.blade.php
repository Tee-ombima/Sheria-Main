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
      <h1 class="text-3xl font-bold text-gray-900">Not Accepted Internship Applications</h1>
    </div>

    <!-- Applications Table -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-[#F4EDE4]">
          <tr>
            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Full Name</th>
            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Email</th>
            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Phone</th>
            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Assigned Department</th>
            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @foreach($applications as $application)
            <tr class="hover:bg-gray-50 transition-colors">
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $application->full_name }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $application->email }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $application->phone }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                  {{ $application->status }}
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                @if($application->department)
                  {{ $application->department->name }}
                @else
                  <span class="text-gray-500">Not Assigned</span>
                @endif
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                <a href="{{ route('admin.internships.show', $application->id) }}" class="text-[#D68C3C] hover:text-[#bf7a2e] hover:underline">
                  View Details
                </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
      {{ $applications->links() }}
    </div>
  </x-card>
</x-layout>
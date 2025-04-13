<x-layout>
<x-card class="p-8 ..." x-data="{ showBulkUpdate: false, showBulkDelete: false }">    <!-- Back Button -->
    <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 bg-[#D68C3C] text-white rounded-md hover:bg-[#bf7a2e] transition-colors shadow-sm mb-6">
      <!-- SVG arrow -->
      Back
    </a>

    <!-- Header Section -->
    <div class="flex justify-between items-center mb-8">
      <h1 class="text-3xl font-bold text-gray-900">Pupillage Applications</h1>
      <div class="flex space-x-4">
        <a href="{{ route('admin.pupillages.export') }}" 
   class="inline-flex items-center px-4 py-2 bg-green-600 text-white font-semibold rounded-md shadow hover:bg-green-500 transition duration-200 ease-in-out">
  <!-- Excel Icon (SVG) -->
  <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" 
       xmlns="http://www.w3.org/2000/svg">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
          d="M9 12h6m-3-3v6m-7 4h14a2 2 0 002-2V5a2 2 0 00-2-2H6a2 2 0 00-2 2v14a2 2 0 002 2z">
    </path>
  </svg>
  Download Excel
</a>
      </div>
    </div>
    <div class="flex space-x-4">
    <!-- Bulk Update Button -->
    <button @click="showBulkUpdate = !showBulkUpdate; showBulkDelete = false" 
            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-500">
        Bulk Update
    </button>
    
    <!-- Bulk Delete Button -->
    <button @click="showBulkDelete = !showBulkDelete; showBulkUpdate = false" 
            class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-500">
        Bulk Delete
    </button>
</div>
<!-- Bulk Update Form -->
<div x-show="showBulkUpdate" x-cloak class="mt-6 bg-white p-6 rounded-lg shadow">
    <h3 class="text-xl font-bold mb-4">Bulk Status Update</h3>
    <form method="POST" action="{{ route('admin.pupillages.bulk-update') }}">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Emails (comma separated)</label>
                <textarea name="emails" rows="3" class="w-full border rounded-md p-2" required></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">New Status</label>
                <select name="status" class="w-full border rounded-md p-2">
                    <option value="Pending">Pending</option>
                    <option value="Accepted">Accepted</option>
                    <option value="Not_Successful">Not Successful</option>
                </select>
            </div>
            <div class="self-end">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-500">
                    Update Selected
                </button>
            </div>
        </div>
    </form>
</div>

<!-- Bulk Delete Form -->
<div x-show="showBulkDelete" x-cloak class="mt-6 bg-white p-6 rounded-lg shadow">
    <h3 class="text-xl font-bold mb-4">Bulk Delete</h3>
    <form method="POST" action="{{ route('admin.pupillages.bulk-destroy') }}">
        @csrf
        @method('DELETE')
        <div class="flex gap-4">
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-2">Emails (comma separated)</label>
                <textarea name="emails" rows="3" class="w-full border rounded-md p-2" required></textarea>
            </div>
            <div class="self-end">
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-500">
                    Delete Selected
                </button>
            </div>
        </div>
    </form>
</div>
    <!-- Search and Filters -->
    <div class="flex justify-between items-center mb-6">
      @if($showTotalPupillage)
        <span class="px-3 py-1 bg-[#D68C3C] text-white rounded-full text-sm">
            Total Applications: {{ number_format($totalPupillage) }}
        </span>
      @endif
      
      <div class="flex gap-4">
        <form method="GET" class="flex items-center gap-4">
          <div class="relative">
            <input type="text" 
                   name="search_email" 
                   placeholder="Search by Email" 
                   class="pl-10 pr-4 py-2 border rounded-md focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                   value="{{ request('search_email') }}">
            <!-- Search SVG -->
          </div>
          <select name="status_filter" class="border rounded-md p-2">
            <option value="">All Statuses</option>
            <option value="Pending" {{ request('status_filter') == 'Pending' ? 'selected' : '' }}>Pending</option>
            <option value="Accepted" {{ request('status_filter') == 'Accepted' ? 'selected' : '' }}>Accepted</option>
            <option value="Not Accepted" {{ request('status_filter') == 'Not Accepted' ? 'selected' : '' }}>Not Accepted</option>
          </select>
          <button type="submit" class="px-4 py-2 bg-[#D68C3C] text-white rounded-md hover:bg-[#bf7a2e]">
            Filter
          </button>
        </form>
      </div>
    </div>

    <!-- Applications Table -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-[#F4EDE4]">
          <tr>
            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Full Name</th>
            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Email</th>
            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @foreach($applications as $application)
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-4">{{ $application->full_name }}</td>
              <td class="px-6 py-4">
                <a href="{{ route('admin.pupillages.show', $application->id) }}" class="text-[#D68C3C] hover:underline">
                  {{ $application->email_address }}
                </a>
              </td>
              <td class="px-6 py-4">
                <span class="px-2 py-1 text-xs rounded-full {{ 
                  $application->status === 'Accepted' ? 'bg-green-100 text-green-800' : 
                  ($application->status === 'Pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                  {{ $application->status }}
                </span>
              </td>
              <td class="px-6 py-4">
  @if($application->status !== 'Pending')
  <form action="{{ route('admin.pupillages.destroy', $application->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">
      Delete
    </button>
  </form>
  @endif
  <a href="{{ route('admin.pupillages.show', $application->id) }}" class="ml-2 text-[#D68C3C] hover:text-[#bf7a2e]">
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
<!-- Add this at the bottom of the template -->
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('bulkActions', () => ({
            showBulkUpdate: false,
            showBulkDelete: false
        }))
    })
</script>
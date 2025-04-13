<x-layout>
  <x-card class="p-8 mx-auto mt-12 max-w-7xl">
    <!-- Status Header -->
    <div class="text-center mb-8">
      <h2 class="text-3xl font-bold text-gray-900 mb-2">
        Seminars & Workshops
        <span class="ml-2 px-4 py-1 rounded-full {{ $relevantCoursesSubmitted ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
          {{ $relevantCoursesSubmitted ? '✓ Submitted' : '✗ Not Submitted' }}
        </span>
      </h2>
      <p class="text-gray-600 mt-2">All fields marked with <span class="text-red-500">*</span> are required</p>
    </div>

    <!-- Error Messages -->
    @if ($errors->any())
    <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6">
      <div class="flex">
        <div class="flex-shrink-0">
          <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
          </svg>
        </div>
        <div class="ml-3">
          <h3 class="text-sm font-medium text-red-800">Please correct the following errors:</h3>
          <ul class="mt-2 text-sm text-red-700 list-disc pl-5 space-y-1">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
    @endif

    <form action="{{ route('add.relrow') }}" method="POST" id="relevantCoursesForm" class="space-y-6">
      @csrf
      
      <!-- Form Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Institution Name -->
        <div>
          <label for="rel_institution_name" class="block text-sm font-medium text-gray-700">
            Institution Name <span class="text-red-500">*</span>
          </label>
          <input type="text" name="rel_institution_name" id="rel_institution_name" maxlength="100" required
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                 value="{{ old('rel_institution_name') }}">
        </div>

        <!-- Course -->
        <div>
          <label for="rel_course" class="block text-sm font-medium text-gray-700">
            Course <span class="text-red-500">*</span>
          </label>
          <input type="text" name="rel_course" id="rel_course" maxlength="100" required
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                 value="{{ old('rel_course') }}">
        </div>

        <!-- Certificate No -->
        <div>
          <label for="rel_certificate_no" class="block text-sm font-medium text-gray-700">
            Certificate Number <span class="text-red-500">*</span>
          </label>
          <input type="text" name="rel_certificate_no" id="rel_certificate_no" maxlength="100" required
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                 value="{{ old('rel_certificate_no') }}">
        </div>

        <!-- Issue Date -->
        <div>
          <label for="rel_issue_date" class="block text-sm font-medium text-gray-700">
            Issue Date <span class="text-red-500">*</span>
          </label>
          <input type="date" name="rel_issue_date" id="rel_issue_date" required
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                 value="{{ old('rel_issue_date') }}">
        </div>
      </div>

      <!-- Form Actions -->
      <div class="flex justify-end space-x-4">
        <button type="submit" class="px-6 py-2 bg-[#D68C3C] text-white rounded-md hover:bg-[#bf7a2e] flex items-center">
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
          </svg>
          Add Entry
        </button>
      </div>
    </form>

    <!-- Data Table -->
    <div class="mt-12 flow-root">
      <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
          <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-300">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="px-3 py-3 text-left text-sm font-semibold text-gray-900">Institution</th>
                  <th scope="col" class="px-3 py-3 text-left text-sm font-semibold text-gray-900">Course</th>
                  <th scope="col" class="px-3 py-3 text-left text-sm font-semibold text-gray-900">Certificate No</th>
                  <th scope="col" class="px-3 py-3 text-left text-sm font-semibold text-gray-900">Issue Date</th>
                  <th scope="col" class="px-3 py-3 text-left text-sm font-semibold text-gray-900">Status</th>
                  <th scope="col" class="px-3 py-3 text-left text-sm font-semibold text-gray-900">Actions</th>
                </tr>
              </thead>
              
              <tbody class="divide-y divide-gray-200 bg-white">
                <!-- Session Rows -->
                @foreach (session('rel_rows', []) as $index => $row)
                <tr class="bg-yellow-50">
                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">{{ $row['rel_institution_name'] }}</td>
                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $row['rel_course'] }}</td>
                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $row['rel_certificate_no'] }}</td>
                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                    {{ \Carbon\Carbon::parse($row['rel_issue_date'])->format('M d, Y') }}
                  </td>
                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                      Not Submitted
                    </span>
                  </td>
                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                    <form action="{{ route('remove.relsession.row') }}" method="POST">
                      @csrf
                      <input type="hidden" name="index" value="{{ $index }}">
                      <button type="submit" class="text-red-600 hover:text-red-900">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                      </button>
                    </form>
                  </td>
                </tr>
                @endforeach

                <!-- Database Rows -->
                @foreach ($relevantCourses as $datum)
                <tr>
                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">{{ $datum->rel_institution_name }}</td>
                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $datum->rel_course }}</td>
                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $datum->rel_certificate_no }}</td>
                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                    {{ \Carbon\Carbon::parse($datum->rel_issue_date)->format('M d, Y') }}
                  </td>
                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                      Submitted
                    </span>
                  </td>
                 <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                    <div class="flex items-center space-x-2">
                      <a href="{{ route('edit.rel.info', $datum->id) }}" 
                         class="text-[#3a4f29] hover:text-[#D68C3C]">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                        </svg>
                      </a>
                      <form action="{{ route('delete.rel.info', $datum->id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900">
                          <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                          </svg>
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
      {{ $relevantCourses->links() }}
    </div>

    <!-- Final Save -->
    <div class="mt-8 pt-6 border-t border-gray-200">
      <form action="{{ route('profile.save-relevant-courses') }}" method="POST">
        @csrf
        <div class="flex justify-end">
          <button type="submit" class="px-6 py-2 bg-[#3a4f29] text-white rounded-md hover:bg-[#2d3f1f] flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            Finalize Submission
          </button>
        </div>
      </form>
    </div>
  </x-card>

  <script>
    // Delete Confirmation
    document.querySelectorAll('.delete-row').forEach(button => {
      button.addEventListener('click', (e) => {
        if (!confirm('Are you sure you want to delete this entry?')) {
          e.preventDefault();
        }
      });
    });

    // Loading State
    document.querySelectorAll('form').forEach(form => {
      form.addEventListener('submit', () => {
        const submitBtn = form.querySelector('button[type="submit"]');
        submitBtn.innerHTML = `
          <svg class="animate-spin h-5 w-5 mr-2" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"/>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
          </svg>
          Processing...`;
      });
    });
  </script>
</x-layout>
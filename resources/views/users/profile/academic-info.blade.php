<x-layout>
  <x-card class="p-8 mx-auto mt-12 max-w-7xl">
    <!-- Status Header -->
    <div class="text-center mb-8">
      <h1 class="text-3xl font-bold text-gray-900 mb-2">
        Academic Information
        <span class="ml-2 px-4 py-1 rounded-full {{ $academicInfoSubmitted ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
          {{ $academicInfoSubmitted ? '✓ Submitted' : '✗ Not Submitted' }}
        </span>
      </h1>
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

    <!-- Form Section -->
    <form action="{{ route('add.row') }}" method="POST" id="academicInfoForm" class="space-y-6">
      @csrf
      
      <!-- Form Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <!-- Institution & Admission -->
        <div>
          <label for="institution_name" class="block text-sm font-medium text-gray-700 mb-1">
            Institution Name <span class="text-red-500">*</span>
          </label>
          <input type="text" name="institution_name" id="institution_name" maxlength="100" required
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                 value="{{ old('institution_name') }}">
        </div>

        <div>
          <label for="student_admission_no" class="block text-sm font-medium text-gray-700 mb-1">
            Student Admission No
          </label>
          <input type="text" name="student_admission_no" id="student_admission_no" maxlength="100"
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                 value="{{ old('student_admission_no') }}">
        </div>

        <!-- Dynamic Select Fields -->
        @foreach(['highschool' => 'Area of Study', 'specialisation' => 'Specialization', 'course' => 'Course', 'award' => 'Award', 'grade' => 'Grade'] as $field => $label)
        <div>
          <label for="{{ $field }}" class="block text-sm font-medium text-gray-700 mb-1">
            {{ $label }} <span class="text-red-500">*</span>
          </label>
          <select name="{{ $field }}" id="{{ $field }}" required
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                  data-other-target="#{{ $field }}_other_div">
            <option value="">Select {{ $label }}</option>
            @foreach(${$field.'s'} as $option)
            <option value="{{ $option->name }}" {{ old($field) == $option->name ? 'selected' : '' }}>
              {{ $option->name }}
            </option>
            @endforeach
            <option value="other" {{ old($field) === 'other' ? 'selected' : '' }}>Other</option>
          </select>
        </div>

        <!-- Other Input -->
        <div id="{{ $field }}_other_div" class="{{ old($field) === 'other' ? '' : 'hidden' }} col-span-full">
          <label for="{{ $field }}_other" class="block text-sm font-medium text-gray-700 mb-1">
            Specify {{ $label }} <span class="text-red-500">*</span>
          </label>
          <input type="text" name="{{ $field }}_other" id="{{ $field }}_other"
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                 value="{{ old($field.'_other') }}">
        </div>
        @endforeach

        <!-- Certificate & Dates -->
        <div>
          <label for="certificate_no" class="block text-sm font-medium text-gray-700 mb-1">
            Certificate No <span class="text-red-500">*</span>
          </label>
          <input type="text" name="certificate_no" id="certificate_no" maxlength="100"
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                 value="{{ old('certificate_no') }}">
        </div>

        <!-- Date Fields -->
        <div>
          <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">
            Start Date <span class="text-red-500">*</span>
          </label>
          <input type="date" name="start_date" id="start_date" required
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                 value="{{ old('start_date') }}">
        </div>

        <div>
          <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">
            End Date <span class="text-red-500">*</span>
          </label>
          <input type="date" name="end_date" id="end_date" required
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                 value="{{ old('end_date') }}">
        </div>

        <div>
          <label for="graduation_completion_date" class="block text-sm font-medium text-gray-700 mb-1">
            Graduation Date
          </label>
          <input type="date" name="graduation_completion_date" id="graduation_completion_date"
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                 value="{{ old('graduation_completion_date') }}">
        </div>
      </div>

      <!-- Form Actions -->
      <div class="flex justify-start space-x-4 mt-8">
       
        <button type="submit" class="px-6 py-2 bg-[#D68C3C] text-white rounded-md hover:bg-[#bf7a2e] flex items-center">
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
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
                  <th scope="col" class="px-3 py-3 text-left text-sm font-semibold text-gray-900">Admission No</th>
                  <th scope="col" class="px-3 py-3 text-left text-sm font-semibold text-gray-900">Study Area</th>
                  <th scope="col" class="px-3 py-3 text-left text-sm font-semibold text-gray-900">Specialization</th>
                  <th scope="col" class="px-3 py-3 text-left text-sm font-semibold text-gray-900">Course</th>
                  <th scope="col" class="px-3 py-3 text-left text-sm font-semibold text-gray-900">Dates</th>
                  <th scope="col" class="px-3 py-3 text-left text-sm font-semibold text-gray-900">Status</th>
                  <th scope="col" class="px-3 py-3 text-left text-sm font-semibold text-gray-900">Actions</th>
                </tr>
              </thead>
              
              <tbody class="divide-y divide-gray-200 bg-white">
    <!-- Temporary Session Rows (Not Submitted) -->
    @foreach (session('rows', []) as $index => $row)
    <tr class="bg-yellow-50">
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">{{ $row['institution_name'] }}</td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $row['student_admission_no'] ?? '' }}</td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $row['highschool'] }}</td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $row['specialisation'] }}</td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $row['course'] }}</td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
            @isset($row['start_date'])
                {{ \Carbon\Carbon::parse($row['start_date'])->format('M Y') }} - 
                {{ \Carbon\Carbon::parse($row['end_date'])->format('M Y') }}
            @endisset
        </td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                Not Submitted
            </span>
        </td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
            <form action="{{ route('remove.session.row') }}" method="POST">
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

    <!-- Saved Database Rows (Submitted) -->
    @foreach ($academicInfo as $datum)
    <tr>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">{{ $datum->institution_name }}</td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $datum->student_admission_no }}</td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $datum->highschool }}</td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $datum->specialisation }}</td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $datum->course }}</td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
            {{ \Carbon\Carbon::parse($datum->start_date)->format('M Y') }} - 
            {{ \Carbon\Carbon::parse($datum->end_date)->format('M Y') }}
        </td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                Submitted
            </span>
        </td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
            <div class="flex items-center space-x-2">
                <a href="{{ route('edit.academic.info', $datum->id) }}" 
                   class="text-[#3a4f29] hover:text-[#D68C3C]">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                    </svg>
                </a>
                <form action="{{ route('delete.academic.info', $datum->id) }}" method="POST">
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

    <!-- Final Save Section -->
    <div class="mt-8 pt-6 border-t border-gray-200">
      <form id="academic-info-form" action="{{ route('profile.save-academic-info') }}" method="POST" class="flex justify-end">
        @csrf
        <button type="submit" class="px-6 py-2 bg-[#3a4f29] text-white rounded-md hover:bg-[#2d3f1f] flex items-center">
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
          </svg>
          Finalize Submission
        </button>
      </form>
    </div>
  </x-card>

  <script>
document.addEventListener('DOMContentLoaded', function() {
    // ======== Dynamic Other Fields ========
    // For selects with data-other-target attribute
    document.querySelectorAll('select[data-other-target]').forEach(select => {
        const otherDiv = document.querySelector(select.dataset.otherTarget);
        const toggleVisibility = () => {
            const showOther = select.value === 'other';
            otherDiv.classList.toggle('hidden', !showOther);
            if (!showOther) {
                otherDiv.querySelector('input').value = '';
            }
        };
        select.addEventListener('change', toggleVisibility);
        toggleVisibility(); // Initial check
    });

    // For specific fields without data attributes
    const otherFieldConfig = [
        { selectId: 'highschool', otherDivId: 'highschool_other_div' },
        { selectId: 'specialisation', otherDivId: 'specialisation_other_div' },
        { selectId: 'course', otherDivId: 'course_other_div' },
        { selectId: 'award', otherDivId: 'award_other_div' },
        { selectId: 'grade', otherDivId: 'grade_other_div' }
    ];

    otherFieldConfig.forEach(({ selectId, otherDivId }) => {
        const select = document.getElementById(selectId);
        const otherDiv = document.getElementById(otherDivId);
        
        if (select && otherDiv) {
            const toggle = () => {
                const showOther = select.value === 'other';
                otherDiv.classList.toggle('hidden', !showOther);
                if (!showOther) {
                    otherDiv.querySelector('input').value = '';
                }
            };
            
            select.addEventListener('change', toggle);
            toggle(); // Initial state
        }
    });

    // ======== Rest of the code remains the same ========
    // Date Validation
    const endDateInput = document.getElementById('end_date');
    if (endDateInput) {
        endDateInput.addEventListener('change', function() {
            const startDate = new Date(document.getElementById('start_date').value);
            const endDate = new Date(this.value);
            
            if (startDate > endDate) {
                alert('End date cannot be before start date');
                this.value = '';
            }
        });
    }

    // Loading State
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', () => {
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.innerHTML = `
                    <svg class="animate-spin h-5 w-5 mr-2" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"/>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
                    </svg>
                    Processing...`;
            }
        });
    });

    // Edit Modal Functions
    window.openEditModal = function(datum) {
        document.getElementById('academic_id').value = datum.id;
        document.getElementById('edit_institution_name').value = datum.institution_name;
        document.getElementById('edit_student_admission_no').value = datum.student_admission_no;
        document.getElementById('editModal').classList.remove('hidden');
    };

    window.closeEditModal = function() {
        document.getElementById('editModal').classList.add('hidden');
    };

    // Delete Row Functionality
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('delete-row')) {
            const index = e.target.dataset.index;
            const row = document.querySelector(`tr[data-index="${index}"]`);
            
            if (row) {
                row.remove();
                
                fetch('{{ route("remove.session.row") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ index: index })
                })
                .then(response => response.json())
                .then(data => console.log(data))
                .catch(error => console.error('Error:', error));
            }
        }
    });
});
</script>

</x-layout>
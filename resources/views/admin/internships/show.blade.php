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
    <h1 class="text-3xl font-bold mb-8 text-gray-900">Application Details</h1>

    <!-- Applicant Information Section -->
    <div class="bg-white p-6 rounded-lg shadow-sm mb-8">
      <h2 class="text-2xl font-semibold mb-6 text-gray-800">Applicant Information</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <p class="text-sm text-gray-600">Full Name</p>
          <p class="text-lg font-medium text-gray-900">{{ $application->full_name }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Email</p>
          <p class="text-lg font-medium text-gray-900">{{ $application->email }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Phone Number</p>
          <p class="text-lg font-medium text-gray-900">{{ $application->phone }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Institution Name</p>
          <p class="text-lg font-medium text-gray-900">{{ $application->institution }}</p>
        </div>
      </div>
    </div>

    <!-- Uploaded Documents Section -->
    <div class="bg-white p-6 rounded-lg shadow-sm mb-8">
      <h3 class="text-2xl font-semibold mb-6 text-gray-800">Uploaded Documents</h3>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <p class="text-sm text-gray-600">ID File</p>
          @if($application->id_file)
            <a href="{{ asset('storage/' . $application->id_file) }}" target="_blank" class="text-[#D68C3C] hover:underline">View Document</a>
          @else
            <p class="text-gray-500">Not Provided</p>
          @endif
        </div>
        <div>
          <p class="text-sm text-gray-600">University Letter</p>
          @if($application->university_letter)
            <a href="{{ asset('storage/' . $application->university_letter) }}" target="_blank" class="text-[#D68C3C] hover:underline">View Document</a>
          @else
            <p class="text-gray-500">Not Provided</p>
          @endif
        </div>
        <div>
          <p class="text-sm text-gray-600">Own Application Letter</p>
          @if($application->application_letter)
            <a href="{{ asset('storage/' . $application->application_letter) }}" target="_blank" class="text-[#D68C3C] hover:underline">View Document</a>
          @else
            <p class="text-gray-500">Not Provided</p>
          @endif
        </div>
        <div>
          <p class="text-sm text-gray-600">Insurance</p>
          @if($application->insurance)
            <a href="{{ asset('storage/' . $application->insurance) }}" target="_blank" class="text-[#D68C3C] hover:underline">View Document</a>
          @else
            <p class="text-gray-500">Not Provided</p>
          @endif
        </div>
        <div>
          <p class="text-sm text-gray-600">Good Conduct</p>
          @if($application->good_conduct)
            <a href="{{ asset('storage/' . $application->good_conduct) }}" target="_blank" class="text-[#D68C3C] hover:underline">View Document</a>
          @else
            <p class="text-gray-500">Not Provided</p>
          @endif
        </div>
        <div>
          <p class="text-sm text-gray-600">Curriculum Vitae (CV)</p>
          @if($application->cv)
            <a href="{{ asset('storage/' . $application->cv) }}" target="_blank" class="text-[#D68C3C] hover:underline">View Document</a>
          @else
            <p class="text-gray-500">Not Provided</p>
          @endif
        </div>
      </div>
    </div>

    <!-- Update Application Form -->
    <div class="bg-white p-6 rounded-lg shadow-sm">
      <form action="{{ route('admin.internships.update', $application->id) }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <!-- Application Status -->
          <div>
            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Application Status</label>
            <select name="status" id="status" class="w-full border-gray-300 rounded-md shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]">
              <option value="Pending" @if($application->status == 'Pending') selected @endif>Pending</option>
              <option value="Accepted" @if($application->status == 'Accepted') selected @endif>Accepted</option>
              <option value="Not_Successful" @if($application->status == 'Not_Successful') selected @endif>Not Successful</option>
            </select>
          </div>
          <!-- Assign to Department -->
          <div>
            <label for="department_id" class="block text-sm font-medium text-gray-700 mb-2">Assign to Department</label>
            <select name="department_id" id="department_id" class="w-full border-gray-300 rounded-md shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]">
              <option value="">-- Select Department --</option>
              @foreach($departments as $department)
                <option value="{{ $department->id }}" @if($application->department_id == $department->id) selected @endif>
                  {{ $department->name }} ({{ $department->email }})
                </option>
              @endforeach
            </select>
          </div>
        </div>
        <!-- Submit Button -->
        <div class="flex justify-end mt-6">
          <button type="submit" class="px-6 py-2 bg-[#D68C3C] text-white rounded-md hover:bg-[#bf7a2e] transition-colors flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            Update Application
          </button>
        </div>
      </form>
    </div>
  </x-card>

  <!-- Loader Script -->
  <script>
    document.querySelector("form").addEventListener("submit", function() {
      const submitBtn = this.querySelector('button[type="submit"]');
      submitBtn.disabled = true;
      submitBtn.innerHTML = `
        <svg class="animate-spin h-5 w-5 mr-2" viewBox="0 0 24 24">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
        </svg>
        Updating...`;
    });
  </script>
</x-layout>
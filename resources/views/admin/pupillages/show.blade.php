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
    <h1 class="text-3xl font-bold mb-8 text-gray-900">Pupillage Application Details</h1>

    <!-- Personal Details Section -->
    <div class="bg-white p-6 rounded-lg shadow-sm mb-8">
      <h2 class="text-2xl font-bold mb-6 text-gray-800">Personal Details</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <p class="text-sm text-gray-600">Full Name</p>
          <p class="text-lg font-medium text-gray-900">{{ $pupillage->full_name }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Date of Birth</p>
          <p class="text-lg font-medium text-gray-900">{{ $pupillage->date_of_birth }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Identity Card Number</p>
          <p class="text-lg font-medium text-gray-900">{{ $pupillage->identity_card_number }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Gender</p>
          <p class="text-lg font-medium text-gray-900">{{ $pupillage->gender }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Nationality</p>
          <p class="text-lg font-medium text-gray-900">{{ $pupillage->nationality }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Ethnicity</p>
          <p class="text-lg font-medium text-gray-900">{{ $pupillage->ethnicity }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Home County</p>
          <p class="text-lg font-medium text-gray-900">{{ $pupillage->home_county }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Sub County</p>
          <p class="text-lg font-medium text-gray-900">{{ $pupillage->sub_county }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Disability Status</p>
          <p class="text-lg font-medium text-gray-900">{{ $pupillage->disability_status ? 'Yes' : 'No' }}</p>
        </div>
        @if($pupillage->disability_status)
          <div>
            <p class="text-sm text-gray-600">Nature of Disability</p>
            <p class="text-lg font-medium text-gray-900">{{ $pupillage->nature_of_disability }}</p>
          </div>
        @endif
      </div>
    </div>

    <!-- Contact Details Section -->
    <div class="bg-white p-6 rounded-lg shadow-sm mb-8">
      <h2 class="text-2xl font-bold mb-6 text-gray-800">Contact Details</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <p class="text-sm text-gray-600">Postal Address</p>
          <p class="text-lg font-medium text-gray-900">{{ $pupillage->postal_address }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Postal Code</p>
          <p class="text-lg font-medium text-gray-900">{{ $pupillage->postal_code }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Town</p>
          <p class="text-lg font-medium text-gray-900">{{ $pupillage->town }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Physical Address</p>
          <p class="text-lg font-medium text-gray-900">{{ $pupillage->physical_address }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Mobile Number</p>
          <p class="text-lg font-medium text-gray-900">{{ $pupillage->mobile_number }}</p>
        </div>
        @if($pupillage->alternate_mobile_number)
          <div>
            <p class="text-sm text-gray-600">Alternate Mobile Number</p>
            <p class="text-lg font-medium text-gray-900">{{ $pupillage->alternate_mobile_number }}</p>
          </div>
        @endif
        <div>
          <p class="text-sm text-gray-600">Email Address</p>
          <p class="text-lg font-medium text-gray-900">{{ $pupillage->email_address }}</p>
        </div>
      </div>
    </div>

    <!-- Academic Qualification Section -->
    <div class="bg-white p-6 rounded-lg shadow-sm mb-8">
      <h2 class="text-2xl font-bold mb-6 text-gray-800">Academic Qualification</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <p class="text-sm text-gray-600">KSCE Grade</p>
          <p class="text-lg font-medium text-gray-900">{{ $pupillage->ksce_grade }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Institution Name</p>
          <p class="text-lg font-medium text-gray-900">{{ $pupillage->institution_name }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Institution Grade</p>
          <p class="text-lg font-medium text-gray-900">{{ $pupillage->institution_grade }}</p>
        </div>
      </div>
    </div>

    <!-- Declaration Section -->
    <div class="bg-white p-6 rounded-lg shadow-sm mb-8">
      <h2 class="text-2xl font-bold mb-6 text-gray-800">Declaration</h2>
      <p class="text-lg font-medium text-gray-900">
        {{ $pupillage->declaration ? 'Applicant has declared that the information provided is true and correct.' : 'Declaration not provided.' }}
      </p>
    </div>

    <!-- Application Status Section -->
    <div class="bg-white p-6 rounded-lg shadow-sm mb-8">
      <h2 class="text-2xl font-bold mb-6 text-gray-800">Application Status</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <p class="text-sm text-gray-600">Status</p>
          <p class="text-lg font-medium text-gray-900">{{ $pupillage->status }}</p>
        </div>
        @if($pupillage->remarks)
          <div>
            <p class="text-sm text-gray-600">Remarks</p>
            <p class="text-lg font-medium text-gray-900">{{ $pupillage->remarks }}</p>
          </div>
        @endif
      </div>
    </div>

    <!-- View Department Button -->
    @if($pupillage->department)
      <div class="bg-white p-6 rounded-lg shadow-sm mb-8">
        <a href="{{ route('admin.departments.show', $pupillage->department->id) }}" class="inline-flex items-center px-4 py-2 bg-[#D68C3C] text-white rounded-md hover:bg-[#bf7a2e] transition-colors shadow-sm">
          <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
          </svg>
          View Department
        </a>
      </div>
    @endif

    <!-- Form to Update Application -->
    <div class="bg-white p-6 rounded-lg shadow-sm">
      <form action="{{ route('admin.admin.pupillages.update', $pupillage->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Use PUT instead of PATCH -->
        <div class="mb-4">
          <label for="status" class="block text-sm font-medium text-gray-700">Application Status</label>
          <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]">
            <option value="Pending" @if($pupillage->status == 'Pending') selected @endif>Pending</option>
            <option value="Accepted" @if($pupillage->status == 'Accepted') selected @endif>Accepted</option>
            <option value="Not_Successful" @if($pupillage->status == 'Not_Successful') selected @endif>Not Successful</option>
            <option value="Removed" @if($pupillage->status == 'Removed') selected @endif>Removed</option>
          </select>
        </div>
        <div class="flex justify-end">
          <button type="submit" class="inline-flex items-center px-4 py-2 bg-[#D68C3C] text-white rounded-md hover:bg-[#bf7a2e] transition-colors shadow-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            Update Application
          </button>
        </div>
      </form>
    </div>
  </x-card>
</x-layout>
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
    <h1 class="text-3xl font-bold mb-8 text-gray-900">Post Pupillage Application Details</h1>

    <!-- Personal Details Section -->
    <div class="bg-white p-6 rounded-lg shadow-sm mb-8">
      <h2 class="text-2xl font-bold mb-6 text-gray-800">Personal Details</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <p class="text-sm text-gray-600">Vacancy No</p>
          <p class="text-lg font-medium text-gray-900">{{ $postpupillage->vacancy_no }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Full Name</p>
          <p class="text-lg font-medium text-gray-900">{{ $postpupillage->full_name }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Date of Birth</p>
          <p class="text-lg font-medium text-gray-900">{{ $postpupillage->date_of_birth }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Identity Card Number</p>
          <p class="text-lg font-medium text-gray-900">{{ $postpupillage->identity_card_number }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Gender</p>
          <p class="text-lg font-medium text-gray-900">{{ $postpupillage->gender }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">KRA PIN</p>
          <p class="text-lg font-medium text-gray-900">{{ $postpupillage->kra_pin }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">NHIF/SHIF Card No</p>
          <p class="text-lg font-medium text-gray-900">{{ $postpupillage->nhif_card_number }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Home County</p>
          <p class="text-lg font-medium text-gray-900">{{ $postpupillage->home_county }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Sub County</p>
          <p class="text-lg font-medium text-gray-900">{{ $postpupillage->sub_county }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Ethnicity</p>
          <p class="text-lg font-medium text-gray-900">{{ $postpupillage->ethnicity }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Disability Status</p>
          <p class="text-lg font-medium text-gray-900">{{ $postpupillage->disability_status ? 'Yes' : 'No' }}</p>
        </div>
        @if($postpupillage->disability_status)
          <div>
            <p class="text-sm text-gray-600">Nature of Disability</p>
            <p class="text-lg font-medium text-gray-900">{{ $postpupillage->nature_of_disability }}</p>
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
          <p class="text-lg font-medium text-gray-900">{{ $postpupillage->postal_address }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Postal Code</p>
          <p class="text-lg font-medium text-gray-900">{{ $postpupillage->postal_code }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Town</p>
          <p class="text-lg font-medium text-gray-900">{{ $postpupillage->town }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Email Address</p>
          <p class="text-lg font-medium text-gray-900">{{ $postpupillage->email_address }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Mobile Number</p>
          <p class="text-lg font-medium text-gray-900">{{ $postpupillage->mobile_number }}</p>
        </div>
      </div>
    </div>

    <!-- Deployment Region Section -->
    <div class="bg-white p-6 rounded-lg shadow-sm mb-8">
      <h2 class="text-2xl font-bold mb-6 text-gray-800">Deployment Region</h2>
      <p class="text-lg font-medium text-gray-900">{{ $postpupillage->deployment_region }}</p>
    </div>

    <!-- Declaration Section -->
    <div class="bg-white p-6 rounded-lg shadow-sm mb-8">
      <h2 class="text-2xl font-bold mb-6 text-gray-800">Declaration</h2>
      <p class="text-lg font-medium text-gray-900">
        {{ $postpupillage->declaration ? 'Applicant has declared that the information provided is true and correct.' : 'Declaration not provided.' }}
      </p>
    </div>

    <!-- Application Status Section -->
    <div class="bg-white p-6 rounded-lg shadow-sm mb-8">
      <h2 class="text-2xl font-bold mb-6 text-gray-800">Application Status</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <p class="text-sm text-gray-600">Status</p>
          <p class="text-lg font-medium text-gray-900">{{ $postpupillage->status }}</p>
        </div>
        
      </div>
    </div>

    <!-- Form to Update Application (For Admin) -->
@if(Auth::check() && in_array(Auth::user()->role, ['admin', 'superadmin']))
      <div class="bg-white p-6 rounded-lg shadow-sm">
        @if ($errors->any())
          <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-md mb-6">
            <strong class="font-bold">Whoops!</strong> There were some problems with your input.<br><br>
            <ul class="mt-3 list-disc list-inside text-sm">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form action="{{ route('admin.admin.postPupillages.update', $postpupillage->id) }}" method="POST">
          @csrf
          @method('PATCH')
          <div class="mb-4">
            <label for="status" class="block text-sm font-medium text-gray-700">Application Status</label>
            <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]">
              <option value="Pending" @if($postpupillage->status == 'Pending') selected @endif>Pending</option>
              <option value="Accepted" @if($postpupillage->status == 'Accepted') selected @endif>Accepted</option>
              <option value="Not_Successful" @if($postpupillage->status == 'Not_Successful') selected @endif>Not Successful</option>
              <option value="Removed" @if($postpupillage->status == 'Removed') selected @endif>Removed</option>
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
    @endif
  </x-card>
</x-layout>
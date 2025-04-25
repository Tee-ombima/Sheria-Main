<x-layout>
  <x-card class="p-8 mx-auto mt-12 max-w-7xl">    <!-- Status Header -->
    <div class="text-center mb-8">
      <h1 class="text-3xl font-bold text-gray-900 mb-2">
        Personal Information
        <span class="ml-2 px-4 py-1 rounded-full {{ $personalInfoSubmitted ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
          {{ $personalInfoSubmitted ? '✓ Submitted' : '✗ Not Submitted' }}
        </span>
      </h1>
      <p class="text-gray-600 mt-2">All fields marked with <span class="text-red-500">*</span> are required</p>
    </div>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
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

    <form id="personal-info" action="{{ route('profile.save-personal-info') }}" method="POST" class="space-y-6">
      @csrf
      
      <!-- Name Section -->
      <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- Surname -->
        <div>
          <label for="surname" class="block text-sm font-medium text-gray-700">Surname <span class="text-red-500">*</span></label>
          <input type="text" name="surname" id="surname" maxlength="100" required
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                 value="{{ old('surname', $inputData['surname'] ?? '') }}">
        </div>

        <!-- First Name -->
        <div>
          <label for="firstname" class="block text-sm font-medium text-gray-700">First Name <span class="text-red-500">*</span></label>
          <input type="text" name="firstname" id="firstname" maxlength="100" required
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                 value="{{ old('firstname', $inputData['firstname'] ?? '') }}">
        </div>

        <!-- Other Names -->
        <div>
          <label for="lastname" class="block text-sm font-medium text-gray-700">Other Names</label>
          <input type="text" name="lastname" id="lastname" maxlength="100"
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                 value="{{ old('lastname', $inputData['lastname'] ?? '') }}">
        </div>

        <!-- Salutation -->
        <div>
          <label for="salutation" class="block text-sm font-medium text-gray-700">Salutation <span class="text-red-500">*</span></label>
          <select name="salutation" id="salutation" required
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                  data-other-target="#salutation_other_div">
            <option value="">Select Salutation</option>
            @foreach($salutations as $salutationOption)
            <option value="{{ $salutationOption->name }}" {{ old('salutation', $inputData['salutation'] ?? '') == $salutationOption->name ? 'selected' : '' }}>
              {{ $salutationOption->name }}
            </option>
            @endforeach
            <option value="other" {{ old('salutation') === 'other' ? 'selected' : '' }}>Other</option>
          </select>
        </div>

        <!-- Salutation Other -->
        <div id="salutation_other_div" class="{{ old('salutation') === 'other' ? '' : 'hidden' }} col-span-full">
          <label for="salutation_other" class="block text-sm font-medium text-gray-700">Specify Salutation <span class="text-red-500">*</span></label>
          <input type="text" name="salutation_other" id="salutation_other"
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                 value="{{ old('salutation_other', $inputData['salutation_other'] ?? '') }}">
        </div>
      </div>

      <!-- Personal Details Section -->
      <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- Date of Birth -->
        <div>
          <label for="dob" class="block text-sm font-medium text-gray-700">Date of Birth <span class="text-red-500">*</span></label>
          <input type="date" name="dob" id="dob" required
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                 value="{{ old('dob', $inputData['dob'] ?? '') }}">
        </div>

        <!-- ID Number -->
        <div>
          <label for="idno" class="block text-sm font-medium text-gray-700">ID Number <span class="text-red-500">*</span></label>
          <input type="text" name="idno" id="idno" maxlength="8" required
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                 value="{{ old('idno', $inputData['idno'] ?? '') }}">
        </div>

        <!-- KRA PIN -->
        <div>
          <label for="kra_pin" class="block text-sm font-medium text-gray-700">KRA PIN <span class="text-red-500">*</span></label>
          <input type="text" name="kra_pin" id="kra_pin" maxlength="11" required
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                 value="{{ old('kra_pin', $inputData['kra_pin'] ?? '') }}">
        </div>

        <!-- Gender -->
        <div>
          <label for="gender" class="block text-sm font-medium text-gray-700">Gender <span class="text-red-500">*</span></label>
          <select name="gender" id="gender" required
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]">
            <option value="male" {{ old('gender', $inputData['gender'] ?? '') == 'male' ? 'selected' : '' }}>Male</option>
            <option value="female" {{ old('gender', $inputData['gender'] ?? '') == 'female' ? 'selected' : '' }}>Female</option>
          </select>
        </div>
      </div>

      <!-- Nationality & Ethnicity Section -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Nationality -->
        <div>
          <label for="nationality" class="block text-sm font-medium text-gray-700">Nationality <span class="text-red-500">*</span></label>
          <input type="text" name="nationality" id="nationality" maxlength="50" required
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                 value="{{ old('nationality', $inputData['nationality'] ?? '') }}">
        </div>

        <!-- Ethnicity -->
        <div>
          <label for="ethnicity" class="block text-sm font-medium text-gray-700">Ethnicity <span class="text-red-500">*</span></label>
          <select name="ethnicity" id="ethnicity" required
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                  data-other-target="#ethnicity_other_div">
            <option value="">Select Ethnicity</option>
            @foreach($ethnicities as $ethnicity)
            <option value="{{ $ethnicity->name }}" {{ old('ethnicity', $inputData['ethnicity'] ?? '') == $ethnicity->name ? 'selected' : '' }}>
              {{ $ethnicity->name }}
            </option>
            @endforeach
            <option value="other" {{ old('ethnicity') === 'other' ? 'selected' : '' }}>Other</option>
          </select>
        </div>

        <!-- Ethnicity Other -->
        <div id="ethnicity_other_div" class="{{ old('ethnicity') === 'other' ? '' : 'hidden' }}">
          <label for="ethnicity_other" class="block text-sm font-medium text-gray-700">Specify Ethnicity <span class="text-red-500">*</span></label>
          <input type="text" name="ethnicity_other" id="ethnicity_other"
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                 value="{{ old('ethnicity_other', $inputData['ethnicity_other'] ?? '') }}">
        </div>
      </div>
<!-- Location Information -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Home County Field -->
    <div class="flex-1">
        <label for="homecounty" class="block text-sm font-medium text-gray-700">
            Home County<span class="text-red-500">*</span>
        </label>
        <select name="homecounty_id" id="homecounty" required 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]">
            <option value="" disabled selected>Select Home County</option>
            @foreach($homecounties as $homecounty)
                <option value="{{ $homecounty->id }}" {{ old('homecounty_id', $inputData['homecounty_id'] ?? '') == $homecounty->id ? 'selected' : '' }}>
                    {{ $homecounty->name }}
                </option>
            @endforeach
        </select>
        @error('homecounty_id')
            <span class="text-red-500 text-xs">{{ $message }}</span>
        @enderror
    </div>

    <!-- Subcounty Field -->
    <div class="flex-1">
        <label for="subcounty" class="block text-sm font-medium text-gray-700">
            Subcounty<span class="text-red-500">*</span>
        </label>
        <select name="subcounty_id" id="subcounty" required 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]">
            <option value="" disabled selected>Select Subcounty</option>
            @if(isset($subcounties))
                @foreach($subcounties as $subcounty)
                    <option value="{{ $subcounty->id }}" {{ old('subcounty_id', $inputData['subcounty_id'] ?? '') == $subcounty->id ? 'selected' : '' }}>
                        {{ $subcounty->name }}
                    </option>
                @endforeach
            @endif
        </select>
        @error('subcounty_id')
            <span class="text-red-500 text-xs">{{ $message }}</span>
        @enderror
    </div>

    <!-- Constituency Field -->
    <div class="flex-1">
        <label for="constituency" class="block text-sm font-medium text-gray-700">
            Constituency<span class="text-red-500">*</span>
        </label>
        <select name="constituency_id" id="constituency" required 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]">
            <option value="" disabled selected>Select Constituency</option>
            @if(isset($constituencies))
                @foreach($constituencies as $constituency)
                    <option value="{{ $constituency->id }}" {{ old('constituency_id', $inputData['constituency_id'] ?? '') == $constituency->id ? 'selected' : '' }}>
                        {{ $constituency->name }}
                    </option>
                @endforeach
            @endif
        </select>
        @error('constituency_id')
            <span class="text-red-500 text-xs">{{ $message }}</span>
        @enderror
    </div>
</div>
      <!-- Contact Information -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Postal Address -->
        <div>
          <label for="postal_address" class="block text-sm font-medium text-gray-700">Postal Address <span class="text-red-500">*</span></label>
          <input type="text" name="postal_address" id="postal_address" maxlength="50" required
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                 value="{{ old('postal_address', $inputData['postal_address'] ?? '') }}">
        </div>

        <!-- Postal Code -->
        <div>
          <label for="code" class="block text-sm font-medium text-gray-700">Postal Code <span class="text-red-500">*</span></label>
          <input type="text" name="code" id="code" maxlength="50" required pattern="\d*"
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                 value="{{ old('code', $inputData['code'] ?? '') }}">
        </div>

        <!-- Town/City -->
        <div>
          <label for="town_city" class="block text-sm font-medium text-gray-700">Town/City <span class="text-red-500">*</span></label>
          <input type="text" name="town_city" id="town_city" maxlength="50" required
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                 value="{{ old('town_city', $inputData['town_city'] ?? '') }}">
        </div>
      </div>

      <!-- Phone Numbers -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Telephone -->
        <div>
          <label class="block text-sm font-medium text-gray-700">Telephone Number</label>
          <div class="flex gap-2">
            <select name="telephone_country_code" class="w-1/3 rounded-md border-gray-300 shadow-sm">
              @foreach($countryCodes as $code)
              <option value="{{ $code->code }}" {{ old('telephone_country_code', $inputData['telephone_country_code'] ?? '') == $code->code ? 'selected' : '' }}>
                {{ $code->code }}
              </option>
              @endforeach
            </select>
            <input type="tel" name="telephone_num" placeholder="XXXXXXXXX" pattern="[0-9]{9}" maxlength="9"
                   class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                   value="{{ old('telephone_num', $inputData['telephone_num'] ?? '') }}">
          </div>
        </div>

        <!-- Mobile -->
        <div>
          <label class="block text-sm font-medium text-gray-700">Mobile Number</label>
          <div class="flex gap-2">
            <select name="mobile_country_code" class="w-1/3 rounded-md border-gray-300 shadow-sm">
              @foreach($countryCodes as $code)
              <option value="{{ $code->code }}" {{ old('mobile_country_code', $inputData['mobile_country_code'] ?? '') == $code->code ? 'selected' : '' }}>
                {{ $code->code }}
              </option>
              @endforeach
            </select>
            <input type="tel" name="mobile_num" placeholder="XXXXXXXXX" pattern="[0-9]{9}" maxlength="9"
                   class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                   value="{{ old('mobile_num', $inputData['mobile_num'] ?? '') }}">
          </div>
        </div>
      </div>

      <!-- Email -->
      <div class="grid grid-cols-1 gap-6">
        <div>
          <label for="email_address" class="block text-sm font-medium text-gray-700">Email Address <span class="text-red-500">*</span></label>
          <input type="email" name="email_address" id="email_address" maxlength="100" required
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                 value="{{ old('email_address', $inputData['email_address'] ?? '') }}">
        </div>
      </div>

      <!-- Alternative Contact -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label for="alt_contact_person" class="block text-sm font-medium text-gray-700">Alternative Contact Person <span class="text-red-500">*</span></label>
          <input type="text" name="alt_contact_person" id="alt_contact_person" maxlength="100" required
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                 value="{{ old('alt_contact_person', $inputData['alt_contact_person'] ?? '') }}">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Contact's Number <span class="text-red-500">*</span></label>
          <div class="flex gap-2">
            <select name="alt_contact_country_code" class="w-1/3 rounded-md border-gray-300 shadow-sm">
              @foreach($countryCodes as $code)
              <option value="{{ $code->code }}" {{ old('alt_contact_country_code', $inputData['alt_contact_country_code'] ?? '') == $code->code ? 'selected' : '' }}>
                {{ $code->code }}
              </option>
              @endforeach
            </select>
            <input type="tel" name="alt_contact_telephone_num" placeholder="XXXXXXXXX" pattern="[0-9]{9}" maxlength="9" required
                   class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                   value="{{ old('alt_contact_telephone_num', $inputData['alt_contact_telephone_num'] ?? '') }}">
          </div>
        </div>
      </div>

      <!-- Disability Section -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label for="disability_question" class="block text-sm font-medium text-gray-700">Living with Disability? <span class="text-red-500">*</span></label>
          <select name="disability_question" id="disability_question" required
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]">
            <option value="">Select...</option>
            <option value="yes" {{ old('disability_question', $inputData['disability_question'] ?? '') == 'yes' ? 'selected' : '' }}>Yes</option>
            <option value="no" {{ old('disability_question', $inputData['disability_question'] ?? '') == 'no' ? 'selected' : '' }}>No</option>
          </select>
        </div>
        
        <!-- Disability Details -->
        <div id="nature_of_disability_container" class="{{ old('disability_question') == 'yes' ? '' : 'hidden' }}">
          <label for="nature_of_disability" class="block text-sm font-medium text-gray-700">Nature of Disability</label>
          <input type="text" name="nature_of_disability" id="nature_of_disability" maxlength="100"
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                 value="{{ old('nature_of_disability', $inputData['nature_of_disability'] ?? '') }}">
        </div>

        <div id="ncpd_registration_no_container" class="{{ old('disability_question') == 'yes' ? '' : 'hidden' }}">
          <label for="ncpd_registration_no" class="block text-sm font-medium text-gray-700">NCPD Registration</label>
          <input type="text" name="ncpd_registration_no" id="ncpd_registration_no" maxlength="100"
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                 value="{{ old('ncpd_registration_no', $inputData['ncpd_registration_no'] ?? '') }}">
        </div>
      </div>

      <!-- Service Section -->
      <div class="space-y-6">
        <h3 class="text-xl font-semibold text-gray-900">For Government Employees</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label for="ministry" class="block text-sm font-medium text-gray-700">Ministry/Department</label>
            <input type="text" name="ministry" id="ministry" maxlength="100"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                   value="{{ old('ministry', $inputData['ministry'] ?? 'N/A') }}">
          </div>
          <div>
            <label for="station" class="block text-sm font-medium text-gray-700">Station</label>
            <input type="text" name="station" id="station" maxlength="100"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                   value="{{ old('station', $inputData['station'] ?? 'N/A') }}">
          </div>
          <div>
            <label for="personal_employment_number" class="block text-sm font-medium text-gray-700">Employment Number</label>
            <input type="text" name="personal_employment_number" id="personal_employment_number" maxlength="100"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                   value="{{ old('personal_employment_number', $inputData['personal_employment_number'] ?? 'N/A') }}">
          </div>
          <div>
            <label for="present_substantive_post" class="block text-sm font-medium text-gray-700">Current Post</label>
            <input type="text" name="present_substantive_post" id="present_substantive_post" maxlength="100"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                   value="{{ old('present_substantive_post', $inputData['present_substantive_post'] ?? 'N/A') }}">
          </div>
          <div>
            <label for="job_grp_scale_grade" class="block text-sm font-medium text-gray-700">Job Group</label>
            <input type="text" name="job_grp_scale_grade" id="job_grp_scale_grade" maxlength="100"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                   value="{{ old('job_grp_scale_grade', $inputData['job_grp_scale_grade'] ?? 'N/A') }}">
          </div>
          <div>
            <label for="date_of_current_appointment" class="block text-sm font-medium text-gray-700">Appointment Date</label>
            <input type="date" name="date_of_current_appointment" id="date_of_current_appointment"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                   value="{{ old('date_of_current_appointment', $inputData['date_of_current_appointment'] ?? '') }}">
          </div>
        </div>
      </div>

      <!-- Form Actions -->
      <div class="flex justify-center space-x-4 mt-8">
        
        <button type="submit" class="px-6 py-2 bg-[#D68C3C] text-white rounded-md hover:bg-[#bf7a2e] flex items-center">
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
          </svg>
          Save Information
        </button>
      </div>
    </form>
  </x-card>

 <script>
document.addEventListener('DOMContentLoaded', function() {
    // Dynamic Other Fields
    document.querySelectorAll('select[data-other-target]').forEach(select => {
        const otherDiv = document.querySelector(select.dataset.otherTarget);
        const toggleVisibility = () => {
            otherDiv.classList.toggle('hidden', select.value !== 'other');
            if (select.value !== 'other') {
                otherDiv.querySelector('input').value = '';
            }
        };
        select.addEventListener('change', toggleVisibility);
        toggleVisibility(); // Initial check
    });

    // Disability Toggle
    const disabilityQuestion = document.getElementById('disability_question');
    const toggleDisabilityFields = () => {
        const visible = disabilityQuestion.value === 'yes';
        document.getElementById('nature_of_disability_container').classList.toggle('hidden', !visible);
        document.getElementById('ncpd_registration_no_container').classList.toggle('hidden', !visible);
    };
    disabilityQuestion.addEventListener('change', toggleDisabilityFields);
    toggleDisabilityFields(); // Initial state

    // Phone Number Formatting
    document.querySelectorAll('input[type="tel"]').forEach(input => {
        input.addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '').slice(0, 9);
        });
    });

    // Loading State
    document.querySelector('form').addEventListener('submit', (e) => {
        const submitBtn = document.querySelector('button[type="submit"]');
        submitBtn.innerHTML = `
            <svg class="animate-spin h-5 w-5 mr-2" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"/>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
            </svg>
            Saving...`;
    });

    // Location Selector Logic
    function handleCountyChange() {
        const homecounty = document.getElementById('homecounty');
        const subcounty = document.getElementById('subcounty');
        const constituency = document.getElementById('constituency');
        
        homecounty.addEventListener('change', function() {
            const countyId = this.value;
            subcounty.value = '';
            constituency.value = '';

            if (countyId) {
                fetch(`/getSubcounties/${countyId}`)
                    .then(response => response.json())
                    .then(data => {
                        subcounty.innerHTML = '<option value="" disabled selected>Select Subcounty</option>';
                        data.forEach(item => {
                            subcounty.innerHTML += `<option value="${item.id}">${item.name}</option>`;
                        });
                        constituency.innerHTML = '';
                    });
            } else {
                subcounty.innerHTML = '';
                constituency.innerHTML = '';
            }
        });

        subcounty.addEventListener('change', function() {
            const subcountyId = this.value;
            constituency.value = '';

            if (subcountyId) {
                fetch(`/getConstituencies/${subcountyId}`)
                    .then(response => response.json())
                    .then(data => {
                        constituency.innerHTML = '<option value="" disabled selected>Select Constituency</option>';
                        data.forEach(item => {
                            constituency.innerHTML += `<option value="${item.id}">${item.name}</option>`;
                        });
                    });
            } else {
                constituency.innerHTML = '';
            }
        });
    }

    // Other Field Toggles
    function setupOtherToggles() {
        function toggleOtherField(selectId, otherDivId) {
            const select = document.getElementById(selectId);
            const otherDiv = document.getElementById(otherDivId);
            
            if (select.value === 'other') {
                otherDiv.style.display = 'block';
            } else {
                otherDiv.style.display = 'none';
            }
        }

        document.getElementById('ethnicity').addEventListener('change', () => {
            toggleOtherField('ethnicity', 'ethnicity_other_div');
        });

        document.getElementById('salutation').addEventListener('change', () => {
            toggleOtherField('salutation', 'salutation_other_div');
        });

        // Initial state
        toggleOtherField('ethnicity', 'ethnicity_other_div');
        toggleOtherField('salutation', 'salutation_other_div');
    }

    // Dropdown Menu
    function setupDropdown() {
        const dropdownMenu = document.getElementById('dropdownMenu');
        const menuButton = document.getElementById('menu-button');

        function toggleDropdown() {
            dropdownMenu.classList.toggle('hidden');
        }

        menuButton.addEventListener('click', toggleDropdown);

        document.addEventListener('click', function(event) {
            if (!dropdownMenu.contains(event.target) && !menuButton.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    }

    // Initialize all components
    handleCountyChange();
    setupOtherToggles();
    setupDropdown();
});
</script>
</x-layout>
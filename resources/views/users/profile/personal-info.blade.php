<x-layout>

  <x-card class="p-10 mx-auto mt-24">


<body class="mb-48">

<div class="text-center my-4">
    <h1 class="text-3xl font-bold">Personal Info
    <span class="{{ $personalInfoSubmitted ? 'submitted' : 'not-submitted' }}">
            {{ $personalInfoSubmitted ? 'Submitted' : 'Not Submitted' }}
        </span>
    </h1>
</div>
@if ($errors->any())
                <div class="alert alert-danger text-red-500">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
    <form id="personal-info" action="{{ route('profile.save-personal-info') }}" method="POST" >
      @csrf
      <!-- Row 1: SurName, FirstName, OtherName, Salutation/Title -->
          <!-- Row 1: SurName, FirstName, OtherName, Salutation/Title -->
<div class="flex space-x-4">
    <!-- Surname Field -->
<div class="flex-1">
    <label for="surname" class="block text-sm font-medium text-gray-700">
        Surname <span class="text-red-500">*</span></label>
    <input 
        type="text" 
        name="surname" 
        id="surname" 
        maxlength="100" 
        required 
        class="mt-1 block w-full py-2 px-4 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
        value="{{ old('surname', $inputData['surname'] ?? '') }}">
</div>



    <!-- FirstName Field -->
    <div class="flex-1">
    <label for="firstname" class="block text-sm font-medium text-gray-700">Firstname<span class="text-red-500">*</span></label>
    <input 
        type="text" 
        name="firstname" 
        id="firstname" 
        maxlength="100" 
        required
        class="mt-1 block w-full py-2 px-4 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
        value="{{ old('firstname', $inputData['firstname'] ?? '') }}">

    @error('firstname')
        <span class="text-red-500 text-xs">{{ $message }}</span>
    @enderror

</div>

    <!-- LastName Field -->
    <div class="flex-1">
    <label for="lastname" class="block text-sm font-medium text-gray-700">Othernames</label>
    <input 
        type="text" 
        name="lastname" 
        id="lastname" 
        maxlength="100" 
        class="mt-1 block w-full py-2 px-4 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
        value="{{ old('lastname', $inputData['lastname'] ?? '') }}">



</div>

    <!-- Salutation/Title Field -->
    <div class="flex-1">
    <label for="salutation" class="block text-sm font-medium text-gray-700">Salutation/Title<span class="text-red-500">*</span></label>
    <select 
        name="salutation" 
        id="salutation" 
        required 
        class="mt-1 block w-full py-2 px-4 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        <option value=""disabled selected>Select Salutation</option>
        @foreach($salutations as $salutation)
            <option value="{{ $salutation->name }}" {{ (old('salutation', $inputData['salutation'] ?? '') == $salutation->name) ? 'selected' : '' }}>{{ $salutation->name }}</option>

        @endforeach
    </select>

    @error('salutation')
        <span class="text-red-500 text-xs">{{ $message }}</span>
    @enderror
</div>

</div>




      <!-- Row 2: Date of Birth, IDNo, Krapin, Gender -->
      <div class="flex space-x-4">
    <div class="flex-1">
    <label for="dob" class="block text-sm font-medium text-gray-700">Date of Birth<span class="text-red-500">*</span></label>

    
    <input 
        type="date" 
        name="dob" 
        id="dob" 
        class="mt-1 block w-full py-2 px-4 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
        value="{{ old('dob', $inputData['dob'] ?? '') }}">
    
    <!-- Display error message if any -->
    @error('dob')
        <span class="text-red-500 text-xs">{{ $message }}</span>
    @enderror
</div>


    <!-- ID Number Field -->
    <div class="flex-1">
    <label for="idno" class="block text-sm font-medium text-gray-700">ID Number<span class="text-red-500">*</span></label>
    <input 
        type="number" 
        name="idno" 
        id="idno" 
        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
        maxlength="8"  {{-- setting the maximum number of digits to 8 --}}
        value="{{ old('idno', $inputData['idno'] ?? '') }}"
    >
    
    <!-- Display error message if any -->
    @error('idno')
        <span class="text-red-500 text-xs">{{ $message }}</span>
    @enderror
</div>


    <!-- KRA PIN Field -->
    <div class="flex-1">
    <label for="kra_pin" class="block text-sm font-medium text-gray-700">KRA PIN<span class="text-red-500">*</span></label>
    <input 
        type="text" 
        name="kra_pin" 
        id="kra_pin" 
        maxlength="11"  {{-- setting the maximum length to 11 characters --}}
        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
        value="{{ old('kra_pin', $inputData['kra_pin'] ?? '') }}"
    >
    
    
    <!-- Display error message if any -->
    @error('kra_pin')
        <span class="text-red-500 text-xs">{{ $message }}</span>
    @enderror
</div>


    <!-- Gender Field -->
    <div class="flex-1">
    <label for="gender" class="block text-sm font-medium text-gray-700">Gender<span class="text-red-500">*</span></label>
    <select name="gender" id="gender" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        <option value="male" {{ old('gender', $inputData['gender'] ?? '') == 'male' ? 'selected' : '' }}>Male</option>
        <option value="female" {{ old('gender', $inputData['gender'] ?? '') == 'female' ? 'selected' : '' }}>Female</option>
    </select>
    
    <!-- Display error message if any -->
    @error('gender')
        <span class="text-red-500 text-xs">{{ $message }}</span>
    @enderror
</div>

  </div>

   <div class="flex space-x-4">
    <div class="flex-1">
    <label for="nationality" class="block text-sm font-medium text-gray-700">Nationality<span class="text-red-500">*</span></label>
    <input 
        type="text" 
        name="nationality" 
        id="nationality" 
        maxlength="50"  {{-- setting the maximum length to 100 characters --}}
        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
        value="{{ old('nationality', $inputData['nationality'] ?? '') }}"
    >
    
    <!-- Display error message if any -->
    @error('nationality')
        <span class="text-red-500 text-xs">{{ $message }}</span>
    @enderror
</div>


    <!-- Ethnicity Field -->
    <div class="flex-1">
    <label for="ethnicity" class="block text-sm font-medium text-gray-700">Ethnicity<span class="text-red-500">*</span></label>
    <select 
        name="ethnicity" 
        id="ethnicity" 
        required 
        class="mt-1 block w-full py-2 px-4 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        <option value="" disabled selected>Select Ethnicity</option>
        @foreach($ethnicities as $ethnicity)
            <option value="{{ $ethnicity->name }}" {{ (old('ethnicity', $inputData['ethnicity'] ?? '') == $ethnicity->name) ? 'selected' : '' }}>{{ $ethnicity->name }}</option>

        @endforeach
    </select>

    @error('ethnicity')
        <span class="text-red-500 text-xs">{{ $message }}</span>
    @enderror
</div>


    <!-- Home County Field -->
    <div class="flex-1">
            <label for="homecounty" class="block text-sm font-medium text-gray-700">Home County<span class="text-red-500">*</span></label>
            <select 
                name="homecounty" 
                id="homecounty" 
                required 
                class="mt-1 block w-full py-2 px-4 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="" disabled selected>Select Home County</option>
                @foreach($homecounties as $homecounty)
                    <option value="{{ $homecounty->name }}" {{ (old('homecounty', $inputData['homecounty'] ?? '') == $homecounty->name) ? 'selected' : '' }}>{{ $homecounty->name }}</option>

                @endforeach
            </select>

            @error('homecounty')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>


  </div>

     <div class="flex space-x-4">
     <!-- Subcounty Dropdown -->
    <div class="flex-1">
            <label for="subcounty" class="block text-sm font-medium text-gray-700">Subcounty</label>
            <select 
                name="subcounty" 
                id="subcounty" 
                
                class="mt-1 block w-full py-2 px-4 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="" disabled>Select Subcounty</option>
                @if (!empty($inputData['homecounty']))
                    @foreach (\App\Models\SubCounty::where('homecounty_id', $inputData['homecounty'])->get() as $subcounty)
                        <option value="{{ $subcounty->name }}" {{ (old('subcounty', $inputData['subcounty'] ?? '') == $subcounty->name) ? 'selected' : '' }}>{{ $subcounty->name }}</option>
                    @endforeach
                @endif
                

            </select>

            @error('subcounty')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

    <!-- Constituency Field -->
    <div class="flex-1">
            <label for="constituency" class="block text-sm font-medium text-gray-700">Constituency<span class="text-red-500">*</span></label>
            <select 
                name="constituency" 
                id="constituency" 
                required 
                class="mt-1 block w-full py-2 px-4 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="" disabled>Select Constituency</option>
                @if (!empty($inputData['homecounty']))
                    @foreach (\App\Models\Constituency::where('homecounty_id', $inputData['homecounty'])->get() as $constituency)
                        <option value="{{ $constituency->name }}" {{ (old('constituency', $inputData['constituency'] ?? '') == $constituency->name) ? 'selected' : '' }}>{{ $constituency->name }}</option>
                    @endforeach
                @endif


            </select>

            @error('constituency')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>
       </div>

  <div class="flex space-x-4">
   <div class="flex-1">
                <label for="postal_address" class="block text-sm font-medium text-gray-700">Postal Address<span class="text-red-500">*</span></label>
                <input 
                    type="text" 
                    name="postal_address" 
                    id="postal_address" 
                    maxlength="50" 
                    required 
                    value="{{ old('postal_address', $inputData['postal_address'] ?? '') }}"
                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <div class="invalid-feedback" style="display: none;">invalid.</div>
                @error('postal_address')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Code Field -->
            <div class="flex-1">
                <label for="code" class="block text-sm font-medium text-gray-700">Code</label>
                <input 
                    type="text" 
                    name="code" 
                    id="code" 
                    maxlength="50" 
                    required 
                    pattern="\d*" 
                    value="{{ old('code', $inputData['code'] ?? '') }}"
                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <div class="invalid-feedback" style="display: none;">invalid.</div>
                @error('code')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Town/City Field -->
            <div class="flex-1">
                <label for="town_city" class="block text-sm font-medium text-gray-700">Town/City<span class="text-red-500">*</span></label>
                <input 
                    type="text" 
                    name="town_city" 
                    id="town_city" 
                    maxlength="50" 
                    required 
                    value="{{ old('town_city', $inputData['town_city'] ?? '') }}"
                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <div class="invalid-feedback" style="display: none;">invalid.</div>
                @error('town_city')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
       </div>

         <div class="flex space-x-4">
    <!-- Telephone Number Field -->
    <div class="flex-1">
        <label for="telephone_num" class="block text-sm font-medium text-gray-700">Telephone Number</label>
        <div class="flex">
            <!-- Country Code Select -->
            <select name="telephone_country_code" id="telephone_country_code" class="mt-1 block py-2 px-3 border border-gray-300 bg-white rounded-l-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @foreach($countryCodes as $code)
                    <option value="{{ $code->code }}" {{ old('telephone_country_code', $inputData['telephone_country_code'] ?? '') == $code->code ? 'selected' : '' }}>
                        {{ $code->code }} ({{ $code->name }})
                    </option>
                @endforeach
            </select>

            <!-- Telephone Number Input -->
            <input 
                type="tel" 
                name="telephone_num" 
                id="telephone_num" 
                placeholder="XXXXXXXXX" 
                pattern="[0-9]{9}" 
                maxlength="9" 
                required 
                value="{{ old('telephone_num', $inputData['telephone_num'] ?? '') }}"
                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-r-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        @error('telephone_num')
            <span class="text-red-500 text-xs">{{ $message }}</span>
        @enderror
    </div>

    <!-- Mobile Number Field -->
    <div class="flex-1">
        <label for="mobile_num" class="block text-sm font-medium text-gray-700">Mobile Number</label>
        <div class="flex">
            <!-- Country Code Select -->
            <select name="mobile_country_code" id="mobile_country_code" class="mt-1 block py-2 px-3 border border-gray-300 bg-white rounded-l-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @foreach($countryCodes as $code)
                    <option value="{{ $code->code }}" {{ old('mobile_country_code', $inputData['mobile_country_code'] ?? '') == $code->code ? 'selected' : '' }}>
                        {{ $code->code }} ({{ $code->name }})
                    </option>
                @endforeach
            </select>

            <!-- Mobile Number Input -->
            <input 
                type="tel" 
                name="mobile_num" 
                id="mobile_num" 
                placeholder="XXXXXXXXX" 
                pattern="[0-9]{9}" 
                maxlength="9" 
                required 
                value="{{ old('mobile_num', $inputData['mobile_num'] ?? '') }}"
                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-r-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        @error('mobile_num')
            <span class="text-red-500 text-xs">{{ $message }}</span>
        @enderror
    </div>
</div>

            <!-- Email Address Field -->
            <div class="flex-1">
                <label for="email_address" class="block text-sm font-medium text-gray-700">Email Address<span class="text-red-500">*</span></label>
                <input 
                    type="email" 
                    name="email_address" 
                    id="email_address" 
                    maxlength="100" 
                    required 
                    value="{{ old('email_address', $inputData['email_address'] ?? '') }}"
                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <div class="invalid-feedback" style="display: none;">invalid.</div>
                @error('email_address')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
       </div>

         <div class="flex space-x-4">
          <!-- Alternative Contact Person Field -->
            <div class="flex-1">
                <label for="alt_contact_person" class="block text-sm font-medium text-gray-700">Alternative Contact Person<span class="text-red-500">*</span></label>
                <input 
                    type="text" 
                    name="alt_contact_person" 
                    id="alt_contact_person" 
                    maxlength="100" 
                    required 
                    value="{{ old('alt_contact_person', $inputData['alt_contact_person'] ?? '') }}"
                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <div class="invalid-feedback" style="display: none;">invalid.</div>
                @error('alt_contact_person')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Alternative Contact Person's Telephone Number Field -->
            <div class="flex-1">
                <label for="alt_contact_telephone_num" class="block text-sm font-medium text-gray-700">Alternative Contact Person's Telephone Number<span class="text-red-500">*</span></label>
                <input 
                    type="tel" 
                    name="alt_contact_telephone_num" 
                    id="alt_contact_telephone_num" 
                    placeholder="+254XXXXXXXXX" 
                    pattern="\+254[0-9]{9}" 
                    maxlength="14" 
                    required 
                    value="{{ old('alt_contact_telephone_num', $inputData['alt_contact_telephone_num'] ?? '') }}"
                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <div class="invalid-feedback" style="display: none;">invalid.</div>
                <small class="text-gray-500">Format: +254XXXXXXXXX</small>
                @error('alt_contact_telephone_num')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
       </div>

<div class="flex space-x-4">
    <!-- Are you living with a disability? Field -->
    <div class="flex-1">
        <label for="disability_question" class="block text-sm font-medium text-gray-700">Are you living with a disability?<span class="text-red-500">*</span></label>
        <select 
            name="disability_question" 
            id="disability_question" 
            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <option value="">Select...</option>
            <option value="yes" {{ old('disability_question', $inputData['disability_question'] ?? '') == 'yes' ? 'selected' : '' }}>Yes</option>
            <option value="no" {{ old('disability_question', $inputData['disability_question'] ?? '') == 'no' ? 'selected' : '' }}>No</option>
        </select>
        <div class="invalid-feedback" style="display: none;">invalid.</div>

        @error('disability_question')
            <span class="text-red-500 text-xs">{{ $message }}</span>
        @enderror
    </div>
</div>


            <!-- Nature of Disability Field -->
            <div class="flex-1 hidden" id="nature_of_disability_container">
                <label for="nature_of_disability" class="block text-sm font-medium text-gray-700">Nature of Disability</label>
                <input 
                    type="text" 
                    name="nature_of_disability" 
                    id="nature_of_disability" 
                    value="{{ old('nature_of_disability', $inputData['nature_of_disability'] ?? '') }}"
                    maxlength="100" 
                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <div class="invalid-feedback" style="display: none;">invalid.</div>
            </div>

            <!-- Registration No and Date for National Council for People with Disabilities Field -->
            <div class="flex-1 hidden" id="ncpd_registration_no_container">
                <label for="ncpd_registration_no" class="block text-sm font-medium text-gray-700">Registration No and Date for National Council for People with Disabilities</label>
                <input 
                    type="text" 
                    name="ncpd_registration_no" 
                    id="ncpd_registration_no" 
                    maxlength="100" 
                    value="{{ old('ncpd_registration_no', $inputData['ncpd_registration_no'] ?? '') }}"
                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <div class="invalid-feedback" style="display: none;">invalid.</div>
            </div>
      </div>
  <div class="flex space-x-4">
</div>

<div class="flex space-x-4">

<div class="text-center my-4">
    <h2 class="text-3xl font-bold">A Section For Applicants in the Service ONLY</h2>
</div>
</div>
<!-- Ministry Field -->
<div class="flex space-x-4">
            <div class="flex-1">
                <label for="ministry" class="block text-sm font-medium text-gray-700">Ministry/state/department/county/other public institutions</label>
                <input type="text"  name="ministry" id="ministry" maxlength="100" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="N/A">
            </div>
            <div class="flex-1">
                <label for="station" class="block text-sm font-medium text-gray-700">Station</label>
                <input type="text"  name="station" id="station" maxlength="100" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="N/A">
            </div>
        </div>

        <div class="flex space-x-4">
            <div class="flex-1">
                <label for="personal_employment_number" class="block text-sm font-medium text-gray-700">Personal/Employment Number</label>
                <input type="text"  name="personal_employment_number" id="personal_employment_number" maxlength="100" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="N/A">
            </div>
            <div class="flex-1">
                <label for="present_substantive_post" class="block text-sm font-medium text-gray-700">Present Substantive Post</label>
                <input type="text"  name="present_substantive_post" id="present_substantive_post" maxlength="100" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="N/A">
            </div>
        </div>

        <div class="flex space-x-4">
            <div class="flex-1">
                <label for="job_grp_scale_grade" class="block text-sm font-medium text-gray-700">Job Group/Scale/Grade</label>
                <input type="text"  name="job_grp_scale_grade" id="job_grp_scale_grade" maxlength="100" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="N/A">
            </div>
            <div class="flex-1">
                <label for="date_of_current_appointment" class="block text-sm font-medium text-gray-700">Date of Current Appointment</label>
                <input type="date" name="date_of_current_appointment" id="date_of_current_appointment" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
        </div>

        <div class="flex space-x-4">
            <div class="flex-1">
                <label for="upgraded_post" class="block text-sm font-medium text-gray-700">Upgraded Post</label>
                <input type="text"  name="upgraded_post" id="upgraded_post" maxlength="100" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="N/A">
            </div>
            <div class="flex-1">
                <label for="effective_date_previous_appointment" class="block text-sm font-medium text-gray-700">Effective Date of Previous Appointment</label>
                <input type="date" name="effective_date_previous_appointment" id="effective_date_previous_appointment" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
        </div>

        <div class="flex space-x-4">
            <div class="flex-1">
                <label for="on_secondment_organization" class="block text-sm font-medium text-gray-700">On Secondment/Organization</label>
                <input type="text"  name="on_secondment_organization" id="on_secondment_organization" maxlength="100" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="N/A">
            </div>
            <div class="flex-1">
                <label for="designation" class="block text-sm font-medium text-gray-700">Designation</label>
                <input type="text" name="designation"  id="designation" maxlength="100" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="N/A">
            </div>
            <div class="flex-1">
                <label for="job_group" class="block text-sm font-medium text-gray-700">Job Group</label>
                <input type="text"  name="job_group" id="job_group" maxlength="100" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="N/A">
            </div>
        </div>

        <div class="flex space-x-4">
            <div class="flex-1">
                <label for="terms_of_service" class="block text-sm font-medium text-gray-700">Terms of Service</label>
                <select name="terms_of_service" id="terms_of_service" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="">Select...</option>
                    <option value="permanent_n_pensionable">Permanent & Pensionable</option>
                    <option value="contract">Contract</option>
                    <option value="other">Other</option>
                </select>
            </div>
        </div>
  




      

  
<div class="flex space-x-4">
                

                {{-- <a href="{{ route('profile.academic-info') }}" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    Next
                </a> --}}
                
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Save</button>

            </div>   
    </form>
    
  </x-card>
  </x-layout>
<!-- resources/views/pupillages/create.blade.php -->
<x-layout>
    <x-card class="p-10 max-w-lg mx-auto mt-24 bg-white rounded-lg shadow-lg">
    <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 bg-gray-500 text-white font-semibold text-sm rounded-lg hover:bg-gray-700">
            ← Back
        </a>
        <h1 class="text-3xl font-bold text-center mb-8 text-gray-800">Apply for Pupillage Program</h1> 

        <!-- Display Validation Errors -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6">
                <strong class="font-bold">Whoops!</strong> There were some problems with your input.<br><br>
                <ul class="mt-3 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pupillages.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- PERSONAL DETAILS -->
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Personal Details</h2>

            <!-- Full Name -->
            <div>
                <label for="full_name" class="block text-sm font-medium text-gray-700">Full Name (As per Identification Card)</label>
                <input type="text" name="full_name" id="full_name" placeholder="Full Name"
                    value="{{ old('full_name') }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                    required>
                @error('full_name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Date of Birth -->
            <div>
                <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                <input type="date" name="date_of_birth" id="date_of_birth"
                    value="{{ old('date_of_birth') }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                    required>
                @error('date_of_birth')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Identity Card Number -->
            <div>
                <label for="identity_card_number" class="block text-sm font-medium text-gray-700">Identity Card Number</label>
                <input type="text" name="identity_card_number" id="identity_card_number" placeholder="Identity Card Number"
                    value="{{ old('identity_card_number') }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                    required>
                @error('identity_card_number')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Gender -->
            <div>
                <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                <select name="gender" id="gender"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                    required>
                    <option value="">Select Gender</option>
                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                </select>
                @error('gender')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nationality -->
            <div>
                <label for="nationality" class="block text-sm font-medium text-gray-700">Nationality</label>
                <input type="text" name="nationality" id="nationality" placeholder="Nationality"
                    value="{{ old('nationality') }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                    required>
                @error('nationality')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Ethnicity -->
            <div>
                <label for="ethnicity" class="block text-sm font-medium text-gray-700">Ethnicity</label>
                <input type="text" name="ethnicity" id="ethnicity" placeholder="Ethnicity"
                    value="{{ old('ethnicity') }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                    required>
                @error('ethnicity')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Home County -->
<div>
    <label for="home_county" class="block text-sm font-medium text-gray-700">Home County</label>
    <select name="home_county" id="home_county"
        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
        required>
        <option value="">Select Home County</option>
        @foreach($countyps as $county)
            <option value="{{ $county->id }}" {{ old('home_county') == $county->id ? 'selected' : '' }}>
                {{ $county->name }}
            </option>
        @endforeach
        <option value="Other" {{ old('home_county') == 'Other' ? 'selected' : '' }}>Otherr</option>
    </select>
    @error('home_county')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror

    <!-- Other Home County Input -->
    <input type="text" name="other_home_county" id="other_home_county" placeholder="Please specify"
        value="{{ old('other_home_county') }}"
        class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
        style="display: none;">
</div>


            <!-- Sub County -->
<div>
    <label for="sub_county" class="block text-sm font-medium text-gray-700">Sub County</label>
    <select name="sub_county" id="sub_county"
        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
        required>
        <option value="">Select Sub County</option>
    </select>
    @error('sub_county')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror

    <!-- Other Sub County Input -->
    <input type="text" name="other_sub_county" id="other_sub_county" placeholder="Please specify"
        value="{{ old('other_sub_county') }}"
        class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
        style="display: none;">
</div>


            <!-- Disability Status -->
            <div>
                <label for="disability_status" class="block text-sm font-medium text-gray-700">Disability Status</label>
                <select name="disability_status" id="disability_status"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                    required>
                    <option value="">Select Disability Status</option>
                    <option value="0" {{ old('disability_status') == '0' ? 'selected' : '' }}>No</option>
                    <option value="1" {{ old('disability_status') == '1' ? 'selected' : '' }}>Yes</option>
                </select>
                @error('disability_status')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nature of Disability -->
            <div id="nature_of_disability_container" style="{{ old('disability_status') == '1' ? '' : 'display:none;' }}">
                <label for="nature_of_disability" class="block text-sm font-medium text-gray-700">Nature of Disability</label>
                <input type="text" name="nature_of_disability" id="nature_of_disability" placeholder="Nature of Disability"
                    value="{{ old('nature_of_disability') }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                @error('nature_of_disability')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- CONTACT DETAILS -->
            <h2 class="text-2xl font-bold mb-4 text-gray-800 mt-8">Contact Details</h2>

            <!-- Postal Address -->
            <div>
                <label for="postal_address" class="block text-sm font-medium text-gray-700">Postal Address</label>
                <input type="text" name="postal_address" id="postal_address" placeholder="Postal Address"
                    value="{{ old('postal_address') }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                    required>
                @error('postal_address')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Postal Code -->
            <div>
                <label for="postal_code" class="block text-sm font-medium text-gray-700">Postal Code</label>
                <input type="text" name="postal_code" id="postal_code" placeholder="Postal Code"
                    value="{{ old('postal_code') }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                    required>
                @error('postal_code')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Town -->
            <div>
                <label for="town" class="block text-sm font-medium text-gray-700">Town</label>
                <input type="text" name="town" id="town" placeholder="Town"
                    value="{{ old('town') }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                    required>
                @error('town')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Physical Address -->
            <div>
                <label for="physical_address" class="block text-sm font-medium text-gray-700">Physical Address</label>
                <input type="text" name="physical_address" id="physical_address" placeholder="Physical Address"
                    value="{{ old('physical_address') }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                    required>
                @error('physical_address')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Mobile Number -->
            <div>
                <label for="mobile_number" class="block text-sm font-medium text-gray-700">Mobile Number</label>
                <input type="text" name="mobile_number" id="mobile_number" placeholder="Mobile Number"
                    value="{{ old('mobile_number') }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                    required>
                @error('mobile_number')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Alternate Mobile Number -->
            <div>
                <label for="alternate_mobile_number" class="block text-sm font-medium text-gray-700">Alternate Mobile Number</label>
                <input type="text" name="alternate_mobile_number" id="alternate_mobile_number" placeholder="Alternate Mobile Number"
                    value="{{ old('alternate_mobile_number') }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                @error('alternate_mobile_number')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Address -->
            <div>
                <label for="email_address" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" name="email_address" id="email_address" placeholder="Email Address"
                    value="{{ old('email_address') }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                    required>
                @error('email_address')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- ACADEMIC QUALIFICATION -->
            <h2 class="text-2xl font-bold mb-4 text-gray-800 mt-8">Academic Qualification</h2>

            <!-- KSCE Grade -->
<div>
    <label for="ksce_grade" class="block text-sm font-medium text-gray-700">KSCE Grade</label>
    <select name="ksce_grade" id="ksce_grade" required
        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
        <option value="">Select KSCE Grade</option>
        @foreach($ksceGrades as $grade)
            <option value="{{ $grade->id }}" {{ old('ksce_grade') == $grade->id ? 'selected' : '' }}>
                {{ $grade->grade }}
            </option>
        @endforeach
        <option value="Other" {{ old('ksce_grade') == 'Other' ? 'selected' : '' }}>Other</option>
    </select>
    @error('ksce_grade')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror

    <input type="text" name="other_ksce_grade" id="other_ksce_grade" placeholder="Enter other KSCE Grade"
        value="{{ old('other_ksce_grade') }}"
        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
        style="display: none;">
    @error('other_ksce_grade')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>


<!-- Institution/University Name -->
<div>
    <label for="institution_name" class="block text-sm font-medium text-gray-700">Institution/University Name</label>
    <select name="institution_name" id="institution_name" required
        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
        <option value="">Select Institution/University</option>
        @foreach($institutions as $institution)
            <option value="{{ $institution->id }}" {{ old('institution_name') == $institution->id ? 'selected' : '' }}>
                {{ $institution->name }}
            </option>
        @endforeach
        <option value="Other" {{ old('institution_name') == 'Other' ? 'selected' : '' }}>Other</option>
    </select>
    @error('institution_name')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror

    <input type="text" name="other_institution_name" id="other_institution_name" placeholder="Enter other Institution"
        value="{{ old('other_institution_name') }}"
        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
        style="display: none;">
    @error('other_institution_name')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="institution_grade" class="block text-sm font-medium text-gray-700">University/Institution Grade</label>
    <select name="institution_grade" id="institution_grade" required
        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
        <option value="">Select Institution Grade</option>
        @foreach($institutionGrades as $grade)
            <option value="{{ $grade->id }}" {{ old('institution_grade') == $grade->id ? 'selected' : '' }}>
                {{ $grade->grade }}
            </option>
        @endforeach
        <option value="Other" {{ old('institution_grade') == 'Other' ? 'selected' : '' }}>Other</option>
    </select>
    @error('institution_grade')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror

    <input type="text" name="other_institution_grade" id="other_institution_grade" placeholder="Enter other Institution Grade"
        value="{{ old('other_institution_grade') }}"
        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
        style="display: none;">
    @error('other_institution_grade')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
            <h2 class="text-2xl font-bold mb-4 text-gray-800 mt-8">Employment Details</h2>

<!-- Are You Employed Field -->
<div>
    <label for="are_you_employed" class="block text-sm font-medium text-gray-700">Are you employed?</label>
    <select name="are_you_employed" id="are_you_employed" required
        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
        <option value="">Select</option>
        <option value="Yes" {{ old('are_you_employed', isset($pupillage) ? $pupillage->are_you_employed : '') == 'Yes' ? 'selected' : '' }}>Yes</option>
        <option value="No" {{ old('are_you_employed', isset($pupillage) ? $pupillage->are_you_employed : '') == 'No' ? 'selected' : '' }}>No</option>
    </select>
    @error('are_you_employed')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<!-- Conditional Employment Details -->
<div id="employment_details" style="display: none;">
    <!-- Employer Institution Name -->
    <div>
        <label for="employer_institution_name" class="block text-sm font-medium text-gray-700">Employer Institution Name</label>
        <input type="text" name="employer_institution_name" id="employer_institution_name"
            value="{{ old('employer_institution_name', isset($pupillage) ? $pupillage->employer_institution_name : '') }}"
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
        @error('employer_institution_name')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Gross Salary -->
    <div>
        <label for="gross_salary" class="block text-sm font-medium text-gray-700">Gross Monthly Salary (KSH)</label>
        <input type="number" name="gross_salary" id="gross_salary"
            value="{{ old('gross_salary', isset($pupillage) ? $pupillage->gross_salary : '') }}"
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
        @error('gross_salary')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>
            <!-- Declaration/Signature Checkbox -->
            <div>
                <label class="block text-sm font-medium text-gray-700">
                    <input type="checkbox" name="declaration" id="declaration" value="1"
                        {{ old('declaration') ? 'checked' : '' }} required>
                    I declare that the information provided is true and correct.
                </label>
                @error('declaration')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                    Submit
                </button>
            </div>
        </form>
    </x-card>
</x-layout>

<!-- JavaScript to toggle Nature of Disability field -->
<script>
    document.getElementById('disability_status').addEventListener('change', function() {
        var natureContainer = document.getElementById('nature_of_disability_container');
        if (this.value == '1') { // 'Yes' selected
            natureContainer.style.display = 'block';
        } else {
            natureContainer.style.display = 'none';
        }
    });
</script>

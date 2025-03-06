<x-layout>
    <x-card class="p-8 max-w-4xl mx-auto mt-12">
        <!-- Back Button -->
        <a href="{{ url()->previous() }}" class="mb-6 inline-flex items-center px-4 py-2 bg-[#D68C3C] text-white rounded-md hover:bg-[#bf7a2e] transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back
        </a>

        <!-- Header -->
        <h1 class="text-3xl font-bold text-center mb-8 text-gray-900">Edit Pupillage Application</h1>

        <!-- Error Messages -->
        @if ($errors->any())
        <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6 rounded-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">There were {{ $errors->count() }} errors with your submission</h3>
                    <ul class="mt-2 text-sm text-red-700 list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif

        <form id="pupillageForm" action="{{ route('pupillages.update', $pupillage->id) }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')

            <!-- Personal Details Section -->
            <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b-2 border-[#D68C3C] pb-2">Personal Details</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Full Name -->
                    <div>
                        <label for="full_name" class="block text-sm font-medium text-gray-700">Full Name <span class="text-red-500">*</span></label>
                        <input type="text" name="full_name" id="full_name" 
                               value="{{ old('full_name', $pupillage->full_name) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                               required>
                    </div>

                    <!-- Date of Birth -->
                    <div>
                        <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth <span class="text-red-500">*</span></label>
                        <input type="date" name="date_of_birth" id="date_of_birth"
                               value="{{ old('date_of_birth', $pupillage->date_of_birth) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                               required>
                    </div>

                    <!-- Identity Card Number -->
                    <div>
                        <label for="identity_card_number" class="block text-sm font-medium text-gray-700">ID Number <span class="text-red-500">*</span></label>
                        <input type="text" name="identity_card_number" id="identity_card_number"
                               value="{{ old('identity_card_number', $pupillage->identity_card_number) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                               required>
                    </div>

                    <!-- Gender -->
                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-700">Gender <span class="text-red-500">*</span></label>
                        <select name="gender" id="gender"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                               required>
                            <option value="">Select Gender</option>
                            <option value="Male" {{ old('gender', $pupillage->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender', $pupillage->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>

                    <!-- Nationality -->
                    <div>
                        <label for="nationality" class="block text-sm font-medium text-gray-700">Nationality <span class="text-red-500">*</span></label>
                        <input type="text" name="nationality" id="nationality"
                               value="{{ old('nationality', $pupillage->nationality) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                               required>
                    </div>

                    <!-- Ethnicity -->
                    <div>
                        <label for="ethnicity" class="block text-sm font-medium text-gray-700">Ethnicity <span class="text-red-500">*</span></label>
                        <input type="text" name="ethnicity" id="ethnicity"
                               value="{{ old('ethnicity', $pupillage->ethnicity) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                               required>
                    </div>

                    <!-- Home County -->
                    <div>
                        <label for="home_county" class="block text-sm font-medium text-gray-700">Home County <span class="text-red-500">*</span></label>
                        <select name="home_county" id="home_county"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                               required>
                            <option value="">Select Home County</option>
                            @foreach($countyps as $county)
                                <option value="{{ $county->id }}" {{ old('home_county', $pupillage->home_county) == $county->id ? 'selected' : '' }}>
                                    {{ $county->name }}
                                </option>
                            @endforeach
                            <option value="Other" {{ old('home_county') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        <input type="text" name="other_home_county" id="other_home_county" placeholder="Specify County"
                               value="{{ old('other_home_county') }}"
                               class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C] hidden">
                    </div>

                    <!-- Sub County -->
                    <div>
                        <label for="sub_county" class="block text-sm font-medium text-gray-700">Sub County <span class="text-red-500">*</span></label>
                        <select name="sub_county" id="sub_county"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                               required>
                            <option value="">Select Sub County</option>
                        </select>
                        <input type="text" name="other_sub_county" id="other_sub_county" placeholder="Specify Sub County"
                               value="{{ old('other_sub_county') }}"
                               class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C] hidden">
                    </div>

                    <!-- Disability Status -->
                    <div>
                        <label for="disability_status" class="block text-sm font-medium text-gray-700">Disability Status <span class="text-red-500">*</span></label>
                        <select name="disability_status" id="disability_status"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                               required>
                            <option value="">Select Status</option>
                            <option value="0" {{ old('disability_status', $pupillage->disability_status) == '0' ? 'selected' : '' }}>No</option>
                            <option value="1" {{ old('disability_status', $pupillage->disability_status) == '1' ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>

                    <!-- Nature of Disability -->
                    <div id="nature_of_disability_container" class="{{ old('disability_status', $pupillage->disability_status) == '1' ? '' : 'hidden' }}">
                        <label for="nature_of_disability" class="block text-sm font-medium text-gray-700">Nature of Disability</label>
                        <input type="text" name="nature_of_disability" id="nature_of_disability"
                               value="{{ old('nature_of_disability', $pupillage->nature_of_disability) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]">
                    </div>
                </div>
            </div>

            <!-- Contact Details Section -->
            <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b-2 border-[#D68C3C] pb-2">Contact Details</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Postal Address -->
                    <div>
                        <label for="postal_address" class="block text-sm font-medium text-gray-700">Postal Address <span class="text-red-500">*</span></label>
                        <input type="text" name="postal_address" id="postal_address"
                               value="{{ old('postal_address', $pupillage->postal_address) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                               required>
                    </div>

                    <!-- Postal Code -->
                    <div>
                        <label for="postal_code" class="block text-sm font-medium text-gray-700">Postal Code <span class="text-red-500">*</span></label>
                        <input type="text" name="postal_code" id="postal_code"
                               value="{{ old('postal_code', $pupillage->postal_code) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                               required>
                    </div>

                    <!-- Town -->
                    <div>
                        <label for="town" class="block text-sm font-medium text-gray-700">Town <span class="text-red-500">*</span></label>
                        <input type="text" name="town" id="town"
                               value="{{ old('town', $pupillage->town) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                               required>
                    </div>

                    <!-- Physical Address -->
                    <div>
                        <label for="physical_address" class="block text-sm font-medium text-gray-700">Physical Address <span class="text-red-500">*</span></label>
                        <input type="text" name="physical_address" id="physical_address"
                               value="{{ old('physical_address', $pupillage->physical_address) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                               required>
                    </div>

                    <!-- Mobile Number -->
                    <div>
                        <label for="mobile_number" class="block text-sm font-medium text-gray-700">Mobile Number <span class="text-red-500">*</span></label>
                        <div class="flex rounded-md shadow-sm">
                            <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">+254</span>
                            <input type="tel" name="mobile_number" id="mobile_number" 
                                   value="{{ old('mobile_number', $pupillage->mobile_number) }}"
                                   class="flex-1 block w-full rounded-r-md border-gray-300 focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                                   pattern="[0-9]{9}" maxlength="9"placeholder="7XX XXX XXX" required>
                        </div>
                    </div>

                    <!-- Alternate Mobile Number -->
                    <div>
                        <label for="alternate_mobile_number" class="block text-sm font-medium text-gray-700">Alternate Mobile Number</label>
                        <div class="flex rounded-md shadow-sm">
                            <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">+254</span>
                            <input type="tel" name="alternate_mobile_number" id="alternate_mobile_number" 
                                   value="{{ old('alternate_mobile_number', $pupillage->alternate_mobile_number) }}"
                                   class="flex-1 block w-full rounded-r-md border-gray-300 focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                                   pattern="[0-9]{9}" maxlength="9"placeholder="7XX XXX XXX">
                        </div>
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label for="email_address" class="block text-sm font-medium text-gray-700">Email <span class="text-red-500">*</span></label>
                        <input type="email" name="email_address" id="email_address"
                               value="{{ old('email_address', $pupillage->email_address) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                               required>
                    </div>
                </div>
            </div>

            <!-- Academic Qualifications Section -->
            <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b-2 border-[#D68C3C] pb-2">Academic Qualifications</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- KSCE Grade -->
                    <div>
                        <label for="ksce_grade" class="block text-sm font-medium text-gray-700">KSCE Grade <span class="text-red-500">*</span></label>
                        <select name="ksce_grade" id="ksce_grade"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                               required>
                            <option value="">Select Grade</option>
                            @foreach($ksceGrades as $grade)
                                <option value="{{ $grade->id }}" {{ old('ksce_grade', $pupillage->ksce_grade) == $grade->id ? 'selected' : '' }}>
                                    {{ $grade->grade }}
                                </option>
                            @endforeach
                            <option value="Other" {{ old('ksce_grade') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        <input type="text" name="other_ksce_grade" id="other_ksce_grade" placeholder="Specify Grade"
                               value="{{ old('other_ksce_grade', $pupillage->other_ksce_grade) }}"
                               class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C] hidden">
                    </div>

                    <!-- Institution Name -->
                    <div>
                        <label for="institution_name" class="block text-sm font-medium text-gray-700">Institution <span class="text-red-500">*</span></label>
                        <select name="institution_name" id="institution_name"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                               required>
                            <option value="">Select Institution</option>
                            @foreach($institutions as $institution)
                                <option value="{{ $institution->id }}" {{ old('institution_name', $pupillage->institution_name) == $institution->id ? 'selected' : '' }}>
                                    {{ $institution->name }}
                                </option>
                            @endforeach
                            <option value="Other" {{ old('institution_name') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        <input type="text" name="other_institution_name" id="other_institution_name" placeholder="Specify Institution"
                               value="{{ old('other_institution_name', $pupillage->other_institution_name) }}"
                               class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C] hidden">
                    </div>

                    <!-- Institution Grade -->
                    <div>
                        <label for="institution_grade" class="block text-sm font-medium text-gray-700">Institution Grade <span class="text-red-500">*</span></label>
                        <select name="institution_grade" id="institution_grade"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                               required>
                            <option value="">Select Grade</option>
                            @foreach($institutionGrades as $grade)
                                <option value="{{ $grade->id }}" {{ old('institution_grade', $pupillage->institution_grade) == $grade->id ? 'selected' : '' }}>
                                    {{ $grade->grade }}
                                </option>
                            @endforeach
                            <option value="Other" {{ old('institution_grade') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        <input type="text" name="other_institution_grade" id="other_institution_grade" placeholder="Specify Grade"
                               value="{{ old('other_institution_grade', $pupillage->other_institution_grade) }}"
                               class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C] hidden">
                    </div>
                </div>
            </div>

            <!-- Employment Details Section -->
            <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b-2 border-[#D68C3C] pb-2">Employment Details</h2>
                
                <div class="space-y-6">
                    <!-- Employment Status -->
                    <div>
                        <label for="are_you_employed" class="block text-sm font-medium text-gray-700">Employment Status <span class="text-red-500">*</span></label>
                        <select name="are_you_employed" id="are_you_employed"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                               required>
                            <option value="">Select Status</option>
                            <option value="Yes" {{ old('are_you_employed', $pupillage->are_you_employed) == 'Yes' ? 'selected' : '' }}>Yes</option>
                            <option value="No" {{ old('are_you_employed', $pupillage->are_you_employed) == 'No' ? 'selected' : '' }}>No</option>
                        </select>
                    </div>

                    <!-- Conditional Employment Fields -->
                    <div id="employment_details" class="{{ old('are_you_employed', $pupillage->are_you_employed) == 'Yes' ? '' : 'hidden' }}">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Employer Institution -->
                            <div>
                                <label for="employer_institution_name" class="block text-sm font-medium text-gray-700">Employer Name</label>
                                <input type="text" name="employer_institution_name" id="employer_institution_name"
                                       value="{{ old('employer_institution_name', $pupillage->employer_institution_name) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]">
                            </div>

                            <!-- Gross Salary -->
                            <div>
                                <label for="gross_salary" class="block text-sm font-medium text-gray-700">Gross Salary (KES)</label>
                                <input type="number" name="gross_salary" id="gross_salary" step="0.01"
                                       value="{{ old('gross_salary', $pupillage->gross_salary) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Declaration Checkbox -->
<div class="bg-[#D68C3C]/10 p-6 rounded-lg border border-[#D68C3C]/20">
    <div class="flex items-start">
        <div class="flex items-center h-5">
            <!-- Hidden input to ensure value is always sent -->
            <input type="hidden" name="declaration" value="0">
            <!-- Visible checkbox -->
            <input type="checkbox" name="declaration" id="declaration" 
                   class="h-4 w-4 text-[#D68C3C] focus:ring-[#D68C3C] border-gray-300 rounded"
                   value="1" {{ old('declaration') ? 'checked' : '' }}>
        </div>
        <div class="ml-3 text-sm">
            <label for="declaration" class="font-medium text-gray-700">
                I declare that the information provided is true and correct
            </label>
            <p class="text-gray-500 mt-1">By checking this box, you confirm the accuracy of the provided information</p>
        </div>
    </div>
    @error('declaration')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2 bg-[#D68C3C] text-white rounded-md hover:bg-[#bf7a2e] flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Update Application
                </button>
            </div>

            <!-- Loader -->
            <div id="loader" class="hidden justify-center mt-4">
                <svg class="animate-spin h-6 w-6 text-[#D68C3C]" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                </svg>
            </div>
        </form>
    </x-card>

    <script>
        // Form submission handler
        document.getElementById("pupillageForm").addEventListener("submit", function(event) {
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = `
                <svg class="animate-spin h-5 w-5 mr-2" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                </svg>
                Updating...`;
            document.getElementById("loader").classList.remove("hidden");
        });

        // Dynamic field toggling
        const toggleFields = {
            'disability_status': () => {
                const container = document.getElementById('nature_of_disability_container');
                container.style.display = document.getElementById('disability_status').value === '1' ? 'block' : 'none';
            },
            'are_you_employed': () => {
                const container = document.getElementById('employment_details');
                container.style.display = document.getElementById('are_you_employed').value === 'Yes' ? 'block' : 'none';
            },
            'home_county': () => {
                const otherInput = document.getElementById('other_home_county');
                const subCountySelect = document.getElementById('sub_county');
                if(document.getElementById('home_county').value === 'Other') {
                    otherInput.style.display = 'block';
                    subCountySelect.style.display = 'none';
                } else {
                    otherInput.style.display = 'none';
                    subCountySelect.style.display = 'block';
                    // Fetch sub-counties logic here
                }
            },
            'ksce_grade': () => {
                const otherInput = document.getElementById('other_ksce_grade');
                otherInput.style.display = document.getElementById('ksce_grade').value === 'Other' ? 'block' : 'none';
            },
            'institution_name': () => {
                const otherInput = document.getElementById('other_institution_name');
                otherInput.style.display = document.getElementById('institution_name').value === 'Other' ? 'block' : 'none';
            },
            'institution_grade': () => {
                const otherInput = document.getElementById('other_institution_grade');
                otherInput.style.display = document.getElementById('institution_grade').value === 'Other' ? 'block' : 'none';
            }
        };

        // Attach event listeners
        Object.keys(toggleFields).forEach(fieldId => {
            document.getElementById(fieldId).addEventListener('change', toggleFields[fieldId]);
            // Initialize on load
            toggleFields[fieldId]();
        });

        // County/Subcounty dynamic loading
        document.getElementById('home_county').addEventListener('change', function() {
            if(this.value !== 'Other') {
                fetch(`/api/subcounties/${this.value}`)
                    .then(response => response.json())
                    .then(data => {
                        const subCountySelect = document.getElementById('sub_county');
                        subCountySelect.innerHTML = data.map(sc => 
                            `<option value="${sc.id}">${sc.name}</option>`
                        ).join('');
                    });
            }
        });
    </script>
</x-layout>
<x-layout>
    <x-card class="p-8 max-w-4xl mx-auto mt-12">
        <!-- Enhanced Back Button -->
        <a href="{{ url()->previous() }}" class="mb-6 inline-flex items-center px-4 py-2 bg-[#D68C3C] text-white rounded-md hover:bg-[#bf7a2e] transition-colors shadow-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back
        </a>

        <!-- Header -->
        <h1 class="text-3xl font-bold text-center mb-8 text-gray-900">Edit Post Pupillage Application</h1>

        <!-- Enhanced Error Messages -->
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

        <form id="editForm" action="{{ route('postPupillages.update', $postpupillage->id) }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')

            <!-- Form Sections -->
            <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b-2 border-[#D68C3C] pb-2">Application Details</h2>
                
                <!-- Vacancy No -->
                <div class="mb-6">
                    <label for="vacancy_no" class="block text-sm font-medium text-gray-700">Vacancy Number</label>
                    <input type="text" name="vacancy_no" id="vacancy_no"
                        value="{{ $vacancyNo }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100 cursor-not-allowed"
                        readonly>
                </div>
            </div>

            <!-- Personal Details Section -->
            <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b-2 border-[#D68C3C] pb-2">Personal Details</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Full Name -->
                    <div>
                        <label for="full_name" class="block text-sm font-medium text-gray-700">Full Name <span class="text-red-500">*</span></label>
                        <input type="text" name="full_name" id="full_name"
                            value="{{ old('full_name', $postpupillage->full_name) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                            placeholder="As per identification document" required>
                    </div>

                    <!-- Date of Birth -->
                    <div>
                        <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth <span class="text-red-500">*</span></label>
                        <input type="date" name="date_of_birth" id="date_of_birth"
                            value="{{ old('date_of_birth', $postpupillage->date_of_birth) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                            required>
                    </div>

                    <!-- Identity Card Number -->
                    <div>
                        <label for="identity_card_number" class="block text-sm font-medium text-gray-700">ID Number <span class="text-red-500">*</span></label>
                        <input type="text" name="identity_card_number" id="identity_card_number"
                            value="{{ old('identity_card_number', $postpupillage->identity_card_number) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                            placeholder="National ID number" required>
                    </div>

                    <!-- Gender -->
                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-700">Gender <span class="text-red-500">*</span></label>
                        <select name="gender" id="gender"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                            required>
                            <option value="">Select Gender</option>
                            <option value="Male" {{ old('gender', $postpupillage->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender', $postpupillage->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>

                    <!-- KRA PIN -->
                    <div>
                        <label for="kra_pin" class="block text-sm font-medium text-gray-700">KRA PIN <span class="text-red-500">*</span></label>
                        <input type="text" name="kra_pin" id="kra_pin"
                            value="{{ old('kra_pin', $postpupillage->kra_pin) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                            placeholder="KRA PIN" required>
                    </div>

                    <!-- NHIF/SHIF Card No -->
                    <div>
                        <label for="nhif_card_number" class="block text-sm font-medium text-gray-700">NHIF/SHIF Number <span class="text-red-500">*</span></label>
                        <input type="text" name="nhif_card_number" id="nhif_card_number"
                            value="{{ old('nhif_card_number', $postpupillage->nhif_card_number) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                            placeholder="NHIF/SHIF number" required>
                    </div>
                </div>
            </div>

            <!-- Contact Information Section -->
            <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b-2 border-[#D68C3C] pb-2">Contact Information</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Postal Address -->
                    <div>
                        <label for="postal_address" class="block text-sm font-medium text-gray-700">Postal Address <span class="text-red-500">*</span></label>
                        <input type="text" name="postal_address" id="postal_address"
                            value="{{ old('postal_address', $postpupillage->postal_address) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                            placeholder="P.O Box" required>
                    </div>

                    <!-- Postal Code -->
                    <div>
                        <label for="postal_code" class="block text-sm font-medium text-gray-700">Postal Code <span class="text-red-500">*</span></label>
                        <input type="text" name="postal_code" id="postal_code"
                            value="{{ old('postal_code', $postpupillage->postal_code) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                            placeholder="Postal code" required>
                    </div>

                    <!-- Town -->
                    <div>
                        <label for="town" class="block text-sm font-medium text-gray-700">Town <span class="text-red-500">*</span></label>
                        <input type="text" name="town" id="town"
                            value="{{ old('town', $postpupillage->town) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                            placeholder="Town/City" required>
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label for="email_address" class="block text-sm font-medium text-gray-700">Email <span class="text-red-500">*</span></label>
                        <input type="email" name="email_address" id="email_address"
                            value="{{ old('email_address', $postpupillage->email_address) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                            placeholder="email@example.com" required>
                    </div>

                    <!-- Mobile Number -->
                    <div>
                        <label for="mobile_number" class="block text-sm font-medium text-gray-700">Mobile Number <span class="text-red-500">*</span></label>
                        <div class="flex rounded-md shadow-sm">
                            <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">+254</span>
                            <input type="tel" name="mobile_number" id="mobile_number" 
                                value="{{ old('mobile_number', $postpupillage->mobile_number) }}"
                                class="flex-1 block w-full rounded-r-md border-gray-300 focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                                pattern="[0-9]{9}" maxlength="9" placeholder="7XX XXX XXX" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Information Section -->
            <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b-2 border-[#D68C3C] pb-2">Additional Information</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Home County -->
                    <div>
                        <label for="home_county" class="block text-sm font-medium text-gray-700">Home County <span class="text-red-500">*</span></label>
                        <select name="home_county" id="home_county"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                            required>
                            <option value="">Select Home County</option>
                            @foreach($countypps as $county)
                                <option value="{{ $county->id }}" {{ old('home_county', $postpupillage->home_county) == $county->id ? 'selected' : '' }}>
                                    {{ $county->name }}
                                </option>
                            @endforeach
                            <option value="Other" {{ old('home_county') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        <input type="text" name="other_home_county" id="other_home_county" 
                            value="{{ old('other_home_county', $postpupillage->other_home_county) }}"
                            class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C] hidden"
                            placeholder="Specify County">
                    </div>

                    <!-- Sub County -->
                    <div>
                        <label for="sub_county" class="block text-sm font-medium text-gray-700">Sub County <span class="text-red-500">*</span></label>
                        <select name="sub_county" id="sub_county"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                            required>
                            <option value="">Select Sub County</option>
                        </select>
                        <input type="text" name="other_sub_county" id="other_sub_county"
                            value="{{ old('other_sub_county', $postpupillage->other_sub_county) }}"
                            class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C] hidden"
                            placeholder="Specify Sub County">
                    </div>

                    <!-- Ethnicity -->
                    <div>
                        <label for="ethnicity" class="block text-sm font-medium text-gray-700">Ethnicity <span class="text-red-500">*</span></label>
                        <input type="text" name="ethnicity" id="ethnicity"
                            value="{{ old('ethnicity', $postpupillage->ethnicity) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                            placeholder="Ethnic group" required>
                    </div>

                    <!-- Disability Status -->
                    <div>
                        <label for="disability_status" class="block text-sm font-medium text-gray-700">Disability Status <span class="text-red-500">*</span></label>
                        <select name="disability_status" id="disability_status"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                            required>
                            <option value="">Select Status</option>
                            <option value="0" {{ old('disability_status', $postpupillage->disability_status) == '0' ? 'selected' : '' }}>No</option>
                            <option value="1" {{ old('disability_status', $postpupillage->disability_status) == '1' ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>

                    <!-- Nature of Disability -->
                    <div id="nature_of_disability_container" class="{{ old('disability_status', $postpupillage->disability_status) == '1' ? '' : 'hidden' }}">
                        <label for="nature_of_disability" class="block text-sm font-medium text-gray-700">Nature of Disability</label>
                        <input type="text" name="nature_of_disability" id="nature_of_disability"
                            value="{{ old('nature_of_disability', $postpupillage->nature_of_disability) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                            placeholder="Describe disability (if applicable)">
                    </div>

                    <!-- Deployment Region -->
                    <div>
                        <label for="deployment_region" class="block text-sm font-medium text-gray-700">Deployment Region <span class="text-red-500">*</span></label>
                        <select name="deployment_region" id="deployment_region"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                            required>
                            <option value="">Select Region</option>
                            <!-- Options remain the same -->
                            <option value="">Select Region</option>
                            <option value="Nakuru" {{ old('deployment_region') == 'Nakuru' ? 'selected' : '' }}>Nakuru</option>
                            <option value="Kisii" {{ old('deployment_region') == 'Kisii' ? 'selected' : '' }}>Kisii</option>
                            <option value="Mombasa" {{ old('deployment_region') == 'Mombasa' ? 'selected' : '' }}>Mombasa</option>
                            <option value="Kisumu" {{ old('deployment_region') == 'Kisumu' ? 'selected' : '' }}>Kisumu</option>
                            <option value="Kericho" {{ old('deployment_region') == 'Kericho' ? 'selected' : '' }}>Kericho</option>
                            <option value="Embu" {{ old('deployment_region') == 'Embu' ? 'selected' : '' }}>Embu</option>
                            <option value="Nyeri" {{ old('deployment_region') == 'Nyeri' ? 'selected' : '' }}>Nyeri</option>
                            <option value="Kakamega" {{ old('deployment_region') == 'Kakamega' ? 'selected' : '' }}>Kakamega</option>
                            <option value="Malindi" {{ old('deployment_region') == 'Malindi' ? 'selected' : '' }}>Malindi</option>
                            <option value="Eldoret" {{ old('deployment_region') == 'Eldoret' ? 'selected' : '' }}>Eldoret</option>
                            <option value="Meru" {{ old('deployment_region') == 'Meru' ? 'selected' : '' }}>Meru</option>
                            <option value="Garissa" {{ old('deployment_region') == 'Garissa' ? 'selected' : '' }}>Garissa</option>
                            <option value="Machakos" {{ old('deployment_region') == 'Machakos' ? 'selected' : '' }}>Machakos</option>
                            <option value="Other" {{ old('deployment_region') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
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

                                <!-- Submit Button with Loader -->
                    <div class="flex justify-end space-x-4">
                        <button type="submit" 
                            class="px-6 py-2 bg-[#D68C3C] text-white rounded-md hover:bg-[#bf7a2e] transition-colors flex items-center">
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
        </x-layout>

        <!-- JavaScript for Dynamic Behavior -->
        <script>
            // Toggle Nature of Disability Field
            document.getElementById('disability_status').addEventListener('change', function() {
                const natureContainer = document.getElementById('nature_of_disability_container');
                if (this.value === '1') {
                    natureContainer.classList.remove('hidden');
                } else {
                    natureContainer.classList.add('hidden');
                }
            });

            // Toggle Other Home County Field
            document.getElementById('home_county').addEventListener('change', function() {
                const otherHomeCountyInput = document.getElementById('other_home_county');
                if (this.value === 'Other') {
                    otherHomeCountyInput.style.display = 'block';
                } else {
                    otherHomeCountyInput.style.display = 'none';
                }
            });

            // Toggle Other Sub County Field
            document.getElementById('sub_county').addEventListener('change', function() {
                const otherSubCountyInput = document.getElementById('other_sub_county');
                if (this.value === 'Other') {
                    otherSubCountyInput.style.display = 'block';
                } else {
                    otherSubCountyInput.style.display = 'none';
                }
            });

            // Form Submission Loader
            document.getElementById('editForm').addEventListener('submit', function() {
                const submitBtn = this.querySelector('button[type="submit"]');
                submitBtn.disabled = true;
                submitBtn.innerHTML = `
                    <svg class="animate-spin h-5 w-5 mr-2" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                    </svg>
                    Updating...`;
                document.getElementById('loader').classList.remove('hidden');
            });
        </script>
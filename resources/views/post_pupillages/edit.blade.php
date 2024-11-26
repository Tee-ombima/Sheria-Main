<!-- resources/views/post_pupillages/edit.blade.php -->
<x-layout>
    <x-card class="p-10 max-w-2xl mx-auto mt-24 bg-white rounded-lg shadow-lg">
    <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 bg-gray-500 text-white font-semibold text-sm rounded-lg hover:bg-gray-700">
            ← Back
        </a>
        <h1 class="text-3xl font-bold text-center mb-8 text-gray-800">Edit Post Pupillage Application</h1>

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

        <form action="{{ route('postPupillages.update', $postpupillage->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Vacancy No -->
<div>
    <label for="vacancy_no" class="block text-sm font-medium text-gray-700">Vacancy No</label>
    <input type="text" name="vacancy_no" id="vacancy_no"
        value="{{ $vacancyNo }}"
        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
        required readonly>
    @error('vacancy_no')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>


            <!-- Full Name -->
            <div>
                <label for="full_name" class="block text-sm font-medium text-gray-700">Full Name (As per Identification Card)</label>
                <input type="text" name="full_name" id="full_name"
                    value="{{ old('full_name', $postpupillage->full_name) }}"
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
                    value="{{ old('date_of_birth', $postpupillage->date_of_birth) }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                    required>
                @error('date_of_birth')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Identity Card Number -->
            <div>
                <label for="identity_card_number" class="block text-sm font-medium text-gray-700">Identity Card Number</label>
                <input type="text" name="identity_card_number" id="identity_card_number"
                    value="{{ old('identity_card_number', $postpupillage->identity_card_number) }}"
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
                    <option value="Male" {{ old('gender', $postpupillage->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ old('gender', $postpupillage->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                </select>
                @error('gender')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- KRA PIN -->
            <div>
                <label for="kra_pin" class="block text-sm font-medium text-gray-700">KRA PIN</label>
                <input type="text" name="kra_pin" id="kra_pin"
                    value="{{ old('kra_pin', $postpupillage->kra_pin) }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                    required>
                @error('kra_pin')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- NHIF/SHIF Card No -->
            <div>
                <label for="nhif_card_number" class="block text-sm font-medium text-gray-700">NHIF/SHIF Card No</label>
                <input type="text" name="nhif_card_number" id="nhif_card_number"
                    value="{{ old('nhif_card_number', $postpupillage->nhif_card_number) }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                    required>
                @error('nhif_card_number')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Postal Address -->
            <div>
                <label for="postal_address" class="block text-sm font-medium text-gray-700">Postal Address</label>
                <input type="text" name="postal_address" id="postal_address"
                    value="{{ old('postal_address', $postpupillage->postal_address) }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                    required>
                @error('postal_address')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Postal Code -->
            <div>
                <label for="postal_code" class="block text-sm font-medium text-gray-700">Postal Code</label>
                <input type="text" name="postal_code" id="postal_code"
                    value="{{ old('postal_code', $postpupillage->postal_code) }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                    required>
                @error('postal_code')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Town -->
            <div>
                <label for="town" class="block text-sm font-medium text-gray-700">Town</label>
                <input type="text" name="town" id="town"
                    value="{{ old('town', $postpupillage->town) }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                    required>
                @error('town')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Address -->
            <div>
                <label for="email_address" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" name="email_address" id="email_address"
                    value="{{ old('email_address', $postpupillage->email_address) }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                    required>
                @error('email_address')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Mobile Number -->
            <div>
                <label for="mobile_number" class="block text-sm font-medium text-gray-700">Mobile Number</label>
                <input type="text" name="mobile_number" id="mobile_number"
                    value="{{ old('mobile_number', $postpupillage->mobile_number) }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                    required>
                @error('mobile_number')
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
        @foreach($countypps as $county)
            <option value="{{ $county->id }}" {{ old('home_county') == $county->id ? 'selected' : '' }}>
                {{ $county->name }}
            </option>
        @endforeach
        <option value="Other" {{ old('home_county') == 'Other' ? 'selected' : '' }}>Other</option>
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


            <!-- Ethnicity -->
            <div>
                <label for="ethnicity" class="block text-sm font-medium text-gray-700">Ethnicity</label>
                <input type="text" name="ethnicity" id="ethnicity"
                    value="{{ old('ethnicity', $postpupillage->ethnicity) }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                    required>
                @error('ethnicity')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Disability Status -->
            <div>
                <label for="disability_status" class="block text-sm font-medium text-gray-700">Disability Status</label>
                <select name="disability_status" id="disability_status"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                    required>
                    <option value="">Select Disability Status</option>
                    <option value="0" {{ old('disability_status', $postpupillage->disability_status) == '0' ? 'selected' : '' }}>No</option>
                    <option value="1" {{ old('disability_status', $postpupillage->disability_status) == '1' ? 'selected' : '' }}>Yes</option>
                </select>
                @error('disability_status')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nature of Disability (Conditional) -->
            <div id="nature_of_disability_container" style="{{ old('disability_status', $postpupillage->disability_status) == '1' ? '' : 'display:none;' }}">
                <label for="nature_of_disability" class="block text-sm font-medium text-gray-700">Nature of Disability</label>
                <input type="text" name="nature_of_disability" id="nature_of_disability"
                    value="{{ old('nature_of_disability', $postpupillage->nature_of_disability) }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                @error('nature_of_disability')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            

            <!-- Deployment Region -->
            <div>
                <label for="deployment_region" class="block text-sm font-medium text-gray-700">Deployment Region</label>
                <select name="deployment_region" id="deployment_region"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                    required>
                    <option value="">Select Region</option>
                    <option value="Nakuru" {{ old('deployment_region', $postpupillage->deployment_region) == 'Nakuru' ? 'selected' : '' }}>Nakuru</option>
                    <option value="Kisii" {{ old('deployment_region', $postpupillage->deployment_region) == 'Kisii' ? 'selected' : '' }}>Kisii</option>
                    <option value="Mombasa" {{ old('deployment_region', $postpupillage->deployment_region) == 'Mombasa' ? 'selected' : '' }}>Mombasa</option>
                    <option value="Kisumu" {{ old('deployment_region', $postpupillage->deployment_region) == 'Kisumu' ? 'selected' : '' }}>Kisumu</option>
                    <option value="Kericho" {{ old('deployment_region', $postpupillage->deployment_region) == 'Kericho' ? 'selected' : '' }}>Kericho</option>
                    <option value="Embu" {{ old('deployment_region', $postpupillage->deployment_region) == 'Embu' ? 'selected' : '' }}>Embu</option>
                    <option value="Nyeri" {{ old('deployment_region', $postpupillage->deployment_region) == 'Nyeri' ? 'selected' : '' }}>Nyeri</option>
                    <option value="Kakamega" {{ old('deployment_region', $postpupillage->deployment_region) == 'Kakamega' ? 'selected' : '' }}>Kakamega</option>
                    <option value="Malindi" {{ old('deployment_region', $postpupillage->deployment_region) == 'Malindi' ? 'selected' : '' }}>Malindi</option>
                    <option value="Eldoret" {{ old('deployment_region', $postpupillage->deployment_region) == 'Eldoret' ? 'selected' : '' }}>Eldoret</option>
                    <option value="Meru" {{ old('deployment_region', $postpupillage->deployment_region) == 'Meru' ? 'selected' : '' }}>Meru</option>
                    <option value="Garissa" {{ old('deployment_region', $postpupillage->deployment_region) == 'Garissa' ? 'selected' : '' }}>Garissa</option>
                    <option value="Machakos" {{ old('deployment_region', $postpupillage->deployment_region) == 'Machakos' ? 'selected' : '' }}>Machakos</option>
                    <option value="Other" {{ old('deployment_region', $postpupillage->deployment_region) == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
                @error('deployment_region')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Declaration/Signature Checkbox -->
            <div>
                <label class="block text-sm font-medium text-gray-700">
                    <input type="checkbox" name="declaration" id="declaration" value="1"
                        {{ old('declaration', $postpupillage->declaration) ? 'checked' : '' }} required>
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
                    Update
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

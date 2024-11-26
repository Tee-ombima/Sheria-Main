<!-- resources/views/admin/pupillages/show.blade.php -->
<x-layout>
    <x-card class="p-10 max-w-full mx-auto mt-24 bg-white rounded-lg shadow-lg">
    <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 bg-gray-500 text-white font-semibold text-sm rounded-lg hover:bg-gray-700">
            ← Back
        </a>

        <h1 class="text-3xl font-bold mb-6">Pupillage Application Details</h1>

        <div class="bg-white shadow-md rounded-lg mb-6">
            <div class="p-4">
                <!-- Personal Details -->
                <h2 class="text-2xl font-bold mb-4">Personal Details</h2>
                <p><strong>Full Name:</strong> {{ $pupillage->full_name }}</p>
                <p><strong>Date of Birth:</strong> {{ $pupillage->date_of_birth }}</p>
                <p><strong>Identity Card Number:</strong> {{ $pupillage->identity_card_number }}</p>
                <p><strong>Gender:</strong> {{ $pupillage->gender }}</p>
                <p><strong>Nationality:</strong> {{ $pupillage->nationality }}</p>
                <p><strong>Ethnicity:</strong> {{ $pupillage->ethnicity }}</p>
                <p><strong>Home County:</strong> {{ $pupillage->home_county }}</p>
                <p><strong>Sub County:</strong> {{ $pupillage->sub_county }}</p>
                <p><strong>Disability Status:</strong> {{ $pupillage->disability_status ? 'Yes' : 'No' }}</p>
                @if($pupillage->disability_status)
                    <p><strong>Nature of Disability:</strong> {{ $pupillage->nature_of_disability }}</p>
                @endif

                <!-- Contact Details -->
                <h2 class="text-2xl font-bold mb-4 mt-6">Contact Details</h2>
                <p><strong>Postal Address:</strong> {{ $pupillage->postal_address }}</p>
                <p><strong>Postal Code:</strong> {{ $pupillage->postal_code }}</p>
                <p><strong>Town:</strong> {{ $pupillage->town }}</p>
                <p><strong>Physical Address:</strong> {{ $pupillage->physical_address }}</p>
                <p><strong>Mobile Number:</strong> {{ $pupillage->mobile_number }}</p>
                @if($pupillage->alternate_mobile_number)
                    <p><strong>Alternate Mobile Number:</strong> {{ $pupillage->alternate_mobile_number }}</p>
                @endif
                <p><strong>Email Address:</strong> {{ $pupillage->email_address }}</p>

                <!-- Academic Qualification -->
                <h2 class="text-2xl font-bold mb-4 mt-6">Academic Qualification</h2>
                <p><strong>KSCE Grade:</strong> {{ $pupillage->ksce_grade }}</p>
                <p><strong>Institution Name:</strong> {{ $pupillage->institution_name }}</p>
                <p><strong>Institution Grade:</strong> {{ $pupillage->institution_grade }}</p>

                <!-- Declaration -->
                <h2 class="text-2xl font-bold mb-4 mt-6">Declaration</h2>
                <p><strong>Declaration:</strong> {{ $pupillage->declaration ? 'Agreed' : 'Not Agreed' }}</p>

                <!-- Status and Remarks -->
                <h2 class="text-2xl font-bold mb-4 mt-6">Application Status</h2>
                <p><strong>Status:</strong> {{ $pupillage->status }}</p>
                @if($pupillage->remarks)
                    <p><strong>Remarks:</strong> {{ $pupillage->remarks }}</p>
                @endif

                <!-- View Department Button -->
                @if($pupillage->department)
                    <div class="mt-6">
                        <a href="{{ route('admin.departments.show', $pupillage->department->id) }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                            View Department
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Form to Update Application -->
        <div class="bg-white shadow-md rounded-lg mb-6">
            <div class="p-4">
                <form action="{{ route('admin.admin.pupillages.update', $pupillage->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700">Application Status</label>
                        <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="Pending" @if($pupillage->status == 'Pending') selected @endif>Pending</option>
                            <option value="Accepted" @if($pupillage->status == 'Accepted') selected @endif>Accepted</option>
                            <option value="Not_Successful" @if($pupillage->status == 'Not_Successful') selected @endif>Not Successful</option>
                            <option value="Removed" @if($pupillage->status == 'Removed') selected @endif>Removed</option>
                        </select>
                    </div>
                    
                    
                    <div class="flex justify-end">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                            Update Application
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </x-card>
</x-layout>

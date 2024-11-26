<!-- resources/views/post_pupillages/show.blade.php -->
<x-layout>
    <x-card class="p-10 max-w-full mx-auto mt-24 bg-white rounded-lg shadow-lg">
    <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 bg-gray-500 text-white font-semibold text-sm rounded-lg hover:bg-gray-700">
            ← Back
        </a>
        <h1 class="text-3xl font-bold mb-6">Post Pupillage Application Details</h1>

        <div class="bg-white shadow-md rounded-lg mb-6">
            <div class="p-4">
                <!-- Personal Details -->
                <h2 class="text-2xl font-bold mb-4">Personal Details</h2>
                <p><strong>Vacancy No:</strong> {{ $postpupillage->vacancy_no }}</p>
                <p><strong>Full Name:</strong> {{ $postpupillage->full_name }}</p>
                <p><strong>Date of Birth:</strong> {{ $postpupillage->date_of_birth }}</p>
                <p><strong>Identity Card Number:</strong> {{ $postpupillage->identity_card_number }}</p>
                <p><strong>Gender:</strong> {{ $postpupillage->gender }}</p>
                <p><strong>KRA PIN:</strong> {{ $postpupillage->kra_pin }}</p>
                <p><strong>NHIF/SHIF Card No:</strong> {{ $postpupillage->nhif_card_number }}</p>
                <p><strong>Home County:</strong> {{ $postpupillage->home_county }}</p>
                <p><strong>Sub County:</strong> {{ $postpupillage->sub_county }}</p>
                <p><strong>Ethnicity:</strong> {{ $postpupillage->ethnicity }}</p>
                <p><strong>Disability Status:</strong> {{ $postpupillage->disability_status ? 'Yes' : 'No' }}</p>
                @if($postpupillage->disability_status)
                    <p><strong>Nature of Disability:</strong> {{ $postpupillage->nature_of_disability }}</p>
                @endif

                <!-- Contact Details -->
                <h2 class="text-2xl font-bold mb-4 mt-6">Contact Details</h2>
                <p><strong>Postal Address:</strong> {{ $postpupillage->postal_address }}</p>
                <p><strong>Postal Code:</strong> {{ $postpupillage->postal_code }}</p>
                <p><strong>Town:</strong> {{ $postpupillage->town }}</p>
                <p><strong>Email Address:</strong> {{ $postpupillage->email_address }}</p>
                <p><strong>Mobile Number:</strong> {{ $postpupillage->mobile_number }}</p>

                
                <!-- Deployment Region -->
                <h2 class="text-2xl font-bold mb-4 mt-6">Deployment Region</h2>
                <p>{{ $postpupillage->deployment_region }}</p>

                <!-- Declaration -->
                <h2 class="text-2xl font-bold mb-4 mt-6">Declaration</h2>
                <p>{{ $postpupillage->declaration ? 'Applicant has declared that the information provided is true and correct.' : 'Declaration not provided.' }}</p>

                <!-- Status and Remarks -->
                <h2 class="text-2xl font-bold mb-4 mt-6">Application Status</h2>
                <p><strong>Status:</strong> {{ $postpupillage->status }}</p>
                @if($postpupillage->remarks)
                    <p><strong>Remarks:</strong> {{ $postpupillage->remarks }}</p>
                @endif
            </div>
        </div>

        <!-- Form to Update Application (For Admin) -->
@if(Auth::check() && Auth::user()->role === 'admin')
            <div class="bg-white shadow-md rounded-lg mb-6">
                <div class="p-4">
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

                    <form action="{{ route('admin.admin.postPupillages.update', $postpupillage->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700">Application Status</label>
                            <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="Pending" @if($postpupillage->status == 'Pending') selected @endif>Pending</option>
                                <option value="Accepted" @if($postpupillage->status == 'Accepted') selected @endif>Accepted</option>
                                <option value="Not_Successful" @if($postpupillage->status == 'Not_Successful') selected @endif>Not Successful</option>
                                <option value="Removed" @if($postpupillage->status == 'Removed') selected @endif>Removed</option>
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
        @endif
    </x-card>
</x-layout>

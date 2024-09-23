<x-layout>
  <x-card class="p-10 mx-auto mt-24">
    <div class="text-center my-4">
    <h1 class="text-3xl font-bold">Professional Qualifications
    <span class="{{ $profInfoSubmitted ? 'submitted' : 'not-submitted' }}">
            {{ $profInfoSubmitted ? 'Submitted' : 'Not Submitted' }}
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
    <form action="{{ route('add.profrow') }}" method="POST" id="profInfoForm">
        @csrf
        <!-- Institution Name -->
        <div class="flex space-x-4">
            
            <div class="flex-1">
    <label for="prof_institution_name" class="block text-sm font-medium text-gray-700">Institution Name<span class="text-red-500">*</span></label>
    <input 
        type="text" 
        name="prof_institution_name" 
        id="prof_institution_name" 
        maxlength="100" 
        required 
        value="{{ old('prof_institution_name') }}"
        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    @error('prof_institution_name')
        <span class="text-red-500 text-xs">{{ $message }}</span>
    @enderror
</div>
            <div class="flex-1">
                <label for="prof_student_admission_no" class="block text-sm font-medium text-gray-700">Student Admission No (optional):</label>
                <input type="text" value="{{ old('prof_student_admission_no')}}" name="prof_student_admission_no" id="prof_student_admission_no" maxlength="100" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
        </div>

        <!-- Area of Study and High School Level -->
        <div class="flex space-x-4">
            <div class="flex-1">
    <label for="prof_area_of_study_high_school_level" class="block text-sm font-medium text-gray-700">Area of Study:<span class="text-red-500">*</span></label>
    <select 
        name="prof_area_of_study_high_school_level" 
        id="prof_area_of_study_high_school_level" 
        required 
        class="mt-1 block w-full py-2 px-4 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        <option value="" disabled selected>Select Area of Study</option>
        @foreach($prof_area_of_study_high_school_levels as $prof_area_of_study_high_school_level)
            <option value="{{ $prof_area_of_study_high_school_level->name }}" {{ old('prof_area_of_study_high_school_level') == $prof_area_of_study_high_school_level->name ? 'selected' : '' }}>{{ $prof_area_of_study_high_school_level->name }}</option>
        @endforeach
    </select>

    @error('prof_area_of_study_high_school_level')
        <span class="text-red-500 text-xs">{{ $message }}</span>
    @enderror
</div>
        </div>

        <!-- Area of Specialisation -->
        <div class="flex space-x-4">
            <div class="flex-1">
    <label for="prof_area_of_specialisation" class="block text-sm font-medium text-gray-700">Area of Specialisation:<span class="text-red-500">*</span></label>
    <select 
        name="prof_area_of_specialisation" 
        id="prof_area_of_specialisation" 
        required 
        class="mt-1 block w-full py-2 px-4 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        <option value="" disabled selected>Select Area of Specialisation</option>
        @foreach($prof_area_of_specialisations as $prof_area_of_specialisation)
            <option value="{{ $prof_area_of_specialisation->name }}" {{ old('prof_area_of_specialisation') == $prof_area_of_specialisation->name ? 'selected' : '' }}>{{ $prof_area_of_specialisation->name }}</option>
        @endforeach
    </select>

    @error('prof_area_of_specialisation')
        <span class="text-red-500 text-xs">{{ $message }}</span>
    @enderror
</div>

        </div>

        

        <!-- Course -->
        <div class="flex space-x-4">
            <div class="flex-1">
        <label for="prof_course" class="block text-sm font-medium text-gray-700">Course:</label>
        <input 
            type="text" 
            name="prof_course" 
            id="prof_course" 
            maxlength="100" 
            
            class="mt-1 block w-full py-2 px-4 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
            value="{{ old('prof_course') }}">
        
        @error('prof_course')
            <span class="text-red-500 text-xs">{{ $message }}</span>
        @enderror
    </div>
        </div>

        <!-- Grade -->
        <div class="flex space-x-4">
            <div class="flex-1">
        <label for="prof_award" class="block text-sm font-medium text-gray-700">Professional Award:<span class="text-red-500">*</span></label>
        <select name="prof_award" id="prof_award" required class="mt-1 block w-full py-2 px-4 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <option value="" disabled selected>Select Professional Award</option>
            @foreach($prof_awards as $prof_award)
                <option value="{{ $prof_award->name }}" {{ old('prof_award') == $prof_award->name ? 'selected' : '' }}>{{ $prof_award->name }}</option>
            @endforeach
        </select>
        @error('prof_award')
            <span class="text-red-500 text-xs">{{ $message }}</span>
        @enderror
    </div>
        </div>

        <div class="flex space-x-4">
            <div class="flex-1">
    <label for="prof_grade" class="block text-sm font-medium text-gray-700">Grade:<span class="text-red-500">*</span></label>
    <select 
        name="prof_grade" 
        id="prof_grade" 
        required 
        class="mt-1 block w-full py-2 px-4 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        <option value="" disabled selected>Select Grade</option>
        @foreach($prof_grades as $prof_grade)
            <option value="{{ $prof_grade->name }}" {{ old('prof_grade') == $prof_grade->name ? 'selected' : '' }}>{{ $prof_grade->name }}</option>
        @endforeach
    </select>

    @error('prof_grade')
        <span class="text-red-500 text-xs">{{ $message }}</span>
    @enderror
</div>
</div>

        <!-- Certificate No. -->
        <div class="flex space-x-4">
            <div class="flex-1">
                <label for="prof_certificate_no" class="block text-sm font-medium text-gray-700">Certificate No.:</label>
                <input type="text" name="prof_certificate_no" id="prof_certificate_no" maxlength="100" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
        </div>

        <!-- Start Date and End Date -->
        <div class="flex space-x-4">
            <div class="flex-1">
                <label for="prof_start_date" class="block text-sm font-medium text-gray-700">Start Date:<span class="text-red-500">*</span></label>
                <input type="date" required name="prof_start_date" id="prof_start_date" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div class="flex-1">
                <label for="prof_end_date" class="block text-sm font-medium text-gray-700">End Date:<span class="text-red-500">*</span></label>
                <input type="date" required name="prof_end_date" id="prof_end_date" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            
        </div>

        <div class="flex space-x-4">
<button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">Update</button>
    </div>
            
    </form>
      

<!-- Display entered data in a table -->
<table id="prof-info-table" class="table table-bordered">
        <thead>
            <tr>
                <th>Institution Name</th>
                <th>Student Admission No</th>
                <th>High School</th>
                <th>Specialisation</th>
                <th>Course</th>
                <th>Award</th>
                <th>Grade</th>
                <th>Certificate No</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach (session('rows', []) as $index => $row)
                <tr data-index="{{ $index }}">
                    <td>{{ $row['prof_institution_name'] }}</td>
                    <td>{{ $row['prof_student_admission_no'] }}</td>
                    <td>{{ $row['prof_area_of_study_high_school_level'] }}</td>
                    <td>{{ $row['prof_area_of_specialisation'] }}</td>
                    <td>{{ $row['prof_course'] }}</td>
                    <td>{{ $row['prof_award'] }}</td>
                    <td>{{ $row['prof_grade'] }}</td>
                    <td>{{ $row['prof_certificate_no'] }}</td>
                    <td>{{ $row['prof_start_date'] }}</td>
                    <td>{{ $row['prof_end_date'] }}</td>
                    <td>
<button class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 delete-row" data-index="{{ $index }}">
    Delete
</button>
                    </td>
                </tr>
            @endforeach
            @foreach ($profInfos as $datum)
                <tr>
                    <td>{{ $datum->prof_institution_name }}</td>
                    <td>{{ $datum->prof_student_admission_no }}</td>
                    <td>{{ $datum->prof_area_of_study_high_school_level }}</td>
                    <td>{{ $datum->prof_area_of_specialisation }}</td>
                    <td>{{ $datum->prof_course }}</td>
                    <td>{{ $datum->prof_award }}</td>
                    <td>{{ $datum->prof_grade }}</td>
                    <td>{{ $datum->prof_certificate_no }}</td>
                    <td>{{ $datum->prof_start_date }}</td>
                    <td>{{ $datum->prof_end_date }}</td>
                    <td>
                        <form action="{{ route('delete.prof.info', $datum->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
<button type="submit" class="inline-flex justify-center py-2 px-4 border border-red-600 shadow-sm text-sm font-medium rounded-md text-red-600 bg-white hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
    Delete
</button>

                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

<form id="prof-info-form" action="{{ route('profile.save-prof-info') }}" method="POST">
        @csrf
<div class="flex justify-center"> <!-- This div will center the button -->
    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 " >
        Save
    </button>
</div>    
</form>
    
</x-card>
</x-layout>
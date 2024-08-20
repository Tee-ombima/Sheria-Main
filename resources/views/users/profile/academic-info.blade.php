<x-layout>
  <x-card class="p-10 mx-auto mt-24">
<!-- resources/views/users/profile.blade.php -->

    <div class="text-center my-4">
    <h1 class="text-3xl font-bold">Academic Info
    <span class="{{ $academicInfoSubmitted ? 'submitted' : 'not-submitted' }}">
            {{ $academicInfoSubmitted ? 'Submitted' : 'Not Submitted' }}
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
    <form action="{{ route('add.row') }}" method="POST" id="academicInfoForm">
        @csrf
        
<div class="flex space-x-4">
    <!-- Institution Name Field -->
<div class="flex-1">
    <label for="institution_name" class="block text-sm font-medium text-gray-700">Institution Name<span class="text-red-500">*</span></label>
    <input 
        type="text" 
        name="institution_name" 
        id="institution_name" 
        maxlength="100" 
        required 
        value="{{ old('institution_name') }}"
        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    @error('institution_name')
        <span class="text-red-500 text-xs">{{ $message }}</span>
    @enderror
</div>

</div>

<!-- Student Admission No (Optional) -->
<div class="flex space-x-4">
    <!-- Student Admission No Field -->
<div class="flex-1">
    <label for="student_admission_no" class="block text-sm font-medium text-gray-700">Student Admission No<span class="text-gray-500"> (optional)</span>:</label>
    <input 
        type="text" 
        name="student_admission_no" 
        id="student_admission_no" 
        maxlength="100" 
        value="{{ old('student_admission_no') }}"
        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    @error('student_admission_no')
        <span class="text-red-500 text-xs">{{ $message }}</span>
    @enderror
</div>

</div>

<!-- Area of Study and High School Level -->
<div class="flex space-x-4">
    
    <div class="flex-1">
    <label for="highschool" class="block text-sm font-medium text-gray-700">Area of Study:<span class="text-red-500">*</span></label>
    <select 
        name="highschool" 
        id="highschool" 
        required 
        class="mt-1 block w-full py-2 px-4 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        <option value=""disabled selected>Select Area of Study</option>
        @foreach($highschools as $highschool)
            <option value="{{ $highschool->name }}" {{ old('highschool') == $highschool->name ? 'selected' : '' }}>{{ $highschool->name }}</option>
        @endforeach
    </select>

    @error('highschool')
        <span class="text-red-500 text-xs">{{ $message }}</span>
    @enderror
</div>
</div>

<!-- Area of Specialisation -->
<div class="flex space-x-4">
    <!-- Area of Specialisation Field -->
<div class="flex-1">
    <label for="specialisation" class="block text-sm font-medium text-gray-700">Specialisation:<span class="text-red-500">*</span></label>
    <select 
        name="specialisation" 
        id="specialisation" 
        required 
        class="mt-1 block w-full py-2 px-4 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        <option value="" disabled selected>Select Specialisation</option>
        @foreach($specialisations as $specialisation)
            <option value="{{ $specialisation->name }}" {{ old('specialisation') == $specialisation->name ? 'selected' : '' }}>{{ $specialisation->name }}</option>
        @endforeach
    </select>

    @error('specialisation')
        <span class="text-red-500 text-xs">{{ $message }}</span>
    @enderror
</div>

</div>



<!-- Course -->
<div class="flex space-x-4">
    <!-- Course Field -->
<div class="flex-1">
    <label for="course" class="block text-sm font-medium text-gray-700">Course:<span class="text-red-500">*</span></label>
    <select 
        name="course" 
        id="course" 
        required 
        class="mt-1 block w-full py-2 px-4 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        <option value="" disabled selected>Select Course</option>
        @foreach($courses as $course)
            <option value="{{ $course->name }}" {{ old('course') == $course->name ? 'selected' : '' }}>{{ $course->name }}</option>
        @endforeach
    </select>

    @error('course')
        <span class="text-red-500 text-xs">{{ $message }}</span>
    @enderror
</div>

</div>
<!-- Award -->
<div class="flex space-x-4">
    <!-- Award Field -->
<div class="flex-1">
    <label for="award" class="block text-sm font-medium text-gray-700">Award:<span class="text-red-500">*</span></label>
    <select 
        name="award" 
        id="award" 
        required 
        class="mt-1 block w-full py-2 px-4 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        <option value="" disabled selected>Select Award</option>
        @foreach($awards as $award)
            <option value="{{ $award->name }}" {{ old('award') == $award->name ? 'selected' : '' }}>{{ $award->name }}</option>
        @endforeach
    </select>

    @error('award')
        <span class="text-red-500 text-xs">{{ $message }}</span>
    @enderror
</div>

</div>

<!-- Grade -->
<div class="flex space-x-4">
    <!-- Grade Field -->
<div class="flex-1">
    <label for="grade" class="block text-sm font-medium text-gray-700">Grade:<span class="text-red-500">*</span></label>
    <select 
        name="grade" 
        id="grade" 
        required 
        class="mt-1 block w-full py-2 px-4 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        <option value="" disabled selected>Select Grade</option>
        @foreach($grades as $grade)
            <option value="{{ $grade->name }}" {{ old('grade') == $grade->name ? 'selected' : '' }}>{{ $grade->name }}</option>
        @endforeach
    </select>

    @error('grade')
        <span class="text-red-500 text-xs">{{ $message }}</span>
    @enderror
</div>

</div>



<!-- Certificate No. -->
<div class="flex space-x-4">
    <div class="flex-1">
        <label for="certificate_no" class="block text-sm font-medium text-gray-700">Certificate No.:</label>
        <input type="text" value="{{ old('certificate_no') }}" name="certificate_no" id="certificate_no" maxlength="100" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" >
    </div>
</div>

<!-- Start Date -->
<div class="flex space-x-4">
    <div class="flex-1">
        <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date:</label>
        <input type="date" value="{{ old('start_date') }}" name="start_date" id="start_date" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" >
    </div>
</div>

<!-- End Date -->
<div class="flex space-x-4">
    <div class="flex-1">
        <label for="end_date" class="block text-sm font-medium text-gray-700">End Date:</label>
        <input type="date" value="{{ old('end_date') }}" name="end_date" id="end_date" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" >
    </div>
</div>

<!-- Graduation/Completion Date -->
<div class="flex space-x-4">
    <div class="flex-1">
        <label for="graduation_completion_date" class="block text-sm font-medium text-gray-700">Graduation/Completion Date:</label>
        <input type="date" value="{{ old('graduation_completion_date') }}" name="graduation_completion_date" id="graduation_completion_date" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" >
    </div>
</div>

<div class="flex space-x-4">
<button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">Update</button>
    </div>



      
      </form>
      

<!-- Display entered data in a table -->
<table id="academic-info-table" class="table table-bordered">
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
                <th>Graduation/Completion Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach (session('rows', []) as $index => $row)
                <tr data-index="{{ $index }}">
                    <td>{{ $row['institution_name'] }}</td>
                    <td>{{ $row['student_admission_no'] }}</td>
                    <td>{{ $row['highschool'] }}</td>
                    <td>{{ $row['specialisation'] }}</td>
                    <td>{{ $row['course'] }}</td>
                    <td>{{ $row['award'] }}</td>
                    <td>{{ $row['grade'] }}</td>
                    <td>{{ $row['certificate_no'] }}</td>
                    <td>{{ $row['start_date'] }}</td>
                    <td>{{ $row['end_date'] }}</td>
                    <td>{{ $row['graduation_completion_date'] }}</td>
                    <td>
                        <button class="btn btn-danger delete-row" data-index="{{ $index }}">Delete</button>
                    </td>
                </tr>
            @endforeach
            @foreach ($academicInfos as $datum)
                <tr>
                    <td>{{ $datum->institution_name }}</td>
                    <td>{{ $datum->student_admission_no }}</td>
                    <td>{{ $datum->highschool }}</td>
                    <td>{{ $datum->specialisation }}</td>
                    <td>{{ $datum->course }}</td>
                    <td>{{ $datum->award }}</td>
                    <td>{{ $datum->grade }}</td>
                    <td>{{ $datum->certificate_no }}</td>
                    <td>{{ $datum->start_date }}</td>
                    <td>{{ $datum->end_date }}</td>
                    <td>{{ $datum->graduation_completion_date }}</td>
                    <td>
                        <form action="{{ route('delete.academic.info', $datum->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

<form id="academic-info-form" action="{{ route('profile.save-academic-info') }}" method="POST">
        @csrf
        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Save</button>
    </form>
    

</x-card>
</x-layout>
<x-layout>
  <x-card class="p-10 mx-auto mt-24">
<!-- resources/views/users/profile.blade.php -->

    <h2 style="font-weight:bold; text-align:center;">SEMINARS, WORKSHOPS OR SHORT COURSES ATTENDED LASTING NOT LESS THAN ONE (1) WEEK
    <span class="{{ $relevantCoursesSubmitted ? 'submitted' : 'not-submitted' }}">
            {{ $relevantCoursesSubmitted ? 'Submitted' : 'Not Submitted' }}
        </span>

    </h2>
@if ($errors->any())
                <div class="alert alert-danger text-red-500">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
    <form action="{{ route('add.relrow') }}" method="POST" id="relevantCoursesForm">
        @csrf
                <!-- Institution Name -->
<div class="flex space-x-4">
    
    <div class="flex-1">
    <label for="rel_institution_name" class="block text-sm font-medium text-gray-700">
        University/College/Institution <span class="text-red-500">*</span></label>
    <input 
        type="text" 
        name="rel_institution_name" 
        id="rel_institution_name" 
        maxlength="100" 
        required 
        class="mt-1 block w-full py-2 px-4 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
        value="{{ old('rel_institution_name') }}">
</div>
</div>


<!-- Course -->
<div class="flex space-x-4">
    
    <div class="flex-1">
    <label for="rel_course" class="block text-sm font-medium text-gray-700">
        Course: <span class="text-red-500">*</span></label>
    <input 
        type="text" 
        name="rel_course" 
        id="rel_course" 
        maxlength="100" 
        required 
        class="mt-1 block w-full py-2 px-4 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
        value="{{ old('rel_course') }}">
</div>
</div>



<!-- Certificate No. -->
<div class="flex space-x-4">
    
    <div class="flex-1">
    <label for="rel_certificate_no" class="block text-sm font-medium text-gray-700">
        Certificate no: <span class="text-red-500">*</span></label>
    <input 
        type="text" 
        name="rel_certificate_no" 
        id="rel_certificate_no" 
        maxlength="100" 
        required 
        class="mt-1 block w-full py-2 px-4 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
        value="{{ old('rel_certificate_no') }}">
</div>

</div>


<div class="flex space-x-4">
    
    <div class="flex-1">
    <label for="rel_issue_date" class="block text-sm font-medium text-gray-700">
        Date of Certificate Issuance: <span class="text-red-500">*</span></label>
    <input 
        type="date" 
        name="rel_issue_date" 
        id="rel_issue_date" 
        maxlength="100" 
        required 
        class="mt-1 block w-full py-2 px-4 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
        value="{{ old('rel_issue_date') }}">
</div>
    
</div>

<div class="flex space-x-4">
<button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">Update</button>
    </div>
            
    </form>
      

<!-- Display entered data in a table -->
<table id="relevant-courses-table" class="table table-bordered">
        <thead>
            <tr>
                <th>Institution Name</th>
            <th>Course</th>
            <th>Certificate No</th>
            <th>Issue Date</th>
            <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach (session('rows', []) as $index => $row)
                <tr data-index="{{ $index }}">
                    <td>{{ $row['rel_institution_name'] }}</td>
                    <td>{{ $row['rel_course'] }}</td>
                    <td>{{ $row['rel_certificate_no'] }}</td>
                    <td>{{ $row['rel_issue_date'] }}</td>
                    <td>
                        <button class="btn btn-danger delete-row" data-index="{{ $index }}">Delete</button>
                    </td>
                </tr>
            @endforeach
            @foreach ($relevantCourses as $datum)
                <tr>
                    <td>{{ $datum->rel_institution_name }}</td>
                    <td>{{ $datum->rel_course }}</td>
                    <td>{{ $datum->rel_certificate_no }}</td>
                    <td>{{ $datum->rel_issue_date }}</td>
                    <td>
                        <form action="{{ route('delete.rel.info', $datum->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
<form id="relevant-courses-form" action="{{ route('profile.save-relevant-courses') }}" method="POST">
        @csrf
        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Save</button>
    </form>
</x-card>
</x-layout>
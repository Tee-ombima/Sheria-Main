<x-layout>
  <x-card class="p-10 mx-auto mt-24">
<!-- resources/views/users/profile.blade.php -->

    <h2 style="font-weight:bold; text-align:center;">EMPLOYMENT HISTORY WHERE APPLICABLE (Starting with current or most recent)
</h2>
    <form action="{{ route('profile.save-emp-details') }}" method="POST">
        @csrf
        <div class="flex space-x-4">
    <div class="flex-1">
        <label for="position" class="block text-sm font-medium text-gray-700">Designation/Position</label>
        <input type="text" name="position" id="position" maxlength="100" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>
</div>


<!-- Course -->
<div class="flex space-x-4">
    <div class="flex-1">
        <label for="salary" class="block text-sm font-medium text-gray-700">Job Scale/Grade/Gross Monthly Salary(Kshs.)</label>
        <input type="text" name="salary" id="salary" maxlength="100" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" >
    </div>
</div>



<!-- Certificate No. -->
<div class="flex space-x-4">
    <div class="flex-1">
        <label for="ministry" class="block text-sm font-medium text-gray-700">Ministry/State Department/County/Organization:</label>
        <input type="text" name="ministry" id="ministry" maxlength="100" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" >
    </div>
   
</div>
<div class="flex space-x-4">
   
    <div class="flex-1">
        <label for="nature_of_work" class="block text-sm font-medium text-gray-700">Nature of Work/Duties:</label>
        <input type="text" name="nature_of_work" id="nature_of_work" maxlength="100" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" >
    </div>
</div>

<!-- Start Date -->
<div class="flex space-x-4">
    <div class="flex-1">
        <label for="emp_start_date" class="block text-sm font-medium text-gray-700">Start Date:*</label>
        <input type="date" name="emp_start_date" id="emp_start_date" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" >
    </div>
    <div class="flex-1">
        <label for="emp_end_date" class="block text-sm font-medium text-gray-700">End Date:*</label>
        <input type="date" name="emp_end_date" id="emp_end_date" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" >
    </div>
</div>



<!-- Graduation/Completion Date -->
<div class="flex space-x-4">

        <button onclick="updateUserInput('institution_name')" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Update</button>
</div>
<div class="flex space-x-4">

        <!-- Placeholder for displaying user input -->
<div id="userInputDisplay" style="margin-top: 20px;"></div>
</div>


<button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        Next
      </button>
    </form>

</x-card>
</x-layout>
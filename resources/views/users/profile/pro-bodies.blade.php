<x-layout>
  <x-card class="p-10 mx-auto mt-24">
<!-- resources/views/users/profile.blade.php -->

    <h2 style="font-weight:bold; text-align:center;">CURRENT REGISTRATION/MEMBERSHIP TO PROFESSIONAL BODIES
</h2>
    <form action="{{ route('profile.save-pro-bodies') }}" method="POST">
        @csrf
        <!-- Form fields for pro bodies -->
<div class="flex space-x-4">
    <div class="flex-1">
        <label for="professional_body" class="block text-sm font-medium text-gray-700">Professional Body:</label>
        <input type="text" name="professional_body" id="professional_body" maxlength="100" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>
</div>


<!-- Course -->
<div class="flex space-x-4">
    <div class="flex-1">
        <label for="membership_type" class="block text-sm font-medium text-gray-700">Membership type(e.g. Associate,Full etc):</label>
        <input type="text" name="membership_type" id="membership_type" maxlength="100" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" >
    </div>
</div>



<!-- Certificate No. -->
<div class="flex space-x-4">
    <div class="flex-1">
        <label for="membership_num" class="block text-sm font-medium text-gray-700">Membership/Registration Number.:</label>
        <input type="text" name="membership_num" id="membership_num" maxlength="100" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" >
    </div>
</div>

<!-- Start Date -->
<div class="flex space-x-4">
    <div class="flex-1">
        <label for="mem_start_date" class="block text-sm font-medium text-gray-700">Date Renewed:*</label>
        <input type="date" name="mem_start_date" id="mem_start_date" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" >
    </div>
    <div class="flex-1">
        <label for="mem_end_date" class="block text-sm font-medium text-gray-700">Next Renewal Date/Expiry Date:*</label>
        <input type="date" name="mem_end_date" id="mem_end_date" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" >
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
      </button>     </form>

</x-card>
</x-layout>
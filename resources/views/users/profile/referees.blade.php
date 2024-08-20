<x-layout>
  <x-card class="p-10 mx-auto mt-24">
<!-- resources/views/users/profile.blade.php -->

<h2 style="font-weight:bold; text-align:center;">REFEREES (PEOPLE WHO HAVE INTERACTED WITH YOU PROFESSIONALLY)</h2>    <form action="{{ route('profile.save-referees') }}" method="POST">
       

        @csrf
        <!-- Form fields for referees -->
                   <h2>1st REFEREE</h2>

        <div class="flex space-x-4">
    <!-- Surname Field -->
    <div class="flex-1">
        <label for="ref_surname" class="block text-sm font-medium text-gray-700">Full Names:</label>
        <input type="text" name="ref_surname" id="ref_surname" maxlength="100" class="mt-1 block w-full py-2 px-4 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        <span id="charCountSurname" class="text-xs text-gray-500">0 / 100</span>
    </div> 

    <!-- FirstName Field -->
    <div class="flex-1">
        <label for="ref_firstname" class="block text-sm font-medium text-gray-700">Occupation:</label>
        <input type="text" name="ref_firstname" id="ref_firstname" maxlength="100" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        <span id="charCountFirstname" class="text-xs text-gray-500">0 / 100</span>
    </div>
</div>
<div class="flex space-x-4">
   <div class="flex-1">
      <label for="ref_postal_address" class="block text-sm font-medium text-gray-700">Postal Address</label>
      <textarea name="ref_postal_address" id="ref_postal_address" rows="3" maxlength="255" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
    </div>

    <!-- Code Field -->
    <div class="flex-1">
      <label for="ref_code" class="block text-sm font-medium text-gray-700">Postal Code</label>
      <input type="text" name="ref_code" id="ref_code" maxlength="100" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>

    <!-- Town/City Field -->
    <div class="flex-1">
      <label for="ref_town_city" class="block text-sm font-medium text-gray-700">Postal Town/City</label>
      <input type="text" name="ref_town_city" id="ref_town_city" maxlength="100" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>
       </div>




      <!-- Row 2: Date of Birth, IDNo, Krapin, Gender -->
      <div class="flex space-x-4">
    
    <div class="flex-1">
      <label for="ref_mobile" class="block text-sm font-medium text-gray-700">Mobile Number</label>
      <input type="text" name="ref_mobile" id="ref_mobile" maxlength="100" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>

    <div class="flex-1">
      <label for="ref_email_address" class="block text-sm font-medium text-gray-700">Email Address</label>
      <input type="email" name="ref_email_address" id="ref_email_address" maxlength="100" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>

    <div class="flex-1">
        <label for="ref_designation" class="block text-sm font-medium text-gray-700">Period for which the referee has known you:</label>
        <input type="int" name="ref_designation" id="ref_designation" maxlength="100" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="N/A">
    </div>
       </div>

   
  <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        onclick="window.location.href='blades.summary.php';">
    Save
</button>

    </form>

</x-card>
</x-layout>
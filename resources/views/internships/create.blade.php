<!-- resources/views/internships/create.blade.php -->
<x-layout>
    <x-card class="p-10 max-w-lg mx-auto mt-24 bg-white rounded-lg shadow-lg">

        <h1 class="text-3xl font-bold text-center mb-8 text-gray-800">Apply for University/College Attachment</h1>
 <!-- Button to View My Attachments -->
        <div class="flex justify-center mb-4">
            <a href="{{ route('internships.index') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg shadow focus:outline-none focus:ring-2 focus:ring-indigo-500">
                View My Attachment Applications
            </a>
        </div>
        <form action="{{ route('internships.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Department Selection -->
            <div>
                <label for="department" class="block text-sm font-medium text-gray-700">Select Department</label>
                <select name="department_id" id="department" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Full Name -->
            <div>
                <label for="full_name" class="block text-sm font-medium text-gray-700">Full Name</label>
                <input type="text" name="full_name" id="full_name" placeholder="Full Name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <!-- Phone Number -->
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                <input type="text" name="phone" id="phone" placeholder="Phone Number" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <!-- Institution Name -->
            <div>
                <label for="institution" class="block text-sm font-medium text-gray-700">Institution Name</label>
                <input type="text" name="institution" id="institution" placeholder="Institution Name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" placeholder="Email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <!-- File Uploads -->
            <div>
                <label for="id_file" class="block text-sm font-medium text-gray-700">ID File</label>
                <input type="file" name="id_file" id="id_file" accept="application/pdf" class="mt-1 block w-full text-gray-700 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <div>
                <label for="university_letter" class="block text-sm font-medium text-gray-700">University Letter</label>
                <input type="file" name="university_letter" id="university_letter" accept="application/pdf" class="mt-1 block w-full text-gray-700 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <div>
                <label for="kra_pin" class="block text-sm font-medium text-gray-700">KRA PIN</label>
                <input type="file" name="kra_pin" id="kra_pin" accept="application/pdf" class="mt-1 block w-full text-gray-700 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <div>
                <label for="insurance" class="block text-sm font-medium text-gray-700">Insurance</label>
                <input type="file" name="insurance" id="insurance" accept="application/pdf" class="mt-1 block w-full text-gray-700 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg shadow focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    Submit
                </button>
            </div>
        </form>
    </x-card>
</x-layout>

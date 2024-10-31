<!-- resources/views/internships/apply.blade.php -->
<x-layout>
    <x-card class="p-10 max-w-lg mx-auto mt-24">
        <header class="text-center mb-6">
            <h2 class="text-2xl font-bold uppercase">Apply to {{ $department->name }}</h2>
        </header>

        <form method="POST" action="{{ route('internships.store', $department->id) }}" enctype="multipart/form-data">
            @csrf
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
            <div >
                <label for="id_file" class="block text-lg mb-2">ID (PDF)</label>
                <input type="file" name="id_file" required class="border border-gray-200 rounded p-2 w-full">
            </div>

            <div >
                <label for="university_letter" class="block text-lg mb-2">University Letter (PDF)</label>
                <input type="file" name="university_letter" required class="border border-gray-200 rounded p-2 w-full">
            </div>

            <div >
                <label for="kra_pin" class="block text-lg mb-2">Own Application Letter (PDF)</label>
                <input type="file" name="kra_pin" required class="border border-gray-200 rounded p-2 w-full">
            </div>

            <div >
                <label for="insurance" class="block text-lg mb-2">Insurance (PDF)</label>
                <input type="file" name="insurance" required class="border border-gray-200 rounded p-2 w-full">
            </div>

            <div class="mb-6">
                <button type="submit" class="bg-laravel text-white py-2 px-4 rounded hover:bg-black">Submit</button>
            </div>
        </form>
    </x-card>
</x-layout>

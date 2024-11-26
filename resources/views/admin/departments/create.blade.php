<x-layout>
    <x-card class="p-10 max-w-4xl mx-auto mt-24 bg-white rounded-lg shadow-lg">

    <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 bg-gray-500 text-white font-semibold text-sm rounded-lg hover:bg-gray-700">
    ← Back
</a>
        <div class="container mx-auto">
            <h1 class="text-2xl font-bold text-center mb-8 text-gray-700">Create a Department</h1>

            <form action="{{ route('admin.departments.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="form-group">
                    <label for="name" class="block text-gray-700 font-medium mb-2">Department Name</label>
                    <input type="text" name="name" id="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Enter department name" required>
                </div>
                <div class="form-group">
        <label for="email" class="block text-gray-700 font-medium mb-2">Department Email</label>
        <input type="email" name="email" id="email" 
               class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm 
                      focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
               placeholder="Enter department email" required>
    </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-indigo-500 text-white px-6 py-2 rounded-lg shadow hover:bg-indigo-600 transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        Create Department
                    </button>
                </div>
            </form>
        </div>
    </x-card>
</x-layout>

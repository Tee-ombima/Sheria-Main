<x-layout>
  <!-- Main card with creamy background -->
  <x-card class="p-8 max-w-4xl mx-auto mt-24 bg-[#FFF5E6] rounded-lg shadow-lg">
    <!-- Back Button -->
    <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 bg-[#D68C3C] text-white rounded-md hover:bg-[#bf7a2e] transition-colors shadow-sm mb-6">
      <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
      </svg>
      Back
    </a>

    <!-- Header Section -->
    <header class="text-center mb-8">
      <h1 class="text-3xl font-bold text-gray-900">Create a Department</h1>
      <p class="mt-2 text-gray-600">Fill in the details to create a new department.</p>
    </header>

    <!-- Form -->
    <form action="{{ route('admin.departments.store') }}" method="POST" class="space-y-6">
      @csrf

      <!-- Department Name Field -->
      <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Department Name <span class="text-red-500">*</span></label>
        <input type="text" name="name" id="name"
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-white focus:border-[#D68C3C] focus:ring-[#D68C3C]"
          placeholder="Enter department name" 
          required>
        @error('name')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Department Email Field -->
      <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Department Email <span class="text-red-500">*</span></label>
        <input type="email" name="email" id="email"
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-white focus:border-[#D68C3C] focus:ring-[#D68C3C]"
          placeholder="Enter department email" 
          required>
        @error('email')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Submit Button -->
      <div class="flex justify-end">
        <button type="submit" 
                class="px-6 py-2 bg-[#D68C3C] text-white rounded-md hover:bg-[#bf7a2e] transition-colors flex items-center">
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
          </svg>
          Create Department
        </button>
      </div>
    </form>
  </x-card>

  <!-- Loader Script -->
  <script>
    document.querySelector("form").addEventListener("submit", function() {
      const submitBtn = this.querySelector('button[type="submit"]');
      submitBtn.disabled = true;
      submitBtn.innerHTML = `
        <svg class="animate-spin h-5 w-5 mr-2" viewBox="0 0 24 24">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
        </svg>
        Creating...`;
    });
  </script>
</x-layout>
<x-layout>
  <!-- Main card with creamy background -->
  <x-card class="p-8 max-w-3xl mx-auto mt-12 bg-[#FFF5E6] rounded-lg shadow-lg">
    <!-- Back Button -->
    <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 bg-[#D68C3C] text-white rounded-md hover:bg-[#bf7a2e] transition-colors shadow-sm">
      <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
      </svg>
      Back
    </a>

    <!-- Header Section -->
    <header class="text-center mt-6">
      <h2 class="text-3xl font-bold text-gray-900">Create Career Opportunity</h2>
      <p class="mt-2 text-gray-600">Fill in the details to create a new job listing.</p>
    </header>

    <!-- Form with all fields -->
    <form method="POST" action="/listings" enctype="multipart/form-data" class="mt-8 space-y-6">
      @csrf

      <!-- Job Title Field -->
      <div>
        <label for="title" class="block text-sm font-medium text-gray-700">Job Title <span class="text-red-500">*</span></label>
        <input type="text" id="title" name="title"
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-white focus:border-[#D68C3C] focus:ring-[#D68C3C]"
          placeholder="Example: Senior Laravel Developer" 
          value="{{ old('title') }}" 
          required>
        @error('title')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Job Reference Number -->
      <div>
        <label for="job_reference_number" class="block text-sm font-medium text-gray-700">Job Reference Number <span class="text-red-500">*</span></label>
        <input type="text" id="job_reference_number" name="job_reference_number"
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-white focus:border-[#D68C3C] focus:ring-[#D68C3C]"
          placeholder="Example: 2024/CVer/17/14" 
          value="{{ old('job_reference_number') }}" 
          required>
        @error('job_reference_number')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Number of Vacancies -->
      <div>
        <label for="vacancies" class="block text-sm font-medium text-gray-700">Number of Vacancies <span class="text-red-500">*</span></label>
        <input type="number" id="vacancies" name="vacancies"
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-white focus:border-[#D68C3C] focus:ring-[#D68C3C]"
          placeholder="Enter number of vacancies" 
          value="{{ old('vacancies') }}" 
          required>
        @error('vacancies')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Application Deadline -->
      <div>
        <label for="deadline" class="block text-sm font-medium text-gray-700">Application Deadline <span class="text-red-500">*</span></label>
        <input type="datetime-local" id="deadline" name="deadline"
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-white focus:border-[#D68C3C] focus:ring-[#D68C3C]"
          value="{{ old('deadline', isset($listing) ? date('Y-m-d\TH:i', strtotime($listing->deadline)) : '') }}" 
          required>
        @error('deadline')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- File Upload -->
      <div>
        <label for="file" class="block text-sm font-medium text-gray-700">Upload Job Description (PDF) <span class="text-red-500">*</span></label>
        <input type="file" id="file" name="file" accept=".pdf"
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-white focus:border-[#D68C3C] focus:ring-[#D68C3C] file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-[#D68C3C]/10 file:text-[#D68C3C] hover:file:bg-[#D68C3C]/20">
        @error('file')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Submit Section -->
      <div class="flex justify-end space-x-4 pt-8">
        <button type="submit" class="px-6 py-2 bg-[#D68C3C] text-white rounded-md hover:bg-[#bf7a2e] transition-colors flex items-center">
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
          </svg>
          Create Job
        </button>
        <a href="/" class="px-6 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-700 transition-colors">
          Cancel
        </a>
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
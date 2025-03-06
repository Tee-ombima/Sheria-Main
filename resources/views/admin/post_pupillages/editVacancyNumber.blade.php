<x-layout>
  <x-card class="p-8 max-w-3xl mx-auto mt-24 bg-[#FFF5E6] rounded-lg shadow-lg">
    <!-- Back Button -->
    <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 bg-[#D68C3C] text-white rounded-md hover:bg-[#bf7a2e] transition-colors shadow-sm mb-6">
      <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
      </svg>
      Back
    </a>

    <!-- Page Title -->
    <h1 class="text-2xl font-bold mb-6 text-gray-900">Edit Post Pupillage Vacancy Number</h1>

    <!-- Success Message -->
    @if(session('message'))
      <div class="bg-green-500 text-white p-2 mb-4 rounded-md">
        {{ session('message') }}
      </div>
    @endif

    <!-- Form -->
    <form action="{{ route('admin.postPupillages.updateVacancyNumber') }}" method="POST" class="space-y-6">
      @csrf

      <!-- Vacancy Number Input -->
      <div>
        <label for="vacancy_no" class="block text-sm font-medium text-gray-700">Vacancy Number</label>
        <input type="text" name="vacancy_no" id="vacancy_no"
               value="{{ old('vacancy_no', $setting->vacancy_no ?? '') }}"
               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
               required>
        @error('vacancy_no')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Submit Button -->
      <button type="submit" class="inline-flex items-center px-4 py-2 bg-[#D68C3C] text-white rounded-md hover:bg-[#bf7a2e] transition-colors shadow-sm">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
        Update Vacancy Number
      </button>
    </form>
  </x-card>
</x-layout>
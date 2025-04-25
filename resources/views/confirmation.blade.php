<x-layout>
  <!-- Main container with flex centering -->
  <div class="min-h-screen flex items-center justify-center p-4">
    <!-- Card with creamy background -->
    <x-card class="p-8 max-w-6xl mx-auto bg-[#FFF5E6] rounded-lg shadow-lg">
      <!-- Centered success message card -->
      <div class="flex items-center justify-center min-h-[50vh]">
        <div class="bg-white p-8 rounded shadow-md max-w-md w-full text-center">
          <h1 class="text-2xl font-semibold mb-4">Success!</h1>
          <p class="mb-6">{{ $message }}</p>
          <a href="{{ $next_url }}" 
             class="inline-block px-4 py-2 bg-[#D68C3C] text-white rounded hover:bg-[#b56834] transition-colors">
            OK
          </a>
        </div>
      </div>
    </x-card>
  </div>
</x-layout>
<x-layout>
  <!-- Main card with creamy background -->
  <x-card class="p-8 max-w-3xl mx-auto mt-12 bg-[#FFF5E6] rounded-lg shadow-lg">
    <div class="container text-center">
      <!-- Center and bold for the heading -->
      <h1 class="text-3xl font-bold mb-4">403 - Permission Denied</h1>
      <!-- Slightly smaller text, still bold and centered -->
      <p class="text-lg font-semibold">
        {{ $exception->getMessage() }}
      </p>
    </div>
  </x-card>
</x-layout>

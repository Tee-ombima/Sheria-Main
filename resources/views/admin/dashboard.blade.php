<x-layout>
  <!-- Main card with creamy background -->
  <x-card class="p-8 max-w-6xl mx-auto mt-24 bg-[#FFF5E6] rounded-lg shadow-lg">
    <!-- Back Button -->
    <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 bg-[#D68C3C] text-white rounded-md hover:bg-[#bf7a2e] transition-colors shadow-sm mb-6">
      <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
      </svg>
      Back
    </a>

    <!-- Header Section -->
    <header class="text-center mb-8">
      <h2 class="text-3xl font-bold text-gray-900">Program Applications Dashboard</h2>
      <p class="mt-2 text-gray-600">Manage and monitor all program applications from one place.</p>
    </header>

    <!-- Three-column layout for different sections -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <!-- Column 1: Attachee Applications -->
      <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow">
        <h3 class="text-xl font-semibold mb-4 text-gray-800">Attachee Applications</h3>
        <p class="text-gray-600 mb-4">
          View and manage attachee applications, including status updates and department assignments.
        </p>
        <a href="{{ route('admin.internships.index') }}" class="inline-flex items-center px-4 py-2 bg-[#D68C3C] text-white rounded-md hover:bg-[#bf7a2e] transition-colors shadow-sm">
          <i class="fa-solid fa-user-graduate mr-2"></i>
          View Attachee Applications
        </a>
      </div>

      <!-- Column 2: Pupillage Applications -->
      <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow">
        <h3 class="text-xl font-semibold mb-4 text-gray-800">Pupillage Applications</h3>
        <p class="text-gray-600 mb-4">
          Manage pupillage applications, enable/disable submissions, and track applicant progress.
        </p>
        <a href="{{ route('admin.pupillages.index') }}" class="inline-flex items-center px-4 py-2 bg-[#D68C3C] text-white rounded-md hover:bg-[#bf7a2e] transition-colors shadow-sm">
          <i class="fa-solid fa-scale-balanced mr-2"></i>
          View Pupillage Applications
        </a>
      </div>

      <!-- Column 3: Post Pupillage Applications -->
      <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow">
        <h3 class="text-xl font-semibold mb-4 text-gray-800">Post Pupillage Applications</h3>
        <p class="text-gray-600 mb-4">
          Oversee post pupillage applications, update vacancy numbers, and manage submissions.
        </p>
        <a href="{{ route('admin.postPupillages.index') }}" class="inline-flex items-center px-4 py-2 bg-[#D68C3C] text-white rounded-md hover:bg-[#bf7a2e] transition-colors shadow-sm">
          <i class="fa-solid fa-gavel mr-2"></i>
          View Post Pupillage Applications
        </a>
      </div>
    </div>
  </x-card>
</x-layout>
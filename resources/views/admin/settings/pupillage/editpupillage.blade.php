<x-layout>
  <x-card class="p-8 max-w-4xl mx-auto mt-24 bg-[#FFF5E6] rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold mb-6">Pupillage Program Capacity Settings</h1>
    
    <!-- Current Capacity Status -->
    <div class="mb-6 bg-white p-4 rounded-lg shadow-sm">
      <div class="grid grid-cols-2 gap-4">
        <div>
          <p class="text-sm text-gray-600">Maximum Capacity</p>
          <p class="text-lg font-semibold text-[#D68C3C]">
            {{ $settings->max_pupillage_applications }} applications
          </p>
        </div>
        
      </div>
      

    </div>
        <div class="mb-6 bg-white p-4 rounded-lg shadow-sm">
              <div class="grid grid-cols-2 gap-4">

        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
          {{ $settings->pupillage_applications_enabled ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
        Applications are {{ $settings->pupillage_applications_enabled ? 'Enabled' : 'Disabled' }}
    </span>

    <form action="{{ route('admin.pupillages.toggleApply') }}" method="POST">
        @csrf
        <button type="submit" 
                class="px-4 py-2 {{ $settings->pupillage_applications_enabled ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }} 
                text-white rounded-md transition-colors shadow-sm flex items-center space-x-2">
            <i class="fa-solid fa-toggle-{{ $settings->pupillage_applications_enabled ? 'on' : 'off' }}"></i>
            <span>{{ $settings->pupillage_applications_enabled ? 'Disable' : 'Enable' }} </span>
        </button>
    </form>
              </div>
        </div>

    <!-- Capacity Update Form -->
    <form action="{{ route('admin.pupillage.update') }}" method="POST" class="mb-6">
      @csrf
      @method('PUT')

      <div class="mb-4">
        <label class="block mb-2 text-sm font-medium text-gray-900">
          New Maximum Capacity
        </label>
        <input type="number" name="max_pupillage_applications" 
              value="{{ old('max_pupillage_applications', $settings->max_pupillage_applications) }}"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#D68C3C] focus:border-[#D68C3C] block w-full p-2.5">
      </div>

      <button type="submit" 
              class="px-4 py-2 bg-[#D68C3C] text-white rounded-md hover:bg-[#bf7a2e] transition-colors shadow-sm">
        Update Capacity
      </button>
    </form>

    <!-- Toggle Applications Form -->
    
  </x-card>
</x-layout>
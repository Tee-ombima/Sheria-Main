@props(['listing'])

<div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
  <div class="p-6">
    <div class="flex items-start justify-between">
      <div class="flex-1">
        <h3 class="text-xl font-semibold text-gray-900 mb-2">
          <a href="/listings/{{$listing->id}}" class="hover:text-[#D68C3C] transition-colors duration-200">
            {{ $listing->title }}
          </a>
        </h3>
        
        <div class="mt-2 flex items-center text-sm text-gray-500">
          <svg class="flex-shrink-0 mr-2 h-5 w-5 text-[#3a4f29]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
          </svg>
          <span>Reference: {{ $listing->job_reference_number }}</span>
        </div>

        @if($listing->deadline)
        <div class="mt-2 flex items-center text-sm text-gray-500">
          <svg class="flex-shrink-0 mr-2 h-5 w-5 text-[#3a4f29]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
          </svg>
          <span>Deadline: {{ \Carbon\Carbon::parse($listing->deadline)->format('M j, Y') }}</span>
        </div>
        @endif
      </div>

      <div class="ml-4 flex-shrink-0">
        <div class="px-3 py-1 text-sm font-medium rounded-full {{ $listing->isActive ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
          {{ $listing->isActive ? 'Active' : 'Closed' }}
        </div>
      </div>
    </div>

    <div class="mt-4 flex items-center justify-between">
      <div class="bg-[#D68C3C] text-white px-4 py-2 rounded-md text-sm font-medium">
        Vacancies: {{ $listing->vacancies }}
      </div>
      <a href="/listings/{{$listing->id}}" class="flex items-center text-[#3a4f29] hover:text-[#D68C3C] transition-colors duration-200">
        <span class="mr-2">View Details</span>
        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
        </svg>
      </a>
    </div>
  </div>
</div>
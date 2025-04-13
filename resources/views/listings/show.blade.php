<x-layout>
  <div class="container mx-auto px-4 py-8">
    <!-- Back Button -->
    <a href="{{ url()->previous() }}" class="mb-6 inline-flex items-center text-[#3a4f29] hover:text-[#D68C3C] transition-colors">
      <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
      </svg>
      Back to Opportunities
    </a>

    <x-card class="relative">
      <!-- Status Ribbon -->
      @if($listing->isActive)
      <div class="absolute top-0 right-0 bg-[#D68C3C] text-white px-4 py-2 rounded-bl-lg">
        Active Opportunity
      </div>
      @else
      <div class="absolute top-0 right-0 bg-red-600 text-white px-4 py-2 rounded-bl-lg">
        Closed Opportunity
      </div>
      @endif

      <div class="space-y-6">
        <!-- Header Section -->
        <div class="text-center border-b border-gray-200 pb-6">
          <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $listing->title }}</h1>
          <div class="text-xl text-[#3a4f29] font-medium mb-4">
            Reference: {{ $listing->job_reference_number }}
          </div>
          
          <!-- Vacancies & Deadline -->
          <div class="flex flex-wrap justify-center gap-4 mb-6">
            <div class="bg-[#D68C3C] text-white px-4 py-2 rounded-md">
              Vacancies: {{ $listing->vacancies }}
            </div>
            @if($listing->deadline)
            <div class="bg-[#3a4f29] text-white px-4 py-2 rounded-md">
              Deadline: {{ \Carbon\Carbon::parse($listing->deadline)->isoFormat('MMMM Do, YYYY [at] h:mm A') }}
            </div>
            @endif
          </div>

          <!-- Countdown Timer -->
          @if($listing->isActive)
          <div id="countdown" class="bg-gray-100 p-4 rounded-lg">
            <div class="flex justify-center gap-4 text-center">
              <div class="countdown-item">
                <div id="days" class="text-2xl font-bold text-[#D68C3C]">00</div>
                <div class="text-sm text-gray-600">Days</div>
              </div>
              <div class="countdown-item">
                <div id="hours" class="text-2xl font-bold text-[#D68C3C]">00</div>
                <div class="text-sm text-gray-600">Hours</div>
              </div>
              <div class="countdown-item">
                <div id="minutes" class="text-2xl font-bold text-[#D68C3C]">00</div>
                <div class="text-sm text-gray-600">Minutes</div>
              </div>
              <div class="countdown-item">
                <div id="seconds" class="text-2xl font-bold text-[#D68C3C]">00</div>
                <div class="text-sm text-gray-600">Seconds</div>
              </div>
            </div>
          </div>
          @endif
        </div>

        <!-- Documents Section -->
        @if($listing->file)
        <div class="bg-gray-50 p-6 rounded-lg">
          <h2 class="text-xl font-semibold text-[#3a4f29] mb-4">Application Documents</h2>
          <div class="flex items-center space-x-4">
            <a href="{{ asset('storage/' . $listing->file) }}" 
               class="flex items-center bg-white px-6 py-3 rounded-lg shadow-sm hover:shadow-md transition-shadow"
               download>
              <svg class="w-6 h-6 mr-2 text-[#D68C3C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
              </svg>
              <span class="font-medium">Download Job Description</span>
            </a>
          </div>
        </div>
        @endif

        <!-- Application Section -->
        <div class="space-y-4">
          @if (session('error'))
          <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
            {{ session('error') }}
          </div>
          @endif

          @if (session('message'))
          <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
            {{ session('message') }}
          </div>
          @endif

          @auth
            @if(auth()->user()->role !== 'admin')
              @if($listing->isActive)
              <form id="applyForm" method="POST" action="/listings/{{ $listing->id }}/apply" class="text-center">
                @csrf
                <button type="submit" id="applyButton" 
                        class="inline-flex items-center px-8 py-3 bg-[#3a4f29] text-white rounded-lg hover:bg-[#2d3f1f] transition-colors">
                  <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                  Submit Application
                </button>
              </form>
              @else
              <div class="text-center p-6 bg-gray-100 rounded-lg">
                <p class="text-red-600 font-medium">
                  <svg class="w-6 h-6 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                  </svg>
                  This position is no longer accepting applications
                </p>
              </div>
              @endif
            @endif
          @endauth
        </div>

        <!-- Admin Controls -->
        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'superadmin')
        <div class="mt-8 pt-6 border-t border-gray-200">
          <div class="flex flex-wrap gap-4 justify-center">
            <a href="/listings/{{$listing->id}}/edit" 
               class="flex items-center px-4 py-2 bg-blue-100 text-blue-800 rounded-lg hover:bg-blue-200">
              <i class="fa-solid fa-pencil mr-2"></i>
              Edit Listing
            </a>
            <a href="{{ route('admin.show', $listing->id) }}" 
   class="flex items-center px-4 py-2 bg-purple-100 text-purple-800 rounded-lg hover:bg-purple-200 transition-colors duration-200">
  <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
  </svg>
  Manage Applicants
</a>

            <form id="deleteForm" method="POST" action="/listings/{{$listing->id}}">
              @csrf
              @method('DELETE')
              <button type="button" 
                      onclick="confirmDelete()"
                      class="flex items-center px-4 py-2 bg-red-100 text-red-800 rounded-lg hover:bg-red-200">
                <i class="fa-solid fa-trash mr-2"></i>
                Delete Listing
              </button>
            </form>

            
          </div>
        </div>
        @endif
      </div>
    </x-card>
  </div>

  <script>
  // Enhanced Countdown Timer
  @if($listing->isActive)
  function updateTimer() {
    const countDownDate = new Date("{{ $listing->deadline }}").getTime();
    const now = new Date().getTime();
    const distance = countDownDate - now;

    if (distance < 0) {
      clearInterval(timerInterval);
      document.getElementById('countdown').innerHTML = `
        <div class="text-center text-red-600 font-medium">
          Application deadline has passed
        </div>`;
      if (document.getElementById('applyButton')) {
        document.getElementById('applyButton').disabled = true;
        document.getElementById('applyButton').innerHTML = `
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4"></path>
          </svg>
          Applications Closed`;
        document.getElementById('applyButton').classList.replace('bg-[#3a4f29]', 'bg-gray-500');
      }
      return;
    }

    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

    document.getElementById('days').textContent = days.toString().padStart(2, '0');
    document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
    document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
    document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');
  }

  const timerInterval = setInterval(updateTimer, 1000);
  updateTimer(); // Initial call
  @endif

  // Delete Confirmation
  function confirmDelete() {
    if (confirm('Are you sure you want to permanently delete this listing?')) {
      document.getElementById('deleteForm').submit();
    }
  }

  // Loading State
  document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function() {
      const loader = document.createElement('div');
      loader.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
      loader.innerHTML = `
        <div class="bg-white p-6 rounded-lg flex items-center">
          <svg class="animate-spin h-8 w-8 text-[#D68C3C]" viewBox="0 0 24 24">
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
          </svg>
          <span class="ml-3 text-lg">Processing...</span>
        </div>`;
      document.body.appendChild(loader);
    });
  });
  </script>
</x-layout>
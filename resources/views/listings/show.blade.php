<x-layout>
  <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 bg-gray-500 text-white font-semibold text-sm rounded-lg hover:bg-gray-700">
            ← Back
        </a>
  
  <div class="mx-4">
    <x-card class="p-10">
      <div class="flex flex-col items-center justify-center text-center">


@if($listing->isActive)
    <!-- Display Countdown Timer -->
    <p id="countdown" class="text-sm text-red-500 font-bold"></p>
@else
    <!-- Listing has expired or is archived -->
    <p class="text-red-500">This job is no longer available.</p>
@endif
        
        <h3 class="text-2xl mb-2">
          {{$listing->title}}
        </h3>

        




        <div class="text-xl font-bold mb-4">{{$listing->job_reference_number}}</div>



        <div class="flex items-center justify-center rounded-xl py-1 px-3 mr-2 text-xs" style="background-color: #D68C3C; color: #FFFFFF;">
        Number of vacancies available: {{ $listing->vacancies }}
      </div>


        <div class="border border-gray-200 w-full mb-6"></div>
        @if($listing->file)
    <div class="mb-6">
        <label class="inline-block text-lg mb-2">Job Description</label>
        <a href="{{ asset('storage/' . $listing->file) }}" target="_blank" class="text-blue-500 underline">
            Download Job Description (PDF)
        </a>
    </div>
@endif


        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        @auth
    @if(auth()->user()->role !== 'admin')
        <form id="applyForm" method="POST" action="/listings/{{ $listing->id }}/apply">
            @csrf
            <button type="submit" class="block bg-green-500 text-white mt-6 py-2 rounded-xl hover:opacity-80">
                Apply for this job
            </button>
        </form>
    @endif
@endauth

      </div>
    </x-card>

    @if(auth()->user()->role === 'admin')
      <x-card class="mt-4 p-2 flex space-x-6">
        <a href="/listings/{{$listing->id}}/edit">
            <i class="fa-solid fa-pencil"></i> Edit
        </a>

        <form method="POST" action="/listings/{{$listing->id}}">
            @csrf
            @method('DELETE')
            <button class="text-red-500"><i class="fa-solid fa-trash"></i> Delete</button>
        </form>

        @if($listing->archived)
            <form method="POST" action="/listings/{{$listing->id}}/unarchive">
                @csrf
                @method('PUT')
                <button class="text-green-500"><i class="fa-solid fa-eye"></i> Unarchive</button>
            </form>
        @else
            <form method="POST" action="/listings/{{$listing->id}}/archive">
                @csrf
                @method('PUT')
                <button class="text-yellow-500"><i class="fa-solid fa-archive"></i> Archive</button>
            </form>
        @endif
      </x-card>
    @endif
  </div>

  

  <script>
@if($listing->isActive)
    // JavaScript for Countdown Timer
    var countDownDate = new Date("{{ $listing->deadline }}").getTime();

    var x = setInterval(function() {

        var now = new Date().getTime();

        var distance = countDownDate - now;

        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60) ) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60) ) / 1000);

        document.getElementById("countdown").innerHTML = "Time left: " + days + "d " + hours + "h "
        + minutes + "m " + seconds + "s ";

        if (distance < 0) {
            clearInterval(x);
            document.getElementById("countdown").innerHTML = "Application deadline has passed.";
        }
    }, 1000);
@endif
</script>
</x-layout>

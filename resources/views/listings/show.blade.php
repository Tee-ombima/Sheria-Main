<x-layout>
  <a href="/" class="inline-block text-black ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i> Back
  </a>
  
  <div class="mx-4">
    <x-card class="p-10">
      <div class="flex flex-col items-center justify-center text-center">
        <img class="w-48 mr-6 mb-6"
          src="{{$listing->logo ? asset('storage/' . $listing->logo) : asset('/images/no-image.png')}}" alt="" />

        <h3 class="text-2xl mb-2">
          {{$listing->title}}
        </h3>
        <div class="text-xl font-bold mb-4">{{$listing->job_reference_number}}</div>

        <x-listing-tags :tagsCsv="$listing->tags" />

        
        <div class="border border-gray-200 w-full mb-6"></div>
        <div>
          <h3 class="text-3xl font-bold mb-4">Job Description</h3>
          <div class="text-lg space-y-6">
            {{$listing->description}}

            
          </div>
        </div>
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
          <form id="applyForm" method="POST" action="/listings/{{ $listing->id }}/apply">
              @csrf
              <input type="hidden" name="personal-info-submitted" id="personal-info-submitted" value="false">
              <input type="hidden" name="academic-info-submitted" id="academic-info-submitted" value="false">
              <input type="hidden" name="prof-info-submitted" id="prof-info-submitted" value="false">
              <input type="hidden" name="relevant-courses-submitted" id="relevant-courses-submitted" value="false">
              <button type="submit" class="block bg-green-500 text-white mt-6 py-2 rounded-xl hover:opacity-80">
                  Apply for this job
              </button>
          </form>
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
</x-layout>
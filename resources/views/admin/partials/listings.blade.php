@foreach($listings as $listing)
    <div class="flex flex-col items-center justify-center text-center">
        <a href="{{ route('admin.show', ['job' => $listing->id]) }}">
            <div class="p-4">
                <h2 class="text-xl font-semibold mt-4">{{ $listing->title }}</h2>
                <div class="flex items-center justify-center rounded-xl py-1 px-3 mr-2 text-xs" style="background-color: #D68C3C; color: #FFFFFF;">
        Number of vacancies available: {{ $listing->vacancies }}
      </div>

            </div>
        </a>
    </div>
@endforeach

@foreach($listings as $listing)
    <div class="flex flex-col items-center justify-center text-center">
        <a href="{{ route('admin.show', ['job' => $listing->id]) }}">
            <div class="p-4">
                <img class="w-48 mr-6 mb-6" src="{{ $listing->logo ? asset('storage/' . $listing->logo) : asset('/images/no-image.png') }}" alt="{{ $listing->title }}">
                <h2 class="text-xl font-semibold mt-4">{{ $listing->title }}</h2>
                <div class="mt-2">
                    @foreach(explode(',', $listing->tags) as $tag)
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">{{ $tag }}</span>
                    @endforeach
                </div>
            </div>
        </a>
    </div>
@endforeach

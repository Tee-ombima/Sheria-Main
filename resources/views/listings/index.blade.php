<x-layout>
  @if (!Auth::check())
    @include('partials._hero')
  @endif

  @include('partials._search')

  <div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-sm">
      @if(count($listings) > 0)
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
          @foreach($listings as $listing)
            <x-listing-card :listing="$listing" />
          @endforeach
        </div>
      @else
        <div class="text-center py-12 bg-gray-50 rounded-lg">
          <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
          </svg>
          <h3 class="mt-2 text-xl font-medium text-gray-900">No Career Opportunities Found</h3>
          <p class="mt-1 text-gray-500">Please check back later for new opportunities</p>
        </div>
      @endif
    </div>

    @if(count($listings) > 0)
      <div class="mt-8 px-4 py-3 bg-white rounded-lg shadow-sm">
        <nav class="flex items-center justify-between">
          {{ $listings->links() }}
        </nav>
      </div>
    @endif
  </div>
</x-layout>
 <x-layout>
    <h1 class="text-center font-bold">Admin Dashboard</h1>
    
    

    

    <!-- Listings Container -->
    <div id="listings-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @include('admin.partials.listings', ['listings' => $listings])
    </div>

    <!-- Load More Button -->
    <div class="mt-6 text-center">
        <button id="load-more" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-500 hover:bg-blue-600" data-page="1" data-url="{{ route('admin.index') }}">
            Load More
        </button>
    </div>
<!-- AJAX for Load More -->
  
    
</x-layout> 

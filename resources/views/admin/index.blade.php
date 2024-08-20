<x-layout>
    <h1 class="text-center font-bold">Admin Dashboard</h1>
    
    <!-- Add the Reports Button -->
    <div class="mb-6">
        <a href="{{ route('admin.reports') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-500 hover:bg-green-600">
            Reports
        </a>
    </div>

    <!-- Search Bar with Filters -->
    <form method="GET" action="{{ route('admin.index') }}" class="mb-6 bg-white shadow-md rounded-lg p-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- Filters go here (same as your code) -->
            <div>
                <label for="job_title" class="block text-sm font-medium text-gray-700">Job Title</label>
                <select name="job_title" id="job_title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">Select Job Title</option>
                    @foreach($job_titles as $title)
                        <option value="{{ $title }}" {{ request('job_title') == $title ? 'selected' : '' }}>{{ $title }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="homecounty" class="block text-sm font-medium text-gray-700">Home County</label>
                <select name="homecounty" id="homecounty" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">Select Home County</option>
                    @foreach($homecounties as $county)
                        <option value="{{ $county }}" {{ request('homecounty') == $county ? 'selected' : '' }}>{{ $county }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="constituency" class="block text-sm font-medium text-gray-700">Constituency</label>
                <select name="constituency" id="constituency" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">Select Constituency</option>
                    @foreach($constituencies as $constituency)
                        <option value="{{ $constituency }}" {{ request('constituency') == $constituency ? 'selected' : '' }}>{{ $constituency }}</option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                <select name="gender" id="gender" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">Any</option>
                    <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>
            <div>
                <label for="dob_from" class="block text-sm font-medium text-gray-700">Date of Birth (From)</label>
                <input type="date" name="dob_from" id="dob_from" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ request('dob_from') }}">
            </div>
            <div>
                <label for="dob_to" class="block text-sm font-medium text-gray-700">Date of Birth (To)</label>
                <input type="date" name="dob_to" id="dob_to" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ request('dob_to') }}">
            </div>
            <div>
                <label for="disability" class="block text-sm font-medium text-gray-700">Disability</label>
                <select name="disability" id="disability" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">Any</option>
                    <option value="yes" {{ request('disability') == 'yes' ? 'selected' : '' }}>Yes</option>
                    <option value="no" {{ request('disability') == 'no' ? 'selected' : '' }}>No</option>
                </select>
            </div>
        </div>
        <div class="mt-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-500 hover:bg-blue-600">
                Search
            </button>
        </div>
    </form>

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

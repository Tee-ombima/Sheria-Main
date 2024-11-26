<x-layout>
    <x-card class="p-10 max-w-6xl mx-auto mt-24">

    <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 bg-gray-500 text-white font-semibold text-sm rounded-lg hover:bg-gray-700">
            ← Back
        </a>
        <header class="text-center mb-6">
            <h2 class="text-2xl font-bold uppercase">Your Program Applications</h2>
        </header>

        <!-- Three-column layout for different sections -->
        <div class="flex flex-col md:flex-row gap-4">

            <!-- Column 1: Attachment Info -->
            <div class="bg-white shadow p-4 rounded w-full md:w-1/3">
                <h3 class="text-xl font-semibold mb-4">Attachment Program</h3>
                
                    @if($internshipApplicationsEnabled)

                @if ($internships->isEmpty())
                    <p class="text-gray-600">Apply as an Attachee for your Institution/University/College Attachment
                        <a href="{{ route('internships.create') }}" class="text-blue-600 hover:text-blue-800 ml-2">APPLY</a>
                    </p>
                @else
                    <table class="min-w-full bg-white border-collapse">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-bold text-gray-600 border-b">Full Name</th>
                                <th class="px-6 py-3 text-left text-sm font-bold text-gray-600 border-b">Status</th>
                                <th class="px-6 py-3 text-left text-sm font-bold text-gray-600 border-b">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($internships as $application)
                                <tr>
                                    <td class="px-6 py-4 border-b">{{ $application->full_name }}</td>
                                    <td class="px-6 py-4 border-b">{{ $application->status }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('internships.edit', $application->id) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination Links -->
                    <div class="mt-4">
                        {{ $internships->links() }}
                    </div>
                @endif

                @else
        <p class="text-gray-600">No Attachee program available at this time.</p>
    @endif
            </div>

            <!-- Column 2: Pupillage Program Info -->
            <div class="bg-white shadow p-4 rounded w-full md:w-1/3">
    <h3 class="text-xl font-semibold mb-4">Pupillage Program</h3>

    @if($pupillageApplicationsEnabled)
        @if ($pupillages->isEmpty())
            <p class="text-gray-600">
                Apply for a law student's Pupillage Program
                <a href="{{ route('pupillages.create') }}" class="text-blue-600 hover:text-blue-800">APPLY</a>
            </p>
        @else
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2">Full Name</th>
                        <th class="py-2">Status</th>
                        <th class="py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pupillages as $application)
                        <tr>
                            <td class="border px-4 py-2">{{ $application->full_name }}</td>
                            <td class="border px-4 py-2">{{ $application->status }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('pupillages.edit', $application->id) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination Links -->
            <div class="mt-4">
                {{ $pupillages->links() }}
            </div>
        @endif
    @else
        <p class="text-gray-600">No Pupillage program available at this time.</p>
    @endif
</div>


            <!-- Column 3: Post Pupillage Program Info -->
<div class="bg-white shadow p-4 rounded w-full md:w-1/3">
    <h3 class="text-xl font-semibold mb-4">Post Pupillage Program</h3>

    @if($postPupillageApplicationsEnabled)
        @if ($postpupillages->isEmpty())
            <p class="text-gray-600">
                Apply for a law student's Post Pupillage Program
                <a href="{{ route('postPupillages.create') }}" class="text-blue-600 hover:text-blue-800">APPLY</a>
            </p>
        @else
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2">Full Name</th>
                        <th class="py-2">Status</th>
                        <th class="py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($postpupillages as $application)
                        <tr>
                            <td class="border px-4 py-2">{{ $application->full_name }}</td>
                            <td class="border px-4 py-2">{{ $application->status }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('postPupillages.edit', $application->id) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination Links -->
            <div class="mt-4">
                {{ $postpupillages->links() }}
            </div>
        @endif
    @else
        <p class="text-gray-600">No Post Pupillage program available at this time.</p>
    @endif
</div>


        </div>
    </x-card>
</x-layout>

<!-- resources/views/admin/dashboard.blade.php -->
<x-layout>
    <x-card class="p-10 max-w-6xl mx-auto mt-24">
    <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 bg-gray-500 text-white font-semibold text-sm rounded-lg hover:bg-gray-700">
            ← Back
        </a>
        <header class="text-center mb-6">
            <h2 class="text-2xl font-bold uppercase">Program Applications</h2>
        </header>

        <!-- Three-column layout for different sections -->
        <div class="flex flex-col md:flex-row gap-4">

            <!-- Column 1: Attachee Applications -->
            <div class="bg-white shadow p-4 rounded w-full md:w-1/3">
                <h3 class="text-xl font-semibold mb-4">Attachee Applications</h3>
                <p class="text-gray-600">
                    View and manage attachee applications.
                </p>
                <a href="{{ route('admin.internships.index') }}" class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                    View Attachee Applications
                </a>
            </div>

            <!-- Column 2: Pupillage Applications -->
            <div class="bg-white shadow p-4 rounded w-full md:w-1/3">
                <h3 class="text-xl font-semibold mb-4">Pupillage Applications</h3>
                <p class="text-gray-600">
                    View and manage pupillage applications.
                </p>
                <a href="{{ route('admin.pupillages.index') }}" class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                    View Pupillage Applications
                </a>
            </div>

            <!-- Column 3: Post Pupillage Applications -->
            <div class="bg-white shadow p-4 rounded w-full md:w-1/3">
                <h3 class="text-xl font-semibold mb-4">Post Pupillage Applications</h3>
                <p class="text-gray-600">
                    View and manage post pupillage applications.
                </p>
                <a href="{{ route('admin.postPupillages.index') }}" class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                    View Post Pupillage Applications
                </a>
            </div>

        </div>
    </x-card>
</x-layout>

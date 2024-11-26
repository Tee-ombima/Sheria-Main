<!-- resources/views/admin/postpupillages/editVacancyNumber.blade.php -->
<x-layout>
    <x-card class="p-10 max-w-3xl mx-auto mt-24 bg-white rounded-lg shadow-lg">
        <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 bg-gray-500 text-white font-semibold text-sm rounded-lg hover:bg-gray-700">
            ← Back
        </a>

        <h1 class="text-2xl font-bold mb-6 mt-4">Edit Post Pupillage Vacancy Number</h1>

        @if(session('message'))
            <div class="bg-green-500 text-white p-2 mb-4 rounded">
                {{ session('message') }}
            </div>
        @endif

        <form action="{{ route('admin.postPupillage.updateVacancyNumber') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Vacancy Number Input -->
            <div>
                <label for="vacancy_no" class="block text-sm font-medium text-gray-700">Vacancy Number</label>
                <input type="text" name="vacancy_no" id="vacancy_no"
                    value="{{ old('vacancy_no', $setting->vacancy_no ?? '') }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                    required>
                @error('vacancy_no')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                Update Vacancy Number
            </button>
        </form>
    </x-card>
</x-layout>

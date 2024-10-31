<x-layout>
    <x-card class="p-10 mx-auto mt-24">
        <div class="text-center my-4">
            <h1 class="text-3xl font-bold">Edit Relevant Course</h1>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger text-red-500">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('update.rel.info', $relevantCourse->id) }}" method="POST" id="relevantCourseForm">
            @csrf

            <!-- Institution Name -->
            <div class="flex space-x-4">
                <div class="flex-1">
                    <label for="rel_institution_name" class="block text-sm font-medium text-gray-700">
                        University/College/Institution <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="rel_institution_name" 
                        id="rel_institution_name" 
                        maxlength="100" 
                        required 
                        value="{{ old('rel_institution_name', $relevantCourse->rel_institution_name) }}"
                        class="mt-1 block w-full py-2 px-4 border border-gray-300 bg-white rounded-md">
                    @error('rel_institution_name')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Course -->
            <div class="flex space-x-4">
                <div class="flex-1">
                    <label for="rel_course" class="block text-sm font-medium text-gray-700">
                        Course: <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="rel_course" 
                        id="rel_course" 
                        maxlength="100" 
                        required 
                        value="{{ old('rel_course', $relevantCourse->rel_course) }}"
                        class="mt-1 block w-full py-2 px-4 border border-gray-300 bg-white rounded-md">
                    @error('rel_course')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Certificate No. -->
            <div class="flex space-x-4">
                <div class="flex-1">
                    <label for="rel_certificate_no" class="block text-sm font-medium text-gray-700">
                        Certificate No:
                    </label>
                    <input 
                        type="text" 
                        name="rel_certificate_no" 
                        id="rel_certificate_no" 
                        maxlength="100" 
                        value="{{ old('rel_certificate_no', $relevantCourse->rel_certificate_no) }}"
                        class="mt-1 block w-full py-2 px-4 border border-gray-300 bg-white rounded-md">
                    @error('rel_certificate_no')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Issue Date -->
            <div class="flex space-x-4">
                <div class="flex-1">
                    <label for="rel_issue_date" class="block text-sm font-medium text-gray-700">
                        Date of Certificate Issuance: <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="date" 
                        name="rel_issue_date" 
                        id="rel_issue_date" 
                        required 
                        value="{{ old('rel_issue_date', $relevantCourse->rel_issue_date) }}"
                        class="mt-1 block w-full py-2 px-4 border border-gray-300 bg-white rounded-md">
                    @error('rel_issue_date')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex space-x-4 mt-4">
                <button type="submit" class="py-2 px-4 bg-orange-600 text-white rounded-md hover:bg-orange-700">
                    Save Changes
                </button>
                <a href="{{ route('profile.relevant-courses') }}" class="py-2 px-4 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                    Cancel
                </a>
            </div>
        </form>
    </x-card>
</x-layout>

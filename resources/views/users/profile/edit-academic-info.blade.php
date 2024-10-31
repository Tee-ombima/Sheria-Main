<x-layout>
    <x-card class="p-10 mx-auto mt-24">
        <div class="text-center my-4">
            <h1 class="text-3xl font-bold">Edit Academic Information</h1>
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

        <form action="{{ route('update.academic.info', $academicInfo->id) }}" method="POST" id="academicInfoForm">
            @csrf

            <!-- Institution Name Field -->
            <div class="flex space-x-4">
                <div class="flex-1">
                    <label for="institution_name" class="block text-sm font-medium text-gray-700">Institution Name<span class="text-red-500">*</span></label>
                    <input 
                        type="text" 
                        name="institution_name" 
                        id="institution_name" 
                        maxlength="100" 
                        required 
                        value="{{ old('institution_name', $academicInfo->institution_name) }}"
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md">
                    @error('institution_name')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Student Admission No (Optional) -->
            <div class="flex space-x-4">
                <div class="flex-1">
                    <label for="student_admission_no" class="block text-sm font-medium text-gray-700">Student Admission No<span class="text-gray-500"> (optional)</span>:</label>
                    <input 
                        type="text" 
                        name="student_admission_no" 
                        id="student_admission_no" 
                        maxlength="100" 
                        value="{{ old('student_admission_no', $academicInfo->student_admission_no) }}"
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md">
                    @error('student_admission_no')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- High School -->
            <div class="flex space-x-4">
                <div class="flex-1">
                    <label for="highschool" class="block text-sm font-medium text-gray-700">Area of Study:<span class="text-red-500">*</span></label>
                    <select 
                        name="highschool" 
                        id="highschool" 
                        required 
                        class="mt-1 block w-full py-2 px-4 border border-gray-300 bg-white rounded-md">
                        <option value="" disabled>Select Area of Study</option>
                        @foreach($highschools as $highschool)
                            <option value="{{ $highschool->name }}" {{ old('highschool', $academicInfo->highschool) == $highschool->name ? 'selected' : '' }}>{{ $highschool->name }}</option>
                        @endforeach
                    </select>
                    @error('highschool')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Specialisation -->
            <div class="flex space-x-4">
                <div class="flex-1">
                    <label for="specialisation" class="block text-sm font-medium text-gray-700">Specialisation:<span class="text-red-500">*</span></label>
                    <select 
                        name="specialisation" 
                        id="specialisation" 
                        required 
                        class="mt-1 block w-full py-2 px-4 border border-gray-300 bg-white rounded-md">
                        <option value="" disabled>Select Specialisation</option>
                        @foreach($specialisations as $specialisation)
                            <option value="{{ $specialisation->name }}" {{ old('specialisation', $academicInfo->specialisation) == $specialisation->name ? 'selected' : '' }}>{{ $specialisation->name }}</option>
                        @endforeach
                    </select>
                    @error('specialisation')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Course -->
            <div class="flex space-x-4">
                <div class="flex-1">
                    <label for="course" class="block text-sm font-medium text-gray-700">Course:<span class="text-red-500">*</span></label>
                    <select 
                        name="course" 
                        id="course" 
                        required 
                        class="mt-1 block w-full py-2 px-4 border border-gray-300 bg-white rounded-md">
                        <option value="" disabled>Select Course</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->name }}" {{ old('course', $academicInfo->course) == $course->name ? 'selected' : '' }}>{{ $course->name }}</option>
                        @endforeach
                    </select>
                    @error('course')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Award -->
            <div class="flex space-x-4">
                <div class="flex-1">
                    <label for="award" class="block text-sm font-medium text-gray-700">Award:<span class="text-red-500">*</span></label>
                    <select 
                        name="award" 
                        id="award" 
                        required 
                        class="mt-1 block w-full py-2 px-4 border border-gray-300 bg-white rounded-md">
                        <option value="" disabled>Select Award</option>
                        @foreach($awards as $award)
                            <option value="{{ $award->name }}" {{ old('award', $academicInfo->award) == $award->name ? 'selected' : '' }}>{{ $award->name }}</option>
                        @endforeach
                    </select>
                    @error('award')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Grade -->
            <div class="flex space-x-4">
                <div class="flex-1">
                    <label for="grade" class="block text-sm font-medium text-gray-700">Grade:<span class="text-red-500">*</span></label>
                    <select 
                        name="grade" 
                        id="grade" 
                        required 
                        class="mt-1 block w-full py-2 px-4 border border-gray-300 bg-white rounded-md">
                        <option value="" disabled>Select Grade</option>
                        @foreach($grades as $grade)
                            <option value="{{ $grade->name }}" {{ old('grade', $academicInfo->grade) == $grade->name ? 'selected' : '' }}>{{ $grade->name }}</option>
                        @endforeach
                    </select>
                    @error('grade')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Certificate No. -->
            <div class="flex space-x-4">
                <div class="flex-1">
                    <label for="certificate_no" class="block text-sm font-medium text-gray-700">Certificate No.:</label>
                    <input type="text" 
                           name="certificate_no" 
                           id="certificate_no" 
                           maxlength="100" 
                           value="{{ old('certificate_no', $academicInfo->certificate_no) }}"
                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md">
                    @error('certificate_no')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Start Date -->
            <div class="flex space-x-4">
                <div class="flex-1">
                    <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date:</label>
                    <input type="date" 
                           name="start_date" 
                           id="start_date" 
                           value="{{ old('start_date', $academicInfo->start_date) }}"
                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md">
                    @error('start_date')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- End Date -->
            <div class="flex space-x-4">
                <div class="flex-1">
                    <label for="end_date" class="block text-sm font-medium text-gray-700">End Date:</label>
                    <input type="date" 
                           name="end_date" 
                           id="end_date" 
                           value="{{ old('end_date', $academicInfo->end_date) }}"
                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md">
                    @error('end_date')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Graduation/Completion Date -->
            <div class="flex space-x-4">
                <div class="flex-1">
                    <label for="graduation_completion_date" class="block text-sm font-medium text-gray-700">Graduation/Completion Date:</label>
                    <input type="date" 
                           name="graduation_completion_date" 
                           id="graduation_completion_date" 
                           value="{{ old('graduation_completion_date', $academicInfo->graduation_completion_date) }}"
                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md">
                    @error('graduation_completion_date')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex space-x-4 mt-4">
                <button type="submit" class="py-2 px-4 bg-orange-600 text-white rounded-md hover:bg-orange-700">
                    Save Changes
                </button>
                <a href="{{ route('profile.academic-info') }}" class="py-2 px-4 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                    Cancel
                </a>
            </div>
        </form>
    </x-card>
</x-layout>

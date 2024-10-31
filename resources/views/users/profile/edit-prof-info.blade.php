<x-layout>
    <x-card class="p-10 mx-auto mt-24">
        <div class="text-center my-4">
            <h1 class="text-3xl font-bold">Edit Professional Qualification</h1>
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

        <form action="{{ route('update.prof.info', $profInfo->id) }}" method="POST" id="profInfoForm">
            @csrf
            <!-- Institution Name -->
            <div class="flex space-x-4">
                <div class="flex-1">
                    <label for="prof_institution_name" class="block text-sm font-medium text-gray-700">Institution Name<span class="text-red-500">*</span></label>
                    <input 
                        type="text" 
                        name="prof_institution_name" 
                        id="prof_institution_name" 
                        maxlength="100" 
                        required 
                        value="{{ old('prof_institution_name', $profInfo->prof_institution_name) }}"
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md">
                    @error('prof_institution_name')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Student Admission No -->
                <div class="flex-1">
                    <label for="prof_student_admission_no" class="block text-sm font-medium text-gray-700">Student Admission No (optional):</label>
                    <input 
                        type="text" 
                        name="prof_student_admission_no" 
                        id="prof_student_admission_no" 
                        maxlength="100" 
                        value="{{ old('prof_student_admission_no', $profInfo->prof_student_admission_no) }}"
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md">
                    @error('prof_student_admission_no')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Area of Study and High School Level -->
            <div class="flex space-x-4">
                <div class="flex-1">
                    <label for="prof_area_of_study_high_school_level" class="block text-sm font-medium text-gray-700">Area of Study:<span class="text-red-500">*</span></label>
                    <select 
                        name="prof_area_of_study_high_school_level" 
                        id="prof_area_of_study_high_school_level" 
                        required 
                        class="mt-1 block w-full py-2 px-4 border border-gray-300 bg-white rounded-md">
                        <option value="" disabled>Select Area of Study</option>
                        @foreach($prof_area_of_study_high_school_levels as $prof_area_of_study_high_school_level)
                            <option value="{{ $prof_area_of_study_high_school_level->name }}" {{ old('prof_area_of_study_high_school_level', $profInfo->prof_area_of_study_high_school_level) == $prof_area_of_study_high_school_level->name ? 'selected' : '' }}>{{ $prof_area_of_study_high_school_level->name }}</option>
                        @endforeach
                    </select>
                    @error('prof_area_of_study_high_school_level')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Area of Specialisation -->
            <div class="flex space-x-4">
                <div class="flex-1">
                    <label for="prof_area_of_specialisation" class="block text-sm font-medium text-gray-700">Area of Specialisation:<span class="text-red-500">*</span></label>
                    <select 
                        name="prof_area_of_specialisation" 
                        id="prof_area_of_specialisation" 
                        required 
                        class="mt-1 block w-full py-2 px-4 border border-gray-300 bg-white rounded-md">
                        <option value="" disabled>Select Area of Specialisation</option>
                        @foreach($prof_area_of_specialisations as $prof_area_of_specialisation)
                            <option value="{{ $prof_area_of_specialisation->name }}" {{ old('prof_area_of_specialisation', $profInfo->prof_area_of_specialisation) == $prof_area_of_specialisation->name ? 'selected' : '' }}>{{ $prof_area_of_specialisation->name }}</option>
                        @endforeach
                    </select>
                    @error('prof_area_of_specialisation')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Course -->
            <div class="flex space-x-4">
                <div class="flex-1">
                    <label for="prof_course" class="block text-sm font-medium text-gray-700">Course:</label>
                    <input 
                        type="text" 
                        name="prof_course" 
                        id="prof_course" 
                        maxlength="100" 
                        value="{{ old('prof_course', $profInfo->prof_course) }}"
                        class="mt-1 block w-full py-2 px-4 border border-gray-300 bg-white rounded-md">
                    @error('prof_course')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Award -->
            <div class="flex space-x-4">
                <div class="flex-1">
                    <label for="prof_award" class="block text-sm font-medium text-gray-700">Professional Award:<span class="text-red-500">*</span></label>
                    <select name="prof_award" id="prof_award" required class="mt-1 block w-full py-2 px-4 border border-gray-300 bg-white rounded-md">
                        <option value="" disabled>Select Professional Award</option>
                        @foreach($prof_awards as $prof_award)
                            <option value="{{ $prof_award->name }}" {{ old('prof_award', $profInfo->prof_award) == $prof_award->name ? 'selected' : '' }}>{{ $prof_award->name }}</option>
                        @endforeach
                    </select>
                    @error('prof_award')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Grade -->
            <div class="flex space-x-4">
                <div class="flex-1">
                    <label for="prof_grade" class="block text-sm font-medium text-gray-700">Grade:<span class="text-red-500">*</span></label>
                    <select 
                        name="prof_grade" 
                        id="prof_grade" 
                        required 
                        class="mt-1 block w-full py-2 px-4 border border-gray-300 bg-white rounded-md">
                        <option value="" disabled>Select Grade</option>
                        @foreach($prof_grades as $prof_grade)
                            <option value="{{ $prof_grade->name }}" {{ old('prof_grade', $profInfo->prof_grade) == $prof_grade->name ? 'selected' : '' }}>{{ $prof_grade->name }}</option>
                        @endforeach
                    </select>
                    @error('prof_grade')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Certificate No -->
            <div class="flex space-x-4">
                <div class="flex-1">
                    <label for="prof_certificate_no" class="block text-sm font-medium text-gray-700">Certificate No.:</label>
                    <input 
                        type="text" 
                        name="prof_certificate_no" 
                        id="prof_certificate_no" 
                        maxlength="100" 
                        value="{{ old('prof_certificate_no', $profInfo->prof_certificate_no) }}"
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md">
                    @error('prof_certificate_no')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Start Date and End Date -->
            <div class="flex space-x-4">
                <div class="flex-1">
                    <label for="prof_start_date" class="block text-sm font-medium text-gray-700">Start Date:<span class="text-red-500">*</span></label>
                    <input 
                        type="date" 
                        name="prof_start_date" 
                        id="prof_start_date" 
                        required 
                        value="{{ old('prof_start_date', $profInfo->prof_start_date) }}"
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md">
                    @error('prof_start_date')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex-1">
                    <label for="prof_end_date" class="block text-sm font-medium text-gray-700">End Date:<span class="text-red-500">*</span></label>
                    <input 
                        type="date" 
                        name="prof_end_date" 
                        id="prof_end_date" 
                        required 
                        value="{{ old('prof_end_date', $profInfo->prof_end_date) }}"
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md">
                    @error('prof_end_date')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex space-x-4 mt-4">
                <button type="submit" class="py-2 px-4 bg-orange-600 text-white rounded-md hover:bg-orange-700">
                    Save Changes
                </button>
                <a href="{{ route('profile.prof-info') }}" class="py-2 px-4 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                    Cancel
                </a>
            </div>
        </form>
    </x-card>
</x-layout>

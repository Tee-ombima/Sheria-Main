<x-layout>
    <x-card class="p-8 max-w-2xl mx-auto mt-12">
        <!-- Back Button -->
        <a href="{{ url()->previous() }}" class="mb-6 inline-flex items-center px-4 py-2 bg-[#D68C3C] text-white rounded-md hover:bg-[#bf7a2e] transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back
        </a>

        <!-- Header -->
        <h1 class="text-3xl font-bold text-center mb-8 text-gray-900">Edit Internship Application</h1>

        <!-- Error Messages -->
        @if ($errors->any())
        <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6 rounded-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">There were {{ $errors->count() }} errors with your submission</h3>
                    <ul class="mt-2 text-sm text-red-700 list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif

        <form id="internshipForm" action="{{ route('internships.update', $internship->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Form Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Full Name -->
                <div>
                    <label for="full_name" class="block text-sm font-medium text-gray-700">Full Name <span class="text-red-500">*</span></label>
                    <input type="text" name="full_name" id="full_name" 
                           value="{{ old('full_name', $internship->full_name) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                           placeholder="As per identification document" required>
                </div>

                <!-- Phone Number -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number <span class="text-red-500">*</span></label>
                    <div class="flex rounded-md shadow-sm">
                        <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                            +254
                        </span>
                        <input type="tel" name="phone" id="phone" 
                               value="{{ old('phone', $internship->phone) }}"
                               class="flex-1 block w-full rounded-r-md border-gray-300 focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                               placeholder="7XX XXX XXX" pattern="[0-9]{9}" maxlength="9" required>
                    </div>
                </div>

                <!-- Institution -->
                <div>
                    <label for="institution" class="block text-sm font-medium text-gray-700">Institution <span class="text-red-500">*</span></label>
                    <input type="text" name="institution" id="institution" 
                           value="{{ old('institution', $internship->institution) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                           placeholder="University/College name" required>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email <span class="text-red-500">*</span></label>
                    <input type="email" name="email" id="email" 
                           value="{{ old('email', $internship->email) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                           placeholder="example@domain.com" required>
                </div>
            </div>

            <!-- File Uploads -->
            <div class="space-y-6">
                @php
                    $fileFields = [
                        'id_file' => 'ID Document',
                        'university_letter' => 'University Letter',
                        'application_letter' => 'Application Letter',
                        'insurance' => 'Insurance Certificate',
                        'good_conduct' => 'Good Conduct Certificate',
                        'cv' => 'Curriculum Vitae (CV)',
                    ];
                @endphp

                @foreach ($fileFields as $field => $label)
                <div>
                    <label for="{{ $field }}" class="block text-sm font-medium text-gray-700">{{ $label }} <span class="text-red-500">*</span></label>
                    @if ($internship->$field)
                        <p class="mt-1 text-sm text-gray-600">
                            Current File: <a href="{{ Storage::url($internship->$field) }}" target="_blank" class="text-[#D68C3C] hover:text-[#bf7a2e]">View Document</a>
                        </p>
                    @endif
                    <div class="mt-1 flex rounded-md shadow-sm">
                        <input type="file" name="{{ $field }}" id="{{ $field }}" accept="application/pdf"
                               class="block w-full rounded-md border-gray-300 focus:border-[#D68C3C] focus:ring-[#D68C3C] file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-[#D68C3C]/10 file:text-[#D68C3C] hover:file:bg-[#D68C3C]/20"
                               onchange="validateFileSize(this)">
                    </div>
                    @error($field) <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                @endforeach
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2 bg-[#D68C3C] text-white rounded-md hover:bg-[#bf7a2e] flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Update Application
                </button>
            </div>

            <!-- Loader -->
            <div id="loader" class="hidden justify-center mt-4">
                <svg class="animate-spin h-6 w-6 text-[#D68C3C]" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                </svg>
            </div>
        </form>
    </x-card>

    <script>
        // Form submission handler
        document.getElementById("internshipForm").addEventListener("submit", function(event) {
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = `
                <svg class="animate-spin h-5 w-5 mr-2" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                </svg>
                Updating...`;
            
            document.getElementById("loader").classList.remove("hidden");
        });

        // File validation
        function validateFileSize(input) {
            if (input.files[0].size > 2 * 1024 * 1024) {
                const errorElement = input.parentElement.nextElementSibling;
                errorElement.textContent = 'File size exceeds 2MB limit';
                errorElement.classList.add('text-red-500');
                input.value = '';
            }
        }
    </script>
</x-layout>
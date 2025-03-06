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
        <h1 class="text-3xl font-bold text-center mb-8 text-gray-900">Apply for University Attachment</h1>

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

        <form action="{{ route('internships.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Form Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Full Name -->
                <div>
                    <label for="full_name" class="block text-sm font-medium text-gray-700">Full Name <span class="text-red-500">*</span></label>
                    <input type="text" name="full_name" id="full_name" value="{{ old('full_name') }}"
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
                        <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                               class="flex-1 block w-full rounded-r-md border-gray-300 focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                               placeholder="7XX XXX XXX" pattern="[0-9]{9}" maxlength="9" required>
                    </div>
                </div>

                <!-- Institution -->
                <div>
                    <label for="institution" class="block text-sm font-medium text-gray-700">Institution <span class="text-red-500">*</span></label>
                    <input type="text" name="institution" id="institution" value="{{ old('institution') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                           placeholder="University/College name" required>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email <span class="text-red-500">*</span></label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
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

                @foreach ($fileFields as $fieldName => $fieldLabel)
                <div>
                    <label for="{{ $fieldName }}" class="block text-sm font-medium text-gray-700">{{ $fieldLabel }} <span class="text-red-500">*</span></label>
                    <div class="mt-1 flex rounded-md shadow-sm">
                        <input type="file" name="{{ $fieldName }}" id="{{ $fieldName }}" accept="application/pdf" required
                               class="block w-full rounded-md border-gray-300 focus:border-[#D68C3C] focus:ring-[#D68C3C] file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-[#D68C3C]/10 file:text-[#D68C3C] hover:file:bg-[#D68C3C]/20"
                               onchange="uploadFile('{{ $fieldName }}')">
                    </div>
                    <p id="{{ $fieldName }}-status" class="text-sm mt-2"></p>
                    <p class="text-xs text-gray-500 mt-1">PDF only, max 2MB</p>
                </div>
                @endforeach
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2 bg-[#D68C3C] text-white rounded-md hover:bg-[#bf7a2e] flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                    </svg>
                    Submit Application
                </button>
            </div>
        </form>
    </x-card>

    <script>
        // File upload handling
        function uploadFile(fieldName) {
            const fileInput = document.getElementById(fieldName);
            const statusElement = document.getElementById(fieldName + '-status');
            
            if (fileInput.files[0].size > 2 * 1024 * 1024) {
                statusElement.textContent = 'File size exceeds 2MB limit';
                statusElement.className = 'text-red-500 text-sm';
                fileInput.value = '';
                return;
            }

            statusElement.textContent = 'Uploading...';
            statusElement.className = 'text-gray-600 text-sm';

            const formData = new FormData();
            formData.append(fieldName, fileInput.files[0]);

            fetch('{{ route('internships.uploadFile') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                statusElement.textContent = data.success ? 'Upload successful!' : 'Upload failed';
                statusElement.className = data.success ? 'text-green-500 text-sm' : 'text-red-500 text-sm';
            })
            .catch(error => {
                statusElement.textContent = 'Upload error';
                statusElement.className = 'text-red-500 text-sm';
            });
        }

        // Loading state
        document.querySelector('form').addEventListener('submit', function() {
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = `
                <svg class="animate-spin h-5 w-5 mr-2" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"/>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
                </svg>
                Submitting...`;
        });
    </script>
</x-layout>
<!-- resources/views/internships/create.blade.php -->
<x-layout>
    <x-card class="p-10 max-w-lg mx-auto mt-24 bg-white rounded-lg shadow-lg">
<a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 bg-gray-500 text-white font-semibold text-sm rounded-lg hover:bg-gray-700">
            ← Back
        </a>
        <h1 class="text-3xl font-bold text-center mb-8 text-gray-800">Apply for University Attachment</h1>

        <!-- Display Validation Errors at the Top (Optional) -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6">
                <strong class="font-bold">Whoops!</strong> There were some problems with your input.<br><br>
                <ul class="mt-3 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('internships.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Full Name -->
            <div>
                <label for="full_name" class="block text-sm font-medium text-gray-700">Full Name (As per Identification Card)</label>
                <input type="text" name="full_name" id="full_name" placeholder="Full Name"
                    value="{{ old('full_name') }}"
                    class="mt-1 block w-full px-3 py-2 border
                        @error('full_name') border-red-500 @else border-gray-300 @enderror
                        rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    required>
                @error('full_name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Phone Number -->
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                <input type="text" name="phone" id="phone" placeholder="Phone Number"
                    value="{{ old('phone') }}"
                    class="mt-1 block w-full px-3 py-2 border
                        @error('phone') border-red-500 @else border-gray-300 @enderror
                        rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    required>
                @error('phone')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Institution Name -->
            <div>
                <label for="institution" class="block text-sm font-medium text-gray-700">Institution Name</label>
                <input type="text" name="institution" id="institution" placeholder="Institution Name"
                    value="{{ old('institution') }}"
                    class="mt-1 block w-full px-3 py-2 border
                        @error('institution') border-red-500 @else border-gray-300 @enderror
                        rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    required>
                @error('institution')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" placeholder="Email"
                    value="{{ old('email') }}"
                    class="mt-1 block w-full px-3 py-2 border
                        @error('email') border-red-500 @else border-gray-300 @enderror
                        rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    required>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- File Inputs -->
            @php
                $fileFields = [
                    'id_file' => 'ID File',
                    'university_letter' => 'University Letter',
                    'kra_pin' => 'Own Application Letter',
                    'insurance' => 'Insurance',
                    'good_conduct' => 'Good Conduct',
                    'cv' => 'Curriculum Vitae (CV)',
                ];
            @endphp

            @foreach ($fileFields as $fieldName => $fieldLabel)
                <div>
                    <label for="{{ $fieldName }}" class="block text-sm font-medium text-gray-700">
                        {{ $fieldLabel }}
                    </label>
                    <input type="file" name="{{ $fieldName }}" id="{{ $fieldName }}" accept="application/pdf"
                        class="mt-1 block w-full text-gray-700 border
                            @error($fieldName) border-red-500 @else border-gray-300 @enderror
                            rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        required onchange="uploadFile('{{ $fieldName }}')">
                    @error($fieldName)
            <p class="text-red-500 text-xs mt-1">{{ $message ? 'Please make sure your PDF is less than 2mb ' . $fieldLabel : 'Invalid file format' }}</p>
                    @enderror
                    <p id="{{ $fieldName }}-status" class="text-sm mt-1"></p>
                </div>
            @endforeach

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg shadow focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    Submit
                </button>
            </div>
        </form>
    </x-card>
    <script>
      document.querySelector("form").addEventListener("submit", function() {
          // Show the loader
          document.getElementById("loader").style.display = "flex";
      });
  </script>

  <!-- Include JavaScript for AJAX File Uploads -->
    <script>
        function uploadFile(fieldName) {
            const fileInput = document.getElementById(fieldName);
            const statusElement = document.getElementById(fieldName + '-status');

            if (fileInput.files.length > 0) {
                const file = fileInput.files[0];
                const formData = new FormData();
                formData.append(fieldName, file);

                fetch('{{ route('internships.uploadFile') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        statusElement.textContent = 'File uploaded successfully.';
                        statusElement.classList.remove('text-red-500');
                        statusElement.classList.add('text-green-500');
                    } else {
                        statusElement.textContent = data.message || 'File upload failed.The PDF should be less than 2mb';
                        statusElement.classList.remove('text-green-500');
                        statusElement.classList.add('text-red-500');
                        // Clear the file input
                        fileInput.value = '';
                    }
                })
                .catch(error => {
                    statusElement.textContent = 'An error occurred during file upload.The PDF should be less than 2mb';
                    statusElement.classList.remove('text-green-500');
                    statusElement.classList.add('text-red-500');
                    // Clear the file input
                    fileInput.value = '';
                });
            }
        }
    </script>
</x-layout>

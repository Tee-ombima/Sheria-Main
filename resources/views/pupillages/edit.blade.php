<!-- resources/views/pupillages/edit.blade.php -->
<x-layout>
    <x-card class="p-10 max-w-lg mx-auto mt-24 bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-center mb-8 text-gray-800">Edit Pupillage Application</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                <strong class="font-bold">Whoops!</strong> Something went wrong.
                <ul class="mt-3 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li class="text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pupillages.update', $pupillage->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            

            <!-- Full Name -->
            <div>
                <label for="full_name" class="block text-sm font-medium text-gray-700">Full Name</label>
                <input type="text" name="full_name" id="full_name" value="{{ old('full_name', $pupillage->full_name) }}" class="mt-1 block w-full" required>
                @error('full_name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Phone Number -->
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone', $pupillage->phone) }}" class="mt-1 block w-full" required>
                @error('phone')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Institution Name -->
            <div>
                <label for="institution" class="block text-sm font-medium text-gray-700">Institution Name</label>
                <input type="text" name="institution" id="institution" value="{{ old('institution', $pupillage->institution) }}" class="mt-1 block w-full" required>
                @error('institution')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $pupillage->email) }}" class="mt-1 block w-full" required>
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- File Uploads -->
            <!-- ID File -->
            <div>
                <label for="id_file" class="block text-sm font-medium text-gray-700">ID File</label>
                @if ($pupillage->id_file)
                    <p class="mt-1 text-sm text-gray-600">
                        Current File: <a href="{{ Storage::url($pupillage->id_file) }}" target="_blank" class="text-blue-600 hover:text-blue-800">View</a>
                    </p>
                @endif
                <input type="file" name="id_file" id="id_file" accept="application/pdf" class="mt-1 block w-full text-gray-700">
                @error('id_file')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- University Letter -->
            <div>
                <label for="university_letter" class="block text-sm font-medium text-gray-700">University Letter</label>
                @if ($pupillage->university_letter)
                    <p class="mt-1 text-sm text-gray-600">
                        Current File: <a href="{{ Storage::url($pupillage->university_letter) }}" target="_blank" class="text-blue-600 hover:text-blue-800">View</a>
                    </p>
                @endif
                <input type="file" name="university_letter" id="university_letter" accept="application/pdf" class="mt-1 block w-full text-gray-700">
                @error('university_letter')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="kra_pin" class="block text-sm font-medium text-gray-700">Own Application Letter</label>
                @if ($pupillage->kra_pin)
                    <p class="mt-1 text-sm text-gray-600">
                        Current File: <a href="{{ Storage::url($pupillage->kra_pin) }}" target="_blank" class="text-blue-600 hover:text-blue-800">View</a>
                    </p>
                @endif
                <input type="file" name="kra_pin" id="kra_pin" accept="application/pdf" class="mt-1 block w-full text-gray-700">
                @error('kra_pin')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Insurance -->
            <div>
                <label for="insurance" class="block text-sm font-medium text-gray-700">Insurance</label>
                @if ($pupillage->insurance)
                    <p class="mt-1 text-sm text-gray-600">
                        Current File: <a href="{{ Storage::url($pupillage->insurance) }}" target="_blank" class="text-blue-600 hover:text-blue-800">View</a>
                    </p>
                @endif
                <input type="file" name="insurance" id="insurance" accept="application/pdf" class="mt-1 block w-full text-gray-700">
                @error('insurance')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Good Conduct -->
            <div>
                <label for="good_conduct" class="block text-sm font-medium text-gray-700">Good Conduct</label>
                @if ($pupillage->good_conduct)
                    <p class="mt-1 text-sm text-gray-600">
                        Current File: <a href="{{ Storage::url($pupillage->good_conduct) }}" target="_blank" class="text-blue-600 hover:text-blue-800">View</a>
                    </p>
                @endif
                <input type="file" name="good_conduct" id="good_conduct" accept="application/pdf" class="mt-1 block w-full text-gray-700">
                @error('good_conduct')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Curriculum Vitae (CV) -->
            <div>
                <label for="cv" class="block text-sm font-medium text-gray-700">Curriculum Vitae (CV)</label>
                @if ($pupillage->cv)
                    <p class="mt-1 text-sm text-gray-600">
                        Current File: <a href="{{ Storage::url($pupillage->cv) }}" target="_blank" class="text-blue-600 hover:text-blue-800">View</a>
                    </p>
                @endif
                <input type="file" name="cv" id="cv" accept="application/pdf" class="mt-1 block w-full text-gray-700">
                @error('cv')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                    Update
                </button>
            </div>
        </form>
    </x-card>
</x-layout>

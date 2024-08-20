<x-layout>
    <x-card>
    <div class="text-center my-4">
        <h1 class="text-3xl font-bold">Upload Attachments
    <span class="{{ $attachementInfoSubmitted ? 'submitted' : 'not-submitted' }}">
            {{ $attachementInfoSubmitted ? 'Submitted' : 'Not Submitted' }}
        </span>
    </h1>
        </div>
        @if (session('success'))
            <div class="text-green-600">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="text-red-600">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('profile.upload-attachment') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex space-x-4">
                <div class="flex-1">
                    <label for="document_name" class="block text-sm font-medium text-gray-700">Document Name:</label>
                    <select name="document_name" id="document_name" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Select Document</option>
                        @foreach($documentNames as $documentName)
                            <option value="{{ $documentName->name }}">{{ $documentName->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex-1">
                    <label for="file" class="block text-sm font-medium text-gray-700">Upload File:</label>
                    <input type="file" name="file" id="file" accept="application/pdf" required class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <small class="text-gray-500">PDF only, max size 10MB</small>
                </div>
            </div>
            <div class="flex space-x-4 mt-4">
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Upload</button>
            </div>
        </form>

        <!-- Display uploaded attachments in a table -->
        <h2 class="text-xl font-bold mt-8 mb-4">Uploaded Documents</h2>
        <table id="attachment-table" class="table table-bordered">
            <thead>
                <tr>
                    <th>Document Name</th>
                    <th>File</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attachments as $attachment)
                    <tr>
                        <td>{{ $attachment->document_name }}</td>
                        <td><a href="{{ asset('storage/' . $attachment->file_path) }}" target="_blank">View Document</a></td>
                        <td>
                            <form action="{{ route('profile.delete-attachment', $attachment->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        
    </x-card>
</x-layout>

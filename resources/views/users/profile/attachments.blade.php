<x-layout>
  <x-card>
    <div class="text-center my-4">
        <h1 class="text-3xl font-bold">Upload Attachments
          <span class="{{ $attachementInfoSubmitted ? 'submitted' : 'not-submitted' }}">
            {{ $attachementInfoSubmitted ? 'Submitted' : 'Not Submitted' }}
          </span>
        </h1>
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

    <!-- Upload Form -->
    <form action="{{ route('profile.upload-attachment') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="flex space-x-4">
            <div class="flex-1">
                <label for="document_name" class="block text-sm font-medium text-gray-700">Document Name:</label>
                <select name="document_name" id="document_name" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" onchange="showOtherField(this)">
                    <option value="">Select Document</option>
                    @foreach($documentNames as $documentName)
                        <option value="{{ $documentName->name }}">{{ $documentName->name }}</option>
                    @endforeach
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="flex-1">
                <label for="file" class="block text-sm font-medium text-gray-700">Upload File:</label>
                <input type="file" name="file" id="file" accept="application/pdf" required class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <small class="text-gray-500">PDF only, max size 5MB</small>
            </div>
        </div>

        <!-- Custom Document Name Input (Hidden by default) -->
        <div class="flex space-x-4 mt-4" id="other-document-name" style="display: none;">
            <div class="flex-1">
                <label for="custom_document_name" class="block text-sm font-medium text-gray-700">Other Document Name:</label>
                <input type="text" name="custom_document_name" id="custom_document_name" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter document name">
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
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attachments as $attachment)
                <tr>
                    <td>{{ $attachment->document_name }}</td>
                    <td><a href="{{ asset('storage/' . $attachment->file_path) }}" target="_blank">View Document</a></td>
                    <td>
                        <form action="{{ route('profile.delete-attachment', $attachment->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                Delete
                            </button>
                        </form>
                        <button onclick="editAttachment({{ $attachment->id }}, '{{ $attachment->document_name }}')" class="inline-flex justify-center py-2 px-4 ml-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Edit
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 hidden z-50 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg p-6">
            <h2 class="text-xl font-bold mb-4">Edit Document</h2>
            <form id="editAttachmentForm" action="{{ route('profile.edit-attachment') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="attachment_id" id="editAttachmentId">
                <div class="flex space-x-4">
                    <div class="flex-1">
                        <label for="edit_document_name" class="block text-sm font-medium text-gray-700">Document Name:</label>
                        <input type="text" name="edit_document_name" id="edit_document_name" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div class="flex-1">
                        <label for="edit_file" class="block text-sm font-medium text-gray-700">Upload New File:</label>
                        <input type="file" name="edit_file" id="edit_file" accept="application/pdf" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <small class="text-gray-500">PDF only, max size 5MB</small>
                    </div>
                </div>
                <div class="flex justify-end space-x-4 mt-4">
                    <button type="button" onclick="closeEditModal()" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-gray-700 bg-gray-300 hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Cancel
                    </button>
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    
  </x-card>
</x-layout>

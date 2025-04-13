<x-layout>
  <x-card class="p-8 mx-auto mt-12 max-w-7xl">
    <!-- Status Header -->
    <div class="text-center mb-8">
      <h1 class="text-3xl font-bold text-gray-900 mb-2">
        Upload Attachments
        <span class="ml-2 px-4 py-1 rounded-full {{ $attachementInfoSubmitted ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
          {{ $attachementInfoSubmitted ? '✓ Submitted' : '✗ Not Submitted' }}
        </span>
      </h1>
      <p class="text-gray-600 mt-2">Allowed file type: PDF (Max size 2MB)</p>
    </div>

    <!-- Error Messages -->
    @if ($errors->any())
    <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6">
      <div class="flex">
        <div class="flex-shrink-0">
          <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
          </svg>
        </div>
        <div class="ml-3">
          <h3 class="text-sm font-medium text-red-800">Please correct the following errors:</h3>
          <ul class="mt-2 text-sm text-red-700 list-disc pl-5 space-y-1">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
    @endif
@if (session('error'))
<div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6">
    <div class="flex">
        <div class="flex-shrink-0">
            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>
        </div>
        <div class="ml-3">
            <p class="text-sm text-red-700">{{ session('error') }}</p>
        </div>
    </div>
</div>
@endif
    <!-- Upload Form -->
    <form id="upload-attachment-form" action="{{ route('profile.upload-attachment') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
      @csrf
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label for="document_name" class="block text-sm font-medium text-gray-700">Document Type <span class="text-red-500">*</span></label>
          <select name="document_name" id="document_name" 
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
                  onchange="toggleCustomDocumentField(this)">
            <option value="">Select Document Type</option>
            @foreach($documentNames as $documentName)
            <option value="{{ $documentName->name }}">{{ $documentName->name }}</option>
            @endforeach
            <option value="other">Other</option>
          </select>
        </div>

        <div>
          <label for="file" class="block text-sm font-medium text-gray-700">Upload File <span class="text-red-500">*</span></label>
          <div class="mt-1 flex rounded-md shadow-sm">
            <input type="file" name="file" id="file" accept="application/pdf" required 
                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C] file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-[#D68C3C]/10 file:text-[#D68C3C] hover:file:bg-[#D68C3C]/20">
          </div>
        </div>
      </div>

      <!-- Custom Document Name -->
      <div id="custom-document-container" class="hidden">
        <label for="custom_document_name" class="block text-sm font-medium text-gray-700">Custom Document Name <span class="text-red-500">*</span></label>
        <input type="text" name="custom_document_name" id="custom_document_name" 
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]"
               placeholder="Specify document name">
      </div>

      <div class="flex justify-end">
        <button type="submit" class="px-6 py-2 bg-[#D68C3C] text-white rounded-md hover:bg-[#bf7a2e] flex items-center">
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
          </svg>
          Upload Document
        </button>
      </div>
    </form>
<!-- Add after the closing </form> tag -->
<div class="mt-6 flex justify-center">
    <a href="{{ route('index') }}" 
       class="px-6 py-2 bg-[#D68C3C]/10 text-[#D68C3C] rounded-md border border-[#D68C3C] hover:bg-[#D68C3C]/20 inline-flex items-center transition">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
        </svg>
        Return to Job Application
    </a>
</div>


    <!-- Attachments Table -->
    <div class="mt-12 flow-root">
      <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
          <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-300">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="px-3 py-3 text-left text-sm font-semibold text-gray-900">Document Name</th>
                  <th scope="col" class="px-3 py-3 text-left text-sm font-semibold text-gray-900">File</th>
                  <th scope="col" class="px-3 py-3 text-left text-sm font-semibold text-gray-900">Actions</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200 bg-white">
                @foreach($attachments as $attachment)
                <tr>
                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">{{ $attachment->document_name }}</td>
                  <td class="whitespace-nowrap px-3 py-4 text-sm text-[#D68C3C]">
                    <a href="{{ asset('storage/' . $attachment->file_path) }}" target="_blank" class="hover:text-[#bf7a2e]">
                      View Document
                    </a>
                  </td>
                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                    <div class="flex items-center space-x-2">
                      <button onclick="editAttachment({{ $attachment->id }}, '{{ $attachment->document_name }}')" 
                         class="text-[#3a4f29] hover:text-[#D68C3C]">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                        </svg>
                      </button>
                      <form action="{{ route('profile.delete-attachment', $attachment->id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900">
                          <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                          </svg>
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">
      <div class="bg-white rounded-lg p-6 w-full max-w-2xl">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-2xl font-bold text-gray-900">Edit Document</h2>
          <button onclick="closeEditModal()" class="text-gray-500 hover:text-gray-700">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
          </button>
        </div>
        
        <form id="editAttachmentForm" action="{{ route('profile.edit-attachment') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
          @csrf
          <input type="hidden" name="attachment_id" id="editAttachmentId">
          
          <div class="grid grid-cols-1 gap-6">
            <div>
              <label for="edit_document_name" class="block text-sm font-medium text-gray-700">Document Name</label>
              <input type="text" name="edit_document_name" id="edit_document_name" 
                     class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C]">
            </div>
            
            <div>
              <label for="edit_file" class="block text-sm font-medium text-gray-700">New File (optional)</label>
              <div class="mt-1 flex rounded-md shadow-sm">
                <input type="file" name="edit_file" id="edit_file" accept="application/pdf" 
                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-[#D68C3C] focus:ring-[#D68C3C] file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-[#D68C3C]/10 file:text-[#D68C3C] hover:file:bg-[#D68C3C]/20">
              </div>
            </div>
          </div>

          <div class="flex justify-end space-x-4 mt-6">
            <button type="button" onclick="closeEditModal()" class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
              Cancel
            </button>
            <button type="submit" class="px-6 py-2 bg-[#D68C3C] text-white rounded-md hover:bg-[#bf7a2e] flex items-center">
              Save Changes
            </button>
          </div>
        </form>

        
      </div>
    </div>

    <script>
      // Toggle custom document field
      function toggleCustomDocumentField(select) {
        const container = document.getElementById('custom-document-container');
        container.classList.toggle('hidden', select.value !== 'other');
        if (select.value !== 'other') {
          document.getElementById('custom_document_name').value = '';
        }
      }

      // Edit attachment functions
      function editAttachment(id, name) {
        document.getElementById('editAttachmentId').value = id;
        document.getElementById('edit_document_name').value = name;
        document.getElementById('editModal').classList.remove('hidden');
      }

      function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
      }

      // Loading state
      document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', () => {
          const submitBtn = form.querySelector('button[type="submit"]');
          submitBtn.disabled = true;
          submitBtn.innerHTML = `
            <svg class="animate-spin h-5 w-5 mr-2" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"/>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
            </svg>
            Processing...`;
        });
      });
    </script>
  </x-card>
</x-layout>
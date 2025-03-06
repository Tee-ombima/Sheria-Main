
        function showOtherField(select) {
            const otherField = document.getElementById('other-document-name');
            if (select.value === 'other') {
                otherField.style.display = 'flex';
            } else {
                otherField.style.display = 'none';
            }
        }

        function editAttachment(id, documentName) {
            // Populate modal fields
            document.getElementById('editAttachmentId').value = id;
            document.getElementById('edit_document_name').value = documentName;

            // Show the modal
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() {
            // Hide the modal
            document.getElementById('editModal').classList.add('hidden');
        }

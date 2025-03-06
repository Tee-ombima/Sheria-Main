        // Function to open the edit modal and populate the form with the selected row's data
        function openEditModal(datum) {
            document.getElementById('academic_id').value = datum.id;
            document.getElementById('edit_institution_name').value = datum.institution_name;
            document.getElementById('edit_student_admission_no').value = datum.student_admission_no;
            // Populate other fields as needed

            // Show the modal
            document.getElementById('editModal').classList.remove('hidden');
        }

        // Function to close the edit modal
        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

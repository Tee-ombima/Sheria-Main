
    document.addEventListener('DOMContentLoaded', function () {
        function toggleOtherField(selectElement, otherFieldId) {
            const otherField = document.getElementById(otherFieldId);
            if (selectElement.value === 'Other') {
                otherField.style.display = 'block';
            } else {
                otherField.style.display = 'none';
            }
        }

        const ksceGradeSelect = document.getElementById('ksce_grade');
        ksceGradeSelect.addEventListener('change', function () {
            toggleOtherField(this, 'other_ksce_grade');
        });
        toggleOtherField(ksceGradeSelect, 'other_ksce_grade'); // Initialize on page load

        const institutionNameSelect = document.getElementById('institution_name');
        institutionNameSelect.addEventListener('change', function () {
            toggleOtherField(this, 'other_institution_name');
        });
        toggleOtherField(institutionNameSelect, 'other_institution_name');

        const institutionGradeSelect = document.getElementById('institution_grade');
        institutionGradeSelect.addEventListener('change', function () {
            toggleOtherField(this, 'other_institution_grade');
        });
        toggleOtherField(institutionGradeSelect, 'other_institution_grade');
    });

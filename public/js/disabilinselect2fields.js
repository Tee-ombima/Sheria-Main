
//select fields n homecounty
  document.addEventListener('DOMContentLoaded', function () {
    $(document).ready(function() {
      $('#specialisation').select2({
        placeholder: 'Select Specialisation',
        allowClear: true
      });

      $('#course').select2({
        placeholder: 'Select Course',
        allowClear: true
      });

      $('#highschool').select2({
        placeholder: 'Select Highschool',
        allowClear: true
      });

      $('#prof_area_of_specialisation').select2({
        placeholder: 'Select Specialisation',
        allowClear: true
      });

      $('#prof_award').select2({
        placeholder: 'Select Award',
        allowClear: true
      });

      $('#prof_area_of_study_high_school_level').select2({
        placeholder: 'Select Area of Study',
        allowClear: true
      });
    });

    var disabilityQuestion = document.getElementById('disability_question');
    var natureOfDisabilityContainer = document.getElementById('nature_of_disability_container');
    var ncpdRegistrationNoContainer = document.getElementById('ncpd_registration_no_container');

    function toggleDisabilityFields() {
      if (disabilityQuestion.value === 'yes') {
        natureOfDisabilityContainer.classList.remove('hidden');
        ncpdRegistrationNoContainer.classList.remove('hidden');
      } else {
        natureOfDisabilityContainer.classList.add('hidden');
        ncpdRegistrationNoContainer.classList.add('hidden');
      }
    }

    disabilityQuestion.addEventListener('change', toggleDisabilityFields);
    toggleDisabilityFields();
  });



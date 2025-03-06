
    document.addEventListener('DOMContentLoaded', function() {
        var areYouEmployed = document.getElementById('are_you_employed');
        var employmentDetails = document.getElementById('employment_details');

        function toggleEmploymentDetails() {
            if (areYouEmployed.value == 'Yes') {
                employmentDetails.style.display = 'block';
            } else {
                employmentDetails.style.display = 'none';
            }
        }

        areYouEmployed.addEventListener('change', toggleEmploymentDetails);

        // Call the function on page load to set the correct state
        toggleEmploymentDetails();
    });

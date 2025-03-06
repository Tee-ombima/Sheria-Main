
    // Function to show or hide the "Other" options for constituency and subcounty
    function toggleOtherOptions() {
        const homecounty = document.getElementById('homecounty').value;
        const otherOptionConstituency = document.querySelector('#constituency option[value="other"]');
        const otherOptionSubcounty = document.querySelector('#subcounty option[value="other"]');
        
        // Show/hide the "Other" option based on home county selection
        if (homecounty && homecounty !== "other") {
            otherOptionConstituency.style.display = 'block';
            otherOptionSubcounty.style.display = 'block';
        } else {
            otherOptionConstituency.style.display = 'none';
            otherOptionSubcounty.style.display = 'none';
        }
    }

    // Event listener for homecounty selection change
    document.getElementById('homecounty').addEventListener('change', toggleOtherOptions);

    // Initial call to handle default state (in case of re-render or validation errors)
    toggleOtherOptions();

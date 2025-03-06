    function toggleProgramsDropdown(menuId) {
        const dropdownMenu = document.getElementById(menuId);
        dropdownMenu.classList.toggle('hidden');
    }

    function toggleAdminReportsDropdown(menuId) {
        const dropdownMenu = document.getElementById(menuId);
        dropdownMenu.classList.toggle('hidden');
    }

    // Close the dropdowns if the user clicks outside of them
    document.addEventListener('click', function(event) {
        const programsDropdown = document.getElementById('programs-dropdown');
        const updatesDropdown = document.getElementById('updates-dropdown');

        const programsMenuButton = document.getElementById('programs-menu-button');
        const updatesMenuButton = document.getElementById('updates-menu-button');

        // Check if the click is inside the Programs dropdown or its button
        const isClickInsidePrograms = programsDropdown.contains(event.target) || programsMenuButton.contains(event.target);
        // Check if the click is inside the Updates dropdown or its button
        const isClickInsideUpdates = updatesDropdown.contains(event.target) || updatesMenuButton.contains(event.target);

        // If the click is outside Programs dropdown, hide it
        if (!isClickInsidePrograms) {
            programsDropdown.classList.add('hidden');
        }

        // If the click is outside Updates dropdown, hide it
        if (!isClickInsideUpdates) {
            updatesDropdown.classList.add('hidden');
        }
    });

function toggleSubDropdown(id) {
    var dropdown = document.getElementById(id);
    dropdown.classList.toggle('hidden');
}

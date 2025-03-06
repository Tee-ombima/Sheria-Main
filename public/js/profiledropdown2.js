  function toggleUserProfileDropdown() {
    document.getElementById('dropdownMenu').classList.toggle('hidden');
  }

  // Close dropdown if clicked outside
  document.addEventListener('click', function (event) {
    var dropdownMenu = document.getElementById('dropdownMenu');
    var button = document.getElementById('menu-button');
    
    // Check if the click is outside the dropdown and button
    if (!dropdownMenu.contains(event.target) && !button.contains(event.target)) {
      dropdownMenu.classList.add('hidden');
    }
  });

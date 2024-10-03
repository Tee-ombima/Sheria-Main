<!DOCTYPE html>
<html lang="en">

<head>
  <link href="/public/css/app.css" rel="stylesheet">

  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="images/favicon.ico" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script> --}}
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Include jQuery (required for Select2) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.x.x/dist/alpine.min.js" defer></script>


<!-- Include Select2 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

<!-- Include Select2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.tiny.cloud/1/tinp8l8r4f831q57swl337li0czi689fr5bajwmv0j2qu8tw/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>


  <script>
    tailwind.config = {
        theme: {
          extend: {
            colors: {
              laravel: '#fbae1b',
            },
          },
        },
      }
  </script>
  <title>Sheriaportal | Find AG Jobs & Programmes</title>
  <style>
  .text-lg ul,
.text-lg ol {
    margin-left: 20px;
    list-style: disc outside; /* For bullets */
}

.text-lg ol {
    list-style: decimal outside; /* For numbers */
}

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .status-icon {
            margin-left: 10px;
        }
        .submitted { color: green; }
        .not-submitted { color: red; }
         .selected-emails-container {
    display: flex;
    flex-wrap: wrap;
    gap: 10px; /* Adjust spacing between emails */
    margin-bottom: 10px;
}

.selected-email {
    background-color: #f1f1f1; /* Light grey background */
    padding: 5px 10px;
    border-radius: 5px;
    white-space: nowrap; /* Prevent line break in email addresses */
}
    </style>

</head>

<body class="mb-48">
<nav class="flex justify-between items-center mb-4 p-4 shadow-md" style="background-color: #3a4f29;">
    <a href="/"><img class="w-24" src="{{asset('images/logo.jpg')}}" alt="logo" /></a>
    <button class="text-3xl md:hidden cursor-pointer" onclick="document.getElementById('nav-links').classList.toggle('hidden')">
      <i class="fa-solid fa-bars" style="color: #ffffff;"></i>
    </button>
    <ul id="nav-links" class="nav-links flex-col md:flex-row md:space-x-6 mt-4 md:mt-0 hidden md:flex text-lg">
      @auth
      <li>
        <span class="font-bold uppercase" style="color: #ffffff;">
          Welcome {{auth()->user()->name}}
        </span>
      </li>
      @if(auth()->user()->role === 'user')

      <li class="relative">
        <button onclick="toggleDropdown()" class="hover:text-laravel flex items-center" id="menu-button" aria-expanded="true" aria-haspopup="true">
          <i class="fa-solid fa-user" style="color: #ffffff;"></i>
          <span class="ml-2" style="color: #ffffff;">My Profile</span>
          <!-- Heroicon name: solid/chevron-down -->
          <svg class="ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" style="color: #ffffff;">
              <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
          </svg>
        </button>

        <ul class="absolute hidden mt-2 w-48 bg-white shadow-lg rounded-md py-2 z-10" id="dropdownMenu" style="background-color: #3a4f29;">
            @foreach(['personal-info' => 'Personal Info', 'academic-info' => 'Academic Information', 'prof-info' => 'Professional Information', 'relevant-courses' => 'Other relevant courses', 'attachments' => 'Attachments'] as $formName => $displayName)
                <li>
                    <a class="block px-4 py-2 hover:bg-green-800" href="{{ route('profile.' . $formName) }}" id="{{ $formName }}" style="color: #ffffff;">
                        {{ $displayName }}
                    </a>
                </li>
            @endforeach

            
        </ul>
      </li>



      @endif
      <!-- View Advertised Jobs Link -->
<li class="ml-6">
    <a class="flex items-center hover:text-laravel" href="{{ route('index') }}">
        <!-- SVG Icon for briefcase -->
        <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" style="color: #ffffff;">
            <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v2H2v4a2 2 0 002 2v6a2 2 0 002 2h8a2 2 0 002-2v-6a2 2 0 002-2V6h-2V4a2 2 0 00-2-2H6zm8 4V4H6v2h8zM4 10v6h12v-6H4z" clip-rule="evenodd" />
        </svg>
        <span style="color: #ffffff;">View Advertised Jobs</span>
    </a>
</li>

      @if(auth()->user()->role === 'user')
      <li class="relative group">
        <a href="{{ route('internships.create') }}" class="hover:text-laravel text-white" style="color: #ffffff;">
            <i class="fa-solid fa-briefcase" style="color: #ffffff;"></i> University/College Attachment
        </a>
        
    </li>


      <li>
        <a href="/my-applications" class="hover:text-laravel" style="color: #ffffff;"><i class="fa-solid fa-clipboard" style="color: #ffffff;"></i> View my applications</a>
      </li>

      @endif
      @if(auth()->user()->role === 'admin')
    <!-- Manage Users Tab (Only for Admins) -->
    <li>
        <a href="{{ route('admin.role-management') }}" class="hover:text-laravel" style="color: #ffffff;">
            <i class="fa-solid fa-users-cog" style="color: #ffffff;"></i> Manage Users
        </a>
    </li>
    <li>
    <a href="{{ route('admin.internships.index') }}" class="hover:text-laravel" style="color: #ffffff;">
        <i class="fa-solid fa-briefcase" style="color: #ffffff;"></i> Recruit Attachees
    </a>
</li>

@endif

      
      @if(auth()->user()->role === 'admin')
      <!-- Admin-specific dropdown -->
      <li class="relative">
        <button onclick="toggleDropdown('admin-dropdown')" class="hover:text-laravel flex items-center" id="admin-menu-button" aria-expanded="true" aria-haspopup="true">
          <i class="fa-solid fa-chart-line" style="color: #ffffff;"></i>
          <span class="ml-2" style="color: #ffffff;">Admin Reports</span>
          <!-- Heroicon name: solid/chevron-down -->
          <svg class="ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" style="color: #ffffff;">
              <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
          </svg>
        </button>

        <ul class="absolute hidden mt-2 w-48 bg-white shadow-lg rounded-md py-2 z-10" id="admin-dropdown" style="background-color: #3a4f29;">
          <li>
            <a class="block px-4 py-2 hover:bg-green-800" href="{{ route('admin.reports.selected') }}" style="color: #ffffff;">
              Selected for Interview
            </a>
          </li>
          <li>
            <a class="block px-4 py-2 hover:bg-green-800" href="{{ route('admin.reports.appointed') }}" style="color: #ffffff;">
              Appointed
            </a>
          </li>
        </ul>
      </li>

      <li>
        <a href="{{ route('admin.index') }}" class="hover:text-laravel" style="color: #ffffff;"><i class="fa-solid fa-chart-line" style="color: #ffffff;"></i> Admin Dashboard</a>
      </li>
      @endif

      <li>
        <form class="inline" method="POST" action="/logout">
          @csrf
          <button type="submit" class="hover:text-laravel" style="color: #ffffff;">
            <i class="fa-solid fa-door-closed" style="color: #ffffff;"></i> Logout
          </button>
        </form>
      </li>
      @else
      <li>
        <a href="/register" class="hover:text-laravel" style="color: #ffffff;"><i class="fa-solid fa-user-plus" style="color: #ffffff;"></i> Register</a>
      </li>
      <li>
        <a href="/login" class="hover:text-laravel" style="color: #ffffff;"><i class="fa-solid fa-arrow-right-to-bracket" style="color: #ffffff;"></i> Login</a>
      </li>
      @endauth
    </ul>
</nav>


  <main>
    {{$slot}}
  </main>
  {{-- <footer class="fixed bottom-0 left-0 w-full flex items-center justify-start font-bold bg-laravel text-white h-24 mt-24 opacity-90 md:justify-center">
    <p class="ml-2">Copyright &copy; 2022, All Rights reserved</p>
    <a href="/listings/create" class="absolute top-1/3 right-10 bg-black text-white py-2 px-5">Post Job</a>
  </footer> --}}
<footer class="fixed bottom-0 left-0 w-full flex flex-col md:flex-row items-center justify-between font-bold h-auto md:h-24 mt-24 opacity-90 md:justify-center p-4" style="background-color: #2c1a1a; color: #D4AF37;">
    <!-- Copyright Info -->
    <p class="ml-2">&copy; {{ date('Y') }}, All Rights Reserved</p>

    <!-- Additional Footer Sections -->
    <div class="flex flex-col md:flex-row items-center justify-center space-y-4 md:space-y-0 md:space-x-6">

        <!-- Contact Info Section -->
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 7.5l8.25 8.25 8.25-8.25" />
            </svg>
            <p class="ml-2">Contact: +123 456 7890 | info@example.com</p>
        </div>

        <!-- Vision Section -->
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4.5 2.25M18.364 5.636a9 9 0 10.001 12.728 9 9 0 00-.001-12.728z" />
            </svg>
            <p class="ml-2">Vision: To be the leading provider of quality services.</p>
        </div>

        <!-- Mission Section -->
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h18M9 6h6m-6 6h6m-6 6h6" />
            </svg>
            <p class="ml-2">Mission: To innovate and provide exceptional service to our clients.</p>
        </div>

    </div>

    <!-- Post Job Button for Admin -->
    @auth
    @if(auth()->user()->role === 'admin')
        <a href="/listings/create" class="bg-[#D68C3C] text-white py-2 px-5 hover:bg-[#bf7a2e] rounded-md">
            Post Job
        </a>
    @endif
    @endauth

</footer>


  <x-flash-message />
<script>
  //overall tick listener
    function toggleDropdown() {
        const dropdownMenu = document.getElementById('dropdownMenu');
        dropdownMenu.classList.toggle('hidden');
    }
    </script>
    

  <script>
        // Load form data from LocalStorage on page load
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('personal-info');
            const formData = JSON.parse(localStorage.getItem('formData')) || {};

            for (const key in formData) {
                if (formData.hasOwnProperty(key) && form[key]) {
                    form[key].value = formData[key];
                }
            }
        });

        // Save form data to LocalStorage on form submit
        document.getElementById('personal-info').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = {};
            const form = event.target;

            for (let i = 0; i < form.elements.length; i++) {
                const element = form.elements[i];
                if (element.name) {
                    formData[element.name] = element.value;
                }
            }

            localStorage.setItem('formData', JSON.stringify(formData));
        });
    </script>

  


<script>
  function toggleDropdown() {
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
</script>

<script>
// Function to save form data to localStorage
function saveFormData() {
    const formData = {
        surname: document.getElementById('surname').value,
        firstname: document.getElementById('firstname').value,
        lastname: document.getElementById('lastname').value,
        salutation: document.getElementById('salutation').value,
        dob: document.getElementById('dob').value,
        idno: document.getElementById('idno').value,
        kra_pin: document.getElementById('kra_pin').value,
        gender: document.getElementById('gender').value,
        nationality: document.getElementById('nationality').value,
        ethnicity: document.getElementById('ethnicity').value,
        homecounty: document.getElementById('homecounty').value,
        subcounty: document.getElementById('subcounty').value,
        constituency: document.getElementById('constituency').value,
        postal_address: document.getElementById('postal_address').value,
        code: document.getElementById('code').value,
        town_city: document.getElementById('town_city').value,
        telephone_num: document.getElementById('telephone_num').value,
        mobile_num: document.getElementById('mobile_num').value,
        email_address: document.getElementById('email_address').value,
        alt_contact_person: document.getElementById('alt_contact_person').value,
        alt_contact_telephone_num: document.getElementById('alt_contact_telephone_num').value,
        disability_question: document.getElementById('disability_question').value,
        nature_of_disability: document.getElementById('nature_of_disability').value,
        ncpd_registration_no: document.getElementById('ncpd_registration_no').value
    };

    localStorage.setItem('personalInfoFormData', JSON.stringify(formData));
}

// Function to load form data from localStorage
function loadFormData() {
    const savedFormData = localStorage.getItem('personalInfoFormData');
    if (savedFormData) {
        const formData = JSON.parse(savedFormData);
        document.getElementById('surname').value = formData.surname || '';
        document.getElementById('firstname').value = formData.firstname || '';
        document.getElementById('lastname').value = formData.lastname || '';
        document.getElementById('salutation').value = formData.salutation || '';
        document.getElementById('dob').value = formData.dob || '';
        document.getElementById('idno').value = formData.idno || '';
        document.getElementById('kra_pin').value = formData.kra_pin || '';
        document.getElementById('gender').value = formData.gender || '';
        document.getElementById('nationality').value = formData.nationality || '';
        document.getElementById('ethnicity').value = formData.ethnicity || '';
        document.getElementById('homecounty').value = formData.homecounty || '';
        document.getElementById('subcounty').value = formData.subcounty || '';
        document.getElementById('constituency').value = formData.constituency || '';
        document.getElementById('postal_address').value = formData.postal_address || '';
        document.getElementById('code').value = formData.code || '';
        document.getElementById('town_city').value = formData.town_city || '';
        document.getElementById('telephone_num').value = formData.telephone_num || '';
        document.getElementById('mobile_num').value = formData.mobile_num || '';
        document.getElementById('email_address').value = formData.email_address || '';
        document.getElementById('alt_contact_person').value = formData.alt_contact_person || '';
        document.getElementById('alt_contact_telephone_num').value = formData.alt_contact_telephone_num || '';
        document.getElementById('disability_question').value = formData.disability_question || '';
        document.getElementById('nature_of_disability').value = formData.nature_of_disability || '';
        document.getElementById('ncpd_registration_no').value = formData.ncpd_registration_no || '';
    }
}

// Function to clear the saved form data after submission
function clearFormData() {
    localStorage.removeItem('personalInfoFormData');
}

// Listen for input events to save data
document.querySelectorAll('input, select').forEach(input => {
    input.addEventListener('input', saveFormData);
});

// Load form data when the page loads
window.onload = function() {
    loadFormData();
};

// Clear form data on form submission
document.getElementById('personal-info').addEventListener('submit', function() {
    clearFormData();
});
</script>



  <script>
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

      document.getElementById('homecounty').addEventListener('change', function() {
        var homecountyName = this.value;

var subcountySelect = document.getElementById('subcounty');
        subcountySelect.innerHTML = '<option value="" disabled selected>Select Subcounty</option>';

        var constituencySelect = document.getElementById('constituency');
        constituencySelect.innerHTML = '<option value="" disabled selected>Select Constituency</option>';
        if (homecountyName) {
        


        fetch(`/constituencies?homecounty=${homecountyName}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(constituency => {
                    var option = document.createElement('option');
                    option.value = constituency.name;
                    option.text = constituency.name;
                    constituencySelect.appendChild(option);
                });
            });
    }
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

  

    


  </script>

<!-- Add this script to your view, likely at the bottom of the file -->
<script>
    document.getElementById('constituency').addEventListener('change', function () {
        var constituencyName = this.value;
        var subcountySelect = document.getElementById('subcounty');

        // Clear existing options
        subcountySelect.innerHTML = '<option value="" disabled selected>Select Subcounty</option>';

        // Fetch subcounties based on selected constituency
        fetch(`/api/subcounties?constituency=${constituencyName}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(function(subcounty) {
                    var option = document.createElement('option');
                    option.value = subcounty.name;
                    option.textContent = subcounty.name;
                    subcountySelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching subcounties:', error));
    });
</script>




<script>
// delete row table
    $(document).ready(function(){
        $('.delete-row').click(function(){
            var index = $(this).data('index');
            $('tr[data-index="' + index + '"]').remove();

            $.ajax({
                url: '{{ route("remove.session.row") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    index: index
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>







    





<!--2 AJAX scripts for Load More -->
    <script>
        $(document).ready(function() {
            $('#load-more').on('click', function() {
                var button = $(this);
                var page = button.data('page');
                var url = "{{ route('admin.index') }}" + '?page=' + (page + 1) + '&' + decodeURIComponent($('form').serialize());

                $.ajax({
                    url: url,
                    type: 'GET',
                    beforeSend: function() {
                        button.prop('disabled', true).text('Loading...');
                    },
                    success: function(response) {
                        $('#listings-container').append(response);
                        button.data('page', page + 1).prop('disabled', false).text('Load More');
                    },
                    error: function() {
                        alert('Could not load more listings.');
                        button.prop('disabled', false).text('Load More');
                    }
                });
            });
        });
    </script>

    <!-- Script to handle Load More functionality -->
<script>
    document.getElementById('load-more').addEventListener('click', function () {
        const hiddenRows = document.querySelectorAll('.application-row[style*="display: none"]');
        for (let i = 0; i < 6 && i < hiddenRows.length; i++) {
            hiddenRows[i].style.display = 'block';
        }
        if (hiddenRows.length <= 6) {
            document.getElementById('load-more-container').style.display = 'none';
        }

        
    });
</script>

<!-- Script to handle dropdown and details toggle -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        function toggleDetails(element) {
            const detailsSection = element.parentElement.nextElementSibling;
            if (detailsSection.classList.contains('hidden')) {
                detailsSection.classList.remove('hidden');
                element.innerText = '▲';  // Change icon to an up arrow when expanded
            } else {
                detailsSection.classList.add('hidden');
                element.innerText = '▼';  // Change icon to a down arrow when collapsed
            }
        }

        document.querySelectorAll('.dropdown-icon').forEach(function (icon) {
            icon.addEventListener('click', function () {
                toggleDetails(this);
            });
        });
    });
</script>

<script>
    function toggleDropdown(menuId = 'dropdownMenu') {
        const dropdownMenu = document.getElementById(menuId);
        dropdownMenu.classList.toggle('hidden');
    }
</script>




</body>

</html>

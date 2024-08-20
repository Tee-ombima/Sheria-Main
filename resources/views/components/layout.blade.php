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
  <nav class="flex justify-between items-center mb-4 p-4 bg-white shadow-md">
    <a href="/"><img class="w-24" src="{{asset('images/logo.jpg')}}" alt="logo" /></a>
    <button class="text-3xl md:hidden cursor-pointer" onclick="document.getElementById('nav-links').classList.toggle('hidden')">
      <i class="fa-solid fa-bars"></i>
    </button>
    <ul id="nav-links" class="nav-links flex-col md:flex-row md:space-x-6 mt-4 md:mt-0 hidden md:flex text-lg">
      @auth
      <li>
        <span class="font-bold uppercase">
          Welcome {{auth()->user()->name}}
        </span>
      </li>
              @if(auth()->user()->role === 'user')

      <li class="relative">
    <button onclick="toggleDropdown()" class="hover:text-laravel flex items-center" id="menu-button" aria-expanded="true" aria-haspopup="true">
    <i class="fa-solid fa-user"></i>
    <span class="ml-2">My Profile</span>
    <!-- Heroicon name: solid/chevron-down -->
    <svg class="ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
    </svg>
</button>


        <ul class="absolute hidden mt-2 w-48 bg-white shadow-lg rounded-md py-2 z-10" id="dropdownMenu">
            @foreach(['personal-info' => 'Personal Info', 'academic-info' => 'Academic Information', 'prof-info' => 'Professional Information', 'relevant-courses' => 'Other relevant courses', 'attachments' => 'Attachments'] as $formName => $displayName)
                <li>
                    <a class="block px-4 py-2 text-black-700 hover:bg-gray-100" href="{{ route('profile.' . $formName) }}" id="{{ $formName }}">
                        {{ $displayName }}
                    </a>
                </li>
            @endforeach
        </ul>
</li>
      @endif

              @if(auth()->user()->role === 'user')

      <li>
        <a href="/my-applications" class="hover:text-laravel"><i class="fa-solid fa-clipboard"></i> View my applications</a>
      </li>

      @endif
      
@if(auth()->user()->role === 'admin')
        <!-- Admin-specific dropdown -->
        <li class="relative">
            <button onclick="toggleDropdown('admin-dropdown')" class="hover:text-laravel flex items-center" id="admin-menu-button" aria-expanded="true" aria-haspopup="true">
                <i class="fa-solid fa-chart-line"></i>
                <span class="ml-2">Admin Reports</span>
                <!-- Heroicon name: solid/chevron-down -->
                <svg class="ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>

            <ul class="absolute hidden mt-2 w-48 bg-white shadow-lg rounded-md py-2 z-10" id="admin-dropdown">
                <li>
                    <a class="block px-4 py-2 text-black-700 hover:bg-gray-100" href="{{ route('admin.reports.selected') }}">
    Selected for Interview
</a>
                </li>
                <li>
                    <a class="block px-4 py-2 text-black-700 hover:bg-gray-100" href="{{ route('admin.reports.appointed') }}">
    Appointed
</a>
                </li>
            </ul>
        </li>

      <li>
        <a href="{{ route('admin.index') }}" class="hover:text-laravel"><i class="fa-solid fa-chart-line"></i> Admin Dashboard</a>
      </li>
      @endif

      <li>
        <form class="inline" method="POST" action="/logout">
          @csrf
          <button type="submit" class="hover:text-laravel">
            <i class="fa-solid fa-door-closed"></i> Logout
          </button>
        </form>
      </li>
      @else
      <li>
        <a href="/register" class="hover:text-laravel"><i class="fa-solid fa-user-plus"></i> Register</a>
      </li>
      <li>
        <a href="/login" class="hover:text-laravel"><i class="fa-solid fa-arrow-right-to-bracket"></i> Login</a>
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
  <footer class="fixed bottom-0 left-0 w-full flex items-center justify-start font-bold bg-laravel text-white h-24 mt-24 opacity-90 md:justify-center">
        <p class="ml-2">&copy; {{ date('Y') }}, All Rights Reserved</p>
        @auth
        @if(auth()->user()->role === 'admin')
            <a href="/listings/create" class="absolute top-1/3 right-10 bg-black text-white py-2 px-5">Post Job</a>
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
        
 fetch(`/subcounties?homecounty=${homecountyName}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(subcounty => {
                    var option = document.createElement('option');
                    option.value = subcounty.name;
                    option.text = subcounty.name;
                    subcountySelect.appendChild(option);
                });
            });

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

<!DOCTYPE html>
<html lang="en">

<head>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<script src="//unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

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
        overflow-x: auto;
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
/* Overlay to cover the page */
.loader-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.8);
    z-index: 9999;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Spinner style */
.spinner {
    width: 50px;
    height: 50px;
    border: 5px solid #ccc;
    border-top-color: #007bff;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}
/* Create hover buffer zone */
.group:hover .dropdown-buffer {
    display: block !important;
}

/* Smooth transitions */
.group .absolute {
    transition: opacity 0.2s ease, transform 0.2s ease;
}

.group:hover .absolute {
    opacity: 1;
    transform: translateY(0);
    pointer-events: auto;
}

.group:hover .group-hover\:block {
    display: block;
}

.transition-all {
    transition-property: all;
}

.duration-300 {
    transition-duration: 300ms;
}

.ease-out {
    transition-timing-function: ease-out;
}
/* Keyframes for spinner animation */
@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}
.badge {
    @apply px-2 py-1 rounded-full text-xs font-medium;
}

.badge-system {
    @apply bg-gray-100 text-gray-600;
}

.badge-user {
    @apply bg-blue-100 text-blue-600;
}

.badge-permissions {
    @apply bg-purple-100 text-purple-600;
}

.badge-application {
    @apply bg-green-100 text-green-600;
}
    </style>
<style>
.rotate-90 {
    transform: rotate(90deg);
}
.rotate-180 {
    transform: rotate(180deg);
}
.bg-admin-menu {
    background-color: #3a4f29;
}
.hover\:bg-green-800:hover {
    background-color: #2d3f1f;
}
.status-badge {
    @apply px-2 py-1 rounded text-sm;
    
    &.Accepted { @apply bg-green-100 text-green-800; }
    &.Not_Accepted { @apply bg-red-100 text-red-800; }
    &.Pending { @apply bg-yellow-100 text-yellow-800; }
}

.application-card {
    @apply p-4 mb-4 border rounded transition-all;
    
    &:hover { @apply shadow-md; }
}
[x-cloak] { display: none !important; }
</style>
</head>

<body class="mb-48 mt-16"> <!-- Adjust the margin-top to match the height of your navbar -->
<!-- Flash Message -->

<!-- Loading Spinner HTML -->
    <div id="loader" class="loader-overlay">
        <div class="spinner"></div>
    </div>
    @if(session()->has('message'))
        <div 
            x-data="{ show: true }" 
            x-init="setTimeout(() => show = false, 5000)" 
            x-show="show"
            class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-laravel text-white px-4 py-2 rounded shadow-md"
            style="z-index: 1000;"
        >
            {{ session('message') }}
        </div>
    @endif
<nav class="flex justify-between items-center p-4 shadow-md fixed w-full top-0 z-50" style="background-color: #3a4f29;">
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

      <li class="relative group">
    <button class="hover:text-laravel text-white flex items-center gap-1 group" id="menu-button">
        <i class="fa-solid fa-user" style="color: #ffffff;"></i>
        <span class="ml-2">My Profile</span>
        <svg class="ml-2 h-5 w-5 transform group-hover:rotate-180 transition-transform" 
             xmlns="http://www.w3.org/2000/svg" 
             viewBox="0 0 20 20" 
             fill="currentColor">
            <path fill-rule="evenodd" 
                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" 
                  clip-rule="evenodd" />
        </svg>
    </button>

    <div class="absolute hidden group-hover:block shadow-lg rounded-lg w-48 pt-1 -mt-1 left-0 top-full transition-all duration-300 ease-out z-20">
        <div class="p-2" style="background-color: #3a4f29;">
            <!-- Invisible buffer zone -->
            <div class="absolute -top-4 left-0 w-full h-4"></div>
            
            @foreach(['personal-info' => 'Personal Info', 'academic-info' => 'Academic Information', 
                    'prof-info' => 'Professional Information', 'relevant-courses' => 'Other relevant courses', 
                    'attachments' => 'Attachments'] as $formName => $displayName)
                <a class="flex items-center px-4 py-2 text-sm text-white hover:bg-green-800 transition-colors" 
                   href="{{ route('profile.' . $formName) }}">
                    <i class="fa-solid fa-chevron-right mr-2 text-sm text-laravel"></i>
                    {{ $displayName }}
                </a>
            @endforeach
        </div>
    </div>
</li>



      @endif
      

      @if(auth()->user()->role === 'user')
      <li class="relative group">
    <a href="#" class="hover:text-laravel text-white flex items-center gap-1 ">
        <i class="fa-solid fa-graduation-cap" style="color: #ffffff;"></i>
        Programs
        <i class="fa-solid fa-caret-down ml-1"></i>
    </a>
    
    <!-- Dropdown menu -->
    <div class="absolute hidden group-hover:block shadow-lg rounded-lg w-64 pt-1 -mt-1 left-0 top-full transition-all duration-300 ease-out" style="background-color: #3a4f29;">
        <div class="p-2">
            <!-- Add invisible buffer area -->
            <div class="absolute -top-4 left-0 w-full h-4"></div>
            
            <!-- Law Student Programs -->
            <p class="text-xs text-gray-300 px-3 py-1 uppercase font-semibold">Legal Programs</p>
            <a href="{{ route('pupillages.create') }}" class="flex items-center px-4 py-2 text-sm text-white hover:bg-green-800">
                <i class="fa-solid fa-scale-balanced mr-2 text-laravel"></i>
                Pupillage Program
            </a>
            <a href="{{ route('postPupillages.create') }}" class="flex items-center px-4 py-2 text-sm text-white hover:bg-green-800">
                <i class="fa-solid fa-gavel mr-2 text-laravel"></i>
                Post-Pupillage Program
            </a>

            <!-- Non-Law Programs -->
            <p class="text-xs text-gray-300 px-3 py-1 mt-2 uppercase font-semibold">Attachment Programs</p>
            <a href="{{ route('internships.create') }}" class="flex items-center px-4 py-2 text-sm text-white hover:bg-green-800">
                <i class="fa-solid fa-building mr-2 text-laravel"></i>
                Campus Attachment Program
            </a>

            <!-- Application Status Section -->
            <div class="border-t border-green-700 my-2"></div>
            <a href="{{ route('internships.index') }}" class="flex items-center px-4 py-2 text-sm text-white hover:bg-green-800">
                <i class="fa-solid fa-file-lines mr-2 text-laravel"></i>
                View Application Status
            </a>
        </div>
    </div>
</li>
 <!-- Career Center Section -->
<li class="relative group ml-6">
    <a href="#" class="hover:text-laravel text-white flex items-center gap-1">
        <i class="fa-solid fa-briefcase" style="color: #ffffff;"></i>
        Career Center
        <i class="fa-solid fa-caret-down ml-1"></i>
    </a>
    
    <!-- Dropdown Menu -->
    <div class="absolute hidden group-hover:block shadow-lg rounded-lg w-64 pt-1 -mt-1 left-0 top-full transition-all duration-300 ease-out z-20" style="background-color: #3a4f29;">
        <div class="p-2">
            <!-- Invisible buffer area -->
            <div class="absolute -top-4 left-0 w-full h-4"></div>

            <!-- Advertised Jobs -->
            <a class="flex items-center px-4 py-2 text-sm text-white hover:bg-green-800" 
               href="{{ route('index') }}">
                <i class="fa-solid fa-bullhorn mr-2 text-laravel"></i>
                View Advertised Jobs
            </a>

            <!-- Application Status -->
            <a class="flex items-center px-4 py-2 text-sm text-white hover:bg-green-800" 
               href="/my-applications">
                <i class="fa-solid fa-clipboard-list mr-2 text-laravel"></i>
                Application Status
            </a>

            
    </div>
</li>

      @endif
      

      @if(auth()->user()->role === 'admin' || auth()->user()->role === 'superadmin')
<!-- Admin Menu Section -->
<li class="relative group">
    <!-- Manage Users -->
    <a href="{{ route('admin.role-management') }}" class="hover:text-laravel text-white flex items-center gap-1 ml-6">
        <i class="fa-solid fa-users-cog"></i>
        Manage Users
    </a>
</li>

@if(auth()->user()->role === 'admin' || auth()->user()->role === 'superadmin')
<li class="relative group ml-6">
    <button class="hover:text-laravel text-white flex items-center gap-1 group">
        <i class="fa-solid fa-briefcase"></i>
        Manage Careers
        <svg class="ml-1 h-5 w-5 transform group-hover:rotate-180 transition-transform" 
             xmlns="http://www.w3.org/2000/svg" 
             viewBox="0 0 20 20" 
             fill="currentColor">
            <path fill-rule="evenodd" 
                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" 
                  clip-rule="evenodd" />
        </svg>
    </button>

    <div class="absolute hidden group-hover:block shadow-lg rounded-lg w-48 pt-1 -mt-1 left-0 top-full transition-all duration-300 ease-out z-20 bg-admin-menu">
        <div class="p-2">
            <a class="flex items-center px-4 py-2 text-sm text-white hover:bg-green-800" 
               href="/listings/create">
                <i class="fa-solid fa-plus-circle mr-2"></i>
                Create New Job Career
            </a>
            <a class="flex items-center px-4 py-2 text-sm text-white hover:bg-green-800" 
               href="/listings">
                <i class="fa-solid fa-list-check mr-2"></i>
                Manage Job & Applicants
            </a>
            
        </div>
    </div>
</li>
@endif
<!-- Trainings & Programs Dropdown -->
<li class="relative ml-6">
    <button onclick="toggleMainDropdown('programs-dropdown')" class="hover:text-laravel text-white flex items-center gap-1">
        <i class="fa-solid fa-graduation-cap"></i>
        Trainings & Programs
        <svg class="ml-1 h-5 w-5 transform" id="programs-chevron" 
             xmlns="http://www.w3.org/2000/svg" 
             viewBox="0 0 20 20" 
             fill="currentColor">
            <path fill-rule="evenodd" 
                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" 
                  clip-rule="evenodd" />
        </svg>
    </button>

    <!-- Main Dropdown -->
    <div class="absolute hidden shadow-lg rounded-lg w-64 pt-1 left-0 top-full transition-all duration-300 ease-out z-20 bg-admin-menu" id="programs-dropdown">
        <div class="p-2">
            <!-- Dashboard Section -->
            <a class="flex items-center px-4 py-2 text-sm text-white hover:bg-green-800" 
               href="{{ route('admin.dashboard') }}">
                <i class="fa-solid fa-gauge-high mr-2"></i> <!-- Dashboard icon -->
                Dashboard
            </a>

            <!-- Attachees Submenu -->
            <div class="relative">
                <button onclick="toggleSubDropdown('attachees-dropdown', this)" class="w-full text-left flex items-center justify-between px-4 py-2 text-sm text-white hover:bg-green-800">
                    <div class="flex items-center">
                        <i class="fa-solid fa-user-graduate mr-2 text-laravel"></i>
                        Attachees
                    </div>
                    <i class="fa-solid fa-chevron-right text-xs submenu-arrow"></i>
                </button>
                <!-- Nested Dropdown -->
                <div class="absolute hidden left-full top-0 ml-1 w-56 shadow-lg rounded-lg z-30 bg-admin-menu" id="attachees-dropdown">
                    <div class="p-2">
                        <a class="flex items-center px-4 py-2 text-sm text-white hover:bg-green-800" 
                           href="{{ route('admin.departments.index') }}">
                            <i class="fa-solid fa-building mr-2"></i>
                            Add Department Email
                        </a>
                        
                        <a class="flex items-center px-4 py-2 text-sm text-white hover:bg-green-800" 
                           href="{{ route('admin.internships.index') }}">
                            <i class="fa-solid fa-list-check mr-2"></i>
                            Manage Internship/attachement Applications
                        </a>
                       <a class="flex items-center px-4 py-2 text-sm text-white hover:bg-green-800" 
                       href="{{ route('admin.settings.edit') }}">
                        <i class="fa-solid fa-gear mr-2"></i>
                        Internship/Attachment Program Capacity
                    </a>
                    </div>
                   
                </div>
            </div>

            <!-- Pupillage Submenu -->
            <div class="relative">
                <button onclick="toggleSubDropdown('pupillage-dropdown', this)" class="w-full text-left flex items-center justify-between px-4 py-2 text-sm text-white hover:bg-green-800">
                    <div class="flex items-center">
                        <i class="fa-solid fa-scale-balanced mr-2 text-laravel"></i>
                        Pupillage
                    </div>
                    <i class="fa-solid fa-chevron-right text-xs submenu-arrow"></i>
                </button>
                <!-- Nested Dropdown -->
                <div class="absolute hidden left-full top-0 ml-1 w-56 shadow-lg rounded-lg z-30 bg-admin-menu" id="pupillage-dropdown">
                    <div class="p-2">
                        <a class="flex items-center px-4 py-2 text-sm text-white hover:bg-green-800" 
                           href="{{ route('admin.pupillages.index') }}">
                            <i class="fa-solid fa-gear mr-2"></i>
                            Manage Pupillages
                        </a>
                        <a class="flex items-center px-4 py-2 text-sm text-white hover:bg-green-800" 
                       href="{{ route('admin.pupillage.edit') }}">
                        <i class="fa-solid fa-gear mr-2"></i>
                        Pupillage Program Capacity
                    </a>
                    </div>
                </div>
            </div>

            <!-- Post Pupillage Submenu -->
            <div class="relative">
                <button onclick="toggleSubDropdown('post-pupillage-dropdown', this)" class="w-full text-left flex items-center justify-between px-4 py-2 text-sm text-white hover:bg-green-800">
                    <div class="flex items-center">
                        <i class="fa-solid fa-gavel mr-2 text-laravel"></i>
                        Post Pupillage
                    </div>
                    <i class="fa-solid fa-chevron-right text-xs submenu-arrow"></i>
                </button>
                <!-- Nested Dropdown -->
                <div class="absolute hidden left-full top-0 ml-1 w-56 shadow-lg rounded-lg z-30 bg-admin-menu" id="post-pupillage-dropdown">
                    <div class="p-2">
                        <a class="flex items-center px-4 py-2 text-sm text-white hover:bg-green-800" 
                           href="{{ route('admin.postPupillages.index') }}">
                            <i class="fa-solid fa-gear mr-2"></i>
                            Manage Post Pupillage
                        </a>
                        <a class="flex items-center px-4 py-2 text-sm text-white hover:bg-green-800" 
                       href="{{ route('admin.postpupillage.edit') }}">
                        <i class="fa-solid fa-gear mr-2"></i>
                       PostPupillage Program Capacity
                    </a>
                        
                        <a class="flex items-center px-4 py-2 text-sm text-white hover:bg-green-800" 
                           href="{{ route('admin.postPupillages.editVacancyNumber') }}">
                            <i class="fa-solid fa-pen-to-square mr-2"></i>
                            Edit Vacancy Number
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</li>

<!-- Admin Reports Dropdown -->
<li class="relative group ml-6">
    <button class="hover:text-laravel text-white flex items-center gap-1 group">
        <i class="fa-solid fa-chart-line"></i>
        Analytics & Reports
        <svg class="ml-1 h-5 w-5 transform group-hover:rotate-180 transition-transform" 
             xmlns="http://www.w3.org/2000/svg" 
             viewBox="0 0 20 20" 
             fill="currentColor">
            <path fill-rule="evenodd" 
                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" 
                  clip-rule="evenodd" />
        </svg>
    </button>

    <div class="absolute hidden group-hover:block shadow-lg rounded-lg w-48 pt-1 -mt-1 left-0 top-full transition-all duration-300 ease-out z-20" style="background-color: #3a4f29;">
        <div class="p-2">
            <div class="absolute -top-4 left-0 w-full h-4"></div>
            <a class="flex items-center px-4 py-2 text-sm text-white hover:bg-green-800" 
               href="{{ route('admin.reports.selected') }}">
                <i class="fa-solid fa-user-check mr-2 text-laravel"></i>
                Shortlisted for Interview
            </a>
            <a class="flex items-center px-4 py-2 text-sm text-white hover:bg-green-800" 
               href="{{ route('admin.reports.appointed') }}">
                <i class="fa-solid fa-badge-check mr-2 text-laravel"></i>
                Final Appointees
            </a>
            <div class="border-t border-green-700 my-2"></div>
            
        </div>
    </div>
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
    <a href="https://www.statelaw.go.ke/" class="ml-2">
        <p>&copy; {{ date('Y') }}, All Rights Reserved</p>
    </a> 

    <!-- Additional Footer Sections -->
    <div class="flex flex-col md:flex-row items-center justify-center space-y-4 md:space-y-0 md:space-x-6">

        <!-- Contact Info Section -->
        <a href="https://www.statelaw.go.ke/" class="flex items-center">
            <!-- SVG Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                <!-- SVG path data -->
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 7.5l8.25 8.25 8.25-8.25" />
            </svg>
            <!-- Contact Info -->
            <p class="ml-2">About Us</p>
        </a>

        <!-- Vision Section -->
        <a href="https://www.statelaw.go.ke/" class="flex items-center">
            <!-- SVG Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                <!-- SVG path data -->
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4.5 2.25M18.364 5.636a9 9 0 10.001 12.728 9 9 0 00-.001-12.728z" />
            </svg>
            <!-- Vision -->
            <p class="ml-2">Contact Us</p>
        </a>

        <!-- Mission Section -->
        <a href="https://www.statelaw.go.ke/" class="flex items-center">
            <!-- SVG Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                <!-- SVG path data -->
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h18M9 6h6m-6 6h6m-6 6h6" />
            </svg>
            <!-- Mission -->
            <p class="ml-2">Our Services</p>
        </a>

    </div>






</footer>

<!-- loading icon -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("loader").style.display = "none";
        });
    </script>
<script>
  //overall tick listener
    function toggleUserProfileDropdown() {
        const dropdownMenu = document.getElementById('dropdownMenu');
        dropdownMenu.classList.toggle('hidden');
    }
    </script>
    

  
<script>
$(document).ready(function(){

    function toggleHomeCountyOther() {
        if ($('#homecounty').val() === 'other') {
            $('#homecounty_other_div').show();
            $('#constituency_div').hide();
            $('#constituency_other_div').hide();
            $('#subcounty_div').hide();
            $('#subcounty_other_div').hide();
        } else {
            $('#homecounty_other_div').hide();
            $('#constituency_div').show();
        }
    }

    function toggleConstituencyOther() {
        if ($('#constituency').val() === 'other') {
            $('#constituency_other_div').show();
            $('#subcounty_div').hide();
            $('#subcounty_other_div').hide();
        } else {
            $('#constituency_other_div').hide();
            $('#subcounty_div').show();
        }
    }

    function toggleSubcountyOther() {
        if ($('#subcounty').val() === 'other') {
            $('#subcounty_other_div').show();
        } else {
            $('#subcounty_other_div').hide();
        }
    }

    $('#homecounty').change(function(){
        toggleHomeCountyOther();
        var homecountyID = $(this).val();
        if (homecountyID && homecountyID !== 'other') {
            $.ajax({
                type:"GET",
                url:"/getSubcounties/"+homecountyID, // Changed endpoint
                success:function(res){               
                    if(res){
                        $("#subcounty").empty();
                        $("#subcounty").append('<option value="" disabled selected>Select Subcounty</option>');
                        $.each(res,function(key,value){
                            $("#subcounty").append('<option value="'+value.id+'">'+value.name+'</option>');
                        });
                        $("#subcounty").append('<option value="other">Other</option>');
                        $("#constituency").empty(); // Clear constituency when subcounty changes
                    } else {
                        $("#subcounty").empty();
                    }
                }
            });
        } else {
            $("#subcounty").empty();
            $("#subcounty").append('<option value="" disabled selected>Select Subcounty</option>');
            $("#subcounty").append('<option value="other">Other</option>');
            $("#constituency").empty();
        }      
    });

    $('#subcounty').change(function(){ // Changed from #constituency to #subcounty
        toggleSubcountyOther();
        var subcountyID = $(this).val();
        if (subcountyID && subcountyID !== 'other') {
            $.ajax({
                type:"GET",
                url:"/getConstituencies/"+subcountyID, // Changed endpoint
                success:function(res){               
                    if(res){
                        $("#constituency").empty();
                        $("#constituency").append('<option value="" disabled selected>Select Constituency</option>');
                        $.each(res,function(key,value){
                            $("#constituency").append('<option value="'+value.id+'">'+value.name+'</option>');
                        });
                        $("#constituency").append('<option value="other">Other</option>');
                    } else {
                        $("#constituency").empty();
                    }
                }
            });
        } else {
            $("#constituency").empty();
            $("#constituency").append('<option value="" disabled selected>Select Constituency</option>');
            $("#constituency").append('<option value="other">Other</option>');
        }
    });

    $('#subcounty').change(function(){
        toggleSubcountyOther();
    });

    // Initial load
    toggleHomeCountyOther();
    toggleConstituencyOther();
    toggleSubcountyOther();

});
</script>

<script>
$(document).ready(function(){
    function toggleOtherField(selectId, otherDivId) {
        if ($('#' + selectId).val() === 'other') {
            $('#' + otherDivId).show();
        } else {
            $('#' + otherDivId).hide();
        }
    }

    $('#ethnicity').change(function(){
        toggleOtherField('ethnicity', 'ethnicity_other_div');
    });

    

    $('#salutation').change(function(){
        toggleOtherField('salutation', 'salutation_other_div');
    });

    // Initial load to handle pre-selected values
    toggleOtherField('ethnicity', 'ethnicity_other_div');
    toggleOtherField('salutation', 'salutation_other_div');
});
</script>

<script>
$(document).ready(function(){
    function toggleOtherField(selectId, otherDivId) {
        if ($('#' + selectId).val() === 'other') {
            $('#' + otherDivId).show();
        } else {
            $('#' + otherDivId).hide();
        }
    }

    $('#highschool').change(function(){
        toggleOtherField('highschool', 'highschool_other_div');
    });

    $('#specialisation').change(function(){
        toggleOtherField('specialisation', 'specialisation_other_div');
    });

    $('#course').change(function(){
        toggleOtherField('course', 'course_other_div');
    });

    $('#award').change(function(){
        toggleOtherField('award', 'award_other_div');
    });

    $('#grade').change(function(){
        toggleOtherField('grade', 'grade_other_div');
    });

    // Initial load to handle pre-selected values
    toggleOtherField('highschool', 'highschool_other_div');
    toggleOtherField('specialisation', 'specialisation_other_div');
    toggleOtherField('course', 'course_other_div');
    toggleOtherField('award', 'award_other_div');
    toggleOtherField('grade', 'grade_other_div');
});
</script>

<!-- Rest of your listing details -->



<script>
$(document).ready(function(){
    function toggleOtherField(selectId, otherDivId) {
        if ($('#' + selectId).val() === 'other') {
            $('#' + otherDivId).show();
        } else {
            $('#' + otherDivId).hide();
        }
    }

    $('#prof_area_of_study_high_school_level').change(function(){
        toggleOtherField('prof_area_of_study_high_school_level', 'prof_area_of_study_other_div');
    });

    $('#prof_area_of_specialisation').change(function(){
        toggleOtherField('prof_area_of_specialisation', 'prof_area_of_specialisation_other_div');
    });

    $('#prof_award').change(function(){
        toggleOtherField('prof_award', 'prof_award_other_div');
    });

    $('#prof_grade').change(function(){
        toggleOtherField('prof_grade', 'prof_grade_other_div');
    });

    // Initial load to handle pre-selected values
    toggleOtherField('prof_area_of_study_high_school_level', 'prof_area_of_study_other_div');
    toggleOtherField('prof_area_of_specialisation', 'prof_area_of_specialisation_other_div');
    toggleOtherField('prof_award', 'prof_award_other_div');
    toggleOtherField('prof_grade', 'prof_grade_other_div');
});
</script>


<script>
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
</script>
{{-- 
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
    </script> --}}





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



<!--attachment edit button -->

<script>
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
    </script>

    
<!--academic edit button -->

 <script>
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
let openDropdown = null;
let openSubDropdown = null;

function toggleMainDropdown(dropdownId) {
    const dropdown = document.getElementById(dropdownId);
    const chevron = document.getElementById('programs-chevron');
    
    // Close other dropdowns
    if (openDropdown && openDropdown !== dropdown) {
        openDropdown.classList.add('hidden');
    }
    if (openSubDropdown) {
        openSubDropdown.classList.add('hidden');
        openSubDropdown = null;
    }
    
    // Toggle current dropdown
    dropdown.classList.toggle('hidden');
    chevron.classList.toggle('rotate-180');
    
    // Update state
    openDropdown = dropdown.classList.contains('hidden') ? null : dropdown;
}

function toggleSubDropdown(subDropdownId, button) {
    const subDropdown = document.getElementById(subDropdownId);
    const arrow = button.querySelector('.submenu-arrow');
    
    // Close other subdropdowns
    if (openSubDropdown && openSubDropdown !== subDropdown) {
        openSubDropdown.classList.add('hidden');
    }
    
    // Toggle current subdropdown
    subDropdown.classList.toggle('hidden');
    arrow.classList.toggle('rotate-90');
    
    // Update state
    openSubDropdown = subDropdown.classList.contains('hidden') ? null : subDropdown;
}

// Close dropdowns when clicking outside
document.addEventListener('click', (e) => {
    if (!e.target.closest('.relative')) {
        if (openDropdown) {
            openDropdown.classList.add('hidden');
            document.getElementById('programs-chevron').classList.remove('rotate-180');
            openDropdown = null;
        }
        if (openSubDropdown) {
            openSubDropdown.classList.add('hidden');
            openSubDropdown = null;
        }
    }
});
</script>


<script>
$(document).ready(function() {
    // Function to fetch sub-counties based on selected county
    $('#home_county').change(function() {
        var countyID = $(this).val();

        if (countyID == 'Other') {
            $('#other_home_county').show();
            $('#sub_county').html('<option value="Other">Other</option>');
            $('#other_sub_county').show();
        } else {
            $('#other_home_county').hide();
            $('#other_sub_county').hide();
            if (countyID) {
                $.ajax({
                    url: '/getSubCounties/' + countyID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#sub_county').empty();
                        $('#sub_county').append('<option value="">Select Sub County</option>');
                        $.each(data, function(key, value) {
                            $('#sub_county').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                        $('#sub_county').append('<option value="Other">Other</option>');
                    }
                });
            } else {
                $('#sub_county').empty();
                $('#sub_county').append('<option value="">Select Sub County</option>');
            }
        }
    });

    // Show or hide 'Other Sub County' input
    $('#sub_county').change(function() {
        var subCounty = $(this).val();
        if (subCounty == 'Other') {
            $('#other_sub_county').show();
        } else {
            $('#other_sub_county').hide();
        }
    });

    // Trigger change event on page load if there's a selected value
    var selectedCounty = '{{ old('home_county') }}';
    if (selectedCounty) {
        $('#home_county').val(selectedCounty).trigger('change');
    }
});
</script>

<script>
$(document).ready(function() {
    // Function to fetch sub-countypps based on selected countypp
    $('#home_countypp').change(function() {
        var countyppID = $(this).val();

        if (countyppID == 'Other') {
            $('#other_home_countypp').show();
            $('#sub_countypp').html('<option value="Other">Other</option>');
            $('#other_sub_countypp').show();
        } else {
            $('#other_home_countypp').hide();
            $('#other_sub_countypp').hide();
            if (countyppID) {
                $.ajax({
                    url: '/getSubCountypps/' + countyppID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#sub_countypp').empty();
                        $('#sub_countypp').append('<option value="">Select Sub County</option>');
                        $.each(data, function(key, value) {
                            $('#sub_countypp').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                        $('#sub_countypp').append('<option value="Other">Other</option>');
                    }
                });
            } else {
                $('#sub_countypp').empty();
                $('#sub_countypp').append('<option value="">Select Sub County</option>');
            }
        }
    });

    // Show or hide 'Other Sub Countypp' input
    $('#sub_countypp').change(function() {
        var subCountypp = $(this).val();
        if (subCountypp == 'Other') {
            $('#other_sub_countypp').show();
        } else {
            $('#other_sub_countypp').hide();
        }
    });

    // Trigger change event on page load if there's a selected value
    var selectedCountypp = '{{ old('home_countypp') }}';
    if (selectedCountypp) {
        $('#home_countypp').val(selectedCountypp).trigger('change');
    }
});
</script>


<script>
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
</script>

<script>
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
</script>


<script>
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
</script>


<script>
    function confirmRoleChange(event, userId, currentRole) {
        event.preventDefault(); // Prevent the form submission

        const newRole = currentRole === 'admin' ? 'user' : 'admin';
        const confirmed = confirm(`Are you sure you want to change the role to ${newRole}?`);

        if (confirmed) {
            // Submit the form for the respective user
            document.getElementById(`toggle-role-form-${userId}`).submit();
        } else {
            // Revert the checkbox state if the action is canceled
            event.target.checked = !event.target.checked;
        }
    }
</script>


</body>

</html>
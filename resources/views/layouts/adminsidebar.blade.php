<!-- resources/views/layouts/sidebar.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Dashboard')</title>
  <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/scrollbar.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" />
  <style>
   
    .sidebar {

      background: linear-gradient(135deg, rgba(13, 110, 253, 0.9), rgba(25, 135, 84, 0.9));
      overflow: hidden;
      height: 117vh;
    }

    .sidebar .nav-link {
      color: #f1f1f1 !important;
      transition: all 0.2s ease-in-out;
    }

    .sidebar .nav-link:hover {
      background-color: rgba(255, 255, 255, 0.05);
      color: #ff9800 !important;
      /* Accent color on hover */
    }

    .sidebar .nav-item.active .nav-link {
      background-color: #ff9800;
      color: #fff !important;
      border-left: 5px solid #219ebc;
    }

    .sidebar .icon i {
      transition: transform 0.3s ease;
    }

    .sidebar .nav-link:hover .icon i {
      transform: scale(1.2);
    }
  </style>
</head>

<body class="noscrollbar noscrollbarfire">
  <div class="wrapper show_pc d-flex">
    <!-- Sidebar -->
    <div class="sidebar shadow collapsed" id="sidebar">
      <div class="admin_brand d-flex justify-content-between align-items-baseline px-2 py-3">
        <div>
          <a class="nav-link fw-bold" href="#">
            <span class="icon"><i class="fas fa-code"></i></span>
            <span class="menu">Board-Search</span>
          </a>
        </div>
        <div class="d-block d-md-none">
          <a href="javascript:void(0)" id="close_sidebar"><i class="fas fa-times-circle fa-lg text-white"></i></a>
        </div>
      </div>

      <ul class="nav nav-pills flex-column px-2" style="margin-left: -10px;">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('employer.dashboard') }}">
            <span class="icon" data-bs-toggle="tooltip" data-bs-title="Dashboard"><i class="fas fa-dashboard"></i></span>
            <span class="menu">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('employer.employerAplicants') }}">
            <span class="icon"  data-bs-toggle="tooltip" data-bs-title="Applicants"><i class="fas fa-cube"></i></span>
            <span class="menu">Applicants</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('employer.allJobs') }}">
            <span class="icon"  data-bs-toggle="tooltip" data-bs-title="Job Posts"><i class="fas fa-cube"></i></span>
            <span class="menu">Job Posts</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('employer.logout') }}">
            <span class="icon"><i class="fas fa-sign-out"></i></span>
            <span class="menu">Logout</span>
          </a>
        </li>
      </ul>
    </div>


    <div class="content">
      <!-- top navbar start -->
      <nav class="navbar navbar-expand-md navbar-light bg-light shadow">
        <div class="container-fluid px-3">

          <!-- Desktop toggle button -->
          <a href="javascript:void(0)" id="show_sidebar_pc" class="d-none d-md-block">
            <i class="fas fa-bars text-black"></i>
          </a>

          <!-- Mobile toggle button -->
          <a href="javascript:void(0)" id="show_sidebar_phone" class="d-md-none">
            <i class="fas fa-bars text-black"></i>
          </a>


          <div class="ms-auto d-flex align-items-center">

            <div class="nav-item d-none d-md-block me-2" data-bs-toggle="tooltip" data-bs-title="Full Screen"
              data-bs-placement="left">
              <a href="#" class="nav-link" id="fullscreen">
                <i class="fa-solid fa-expand"></i>
              </a>
            </div>

            <div class="dropdown">

              <a class="nav-link dropdown-toggle py-1 px-3 rounded-1" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="fas fa-user-circle me-1"></i>{{ Auth::user()->name ?? 'User' }}
              </a>

              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="{{ route('employer.logout') }}"><i class="fa-solid fa-right-from-bracket me-2"></i>Logout</a> </li>

              </ul>
            </div>
          </div>
        </div>
      </nav>

      <!-- Page Content -->
      <div class="p-4">
        @yield('content')
      </div>
    </div>
  </div>

  <!-- Bootstrap 5 JS Bundle (at the end of <body>) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{asset('assets/js/main.js')}}"></script>



</body>

</html>
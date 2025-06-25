<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Beth Diana Fitness</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link rel="stylesheet" href="{{ asset('assets/newTemplate/img/favicon.png') }}">


  <link rel="icon" href="{{ asset('assets/newTemplate/img/apple-touch-icon.png') }}" />



  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link rel="stylesheet" href="{{ asset('assets/newTemplate/vendor/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/newTemplate/vendor/bootstrap-icons/bootstrap-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/newTemplate/vendor/boxicons/css/boxicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/newTemplate/vendor/quill/quill.snow.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/newTemplate/vendor/quill/quill.bubble.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/newTemplate/vendor/remixicon/remixicon.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/newTemplate/vendor/simple-datatables/style.css') }}">





  <!-- Template Main CSS File -->
  <link rel="stylesheet" href="{{ asset('assets/newTemplate/css/style.css') }}">





  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
    

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="{{ asset('assets/newTemplate/img/profile-img.jpg') }}" alt="">
        <span class="d-none d-lg-block">Diana Beth Fitness</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li>
        <!-- End Search Icon-->


        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="{{ asset('assets/newTemplate/img/profile-img.jpg') }}" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">Beth Diana</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>Biana Beth Fitness</h6>
              <span>Fitness Coach</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html" >
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('home') }}" target="_blank">
                <i class="bi bi-person"></i>
                <span>View as User</span>
              </a>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>


            <li>
                <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.logout') }}">
                    @csrf
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Log Out</span>
                  </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link" href="{{ route('adminTwo.dashboard') }}">
              <i class="bi bi-grid"></i>
              <!-- <span>Admin Dashboard</span> -->
            </a>
          </li>

      <!-- End Dashboard Nav -->
      {{-- Start of Videos Nav  --}}
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-journal-text"></i><span>Videos</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
            <li>
                <a href="{{ route('admin.uploadVideo') }}" class="d-flex align-items-center text-decoration-none">
                    <i class="bi bi-circle me-2"></i>
                    <span>Upload Videos</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.viewVideos') }}" class="d-flex align-items-center text-decoration-none">
                    <i class="bi bi-circle me-2"></i>
                    <span>View All Videos</span>
                </a>
            </li>
        </ul>
    </li>

      <!-- End Videos Nav-->


{{--
      Start of devotional nav --}}
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Devotionals</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="tables-general.html">
                <a href="{{ route('admin.viewDevotionals') }}" class="d-flex align-items-center text-decoration-none">
              <i class="bi bi-circle"></i><span>View All Devotionals</span>
            </a>
          </li>

          <a href="tables-data.html">
            <a href="{{ route('admin.uploadDevotional') }}" class="d-flex align-items-center text-decoration-none">
                <i class="bi bi-circle me-2"></i>
                <span>Upload Devotionals</span>
              </a>
            </li>

        </ul>
      </li>
      <!-- End devotional Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-journal-text"></i><span>Plans</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
            <li>
                <a href="{{ route('plans.create') }}" class="d-flex align-items-center text-decoration-none">
                    <i class="bi bi-circle me-2"></i>
                    <span>Create a plan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.plans') }}" class="d-flex align-items-center text-decoration-none">
                    <i class="bi bi-circle me-2"></i>
                    <span>View All Plans</span>
                </a>
            </li>
        </ul>
    </li>


    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">


    <a href="{{ route('adminTwo.dashboard') }}">Admin Dashboard</a>

    @yield('content')



    <!-- End Page Title -->

  </main>







     <!-- ======= Footer ======= -->
     <body>
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>DBF</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">Yada Innovations</a>
    </div>
  </footer><!-- End Footer -->
     </body>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/newTemplate/vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/newTemplate/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/newTemplate/vendor/chart.js/chart.umd.js') }}"></script>
  <script src="{{ asset('assets/newTemplate/vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('assets/newTemplate/vendor/quill/quill.js') }}"></script>
  <script src="{{ asset('assets/newTemplate/vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ asset('assets/newTemplate/vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('assets/newTemplate/vendor/php-email-form/validate.js') }}"></script>


  <!-- Template Main JS File -->

  <script src="{{ asset('assets/newTemplate/js/main.js') }}"></script>



</body>

</html>

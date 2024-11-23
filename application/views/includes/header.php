<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="icon" type="image/x-icon" href="<?= base_url('assets/images/favicon.ico') ?>">
  <!-- Theme style -->
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="<?= base_url('assets/') ?>images/logo.svg" alt="sms-logo" style="max-width: 250px;">
      <h5 class="mt-2 mb-0">Divine Word College of Calapan</h5>
      <p>Scholarship Management System</p>
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Search Bar (Only for Admin) -->
        <?php if ($this->session->userdata('user_type') === 'Admin'): ?>
          <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
              <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
              <form action="<?= site_url('admin/search') ?>" method="POST" class="form-inline">
                <div class="input-group input-group-sm">
                  <input class="form-control form-control-navbar" type="search" name="search_query" placeholder="Search" aria-label="Search" required>
                  <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                      <i class="fas fa-search"></i>
                    </button>
                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </li>
        <?php endif; ?>
        <!-- Search Bar (Only for TWC) -->
        <?php if ($this->session->userdata('user_type') === 'TWC'): ?>
          <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
              <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
              <form action="<?= site_url('twc/search') ?>" method="POST" class="form-inline">
                <div class="input-group input-group-sm">
                  <input class="form-control form-control-navbar" type="search" name="search_query" placeholder="Search" aria-label="Search" required>
                  <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                      <i class="fas fa-search"></i>
                    </button>
                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </li>
        <?php endif; ?>
        <!-- Search Bar (Only for SC) -->
        <?php if ($this->session->userdata('user_type') === 'Scholarship Coordinator'): ?>
          <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
              <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
              <form action="<?= site_url('sc/search') ?>" method="POST" class="form-inline">
                <div class="input-group input-group-sm">
                  <input class="form-control form-control-navbar" type="search" name="search_query" placeholder="Search" aria-label="Search" required>
                  <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                      <i class="fas fa-search"></i>
                    </button>
                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </li>
        <?php endif; ?>
        <!-- User Settings Dropdown -->
        <?php if ($this->session->userdata('user_type') === 'Admin'): ?>
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="fas fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <a href="<?= base_url('admin/update_info'); ?>" class="dropdown-item">
                <i class="fas fa-user-edit mr-2"></i> Edit Information
              </a>
              <div class="dropdown-divider"></div>
              <a href="<?= base_url('admin/change_password'); ?>" class="dropdown-item">
                <i class="fas fa-key mr-2"></i> Change Password
              </a>
            </div>
          </li>
        <?php elseif ($this->session->userdata('user_type') === 'Scholarship Coordinator'): ?>
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="fas fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <a href="<?= base_url('sc/update_info'); ?>" class="dropdown-item">
                <i class="fas fa-user-edit mr-2"></i> Edit Information
              </a>
              <div class="dropdown-divider"></div>
              <a href="<?= base_url('sc/change_password'); ?>" class="dropdown-item">
                <i class="fas fa-key mr-2"></i> Change Password
              </a>
            </div>
          </li>
        <?php elseif ($this->session->userdata('user_type') === 'TWC'): ?>
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="fas fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <a href="<?= base_url('twc/update_info'); ?>" class="dropdown-item">
                <i class="fas fa-user-edit mr-2"></i> Edit Information
              </a>
              <div class="dropdown-divider"></div>
              <a href="<?= base_url('twc/change_password'); ?>" class="dropdown-item">
                <i class="fas fa-key mr-2"></i> Change Password
              </a>
            </div>
          </li>
        <?php endif; ?>
        <!-- Logout Button -->
        <li class="nav-item">
          <a class="nav-link" href="<?= site_url('auth/logout') ?>" role="button">
            <i class="fas fa-sign-out-alt"></i> Logout
          </a>
        </li>
      </ul>
    </nav>
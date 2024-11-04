<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SMS | Applicant Log in</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/fontawesome-free/css/all.min.css">
  <link rel="icon" type="image/x-icon" href="<?= base_url('assets/images/favicon.ico') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>dist/css/adminlte.css">
</head>
<body class="hold-transition login-page">
 <!-- Preloader -->
 <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="<?= base_url('assets/') ?>images/logo.svg" alt="sms-logo" style="max-width: 250px;">
      <h5 class="mt-2 mb-0">Divine Word College of Calapan</h5>
      <p>Scholarship Management System</p>
    </div>
  <div class="login-box shadow-lg">
    <div class="card">
      <div class="card-body login-card-body">
        <div class="logo-container mb-0">
          <img src="<?= base_url('assets/images/logo.svg'); ?>" alt="Logo" class="img-fluid mb-2" style="max-width: 130px;">
          <div class="login-box-msg text-center">
            <h5 class="mt-2 mb-0">Divine Word College of Calapan</h5>
            <p>Scholarship Management System</p>
          </div>
        </div>
        <form action="<?php echo site_url('auth/applicant_login'); ?>" method="post">
          <div class="input-group  mb-3">
            <input type="text" class="form-control <?php echo (form_error('id_number') || $this->session->flashdata('error_id_number')) ? 'is-invalid' : ''; ?>" name="id_number" id="id_number" placeholder="ID Number" value="<?= set_value('id_number'); ?>">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
            <?php echo form_error('id_number', '<div class="invalid-feedback">', '</div>'); ?>
            <?php if ($this->session->flashdata('error_id_number')): ?>
              <div class="invalid-feedback"><?= $this->session->flashdata('error_id_number'); ?></div>
            <?php endif; ?>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control <?php echo (form_error('password') || $this->session->flashdata('error_password')) ? 'is-invalid' : ''; ?>" name="password" id="password" placeholder="Password" value="<?= set_value('password'); ?>">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
            <?php echo form_error('password', '<div class="invalid-feedback">', '</div>'); ?>
            <?php if ($this->session->flashdata('error_password')): ?>
              <div class="invalid-feedback"><?= $this->session->flashdata('error_password'); ?></div>
            <?php endif; ?>
          </div>
          <div class="d-flex mb-3">
            <a href="<?php echo site_url('auth/applicant_forgot_password'); ?>" class="text-muted forgot-password-link ml-auto">Forgot Password?</a>
          </div>
          <div class="row">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
        </form>
        <!-- Registration link -->
        <div class="text-center mt-3">
          <p class="mb-0">
            <a href="<?php echo site_url('applicant/register'); ?>" class="text-left">Don't have an account? Register here</a>
          </p>
        </div>
      </div>
    </div>
  </div>
  <!-- jQuery -->
  <script src="<?= base_url('assets/') ?>/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url('assets/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url('assets/') ?>dist/js/adminlte.min.js"></script>
</body>
</html>
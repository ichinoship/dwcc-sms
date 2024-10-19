<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Verify Code</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="icon" type="image/x-icon" href="<?= base_url('assets/images/favicon.ico') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>dist/css/adminlte.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box shadow-lg">
    <div class="card">
      <div class="card-body register-card-body">
        <div class="text-center">
          <img src="<?= base_url('assets/images/logo.svg'); ?>" alt="Logo" class="img-fluid mb-2" style="max-width: 130px;">
          <h5 class="mt-2 mb-0">Divine Word College of Calapan</h5>
          <p>Scholarship Management System</p>
        </div>
        <h6 class="login-box-msg">Enter your verification code</h6>

        <!-- Display success or error messages -->
        <?php if ($this->session->flashdata('success')): ?>
          <div class="alert alert-success">
            <?= $this->session->flashdata('success'); ?>
          </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
          <div class="alert alert-danger">
            <?= $this->session->flashdata('error'); ?>
          </div>
        <?php endif; ?>

        <form action="<?= site_url('auth/applicant_check_verification_code'); ?>" method="post">
          <div class="form-group">
            <label for="code">Verification Code</label>
            <div class="d-flex justify-content-between">
              <?php for ($i = 0; $i < 6; $i++): ?>
                <input type="text" class="form-control text-center <?= form_error('code') ? 'is-invalid' : ''; ?>" id="code<?= $i ?>" name="code[]" maxlength="1" style="width: 50px; height: 50px; font-size: 24px; border-radius: 0.25rem; border: 1px solid #ced4da; margin: 0 5px;" oninput="moveFocus(this, <?= $i ?>)" />
              <?php endfor; ?>
            </div>
            <?= form_error('code[]', '<div class="invalid-feedback">', '</div>'); ?>
          </div>

          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">Verify Code</button>
            </div>
          </div>

          <div class="row mt-2">
            <div class="col-12">
              <a href="<?= site_url('auth/applicant_forgot_password'); ?>" class="btn btn-secondary btn-block">Back</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>
  <script src="<?= base_url('assets/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url('assets/') ?>dist/js/adminlte.min.js"></script>

  <script>
    function moveFocus(current, index) {
      // Move to next input box on valid input
      if (current.value.length === 1 && index < 5) {
        document.getElementById('code' + (index + 1)).focus();
      }
      // Move back to previous input box on delete
      if (current.value.length === 0 && index > 0) {
        document.getElementById('code' + (index - 1)).focus();
      }
    }
  </script>
</body>

</html>

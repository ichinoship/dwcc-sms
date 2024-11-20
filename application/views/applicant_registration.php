<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Applicant Registration</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="icon" type="image/x-icon" href="<?= base_url('assets/images/favicon.ico') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>dist/css/adminlte.css">
</head>

<body class="hold-transition register-page">
  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?= base_url('assets/') ?>images/logo.svg" alt="sms-logo" style="max-width: 250px;">
    <h5 class="mt-2 mb-0">Divine Word College of Calapan</h5>
    <p>Scholarship Management System</p>
  </div>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card shadow-lg">
          <div class="card-body register-card-body">
            <div class="text-center">
              <img src="<?= base_url('assets/images/logo.svg'); ?>" alt="Logo" class="img-fluid mb-2" style="max-width: 130px;">
              <h5 class="mt-2 mb-0">Divine Word College of Calapan</h5>
              <p>Scholarship Management System</p>
            </div>
            <h6 class="register-box-msg mb-2">Account Registration</h6>
            <!-- error messages -->
            <?php if ($this->session->flashdata('error')): ?>
              <div class="alert text-center alert-danger">
                <?= $this->session->flashdata('error'); ?>
              </div>
            <?php endif; ?>
            <form action="<?= site_url('applicant/register'); ?>" method="post" enctype="multipart/form-data">
              <div class="justify-content-center text-center">
                <div class="alert alert-warning fade show text-center" role="alert">
                  <strong>Important:</strong> Double-check your info before submitting. This registration is for account creation only, and you will need to wait for admin approval.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              </div>
              <div class="row justify-content-center mb-3">
                <div id="photo_preview">
                  <img id="photo_preview_img" src="#" alt="2x2 Photo Preview" style="display:none; width:200px; height:200px; object-fit:cover; border: 1px solid black;" class="img-fluid">
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="applicant_photo">Upload 2x2 Photo: <span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input <?= form_error('applicant_photo') ? 'is-invalid' : ''; ?>" id="applicant_photo" name="applicant_photo" accept="image/*" onchange="updateFileName(this)">
                        <label class="custom-file-label" for="applicant_photo">Choose photo...</label>
                      </div>
                      <?= form_error('applicant_photo', '<div class="invalid-feedback d-block">', '</div>'); ?>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="id_number">ID Number <span class="text-danger">*</span></label>
                    <input type="text" class="form-control <?= form_error('id_number') ? 'is-invalid' : ''; ?>" id="id_number" name="id_number" placeholder="ID Number" value="<?= set_value('id_number'); ?>">
                    <?= form_error('id_number', '<div class="invalid-feedback">', '</div>'); ?>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="firstname">First name: <span class="text-danger">*</span></label>
                    <input type="text" class="form-control <?= form_error('firstname') ? 'is-invalid' : ''; ?>" id="firstname" name="firstname" placeholder="First Name" value="<?= set_value('firstname'); ?>">
                    <?= form_error('firstname', '<div class="invalid-feedback">', '</div>'); ?>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="middlename">Middle name: </label>
                    <input type="text" class="form-control <?= form_error('middlename') ? 'is-invalid' : ''; ?>" id="middlename" name="middlename" placeholder="Middle Name" value="<?= set_value('middlename'); ?>">
                    <?= form_error('middlename', '<div class="invalid-feedback">', '</div>'); ?>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="lastname">Last name: <span class="text-danger">*</span></label>
                    <input type="text" class="form-control <?= form_error('lastname') ? 'is-invalid' : ''; ?>" id="lastname" name="lastname" placeholder="Last Name" value="<?= set_value('lastname'); ?>">
                    <?= form_error('lastname', '<div class="invalid-feedback">', '</div>'); ?>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="birthdate">Birthdate <span class="text-danger">*</span></label>
                    <input type="date" class="form-control <?= form_error('birthdate') ? 'is-invalid' : ''; ?>" id="birthdate" name="birthdate" placeholder="Birthdate" value="<?= set_value('birthdate'); ?>" max="<?= date('Y-m-d'); ?>">
                    <?= form_error('birthdate', '<div class="invalid-feedback">', '</div>'); ?>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="gender">Gender <span class="text-danger">*</span></label>
                    <div class="d-flex">
                      <div class="form-check form-check-inline mr-3">
                        <input class="form-check-input <?= form_error('gender') ? 'is-invalid' : ''; ?>" type="radio" name="gender" id="male" value="Male" <?= set_radio('gender', 'Male'); ?>>
                        <label class="form-check-label" for="male">
                          Male
                        </label>
                      </div>
                      <div class="form-check form-check-inline mr-3">
                        <input class="form-check-input <?= form_error('gender') ? 'is-invalid' : ''; ?>" type="radio" name="gender" id="female" value="Female" <?= set_radio('gender', 'Female'); ?>>
                        <label class="form-check-label" for="female">
                          Female
                        </label>
                      </div>
                    </div>
                    <?= form_error('gender', '<div class="invalid-feedback d-block">', '</div>'); ?>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="contact">Contact <span class="text-danger">*</span></label>
                    <input type="number" class="form-control <?= form_error('contact') ? 'is-invalid' : ''; ?>" id="contact" name="contact" placeholder="Contact" value="<?= set_value('contact'); ?>">
                    <?= form_error('contact', '<div class="invalid-feedback">', '</div>'); ?>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="email">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control <?= form_error('email') ? 'is-invalid' : ''; ?>" id="email" name="email" placeholder="Email" value="<?= set_value('email'); ?>">
                    <?= form_error('email', '<div class="invalid-feedback">', '</div>'); ?>
                  </div>
                </div>
                <div class="col-md-6 form-group">
                  <label for="program_type">Program Type <span class="text-danger">*</span></label>
                  <select class="form-control <?= form_error('program_type') ? 'is-invalid' : ''; ?>" id="program_type" name="program_type" onchange="updateYearOptions(); updateProgramOptions();">
                    <option value="" disabled selected>Select Program Type</option>
                    <option value="College" <?= set_select('program_type', 'College'); ?>>College</option>
                    <option value="Senior High School" <?= set_select('program_type', 'Senior High School'); ?>>Senior High School</option>
                    <option value="Junior High School" <?= set_select('program_type', 'Junior High School'); ?>>Junior High School</option>
                    <option value="Grade School" <?= set_select('program_type', 'Grade School'); ?>>Grade School</option>
                  </select>
                  <?= form_error('program_type', '<div class="invalid-feedback">', '</div>'); ?>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="year">Year Level <span class="text-danger">*</span></label>
                    <select class="form-control <?= form_error('year') ? 'is-invalid' : ''; ?>" id="year" name="year">
                      <option value="" disabled selected>Select Year Level</option>
                      <option value="5th" <?= set_select('year', '5th'); ?>>5th</option>
                      <option value="4th" <?= set_select('year', '4th'); ?>>4th</option>
                      <option value="3rd" <?= set_select('year', '3rd'); ?>>3rd</option>
                      <option value="2nd" <?= set_select('year', '2nd'); ?>>2nd</option>
                      <option value="1st" <?= set_select('year', '1st'); ?>>1st</option>
                      <option value="Grade 12" <?= set_select('year', 'Grade 12'); ?>>Grade 12</option>
                      <option value="Grade 11" <?= set_select('year', 'Grade 11'); ?>>Grade 11</option>
                      <option value="Grade 10" <?= set_select('year', 'Grade 10'); ?>>Grade 10</option>
                      <option value="Grade 9" <?= set_select('year', 'Grade 9'); ?>>Grade 9</option>
                      <option value="Grade 8" <?= set_select('year', 'Grade 8'); ?>>Grade 8</option>
                      <option value="Grade 7" <?= set_select('year', 'Grade 7'); ?>>Grade 7</option>
                      <option value="Grade 6" <?= set_select('year', 'Grade 6'); ?>>Grade 6</option>
                      <option value="Grade 5" <?= set_select('year', 'Grade 5'); ?>>Grade 5</option>
                      <option value="Grade 4" <?= set_select('year', 'Grade 4'); ?>>Grade 4</option>
                      <option value="Grade 3" <?= set_select('year', 'Grade 3'); ?>>Grade 3</option>
                      <option value="Grade 2" <?= set_select('year', 'Grade 2'); ?>>Grade 2</option>
                      <option value="Grade 1" <?= set_select('year', 'Grade 1'); ?>>Grade 1</option>
                      <option value="Senior Kinder" <?= set_select('year', 'Senior Kinder'); ?>>Senior Kinder</option>
                      <option value="Junior Kinder" <?= set_select('year', 'Junior Kinder'); ?>>Junior Kinder</option>
                      <option value="Special Education" <?= set_select('year', 'Special Education'); ?>>Special Education</option>
                    </select>
                    <?= form_error('year', '<div class="invalid-feedback">', '</div>'); ?>
                  </div>
                </div>
                <div class="col-md-6 form-group">
                  <label for="program">Program <span class="text-danger">*</span></label>
                  <select name="program" id="program" class="form-control  <?= form_error('program') ? 'is-invalid' : ''; ?>">
                    <option value="">Select Program</option>
                    <?php foreach ($programs as $program): ?>
                      <option value="<?= $program->program_name ?>" <?= set_select('program', $program->program_name); ?>>
                        <?= $program->program_name ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                  <?= form_error('program', '<div class="invalid-feedback">', '</div>'); ?>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="address">Address <span class="text-danger">*</span></label>
                    <input type="text" class="form-control <?= form_error('address') ? 'is-invalid' : ''; ?>" id="address" name="address" placeholder="Address" value="<?= set_value('address'); ?>">
                    <?= form_error('address', '<div class="invalid-feedback">', '</div>'); ?>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="applicant_residence">Applicant Residence <span class="text-danger">*</span></label>
                    <select class="form-control <?= form_error('applicant_residence') ? 'is-invalid' : ''; ?>" id="applicant_residence" name="applicant_residence">
                      <option value="" disabled selected>Select Residence</option>
                      <option value="DWCC Dormitory" <?= set_select('applicant_residence', 'DWCC Dormitory'); ?>>DWCC Dormitory</option>
                      <option value="Off-Campus Boarding House" <?= set_select('applicant_residence', 'Off-Campus Boarding House'); ?>>Off-Campus Boarding House</option>
                      <option value="With Relative" <?= set_select('applicant_residence', 'With Relative'); ?>>With Relative</option>
                    </select>
                    <?= form_error('applicant_residence', '<div class="invalid-feedback">', '</div>'); ?>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <button type="submit" class="btn btn-primary btn-block">Register</button>
                </div>
              </div>
              <div class="row mt-2">
                <div class="col-12">
                  <a href="<?= site_url('auth/applicant_login'); ?>" class="btn btn-secondary btn-block">Back to Login</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>
  <script src="<?= base_url('assets/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url('assets/') ?>dist/js/adminlte.min.js"></script>
  <script>
    function updateProgramOptions() {
      var programType = document.getElementById("program_type").value;
      var programDropdown = document.getElementById("program");

      programDropdown.innerHTML = "<option value=''>Select Program</option>";
      var programs = <?= json_encode($programs); ?>;

      programs.forEach(function(program) {
        if (programType === "College" && program.program_type === "College") {
          var option = document.createElement("option");
          option.value = program.program_name;
          option.textContent = program.program_name;
          programDropdown.appendChild(option);
        } else if (programType === "Senior High School" && program.program_type === "Senior High School") {
          var option = document.createElement("option");
          option.value = program.program_name;
          option.textContent = program.program_name;
          programDropdown.appendChild(option);
        } else if ((programType === "Junior High School" || programType === "Grade School") && program.program_type === "JHS/Grade School") {
          var option = document.createElement("option");
          option.value = program.program_name;
          option.textContent = program.program_name;
          programDropdown.appendChild(option);
        }
      });
    }
  </script>

  <script>
    function updateFileName(input) {
      const label = input.nextElementSibling;
      const fileName = input.files[0] ? input.files[0].name : 'Choose photo...';
      label.innerText = fileName;
    }
    document.getElementById('applicant_photo').addEventListener('change', function(event) {
      var reader = new FileReader();
      reader.onload = function(e) {
        var img = document.getElementById('photo_preview_img');
        img.src = e.target.result;
        img.style.display = 'block';
      };
      reader.readAsDataURL(event.target.files[0]);
    });

    function updateYearOptions() {
      const programType = document.getElementById('program_type').value;
      const yearSelect = document.getElementById('year');

      yearSelect.innerHTML = '<option value="" disabled selected>Select Year Level</option>';

      let options = [];
      switch (programType) {
        case 'College':
          options = ['5th', '4th', '3rd', '2nd', '1st'];
          break;
        case 'Senior High School':
          options = ['Grade 12', 'Grade 11'];
          break;
        case 'Junior High School':
          options = ['Grade 10', 'Grade 9', 'Grade 8', 'Grade 7'];
          break;
        case 'Grade School':
          options = ['Grade 6', 'Grade 5', 'Grade 4', 'Grade 3', 'Grade 2', 'Grade 1', 'Senior Kinder', 'Junior Kinder', 'Special Education'];
          break;
        default:
          options = [];
      }
      options.forEach(option => {
        const opt = document.createElement('option');
        opt.value = option;
        opt.textContent = option;
        yearSelect.appendChild(opt);
      });
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <?php if ($this->session->flashdata('success')): ?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '<?= $this->session->flashdata('success'); ?>',
        confirmButtonText: 'OK'
      });
    </script>
  <?php elseif ($this->session->flashdata('error')): ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: '<?= $this->session->flashdata('error'); ?>',
        confirmButtonText: 'Try Again'
      });
    </script>
  <?php endif; ?>
</body>

</html>
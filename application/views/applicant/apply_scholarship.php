<?php $this->load->view('includes/applicant_header') ?>
<?php $this->load->view('includes/applicant_sidebar') ?>
<!-- Apply Scholarship -->
<title>Application Form</title>
<div class="content-wrapper">
    <div class="content-header">
        <div class="content">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= base_url('applicant/dashboard_applicant'); ?>">Home</a></li>
                            <li class="breadcrumb-item active">Applicant</li>
                        </ol>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="text-center">
                            <img src="<?= base_url('assets/images/logo.svg'); ?>" alt="Logo" class="img-fluid" style="max-width: 130px;">
                            <h5 class="mt-2 mb-0">Divine Word College of Calapan</h5>
                            <p>Scholarship Management System</p>
                            <p class="mb-0 mt-3 font-weight-bold">APPLICATION FORM</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-warning fade show text-center" role="alert">
                            <strong>Important:</strong> Please double-check all your information. Ensure that all uploaded documents are correct before submitting your application.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?= base_url('applicant/submit_application'); ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="existing_photo" value="<?= $applicant->applicant_photo ?>">
                            <div class="row justify-content-center">
                                <div id="photo_preview" class="mb-5">
                                    <?php if (!empty($applicant->applicant_photo)): ?>
                                        <img src="<?= base_url('uploads/' . $applicant->applicant_photo); ?>" alt="Applicant Photo" id="photo" style="max-width: 200px; object-fit: cover; border: 1px solid black;">
                                    <?php else: ?>
                                        <img src="#" alt="No photo uploaded" id="photo" style="width: 100px; height: 100px; object-fit: cover;">
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="applicant_photo">Upload 2x2 Photo: <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="applicant_photo" name="applicant_photo" accept="image/*" onchange="updateFileName(this); previewImage(event)">
                                            <label class="custom-file-label" for="applicant_photo">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="id_number">ID Number:</label>
                                    <input type="text" class="form-control" id="id_number" name="id_number" value="<?= htmlspecialchars($applicant->id_number); ?>" readonly>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="firstname">First Name:</label>
                                    <input type="text" class="form-control" id="firstname" name="firstname" value="<?= htmlspecialchars($applicant->firstname); ?>" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="middlename">Middle Name:</label>
                                    <input type="text" class="form-control" id="middlename" name="middlename" value="<?= htmlspecialchars($applicant->middlename); ?>" readonly>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="lastname">Last Name:</label>
                                    <input type="text" class="form-control" id="lastname" name="lastname" value="<?= htmlspecialchars($applicant->lastname); ?>" readonly>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="birthdate">Birthdate:</label>
                                    <input type="date" class="form-control" id="birthdate" name="birthdate" value="<?= htmlspecialchars($applicant->birthdate); ?>" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="gender">Gender:</label>
                                    <input type="text" class="form-control" id="gender" name="gender" value="<?= htmlspecialchars($applicant->gender); ?>" readonly>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="contact">Contact Number: </label>
                                    <input type="number" class="form-control" id="contact" name="contact" value="<?= htmlspecialchars($applicant->contact); ?>" readonly>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="email">Email: </label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($applicant->email); ?>" readonly>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="program_type">Program Type:</label>
                                    <input type="text" class="form-control" id="program_type" name="program_type" value="<?= htmlspecialchars($applicant->program_type); ?>" readonly>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="year">Year Level:</label>
                                    <input type="text" class="form-control" id="year" name="year" value="<?= htmlspecialchars($applicant->year); ?>" readonly>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="program">Program:</label>
                                    <input type="text" class="form-control" id="program" name="program" value="<?= htmlspecialchars($applicant->program); ?>" readonly>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="campus">Campus:</label>
                                    <input type="text" class="form-control" id="campus" name="campus" value="<?= htmlspecialchars($applicant->campus); ?>" readonly>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="address">Address:</label>
                                    <input type="text" class="form-control" id="address" name="address" value="<?= htmlspecialchars($applicant->address); ?>" readonly>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="applicant_residence">Applicant Residence:</label>
                                    <input type="text" class="form-control" id="applicant_residence" name="applicant_residence" value="<?= htmlspecialchars($applicant->applicant_residence); ?>" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="academic_year">Academic Year <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="academic_year" name="academic_year"
                                        value="<?php echo isset($active_academic_year) ? $active_academic_year : ''; ?>" readonly>
                                </div>
                                <div class="col-md-6 form-group">
    <label for="semester">Semester <span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="semester" name="semester" 
           value="<?= (!empty($semesters)) ? $default_semester : $default_semester ?>" readonly>
</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="application_type">Application Type: <span class="text-danger">*</span></label>
                                    <select class="form-control" id="application_type" name="application_type" required>
                                        <option value="">Select Application Type</option>
                                        <option value="Renewal">Renewal</option>
                                        <option value="New Applicant">New Applicant</option>
                                    </select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="scholarship_program">Scholarship Program: <span class="text-danger">*</span></label>
                                    <select class="form-control" id="scholarship_program" name="scholarship_program" required>
                                        <option value="" disabled <?= empty($selected_program_code) ? 'selected' : ''; ?>>Select Program</option>
                                        <?php foreach ($scholarship_programs as $program): ?>
                                            <option value="<?= htmlspecialchars($program->scholarship_program); ?>"
                                                <?= isset($selected_program_code) && $selected_program_code == $program->program_code ? 'selected' : ''; ?>>
                                                <?= htmlspecialchars($program->scholarship_program); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="requirements">Upload Requirements: <span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="requirements" name="requirements[]" multiple required>
                                        <label class="custom-file-label" for="requirements">Choose files... </label>
                                    </div>
                                </div>
                                <small class="form-text text-muted">
                                    <strong>Note:</strong> Please upload your documents in the format: [Document-Type]-[Surname] (e.g., Certificate-of-Enrollment-Doe.pdf).
                                </small>
                                <ul id="file-list" class="list-group mt-2"></ul>
                            </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit Application</button>
                        <a href="<?= base_url('applicant/dashboard_applicant'); ?>" class="btn btn-secondary">Back</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php $this->load->view('includes/applicant_footer') ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if ($this->session->flashdata('error')): ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: 'error',
                title: 'Submission Error',
                text: '<?= $this->session->flashdata('error'); ?>',
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false,
            });
        });
    </script>
<?php endif; ?>

<?php if ($this->session->flashdata('success')): ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: 'success',
                title: 'Application Submitted',
                text: '<?= $this->session->flashdata('success'); ?>',
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false,
            });
        });
    </script>
<?php endif; ?>
<script>
    function updateFileName(input) {
        const label = input.nextElementSibling;
        const fileName = input.files[0] ? input.files[0].name : 'Choose photo...';
        label.innerText = fileName;
    }

    document.addEventListener('DOMContentLoaded', function() {
        const photoInput = document.getElementById('applicant_photo');
        const photoLabel = photoInput.nextElementSibling;
        const existingPhoto = "<?= !empty($applicant->applicant_photo) ? $applicant->applicant_photo : 'Choose file'; ?>";

        photoLabel.innerText = existingPhoto;
    });

    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('photo');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }


    document.getElementById('requirements').addEventListener('change', function(e) {
        const allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf'];
        const files = e.target.files;

        for (let i = 0; i < files.length; i++) {
            const fileExtension = files[i].name.split('.').pop().toLowerCase();
            if (!allowedExtensions.includes(fileExtension)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid File Type',
                    text: 'Please upload files in the format: jpg, jpeg, png or pdf only.',
                });
                e.target.value = '';
                break;
            }
        }
    });
    document.getElementById('requirements').addEventListener('change', function(event) {
        const fileList = document.getElementById('file-list');
        fileList.innerHTML = '';

        const files = event.target.files;
        Array.from(files).forEach((file, index) => {
            const listItem = document.createElement('li');
            listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
            listItem.textContent = file.name;

            const removeButton = document.createElement('button');
            removeButton.className = 'btn btn-danger btn-sm';
            removeButton.innerHTML = '<i class="fas fa-times"></i>';
            removeButton.title = 'Remove';
            removeButton.addEventListener('click', () => {
                fileList.removeChild(listItem);
                const dataTransfer = new DataTransfer();
                Array.from(event.target.files).forEach((f, i) => {
                    if (i !== index) {
                        dataTransfer.items.add(f);
                    }
                });
                event.target.files = dataTransfer.files;
            });

            listItem.appendChild(removeButton);
            fileList.appendChild(listItem);
        });
    });
</script>
<?php $this->load->view('includes/applicant_header'); ?>
<?php $this->load->view('includes/applicant_sidebar'); ?>
<title>Edit Application</title>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('applicant/dashboard_applicant'); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('applicant/my_application'); ?>">My Application</a></li>
                        <li class="breadcrumb-item active">Applicant</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <div class="text-center">
                    <img src="<?= base_url('assets/images/logo.svg'); ?>" alt="Logo" class="img-fluid" style="max-width: 130px;">
                    <h5 class="mt-2 mb-0">Divine Word College of Calapan</h5>
                    <p>Scholarship Management System</p>
                    <p class="mb-0 mt-3 font-weight-bold">EDIT APPLICATION FORM</p>
                </div>
            </div>
            <div class="card-body">
                <?= form_open_multipart('applicant/update_application'); ?>
                <div class="row">
                    <!-- Applicant Photo -->
                    <div class="col-md-4">
                        <div class="mb-3">
                            <p><strong>Applicant Photo:</strong></p>
                            <?php if (!empty($application->applicant_photo)): ?>
                                <img src="<?= base_url('uploads/' . $application->applicant_photo) ?>" alt="Applicant Photo" class="img-fluid mb-2" style="max-width: 200px; object-fit: cover; border: 1px solid black;">
                            <?php else: ?>
                                <p>No photo uploaded.</p>
                            <?php endif; ?>
                            <div class="input-group mb-3">
                                <input type="file" class="form-control d-none" id="applicant_photo" name="applicant_photo" accept="image/*" onchange="previewPhoto(this)">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-secondary rounded" onclick="document.getElementById('applicant_photo').click();">Choose Photo</button>
                                </div>
                            </div>

                            <div class="preview-container" style="display: none;">
                                <p><strong>Preview Image:</strong></p>
                                <img id="photo_preview" class="img-fluid mb-2" style="max-width: 200px; object-fit: cover; border: 1px solid black;" alt="Photo Preview">
                            </div>
                        </div>
                    </div>
                    <!-- Application Details -->
                    <div class="col-md-12">
                        <!-- Personal Information -->
                        <h5 class="mb-3">Personal Information</h5>
                        <form>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="applicantNo">Applicant No:</label>
                                    <input type="text" class="form-control" id="applicantNo" name="applicant_no" value="<?= htmlspecialchars($application->applicant_no); ?>" readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="idNumber">ID Number:</label>
                                    <input type="text" class="form-control" id="idNumber" name="id_number" value="<?= htmlspecialchars($application->id_number); ?>" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="fullName">Full Name:</label>
                                    <input type="text" class="form-control" id="fullName" name="full_name" value="<?= htmlspecialchars($application->firstname . ' ' . $application->middlename . ' ' . $application->lastname); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="birthdate">Birthdate:</label>
                                    <input type="text" class="form-control" id="birthdate" name="birthdate" value="<?= htmlspecialchars($application->birthdate); ?>" readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="gender">Gender:</label>
                                    <input type="text" class="form-control" id="gender" name="gender" value="<?= htmlspecialchars($application->gender); ?>" readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="contact">Contact:</label>
                                    <input type="text" class="form-control" id="contact" name="contact" value="<?= htmlspecialchars($application->contact); ?>" readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($application->email); ?>" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="address">Address:</label>
                                    <input type="text" class="form-control" id="address" name="address" value="<?= htmlspecialchars($application->address); ?>" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="applicant_residence">Applicant Residence:</label>
                                    <select class="form-control" id="applicant_residence" name="applicant_residence" required>
                                        <option value="" disabled>Select Residence</option>
                                        <option value="DWCC Dormitory" <?= $application->applicant_residence == 'DWCC Dormitory' ? 'selected' : ''; ?>>DWCC Dormitory</option>
                                        <option value="Off-Campus Boarding House" <?= $application->applicant_residence == 'Off-Campus Boarding House' ? 'selected' : ''; ?>>Off-Campus Boarding House</option>
                                        <option value="With a Relative" <?= $application->applicant_residence == 'With a Relative' ? 'selected' : ''; ?>>With a Relative</option>
                                        <option value="Other" <?= $application->applicant_residence == 'Other' ? 'selected' : ''; ?>>Other</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Academic Information -->
                            <h5 class="mb-3 mt-4">Academic Information</h5>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="applicationType">Application Type:</label>
                                    <input type="text" class="form-control" id="applicationType" name="application_type" value="<?= htmlspecialchars($application->application_type); ?>" readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="campus">Campus:</label>
                                    <input type="text" class="form-control" id="campus" name="campus" value="<?= htmlspecialchars($application->campus); ?>" readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="academic_year">Academic Year:</label>
                                    <input type="text" class="form-control" id="academic_year" name="academic_year" value="<?= htmlspecialchars($application->academic_year); ?>" readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="semester">Semester:</label>
                                    <input type="text" class="form-control" id="semester" name="semester" value="<?= htmlspecialchars($application->semester); ?>" readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="year">Year:</label>
                                    <input type="text" class="form-control" id="year" name="year" value="<?= htmlspecialchars($application->year); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="program">Program:</label>
                                    <input type="text" class="form-control" id="program" name="program" value="<?= htmlspecialchars($application->program); ?>" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="scholarshipProgram">Scholarship Program:</label>
                                    <input type="text" class="form-control" id="scholarshipProgram" name="scholarship_program" value="<?= htmlspecialchars($application->scholarship_program); ?>" readonly>
                                </div>
                            </div>
                            <input type="hidden" id="remove-requirements" name="remove_requirements[]" value="">
                            <h5 class="mb-3 mt-4">Uploaded Requirements:</h5>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="requirements" name="requirements[]" multiple>
                                    <label class="custom-file-label" for="requirements">Choose files...</label>
                                </div>
                            </div>
                            <small class="form-text text-muted">
                                <strong>Note:</strong> Please upload your documents in the format: [Document-Type]-[Surname] (e.g., Certificate-of-Enrollment-Doe).
                            </small>
                            <ul id="file-list" class="list-group mt-2">
                                <?php if (!empty($existing_requirements)): ?>
                                    <?php foreach ($existing_requirements as $file): ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <?php echo htmlspecialchars($file); ?>
                                            <button class="btn btn-danger btn-sm remove-file" title="Remove" data-file="<?php echo htmlspecialchars($file); ?>">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                    </div>
                </div>
            </div>
            <!-- Buttons -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update Application</button>
                <a href="<?= site_url('applicant/view_form/' . $application->applicant_no); ?>" class="btn btn-secondary">Back</a>
            </div>
            </form>
        </div>
        <?= form_close(); ?>
    </section>
</div>
<?php $this->load->view('includes/applicant_footer'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('requirements').addEventListener('change', function(e) {
        const allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf', 'docx'];
        const files = e.target.files;

        // Check for valid file extensions
        for (let i = 0; i < files.length; i++) {
            const fileExtension = files[i].name.split('.').pop().toLowerCase();
            if (!allowedExtensions.includes(fileExtension)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid File Type',
                    text: 'Please upload files in the format: jpg, jpeg, png, docx, or pdf only.',
                });
                e.target.value = '';
                return;
            }
        }
        const fileList = document.getElementById('file-list');
        // Append new files to the existing list
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
                Array.from(e.target.files).forEach((f, i) => {
                    if (i !== index) {
                        dataTransfer.items.add(f);
                    }
                });
                e.target.files = dataTransfer.files;
            });

            listItem.appendChild(removeButton);
            fileList.appendChild(listItem);
        });
    });

    document.querySelectorAll('.remove-file').forEach(button => {
        button.addEventListener('click', function() {
            const fileName = this.getAttribute('data-file');
            const listItem = this.parentElement;

            listItem.remove();

            const removeRequirementsInput = document.getElementById('remove-requirements');
            let removedFiles = removeRequirementsInput.value.split(',').filter(Boolean);
            removedFiles.push(fileName); // Add the removed file
            removeRequirementsInput.value = removedFiles.join(',');
        });
    });

    function previewPhoto(input) {
        const file = input.files[0];
        const previewContainer = document.querySelector('.preview-container');
        const photoPreview = document.getElementById('photo_preview');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                photoPreview.src = e.target.result;
                previewContainer.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            photoPreview.src = '';
            previewContainer.style.display = 'none';
        }
    }
</script>
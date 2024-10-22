<?php $this->load->view('includes/applicant_header'); ?>
<?php $this->load->view('includes/applicant_sidebar'); ?>
<title>View Application</title>
<div class="content-wrapper">
    <section class="content-header">
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
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header text-center">
                <img src="<?= base_url('assets/images/logo.svg'); ?>" alt="Logo" class="img-fluid" style="max-width: 130px;">
                <h5 class="mt-2 mb-0">Divine Word College of Calapan</h5>
                <p>Scholarship Management System</p>
                <p class="mb-0 mt-3 font-weight-bold">MY APPLICATION FORM</p>
            </div>

            <div class="card-body">
                <div class="row">
                    <!-- Applicant Photo -->
                    <div class="col-md-6">
                        <p><strong>Applicant Photo:</strong></p>
                        <img src="<?= base_url('uploads/' . $application->applicant_photo); ?>" alt="Applicant Photo" class="img-fluid mb-3" style="max-width:200px; object-fit:cover; border: 1px solid black;">
                    </div>

                    <!-- Application Details -->
                    <div class="col-md-12">
                        <!-- Personal Information -->
                        <h5 class="mb-3">Personal Information</h5>
                        <form>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="applicantNo">Applicant No:</label>
                                    <input type="text" class="form-control" id="applicantNo" value="<?= htmlspecialchars($application->applicant_no); ?>" readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="idNumber">ID Number:</label>
                                    <input type="text" class="form-control" id="idNumber" value="<?= htmlspecialchars($application->id_number); ?>" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="fullName">Full Name:</label>
                                    <input type="text" class="form-control" id="fullName" value="<?= htmlspecialchars($application->firstname . ' ' . $application->middlename . ' ' . $application->lastname); ?>" readonly>
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="birthdate">Birthdate:</label>
                                    <input type="text" class="form-control" id="birthdate" value="<?= htmlspecialchars($application->birthdate); ?>" readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="gender">Gender:</label>
                                    <input type="text" class="form-control" id="gender" value="<?= htmlspecialchars($application->gender); ?>" readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="contact">Contact:</label>
                                    <input type="text" class="form-control" id="contact" value="<?= htmlspecialchars($application->contact); ?>" readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" id="email" value="<?= htmlspecialchars($application->email); ?>" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="address">Address:</label>
                                    <input type="text" class="form-control" id="address" value="<?= htmlspecialchars($application->address); ?>" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="applicant_residence">Applicant Residence:</label>
                                    <input type="text" class="form-control" id="applicant_residence" value="<?= htmlspecialchars($application->applicant_residence); ?>" readonly>
                                </div>

                            </div>

                            <!-- Academic Information -->
                            <h5 class="mb-3 mt-4">Academic Information</h5>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="applicationType">Application Type:</label>
                                    <input type="text" class="form-control" id="applicationType" value="<?= htmlspecialchars($application->application_type); ?>" readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="campus">Campus:</label>
                                    <input type="text" class="form-control" id="campus" value="<?= htmlspecialchars($application->campus); ?>" readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="academic_year">Academic Year:</label>
                                    <input type="text" class="form-control" id="academic_year" value="<?= htmlspecialchars($application->academic_year); ?>" readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="semester">Semester:</label>
                                    <input type="text" class="form-control" id="semester" value="<?= htmlspecialchars($application->semester); ?>" readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="year">Year:</label>
                                    <input type="text" class="form-control" id="year" value="<?= htmlspecialchars($application->year); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="program">Program:</label>
                                    <input type="text" class="form-control" id="program" value="<?= htmlspecialchars($application->program); ?>" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="scholarshipProgram">Scholarship Program:</label>
                                    <input type="text" class="form-control" id="scholarshipProgram" value="<?= htmlspecialchars($application->scholarship_program); ?>" readonly>
                                </div>
                            </div>
                            <!-- Uploaded Requirements -->
                            <h5 class="mb-3 mt-4">Uploaded Requirements</h5>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="list-group">
                                        <?php
                                        $requirements = explode(',', $application->requirements);
                                        foreach ($requirements as $file_name):
                                            $file_path = base_url('uploads/' . $file_name);
                                            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
                                        ?>
                                            <a href="<?= $file_path; ?>" target="_blank" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h6 class="mb-1"><?= htmlspecialchars($file_name); ?></h6>
                                                    <small class="text-muted"><?= strtoupper($file_ext); ?></small>
                                                </div>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <!-- Buttons -->
                            <div class="form-group mt-3 text-right">
                                <?php if ($application->status == 'qualified' || $application->status == 'not qualified'): ?>
                                    <button type="button" class="btn btn-primary" onclick="showAlert()">Edit Application</button>
                                <?php else: ?>
                                    <a href="<?= site_url('applicant/edit_application/' . $application->applicant_no); ?>" class="btn btn-primary">Edit Application</a>
                                <?php endif; ?>
                                <a href="<?= site_url('applicant/my_application'); ?>" class="btn btn-secondary">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function showAlert() {
    Swal.fire({
        icon: 'warning',
        title: 'Access Denied',
        text: 'You are not allowed to edit your application at this time.',
        confirmButtonText: 'OK'
    });
}
</script>

<?php $this->load->view('includes/applicant_footer'); ?>
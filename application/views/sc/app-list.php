<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>
<title>Application Information List</title>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Applicant Information List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('sc/dashboard'); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('sc/program_app_list'); ?>">Program List</a></li>
                        <li class="breadcrumb-item active">Applicant List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">List of Applicants</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Applicant No.</th>
                                    <th>ID Number</th>
                                    <th>Full Name</th>
                                    <th>Program Type</th>
                                    <th>Scholarship Program</th>
                                    <th>Application Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($applicants) && !empty($applicants)): ?>
                                    <?php foreach ($applicants as $applicant): ?>
                                        <tr>
                                            <td><?= $applicant->applicant_no; ?></td>
                                            <td><?= $applicant->id_number ?></td>
                                            <td><?= htmlspecialchars($applicant->firstname . ' ' . (!empty($applicant->middlename) ? $applicant->middlename . ' ' : '') . $applicant->lastname); ?></td>
                                            <td><?= $applicant->program_type; ?></td>
                                            <td><?= $applicant->scholarship_program; ?></td>
                                            <td><?= $applicant->application_type; ?></td>
                                            <td><?= ucwords($applicant->status); ?></td>
                                            <td>
                                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#viewModal"
                                                    data-id="<?= $applicant->applicant_no; ?>"
                                                    data-id_number="<?= $applicant->id_number; ?>"
                                                    data-firstname="<?= $applicant->firstname; ?>"
                                                    data-middlename="<?= $applicant->middlename; ?>"
                                                    data-lastname="<?= $applicant->lastname; ?>"
                                                    data-program="<?= $applicant->program; ?>"
                                                    data-year="<?= $applicant->year; ?>"
                                                    data-campus="<?= $applicant->campus; ?>"
                                                    data-program_type="<?= $applicant->program_type; ?>"
                                                    data-contact="<?= $applicant->contact; ?>"
                                                    data-email="<?= $applicant->email; ?>"
                                                    data-birthdate="<?= $applicant->birthdate; ?>"
                                                    data-scholarship_program="<?= $applicant->scholarship_program; ?>"
                                                    data-address="<?= $applicant->address; ?>">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="8" class="text-center">No applicants found for this program.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- View Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">Applicant Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <dl class="row">
                    <dt class="col-sm-4">ID Number:</dt>
                    <dd class="col-sm-8" id="viewIdNumber"></dd>
                    <dt class="col-sm-4">First Name:</dt>
                    <dd class="col-sm-8" id="viewFirstname"></dd>
                    <dt class="col-sm-4">Middle Name:</dt>
                    <dd class="col-sm-8" id="viewMiddlename"></dd>
                    <dt class="col-sm-4">Last Name:</dt>
                    <dd class="col-sm-8" id="viewLastname"></dd>
                    <dt class="col-sm-4">Program:</dt>
                    <dd class="col-sm-8" id="viewProgram"></dd>
                    <dt class="col-sm-4">Year:</dt>
                    <dd class="col-sm-8" id="viewYear"></dd>
                    <dt class="col-sm-4">Campus:</dt>
                    <dd class="col-sm-8" id="viewCampus"></dd>
                    <dt class="col-sm-4">Program Type:</dt>
                    <dd class="col-sm-8" id="viewProgramType"></dd>
                    <dt class="col-sm-4">Contact:</dt>
                    <dd class="col-sm-8" id="viewContact"></dd>
                    <dt class="col-sm-4">Email:</dt>
                    <dd class="col-sm-8" id="viewEmail"></dd>
                    <dt class="col-sm-4">Birthdate:</dt>
                    <dd class="col-sm-8" id="viewBirthdate"></dd>
                    <dt class="col-sm-4">Scholarship Program:</dt>
                    <dd class="col-sm-8" id="viewScholarshipProgram"></dd>
                    <dt class="col-sm-4">Address:</dt>
                    <dd class="col-sm-8" id="viewAddress"></dd>
                </dl>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('includes/footer'); ?>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {


        $('#viewModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var idNumber = button.data('id_number');
            var firstname = button.data('firstname');
            var middlename = button.data('middlename');
            var lastname = button.data('lastname');
            var program = button.data('program');
            var year = button.data('year');
            var campus = button.data('campus');
            var program_type = button.data('program_type');
            var contact = button.data('contact');
            var email = button.data('email');
            var birthdate = button.data('birthdate');
            var scholarshipProgram = button.data('scholarship_program');
            var address = button.data('address');

            var modal = $(this);
            modal.find('#viewIdNumber').text(idNumber);
            modal.find('#viewFirstname').text(firstname);
            modal.find('#viewMiddlename').text(middlename);
            modal.find('#viewLastname').text(lastname);
            modal.find('#viewProgram').text(program);
            modal.find('#viewYear').text(year);
            modal.find('#viewCampus').text(campus);
            modal.find('#viewProgramType').text(program_type);
            modal.find('#viewContact').text(contact);
            modal.find('#viewEmail').text(email);
            modal.find('#viewBirthdate').text(birthdate);
            modal.find('#viewScholarshipProgram').text(scholarshipProgram);
            modal.find('#viewAddress').text(address);
        });
    });

    function confirmDeactivation(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, deactivate it!'
        }).then((result) => {
            if (result.isConfirmed) {}
        });
    }
</script>
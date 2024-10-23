<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>
<title>Applicant Accounts</title>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Applicant Accounts</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Acccount List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <!-- Accepted Applicants Table -->
            <div class="card">
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>ID Number</th>
                                <th>Full Name</th>
                                <th>Campus</th>
                                <th>Program Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($applicants as $applicant): ?>
                                <tr>
                                    <td><?= $applicant->id_number; ?></td>
                                    <td><?= htmlspecialchars($applicant->firstname . ' ' . (!empty($applicant->middlename) ? $applicant->middlename . ' ' : '') . $applicant->lastname); ?></td>
                                    <td><?= $applicant->campus; ?></td>
                                    <td><?= $applicant->program_type; ?></td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#updateModal" data-id="<?= $applicant->account_no; ?>" data-firstname="<?= $applicant->firstname; ?>" data-middlename="<?= $applicant->middlename; ?>" data-lastname="<?= $applicant->lastname; ?>" data-birthdate="<?= $applicant->birthdate; ?>" data-contact="<?= $applicant->contact; ?>" data-email="<?= $applicant->email; ?>" data-campus="<?= $applicant->campus; ?>"  data-program_type="<?= $applicant->program_type; ?>" data-year="<?= $applicant->year; ?>"  data-program="<?= $applicant->program; ?>" data-address="<?= $applicant->address; ?>" data-applicant_residence="<?= $applicant->applicant_residence; ?>">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <?php if ($applicant->account_status == 'active'): ?>
                                            <button class="btn btn-danger btn-sm toggle-status" data-id="<?= $applicant->account_no; ?>" data-status="deactivate">
                                                <i class="fas fa-user-slash"></i>
                                            </button>
                                        <?php else: ?>
                                            <button class="btn btn-success btn-sm toggle-status" data-id="<?= $applicant->account_no; ?>" data-status="activate">
                                                <i class="fas fa-user-check"></i>
                                            </button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- View Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">View Applicant Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="account_no" id="account_no">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="firstname">First Name</label>
                        <p id="firstname" class="form-control-plaintext"></p>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="middlename">Middle Name</label>
                        <p id="middlename" class="form-control-plaintext"></p>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="lastname">Last Name</label>
                        <p id="lastname" class="form-control-plaintext"></p>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="birthdate">Birthdate</label>
                        <p id="birthdate" class="form-control-plaintext"></p>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="contact">Contact Number</label>
                        <p id="contact" class="form-control-plaintext"></p>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <p id="email" class="form-control-plaintext"></p>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="program_type">Program Type</label>
                        <p id="program_type" class="form-control-plaintext"></p>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="campus">Campus</label>
                        <p id="campus" class="form-control-plaintext"></p>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="year">Year</label>
                        <p id="year" class="form-control-plaintext"></p>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="program">Program</label>
                        <p id="program" class="form-control-plaintext"></p>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="address">Address</label>
                        <p id="address" class="form-control-plaintext"></p>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="applicant_residence">Applicant Residence</label>
                        <p id="applicant_residence" class="form-control-plaintext"></p>
                    </div>
                </div>
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
    $(function() {
        // Initialize DataTable
        $('#applicantTable').DataTable();

        // Show modal with pre-filled data
        $('#updateModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var firstname = button.data('firstname');
            var middlename = button.data('middlename');
            var lastname = button.data('lastname');
            var birthdate = button.data('birthdate');
            var contact = button.data('contact');
            var email = button.data('email');
            var campus = button.data('campus');
            var program_type = button.data('program_type');
            var year = button.data('year');
            var program = button.data('program');
            var address = button.data('address');
            var applicant_residence = button.data('applicant_residence');

            var modal = $(this);
            modal.find('#account_no').val(id);
            modal.find('#firstname').text(firstname);
            modal.find('#middlename').text(middlename);
            modal.find('#lastname').text(lastname);
            modal.find('#birthdate').text(birthdate);
            modal.find('#contact').text(contact);
            modal.find('#email').text(email);
            modal.find('#campus').text(campus);
            modal.find('#program_type').text(program_type);
            modal.find('#year').text(year);
            modal.find('#program').text(program);
            modal.find('#address').text(address);
            modal.find('#applicant_residence').text(applicant_residence);
        });
    });

    $(document).on('click', '.toggle-status', function() {
        var applicantId = $(this).data('id');
        var newStatus = $(this).data('status');

        Swal.fire({
            title: 'Are you sure?',
            text: "You are about to " + newStatus + " this account.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, ' + newStatus + ' it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url('admin/toggle_applicant_status'); ?>',
                    method: 'POST',
                    data: {
                        account_no: applicantId,
                        status: newStatus
                    },
                    dataType: 'json', // Ensure the response is treated as JSON
                    success: function(response) {
                        if (response.success) {
                            Swal.fire('Success', 'Account status updated!', 'success');
                            location.reload(); // Reload page after status change
                        } else {
                            Swal.fire('Error', 'Something went wrong. Please try again.', 'error');
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire('Error', 'An error occurred: ' + error, 'error');
                    }
                });
            }
        });
    });
</script>
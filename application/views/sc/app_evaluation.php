<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>
<title>Application Evaluation</title>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Application Evaluation</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('sc/dashboard'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Application Evaluation</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List of Shortlisted Applicants</h3>
            </div>
            <div class="card-body">
                <div class="card-tools mb-3">
                    <form id="filterForm" class="d-flex">
                        <div class="row align-items-end">
                            <div class="form-group col-md-3">
                                <select name="semester" id="semester" class="form-control">
                                    <option value="">Select Semester</option>
                                    <option value="1st Semester" <?= ($this->input->post('semester') == '1st Semester') ? 'selected' : ''; ?>>1st Semester</option>
                                    <option value="2nd Semester" <?= ($this->input->post('semester') == '2nd Semester') ? 'selected' : ''; ?>>2nd Semester</option>
                                    <option value="Whole Semester" <?= ($this->input->post('semester') == 'Whole Semester') ? 'selected' : ''; ?>>Whole Semester</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <select name="scholarship_program" id="scholarship_program" class="form-control">
                                    <option value="">Select Scholarship Program</option>
                                    <?php foreach ($scholarship_programs as $program): ?>
                                        <option value="<?= htmlspecialchars($program->scholarship_program); ?>" <?= set_value('scholarship_program') == $program->scholarship_program ? 'selected' : ''; ?>>
                                            <?= htmlspecialchars($program->scholarship_program); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <select name="status" id="status" class="form-control">
                                    <option value=""> Select Status</option>
                                    <option value="qualified" <?= ($this->input->post('status') == 'qualified') ? 'selected' : ''; ?>>Qualified</option>
                                    <option value="conditional" <?= ($this->input->post('status') == 'conditional') ? 'selected' : ''; ?>>Conditional</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <button type="button" class="btn btn-secondary btn-block" id="resetFilters">Reset Filters</button>
                            </div>
                        </div>
                    </form>
                </div>
                <form id="finalListForm" method="POST" action="<?= site_url('sc/submit_final_list'); ?>">
                    <div class="table-responsive">
                        <table id="apptable" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Last Name</th>
                                    <th>First Name</th>
                                    <th>Academic Year</th>
                                    <th>Semester</th>
                                    <th>Scholarship Program</th>
                                    <th>Application Type</th>
                                    <th>Discount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($shortlist)): ?>
                                    <?php foreach ($shortlist as $entry): ?>
                                        <tr>
                                           
                                            <td><?= $entry->lastname; ?></td>
                                            <td><?= $entry->firstname; ?></td>
                                            <td><?= $entry->academic_year; ?></td>
                                            <td><?= $entry->semester; ?></td>
                                            <td><?= $entry->scholarship_program; ?></td>
                                            <td><?= $entry->application_type; ?></td>
                                            <td><?= $entry->discount; ?></td>
                                            <td><?= ucwords($entry->status); ?></td>
                                            <td>
                                                <a href="<?= site_url('sc/view_shortlist_applicant/' . $entry->applicant_no); ?>" class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye toogle-status" title="View Application"></i>
                                                </a>
                                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#evaluateModal" data-id="<?= $entry->applicant_no ?>" data-name="<?= htmlspecialchars($entry->firstname . ' ' . $entry->lastname) ?>" data-status="<?= $entry->status ?>" data-discount="<?= $entry->discount ?>">
                                                    <i class="fas fa-edit toogle-status" title="Evaluate"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="9" class="text-center">No shortlisted applicants found</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<!-- Evaluation Modal -->
<div class="modal fade" id="evaluateModal" tabindex="-1" role="dialog" aria-labelledby="evaluateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="evaluateModalLabel">Evaluate Applicant</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="evaluateApplicantForm" method="POST" action="<?= site_url('sc/update_shortlist'); ?>">
                <div class="modal-body">
                    <input type="hidden" name="applicant_no" id="applicant_no">
                    <div class="form-group">
                        <label for="applicant_name">Full Name</label>
                        <input type="text" class="form-control" id="applicant_name" disabled>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="status">Status</label>
                            <select class="form-control" name="status" id="status">
                                <option value="qualified">Qualified</option>
                                <option value="not qualified">Not Qualified</option>
                                <option value="conditional">Conditional</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="discount">Discount</label>
                            <input type="number" class="form-control" name="discount" id="discount" min="0" max="100">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="comment">Comment (Optional)</label>
                        <textarea class="form-control" name="comment" id="comment" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="submitToFinalList">Submit to Official List</button>
                    <div class="ml-auto">
                        <button type="submit" class="btn btn-primary" id="saveChangesButton">Save Changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $this->load->view('includes/footer'); ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if ($this->session->flashdata('success')): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'Application updated successfully.',
            showConfirmButton: true
        });
    </script>
<?php endif; ?>

<script>
    $(document).ready(function() {
        var table = $('#apptable').DataTable({});
        $('select[name="semester"], select[name="scholarship_program"], select[name="status"]').on('change', function() {
            var semester = $('select[name="semester"]').val();
            var scholarship_program = $('select[name="scholarship_program"]').val();
            var status = $('select[name="status"]').val();

            table.columns(3).search(semester)
                .columns(4).search(scholarship_program)
                .columns(6).search(status ? '^' + status + '$' : '', true, false)
                .draw();
        });
        // Reset all filters
        $('#resetFilters').on('click', function() {

            $('select[name="semester"]').val('');
            $('select[name="scholarship_program"]').val('');
            $('select[name="status"]').val('');
            table.columns().search('').draw();
        });

        $('#evaluateModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var name = button.data('name');
            var status = button.data('status');
            var discount = button.data('discount');
            var comment = button.data('comment');

            var modal = $(this);
            modal.find('#applicant_no').val(id);
            modal.find('#applicant_name').val(name);
            modal.find('#status').val(status);
            modal.find('#discount').val(discount);
            modal.find('#comment').val(comment);
        });

        $('#evaluateApplicantForm').on('submit', function() {
            var button = $('#saveChangesButton');
            button.prop('disabled', true).text('Saving...');
        });

        // Submit to Final List
        $('#submitToFinalList').on('click', function() {
            var shortlistId = $('#applicant_no').val();
            var name = $('#applicant_name').val();
            var discount = $('#discount').val();
            var status = $('#status').val();

            Swal.fire({
                title: 'Are you sure?',
                text: `You are about to submit ${name} to the final list.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, submit!',
                cancelButtonText: 'No, cancel!'
            }).then((result) => {
                if (result.isConfirmed) {
                    var data = {
                        applicant_no: shortlistId,
                        applicant_name: name,
                        discount: discount,
                    };
                    $(this).prop('disabled', true).text('Submitting...');

                    $.ajax({
                        url: "<?= site_url('sc/submit_to_final_list'); ?>",
                        type: "POST",
                        data: data,
                        dataType: "json",
                        success: function(response) {
                            if (response.status === 'success') {
                                Swal.fire('Success', 'Applicant submitted to final list!', 'success').then(() => {
                                    location.reload();
                                });
                                $('#evaluateModal').modal('hide');
                            } else {
                                Swal.fire('Error', response.message || 'An unexpected error occurred.', 'error');
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire('Error', xhr.responseJSON?.message || 'There was an error submitting the applicant.', 'error');
                        },
                        complete: function() {
                            $('#submitToFinalList').prop('disabled', false).text('Submit to Final List');
                        }
                    });
                }
            });
        });
    });
</script>
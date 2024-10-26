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
                                <select name="academic_year" id="academic_year" class="form-control">
                                    <option value="">Select Academic Year</option>
                                    <?php foreach ($academic_years as $year): ?>
                                        <option value="<?= htmlspecialchars($year->academic_year); ?>" <?= set_value('academic_year') == $year->academic_year ? 'selected' : ''; ?>>
                                            <?= htmlspecialchars($year->academic_year); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
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
                                    <th>Id Number</th>
                                    <th>Full Name</th>
                                    <th>Academic Year</th>
                                    <th>Semester</th>
                                    <th>Scholarship Program</th>
                                    <th>Application Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($shortlist)): ?>
                                    <?php foreach ($shortlist as $entry): ?>
                                        <tr>
                                            <td><?= $entry->id_number; ?></td>
                                            <td><?= htmlspecialchars($entry->firstname . ' ' . (!empty($entry->middlename) ? $entry->middlename . ' ' : '') . $entry->lastname); ?></td>
                                            <td><?= $entry->academic_year; ?></td>
                                            <td><?= $entry->semester; ?></td>
                                            <td><?= $entry->scholarship_program; ?></td>
                                            <td><?= $entry->application_type; ?></td>
                                            <td><?= ucwords($entry->status); ?></td>
                                            <td>
                                                <a href="<?= site_url('sc/view_shortlist_applicant/' . $entry->shortlist_id); ?>" class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#evaluateModal" data-id="<?= $entry->shortlist_id ?>" data-name="<?= htmlspecialchars($entry->firstname . ' ' . $entry->lastname) ?>" data-status="<?= $entry->status ?>" data-discount="<?= $entry->discount ?>">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center">No shortlisted applicants found</td>
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
                    <input type="hidden" name="shortlist_id" id="shortlist_id">
                    <div class="form-group">
                        <label for="applicant_name">Full Name</label>
                        <input type="text" class="form-control" id="applicant_name" disabled>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="qualified">Qualified</option>
                            <option value="not qualified">Not Qualified</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="discount">Discount</label>
                        <input type="number" class="form-control" name="discount" id="discount" min="0" max="100">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="submitToFinalList">Submit to Final List</button>
                    <div class="ml-auto">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $this->load->view('includes/footer'); ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        var table = $('#apptable').DataTable({

        });

        $('select[name="academic_year"], select[name="semester"], select[name="scholarship_program"]').on('change', function() {
            var academic_year = $('select[name="academic_year"]').val();
            var semester = $('select[name="semester"]').val();
            var scholarship_program = $('select[name="scholarship_program"]').val();

            table.columns(2).search(academic_year)
                .columns(3).search(semester)
                .columns(4).search(scholarship_program)
                .draw();
        });

        // Reset filters
        $('#resetFilters').on('click', function() {
            $('select[name="academic_year"]').val('');
            $('select[name="semester"]').val('');
            $('select[name="scholarship_program"]').val('');
            table.columns().search('').draw();
        });

        // Modal functionality for evaluating applicants
        $('#evaluateModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var name = button.data('name');
            var status = button.data('status');
            var discount = button.data('discount');

            // Update the modal's content
            var modal = $(this);
            modal.find('#shortlist_id').val(id);
            modal.find('#applicant_name').val(name);
            modal.find('#status').val(status);
            modal.find('#discount').val(discount);
        });

        // Submit to Final List
        $('#submitToFinalList').on('click', function() {
            var shortlistId = $('#shortlist_id').val();
            var name = $('#applicant_name').val();
            var discount = $('#discount').val();
            var status = $('#status').val();

            if (status.toLowerCase() !== 'qualified') {
                Swal.fire('Error', 'Only qualified applicants can be submitted to the final list.', 'error');
                return;
            }

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
                        shortlist_id: shortlistId,
                        applicant_name: name,
                        discount: discount,
                    };
                    $(this).prop('disabled', true).text('Submitting...');

                    $.ajax({
                        url: "<?= site_url('sc/submit_to_final_list'); ?>",
                        type: "POST",
                        data: data,
                        success: function(response) {
                            Swal.fire('Success', 'Applicant submitted to final list!', 'success').then(() => {
                                location.reload();
                            });
                            $('#evaluateModal').modal('hide');
                        },
                        error: function(xhr, status, error) {
                            Swal.fire('Error', 'There was an error submitting the applicant.', 'error');
                        },
                        complete: function() {
                            // Re-enable the button and reset text
                            $('#submitToFinalList').prop('disabled', false).text('Submit to Final List');
                        }
                    });
                }
            });
        });
    });
</script>
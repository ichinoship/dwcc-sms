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
                <h3 class="card-title">List of Approved Applicants</h3>
            </div>
            <div class="card-body">
                <form id="finalListForm" method="POST" action="<?= site_url('sc/submit_final_list'); ?>">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id Number</th>
                                    <th>Full Name</th>
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
                                            <td><?= $entry->scholarship_program; ?></td>
                                            <td><?= $entry->application_type; ?></td>
                                            <td><?= ucwords($entry->status); ?></td>
                                            <td>
                                                <a href="<?= site_url('sc/view_shortlist_applicant/' . $entry->shortlist_id); ?>" class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <!-- Button to open evaluation modal -->
                                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#evaluateModal" data-id="<?= $entry->shortlist_id ?>" data-name="<?= htmlspecialchars($entry->firstname . ' ' . $entry->lastname) ?>" data-status="<?= $entry->status ?>" data-discount="<?= $entry->discount ?>">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center">No shortlisted applicants found</td>
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
</script>

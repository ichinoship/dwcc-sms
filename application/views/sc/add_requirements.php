<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>
<title>Add Requirements</title>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add Requirements</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('sc/dashboard'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Add Requirements</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Form Card -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add New Requirement</h3>
                        </div>
                        <form method="post" action="<?= base_url('sc/add_requirements'); ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="requirement_name">Requirement Name</label>
                                    <input type="text" class="form-control" id="requirement_name" name="requirement_name" required>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Add Requirement</button>
                                <a href="<?= base_url('sc/scholarship_program'); ?>" class="btn btn-secondary ml-2">Back</a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Requirements Table Card -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List of Requirements</h3>
                        </div>
                        <div class="card-body">
                            <table id="add_reqs" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Requirement Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($requirements)): ?>
                                        <?php foreach ($requirements as $requirement): ?>
                                            <tr>
                                                <td><?= $requirement['id']; ?></td>
                                                <td><?= $requirement['requirement_name']; ?></td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm editRequirementBtn" data-id="<?= $requirement['id']; ?>" data-name="<?= $requirement['requirement_name']; ?>">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-danger btn-sm deleteRequirementBtn" data-id="<?= $requirement['id']; ?>">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="2" class="text-center">No requirements added yet.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Edit Requirement Modal -->
                <div class="modal fade" id="editRequirementModal" tabindex="-1" aria-labelledby="editRequirementModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="post" action="<?= base_url('sc/update_requirement'); ?>" id="editRequirementForm">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editRequirementModalLabel">Edit Requirement</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="edit_requirement_id" name="id">
                                    <div class="form-group">
                                        <label for="edit_requirement_name">Requirement Name</label>
                                        <input type="text" class="form-control" id="edit_requirement_name" name="requirement_name" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update Requirement</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('includes/footer'); ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php if ($this->session->flashdata('success_message')): ?>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '<?= $this->session->flashdata('success_message'); ?>',
                confirmButtonText: 'OK'
            });
        <?php elseif ($this->session->flashdata('error_message')): ?>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '<?= $this->session->flashdata('error_message'); ?>',
                confirmButtonText: 'OK'
            });
        <?php endif; ?>
    });
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.deleteRequirementBtn').forEach(function(button) {
        button.addEventListener('click', function(event) {
            const requirementId = this.getAttribute('data-id');

            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this requirement!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to delete URL if confirmed
                    window.location.href = `<?= base_url('sc/delete_requirement/'); ?>${requirementId}`;
                }
            });
        });
    });
});
</script>
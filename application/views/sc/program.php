<?php $this->load->view('includes/header') ?>
<?php $this->load->view('includes/sidebar') ?>
<title>School Program List</title>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Program Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('sc/dashboard'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">School Programs</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- Program List -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">School Program List</h3>
                        </div>
                        <div class="card-body">
                            <div class="card-tools mb-3">
                                <button class="btn btn-secondary" data-toggle="modal" data-target="#addProgramModal">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i> <span class="ml-2">Add School Program</span>
                                </button>
                            </div>
                            <table id="programTable" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Program Name</th>
                                        <th>Program Type</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($programs)) : ?>
                                        <?php foreach ($programs as $program) : ?>
                                            <tr>
                                                <td><?= $program->program_id; ?></td>
                                                <td><?= $program->program_name; ?></td>
                                                <td><?= $program->program_type; ?></td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm edit-btn"
                                                        data-toggle="modal"
                                                        data-target="#editProgramModal"
                                                        data-id="<?= $program->program_id; ?>"
                                                        data-name="<?= $program->program_name; ?>"
                                                        data-type="<?= $program->program_type; ?>">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-danger btn-sm delete-btn"
                                                        data-toggle="modal"
                                                        data-target="#deleteProgramModal"
                                                        data-id="<?= $program->program_id; ?>">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="3" class="text-center">No programs found</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Program Modal -->
<div class="modal fade" id="addProgramModal" tabindex="-1" role="dialog" aria-labelledby="addProgramModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProgramModalLabel">Add New Program</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('sc/add_program'); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="program_name">Program Name</label>
                        <input type="text" name="program_name" id="program_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="program_type">Program Type</label>
                        <select name="program_type" id="program_type" class="form-control" required>
                            <option value="" disabled selected>Select Program Type</option>
                            <option value="College">College</option>
                            <option value="Senior High School">Senior High School</option>
                            <option value="JHS/Grade School">JHS/Grade School</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Program</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit Program Modal -->
<div class="modal fade" id="editProgramModal" tabindex="-1" role="dialog" aria-labelledby="editProgramModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProgramModalLabel">Edit Program</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('sc/edit_program'); ?>" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="program_id" id="edit_program_id">
                    <div class="form-group">
                        <label for="edit_program_name">Program Name</label>
                        <input type="text" name="program_name" id="edit_program_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_program_type">Program Type</label>
                        <select name="program_type" id="edit_program_type" class="form-control" required>
                            <option value="College">College</option>
                            <option value="Senior High School">Senior High School</option>
                            <option value="JHS/Grade School">JHS/Grade School</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Delete Program Modal -->
<div class="modal fade" id="deleteProgramModal" tabindex="-1" role="dialog" aria-labelledby="deleteProgramModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteProgramModalLabel">Delete Program</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('sc/delete_program'); ?>" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="program_id" id="delete_program_id">
                    <p>Are you sure you want to delete this program?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $this->load->view('includes/footer') ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php if ($this->session->flashdata('message')): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '<?= $this->session->flashdata('message'); ?>',
            confirmButtonText: 'OK'
        });
    </script>
<?php endif; ?>
<script>
    $(document).ready(function() {
        // Edit button click
        $('.edit-btn').on('click', function() {
            const programId = $(this).data('id');
            const programName = $(this).data('name');
            const programType = $(this).data('type'); // Add program_type data

            $('#edit_program_id').val(programId);
            $('#edit_program_name').val(programName);
            $('#edit_program_type').val(programType); // Set selected program_type
        });

        // Delete button click
        $('.delete-btn').on('click', function() {
            const programId = $(this).data('id');
            $('#delete_program_id').val(programId);
        });
    });
    $(function() {
        var table = $('#programTable').DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": [{
                    extend: "copy",
                    text: "Copy",
                },
                {
                    extend: "colvis",
                    text: "Column Visibility",
                }
            ],
            initComplete: function() {
                this.api().columns(4).every(function() {
                    var column = this;
                    $('#userTypeFilter').on('change', function() {
                        var val = $.fn.dataTable.util.escapeRegex($(this).val());
                        column.search(val ? '^' + val + '$' : '', true, false).draw();
                    });
                });
            }
        });
        table.buttons().container().appendTo('#programTable_wrapper .col-md-6:eq(0)');
    });
</script>
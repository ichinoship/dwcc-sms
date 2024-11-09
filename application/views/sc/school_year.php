<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>
<title>School Year</title>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">School Year List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('sc/dashboard'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">School Year List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- School Year Card -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List of School Year</h3>
                        </div>
                        <div class="card-body">
                            <div class="card-tools mb-3">
                                <button class="btn btn-secondary" data-toggle="modal" data-target="#addYearModal">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i> <span class="ml-2">Add School Year</span>
                                </button>
                            </div>
                            <table id="example4" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Academic Year</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($school_years)): ?>
                                        <?php foreach ($school_years as $year): ?>
                                            <tr>
                                                <td><?php echo $year->academic_year; ?></td>
                                                <td><?php echo ucfirst($year->year_status); ?></td>
                                                <td>
                                                    <a href="<?php echo site_url('sc/view_list/' . $year->school_year_id); ?>" class="btn btn-info btn-sm">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editYearModal" onclick="editSchoolYear('<?php echo $year->school_year_id; ?>', '<?php echo $year->academic_year; ?>')">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="3" class="text-center">No academic year found</td>
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
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Add Year Modal -->
<div class="modal fade" id="addYearModal" tabindex="-1" role="dialog" aria-labelledby="addYearModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addYearModalLabel">Add School Year</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo site_url('sc/add_school_year'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="academic_year">Academic Year</label>
                        <input type="text" class="form-control" id="academic_year" name="academic_year" placeholder="yyyy-yyyy" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit Year Modal -->
<div class="modal fade" id="editYearModal" tabindex="-1" role="dialog" aria-labelledby="editYearModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editYearModalLabel">Edit School Year</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo site_url('sc/edit_school_year'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_academic_year">Academic Year</label>
                        <input type="text" class="form-control" id="edit_academic_year" name="academic_year" placeholder="yyyy-yyyy" required>
                        <input type="hidden" id="edit_school_year_id" name="school_year_id"> <!-- Hidden input for school_year_id -->
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

<?php $this->load->view('includes/footer'); ?>

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
    function confirmDelete(schoolYearId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '<?= site_url('sc/delete_school_year/'); ?>' + schoolYearId;
            }
        });
    }
    function editSchoolYear(id, academicYear) {
    // Set the values for the modal
    $('#edit_school_year_id').val(id);
    $('#edit_academic_year').val(academicYear);
}
</script>
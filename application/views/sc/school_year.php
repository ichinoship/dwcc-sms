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
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List of School Year</h3>
                </div>
                <div class="card-body">
                <div class="card-tools mb-3">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#addYearModal">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i> <span class="ml-2">Add School Year</span>
                        </button>
                    </div>
                    <table id="example4" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Academic Year</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($school_years as $year): ?>
                                <tr>
                                    <td><?php echo $year->academic_year; ?></td>
                                    <td>
                                        <a href="<?php echo site_url('sc/view_list/' . $year->school_year_id); ?>" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
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
                        <input type="text" class="form-control" id="academic_year" name="academic_year" required>
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

<?php $this->load->view('includes/footer'); ?>

<script>
    function submitForm() {
        document.getElementById('filterForm').submit();
    }
</script>


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
</script>
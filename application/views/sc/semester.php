<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>

<title>Semester</title>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Semester List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('sc/dashboard'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Semester List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Semester Table -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List of Semesters</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Semester</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($semesters)): ?>
                                        <?php foreach ($semesters as $semester): ?>
                                            <tr>
                                                <td><?php echo $semester->semester; ?></td>
                                                <td><?php echo ucfirst($semester->status); ?></td>
                                                <td>
                                                    <!-- Toggle Active/Inactive Buttons -->
                                                    <?php if ($semester->status == 'active'): ?>
                                                        <button class="btn btn-danger toogle-status" title="Deactivate" onclick="toggleStatus(<?php echo $semester->semester_id; ?>, 'inactive')"><i class="fas fa-times-circle"></i></button>
                                                    <?php else: ?>
                                                        <button class="btn btn-success toogle-status" title="Activate" onclick="toggleStatus(<?php echo $semester->semester_id; ?>, 'active')"><i class="fas fa-check-circle"></i></button>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="3" class="text-center">No semesters found</td>
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
    function toggleStatus(semesterId, newStatus) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to change the semester status?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, change it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?php echo site_url('sc/toggle_semester_status'); ?>",
                    type: "POST",
                    data: {
                        semester_id: semesterId,
                        status: newStatus
                    },
                    success: function(response) {
                        if (response == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Status Changed',
                                text: 'The semester status was successfully updated.',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Failed to change the semester status.',
                                confirmButtonText: 'OK'
                            });
                        }
                    }
                });
            }
        });
    }
</script>
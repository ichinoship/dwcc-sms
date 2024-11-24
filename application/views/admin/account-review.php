
<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>
<title>Account Review</title>
<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Account Review</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Account Review</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <!-- Application Review Table -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Account Review</h3>
                </div>
                <div class="card-body">
                        <table id="applicantTable" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>ID Number</th>
                                    <th>Full Name</th>
                                    <th>Program Type</th>
                                    <th>Campus</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($applicants)): ?>
                                <?php foreach ($applicants as $applicant): ?>
                                    <tr>
                                        <td><?= $applicant->id_number; ?></td>
                                        <td><?= htmlspecialchars($applicant->firstname . ' ' . (!empty($applicant->middlename) ? $applicant->middlename . ' ' : '') . $applicant->lastname); ?></td> 
                                        <td><?= $applicant->program_type; ?></td>
                                        <td><?= $applicant->campus; ?></td>
                                        <td>
                                            <a href="<?= site_url('applicant/accept/' . $applicant->account_no); ?>" class="btn btn-success btn-sm toogle-status" title="Accept Applicant"><i class="fas fa-check"></i></a>
                                            <a href="<?= site_url('applicant/decline/' . $applicant->account_no); ?>" class="btn btn-danger btn-sm toogle-status" title="Reject Applicant"><i class="fas fa-times"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="8" class="text-center">No applicants found</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                  
                </div> <!-- /.card-body -->
            </div> <!-- /.card -->
        </div> <!-- /.container-fluid -->
    </div> <!-- /.content -->
</div> <!-- /.content-wrapper -->
<?php $this->load->view('includes/footer'); ?>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    <?php if ($this->session->flashdata('success')): ?>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '<?= $this->session->flashdata('success'); ?>',
            confirmButtonText: 'OK'
        });
    <?php elseif ($this->session->flashdata('error')): ?>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '<?= $this->session->flashdata('error'); ?>',
            confirmButtonText: 'OK'
        });
    <?php endif; ?>
</script>
<script>
    $(function() {
        var table = $('#applicantTable').DataTable({
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
        table.buttons().container().appendTo('#applicantTable_wrapper .col-md-6:eq(0)');
    });
</script>
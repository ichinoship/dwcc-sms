
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
                    <?php if ($this->session->flashdata('success')): ?>
                        <div class="alert text-center alert-success">
                            <?= $this->session->flashdata('success'); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($this->session->flashdata('error')): ?>
                        <div class="alert text-center alert-danger">
                            <?= $this->session->flashdata('error'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="table-responsive">
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
                                            <a href="<?= site_url('applicant/accept/' . $applicant->account_no); ?>" class="btn btn-success btn-sm"><i class="fas fa-check"></i></a>
                                            <a href="<?= site_url('applicant/decline/' . $applicant->account_no); ?>" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></a>
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
                    </div> <!-- /.table-responsive -->
                </div> <!-- /.card-body -->
            </div> <!-- /.card -->
        </div> <!-- /.container-fluid -->
    </div> <!-- /.content -->
</div> <!-- /.content-wrapper -->

<?php $this->load->view('includes/footer'); ?>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

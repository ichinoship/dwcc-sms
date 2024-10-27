<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>
<title>Change Password</title>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Change Password</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('twc/dashboard'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Change Password</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Change Password</h3>
                        </div>
                        <div class="card-body">
                            <?= form_open('twc/update_password'); ?>
                            <div class="form-group">
                                <label for="current_password">Current Password</label>
                                <input type="password" name="current_password" class="form-control" id="current_password" required>
                                <?= form_error('current_password'); ?>
                            </div>

                            <div class="form-group">
                                <label for="new_password">New Password</label>
                                <input type="password" name="new_password" class="form-control" id="new_password" required>
                                <?= form_error('new_password'); ?>
                            </div>

                            <div class="form-group">
                                <label for="confirm_password">Confirm New Password</label>
                                <input type="password" name="confirm_password" class="form-control" id="confirm_password" required>
                                <?= form_error('confirm_password'); ?>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Change Password</button>
                            <a href="<?= base_url('twc/dashboard'); ?>" class="btn btn-secondary">Back</a>
                        </div>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('includes/footer'); ?>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php if ($this->session->flashdata('success')): ?>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '<?= $this->session->flashdata('success'); ?>',
                showConfirmButton: false,
                timer: 1500
            });
        <?php elseif ($this->session->flashdata('error')): ?>
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '<?= $this->session->flashdata('error'); ?>',
                showConfirmButton: false,
                timer: 1500
            });
        <?php endif; ?>
    });
</script>
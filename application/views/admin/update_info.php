<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>
<title>Update Info</title>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Account Settings</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Your Details</h3>
                        </div>
                        <form id="editProfileForm" action="<?= site_url('admin/update_profile'); ?>" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row justify-content-center mb-5">
                                <?php if (!empty($user->user_photo)): ?>
                                            <img src="<?= base_url('uploads/' . $user->user_photo); ?>" alt="User Image" style="width:200px; height:200px; object-fit:cover; border: 1px solid black;" class="img-fluid">
                                        <?php endif; ?>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="user_photo">Profile Photo</label>
                                        <input type="file" class="form-control" id="user_photo" name="user_photo" accept="image/*">
                                       
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="name">Full Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="<?= set_value('name', $user->name); ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="contact">Contact Number</label>
                                        <input type="text" class="form-control" id="contact" name="contact" value="<?= set_value('contact', $user->contact); ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email">Email Address</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?= set_value('email', $user->email); ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="birthdate">Birthdate</label>
                                        <input type="date" class="form-control" id="birthdate" name="birthdate" value="<?= set_value('birthdate', $user->birthdate); ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="gender">Gender</label>
                                        <select class="form-control" id="gender" name="gender">
                                            <option value="male" <?= set_select('gender', 'male', $user->gender == 'male'); ?>>Male</option>
                                            <option value="female" <?= set_select('gender', 'female', $user->gender == 'female'); ?>>Female</option>
                                            <option value="other" <?= set_select('gender', 'other', $user->gender == 'other'); ?>>Other</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update Profile</button>
                                <a href="<?= base_url('admin/dashboard'); ?>" class="btn btn-secondary">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('includes/footer'); ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php if ($this->session->flashdata('success')): ?>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '<?= $this->session->flashdata('success'); ?>',
                showConfirmButton: false,
                timer: 3000
            });
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?>
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '<?= $this->session->flashdata('error'); ?>',
                showConfirmButton: false,
                timer: 3000
            });
        <?php endif; ?>
        <?php if ($this->session->flashdata('info')): ?>
            Swal.fire({
                icon: 'info',
                title: 'No changes made!',
                text: '<?= $this->session->flashdata('info'); ?>',
                showConfirmButton: false,
                timer: 3000
            });
        <?php endif; ?>
    });
</script>
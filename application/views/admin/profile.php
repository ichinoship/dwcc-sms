<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>
<title>Profile Management</title>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Profile Management</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Profile Table -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Admin Profile</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Full Name</th>
                                        <th>Birthdate</th>
                                        <th>Gender</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $user): ?>
                                        <?php if ($user->usertype === 'Admin'): ?>
                                            <tr>
                                                <td><?php echo $user->name; ?></td>
                                                <td><?php echo $user->birthdate; ?></td>
                                                <td><?php echo ucfirst($user->gender); ?></td>
                                                <td><?php echo $user->email; ?></td>
                                                <td class="project-actions">
                                                    <a class="btn btn-info btn-sm" data-toggle="modal" data-target="#editModal"
                                                       data-id="<?php echo $user->id; ?>"
                                                       data-name="<?php echo $user->name; ?>"
                                                       data-birthdate="<?php echo $user->birthdate; ?>"
                                                       data-gender="<?php echo $user->gender; ?>"
                                                       data-email="<?php echo $user->email; ?>">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#changePasswordModal"
                                                       data-id="<?php echo $user->id; ?>">
                                                        <i class="fas fa-key"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Edit Profile Modal HTML -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editProfileForm">
                <div class="modal-body">
                    <input type="hidden" id="userId" name="userId">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="birthdate">Birthdate</label>
                        <input type="date" class="form-control" id="birthdate" name="birthdate">
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select class="form-control" id="gender" name="gender">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Change Password Modal HTML -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="changePasswordForm">
                <input type="hidden" id="changeUserId" name="userId">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="old_password">Old Password</label>
                        <input type="password" class="form-control" id="old_password" name="old_password" required>
                    </div>
                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Change Password</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#editModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var userId = button.data('id');
            var name = button.data('name');
            var birthdate = button.data('birthdate');
            var gender = button.data('gender');
            var email = button.data('email');

            var modal = $(this);
            modal.find('#userId').val(userId);
            modal.find('#name').val(name);
            modal.find('#birthdate').val(birthdate);
            modal.find('#gender').val(gender);
            modal.find('#email').val(email);
        });

        $('#changePasswordModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var userId = button.data('id');

            var modal = $(this);
            modal.find('#changeUserId').val(userId);
        });

        $('#editProfileForm').on('submit', function (event) {
            event.preventDefault();
            var form = $(this);
            var formData = form.serialize();

            $.ajax({
                url: '<?php echo base_url('profile/update'); ?>',
                type: 'POST',
                data: formData,
                success: function (response) {
                    var jsonResponse = JSON.parse(response);
                    if (jsonResponse.status === 'success') {
                        $('#editModal').modal('hide');
                        
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Your profile has been updated successfully.',
                            timer: 1500,
                            timerProgressBar: true,
                            showConfirmButton: false,
                            willClose: () => {
                                window.location.href = '<?php echo base_url('admin/profile'); ?>';
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Update Failed',
                            text: jsonResponse.message
                        });
                    }
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'An error occurred',
                        text: 'Error: ' + error
                    });
                }
            });
        });

        $('#changePasswordForm').on('submit', function (event) {
            event.preventDefault();
            var form = $(this);
            var formData = form.serialize();

            $.ajax({
                url: '<?php echo base_url('profile/change_password'); ?>',
                type: 'POST',
                data: formData,
                success: function (response) {
                    var jsonResponse = JSON.parse(response);
                    if (jsonResponse.status === 'success') {
                        $('#changePasswordModal').modal('hide');
                        
                        Swal.fire({
                            icon: 'success',
                            title: 'Password changed successfully',
                            timer: 1500,
                            timerProgressBar: true,
                            showConfirmButton: false,
                            willClose: () => {
                                window.location.href = '<?php echo base_url('admin/profile'); ?>';
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Change password failed',
                            text: jsonResponse.message
                        });
                    }
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'An error occurred',
                        text: 'Error: ' + error
                    });
                }
            });
        });
    });
</script>

<?php $this->load->view('includes/footer'); ?>

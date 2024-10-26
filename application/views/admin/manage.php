<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>
<title>Manage Users</title>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">User Lists</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="card-tools mb-3">
                                <div class="row align-items-end">
                                    <div class="form-group col-md-3">
                                        <select id="userTypeFilter" class="form-control">
                                            <option value="" disabled selected>Filter by User Type:</option>
                                            <option value="">All</option>
                                            <option value="Admin">Admin</option>
                                            <option value="TWC">Technical Working Committee</option>
                                            <option value="Scholarship Coordinator">Scholarship Coordinator</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <button type="button" class="btn btn-secondary" onclick="window.location.href='<?php echo site_url('admin/add'); ?>'"> 
                                        <i class="fa fa-user-plus" aria-hidden="true"></i> <span class="ml-2">Add User</span></button>
                                    </div>
                                </div>
                            </div>
                            <table id="example1" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>ID Number</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>User Type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $user): ?>
                                        <tr>
                                            <td><?php echo $user->id; ?></td>
                                            <td><?php echo $user->id_number; ?></td>
                                            <td><?php echo $user->name; ?></td>
                                            <td><?php echo $user->email; ?></td>
                                            <td><?php echo ucfirst($user->usertype); ?></td>
                                            <td class="project-state">
                                                <?php if ($user->status == 1): ?>
                                                    <span class="badge badge-success">Active</span>
                                                <?php else: ?>
                                                    <span class="badge badge-danger">Inactive</span>
                                                <?php endif; ?>
                                            </td>

                                            <td class="project-actions">
                                                <a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#editModal"
                                                    data-id="<?php echo $user->id; ?>"
                                                    data-id_number="<?php echo $user->id_number; ?>"
                                                    data-name="<?php echo $user->name; ?>"
                                                    data-birthdate="<?php echo $user->birthdate; ?>"
                                                    data-gender="<?php echo $user->gender; ?>"
                                                    data-contact="<?php echo $user->contact; ?>"
                                                    data-email="<?php echo $user->email; ?>"
                                                    data-usertype="<?php echo $user->usertype; ?>"
                                                    data-status="<?php echo $user->status; ?>">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
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

<!-- Edit User Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="<?php echo site_url('admin/update'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Hidden field for user ID -->
                    <input type="hidden" id="user_id" name="user_id">

                    <!-- Grid container for form fields -->
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="id_number">ID Number</label>
                            <input type="text" class="form-control" id="id_number" name="id_number">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="birthdate">Birthdate</label>
                            <input type="date" class="form-control" id="birthdate" name="birthdate" max="<?= date('Y-m-d'); ?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="gender">Gender</label>
                            <select class="form-control" id="gender" name="gender">
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="contact_number">Contact Number</label>
                            <input type="text" class="form-control" id="contact_number" name="contact_number">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="user_type">User Type</label>
                            <select class="form-control" id="user_type" name="user_type">
                                <option value="Admin">Admin</option>
                                <option value="TWC">Technical Working Committee</option>
                                <option value="Scholarship Coordinator">Scholarship Coordinator</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
        </div>
        </form>
    </div>
</div>
</div>

<?php $this->load->view('includes/footer'); ?>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    <?php if ($this->session->flashdata('success')): ?>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '<?php echo $this->session->flashdata('success'); ?>',
            timer: 3000,
            showConfirmButton: false
        });
    <?php elseif ($this->session->flashdata('error')): ?>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '<?php echo $this->session->flashdata('error'); ?>',
            timer: 3000,
            showConfirmButton: false
        });
    <?php endif; ?>

    $('#editModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var user_id = button.data('id');
        var id_number = button.data('id_number');
        var name = button.data('name');
        var birthdate = button.data('birthdate');
        var gender = button.data('gender');
        var contact = button.data('contact');
        var email = button.data('email');
        var usertype = button.data('usertype');
        var status = button.data('status');
        var image = button.data('image');

        var modal = $(this);
        modal.find('.modal-body #user_id').val(user_id);
        modal.find('.modal-body #id_number').val(id_number);
        modal.find('.modal-body #name').val(name);
        modal.find('.modal-body #birthdate').val(birthdate);
        modal.find('.modal-body #gender').val(gender);
        modal.find('.modal-body #contact_number').val(contact);
        modal.find('.modal-body #email').val(email);
        modal.find('.modal-body #user_type').val(usertype);
        modal.find('.modal-body #status').val(status);
        modal.find('.modal-body #current_image').val(image);

        if (image) {
            var imagePreview = '<img src="<?php echo base_url('uploads/'); ?>' + image + '" alt="Current Image" style="width: 100px; height: auto;">';
            modal.find('#current_image_preview').html(imagePreview);
        } else {
            modal.find('#current_image_preview').html('No Image');
        }
    });

    $('#editModal form').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: new FormData(this),
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#editModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.success,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        // Redirect to user list page after the success message
                        window.location.href = '<?php echo site_url("admin/manage"); ?>';
                    });
                } else if (response.error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: response.error,
                        timer: 3000,
                        showConfirmButton: false
                    });
                }
            },
            error: function(xhr, status, error) {
                console.log('An error occurred: ' + error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'An error occurred while updating the user.',
                    timer: 3000,
                    showConfirmButton: false
                });
            }
        });
    });
    $(document).ready(function() {
        // Get URL parameter
        var urlParams = new URLSearchParams(window.location.search);
        var userType = urlParams.get('usertype');

        if (userType) {
            // Set the select option to the passed user type
            $('#userTypeFilter').val(userType);

            // Filter the DataTable based on the selected user type
            var table = $('#example1').DataTable();
            table.column(4).search(userType).draw();
        }

        // Update table when the filter changes
        $('#userTypeFilter').on('change', function() {
            var selectedUserType = $(this).val();
            table.column(4).search(selectedUserType).draw();
        });
    });
</script>
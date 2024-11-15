<?php $this->load->view('includes/header') ?>
<?php $this->load->view('includes/sidebar') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add New User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo site_url('admin/manage'); ?>">Users</a></li>
                        <li class="breadcrumb-item active">Add New</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add New User</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo site_url('admin/insert'); ?>" method="post" enctype="multipart/form-data">
                                <div class="row justify-content-center mb-3">
                                    <div class="mt-2">
                                        <img id="image_preview" src="#" alt="User Photo Preview" style="display:none; width:200px; height:200px; object-fit:cover; border: 1px solid black;" class="img-fluid">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="user_photo">User Photo</label>
                                            <input type="file" class="form-control" id="user_photo" name="user_photo" accept="image/*" onchange="previewImage(event)">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="id_number">ID Number</label>
                                            <input type="text" class="form-control <?= form_error('id_number') ? 'is-invalid' : ''; ?>" id="id_number" name="id_number" placeholder="ID Number" value="<?= set_value('id_number'); ?>">
                                            <?= form_error('id_number', '<div class="invalid-feedback">', '</div>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control <?= form_error('name') ? 'is-invalid' : ''; ?>" id="name" name="name" placeholder="Name" value="<?= set_value('name'); ?>">
                                            <?= form_error('name', '<div class="invalid-feedback">', '</div>'); ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- Additional fields -->
                                <div class="row">
                                <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="birthdate">Birthdate</label>
                                            <input type="date" class="form-control <?= form_error('birthdate') ? 'is-invalid' : ''; ?>" id="birthdate" name="birthdate" value="<?= set_value('birthdate'); ?>">
                                            <?= form_error('birthdate', '<div class="invalid-feedback">', '</div>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <!-- Gender, Contact Number, and other fields -->
                                        <div class="form-group">
                                            <label for="gender">Gender</label>
                                            <select class="form-control <?= form_error('gender') ? 'is-invalid' : ''; ?>" id="gender" name="gender">
                                                <option value="">Select Gender</option>
                                                <option value="male" <?= set_select('gender', 'male'); ?>>Male</option>
                                                <option value="female" <?= set_select('gender', 'female'); ?>>Female</option>
                                            </select>
                                            <?= form_error('gender', '<div class="invalid-feedback">', '</div>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="contact_number">Contact Number</label>
                                            <input type="text" class="form-control <?= form_error('contact_number') ? 'is-invalid' : ''; ?>" id="contact_number" name="contact_number" placeholder="Contact Number" value="<?= set_value('contact_number'); ?>" pattern="\d{11}" title="Contact number must be 11 digits.">
                                            <?= form_error('contact_number', '<div class="invalid-feedback">', '</div>'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="user_type">User Type</label>
                                            <select class="form-control <?= form_error('user_type') ? 'is-invalid' : ''; ?>" id="user_type" name="user_type">
                                                <option value="">Select User Type</option>
                                                <option value="Admin" <?= set_select('user_type', 'Admin'); ?>>Admin</option>
                                                <option value="TWC" <?= set_select('user_type', 'TWC'); ?>>Technical Working Committee</option>
                                                <option value="Scholarship Coordinator" <?= set_select('user_type', 'Scholarship Coordinator'); ?>>Scholarship Coordinator</option>
                                            </select>
                                            <?= form_error('user_type', '<div class="invalid-feedback">', '</div>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control <?= form_error('email') ? 'is-invalid' : ''; ?>" id="email" name="email" placeholder="Email" value="<?= set_value('email'); ?>">
                                            <?= form_error('email', '<div class="invalid-feedback">', '</div>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control <?= form_error('password') ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="Password" value="<?= set_value('password'); ?>">
                                            <?= form_error('password', '<div class="invalid-feedback">', '</div>'); ?>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Add User</button>
                                <a href="<?php echo site_url('admin/manage'); ?>" class="btn btn-secondary">Back</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<?php $this->load->view('includes/footer') ?>

<script>
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('birthdate').setAttribute('max', today);

    function previewImage(event) {
        const imagePreview = document.getElementById('image_preview');
        imagePreview.src = URL.createObjectURL(event.target.files[0]);
        imagePreview.style.display = 'block';
    }
</script>
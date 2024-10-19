<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-green elevation-1">
    <!-- Brand Logo -->
    <a href="<?= base_url('applicant/dashboard_applicant'); ?>" class="brand-link">
        <img src="<?= base_url('assets/') ?>images/logo-white.png" alt="SMS-LOGO" class="brand-image">
        <span class="brand-text font-weight-bold">DWCC SMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <?php
                $user_image = $this->session->userdata('user_image');
                $image_path = $user_image ? 'uploads/' . $user_image : 'assets/images/user.png';
                ?>
                <img src="<?= base_url($image_path); ?>" class="img-circle elevation-2" alt="" style="width: 40px; height: 40px; object-fit: cover;">
            </div>
            <div class="info mt-1">
                <a href="<?= base_url('applicant/update_info'); ?>" class="d-block"><?= $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name'); ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?= base_url('applicant/dashboard_applicant'); ?>" class="nav-link <?= $this->uri->segment(2) == 'dashboard_applicant' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <!-- Scholarship Program Dropdown -->
                <li class="nav-item has-treeview <?= $this->uri->segment(2) == 'merit_programs' || $this->uri->segment(2) == 'non_merit_programs' ? 'menu-open' : ''; ?>">
                    <a href="#" class="nav-link <?= $this->uri->segment(2) == 'merit_programs' || $this->uri->segment(2) == 'non_merit_programs' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Scholarship Programs
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('applicant/merit_programs'); ?>" class="nav-link <?= $this->uri->segment(2) == 'merit_programs' ? 'active' : ''; ?>">
                                <i class="fas fa-file-alt"></i>
                                <p>Merit Scholarship</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('applicant/non_merit_programs'); ?>" class="nav-link <?= $this->uri->segment(2) == 'non_merit_programs' ? 'active' : ''; ?>">
                                <i class="fas fa-file-alt"></i>
                                <p>Non-Merit Scholarship</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('applicant/apply_scholarship'); ?>" class="nav-link <?= $this->uri->segment(2) == 'apply_scholarship' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-file-signature"></i>
                        <p>Apply Scholarship</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('applicant/my_application'); ?>" class="nav-link <?= in_array($this->uri->segment(2), ['my_application', 'view_form', 'edit_application']) ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-folder-open"></i>
                        <p>My Application</p>
                    </a>
                </li>
                <li class="nav-item has-treeview <?= $this->uri->segment(2) == 'update_info' || $this->uri->segment(2) == 'change_password' || $this->uri->segment(2) == 'update_password' ? 'menu-open' : ''; ?>">
                        <a href="#" class="nav-link <?= $this->uri->segment(2) == 'update_info' || $this->uri->segment(2) == 'change_password' || $this->uri->segment(2) == 'update_password' ? 'active' : ''; ?>">
                            <i class="nav-icon fas fa-users-cog"></i>
                            <p>
                                Account Settings
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('applicant/update_info'); ?>" class="nav-link <?= $this->uri->segment(2) == 'update_info' ? 'active' : ''; ?>">
                                    <i class="fas fa-edit"></i>
                                    <p>Edit Information</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('applicant/change_password'); ?>" class="nav-link <?= $this->uri->segment(2) == 'change_password' ? 'active' : ''; ?>">
                                    <i class="fas fa-key"></i>
                                    <p>Change Password</p>
                                </a>
                            </li>
                        </ul>
                    </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

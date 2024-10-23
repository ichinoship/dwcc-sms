<!-- Main Sidebar Container -->

<aside class="main-sidebar sidebar-dark-success elevation-1">
    <!-- Brand Logo -->
    <a href="<?= base_url('dashboard'); ?>" class="brand-link">
        <img src="<?= base_url('assets/images/logo-white.png'); ?>" alt="SMS-LOGO" class="brand-image">
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
                <img src="<?= base_url($image_path); ?>" class="img-circle elevation-2" alt="User Image" style="width: 40px; height: 40px; object-fit: cover;">
            </div>
            <div class="info mt-1">
                <?php
                $user_type = $this->session->userdata('user_type');
                $update_url = '#';

                if ($user_type == 'Admin') {
                    $update_url = base_url('admin/profile');
                } elseif ($user_type == 'Scholarship Coordinator') {
                    $update_url = base_url('sc/update_info');
                } elseif ($user_type == 'TWC') {
                    $update_url = base_url('twc/update_info');
                }
                ?>

                <a href="<?= $update_url; ?>" class="d-block"><?= $this->session->userdata('user_name'); ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <?php $user_type = $this->session->userdata('user_type'); ?>

                <!-- Dashboard Link -->
                <?php if ($user_type == 'Admin'): ?>
                    <li class="nav-item">
                        <a href="<?= base_url('admin/dashboard'); ?>" class="nav-link <?= $this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'dashboard' ? 'active' : ''; ?>">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('admin/profile'); ?>" class="nav-link <?= $this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'profile' ? 'active' : ''; ?>">
                            <i class="nav-icon fas fa-user-cog"></i>
                            <p>Profile Management</p>
                        </a>
                    </li>

                    <li class="nav-item <?= ($this->uri->segment(1) == 'admin' && ($this->uri->segment(2) == '' || $this->uri->segment(2) == 'add')) ? 'menu-open' : ''; ?>">
                        <a href="<?= base_url('admin/manage'); ?>" class="nav-link <?= $this->uri->segment(1) == 'admin' && ($this->uri->segment(2) == 'manage' || $this->uri->segment(2) == 'add') ? 'active' : ''; ?>">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Manage Users</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="<?= base_url('admin/app-list'); ?>" class="nav-link <?= $this->uri->segment(2) == 'app-list' ? 'active' : ''; ?>">
                            <i class="nav-icon fas fa-address-card"></i>
                            <p>Applicant Accounts</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('admin/account_review'); ?>" class="nav-link <?= $this->uri->segment(2) == 'account_review' ? 'active' : ''; ?>">
                            <i class="nav-icon fas fa-user-check"></i>
                            <p>Account Review</p>
                        </a>
                    </li>
                    <!-- Logout Link -->
                    <div class="sidebar-bottom">
                        <nav>
                            <ul class="nav nav-pills nav-sidebar">
                                <li class="nav-item">
                                    <a href="<?= base_url('auth/logout'); ?>" class="nav-link">
                                        <i class="nav-icon fas fa-sign-out-alt"></i>
                                        <p>Logout</p>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                <?php elseif ($user_type == 'Scholarship Coordinator'): ?>
                    <li class="nav-item">
                        <a href="<?= base_url('sc/dashboard'); ?>" class="nav-link <?= $this->uri->segment(1) == 'sc' && $this->uri->segment(2) == 'dashboard' ? 'active' : ''; ?>">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('sc/school_year'); ?>"
                            class="nav-link <?= $this->uri->segment(1) == 'sc' && ($this->uri->segment(2) == 'school_year' || $this->uri->segment(2) == 'view_list') ? 'active' : ''; ?>">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <p>School Year</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('sc/scholarship_program'); ?>" class="nav-link <?= ($this->uri->segment(1) == 'sc' && ($this->uri->segment(2) == 'scholarship_program' || $this->uri->segment(2) == 'add_requirements' || $this->uri->segment(2) == 'add_scholarship_program' || $this->uri->segment(2) == 'edit_scholarship_program')) ? 'active' : ''; ?>">
                            <i class="nav-icon fas fa-book"></i>
                            <p>Scholarship Program</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('sc/program_app_list'); ?>"
                            class="nav-link <?= $this->uri->segment(1) == 'sc' && ($this->uri->segment(2) == 'program_app_list' || $this->uri->segment(2) == 'app_list') ? 'active' : ''; ?>">
                            <i class="nav-icon fas fa-list"></i>
                            <p>Applicant List</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('sc/app_evaluation'); ?>"
                            class="nav-link <?= ($this->uri->segment(1) == 'sc' && ($this->uri->segment(2) == 'app_evaluation' || $this->uri->segment(2) == 'view_shortlist_applicant')) ? 'active' : ''; ?>">
                            <i class="nav-icon fas fa-clipboard-list"></i>
                            <p>Application Evaluation</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('sc/final_list'); ?>"
                            class="nav-link <?= ($this->uri->segment(1) == 'sc' && ($this->uri->segment(2) == 'program_list' || $this->uri->segment(2) == 'final_list')) ? 'active' : ''; ?>">
                            <i class="nav-icon fas fa-check-circle"></i>
                            <p>Final List</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('sc/reports'); ?>" class="nav-link <?= $this->uri->segment(1) == 'sc' && $this->uri->segment(2) == 'reports' ? 'active' : ''; ?>">
                            <i class="nav-icon fas fa-chart-bar"></i>
                            <p>Reports</p>
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
                                <a href="<?= base_url('sc/update_info'); ?>" class="nav-link <?= $this->uri->segment(2) == 'update_info' ? 'active' : ''; ?>">
                                    <i class="fas fa-edit"></i>
                                    <p>Edit Information</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('sc/change_password'); ?>" class="nav-link <?= $this->uri->segment(2) == 'change_password' ? 'active' : ''; ?>">
                                    <i class="fas fa-key"></i>
                                    <p>Change Password</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Logout Link -->
                    <div class="sidebar-bottom">
                        <nav>
                            <ul class="nav nav-pills nav-sidebar">
                                <li class="nav-item">
                                    <a href="<?= base_url('auth/logout'); ?>" class="nav-link">
                                        <i class="nav-icon fas fa-sign-out-alt"></i>
                                        <p>Logout</p>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                <?php elseif ($user_type == 'TWC'): ?>
                    <li class="nav-item">
                        <a href="<?= base_url('twc/dashboard'); ?>" class="nav-link <?= $this->uri->segment(1) == 'twc' && $this->uri->segment(2) == 'dashboard' ? 'active' : ''; ?>">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('twc/app-review'); ?>" class="nav-link <?= in_array($this->uri->segment(2), ['app-review', 'view_applicant']) ? 'active' : ''; ?>">
                            <i class="nav-icon fas fa-clipboard-check"></i>
                            <p>Application Review</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('twc/shortlist'); ?>" class="nav-link <?= ($this->uri->segment(2) == 'shortlist' || $this->uri->segment(2) == 'view_shortlist_applicant') ? 'active' : ''; ?>">
                            <i class="nav-icon fas fa-thumbtack"></i>
                            <p>Shortlist</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('twc/reports'); ?>" class="nav-link <?= $this->uri->segment(1) == 'twc' && $this->uri->segment(2) == 'reports' ? 'active' : ''; ?>">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>Reports</p>
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
                                <a href="<?= base_url('twc/update_info'); ?>" class="nav-link <?= $this->uri->segment(2) == 'update_info' ? 'active' : ''; ?>">
                                    <i class="fas fa-edit"></i>
                                    <p>Edit Information</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('twc/change_password'); ?>" class="nav-link <?= $this->uri->segment(2) == 'change_password' ? 'active' : ''; ?>">
                                    <i class="fas fa-key"></i>
                                    <p>Change Password</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Logout Link -->
                    <div class="sidebar-bottom">
                        <nav>
                            <ul class="nav nav-pills nav-sidebar">
                                <li class="nav-item">
                                    <a href="<?= base_url('auth/logout'); ?>" class="nav-link">
                                        <i class="nav-icon fas fa-sign-out-alt"></i>
                                        <p>Logout</p>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                <?php endif; ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

</aside>
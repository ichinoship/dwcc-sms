<!-- Main Sidebar Container -->

<aside class="main-sidebar sidebar-dark-success elevation-1">
    <!-- Brand Logo -->
    <?php
    // Determine the base URL based on user type
    $user_type = $this->session->userdata('user_type');
    $dashboard_url = ''; // Initialize the variable

    if ($user_type == 'Admin') {
        $dashboard_url = base_url('admin/dashboard');
    } elseif ($user_type == 'Scholarship Coordinator') {
        $dashboard_url = base_url('sc/dashboard');
    } elseif ($user_type == 'TWC') {
        $dashboard_url = base_url('twc/dashboard');
    }
    ?>
    <a href="<?= $dashboard_url; ?>" class="brand-link">
        <img src="<?= base_url('assets/images/dwcc-logo-outline.png'); ?>" alt="SMS-LOGO" class="brand-image img-circle">
        <span class="brand-text font-weight-bold">DWCC SMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <?php if (!empty($this->session->userdata('user_image'))): ?>
                    <!-- If user has a profile photo, display it -->
                    <img src="<?= base_url('uploads/' . $this->session->userdata('user_image')); ?>" class="img-circle elevation-2" alt="User Image" style="width: 40px; height: 40px;">
                <?php else: ?>
                    <!-- If no profile photo, display default user icon -->
                    <i class="fas fa-user-circle text-white" style="font-size: 40px;"></i>
                <?php endif; ?>
            </div>
            <div class="info mt-1">
                <?php
                $user_type = $this->session->userdata('user_type');
                $update_url = '#';

                if ($user_type == 'Admin') {
                    $update_url = base_url('admin/update_info');
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
                    

                    <li class="nav-item <?= ($this->uri->segment(1) == 'admin' && ($this->uri->segment(2) == '' || $this->uri->segment(2) == 'add' || $this->uri->segment(2) == 'insert')) ? 'menu-open' : ''; ?>">
                        <a href="<?= base_url('admin/manage'); ?>" class="nav-link <?= $this->uri->segment(1) == 'admin' && ($this->uri->segment(2) == 'manage' || $this->uri->segment(2) == 'add' || $this->uri->segment(2) == 'insert') ? 'active' : ''; ?>">
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
                                <a href="<?= base_url('admin/update_info'); ?>" class="nav-link <?= $this->uri->segment(2) == 'update_info' ? 'active' : ''; ?>">
                                    <i class="fas fa-edit"></i>
                                    <p>Edit Information</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/change_password'); ?>" class="nav-link <?= $this->uri->segment(2) == 'change_password' ? 'active' : ''; ?>">
                                    <i class="fas fa-key"></i>
                                    <p>Change Password</p>
                                </a>
                            </li>
                        </ul>
                    </li>


                <?php elseif ($user_type == 'Scholarship Coordinator'): ?>
                    <li class="nav-item">
                        <a href="<?= base_url('sc/dashboard'); ?>" class="nav-link <?= $this->uri->segment(1) == 'sc' && $this->uri->segment(2) == 'dashboard' ? 'active' : ''; ?>">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('sc/add_announcement'); ?>" class="nav-link <?= $this->uri->segment(1) == 'sc' && $this->uri->segment(2) == 'add_announcement' ? 'active' : ''; ?>">
                            <i class="nav-icon fas fa-bullhorn"></i>
                            <p>Announcements</p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview <?= in_array($this->uri->segment(2), ['school_year', 'semester', 'program', 'view_list']) ? 'menu-open' : ''; ?>">
                        <a href="#" class="nav-link <?= in_array($this->uri->segment(2), ['school_year', 'semester', 'program', 'view_list']) ? 'active' : ''; ?>">
                            <i class="nav-icon fas fa-school"></i>
                            <p>
                                Academic Preferences
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('sc/school_year'); ?>"
                                    class="nav-link <?= $this->uri->segment(2) == 'school_year' || $this->uri->segment(2) == 'view_list' ? 'active' : ''; ?>">
                                    <i class="far fa-calendar-alt nav-icon"></i>
                                    <p>School Year</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('sc/program'); ?>"
                                    class="nav-link <?= $this->uri->segment(2) == 'program' ? 'active' : ''; ?>">
                                    <i class="fas fa-chalkboard-teacher nav-icon"></i>
                                    <p>School Program</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('sc/scholarship_program'); ?>" class="nav-link <?= ($this->uri->segment(1) == 'sc' && ($this->uri->segment(2) == 'scholarship_program' || $this->uri->segment(2) == 'manage_requirements' || $this->uri->segment(2) == 'add_scholarship_program' || $this->uri->segment(2) == 'edit_scholarship_program')) ? 'active' : ''; ?>">
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
                            <p>Official List</p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview <?= $this->uri->segment(2) == 'reports' || $this->uri->segment(2) == 'grants' ? 'menu-open' : ''; ?>">
                        <a href="#" class="nav-link <?= $this->uri->segment(2) == 'reports' || $this->uri->segment(2) == 'grants' ? 'active' : ''; ?>">
                            <i class="nav-icon fas fa-chart-bar"></i>
                            <p>
                                Reports
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('sc/reports'); ?>" class="nav-link <?= $this->uri->segment(2) == 'reports' ? 'active' : ''; ?>">
                                    <i class="fas fa-table"></i>
                                    <p>Scholarship Reports</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('sc/grants'); ?>" class="nav-link <?= $this->uri->segment(2) == 'grants' ? 'active' : ''; ?>">
                                    <i class="fas fa-hands-helping"></i>
                                    <p>Scholarship Grants</p>
                                </a>
                            </li>
                        </ul>
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


                <?php elseif ($user_type == 'TWC'): ?>
                    <li class="nav-item">
                        <a href="<?= base_url('twc/dashboard'); ?>" class="nav-link <?= $this->uri->segment(1) == 'twc' && $this->uri->segment(2) == 'dashboard' ? 'active' : ''; ?>">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('twc/app_evaluation'); ?>" class="nav-link <?= in_array($this->uri->segment(2), ['app_evaluation', 'view_applicant']) ? 'active' : ''; ?>">
                            <i class="nav-icon fas fa-clipboard-list"></i>
                            <p>Application Evaluation</p>
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
                <?php endif; ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

</aside>
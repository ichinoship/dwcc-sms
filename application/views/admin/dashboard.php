<?php $this->load->view('includes/header') ?>
<?php $this->load->view('includes/sidebar') ?>
<?php
$coordinator_count = $this->Admin_model->count_scholarship_coordinators();
$twc_count = $this->Admin_model->count_twc();
?>
<title>Admin Dashboard</title>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="content">
        <div class="container-fluid">
            <!-- Row for the boxes -->
            <div class="row">
                <!-- Box 1 -->
                <div class="col-lg-4 col-12">
    <div class="small-box bg-info">
        <div class="inner">
            <h3><?php echo $accepted_applicants_count; ?></h3>
            <p>Total Number of Accepted Applicants</p>
        </div>
        <div class="icon">
            <i class="fas fa-users"></i>
        </div>
        <a href="<?php echo site_url('admin/app-list')?>" class="small-box-footer">
            View List <i class="fas fa-arrow-circle-right"></i>
        </a>
    </div>
</div>
                <!-- Box 2 -->
                <div class="col-lg-4 col-12">
                    <div class="small-box bg-purple">
                        <div class="inner">
                            <h3><?php echo $twc_count; ?></h3>
                            <p>Technical Working Committee</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <a href="<?php echo site_url('admin/manage') . '?usertype=TWC'; ?>" class="small-box-footer">
                            View List <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- Box 3 -->
                <div class="col-lg-4 col-12">
                    <div class="small-box bg-gradient-success">
                        <div class="inner">
                            <h3><?php echo $coordinator_count; ?></h3>
                            <p>Scholarship Coordinators</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <a href="<?php echo site_url('admin/manage') . '?usertype=Scholarship Coordinator'; ?>" class="small-box-footer">
                            View List <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content -->
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('includes/footer') ?>
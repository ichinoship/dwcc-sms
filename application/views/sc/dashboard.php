<?php $this->load->view('includes/header') ?>
<?php $this->load->view('includes/sidebar') ?>
<title>SC Dashboard</title>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row">
            <div class="col-12 mt-1">
                <div class="card bg-dark">
                    <img src="<?= base_url('assets/images/sc-banner.svg'); ?>" alt="Logo" class="img-fluid">
                </div>
            </div>
        </div>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Program Overview</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Program Overview</li>
                    </ol>
                </div>
            </div>
            
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- Total Applicants Card -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo $totalApplicants; ?></h3>
                            <p>Total Applicants</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- Pending Applicants Card -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo $pendingApplicants; ?></h3>
                            <p>Pending Applicants</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- Qualified Applicants Card -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php echo $qualifiedApplicants; ?></h3>
                            <p>Qualified Applicants</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- Not Qualified Applicants Card -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?php echo $notQualifiedApplicants; ?></h3>
                            <p>Not Qualified Applicants</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-times-circle"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- Conditional Applicants Card -->
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3><?php echo $conditionalApplicants; ?></h3>
                            <p>Conditional Applicants</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content -->
</div><!-- /.content-wrapper -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<?php $this->load->view('includes/footer') ?>
<?php $this->load->view('includes/header') ?>
<?php $this->load->view('includes/sidebar') ?>
<title>SC Dashboard</title>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        
        <div class="container-fluid">
            <div class="row">
            <div class="col-12 mt-1">
                <div class="card bg-dark">
                    <img src="<?= base_url('assets/images/sc-banner.svg'); ?>" alt="Logo" class="img-fluid">
                </div>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <!-- Row for the cards -->
            <div class="row">
                <!-- Total Applicants Card -->
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $total_applicants ?></h3>
                            <p>Total Applicants</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="<?= base_url('sc/program_app_list') ?>" class="small-box-footer">
                            View List <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Approved Applicants Card -->
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $approve_applicants ?></h3>
                            <p>Approved Applicants</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <a href="<?= base_url('sc/program_app_list') ?>" class="small-box-footer">
                            View List <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Not Approved Applicants Card -->
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?= $not_approve_applicants ?></h3>
                            <p>Not Approved Applicants</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <a href="<?= base_url('sc/program_app_list') ?>" class="small-box-footer">
                            View List <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Conditional Applicants Card -->
                <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= $conditional_applicants ?></h3>
                            <p>Conditional Applicants</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <a href="<?= base_url('sc/program_app_list') ?>" class="small-box-footer">
                            View List <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Pending Applicants Card -->
                <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3><?= $pending_applicants ?></h3>
                            <p>Pending Applicants</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-hourglass-half"></i>
                        </div>
                        <a href="<?= base_url('sc/program_app_list') ?>" class="small-box-footer">
                            View List <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <!-- Row for School Year and Scholarship Programs -->
            <div class="row">
                <!-- School Year Card -->
                <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3><?= $total_school_years ?></h3>
                            <p>School Year</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <a href="<?= base_url('sc/school_year') ?>" class="small-box-footer">
                            View List <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Scholarship Programs Card -->
                <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                    <div class="small-box bg-purple">
                        <div class="inner">
                            <h3><?= $total_scholarship_programs ?></h3>
                            <p>Scholarship Programs</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-university"></i>
                        </div>
                        <a href="<?= base_url('sc/scholarship_program') ?>" class="small-box-footer">
                            View List <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php $this->load->view('includes/footer') ?>

<script src="<?= base_url('assets/plugins/chart.js/Chart.min.js') ?>"></script>
<script>
    $(function() {
        var ctx = document.getElementById('applicantsChart').getContext('2d');
        var applicantsChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Qualified', 'Not Qualified', 'Pending', 'Conditional'],
                datasets: [{
                    data: [<?= $approved_applicants ?>, <?= $not_approved_applicants ?>, <?= $pending_applicants ?>, <?= $conditional_applicants ?>],
                    backgroundColor: ['#28a745', '#dc3545', '#ffc107', '#17a2b8'],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'right',
                },
            }
        });
    });
</script>

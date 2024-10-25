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
            <!-- Chart and Navigation Section -->
            <!-- Chart and Navigation Section -->
            <div class="row">
                <div class="col-md-8 d-flex align-items-stretch">
                    <div class="card flex-fill">
                        <div class="card-header">
                            <h3 class="card-title">Application Status</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="applicantsChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Cards Section -->
                <div class="col-md-4 d-flex flex-column">
                    <div class="card mb-3" style="height: 150px;">
                        <div class="card-header bg-success">
                            <h5 class="card-title">Final List Overview</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Would you like to view the final list of applicants?</p>
                            <a href="<?= base_url('sc/final_list'); ?>" class="text-primary">View Final List</a>
                        </div>
                    </div>

                    <div class="card mb-3" style="height: 150px;">
                        <div class="card-header bg-info">
                            <h5 class="card-title">Evaluate Applicants</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Are you ready to evaluate the applicants?</p>
                            <a href="<?= base_url('sc/app_evaluation'); ?>" class="text-primary">Evaluate Applicants</a>
                        </div>
                    </div>

                    <div class="card mb-3" style="height: 150px;">
                        <div class="card-header bg-purple">
                            <h5 class="card-title">Reports Overview</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Would you like to view the reports?</p>
                            <a href="<?= base_url('sc/reports'); ?>" class="text-primary">View Reports</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content -->
</div><!-- /.content-wrapper -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Application Status Area Chart
        const ctx = document.getElementById('applicantsChart').getContext('2d');
        const applicantsChart = new Chart(ctx, {
            type: 'line', // Change to line chart for area effect
            data: {
                labels: ['Pending', 'Qualified', 'Not Qualified', 'Conditional'],
                datasets: [{
                    label: 'Applicants',
                    data: [<?= $pending_applicants ?>, <?= $approve_applicants ?>, <?= $not_approve_applicants ?>, <?= $conditional_applicants ?>],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)', // Light Blue for area
                    borderColor: 'rgba(54, 162, 235, 1)', // Blue for line
                    borderWidth: 2,
                    fill: true // Fill the area under the line
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Applicants Status Distribution'
                    }
                }
            }
        });

    });
</script>

<?php $this->load->view('includes/footer') ?>
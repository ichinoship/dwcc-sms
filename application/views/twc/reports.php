<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Reports</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href='<?= base_url('twc/dashboard'); ?>'>Home</a></li>
                        <li class="breadcrumb-item active">Reports</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="row report-section applicant-report">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Applicants Report by Program</h3>
                    </div>
                    <div class="card-body">
                        <table id="example3" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Total Applicants</th>
                                    <th>Qualified</th>
                                    <th>Not Qualified</th>
                                    <th>Conditional</th>
                                    <th>Pending</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?= $report_counts['total'] ?></td>
                                    <td><?= $report_counts['qualified'] ?></td>
                                    <td><?= $report_counts['not_qualified'] ?></td>
                                    <td><?= $report_counts['conditional'] ?></td>
                                    <td><?= $report_counts['pending'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row report-section scholarship-report">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Scholarship Grants</h3>
                    </div>
                    <div class="card-body">
                        <table id="example4" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Program Code</th>
                                    <th>Scholarship Program</th>
                                    <th>Percentage</th>
                                    <th>Number of Grantees</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($scholarship_programs as $program): ?>
                                    <tr>
                                        <td><?= $program['program_code'] ?></td>
                                        <td><?= $program['scholarship_program'] ?></td>
                                        <td><?= $program['percentage'] ?></td>
                                        <td><?= $program['num_grantees'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view('includes/footer'); ?>

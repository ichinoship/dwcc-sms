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
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-hover table-sm">
                                <thead>
                                    <tr>
                                        
                                        <th>ID Number</th>
                                        <th>Last Name</th>
                                        <th>First Name</th>
                                        <th>Scholarship Program</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($applicants)): ?>
                                        <?php foreach ($applicants as $applicant): ?>
                                            <tr>
                                                <td><?= $applicant->id_number; ?></td>
                                                <td><?= $applicant->lastname; ?></td>
                                                <td><?= $applicant->firstname; ?></td>
                                                <td><?= $applicant->scholarship_program; ?></td>
                                                <td class="status-column"><?= ucwords($applicant->status); ?></td>
                                                <td>
                                                    <a href="<?= site_url('twc/view_applicant/' . $applicant->applicant_no); ?>" class="btn btn-info btn-sm">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <button class="btn btn-primary evaluate-btn btn-sm" data-id="<?= $applicant->applicant_no; ?>" data-toggle="modal" data-target="#evaluateModal">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="8" class="text-center">No data found</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
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

        
    </section>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<?php $this->load->view('includes/footer'); ?>

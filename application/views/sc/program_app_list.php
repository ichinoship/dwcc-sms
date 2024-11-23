<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>
<title>Scholarship Program Applicants</title>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('sc/dashboard'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Program List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <!-- Merit Program Applicants Section -->
            <h4 class="mb-3">Merit Program Applicants</h4>
            <div class="row mb-3">
                <?php if (isset($programs) && !empty($programs)): ?>
                    <?php foreach ($programs as $program): ?>
                        <?php if ($program->scholarship_type == 'Merit'): ?>
                            <div class="col-lg-6 col-6 mb-3">
                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <h5 class="font-weight-bold"><?= $program->scholarship_program; ?></h5>
                                        <p>Number of Applicants: <?= $program->applicant_count; ?></p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-graduation-cap"></i>
                                    </div>
                                    <a href="<?= site_url('sc/app_list/'.$program->program_code); ?>" class="small-box-footer">
                                        View Applicants <i class="fas fa-arrow-circle-right toogle-status" title="View"></i>
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No merit program applicants available.</p>
                <?php endif; ?>
            </div>

            <!-- Non-Merit Program Applicants Section -->
            <h4 class="mb-3">Non-Merit Program Applicants</h4>
            <div class="row">
                <?php if (isset($programs) && !empty($programs)): ?>
                    <?php foreach ($programs as $program): ?>
                        <?php if ($program->scholarship_type == 'Non-Merit'): ?>
                            <div class="col-lg-4 col-6 mb-3">
                                <div class="small-box bg-purple">
                                    <div class="inner" style="height: 150px;">
                                        <h5 class="font-weight-bold"><?= $program->scholarship_program; ?></h5>
                                        <p>Number of Applicants: <?= $program->applicant_count; ?></p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-graduation-cap"></i>
                                    </div>
                                    <a href="<?= site_url('sc/app_list/'.$program->program_code); ?>" class="small-box-footer">
                                        View Applicants <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No non-merit program applicants available.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view('includes/footer'); ?>

<?php $this->load->view('includes/applicant_header') ?>
<?php $this->load->view('includes/applicant_sidebar') ?>
<!-- Applicant Dashboard -->
<title>Applicant Dashboard</title>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mt-1">
                <div class="card bg-dark">
                    <img src="<?= base_url('assets/images/applicant-banner.svg'); ?>" alt="Logo" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
            <div class="col-12 mt-1">
                    <div class="alert alert-warning fade show" role="alert">
                        <strong>Important:</strong> TO BE ABLE TO APPLY ON A SCHOLARSHIP. YOU MUST NEED TO FULFILL A SPECIFIC QUALIFICATIONS.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                 <!-- Announcement Card -->
                 <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-light">
                            <h3 class="card-title"><i class="fas fa-bullhorn"></i> Announcements</h3>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($announcements)): ?>
                                <ul class="list-group">
                                    <?php foreach ($announcements as $announcement): ?>
                                        <li class="list-group-item">
                                        <h5><strong><?= htmlspecialchars($announcement->title) ?></strong></h5>
                                            <p><?= htmlspecialchars($announcement->statement) ?></p>
                                            <small class="text-muted"><?= date('F j, Y', strtotime($announcement->announcement_date)) ?> at <?= date('g:i A', strtotime($announcement->announcement_time)) ?></small>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <p>No announcements available at this time.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
               
                <!-- Card 1 -->
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header bg-blue">
                            <h3 class="card-title">Merit Scholarship Program</h3>
                        </div>
                        <div class="card-body">
                            <p>This scholarship is awarded based on academic achievement.</p>
                            <a href="<?= base_url('applicant/merit_programs'); ?>" class="text-info">View Program</a>
                        </div>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header bg-green">
                            <h3 class="card-title">Non-Merit Scholarship Program</h3>
                        </div>
                        <div class="card-body">
                            <p>This scholarship is awarded based on financial need or other criteria.</p>
                            <a href="<?= base_url('applicant/non_merit_programs'); ?>" class="text-green">View Program</a>
                        </div>
                    </div>
                </div>
               
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content -->
</div><!-- /.content-wrapper -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php $this->load->view('includes/applicant_footer') ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php if ($this->session->flashdata('success')): ?>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '<?= $this->session->flashdata('success'); ?>',
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true
            });
        <?php endif; ?>
        
        <?php if ($has_conditional):?>
            Swal.fire({
                icon: 'warning',
                title: 'Conditional Status',
                text: 'One of your applications has a conditional status. Check your application page for TWC comment.',
                confirmButtonText: 'Okay'
            });
        <?php endif; ?>
    });
</script>

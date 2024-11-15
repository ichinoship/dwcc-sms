<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>
<title>View Applicant</title>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">View Application</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('twc/dashboard'); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('twc/app_review'); ?>">Application Review</a></li>
                        <li class="breadcrumb-item active">View Application</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <!-- Applicant Profile -->
            <div class="row justify-content-center">
                <div class="col-md-12 text-center">
                    <div class="card card-outline card-secondary shadow-sm">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <h5 class="card-title m-0"><i class="far fa-image mr-2"></i>Applicant Photo</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-center align-items-center flex-column">
                                <img src="<?= base_url('uploads/' . $applicant->applicant_photo); ?>" alt="Applicant Photo" class="mb-3" style="width:200px; height:200px; object-fit:cover; border: 1px solid black;">
                            </div>
                            <h3 class="font-weight-bold"><?= htmlspecialchars($applicant->firstname) . ' ' . htmlspecialchars($applicant->lastname); ?></h3>
                            <p class="text-muted"><strong>Applicant No:</strong> <?= htmlspecialchars($applicant->applicant_no); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Application Details -->
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card card-outline card-secondary shadow-sm">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <h5 class="card-title m-0"><i class="far fa-id-card mr-2"></i>Applicant Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>ID Number:</strong> <?= htmlspecialchars($applicant->id_number); ?></p>
                                    <p><strong>Full Name: </strong><?= htmlspecialchars($applicant->firstname) . ' ' . htmlspecialchars($applicant->middlename) . ' ' . htmlspecialchars($applicant->lastname); ?></p>
                                    <p><strong>Birthdate:</strong> <?= htmlspecialchars($applicant->birthdate); ?></p>
                                    <p><strong>Gender:</strong> <?= htmlspecialchars($applicant->gender); ?></p>
                                    <p><strong>Year:</strong> <?= htmlspecialchars($applicant->year); ?></p>
                                    <p><strong>Program:</strong> <?= htmlspecialchars($applicant->program); ?></p>
                                    <p><strong>Academic Year:</strong> <?= htmlspecialchars($applicant->academic_year); ?></p>
                                    <p><strong>Semester:</strong> <?= htmlspecialchars($applicant->semester); ?></p>
                                    <p><strong>Application Type:</strong> <?= htmlspecialchars($applicant->application_type); ?></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Scholarship Program:</strong> <?= htmlspecialchars($applicant->scholarship_program); ?></p>
                                    <p><strong>Campus:</strong> <?= htmlspecialchars($applicant->campus); ?></p>
                                    <p><strong>Program Type:</strong> <?= htmlspecialchars($applicant->program_type); ?></p>
                                    <p><strong>Contact:</strong> <?= htmlspecialchars($applicant->contact); ?></p>
                                    <p><strong>Email:</strong> <?= htmlspecialchars($applicant->email); ?></p>
                                    <p><strong>Address:</strong> <?= htmlspecialchars($applicant->address); ?></p>
                                    <p><strong>Applicant Residence:</strong> <?= htmlspecialchars($applicant->applicant_residence); ?></p>
                                    <p><strong>Status:</strong> <?= ucwords(htmlspecialchars($applicant->status)); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card card-outline card-secondary shadow-sm">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <h5 class="card-title m-0"><i class="far fa-list-alt mr-2"></i>Requirements</h5>
                        </div>
                        <div class="card-body">
                            <?php if ($applicant->requirements): ?>
                                <?php $requirements = explode(',', $applicant->requirements); ?>
                                <div class="list-group">
                                    <?php foreach ($requirements as $file_name): ?>
                                        <?php
                                        $file_path = base_url('uploads/' . trim($file_name));
                                        $file_ext = strtolower(pathinfo(trim($file_name), PATHINFO_EXTENSION));
                                        ?>
                                        <a href="#" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#filePreviewModal" data-file="<?= $file_path; ?>" data-type="<?= $file_ext; ?>">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h6 class="mb-1"><?= htmlspecialchars(trim($file_name)); ?></h6>
                                                <small class="text-muted"><?= strtoupper($file_ext); ?></small>
                                            </div>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <p>No requirements files available</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card card-outline card-secondary shadow-sm">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <h5 class="card-title m-0"><i class="far fa-comment-dots mr-2"></i>Application Comment</h5>
                        </div>
                        <div class="card-body p-3">
                            <?php if (!empty($applicants->comment)): ?>
                                <p class="mb-0"><?= nl2br(htmlspecialchars($applicants->comment)); ?></p>
                            <?php else: ?>
                                <p class="text-muted mb-0">No comments available for this application.</p>
                            <?php endif; ?>
                        </div>
                        <div class="card-footer">
                            <a href="<?= site_url('twc/app_evaluation'); ?>" class="btn btn-secondary">Back to App Evaluation</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal for File Preview -->
    <div class="modal fade" id="filePreviewModal" tabindex="-1" role="dialog" aria-labelledby="filePreviewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filePreviewModalLabel">File Preview</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="filePreviewContainer"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('includes/footer'); ?>

<script>
    $('#filePreviewModal').on('show.bs.modal', function(e) {
        var filePath = $(e.relatedTarget).data('file');
        var fileType = $(e.relatedTarget).data('type');
        var previewContainer = $('#filePreviewContainer');

        previewContainer.html('');

        if (fileType === 'pdf') {
            previewContainer.html('<embed src="' + filePath + '" width="100%" height="500px" type="application/pdf">');
        } else if (fileType === 'jpg' || fileType === 'jpeg' || fileType === 'png') {
            previewContainer.html('<img src="' + filePath + '" alt="Image Preview" width="100%" />');
        } else {
            previewContainer.html('<p>Unable to preview this file type.</p>');
        }
    });
</script>
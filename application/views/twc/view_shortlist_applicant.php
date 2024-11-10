<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>

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
                        <li class="breadcrumb-item"><a href="<?= base_url('twc/shortlist'); ?>">Shortlist</a></li>
                        <li class="breadcrumb-item active">View Application</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <!-- Profile Header -->
            <div class="row justify-content-center">
                <div class="col-md-12 text-center">
                    <div class="card shadow-sm ">
                        <div class="card-header bg-light">
                            <h5 class="card-title">Applicant Profile</h5>
                        </div>
                        <div class="card-body">

                            <div class="d-flex justify-content-center align-items-center flex-column">
                                <?php if ($applicants->applicant_photo): ?>
                                    <img src="<?= base_url('uploads/' . $applicants->applicant_photo); ?>"
                                        alt="Applicant Photo" class="mb-3"
                                        style="width:200px; height:200px; object-fit:cover; border: 1px solid black;">
                                <?php else: ?>
                                    <p>No photo available</p>
                                <?php endif; ?>
                                <h3 class="font-weight-bold"><?= htmlspecialchars($applicants->firstname) . ' ' . htmlspecialchars($applicants->lastname); ?></h3>
                                <p class="text-muted"><strong>Applicant No:</strong> <?= htmlspecialchars($applicants->applicant_no); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Application Details -->
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-light">
                            <h5 class="card-title">Applicant Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Id Number:</strong> <?= htmlspecialchars($applicants->id_number); ?></p>
                                    <p><strong>Full Name: </strong><?= htmlspecialchars($applicants->firstname) . ' ' . htmlspecialchars($applicants->middlename) . ' ' . htmlspecialchars($applicants->lastname); ?></p>
                                    <p><strong>Birthdate:</strong> <?= htmlspecialchars($applicants->birthdate); ?></p>
                                    <p><strong>Gender:</strong> <?= htmlspecialchars($applicants->gender); ?></p>
                                    <p><strong>Year Level:</strong> <?= htmlspecialchars($applicants->year); ?></p>
                                    <p><strong>Program:</strong> <?= htmlspecialchars($applicants->program); ?></p>
                                    <p><strong>Academic Year:</strong> <?= htmlspecialchars($applicants->academic_year); ?></p>
                                    <p><strong>Semester:</strong> <?= htmlspecialchars($applicants->semester); ?></p>
                                    <p><strong>Application Type:</strong> <?= htmlspecialchars($applicants->application_type); ?></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Discount:</strong> <?= htmlspecialchars($applicants->discount) . '%'; ?></p>
                                    <p><strong>Scholarship Program:</strong> <?= htmlspecialchars($applicants->scholarship_program); ?></p>
                                    <p><strong>Campus:</strong> <?= htmlspecialchars($applicants->campus); ?></p>
                                    <p><strong>Program Type:</strong> <?= htmlspecialchars($applicants->program_type); ?></p>
                                    <p><strong>Contact:</strong> <?= htmlspecialchars($applicants->contact); ?></p>
                                    <p><strong>Email:</strong> <?= htmlspecialchars($applicants->email); ?></p>
                                    <p><strong>Address:</strong> <?= htmlspecialchars($applicants->address); ?></p>
                                    <p><strong>Applicant Residence:</strong> <?= htmlspecialchars($applicants->applicant_residence); ?></p>
                                    <p><strong>Status:</strong> <?= ucwords(htmlspecialchars($applicants->status)); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Requirements -->
                    <div class="card shadow-sm">
                        <div class="card-header bg-light">
                            <h5 class="card-title">Requirements</h5>
                        </div>
                        <div class="card-body">
                            <?php if ($applicants->requirements): ?>
                                <?php $requirements = explode(',', $applicants->requirements); ?>
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
                        <div class="card-footer">
                            <a href="<?= site_url('twc/shortlist'); ?>" class="btn btn-secondary">Back to Shortlist</a>
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

        previewContainer.html(''); // Clear the previous preview

        if (fileType === 'pdf') {
            previewContainer.html('<embed src="' + filePath + '" width="100%" height="500px" type="application/pdf">');
        } else if (fileType === 'jpg' || fileType === 'jpeg' || fileType === 'png') {
            previewContainer.html('<img src="' + filePath + '" alt="Image Preview" width="100%" />');
        } else {
            previewContainer.html('<p>Unable to preview this file type.</p>');
        }
    });
</script>
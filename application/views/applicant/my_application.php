<?php $this->load->view('includes/applicant_header'); ?>
<?php $this->load->view('includes/applicant_sidebar'); ?>
<title>My Applications</title>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">My Applications</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('applicant/dashboard_applicant'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Applicant</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">My Scholarship Applications</h3>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <select id="filter_academic_year" class="form-control">
                                <option value="" disabled selected>Filter by Academic Year:</option>
                                <option value="">All Academic Years</option>
                                <?php foreach ($academic_filter_years as $year): ?>
                                    <option value="<?= $year->academic_year ?>"><?= $year->academic_year ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <select id="filter_semester" class="form-control">
                                <option value="" disabled selected>Filter by Semester:</option>
                                <option value="">All Semesters</option>
                                <option value="1st Semester">1st Semester</option>
                                <option value="2nd Semester">2nd Semester</option>
                                <option value="Whole Semester">Whole Semester</option>
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Scholarship Program</th>
                                    <th>Academic Year</th>
                                    <th>Semester</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($applications)): ?>
                                    <tr>
                                        <td colspan="6" class="text-center">No application found</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($applications as $application): ?>
                                        <?php
                                            $statusChangedDate = $application->date_status_changed; // Fetch the date when the status changed
                                            $conditionalExpiryDate = date('Y-m-d', strtotime($statusChangedDate . ' +5 days'));
                                            $today = date('Y-m-d');
                                        ?>

                                        <tr data-academic-year="<?= htmlspecialchars($application->academic_year); ?>" data-semester="<?= htmlspecialchars($application->semester); ?>">
                                            <td><?= htmlspecialchars($application->firstname . ' ' . $application->middlename . ' ' . $application->lastname); ?></td>
                                            <td><?= htmlspecialchars($application->scholarship_program); ?></td>
                                            <td><?= htmlspecialchars($application->academic_year); ?></td>
                                            <td><?= htmlspecialchars($application->semester); ?></td>
                                            <td><?= ucwords(htmlspecialchars($application->status)); ?></td>
                                            <td>
                                                <a href="<?= site_url('applicant/view_form/' . $application->applicant_no); ?>" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <?php if ($application->status === 'conditional' && $today <= $conditionalExpiryDate): ?>
                                                    <a href="#"
                                                       class="btn btn-success btn-sm edit-btn"
                                                       data-status="<?= htmlspecialchars($application->status); ?>"
                                                       data-url="<?= site_url('applicant/edit_application/' . $application->applicant_no); ?>">
                                                       <i class="fas fa-edit"></i>
                                                    </a>
                                                <?php endif; ?>
                                                <?php if ($application->status === 'conditional' && !empty($application->comment)): ?>
                                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#commentModal" data-comment="<?= htmlspecialchars($application->comment); ?>">
                                                        <i class="fas fa-comments"></i>
                                                    </button>
                                                <?php elseif ($application->status === 'conditional'): ?>
                                                    <button class="btn btn-secondary btn-sm" disabled>No Comment</button>
                                                <?php elseif ($application->status === 'not qualified' && !empty($application->comment)): ?>
                                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#commentModal" data-comment="<?= htmlspecialchars($application->comment); ?>">
                                                        <i class="fas fa-comments"></i>
                                                    </button>
                                                <?php elseif ($application->status === 'not qualified'): ?>
                                                    <button class="btn btn-secondary btn-sm" disabled>No Comment</button>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Comment Modal -->
<div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="commentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="commentModalLabel">Comment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="commentModalBody">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('includes/applicant_footer'); ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $('#commentModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var comment = button.data('comment');
        var modal = $(this);
        modal.find('#commentModalBody').text(comment);
    });
    $(document).ready(function() {
        $('.edit-btn').click(function(e) {
            e.preventDefault();
            var status = $(this).data('status');
            var url = $(this).data('url');
            var startDate = new Date($(this).data('start-date'));
            var endDate = new Date($(this).data('end-date'));
            var today = new Date();

            if (status === 'qualified' || status === 'not qualified' || status === 'pending') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Access Denied',
                    text: 'You are currently ' + status + '. You cannot edit this application.',
                    showConfirmButton: true
                });
            } else {
                window.location.href = url;
            }
        });
    });
</script>

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
    });
</script>
<?php $this->load->view('includes/applicant_header') ?>
<?php $this->load->view('includes/applicant_sidebar') ?>
<title>Non-Merit Scholarship Program</title>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Non-Merit Scholarship Program</h1>
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
            <div class="row">
                <div class="col-lg-12 col-md-12 mb-4">
                    <input type="text" id="searchPrograms" class="form-control" placeholder="Search for programs...">
                </div>
                <!-- Non-Merit Programs -->
                <div class="col-lg-12 col-md-12 program-category">
                    <div class="card card-green card-outline">
                        <div class="card-body">
                            <div class="row" id="programList">
                                <?php if (!empty($non_merit_programs)): ?>
                                    <?php foreach ($non_merit_programs as $program): ?>
                                        <div class="col-md-6 mb-4 program-item">
                                            <div class="card card-widget">
                                                <div class="card-header">
                                                    <h5 class="card-title text-bold"><?= htmlspecialchars($program->scholarship_program) ?></h5>
                                                </div>
                                                <div class="card-body">
                                                    <p><?= htmlspecialchars($program->description) ?></p>
                                                    <a href="<?= base_url('applicant/apply_scholarship'); ?>" class="btn btn-primary btn-sm apply-now-btn">Apply Now</a>
                                                    <button data-program-code="<?= htmlspecialchars($program->program_code) ?>" class="btn btn-secondary btn-sm view-info-btn">View Info</button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p>No Non-Merit Programs available.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for viewing program details -->
<div class="modal fade" id="programInfoModal" tabindex="-1" role="dialog" aria-labelledby="programInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="programInfoModalLabel">Program Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="programDetails">
                    <!-- Program details will be loaded here -->
                    <h5 id="programTitle"></h5>
                    <p><strong>Description:</strong> <span id="programDescription"></span></p>
                    <p><strong>Campus:</strong> <span id="programCampus"></span></p>
                    <p><strong>Academic Year:</strong> <span id="programAcademicYear"></span></p>
                    <p><strong>Semester:</strong> <span id="programSemester"></span></p>
                    <p><strong>Qualifications:</strong> <span id="programQualifications"></span></p>
                    <ul id="programQualificationsList"></ul>
                    <p><strong>Requirements:</strong> <span id="programRequirements"></span></p>
                    <ul id="programRequirementsList"></ul>
                </div>
            </div>
            <div class="modal-footer">
                <a href="<?= base_url('applicant/apply_scholarship'); ?>" class="btn btn-primary btn-sm">Apply Now</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('includes/applicant_footer') ?>

<script>
     
    $(document).on('click', '.view-info-btn', function() {
        var programCode = $(this).data('program-code');
        
        $.ajax({
            url: '<?= base_url('applicant/get_program_details'); ?>',
            method: 'GET',
            data: { program_code: programCode },
            success: function(response) {
                var program = JSON.parse(response);
                $('#programTitle').text(program.scholarship_program);
                $('#programDescription').text(program.description);
                $('#programCampus').text(program.campus);
                var qualifications = program.qualifications.split(';');
                var qualificationsList = $('#programQualificationsList');
                qualificationsList.empty();
                qualifications.forEach(function(qualifications) {
                    qualificationsList.append('<li>' + qualifications.trim() + '</li>');
                });
                var requirements = program.requirements.split(';');
                var requirementsList = $('#programRequirementsList');
                requirementsList.empty();
                requirements.forEach(function(requirement) {
                    requirementsList.append('<li>' + requirement.trim() + '</li>');
                });
                $('#programSubmitTo').text(program.submit_to);
                $('#programAcademicYear').text(program.academic_year);
                $('#programSemester').text(program.semester);
                $('#programInfoModal').modal('show');
            }
        });
    });

    // Search filter for programs
    $('#searchPrograms').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        $('#programList .program-item').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

</script>

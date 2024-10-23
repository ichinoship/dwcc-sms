<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Scholarship Applicants</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('sc/dashboard'); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('sc/school_year'); ?>">School Year</a></li>
                        <li class="breadcrumb-item active">View List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Applicants for <?php echo $academic_year; ?></h3>
                </div>
                <div class="card-body">
                    <div class="card-tools mb-3">
                        <div class="row col-12">
                            <div class="col-md-3 mb-2">
                                <select id="campusFilter" class="form-control">
                                    <option value="All" selected>All Campuses</option>
                                    <option value="Janssen">Janssen</option>
                                    <option value="Freinademetz">Freinademetz</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-2">
                                <select id="semesterFilter" class="form-control">
                                    <option value="All" selected>All Semesters</option>
                                    <option value="1st Semester">1st Semester</option>
                                    <option value="2nd Semester">2nd Semester</option>
                                    <option value="Whole Semester">Whole Semester</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-2">
                                <select id="scholarshipProgramFilter" class="form-control">
                                    <option value="All" selected>All Scholarship Programs</option>
                                    <?php foreach ($programs as $program): ?>
                                        <option value="<?= $program->scholarship_program; ?>"><?= $program->scholarship_program; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-3 mb-2 d-flex align-items-end">
                                <button id="resetFilters" class="btn btn-secondary col-md-12">Reset Filters</button>
                            </div>
                        </div>
                    </div>
                    <table id="example1" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>ID Number</th>
                                <th>Name</th>
                                <th>Program Type</th>
                                <th>Scholarship Program</th>
                                <th>Discount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($applicants)): ?>
                                <?php foreach ($applicants as $applicant): ?>
                                    <tr class="applicant-row" data-scholarship="<?= $applicant->scholarship_program; ?>" data-campus="<?= $applicant->campus; ?>" data-semester="<?= $applicant->semester; ?>">
                                        <td><?php echo $applicant->id_number; ?></td>
                                        <td><?php echo $applicant->firstname . ' ' . $applicant->middlename . ' ' . $applicant->lastname; ?></td>
                                        <td><?php echo $applicant->program_type; ?></td>
                                        <td><?php echo $applicant->scholarship_program; ?></td>
                                        <td><?php echo $applicant->discount; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center">No applicants found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
</div>

<?php $this->load->view('includes/footer'); ?>

<script>
    $(document).ready(function() {
        function filterApplicants() {
            var selectedProgram = $('#scholarshipProgramFilter').val();
            var selectedCampus = $('#campusFilter').val();
            var selectedSemester = $('#semesterFilter').val();

            $('.applicant-row').each(function() {
                var matchProgram = (selectedProgram === "All" || $(this).data('scholarship') === selectedProgram);
                var matchCampus = (selectedCampus === "All" || $(this).data('campus') === selectedCampus);
                var matchSemester = (selectedSemester === "All" || $(this).data('semester') === selectedSemester);

                if (matchProgram && matchCampus && matchSemester) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }

        // Apply filtering when dropdown values change
        $('#scholarshipProgramFilter, #campusFilter, #semesterFilter').on('change', filterApplicants);

        // Reset filters
        $('#resetFilters').on('click', function() {
            $('#scholarshipProgramFilter').val('All');
            $('#campusFilter').val('All');
            $('#semesterFilter').val('All');
            filterApplicants(); // Show all applicants
        });
    });
</script>
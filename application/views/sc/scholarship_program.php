<!-- Scholarship Program -->
<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>
<title>Scholarship Program</title>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Scholarship Program</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('sc/dashboard'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Scholarship Program</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <?php if (validation_errors()): ?>
                <div class="alert text-center alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert text-center alert-danger">
                    <?= $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('message')): ?>
                <div class="alert text-center alert-success">
                    <?= $this->session->flashdata('message'); ?>
                </div>
            <?php endif; ?>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List of Scholarship Programs</h3>
                    <div class="card-tools">
                        <!-- Set Date Button -->
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#setDateModal"><i class="fa fa-calendar" aria-hidden="true"></i>
                            <span class="ml-2">Set Date</span>
                        </button>
                        <!-- Add Requirements Button -->
                        <a href="<?= base_url('sc/add_requirements'); ?>" class="btn btn-secondary">
                            <i class="fa fa-file" aria-hidden="true"></i>
                            <span class="ml-2">Add Requirements</span>
                        </a>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProgramModal"><i class="fa fa-plus" aria-hidden="true"></i>
                            <span class="ml-2">Add Program</span>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Program Code</th>
                                <th>Scholarship Program</th>
                                <th>Scholarship Type</th>
                                <th>Program Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($programs as $program) : ?>
                                <tr>
                                    <td><?= $program->program_code; ?></td>
                                    <td><?= $program->scholarship_program; ?></td>
                                    <td><?= $program->scholarship_type; ?></td>
                                    <td><?= ucfirst($program->program_status); ?></td>
                                    <td>
                                        <!-- View Button -->
                                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewProgramModal"
                                            data-program-code="<?= $program->program_code; ?>"
                                            data-program-name="<?= $program->scholarship_program; ?>"
                                            data-campus="<?= $program->campus; ?>"
                                            data-academic-year="<?= $program->academic_year; ?>"
                                            data-semester="<?= $program->semester; ?>"
                                            data-start_date="<?= $program->start_date; ?>"
                                            data-end_date="<?= $program->end_date; ?>"
                                            data-scholarship-type="<?= $program->scholarship_type; ?>"
                                            data-percentage="<?= $program->percentage; ?>"
                                            data-requirements="<?= $program->requirements; ?>"
                                            data-description="<?= $program->description; ?>"
                                            data-qualifications="<?= $program->qualifications; ?>">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <!-- Edit Button -->
                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editProgramModal"
                                            data-program-code="<?= $program->program_code; ?>"
                                            data-program-name="<?= $program->scholarship_program; ?>"
                                            data-campus="<?= $program->campus; ?>"
                                            data-academic_year="<?= $program->academic_year; ?>"
                                            data-semester="<?= $program->semester; ?>"
                                            data-scholarship-type="<?= $program->scholarship_type; ?>"
                                            data-program-status="<?= $program->program_status; ?>"
                                            data-percentage="<?= $program->percentage; ?>"
                                            data-requirements="<?= $program->requirements; ?>"
                                            data-description="<?= $program->description; ?>"
                                            data-qualifications="<?= $program->qualifications; ?>">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Set Date Modal -->
            <div class="modal fade" id="setDateModal" tabindex="-1" role="dialog" aria-labelledby="setDateModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="setDateModalLabel">Set Dates for Scholarship Program</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="setDateForm">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="start_date">Start Date</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date" required min="<?= date('Y-m-d'); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="end_date">End Date</label>
                                    <input type="date" class="form-control" id="end_date" name="end_date" required min="<?= date('Y-m-d'); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Select Scholarship Program</label>
                                    <div class="form-check mb-2">
                                        <!-- "Select All" checkbox -->
                                        <input type="checkbox" class="form-check-input" id="selectAll">
                                        <label class="form-check-label" for="selectAll">All Program</label>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <?php foreach ($programs as $program): ?>
                                            <div class="col-md-4">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input program-checkbox" name="scholarship_programs[]" value="<?= $program->program_code; ?>" id="program_<?= $program->program_code; ?>">
                                                    <label class="form-check-label" for="program_<?= $program->program_code; ?>"><?= $program->scholarship_program; ?></label>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Set Date</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <!-- View Program Modal -->
            <div class="modal fade" id="viewProgramModal" tabindex="-1" role="dialog" aria-labelledby="viewProgramModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="viewProgramModalLabel">View Scholarship Program</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Program Code:</strong> <span id="viewProgramCode"></span></p>
                            <p><strong>Scholarship Program:</strong> <span id="viewProgramName"></span></p>
                            <div class="row">
                                <div class="col-md-4">
                                    <p><strong>Scholarship Type:</strong> <span id="viewScholarshipType"></span></p>
                                </div>
                                <div class="col-md-4">
                                    <p><strong>Academic Year:</strong> <span id="viewAcademicYear"></span></p>
                                </div>
                                <div class="col-md-4">
                                    <p><strong>Semester:</strong> <span id="viewSemester"></span></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <p><strong>Start Date:</strong> <span id="viewStartDate"></span></p>
                                </div>
                                <div class="col-md-4">
                                    <p><strong>End Date:</strong> <span id="viewEndDate"></span></p>
                                </div>
                            </div>
                            <p><strong>Description:</strong> <span id="viewDescription"></span></p>
                            <p><strong>Qualifications:</strong> <span id="viewQualifications"></span></p>
                            <ul id="viewQualificationsList"></ul>
                            <p><strong>Percentage:</strong> <span id="viewPercentage"></span></p>
                            <ul id="viewPercentageList"></ul>
                            <p><strong>Requirements:</strong> <span id="viewRequirements"></span></p>
                            <ul id="viewRequirementsList"></ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add Program Modal -->
            <div class="modal fade" id="addProgramModal" tabindex="-1" role="dialog" aria-labelledby="addProgramModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addProgramModalLabel">Add New Scholarship Program</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?= base_url('sc/add_scholarship_program'); ?>" method="post">
                            <div class="modal-body">
                                <div class="row">
                                    <!-- Scholarship Program Name -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="scholarship_program">Scholarship Program Name</label>
                                            <input type="text" class="form-control" id="scholarship_program" name="scholarship_program" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- Campus -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="campus">Campus</label>
                                            <select class="form-control" id="campus" name="campus" required>
                                                <option value="">Select Campus</option>
                                                <option value="Janssen">Janssen</option>
                                                <option value="Freinademetz">Freinademetz</option>
                                                <option value="All Campus">All Campus</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Academic Year -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="academic_year">Academic Year</label>
                                            <select class="form-control" id="academic_year" name="academic_year" required>
                                                <option value="">Select Academic Year</option>
                                                <?php if (isset($academic_years) && !empty($academic_years)): ?>
                                                    <?php foreach ($academic_years as $year): ?>
                                                        <option value="<?php echo $year['academic_year']; ?>">
                                                            <?php echo $year['academic_year']; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Semester -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="semester">Semester</label>
                                            <select class="form-control" id="semester" name="semester" required>
                                                <option value="">Select Semester</option>
                                                <option value="1st Semester">1st Semester</option>
                                                <option value="2nd Semester">2nd Semester</option>
                                                <option value="Whole Semester">Whole Semester</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- Scholarship Type -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="scholarship_type">Scholarship Type</label>
                                            <select class="form-control" id="scholarship_type" name="scholarship_type" required>
                                                <option value="">Select Type</option>
                                                <option value="Non-Merit">Non-Merit</option>
                                                <option value="Merit">Merit</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="program_status">Program Status</label>
                                            <select class="form-control" id="program_status" name="program_status" required>
                                                <option value="active">Active</option>
                                                <option value="deactivated">Deactivate</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Assigned To -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="assigned_to">Assigned To</label>
                                            <select class="form-control" id="assigned_to" name="assigned_to" required>
                                                <option value="">Select TWC User</option>
                                                <?php foreach ($twc_users as $twc_user) : ?>
                                                    <option value="<?= $twc_user->id; ?>"><?= $twc_user->name; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="percentage">Percentage</label>
                                            <input type="text" class="form-control" id="percentage" name="percentage" min="0" max="100" step="0.01" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- Description -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="qualifications">Qualifications</label>
                                            <textarea class="form-control" id="qualifications" name="qualifications" rows="3" required></textarea>
                                        </div>
                                    </div>
                                    <!-- Program Status -->

                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="requirements">Requirements</label>
                                        <div class="row">
                                            <?php
                                            $columnsPerRow = 3;
                                            $counter = 0;
                                            $totalRequirements = count($requirements);
                                            ?>
                                            <?php foreach ($requirements as $requirement) : ?>
                                                <div class="col-md-<?php echo 12 / $columnsPerRow; ?>">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="requirements[]" value="<?= $requirement->requirement_name; ?>" id="requirement<?= $requirement->id; ?>">
                                                        <label class="form-check-label" for="requirement<?= $requirement->id; ?>">
                                                            <?= $requirement->requirement_name; ?>
                                                        </label>
                                                    </div>
                                                </div>
                                                <?php
                                                $counter++;
                                                if ($counter % $columnsPerRow == 0 && $counter != $totalRequirements) {
                                                    echo '</div><div class="row">';
                                                }
                                                ?>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Edit Program Modal -->
            <div class="modal fade" id="editProgramModal" tabindex="-1" role="dialog" aria-labelledby="editProgramModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editProgramModalLabel">Edit Scholarship Program</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="editProgramForm" action="<?= base_url('sc/edit_scholarship_program'); ?>" method="post">
                            <div class="modal-body">
                                <input type="hidden" id="edit_program_code" name="program_code">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="edit_scholarship_program">Scholarship Program Name</label>
                                            <input type="text" class="form-control" id="edit_scholarship_program" name="scholarship_program" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- Campus -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="edit_campus">Campus</label>
                                            <select class="form-control" id="edit_campus" name="campus" required>
                                                <option value="">Select Campus</option>
                                                <option value="Janssen">Janssen</option>
                                                <option value="Freinademetz">Freinademetz</option>
                                                <option value="All Campus">All Campus</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Academic Year -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="academic_year">Academic Year</label>
                                            <select class="form-control" id="academic_year" name="academic_year" required>
                                                <option value="">Select Academic Year</option>
                                                <?php if (isset($academic_years) && !empty($academic_years)): ?>
                                                    <?php foreach ($academic_years as $year): ?>
                                                        <option value="<?php echo $year['academic_year']; ?>"
                                                            <?php echo (isset($current_academic_year) && $current_academic_year === $year['academic_year']) ? 'selected' : ''; ?>>
                                                            <?php echo $year['academic_year']; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Semester -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="edit_semester">Semester</label>
                                            <select class="form-control" id="edit_semester" name="semester" required>
                                                <option value="">Select Semester</option>
                                                <option value="1st Semester">1st Semester</option>
                                                <option value="2nd Semester">2nd Semester</option>
                                                <option value="Whole Semester">Whole Semester</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="edit_scholarship_type">Scholarship Type</label>
                                            <select class="form-control" id="edit_scholarship_type" name="scholarship_type" required>
                                                <option value="">Select Type</option>
                                                <option value="Non-Merit">Non-Merit</option>
                                                <option value="Merit">Merit</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Program Status -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="edit_program_status">Program Status</label>
                                            <select class="form-control" id="edit_program_status" name="program_status" required>
                                                <option value="active">Active</option>
                                                <option value="deactivated">Deactivate</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="edit_assigned_to">Assigned To</label>
                                            <select class="form-control" id="edit_assigned_to" name="assigned_to" required>
                                                <option value="">Select TWC User</option>
                                                <?php foreach ($twc_users as $twc_user) : ?>
                                                    <option value="<?= $twc_user->id; ?>"><?= $twc_user->name; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="edit_percentage">Percentage</label>
                                            <input type="text" class="form-control" id="edit_percentage" name="percentage" min="0" max="100" step="0.01" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="edit_description">Description</label>
                                            <textarea class="form-control" id="edit_description" name="description" rows="3" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="edit_qualifications">Qualifications</label>
                                            <textarea class="form-control" id="edit_qualifications" name="qualifications" rows="3" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- Requirements Section -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="edit_requirements">Requirements</label>
                                        <div class="row">
                                            <?php
                                            $columnsPerRow = 3;
                                            $counter = 0;
                                            ?>
                                            <?php foreach ($requirements as $requirement) : ?>
                                                <div class="col-md-<?php echo 12 / $columnsPerRow; ?>">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="requirements[]" value="<?= $requirement->requirement_name; ?>" id="edit_requirement<?= $requirement->id; ?>">
                                                        <label class="form-check-label" for="edit_requirement<?= $requirement->id; ?>">
                                                            <?= $requirement->requirement_name; ?>
                                                        </label>
                                                    </div>
                                                </div>
                                                <?php
                                                $counter++;
                                                if ($counter % $columnsPerRow == 0 && $counter != count($requirements)) {
                                                    echo '</div><div class="row">';
                                                }
                                                ?>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
<!-- End of Scholarship Program -->
<?php $this->load->view('includes/footer'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php if ($this->session->flashdata('message')): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '<?= $this->session->flashdata('message'); ?>',
            confirmButtonText: 'OK'
        });
    </script>
<?php endif; ?>
<script>
    $('button[data-target="#editProgramModal"]').on('click', function() {
        var programCode = $(this).closest('tr').find('td:first').text();

        $.ajax({
            url: '<?= base_url('sc/get_scholarship_program'); ?>',
            method: 'GET',
            data: {
                program_code: programCode
            },
            success: function(response) {
                var program = JSON.parse(response);

                $('#edit_program_code').val(program.program_code);
                $('#edit_scholarship_program').val(program.scholarship_program);
                $('#edit_campus').val(program.campus);
                $('#edit_academic_year').val(program.academic_year);
                $('#edit_semester').val(program.semester);
                $('#edit_scholarship_type').val(program.scholarship_type);
                $('#edit_description').val(program.description);
                $('#edit_qualifications').val(program.qualifications);
                $('#edit_percentage').val(program.percentage);
                $('#edit_program_status').val(program.program_status);
                $('#edit_assigned_to').val(program.assigned_to);
                $('#edit_submit_to').val(program.submit_to);

                var requirements = program.requirements.split(';');
                $('input[name="requirements[]"]').each(function() {
                    $(this).prop('checked', requirements.includes($(this).val()));
                });

                // Update the form action to include the program code
                $('#editProgramForm').attr('action', '<?= base_url('sc/edit_scholarship_program/'); ?>' + program.program_code);

                $('#editProgramModal').modal('show');
            }
        });
    });

    $('#viewProgramModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var programCode = button.data('program-code');
        var programName = button.data('program-name');
        var scholarshipType = button.data('scholarship-type');
        var academicYear = button.data('academic-year');
        var semester = button.data('semester');
        var start_date = button.data('start_date');
        var end_date = button.data('end_date');
        var programStatus = button.data('program_status');
        var assignedTo = button.data('assigned-to');
        var description = button.data('description');
        var qualifications = button.data('qualifications').split(';');
        var requirements = button.data('requirements').split(';');
        var percentage = button.data('percentage').split(';');

        $('#viewProgramCode').text(programCode);
        $('#viewProgramName').text(programName);
        $('#viewScholarshipType').text(scholarshipType);
        $('#viewAcademicYear').text(academicYear);
        $('#viewSemester').text(semester);
        $('#viewStartDate').text(start_date);
        $('#viewEndDate').text(end_date);
        $('#viewProgramStatus').text(programStatus);
        $('#viewAssignedTo').text(assignedTo);
        $('#viewDescription').text(description);
        var qualificationsList = $('#viewQualificationsList');
        qualificationsList.empty();
        qualifications.forEach(function(qualification) {
            qualificationsList.append('<li>' + qualification.trim() + '</li>');
        });
        var percentageList = $('#viewPercentageList');
        percentageList.empty();
        percentage.forEach(function(percentage) {
            percentageList.append('<li>' + percentage.trim() + '</li>');
        });
        var requirementsList = $('#viewRequirementsList');
        requirementsList.empty();
        requirements.forEach(function(requirement) {
            requirementsList.append('<li>' + requirement.trim() + '</li>');
        });
    });
</script>

<script>
    document.getElementById('selectAll').addEventListener('change', function() {
        var checkboxes = document.querySelectorAll('.program-checkbox');
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = this.checked;
        }
    });

    var programCheckboxes = document.querySelectorAll('.program-checkbox');
    for (var i = 0; i < programCheckboxes.length; i++) {
        programCheckboxes[i].addEventListener('change', function() {
            if (!this.checked) {
                document.getElementById('selectAll').checked = false;
            }
        });
    }
    document.getElementById('start_date').addEventListener('change', function() {
        var startDate = this.value;
        document.getElementById('end_date').setAttribute('min', startDate);
    });
    $(document).ready(function() {
        $('#setDateForm').submit(function(e) {
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: '<?= base_url('sc/set_scholarship_dates'); ?>',
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (response === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Dates Set',
                            text: 'Start and end dates have been set successfully.',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to set dates. Please try again.',
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An unexpected error occurred. Please try again later.',
                    });
                }
            });
        });
    });
</script>
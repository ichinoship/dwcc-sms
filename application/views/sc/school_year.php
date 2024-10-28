<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>
<title>School Year</title>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">School Year List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('sc/dashboard'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">School Year List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Semester Card -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List of Semesters</h3>
                        </div>
                        <div class="card-body">
                            <div class="card-tools mb-3">
                                <button class="btn btn-secondary" data-toggle="modal" data-target="#addSemesterModal">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i> <span class="ml-2">Add Semester</span>
                                </button>
                            </div>
                            <table id="example5" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Semester</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($semesters)): ?>
                                        <?php foreach ($semesters as $semester): ?>
                                            <tr>
                                                <td><?php echo $semester->semester; ?></td>
                                                <td><?php echo date('Y-m-d', strtotime($semester->start_date)); ?></td>
                                            <td><?php echo date('Y-m-d', strtotime($semester->end_date)); ?></td>
                                                <td>
                                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editSemesterModal"
                                                        data-id="<?php echo $semester->semester_id; ?>"
                                                        data-semester="<?php echo $semester->semester; ?>"
                                                        data-start-date="<?php echo $semester->start_date; ?>"
                                                        data-end-date="<?php echo $semester->end_date; ?>">

                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="text-center">No semesters available</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- School Year Card -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List of School Year</h3>
                        </div>
                        <div class="card-body">
                            <div class="card-tools mb-3">
                                <button class="btn btn-secondary" data-toggle="modal" data-target="#addYearModal">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i> <span class="ml-2">Add School Year</span>
                                </button>
                            </div>
                            <table id="example4" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Academic Year</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($school_years as $year): ?>
                                        <tr>
                                            <td><?php echo $year->academic_year; ?></td>
                                            <td>
                                                <a href="<?php echo site_url('sc/view_list/' . $year->school_year_id); ?>" class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Add Year Modal -->
<div class="modal fade" id="addYearModal" tabindex="-1" role="dialog" aria-labelledby="addYearModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addYearModalLabel">Add School Year</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo site_url('sc/add_school_year'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="academic_year">Academic Year</label>
                        <input type="text" class="form-control" id="academic_year" name="academic_year" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Add Semester Modal -->
<div class="modal fade" id="addSemesterModal" tabindex="-1" role="dialog" aria-labelledby="addSemesterModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSemesterModalLabel">Add Semester</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo site_url('sc/add_semester'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <select class="form-control" id="semester" name="semester" required onchange="setSchoolLevel()">
                            <option value="">Select Semester</option>
                            <option value="1st Semester">1st Semester</option>
                            <option value="2nd Semester">2nd Semester</option>
                            <option value="Whole Semester">Whole Semester</option>
                        </select>
                    </div>
                    <input type="hidden" id="school_level" name="school_level" value="Higher Education">

                    <div class="form-group">
                        <label for="start_date">Start Date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                    </div>

                    <div class="form-group">
                        <label for="end_date">End Date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Semester Modal -->
<div class="modal fade" id="editSemesterModal" tabindex="-1" role="dialog" aria-labelledby="editSemesterModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSemesterModalLabel">Edit Semester</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo site_url('sc/edit_semester'); ?>" method="post">
                <div class="modal-body">
                    <input type="hidden" id="edit_semester_id" name="semester_id">
                    <div class="form-group">
                        <label for="edit_start_date">Start Date</label>
                        <input type="date" class="form-control" id="edit_start_date" name="start_date" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_end_date">End Date</label>
                        <input type="date" class="form-control" id="edit_end_date" name="end_date" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

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
    function confirmDelete(schoolYearId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '<?= site_url('sc/delete_school_year/'); ?>' + schoolYearId;
            }
        });
    }

    
    $('#editSemesterModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var semesterId = button.data('id'); // Extract info from data-* attributes
        var semester = button.data('semester');
        var startDate = button.data('start-date');
        var endDate = button.data('end-date');

        // Update the modal's content
        var modal = $(this);
        modal.find('#edit_semester_id').val(semesterId);
        modal.find('#edit_start_date').val(startDate);
        modal.find('#edit_end_date').val(endDate);
    });
</script>
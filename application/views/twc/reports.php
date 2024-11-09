<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>
<title>TWC Reports</title>

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
                            <div class="card-tools mb-3">
                                <form method="post" action="<?= base_url('sc/reports'); ?>" class="form-inline">
                                    <div class="row col-12">
                                        <div class="col-md-4 mb-2">
                                            <select name="academic_year" class="form-control w-100">
                                                <option value="">Select Academic Year</option>
                                                <?php foreach ($academic_years as $year): ?>
                                                    <option value="<?= $year->academic_year; ?>" <?= ($this->input->post('academic_year') == $year->academic_year) ? 'selected' : ''; ?>>
                                                        <?= $year->academic_year; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <select name="semester" class="form-control w-100">
                                                <option value="">Select Semester</option>
                                                <option value="1st Semester" <?= ($this->input->post('semester') == '1st Semester') ? 'selected' : ''; ?>>1st Semester</option>
                                                <option value="2nd Semester" <?= ($this->input->post('semester') == '2nd Semester') ? 'selected' : ''; ?>>2nd Semester</option>
                                                <option value="Whole Semester" <?= ($this->input->post('semester') == 'Whole Semester') ? 'selected' : ''; ?>>Whole Semester</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <select name="campus" class="form-control w-100">
                                                <option value="">Select Campus</option>
                                                <option value="Janssen" <?= ($this->input->post('campus') == 'Janssen') ? 'selected' : ''; ?>>Janssen</option>
                                                <option value="Freinademetz" <?= ($this->input->post('campus') == 'Freinademetz') ? 'selected' : ''; ?>>Freinademetz</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="row col-12">
                                        <div class="col-md-4 mb-2">
                                            <select name="status" class="form-control w-100">
                                                <option value="">Select Status</option>
                                                <option value="qualified" <?= ($this->input->post('status') == 'qualified') ? 'selected' : ''; ?>>Qualified</option>
                                                <option value="conditional" <?= ($this->input->post('status') == 'conditional') ? 'selected' : ''; ?>>Conditional</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <select name="scholarship_program" class="form-control w-100">
                                                <option value="">Select Scholarship Program</option>
                                                <?php foreach ($scholarship_programs as $program): ?>
                                                    <option value="<?= $program->scholarship_program; ?>" <?= ($this->input->post('scholarship_program') == $program->scholarship_program) ? 'selected' : ''; ?>>
                                                        <?= $program->scholarship_program; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-2 d-flex align-items-end">
                                            <button type="button" class="btn btn-secondary mr-2 col-md-6" id="resetFilters">Reset Filters</button>
                                            <button type="button" class="btn btn-primary col-md-6" id="printTable">Print Report</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <table id="applicantsTable" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>

                                        <th>ID Number</th>
                                        <th>Last Name</th>
                                        <th>First Name</th>
                                        <th>Academic Year</th>
                                        <th>Semester</th>
                                        <th>Campus</th>
                                        <th>Scholarship Program</th>
                                        <th>Status</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($applicants)): ?>
                                        <?php foreach ($applicants as $applicant): ?>
                                            <tr>
                                                <td><?= $applicant->id_number; ?></td>
                                                <td><?= $applicant->lastname; ?></td>
                                                <td><?= $applicant->firstname; ?></td>
                                                <td><?= $applicant->academic_year; ?></td>
                                                <td><?= $applicant->semester; ?></td>
                                                <td><?= $applicant->campus; ?></td>
                                                <td><?= $applicant->scholarship_program; ?></td>
                                                <td class="status-column"><?= ucwords($applicant->status); ?></td>

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
                    </div>
                </div>
            </div>
        </div>


    </section>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>


<script>
    $(document).ready(function() {
        // Initialize DataTable with the new table ID
        var table = $('#applicantsTable').DataTable({
            "processing": true,
            "serverSide": false,
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });

        // Apply filters on change
        $('select[name="academic_year"], select[name="semester"], select[name="campus"], select[name="status"], select[name="scholarship_program"]').on('change', function() {
            var academic_year = $('select[name="academic_year"]').val();
            var semester = $('select[name="semester"]').val();
            var campus = $('select[name="campus"]').val();
            var scholarship_program = $('select[name="scholarship_program"]').val();
            var status = $('select[name="status"]').val();

            // Apply column-specific filters and redraw
            table.column(3).search(academic_year) // Academic Year column
                .column(4).search(semester)
                .column(5).search(campus) // Semester column
                .column(6).search(scholarship_program) // Scholarship Program column
                .column(7).search(status) // Status column
                .draw(); // Redraw the table with new filters
        });

        // Reset filters functionality
        $('#resetFilters').on('click', function() {
            $('select[name="academic_year"]').val('');
            $('select[name="semester"]').val('');
            $('select[name="campus"]').val('');
            $('select[name="scholarship_program"]').val('');
            $('select[name="status"]').val('');

            // Clear all search filters and redraw
            table.columns().search('').draw();
        });

        // Print functionality
        $('#printTable').on('click', function() {
            window.print();
        });
    });
</script>
<?php $this->load->view('includes/footer'); ?>
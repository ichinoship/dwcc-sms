<?php $this->load->view('includes/header') ?>
<?php $this->load->view('includes/sidebar') ?>
<title>Reports</title>


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Reports</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('sc/dashboard'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Reports</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title" id="reportTitle">Scholarship Reports</h3>
                        </div>
                        <div class="card-body">
                            <div class="card-tools mb-3">
                                <form id="report-filter-form" method="post" action="<?= base_url('sc/reports'); ?>" class="form-inline">
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
                                            <select name="program_type" class="form-control w-100">
                                                <option value="">Select Program Type</option>
                                                <option value="College" <?= ($this->input->post('program_type') == 'College') ? 'selected' : ''; ?>>College</option>
                                                <option value="Senior High School" <?= ($this->input->post('program_type') == 'Senior High School') ? 'selected' : ''; ?>>Senior High School</option>
                                                <option value="Junior High School" <?= ($this->input->post('program_type') == 'Junior High School') ? 'selected' : ''; ?>>Junior High School</option>
                                                <option value="Grade School" <?= ($this->input->post('program_type') == 'Grade School') ? 'selected' : ''; ?>>Grade School</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row col-12">

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

                                        <div class="col-md-4 mb-2">
                                            <select name="discount" class="form-control w-100">
                                                <option value="">Select Discount</option>
                                                
                                                <option value="5" <?= ($this->input->post('discount') == '5') ? 'selected' : ''; ?>>5%</option>
                                                <option value="10" <?= ($this->input->post('discount') == '10') ? 'selected' : ''; ?>>10%</option>
                                                <option value="15" <?= ($this->input->post('discount') == '15') ? 'selected' : ''; ?>>15%</option>
                                                <option value="20" <?= ($this->input->post('discount') == '20') ? 'selected' : ''; ?>>20%</option>
                                                <option value="25" <?= ($this->input->post('discount') == '25') ? 'selected' : ''; ?>>25%</option>
                                                <option value="50" <?= ($this->input->post('discount') == '50') ? 'selected' : ''; ?>>50%</option>
                                                <option value="60" <?= ($this->input->post('discount') == '60') ? 'selected' : ''; ?>>60%</option>
                                                <option value="75" <?= ($this->input->post('discount') == '75') ? 'selected' : ''; ?>>75%</option>
                                                <option value="80" <?= ($this->input->post('discount') == '80') ? 'selected' : ''; ?>>80%</option>
                                                <option value="100" <?= ($this->input->post('discount') == '100') ? 'selected' : ''; ?>>100%</option>
                                            </select>
                                        </div>
                                        
                                        <div class="col-md-4 mb-2 d-flex align-items-end">
                                            <button type="button" class="btn btn-secondary mr-2 col-md-6" id="resetFilters">Reset Filters</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <table id="applicationsTable" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>ID Number</th>
                                        <th>Name</th>
                                        <th>Academic Year</th>
                                        <th>Semester</th>
                                        <th>Program Type</th>
                                        <th>Scholarship Program</th>
                                        <th>Discount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($applications as $application): ?>
                                        <tr>
                                            <td><?= $application->id_number; ?></td>
                                            <td><?php echo $application->firstname . ' ' . $application->middlename . ' ' . $application->lastname; ?></td>
                                            <td><?= $application->academic_year; ?></td>
                                            <td><?= $application->semester; ?></td>
                                            <td><?= $application->program_type; ?></td>
                                            <td><?= $application->scholarship_program; ?></td>
                                            <td><?= $application->discount; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
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
        var table = $('#applicationsTable').DataTable();

        // Function to update the title based on selected filters
<<<<<<< HEAD
        function updateTitle() {
            // Get the selected values from each filter
            var academic_year = $('select[name="academic_year"]').val();
            var semester = $('select[name="semester"]').val();
            var program_type = $('select[name="program_type"]').val();
            var scholarship_program = $('select[name="scholarship_program"]').val();
=======
    function updateTitle() {
        // Get the selected values from each filter
        var academic_year = $('select[name="academic_year"]').val();
        var semester = $('select[name="semester"]').val();
        var program_type = $('select[name="program_type"]').val();
        var scholarship_program = $('select[name="scholarship_program"]').val();
        var discount = $('select[name="discount"]').val();
>>>>>>> 4ab347db9efa2594bab50e720aab5e0957d62a8f

            // Initialize the base title
            var title = "Scholarship Reports";

<<<<<<< HEAD
            // Construct the dynamic title based on selected filters
            if (academic_year) {
                title += " for " + academic_year;
            }
            if (semester) {
                title += ", " + semester;
            }
            if (scholarship_program) {
                title += " in " + scholarship_program;
            }
            if (program_type) {
                title += " (" + program_type + ")";
            }
=======
        // Construct the dynamic title based on selected filters
        if (academic_year) {
            title += " for " + academic_year;
        }
        if (semester) {
            title += ", " + semester;
        }
        if (scholarship_program) {
            title += " in " + scholarship_program;
        }
        if (program_type) {
            title += " (" + program_type + ")";
        }
        if (discount) {
        title += " with " + discount + "% Discount";
        }

        // Update the card title element
        $('#reportTitle').text(title);
    }
>>>>>>> 4ab347db9efa2594bab50e720aab5e0957d62a8f

            // Update the card title element
            $('#reportTitle').text(title);
        }

        $('select[name="academic_year"], select[name="semester"], select[name="program_type"], select[name="scholarship_program"], select[name="discount"]').on('change', function() {
            var academic_year = $('select[name="academic_year"]').val();
            var semester = $('select[name="semester"]').val();
            var program_type = $('select[name="program_type"]').val();
            var scholarship_program = $('select[name="scholarship_program"]').val();
            var discount = $('select[name="discount"]').val();

            table.columns(2).search(academic_year)
                .columns(3).search(semester)
                .columns(4).search(program_type)
                .columns(5).search(scholarship_program)
                .columns(6).search(discount)
                .draw();
<<<<<<< HEAD
            updateTitle();
=======

                // Use regex for exact match on discount
                if (discount) {
                    table.columns(6).search('^' + discount + '$', true, false).draw();
                } else {
                    table.columns(6).search('').draw();
                }

                updateTitle();
>>>>>>> 4ab347db9efa2594bab50e720aab5e0957d62a8f
        });
        // Reset filters
        $('#resetFilters').on('click', function() {
            $('select[name="academic_year"]').val('');
            $('select[name="semester"]').val('');
            $('select[name="program_type"]').val('');
            $('select[name="scholarship_program"]').val('');
            $('select[name="discount"]').val('');
            table.columns().search('').draw();

            updateTitle();

            table.destroy();
            table = $('#applicationsTable').DataTable();
        });
        $('#printTable').on('click', function() {
            window.print();
        });
    });
</script>

<?php $this->load->view('includes/footer') ?>
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
                            <div class="card-tools">
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
                                            <select name="application_type" class="form-control w-100">
                                                <option value="">Select Application Type</option>
                                                <option value="New Applicant" <?= ($this->input->post('application_type') == 'New Applicant') ? 'selected' : ''; ?>>New Applicant</option>
                                                <option value="Renewal" <?= ($this->input->post('application_type') == 'Renewal') ? 'selected' : ''; ?>>Renewal</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row col-12">
                                        <div class="col-md-4 mb-2">
                                            <select name="status" class="form-control w-100">
                                                <option value="">Select Status</option>
                                                <option value="qualified" <?= ($this->input->post('status') == 'qualified') ? 'selected' : ''; ?>>Qualified</option>
                                                <option value="not qualified" <?= ($this->input->post('status') == 'not qualified') ? 'selected' : ''; ?>>Not Qualified</option>
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
                                            <button type="button" class="btn btn-secondary mr-2" id="resetFilters">Reset Filters</button>
                                            <button type="button" class="btn btn-primary" id="printTable">Print</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>


                        <div class="card-body">
                            <table id="applicationsTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Applicant No</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Scholarship Program</th>
                                        <th>Status</th>
                                        <th>Academic Year</th>
                                        <th>Semester</th>
                                        <th>Application Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($applications as $application): ?>
                                        <tr>
                                            <td><?= $application->applicant_no; ?></td>
                                            <td><?= $application->firstname; ?></td>
                                            <td><?= $application->lastname; ?></td>
                                            <td><?= $application->scholarship_program; ?></td>
                                            <td><?= ucwords($application->status); ?></td>
                                            <td><?= $application->academic_year; ?></td>
                                            <td><?= $application->semester; ?></td>
                                            <td><?= $application->application_type; ?></td>
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

        $('select[name="academic_year"], select[name="semester"], select[name="application_type"], select[name="status"], select[name="scholarship_program"]').on('change', function() {
            var academic_year = $('select[name="academic_year"]').val();
            var semester = $('select[name="semester"]').val();
            var application_type = $('select[name="application_type"]').val();
            var status = $('select[name="status"]').val();
            var scholarship_program = $('select[name="scholarship_program"]').val();

            table.columns(6).search(academic_year)
                .columns(7).search(semester)
                .columns(8).search(application_type)
                .columns(5).search(status)
                .columns(4).search(scholarship_program)
                .draw();
        });

        // Reset filters
        $('#resetFilters').on('click', function() {
            $('select[name="academic_year"]').val('');
            $('select[name="semester"]').val('');
            $('select[name="application_type"]').val('');
            $('select[name="status"]').val('');
            $('select[name="scholarship_program"]').val('');
            table.columns().search('').draw();
            table.destroy();
            table = $('#applicationsTable').DataTable();
        });

        // Print functionality
        $('#printTable').on('click', function() {
            var currentDate = new Date().toLocaleString();
            var printedBy = "<?= $this->session->userdata('user_name'); ?>"; // Adjust as necessary
            var headerImage = "<?= base_url('assets/images/header.png'); ?>"; // Adjust the path to your header image

            var printWindow = window.open('', '', 'height=600,width=800');
            printWindow.document.write('<html><head><title>Print Report</title>');
            printWindow.document.write('<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">');
            printWindow.document.write('<style>');
            printWindow.document.write('body { margin: 0; padding: 0; }'); // Remove default body margins
            printWindow.document.write('img { width: 100%; height: auto; display: block; }'); // Image styles
            printWindow.document.write('</style>');
            printWindow.document.write('</head><body>');

            // Add the header image
            printWindow.document.write('<img src="' + headerImage + '" alt="Header Image">');


            printWindow.document.write('<p class="text-right">Printed by: ' + printedBy + '</p>');
            printWindow.document.write('<p class="text-right">Date: ' + currentDate + '</p>');
            printWindow.document.write($('#applicationsTable').parent().html()); // This will get the HTML of the DataTable
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });

    });
</script>

<?php $this->load->view('includes/footer') ?>
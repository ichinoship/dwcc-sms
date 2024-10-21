<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>
<title>Final List of Applicants</title>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Final List of Applicants</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('sc/dashboard'); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('sc/program_list'); ?>">Program List</a></li>
                        <li class="breadcrumb-item active">Final List of Applicants</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools d-flex justify-content-between align-items-center w-100">
                        <form method="post" class="form-inline" id="filterForm" style="flex: 1;">
                            <div class="row w-100 align-items-center">
                                <div class="col-md-3 mb-2">
                                    <select name="academic_year" class="form-control w-100" id="academicYearFilter">
                                        <option value="">Select Academic Year</option>
                                        <?php foreach ($academic_years as $year): ?>
                                            <option value="<?= $year->academic_year; ?>"><?= $year->academic_year; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <select name="semester" class="form-control w-100" id="semesterFilter">
                                        <option value="">Select Semester</option>
                                        <option value="1st Semester">1st Semester</option>
                                        <option value="2nd Semester">2nd Semester</option>
                                        <option value="Whole Semester">Whole Semester</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <select name="scholarship_program" class="form-control w-100" id="scholarshipProgramFilter">
                                        <option value="">Select Scholarship Program</option>
                                        <?php foreach ($scholarship_programs as $program): ?>
                                            <option value="<?= $program->scholarship_program; ?>"><?= $program->scholarship_program; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-2 d-flex">
                                    <button type="button" class="btn btn-secondary mr-2" id="resetFilters">Reset Filters</button>
                                    <button id="printFinalList" class="btn btn-primary" onclick="printFinalList()">Print</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <table id="finalListTable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Id Number</th>
                                <th>Full Name</th>
                                <th>Program Type</th>
                                <th>Year</th>
                                <th>Campus</th>
                                <th>Academic Year</th>
                                <th>Semester</th>
                                <th>Scholarship Program</th>
                                <th>Discount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($applicants) && !empty($applicants)): ?>
                                <?php foreach ($applicants as $applicant): ?>
                                    <tr>
                                        <td><?= $applicant->id_number; ?></td>
                                        <td><?= htmlspecialchars($applicant->firstname . ' ' . (!empty($applicant->middlename) ? $applicant->middlename . ' ' : '') . $applicant->lastname); ?></td>
                                        <td><?= $applicant->program_type; ?></td>
                                        <td><?= $applicant->year; ?></td>
                                        <td><?= $applicant->campus; ?></td>
                                        <td><?= $applicant->academic_year; ?></td>
                                        <td><?= $applicant->semester; ?></td>
                                        <td><?= $applicant->scholarship_program; ?></td>
                                        <td><?= $applicant->discount; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="9" class="text-center">No applicants found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        var table = $('#finalListTable').DataTable(); // Initialize DataTable

        // Function to apply filters
        function filterTable() {
            var academicYear = $('#academicYearFilter').val();
            var semester = $('#semesterFilter').val();
            var scholarshipProgram = $('#scholarshipProgramFilter').val();

            // Apply the filter to the DataTable
            table
                .columns(5).search(academicYear) // Filter by Academic Year (Column 5)
                .columns(6).search(semester) // Filter by Semester (Column 6)
                .columns(7).search(scholarshipProgram) // Filter by Scholarship Program (Column 7)
                .draw();
        }

        // Apply filters on selection change
        $('#academicYearFilter, #semesterFilter, #scholarshipProgramFilter').change(function() {
            filterTable();
        });

        // Reset filters
        $('#resetFilters').on('click', function() {
            $('#academicYearFilter').val('');
            $('#semesterFilter').val('');
            $('#scholarshipProgramFilter').val('');
            table
                .columns().search('')
                .draw();
        });
    });


    function printFinalList() {
        // Get the header image URL
        var headerImageUrl = '<?= base_url('assets/images/header.png'); ?>';

        // Define the print header
        var printHeader = `
        <div style="text-align: center; margin-bottom: 50px;">
            <img src="${headerImageUrl}" alt="Header Image" style="max-width: 100%; height: auto; width: 100%; max-height: 100px;">
        </div>
    `;

        // Get the contents of the table to print
        var printContents = document.querySelector('#finalListTable').outerHTML;

        // Define the signatories HTML (can be optional or customized as required)
        var signatoriesHTML = `
        <div class="signatories" style="margin-top: 90px; text-align: center; width: 100%;">
            <!-- Prepared by Section on the Left -->
            <div style="text-align: left; width: 50%;">
                <p style="font-weight: bold; margin-bottom: 30px;">Prepared by:</p>
                <p style="font-weight: bold; margin: 0;">DIANA KYTH P. CONTI</p>
                <p style="margin-bottom: 30px;">Scholarship Coordinator</p>
            </div>

            <!-- Scholarship Committee -->
            <div style="margin-bottom: 40px; text-align: center;">
                <p style="text-align: left;">Evaluated and Recommended by:</p>
                <p style="font-weight: bold; margin-bottom:30px">SCHOLARSHIP COMMITTEE</p>

                <!-- Committee Members -->
                <div style="display: flex; justify-content: center; flex-wrap: wrap; margin-bottom: 30px;">
                    <div style="margin: 20px; text-align: center;">
                        <p style="font-weight: bold; margin: 0;">MS. CLAUDETTE SIM, MBA</p>
                        <p style="margin: 0;"><i>Member</i></p>
                    </div>
                    <div style="margin: 20px; text-align: center;">
                        <p style="font-weight: bold; margin: 0;">MS. GRACE D. LUZON, MSEco</p>
                        <p style="margin: 0;"><i>Member</i></p>
                    </div>
                    <div style="margin: 20px; text-align: center;">
                        <p style="font-weight: bold; margin: 0;">DR. MARY JANE D. CASTILLO, LPT</p>
                        <p style="margin: 0;"><i>Member</i></p>
                    </div>
                    <div style="margin: 20px; text-align: center;">
                        <p style="font-weight: bold; margin: 0;">REV. FR. JEROME A. ORMITA, SVD</p>
                        <p style="margin: 0;"><i>Member</i></p>
                    </div>
                </div>

                <!-- Vice Chairperson and Chairperson -->
                <div style="text-align: center; margin-bottom: 30px;">
                    <p style="font-weight: bold; margin: 0;">REV. FR. VICENTE D. CASTRO JR, SVD</p>
                    <p style="margin: 0; padding-top: 5px;"> <i>Vice Chairperson</i></p>
                </div>
                <div style="text-align: center;">
                    <p style="font-weight: bold; margin: 0;">BR. HUBERTUS GURU, SVD, Ed.D.</p>
                    <p style="margin: 0; padding-top: 5px;"> <i>Scholarship Chairperson</i></p>
                </div>
            </div>

            <!-- Approved by -->
            <div>
                <p style="text-align:left;">Approved by:</p>
                <p style="font-weight: bold; margin: 0;">REV. FR. RENATO A. TAMPOL, SVD, PhD</p>
                <p style="margin: 0;"><i>President</i></p>
            </div>
        </div>
    `;

        // Combine the header, the table, and the signatories
        var finalPrintContent = printHeader + printContents + signatoriesHTML;

        // Open a new window for printing
        var printWindow = window.open('', '', 'height=600,width=800');
        printWindow.document.write('<html><head>');
        printWindow.document.write('<style>body {font-family: Arial, sans-serif; margin: 0; padding: 20px;} table {border-collapse: collapse; width: 100%;} th, td {border: 1px solid black; padding: 8px; text-align: center;} th {background-color: #f2f2f2;}</style>');
        printWindow.document.write('</head><body>');
        printWindow.document.write(finalPrintContent);
        printWindow.document.write('</body></html>');

        // Automatically trigger the print dialog
        printWindow.document.close();
        printWindow.print();
    }
</script>

<?php $this->load->view('includes/footer'); ?>
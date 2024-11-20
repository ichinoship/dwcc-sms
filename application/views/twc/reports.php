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
                                            <select name="year" class="form-control w-100">
                                                <option value="">Select Year</option>
                                                <option value="5th" <?= ($this->input->post('year') == '5th') ? 'selected' : ''; ?>>5th</option>
                                                <option value="4th" <?= ($this->input->post('year') == '4th') ? 'selected' : ''; ?>>4th</option>
                                                <option value="3rd" <?= ($this->input->post('year') == '3rd') ? 'selected' : ''; ?>>3rd</option>
                                                <option value="2nd" <?= ($this->input->post('year') == '2nd') ? 'selected' : ''; ?>>2nd</option>
                                                <option value="1st" <?= ($this->input->post('year') == '1st') ? 'selected' : ''; ?>>1st</option>
                                                <option value="Grade 12" <?= ($this->input->post('year') == 'Grade 12') ? 'selected' : ''; ?>>Grade 12</option>
                                                <option value="Grade 11" <?= ($this->input->post('year') == 'Grade 11') ? 'selected' : ''; ?>>Grade 11</option>
                                                <option value="Grade 10" <?= ($this->input->post('year') == 'Grade 10') ? 'selected' : ''; ?>>Grade 10</option>
                                                <option value="Grade 9" <?= ($this->input->post('year') == 'Grade 9') ? 'selected' : ''; ?>>Grade 9</option>
                                                <option value="Grade 8" <?= ($this->input->post('year') == 'Grade 8') ? 'selected' : ''; ?>>Grade 8</option>
                                                <option value="Grade 7" <?= ($this->input->post('year') == 'Grade 7') ? 'selected' : ''; ?>>Grade 7</option>
                                                <option value="Grade 6" <?= ($this->input->post('year') == 'Grade 6') ? 'selected' : ''; ?>>Grade 6</option>
                                                <option value="Grade 5" <?= ($this->input->post('year') == 'Grade 5') ? 'selected' : ''; ?>>Grade 5</option>
                                                <option value="Grade 4" <?= ($this->input->post('year') == 'Grade 4') ? 'selected' : ''; ?>>Grade 4</option>
                                                <option value="Grade 3" <?= ($this->input->post('year') == 'Grade 3') ? 'selected' : ''; ?>>Grade 3</option>
                                                <option value="Grade 2" <?= ($this->input->post('year') == 'Grade 2') ? 'selected' : ''; ?>>Grade 2</option>
                                                <option value="Grade 1" <?= ($this->input->post('year') == 'Grade 1') ? 'selected' : ''; ?>>Grade 1</option>
                                                <option value="Senior Kinder" <?= ($this->input->post('year') == 'Senior Kinder') ? 'selected' : ''; ?>>Senior Kinder</option>
                                                <option value="Junior Kinder" <?= ($this->input->post('year') == 'Junior Kinder') ? 'selected' : ''; ?>>Junior Kinder</option>
                                                <option value="Special Education" <?= ($this->input->post('year') == 'Special Education') ? 'selected' : ''; ?>>Special Education</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <select name="program" class="form-control w-100">
                                                <option value="">Select Program</option>
                                                <option value="Bachelor of Science in Business Administration" <?= ($this->input->post('program') == 'Bachelor of Science in Business Administration') ? 'selected' : ''; ?>>Bachelor of Science in Business Administration</option>
                                                <option value="Bachelor of Science in Hospitality Management" <?= ($this->input->post('program') == 'Bachelor of Science in Hospitality Management') ? 'selected' : ''; ?>>Bachelor of Science in Hospitality Management</option>
                                                <option value="Bachelor of Science in Tourism Management" <?= ($this->input->post('program') == 'Bachelor of Science in Tourism Management') ? 'selected' : ''; ?>>Bachelor of Science in Tourism Management</option>
                                                <option value="Bachelor of Science in Accountancy" <?= ($this->input->post('program') == 'Bachelor of Science in Accountancy') ? 'selected' : ''; ?>>Bachelor of Science in Accountancy</option>
                                                <option value="Bachelor of Science in Management Accounting" <?= ($this->input->post('program') == 'Bachelor of Science in Management Accounting') ? 'selected' : ''; ?>>Bachelor of Science in Management Accounting</option>
                                                <option value="Bachelor of Science in Criminology" <?= ($this->input->post('program') == 'Bachelor of Science in Criminology') ? 'selected' : ''; ?>>Bachelor of Science in Criminology</option>
                                                <option value="Bachelor of Science in Civil Engineering" <?= ($this->input->post('program') == 'Bachelor of Science in Civil Engineering') ? 'selected' : ''; ?>>Bachelor of Science in Civil Engineering</option>
                                                <option value="Bachelor of Science in Computer Engineering" <?= ($this->input->post('program') == 'Bachelor of Science in Computer Engineering') ? 'selected' : ''; ?>>Bachelor of Science in Computer Engineering</option>
                                                <option value="Bachelor of Science in Electronics Engineering" <?= ($this->input->post('program') == 'Bachelor of Science in Electronics Engineering') ? 'selected' : ''; ?>>Bachelor of Science in Electronics Engineering</option>
                                                <option value="Bachelor of Science in Electrical Engineering" <?= ($this->input->post('program') == 'Bachelor of Science in Electrical Engineering') ? 'selected' : ''; ?>>Bachelor of Science in Electrical Engineering</option>
                                                <option value="Bachelor of Science in Architecture" <?= ($this->input->post('program') == 'Bachelor of Science in Architecture') ? 'selected' : ''; ?>>Bachelor of Science in Architecture</option>
                                                <option value="Bachelor of Science in Fine Arts" <?= ($this->input->post('program') == 'Bachelor of Science in Fine Arts') ? 'selected' : ''; ?>>Bachelor of Science in Fine Arts</option>
                                                <option value="Bachelor of Elementary Education" <?= ($this->input->post('program') == 'Bachelor of Elementary Education') ? 'selected' : ''; ?>>Bachelor of Elementary Education</option>
                                                <option value="Bachelor of Secondary Education" <?= ($this->input->post('program') == 'Bachelor of Secondary Education') ? 'selected' : ''; ?>>Bachelor of Secondary Education</option>
                                                <option value="Bachelor of Physical Education" <?= ($this->input->post('program') == 'Bachelor of Physical Education') ? 'selected' : ''; ?>>Bachelor of Physical Education</option>
                                                <option value="Bachelor of Science in Information Technology" <?= ($this->input->post('program') == 'Bachelor of Science in Information Technology') ? 'selected' : ''; ?>>Bachelor of Science in Information Technology</option>
                                                <option value="Bachelor of Science in Psychology" <?= ($this->input->post('program') == 'Bachelor of Science in Psychology') ? 'selected' : ''; ?>>Bachelor of Science in Psychology</option>
                                                <option value="Bachelor of Arts in Political Science" <?= ($this->input->post('program') == 'Bachelor of Arts in Political Science') ? 'selected' : ''; ?>>Bachelor of Arts in Political Science</option>
                                                <option value="Bachelor of Arts in Psychology" <?= ($this->input->post('program') == 'Bachelor of Arts in Psychology') ? 'selected' : ''; ?>>Bachelor of Arts in Psychology</option>
                                                <option value="Science, Technology, Engineering and Mathematics (STEM)" <?= ($this->input->post('program') == 'Science, Technology, Engineering and Mathematics (STEM)') ? 'selected' : ''; ?>>Science, Technology, Engineering and Mathematics (STEM)</option>
                                                <option value="Accountancy, Business and Management (ABM)" <?= ($this->input->post('program') == 'Accountancy, Business and Management (ABM)') ? 'selected' : ''; ?>>Accountancy, Business and Management (ABM)</option>
                                                <option value="Humanities and Social Sciences (HUMMS)" <?= ($this->input->post('program') == 'Humanities and Social Sciences (HUMMS)') ? 'selected' : ''; ?>>Humanities and Social Sciences (HUMMS)</option>
                                                <option value="Technical Vocational Livelihood (TVL)" <?= ($this->input->post('program') == 'Technical Vocational Livelihood (TVL)') ? 'selected' : ''; ?>>Technical Vocational Livelihood (TVL)</option>
                                                <option value="Special Science Class" <?= ($this->input->post('program') == 'Special Science Class') ? 'selected' : ''; ?>>Special Science Class</option>
                                                <option value="None" <?= ($this->input->post('program') == 'None') ? 'selected' : ''; ?>>None</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <select name="campus" class="form-control w-100">
                                                <option value="">Select Campus</option>
                                                <option value="Janssen" <?= ($this->input->post('campus') == 'Janssen') ? 'selected' : ''; ?>>Janssen</option>
                                                <option value="Freinademetz" <?= ($this->input->post('campus') == 'Freinademetz') ? 'selected' : ''; ?>>Freinademetz</option>
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
                                        <div class="col-md-4 mb-2">
                                            <select name="status" class="form-control w-100">
                                                <option value="">Select Status</option>
                                                <option value="qualified" <?= ($this->input->post('status') == 'qualified') ? 'selected' : ''; ?>>Qualified</option>
                                                <option value="conditional" <?= ($this->input->post('status') == 'conditional') ? 'selected' : ''; ?>>Conditional</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-2 d-flex align-items-end">
                                            <button type="button" class="btn btn-secondary mr-2 col-md-6" id="resetFilters">Reset Filters</button>
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
                                        <th>Program Type</th>
                                        <th>Year</th>
                                        <th>Program</th>
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
                                                <td><?= $applicant->program_type; ?></td>
                                                <td><?= $applicant->year; ?></td>
                                                <td><?= $applicant->program; ?></td>
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

        // Initialize DataTable with buttons
        var table = $('#applicantsTable').DataTable({
            "processing": true,
            "serverSide": false,
            "paging": false,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            buttons: [{
                    extend: "copy",
                    text: "Copy",
                },
                {
                    extend: "pdf",
                    text: "Export to PDF",
                    title: '',
                    filename: function() {
                        return "TWC - Scholarship Reports";
                    },
                    customize: function(doc) {

                        var scholarshipProgram = $('select[name="scholarship_program"]').val();
                        var programName = scholarshipProgram ? scholarshipProgram : "";

                        doc.pageMargins = [50, 115, 50, 115];
                        doc.background = [{
                            image: 'data:image/png;base64,<?= base64_encode(file_get_contents(base_url("assets/images/format.png"))); ?>',
                            width: 624,
                            height: 830
                        }];

                        // Add title and details
                        doc.content.splice(0, 0, {
                            text: `SCHOLARSHIP REPORTS\n${programName}`,
                            alignment: 'center',
                            fontSize: 12,
                            bold: true,
                            margin: [0, 20, 0, 10]
                        });

                        doc.content.splice(1, 0, {
                            text: 'List of Scholarship Applicants',
                            alignment: 'center',
                            fontSize: 12,
                            bold: false,
                            margin: [0, 0, 0, 20]
                        });

                        var currentDate = new Date().toLocaleDateString();
                        doc.content.splice(2, 0, {
                            text: `Date: ${currentDate}`,
                            alignment: 'right',
                            fontSize: 10,
                            margin: [0, 0, 0, 10]
                        });

                        var table = doc.content[3];
                        if (table && table.table) {
                            table.layout = {
                                hLineWidth: function() {
                                    return 0.5;
                                },
                                vLineWidth: function() {
                                    return 0.5;
                                },
                                hLineColor: function() {
                                    return '#000';
                                },
                                vLineColor: function() {
                                    return '#000';
                                },
                                paddingLeft: function() {
                                    return 2;
                                },
                                paddingRight: function() {
                                    return 2;
                                },
                                paddingTop: function() {
                                    return 2;
                                },
                                paddingBottom: function() {
                                    return 2;
                                },
                            };

                            var header = table.table.body[0];
                            for (var j = 0; j < header.length; j++) {
                                header[j].fillColor = '#A6D18A';
                                header[j].color = '#000000';
                            }
                        }

                        doc.content.push({
                            text: 'Prepared by:',
                            alignment: 'left',
                            margin: [0, 30, 0, 20],
                            fontSize: 12,
                            bold: false
                        });
                        doc.content.push({
                            text: '<?= $this->session->userdata("user_name") ?>\n',
                            alignment: 'left',
                            margin: [0, 0, 0, 0],
                            fontSize: 12,
                            bold: true
                        });
                        doc.content.push({
                            text: 'Technical Working Committee',
                            alignment: 'left',
                            margin: [0, 0, 0, 20],
                            fontSize: 12,
                            bold: false
                        });
                    }
                },
                {
                    extend: "colvis",
                    text: "Column Visibility",
                }
            ],
            "initComplete": function() {
                this.api().buttons().container().appendTo('#applicantsTable_wrapper .col-md-6:eq(0)');
            }
        });

        // Apply filters on change
        $('select[name="academic_year"], select[name="semester"], select[name="program_type"], select[name="year"], select[name="program"], select[name="campus"], select[name="status"], select[name="scholarship_program"]').on('change', function() {
            var academic_year = $('select[name="academic_year"]').val();
            var semester = $('select[name="semester"]').val();
            var program_type = $('select[name="program_type"]').val();
            var year = $('select[name="year"]').val();
            var program = $('select[name="program"]').val();
            var campus = $('select[name="campus"]').val();
            var scholarship_program = $('select[name="scholarship_program"]').val();
            var status = $('select[name="status"]').val();

            table.column(3).search(academic_year)
                .column(4).search(semester)
                .column(5).search(program_type)
                .column(6).search(year)
                .column(7).search(program)
                .column(8).search(campus)
                .column(9).search(scholarship_program)
                .column(10).search(status)
                .draw();
        });

        // Reset filters functionality
        $('#resetFilters').on('click', function() {
            $('select[name="academic_year"]').val('');
            $('select[name="semester"]').val('');
            $('select[name="program_type"]').val('');
            $('select[name="year"]').val('');
            $('select[name="program"]').val('');
            $('select[name="campus"]').val('');
            $('select[name="scholarship_program"]').val('');
            $('select[name="status"]').val('');

            // Clear all search filters and redraw
            table.columns().search('').draw();
        });

        // Print functionality
        $('#printTable').on('click', function() {
            table.button('.buttons-pdf').trigger();
        });
    });
</script>
<?php $this->load->view('includes/footer'); ?>
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
                                            <select name="program" class="form-control w-100" id="program">
                                                <option value="">Select Program</option>
                                                <?php foreach ($programs_track as $program_strand): ?>
                                                    <option value="<?= $program_strand->program ?>" <?= set_select('program', $program_strand->program); ?>>
                                                        <?= $program_strand->program ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <select name="application_type" class="form-control w-100">
                                                <option value="">Select Application Type</option>
                                                <option value="New Applicant" <?= ($this->input->post('application_type') == 'New Applicant') ? 'selected' : ''; ?>>New Applicant</option>
                                                <option value="Renewal" <?= ($this->input->post('application_type') == 'Renewal') ? 'selected' : ''; ?>>Renewal</option>
                                               
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <select name="status" class="form-control w-100">
                                                <option value="">Select Status</option>
                                                <option value="qualified" <?= ($this->input->post('status') == 'qualified') ? 'selected' : ''; ?>>Qualified</option>
                                                <option value="not qualified" <?= ($this->input->post('status') == 'not qualified') ? 'selected' : ''; ?>>Not Qualified</option>
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
                                        <th>Application Type</th>
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
                                                <td><?= $applicant->application_type; ?></td>
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
        $('select[name="academic_year"], select[name="semester"], select[name="program_type"], select[name="year"], select[name="campus"], select[name="status"], select[name="scholarship_program"], select[name="program"], select[name="application_type"]').on('change', function() {
            var academic_year = $('select[name="academic_year"]').val();
            var semester = $('select[name="semester"]').val();
            var program_type = $('select[name="program_type"]').val();
            var year = $('select[name="year"]').val();
            var campus = $('select[name="campus"]').val();
            var scholarship_program = $('select[name="scholarship_program"]').val();
            var status = $('select[name="status"]').val();
            var program = $('select[name="program"]').val();
            var application_type = $('select[name="application_type"]').val();

            table.column(3).search(academic_year)
                .column(4).search(semester)
                .column(5).search(program_type)
                .column(6).search(year)
                .column(7).search(program)
                .column(8).search(campus)
                .column(9).search(scholarship_program)
                .column(10).search(application_type)
                .columns(11).search("^" + status + "$", true, false)
                .draw();
        });

        // Reset filters functionality
        $('#resetFilters').on('click', function() {
            $('select[name="academic_year"]').val('');
            $('select[name="semester"]').val('');
            $('select[name="program_type"]').val('');
            $('select[name="year"]').val('');
            $('select[name="campus"]').val('');
            $('select[name="scholarship_program"]').val('');
            $('select[name="status"]').val('');
            $('select[name="program"]').val('');
            $('select[name="application_type"]').val('');
            
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
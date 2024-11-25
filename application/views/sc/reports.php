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
                                            <select name="program_type" class="form-control w-100" id="program_type">
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
                                            <select name="year" id="year" class="form-control w-100">
                                                <option value="">Select Year</option>
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
                            <table id="applicationsTable" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>ID Number</th>
                                        <th>Name</th>
                                        <th>Academic Year</th>
                                        <th>Semester</th>
                                        <th>Program Type</th>
                                        <th>Year</th>
                                        <th>Scholarship Program</th>
                                        <th>Program</th>
                                        <th>Application Type</th>
                                        <th>Discount</th>
                                        <th>Status</th>
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
                                            <td><?= $application->year; ?></td>
                                            <td><?= $application->scholarship_program; ?></td>
                                            <td><?= $application->program; ?></td>
                                            <td><?= $application->application_type; ?></td>
                                            <td><?= $application->discount; ?></td>
                                            <td><?= ucwords($application->status); ?></td>
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
        var table = $('#applicationsTable').DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": [{
                    extend: "copy",
                    text: "Copy",
                },
                {
                    extend: "pdf",
                    text: "Export to PDF",
                    title: '',
                    filename: function() {
                        return "Scholarship-Reports";
                    },
                    customize: function(doc) {

                        var exportData = $('#applicationsTable').DataTable().buttons.exportData({
                            columns: ':visible'
                        });

                        doc.pageMargins = [20, 115, 20, 115];

                        doc.background = [{
                            image: 'data:image/png;base64,<?= base64_encode(file_get_contents(base_url("assets/images/format.png"))); ?>',
                            width: 624,
                            height: 830
                        }];
                        doc.content.splice(0, 0, {
                            text: 'SCHOLARSHIP REPORTS',
                            alignment: 'center',
                            fontSize: 12,
                            bold: true,
                            margin: [0, 20, 0, 0]
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
                        var tableBody = [];
                        tableBody.push(exportData.header.map(header => ({
                            text: header,
                            bold: true,
                            fillColor: '#A6D18A',
                            color: '#000000',
                            alignment: 'center'
                        })));
                        exportData.body.forEach(row => {
                            tableBody.push(row.map(cell => ({
                                text: cell,
                                fillColor: '#FFFFFF',
                                fontSize: 11,
                                alignment: 'center'
                            })));
                        });
                        doc.content[3] = {
                            table: {
                                headerRows: 1,
                                body: tableBody,
                                
                            },
                            layout: {
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
                            },
                            alignment: 'center' 
                        };
                        doc.content.push({
                            text: 'Prepared by:',
                            alignment: 'left',
                            margin: [0, 30, 0, 20],
                            fontSize: 12,
                            bold: false
                        });
                        doc.content.push({
                            text: 'DIANA KYTH P. CONTI\n',
                            alignment: 'left',
                            margin: [0, 0, 0, 0],
                            fontSize: 12,
                            bold: true
                        });
                        doc.content.push({
                            text: 'Scholarship Coordinator',
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
                this.api().buttons().container().appendTo('#applicationsTable_wrapper .col-md-6:eq(0)');
            }
        });

        $('select[name="academic_year"], select[name="semester"], select[name="program_type"], select[name="year"], select[name="scholarship_program"], select[name="program"], select[name="application_type"], select[name="discount"],  select[name="status"]').on('change', function() {
            var academic_year = $('select[name="academic_year"]').val();
            var semester = $('select[name="semester"]').val();
            var program_type = $('select[name="program_type"]').val();
            var year = $('select[name="year"]').val();
            var scholarship_program = $('select[name="scholarship_program"]').val();
            var program = $('select[name="program"]').val();
            var application_type = $('select[name="application_type"]').val();
            var discount = $('select[name="discount"]').val();
            var status = $('select[name="status"]').val();

            //console.log("Status:", status);

            table.columns(2).search(academic_year)
                .columns(3).search(semester)
                .columns(4).search(program_type)
                .columns(5).search(year)
                .columns(6).search(scholarship_program)
                .columns(7).search(program)
                .columns(8).search(application_type)
                .columns(9).search(discount)
                .columns(10).search("^" + status + "$", true, false)
                .draw();
        });

        $('#resetFilters').on('click', function() {
            $('select[name="academic_year"]').val('');
            $('select[name="semester"]').val('');
            $('select[name="program_type"]').val('');
            $('select[name="year"]').val('');
            $('select[name="scholarship_program"]').val('');
            $('select[name="program"]').val('');
            $('select[name="application_type"]').val('');
            $('select[name="discount"]').val('');
            $('select[name="status"]').val('');
            table.columns().search('').draw();
        });

        $('#printTable').on('click', function() {
            table.button('.buttons-pdf').trigger();
        });
    });

    $('#program_type').on('change', function() {
        var program_type = $(this).val();
        $.ajax({
            url: "<?= base_url('sc/get_programs_by_type'); ?>",
            type: "POST",
            data: {
                program_type: program_type
            },
            dataType: "json",
            success: function(data) {
                var programDropdown = $('#program');
                programDropdown.empty();
                programDropdown.append('<option value="">Select Program</option>');
                if (data.length > 0) {
                    $.each(data, function(index, program) {
                        programDropdown.append('<option value="' + program.program + '">' + program.program + '</option>');
                    });
                }
            }
        });
    });
    $('#program_type').on('change', function() {
        var program_type = $(this).val();
        var yearDropdown = $('#year');
        yearDropdown.empty();

        yearDropdown.append('<option value="">Select Year</option>');

        var years = [];
        if (program_type === 'College') {
            years = ['5th', '4th', '3rd', '2nd', '1st'];
        } else if (program_type === 'Senior High School') {
            years = ['Grade 12', 'Grade 11'];
        } else if (program_type === 'Junior High School') {
            years = ['Grade 10', 'Grade 9', 'Grade 8', 'Grade 7'];
        } else if (program_type === 'Grade School') {
            years = ['Grade 6', 'Grade 5', 'Grade 4', 'Grade 3', 'Grade 2', 'Grade 1', 'Senior Kinder', 'Junior Kinder', 'Special Education'];
        }

        $.each(years, function(index, year) {
            yearDropdown.append('<option value="' + year + '">' + year + '</option>');
        });
    });
</script>

<?php $this->load->view('includes/footer') ?>
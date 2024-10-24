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
                            <h3 class="card-title">Scholarship Reports</h3>
                        </div>
                        <div class="card-body">
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
                                            <button type="button" class="btn btn-secondary mr-2 col-md-6" id="resetFilters">Reset Filters</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <table id="applicationsTable" class="table table-bordered table-hover table-striped">
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

        <!-- Scholarship Grants -->
        <div class="row report-section scholarship-program-report">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Scholarship Grants</h3>
                    </div>
                    <div class="card-body">
                        <div class="card-tools">
                            <div class="mb-3">
                                <strong>Total Programs:</strong> <?= $total_programs ?>
                            </div>
                        </div>
                        <table id="grant" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Program Name</th>
                                    <th>Percentage</th>
                                    <th>No. of Grantees</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($scholarship_programs as $program): ?>
                                    <tr>
                                        <td><?= $program->program_code ?></td>
                                        <td><?= $program->scholarship_program ?></td>
                                        <td><?= $program->percentage ?></td>
                                        <td><?= $program->number_of_grantees ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
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
        $('#printTable').on('click', function() {
            window.print();
        });
    });

    <?php
    $years = array_column($scholarship_programs, 'academic_year');
    $semesters = array_column($scholarship_programs, 'semester');

    $most_common_year = array_count_values($years);
    $most_common_year = array_search(max($most_common_year), $most_common_year);

    $most_common_semester = array_count_values($semesters);
    $most_common_semester = array_search(max($most_common_semester), $most_common_semester);
    ?>

$(function() {
    var table = $("#grant").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": [{
                extend: "copy",
                text: "Copy",
            },
            {
                extend: "pdf",
                text: "PDF",
                title: '',
                customize: function(doc) {
                    // Page margins for PDF
                    doc.pageMargins = [30, 115, 30, 115]; 

                    // Set background image
                    doc.background = [{
                        image: 'data:image/png;base64,<?= base64_encode(file_get_contents(base_url("assets/images/format.png"))); ?>',
                        width: 624,
                        height: 830
                    }];

                    // Title
                    doc.content.splice(0, 0, {
                        text: 'SCHOLARSHIP GRANTS',
                        alignment: 'center',
                        fontSize: 12,
                        bold: true,
                        margin: [0, 20, 0, 0]
                    });

                    // Subtitle
                    doc.content.splice(1, 0, {
                        text: 'ACADEMIC YEAR <?= $most_common_year ?> | <?= strtoupper($most_common_semester) ?>',
                        alignment: 'center',
                        fontSize: 12,
                        bold: true,
                        margin: [0, 0, 0, 20]
                    });

                    var table = doc.content[2];
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

                        for (var i = 0; i < table.table.body.length; i++) {
                            for (var j = 0; j < table.table.body[i].length; j++) {
                                table.table.body[i][j].fillColor = '#FFFFFF'; 
                                table.table.body[i][j].fontSize = 10;  
                            }
                        }

                        // Set header row styling
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
                        text: 'DIANA KYTH P. CONTI\n',
                        alignment: 'left',
                        margin: [0, 0, 0, 0],
                        fontSize: 12,
                        bold: true
                    });
                    doc.content.push({
                        text: 'Scholarship Coordinator',
                        alignment: 'left',
                        margin: [0, 0, 0, 50],
                        fontSize: 12,
                        bold: false 
                    });

                    doc.content.push({
                        text: 'Evaluated and Recommended by:',
                        alignment: 'left',
                        margin: [0, 30, 0, 20],
                        fontSize: 12,
                        bold: false
                    });
                    doc.content.push({
                        text: 'REV. FR. VICENTE D. CASTRO JR, SVD\n',
                        alignment: 'center',
                        margin: [0, 0, 0, 0],
                        fontSize: 12,
                        bold: true
                    });
                    doc.content.push({
                        text: 'Vice Chairperson',
                        alignment: 'center',
                        margin: [0, 0, 0, 10],
                        fontSize: 12,
                        bold: false 
                    });
                    doc.content.push({
                        text: 'BR. HUBERTUS GURU, SVD, Ed.D\n',
                        alignment: 'center',
                        margin: [0, 30, 0, 0],
                        fontSize: 12,
                        bold: true
                    });
                    doc.content.push({
                        text: 'Scholarship Chairperson',
                        alignment: 'center',
                        margin: [0, 0, 0, 10],
                        fontSize: 12,
                        bold: false 
                    });

                    doc.content.push({
                        text: 'Approved by:',
                        alignment: 'left',
                        margin: [0, 30, 0, 20],
                        fontSize: 12,
                        bold: false
                    });
                    doc.content.push({
                        text: 'REV. FR. RENATO A. TAMPOL, SVD, PhD\n',
                        alignment: 'center',
                        margin: [0, 0, 0, 0],
                        fontSize: 12,
                        bold: true
                    });
                    doc.content.push({
                        text: 'President',
                        alignment: 'center',
                        margin: [0, 0, 0, 0],
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
        initComplete: function() {
            this.api().columns(4).every(function() {
                var column = this;
                $('#userTypeFilter').on('change', function() {
                    var val = $.fn.dataTable.util.escapeRegex(
                        $(this).val()
                    );
                    column
                        .search(val ? '^' + val + '$' : '', true, false)
                        .draw();
                });
            });
        }
    }).buttons().container().appendTo('#grant_wrapper .col-md-6:eq(0)');
});


</script>

<?php $this->load->view('includes/footer') ?>
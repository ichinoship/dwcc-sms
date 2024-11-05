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
                        <table id="scholarship_grant" class="table table-bordered table-hover table-striped">
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
        
        // Function to update the title based on selected filters
    function updateTitle() {
        // Get the selected values from each filter
        var academic_year = $('select[name="academic_year"]').val();
        var semester = $('select[name="semester"]').val();
        var program_type = $('select[name="program_type"]').val();
        var scholarship_program = $('select[name="scholarship_program"]').val();
        var discount = $('select[name="discount"]').val();

        // Initialize the base title
        var title = "Scholarship Reports";

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

                // Use regex for exact match on discount
                if (discount) {
                    table.columns(6).search('^' + discount + '$', true, false).draw();
                } else {
                    table.columns(6).search('').draw();
                }

                updateTitle();
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

    <?php
    $years = array_column($scholarship_programs, 'academic_year');
    $semesters = array_column($scholarship_programs, 'semester');

    $most_common_year = array_count_values($years);
    $most_common_year = array_search(max($most_common_year), $most_common_year);

    $most_common_semester = array_count_values($semesters);
    $most_common_semester = array_search(max($most_common_semester), $most_common_semester);
    ?>

    $(function() {
        var table = $("#scholarship_grant").DataTable({
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
                    customize: function(doc) {
                        // Page margins for PDF
                        doc.pageMargins = [50, 115, 50, 115];

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
        }).buttons().container().appendTo('#scholarship_grant_wrapper .col-md-6:eq(0)');
    });
</script>

<?php $this->load->view('includes/footer') ?>
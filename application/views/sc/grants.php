<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>
<title>Scholarship Grants</title>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Scholarship Grants Report</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('sc/dashboard'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Scholarship Grants</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row report-section scholarship-program-report">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Scholarship Grants</h3>
                        </div>
                        <div class="card-body">
                            <div class="card-tools mb-3">
                                <form id="grants-filter-form" method="post" action="">
                                    <div class="form-row">
                                        <div class="col-md-3">
                                            <select name="academic_year" id="academic_year" class="form-control" onchange="document.getElementById('grants-filter-form').submit();">
                                                <option value="">Select School Year</option>
                                                <?php foreach ($academic_years as $year): ?>
                                                    <option value="<?= $year->academic_year; ?>" <?= ($selected_academic_year == $year->academic_year) ? 'selected' : ''; ?>>
                                                        <?= $year->academic_year; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <select name="semester" id="semester" class="form-control" onchange="document.getElementById('grants-filter-form').submit();">
                                                <option value="">Select Semester</option>
                                                <option value="1st Semester" <?= ($selected_semester == '1st Semester') ? 'selected' : ''; ?>>1st Semester</option>
                                                <option value="2nd Semester" <?= ($selected_semester == '2nd Semester') ? 'selected' : ''; ?>>2nd Semester</option>
                                                <option value="Whole Semester" <?= ($selected_semester == 'Whole Semester') ? 'selected' : ''; ?>>Whole Semester</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="button" class="btn btn-secondary col-md-6" onclick="resetFilters();">Reset Filters</button>
                                        </div>
                                    </div>
                                </form>
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
                                            <td><?= $program->program_code; ?></td>
                                            <td><?= $program->scholarship_program; ?></td>
                                            <td><?= $program->percentage; ?></td>
                                            <td>
                                                <?php
                                                $grantee_count = 0;
                                                foreach ($grantee_counts as $count) {
                                                    if ($count->scholarship_program === $program->scholarship_program) {
                                                        $grantee_count = $count->grantee_count;
                                                        break;
                                                    }
                                                }
                                                echo $grantee_count;
                                                ?>
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
    </section>
</div>
<?php $this->load->view('includes/footer') ?>
<script>
    function resetFilters() {
        document.getElementById('academic_year').selectedIndex = 0;
        document.getElementById('semester').selectedIndex = 0;
        document.getElementById('grants-filter-form').submit();
    }

    $(function() {
        var selectedAcademicYear = "<?= $selected_academic_year; ?>";
        var selectedSemester = "<?= $selected_semester; ?>";

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

                        
                        doc.content.splice(1, 0, {
                            text: `ACADEMIC YEAR ${selectedAcademicYear.toUpperCase()} | ${selectedSemester.toUpperCase()}`,
                            alignment: 'center',
                            fontSize: 10,
                            bold: true,
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
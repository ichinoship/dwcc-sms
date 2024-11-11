<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>
<title>Official List of Applicants</title>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Official List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('sc/dashboard'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Official List of Applicants</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Official List of Applicants</h3>
                </div>
                <div class="card-body">
                    <div class="card-tools mb-3">
                        <form action="<?= base_url('sc/final_list'); ?>" method="GET" class="d-flex">
                            <div class="row align-items-end">
                                <div class="form-group col-md-2">
                                    <select name="academic_year" id="academic_year" class="form-control">
                                        <option value="">Select Academic Year</option>
                                        <?php foreach ($academic_years as $year): ?>
                                            <option value="<?= htmlspecialchars($year->academic_year); ?>" <?= set_value('academic_year') == $year->academic_year ? 'selected' : ''; ?>>
                                                <?= htmlspecialchars($year->academic_year); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <select name="semester" id="semester" class="form-control">
                                        <option value="">Select Semester</option>
                                        <option value="1st Semester" <?= ($this->input->post('semester') == '1st Semester') ? 'selected' : ''; ?>>1st Semester</option>
                                        <option value="2nd Semester" <?= ($this->input->post('semester') == '2nd Semester') ? 'selected' : ''; ?>>2nd Semester</option>
                                        <option value="Whole Semester" <?= ($this->input->post('semester') == 'Whole Semester') ? 'selected' : ''; ?>>Whole Semester</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <select name="campus" id="campus" class="form-control w-100">
                                        <option value="">Select Campus</option>
                                        <option value="Janssen" <?= ($this->input->post('campus') == 'Janssen') ? 'selected' : ''; ?>>Janssen</option>
                                        <option value="Freinademetz" <?= ($this->input->post('campus') == 'Freinademetz') ? 'selected' : ''; ?>>Freinademetz</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <select name="scholarship_program" id="scholarship_program" class="form-control">
                                        <option value="">Select Scholarship Program</option>
                                        <?php foreach ($scholarship_programs as $program): ?>
                                            <option value="<?= htmlspecialchars($program->scholarship_program); ?>" <?= set_value('scholarship_program') == $program->scholarship_program ? 'selected' : ''; ?>>
                                                <?= htmlspecialchars($program->scholarship_program); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <button type="button" class="btn btn-secondary btn-block" id="resetFilters">Reset Filters</button>
                                </div>
                            </div>
                        </form>
                    </div>


                    <table id="finalListTable" class="table table-bordered table-hover mt-3">
                        <thead>
                            <tr>
                                <th>Id Number</th>
                                <th>Full Name</th>
                                <th>Academic Year</th>
                                <th>Semester</th>
                                <th>Campus</th>
                                <th>Scholarship Program</th>
                                <th>Discount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($applicants) && !empty($applicants)): ?>
                                <?php foreach ($applicants as $applicant): ?>
                                    <tr>
                                        <td><?= $applicant->id_number; ?></td>
                                        <td><?= htmlspecialchars($applicant->firstname . ' ' . $applicant->lastname); ?></td>
                                        <td><?= $applicant->academic_year; ?></td>
                                        <td><?= $applicant->semester; ?></td>
                                        <td><?= $applicant->campus; ?></td>
                                        <td><?= $applicant->scholarship_program; ?></td>
                                        <td><?= $applicant->discount; ?>%</td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">No applicants found.</td>
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
        var table = $('#finalListTable').DataTable({
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
                        
                        doc.pageMargins = [50, 115, 50, 115];

                        doc.background = [{
                            image: 'data:image/png;base64,<?= base64_encode(file_get_contents(base_url("assets/images/format.png"))); ?>',
                            width: 624,
                            height: 830
                        }];

                        
                        doc.content.splice(0, 0, {
                            text: 'SCHOLARSHIP COMMITTEE',
                            alignment: 'center',
                            fontSize: 12,
                            bold: true,
                            margin: [0, 20, 0, 0]
                        });

                      
                        doc.content.splice(1, 0, {
                            text: 'Recommendation for Scholarship',
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

                            for (var i = 0; i < table.table.body.length; i++) {
                                for (var j = 0; j < table.table.body[i].length; j++) {
                                    table.table.body[i][j].fillColor = '#FFFFFF';
                                    table.table.body[i][j].fontSize = 11;
                                }
                            }

                            // Set header row styling
                            var header = table.table.body[0];
                            for (var j = 0; j < header.length; j++) {
                                header[j].fillColor = '#A6D18A';
                                header[j].color = '#000000';
                            }
                        }

                        // Prepared by
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
                        // Evaluated and Recommended by
                        doc.content.push({
                            text: 'Evaluated and Recommended by:',
                            alignment: 'left',
                            margin: [0, 30, 0, 20],
                            fontSize: 12,
                            bold: false
                        });
                        // First row of signatories
                        doc.content.push({
                            columns: [{
                                    stack: [{
                                            text: 'MS. CLAUDETTE SIM, MBA',
                                            alignment: 'center',
                                            fontSize: 12,
                                            bold: true
                                        },
                                        {
                                            text: 'Member',
                                            alignment: 'center',
                                            fontSize: 12,
                                            bold: false
                                        }
                                    ],
                                    width: '50%'
                                },
                                {
                                    stack: [{
                                            text: 'MS. GRACE D. LUZON, MSEco',
                                            alignment: 'center',
                                            fontSize: 12,
                                            bold: true
                                        },
                                        {
                                            text: 'Member',
                                            alignment: 'center',
                                            fontSize: 12,
                                            bold: false
                                        }
                                    ],
                                    width: '50%'
                                }
                            ],
                            margin: [0, 0, 0, 30]
                        });
                        // Second row of signatories
                        doc.content.push({
                            columns: [{
                                    stack: [{
                                            text: 'DR. MARY JANE D. CASTILLO, LPT',
                                            alignment: 'center',
                                            fontSize: 12,
                                            bold: true
                                        },
                                        {
                                            text: 'Member',
                                            alignment: 'center',
                                            fontSize: 12,
                                            bold: false
                                        }
                                    ],
                                    width: '50%'
                                },
                                {
                                    stack: [{
                                            text: 'REV. FR. JEROME A. ORMITA, SVD',
                                            alignment: 'center',
                                            fontSize: 12,
                                            bold: true
                                        },
                                        {
                                            text: 'Member',
                                            alignment: 'center',
                                            fontSize: 12,
                                            bold: false
                                        }
                                    ],
                                    width: '50%'
                                }
                            ],
                            margin: [0, 0, 0, 30]
                        });
                        // Third row of signatories
                        doc.content.push({
                            columns: [{
                                stack: [{
                                        text: 'REV. FR. VICENTE D. CASTRO JR, SVD',
                                        alignment: 'center',
                                        fontSize: 12,
                                        bold: true
                                    },
                                    {
                                        text: 'Vice Chairperson',
                                        alignment: 'center',
                                        fontSize: 12,
                                        bold: false
                                    }
                                ],
                                width: '100%'
                            }],
                            margin: [0, 0, 0, 30]
                        });
                        doc.content.push({
                            columns: [{
                                stack: [{
                                        text: 'BR. HUBERTUS GURU, SVD, Ed.D',
                                        alignment: 'center',
                                        fontSize: 12,
                                        bold: true
                                    },
                                    {
                                        text: 'Scholarship Chairperson',
                                        alignment: 'center',
                                        fontSize: 12,
                                        bold: false
                                    }
                                ],
                                width: '100%'
                            }],
                            margin: [0, 0, 0, 20]
                        });
                        // Final Approver 
                        doc.content.push({
                            text: 'Approved by:',
                            alignment: 'left',
                            margin: [0, 10, 0, 20],
                            fontSize: 12,
                            bold: false
                        });
                        doc.content.push({
                            stack: [{
                                    text: 'REV. FR. RENATO A. TAMPOL, SVD, PhD',
                                    alignment: 'center',
                                    fontSize: 12,
                                    bold: true
                                },
                                {
                                    text: 'President',
                                    alignment: 'center',
                                    fontSize: 12,
                                    bold: false
                                }
                            ],
                            margin: [0, 5, 0, 0]
                        });
                    }
                },
                {
                    extend: "colvis",
                    text: "Column Visibility",
                }
            ],
            "initComplete": function() {
                this.api().buttons().container().appendTo('#finalListTable_wrapper .col-md-6:eq(0)');
            }
        });

        // Filtering functionality
        $('select[name="academic_year"], select[name="semester"], select[name="campus"], select[name="scholarship_program"]').on('change', function() {
            var academic_year = $('select[name="academic_year"]').val();
            var semester = $('select[name="semester"]').val();
            var campus = $('select[name="campus"]').val();
            var scholarship_program = $('select[name="scholarship_program"]').val();

            table.columns(2).search(academic_year)
                .columns(3).search(semester)
                .columns(4).search(campus)
                .columns(5).search(scholarship_program)
                .draw();
        });

        // Reset filters
        $('#resetFilters').on('click', function() {
            $('select[name="academic_year"]').val('');
            $('select[name="semester"]').val('');
            $('select[name="campus"]').val('');
            $('select[name="scholarship_program"]').val('');
            table.columns().search('').draw();
        });

        // Print button functionality
        $('#printButton').on('click', function() {
            table.button('.buttons-print').trigger();
        });
    });
</script>

<?php $this->load->view('includes/footer'); ?>
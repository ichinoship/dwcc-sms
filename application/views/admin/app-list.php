<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>
<title>Applicant Accounts</title>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Applicant Accounts</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Acccount List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <!-- Accepted Applicants Table -->
            <div class="card">
                <div class="card-body">
                    <table id="applicantTable" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>ID Number</th>
                                <th>Full Name</th>
                                <th>Campus</th>
                                <th>Program Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($applicants as $applicant): ?>
                                <tr>
                                    <td><?= $applicant->id_number; ?></td>
                                    <td><?= htmlspecialchars($applicant->firstname . ' ' . (!empty($applicant->middlename) ? $applicant->middlename . ' ' : '') . $applicant->lastname); ?></td>
                                    <td><?= $applicant->campus; ?></td>
                                    <td><?= $applicant->program_type; ?></td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#viewModal"
                                            data-id="<?= $applicant->account_no; ?>"
                                            data-firstname="<?= $applicant->firstname; ?>"
                                            data-middlename="<?= $applicant->middlename; ?>"
                                            data-lastname="<?= $applicant->lastname; ?>"
                                            data-birthdate="<?= $applicant->birthdate; ?>"
                                            data-contact="<?= $applicant->contact; ?>"
                                            data-email="<?= $applicant->email; ?>"
                                            data-campus="<?= $applicant->campus; ?>"
                                            data-program_type="<?= $applicant->program_type; ?>"
                                            data-year="<?= $applicant->year; ?>"
                                            data-program="<?= $applicant->program; ?>"
                                            data-address="<?= $applicant->address; ?>"
                                            data-applicant_residence="<?= $applicant->applicant_residence; ?>">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <?php if ($applicant->account_status == 'active'): ?>
                                            <button class="btn btn-danger btn-sm toggle-status" data-id="<?= $applicant->account_no; ?>" data-status="inactive">
                                                <i class="fas fa-user-slash"></i>
                                            </button>
                                        <?php else: ?>
                                            <button class="btn btn-success btn-sm toggle-status" data-id="<?= $applicant->account_no; ?>" data-status="active">
                                                <i class="fas fa-user-check"></i>
                                            </button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- View Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">View Applicant Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="account_no" id="account_no">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>First Name:</strong> <span id="firstname"></span></p>
                        <p><strong>Middle Name:</strong> <span id="middlename"></span></p>
                        <p><strong>Last Name:</strong> <span id="lastname"></span></p>
                        <p><strong>Birthdate:</strong> <span id="birthdate"></span></p>
                        <p><strong>Contact Number:</strong> <span id="contact"></span></p>
                        <p><strong>Email:</strong> <span id="email"></span></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Program Type:</strong> <span id="program_type"></span></p>
                        <p><strong>Campus:</strong> <span id="campus"></span></p>
                        <p><strong>Year:</strong> <span id="year"></span></p>
                        <p><strong>Program:</strong> <span id="program"></span></p>
                        <p><strong>Address:</strong> <span id="address"></span></p>
                        <p><strong>Applicant Residence:</strong> <span id="applicant_residence"></span></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<?php $this->load->view('includes/footer'); ?>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(function() {
        var table = $('#applicantTable').DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": [{
                    extend: "copy",
                    text: "Copy",
                },
                {
                    extend: "excel",
                    text: "Excel",
                },
                {
                    extend: "pdf",
                    text: "Export to PDF",
                    title: '',
                    filename: function() {
                        return "Applicant-Accounts";
                    },
                    customize: function(doc) {
                        doc.pageMargins = [50, 100, 50, 100];

                        doc.background = [{
                            image: 'data:image/png;base64,<?= base64_encode(file_get_contents(base_url("assets/images/format.png"))); ?>',
                            width: 624,
                            height: 830
                        }];

                        doc.content.splice(0, 0, {
                            text: 'Scholarship Management System',
                            alignment: 'center',
                            fontSize: 12,
                            bold: true,
                            margin: [0, 20, 0, 0]
                        });

                        doc.content.splice(1, 0, {
                            text: 'List of Applicant Accounts',
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

                            table.alignment = 'center';
                            table.table.widths = ['20%', '30%', '20%', '30%'];
                            
                            var header = table.table.body[0];
                            var filteredHeader = header.filter(function(cell, index) {
                                return index !== 4;
                            });

        
                            table.table.body[0] = filteredHeader;

                            for (var i = 1; i < table.table.body.length; i++) {
                                table.table.body[i] = table.table.body[i].filter(function(cell, index) {
                                    return index !== 4;
                                });
                            }

                            for (var j = 0; j < filteredHeader.length; j++) {
                                filteredHeader[j].fillColor = '#A6D18A';
                                filteredHeader[j].color = '#000000';
                            }

                            for (var i = 1; i < table.table.body.length; i++) {
                                for (var j = 0; j < table.table.body[i].length; j++) {
                                    table.table.body[i][j].fillColor = '#FFFFFF';
                                    table.table.body[i][j].fontSize = 11;
                                }
                            }
                        }
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
                        var val = $.fn.dataTable.util.escapeRegex($(this).val());
                        column.search(val ? '^' + val + '$' : '', true, false).draw();
                    });
                });
            }
        });

        // Append the DataTable buttons to a specific location
        table.buttons().container().appendTo('#applicantTable_wrapper .col-md-6:eq(0)');

        // Show modal with pre-filled data
        $('#viewModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var firstname = button.data('firstname');
            var middlename = button.data('middlename');
            var lastname = button.data('lastname');
            var birthdate = button.data('birthdate');
            var contact = button.data('contact');
            var email = button.data('email');
            var campus = button.data('campus');
            var program_type = button.data('program_type');
            var year = button.data('year');
            var program = button.data('program');
            var address = button.data('address');
            var applicant_residence = button.data('applicant_residence');

            var modal = $(this);
            modal.find('#account_no').val(id);
            modal.find('#firstname').text(firstname);
            modal.find('#middlename').text(middlename);
            modal.find('#lastname').text(lastname);
            modal.find('#birthdate').text(birthdate);
            modal.find('#contact').text(contact);
            modal.find('#email').text(email);
            modal.find('#campus').text(campus);
            modal.find('#program_type').text(program_type);
            modal.find('#year').text(year);
            modal.find('#program').text(program);
            modal.find('#address').text(address);
            modal.find('#applicant_residence').text(applicant_residence);
        });
    });

    $(document).on('click', '.toggle-status', function() {
        var applicantId = $(this).data('id');
        var newStatus = $(this).data('status');

        Swal.fire({
            title: 'Are you sure?',
            text: "You are about to make this account " + newStatus + ".",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, make it ' + newStatus + '!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url('admin/toggle_applicant_status'); ?>',
                    method: 'POST',
                    data: {
                        account_no: applicantId,
                        status: newStatus
                    },
                    dataType: 'json', // Ensure the response is treated as JSON
                    success: function(response) {
                        if (response.success) {
                            Swal.fire('Success', 'Account status updated!', 'success');
                            location.reload(); // Reload page after status change
                        } else {
                            Swal.fire('Error', 'Something went wrong. Please try again.', 'error');
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire('Error', 'An error occurred: ' + error, 'error');
                    }
                });
            }
        });
    });
</script>
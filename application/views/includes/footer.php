<footer class="main-footer">
    <strong>Copyright &copy; 2024-2025 <a href="">DWCC-SMS</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Scholarship Management System</b>
    </div>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>


<!-- jQuery -->
<script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('assets/') ?>plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?= base_url('assets/') ?>plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?= base_url('assets/') ?>plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?= base_url('assets/') ?>plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?= base_url('assets/') ?>plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url('assets/') ?>plugins/jquery-knob/jquery.knob.min.js"></script>

<!-- daterangepicker -->
<script src="<?= base_url('assets/') ?>plugins/moment/moment.min.js"></script>
<script src="<?= base_url('assets/') ?>plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url('assets/') ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?= base_url('assets/') ?>plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('assets/') ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/') ?>dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= base_url('assets/') ?>dist/js/pages/dashboard.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?= base_url('assets/') ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/') ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/') ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets/') ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/') ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url('assets/') ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/') ?>plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url('assets/') ?>plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url('assets/') ?>plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url('assets/') ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url('assets/') ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url('assets/') ?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


<!-- Page specific script -->
<script>
    $(function() {
        var table = $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": [{
                    extend: "copy",
                    text: "Copy",
                },
                {
                    extend: "csv",
                    text: "CSV",
                },
                {
                    extend: "excel",
                    text: "Excel",
                },
                {
                    extend: "pdf",
                    text: "PDF",
                    title: '',
                    customize: function(doc) {
                        doc.content.splice(0, 0, {
                            alignment: 'center',
                            image: 'data:image/png;base64,<?= base64_encode(file_get_contents(base_url("assets/images/logo-preloader.png"))); ?>',
                            width: 100,
                            margin: [0, 0, 0, 10]
                        });
                        doc.defaultStyle.fontSize = 12;
                    }
                },
                {
                    extend: "print",
                    text: "Print",
                    title: '',
                    message: '<div style="text-align: center;">' +
                        '<img src="<?= base_url('assets/images/logo-preloader.png'); ?>" alt="Logo" style="max-width: 200px; margin-bottom:10px;"><br>' +
                        '</div>',
                    customize: function(win) {
                        $(win.document.body)
                            .css('font-size', '15pt')
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
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        var table = $("#example2").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": [{
                    extend: "copy",
                    text: "Copy",
                },
                {
                    extend: "csv",
                    text: "CSV",
                },
                {
                    extend: "excel",
                    text: "Excel",
                },
                {
                    extend: "pdf",
                    text: "PDF",
                    title: '',
                    customize: function(doc) {
                        doc.content.splice(0, 0, {
                            alignment: 'center',
                            image: 'data:image/png;base64,<?= base64_encode(file_get_contents(base_url("assets/images/logo-preloader.png"))); ?>',
                            width: 100,
                            margin: [0, 0, 0, 10]
                        });
                        doc.defaultStyle.fontSize = 12;
                    }
                },
                {
                    extend: "print",
                    text: "Print",
                    title: '',
                    message: '<div style="text-align: center;">' +
                        '<img src="<?= base_url('assets/images/logo-preloader.png'); ?>" alt="Logo" style="max-width: 200px; margin-bottom:10px;"><br>' +
                        '</div>',
                    customize: function(win) {
                        $(win.document.body)
                            .css('font-size', '15pt')
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
        }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');

        var table = $("#example3").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": [{
                    extend: "copy",
                    text: "Copy",
                },
                {
                    extend: "csv",
                    text: "CSV",
                },
                {
                    extend: "excel",
                    text: "Excel",
                },
                {
                    extend: "pdf",
                    text: "PDF",
                    title: '',
                    customize: function(doc) {
                        doc.content.splice(0, 0, {
                            alignment: 'center',
                            image: 'data:image/png;base64,<?= base64_encode(file_get_contents(base_url("assets/images/logo-preloader.png"))); ?>',
                            width: 100,
                            margin: [0, 0, 0, 10]
                        });
                        doc.defaultStyle.fontSize = 12;
                    }
                },
                {
                    extend: "print",
                    text: "Print",
                    title: '',
                    message: '<div style="text-align: center;">' +
                        '<img src="<?= base_url('assets/images/logo-preloader.png'); ?>" alt="Logo" style="max-width: 200px; margin-bottom:10px;"><br>' +
                        '</div>',
                    customize: function(win) {
                        $(win.document.body)
                            .css('font-size', '15pt')
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
        }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');

        $(document).ready(function() {
            // Initialize DataTable with pagination
            var table = $("#add_reqs").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
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
            }).buttons().container().appendTo('#add_reqs_wrapper .col-md-6:eq(0)');

            // Event delegation for edit button
            $(document).on('click', '.editRequirementBtn', function() {
                var requirementId = $(this).data('id');
                var requirementName = $(this).data('name');

                $('#edit_requirement_id').val(requirementId);
                $('#edit_requirement_name').val(requirementName);

                $('#editRequirementModal').modal('show');
            });
        });
    });
</script>

<!-- Generate the image URL with PHP and pass it to JavaScript -->
<script>
    var headerImageUrl = '<?= base_url('assets/images/header.png'); ?>';

    function printTable() {
        // Remove body margins and set to zero
        document.body.style.margin = "0";
        document.body.style.padding = "0";

        var printHeader = `
            <div style="text-align: center; margin-bottom: 50px;">
                <img src="${headerImageUrl}" alt="Header Image" style="max-width: 100%; height: auto; width: 100%; max-height: 100px;">
            </div>
        `;
        var printContents = document.querySelector('#academicYearTable').outerHTML;

        // Add signatories HTML
        var signatoriesHTML = `
    
    `;

        var originalContents = document.body.innerHTML;

        // Combine the image header, the table, and the signatories for printing
        document.body.innerHTML = printHeader + printContents + signatoriesHTML;
        window.print();

        // Restore the original page content after printing
        document.body.innerHTML = originalContents;

        // Reload to restore event listeners or dynamic content
        window.location.reload();
    }
</script>


<script>
    var headerImageUrl = '<?= base_url('assets/images/header.png'); ?>';

    function printScholarshipReport() {
        // Remove body margins and set to zero
        document.body.style.margin = "0";
        document.body.style.padding = "0";

        var printHeader = `
            <div style="text-align: center; margin-bottom: 50px;">
                <img src="${headerImageUrl}" alt="Header Image" style="max-width: 100%; height: auto; width: 100%; max-height: 100px;">
            </div>
        `;
        var printContents = document.querySelector('#scholarshipTable').outerHTML;

        // Add signatories HTML (optional: if you want signatories for this report too)
        var signatoriesHTML = `
           



        `;

        var originalContents = document.body.innerHTML;

        // Combine the image header, the table, and the signatories for printing
        document.body.innerHTML = printHeader + printContents + signatoriesHTML;
        window.print();

        // Restore the original page content after printing
        document.body.innerHTML = originalContents;

        // Reload to restore event listeners or dynamic content
        window.location.reload();
    }
</script>

</body>

</html>
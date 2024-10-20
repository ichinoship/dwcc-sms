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
                    <h3 class="card-title">Final List</h3>

                    <!-- Filter by Academic Year -->
                    <div class="float-right">
                        <form id="filterForm" method="POST" action="<?= base_url('sc/final_list'); ?>">
                            <select name="academic_year" id="academic_year" class="form-control" onchange="document.getElementById('filterForm').submit();">
                                <option value="">Select Academic Year</option>
                                <?php foreach ($academic_years as $year): ?>
                                    <option value="<?= $year->academic_year; ?>" <?= isset($selected_year) && $selected_year == $year->academic_year ? 'selected' : ''; ?>>
                                        <?= $year->academic_year; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </form>
                    </div>

                    <button id="printFinalList" class="btn btn-primary float-right" onclick="printFinalList()">Print Report</button>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Id Number</th>
                                <th>Full Name</th>
                                <th>Program Type</th>
                                <th>Year</th>
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
                                        <td><?= htmlspecialchars($applicant->firstname . ' ' . (!empty($applicant->middlename) ? $applicant->middlename . ' ' : '') . $applicant->lastname); ?></td>
                                        <td><?= $applicant->program_type; ?></td>
                                        <td><?= $applicant->year; ?></td>
                                        <td><?= $applicant->campus; ?></td>
                                        <td><?= $applicant->scholarship_program; ?></td>
                                        <td><?= $applicant->discount; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">No applicants found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    var headerImageUrl = '<?= base_url('assets/images/header.png'); ?>';

    function printFinalList() {
        // Remove body margins and set to zero
        document.body.style.margin = "0";
        document.body.style.padding = "0";

        var printHeader = `
            <div style="text-align: center; margin-bottom: 50px;">
                <img src="${headerImageUrl}" alt="Header Image" style="max-width: 100%; height: auto; width: 100%; max-height: 100px;">
            </div>
        `;
        var printContents = document.querySelector('#finalList').outerHTML;

        // Add signatories HTML (optional: if you want signatories for this report too)
        var signatoriesHTML = `
           <div class="signatories" style="margin-top: 90px; text-align: center; width: 100%;">

   <!-- Prepared by Section on the Left -->
    <div style="text-align: left; width: 50%;">
        <p style="font-weight: bold; margin-bottom: 30px;">Prepared by:</p>
        <p style="font-weight: bold; margin: 0;">DIANA KYTH P. CONTI</p>
        <p style="margin-bottom: 30px;">Scholarship Coordinator</p>
    </div>

    <!-- Scholarship Committee -->
    <div style="margin-bottom: 40px;text-align: center;">
        <p style="text-align: left;">Evaluated and Recommended by:</p>
        <p style="font-weight: bold;margin-bottom:30px">SCHOLARSHIP COMMITTEE</p>

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
            <p style="margin: 0; padding-top: 5px;"> <i>Vice Chairperson</i></p> <!-- Added padding for spacing -->
        </div>
        <div style="text-align: center;">
            <p style="font-weight: bold; margin: 0;">BR. HUBERTUS GURU, SVD, Ed.D.</p>
            <p style="margin: 0; padding-top: 5px;"> <i>Scholarship Chairperson</i></p> <!-- Added padding for spacing -->
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

<?php $this->load->view('includes/footer'); ?>

<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/sidebar'); ?>
<title>Shortlist</title>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Shortlisted Applicants</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('twc/dashboard'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Shortlist</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List of Shortlisted Applicants</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Shortlist Id</th>
                                <th>Id Number</th>
                                <th>Last Name</th>
                                <th>First Name</th>
                                <th>Scholarship Program</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($shortlist)): ?>
                                <?php foreach ($shortlist as $entry): ?>
                                    <tr>
                                        <td><?= $entry->shortlist_id; ?></td>
                                        <td><?= $entry->id_number; ?></td>
                                        <td><?= $entry->lastname; ?></td>
                                        <td><?= $entry->firstname; ?></td>
                                        <td><?= $entry->scholarship_program; ?></td>
                                        <td><?= ucfirst($entry->status); ?></td>
                                        <td>
                                            <a href="<?= site_url('twc/view_shortlist_applicant/' . $entry->shortlist_id); ?>" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center">No shortlisted applicants found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view('includes/footer'); ?>
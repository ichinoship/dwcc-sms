<?php $this->load->view('includes/header') ?>
<?php $this->load->view('includes/sidebar') ?>
<title>Add Announcement</title>

<div class="content-wrapper">
<div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add New Announcement</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('sc/dashboard'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Announcements</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Card for Adding New Announcement -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-light text-dark">
                            <h5 class="card-title mb-0">New Announcement</h5>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('sc/submit_announcement'); ?>" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="title">Announcement Title</label>
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>
                                <div class="form-group">
                                    <label for="statement">Statement</label>
                                    <textarea class="form-control" id="statement" name="statement" rows="4" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Publish Announcement</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Table for viewing, editing, and deleting announcements -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-light text-dark">
                            <h5 class="card-title mb-0">List of Announcements</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($announcements)): ?>
                                        <tr>
                                            <td colspan="4" class="text-center">No announcements available</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($announcements as $announcement): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($announcement->title) ?></td>
                                                <td><?= htmlspecialchars($announcement->announcement_date) ?></td>
                                                <td><?= htmlspecialchars($announcement->announcement_time) ?></td>
                                                <td>
                                                    <button class="btn btn-info btn-sm" onclick="openViewModal('<?= addslashes($announcement->title) ?>', '<?= addslashes($announcement->statement) ?>')" title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="btn btn-warning btn-sm" onclick="openEditModal(<?= $announcement->id ?>, '<?= addslashes($announcement->title) ?>', '<?= addslashes($announcement->statement) ?>')" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-danger btn-sm" onclick="deleteAnnouncement(<?= $announcement->id ?>)" title="Delete">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- View Announcement Modal -->
<div class="modal fade" id="viewAnnouncementModal" tabindex="-1" role="dialog" aria-labelledby="viewAnnouncementModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewAnnouncementModalLabel">View Announcement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 id="view-announcement-title"></h5>
                <p id="view-announcement-statement"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Announcement Modal -->
<div class="modal fade" id="editAnnouncementModal" tabindex="-1" role="dialog" aria-labelledby="editAnnouncementModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAnnouncementModalLabel">Edit Announcement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editAnnouncementForm" action="<?= base_url('sc/update_announcement'); ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="edit-announcement-id">
                    <div class="form-group">
                        <label for="edit-title">Announcement Title</label>
                        <input type="text" class="form-control" id="edit-title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-statement">Statement</label>
                        <textarea class="form-control" id="edit-statement" name="statement" rows="4" required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="submitEditForm()">Update Announcement</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Announcement Modal -->
<div class="modal fade" id="deleteAnnouncementModal" tabindex="-1" role="dialog" aria-labelledby="deleteAnnouncementModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAnnouncementModalLabel">Delete Announcement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this announcement?</p>
                <input type="hidden" id="delete-announcement-id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="confirmDelete()">Delete</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php if (!empty($message)): ?>
    <script>
        const message = "<?= addslashes($message); ?>";
        const isSuccess = message.includes('successfully');
        const alertType = isSuccess ? 'success' : 'error';

        Swal.fire({
            icon: alertType,
            title: isSuccess ? 'Success!' : 'Error!',
            text: message,
            confirmButtonText: 'OK'
        });
    </script>
<?php endif; ?>

<script>
    function openViewModal(title, statement) {
        document.getElementById('view-announcement-title').innerText = title;
        document.getElementById('view-announcement-statement').innerText = statement;
        $('#viewAnnouncementModal').modal('show');
    }

    function openEditModal(id, title, statement) {
        document.getElementById('edit-announcement-id').value = id;
        document.getElementById('edit-title').value = title;
        document.getElementById('edit-statement').value = statement;
        $('#editAnnouncementModal').modal('show');
    }

    function submitEditForm() {
        document.getElementById('editAnnouncementForm').submit();
    }

    function deleteAnnouncement(id) {
        document.getElementById('delete-announcement-id').value = id;
        $('#deleteAnnouncementModal').modal('show');
    }

    function confirmDelete() {
        const id = document.getElementById('delete-announcement-id').value;
        window.location.href = "<?= base_url('sc/delete_announcement/'); ?>" + id;
    }
</script>

<?php $this->load->view('includes/footer') ?>
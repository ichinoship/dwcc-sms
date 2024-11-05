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
                                    <label for="content">Content</label>
                                    <textarea class="form-control" id="content" name="content" rows="4" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="author">Author Name</label>
                                    <input type="text" class="form-control" id="author" name="author" required>
                                </div>
                                <div class="form-group">
                                    <label for="image">Upload Image</label>
                                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
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
                                                <td>
                                                    <button class="btn btn-info btn-sm"
                                                        onclick="openViewModal('<?= addslashes($announcement->title) ?>', 
                                '<?= addslashes($announcement->content) ?>', 
                                '<?= addslashes($announcement->author) ?>', 
                                '<?= date('F j, Y', strtotime($announcement->announcement_date)) ?> at <?= date('g:i A', strtotime($announcement->announcement_time)) ?>', 
                                '<?= !empty($announcement->image) ? base_url('uploads/' . $announcement->image) : '' ?>')"
                                                        title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="btn btn-warning btn-sm" onclick="openEditModal(<?= $announcement->id ?>, '<?= addslashes($announcement->title) ?>', '<?= addslashes($announcement->content) ?>', '<?= addslashes($announcement->author) ?>', '<?= base_url('uploads/' . $announcement->image) ?>')" title="Edit">
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
                <p id="view-announcement-content"></p>
                <p><strong id="view-announcement-author"></strong></p>
                <p><small id="view-announcement-datetime" class="text-muted"></small></p>
                <div id="view-announcement-image" class="mt-2" style="display:none;">
                    <img src="" alt="Announcement Image" class="img-fluid" style="max-width: 100%; height: auto;">
                </div>
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
                        <label for="edit-author">Author</label>
                        <input type="text" class="form-control" id="edit-author" name="author" required>
                    </div>

                    <div class="form-group">
                        <label for="edit-content">Content</label>
                        <textarea class="form-control" id="edit-content" name="content" rows="4" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Current Image</label>
                        <div id="current-image-container" class="mb-2">
                            <img id="current-image" src="" alt="Current Announcement Image" class="img-fluid" style="max-width: 100%; height: auto;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="edit-image">Change Image (optional)</label>
                        <input type="file" class="form-control" id="edit-image" name="image" accept="image/*">
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
    function openViewModal(title, content, author, datetime, image) {
        document.getElementById('view-announcement-title').innerHTML = "<strong>" + title + "</strong>";
        document.getElementById('view-announcement-content').innerText = content;
        document.getElementById('view-announcement-author').innerText = "Posted By: " + author;
        document.getElementById('view-announcement-datetime').innerText = datetime;

        const imageElement = document.getElementById('view-announcement-image');
        const img = imageElement.querySelector('img');

        if (image) {
            img.src = image;
            imageElement.style.display = 'block';
        } else {
            imageElement.style.display = 'none';
        }

        $('#viewAnnouncementModal').modal('show');
    }

    function openEditModal(id, title, content, author, image) {
        document.getElementById('edit-announcement-id').value = id;
        document.getElementById('edit-title').value = title;
        document.getElementById('edit-content').value = content;
        document.getElementById('edit-author').value = author;

        const currentImage = document.getElementById('current-image');
        const currentImageContainer = document.getElementById('current-image-container');

        if (image) {
            currentImage.src = image; // Set the image source
            currentImageContainer.style.display = 'block'; // Show the image
        } else {
            currentImageContainer.style.display = 'none'; // Hide if no image
        }

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
<?php include "includes/header.php";
if(!isset($_GET['id'])) {
    header("location: events.php?error=Invalid+Access+Method");
    exit();
}

$event_info = getSpecificEvent($_GET['id']);
?>
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <!-- row -->
        <div class="row">
            <div class="col-xl-12 col-lg-8">
                <div class="card profile-card card-bx m-b30">
                    <div class="card-header">
                        <h6 class="title">Edit Event</h6>
                    </div>
                    <form class="profile-form" action="operations/editEventApi.php" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <?php
                            if (isset($_GET['error'])) { ?>
                                <div class="error mb-3">
                                    <?php echo htmlspecialchars($_GET['error']) ?>
                                </div>
                            <?php }
                            if (isset($_GET['success'])) { ?>
                                <div class="success mb-3"><?php echo htmlspecialchars($_GET['success']) ?></div>
                            <?php }
                            ?>

                            <div class="row">
                                <div class="col-sm-6 m-b30">
                                    <label class="form-label">Event Name</label>
                                    <input type="text" class="form-control" name="name" value="<?= $event_info['event_name'] ?>">
                                </div>
                                <div class="col-sm-6 m-b30">
                                    <label class="form-label">Venue</label>
                                    <input type="text" class="form-control" name="venue" value="<?= $event_info['venue'] ?>">
                                </div>
                                <div class="col-sm-6 m-b30">
                                    <label class="form-label">Link</label>
                                    <input type="text" class="form-control" name="link" value="<?= $event_info['links'] ?>">
                                </div>
                                <div class="col-sm-6 m-b30">
                                    <label class="form-label">Scheduled Date</label>
                                    <input type="date" class="form-control" name="date" value="<?= $event_info['event_date'] ?>">
                                </div>
                                <div class="col-sm-6 m-b30">
                                    <label class="form-label">Contact</label>
                                    <input type="contact" class="form-control" name="contact" value="<?= $event_info['contact_two'] ?>">
                                </div>
                                <div class="col-sm-6 mb-30">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-txtarea form-control" placeholder="Description" rows="8" required><?= $event_info['description'] ?></textarea>
                                </div>
                                <div class="col-sm-6 mb-30">
                                    <label for="formFile" class="form-label">Event Thumbnail</label>
                                    <input type="file" name="thumbnail" class="form-control" id="formFile">
                                </div>
                                <input type="hidden" name="event_id" value="<?= $_GET['id'] ?>">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary">UPDATE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                <div class="basic-form">
                    <form method="post" action="operations/changePassword.php" class="profile-form needs-validation" novalidate>
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label class="col-lg-4 col-form-label" for="validationCustom01">Create New Password
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="password" class="form-control" name="cpass" id="validationCustom01" placeholder="Create Password" required>

                                <div class="invalid-feedback">
                                    Please this is a required field.
                                </div>
                            </div>

                            <div class="mb-3 col-md-12">
                                <label class="col-lg-4 col-form-label" for="validationCustom02">Confirm Password
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="password" class="form-control" name="conpass" id="validationCustom02" placeholder="Confirm Password" required>

                                <div class="invalid-feedback">
                                    Please, this is a required field
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger btn-sm light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-sm btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "includes/footer.php"; ?>
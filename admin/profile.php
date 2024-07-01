<?php include "includes/header.php"; ?>
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <!-- row -->
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                <div class="clearfix">
                    <div class="card card-bx profile-card author-profile m-b30">
                        <div class="card-body">
                            <div class="p-5">
                                <div class="author-profile">
                                    <div class="author-media">
                                        <form id="form" action="operations/updateProfilePicture.php" method="post" enctype="multipart/form-data">
                                            <img src="../dbimages/<?= $admin_data['profile_picture'] ?> " alt="">
                                            <div class="upload-link" title="" data-toggle="tooltip" data-placement="right" data-original-title="update">
                                                <input type="file" id="photo" class="update-flie" name="photo" accept=".jpg, .jpeg, .png">
                                                <i class="fa fa-camera"></i>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8">
                <div class="card profile-card card-bx m-b30">
                    <div class="card-header">
                        <h6 class="title">Account setup</h6>
                    </div>
                    <form class="profile-form" action="operations/editProfile.php" method="post">
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
                                    <label class="form-label">First Name</label>
                                    <input type="text" class="form-control" name="fname" value="<?= $admin_data['firstname'] ?>">
                                </div>
                                <div class="col-sm-6 m-b30">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" class="form-control" name="lname" value="<?= $admin_data['lastname'] ?>">
                                </div>
                                <div class="col-sm-6 m-b30">
                                    <label class="form-label">Phone</label>
                                    <input type="text" class="form-control" name="phone" value="<?= $admin_data['contact'] ?>">
                                </div>
                                <div class="col-sm-6 m-b30">
                                    <label class="form-label">Email address</label>
                                    <input type="email" class="form-control" name="email" value="<?= $admin_data['email'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary">UPDATE</button>
                            <a href="page-register.html" class="btn-link" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">Forgot your password?</a>
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

<script>
    document.getElementById("photo").onchange = function() {
        document.getElementById('form').submit();
    }
</script>
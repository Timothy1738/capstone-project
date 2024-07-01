<?php
include "./includes/header.php";
$admins = get_Admins($_SESSION['admin_id']);
?>
<!--**********************************
   Content body start
   ***********************************-->
<div class="content-body">
    <!-- container starts -->
    <div class="container-fluid">
        <div class="row">
            <!-- Column starts -->
            <div class="col-xl-12">
                <div class="card dz-card" id="accordion-one">
                    <div class="card-header flex-wrap">
                        <div>
                            <h4 class="card-title">Admins</h4>
                        </div>
                        <!-- Large modal -->
                        <button type="button" class="btn btn-primary mb-2 btn-sm" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">Add Admin</button>
                    </div>
                    <!--tab-content-->
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="Preview" role="tabpanel" aria-labelledby="home-tab">
                            <div class="card-body pt-0">
                                <div class="table-responsive">
                                    <?php
                                    if (isset($_GET['error'])) { ?>
                                        <div class="error" style="padding: 10px;">
                                            <?php echo $_GET['error'] ?>
                                        </div>
                                    <?php }
                                    if (isset($_GET['success'])) { ?>
                                        <div class="success"><?php echo htmlspecialchars($_GET['success']) ?></div>
                                    <?php }
                                    ?>
                                    <table id="example" class="display table" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Profile Picture</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
                                                <th>Contact</th>
                                                <th>UserName</th>
                                                <th>Created</th>
                                                <th>Created By</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($admins == null) { ?>
                                                <tr>
                                                    <td colspan="10" style="text-align: center;">
                                                        You are the only admin available!
                                                    </td>
                                                </tr>
                                            <?php } else { ?>
                                                <?php
                                                $num = 0;
                                                foreach ($admins as $admin) : ?>
                                                    <tr>
                                                        <td><?= $num += 1 ?></td>
                                                        <td><img height="50px" width="50px" style="border-radius: 50%;" src="../dbimages/<?= $admin['profile_picture'] ?>" alt=""></td>
                                                        <td><?= $admin['firstname'] ?></td>
                                                        <td><?= $admin['lastname'] ?></td>
                                                        <td><?= $admin['email'] ?></td>
                                                        <td><?= $admin['contact'] ?></td>
                                                        <td><?= $admin['username'] ?></td>
                                                        <td><?= $admin['created'] ?></td>
                                                        <td><?= $admin['created_by'] ?></td>
                                                        <td>
                                                            <form action="./operations/deleteAdmin.php" method="post" onsubmit="return confirm('Are you sure you want to delete this record?')">
                                                                <input type="hidden" value="<?= $admin['admin_id'] ?>" name="admin_id">
                                                                <button name="delete" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Profile Picture</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
                                                <th>Contact</th>
                                                <th>UserName</th>
                                                <th>Created</th>
                                                <th>Created By</th>
                                                <th>Actions</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <!-- /Default accordion -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Admin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="basic-form">
                            <form method="post" action="./operations/add-admin.php" class="profile-form needs-validation" novalidate>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="col-lg-4 col-form-label" for="validationCustom01">First Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="fname" id="validationCustom01" placeholder="First Name" required>

                                        <div class="invalid-feedback">
                                            Please this is a required field.
                                        </div>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02">Last Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="lname" id="validationCustom02" placeholder="Last Name" required>

                                        <div class="invalid-feedback">
                                            Please, this is a required field
                                        </div>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label class="col-lg-4 col-form-label" for="validationCustom01">Email
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="email" class="form-control" name="email" id="validationCustom01" placeholder="Email" required>

                                        <div class="invalid-feedback">
                                            Please this is a required field.
                                        </div>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02">Contact
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="contact" id="validationCustom02" placeholder="Contact" required>

                                        <div class="invalid-feedback">
                                            Please, this is a required field
                                        </div>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label class="col-lg-4 col-form-label" for="validationCustom01">Password
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="password" class="form-control" name="password" id="validationCustom01" placeholder="Password" required>

                                        <div class="invalid-feedback">
                                            Please this is a required field.
                                        </div>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02">Username
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="username" id="validationCustom02" placeholder="Username" required>

                                        <div class="invalid-feedback">
                                            Please, this is a required field
                                        </div>
                                    </div>

                                    <input type="hidden" name="user_id" value="<?= $_SESSION['admin_id'] ?>">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger btn-sm light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="submit" class="btn btn-sm btn-primary">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--**********************************
   Content body end
   ***********************************-->
<?php
include "./includes/footer.php";
?>

<script>
    if (window.location.href.indexOf('success=Admin created successfully') > -1) {
        swal("Success !!", "Admin Created successfully", "success");

        // Remove the success parameter from the URL
        var newUrl = window.location.href.split("?")[0];
        window.history.replaceState({}, document.title, newUrl);
    }
</script>
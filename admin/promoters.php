<?php
include "./includes/header.php";

$promoters = getPromoters();
$talentCategory = get_talentCategory();
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
                            <h4 class="card-title">Promoters</h4>
                        </div>
                        <!-- Large modal -->
                        <button type="button" class="btn btn-primary mb-2 btn-sm" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">Add Promoter</button>
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
                                                <th>Brand Name</th>
                                                <th>Email</th>
                                                <th>Contact</th>
                                                <th>UserName</th>
                                                <th>Talent Category</th>
                                                <th>Created</th>
                                                <th>Created By</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($promoters == null) { ?>
                                                <tr>
                                                    <td colspan="9" style="text-align: center;">No Promoters added yet!</td>
                                                </tr>
                                            <?php } else { ?>
                                                <?php
                                                $num = 0;
                                                foreach ($promoters as $promoter) : ?>
                                                    <tr>
                                                        <td><?= $num += 1 ?></td>
                                                        <td><img height="50px" width="50px" style="border-radius: 50%;" src="../dbimages/<?= $promoter['profile_picture'] ?>" alt=""></td>
                                                        <td><?= $promoter['brand_name'] ?></td>
                                                        <td><?= $promoter['email'] ?></td>
                                                        <td><?= $promoter['contact'] ?></td>
                                                        <td><?= $promoter['username'] ?></td>
                                                        <td><?= getCategoryName($promoter['talentCategory']) ?></td>
                                                        <td>
                                                            <?= $promoter['created'] ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($promoter['created_by'] == $admin_data['admin_id']) {
                                                                echo "You";
                                                            } else { ?><?= $promoter['createdby'] ?><?php } ?>
                                                        </td>
                                                        <td>
                                                            <form action="operations/deletePromoter.php" method="post" onsubmit="return confirm('Are you sure you want to delete this record?')">
                                                                <input type="hidden" value="<?= $promoter['promoter_id'] ?>" name="promoter_id">
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
                                                <th>Brand Name</th>
                                                <th>Email</th>
                                                <th>Contact</th>
                                                <th>UserName</th>
                                                <th>Talent Category</th>
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
                        <h5 class="modal-title">Add Promoter</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="basic-form">
                            <form method="post" action="operations/addPromoter.php" class="profile-form needs-validation" novalidate>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="col-lg-4 col-form-label" for="validationCustom01">Brand Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="name" id="validationCustom01" placeholder="Brand Name" required>

                                        <div class="invalid-feedback">
                                            Please this is a required field.
                                        </div>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02">Email
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="email" class="form-control" name="email" id="validationCustom02" placeholder="Email" required>

                                        <div class="invalid-feedback">
                                            Please, this is a required field
                                        </div>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label class="col-lg-4 col-form-label" for="validationCustom01">Contact
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="contact" id="validationCustom01" placeholder="contact" required>

                                        <div class="invalid-feedback">
                                            Please this is a required field.
                                        </div>
                                    </div>
                                    <!-- talentcategory -->

                                    <div class="mb-3 col-md-6">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02">Username
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="username" id="validationCustom02" placeholder="Username" required>

                                        <div class="invalid-feedback">
                                            Please, this is a required field
                                        </div>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label class="col-lg-4 col-form-label" for="validationCustom03">Talent Category
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="default-select  form-control wide" name="talentcategory" id="validationCustom03" required>
                                            <option value="">Choose...</option>
                                            <?php if ($talentCategory == null) { ?>
                                                <option value="">Null</option>
                                                <?php } else {
                                                foreach ($talentCategory as $category) : ?>
                                                    <option value="<?= $category['category_id'] ?>"><?= $category['talent_Name']; ?></option>
                                            <?php endforeach;
                                            } ?>
                                        </select>

                                        <div class="invalid-feedback">
                                            Please, this is a required field
                                        </div>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02">Password
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="password" class="form-control" name="password" id="validationCustom02" placeholder="password" required>

                                        <div class="invalid-feedback">
                                            Please, this is a required field
                                        </div>
                                    </div>
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
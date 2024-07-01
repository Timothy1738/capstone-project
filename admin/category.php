<?php
include "./includes/header.php";

$cateogries = get_talentCategory();
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
                            <h4 class="card-title">Talent Cateogries</h4>
                        </div>
                        <!-- Large modal -->
                        <button type="button" class="btn btn-primary mb-2 btn-sm" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">Add New Category</button>
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
                                                <th>Category Name</th>
                                                <th>Description</th>
                                                <th>Created</th>
                                                <th>Created By</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($cateogries == null) { ?>
                                                <tr>
                                                    <td colspan="6" style="text-align: center;">No Talent Cateories Available</td>
                                                </tr>
                                            <?php } else { ?>
                                                <?php
                                                $num = 0;
                                                foreach ($cateogries as $category) : ?>
                                                    <tr>
                                                        <td><?= $num += 1 ?></td>
                                                        <td><?= $category['talent_Name'] ?></td>
                                                        <td><?= $category['Description'] ?></td>
                                                        <td><?= $category['created'] ?></td>
                                                        <td><?= $category['created_by'] ?></td>
                                                        <td class="d-flex">
                                                            <form action="operations/delete-category.php" method="post" onsubmit="return confirm('Are you sure you want to delete this record?')">
                                                                <input type="hidden" value="<?= $category['category_id'] ?>" name="category_id">
                                                                <button name="delete" class="btn btn-danger shadow btn-xs sharp me-1"><i class="fa fa-trash"></i></button>
                                                            </form>
                                                            <a href="updateCategory.php?id=<?= $category['category_id'] ?>" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Category Name</th>
                                                <th>Description</th>
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
                        <h5 class="modal-title">Add Talent Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="basic-form">
                            <form method="post" action="operations/add-category.php" class="profile-form needs-validation" novalidate>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="col-lg-4 col-form-label" for="validationCustom01">Talent Name | Category Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="name" id="validationCustom01" placeholder="e.g Music" required>

                                        <div class="invalid-feedback">
                                            Please this is a required field.
                                        </div>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02">Category Description
                                            <span class="text-danger">*</span>
                                        </label>

                                        <textarea name="desc" class="form-control" id="validationCustom02" required></textarea>

                                        <div class="invalid-feedback">
                                            Please, this is a required field
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger btn-sm light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="submit" class="btn btn-sm btn-primary">Add Category</button>
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
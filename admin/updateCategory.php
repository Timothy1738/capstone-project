<?php
include "./includes/header.php";
$category = get_categoryBy_id($_GET['id']);
?>
<!--**********************************
   Content body start
   ***********************************-->
<div class="content-body">
    <!-- container starts -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Update Talent Category</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="./operations/updateCateory.php">
                            <div class="card-body">
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
                                <div class="row mt-xl-3">
                                    <div class="col-sm-6 m-b30">
                                        <label class="col-lg-4 col-form-label">Category Name
                                        </label>
                                        <input type="text" class="form-control form-control-lg" name="name" value="<?= $category['talent_Name'] ?>">
                                    </div>

                                    <input type="hidden" name="category_id" value="<?= $category['category_id'] ?>">

                                    <div class="col-sm-6 m-b30">
                                        <label class="col-lg-4 col-form-label">Description
                                        </label>
                                        <textarea name="desc" class="form-txtarea form-control" rows="8" id=""><?= $category['Description'] ?></textarea>
                                    </div>
                                </div>
                                <div class="col-12 mt-xl-4">
                                    <button name="edit" type="submit" class="btn btn-primary mb-2">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--**********************************
   Content body end
   ***********************************-->
<?php include "./includes/footer.php"; ?>
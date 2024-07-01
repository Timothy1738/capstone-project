<?php
include "./includes/header.php";

$promoters = getPromoters_note($_SESSION['promoter_id']);
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
                            <h4 class="card-title">Meet Other Promoters</h4>
                        </div>
                        <!-- Large modal -->
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
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($promoters == null) { ?>
                                                <tr>
                                                    <td colspan="9" style="text-align: center;">😊😊 Your are the only Promoter currently signed up</td>
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
    </div>
</div>
<!--**********************************
   Content body end
   ***********************************-->
<?php
include "./includes/footer.php";
?>
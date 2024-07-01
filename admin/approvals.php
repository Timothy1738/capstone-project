<?php
include "./includes/header.php";
$perfomance = approveVidoes();
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
                            <h4 class="card-title">Verify Videos</h4>
                        </div>
                        <!-- Large modal -->
                        <a href="history.php">
                            <button type="button" class="btn btn-primary mb-2 btn-sm">Approval Logs</button>
                        </a>
                    </div>
                    <!--tab-content-->

                    <div class="">
                        <div class="row">
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
                            <?php
                            if ($perfomance == null) { ?>
                                <div style="width: 100%; padding: 10%; text-align: center;">
                                    <h3>All Vidoes have been Reviewed</h3>
                                </div>
                                <?php } else {
                                foreach ($perfomance as $perfomance) : ?>
                                    <div class="col-xl-6">
                                        <div class="card-body pt-0">
                                            <div class="post-img mt-3 video">
                                                <video width="100%" style="border-radius: 10px;" controls src="../dbvideos/<?= $perfomance['video_url'] ?>"></video>
                                            </div>
                                            <div class="mt-3 d-flex align-items-center">
                                                <span class="me-2"><?= $perfomance['description'] ?></span>
                                                <span class="badge light badge-primary">Talent Category: <?= getCategoryName($perfomance['talentCategory']); ?> </span>
                                            </div>
                                            <ul class="post-comment d-flex mt-3">
                                                <a href="view-more.php?id=<?= $perfomance['user_id'] ?>">
                                                    <img src="../dbimages/<?= $perfomance['profile_picture'] ?>" class="avatar rounded-circle me-3" alt="">
                                                </a>
                                                <li>
                                                    <div class="d-flex">
                                                        <form action="operations/approve.php" method="post" class="me-2">
                                                            <input type="hidden" name="video_id" value="<?= $perfomance['video_id'] ?>">
                                                            <button type="submit" name="approve" href="#" class="btn btn-secondary btn-sm">Approve</button>
                                                        </form>
                                                        <form action="operations/denyVideo.php" method="post" onsubmit="return(confirm('Are you sure you want to block this video?'))">
                                                            <input type="hidden" name="video_id" value="<?= $perfomance['video_id'] ?>">
                                                            <button type="submit" name="home_deny" class="btn btn-danger btn-sm ms-2">Deny</button>
                                                        </form>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                            <?php endforeach;
                            } ?>
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
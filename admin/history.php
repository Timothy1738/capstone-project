<?php
include "./includes/header.php";
$logs = approvallogs();
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
                            <h4 class="card-title">Video Approval History</h4>
                        </div>
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
                                                <th>Video Owner</th>
                                                <th>Video</th>
                                                <th>Status</th>
                                                <th>Approver</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($logs == null) { ?>
                                                <tr>
                                                    <td colspan="5" style="text-align: center; padding: 10px;">No Video has been approved yet!</td>
                                                </tr>
                                            <?php } else { ?>
                                                <?php
                                                $num = 0;
                                                foreach ($logs as $log) : ?>
                                                    <tr>
                                                        <td><?= $num += 1 ?></td>
                                                        <td><?= $log['firstname'] . ' ' . $log['lastname'] ?></td>
                                                        <td><a href="specific_videoApproval.php?id=<?= $log['video_id'] ?>" class="badge light badge-success">Video</a></td>
                                                        <td><span class="badge light <?php if($log['status'] == "approved") {echo "badge-primary";}else {echo "badge-danger";} ?>"><?= $log['status']?></span></td>
                                                        <td><?= $log['created_by'] ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Video Owner</th>
                                                <th>Video</th>
                                                <th>Status</th>
                                                <th>Approver</th>
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
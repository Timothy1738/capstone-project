<?php
include "./includes/header.php";

$event_subs = eventsubs();
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
                            <h4 class="card-title">News Letter Subscriptions</h4>
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
                                                <th>Sender Email</th>
                                                <th>Sender Contact</th>
                                                <th>About Event</th>
                                                <th>Status</th>
                                                <th>Time Stamp</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($event_subs == null) { ?>
                                                <tr>
                                                    <td style="text-align: center;" colspan="6">No Event subscriptions yet!</td>
                                                </tr>
                                            <?php } else { ?>
                                                <?php
                                                $num = 0;
                                                foreach ($event_subs as $sub) : ?>
                                                    <tr>
                                                        <td><?= $num += 1 ?></td>
                                                        <td><?= $sub['email'] ?></td>
                                                        <td><?= $sub['contact'] ?></td>
                                                        <td><?= breakTextAfterWords($sub['event_info']) ?></td>
                                                        <td>
                                                            <?php if ($sub['status'] == "Mark As Read") { ?>
                                                                <a href="operations/markEventsubAsRead.php?id=<?= $sub['table_id'] ?>" class="badge badge-primary">Mark As Read</a>
                                                            <?php } else { ?>
                                                                <span class="badge badge-success">Read</span>
                                                            <?php } ?>
                                                        </td>
                                                        <td><?= $sub['timestamp'] ?></td>
                                                        <td>
                                                            <div class="d-flex">
                                                                <form action="operations/deleteEventSub.php" onsubmit="return confirm('Are you sure you want to delete this record?')" method="post">
                                                                    <input type="hidden" value="<?= $sub['table_id'] ?>" name="table_id">
                                                                    <button name="delete" class="btn btn-danger shadow sharp btn-xs"><i class="fa fa-trash"></i></button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php } ?>
                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Sender Email</th>
                                                <th>Sender Contact</th>
                                                <th>About Event</th>
                                                <th>Status</th>
                                                <th>Time Stamp</th>
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
    </div>
</div>
<!--**********************************
   Content body end
   ***********************************-->
<?php
include "./includes/footer.php";
?>
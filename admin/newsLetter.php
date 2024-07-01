<?php
include "./includes/header.php";

$messages = newsLettersubs();
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
                                                <th>Email</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($messages == null) { ?>
                                                <tr>
                                                    <td colspan="3" style="text-align: center;">No email subscriptions</td>
                                                </tr>
                                            <?php } else { ?>
                                                <?php
                                                $num = 0;
                                                foreach ($messages as $message) : ?>
                                                    <tr>
                                                        <td><?= $num += 1 ?></td>
                                                        <td><?= $message['email'] ?></td>
                                                        <td>
                                                            <div class="d-flex">
                                                                <form action="operations/deleteSubscription.php" method="post" onsubmit="return confirm('Are you sure you want to delete this record?')">
                                                                    <input type="hidden" value="<?= $message['news_letter_id'] ?>" name="newsLetter_id">
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
                                                <th>Email</th>
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
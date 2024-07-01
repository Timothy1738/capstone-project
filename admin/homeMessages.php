<?php
include "./includes/header.php";

$messages = getMessages();
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
                            <h4 class="card-title">Home Page Messages</h4>
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
                                                <th>Sender</th>
                                                <th>Email</th>
                                                <th>Subject</th>
                                                <th>Message</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($messages == null) { ?>
                                                <tr>
                                                    <td style="text-align: center;" colspan="6">No messages yet!</td>
                                                </tr>
                                            <?php } else { ?>
                                                <?php
                                                $num = 0;
                                                foreach ($messages as $message) : ?>
                                                    <tr>
                                                        <td><?= $num += 1 ?></td>
                                                        <td><?= $message['name'] ?></td>
                                                        <td><?= $message['email'] ?></td>
                                                        <td><?= $message['subject'] ?></td>
                                                        <td><?= $message['message'] ?></td>
                                                        <td>
                                                            <div class="d-flex">
                                                                <form action="operations/deleteMessage.php" method="post" onsubmit="return confirm('Are you sure you want to delete this message')">
                                                                    <input type="hidden" value="<?= $message['contact_id'] ?>" name="message_id">
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
                                                <th>Sender</th>
                                                <th>Email</th>
                                                <th>Subject</th>
                                                <th>Message</th>
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
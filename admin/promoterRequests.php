<?php
include "./includes/header.php";

$promoterRequests = PromoterRequests();
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
                                                <th>Talent Area</th>
                                                <th>Brand Name</th>
                                                <th>Email</th>
                                                <th>Contact</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($promoterRequests == null) { ?>
                                                <tr>
                                                    <td style="text-align: center;" colspan="6">No promoter Requests available yet! come back later</td>
                                                </tr>
                                            <?php } else { ?>
                                                <?php
                                                $num = 0;
                                                foreach ($promoterRequests as $request) : ?>
                                                    <tr>
                                                        <td><?= $num += 1 ?></td>
                                                        <td><?= $request['talent_area'] ?></td>
                                                        <td><?= $request['brand_name'] ?></td>
                                                        <td><?= $request['email'] ?></td>
                                                        <td><?= $request['contact'] ?></td>
                                                        <td>
                                                            <div class="d-flex">
                                                                <form action="operations/deletePromoterRequest.php" method="post" onsubmit="return confirm('Are you sure you want to delete this record?')">
                                                                    <input type="hidden" value="<?= $request['request_id'] ?>" name="id">
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
                                                <th>Talent Area</th>
                                                <th>Brand Name</th>
                                                <th>Email</th>
                                                <th>Contact</th>
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
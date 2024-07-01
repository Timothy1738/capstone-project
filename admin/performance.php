<?php
include "./includes/header.php";
$perfomance = getVideosOrderedByVotes();
// $promoterRequests = PromoterRequests();
$people_ranks = getPeopleOrderedByVotes();
$music_ranks = getMusicCat_orderbyvotes();
$dance_ranks = getDanceCat_orderbyvotes();
$acting_ranks = getTheatreCat_orderbyvotes();
$comdey_ranks = getComedyCat_orderbyvotes();
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
                            <h4 class="card-title">Top Videos & Creators</h4>
                        </div>
                        <!-- Large modal -->
                    </div>
                    <!--tab-content-->

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="DefaultTab" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="card-body pt-0">
                                        <!-- Nav tabs -->
                                        <div class="default-tab">
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-bs-toggle="tab" href="#home">All</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#profile">Music</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#contact">Dance</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#message">Acting</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#comedy">Comedy</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane fade show active" id="home" role="tabpanel">
                                                    <div class="pt-4">
                                                        <div class="tab-content" id="myTabContent">
                                                            <div class="tab-pane fade show active" id="Preview" role="tabpanel" aria-labelledby="home-tab">
                                                                <div class="card-body pt-0">
                                                                    <div class="table-responsive">
                                                                        <!-- id="user-tbl" -->
                                                                        <table class="table shorting">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>S/N</th>
                                                                                    <th>User</th>
                                                                                    <th>Email</th>
                                                                                    <th>Contact</th>
                                                                                    <th>Video</th>
                                                                                    <th>Vote Count</th>
                                                                                    <th>Comment Count</th>
                                                                                    <th>Action</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <?php
                                                                                $num = 0;
                                                                                if ($people_ranks == null) { ?>
                                                                                    <tr>
                                                                                        <td colspan="9" style="text-align: center;">System action null</td>
                                                                                    </tr>
                                                                                    <?php } else {
                                                                                    foreach ($people_ranks as $rank) : ?>
                                                                                        <tr>
                                                                                            <td><?= $num += 1 ?></td>
                                                                                            <td>
                                                                                                <div class="d-flex align-items-center">
                                                                                                    <img src="../dbimages/<?= $rank['profile_picture'] ?>" class="avatar rounded-circle" alt="">
                                                                                                    <p class="mb-0 ms-2"><?= $rank['firstname'] . ' ' . $rank['lastname'] ?></p>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td><?= $rank['email'] ?></td>
                                                                                            <td><?= $rank['contact'] ?></td>
                                                                                            <td>
                                                                                                <a href="view-more.php?id=<?= $rank['user_id'] ?>">
                                                                                                    <span class='badge badge-primary light border-0 me-1'>View Video</span>
                                                                                                </a>
                                                                                            </td>
                                                                                            <td><?= $rank['vote_count'] ?></td>
                                                                                            <td><?= getNumberofComments($rank['video_id']) ?></td>
                                                                                            <td>
                                                                                                <a href="view-more.php?id=<?= $rank['user_id'] ?>"><span class='badge badge-secondary border-0 ms-1'>View User Profile</span></a>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <!-- END OF ROW -->
                                                                                <?php endforeach;
                                                                                }
                                                                                ?>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <!-- /Default accordion -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- END OF ALL -->

                                                <div class="tab-pane fade" id="profile">
                                                    <div class="pt-4">
                                                        <div class="tab-content" id="myTabContent">
                                                            <div class="tab-pane fade show active" id="Preview" role="tabpanel" aria-labelledby="home-tab">
                                                                <div class="card-body pt-0">
                                                                    <div class="table-responsive">
                                                                        <!-- id="user-tbl" -->
                                                                        <table class="table shorting">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>S/N</th>
                                                                                    <th>User</th>
                                                                                    <th>Email</th>
                                                                                    <th>Contact</th>
                                                                                    <th>Video</th>
                                                                                    <th>Vote Count</th>
                                                                                    <th>Comment Count</th>
                                                                                    <th>Action</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <?php
                                                                                $num = 0;
                                                                                if ($music_ranks == null) { ?>
                                                                                    <tr>
                                                                                        <td colspan="9" style="text-align: center;">System action null</td>
                                                                                    </tr>
                                                                                    <?php } else {
                                                                                    foreach ($music_ranks as $rank) : ?>
                                                                                        <tr>
                                                                                            <td><?= $num += 1 ?></td>
                                                                                            <td>
                                                                                                <div class="d-flex align-items-center">
                                                                                                    <img src="../dbimages/<?= $rank['profile_picture'] ?>" class="avatar rounded-circle" alt="">
                                                                                                    <p class="mb-0 ms-2"><?= $rank['firstname'] . ' ' . $rank['lastname'] ?></p>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td><?= $rank['email'] ?></td>
                                                                                            <td><?= $rank['contact'] ?></td>
                                                                                            <td>
                                                                                                <a href="view-more.php?id=<?= $rank['user_id'] ?>">
                                                                                                    <span class='badge badge-primary light border-0 me-1'>View Video</span>
                                                                                                </a>
                                                                                            </td>
                                                                                            <td><?= $rank['vote_count'] ?></td>
                                                                                            <td><?= getNumberofComments($rank['video_id']) ?></td>
                                                                                            <td>
                                                                                                <a href="view-more.php?id=<?= $rank['user_id'] ?>"><span class='badge badge-secondary border-0 ms-1'>View User Profile</span></a>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <!-- END OF ROW -->
                                                                                <?php endforeach;
                                                                                }
                                                                                ?>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <!-- /Default accordion -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- END OF MUSIC -->

                                                <div class="tab-pane fade" id="contact">
                                                    <div class="pt-4">
                                                        <div class="tab-content" id="myTabContent">
                                                            <div class="tab-pane fade show active" id="Preview" role="tabpanel" aria-labelledby="home-tab">
                                                                <div class="card-body pt-0">
                                                                    <div class="table-responsive">
                                                                        <!-- id="user-tbl" -->
                                                                        <table class="table shorting">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>S/N</th>
                                                                                    <th>User</th>
                                                                                    <th>Email</th>
                                                                                    <th>Contact</th>
                                                                                    <th>Video</th>
                                                                                    <th>Vote Count</th>
                                                                                    <th>Comment Count</th>
                                                                                    <th>Action</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <?php
                                                                                $num = 0;
                                                                                if ($dance_ranks == null) { ?>
                                                                                    <tr>
                                                                                        <td colspan="9" style="text-align: center;">System action null</td>
                                                                                    </tr>
                                                                                    <?php } else {
                                                                                    foreach ($dance_ranks as $rank) : ?>
                                                                                        <tr>
                                                                                            <td><?= $num += 1 ?></td>
                                                                                            <td>
                                                                                                <div class="d-flex align-items-center">
                                                                                                    <img src="../dbimages/<?= $rank['profile_picture'] ?>" class="avatar rounded-circle" alt="">
                                                                                                    <p class="mb-0 ms-2"><?= $rank['firstname'] . ' ' . $rank['lastname'] ?></p>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td><?= $rank['email'] ?></td>
                                                                                            <td><?= $rank['contact'] ?></td>
                                                                                            <td>
                                                                                                <a href="view-more.php?id=<?= $rank['user_id'] ?>">
                                                                                                    <span class='badge badge-primary light border-0 me-1'>View Video</span>
                                                                                                </a>
                                                                                            </td>
                                                                                            <td><?= $rank['vote_count'] ?></td>
                                                                                            <td><?= getNumberofComments($rank['video_id']) ?></td>
                                                                                            <td>
                                                                                                <a href="view-more.php?id=<?= $rank['user_id'] ?>"><span class='badge badge-secondary border-0 ms-1'>View User Profile</span></a>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <!-- END OF ROW -->
                                                                                <?php endforeach;
                                                                                }
                                                                                ?>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <!-- /Default accordion -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- END OF DANCE -->


                                                <div class="tab-pane fade" id="message">
                                                    <div class="pt-4">
                                                        <div class="tab-content" id="myTabContent">
                                                            <div class="tab-pane fade show active" id="Preview" role="tabpanel" aria-labelledby="home-tab">
                                                                <div class="card-body pt-0">
                                                                    <div class="table-responsive">
                                                                        <!-- id="user-tbl" -->
                                                                        <table class="table shorting">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>S/N</th>
                                                                                    <th>User</th>
                                                                                    <th>Email</th>
                                                                                    <th>Contact</th>
                                                                                    <th>Video</th>
                                                                                    <th>Vote Count</th>
                                                                                    <th>Comment Count</th>
                                                                                    <th>Action</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <?php
                                                                                $num = 0;
                                                                                if ($acting_ranks == null) { ?>
                                                                                    <tr>
                                                                                        <td colspan="9" style="text-align: center;">System action null</td>
                                                                                    </tr>
                                                                                    <?php } else {
                                                                                    foreach ($acting_ranks as $rank) : ?>
                                                                                        <tr>
                                                                                            <td><?= $num += 1 ?></td>
                                                                                            <td>
                                                                                                <div class="d-flex align-items-center">
                                                                                                    <img src="../dbimages/<?= $rank['profile_picture'] ?>" class="avatar rounded-circle" alt="">
                                                                                                    <p class="mb-0 ms-2"><?= $rank['firstname'] . ' ' . $rank['lastname'] ?></p>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td><?= $rank['email'] ?></td>
                                                                                            <td><?= $rank['contact'] ?></td>
                                                                                            <td>
                                                                                                <a href="view-more.php?id=<?= $rank['user_id'] ?>">
                                                                                                    <span class='badge badge-primary light border-0 me-1'>View Video</span>
                                                                                                </a>
                                                                                            </td>
                                                                                            <td><?= $rank['vote_count'] ?></td>
                                                                                            <td><?= getNumberofComments($rank['video_id']) ?></td>
                                                                                            <td>
                                                                                                <a href="view-more.php?id=<?= $rank['user_id'] ?>"><span class='badge badge-secondary border-0 ms-1'>View User Profile</span></a>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <!-- END OF ROW -->
                                                                                <?php endforeach;
                                                                                }
                                                                                ?>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <!-- /Default accordion -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- END OF ACTING -->

                                                <div class="tab-pane fade" id="comedy">
                                                    <div class="pt-4">
                                                        <div class="tab-content" id="myTabContent">
                                                            <div class="tab-pane fade show active" id="Preview" role="tabpanel" aria-labelledby="home-tab">
                                                                <div class="card-body pt-0">
                                                                    <div class="table-responsive">
                                                                        <!-- id="user-tbl" -->
                                                                        <table class="table shorting">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>S/N</th>
                                                                                    <th>User</th>
                                                                                    <th>Email</th>
                                                                                    <th>Contact</th>
                                                                                    <th>Video</th>
                                                                                    <th>Vote Count</th>
                                                                                    <th>Comment Count</th>
                                                                                    <th>Action</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <?php
                                                                                $num = 0;
                                                                                if ($comdey_ranks == null) { ?>
                                                                                    <tr>
                                                                                        <td colspan="9" style="text-align: center;">System action null</td>
                                                                                    </tr>
                                                                                    <?php } else {
                                                                                    foreach ($comdey_ranks as $rank) : ?>
                                                                                        <tr>
                                                                                            <td><?= $num += 1 ?></td>
                                                                                            <td>
                                                                                                <div class="d-flex align-items-center">
                                                                                                    <img src="../dbimages/<?= $rank['profile_picture'] ?>" class="avatar rounded-circle" alt="">
                                                                                                    <p class="mb-0 ms-2"><?= $rank['firstname'] . ' ' . $rank['lastname'] ?></p>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td><?= $rank['email'] ?></td>
                                                                                            <td><?= $rank['contact'] ?></td>
                                                                                            <td>
                                                                                                <a href="view-more.php?id=<?= $rank['user_id'] ?>">
                                                                                                    <span class='badge badge-primary light border-0 me-1'>View Video</span>
                                                                                                </a>
                                                                                            </td>
                                                                                            <td><?= $rank['vote_count'] ?></td>
                                                                                            <td><?= getNumberofComments($rank['video_id']) ?></td>
                                                                                            <td>
                                                                                                <a href="view-more.php?id=<?= $rank['user_id'] ?>"><span class='badge badge-secondary border-0 ms-1'>View User Profile</span></a>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <!-- END OF ROW -->
                                                                                <?php endforeach;
                                                                                }
                                                                                ?>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <!-- /Default accordion -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- END OF COMEDY -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php foreach ($perfomance as $perfomance) : ?>
                            <div class="col-xl-6">
                                <div class="card-body pt-0">
                                    <div class="post-img mt-3 video">
                                        <video width="100%" style="border-radius: 10px;" controls src="../dbvideos/<?= $perfomance['video_url'] ?>"></video>
                                    </div>
                                    <div class="mt-3">
                                        <span><?= $perfomance['description'] ?></span>
                                    </div>
                                    <ul class="post-comment d-flex mt-3">
                                        <li>
                                            <label class="me-3"><a href="javascript:void(0)"><i class="fa-solid fa-check-to-slot me-2"></i><?= $perfomance['vote_count'] ?> Votes</a></label>
                                        </li>
                                        <li>
                                            <label class="me-3"><a href="javascript:void(0)"><i class="fa-regular fa-message me-2"></i><?= getNumberofComments($perfomance['video_id']) ?> Comments</a></label>
                                        </li>
                                        <li>
                                            <label class="me-3"><a href="view-more.php?id=<?= $perfomance['user_id'] ?>"><i class="fa-solid fa-user me-2"></i>User </a></label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        <?php endforeach ?>
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
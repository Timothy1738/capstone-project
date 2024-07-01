<?php
include "./includes/header.php";

$newUser = $_GET['id'];
$personProfile = getOtherUserProfile($newUser);
$myVideos = getUserVideo($newUser);
$followers = getFollowers($newUser);
$following = getFollowing($newUser);

?>

<div id="profile" class="container">
    <div class="profile-card">
        <div class="cover-img">
            <img src="../dbcoverimages/<?= $personProfile['cover_picture'] ?>" alt="">
        </div>
        <div class="box-profile">
            <div class="card-1">
                <div class="img">
                    <img src="../dbimages/<?= $personProfile['profile_picture'] ?>" alt="">
                </div>
                <div class="box-name">
                    <p><?= $personProfile['firstname'] . ' ' . $personProfile['lastname'] ?></p>
                </div>
                <?php if ($user['category_id'] == "") {
                } else { ?>
                    <div class="talent-box">
                        Talent Category: <?= getCategoryName($personProfile['category_id']) ?>
                    </div>
                <?php } ?>
                <div class="box-stats">
                    <div class="box-stat">
                        <p>Number of Videos</p>
                        <span><?= getNumberOfVideos($newUser) ?></span>
                    </div>
                    <!-- end of box stat -->

                    <div class="box-stat">
                        <p>Followers</p>
                        <span><?= getNumberofFollowers($newUser) ?></span>
                    </div>
                    <!-- end of box stat -->

                    <div class="box-stat">
                        <p>Following</p>
                        <span><?= getNumberofFollowering($newUser) ?></span>
                    </div>
                    <!-- end of box stat -->
                </div>
            </div>
            <div class="card-2">
                <p><strong>Contact:</strong> <span><?= $personProfile['contact'] ?></span></p>
                <p><strong>Email:</strong> <span><?= $personProfile['email'] ?></span></p>
                <?php if ($personProfile['about'] == "") {
                } else {
                ?><div class="about_me">
                        <strong>About Me</strong>
                        <p><?= $personProfile['about'] ?></p>
                    </div>
                    <?php
                        } ?>
            </div>
        </div>
    </div>
    <!-- END OF PROFILE CARD -->

    <div class="profile-content">
        <ul class="tab">
            <li><a href="#" class="active" data-target="my_videos">Videos</a></li>
            <li><a href="#" data-target="followers">Followers</a></li>
            <li><a href="#" data-target="following">Following</a></li>
        </ul>

        <div id="my_videos" class="content active">
            <?php
            if ($myVideos == null) { ?>
                <div class="noVideos">
                    <iconify-icon icon="game-icons:binoculars"></iconify-icon>
                    <p>Nothing to see here! <br><span>You have not uploaded any video yet!</span></p>
                </div>
            <?php } else { ?>
                <div class="video_columns">
                    <?php
                    foreach ($myVideos as $video) : ?>
                        <a href="view-personsVideo.php?id=<?= $video['video_id'] ?>&usid=<?= $video['user_id'] ?>">
                            <div class="video_column">
                                <div class="video_box">
                                    <video controls src="../dbvideos/<?= $video['video_url'] ?>"></video>
                                </div>
                                <div class="title">
                                    <p><?= $video['description'] ?></p>
                                </div>
                            </div>
                        </a>
                        <!--END OF THIS COLUMN-->
                    <?php
                    endforeach;
                    ?>
                </div>
            <?php }
            ?>
        </div>
        <!--end of My vidoes page-->


        <div id="followers" class="content">
            <?php
            if ($followers == null) { ?>
                <div class="noVideos">
                    <iconify-icon icon="game-icons:binoculars"></iconify-icon>
                    <p>Nothing to see here! <br><span>You have no followers</span></p>
                </div>
            <?php } else { ?>
                <div class="follow_box">
                    <?php foreach ($followers as $follower) : ?>
                        <div class="follow_card">
                            <div class="img">
                                <img src="../dbImages/<?= $follower['profile_picture'] ?>" alt="">
                            </div>
                            <div class="name">
                                <?php if ($user['profile_picture'] == $follower['profile_picture']) { ?>
                                    <p>You</p>
                                <?php } else { ?>
                                    <a href="view-other-profile.php?id=<?= $follower['user_id'] ?>"><?= $follower['firstname'] . ' ' . $follower['lastname'] ?></a>
                                <?php } ?>
                            </div>
                        </div>
                        <!-- end of card -->
                    <?php endforeach; ?>
                </div>
            <?php }
            ?>
        </div>
        <!-- END OF FOLLOWERS PAGE-->

        <div id="following" class="content">
            <?php
            if ($following == null) { ?>
                <div class="noVideos">
                    <iconify-icon icon="game-icons:binoculars"></iconify-icon>
                    <p>Nothing to see here! <br><span>No one is following you</span></p>
                </div>
            <?php } else { ?>
                <div class="follow_box">
                    <?php foreach ($following as $following) : ?>
                        <div class="follow_card">
                            <div class="img">
                                <img src="../dbImages/<?= $following['profile_picture'] ?>" alt="">
                            </div>
                            <div class="name">
                                <?php if ($user['profile_picture'] == $following['profile_picture']) { ?>
                                    <p>You</p>
                                <?php } else { ?>
                                    <a href="view-other-profile.php?id=<?= $following['user_id'] ?>"><?= $following['firstname'] . ' ' . $following['lastname'] ?></a>
                                <?php } ?>
                            </div>
                        </div>
                        <!-- end of card -->
                    <?php endforeach; ?>
                </div>
            <?php }
            ?>
        </div>
        <!-- END OF FOLLOWING PAGE -->
    </div>
</div>
</div>
<!-- local js -->
<?php include "./includes/footer.php"; ?>
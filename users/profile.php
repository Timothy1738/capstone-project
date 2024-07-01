<?php
include "./includes/header.php";
$myVideos = getUserVideo($user_id);

$followers = getFollowers($user_id);
$following = getFollowing($user_id);

$votedVideos = getLikedVideosByUser($user_id);

$performance = myMostVotedVideo($user_id);

$comments_perfomance = myMostCommentedVideo($user_id);

$position = getUserMostVotedVideoPosition($user_id);
?>
<!-- END OF THIS PAGE NAVBAR -->
<?php if (isset($_GET['error'])) { ?>
    <div class="error">
        <?php echo htmlspecialchars($_GET['error']) ?>
    </div>
<?php }
if (isset($_GET['success'])) { ?>
    <div class="success"><?php echo htmlspecialchars($_GET['success']) ?></div>
<?php } ?>
<div id="profile" class="container">
    <div class="profile-card">
        <div class="cover-img">
            <img src="../dbcoverimages/<?= $user['cover_picture'] ?>" alt="">
        </div>
        <div class="box-profile">
            <div class="card-1">
                <div class="img">
                    <img src="../dbimages/<?= $user['profile_picture'] ?>" alt="">
                </div>
                <div class="box-name">
                    <p><?= $user['firstname'] . ' ' . $user['lastname'] ?></p>
                </div>

                <?php if ($user['category_id'] == "") {
                } else { ?>
                    <div class="talent-box">
                        Talent Category: <?= getCategoryName($user['category_id']) ?>
                    </div>
                <?php } ?>
                <div class="box-stats">
                    <div class="box-stat">
                        <span><?php echo getNumberOfVideos($user_id) ?></span>
                        <p>Number of Videos</p>
                    </div>
                    <!-- end of box stat -->

                    <div class="box-stat">
                        <span><?php echo getNumberofFollowers($user_id) ?></span>
                        <p>Followers</p>
                    </div>
                    <!-- end of box stat -->

                    <div class="box-stat">
                        <span><?php echo getNumberofFollowering($user_id) ?></span>
                        <p>Following</p>
                    </div>
                    <!-- end of box stat -->
                </div>
            </div>
            <!-- end of this card-->

            <div class="card-2">
                <p><strong>Contact:</strong> <span><?= $user['contact'] ?></span></p>
                <p><strong>Email:</strong> <span><?= $user['email'] ?></span></p>
                <div class="about_me">
                    <strong>About Me</strong>
                    <p><?php if($user['about'] == "") {echo "#";}else {echo $user['about'];} ?></p>
                </div>
            </div>
        </div>
    </div>
    <!-- END OF PROFILE CARD -->

    <div class="profile-content">
        <ul class="tab">
            <li><a href="#" class="active" data-target="my_videos">My Videos</a></li>
            <li><a href="#" data-target="followers">Followers</a></li>
            <li><a href="#" data-target="following">Following</a></li>
            <li><a href="#" data-target="votes">My Votes</a></li>
            <li><a href="#" data-target="performance">Performance</a></li>
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
                        <a href="view-video.php?id=<?= $video['video_id'] ?>">
                            <div class="video_column">
                                <div class="video_box">
                                    <video controls src="../dbvideos/<?= $video['video_url'] ?>"></video>
                                </div>
                                <div class="title">
                                    <p><?= $video['description'] ?></p>
                                    <hr>

                                    <div>Review status: <?php if ($video['status'] == "pending") { ?><span class="pending">Pending</span><?php } else { ?><span class="active">Approved</span><?php } ?></div>
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

        <div id="votes" class="content">
            <h3>You Voted for these Videos!</h3>
            <?php if ($votedVideos == null) { ?>
                <div class="noVideos">
                    <iconify-icon icon="game-icons:binoculars"></iconify-icon>
                    <p>Yikes!<br>You Have not voted on any video yet!<span> <a href="home.php">Click Here to get started</a></span></p>
                </div>
            <?php } else { ?>
                <div class="video_columns">
                    <?php foreach ($votedVideos as $votes) : ?>
                        <a href="view-personsVideo.php?id=<?= $votes['video_id'] ?>&usid=<?= $votes['user_id'] ?>">
                            <div class="video_column">
                                <div class="video_box">
                                    <video controls src="../dbvideos/<?= $votes['video_url'] ?>"></video>
                                </div>
                                <div class="title">
                                    <p><?= $votes['description'] ?></p>
                                </div>
                            </div>
                        </a>
                        <!--END OF THIS COLUMN-->
                    <?php endforeach ?>
                </div>
            <?php } ?>
        </div>
        <!--VIDEOS PERSON VOTED FOR-->

        <div id="performance" class="content">
            <div class="performance_cards">
                <div class="card">
                    <p>My Most Voted Video</p>
                    <?php if ($performance == null) {
                        echo "<span>No Votes Yet</span>";
                    } else { ?>
                        <?php if ($performance['vote_count'] == 0) { ?>
                            <span>No Votes Yet</span>
                        <?php } else { ?>
                            <span>
                                <?php echo $performance['vote_count'] . ' ' . 'Votes' ?>
                            </span>
                            <a href="view-video.php?id=<?= $performance['video_id'] ?>">Click Here To View</a>
                        <?php } ?>
                    <?php } ?>
                </div>
                <!-- end of card -->

                <div class="card">
                    <p>My most commented on Video</p>
                    <?php
                    if ($comments_perfomance !== null) {
                        if ($comments_perfomance['comment_count'] == 0) {
                            echo '<span>No Comments Yet</span>';
                        } else { ?>
                            <span><?= $comments_perfomance['comment_count'] ?> Comments</span>
                            <a href="view-video.php?id=<?= $comments_perfomance['video_id'] ?>">Click Here to View</a>
                        <?php }
                        ?>
                    <?php } else {
                    ?>
                        <span>No Comments Yet</span>
                    <?php
                    }
                    ?>
                </div>
                <!-- end of card -->

                <div class="card">
                    <p>My Ranking</p>
                    <span><?php if ($position !== null) {
                                if ($position == 1) {
                                    echo "1st";
                                } elseif ($position == 2) {
                                    echo "2nd";
                                } elseif ($position == 3) {
                                    echo "3rd";
                                } else {
                                    echo $position . 'th';
                                }
                            } else {
                                echo "No Rank";
                            } ?>
                    </span>
                </div>
                <!-- end of card -->
            </div>
        </div>
    </div>
</div>
</div>
<?php include "./includes/footer.php"; ?>
<?php
include "./includes/header.php";
if ($_SESSION['status'] == "invalid") {
    header("location: ../redirect.php");
    exit();
}

$videos = getVideos($user_id);
?>
<!-- splash -->
<div class="splash">
    <div class="container">
        <div class="spash_content">
            <h1>May Intake - Lets Get Uploading</h1>
        </div>
    </div>
</div>
<!-- splash -->

<div class="talent-content container">
    <div class="search-bar">
        <form action="search.php" method="get">
            <input type="text" name="search" placeholder="Search" id="">
            <button type="submit"><iconify-icon icon="bi:search"></iconify-icon></button>
        </form>
    </div>

    <div class="videos">
        <?php
        if (isset($_GET['error'])) { ?>
            <div class="error"><?php echo htmlspecialchars($_GET['error']) ?></div>
        <?php }
        if (isset($_GET['success'])) {
        ?>
            <div class="success"><?php echo htmlspecialchars($_GET['success']) ?></div>
        <?php
        }
        foreach ($videos as $video) {
            $video_id = $video['video_id'];
            $comments = getComments($video_id);
        ?>
            <div class="video-block">
                <div class="video-placeholder">
                    <div class="video-play">
                        <video class="video-element" controls src="../dbvideos/<?= $video['video_url'] ?>"></video>
                    </div>
                    <div class="comments">
                        <h3>Comments</h3>
                        <div class="comment-container">
                            <div class="comments-box" id="commentsBox">
                                <?php if ($comments == null) { ?>
                                    <div class="noComments">
                                        <p>No comments yet!</p>
                                    </div>
                                    <!--CLASS YOU-->
                                    <?php } else {
                                    foreach ($comments as $comment) {
                                        $userClass = $comment['user_id'];
                                        if ($userClass == $user_id) { ?>
                                            <div class="you">
                                                <div class="you_profile">
                                                    <div class="you_img">
                                                        <img src="../dbimages/<?= $comment['profile_picture'] ?>" alt="">
                                                    </div>
                                                    <div class="you_name">
                                                        <p><a href="#">You</a></p>
                                                    </div>
                                                </div>
                                                <div class="you_comment">
                                                    <p><?= $comment['content'] ?></p>
                                                </div>
                                                <div class="delete">
                                                    <form action="../backend/deletecommentHome.php" method="post" onsubmit="return(confirm('Are you sure you want to delete this message?'))">
                                                        <input type="hidden" name="comment_id" value="<?= $comment['comment_id'] ?>">
                                                        <input type="hidden" name="video_id" value="<?= $comment['video_id'] ?>">
                                                        <button type="submit"><iconify-icon icon="fluent:delete-32-regular"></iconify-icon></button>
                                                    </form>
                                                </div>
                                            </div>
                                            <!--CLASS YOU-->
                                        <?php } else { ?>
                                            <div class="others">
                                                <div class="others_profile">
                                                    <div class="img">
                                                        <img src="../dbimages/<?= $comment['profile_picture'] ?>" alt="">
                                                    </div>
                                                    <div class="others_name">
                                                        <p><a href="view-other-profile.php?id=<?= $comment['user_id'] ?>"><?= $comment['firstname'] . ' ' . $comment['lastname'] ?></a></p>
                                                    </div>
                                                </div>
                                                <div class="others_comment">
                                                    <p><?= $comment['content'] ?></p>
                                                </div>
                                            </div>
                                            <!--CLASS OTHERS-->
                                        <?php }
                                        ?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                            <form action="../backend/insertCommentHome.php" method="post">
                                <div class="comment-input">
                                    <input type="text" id="commentInput" name="comment" placeholder="Add a comment...">
                                    <input type="hidden" name="video_id" value="<?= $video['video_id'] ?>">
                                    <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                                    <button type="submit">Send <iconify-icon icon="iconamoon:send-bold"></iconify-icon></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="actions">
                        <div class="icon">
                            <?php
                            $video_id = $video['video_id'];
                            if (checkIfUserVoted($user_id, $video_id)) { ?>
                                <form action="../backend/deleteVote.php" method="post" onsubmit="return(confirm('Are you sure you want to change your vote?'))">
                                    <input type="hidden" name="video_id" value="<?= $video['video_id'] ?>">
                                    <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                                    <button type="submit" class="box"><iconify-icon icon="fluent:vote-24-regular"></iconify-icon></button>
                                </form>
                            <?php } else {
                            ?>
                                <form action="../backend/vote-video.php" method="post">
                                    <input type="hidden" name="video_id" value="<?= $video['video_id'] ?>">
                                    <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                                    <button type="submit" class="voted">
                                        <iconify-icon icon="fluent:vote-24-regular"></iconify-icon>
                                    </button>
                                </form>
                            <?php
                            } ?>
                            <span><?php echo getNumberofVotes($video_id) ?></span>
                        </div>

                        <div class="icon">
                            <div class="box">
                                <iconify-icon icon="majesticons:share"></iconify-icon>
                            </div>
                        </div>
                        <div class="icon">
                            <a href="../dbvideos/<?= $video['video_url'] ?>" download>
                                <div class="box">
                                    <iconify-icon icon="material-symbols:download"></iconify-icon>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!--NED OF VIDEO PLACE HOLDER -->

                <div class="bottom-elements">
                    <div class="flex-column">
                        <div class="vid-info">
                            <a href="view-other-profile.php?id=<?= $video['user_id'] ?>">
                                <div class="img">
                                    <img src="../dbimages/<?= $video['profile_picture'] ?>" alt="">

                                </div>
                            </a>
                            <div class="name">
                                <p><?= $video['name'] ?></p>
                            </div>
                        </div>
                        <?php
                        // Example usage
                        $follower_id = $user['user_id']; // Replace with actual follower_id
                        $followee_id = $video['user_id']; // Replace with actual followee_id

                        if (checkIfUserFollows($follower_id, $followee_id)) { ?>
                            <div class="red">
                                <form action="../backend/unfollow.php" method="post" onsubmit="return(confirm('Are you sure you want to unfollow this user!'))">
                                    <input type="hidden" name="follower_id" value="<?= $user['user_id'] ?>">
                                    <input type="hidden" name="followee_id" value="<?= $video['user_id'] ?>">
                                    <button type="submit" name="homeunfollow">Following</button>
                                </form>
                            </div>
                        <?php
                        } else { ?>
                            <div class="follow">
                                <form action="../backend/follow.php" method="post">
                                    <input type="hidden" name="follower_id" value="<?= $user['user_id'] ?>">
                                    <input type="hidden" name="followee_id" value="<?= $video['user_id'] ?>">
                                    <button type="submit" name="homefollow">Follow</button>
                                </form>
                            </div>
                        <?php }
                        ?>
                    </div>
                    <hr>
                    <div class="title">
                        <p><?= $video['description'] ?></p>
                    </div>
                </div>
            </div>
            <!--END OF THIS VIDEO-->
        <?php }
        ?>
    </div>
</div>
</div>
<!-- local js -->
<?php include "./includes/footer.php"; ?>
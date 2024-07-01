<?php
include "./includes/header.php";

$video_id = $_GET['id'];

$myVideos = getSpecificVideo($user_id, $video_id);

$comments = getComments($video_id);

?>

<div class="myVideosSplash">
    <h1>My Videos</h1>
</div>
<!-- page splash -->

<div class="cover_class container">
    <?php
    if (isset($_GET['error'])) { ?>
        <div class="error">
            <?php echo htmlspecialchars($_GET['error']) ?>
        </div>
    <?php }
    if (isset($_GET['success'])) { ?>
        <div class="success"><?php echo htmlspecialchars($_GET['success']) ?></div>
    <?php }

    if ($myVideos == null) { ?>
        <div class="noVideos">
            <iconify-icon icon="game-icons:binoculars"></iconify-icon>
            <p>Nothing to see here! <br><span>You have not uploaded any video yet!</span></p>
        </div>
    <?php } else { ?>
        <div class="video-block">
            <div class="video-placeholder">
                <div class="video-play">
                    <video class="video-element" controls src="../dbvideos/<?php echo $myVideos['video_url'] ?>"></video>
                </div>
                <!-- video placeholder -->
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
                                                    <p><a href="profile.php"><?= $comment['firstname'] . ' ' . $comment['lastname'] ?></a></p>
                                                </div>
                                            </div>
                                            <div class="you_comment">
                                                <p><?= $comment['content'] ?></p>
                                            </div>
                                            <div class="delete">
                                                <form action="../backend/deletecomment.php" method="post" onsubmit="return(confirm('Are you sure you want to delete this message?'))">
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
                                                    <p><a href="view-other-profile.php?userid=<?= $comment['user_id'] ?>"><?= $comment['firstname'] . ' ' . $comment['lastname'] ?></a></p>
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
                        <form action="../backend/insertComment.php" method="post">
                            <div class="comment-input">

                                <input type="text" id="commentInput" name="comment" placeholder="Add a comment...">
                                <input type="hidden" name="video_id" value="<?= $myVideos['video_id'] ?>">
                                <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                                <button type="submit">Send <iconify-icon icon="iconamoon:send-bold"></iconify-icon></button>

                            </div>
                        </form>
                    </div>
                </div>
                <!-- end of comments section -->

                <div class="actions">
                    <div class="icon">
                        <?php
                        if (checkIfUserVoted($user_id, $myVideos['video_id'])) { ?>
                            <div class="justVoted"><iconify-icon icon="fluent:vote-24-regular"></iconify-icon></div>
                        <?php } else {
                        ?>
                            <form action="../backend/voteMyVideo.php" method="post">
                                <input type="hidden" name="video_id" value="<?= $myVideos['video_id'] ?>">
                                <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                                <button type="submit" class="voted">
                                    <iconify-icon icon="fluent:vote-24-regular"></iconify-icon>
                                </button>
                            </form>
                        <?php
                        } ?>
                        <span><?= getNumberofVotes($myVideos['video_id']) ?></span>
                    </div>
                    <div class="icon">
                        <div class="box">
                            <iconify-icon icon="majesticons:share"></iconify-icon>
                        </div>
                    </div>
                    <div class="icon">
                        <a href="../dbvideos/<?= $myVideos['video_url'] ?>" download>
                            <div class="box">
                                <iconify-icon icon="material-symbols:download"></iconify-icon>
                            </div>
                        </a>
                    </div>
                    <div class="icon">
                        <form action="../backend/deletevideo.php" method="post" onsubmit="return(confirm('Are you sure you want to delete this video?'))">
                            <input type="hidden" name="video_id" value="<?= $myVideos['video_id'] ?>">
                            <button class="box">
                                <iconify-icon icon="fluent:delete-32-regular"></iconify-icon>
                            </button>
                        </form>
                    </div>
                </div>
                <!-- end of share, download, see votes, delete -->

                <!-- change visibility -->
            </div>
            <!--END OF VIDEO PLACE HOLDER -->

            <div class="bottom-elements">
                <div class="title">
                    <p><?= $myVideos['description'] ?></p>
                </div>
            </div>
        </div>
    <?php } ?>
    <!--END OF THIS VIDEO-->
</div>
</div>
<!-- local js -->
<?php include "./includes/footer.php"; ?>
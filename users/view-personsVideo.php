<?php
include "./includes/header.php";

$video_id = $_GET['id'];

$newuser = $_GET['usid'];


$myVideos = getSpecificVideo($newuser, $video_id);

$comments = getComments($video_id);

?>

<div class="myVideosSplash">
    <h1>Follow, Vote & Comment!</h1>
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
                                                <form action="../backend/deletecommentPersons.php" method="post" onsubmit="return(confirm('Are you sure you want to delete this message?'))">
                                                    <input type="hidden" name="comment_id" value="<?= $comment['comment_id'] ?>">
                                                    <input type="hidden" name="video_id" value="<?= $comment['video_id'] ?>">
                                                    <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                                                    <input type="hidden" name="person_id" value="<?= $newuser ?>">
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
                        <form action="../backend/insertCommentPersons.php" method="post">
                            <div class="comment-input">
                                <input type="text" id="commentInput" name="comment" placeholder="Add a comment...">
                                <input type="hidden" name="video_id" value="<?= $myVideos['video_id'] ?>">
                                <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                                <input type="hidden" name="person_id" value="<?= $newuser ?>">
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
                                <input type="hidden" name="person_id" value="<?= $newuser ?>">
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
                            <div class="box" style="background-color: var(--color_purple);">
                                <iconify-icon icon="material-symbols:download"></iconify-icon>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- end of share, download, see votes, delete -->

                <!-- change visibility -->
            </div>
            <!--END OF VIDEO PLACE HOLDER -->

            <div class="bottom-elements">
                <div class="flex-column">
                    <div class="vid-info">
                        <div class="img">
                            <img src="../dbimages/<?= $myVideos['profile_picture'] ?>" alt="">

                        </div>
                        <div class="name">
                            <p><?= $myVideos['firstname'] . ' ' . $myVideos['lastname'] ?></p>
                        </div>
                    </div>
                    <?php
                    // Example usage
                    $follower_id = $user['user_id']; // Replace with actual follower_id
                    $followee_id = $myVideos['user_id']; // Replace with actual followee_id

                    if (checkIfUserFollows($follower_id, $followee_id)) { ?>
                        <div class="red">
                            <form action="../backend/unfollow.php" method="post" onsubmit="return(confirm('Are you sure you want to unfollow this user!'))">
                                <input type="hidden" name="follower_id" value="<?= $user['user_id'] ?>">
                                <input type="hidden" name="followee_id" value="<?= $myVideos['user_id'] ?>">
                                <input type="hidden" name="video_id" value="<?= $myVideos['video_id'] ?>">
                                <button type="submit" name="unfollow">Following</button>
                            </form>
                        </div>
                    <?php
                    } else { ?>
                        <div class="follow">
                            <form action="../backend/follow.php" method="post">
                                <input type="hidden" name="follower_id" value="<?= $user['user_id'] ?>">
                                <input type="hidden" name="followee_id" value="<?= $myVideos['user_id'] ?>">
                                <input type="hidden" name="video_id" value="<?= $myVideos['video_id'] ?>">
                                <button type="submit" name="follow">Follow</button>
                            </form>
                        </div>
                    <?php }
                    ?>
                </div>
                <hr>
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
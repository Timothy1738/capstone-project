<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location: logout.php");
}

require_once "../backend/functions.php";
$user_id = $_SESSION['user_id'];
$user = get_user($user_id);

$videos = getVideos();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- LOCAL CSS -->
    <link rel="stylesheet" href="../css/styles.css">
    <title>Home | TalentVerse</title>
</head>

<body>
    <div class="main_class">
        <div class="navbar">
            <div class="container">
                <div class="logo">
                    <h1>TalentVerse</h1>
                </div>
                <div class="action-links">
                    <a href="uploadvideo.php">
                        <div class="uploadvideo">
                            <iconify-icon icon="mage:video-upload-fill"></iconify-icon>
                            <p>Upload</p>
                        </div>
                    </a>
                    <!-- end of this section -->
                    <a href="events.php">
                        <div class="events">
                            <iconify-icon icon="simple-line-icons:calender"></iconify-icon>
                            <p>Events</p>
                        </div>
                    </a>
                    <!-- end of this section -->

                    <div class="theme">
                        <img src="../images/dark theme icon/sun.png" alt="">
                        <p>Dark Mode</p>
                    </div>
                    <!-- end of this section -->

                    <div class="notifications">
                        <iconify-icon icon="oui:bell"></iconify-icon>
                        <div class="notification_count">
                            16
                        </div>
                        <p>Notifications</p>
                    </div>
                    <!-- end of this section -->

                    <div class="profile">
                        <div class="img profileImg">
                            <img src="../dbimages/<?= $user['profile_picture'] ?>" alt="">
                        </div>
                        <p>Me<iconify-icon icon="mingcute:down-line"></iconify-icon></p>
                    </div>
                    <!-- end of this section -->

                    <div class="hover-box" id="hoverBox">
                        <ul class="links">
                            <li><a href="profile.php"><iconify-icon icon="iconoir:profile-circle"></iconify-icon> Profile</a></li>
                            <li><a href="messages.php"><iconify-icon icon="tabler:message-2"></iconify-icon>Messages</a></li>
                            <li><a href="settings.php"><iconify-icon icon="ic:baseline-settings"></iconify-icon>Settings</li></a>
                        </ul>
                        <hr>
                        <ul class="logout">
                            <li><a href="logout.php"><iconify-icon icon="ic:baseline-logout"></iconify-icon> Log out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OF THIS PAGE NAVBAR -->


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
                <form action="">
                    <input type="text" name="search" placeholder="Search" id="">
                    <button type="submit"><iconify-icon icon="bi:search"></iconify-icon></button>
                </form>
            </div>

            <div class="videos">
                <?php
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
                                                        <div class="delete">
                                                            <form action="../backend/deletecomment.php" method="post" onsubmit="return(confirm('Are you sure you want to delete this message?'))">
                                                                <input type="hidden" name="comment_id" value="<?= $comment['comment_id'] ?>">
                                                                <input type="hidden" name="video_id" value="<?= $comment['video_id'] ?>">
                                                                <button type="submit"><iconify-icon icon="fluent:delete-32-regular"></iconify-icon></button>
                                                            </form>
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
                                            <input type="hidden" name="video_id" value="<?= $video['video_id'] ?>">
                                            <input type="hidden" name="user_id" value="<?= $comment['user_id'] ?>">
                                            <button type="submit">Send <iconify-icon icon="iconamoon:send-bold"></iconify-icon></button>

                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="actions">
                                <div class="icon">
                                    <div class="box">
                                        <iconify-icon icon="fluent:vote-24-regular"></iconify-icon>
                                    </div>
                                    <span>10k</span>
                                </div>
                                <div class="icon">
                                    <div class="box">
                                        <iconify-icon icon="majesticons:share"></iconify-icon>
                                    </div>
                                    <span>30k</span>
                                </div>
                                <div class="icon">
                                    <div class="box">
                                        <iconify-icon icon="material-symbols:download"></iconify-icon>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--NED OF VIDEO PLACE HOLDER -->

                        <div class="bottom-elements">
                            <div class="flex-column">
                                <div class="vid-info">
                                    <div class="img">
                                        <img src="../dbimages/<?= $video['profile_picture'] ?>" alt="">

                                    </div>
                                    <div class="name">
                                        <p><?= $video['firstname'] . ' ' . $video['lastname'] ?></p>
                                    </div>
                                </div>
                                <div class="follow">
                                    <button>Follow</button>
                                </div>
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
    <script defer src="../js/main.js"></script>

    <!-- SCROLL BACK TO TOP -->
    <button class="scroll-to-top"><iconify-icon icon="fluent-mdl2:up"></iconify-icon></button>

    <!--ICONIFY JS-->
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</body>

</html>
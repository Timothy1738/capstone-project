<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location: logout.php");
}
require_once "../backend/functions.php";
$user_id = $_SESSION['user_id'];
$user = get_user($user_id);
$myVideos = getUserVideo($user_id);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | TalentVerse</title>
    <!-- LOCAL CSS -->
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <div class="main_class">
        <div class="navbar">
            <div class="container">
                <a href="home.php">
                    <div class="logo">
                        <h1>TalentVerse</h1>
                    </div>
                </a>
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

        <div id="profile" class="container">
            <div class="profile-card">
                <div class="cover-img">
                    <img src="../dbcoverimages/<?= $user['cover_picture'] ?>" alt="">
                </div>
                <div class="box-profile">
                    <div class="img">
                        <img src="../dbimages/<?= $user['profile_picture'] ?>" alt="">
                    </div>
                    <div class="box-name">
                        <p><?= $user['firstname'] . ' ' . $user['lastname'] ?></p>
                    </div>
                    <div class="box-stats">
                        <div class="box-stat">
                            <span>2</span>
                            <p>Number of Videos</p>
                        </div>
                        <!-- end of box stat -->

                        <div class="box-stat">
                            <span>2</span>
                            <p>Followers</p>
                        </div>
                        <!-- end of box stat -->

                        <div class="box-stat">
                            <span>2</span>
                            <p>Following</p>
                        </div>
                        <!-- end of box stat -->
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
                    <li><a href="#">Performance</a></li>
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
                            foreach($myVideos as $video) :?>
                            <a href="view-video.php?id=<?= $video['video_id']?>">
                                <div class="video_column">
                                    <div class="video_box">
                                        <video controls src="../dbvideos/<?= $video['video_url']?>"></video>
                                    </div>
                                    <div class="title">
                                        <p><?= $video['description']?></p>
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
                    <div class="follow_box">
                        <div class="follow_card">
                            <div class="img">
                                <img src="../test_images/testimonial-2.jpg" alt="">
                            </div>
                            <div class="name">
                                <a href="view-other-profile.php">Roscoe jaja</a>
                            </div>
                        </div>
                        <!-- end of card -->

                        <div class="follow_card">
                            <div class="img">
                                <img src="../test_images/testimonial-2.jpg" alt="">
                            </div>
                            <div class="name">
                                <a href="view-other-profile.php">Roscoe jaja</a>
                            </div>
                        </div>
                        <!-- end of card -->

                        <div class="follow_card">
                            <div class="img">
                                <img src="../test_images/testimonial-2.jpg" alt="">
                            </div>
                            <div class="name">
                                <a href="view-other-profile.php">Roscoe jaja</a>
                            </div>
                        </div>
                        <!-- end of card -->

                        <div class="follow_card">
                            <div class="img">
                                <img src="../test_images/testimonial-2.jpg" alt="">
                            </div>
                            <div class="name">
                                <a href="view-other-profile.php">Roscoe jaja</a>
                            </div>
                        </div>
                        <!-- end of card -->

                        <div class="follow_card">
                            <div class="img">
                                <img src="../test_images/testimonial-2.jpg" alt="">
                            </div>
                            <div class="name">
                                <a href="view-other-profile.php">Roscoe jaja</a>
                            </div>
                        </div>
                        <!-- end of card -->

                        <div class="follow_card">
                            <div class="img">
                                <img src="../test_images/testimonial-2.jpg" alt="">
                            </div>
                            <div class="name">
                                <a href="view-other-profile.php">Roscoe jaja</a>
                            </div>
                        </div>
                        <!-- end of card -->
                    </div>
                </div>
                <!-- END OF FOLLOWERS PAGE-->

                <div id="following" class="content">
                    <div class="follow_box">
                        <div class="follow_card">
                            <div class="img">
                                <img src="../test_images/testimonial-2.jpg" alt="">
                            </div>
                            <div class="name">
                                <a href="#">achor boy baba</a>
                            </div>
                        </div>
                        <!-- end of following box -->

                        <div class="follow_card">
                            <div class="img">
                                <img src="../test_images/testimonial-2.jpg" alt="">
                            </div>
                            <div class="name">
                                <a href="#">achor boy baba</a>
                            </div>
                        </div>
                        <!-- end of following box -->

                        <div class="follow_card">
                            <div class="img">
                                <img src="../test_images/testimonial-2.jpg" alt="">
                            </div>
                            <div class="name">
                                <a href="#">achor boy baba</a>
                            </div>
                        </div>
                        <!-- end of following box -->

                        <div class="follow_card">
                            <div class="img">
                                <img src="../test_images/testimonial-2.jpg" alt="">
                            </div>
                            <div class="name">
                                <a href="#">achor boy baba</a>
                            </div>
                        </div>
                        <!-- end of following box -->

                        <div class="follow_card">
                            <div class="img">
                                <img src="../test_images/testimonial-2.jpg" alt="">
                            </div>
                            <div class="name">
                                <a href="#">achor boy baba</a>
                            </div>
                        </div>
                        <!-- end of following box -->
                    </div>
                </div>
                <!-- END OF FOLLOWING PAGE -->

                <div id="votes" class="content">
                    <h3>You Voted for these Videos!</h3>
                    <div class="video_columns">
                        <a href="view-video.php">
                            <div class="video_column">
                                <div class="video_box">
                                    <video controls src=""></video>
                                </div>
                                <div class="title">
                                    <p>Ben White Padibe Moscow</p>
                                </div>
                            </div>
                        </a>
                        <!--END OF THIS COLUMN-->

                        <a href="#">
                            <div class="video_column">
                                <div class="video_box">
                                    <video controls src=""></video>
                                </div>
                                <div class="title">
                                    <p>Ben White Padibe Moscow</p>
                                </div>
                            </div>
                        </a>
                        <!--END OF THIS COLUMN-->

                        <a href="#">
                            <div class="video_column">
                                <div class="video_box">
                                    <video controls src=""></video>
                                </div>
                                <div class="title">
                                    <p>Ben White Padibe Moscow</p>
                                </div>
                            </div>
                        </a>
                        <!--END OF THIS COLUMN-->
                    </div>
                </div>
                <!--VIDEOS PERSON VOTED FOR-->
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
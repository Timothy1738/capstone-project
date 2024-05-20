<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    header("location: logout.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages | TalentVerse</title>
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
                            <img src="../test_images/team-3.jpg" alt="">
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
    </div>
    <!-- local js -->
    <script defer src="../js/main.js"></script>

    <!-- SCROLL BACK TO TOP -->
    <button class="scroll-to-top"><iconify-icon icon="fluent-mdl2:up"></iconify-icon></button>

    <!--ICONIFY JS-->
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</body>

</html>
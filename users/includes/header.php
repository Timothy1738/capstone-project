<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: logout.php");
    exit;
}
require_once "../backend/functions.php";
$user_id = $_SESSION['user_id'];
$user = get_user($user_id);
$myNotifications = getAllNotifications($user_id);
$readNotifications = getAllReadNotifications($user_id);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- LOCAL CSS -->
    <link rel="stylesheet" href="../css/styles.css">
    <title>Home | TalentVerse</title>

    <!--GOOGLE ICONS-->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"
    />
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

                    <div class="theme" id="theme">
                        <img src="../images/dark theme icon/sun.png" alt="Toggle Theme">
                        <p>Dark Mode</p>
                    </div>


                    <div class="notifications">
                        <iconify-icon icon="oui:bell"></iconify-icon>
                        <div class="notification_count">
                            <?= countUnreadNotifications($user_id) ?>
                        </div>
                        <p>Notifications</p>
                    </div>
                    <!-- end of this section -->

                    <div class="notifications-box">
                        <div class="flex-notifications">
                            <p>Notifications</p>
                        </div>

                        <ul class="notificationsTab">
                            <li><a href="#" class="active" data-target="newnotify">New Notifications</a></li>
                            <li><a href="#" data-target="oldnotify">Read Notifications</a></li>
                        </ul>

                        <div id="newnotify" class="content active">
                            <div class="new-box">
                                <?php if ($myNotifications == null) { ?>
                                    <div class="notify" style="margin-top: 20px;">
                                        <p style="text-align: center;">You have no new notifications!</p>
                                    </div>
                                <?php } else { ?><button id="markAllAsRead">Mark all as read</button><?php
                                        foreach ($myNotifications as $notification) : ?>
                                        <div class="notify" data-id="<?= $notification['notification_id'] ?>">
                                            <p><?= $notification['message'] ?></p>
                                            <div class="close-icon">
                                                <iconify-icon icon="carbon:close-outline"></iconify-icon>
                                            </div>
                                        </div>
                                <?php endforeach; } ?>
                            </div>
                        </div>

                        <div id="oldnotify" class="content">
                            <div class="old-box">
                                <?php if ($readNotifications == null) { ?>
                                    <div class="notify">
                                        <p>You have no unread notifications!</p>
                                    </div>
                                <?php } else { ?><button>Clear Notifications</button><?php
                                        foreach ($readNotifications as $notification) : ?>
                                        <div class="notify">
                                            <p><?= $notification['message'] ?></p>
                                            <div class="close-icon">
                                                <iconify-icon icon="fluent:delete-32-regular"></iconify-icon>
                                            </div>
                                        </div>
                                <?php endforeach; } ?>
                            </div>
                        </div>

                    </div>

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
                            <li><a href="support.php"><iconify-icon icon="streamline:customer-support-1"></iconify-icon> Support</a></li>
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
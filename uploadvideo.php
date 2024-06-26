<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location: logout.php");
}

require_once "../backend/functions.php";

$user_id = $_SESSION['user_id'];
$user = get_user($user_id);

if ($user['creator_status'] == 'community') {
    header("location: ./creator.php");
} else {
    $talentCategory = $user['category_id'];
}

if(isset($_POST['submit'])) {
    echo "yes";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Center | TalentVerse</title>
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

                    <div class="notifications-box">
                        <div class="flex-notifications">
                            <p>Notifications</p>
                            <button>Mark all as read</button>
                        </div>
                        <div class="notify">
                            <p>Message ben polo riddick</p>
                            <div class="close-icon">
                                <iconify-icon icon="carbon:close-outline"></iconify-icon>
                            </div>
                        </div>

                        <div class="notify">
                            <p>Message ben polo riddick</p>
                            <div class="close-icon">
                                <iconify-icon icon="carbon:close-outline"></iconify-icon>
                            </div>
                        </div>

                        <div class="notify">
                            <p>Message ben polo riddick</p>
                            <div class="close-icon">
                                <iconify-icon icon="carbon:close-outline"></iconify-icon>
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

        <div class="upload-container container">
            <form action="../backend/upload_video.php" method="GET" enctype="multipart/form-data">
                <?php
                if (isset($_GET['error'])) { ?>
                    <div class="error"> 
                        <?php echo htmlspecialchars($_GET['error']); ?>
                    </div>
                <?php }
                if (isset($_GET['success'])) { ?>
                    <div class="success"><?php echo htmlspecialchars($_GET['success']); ?></div>
                <?php }
                ?>
                <label for="input-file" id="drop-area">
                    <input type="file" id="input-file" name="video" accept="video/*" hidden required>
                    <div id="img-view">
                        <iconify-icon icon="ic:round-cloud-upload"></iconify-icon>
                        <p>Drag and drop or click here to upload video<br>Less than 50MB</p>
                        <span>Upload any video from desktop - mp4</span>
                    </div>
                </label>

                <div class="form-box">
                    <div class="form-group">
                        <label for="description">Description | Title</label>
                        <textarea name="description" id="description" required></textarea>
                    </div>
                </div>

                <input type="hidden" name="category_id" value="<?= htmlspecialchars($talentCategory) ?>">
                <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['user_id']) ?>">
                <input type="submit" name="submit" value="Upload Video">
            </form>
        </div>
    </div>
    <!-- local js -->
    <script defer src="../js/main.js"></script>
    <script defer src="../js/notification.js"></script>

    <!-- SCROLL BACK TO TOP -->
    <button class="scroll-to-top"><iconify-icon icon="fluent-mdl2:up"></iconify-icon></button>

    <!--ICONIFY JS-->
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

    <script>
        // REMOVE ERROR AND SUCCESS MESSAGES FROM THE BROWSER
        // Function to remove messages after a specified duration
        function removeMessages() {
            // Get all elements with class 'error' and 'success'
            var errorMessages = document.querySelectorAll('.error');
            var successMessages = document.querySelectorAll('.success');

            // Function to remove messages
            function removeElement(element) {
                element.parentNode.removeChild(element);
            }

            // Remove error messages after 1 minute
            errorMessages.forEach(function(element) {
                setTimeout(function() {
                    removeElement(element);
                }, 5000);
            });

            // Remove success messages after 1 minute
            successMessages.forEach(function(element) {
                setTimeout(function() {
                    removeElement(element);
                }, 5000); // 1 minute = 60,000 milliseconds
            });
        }

        // Call the function when the page loads
        window.onload = function() {
            // Call the existing window.onload function to clear messages from the URL
            if (window.history.replaceState) {
                const url = new URL(window.location);
                url.searchParams.delete('error');
                url.searchParams.delete('success');
                window.history.replaceState(null, null, url);
            }

            // Call the function to remove messages from the DOM after 1 minute
            removeMessages();
        };
    </script>
</body>

</html>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location: logout.php");
}

require_once "../backend/functions.php";

$user_id = $_SESSION['user_id'];

$user = get_user($user_id);

$video_id = $_GET['id'];


$myVideos = getSpecificVideo($user_id, $video_id);

$comments = getComments($video_id);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyVideos | TalentVerse</title>
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
                                                            <input type="hidden" name="video_id" value="<?= $comment['video_id']?>">
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
                                                            <input type="hidden" name="video_id" value="<?= $comment['video_id']?>">
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
                                <div class="box">
                                    <iconify-icon icon="fluent:vote-24-regular"></iconify-icon>
                                </div>
                                <span>10k</span>
                            </div>
                            <div class="icon">
                                <div class="box">
                                    <iconify-icon icon="majesticons:share"></iconify-icon>
                                </div>
                            </div>
                            <div class="icon">
                                <div class="box">
                                    <iconify-icon icon="material-symbols:download"></iconify-icon>
                                </div>
                            </div>
                            <div class="icon">
                                <div class="box">
                                    <iconify-icon icon="fluent:delete-32-regular"></iconify-icon>
                                </div>
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
                        <button class="visible" data="<?= $myVideos['video_id'] ?>">Visibility</button>
                    </div>
                </div>
            <?php } ?>
            <!--END OF THIS VIDEO-->
        </div>
    </div>
    <!-- local js -->

    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="courseForm" action="../backend/updateVisibility.php" method="post">
                <div class="title">
                    <h3>Change who can see this video</h3>
                    <div>Currently <span><?= $myVideos['visibility'] ?></span></div>
                </div>

                <select name="visibility" id="" required>
                    <option value="" disabled selected>Choose</option>
                    <option value="Anyone">Anyone</option>
                    <option value="Only Me">Only Me</option>
                    <option value="Friends">Friends</option>
                </select>

                <input type="hidden" id="video_id" name="video_id" value="">

                <input type="submit" value="Change">
            </form>
        </div>
    </div>

    <!-- SCROLL BACK TO TOP -->
    <button class="scroll-to-top"><iconify-icon icon="fluent-mdl2:up"></iconify-icon></button>

    <script defer src="../js/main.js"></script>

    <script defer src="../js/notification.js"></script>

    <script>
        // MODAL MODAL MODAL
        // Function to open the modal
        function openModal(videoId) {
            const modal = document.getElementById('myModal');
            const videoIdInput = document.getElementById('video_id');
            videoIdInput.value = videoId;
            modal.style.display = 'block';
        }

        // Function to close the modal
        function closeModal() {
            const modal = document.getElementById('myModal');
            modal.style.display = 'none';
        }

        // Event listener to open the modal when the button is clicked
        document.querySelectorAll('.visible').forEach(button => {
            button.addEventListener('click', function() {
                const videoId = this.getAttribute('data');
                openModal(videoId);
            });
        });

        // Event listener to close the modal when the close button is clicked
        document.querySelector('.modal .close').addEventListener('click', function() {
            closeModal();
        });

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
    </script>

    <!--ICONIFY JS-->
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</body>

</html>
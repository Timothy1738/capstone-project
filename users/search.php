<?php
include "./includes/header.php";
?>

<div id="profile" class="container">
    <div class="profile-content">
        <ul class="tab">
            <li><a href="#" class="active" data-target="my_videos">Videos</a></li>
            <li><a href="#" data-target="following">People</a></li>
        </ul>

        <div id="my_videos" class="content active">
            <?php
            if (isset($_GET['search'])) {
                $search = $_GET['search'];

                $search = mysqli_real_escape_string($conn, $search);

                // SQL query to search for videos based on the name or description
                $sql = "SELECT * FROM `videos` WHERE `description` LIKE '%$search%'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) { ?>
                    <div class="video_columns">
                        <?php
                        while ($row = $result->fetch_assoc()) { ?>
                            <a href="view-video.php?id=<?= $row['video_id'] ?>">
                                <div class="video_column">
                                    <div class="video_box">
                                        <video controls src="../dbvideos/<?= $row['video_url'] ?>"></video>
                                    </div>
                                    <div class="title">
                                        <p><?= $row['description'] ?></p>
                                    </div>
                                </div>
                            </a>
                            <!--END OF THIS COLUMN-->
                        <?php
                        }
                        ?>
                    </div>
                <?php } else { ?>
                    <div class="noVideos">
                        <iconify-icon icon="game-icons:binoculars"></iconify-icon>
                        <p>No Results Found</p>
                    </div>
            <?php }
            } else {
                header("location: home.php?error=Invalid Access");
            }
            ?>
        </div>
        <!--end of My vidoes page-->

        <div id="following" class="content">
            <?php
            if (isset($_GET['search'])) {
                $search = $_GET['search'];

                $search = mysqli_real_escape_string($conn, $search);

                // SQL query to search for videos based on the name or description
                $sql = "SELECT * FROM `users` WHERE (`username` LIKE '%$search%' OR `firstname` LIKE '%$search%' OR `lastname` LIKE '%$search%') AND `user_id` != '$user_id'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) { ?>
                    <div class="follow_box">
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <div class="follow_card">
                                <div class="img">
                                    <img src="../dbImages/<?= $row['profile_picture'] ?>" alt="">
                                </div>
                                <div class="name">
                                    <a href="view-other-profile.php?id=<?= $row['user_id'] ?>"><?= $row['firstname'] . ' ' . $row['lastname'] ?></a>
                                </div>
                            </div>
                            <!-- end of card -->
                        <?php } ?>
                    </div>
                <?php } else { ?>
                    <div class="noVideos">
                        <iconify-icon icon="game-icons:binoculars"></iconify-icon>
                        <p>No Results Found!</p>
                    </div>
            <?php }
            }
            ?>
        </div>
        <!-- END OF FOLLOWING PAGE -->
    </div>
</div>
</div>
<?php include "./includes/footer.php"; ?>
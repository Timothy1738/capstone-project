<?php
include "./includes/header.php";
?>

<div class="settings container">
    <div class="settings_tabs">
        <ul class="these_tabs">
            <li><a href="settings.php">Change Profile Picture</a></li>
            <li><a href="editprofile.php">Edit Profile</a></li>
            <li class="active"><a href="changecoverpicture.php">Change Cover Picture</a></li>
            <li><a href="changepassword.php">Change Password</a></li>
            <li><a href="changeusername.php">Change Username</a></li>
        </ul>

        <div class="these_pages">
            <div id="coverpicture">
                <div class="cov_pic_box">
                    <?php
                    if (isset($_GET['error'])) { ?>
                        <div class="error">
                            <?php echo htmlspecialchars($_GET['error']) ?>
                        </div>
                    <?php }
                    ?>
                    <div class="img_itself">
                        <img src="../dbcoverimages/<?= $user['cover_picture'] ?>" alt="">
                    </div>
                    <form id="form_coverimg" action="../backend/update_usercover.php" method="post" enctype="multipart/form-data">
                        <input type="file" name="cover_img" id="cover_img">
                        <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                        <button class="btn">Change Cover Photo</button>
                    </form>
                </div>
            </div>
            <!-- END OF COVER PIC CHANGE -->
        </div>
    </div>

</div>
</div>
<!-- local js -->
<?php include "./includes/footer.php"; ?>
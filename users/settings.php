<?php
include "./includes/header.php";
?>

<div class="settings container">
    <div class="settings_tabs">
        <ul class="these_tabs">
            <li class="active"><a href="settings.php">Change Profile Picture</a></li>
            <li><a href="editprofile.php">Edit Profile</a></li>
            <li><a href="changecoverpicture.php">Change Cover Picture</a></li>
            <li><a href="changepassword.php">Change Password</a></li>
            <li><a href="changeusername.php">Change Username</a></li>
        </ul>

        <div class="these_pages">
            <div id="profilepicture">
                <form id="form" action="../backend/update_userpic.php" enctype="multipart/form-data" method="post">
                    <div class="author-profile">
                        <img src="../dbimages/<?= $user['profile_picture'] ?>" alt="" title="">
                    </div>
                    <div class="author-media">
                        <input type="file" id="photo" name="photo" accept=".jpg, .jpeg, .png">
                        <iconify-icon icon="ph:camera-bold"></iconify-icon>
                    </div>
                    <div class="author-info">
                        <h4 class="title">Change Photo</h4>
                    </div>
                    <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                </form>
                <?php
                if (isset($_GET['error'])) { ?>
                    <div class="error">
                        <?php echo htmlspecialchars($_GET['error']) ?>
                    </div>
                <?php }
                if (isset($_GET['success'])) { ?>
                    <div class="success"><?php echo htmlspecialchars($_GET['success']) ?></div>
                <?php }
                ?>
            </div>
            <!-- END OF PROFILE PIC CHANGE -->
        </div>
    </div>

</div>
</div>
<?php include "./includes/footer.php"; ?>
<script>
    document.getElementById("photo").onchange = function() {
        document.getElementById('form').submit();
    }
</script>
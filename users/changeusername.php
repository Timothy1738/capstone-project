<?php
include "./includes/header.php";
?>

<div class="settings container">
    <div class="settings_tabs">
        <ul class="these_tabs">
            <li><a href="settings.php">Change Profile Picture</a></li>
            <li><a href="editprofile.php">Edit Profile</a></li>
            <li><a href="changecoverpicture.php">Change Cover Picture</a></li>
            <li><a href="changepassword.php">Change Password</a></li>
            <li class="active"><a href="changeusername.php">Change Username</a></li>
        </ul>

        <div class="these_pages">
            <div id="username" class="pages">
                <form action="../backend/change_username.php" method="post">
                    <h3>Change Username</h3>
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
                    <label for="username">New Username</label>
                    <input type="text" id="username" name="username" required value="<?= $user['username'] ?>">
                    <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                    <input type="submit" value="Change Username">
                </form>
            </div>
            <!-- END OF CHANGE USERNAME -->
        </div>
    </div>

</div>
</div>
<!-- local js -->
<?php include "./includes/footer.php"; ?>
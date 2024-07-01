<?php
include "./includes/header.php";
?>

<div class="settings container">
    <div class="settings_tabs">
        <ul class="these_tabs">
            <li><a href="settings.php">Change Profile Picture</a></li>
            <li><a href="editprofile.php">Edit Profile</a></li>
            <li><a href="changecoverpicture.php">Change Cover Picture</a></li>
            <li class="active"><a href="changepassword.php">Change Password</a></li>
            <li><a href="changeusername.php">Change Username</a></li>
        </ul>

        <div class="these_pages">
            <div id="changepassword" class="pages" onsubmit="return validateForm()">
                <form action="../backend/change_user_password.php" method="post">
                    <h3>Change Password</h3>
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
                    <div class="form-box">
                        <div class="form-group">
                            <label for="old_password">Current Password</label>
                            <input type="password" id="old_password" name="old_password" required>

                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" id="confirm_password" name="confirm_password" required onkeyup="checkPasswordsMatch()">

                        </div>
                        <div class="form-group">
                            <label for="new_password">New Password</label>
                            <input type="password" id="new_password" name="new_password" required onkeyup="checkPasswordLength()">
                        </div>

                    </div>

                    <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">

                    <input type="submit" value="Change Password">
                </form>
            </div>
            <!-- END OF CHANGE PASSWORD -->
        </div>
    </div>

</div>
</div>
<?php include "./includes/footer.php"; ?>
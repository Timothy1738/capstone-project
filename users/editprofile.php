<?php
include "./includes/header.php";
?>

<div class="settings container">
    <div class="settings_tabs">
        <ul class="these_tabs">
            <li><a href="settings.php">Change Profile Picture</a></li>
            <li class="active"><a href="editprofile.php">Edit Profile</a></li>
            <li><a href="changecoverpicture.php">Change Cover Picture</a></li>
            <li><a href="changepassword.php">Change Password</a></li>
            <li><a href="changeusername.php">Change Username</a></li>
        </ul>

        <div class="these_pages">
            <div id="username" class="pages">
                <form action="../backend/edit-userprofile.php" method="post">
                    <h3>Edit Profile</h3>
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
                            <label for="fname">First Name</label>
                            <input type="text" id="fname" name="fname" value="<?= $user['firstname'] ?>" required>

                            <label for="lname">Last Name</label>
                            <input type="text" name="lname" id="lname" value="<?= $user['lastname'] ?>" required>
                        </div>
                        <!-- end of form group -->
                         <div class="form-group">
                            <label for="">About Yourself</label>
                            <textarea name="about" id="" rows="8" placeholder="Tell your viewers about yourself..."><?= $user['about'] ?></textarea>
                         </div>
                        <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                    </div>
                    <input type="submit" value="Edit Profile">
                </form>
            </div>
            <!-- END OF CHANGE USERNAME -->
        </div>
    </div>

</div>
</div>
<!-- local js -->
<?php include "./includes/footer.php"; ?>
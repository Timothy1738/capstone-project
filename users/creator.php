<?php
include "./includes/header.php";
$category = get_talentCategory();
?>

<div class="container creator">
    <h1>Welcome to the Video Upload Center</h1>
    <h2>The first step to getting your talent discovered!</h2>

    <div class="quest">
        <h4>Lets get to know you better</h4>
        <p>Do you have a talent?</p>
        <label>
            <input type="radio" name="talent" value="yes" onclick="showTalentForm()"> Yes
        </label>
        <label>
            <input type="radio" name="talent" value="no" onclick="showMessage()"> No
        </label>
    </div>

    <div id="talent-form" class="hidden">
        <form action="../backend/process-category.php" method="post">
            <label for="talent-category">Great 😊, Select your talent category:</label>
            <table>
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>Talent Catergory</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($category == null) { ?>
                        <tr>
                            <td colspan="3" style="text-align: center;">We Currently Experiencing Some technical difficulty! come back later</td>
                        </tr>
                        <?php } else {
                        foreach ($category as $category) : ?>
                            <tr>
                                <td><input type="radio" name="category_id" id="" value="<?= $category['category_id'] ?>"></td>
                                <td><?= $category['talent_Name'] ?></td>
                                <td><?= $category['Description'] ?></td>
                            </tr>
                    <?php endforeach;
                    } ?>
                </tbody>
            </table>

            <div class="note">
                <div class="notebox">
                    Note!
                </div>
                <div class="notemessage">
                    <p>The Talent Category you select cannot be changed. So ensure you make select the right category because all videos you upload should be inline with that talent category, otherwise, your videos wont get approved for public consumption. Thanks!</p>
                </div>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" name="terms" required> <a href="#">I agree to the terms and conditions</a>
                </label>
            </div>

            <button type="submit">Update Profile</button>
        </form>
    </div>

    <div id="message" class="hidden">
        <p>This section is only for people who have a talent and are willing to share it with our community to gain recognition. Thank you for your interest!</p>
    </div>
</div>
<?php include "includes/footer.php"; ?>
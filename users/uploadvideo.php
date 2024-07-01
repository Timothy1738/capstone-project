<?php
ob_start(); // Start output buffering at the very beginning
include "includes/header.php";

if ($user['creator_status'] == 'community') {
    header("Location: creator.php");
    exit; // It's good practice to call exit after a header redirection
} else {
    $talentCategory = $user['category_id'];
}
?>
<div class="upload-container container">
    <form action="../backend/upload_video.php" method="POST" enctype="multipart/form-data">
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
<?php
include "./includes/footer.php";
ob_end_flush(); // Flush the output buffer
?>

<?php
include "./includes/header.php";

$personal_id = $_GET['id'];

if (empty($personal_id)) {
    header("location: users.php");
}

$personalInformation = get_user($personal_id);
$followers = getFollowers($personal_id);
$following = getFollowing($personal_id);
$videos = getUserVideo($personal_id);
?>
<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
    <div class="container-fluid">
        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-profile">
                    <div class="admin-user">
                        <div class="img-wrraper">
                            <div class="">
                                <img src="../dbimages/<?= $personalInformation['profile_picture'] ?>" class="rounded-circle">
                            </div>
                        </div>
                        <div class="user-details">
                            <div class="title"><a target="_blank" href="#">
                                    <h4><?= $personalInformation['firstname'] . ' ' . $personalInformation['lastname'] ?></h4>
                                    <h6><?= $personalInformation['contact'] ?></h6>
                                </a>
                                <span class='badge badge-primary light border-0 me-1'>Talent Category: <?= getCategoryName($personalInformation['category_id']) ?></span>
                            </div>
                            <ul class="follow-list">
                                <li>
                                    <div class="follow-num "><?= getNumberOfVideos($personalInformation['user_id']) ?></div><span>Videos</span>
                                </li>
                                <li>
                                    <div class="follow-num "><?= getNumberofFollowers($personalInformation['user_id']) ?></div><span>Followers</span>
                                </li>
                                <li>
                                    <div class="follow-num "><?= getNumberofFollowering($personalInformation['user_id']) ?></div><span>Following</span>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3 col-xxl-4">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body profile-accordion pb-0">
                                <div class="accordion" id="accordionExample2">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne2">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne2" aria-expanded="true" aria-controls="collapseOne2">
                                                Followers
                                            </button>
                                        </h2>
                                        <div id="collapseOne2" class="accordion-collapse collapse show" aria-labelledby="headingOne2" data-bs-parent="#accordionExample2">
                                            <?php
                                            if ($followers == null) { ?>
                                                <div class="accordion-body">
                                                    <div class="products mb-3">
                                                        <div>
                                                            <h6>This User has no followers</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } else { ?>
                                                <div class="accordion-body">
                                                    <?php foreach ($followers as $follower) : ?>
                                                        <div class="products mb-3">
                                                            <img src="../dbimages/<?= $follower['profile_picture'] ?>" class="avatar avatar-md" alt="">
                                                            <div>
                                                                <h6><a href="view-more.php?id=<?= $follower['user_id'] ?>"><?= $follower['firstname'] . ' ' . $follower['lastname'] ?></a></h6>
                                                            </div>
                                                        </div>
                                                    <?php endforeach ?>
                                                </div>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body profile-accordion pb-0">
                                <div class="accordion" id="accordionExample3">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne3">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne3" aria-expanded="true" aria-controls="collapseOne3">
                                                Following
                                            </button>
                                        </h2>
                                        <div id="collapseOne3" class="accordion-collapse collapse show" aria-labelledby="headingOne3" data-bs-parent="#accordionExample3">
                                            <?php
                                            if ($following == null) { ?>
                                                <div class="products mb-3">
                                                    <div>
                                                        <h6>This User is following no one</h6>
                                                    </div>
                                                </div>
                                            <?php } else { ?>
                                                <div class="accordion-body">
                                                    <?php foreach ($following as $follow) : ?>
                                                        <div class="products mb-3">
                                                            <img src="../dbimages/<?= $follow['profile_picture'] ?>" class="avatar avatar-md" alt="">
                                                            <div>
                                                                <h6><a href="view-more.php?id=<?= $follow['user_id'] ?>"><?= $follow['firstname'] . ' ' . $follow['lastname'] ?></a></h6>
                                                            </div>
                                                        </div>
                                                    <?php endforeach ?>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-9 col-xxl-8">
                <div class="row">
                    <?php if ($videos == null) { ?>
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body pt-0">
                                    <h4 class="mt-4">No video uploaded yet</h4>
                                </div>
                            </div>
                        </div>
                        <?php } else {
                        foreach ($videos as $video) : ?>
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body pt-0">
                                        <div class="post-img mt-3 video">
                                            <video width="100%" style="border-radius: 10px;" controls src="../dbvideos/<?= $video['video_url'] ?>"></video>
                                        </div>
                                        <div class="mt-3">
                                            <span><?= $video['description'] ?></span>
                                        </div>
                                        <ul class="post-comment d-flex mt-3">
                                            <li>
                                                <label class="me-3"><a href="javascript:void(0)"><i class="fa-solid fa-check-to-slot me-2"></i><?= getNumberofVotes($video['video_id'])?> Votes</a></label>
                                            </li>
                                            <li>
                                                <label class="me-3"><a href="javascript:void(0)"><i class="fa-regular fa-message me-2"></i><?= getNumberofComments($video['video_id'])?> Comments</a></label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- END OF LOOPING COMPONENT -->
                        <?php endforeach; ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!--**********************************
            Content body end
        ***********************************-->
<?php
include "./includes/footer.php";
?>

<script>
    document.querySelectorAll(".deleteButton").forEach(function(button) {
        button.addEventListener("click", function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Show the confirmation message using SweetAlert
            swal({
                title: "Are you sure to delete?",
                text: "You will not be able to recover this record!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: true
            }, function(isConfirm) {
                if (isConfirm) {
                    // If user confirms, submit the form associated with the clicked button
                    button.closest("form").submit();
                }
            });
        });
    });

    // Check if the URL contains the parameter for success
    if (window.location.href.indexOf('008839=SUCCESS') > -1) {
        swal("Success !!", "New user Added Successfully!", "success");

        // Remove the success parameter from the URL
        var newUrl = window.location.href.split("?")[0];
        window.history.replaceState({}, document.title, newUrl);
    }
    // Check if the URL contains the parameter for ERROR_1 or ERROR_2
    else if (window.location.href.indexOf('009911=ERROR_1') > -1) {
        sweetAlert("Oops...", "Something went wrong. Failed to add new User!", "error");

        // Remove the success parameter from the URL
        var newUrl = window.location.href.split("?")[0];
        window.history.replaceState({}, document.title, newUrl);
    } else if (window.location.href.indexOf('009911=ERROR_2') > -1) {
        sweetAlert("Oops...", "Something went wrong. Contact Developer for Support!", "error");

        // Remove the success parameter from the URL
        var newUrl = window.location.href.split("?")[0];
        window.history.replaceState({}, document.title, newUrl);
    } else if (window.location.href.indexOf('119940=SUCCESS') > -1) {
        swal("Success !!", "User deleted Successfully!", "success");

        // Remove the success parameter from the URL
        var newUrl = window.location.href.split("?")[0];
        window.history.replaceState({}, document.title, newUrl);
    } else if (window.location.href.indexOf('110022=FAILURE') > -1) {
        sweetAlert("Oops...", "Something went wrong. Contact Developer for Support!", "error");

        // Remove the success parameter from the URL
        var newUrl = window.location.href.split("?")[0];
        window.history.replaceState({}, document.title, newUrl);
    } else if (window.location.href.indexOf('115511=ERROR_IMG_UPLOAD') > -1) {
        sweetAlert("Oops...", "Something went wrong. Failed to Move Image to System Directory", "error");

        // Remove the success parameter from the URL
        var newUrl = window.location.href.split("?")[0];
        window.history.replaceState({}, document.title, newUrl);
    } else if (window.location.href.indexOf('116611=ERROR_IMG_SIZE_TOO_LARGE') > -1) {
        sweetAlert("Sorry...", "Your file is too large. Please upload a file under 5MB.", "error");

        // Remove the success parameter from the URL
        var newUrl = window.location.href.split("?")[0];
        window.history.replaceState({}, document.title, newUrl);
    } else if (window.location.href.indexOf('117711=WRONG_FILE_FORMART') > -1) {
        sweetAlert("Sorry...", "Only JPG, JPEG, PNG, and GIF files are allowed.", "error");

        // Remove the success parameter from the URL
        var newUrl = window.location.href.split("?")[0];
        window.history.replaceState({}, document.title, newUrl);
    }
</script>
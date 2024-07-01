<?php
include "includes/header.php";
$events = getEvents();
?>
<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
    <div class="container-fluid mh-auto">
        <div class="row">
            <div class="col-xl-12">
                <div class="card dz-card" id="accordion-one">
                    <div class="card-header flex-wrap">
                        <div>
                            <h4 class="card-title">Events</h4>
                        </div>
                        <!-- Large modal -->
                        <div class="flex-wrap">
                            <button type="button" class="btn btn-primary mb-2 btn-sm" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">Add Event</button>
                            <a href="eventsubs.php">
                                <button type="button" class="btn btn-primary mb-2 btn-sm">Event Subs</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if (isset($_GET['error'])) { ?>
            <div class="error">
                <?php echo htmlspecialchars($_GET['error']) ?>
            </div>
        <?php }
        if (isset($_GET['success'])) { ?>
            <div class="success mb-3"><?php echo htmlspecialchars($_GET['success']) ?></div>
        <?php } ?>

        <div class="row">
            <?php foreach ($events as $event) : ?>
                <div class="col-lg-12 col-xl-6 col-xxl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row m-b-30">
                                <div class="col-md-5 col-xxl-12">
                                    <div class="new-arrival-product mb-4 mb-xxl-4 mb-md-0">
                                        <div class="new-arrivals-img-contnent">
                                            <img class="img-fluid" src="../dbimages/<?= $event['thumbnail'] ?>" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7 col-xxl-12">
                                    <div class="new-arrival-content position-relative">
                                        <h4><?= $event['event_name'] ?></h4>
                                        <p>Scheduled Date: <span class="item"> <?= $event['event_date'] ?> </span></p>
                                        <p>Location: <span class="item"><?= $event['venue'] ?></span></p>
                                        <p>Contact: <span class="item"><?= $event['contact_two'] ?></span> </p>
                                        <p class="text-content"><?= $event['description'] ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex mt-3">
                                <a href="editEvent.php?id=<?= $event['event_id']; ?>" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></a>
                                <a href="operations/deleteEvent.php?id=<?= $event['event_id']; ?>" class="btn btn-danger shadow btn-xs sharp" onclick="return confirmDeletion();"><i class="fa fa-trash"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>
<!--**********************************
            Content body end
        ***********************************-->

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>

            <div class="modal-body">
                <div class="basic-form">
                    <form method="post" action="operations/addEvent.php" class="profile-form needs-validation" novalidate enctype="multipart/form-data">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="col-lg-4 col-form-label" for="validationCustom01">Event Name
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" name="name" id="validationCustom01" placeholder="Event Name" required>

                                <div class="invalid-feedback">
                                    Please this is a required field.
                                </div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="col-lg-4 col-form-label" for="validationCustom02">Scheduled Date
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="date" class="form-control" name="date" id="validationCustom02" placeholder="" required>

                                <div class="invalid-feedback">
                                    Please, this is a required field
                                </div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="col-lg-4 col-form-label" for="validationCustom01">Venue
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" name="contact_1" id="validationCustom01" placeholder="Venue" required>

                                <div class="invalid-feedback">
                                    Please this is a required field.
                                </div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="col-lg-4 col-form-label" for="validationCustom02">Contact_2
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" name="contact_2" id="validationCustom02" placeholder="Contact" value="">

                                <div class="invalid-feedback">
                                    Please, this is a required field
                                </div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="col-lg-4 col-form-label" for="validationCustom02">Link
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" name="link" id="validationCustom02" placeholder="https://" value="">
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="col-lg-4 col-form-label" for="validationCustom02">Description
                                    <span class="text-danger">*</span>
                                </label>
                                <textarea name="description" class="form-txtarea form-control" id="validationCustom02" rows="8" placeholder="Description" required></textarea>

                                <div class="invalid-feedback">
                                    Please, this is a required field
                                </div>
                            </div>

                            <div class="mb-3 col-md-12">
                                <label class="col-lg-4 col-form-label" for="validationCustom02">Event Image
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="file" class="form-control" name="file" id="validationCustom02" required>

                                <div class="invalid-feedback">
                                    Please, this is a required field
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger btn-sm light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-sm btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "includes/footer.php" ?>
<script>
    function confirmDeletion() {
        return confirm("Are you sure you want to delete this event? Please note that this action is irreversible.");
    }
</script>
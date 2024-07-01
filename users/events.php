<?php
include "./includes/header.php";
$events = getEvents();
?>

<div class="events_splash">
    <?php
    if (isset($_GET['error'])) { ?>
        <div class="error" style="margin-bottom: 20px;">
            <?php echo htmlspecialchars($_GET['error']) ?>
        </div>
    <?php }
    if (isset($_GET['success'])) { ?>
        <div class="success" style="margin-bottom: 20px;"><?php echo htmlspecialchars($_GET['success']) ?></div>
    <?php }
    ?>
    <h1 style="text-align: center;">Events, happenings and Talent<br> Programs around you!</h1>
</div>
<!-- end of events splash -->

<div class="eventsaround container">
    <div class="event_columns">
        <?php foreach ($events as $event) : ?>
            <div class="column-card">
                <div class="event_img">
                    <img src="../dbimages/<?= $event['thumbnail'] ?>" alt="">
                </div>
                <div class="event-intro">
                    <h4><?= $event['event_name'] ?></h4>
                    <ul>
                        <li>Scheduled Date: <span><?= $event['event_date'] ?></span></li>
                        <li>Location: <span><?= $event['venue'] ?></span></li>
                        <li>Contact: <span><?= $event['contact_two'] ?></span></li>
                    </ul>
                    <p style="display: flex; flex-direction:column;"><strong>About: </strong>
                        <?= $event['description'] ?></p>
                </div>
            </div>
            <!--end of column card-->
        <?php endforeach ?>
    </div>
</div>
</div>
<?php include "./includes/footer.php"; ?>
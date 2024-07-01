<?php include "./includes/header.php"; ?>
<section class="chitchat container">
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
    <div class="column-flex">
        <div class="info">
            <div class="title">
                <h1>Contact Us</h1>
                <p>
                    Have any inquiry, feel free to contact us any time. We will get back to you as soon
                    as we can!
                </p>
            </div>

            <div class="tel">
                <div>
                    <span class="material-symbols-outlined">mail</span>info@gmail.com
                </div>

                <div>
                    <span class="material-symbols-outlined">call</span> 0778907657 |
                    0783375451
                </div>

                <div>
                    <span class="material-symbols-outlined">location_on</span> Gulu
                    City, Laroo
                </div>
            </div>
        </div>
        <!--END OF TEL DETAILS-->
        <form action="../backend/inquiry.php" method="post">
            <div class="input">
                <div class="inputbox">
                    <label for="name">NAME</label>
                    <input type="text" name="name" placeholder="Your Name" required />
                </div>

                <div class="inputbox">
                    <label for="email">EMAIL</label>
                    <input type="email" name="email" placeholder="Your Email" required />
                </div>
            </div>

            <label for="subject" style="margin-top: 20px">SUBJECT</label>
            <input type="text" name="subject" placeholder="Subject" required />

            <label for="message" style="margin-top: 20px">MESSAGE</label>
            <textarea name="message" placeholder="Your Message..." id="" cols="30" rows="10"></textarea>

            <button type="submit">
                Send Message <span class="material-symbols-outlined"> send </span>
            </button>
        </form>
        <!--END OF FROM-->
    </div>
</section>
<?php include "./includes/footer.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Local CSS -->
    <link rel="stylesheet" href="css/styles.css">

    <!--boxicons-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .btn {
            border-radius: 5px;
            background-color: var(--color_purple);
            color: var(--dull_white);
            font-family: "Play", 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            width: fit-content;
            padding: 8px 1.5rem;
            font-size: 15px;
            cursor: pointer;
            transition: var(--transition);
            border: 1.5px solid var(--color_purple);
        }

        .btn:hover {
            background: transparent;
            border: 1.5px solid var(--color_purple);
            color: var(--color_purple);
        }
    </style>

    <title>Home | TalentVerse</title>
</head>

<body>
    <nav id="navbar">
        <div class="container">
            <div class="logo">
                <h1>TalentVerse</h1>
            </div>
            <div class="links">
                <a href="#home">Home</a>
                <a href="#about">About</a>
                <a href="#contact">Contact Us</a>
                <a href="login.php">
                    <span>Sign In</span>
                </a>
            </div>
        </div>
    </nav>
    <!--END OF NAV-BAR-->

    <!--Home page start-->
    <section id="home">
        <div class="container">
            <div class="home_content">
                <h1>Discover a World of <br> Talent - Your Journey Starts Here</h1>
                <span>Where Creativity Finds its Audience</span>

                <div class="cta">
                    <a href="signup.php">
                        <button class="btn">
                            Sign Up
                        </button>
                    </a>

                    <div class="social-linx">
                        <a href="#"><iconify-icon icon="basil:facebook-solid"></iconify-icon></a>
                        <a href="#"><iconify-icon icon="iconoir:instagram"></iconify-icon></a>
                        <a href="#"><iconify-icon icon="hugeicons:new-twitter"></iconify-icon></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="about">
        <div class="container">
            <div class="about_text">
                <h3>The Talent Behind Us</h3>
                <p>"TalentVerse" is more than a platform; it's a mission to democratize opportunities for artists globally. Recognizing the hurdles facing emerging talents, especially from underprivileged backgrounds, we're committed to bridging this gap. Our journey is fueled by a dedication to showcasing diverse talents and providing a central space for exhibition, mentorship, and connections. We believe in the transformative power of creativity and nurturing talents from all walks of life. Join us as we redefine how society identifies, supports, and celebrates emerging talents in the digital age.</p>
                <a href="signup.php">
                    <button class="btn">
                        Get Started Now
                    </button>
                </a>
            </div>
            <div class="about_img">
                <img src="./images/about-bg.jpg" alt="About Image">
            </div>
        </div>
    </section>

    <!-- end of about-->

    <!--Start of working process-->
    <section class="process">
        <div class="container">
            <h3>Behind the Curtain: Navigating the Path to Talent Recognition</h3>
            <div class="sub-title">How to get Started?</div>
            <div class="cute-cards">
                <div class="card">
                    <div class="icon">
                        <iconify-icon icon="mage:video-upload-fill"></iconify-icon>
                    </div>
                    <h5>Upload Your Video</h5>
                    <p>Post a short video of you performing your talent onto our platform</p>
                </div>
                <!-- end of card -->

                <div class="card">
                    <div class="icon">
                        <iconify-icon icon="fluent:vote-20-regular"></iconify-icon>
                    </div>
                    <h5>Gain Recognition</h5>
                    <p>Our vast community will vote and react to your video based on how good your talent is.</p>
                </div>
                <!-- end of card -->

                <div class="card">
                    <div class="icon">
                        <iconify-icon icon="fa6-regular:handshake"></iconify-icon>
                    </div>
                    <h5>Get Connected to a Mentor</h5>
                    <p>If your video gets the highest vote in your talent category, you get to be assigned a mentor.</p>
                </div>
                <!-- end of card -->

                <div class="card">
                    <div class="icon">
                        <iconify-icon icon="game-icons:stump-regrowth"></iconify-icon>
                    </div>
                    <h5>Grow with your Talent</h5>
                    <p>Your mentor gets to expose you to a wealth of opportunities, mentorship and guidance</p>
                </div>
                <!-- end of card -->
            </div>
            <!-- END OF PROCESS CARDS -->

            <div class="insight_cards">
                <div class="insight">
                    <div class="left">
                        <h3>What it means to be a Mentor</h3>
                        <p>
                            Become a big part of someone’s success story! From a young seedling to a big mustard tree, here is a unique opportunity to nature and develop ones talent using the resources at your exposure and encouraging them to become more than what they are. Its also an opportunity to grow your brand as a mentor and have a quid pro quo relationship with those that you nurture. So, dont pass on this opportunity as we strive to build our country through our talents.
                        </p>
                        <button class="btn" data-toggle="modal" data-target="#exampleModal">
                            Become a Mentor
                        </button>
                    </div>
                    <div class="right">
                        <img src="./images/nurture.jpg" alt="">
                    </div>
                </div>
                <!--end of insight-->

                <div class="insight">
                    <div class="right">
                        <img src="./images/dancing-kid.jpg" alt="">
                    </div>
                    <div class="left">
                        <h3>To all you upcoming talents!</h3>
                        <p>
                            TalentVerse hopes to bridge the gap between talent, audience and opportunity! We are on the search for the next big artists so as to bring them up, nurture them and let their talent work them. Anyone with a talent (In Performing Arts - for now) can sign up, show us what they have and leave it to the community to judge based on how good your talent is. The plain field is leveled, so don’t wait anymore, sign up now and you could be the next “big thing”
                        </p>
                        <a href="signup.php">
                            <button class="btn">
                                Sign Up
                            </button>
                        </a>
                    </div>
                </div>
                <!--end of insight-->

                <div class="insight">
                    <div class="left">
                        <h3>Become a community member</h3>
                        <p>
                            By becoming a community member, you get to add your voice in selecting the next “big artists” by voting and commenting on their talents. Your contribution is invaluable in democratizing the whole process and ensuring its free and fair. By being a community member , you also get to meet, interact with, different talented individuals and possibly get entertained by what have to offer as you support them in their journey of growth and development. The stage is set, lets cheer them on!
                        </p>
                        <a href="signup.php">
                            <button class="btn">
                                Sign Up
                            </button>
                        </a>
                    </div>
                    <div class="right">
                        <img src="./images/community.jpg" alt="">
                    </div>
                </div>
                <!--end of insight-->

                <div class="insight">
                    <div class="right">
                        <img src="./images/fantasy.jpg" alt="">
                    </div>
                    <div class="left">
                        <h3>Why Sign Up?</h3>
                        <p>
                            Sign Up today and get exposed to several opportunities and services that we offer. These include:
                        </p>
                        <ul>
                            <li>Get updates about the latest talent events in your area.</li>
                            <li>A chance to get mentorship and exposure</li>
                            <li>Meet your audience and fan base</li>
                            <li>Market yourself, your talent and skills</li>
                            <li>Collaboration opportunities with other artists</li>
                            <li>Talent development</li>
                            <li>Community support</li>
                            <li>Networking Opportunities</li>
                        </ul>
                        <a href="signup.php">
                            <button class="btn">
                                Get Started Now
                            </button>
                        </a>
                    </div>
                </div>
                <!--end of insight-->
            </div>
        </div>
    </section>
    <!--end of working process-->

    <section class="faqs">
        <div class="container">
            <h3>Frequently asked Questions?</h3>
            <div class="faq">
                <div class="faq-card">
                    <div class="question">
                        <h5>How does my video gain recognition?</h5>
                        <iconify-icon icon="mingcute:down-fill"></iconify-icon>
                    </div>
                    <div class="answer">
                        After posting your video on our platform, you can share
                        it with friends and family meanwhile encouraging them
                        to vote on your video so that it gains recognition. The
                        more votes it gets, the more it displayed to other viewers
                        who may just vote on it basing on how good and
                        impressive your talent is.
                    </div>
                </div>
                <!--end of faq card-->

                <div class="faq-card">
                    <div class="question">
                        <h5>Is mentorship free?</h5>
                        <iconify-icon icon="mingcute:down-fill"></iconify-icon>
                    </div>
                    <div class="answer">Answer 2</div>
                </div>
                <!--end of faq card-->

                <div class="faq-card">
                    <div class="question">
                        <h5>What next after I become successful?</h5>
                        <iconify-icon icon="mingcute:down-fill"></iconify-icon>
                    </div>
                    <div class="answer">Answer 2</div>
                </div>
                <!--end of faq card-->

                <div class="faq-card">
                    <div class="question">
                        <h5>What next after meeting a mentor?</h5>
                        <iconify-icon icon="mingcute:down-fill"></iconify-icon>
                    </div>
                    <div class="answer">Answer 2</div>
                </div>
                <!--end of faq card-->

                <div class="faq-card">
                    <div class="question">
                        <h5>How safe is my data?</h5>
                        <iconify-icon icon="mingcute:down-fill"></iconify-icon>
                    </div>
                    <div class="answer">Answer 2</div>
                </div>
                <!--end of faq card-->

                <div class="faq-card">
                    <div class="question">
                        <h5>Any other question?</h5>
                        <iconify-icon icon="mingcute:down-fill"></iconify-icon>
                    </div>
                    <div class="answer">Answer 2</div>
                </div>
                <!--end of faq card-->
            </div>
        </div>
    </section>
    <!--end of faq section-->

    <!-- Contact us section -->
    <section id="contact">
        <div class="container">
            <h3>Have Any Inquiries?</h3>
            <div class="contact-box">
                <div class="follow-us">
                    <h4>Follow Us on Social Media</h4>
                    <div class="social-linx">
                        <a href="#"><iconify-icon icon="basil:facebook-solid"></iconify-icon></a>
                        <a href="#"><iconify-icon icon="iconoir:instagram"></iconify-icon></a>
                        <a href="#"><iconify-icon icon="hugeicons:new-twitter"></iconify-icon></a>
                    </div>
                    <div class="text">
                        We shall endeavor to answer you as soon as possible. Thanks!
                    </div>
                </div>
                <div class="form">
                    <h4>Send Us a Message</h4>
                    <form action="" class="needs-validation" novalidate>
                        <label for="name">Enter Your Name</label>
                        <input type="text" name="name" id="">

                        <label for="email">Enter Your Email</label>
                        <input type="email" name="email">

                        <label for="subject">Subject</label>
                        <input type="text" name="subject" required>

                        <label for="message">Message</label>
                        <textarea name="message" id=""></textarea>

                        <button type="submit" class="btn">Send Message <iconify-icon icon="iconamoon:send-bold"></iconify-icon></button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--END OF CONTACT US SECTION -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-cols">
                    <div class="logo">
                        <h1>TalentVerse</h1>
                    </div>
                    <div class="contact-details">
                        <div><iconify-icon icon="ic:round-phone"></iconify-icon> +256 778907 876</div>
                        <div><iconify-icon icon="mage:email"></iconify-icon> info@gmail.com</div>
                        <div><iconify-icon icon="gridicons:location"></iconify-icon>Gulu City</div>
                    </div>
                </div>
                <!--END OF FOOTER COLS -->

                <div class="footer-cols">
                    <h3>Quick Links</h3>
                    <ul class="quick-linx">
                        <li><a href="#home">Home</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>
                <!--END OF FOOTER COLS -->

                <div class="footer-cols">
                    <h3>Stay Updated</h3>
                    <p>
                        Subscribe to our news letter and be the first to hear about our exciting offers, upcoming events, and so much more
                    </p>
                    <form action="">
                        <input type="email" name="subscription-email" placeholder="Enter Your Email" id="" required>
                        <input type="submit" value="Subscribe">
                    </form>
                </div>
                <!--END OF FOOTER COLS -->
            </div>

            <hr>
            <div class="copy">
                <div class="line_1">
                    <div class="logo">
                        <h4>TalentVerse</h4>
                    </div>
                    <ul>
                        <li>Where Creativity finds its audience!</li>
                    </ul>
                </div>
                <span>All Rights Reserved - <?php echo date("Y"); ?></span>
            </div>
        </div>
    </footer>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apply to become a Mentor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form inside modal -->
                    <form method="get">
                        <div class="form-group">
                            <label for="talent_area">Talent Area</label>
                            <input type="text" class="form-control" id="talent_area" aria-describedby="emailHelp" placeholder="e.g Music, Acting etc" required>
                        </div>
                        <div class="form-group">
                            <label for="brand_name">Brand Name</label>
                            <input type="text" class="form-control" id="brand_name" aria-describedby="emailHelp" placeholder="Enter Brand Name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
                        </div>
                        <div class="form-group">
                            <label for="number">Contact</label>
                            <input type="text" class="form-control" id="number" aria-describedby="emailHelp" placeholder="e.g 07789076478" required>
                        </div>
                        <button type="submit" class="btn">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--ICONIFY JS-->
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

    <!--MAIN JS-->
    <script src="./js/main.js"></script>

    <!-- SCROLL BACK TO TOP -->
    <button class="scroll-to-top"><iconify-icon icon="fluent-mdl2:up"></iconify-icon></button>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
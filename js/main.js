document.querySelectorAll('.faq-card').forEach(card => {
    card.addEventListener('click', () => {
        const answer = card.querySelector('.answer');

        if (answer.style.maxHeight) {
            answer.style.maxHeight = null; // Hide the answer
            card.classList.remove('active');
        } else {
            answer.style.maxHeight = answer.scrollHeight + "px"; // Show the answer
            card.classList.add('active');
        }
    });
});

var lastScrollTop = 0;
var navbar = document.getElementById("navbar");
var delta = 5; // Set a threshold to determine scrolling direction

window.addEventListener("scroll", function () {
    var scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    if (Math.abs(lastScrollTop - scrollTop) <= delta) {
        return; // Ignore small scroll movements
    }

    if (scrollTop > lastScrollTop) {
        // Downscroll code
        navbar.classList.add("hidden");
        navbar.classList.remove("white-bg");
    } else {
        // Upscroll code
        if (scrollTop < 50) { // Adjust the threshold as needed
            navbar.classList.remove("white-bg");
        } else {
            navbar.classList.add("white-bg");
        }

        navbar.classList.remove("hidden");
    }

    lastScrollTop = scrollTop;
});


// Get the profile image and hover box elements
document.addEventListener('DOMContentLoaded', function () {
    const profileImg = document.querySelector('.profileImg');
    const hoverBox = document.getElementById('hoverBox');

    // Add event listener for click
    profileImg.addEventListener('click', function (event) {
        // Toggle the display of the hover box
        event.stopPropagation();
        hoverBox.style.display = hoverBox.style.display === 'block' ? 'none' : 'block';
    });

    document.addEventListener('click', function () {
        hoverBox.style.display = 'none';
    });
});

//SCROLL BACK TO TOP
const scrollToTopButton = document.querySelector('.scroll-to-top');
// Add click event listener to scroll-to-top button
scrollToTopButton.addEventListener('click', function () {
    // Scroll to the top of the page
    window.scrollTo({ top: 0, behavior: 'smooth' });
});

// Show or hide the scroll-to-top button based on the scroll position
window.addEventListener('scroll', function () {
    if (window.pageYOffset > 0) {
        scrollToTopButton.style.display = 'block';
    } else {
        scrollToTopButton.style.display = 'none';
    }
});


//VIDEO AUTOPLAY
document.addEventListener('DOMContentLoaded', () => {
    const videos = document.querySelectorAll('.video-element');

    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.5 // Play video when 50% of it is visible
    };

    const videoObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.play();
            } else {
                entry.target.pause();
                entry.target.currentTime = 0; // Reset the video to the beginning
            }
        });
    }, observerOptions);

    videos.forEach(video => {
        videoObserver.observe(video);
    });
});


/*PROFILE PAGE FOR USER OR VIEWING FOR ANOTHER PERSON*/
document.addEventListener('DOMContentLoaded', () => {
    const navLinks = document.querySelectorAll('.tab li a');

    navLinks.forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default link behavior

            // Get the target content ID from the data-target attribute
            const targetId = this.getAttribute('data-target');

            // Hide all content sections
            document.querySelectorAll('.content').forEach(content => {
                content.classList.remove('active');
            });

            // Show the clicked content section
            document.getElementById(targetId).classList.add('active');

            // Set the active class on the clicked link
            navLinks.forEach(link => {
                link.classList.remove('active');
            });
            this.classList.add('active');
        });
    });
});



// UPLOADING VIDEO INTO DB
// script.js
// handling video selection
// handling video selection
const dropArea = document.getElementById("drop-area");
const inputFile = document.getElementById("input-file");
const imageView = document.getElementById("img-view");

inputFile.addEventListener("change", uploadVideo);

function uploadVideo() {
    const file = inputFile.files[0];
    if (file) {
        const videoLink = URL.createObjectURL(file);
        displayVideo(videoLink);
    }
}

dropArea.addEventListener("dragover", function (e) {
    e.preventDefault();
    dropArea.classList.add("highlight");
});

dropArea.addEventListener("dragleave", function () {
    dropArea.classList.remove("highlight");
});

dropArea.addEventListener("drop", function (e) {
    e.preventDefault();
    dropArea.classList.remove("highlight");
    inputFile.files = e.dataTransfer.files;
    uploadVideo();
});

function displayVideo(src) {
    // Clear the current content
    imageView.innerHTML = "";
    imageView.style.border = 0;

    // Create video element
    const videoElement = document.createElement("video");
    videoElement.src = src;
    videoElement.controls = true;
    videoElement.classList.add("preview-video");

    // Append video element to img-view
    imageView.appendChild(videoElement);
}




// Event listener to close the modal when clicking outside the modal content
window.addEventListener('click', function(event) {
    const modal = document.getElementById('myModal');
    if (event.target === modal) {
        closeModal();
    }
});



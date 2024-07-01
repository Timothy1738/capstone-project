<script defer src="../js/main.js"></script>
<script defer src="../js/notification.js"></script>

<!-- SCROLL BACK TO TOP -->
<button class="scroll-to-top"><iconify-icon icon="fluent-mdl2:up"></iconify-icon></button>

<!--ICONIFY JS-->
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

<script>
    function removeMessages() {
        // Get all elements with class 'error' and 'success'
        var errorMessages = document.querySelectorAll('.error');
        var successMessages = document.querySelectorAll('.success');

        // Function to remove messages
        function removeElement(element) {
            element.parentNode.removeChild(element);
        }

        // Remove error messages after 1 minute
        errorMessages.forEach(function(element) {
            setTimeout(function() {
                removeElement(element);
            }, 5000);
        });

        // Remove success messages after 1 minute
        successMessages.forEach(function(element) {
            setTimeout(function() {
                removeElement(element);
            }, 5000); // 1 minute = 60,000 milliseconds
        });
    }

    // Call the function when the page loads
    window.onload = function() {
        // Call the existing window.onload function to clear messages from the URL
        if (window.history.replaceState) {
            const url = new URL(window.location);
            url.searchParams.delete('error');
            url.searchParams.delete('success');
            window.history.replaceState(null, null, url);
        }

        // Call the function to remove messages from the DOM after 1 minute
        removeMessages();
    };
    document.getElementById("cover_img").onchange = function() {
        document.getElementById('form_coverimg').submit();
    }

    function checkPasswordLength() {
        var password = document.getElementById('new_password').value;
        if (password.length < 8) {
            document.getElementById('password_length_error').innerText = "Password is too short.";
        } else {
            document.getElementById('password_length_error').innerText = "";
        }
    }

    function checkPasswordsMatch() {
        var newPassword = document.getElementById('new_password').value;
        var confirmPassword = document.getElementById('confirm_password').value;
        if (newPassword !== confirmPassword) {
            document.getElementById('password_match_error').innerText = "New Password do not match.";
        } else {
            document.getElementById('password_match_error').innerText = "";
        }
    }

    function validateForm() {
        var newPassword = document.getElementById('new_password').value;
        var confirmPassword = document.getElementById('confirm_password').value;
        if (newPassword.length < 8) {
            alert("Password is too short.");
            return false;
        }
        if (newPassword !== confirmPassword) {
            alert("New password does not match with confirm password!");
            return false;
        }
        return true;
    }
</script>
</body>

</html>
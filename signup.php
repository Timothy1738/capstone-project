<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | TalentVerse</title>

    <link rel="stylesheet" href="./css/styles.css">
</head>

<body>
    <div class="signup">
        <div class="signup_auth">
            <form action="backend/signup.php" id="signupForm" method="post">
                <div class="form-step form-step-active" id="form-step-3">
                    <div class="header">
                        <a href="index.php">
                            <div class="logo">
                                <h1>TalentVerse</h1>
                            </div>
                        </a>
                        <h3>Create your Account</h3>
                        <h2>Step 1</h2>
                    </div>
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
                    <div class="boxicon">
                        <label for="firstName">First Name:</label>
                        <input type="text" id="firstName" name="firstName" required>

                        <label for="lastName">Last Name:</label>
                        <input type="text" id="lastName" name="lastName" required>

                        <label for="contact">Contact:</label>
                        <input type="text" name="contact" required>

                        <span class="error-message" id="error-message-1"></span>

                        <div class="side-btns">
                            <div>Already have an account? <a href="login.php">Login</a></div>
                            <button type="button" class="next-btn">Next</button>
                        </div>
                    </div>
                </div>
                <!-- end of form step -->

                <div class="form-step" id="form-step-3">
                    <div class="header">
                        <a href="index.php">
                            <div class="logo">
                                <h1>TalentVerse</h1>
                            </div>
                        </a>
                        <h3>Create your Account</h3>
                        <h2>Step 2</h2>
                    </div>
                    <div class="boxicon">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>

                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>

                        <label for="sex">Sex:</label>
                        <select name="sex" id="sex" required>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>

                        <span class="error-message" id="error-message-2"></span>

                        <div class="side-btns">
                            <button type="button" class="prev-btn">Previous</button>
                            <button type="button" class="next-btn">Next</button>
                        </div>
                    </div>
                </div>
                <!-- end of form step -->

                <div class="form-step" id="form-step-3">
                    <div class="header">
                        <a href="index.php">
                            <div class="logo">
                                <h1>TalentVerse</h1>
                            </div>
                        </a>
                        <h3>Create your Account</h3>
                        <h2>Step 3</h2>
                    </div>

                    <div class="boxicon">
                        <label for="dob">Date of Birth:</label>
                        <input type="date" id="dob" name="dob" required>

                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" required>

                        <span class="error-message" id="error-message-3"></span>

                        <div class="side-btns">
                            <button type="button" class="prev-btn">Previous</button>
                            <button type="submit" class="next-btn">Sign Up</button>
                        </div>
                    </div>
                </div>
                <!-- end of form step -->
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const nextBtns = document.querySelectorAll('.next-btn');
            const prevBtns = document.querySelectorAll('.prev-btn');
            const formSteps = document.querySelectorAll('.form-step');
            const form = document.getElementById('signupForm');
            let formStepIndex = 0;

            nextBtns.forEach((btn, index) => {
                btn.addEventListener('click', () => {
                    const currentStep = formSteps[formStepIndex];
                    const errorMessage = document.getElementById(`error-message-${formStepIndex + 1}`);

                    if (validateStep(currentStep)) {
                        errorMessage.textContent = "";
                        currentStep.classList.remove('form-step-active');
                        formStepIndex++;
                        formSteps[formStepIndex].classList.add('form-step-active');
                    } else {
                        errorMessage.textContent = "You haven't filled all fields.";
                    }
                });
            });

            prevBtns.forEach((btn, index) => {
                btn.addEventListener('click', () => {
                    formSteps[formStepIndex].classList.remove('form-step-active');
                    formStepIndex--;
                    formSteps[formStepIndex].classList.add('form-step-active');
                    const errorMessage = document.getElementById(`error-message-${formStepIndex + 1}`);
                    errorMessage.textContent = "";
                });
            });

            function validateStep(step) {
                const inputs = step.querySelectorAll('input[required]');
                let allFilled = true;

                inputs.forEach(input => {
                    if (!input.value.trim()) {
                        allFilled = false;
                        input.classList.add('invalid');
                    } else {
                        input.classList.remove('invalid');
                    }
                });

                return allFilled;
            }
        });

        window.onload = function() {
            if (window.history.replaceState) {
                const url = new URL(window.location);
                url.searchParams.delete('error');
                url.searchParams.delete('success');
                window.history.replaceState(null, null, url);
            }
        };
    </script>
</body>

</html>
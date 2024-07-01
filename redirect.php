<?php
session_start();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirect | TalentVerse</title>
    <link rel="stylesheet" href="css/styles.css">

    <!-- Boxicons icon -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="redirect">
        <div class="redirect-card">
            <div class="icon">
                <i class='bx bx-window-close'></i>
            </div>
            <div class="text">
                <h1>Your Account has been Banned unfortunately due some suspicious activity!</h1>
                <p>Sorry for the inconveniences caused. But if you feel this is an error on our part, please contact the following to get assisted!</p>
                <div class="contacts">
                    <ul>
                        <li><i class='bx bx-envelope'></i> geoffreyodokopira58@gmai.com</li>
                        <li><i class='bx bx-phone'></i> 0778907657</li>
                        <li><i class='bx bx-phone'></i> 0780442071</li>
                    </ul>
                </div>
                <a href="login.php">
                    <button>Back to Login</button>
                </a>
            </div>
        </div>
    </div>
</body>

</html>
<?php
session_start();

include_once "backend/functions.php";

// function login($email, $password) {
//     global $conn;
//     $role = "";
//     $tables = ["admin", "promoter", "users"];
//     foreach ($tables as $table) {
//         $query = "SELECT * FROM $table WHERE email = ?";
//         $stmt = $conn->prepare($query);
//         // Bind parameters
//         $stmt->bind_param("s", $email);
//         // Execute the statement
//         $stmt->execute();
//         // Get result set
//         $result = $stmt->get_result();
//         if ($result->num_rows == 1) {
//             $role = $table;
//             break;
//         }
//     }

//     if ($role !== "") {
//         // User exists, now verify the password
//         $sql = "SELECT * FROM $role WHERE email = ?";
//         $stmt = $conn->prepare($sql);
//         $stmt->bind_param("s", $email);
//         $stmt->execute();
//         $row = mysqli_fetch_array($result);
//         $db_result = $stmt->get_result();
//         if (mysqli_num_rows($db_result) == 1) {
//             $row = mysqli_fetch_array($db_result);
//             $dbpass = $row['password'];
//             if (password_verify($password, $dbpass)) {
//                 switch ($role) {
//                     case "admin":
//                         // $_SESSION['admin_id'] = $row['admin_id'];
//                         // $_SESSION['afname'] = $row['firstname'];
//                         // $_SESSION['alname'] = $row['lastname'];
//                         // $_SESSION['sprofile_pc'] = $row['profile_picture'];
//                         // header("location: admin/admin.php");
//                         echo "admin_login";
//                         break;
//                     case "promoter":
//                         // $_SESSION['promoter_id'] = $row['promoter_id'];
//                         // $_SESSION['brand'] = $row['brandname'];
//                         // $_SESSION['uname'] = $row['username'];
//                         // $_SESSION['pprofile_pc'] = $row['profile_picture'];
//                         // $_SESSION['delete_status'] = $row['delete_status'];
//                         // header("location: promoter/home.php");
//                         echo "promoter_login";
//                         break;
//                     case "user":
//                         // $_SESSION['user_id'] = $row['user_id'];
//                         // $_SESSION['username'] = $row['username'];
//                         // $_SESSION['userfname'] = $row['firstname'];
//                         // $_SESSION['userlname'] = $row['lastname'];
//                         // $_SESSION['tprofile_pc'] = $row['profile_picture'];
//                         // header("location: users/home.php");
//                         echo "user_login";
//                         break;
//                 }
//                 exit();
//             } else {
//                 return "Wrong Password";
//             }
//         }
//     } else {
//         return "Email not Found";
//     }
// }

function login($email, $password)
{
    global $conn;
    $role = "";
    $tables = ["admin", "promoter", "users"];
    $user = null;

    foreach ($tables as $table) {
        $query = "SELECT * FROM $table WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $role = $table;
            $user = $result->fetch_assoc();
            break;
        }
    }

    if ($role !== "" && $user !== null) {
        $dbpass = $user['password'];
        if (password_verify($password, $dbpass)) {
            switch ($role) {
                case "admin":
                    $_SESSION['admin_id'] = $user['admin_id'];
                    $_SESSION['afname'] = $user['firstname'];
                    $_SESSION['alname'] = $user['lastname'];
                    $_SESSION['sprofile_pc'] = $user['profile_picture'];
                    header("location: admin/admin.php");
                    break;
                case "promoter":
                    $_SESSION['promoter_id'] = $user['promoter_id'];
                    $_SESSION['brand'] = $user['brandname'];
                    $_SESSION['uname'] = $user['username'];
                    $_SESSION['pprofile_pc'] = $user['profile_picture'];
                    $_SESSION['delete_status'] = $user['delete_status'];
                    header("location: promoter/home.php");
                    break;
                case "users":
                    $_SESSION['user_id'] = $user['user_id'];
                    header("location: users/home.php");
                    break;
            }
            exit();
        } else {
            return "Invalid login credentials";
        }
    } else {
        return "Invalid login credentials";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $login = login($email, $password);

    if ($login !== null) {
        $error[] = $login;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | TalentVerse</title>

    <link rel="stylesheet" href="./css/styles.css">
</head>

<body>
    <div class="authenticate">
        <div class="auth">
            <div class="header">
                <a href="index.php">
                    <div class="logo">
                        <h1>TalentVerse</h1>
                    </div>
                </a>
                <h3>Log into your Account</h3>
            </div>
            <?php
            if (isset($error)) {
                foreach ($error as $error) { ?>
                    <div class="error">
                        <?php echo $error ?>
                    </div>
                <?php }
            }
            ?>
            <form method="post">
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Enter Your Email" id="" required>
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Enter Your Password" required>

                <span><a href="forgotpassword.php">Forgot Password?</a></span>
                <input type="submit" value="Login">
                <div>Don't have an account? <a href="signup.php">Sign Up</a></div>
            </form>
        </div>
    </div>
</body>

</html>
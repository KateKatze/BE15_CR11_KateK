<?php
session_start();
require_once 'components/db_connect.php';

// it will never let you open index (login) page if session is set
if (isset($_SESSION['user']) != "") {
    header("Location: home.php");
    exit;
}
if (isset($_SESSION['adm']) != "") {
    header("Location: dashboard.php"); // redirects to home.php
}

$error = false;
$email = $password = $emailError = $passError = '';

if (isset($_POST['btn-login'])) {

    // prevent sql injections/ clear user invalid inputs
    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $pass = trim($_POST['password']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);

    if (empty($email)) {
        $error = true;
        $emailError = "Please enter your email address.";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter valid email address.";
    }

    if (empty($pass)) {
        $error = true;
        $passError = "Please enter your password.";
    }

    // if there's no error, continue to login
    if (!$error) {

        $password = hash('sha256', $pass); // password hashing

        $sql = "SELECT users_id, first_name, password, status FROM users WHERE email = '$email'";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_assoc($result);
        $count = mysqli_num_rows($result);
        if ($count == 1 && $row['password'] == $password) {
            if ($row['status'] == 'adm') {
                $_SESSION['adm'] = $row['users_id'];
                header("Location: dashboard.php");
            } else {
                $_SESSION['user'] = $row['users_id'];
                header("Location: home.php");
            }
        } else {
            $errMSG = "Ooops, incorrect credentials! Please try again.";
        }
    }
}

mysqli_close($connect);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Registration System</title>
    <?php require_once 'components/boot.php' ?>
</head>

<body>
    <div class="container d-flex justify-content-center">
        <form class="card shadow p-5 w-50" style="margin-top: 10vh;" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
            <h2 class="mt-5 text-center">Welcome to Vienna largest pet portal!</h2>
            <p class="mt-3 text-center">Please, log in to the system</p>
            <hr />
            <?php
            if (isset($errMSG)) {
                echo $errMSG;
            }
            ?>

            <input type="email" autocomplete="off" name="email" class="form-control" placeholder="Email" value="<?php echo $email; ?>" maxlength="40" />
            <span class="text-danger"><?php echo $emailError; ?></span>
            <br>
            <input type="password" name="password" class="form-control" placeholder="Password" maxlength="15" />
            <span class="text-danger"><?php echo $passError; ?></span>
            
            <hr />
            <button class="btn btn-lg btn-primary" type="submit" name="btn-login">Sign In</button>
            <hr />
            <p>Not registered yet?</p>
            <a href="register.php" class="btn btn-success">Sign up</a>
        </form>
    </div>
</body>
</html>
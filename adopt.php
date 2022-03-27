<?php
session_start();
require_once 'components/boot.php';
require_once 'components/db_connect.php';
require_once 'components/file_upload.php';

// if session is not set this will redirect to login page
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

$backBtn = '';
//if it is a user it will create a back button to home.php
if (isset($_SESSION["user"])) {
    $backBtn = "home.php";
}
//if it is a adm it will create a back button to dashboard.php
if (isset($_SESSION["adm"])) {
    $backBtn = "dashboard.php";
}

$sql1 = "SELECT * FROM pet_adoption WHERE fk_user_id = {$_SESSION["user"]} AND fk_animal_id = {$_GET["id"]}";
$res1 = mysqli_query($connect, $sql1);
if (mysqli_num_rows($res1) > 0) {
    header("location: products/error.php");
}

$sql = "INSERT INTO pet_adoption (fk_user_id, fk_animal_id) VALUES ({$_SESSION["user"]}, {$_GET["id"]})";
$res = mysqli_query($connect, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once 'components/boot.php'?>
    <title>Adopt this animal</title>
</head>
<body>
<div class="container">
        <div class="card shadow p-5 w-50 mt-5" style="margin: 0 auto;">
            <?php 
            if($res){
                echo "You have successfully adopted this animal!";
            }else {
                echo "Ooops! Something went wrong, please try again!";
            }
            ?>
        <a class="btn btn-primary mt-3" style='width: 5vw;' href="home.php" role="button">Home</a>
        </div>
    </div>
</body>
</html>
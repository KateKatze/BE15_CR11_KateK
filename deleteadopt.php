<?php

session_start();
require_once 'components/db_connect.php';
require_once 'components/boot.php';

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}


$class = 'd-none';

$id = $_GET["id"];
$sql = "DELETE FROM pet_adoption WHERE fk_animal_id = {$id}";
$res = mysqli_query($connect, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Adoption request</title>
    <?php require_once 'components/boot.php'?>
</head>
<body>
    <div class="container">
        <div class="card shadow p-5 w-50 mt-5" style="margin: 0 auto;">
            <?php 
            if($res){
                echo "Your adoption request has been successfully deleted!";
            }else {
                echo "Ooops! Something went wrong, please try again!";
            }
            ?>
        <a class="btn btn-primary mt-3" style='width: 5vw;' href="home.php" role="button">Home</a>
        </div>
    </div>
</body>
</html>
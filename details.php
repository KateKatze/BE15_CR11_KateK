<?php 
require_once 'components/db_connect.php';

if ($_GET['id']) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM animals WHERE animal_id = {$id}";
    $result = mysqli_query($connect, $sql);
    $data = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) == 1) {
        $location = $data['location'];
        $description = $data['description'];
        $size = $data['size'];
        $age = $data['age'];
        $hobbies = $data['hobbies'];
        $breed = $data['breed'];
        $photo = $data['photo'];
        $tcontent = "<tr>
            <td>" .$photo."</td>
            <td>" .$location."</td>
            <td>" .$description."</td>
            <td>" .$size."</td>
            <td>" .$age."</td>
            <td>" .$hobbies."</td>
            <td>" .$breed."</td>
            <td><a href='adopt.php?id=" . $_GET['id'] . "'><button class='btn btn-success btn-sm' type='button'>Adopt</button></a>
            </td>
            </tr>";
    } else {
        header("location: error.php");
    }
    mysqli_close($connect);
} else {
    header("location: error.php");
}  
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Animal Info</title>
        <?php require_once 'components/boot.php'?>
        <style type="text/css">
            .manageProduct {           
                margin: auto;
            }
            .img-thumbnail {
                width: 70px !important;
                height: 70px !important;
            }
            td {          
                text-align: center;
                vertical-align: middle;
            }
            tr {
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="manageProduct w-75 mt-3">    
            <p class='h2 text-center mt-5 mb-5'> <?= $description ?> </p>
            <img src="pictures/<?= $photo ?>" class="rounded mx-auto d-block mb-3 " alt="<?= $description ?>" width="200px">
            <table class='table table-striped'>
                <thead class='table-secondary'>
                    <tr>
                        <th class='h5'>Photo</th>
                        <th class='h5'>Location</th>
                        <th class='h5'>Description</th>
                        <th class='h5'>Size</th>
                        <th class='h5'>Age</th>
                        <th class='h5'>Hobbies</th>
                        <th class='h5'>Breed</th>
                        <th class='h5'>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?= $tcontent;?>
                </tbody>
            </table>
            <div class='mb-3 d-flex justify-content-end'>
                <a href= "index.php"><button class='btn btn-md btn-primary' type="button">Back to catalogue</button></a>
            </div>
        </div>
    </body>
</html>
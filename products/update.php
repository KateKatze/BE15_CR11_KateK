<?php
session_start();

if (isset($_SESSION['user']) != "") {
    header("Location: ../home.php");
    exit;
}

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit;
}

require_once '../components/db_connect.php';

if ($_GET['id']) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM animals WHERE animal_id = {$id}";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);
        $photo = $data['photo'];
        $location = $data['location'];
        $description = $data['description'];
        $size = $data['size'];
        $age = $data['age'];
        $hobbies = $data['hobbies'];
        $breed = $data['breed'];
    } else {
        header("location: error.php");
    }
    mysqli_close($connect);
} else {
    header("location: error.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Animal Info</title>
    <?php require_once '../components/boot.php' ?>
    <style type="text/css">
        fieldset {
            margin: auto;
            margin-top: 100px;
            width: 60%;
        }

        .img-thumbnail {
            width: 140px !important;
            height: auto !important;
        }
    </style>
</head>

<body>
    <fieldset>
        <legend class='h2 me-5 mb-5'>Update Animal Info<img class='img-thumbnail rounded ms-5' src='../pictures/<?php echo $photo ?>' alt="<?php echo $description ?>"></legend>
        <form action="actions/a_update.php" method="post" enctype="multipart/form-data">
            <table class="table">
                <tr>
                    <th>Location</th>
                    <td><input class="form-control" type="text" name="location" placeholder="Location" value="<?php echo $location ?>" /></td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td><input class="form-control" type="text" name="description" placeholder="Description" value="<?php echo $description ?>" /></td>
                </tr>
                <tr>
                    <th>Size</th>
                    <td><input class="form-control" type="text" name="size" placeholder="Size" value="<?php echo $size ?>" /></td>
                </tr>
                <tr>
                    <th>Age</th>
                    <td><input class="form-control" type="text" name="age" placeholder="Age" value="<?php echo $age ?>" /></td>
                </tr>
                <tr>
                    <th>Hobbies</th>
                    <td><input class="form-control" type="text" name="hobbies" placeholder="Hobbies" value="<?php echo $hobbies ?>" /></td>
                </tr>
                <tr>
                    <th>Breed</th>
                    <td><input class="form-control" type="text" name="breed" placeholder="Breed" value="<?php echo $breed ?>" /></td>
                </tr>
                <tr>
                    <th>Photo</th>
                    <td><input class="form-control" type="file" name="picture" /></td>
                </tr>
              
                <tr>
                    <input type="hidden" name="animal_id" value="<?php echo $data['animal_id'] ?>" />
                    <input type="hidden" name="picture" value="<?php echo $data['photo'] ?>" />
                    <td><button class="btn btn-success" type="submit">Save Changes</button></td>
                    <td><a href="index.php"><button class="btn btn-warning" type="button">Back</button></a></td>
                </tr>
            </table>
        </form>
    </fieldset>
</body>
</html>
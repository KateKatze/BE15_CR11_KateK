<?php
session_start();
require_once 'components/db_connect.php';


// if adm will redirect to dashboard

if (isset($_SESSION['adm'])) {
    header("Location: dashboard.php");
    exit;
}

// if session is not set this will redirect to login page
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

// setting age
$senioranim = false;
$age = -1;

    if (isset($_GET['senioranim']) && ($_GET['senioranim'] == "old")){
    $senioranim = true;
    $age = 8;
    }

// select logged-in users details - procedural style
$res = mysqli_query($connect, "SELECT * FROM users WHERE users_id = " . $_SESSION['user']);
$rowuser = mysqli_fetch_array($res, MYSQLI_ASSOC);

$sql = "SELECT * FROM animals WHERE age > '$age' AND status = 0";
$result = mysqli_query($connect,$sql);
$tbody ='';

if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $tbody.="<tr>
        <td><img class='img-thumbnail' src='pictures/" . $row['photo'] . "'</td>
        <td>" . $row['location'] . "</td>
        <td>" . $row['description'] . "</td>
        <td>" . $row['size'] . "</td>
        <td>" . $row['age'] . "</td>
        <td>" . $row['hobbies'] . "</td>
        <td>" . $row['breed'] . "</td>
        <td>
        <a href='details.php?id=" . $row['animal_id'] . "'><button class='btn btn-primary btn-sm mb-2' style='width: 5vw;' type='button'>Details</button></a>
        <a href='adopt.php?id=" . $row['animal_id'] . "'><button class='btn btn-success btn-sm' style='width: 5vw;' type='button'>Adopt</button></a>
        </td>
        </tr>";
    };
} else {
$tbody =  "<tr><td colspan='8'><center>No Data Available </center></td></tr>"; 
}

$sql1 = "SELECT * from animals JOIN pet_adoption ON animals.animal_id=pet_adoption.fk_animal_id WHERE pet_adoption.fk_user_id = " . $_SESSION['user'];
$result1 = mysqli_query($connect,$sql1);
$tbody1 ='';

if(mysqli_num_rows($result1) > 0){
    while($row = mysqli_fetch_array($result1, MYSQLI_ASSOC)){
        $tbody1.="<tr>
        <td><img class='img-thumbnail' src='pictures/" . $row['photo'] . "'</td>
        <td>" . $row['location'] . "</td>
        <td>" . $row['description'] . "</td>
        <td>" . $row['size'] . "</td>
        <td>" . $row['age'] . "</td>
        <td>" . $row['hobbies'] . "</td>
        <td>" . $row['breed'] . "</td>
        <td><a href='deleteadopt.php?id=" . $row['animal_id'] . "'><button class='btn btn-danger btn-sm' type='button'>Cancel</button></a></td>
        </tr>";
    };
} else {
$tbody1 =  "<tr><td colspan='8'><center>No Data Available </center></td></tr>"; 
}


mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - <?php echo $rowuser['first_name']; ?></title>
    <?php require_once 'components/boot.php' ?>
    <style>
        .userImage {
            width: 50px;
            height: 50px;
        }

        .hero {
            background: rgb(2, 0, 36);
            background: linear-gradient(24deg, rgba(2, 0, 36, 1) 0%, rgba(0, 212, 255, 1) 100%);
        }

        .img-thumbnail {
            width: 140px !important;
            height: auto !important;
        }
    </style>
</head>

<body>

    <!-- Navbar -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><h4 class="text-light mt-1 ms-2 me-2">Hi, <?php echo $rowuser['first_name']; ?>!</h4></a>
            <img class="userImage rounded me-5" src="pictures/<?= $rowuser['picture'] ?>" alt="Adm avatar">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link" href="logout.php?logout">Sign Out</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>
    
    <!-- Animals adopted by me -->
    <div class="container">
        <p class='h2 mt-5 mb-5'>Animals adopted by me</p>
        <table class='table table-striped mb-5'>
            <thead class='table-secondary'>
                <tr>
                    <th>Photo</th>
                    <th>Location</th>
                    <th>Description</th>
                    <th>Size</th>
                    <th>Age</th>
                    <th>Hobbies</th>
                    <th>Breed</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?= $tbody1; ?>
            </tbody>
        </table>
    </div>

    <!-- Animals list -->
    <div class="container">
        <p class='h2 mt-5 mb-5'>Animals</p>
        <a href="home.php?senioranim=<?= $senioranim ? 'young':'old' ?>" class="btn btn-md btn-success mb-5">Sort animals by age</a>
        <table class='table table-striped'>
            <thead class='table-secondary'>
                <tr>
                    <th>Photo</th>
                    <th>Location</th>
                    <th>Description</th>
                    <th>Size</th>
                    <th>Age</th>
                    <th>Hobbies</th>
                    <th>Breed</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?= $tbody; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
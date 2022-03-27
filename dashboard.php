<?php
session_start();
require_once 'components/db_connect.php';
// if session is not set this will redirect to login page
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

//if session user exist it shouldn't access dashboard.php
if (isset($_SESSION["user"])) {
    header("Location: home.php");
    exit;
}

$id = $_SESSION ['adm'];
$status = 'adm';

$sql = "SELECT users.* FROM users
WHERE `status` != 'adm'";
$result = mysqli_query($connect, $sql);
$tbody = '';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $tbody .= "<tr>
            <td><img class='img-thumbnail rounded' src='pictures/" . $row['picture'] . "' alt=" . $row['first_name'] . "></td>
            <td>" . $row['first_name'] . "</td>
            <td>" . $row['last_name'] . "</td>
            <td>" . $row['email'] . "</td>
            <td>" . $row['phone_number'] . "</td>
            <td>" . $row['address'] . "</td>
            <td><a href='updateadm.php?id=" . $row['users_id'] . "'><button class='btn btn-primary btn-sm' type='button'>Edit</button></a>
            <a href='delete.php?id=" . $row['users_id'] . "'><button class='btn btn-danger btn-sm' type='button'>Delete</button></a></td>
         </tr>";
    }
} else {
    $tbody = "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
}

mysqli_close($connect);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <?php require_once 'components/boot.php' ?>
    <style type="text/css">
        .img-thumbnail {
            width: 140px !important;
            height: auto !important;
        }

        td {
            text-align: left;
            vertical-align: middle;
        }

        tr {
            text-align: center;
        }

        .userImage {
            width: 50px;
            height: auto;
        }
    </style>
</head>

<body>
    <!-- Navbar -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><h4 class="text-light mt-1 ms-2 me-2">Hi, Admin!</h4></a>
            <img class="userImage me-5 rounded" src="pictures/admavatar.png" alt="Adm avatar">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link" href="products/index.php">Animals</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="logout.php?logout">Sign Out</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
                <p class='h2 mt-5 mb-5'>Users</p>
                <table class='table table-striped'>
                    <thead class='table-secondary'>
                        <tr>
                            <th>Picture</th>
                            <th>First name</th>
                            <th>Last name</th>
                            <th>Email</th>
                            <th>Phone number</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?= $tbody ?>
                    </tbody>
                </table>
        </div>
    </div>
</body>
</html>
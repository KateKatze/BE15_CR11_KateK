<?php

$localhost = "127.0.0.1";   
$username = "root";
$password = "";
$dbname = "be15_cr11_petadoption_katek";

// create connection
$connect = new mysqli($localhost, $username, $password, $dbname);

// check connection
if ($connect->connect_error) {
  die("Connection failed: " . $connect->connect_error);
}
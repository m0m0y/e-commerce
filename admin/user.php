<?php 
include "assets/common/header.php";
include "controller/function.php";
session_start();

$firstname = $_SESSION["firstname"];
$lastname = $_SESSION["lastname"];
$email = $_SESSION["email"];
$class->islogin($email);
?>
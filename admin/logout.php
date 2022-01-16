<?php
session_start();
require "controller/base.controller.php";

date_default_timezone_set("Singapore");
$user_group_id = $_SESSION["user_group"];
$email = $_SESSION["email"];
$date_added = date("Y-m-d h:i:sa");
$class->add_to_logs("user_group_id, email, activity, date_added", "'$user_group_id', '$email', 'Logout', '$date_added'");

session_destroy();
?>

<script>window.location.replace("index");</script>
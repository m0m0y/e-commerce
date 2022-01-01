<?php
session_start();
require "controller/function.php";
session_destroy();
?>

<script>window.location.replace("login");</script>
<?php
session_start();
require "controller/function.php";
session_destroy();
header("location: http://localhost/test/admin/");
?>
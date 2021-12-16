<?php
session_start();
include "controller/function.php";
session_destroy();
header("location: http://localhost/test/admin/");
?>
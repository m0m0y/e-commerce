<?php
class database_connection {
  private $servername;
  private $username;
  private $password;
  private $dbname;
 
  protected function db_conn() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "testdb";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    return $conn;
  }
}
?>
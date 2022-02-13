<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testdb";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$date_data = '';
$total_data = '';

$sql = "SELECT date_added, SUM(total) AS grand_total FROM orders WHERE order_status_id=8 GROUP BY date_added";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_array($result)) {
    $date_data = $date_data . '"'. $row['date_added'].'",';
    $total_data = $total_data . '"'. $row['grand_total'].'",';
}

if($result=mysqli_query($conn,$sql)) {
    $rowcount=mysqli_num_rows($result);
}

$date_data = trim($date_data,",");
$total_data = trim($total_data,",");
$rowcount;
?>
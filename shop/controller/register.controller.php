<?php
require "config.php";

class Register extends database_connection {
    function registration() {
        $firstname = $_POST["customer_firstname"];
        $lastname = $_POST["customer_lastname"];
        $email = $_POST["customer_email"];
        $telephone = $_POST["customer_telophone"];
        $password = $_POST["customer_password"];

        $ip = $_SERVER['REMOTE_ADDR'];
        $date_added = date("Y-m-d");

        $conn = $this->db_conn();
        $sql = "INSERT INTO customer (firstname, lastname, email, telephone, password, ip, date_added) VALUES ('$firstname', '$lastname', '$email', '$telephone', '$password', '$ip', '$date_added');";

        $sql .= "INSERT INTO customer_ip (customer_id, email, ip, date_added) VALUES ((SELECT customer_id FROM customer WHERE email='$email'), '$email', '$ip', '$date_added');";
        
        if ($conn->multi_query($sql) === TRUE) {
			echo "New records created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
    } 
}

$class = new Register();

if(isset($_GET["registration"])){
	$class->registration();
}
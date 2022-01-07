<?php
require "config.php";
date_default_timezone_set("Singapore");

class Register extends database_connection {
    function registration() {
        $firstname = $_POST["customer_firstname"];
        $lastname = $_POST["customer_lastname"];
        $email = $_POST["customer_email"];
        $telephone = $_POST["customer_telophone"];
        $password = $_POST["customer_password"];

        $ip = $_SERVER['REMOTE_ADDR'];
        $date_added = date("Y-m-d h:i:sa");

        $address_1 = $_POST["address_1"];
        $address_2 = $_POST["address_2"];
        $city = $_POST["city"];
        $postcode = $_POST["postcode"];
        $region = $_POST["region"];

        $conn = $this->db_conn();
        $sql = "INSERT INTO customer (firstname, lastname, email, telephone, password, ip, date_added) VALUES ('$firstname', '$lastname', '$email', '$telephone', '$password', '$ip', '$date_added');";

        $sql .= "INSERT INTO customer_ip (customer_id, email, ip, date_added) VALUES ((SELECT customer_id FROM customer WHERE email='$email'), '$email', '$ip', '$date_added');";

        $sql .= "INSERT INTO customer_address (customer_id, firstname, lastname, address_1, address_2, city, postcode, region) VALUES ((SELECT customer_id FROM customer WHERE email='$email'), '$firstname', '$lastname', '$address_1', '$address_2', '$city', '$postcode', '$region');";
        
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
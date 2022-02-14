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
        $sql = "SELECT * FROM customer WHERE email='$email'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				if ($row["email"] == $email) {
                    echo "existing email";
                }
			}
		} else {
            $sql = "INSERT INTO customer (firstname, lastname, email, telephone, password, ip, date_added) VALUES ('$firstname', '$lastname', '$email', '$telephone', '$password', '$ip', '$date_added');";

            $sql .= "INSERT INTO customer_ip (customer_id, email, ip, date_added) VALUES ((SELECT customer_id FROM customer WHERE email='$email'), '$email', '$ip', '$date_added');";

            $sql .= "INSERT INTO customer_address (customer_id, firstname, lastname, address_1, address_2, city, postcode, region) VALUES ((SELECT customer_id FROM customer WHERE email='$email'), '$firstname', '$lastname', '$address_1', '$address_2', '$city', '$postcode', '$region');";

            if ($conn->multi_query($sql) === TRUE) {
                echo "success";
                $this->get_customer();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    function get_customer() {
        $email = $_POST["customer_email"];
        $password = $_POST["customer_password"];

        $conn = $this->db_conn();
        $sql = "SELECT * FROM customer WHERE email='$email' AND password='$password' AND status=1";
		$result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				session_start();
				$_SESSION["customer_id"] = $row["customer_id"];
				$_SESSION["firstname"] = $row["firstname"];
				$_SESSION["lastname"] = $row["lastname"];
				$_SESSION["email"] = $row["email"];
				$_SESSION["telephone"] = $row["telephone"];
				$_SESSION["password"] = $row["password"];

				// Update cart customer id that get in the session 
				if (isset($_POST)) {
					$this->update_cart($_SESSION["customer_id"]);
				}
			}
		} else {
			echo "invalid";
		}
    }

    // Get the function get_cart_customer_id to where the cart_id thats equal to 0
    function update_cart($customer_id) {
		$conn = $this->db_conn();
		$sql = "UPDATE cart SET customer_id='$customer_id' WHERE cart_id='".$this->get_cart_customer_id("cart_id")."'";

		if ($conn->query($sql) === TRUE) {
			echo "";
		} else {
			echo "cart update error";
		}
	}

    // Get customer id that equal to 0
    function get_cart_customer_id($column) {
		$conn = $this->db_conn();
		$sql = "SELECT $column FROM cart WHERE customer_id=0";
		$result = mysqli_fetch_assoc($conn->query($sql));

        if ($result == NULL) {
			echo "success";
		} else {
			echo "success";
			return $result[$column];
		}
	}
}

$class = new Register();

if(isset($_GET["registration"])){
	$class->registration();
}
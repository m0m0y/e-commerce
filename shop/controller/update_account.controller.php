<?php
require "config.php";

class Update_Account extends database_connection { 
    function update_customer() {
        session_start();
        $customer_id = $_POST["customer_id"];
        $_SESSION["firstname"] = $_POST["firstname"];
        $_SESSION["lastname"] = $_POST["lastname"];
        $_SESSION["email"] = $_POST["email"];
        $_SESSION["telephone"] = $_POST["telephone"];

        $conn = $this->db_conn();
		$sql = "UPDATE customer SET firstname='".$_SESSION["firstname"]."', lastname='".$_SESSION["lastname"]."', email='".$_SESSION["email"]."', telephone='".$_SESSION["telephone"]."' WHERE customer_id='$customer_id'";

        $sql1 = $this->update_orders_tables("orders", "firstname='".$_SESSION["firstname"]."', lastname='".$_SESSION["lastname"]."', email='".$_SESSION["email"]."', telephone='".$_SESSION["telephone"]."'", "customer_id='$customer_id'");

		if ($conn->query($sql) === TRUE || $conn->query($sql1) === TRUE) {
			echo "Record updated successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}
    }

    function update_customer_password() {
        session_start();
        $customer_id = $_POST["customer_id"];
        $password = $_POST["password"];

        $conn = $this->db_conn();
		$sql = "UPDATE customer SET password='$password' WHERE customer_id='$customer_id'";

		if ($conn->query($sql) === TRUE) {
			echo "Record updated successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}
    }

    function update_customer_address() {
        session_start();
        $customer_id = $_POST["customer_id"];
        $address_1 = $_POST["address_1"];
        $address_2 = $_POST["address_2"];
        $city = $_POST["city"];
        $postcode = $_POST["postcode"];
        $region = $_POST["region"];

        $conn = $this->db_conn();
		$sql = "UPDATE customer_address SET address_1='$address_1', address_2='$address_2', city='$city', postcode='$postcode', region='$region' WHERE customer_id='$customer_id'";

		if ($conn->query($sql) === TRUE) {
			echo "Record updated successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}
    }

    function update_orders_tables($table, $column, $wherevalues) {
		$conn = $this->db_conn();
		$sql = "UPDATE $table SET $column WHERE $wherevalues";
		
		if ($conn->query($sql) === TRUE) {
			echo "";
		} else {
			echo "Error updating record: " . $conn->error;
		}
	}

    function reset_password() {
        $email = $_POST["customer_email"];
        $password = $_POST["customer_password"];
        
        $conn = $this->db_conn();
		$sql = "UPDATE customer SET password='$password' WHERE email='$email'";

		if ($conn->query($sql) === TRUE) {
			echo "Record updated successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}
    }
}

$class = new Update_Account();

if(isset($_GET["update_customer"])){
    $class->update_customer();
}

if(isset($_GET["update_customer_password"])){
    $class->update_customer_password();
}

if(isset($_GET["update_customer_address"])){
    $class->update_customer_address();
}

if(isset($_GET["reset_password"])){
    $class->reset_password();
}
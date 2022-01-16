<?php
require "config.php";

class Login extends database_connection {
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
			echo "success";
		} else {
			echo "error";
		}
	}

	// Get customer id that equal to 0
	function get_cart_customer_id($column) {
		$conn = $this->db_conn();
		$sql = "SELECT $column FROM cart WHERE customer_id=0";
		$result = mysqli_fetch_assoc($conn->query($sql));

        return $result[$column];
	}

}

$class = new Login();

if(isset($_GET["get_customer"])){
	$class->get_customer();
}
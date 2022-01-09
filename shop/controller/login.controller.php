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
				$_SESSION["password"] = $row["password"];

				if (isset($_POST)) {
					$this->update_cart($row["customer_id"]);
				}
			}
		} else {
			echo "invalid";
		} 
    }

	function update_cart($customer_id) {
		$conn = $this->db_conn();
		$sql = "UPDATE cart SET customer_id='$customer_id' WHERE customer_id='$customer_id'";

		if ($conn->query($sql) === TRUE) {
			echo "success";
		} else {
			echo "mali";
		}
	}
}

$class = new Login();

if(isset($_GET["get_customer"])){
	$class->get_customer();
}
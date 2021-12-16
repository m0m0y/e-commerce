<?php
require("config.php");


class Main extends database_connection{

	function register() {
		$fname = $_POST["fname"];
		$lname = $_POST["lname"];
		$email = $_POST["mail"];
		$pass = $_POST["pass"];

		$conn = $this->db_conn();
		$sql = "INSERT INTO admin_user (firstname, lastname, email, password) VALUES ('".$fname."', '".$lname."', '".$email."', '".$pass."')";
		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}

	function login() {
		$email = $_POST["email"];
		$pass = $_POST["pass"];

		$conn = $this->db_conn();
		$sql = "SELECT * FROM admin_user WHERE email='$email' AND password='$pass'";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				session_start();
				$_SESSION["id"] = $row["id"];
				$_SESSION["firstname"] = $row["firstname"];
				$_SESSION["lastname"] = $row["lastname"];
				$_SESSION["email"] = $row["email"];
				$_SESSION["password"] = $row["password"];
				echo "success";
			}
		} else {
			echo "invalid";
		}
	}

	function islogin($email) {
		if($email=="") {
			header("location: http://localhost/test/admin/");
		}
	}

	function update_profile() {
		session_start();
		$user_id = $_POST["userId"];
		$_SESSION["firstname"] = $_POST["fname"];
		$_SESSION["lastname"] = $_POST["lname"];
		$_SESSION["email"] = $_POST["mail"];
		$pass = $_POST["pass"];

		if($pass == NULL || $pass == "") {
			$conn = $this->db_conn();
			$sql = "UPDATE admin_user SET firstname='".$_SESSION["firstname"]."' , lastname='".$_SESSION["lastname"]."', email='".$_SESSION["email"]."' WHERE id='$user_id'";
			$result = mysqli_query($conn, $sql);
		} else {
			$conn = $this->db_conn();
			$sql = "UPDATE admin_user SET firstname='".$_SESSION["firstname"]."' , lastname='".$_SESSION["lastname"]."', email='".$_SESSION["email"]."', password='$pass' WHERE id='$user_id'";
			$result = mysqli_query($conn, $sql);
		}
	}

	function select_user_groups() {
		$conn = $this->db_conn();
		$sql = "SELECT * FROM admin_user_group";
		$result = mysqli_query($conn, $sql);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo $row["name"];
			}
		}
	}
}

$class = new Main();

if(isset($_GET["login"])){
	$class->login();
}

if(isset($_GET["register"])){
	$class->register();
}

if(isset($_GET["update_profile"])){
	$class->update_profile();
}
?>
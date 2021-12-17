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
		$table="";
		$conn = $this->db_conn();
		$sql = "SELECT * FROM admin_user_group WHERE user_group_status = 1";
		$result = mysqli_query($conn, $sql);

		$table .= '
			<div align="right" style="margin-bottom:5px;">
				<button type="button" id="add_user_button" class="btn btn-sm btn-primary" onclick="add_user_group()"><i class="fas fa-user-plus"></i> Add New</button>
			</div>
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>User Group Name</th>
						<th>Action</th>
					</tr>
				</thead>

				<tbody>
		';

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$user_group_name = $row["user_group_name"];
				$user_group_id  = $row['user_group_id'];
		
				$table .= '
					<tr>
						<td>'.$user_group_name.'</td>
						<td>
							<button type="button" name="update" class="btn btn-sm btn-info" id="update_user_button" onclick="update_user_group('.$user_group_id.',\''.$user_group_name.'\')"><i class="fas fa-pencil-alt"></i></button>

							<button type="button" name="deletes" class="btn btn-sm btn-danger" onclick="delete_user_group('.$user_group_id.')"><i class="fas fa-trash-alt"></i></button>
						</td>
					</tr>
				';
			}
		} else {
			$table .= '
			<tr>
				<td colspan="6" align="center">No data found</td>
			</tr>
			';
		}

		$table .='
				
				</tbody>
			</table>
		';

		echo $table;
	} 

	function add_user_groups() {
		$name = $_POST["name"];

		$conn = $this->db_conn();
		$sql = "INSERT INTO admin_user_group (user_group_name) VALUES ('".$name."')";
		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}

	function update_user_groups() {
		$user_group_id = $_POST["user_group_id"];
		$name = $_POST["name"];

		echo $name;

		$conn = $this->db_conn();
		$sql = "UPDATE admin_user_group SET user_group_name='$name' WHERE user_group_id ='$user_group_id'";
		if ($conn->query($sql) === TRUE) {
			echo "Record updated successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}
	}

	function delete_user_groups() {
		$user_group_id = $_POST["user_group_id"];

		$conn = $this->db_conn();
		$sql = "UPDATE admin_user_group SET user_group_status=0 WHERE user_group_id='$user_group_id'";
		if ($conn->query($sql) === TRUE) {
			echo "Record delete successfully";
		} else {
			echo "Error updating record: " . $conn->error;
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

if(isset($_GET["delete_user_groups"])){
	$class->delete_user_groups();
}

if(isset($_GET["add_user_groups"])){
	$class->add_user_groups();
}

if(isset($_GET["update_user_groups"])){
	$class->update_user_groups();
}

?>
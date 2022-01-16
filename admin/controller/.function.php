<?php
require "config.php";
date_default_timezone_set("Singapore");

class Main extends database_connection{

	function login() {
		$email = $_POST["email"];
		$pass = $_POST["pass"];

		$conn = $this->db_conn();
		$sql = "SELECT * FROM admin_user WHERE email='$email' AND password='$pass' AND admin_status=1";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				session_start();
				$_SESSION["id"] = $row["id"];
				$_SESSION["firstname"] = $row["firstname"];
				$_SESSION["lastname"] = $row["lastname"];
				$_SESSION["email"] = $row["email"];
				$_SESSION["password"] = $row["password"];
				$_SESSION["user_group"] = $row["user_group"];
				echo "success";

				$user_group_id = $_SESSION["user_group"];
				$email = $_SESSION["email"];
				$date_added = date("Y-m-d h:i:sa");

				// Add activity logs
				$this->add_to_logs("user_group_id, email, activity, date_added", "'$user_group_id', '$email', 'Login on dashboard', '$date_added'");
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
		
		$user_group_id = $_SESSION["user_group"];
		$email = $_SESSION["email"];
		$date_added = date("Y-m-d h:i:sa");

		$conn = $this->db_conn();

		if($pass == NULL || $pass == "") {
			$sql = "UPDATE admin_user SET firstname='".$_SESSION["firstname"]."' , lastname='".$_SESSION["lastname"]."', email='".$_SESSION["email"]."' WHERE id='$user_id'";
			$result = mysqli_query($conn, $sql);
		} else {
			$sql = "UPDATE admin_user SET firstname='".$_SESSION["firstname"]."' , lastname='".$_SESSION["lastname"]."', email='".$_SESSION["email"]."', password='$pass' WHERE id='$user_id'";
			$result = mysqli_query($conn, $sql);
		}

		// Add activity logs
		$this->add_to_logs("user_group_id, email, activity, date_added", "'$user_group_id', '$email', 'Update Profile', '$date_added'");
	}

	function select_user_groups() {
		$table="";
		$conn = $this->db_conn();
		$sql = "SELECT * FROM admin_user_group WHERE user_group_status = 1";
		$result = mysqli_query($conn, $sql);

		// Check session user group
		if ($_SESSION["user_group"] == 2) {
			$table .= '
				<div align="right" style="margin-bottom:5px;">
					<button type="button" id="add_user_button" class="btn btn-sm btn-primary" disabled><i class="fas fa-user-plus"></i> Add New</button>
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
		} else {
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
		}

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$user_group_name = $row["user_group_name"];
				$user_group_id  = $row['user_group_id'];
				
				// Check session user group
				if ($_SESSION["user_group"] == 2) { 
					$table .= '
						<tr>
							<td>'.$user_group_name.'</td>
							<td>
								<button type="button" class="btn btn-sm btn-info" disabled><i class="fas fa-pencil-alt"></i></button>

								<button type="button" class="btn btn-sm btn-danger" disabled><i class="fas fa-trash-alt"></i></button>
							</td>
						</tr>
					';	
				} else {
					$table .= '
						<tr>
							<td>'.$user_group_name.'</td>
							<td>
								<button type="button" class="btn btn-sm btn-info" onclick="update_user_group('.$user_group_id.',\''.$user_group_name.'\')"><i class="fas fa-pencil-alt"></i></button>

								<button type="button" class="btn btn-sm btn-danger" onclick="delete_user_group('.$user_group_id.')"><i class="fas fa-trash-alt"></i></button>
							</td>
						</tr>
					';
				}
				
			}
		}

		$table .='
				</tbody>
			</table>
		';

		echo $table;
	} 

	function add_user_groups() {
		$email = $_POST["email"];
		$ses_group_id = $_POST["ses_group_id"];
		$name = $_POST["name"];
		$date_added = date("Y-m-d h:i:sa");

		$conn = $this->db_conn();
		$sql = "INSERT INTO admin_user_group (user_group_name) VALUES ('$name')";

		// Add activity logs
		$this->add_to_logs("user_group_id, email, activity, date_added", "'$user_group_id', '$email', 'Add on user groups', '$date_added'");

		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}

	function update_user_groups() {
		$email = $_POST["email"];
		$ses_group_id = $_POST["ses_group_id"];
		$user_group_id = $_POST["user_group_id"];
		$name = $_POST["name"];
		$date_added = date("Y-m-d h:i:sa");

		$conn = $this->db_conn();
		$sql = "UPDATE admin_user_group SET user_group_name='$name' WHERE user_group_id ='$user_group_id'";

		// Add activity logs
		$this->add_to_logs("user_group_id, email, activity, date_added", "'$ses_group_id', '$email', 'Update on user groups', '$date_added'");

		if ($conn->query($sql) === TRUE) {
			echo "Record updated successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}
	}

	function delete_user_groups() {
		$email = $_POST["email"];
		$ses_group_id = $_POST["ses_group_id"];
		$user_group_id = $_POST["user_group_id"];
		$date_added = date("Y-m-d h:i:sa");

		$conn = $this->db_conn();
		// Update status
		$sql = "UPDATE admin_user_group SET user_group_status=0 WHERE user_group_id='$user_group_id'";

		// Auto update the table of admin_user
		$sql1 = "UPDATE admin_user SET admin_status=0 WHERE user_group='$user_group_id'";
		
		// Add activity logs
		$this->add_to_logs("user_group_id, email, activity, date_added", "'$ses_group_id', '$email', 'Delete on user groups', '$date_added'");

		if ($conn->query($sql) === TRUE && $conn->query($sql1)) {
			echo "Record delete successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}
	}

	function get_admin_user_group($column, $user_group_id) {
        $conn = $this->db_conn();
        $sql = "SELECT $column FROM admin_user_group WHERE user_group_id='$user_group_id'";
        $result = mysqli_fetch_assoc($conn->query($sql));

        return $result[$column];
    }

	function get_admin_user() {
		$table="";
		$conn = $this->db_conn();
		$sql = "SELECT * FROM admin_user";
		$result = mysqli_query($conn, $sql);

		// Check session user group
		if ($_SESSION["user_group"] == 2) {
			$table .= '
				<div align="right" style="margin-bottom:5px;">
					<button type="button" id="add_user_button" class="btn btn-sm btn-primary" disabled><i class="fas fa-user-plus"></i> Add New</button>
				</div>
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>Firstname</th>
							<th>Lastname</th>
							<th>Status</th>
							<th>User Group</th>
							<th>Date Added</th>
							<th>Action</th>
						</tr>
					</thead>

					<tbody>
			';
		} else {
			$table .= '
				<div align="right" style="margin-bottom:5px;">
					<button type="button" id="add_user_button" class="btn btn-sm btn-primary" onclick="add_user_admin()"><i class="fas fa-user-plus"></i> Add New</button>
				</div>
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>Firstname</th>
							<th>Lastname</th>
							<th>Status</th>
							<th>User Group</th>
							<th>Date Added</th>
							<th>Action</th>
						</tr>
					</thead>

					<tbody>
			';
		}

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$admin_user_id = $row["id"];
				$firstname = $row["firstname"];
				$lastname  = $row["lastname"];
				$user_group_id = $row["user_group"];
				$email = $row["email"];
				$date_added = $row["date_added"];

				if($row["admin_status"] == 1) {
					$admin_status = "Enabled";
				} else {
					$admin_status = "Disabled";
				}

				$user_group_name = $this->get_admin_user_group("user_group_name", $user_group_id);

				// Check session user group
				if ($_SESSION["user_group"] == 2) {
					$table .= '
						<tr>
							<td>'.$firstname.'</td>
							<td>'.$lastname.'</td>
							<td>'.$admin_status.'</td>
							<td>'.$user_group_name.'</td>
							<td>'.$date_added.'</td>
							<td>
								<button type="button" class="btn btn-sm btn-info" disabled><i class="fas fa-pencil-alt"></i></button>

								<button type="button" class="btn btn-sm btn-danger" disabled><i class="fas fa-trash-alt"></i></button>
							</td>
						</tr>
					';
				} else {
					$table .= '
						<tr>
							<td>'.$firstname.'</td>
							<td>'.$lastname.'</td>
							<td>'.$admin_status.'</td>
							<td>'.$user_group_name.'</td>
							<td>'.$date_added.'</td>
							<td>
								<button type="button" class="btn btn-sm btn-info" onclick="update_admin_user(\'' . $admin_user_id . '\',\'' . $firstname . '\',\'' . $lastname . '\',\'' . $email . '\',\'' . $admin_status . '\',\'' . $user_group_id . '\')"><i class="fas fa-pencil-alt"></i></button>

								<button type="button" class="btn btn-sm btn-danger" onclick="delete_admin_user('.$admin_user_id.')"><i class="fas fa-trash-alt"></i></button>
							</td>
						</tr>
					';
				}
			}
		}

		$table .='
				</tbody>
			</table>
		';

		echo $table;
	}

	function get_user_group_id() {
		$conn = $this->db_conn();
		$sql = "SELECT * FROM admin_user_group WHERE user_group_status=1";
		$result = mysqli_query($conn, $sql);

		foreach ($result as $key => $value) {
			echo '
				<option value="'.$value["user_group_id"].'">'.$value["user_group_name"].'</option>
			';
		}
	}

	function add_user_admin() {
		$firstname = $_POST["fname"];
		$lastname = $_POST["lname"];
		$email = $_POST["mail"];
		$password = $_POST["pass"];
		$user_group = $_POST["user_group"];
		$admin_status = $_POST["admin_status"];

		$ses_email = $_POST["ses_email"];
		$ses_group_id = $_POST["ses_group_id"];

		$date_added = date("Y-m-d h:i:sa");

		$conn = $this->db_conn();
		$sql = "INSERT INTO admin_user (firstname, lastname, email, password, user_group, admin_status, date_added) VALUES ('$firstname', '$lastname', '$email', '$password', '$user_group', '$admin_status', '$date_added')";

		// Add activity logs
		$this->add_to_logs("user_group_id, email, activity, date_added", "'$ses_group_id', '$ses_email', 'Add new user', '$date_added'");

		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}

	function update_user_admins() {
		$id = $_POST["admin_user_id"];
		$firstname = $_POST["fname"];
		$lastname = $_POST["lname"];
		$email = $_POST["mail"];
		$pass = $_POST["pass"];
		$status = $_POST["admin_status"];

		$ses_email = $_POST["ses_email"];
		$ses_group_id = $_POST["ses_group_id"];
		$date_added = date("Y-m-d h:i:sa");

		$conn = $this->db_conn();

		if ($pass == NULL) {
			$sql = "UPDATE admin_user SET firstname='$firstname' , lastname='$lastname', email='$email', admin_status='$status' WHERE id='$id'";
			$result = mysqli_query($conn, $sql);
		} else {
			$sql = "UPDATE admin_user SET firstname='$firstname' , lastname='$lastname', email='$email', password='$pass', admin_status='$status' WHERE id='$id'";
			$result = mysqli_query($conn, $sql);
		}

		// Add activity logs
		$this->add_to_logs("user_group_id, email, activity, date_added", "'$ses_group_id', '$ses_email', 'Update 1 user details', '$date_added'");

		if ($conn->query($sql) === TRUE && $conn->query($sql1) === TRUE ) {
			echo "Record updated successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}
	}

	function delete_admin_users() {
		$admin_user_id = $_POST["admin_user_id"];

		$ses_email = $_POST["ses_email"];
		$ses_group_id = $_POST["ses_group_id"];
		$date_added = date("Y-m-d h:i:sa");

		$conn = $this->db_conn();
		$sql = "DELETE FROM admin_user WHERE id='$admin_user_id'";

		// Add activity logs
		$this->add_to_logs("user_group_id, email, activity, date_added", "'$ses_group_id', '$ses_email', 'Delete user account', '$date_added'");

		if ($conn->query($sql) === TRUE) {
			echo "Record delete successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}
	}

	function get_product() {
		$table = "";
		$conn = $this->db_conn();
		$sql = "SELECT product.product_id, product.product_name, product.quantity, product.stock_status_id, product.manufacturer_id, product.price, product.product_weight, product.weight_id, product.product_status, product_description.product_desc, product_description.meta_title, product_description.meta_description, product_description.meta_keywords FROM product INNER JOIN product_description ON product.product_id = product_description.product_id";
		$result = mysqli_query($conn, $sql);

		// Product table
		$table .= '
			<div align="right" style="margin-bottom:5px;">
				<button type="button" id="add_product_button" class="btn btn-sm btn-primary" onclick="add_product()"><i class="fas fa-plus-square"></i> Add New</button>
			</div>
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Product name</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>

				<tbody>
		';
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$product_id = $row["product_id"];
				$name = $row["product_name"];
				$quantity = $row["quantity"];
				$manufacturer_id = $row["manufacturer_id"];
				$price = $row["price"];
				$product_desc = $row["product_desc"];
				$meta_title = $row["meta_title"];
				$meta_description = $row["meta_description"];
				$meta_keywords = $row["meta_keywords"];
				$stock_status_id = $row["stock_status_id"];
				$product_weight = $row["product_weight"];
				$weight_id = $row["weight_id"];
				
				if ($row["product_status"] == 1) {
					$product_status = "Enable";
				} else {
					$product_status = "Disabled";
				}

				$product_category = $this->get_product_to_category($product_id);

				$table .= '
					<tr>
						<td>'.$name.'</td>
						<td>Php '.number_format($price, '2').'</td>
						<td>'.$quantity.'</td>
						<td>'.$product_status.'</td>
						<td>
							<button type="button" class="btn btn-sm btn-info" onclick="update_products(\'' . $product_id . '\',\'' . $name . '\',\'' . $quantity . '\',\'' . $manufacturer_id . '\',\'' . $price . '\',\'' . $product_status . '\',\'' . $product_desc . '\',\'' . $meta_title . '\',\'' . $meta_description . '\',\'' . $meta_keywords . '\',\'' . $stock_status_id . '\',\'' . $product_weight . '\',\'' . $weight_id . '\',\'' . $product_category . '\')"><i class="fas fa-pencil-alt"></i></button>

							<button type="button" class="btn btn-sm btn-danger" onclick="delete_products(\'' . $product_id . '\',)"><i class="fas fa-trash-alt"></i></button>
						</td>
					</tr>
				';
			}
		}

		$table .='
				</tbody>
			</table>
		';

		echo $table;
	}

	function get_stock_status_id() {
		$conn = $this->db_conn();
		$sql = "SELECT * FROM stock_status";
		$result = mysqli_query($conn, $sql);

		foreach ($result as $key => $value) {
			echo '
				<option value="'.$value["stock_status_id"].'">'.$value["name"].'</option>
			';
		}
	}

	function get_weight_description() {
		$conn = $this->db_conn();
		$sql = "SELECT * FROM weight_class_description";
		$result = mysqli_query($conn, $sql);

		foreach ($result as $key => $value) {
			echo '
				<option value="'.$value["id"].'">'.$value["title"].'</option>
			';
		}
	}

	function get_category_description() {
		$conn = $this->db_conn();
		$sql = "SELECT * FROM category_description";
		$result = mysqli_query($conn, $sql);

		foreach ($result as $key => $value) {
			echo '
				<option value="'.$value["category_id"].'">'.$value["category_name"].'</option>
			';
		}
	}

	function update_product() {
		$product_id = $_POST["product_id"];
		$product_name = $_POST["product_name"];
		$product_desc = $_POST["product_desc"];
		$meta_tag_title = $_POST["meta_tag_title"];
		$meta_tag_description = $_POST["meta_tag_description"];
		$meta_tag_keywords = $_POST["meta_tag_keywords"];
		$price = $_POST["price"];
		$quantity = $_POST["quantity"];
		$stock_status = $_POST["stock_status"];
		$product_weight = $_POST["product_weight"];
		$weight_class = $_POST["weight_class"];
		$product_status = $_POST["product_status"];
		$manufacturer_id = $_POST["manufacturer_id"];
		$product_category = $_POST["product_category"];

		$email = $_POST["email"];
		$ses_group_id = $_POST["ses_group_id"];
		$date_added = date("Y-m-d h:i:sa");

		$conn = $this->db_conn();
		// Update for Product table
		$sql = "UPDATE product SET product_name='$product_name', quantity='$quantity', stock_status_id='$stock_status', manufacturer_id='$manufacturer_id', price='$price', product_weight='$product_weight', weight_id='$weight_class', product_status='$product_status' WHERE product_id='$product_id'";

		// Update for Product Description table
		$sql1 = "UPDATE product_description SET product_name='$product_name', product_desc='$product_desc', meta_title='$meta_tag_title', meta_description='$meta_tag_description', meta_keywords='$meta_tag_keywords' WHERE product_id='$product_id'";

		// Update for product_to_category table
		$sql2 = "UPDATE product_to_category SET category_id='$product_category' WHERE product_id='$product_id'";

		// Add activity logs
		$this->add_to_logs("user_group_id, email, activity, date_added", "'$ses_group_id', '$email', 'Update product', '$date_added'");

		if ($conn->query($sql) === TRUE && $conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE) {
			echo "Record updated successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}
	}

	function delete_product() {
		$product_id = $_POST["product_id"];

		$email = $_POST["email"];
		$ses_group_id = $_POST["ses_group_id"];
		$date_added = date("Y-m-d h:i:sa");
		
		$conn = $this->db_conn();
		$sql = "DELETE FROM product WHERE product_id='$product_id'";
		$sql1 = "DELETE FROM product_description WHERE product_id='$product_id'";
		$sql2 = "DELETE FROM product_to_category WHERE product_id='$product_id'";

		// Add activity logs
		$this->add_to_logs("user_group_id, email, activity, date_added", "'$ses_group_id', '$email', 'Delete categories', '$date_added'");
		
		if ($conn->query($sql) === TRUE && $conn->query($sql1) === TRUE && $conn->query($sql2)) {
			echo "Record delete successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}
	}

	function add_product() {
		$product_name = $_POST["product_name"];
		$description = $_POST["description"];
		$meta_tag_title = $_POST["meta_tag_title"];
		$meta_tag_description = $_POST["meta_tag_description"];
		$meta_tag_keywords = $_POST["meta_tag_keywords"];
		$manufacturer_id = $_POST["manufacturer_id"];
		$product_category = $_POST["product_category"];
		$price = $_POST["price"];
		$quantity = $_POST["quantity"];
		$stock_status = $_POST["stock_status"];
		$product_weight = $_POST["product_weight"];
		$weight_class = $_POST["weight_class"];
		$product_status = $_POST["product_status"];

		$email = $_POST["email"];
		$ses_group_id = $_POST["ses_group_id"];

		$date_added = date("Y-m-d h:i:sa");

		$conn = $this->db_conn();
		$sql = "INSERT INTO product (product_name, quantity, stock_status_id, manufacturer_id, price, product_weight, weight_id, product_status, date_added) VALUES ('$product_name', '$quantity', '$stock_status', '$manufacturer_id', '$price', '$product_weight', '$weight_class', '$product_status', '$date_added');";

		$sql .= "INSERT INTO product_description (product_name, product_desc, meta_title, meta_description, meta_keywords) VALUES ('$product_name', '$description', '$meta_tag_title', '$meta_tag_description', '$meta_tag_keywords');";

		$sql .= "INSERT INTO product_to_category (product_id, category_id) VALUES ((SELECT product_id FROM product WHERE product_name='$product_name'), '$product_category');";

		// Add activity logs
		$this->add_to_logs("user_group_id, email, activity, date_added", "'$ses_group_id', '$email', 'Add new product', '$date_added'");

		if ($conn->multi_query($sql) === TRUE) {
			echo $product_category;
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}

	function get_categories() {
		$table = "";
		$conn = $this->db_conn();
		$sql = "SELECT categories.category_id, categories.category_status, categories.date_added, category_description.category_id, category_description.category_name, category_description.description, category_description.meta_title FROM categories INNER JOIN category_description ON categories.category_id = category_description.category_id";
		$result = mysqli_query($conn, $sql);

		$table .= '
			<div align="right" style="margin-bottom:5px;">
				<button type="button" id="add_product_button" class="btn btn-sm btn-primary" onclick="add_category()"><i class="fas fa-plus-square"></i> Add New</button>
			</div>
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Category</th>
						<th>Status</th>
						<th>Date Added</th>
						<th>Action</th>
					</tr>
				</thead>

				<tbody>
		';
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$category_id = $row["category_id"];
				$date_added = $row["date_added"];
				$category_name = $row["category_name"];
				$description = $row["description"];
				$meta_title = $row["meta_title"];
				
				if ($row["category_status"] == 1) {
					$category_status = "Enable";
				} else {
					$category_status = "Disabled";
				}

				$table .= '
					<tr>
						<td>'.$category_name.'</td>
						<td>'.$category_status.'</td>
						<td>'.$date_added.'</td>
						<td>
							<button type="button" class="btn btn-sm btn-info" onclick="update_category(\'' . $category_id . '\',\'' . $category_name . '\',\'' . $description . '\',\'' . $meta_title . '\',\'' . $category_status . '\')"><i class="fas fa-pencil-alt"></i></button>

							<button type="button" class="btn btn-sm btn-danger" onclick="delete_category(\'' . $category_id . '\',)"><i class="fas fa-trash-alt"></i></button>
						</td>
					</tr>
				';
			}
		}

		$table .='
				</tbody>
			</table>
		';

		echo $table;
	}

	function add_categories() {
		$category_name = $_POST["category_name"];
		$description = $_POST["description"];
		$meta_tag_title = $_POST["meta_tag_title"];
		$category_status = $_POST["category_status"];

		$email = $_POST["email"];
		$ses_group_id = $_POST["ses_group_id"];

		$date_added = date("Y-m-d h:i:sa");

		$conn = $this->db_conn();
		$sql = "INSERT INTO categories (category_status, date_added) VALUES ('$category_status', '$date_added');";

		$sql .= "INSERT INTO category_description (category_name, description, meta_title) VALUES ('$category_name', '$description', '$meta_tag_title');";

		// Add activity logs
		$this->add_to_logs("user_group_id, email, activity, date_added", "'$ses_group_id', '$email', 'Add new categories', '$date_added'");

		if ($conn->multi_query($sql) === TRUE) {
			echo "New records created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}

	function update_categories() {
		$category_id = $_POST["category_id"];
		$category_name = $_POST["category_name"];
		$description = $_POST["description"];
		$meta_tag_title = $_POST["meta_tag_title"];
		$category_status = $_POST["category_status"];

		$email = $_POST["email"];
		$ses_group_id = $_POST["ses_group_id"];
		$date_added = date("Y-m-d h:i:sa");

		$conn = $this->db_conn();
		$sql = "UPDATE categories SET category_status='$category_status' WHERE category_id='$category_id'";

		$sql1 = "UPDATE category_description SET category_name='$category_name', description='$description', meta_title='$meta_tag_title' WHERE category_id='$category_id'";

		// Add activity logs
		$this->add_to_logs("user_group_id, email, activity, date_added", "'$ses_group_id', '$email', 'Update categories', '$date_added'");

		if ($conn->query($sql) === TRUE && $conn->query($sql1) ) {
			echo "Record updated successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}
	}

	function delete_categories() {
		$category_id = $_POST["category_id"];

		$email = $_POST["email"];
		$ses_group_id = $_POST["ses_group_id"];
		$date_added = date("Y-m-d h:i:sa");

		$conn = $this->db_conn();
		$sql = "DELETE FROM categories WHERE category_id='$category_id'";
		$sql1 = "DELETE FROM category_description WHERE category_id='$category_id'";
		$sql2 = "UPDATE product_to_category SET category_id=0 WHERE category_id='$category_id'";

		// Add activity logs
		$this->add_to_logs("user_group_id, email, activity, date_added", "'$ses_group_id', '$email', 'Delete categories', '$date_added'");

		if ($conn->query($sql) === TRUE && $conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE) {
			echo "Record delete successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}
	}

	function get_product_to_category($product_id) {
		$conn = $this->db_conn();
		$sql = "SELECT * FROM product_to_category WHERE product_id='$product_id'";
		$result = mysqli_query($conn, $sql);

		foreach ($result as $key => $value) {
			return $value["category_id"];
		}
	}

	function get_information() {
		$table = "";
		$conn = $this->db_conn();
		$sql = "SELECT * FROM information_description";
		$result = mysqli_query($conn, $sql);

		// Check session user group
		if ($_SESSION["user_group"] == 2) {
			$table .= '
				<div align="right" style="margin-bottom:5px;">
					<button type="button" id="add_product_button" class="btn btn-sm btn-primary" disabled><i class="fas fa-plus-square"></i> Add New</button>
				</div>
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>Information Title</th>
							<th>Status</th>
							<th>Date Added</th>
							<th>Action</th>
						</tr>
					</thead>

					<tbody>
			';
		} else {
			$table .= '
				<div align="right" style="margin-bottom:5px;">
					<button type="button" id="add_product_button" class="btn btn-sm btn-primary" onclick="add_info()"><i class="fas fa-plus-square"></i> Add New</button>
				</div>
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>Information Title</th>
							<th>Status</th>
							<th>Date Added</th>
							<th>Action</th>
						</tr>
					</thead>

					<tbody>
			';
		}
		
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$information_id = $row["information_id"];
				$info_title = $row["info_title"];
				$info_description = $row["info_description"];
				$meta_title = $row["meta_title"];
				$meta_description = $row["meta_description"];
				$meta_keyword = $row["meta_keyword"];
				$date_added = $row["date_added"];
				
				if ($row["info_status"] == 1) {
					$info_status = "Enable";
				} else {
					$info_status = "Disabled";
				}

				// Check session user group
				if ($_SESSION["user_group"] == 2) {
					$table .= '
						<tr>
							<td>'.$info_title.'</td>
							<td>'.$info_status.'</td>
							<td>'.$date_added.'</td>
							<td>
								<button type="button" class="btn btn-sm btn-info" disabled><i class="fas fa-pencil-alt"></i></button>

								<button type="button" class="btn btn-sm btn-danger" disabled></i></button>
							</td>
						</tr>
					';
				} else {
					$table .= '
						<tr>
							<td>'.$info_title.'</td>
							<td>'.$info_status.'</td>
							<td>'.$date_added.'</td>
							<td>
								<button type="button" class="btn btn-sm btn-info" onclick="update_info(\'' . $information_id . '\',\'' . $info_title . '\',\'' . $info_description . '\',\'' . $meta_title . '\',\'' . $meta_description . '\',\'' . $meta_keyword . '\',\'' . $info_status . '\')"><i class="fas fa-pencil-alt"></i></button>

								<button type="button" class="btn btn-sm btn-danger" onclick="delete_info(\'' . $information_id . '\',)"><i class="fas fa-trash-alt"></i></button>
							</td>
						</tr>
					';
				}

			}
		}

		$table .='
				</tbody>
			</table>
		';

		echo $table;
	}

	function add_information() {
		$info_title = $_POST["info_title"];
		$info_description = $_POST["info_description"];
		$meta_title = $_POST["meta_title"];
		$meta_description = $_POST["meta_description"];
		$meta_keyword = $_POST["meta_keyword"];
		$info_status = $_POST["info_status"];

		$date_added = date("Y-m-d h:i:sa");

		$conn = $this->db_conn();
		$sql = "INSERT INTO information_description (info_title, info_description, meta_title, meta_description, meta_keyword, info_status, date_added) VALUES ('$info_title', '$info_description', '$meta_title', '$meta_description', '$meta_keyword', '$info_status', '$date_added')";

		if ($conn->query($sql) === TRUE) {
			echo "New records created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}

	function update_products() {
		$information_id = $_POST["information_id"];
		$info_title = $_POST["info_title"];
		$info_description = $_POST["info_description"];
		$meta_title = $_POST["meta_title"];
		$meta_description = $_POST["meta_description"];
		$meta_keyword = $_POST["meta_keyword"];
		$info_status = $_POST["info_status"];

		$conn = $this->db_conn();
		$sql = "UPDATE information_description SET info_title='$info_title', info_description='$info_description', meta_title='$meta_title', meta_description='$meta_description', meta_keyword='$meta_keyword', info_status='$info_status' WHERE information_id='$information_id'";
		
		if ($conn->query($sql) === TRUE) {
			echo "Record updated successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}
	}

	function delete_informations() {
		$information_id = $_POST["information_id"];

		$conn = $this->db_conn();
		$sql = "DELETE FROM information_description WHERE information_id='$information_id'";
		if ($conn->query($sql) === TRUE) {
			echo "Record delete successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}
	}

	function get_customers() {
		$table = "";
		$conn = $this->db_conn();
		$sql = "SELECT customer.customer_id, customer.firstname, customer.lastname, customer.email, customer.telephone, customer.password, customer.ip, customer.date_added, customer.status, customer_address.address_id, customer_address.customer_id, customer_address.address_1, customer_address.address_2, customer_address.city, customer_address.postcode, customer_address.region FROM customer INNER JOIN customer_address ON customer.customer_id = customer_address.customer_id";
		$result = mysqli_query($conn, $sql);

		$table .= '
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Customer Name</th>
						<th>Email</th>
						<th>Status</th>
						<th>IP</th>
						<th>Date Added</th>
						<th>Action</th>
					</tr>
				</thead>

				<tbody>
		';
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$customer_id = $row["customer_id"];
				$firstname = $row["firstname"];
				$lastname = $row["lastname"];
				$email = $row["email"];
				$telephone = $row["telephone"];
				$password = $row["password"];
				$ip = $row["ip"];
				$date_added = $row["date_added"];

				if ($row["status"] == 1) {
					$status = "Enable";
				} else {
					$status = "Disabled";
				}

				$address_id = $row["address_id"];
				$address_1 = $row["address_1"];
				$address_2 = $row["address_2"];
				$city = $row["city"];
				$postcode = $row["postcode"];
				$region = $row["region"];
				
				$table .= '
					<tr>
						<td>'.$firstname.' '.$lastname.'</td>
						<td>'.$email.'</td>
						<td>'.$status.'</td>
						<td>'.$ip.'</td>
						<td>'.$date_added.'</td>
						<td>
							<button type="button" class="btn btn-sm btn-info" onclick="update_cunstomer_info(\'' . $customer_id . '\',\'' . $firstname . '\',\'' . $lastname . '\',\'' . $email . '\',\'' . $telephone . '\',\'' . $status . '\',\'' . $address_1 . '\',\'' . $address_2 . '\',\'' . $city . '\',\'' . $postcode . '\',\'' . $region . '\',)"><i class="fas fa-pencil-alt"></i></button>

							<button type="button" class="btn btn-sm btn-danger" onclick="delete_customer(\'' . $customer_id . '\',)"><i class="fas fa-trash-alt"></i></button>
						</td>
					</tr>
				';
			}
		}

		$table .='
				</tbody>
			</table>
		';

		echo $table;
	}

	function update_customer_info() {
		$customer_id = $_POST["customer_id"];
		$firstname = $_POST["firstname"];
		$lastname = $_POST["lastname"];
		$email = $_POST["email"];
		$telephone = $_POST["telephone"];
		$password = $_POST["password"];
		$status = $_POST["status"];
		$address_1 = $_POST["address_1"];
		$address_2 = $_POST["address_2"];
		$city = $_POST["city"];
		$postcode = $_POST["postcode"];
		$region = $_POST["region"];

		$ses_email = $_POST["ses_email"];
		$ses_group_id = $_POST["ses_group_id"];
		$date_added = date("Y-m-d h:i:sa");

		$conn = $this->db_conn();

		if ($password == NULL) {
			$sql = "UPDATE customer SET firstname='$firstname', lastname='$lastname', email='$email', telephone='$telephone', status='$status' WHERE customer_id='$customer_id'";
		} else {
			$sql = "UPDATE customer SET firstname='$firstname', lastname='$lastname', email='$email', telephone='$telephone', password='$password', status='$status' WHERE customer_id='$customer_id'";
		}

		$sql1 = "UPDATE customer_address SET firstname='$firstname', lastname='$lastname', address_1='$address_1', address_2='$address_2', city='$city', postcode='$postcode', region='$region' WHERE customer_id='$customer_id'";

		// Add activity logs
		$this->add_to_logs("user_group_id, email, activity, date_added", "'$ses_group_id', '$ses_email', 'Update customer information', '$date_added'");

		if ($conn->query($sql) === TRUE && $conn->query($sql1) === TRUE) {
			echo "Record updated successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}
	}

	function delete_customer_accnt() {
		$customer_id = $_POST["customer_id"];

		$ses_email = $_POST["ses_email"];
		$ses_group_id = $_POST["ses_group_id"];
		$date_added = date("Y-m-d h:i:sa");

		$conn = $this->db_conn();
		$sql = "DELETE FROM customer WHERE customer_id='$customer_id'";
		$sql1 = "DELETE FROM customer_address WHERE customer_id='$customer_id'";
		$sql2 = "DELETE FROM customer_ip WHERE customer_id='$customer_id'";
		$sql3 = "DELETE FROM customer_wishlist WHERE customer_id='$customer_id'";
		$sql4 = "DELETE FROM cart WHERE customer_id='$customer_id'";

		// Add activity logs
		$this->add_to_logs("user_group_id, email, activity, date_added", "'$ses_group_id', '$ses_email', 'Delete customer account', '$date_added'");

		if ($conn->query($sql) === TRUE && $conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE && $conn->query($sql3) === TRUE && $conn->query($sql4) === TRUE) {
			echo "Record delete successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}
	}

	function get_stock_statuses() {
		$table = "";
		$conn = $this->db_conn();
		$sql = "SELECT * FROM stock_status";
		$result = mysqli_query($conn, $sql);

		$table .= '
			<div align="right" style="margin-bottom:5px;">
				<button type="button" id="add_product_button" class="btn btn-sm btn-primary" onclick="add_stockStatus()"><i class="fas fa-plus-square"></i> Add New</button>
			</div>
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Name</th>
						<th>Action</th>
					</tr>
				</thead>

				<tbody>
		';
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$stock_status_id = $row["stock_status_id"];
				$name = $row["name"];

				$table .= '
					<tr>
						<td>'.$name.'</td>
						<td>
							<button type="button" class="btn btn-sm btn-info" onclick="update_stockStatus(\'' . $stock_status_id . '\',\'' . $name . '\')"><i class="fas fa-pencil-alt"></i></button>

							<button type="button" class="btn btn-sm btn-danger" onclick="delete_stockStatus(\'' . $stock_status_id . '\',)"><i class="fas fa-trash-alt"></i></button>
						</td>
					</tr>
				';
			}
		}

		$table .='
				</tbody>
			</table>
		';

		echo $table;
	}

	function add_stockstatus() {
		$name = $_POST["name"];

		$email = $_POST["email"];
		$ses_group_id = $_POST["ses_group_id"];
		$date_added = date("Y-m-d h:i:sa");

		$conn = $this->db_conn();
		$sql = "INSERT INTO stock_status (name) VALUES ('$name')";

		// Add activity logs
		$this->add_to_logs("user_group_id, email, activity, date_added", "'$ses_group_id', '$ses_email', 'Add new stock status', '$date_added'");

		if ($conn->query($sql) === TRUE) {
			echo "New records created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}

	function update_stockstatus() {
		$stock_status_id = $_POST["stock_status_id"];
		$name = $_POST["name"];

		$email = $_POST["email"];
		$ses_group_id = $_POST["ses_group_id"];
		$date_added = date("Y-m-d h:i:sa");

		$conn = $this->db_conn();
		$sql = "UPDATE stock_status SET name='$name' WHERE stock_status_id='$stock_status_id'";

		// Add activity logs
		$this->add_to_logs("user_group_id, email, activity, date_added", "'$ses_group_id', '$ses_email', 'Update details on stock status', '$date_added'");

		if ($conn->query($sql) === TRUE) {
			echo "Record updated successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}
	}

	function delete_stockstatus() {
		$stock_status_id = $_POST["stock_status_id"];

		$email = $_POST["email"];
		$ses_group_id = $_POST["ses_group_id"];
		$date_added = date("Y-m-d h:i:sa");

		$conn = $this->db_conn();
		$sql = "DELETE FROM stock_status WHERE stock_status_id='$stock_status_id'";

		// Add activity logs
		$this->add_to_logs("user_group_id, email, activity, date_added", "'$ses_group_id', '$ses_email', 'Delete data in stock status', '$date_added'");

		if ($conn->query($sql) === TRUE) {
			echo "Record delete successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}
	}

	function get_order_statuses() {
		$table = "";
		$conn = $this->db_conn();
		$sql = "SELECT * FROM order_status";
		$result = mysqli_query($conn, $sql);

		$table .= '
			<div align="right" style="margin-bottom:5px;">
				<button type="button" id="add_product_button" class="btn btn-sm btn-primary" onclick="add_orderStatus()"><i class="fas fa-plus-square"></i> Add New</button>
			</div>
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Name</th>
						<th>Action</th>
					</tr>
				</thead>

				<tbody>
		';
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$order_status_id = $row["order_status_id"];
				$name = $row["name"];

				$table .= '
					<tr>
						<td>'.$name.'</td>
						<td>
							<button type="button" class="btn btn-sm btn-info" onclick="update_orderStatus(\'' . $order_status_id . '\',\'' . $name . '\')"><i class="fas fa-pencil-alt"></i></button>

							<button type="button" class="btn btn-sm btn-danger" onclick="delete_orderStatus(\'' . $order_status_id . '\',)"><i class="fas fa-trash-alt"></i></button>
						</td>
					</tr>
				';
			}
		}

		$table .='
				</tbody>
			</table>
		';

		echo $table;
	}

	function add_orderstatus() {
		$name = $_POST["name"];

		$email = $_POST["email"];
		$ses_group_id = $_POST["ses_group_id"];
		$date_added = date("Y-m-d h:i:sa");

		$conn = $this->db_conn();
		$sql = "INSERT INTO order_status (name) VALUES ('$name')";

		// Add activity logs
		$this->add_to_logs("user_group_id, email, activity, date_added", "'$ses_group_id', '$email', 'Add new order status', '$date_added'");

		if ($conn->query($sql) === TRUE) {
			echo "New records created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}

	function update_orderstatus() {
		$order_status_id = $_POST["order_status_id"];
		$name = $_POST["name"];

		$email = $_POST["email"];
		$ses_group_id = $_POST["ses_group_id"];
		$date_added = date("Y-m-d h:i:sa");

		$conn = $this->db_conn();
		$sql = "UPDATE order_status SET name='$name' WHERE order_status_id='$order_status_id'";

		// Add activity logs
		$this->add_to_logs("user_group_id, email, activity, date_added", "'$ses_group_id', '$email', 'Update details on order status', '$date_added'");

		if ($conn->query($sql) === TRUE) {
			echo "Record updated successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}
	}

	function delete_orderstatus() {
		$order_status_id = $_POST["order_status_id"];

		$email = $_POST["email"];
		$ses_group_id = $_POST["ses_group_id"];
		$date_added = date("Y-m-d h:i:sa");

		$conn = $this->db_conn();
		$sql = "DELETE FROM order_status WHERE order_status_id='$order_status_id'";

		// Add activity logs
		$this->add_to_logs("user_group_id, email, activity, date_added", "'$ses_group_id', '$email', 'Delete data in order status', '$date_added'");

		if ($conn->query($sql) === TRUE) {
			echo "Record delete successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}
	}

	function get_manufacturers() {
		$table = "";
		$conn = $this->db_conn();
		$sql = "SELECT * FROM manufacturer";
		$result = mysqli_query($conn, $sql);

		$table .= '
			<div align="right" style="margin-bottom:5px;">
				<button type="button" id="add_product_button" class="btn btn-sm btn-primary" onclick="add_manufacturers()"><i class="fas fa-plus-square"></i> Add New</button>
			</div>
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Name</th>
						<th>Action</th>
					</tr>
				</thead>

				<tbody>
		';
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$manufacturer_id = $row["manufacturer_id"];
				$name = $row["name"];

				$table .= '
					<tr>
						<td>'.$name.'</td>
						<td>
							<button type="button" class="btn btn-sm btn-info" onclick="update_manufacturers(\'' . $manufacturer_id . '\',\'' . $name . '\')"><i class="fas fa-pencil-alt"></i></button>

							<button type="button" class="btn btn-sm btn-danger" onclick="delete_manufacturers(\'' . $manufacturer_id . '\',)"><i class="fas fa-trash-alt"></i></button>
						</td>
					</tr>
				';
			}
		}

		$table .='
				</tbody>
			</table>
		';

		echo $table;
	}

	function add_manufacturer() {
		$name = $_POST["name"];

		$email = $_POST["email"];
		$ses_group_id = $_POST["ses_group_id"];
		$date_added = date("Y-m-d h:i:sa");

		$conn = $this->db_conn();
		$sql = "INSERT INTO manufacturer (name) VALUES ('$name')";

		// Add activity logs
		$this->add_to_logs("user_group_id, email, activity, date_added", "'$ses_group_id', '$email', 'Add new manufacturer', '$date_added'");

		if ($conn->query($sql) === TRUE) {
			echo "New records created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}

	function update_manufaturer() {
		$manufacturer_id = $_POST["manufacturer_id"];
		$name = $_POST["name"];

		$email = $_POST["email"];
		$ses_group_id = $_POST["ses_group_id"];
		$date_added = date("Y-m-d h:i:sa");

		$conn = $this->db_conn();
		$sql = "UPDATE manufacturer SET name='$name' WHERE manufacturer_id='$manufacturer_id'";

		// Add activity logs
		$this->add_to_logs("user_group_id, email, activity, date_added", "'$ses_group_id', '$email', 'Uodate manufacturer details', '$date_added'");

		if ($conn->query($sql) === TRUE) {
			echo "Record updated successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}
	}

	function delete_manufacturer() {
		$manufacturer_id = $_POST["manufacturer_id"];

		$email = $_POST["email"];
		$ses_group_id = $_POST["ses_group_id"];
		$date_added = date("Y-m-d h:i:sa");

		$conn = $this->db_conn();
		$sql = "DELETE FROM manufacturer WHERE manufacturer_id='$manufacturer_id'";

		// Add activity logs
		$this->add_to_logs("user_group_id, email, activity, date_added", "'$ses_group_id', '$email', 'Uodate manufacturer details', '$date_added'");

		if ($conn->query($sql) === TRUE) {
			echo "Record delete successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}
	}

	function get_manufacturer_value() {
		$conn = $this->db_conn();
		$sql = "SELECT * FROM manufacturer";
		$result = mysqli_query($conn, $sql);

		foreach ($result as $key => $value) {
			echo '
				<option value="'.$value["manufacturer_id"].'">'.$value["name"].'</option>
			';
		}
	}

	function get_latest_customers_account() {
		$table = "";
		$conn = $this->db_conn();
		$sql = "SELECT * FROM customer ORDER BY date_added ASC LIMIT 5";
		$result = mysqli_query($conn, $sql);

		$table .= '
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Customer Name</th>
						<th>Email</th>
						<th>Status</th>
						<th>Date Added</th>
					</tr>
				</thead>

				<tbody>
		';
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$firstname = $row["firstname"];
				$lastname = $row["lastname"];
				$email = $row["email"];
				$date_added = $row["date_added"];

				if ($row["status"] == 1) {
					$status = "Enable";
				} else {
					$status = "Disabled";
				}
				
				$table .= '
					<tr>
						<td>'.$firstname.' '.$lastname.'</td>
						<td>'.$email.'</td>
						<td>'.$status.'</td>
						<td>'.$date_added.'</td>
					</tr>
				';
			}
		}else {
			$table .='
			<tr>
				<td class="text-center text-md-start" colspan="4">No Data..</td>
			</tr>
			';
		}

		$table .='
				</tbody>
			</table>
		';

		echo $table;
	}

	function add_notes() {
		$title = $_POST["title"];
		$note = $_POST["note"];
		$date_added = date("Y-m-d h:i:sa");

		$conn = $this->db_conn();
		$sql = "INSERT INTO notes (title, note, date_added) VALUES ('$title', '$note', '$date_added')";

		if ($conn->query($sql) === TRUE) {
			echo "New records created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}

	function get_notes() {
		$table = "";
		$conn = $this->db_conn();
		$sql = "SELECT * FROM notes";
		$result = mysqli_query($conn, $sql);

		$table .= '
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Title</th>
						<th>Notes</th>
						<th>Action</th>
					</tr>
				</thead>

				<tbody>
		';
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$note_id = $row["note_id"];
				$title = $row["title"];
				$note = $row["note"];
				$date_added = $row["date_added"];

				$uncut_title = $row["title"];
				$uncut_note = $row["note"];

				$note = strip_tags($note);
                if (strlen($note) > 10) {
                    $stringCut = substr($note, 0 , 10);
                    $endPoint = strrpos($stringCut, ' ');

                    $note = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                    $note .= '...';
                }

				$title = strip_tags($title);
				if (strlen($title) > 6) {
                    $stringCut = substr($title, 0 , 6);
                    $endPoint = strrpos($stringCut, '');

                    $title = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                    $title .= '...';
                }

				$table .= '
					<tr>
						<td>'.$title.'</td>
						<td>'.$note.'</td>
						<td class="text-center">
							<button type="button" class="btn btn-sm btn-info" onclick="view_notes(\'' . $note_id . '\',\'' . $uncut_title . '\',\'' . $uncut_note . '\',\'' . $date_added . '\')"><i class="fas fa-eye"></i></button>

							<button type="button" class="btn btn-sm btn-danger" onclick="delete_notes(\'' . $note_id . '\',)"><i class="fas fa-trash-alt"></i></button>
						</td>
					</tr>
				';
			}
		} else {
			$table .='
			<tr>
				<td class="text-center text-md-start" colspan="3">No Data..</td>
			</tr>
			';
		}

		$table .='
				</tbody>
			</table>
		';

		echo $table;
	}

	function update_note() {
		$note_id = $_POST["note_id"];
		$title = $_POST["title"];
		$note = $_POST["note"];

		$conn = $this->db_conn();
		$sql = "UPDATE notes SET title='$title', note='$note' WHERE note_id='$note_id'";

		if ($conn->query($sql) === TRUE) {
			echo "Record updated successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}
	}

	function delete_note() {
		$note_id = $_POST["note_id"];

		$conn = $this->db_conn();
		$sql = "DELETE FROM notes WHERE note_id='$note_id'";

		if ($conn->query($sql) === TRUE) {
			echo "Record delete successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}
	}

	function get_customer_rows() {
        $conn = $this->db_conn();
        $sql = "SELECT * FROM customer";
        $result = $conn->query($sql);
        $numrow = mysqli_num_rows($result);

        return $numrow;
    }

	function get_admin_logs() {
		$table = "";
		$conn = $this->db_conn();
		$sql = "SELECT * FROM admin_logs";
		$result = mysqli_query($conn, $sql);

		$table .= '
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>User</th>
						<th>Email</th>
						<th>Activity</th>
						<th>Date Added</th>
						<th>Action</th>
					</tr>
				</thead>

				<tbody>
		';
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$activity_id = $row["activity_id"];
				$user_group_id = $row["user_group_id"];
				$email = $row["email"];
				$activity = $row["activity"];
				$date_added = $row["date_added"];

				$user_group_name = $this->get_admin_user_group("user_group_name", $user_group_id);
				
				// Check session user group
				if ($_SESSION["user_group"] == 2) {
					$table .= '
						<tr>
							<td>'.$user_group_name.'</td>
							<td>'.$email.'</td>
							<td>'.$activity.'</td>
							<td>'.$date_added.'</td>
							<td class="text-center">
								<button type="button" class="btn btn-sm btn-danger" disabled><i class="fas fa-trash-alt"></i></button>
							</td>
						</tr>
					';
				} else {
					$table .= '
						<tr>
							<td>'.$user_group_name.'</td>
							<td>'.$email.'</td>
							<td>'.$activity.'</td>
							<td>'.$date_added.'</td>
							<td class="text-center">
								<button type="button" class="btn btn-sm btn-danger" onclick="delete_notes(\'' . $activity_id . '\',)"><i class="fas fa-trash-alt"></i></button>
							</td>
						</tr>
					';
				}
			}
		}

		$table .='
				</tbody>
			</table>
		';

		echo $table;
	}

	function add_to_logs($column, $values) {
		$conn = $this->db_conn();
        $sql = "INSERT INTO admin_logs ($column) VALUES ($values)";

        if ($conn->query($sql) === TRUE) {
            echo "";
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

if(isset($_GET["add_user_admin"])){
	$class->add_user_admin();
}

if(isset($_GET["update_user_admins"])){
	$class->update_user_admins();
}

if(isset($_GET["delete_admin_users"])){
	$class->delete_admin_users();
}

if(isset($_GET["update_product"])){
	$class->update_product();
}

if(isset($_GET["delete_product"])){
	$class->delete_product();
}

if(isset($_GET["add_product"])){
	$class->add_product();
}

if(isset($_GET["add_categories"])){
	$class->add_categories();
}

if(isset($_GET["update_categories"])){
	$class->update_categories();
}

if(isset($_GET["delete_categories"])){
	$class->delete_categories();
}

if(isset($_GET["add_information"])){
	$class->add_information();
}

if(isset($_GET["update_products"])){
	$class->update_products();
}

if(isset($_GET["delete_informations"])){
	$class->delete_informations();
}

if(isset($_GET["update_customer_info"])){
	$class->update_customer_info();
}

if(isset($_GET["delete_customer_accnt"])){
	$class->delete_customer_accnt();
}

if(isset($_GET["add_stockstatus"])){
	$class->add_stockstatus();
}

if(isset($_GET["update_stockstatus"])){
	$class->update_stockstatus();
}

if(isset($_GET["delete_stockstatus"])){
	$class->delete_stockstatus();
}

if(isset($_GET["add_orderstatus"])){
	$class->add_orderstatus();
}

if(isset($_GET["update_orderstatus"])){
	$class->update_orderstatus();
}

if(isset($_GET["delete_orderstatus"])){
	$class->delete_orderstatus();
}

if(isset($_GET["add_manufacturer"])){
	$class->add_manufacturer();
}

if(isset($_GET["update_manufaturer"])){
	$class->update_manufaturer();
}

if(isset($_GET["delete_manufacturer"])){
	$class->delete_manufacturer();
}

if(isset($_GET["add_notes"])){
	$class->add_notes();
}

if(isset($_GET["update_note"])){
	$class->update_note();
}

if(isset($_GET["delete_note"])){
	$class->delete_note();
}
?>
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

		// Admin user group table
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
							<button type="button" class="btn btn-sm btn-info" id="update_user_button" onclick="update_user_group('.$user_group_id.',\''.$user_group_name.'\')"><i class="fas fa-pencil-alt"></i></button>

							<button type="button" class="btn btn-sm btn-danger" onclick="delete_user_group('.$user_group_id.')"><i class="fas fa-trash-alt"></i></button>
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
		$sql = "INSERT INTO admin_user_group (user_group_name) VALUES ('.$name.')";
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
		// Update status
		$sql = "UPDATE admin_user_group SET user_group_status=0 WHERE user_group_id='$user_group_id'";

		// Auto update the table of admin_user
		$sql1 = "UPDATE admin_user SET admin_status=0 WHERE user_group='$user_group_id'";

		if ($conn->query($sql) === TRUE && $conn->query($sql1)) {
			echo "Record delete successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}
	}

	function get_admin_user() {
		$table="";
		$conn = $this->db_conn();
		$sql = "SELECT * FROM admin_user";
		$result = mysqli_query($conn, $sql);

		// Admin user table
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
						<th>Date Added</th>
						<th>Action</th>
					</tr>
				</thead>

				<tbody>
		';

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$admin_user_id = $row["id"];
				$firstname = $row["firstname"];
				$lastname  = $row["lastname"];
				$user_group = $row["user_group"];
				$email = $row["email"];
				$date_added = $row["date_added"];

				if($row["admin_status"] == 1) {
					$admin_status = "Enabled";
				} else {
					$admin_status = "Disabled";
				}
		
				$table .= '
					<tr>
						<td>'.$firstname.'</td>
						<td>'.$lastname.'</td>
						<td>'.$admin_status.'</td>
						<td>'.$date_added.'</td>
						<td>
							<button type="button" class="btn btn-sm btn-info" id="update_user_button" onclick="update_admin_user(\'' . $admin_user_id . '\',\'' . $firstname . '\',\'' . $lastname . '\',\'' . $email . '\',\'' . $admin_status . '\',\'' . $user_group . '\')"><i class="fas fa-pencil-alt"></i></button>

							<button type="button" class="btn btn-sm btn-danger" onclick="delete_admin_user('.$admin_user_id.')"><i class="fas fa-trash-alt"></i></button>
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

	function delete_admin_users() {
		$admin_user_id = $_POST["admin_user_id"];

		$conn = $this->db_conn();
		$sql = "DELETE FROM admin_user WHERE id='$admin_user_id'";
		if ($conn->query($sql) === TRUE) {
			echo "Record delete successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}
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

		$date_added = date("Y-m-d h:i:sa");

		$conn = $this->db_conn();
		$sql = "INSERT INTO admin_user (firstname, lastname, email, password, user_group, admin_status, date_added) VALUES ('$firstname', '$lastname', '$email', '$password', '$user_group', '$admin_status', '$date_added')";
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

		if ($pass == NULL) {
			$conn = $this->db_conn();
			$sql = "UPDATE admin_user SET firstname='$firstname' , lastname='$lastname', email='$email', admin_status='$status' WHERE id='$id'";
			$result = mysqli_query($conn, $sql);
		} else {
			$conn = $this->db_conn();
			$sql = "UPDATE admin_user SET firstname='$firstname' , lastname='$lastname', email='$email', password='$pass', admin_status='$status' WHERE id='$id'";
			$result = mysqli_query($conn, $sql);
		}

		if ($conn->query($sql) === TRUE && $conn->query($sql1) === TRUE ) {
			echo "Record updated successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}
	}

	function get_product() {
		$table = "";
		$conn = $this->db_conn();
		$sql = "SELECT product.product_id, product.product_name, product.quantity, product.stock_status_id, product.price, product.product_weight, product.weight_id, product.product_status, product_description.product_desc, product_description.meta_title, product_description.meta_description, product_description.meta_keywords FROM product INNER JOIN product_description ON product.product_id = product_description.product_id";
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
							<button type="button" class="btn btn-sm btn-info" onclick="update_products(\'' . $product_id . '\',\'' . $name . '\',\'' . $quantity . '\',\'' . $price . '\',\'' . $product_status . '\',\'' . $product_desc . '\',\'' . $meta_title . '\',\'' . $meta_description . '\',\'' . $meta_keywords . '\',\'' . $stock_status_id . '\',\'' . $product_weight . '\',\'' . $weight_id . '\',\'' . $product_category . '\')"><i class="fas fa-pencil-alt"></i></button>

							<button type="button" class="btn btn-sm btn-danger" onclick="delete_products(\'' . $product_id . '\',)"><i class="fas fa-trash-alt"></i></button>
						</td>
					</tr>
				';
			}
		} else {
			$table .= '
			<tr>
				<td colspan="5" align="center">No data found</td>
			</tr>
			';
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
		$product_category = $_POST["product_category"];

		$conn = $this->db_conn();
		// Update for Product table
		$sql = "UPDATE product SET product_name='$product_name', quantity='$quantity', stock_status_id='$stock_status', price='$price', product_weight='$product_weight', weight_id='$weight_class', product_status='$product_status' WHERE product_id='$product_id'";

		// Update for Product Description table
		$sql1 = "UPDATE product_description SET product_name='$product_name', product_desc='$product_desc', meta_title='$meta_tag_title', meta_description='$meta_tag_description', meta_keywords='$meta_tag_keywords' WHERE product_id='$product_id'";

		// Update for product_to_category table
		$sql2 = "UPDATE product_to_category SET category_id='$product_category' WHERE product_id='$product_id'";

		if ($conn->query($sql) === TRUE && $conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE) {
			echo "Record updated successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}
	}

	function delete_product() {
		$product_id = $_POST["product_id"];
		
		$conn = $this->db_conn();
		$sql = "DELETE FROM product WHERE product_id='$product_id'";
		$sql1 = "DELETE FROM product_description WHERE product_id='$product_id'";
		$sql2 = "DELETE FROM product_to_category WHERE product_id='$product_id'";
		
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
		$product_category = $_POST["product_category"];
		$price = $_POST["price"];
		$quantity = $_POST["quantity"];
		$stock_status = $_POST["stock_status"];
		$product_weight = $_POST["product_weight"];
		$weight_class = $_POST["weight_class"];
		$product_status = $_POST["product_status"];

		$date_added = date("Y-m-d h:i:sa");

		$conn = $this->db_conn();
		$sql = "INSERT INTO product (product_name, quantity, stock_status_id, price, product_weight, weight_id, product_status, date_added) VALUES ('$product_name', '$quantity', '$stock_status', '$price', '$product_weight', '$weight_class', '$product_status', '$date_added');";

		$sql .= "INSERT INTO product_description (product_name, product_desc, meta_title, meta_description, meta_keywords) VALUES ('$product_name', '$description', '$meta_tag_title', '$meta_tag_description', '$meta_tag_keywords');";

		$sql .= "INSERT INTO product_to_category (product_id, category_id) VALUES ((SELECT product_id FROM product WHERE product_name='$product_name'), '$product_category');";

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
		} else {
			$table .= '
			<tr>
				<td colspan="4" align="center">No data found</td>
			</tr>
			';
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

		$date_added = date("Y-m-d h:i:sa");

		$conn = $this->db_conn();
		$sql = "INSERT INTO categories (category_status, date_added) VALUES ('$category_status', '$date_added');";

		$sql .= "INSERT INTO category_description (category_name, description, meta_title) VALUES ('$category_name', '$description', '$meta_tag_title');";

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

		$conn = $this->db_conn();
		$sql = "UPDATE categories SET category_status='$category_status' WHERE category_id='$category_id'";

		$sql1 = "UPDATE category_description SET category_name='$category_name', description='$description', meta_title='$meta_tag_title' WHERE category_id='$category_id'";

		if ($conn->query($sql) === TRUE && $conn->query($sql1) ) {
			echo "Record updated successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}
	}

	function delete_categories() {
		$category_id = $_POST["category_id"];

		$conn = $this->db_conn();
		$sql = "DELETE FROM categories WHERE category_id='$category_id'";
		$sql1 = "DELETE FROM category_description WHERE category_id='$category_id'";
		if ($conn->query($sql) === TRUE && $conn->query($sql1) === TRUE) {
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
		} else {
			$table .= '
			<tr>
				<td colspan="4" align="center">No data found</td>
			</tr>
			';
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
			<div align="right" style="margin-bottom:5px;">
				<button type="button" id="add_product_button" class="btn btn-sm btn-primary" onclick="add_info()"><i class="fas fa-plus-square"></i> Add New</button>
			</div>
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

		$conn = $this->db_conn();
		$sql = "UPDATE customer SET firstname='$firstname', lastname='$lastname', email='$email', telephone='$telephone', password='$password', status='$status' WHERE customer_id='$customer_id'";

		$sql1 = "UPDATE customer_address SET firstname='$firstname', lastname='$lastname', address_1='$address_1', address_2='$address_2', city='$city', postcode='$postcode', region='$region' WHERE customer_id='$customer_id'";

		if ($conn->query($sql) === TRUE && $conn->query($sql1) === TRUE) {
			echo "Record updated successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}
	}

	function delete_customer_accnt() {
		$customer_id = $_POST["customer_id"];

		$conn = $this->db_conn();
		$sql = "DELETE FROM customer WHERE customer_id='$customer_id'";
		$sql1 = "DELETE FROM customer_address WHERE customer_id='$customer_id'";
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

if(isset($_GET["delete_admin_users"])){
	$class->delete_admin_users();
}

if(isset($_GET["add_user_admin"])){
	$class->add_user_admin();
}

if(isset($_GET["update_user_admins"])){
	$class->update_user_admins();
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
?>
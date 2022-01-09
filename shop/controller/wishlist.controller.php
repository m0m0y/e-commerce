<?php
require "config.php";
date_default_timezone_set("Singapore");

class Wishlist extends database_connection {
    function add_wishlist() {
        $customer_id = $_POST["customer_id"];
        $product_id = $_POST["product_id"];
        $date_added = date("Y-m-d h:i:sa");

        $conn = $this->db_conn();
        $sql = "INSERT INTO customer_wishlist (customer_id, product_id, date_added) VALUES ('$customer_id', '$product_id', '$date_added')";
        if ($conn->query($sql) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error";
		}
    }
}

$class = New Wishlist();

if(isset($_GET["add_wishlist"])) {
    $class->add_wishlist();
}
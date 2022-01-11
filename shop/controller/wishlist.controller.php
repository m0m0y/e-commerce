<?php
require "config.php";
date_default_timezone_set("Singapore");

class Wishlist extends database_connection {
    function add_wishlist() {
        $customer_id = $_POST["customer_id"];
        $product_id = $_POST["product_id"];
        $date_added = date("Y-m-d h:i:sa");

        $wishlist_product_id = $this->get_wishlist("product_id", $customer_id);

        if ($product_id == $wishlist_product_id) {
            echo "Record is existing";
        } else {
            $conn = $this->db_conn();
            $sql = "INSERT INTO customer_wishlist (customer_id, product_id, date_added) VALUES ('$customer_id', '$product_id', '$date_added')";
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            }
        }
    }

    function get_wishlist($column, $customer_id) {
        $conn = $this->db_conn();
        $sql = "SELECT $column FROM customer_wishlist WHERE customer_id='$customer_id'";
        $result = mysqli_fetch_assoc($conn->query($sql));

        return $result[$column];
    }

    function delete_wishlist() {
        $product_id = $_POST["product_id"];

		$conn = $this->db_conn();
		$sql = "DELETE FROM customer_wishlist WHERE product_id='$product_id'";

		if ($conn->query($sql) === TRUE) {
			echo "Record delete successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}
    }
}

$class = New Wishlist();

if(isset($_GET["add_wishlist"])) {
    $class->add_wishlist();
}

if(isset($_GET["delete_wishlist"])) {
    $class->delete_wishlist();
}
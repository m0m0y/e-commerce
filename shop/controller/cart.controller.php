<?php
require "config.php";
date_default_timezone_set("Singapore");

class AddToCart extends database_connection {
    function addToCart() {
        $customer_id = $_POST["customer_id"];
        $product_id = $_POST["product_id"];
        $quantity = $_POST["quantity"];
        $date_added = date("Y-m-d h:i:sa");
        
        $conn = $this->db_conn();
        $sql = "INSERT INTO cart (customer_id, product_id, quantity, date_added) VALUES ('$customer_id', '$product_id', '$quantity', '$date_added')";
        if ($conn->query($sql) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error";
		}
    }
}

$class = New AddToCart();
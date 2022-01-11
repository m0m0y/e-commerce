<?php
require "config.php";
date_default_timezone_set("Singapore");

class AddToCart extends database_connection {
    function add_cart() {      
        $customer_id = $_POST["customer_id"];
        $product_id = $_POST["product_id"];
        $quantity = $_POST["quantity"];
        $date_added = date("Y-m-d h:i:sa");
    
        $cart_customer_id = $this->get_cart("customer_id", $customer_id);
        $cart_product_id = $this->get_cart("product_id", $customer_id);
        $cart_quantity = $this->get_cart("quantity", $customer_id);
        // Use for update quantity in cart
        $total_quantity = $quantity + $cart_quantity;

        if ($customer_id == "") {
            if ($product_id == $cart_product_id) {
                $this->update_cart("quantity='$total_quantity'", "product_id='$cart_product_id' OR customer_id=0");
            } else {
                $conn = $this->db_conn();
                $sql = "INSERT INTO cart (customer_id, product_id, quantity, date_added) VALUES ('$customer_id', '$product_id', '$quantity', '$date_added')";
                if ($conn->query($sql) === TRUE) {
                    echo "New record created successfully";
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            }
        } else {
            if ($product_id == $cart_product_id) {
                $this->update_cart("quantity='$total_quantity'", "product_id='$cart_product_id'");
            } else {
                $conn = $this->db_conn();
                $sql = "INSERT INTO cart (customer_id, product_id, quantity, date_added) VALUES ('$customer_id', '$product_id', '$quantity', '$date_added')";
                if ($conn->query($sql) === TRUE) {
                    echo "New record created successfully";
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            }
        }
        
    }

    function get_cart($column, $customer_id) {
        $conn = $this->db_conn();
        $sql = "SELECT $column FROM cart WHERE customer_id='$customer_id'";
        $result = mysqli_fetch_assoc($conn->query($sql));

        return $result[$column];
    }

    function update_cart($column, $wherevalues) {
        $conn = $this->db_conn();
        $sql = "UPDATE cart SET $column WHERE $wherevalues";

        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully!";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
}

$class = New AddToCart();

if(isset($_GET["add_cart"])){
	$class->add_cart();
}
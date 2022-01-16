<?php
require "config.php";
date_default_timezone_set("Singapore");

class OrderController extends database_connection {
    function add_order() {
        $customer_id = $_POST["customer_id"];
        $customer_firstname = $_POST["customer_firstname"];
        $customer_lastname = $_POST["customer_lastname"];
        $customer_email = $_POST["customer_email"];
        $customer_telephone = $_POST["customer_telephone"];
        $address_1 = $_POST["address_1"];
        $address_2 = $_POST["address_2"];
        $city = $_POST["city"];
        $postcode = $_POST["postcode"];
        $region = $_POST["region"];
        $pick_up_date = $_POST["pick_up_date"];
        $payment_option = $_POST["payment_option"];
        $over_all_total = $_POST["over_all_total"];

        if ($payment_option == "cash") {
            $payment_method = "Cash";
        } else if ($payment_option == "gcash") {
            $payment_method = "Gcash";
        } else if ($payment_option == "bank_transfer") {
            $payment_method = "Bank Transfer";
        }

        $comment = $_POST["comment"];

        $date_added = date("Y-m-d h:i:sa");

        $moy = 2;
        $characters = '0123456789';
        $randomString = '';

        for ($i=0; $i < $moy; $i++) { 
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        $order_rows = $this->get_orders_rows($customer_id);
        for ($x = 0; $x <= $order_rows; $x++) {
            $counter = $x;
        }
        $invoice_no = 'INV-'.date("Y").'-'.$randomString.'00'.$counter;

        $ip = $_SERVER['REMOTE_ADDR'];

        $cart_id = $_POST["cart_id"];
        $product_id = $_POST["product_id"];
        $product_name = $_POST["product_name"];
        $quantity = $_POST["quantity"];
        $price = $_POST["price"];
        $total_price = $_POST["total_price"];

        $sadd = $this->get_cart("product_id");

        echo $sadd;

        // $conn = $this->db_conn();
        // $sql = "INSERT INTO orders (invoice_no, customer_id, firstname, lastname, email, telephone, comment, payment_method, payment_code, total, order_status_id, ip, pick_up_date, date_added) VALUES ('$invoice_no', '$customer_id', '$customer_firstname', '$customer_lastname', '$customer_email', '$customer_telephone', '$comment', '$payment_method', '$payment_option', '$over_all_total', '2', '$ip', '$pick_up_date', '$date_added');";

        // $sql .= "INSERT INTO order_product (invoice_no, order_id, product_id, product_name, quantity, price, total) VALUES ('$invoice_no', (SELECT order_id FROM orders WHERE invoice_no='$invoice_no'), '$product_id', '$product_name', '$quantity', '$price', '$total_price');";

        // $sql .= "INSERT INTO orders_history (invoice_no, order_id, order_status_id, comment, date_added) VALUES ('$invoice_no', (SELECT order_id FROM orders WHERE invoice_no='$invoice_no'), '2', '$comment', '$date_added');";

        // if ($conn->multi_query($sql) === TRUE) {
		// 	echo "New records created successfully";
		// } else {
		// 	echo "Error: " . $sql . "<br>" . $conn->error;
		// }
    }

    // Get the numbers of rows in orders
    function get_orders_rows($customer_id) {
        $conn = $this->db_conn();
        $sql = "SELECT * FROM orders WHERE customer_id='$customer_id'";
        $result = $conn->query($sql);
        $numrow = mysqli_num_rows($result);

        return $numrow;
    }

    function get_cart($column) {
        $conn = $this->db_conn();
        $sql = "SELECT $column FROM cart";
        $result = mysqli_fetch_assoc($conn->query($sql));

        return $result[$column];
    }

    function delete_cart($cart_id) {
        $conn = $this->db_conn();
		$sql = "DELETE FROM cart WHERE cart_id='$cart_id'";
		if ($conn->query($sql) === TRUE) {
			echo "Record delete successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}
    }

}

$class = new OrderController();

if(isset($_GET["add_order"])){
	$class->add_order();
}
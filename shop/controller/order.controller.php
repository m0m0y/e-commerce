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

        $subtotal = $_POST["subtotal"];
        $tax = $_POST["tax"];
        $total = $_POST["total"];


        $title = array();
        foreach ($title as $title_value) {
            $title_value;
        }

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

        // Count the number of orders
        $order_rows = $this->get_orders_rows();
        for ($x = 0; $x <= $order_rows; $x++) {
            $counter = $x;
        }
        $invoice_no = 'INV-'.date("Y").'-'.$randomString.'00'.$counter;

        $ip = $_SERVER['REMOTE_ADDR'];

        $conn = $this->db_conn();
        $sql = "INSERT INTO orders (invoice_no, customer_id, firstname, lastname, email, telephone, comment, payment_method, payment_code, total, order_status_id, ip, pick_up_date, date_added) VALUES ('$invoice_no', '$customer_id', '$customer_firstname', '$customer_lastname', '$customer_email', '$customer_telephone', '$comment', '$payment_method', '$payment_option', '$over_all_total', '2', '$ip', '$pick_up_date', '$date_added');";

        $sql .= "INSERT INTO orders_history (invoice_no, order_id, order_status_id, comment, date_added) VALUES ('$invoice_no', (SELECT order_id FROM orders WHERE invoice_no='$invoice_no'), '2', '$comment', '$date_added');";

        $title_value = array("Sub-Total", "Total", "Vat");
            $total_value = array($subtotal, $total, $tax);
            sort($title_value);

            $titleLength = count($title_value);

            $totalLength = $titleLength;
            for($x = 0; $x < $totalLength; $x++) {
                $sql .= "INSERT INTO order_total (order_id, invoice_no, title, val) VALUES ((SELECT order_id FROM orders WHERE invoice_no='$invoice_no'), '$invoice_no', '$title_value[$x]', '$total_value[$x]');";
            }

        if ($conn->multi_query($sql) === TRUE) {
            $last_id =mysqli_insert_id($conn);

            // Insert every order products by customer and automatic clear their cart
            $this->add_order_product($customer_id, $invoice_no, $last_id);

			echo "New records created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
    }

    // Get the numbers of rows in orders
    function get_orders_rows() {
        $conn = $this->db_conn();
        $sql = "SELECT * FROM orders";
        $result = $conn->query($sql);
        $numrow = mysqli_num_rows($result);

        return $numrow;
    }

    function get_product($column, $product_id) {
        $conn = $this->db_conn();
        $sql = "SELECT $column FROM product WHERE product_id='$product_id' AND product_status=1";
        $result = mysqli_fetch_assoc($conn->query($sql));

        return $result[$column];
    }

    function add_order_product($customer_id, $invoice_no, $last_id) {
        $conn = $this->db_conn();
		$sql = "SELECT * FROM cart WHERE customer_id='$customer_id'";
		$result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
                $cart_id = $row["cart_id"];
                $product_id = $row["product_id"];
                $quantity = $row["quantity"];
                $product_name = $this->get_product("product_name", $product_id);
                $price = $this->get_product("price", $product_id);

                $total_price = $price * $quantity;

                $sql = "INSERT INTO order_product (invoice_no, order_id, product_id, product_name, quantity, price, total) VALUES ('$invoice_no', '$last_id', '$product_id', '$product_name', '$quantity', '$price', '$total_price')";

                $this->delete_cart($cart_id);

                if ($conn->query($sql) === TRUE) {
                	echo "";
                } else {
                	echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
    }

    function delete_cart($cart_id) {
        $conn = $this->db_conn();
		$sql = "DELETE FROM cart WHERE cart_id='$cart_id'";
		if ($conn->query($sql) === TRUE) {
			echo "";
		} else {
			echo "Error deleting record: " . $conn->error;
		}
    }


    function cancel_order() {
        $order_id = $_POST["order_id"];

        $conn = $this->db_conn();
        $sql = "UPDATE orders SET order_status_id=3 WHERE order_id='$order_id'";

        $sql1 = "UPDATE orders_history SET order_status_id=3 WHERE order_id='$order_id'";

        if ($conn->query($sql) === TRUE && $conn->query($sql1) === TRUE) {
			echo "Record updated successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}
    }

}

$class = new OrderController();

if(isset($_GET["add_order"])){
	$class->add_order();
}


if(isset($_GET["cancel_order"])){
    $class->cancel_order();
}
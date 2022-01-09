<?php
require "config.php";
date_default_timezone_set("Singapore");

class BaseController extends database_connection {
    function get_categories() {
        // Navbar menu
        $conn = $this->db_conn();
        $sql = "SELECT categories.category_id, category_description.category_id, category_description.category_name, category_description.description, category_description.meta_title FROM categories INNER JOIN category_description ON categories.category_id = category_description.category_id WHERE categories.category_status=1";
		$result = mysqli_query($conn, $sql);

        foreach ($result as $key => $value) {
            $category_id = $value["category_id"];
            $category_name = $value["category_name"];
            $description = $value["description"];
            $meta_title = $value["meta_title"];

            echo '<a class="dropdown-item" href="category?id='.$category_id.'">'.$category_name.'</a>';
		}
    }
    
    function side_categories() {
        // Side menu on category page
        $conn = $this->db_conn();
        $sql = "SELECT categories.category_id, category_description.category_id, category_description.category_name, category_description.description, category_description.meta_title FROM categories INNER JOIN category_description ON categories.category_id = category_description.category_id WHERE categories.category_status=1";
		$result = mysqli_query($conn, $sql);

        foreach ($result as $key => $value) {
            echo '<li class="list-group-item"><a class="category-menu" href="category?id='.$value["category_id"].'">'.$value["category_name"].'</a></li>';
		}
    }

    // function get_categories_id($column) {
    //     $conn = $this->db_conn();
    //     $sql = "SELECT $column FROM categories WHERE category_status=1";
    //     $result = mysqli_fetch_assoc($conn->query($sql));

    //     return $result[$column];
    // }

    function get_product_desc($column, $id) {
        $conn = $this->db_conn();
        $sql = "SELECT $column FROM category_description WHERE category_id='$id'";
        $result = mysqli_fetch_assoc($conn->query($sql));

        return $result[$column];
    }

    function get_product_to_category($id) {
        $conn = $this->db_conn();
        $sql = "SELECT * FROM product_to_category WHERE category_id='$id'";
        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
                $product_id = $row["product_id"];
                echo $this->get_products($product_id);
            }
        } else {
            echo '<p class="card-text">There are no products to list in this category.</p>';
        }
    }

    function get_products($product_id) {
        $conn = $this->db_conn();
        $sql = "SELECT product.product_id, product.product_name, product.price, product.stock_status_id, product_description.product_desc, product_description.meta_title, product_description.meta_description, product_description.meta_keywords FROM product INNER JOIN product_description ON product_description.product_id = product.product_id WHERE product.product_id='$product_id'";
        $result = mysqli_query($conn, $sql);

        echo '<div class="mb-3 col-sm-12 col-md-4">';

        if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
                $product_name = $row["product_name"];
                $price = $row["price"];
                $product_id = $row["product_id"];
                $stock_status_id = $row["stock_status_id"];

                $product_desc = $row["product_desc"];
                
                // Use for manage the lenght of description
                $product_desc = strip_tags($product_desc);
                if (strlen($product_desc) > 100) {
                    $stringCut = substr($product_desc, 0 , 100);
                    $endPoint = strrpos($stringCut, ' ');

                    $product_desc = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                    $product_desc .= '...';
                }

                // If there is no product description display N/A
                if ($product_desc == "" || $product_desc == NULL) {
                    $product_desc .= "N/A";
                }

                // Check session
                if (isset($_SESSION["customer_id"])) {
                    $customer_id = $_SESSION["customer_id"];

                    echo '
                        <div class="card">
                            <div class="card-body">
                                <p class="card-text"><a href="#">'.$product_name.'</a></p>
                                <small>'.$product_desc.'</small>
                                <h5>₱ '.number_format($price, '2').'</h5>
                                <button type="button" class="btn btn-sm btn-primary" onclick="add_to_cart(\'' . $product_id . '\',)">ADD TO CART</button>
                                <button type="button" class="btn btn-sm btn-secondary" onclick="add_to_wishlist(\'' . $product_id . '\',\'' . $customer_id . '\')"><i class="fa fa-heart"></i></button>
                            </div>
                        </div>
                    ';
                } else {
                    $customer_id = "";
                    $quantity = 1;

                    echo '
                        <div class="card">
                            <div class="card-body">
                                <p class="card-text"><a href="#">'.$product_name.'</a></p>
                                <small>'.$product_desc.'</small>
                                <h5>₱ '.number_format($price, '2').'</h5>
                                <button type="button" class="btn btn-sm btn-primary" onclick="add_to_cart(\'' . $customer_id . '\', \'' . $product_id . '\', \'' . $quantity . '\')">ADD TO CART</button>
                                <button type="button" class="btn btn-sm btn-secondary" onclick="alert_to_login()"><i class="fa fa-heart"></i></button>
                            </div>
                        </div>
                    ';
                }
            }
        }
        echo '</div>';
    }

    function get_wishlist_rows($customer_id) {
        $conn = $this->db_conn();
        $sql = "SELECT * FROM customer_wishlist WHERE customer_id='$customer_id'";
        $result = $conn->query($sql);

        $numrow = mysqli_num_rows($result);

        return $numrow;
    }

    function get_stock_status($column, $stock_status_id) {
        $conn = $this->db_conn();
        $sql = "SELECT $column FROM stock_status WHERE stock_status_id='$stock_status_id'";
        $result = mysqli_fetch_assoc($conn->query($sql));

        return $result[$column];
    }
}

$class = new BaseController();
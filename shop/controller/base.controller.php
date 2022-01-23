<?php
require "config.php";
date_default_timezone_set("Singapore");

class BaseController extends database_connection {
    // Navbar menu
    function get_categories() {
        $conn = $this->db_conn();
        $sql = "SELECT * FROM categories WHERE category_status=1";
		$result = mysqli_query($conn, $sql);

        foreach ($result as $key => $value) {
            $category_id = $value["category_id"];
            $category_status = $value["category_status"];
            $category_name = $this->get_category_description("category_name", $category_id);
            $description = $this->get_category_description("description", $category_id);
            $meta_title = $this->get_category_description("meta_title", $category_id);

            echo '<a class="dropdown-item" href="category?category_id='.$category_id.'">'.$category_name.'</a>';
		}
       
    }
    
    // Side menu on category page
    function side_categories() {
        $conn = $this->db_conn();
        $sql = "SELECT * FROM categories WHERE category_status=1";
		$result = mysqli_query($conn, $sql);

        foreach ($result as $key => $value) {
            $category_id = $value["category_id"];
            $category_name = $this->get_category_description("category_name", $category_id);

            echo '<li class="list-group-item"><a class="text-decoration-none" href="category?category_id='.$category_id.'">'.$category_name.'</a></li>';
		}
    }

    // Display product every catrgories
    function get_product_to_category($category_id) {
        $conn = $this->db_conn();
        $sql = "SELECT * FROM product_to_category WHERE category_id='$category_id'";
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

    // Get the product details to display in categories
    function get_products($product_id) {
        $conn = $this->db_conn();
        $sql = "SELECT * FROM product WHERE product_id='$product_id' AND product.product_status=1";
        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
                $product_name = $row["product_name"];
                $price = number_format($row["price"], 2);
                $product_id = $row["product_id"];
                $product_desc = $this->get_product_description("product_desc", $product_id);
                
                // Use for manage the lenght of description
                $product_desc = strip_tags($product_desc);
                if (strlen($product_desc) > 55) {
                    $stringCut = substr($product_desc, 0 , 55);
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
                    $quantity = 1;

                    echo '
                    <div class="mb-3 col-sm-12 col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <img src="assets/images/products/shopping-bag-icon4.png" class="card-img-top product-icon" alt="'.$product_name.'_img">
                                <p class="card-text"><a href="product?product_id='.$product_id.'" class="text-decoration-none">'.$product_name.'</a></p>
                                <small>'.$product_desc.'</small>
                                <h5>₱ '.$price.'</h5>
                                <div class="d-grid gap-1 d-sm-flex justify-content-sm-center">
                                    <button type="button" class="btn btn-primary" onclick="add_to_cart(\'' . $customer_id . '\', \'' . $product_id . '\', \'' . $quantity . '\')"><i class="fa fa-shopping-cart"></i> ADD TO CART</button>
                                    <button type="button" class="btn btn-secondary" onclick="add_to_wishlist(\'' . $product_id . '\',\'' . $customer_id . '\')"><i class="fa fa-heart"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    ';
                } else {
                    $customer_id = "";
                    $quantity = 1;

                    echo '
                    <div class="mb-3 col-sm-12 col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <img src="assets/images/products/shopping-bag-icon4.png" class="card-img-top product-icon" alt="'.$product_name.'_img">
                                <p class="card-text"><a href="product?product_id='.$product_id.'" class="text-decoration-none">'.$product_name.'</a></p>
                                <small>'.$product_desc.'</small>
                                <h5>₱ '.$price.'</h5>

                                <div class="d-grid gap-1 d-sm-flex justify-content-sm-center">
                                    <button type="button" class="btn btn-primary" onclick="add_to_cart(\'' . $customer_id . '\', \'' . $product_id . '\', \'' . $quantity . '\')"><i class="fa fa-shopping-cart"></i> ADD TO CART</button>
                                    <button type="button" class="btn btn-secondary" onclick="alert_to_login()"><i class="fa fa-heart"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    ';
                }
            }
        }
    }

    // Display products in featured products section, this is limit by 4 products only
    function get_featuredProducts() {
        $conn = $this->db_conn();
        $sql = "SELECT * FROM product WHERE product_status=1 LIMIT 4";
        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
                $product_name = $row["product_name"];
                $price = number_format($row["price"], 2);
                $product_id = $row["product_id"];
                $product_desc = $this->get_product_description("product_desc", $product_id);

                // Use for manage the lenght of description
                $product_desc = strip_tags($product_desc);
                if (strlen($product_desc) > 55) {
                    $stringCut = substr($product_desc, 0 , 55);
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
                    $quantity = 1;

                    echo '
                    <div class="col-sm-12 col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <img src="assets/images/products/shopping-bag-icon4.png" class="card-img-top product-icon" alt="'.$product_name.'_img">
                                <p class="card-text"><a href="product?product_id='.$product_id.'" class="text-decoration-none">'.$product_name.'</a></p>
                                <small>'.$product_desc.'</small>
                                <h5>₱ '.$price.'</h5>
                                <div class="d-grid gap-1">
                                    <button type="button" class="btn btn-primary" onclick="add_to_cart(\'' . $customer_id . '\',\'' . $product_id . '\',\'' . $quantity . '\')"><i class="fa fa-shopping-cart"></i> ADD TO CART</button>
                                    <button type="button" class="btn btn-secondary" onclick="add_to_wishlist(\'' . $product_id . '\',\'' . $customer_id . '\')"><i class="fa fa-heart"></i> ADD TO WISHLIST</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    ';
                } else {
                    $customer_id = "";
                    $quantity = 1;

                    echo '
                    <div class="col-sm-12 col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <img src="assets/images/products/shopping-bag-icon4.png" class="card-img-top product-icon" alt="'.$product_name.'_img">
                                <p class="card-text"><a href="product?product_id='.$product_id.'" class="text-decoration-none">'.$product_name.'</a></p>
                                <small>'.$product_desc.'</small>
                                <h5>₱ '.$price.'</h5>
                                <div class="d-grid gap-1">
                                    <button type="button" class="btn btn-primary" onclick="add_to_cart(\'' . $customer_id . '\', \'' . $product_id . '\', \'' . $quantity . '\')"><i class="fa fa-shopping-cart"></i>  ADD TO CART</button>
                                    <button type="button" class="btn btn-secondary" onclick="alert_to_login()"><i class="fa fa-heart"></i> ADD TO WISHLIST</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    ';
                }
            }
        } else {
            echo '
                <div class="col-sm-12">
                    <div class="container card"> 
                        <div class="card-body">
                            <h2 class="text-center font-weight-normal">No products yet..</h2>
                        </div>
                    </div>
                </div>
            ';
        }
    }

    // Display products in newest products section, this is limit by 4 products only and use order by date to select the currently added product in dashboard
    function get_newProducts() {
        $conn = $this->db_conn();
        $sql = "SELECT * FROM product WHERE product_status=1 ORDER BY date_added DESC LIMIT 4";
        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
                $product_name = $row["product_name"];
                $price = number_format($row["price"], 2);
                $product_id = $row["product_id"];
                // This variable use for cut or limit the description display each product.
                $product_desc = $this->get_product_description("product_desc", $product_id);
            
                // Use for manage the lenght of description.
                $product_desc = strip_tags($product_desc);
                if (strlen($product_desc) > 55) {
                    $stringCut = substr($product_desc, 0 , 55);
                    $endPoint = strrpos($stringCut, ' ');

                    $product_desc = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                    $product_desc .= '...';
                }

                // If there is no product_desc display N/A
                if ($product_desc == "" || $product_desc == NULL) {
                    $product_desc .= "N/A";
                } 

                if (isset($_SESSION["customer_id"])) {
                    $customer_id = $_SESSION["customer_id"];
                    $quantity = 1;

                    echo '
                    <div class="col-sm-12 col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <img src="assets/images/products/shopping-bag-icon4.png" class="card-img-top product-icon" alt="'.$product_name.'_img">
                                <p class="card-text"><a href="product?product_id='.$product_id.'" class="text-decoration-none">'.$product_name.'</a></p>
                                <p><small>'.$product_desc.'</small></p>
                                <h5>₱ '.$price.'</h5>
                                <div class="d-grid gap-1">
                                    <button type="button" class="btn btn-primary" onclick="add_to_cart(\'' . $customer_id . '\',\'' . $product_id . '\',\'' . $quantity . '\')"><i class="fa fa-shopping-cart"></i> ADD TO CART</button>
                                    <button type="button" class="btn btn-secondary" onclick="add_to_wishlist(\'' . $product_id . '\',\'' . $customer_id . '\')"><i class="fa fa-heart"></i> ADD TO WISHLIST</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    ';
                } else {
                    $customer_id = "";
                    $quantity = 1;

                    echo '
                    <div class="col-sm-12 col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <img src="assets/images/products/shopping-bag-icon4.png" class="card-img-top product-icon" alt="'.$product_name.'_img">
                                <p class="card-text"><a href="product?product_id='.$product_id.'" class="text-decoration-none">'.$product_name.'</a></p>
                                <p><small>'.$product_desc.'</small></p>
                                <h5>₱ '.$price.'</h5>
                                <div class="d-grid gap-1">
                                    <button type="button" class="btn btn-primary" onclick="add_to_cart(\'' . $customer_id . '\', \'' . $product_id . '\', \'' . $quantity . '\')"><i class="fa fa-shopping-cart"></i>  ADD TO CART</button>
                                    <button type="button" class="btn btn-secondary" onclick="alert_to_login()"><i class="fa fa-heart"></i> ADD TO WISHLIST</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    ';
                }
            }
        } else {
            echo '
                <div class="col-sm-12">
                    <div class="container card"> 
                        <div class="card-body">
                            <h2 class="text-center font-weight-normal">No products yet..</h2>
                        </div>
                    </div>
                </div>
            ';
        }
    }

    // Get the numbers of rows in wishlist
    function get_wishlist_rows($customer_id) {
        $conn = $this->db_conn();
        $sql = "SELECT * FROM customer_wishlist WHERE customer_id='$customer_id'";
        $result = $conn->query($sql);

        $numrow = mysqli_num_rows($result);

        return $numrow;
    }

    // Get the numbers of rows in cart
    function get_cart_rows($customer_id) {
        $conn = $this->db_conn();
        $sql = "SELECT * FROM cart WHERE customer_id='$customer_id'";
        $result = $conn->query($sql);
        $numrow = mysqli_num_rows($result);

        return $numrow;
    }

    function get_order_product_rows($order_id) {
        $conn = $this->db_conn();
        $sql = "SELECT * FROM order_product WHERE order_id='$order_id'";
        $result = $conn->query($sql);

        $numrow = mysqli_num_rows($result);

        return $numrow;
    }

    function get_product_category($column, $product_id) {
        $conn = $this->db_conn();
        $sql = "SELECT $column FROM product_to_category WHERE product_id='$product_id'";
        $result = mysqli_fetch_assoc($conn->query($sql));

        return $result[$column];
    }

    function get_product_manufacturer($column, $manufacturer_id) {
        $conn = $this->db_conn();
        $sql = "SELECT $column FROM manufacturer WHERE manufacturer_id='$manufacturer_id'";
        $result = mysqli_fetch_assoc($conn->query($sql));

        return $result[$column];
    }

    function get_product_stock_status($column, $stock_status_id) {
        $conn = $this->db_conn();
        $sql = "SELECT $column FROM stock_status WHERE stock_status_id='$stock_status_id'";
        $result = mysqli_fetch_assoc($conn->query($sql));

        return $result[$column];
    }

    function get_product_description($column, $product_id) {
        $conn = $this->db_conn();
        $sql = "SELECT $column FROM product_description WHERE product_id='$product_id'";
        $result = mysqli_fetch_assoc($conn->query($sql));

        return $result[$column];
    }

    function get_category_description($column, $category_id) {
        $conn = $this->db_conn();
        $sql = "SELECT $column FROM category_description WHERE category_id='$category_id'";
        $result = mysqli_fetch_assoc($conn->query($sql));

        return $result[$column];
    }

    function get_product($column, $product_id) {
        $conn = $this->db_conn();
        $sql = "SELECT $column FROM product WHERE product_id='$product_id' AND product_status=1";
        $result = mysqli_fetch_assoc($conn->query($sql));

        return $result[$column];
    }

    function get_categories_status($column, $category_id) {
        $conn = $this->db_conn();
        $sql = "SELECT $column FROM categories WHERE category_id='$category_id'";
        $result = mysqli_fetch_assoc($conn->query($sql));

        return $result[$column];
    }

    function get_orders_tables($column, $table, $wherevalues) {
        $conn = $this->db_conn();
        $sql = "SELECT $column FROM $table WHERE $wherevalues";
        $result = mysqli_fetch_assoc($conn->query($sql));

        return $result[$column];
    }

    function get_orders_history($column, $wherevalues) {
        $conn = $this->db_conn();
        $sql = "SELECT $column FROM orders_history WHERE $wherevalues ORDER BY order_history_id DESC";
        $result = mysqli_fetch_assoc($conn->query($sql));

        return $result[$column];
    }

    function get_customer_wishlist($customer_id) {
        $table = "";
		$conn = $this->db_conn();
		$sql = "SELECT * FROM customer_wishlist WHERE customer_id='$customer_id'";
		$result = mysqli_query($conn, $sql);

		$table .= '
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Product Name</th>
                        <th>Stock</th>
                        <th>Price</th>
						<th>Action</th>
					</tr>
				</thead>

				<tbody>
		';
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$customer_id = $row["customer_id"];
                $product_id = $row["product_id"];

                $product_name = $this->get_product("product_name", $product_id);
                $product_status = $this->get_product("product_status", $product_id);
                $price = $this->get_product("price", $product_id);
                $stock_status_id = $this->get_product("stock_status_id", $product_id);
                $stock_status_name = $this->get_product_stock_status("name", $stock_status_id);

                $quantity = 1;

                if ($product_status == 1) {
                    $table .= '
                        <tr>
                            <td>'.$product_name.'</td>
                            <td>'.$stock_status_name.'</td>
                            <td>₱ '.number_format($price, 2).'</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-outline-primary" onclick="add_to_cart(\'' . $customer_id . '\',\'' . $product_id . '\',\'' . $quantity . '\')"><i class="fa fa-shopping-cart"></i></button>

                                <button type="button" class="btn btn-outline-danger" onclick="remove_wishlist(\'' . $product_id . '\')"><i class="fas fa-ban"></i></button>
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

    function get_cart_info($column, $cart_id) {
        $conn = $this->db_conn();
        $sql = "SELECT $column FROM cart WHERE cart_id='$cart_id'";
        $result = mysqli_fetch_assoc($conn->query($sql));

        return $result[$column];
    }

    function get_customer_cart($customer_id) {
        $table = "";
		$conn = $this->db_conn();
		$sql = "SELECT * FROM cart WHERE customer_id='$customer_id'";
		$result = mysqli_query($conn, $sql);

		$table .= '

			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Product Name</th>
                        <th>Manufacturer</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Action</th>
					</tr>
				</thead>

				<tbody>
		';
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
                $cart_id = $row["cart_id"];
				$customer_id = $row["customer_id"];
                $product_id = $row["product_id"];
                $quantity = $row["quantity"];

                $product_name = $this->get_product("product_name", $product_id);
                $product_status = $this->get_product("product_status", $product_id);
                $price = $this->get_product("price", $product_id);
                $stock_status_id = $this->get_product("stock_status_id", $product_id);
                $manufacturer_id = $this->get_product("manufacturer_id", $product_id);

                $manufacturer_name = $this->get_product_manufacturer("name", $manufacturer_id);

                if ($manufacturer_id == 0) {
                    $manufacturer_name = "N/A";
                }

                $cart_product_id = $this->get_cart_info("product_id", $cart_id);

                $total_price = $price * $quantity;

                if ($product_status == 1) {
                    $table .= '
                        <tr>
                            <td>'.$product_name.'</td>
                            <td>'.$manufacturer_name.'</td>
                            <td>
                                <div class="input-group">
                                    <input type="number" class="form-control" value="'.$quantity.'" id="quantity'.$cart_id.'">
                                    <button type="button" class="btn btn-outline-primary" onclick="update_quantity(\'' . $cart_id . '\')">Update</button>
                                </div>
                            </td>
                            <td>₱ '.number_format($price, 2).'</td>
                            <td data-id="'.$cart_id.'">₱ <span>'.number_format($total_price, 2).'</span></td>
                            <td class="text-center">
                                <button type="button" class="btn btn-outline-danger" onclick="remove_product(\'' . $cart_id . '\')" alt="Remove"><i class="fas fa-ban"></i></button>
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

    function get_customer_address($column, $customer_id) {
        $conn = $this->db_conn();
        $sql = "SELECT $column FROM customer_address WHERE customer_id='$customer_id'";
        $result = mysqli_fetch_assoc($conn->query($sql));

        return $result[$column];
    }

    function get_cart_to_confirm($customer_id) {
        $table = "";
		$conn = $this->db_conn();
		$sql = "SELECT * FROM cart WHERE customer_id='$customer_id'";
		$result = mysqli_query($conn, $sql);

		$table .= '
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Product Name</th>
                        <th>Manufacturer</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th class="text-end">Total</th>
					</tr>
				</thead>

				<tbody>
		';
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {

                $cart_id = $row["cart_id"];
				$customer_id = $row["customer_id"];
                $product_id = $row["product_id"];
                $quantity = $row["quantity"];

                $product_name = $this->get_product("product_name", $product_id);
                $product_status = $this->get_product("product_status", $product_id);
                $price = $this->get_product("price", $product_id);
                $stock_status_id = $this->get_product("stock_status_id", $product_id);
                $manufacturer_id = $this->get_product("manufacturer_id", $product_id);

                $manufacturer_name = $this->get_product_manufacturer("name", $manufacturer_id);


                if ($manufacturer_id == 0) {
                    $manufacturer_name = "N/A";
                }

                $total_price = $price * $quantity;

                if ($product_status == 1) {
                    $table .= '
                        <tr>
                            <td><a href="product?product_id='.$product_id.'" class="text-decoration-none"> '.$product_name.'</a></td>
                            <td>'.$manufacturer_name.'</td>
                            <td>'.$quantity.'</td>
                            <td>₱ '.number_format($price, 2).'</td>
                            <td data-id="'.$cart_id.'" class="text-end">₱ <span>'.number_format($total_price, 2).'</span></td>
                        </tr>
                    ';
                }
			}
		}

		$table .='
                    <tr>
                        <td colspan="3"></td>
                        <td class="text-end fw-bold">SUB-TOTAL:</td>
                        <td class="text-end fw-normal" id="sub-total"></td>
                    </tr>
                    
                    <tr>
                        <td colspan="3"></td>
                        <td class="text-end fw-bold">VAT:</td>
                        <td class="text-end fw-normal" id="vat"></td>
                    </tr>

                    <tr>
                        <td colspan="3"></td>
                        <td class="text-end fw-bold">TOTAL:</td>
                        <td class="text-end fw-bold" id="total-price"></td>
                    </tr>
				</tbody>
			</table>
        ';


		echo $table;
    }

    function get_banks($column, $bank_name) {
        $conn = $this->db_conn();
        $sql = "SELECT $column FROM banks WHERE bank_name='$bank_name'";
        $result = mysqli_fetch_assoc($conn->query($sql));

        return $result[$column];
    }

    function site_map_categories() {
        $conn = $this->db_conn();
        $sql = "SELECT * FROM categories WHERE category_status=1";
        $result = mysqli_query($conn, $sql);

        foreach ($result as $key => $value) {
            $category_id = $value["category_id"];
            $category_name = $this->get_category_description("category_name", $category_id);

            echo '<li><a href="category?category_id='.$category_id.'" class="text-decoration-none">'.$category_name.'</a></li>';
		}
    }

    function get_about_us() {
        $info_title = "About Us";
        $conn = $this->db_conn();
        $sql = "SELECT * FROM information_description WHERE info_title='$info_title'";
        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) { 
                $information_id = $row["information_id"];
                $info_title = $row["info_title"];
                $info_description = $row["info_description"];
                $info_status = $row["info_status"];

                if ($info_status == 1) {
                    echo '
                        <h3>'.$info_title.'</h3>

                        <p class="mt-5 text-lg-start">'.$info_description.'</p>
                    ';
                } else {
                    echo '
                        <h3>'.$info_title.'</h3>

                        <h4 class="mt-5 text-lg-start fw-normal">No Content.</h4>
                    ';
                }
            }
        }
    }

    function get_privacy_policy() {
        $info_title = "Privacy Policy";
        $conn = $this->db_conn();
        $sql = "SELECT * FROM information_description WHERE info_title='$info_title'";
        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) { 
                $information_id = $row["information_id"];
                $info_title = $row["info_title"];
                $info_description = $row["info_description"];
                $info_status = $row["info_status"];

                if ($info_status == 1) {
                    echo '
                        <h3>'.$info_title.'</h3>

                        <p class="mt-5 text-lg-start">'.$info_description.'</p>
                    ';
                } else {
                    echo '
                        <h3>'.$info_title.'</h3>

                        <h4 class="mt-5 text-lg-start fw-normal">No Content.</h4>
                    ';
                }
            }
        }
    }

    function get_terms_and_condition() {
        $info_title = "Terms & Condition";
        $conn = $this->db_conn();
        $sql = "SELECT * FROM information_description WHERE info_title='$info_title'";
        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) { 
                $information_id = $row["information_id"];
                $info_title = $row["info_title"];
                $info_description = $row["info_description"];
                $info_status = $row["info_status"];

                if ($info_status == 1) {
                    echo '
                        <h3>'.$info_title.'</h3>

                        <p class="mt-5 text-lg-start">'.$info_description.'</p>
                    ';
                } else {
                    echo '
                        <h3>'.$info_title.'</h3>

                        <h4 class="mt-5 text-lg-start fw-normal">No Content.</h4>
                    ';
                }
            }
        }
    }


    function get_order_history($customer_id) {
        $table = "";
		$conn = $this->db_conn();
		$sql = "SELECT * FROM orders WHERE customer_id='$customer_id' ORDER BY order_id DESC";
		$result = mysqli_query($conn, $sql);

		$table .= '
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Order ID</th>
                        <th>Customer</th>
                        <th>No. of Products</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Date Added</th>
                        <th>Action</th>
					</tr>
				</thead>

				<tbody>
		';
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
                $customer_id = $row["customer_id"];
                $order_id = $row["order_id"];
				$firstname = $row["firstname"];
                $lastname = $row["lastname"];
                $order_status_id = $row["order_status_id"];
                $total = $row["total"];
                $date_added = $row["date_added"];

                $order_product_num = $this->get_order_product_rows($order_id);
                $order_status = $this-> get_orders_tables("name", "order_status", "order_status_id='$order_status_id'");

                $table .= '
                    <tr>
                        <td>'.$order_id.'</td>
                        <td>'.$firstname.' '.$lastname.'</td>
                        <td class="text-end">'.$order_product_num.'</td>
                        <td>'.$order_status.'</td>
                        <td>₱ '.number_format($total, 2).'</td>
                        <td>'.$date_added.'</td>
                        <td class="text-center">
                            <a href="order_information?order_id='.$order_id.'" class="btn btn-outline-primary" alt="Remove"><i class="fas fa-eye"></i></a>
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

    function get_orders_product($order_id) {
		$table = "";
		$conn = $this->db_conn();
		$sql = "SELECT * FROM order_product WHERE order_id='$order_id'";
		$result = mysqli_query($conn, $sql);

		$table .= '
			<table class="table table-bordered">
				<tbody>
                    <td>Product</td>
                    <td>Quantity</td>
                    <td>Price</td>
                    <td class="text-end">Total</td>
                    <td class="text-center">Action</td>
		';
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$order_id = $row["order_id"];
				$product_id = $row["product_id"];
				$product_name = $row["product_name"];
				$quantity = $row["quantity"];
				$price = $row["price"];
				$total = $row["total"];

                $subtotal = $this->get_orders_tables("val", "order_total", "order_id='$order_id' AND title='Sub-total'");
                $over_all_total = $this->get_orders_tables("val", "order_total", "order_id='$order_id' AND title='Total'");
                $vat = $this->get_orders_tables("val", "order_total", "order_id='$order_id' AND title='Vat'");

                $customer_id = $_SESSION["customer_id"];

				$table .= '
					<tr>
						<td>'.$product_name.'</td>
						<td>'.$quantity.'</td>
						<td>₱ '.number_format($price, 2).'</td>
						<td class="text-end">₱ <span>'.number_format($total, 2).'</span></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="add_to_cart(\'' . $customer_id . '\', \'' . $product_id . '\', \'' . $quantity . '\')">Re-order</button>
                        </td>
					</tr>
				';
			}
		}

		$table .='
					<tr>
						<td colspan="2"></td>
						<td class="text-end">Sub-total:</td>
						<td class="text-end fw-normal">₱ '.number_format($subtotal, 2).'</td>
                        <td></td>
					</tr>
					
					<tr>
						<td colspan="2"></td>
						<td class="text-end">Vat:</td>
						<td class="text-end fw-normal" id="vat">₱ '.number_format($vat, 2).'</td>
                        <td></td>
					</tr>

					<tr>
						<td colspan="2"></td>
						<th class="text-end">Total:</th>
						<td class="text-end fw-bold" id="total-price">₱ '.number_format($over_all_total, 2).'</td>
                        <td></td>
					</tr>
				</tbody>
			</table>
		';

		echo $table;
	}

}

$class = new BaseController();
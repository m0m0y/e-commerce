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

            echo '<li class="list-group-item"><a class="category-menu" href="category?category_id='.$category_id.'">'.$category_name.'</a></li>';
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
                                <p class="card-text"><a href="product?product_id='.$product_id.'">'.$product_name.'</a></p>
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
                                <p class="card-text"><a href="product?product_id='.$product_id.'">'.$product_name.'</a></p>
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
                                <p class="card-text"><a href="product?product_id='.$product_id.'">'.$product_name.'</a></p>
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
                                <p class="card-text"><a href="product?product_id='.$product_id.'">'.$product_name.'</a></p>
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
                                <p class="card-text"><a href="product?product_id='.$product_id.'">'.$product_name.'</a></p>
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
                                <p class="card-text"><a href="product?product_id='.$product_id.'">'.$product_name.'</a></p>
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
                            <td>
                                <button type="button" class="btn btn-sm btn-primary" onclick="add_to_cart(\'' . $customer_id . '\',\'' . $product_id . '\',\'' . $quantity . '\')"><i class="fa fa-shopping-cart"></i></button>

                                <button type="button" class="btn btn-sm btn-danger" onclick="remove_wishlist(\'' . $product_id . '\')"><i class="fas fa-ban"></i></button>
                            </td>
                        </tr>
                    ';
                }
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
}

$class = new BaseController();
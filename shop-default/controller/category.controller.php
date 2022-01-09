<?php
require "config.php";

class Categories extends database_connection {
    function get_categories() {
        $conn = $this->db_conn();
        $sql = "SELECT categories.category_id, category_description.category_id, category_description.category_name, category_description.description, category_description.meta_title FROM categories INNER JOIN category_description ON categories.category_id = category_description.category_id WHERE categories.category_status=1";
		$result = mysqli_query($conn, $sql);

        foreach ($result as $key => $value) {
            echo '<a class="dropdown-item" href="category?id='.$value["category_id"].'">'.$value["category_name"].'</a>';
		}
    }
}

$class = new Categories();
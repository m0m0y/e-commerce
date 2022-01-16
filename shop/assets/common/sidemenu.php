<?php 
if (isset($_SESSION["customer_id"])) {
?>
    <div class="menu"> 
        <ul class="list-group">
            <li class="list-group-item"><a href="<?= $BASE_URL ?>myaccount" class="text-decoration-none">My Account</a></li>
            <li class="list-group-item"><a href="<?= $BASE_URL ?>update_account" class="text-decoration-none">Edit Account</a></li>
            <li class="list-group-item"><a href="<?= $BASE_URL ?>update_password" class="text-decoration-none">Password</a></li>
            <li class="list-group-item"><a href="<?= $BASE_URL ?>update_address" class="text-decoration-none">Update Address</a></li>
            <li class="list-group-item"><a href="<?= $BASE_URL ?>wishlist" class="text-decoration-none">Wishlist</a></li>
            <li class="list-group-item"><a href="#" class="text-decoration-none">Order History</li>
            <li class="list-group-item"><a href="#" class="text-decoration-none">Transaction</a></li>
            <li class="list-group-item"><a href="<?= $BASE_URL ?>logout" class="text-decoration-none">Logout</a></li>
        </ul>
    </div>
<?php
} else {
?>
    <div class="menu"> 
        <ul class="list-group">
            <li class="list-group-item"><a href="<?= $BASE_URL ?>login" class="text-decoration-none">Login</a></li>
            <li class="list-group-item"><a href="<?= $BASE_URL ?>register" class="text-decoration-none">Register</a></li>
            <li class="list-group-item"><a href="#" class="text-decoration-none">Forget Password</a></li>
            <li class="list-group-item"><a href="<?= $BASE_URL ?>login" class="text-decoration-none">My Account</a></li>
            <li class="list-group-item"><a href="<?= $BASE_URL ?>login" class="text-decoration-none">Address Book</a></li>
            <li class="list-group-item"><a href="<?= $BASE_URL ?>login" class="text-decoration-none">Wishlist</a></li>
            <li class="list-group-item"><a href="<?= $BASE_URL ?>login" class="text-decoration-none">Order History</a></li>
            <li class="list-group-item"><a href="<?= $BASE_URL ?>login" class="text-decoration-none">Transaction</a></li>
        </ul>
    </div>
<?php
}
?>

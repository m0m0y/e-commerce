<?php 
if (isset($_SESSION["customer_id"])) {
?>
    <div class="menu"> 
        <ul class="list-group">
            <li class="list-group-item">My Account</li>
            <li class="list-group-item">Edit Account</li>
            <li class="list-group-item">Password</li>
            <li class="list-group-item">Address Book</li>
            <li class="list-group-item">Wishlist</li>
            <li class="list-group-item">Order History</li>
            <li class="list-group-item">Transaction</li>
            <li class="list-group-item">Logout</li>
        </ul>
    </div>
<?php
} else {
?>
    <div class="menu"> 
        <ul class="list-group">
            <li class="list-group-item">Login</li>
            <li class="list-group-item">Register</li>
            <li class="list-group-item">Forget Password</li>
            <li class="list-group-item">My Account</li>
            <li class="list-group-item">Address Book</li>
            <li class="list-group-item">Wishlist</li>
            <li class="list-group-item">Order History</li>
            <li class="list-group-item">Transaction</li>
        </ul>
    </div>
<?php
}
?>

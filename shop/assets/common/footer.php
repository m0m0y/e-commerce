<?php
if (isset($_SESSION["customer_id"])) {
?>

<section class="mt-5 container-fluid footer-section">
    <div class="container pt-5">
        <div class="row">
            <div class="col-sm-12 col-md-3 pb-4">
                <h5>Information</h5>
                <a href="about" class="text-decoration-none text-white">About Us</a>
                <br/>
                <a href="privacy_policy" class="text-decoration-none text-white">Privacy Policy</a>
                <br/>
                <a href="terms_and_condition" class="text-decoration-none text-white" text-white>Terms & Condition</a>
            </div>

            <div class="col-sm-12 col-md-3 pb-4">
                <h5>Customer Service</h5>
                <a href="contact" class="text-decoration-none text-white">Contact Us</a>
                <br/>
                <a href="#" class="text-decoration-none text-white">Returns</a>
                <br/>
                <a href="site_map" class="text-decoration-none text-white">Site Map</a>
            </div>

            <div class="col-sm-12 col-md-3 pb-4">
                <h5>Extras</h5>
                <a href="manufacturer" class="text-decoration-none text-white">Manufacturer</a>
                <br/>
                <a href="#" class="text-decoration-none text-white">Special Offers</a>
            </div>

            <div class="col-sm-12 col-md-3 pb-4">
                <h5>My Account</h5>
                <a href="myaccount" class="text-decoration-none text-white">My Account</a>
                <br/>
                <a href="order_history" class="text-decoration-none text-white">Order History</a>
                <br/>
                <a href="wishlist" class="text-decoration-none text-white">Wish List</a>
            </div>

            <div class="pb-5"> 
                <div class="col-md-12">
                    <small>Copyright &copy; Your Website 2021</small>
                </div>
            </div>
        </div>
    </div>
</section>

<?php } else { ?> 

<section class="mt-5 container-fluid footer-section">
    <div class="container pt-5">
        <div class="row">
            <div class="col-sm-12 col-md-3 pb-4">
                <h5>Information</h5>
                <a href="about" class="text-decoration-none text-white">About Us</a>
                <br/>
                <a href="privacy_policy" class="text-decoration-none text-white">Privacy Policy</a>
                <br/>
                <a href="terms_and_condition" class="text-decoration-none text-white">Terms & Condition</a>
            </div>

            <div class="col-sm-12 col-md-3 pb-4">
                <h5>Customer Service</h5>
                <a href="contact" class="text-decoration-none text-white">Contact Us</a>
<<<<<<< HEAD
                <br/>
                <a href="#" class="text-decoration-none text-white">Returns</a>
=======
>>>>>>> e9687b951bb12d6a70f790f21a7896a294e742b0
                <br/>
                <a href="site_map" class="text-decoration-none text-white">Site Map</a>
            </div>

            <div class="col-sm-12 col-md-3 pb-4">
                <h5>Extras</h5>
                <a href="manufacturer" class="text-decoration-none text-white">Manufacturer</a>
                <br/>
                <a href="#" class="text-decoration-none text-white">Special Offers</a>
            </div>

            <div class="col-sm-12 col-md-3 pb-4">
                <h5>My Account</h5>
                <a href="login" class="text-decoration-none text-white">My Account</a>
                <br/>
                <a href="login" class="text-decoration-none text-white">Order History</a>
                <br/>
                <a href="login" class="text-decoration-none text-white">Wish List</a>
            </div>

            <div class="pb-5"> 
                <div class="col-md-12">
                    <small>Copyright &copy; Your Website 2021</small>
                </div>
            </div>
        </div>
    </div>
</section>

<?php } ?>
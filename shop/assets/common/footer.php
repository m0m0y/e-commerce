<?php
if (isset($_SESSION["customer_id"])) {
?>

<section class="mt-5 container-fluid footer-section">
    <div class="container pb-4 pt-4">
        <div class="row">
            <div class="col-sm-12 col-md-3">
                <h5>Information</h5>
                <a href="about" class="text-decoration-none text-white">About Us</a>
                <br/>
                <a href="privacy_policy" class="text-decoration-none text-white">Privacy Policy</a>
                <br/>
                <a href="terms_and_condition" class="text-decoration-none text-white" text-white>Terms & Condition</a>
            </div>

            <div class="col-sm-12 col-md-3">
                <h5>Customer Service</h5>
                <a href="about" class="text-decoration-none text-white">Contact Us</a>
                <br/>
                <a href="site_map" class="text-decoration-none text-white">Site Map</a>
            </div>

            <div class="col-sm-12 col-md-3">
                <h5>Extras</h5>
                <a href="manufacturer" class="text-decoration-none text-white">Manufacturer</a>
                <br/>
                <a href="#" class="text-decoration-none text-white">Special Offers</a>
            </div>

            <div class="col-sm-12 col-md-3">
                <h5>My Account</h5>
                <a href="myaccount" class="text-decoration-none text-white">My Account</a>
                <br/>
                <a href="#" class="text-decoration-none text-white">Order History</a>
                <br/>
                <a href="#" class="text-decoration-none text-white">Wish List</a>
            </div>

            <div class="pt-5"> 
                <div class="col-md-12">
                    <small>Copyright &copy; Your Website 2021</small>
                </div>
            </div>
        </div>
    </div>
</section>

<?php } else { ?> 

<section class="mt-5 container-fluid footer-section">
    <div class="container pb-4 pt-4">
        <div class="row">
            <div class="col-sm-12 col-md-3">
                <h5>Information</h5>
                <a href="about" class="text-decoration-none text-white">About Us</a>
                <br/>
                <a href="privacy_policy" class="text-decoration-none text-white">Privacy Policy</a>
                <br/>
                <a href="terms_and_condition" class="text-decoration-none text-white">Terms & Condition</a>
            </div>

            <div class="col-sm-12 col-md-3">
                <h5>Customer Service</h5>
                <a href="about" class="text-decoration-none text-white">Contact Us</a>
                <br/>
                <a href="site_map" class="text-decoration-none text-white">Site Map</a>
            </div>

            <div class="col-sm-12 col-md-3">
                <h5>Extras</h5>
                <a href="manufacturer" class="text-decoration-none text-white">Manufacturer</a>
                <br/>
                <a href="#" class="text-decoration-none text-white">Special Offers</a>
            </div>

            <div class="col-sm-12 col-md-3">
                <h5>My Account</h5>
                <a href="login" class="text-decoration-none text-white">My Account</a>
                <br/>
                <a href="login" class="text-decoration-none text-white">Order History</a>
                <br/>
                <a href="login" class="text-decoration-none text-white">Wish List</a>
            </div>

            <div class="pt-5"> 
                <div class="col-md-12">
                    <small>Copyright &copy; Your Website 2021</small>
                </div>
            </div>
        </div>
    </div>
</section>

<?php } ?>
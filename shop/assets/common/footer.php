<?php
if (isset($_SESSION["customer_id"])) {
?>

<section class="mt-5 container-fluid footer-section">
    <div class="container pb-4 pt-4">
        <div class="row">
            <div class="col-sm-12 col-md-3">
                <h5>Information</h5>
                <a href="<?= $BASE_URL ?>about" target="blank" class="btn btn-link">About Us</a>
                <br/>
                <a href="#" target="blank" class="btn btn-link">Privacy Policy</a>
                <br/>
                <a href="#" target="blank" class="btn btn-link">Terms & Condition</a>
            </div>

            <div class="col-sm-12 col-md-3">
                <h5>Customer Service</h5>
                <a href="<?= $BASE_URL ?>about" class="btn btn-link">Contact Us</a>
                <br/>
                <a href="#" target="blank" class="btn btn-link">Returns</a>
                <br/>
                <a href="#" target="blank" class="btn btn-link">Site Map</a>
            </div>

            <div class="col-sm-12 col-md-3">
                <h5>Extras</h5>
                <a href="#" target="blank" class="btn btn-link">Brands</a>
                <br/>
                <a href="#" target="blank" class="btn btn-link">Special Offers</a>
            </div>

            <div class="col-sm-12 col-md-3">
                <h5>My Account</h5>
                <a href="<?= $BASE_URL ?>myaccount" class="btn btn-link">My Account</a>
                <br/>
                <a href="#" target="blank" class="btn btn-link">Order History</a>
                <br/>
                <a href="#" target="blank" class="btn btn-link">Wish List</a>
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
                <a href="<?= $BASE_URL ?>about" class="btn btn-link">About Us</a>
                <br/>
                <a href="#" class="btn btn-link">Privacy Policy</a>
                <br/>
                <a href="#" class="btn btn-link">Terms & Condition</a>
            </div>

            <div class="col-sm-12 col-md-3">
                <h5>Customer Service</h5>
                <a href="<?= $BASE_URL ?>about" class="btn btn-link">Contact Us</a>
                <br/>
                <a href="#" class="btn btn-link">Returns</a>
                <br/>
                <a href="#" class="btn btn-link">Site Map</a>
            </div>

            <div class="col-sm-12 col-md-3">
                <h5>Extras</h5>
                <a href="#" class="btn btn-link">Brands</a>
                <br/>
                <a href="#" class="btn btn-link">Special Offers</a>
            </div>

            <div class="col-sm-12 col-md-3">
                <h5>My Account</h5>
                <a href="<?= $BASE_URL ?>login" class="btn btn-link">My Account</a>
                <br/>
                <a href="<?= $BASE_URL ?>login" class="btn btn-link">Order History</a>
                <br/>
                <a href="<?= $BASE_URL ?>login" class="btn btn-link">Wish List</a>
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
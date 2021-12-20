<?php
include "assets/common/header.php"; 
?>
<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <!-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
							<div id="usercheck"></div>
							<div class="form-group row">
								<div class="col-sm-6 mb-3 mb-sm-0">
									<input type="text" id="firstname" class="form-control" name="fname" placeholder="First Name"/>
								</div>
								<div class="col-sm-6">
									<input type="text" id="lastname" class="form-control" name="lname" placeholder ="Last Name"/>
								</div>
							</div>
							<div class="form-group">
								<input type="email" id="emailadd" class="form-control form-control-user" name="email" placeholder="Email Address"/>
							</div>
							<div class="form-group row">
								<div class="col-sm-6 mb-3 mb-sm-0">
									<input type="password" id="password" class="form-control" name="pass" placeholder="Password"/>
								</div>
								<div class="col-sm-6">
									<input type="password" id="confirm_password" class="form-control" name="confirm_pass" placeholder="Repeat Password"/>
								</div>
							</div>
							<input id="submit" type="button" class="btn btn-primary btn-user" name="submit" value="Register Account">
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="http://localhost/test/admin/">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
	<script src="assets/js/admin.min.js"></script>

	<script>
		$(document).ready(function(){
			$('#submit').on('click',function(){
				var error_msg = $('#usercheck').val();

				var fname = $('#firstname').val();
				var lname = $('#lastname').val();
				var mail = $('#emailadd').val();
				var pass = $('#password').val();
				var confirm_pass = $('#confirm_password').val();

				if(pass != confirm_pass) {
					error_msg = "Password did not match!</div>";
					$('#usercheck').text(error_msg).addClass("alert alert-danger");
				} else if (fname == "" || lname == "" || mail == "" || pass == "" || confirm_pass == ""){
					error_msg = "Please fill up the form correctly!";
					$('#usercheck').text(error_msg).addClass("alert alert-danger");
				} else {
					$.ajax({
						url:'controller/function.php?register',
						method:'POST',
						data:{
							fname:fname, lname:lname, mail:mail, pass:pass
						},
						success: function(response){
							error_msg = 'You are now registered! Do you want to <a href="http://localhost/test/admin/">Login?</a>';
							$('#usercheck').html(error_msg).addClass("alert alert-success");
							$('#submit').attr("disabled", true);
							location.refresh(true);
						}
					});
				}
			});
		});
	</script>

</body>
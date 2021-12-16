<?php 
include "assets/common/header.php"; 
session_start();
?>
<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <div id="usercheck"></div>
                                    
                                    <div class="form-group">
                                        <input type="email" id="email" class="form-control form-control-user" name="email" placeholder="Enter Email Address"/>
                                    </div>
                                    <div class="form-group">
                                        <input  type="password" id="password" class="form-control form-control-user" name="pass" placeholder ="Password"/>
                                    </div>
                        
                                    <input id="submit" type="button" class="btn btn-primary btn-user btn-block" name="sub" value="Submit">
                                    <hr>
                                    
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="text-link small" href="registration">Create an Account!</a>
                                    </div>
                                </div>
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
    <script src="js/sb-admin-2.min.js"></script>

    <script>
        $(document).ready(function(){
            $('#submit').on('click',function(){
                var error_msg = $('#usercheck').val();

                var email = $('#email').val();
                var pass = $('#password').val();

                if (email == "" || pass == ""){
                    error_msg = 'Error message!';
                    $('#usercheck').text(error_msg).addClass("alert alert-danger");
                } else {
                    $.ajax({
                        url:'controller/function.php?login',
                        type:'post',
                        data:{
                            email:email,
                            pass:pass
                        },
                        success: function(response){
                            if(response=="success") {
                                window.location.href="home";
                            } else {
                                error_msg = 'Your email and password not match!';
                                $('#usercheck').text(error_msg).addClass("alert alert-danger");
                            }
                        }
                    });
                }
            });
        });
    </script>

</body>

</html>
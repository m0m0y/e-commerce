<?php
require "config.php";
require "PHPMailer/Exception.php";
require "PHPMailer/PHPMailerAutoload.php";
require "PHPMailer/SMTP.php";
require "PHPMailer/PHPMailer.php";

class Login extends database_connection {
    function get_customer() {
        $email = $_POST["customer_email"];
        $password = $_POST["customer_password"];

        $conn = $this->db_conn();
        $sql = "SELECT * FROM customer WHERE email='$email' AND password='$password' AND status=1";
		$result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				session_start();
				$_SESSION["customer_id"] = $row["customer_id"];
				$_SESSION["firstname"] = $row["firstname"];
				$_SESSION["lastname"] = $row["lastname"];
				$_SESSION["email"] = $row["email"];
				$_SESSION["telephone"] = $row["telephone"];
				$_SESSION["password"] = $row["password"];

				// Update cart customer id that get in the session 
				$this->update_cart($_SESSION["customer_id"]);
			}
		} else {
			echo "invalid";
		}
    }

	// Get the function get_cart_customer_id to where the cart_id thats equal to 0
	function update_cart($customer_id) {
		$conn = $this->db_conn();
		$sql = "UPDATE cart SET customer_id='$customer_id' WHERE cart_id='".$this->get_cart_customer_id("cart_id")."'";

		if ($conn->query($sql) === TRUE) {
			echo "success";
		} else {
			echo "cart update error";
		}
	}

	// Get customer id that equal to 0
	function get_cart_customer_id($column) {
		$conn = $this->db_conn();
		$sql = "SELECT $column FROM cart WHERE customer_id=0";
		$result = mysqli_fetch_assoc($conn->query($sql));

		// if ($result == NULL) {
		// 	echo "success";
		// } else {
		// 	echo "success";
			return $result[$column];
		// }
	}

	function forgot_pass() {
		$customer_email = $_POST["customer_email"];

		$conn = $this->db_conn();
		$result = mysqli_query($conn, "SELECT * FROM customer WHERE email='$customer_email'");
		$row = mysqli_fetch_array($result);

		if($row) {
			$token = md5($customer_email).rand(11,9999);
			$password = "";
			$update = mysqli_query($conn,"UPDATE customer set  password='$password' WHERE email='$customer_email'");
			$link = "<a href='http://localhost/test/shop/reset-password.php?key=".$customer_email."&token=".$token."'>Click To Reset password</a>";
			
			$mail = new PHPMailer;
			$mail->isSMTP();
			$mail->SMTPDebug = 0;
			$mail->Debugoutput = 'html';
			$mail->Host = "ssl://smtp.gmail.com";
			$mail->Port = 465;
			$mail->SMTPAuth = true;
			$mail->Username = "cpascual107@gmail.com"; // Enter Email Address
			$mail->Password = "uopogosrviqdghju"; // Enter Email Password
			$mail->SetFrom("cpascual107@gmail.com"); // Sender
			$mail->addAddress($customer_email); // Reciever
			$mail->Subject = "Your Shop - Reset Password";
			$mail->Body = $link;
			$mail->isHTML(true);
			if (!$mail->send()) {
				echo "Mailer Error: " . $mail->ErrorInfo;
			} else {
				echo "Successfully sent!";
			}
		} else {
			echo "xx";
		}
	}

}

$class = new Login();

if(isset($_GET["get_customer"])){
	$class->get_customer();
}

if(isset($_GET["forgot_pass"])){
	$class->forgot_pass();
}
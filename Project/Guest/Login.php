<?php
session_start();

include("../Assets/Connection/Connection.php");

if(isset($_POST["btn_login"]))
{
	$email = $_POST["txt_email"];
	$password = $_POST["txt_password"];
	
	$selQry = "select * from tbl_user where user_email ='".$email."' and user_password='".$password."'";
	$result = $Conn->query($selQry);
	
	
	$selQry1 = "select * from tbl_shop where shop_email ='".$email."' and shop_password='".$password."' and shop_status='1'";
	$result1 = $Conn->query($selQry1);
	
	
	$selQry2 = "select * from tbl_admin where admin_email ='".$email."' and admin_password='".$password."'";
	$result2 = $Conn->query($selQry2);

	$selQry3 = "select * from tbl_deliveryboy where deliveryboy_email ='".$email."' and deliveryboy_password='".$password."'";
	$result3 = $Conn->query($selQry3);
	
	
	if($row=$result->fetch_assoc())
	{
		$_SESSION["uid"]=$row["user_id"];
		$_SESSION["uname"]=$row["user_name"];
		header("Location:../User/HomePage.php");
	}
	
	else if($row1=$result1->fetch_assoc())
	{
		$_SESSION["kid"]=$row1["shop_id"];
		$_SESSION["kname"]=$row1["shop_name"];
		header("Location:../Shop/HomePage.php");
	}
	
	else if($row2=$result2->fetch_assoc())
	{
		$_SESSION["aid"]=$row2["admin_id"];
		$_SESSION["aname"]=$row2["admin_name"];
		header("Location:../Admin/HomePage.php");
	}
	

	else if($row3=$result3->fetch_assoc())
	{
		$_SESSION["did"]=$row3["deliveryboy_id"];
		$_SESSION["dname"]=$row3["deliveryboy_name"];
		header("Location:../DeliveryBoy/HomePage.php");
	}
	
	else
	{
		echo "<script>alert('Invalid Credentials!!!')</script>";
	}
}

?>

<!doctype html>
<html lang="en">
  <head>
  	<title>FastKart</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="../Assets/Template/Login/css/style.css">

	</head>
	<body class="img js-fullheight" style="background-image: url(../Assets/Template/Login/images/bg.jpg);">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">FastKart</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
					<h3 class="mb-4 text-center">Login</h3>

		      	<form method="post" class="signin-form">
		      		<div class="form-group">
		      			<input type="email" class="form-control" placeholder="Email" name="txt_email" required>
		      		</div>
	            <div class="form-group">
	              <input id="password-field" type="password" name="txt_password" class="form-control" placeholder="Password" required>
	              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
	            </div>
	            <div class="form-group">
	            	<button type="submit" name="btn_login" class="form-control btn btn-primary submit px-3">Sign In</button>
	            </div>
	            <div class="form-group d-md-flex">
	            	<div class="w-50">
		            </div>
					<div class="w-50 text-md-right">
						<a href="../Index.html" style="color: #fff">Back to Home</a>
					</div>
	            </div>
	          </form>
	          
		      </div>
				</div>
			</div>
		</div>
	</section>

	<script src="../Assets/Template/Login/js/jquery.min.js"></script>
  <script src="../Assets/Template/Login/js/popper.js"></script>
  <script src="../Assets/Template/Login/js/bootstrap.min.js"></script>
  <script src="../Assets/Template/Login/js/main.js"></script>

	</body>
</html>


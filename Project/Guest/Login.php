

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="../Assets/Templates/Login/css/style.css">
</head>
<?php
include("../Assets/Connection/Connection.php");
session_start();
if(isset($_POST["btnsubmit"]))
{
	
	$Email=$_POST["txtemail"];
	$Password=$_POST["txtpassword"];
	
	$selUserQry="select * from tbl_user where user_email='".$Email."' and user_password= '".$Password."'";
	//echo $selQry;
	$rowU=$conn->query($selUserQry);
	if($dataU=$rowU->fetch_assoc())
	
	{
		$_SESSION["uid"]=$dataU["user_id"];
		$_SESSION["uname"]=$dataU["user_name"];
		
		header("Location:../User/Homepage.php");
	}
	
	$selAdmin="select * from tbl_admin where admin_email='".$Email."' and admin_password= '".$Password."'";
	
	$rowAdmin=$conn->query($selAdmin);
	if($dataAdmin=$rowAdmin->fetch_assoc())
	
	{
		$_SESSION["adminid"]=$dataAdmin["admin_id"];
		$_SESSION["adminname"]=$dataAdmin["admin_name"];
		header("Location:../Admin/Homepage.php");
	}
}
 ?>

<body>
<body class="img js-fullheight" style="background-color:#fff;">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Login </h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
		      	<h3 class="mb-4 text-center">Have an account?</h3>
		      	<form action="#" class="signin-form" method="post">
		      		<div class="form-group">
		      			<input type="email" class="form-control" placeholder="email"  name="txtemail" required>
		      		</div>
	            <div class="form-group">
	              <input id="password-field" type="password" class="form-control" placeholder="Password" name="txtpassword" required>
	              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
	            </div>
	            <div class="form-group">
	            	<button type="submit" class="form-control btn btn-primary submit px-3" name="btnsubmit">Sign In</button>
	            </div>
	            
	          </form>
	          <p class="w-100 text-center">Don't have an account yet?</p>
	          <div class="social d-flex text-center">
	          	<a href="NewUser.php" class="px-2 py-2 mr-md-1 rounded"><span class="ion-logo-facebook mr-2"></span> Sign Up</a>
	          	
	          </div>
		      </div>
				</div>
			</div>
		</div>
	</section>

	<script src="../Assets/Templates/Login/js/jquery.min.js"></script>
  <script src="../Assets/Templates/Login/js/popper.js"></script>
  <script src="../Assets/Templates/Login/js/bootstrap.min.js"></script>
  <script src="../Assets/Templates/Login/js/main.js"></script>

	</body>
</html>

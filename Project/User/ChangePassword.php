<?php
include("../Assets/Connection/Connection.php");

include("Head.php");


if(isset($_POST["submit"]))
{
	$curpwd=$_POST["cpass"];
	$newpass=$_POST["npass"];
	$repass=$_POST["copass"];
	$sel = "select * from tbl_user where user_id='".$_SESSION["uid"]."' and user_password='".$curpwd."'";
	$row=$conn->query($sel);
	if($data=$row->fetch_assoc())
	{
		if($newpass==$repass)
		{
			$upQry="update tbl_user set user_password='".$newpass."' where user_id='".$_SESSION["uid"]."'";
			if($conn->query($upQry))
			{
				?>
				<script>
				alert('Password Updated');
				location.href='MyProfile.php';
				</script>
				<?php
			}	
		}
		else
		{
			?>
			<script>
			alert('Password Missmatch');
			location.href='ChangePassword.php';
			</script>
			<?php
		}
		
	}
	else
	{
		?>
		<script>
		alert('Password Not Correct');
		location.href='ChangePassword.php';
		</script>
		<?php
	}
	
}

if (isset($_POST["cancel"])) {
    ?>
    <script>
        window.location = "MyProfile.php";
    </script>
    <?php
}


?>

<!DOCTYPE html>
<html lang="en">
<br><br><br><br><br>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container mt-5">
    <form action="" method="post" enctype="multipart/form-data">
     <table class="table  table-bordered table-hover">
         <thead>
          <tr class="table-primary">
            <th scope="col" colspan="2" class="text-center">Change Password</th>
          </tr>
        </thead>
        <tbody>
          
         
          <tr>
            <th scope="row">Current Password</th>
            <td><input type="password" name="cpass" class="form-control"  id="" required
            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 characters"></td>
          </tr>
         
          <tr>
            <th scope="row">New Password</th>
            <td><input type="password" name="npass" class="form-control"  id="" required
            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 characters"></td>
          </tr>
         
          <tr>
            <th scope="row">Conform Password</th>
            <td><input type="password" name="copass" class="form-control"  id="" required
            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 characters" required></td>
          </tr>
          
          <tr>
            <td colspan="2" align="center">
               <input type="submit" name="submit" value="Update" class="btn btn-primary">
               <input type="submit" name="cancel" value="Cancel" class="btn btn-warning">
            </td>
          </tr>
        </tbody>
      </table>
    </form>
  </div>

  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
</body>

</html>

<br><br><br><br><br><br>
<br><br><br><br><br><br>
<?php 
include("Foot.php");
?>

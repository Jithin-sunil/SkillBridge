<?php
ob_start();
include("../Assets/Connection/Connection.php");

if(isset($_POST["submit"]))
{
  $name=$_POST["name"];
  $contact=$_POST["contact"];
  $email=$_POST["email"];
  $location=$_POST["sel_location"];
  $password=$_POST["password"];

  $photo = $_FILES["photo"]["name"];
  $temp = $_FILES["photo"]["tmp_name"];
  move_uploaded_file($temp,"../Assets/Files/UserDocs/".$photo);

  $selQry="select *from tbl_user where user_email='".$email."' ";
  $res=$conn->query($selQry);

  if($res->num_rows > 0)
  {
?>
<script>
    alert('Email Already Exists');
</script>
<?php
  }
  else
  {
      $insqry="insert into tbl_user(user_name,user_contact,user_email,location_id,user_photo,user_password) values('".$name."','".$contact."','".$email."','".$location."','".$photo."','".$password."')";
      if($conn->query($insqry))
      {
          echo "<script>alert('Registration Completed..');
          window.location = 'Login.php'; </script>";
      }
      else
      {
          echo "<script>alert('Failed')</script>";
      }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../Assets/Templates/Login/css/style.css">
    <title>User Registration</title>
    <style>
        .form-group {
            margin-bottom: 15px; /* Increased space between form fields */
        }
        .form-control {
            width: 100%; /* Ensure input fields are full width */
            box-sizing: border-box;
        }
        .form-select {
            width: 100%; /* Increased width for dropdowns */
            box-sizing: border-box;
        }
        .col-md-6, .col-lg-4 {
            margin-bottom: 20px; /* Added margin between columns */
        }
        .login-wrap {
            padding: 30px; /* Increased padding for better spacing */
        }
        .social a {
            margin: 0 5px;
        }
    </style>
</head>

<body class="img js-fullheight" style="background-color:#f7f7f7;">
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">User Registration</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-4">
                        <h3 class="mb-4 text-center">Create your account</h3>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row g-3">
                                <!-- Column 1 -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Name" name="name" required
                                            title="Name Allows Only Alphabets,Spaces and First Letter Must Be Capital Letter" pattern="^[A-Z]+[a-zA-Z ]*$">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Email" name="email" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Contact Number" name="contact" required
                                            pattern="[7-9]{1}[0-9]{9}" title="Phone number with 7-9 and remaining 9 digits with 0-9">
                                    </div>
                                    <div class="form-group">
                                        <select name="sel_district" id="sel_district" class="form-select" onchange="getPlace(this.value)" required>
                                            <option value="">--Select District--</option>
                                            <?php
                                            $selQry = "select * from tbl_district";
                                            $result = $conn->query($selQry);
                                            while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <option value="<?php echo $row["district_id"] ?>">
                                                <?php echo $row["district_name"] ?>
                                            </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Column 2 -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select name="sel_place" id="sel_place" class="form-select" onchange="getlocation(this.value)" required>
                                            <option value="">--Select Place--</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select name="sel_location" id="sel_location" class="form-select" required>
                                            <option value="">--Select Location--</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Password" name="password" required
                                            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 characters">
                                    </div>
                                    <div class="form-group">
                                        <input type="file" class="form-control form-control-lg" name="photo" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group text-center mt-4">
                                <button type="submit" name="submit" class="form-control btn btn-primary submit px-3">Register</button>
                            </div>
                        </form>
                        <p class="w-100 text-center">Already have an account?</p>
                        <div class="social d-flex justify-content-center">
                            <a href="Login.php" class="px-2 py-2 mr-md-1 rounded"><span class="fa fa-sign-in mr-2"></span> Sign In</a>
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

    <script>
        function getPlace(did) {
            $.ajax({
                url: "../Assets/AjaxPages/AjaxPlace.php?did=" + did,
                success: function (result) {
                    $("#sel_place").html(result);
                }
            });
        }

        function getlocation(pid) {
            $.ajax({
                url: "../Assets/AjaxPages/AjaxLocation.php?pid=" + pid,
                success: function (result) {
                    $("#sel_location").html(result);
                }
            });
        }
    </script>
</body>
</html>

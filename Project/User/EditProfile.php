<?php
include("../Assets/Connection/Connection.php");
include("Head.php");

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $contact = $_POST["contact"];
    $photo = $_FILES["photo"]["name"];
    
   
    if ($photo != "") {
        $temp = $_FILES["photo"]["tmp_name"];
        move_uploaded_file($temp, "../Assets/Files/UserDocs/" . $photo);
    } else {
        
        $photo = $_POST["existing_photo"];
    }

    $upQry = "UPDATE tbl_user SET user_name='" . $name . "', user_photo='" . $photo . "', user_contact='" . $contact . "', user_email='" . $email . "' WHERE user_id='" . $_SESSION["uid"] . "'";
    
    if ($conn->query($upQry)) {
        ?>
        <script>
            alert('Data Updated');
            window.location = 'MyProfile.php';
        </script>
        <?php
    } else {
        ?>
        <script>
            alert('Failed');
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

$sel = "SELECT * FROM tbl_user WHERE user_id='" . $_SESSION["uid"] . "'";
$row = $conn->query($sel);
$user = $row->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<br><br><br>
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
            <th scope="col" colspan="2" class="text-center">My Profile</th>
          </tr>
        </thead>
        <tbody>
          <!-- Profile Picture -->
          <tr>
            <th scope="row" class="text-center" colspan="2">
              <img src="../Assets/Files/UserDocs/<?php echo $user['user_photo'] ?>" alt="Profile Picture" class="img-fluid rounded-circle mb-3" style="width: 150px;">
            </th>
          </tr>
          <!-- File Input for New Photo -->
          <tr>
            <th scope="row">Upload New Photo</th>
            <td>
              <input type="file" name="photo" class="form-control" accept="image/*">
              
              <input type="hidden" name="existing_photo" value="<?php echo $user['user_photo']; ?>">
            </td>
          </tr>
          <!-- Name -->
          <tr>
            <th scope="row">Name</th>
            <td><input type="text" name="name" class="form-control" value="<?php echo $user['user_name'] ?>" required
            title="Name Allows Only Alphabets,Spaces and First Letter Must Be Capital Letter" pattern="^[A-Z]+[a-zA-Z ]*$" id=""></td>
          </tr>
          <!-- Email -->
          <tr>
            <th scope="row">Email</th>
            <td><input type="email" name="email" class="form-control" value="<?php echo $user['user_email'] ?>" id=""></td>
          </tr>
          <!-- Phone -->
          <tr>
            <th scope="row">Phone</th>
            <td><input type="text" name="contact" class="form-control" value="<?php echo $user['user_contact'] ?>" required
            pattern="[7-9]{1}[0-9]{9}" title="Phone number with 7-9 and remaining 9 digits with 0-9" id=""></td>
          </tr>
          <!-- Submit and Cancel Buttons -->
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

<br><br><br><br><br><br>

</html>
<?php 
include("Foot.php");
?>

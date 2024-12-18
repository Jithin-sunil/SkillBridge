<?php
include("../Assets/Connection/Connection.php");
include("Head.php");
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
    <div class="table table-responsive">
      <table class="table  table-bordered table-hover">
        <thead>
          <tr class="table-primary">
            <th scope="col" colspan="2" class="text-center">My Profile</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row" class="text-center" colspan="2">
              <img src="../Assets/Files/UserDocs/<?php echo $user['user_photo'] ?>" alt="Profile Picture"
                class="img-fluid rounded-circle mb-3" style="width: 150px;">
            </th>
          </tr>
          <tr>
            <th scope="row">Name</th>
            <td>
              <?php echo $user['user_name'] ?>
            </td>
          </tr>
          <tr>
            <th scope="row">Email</th>
            <td>
              <?php echo $user['user_email'] ?>
            </td>
          </tr>
          <tr>
            <th scope="row">Phone</th>
            <td>
              <?php echo $user['user_contact'] ?>
            </td>
          </tr>
          <tr>
            <td colspan="2" align="center">
              <a href="EditProfile.php" class="btn btn-primary">EditProfile</a>
              <a href="ChangePassword.php" class="btn btn-success">ChangePassword</a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
<br><br><br><br><br><br>
</html>
<?php 
include("Foot.php");
?>
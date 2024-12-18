<?php
ob_start();
include("Head.php");

include("../Assets/Connection/Connection.php");


if(isset($_GET['uid']))
{
	
	
    $insQry="update tbl_user set user_status='".$_GET['sts']."' where user_id='".$_GET["uid"]."'";
    	if($conn->query($insQry))
	{
		?>
  <script>
    alert("User Removed");
    window.location="UserList.php";
  </script>
  <?php
	}
    else
    {
    	?>
  <script>
    alert("Data Insertion Failed");
  </script>
  <?php
    
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
    <title>User List</title>
</head>

<body>
    <div class="container">
       <table class="table  table-bordered table-hover">
             <thead>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th>District</th>
                <th>Place</th>
                <th>Location</th>
                <th>Photo</th>
                <th>Action</th>
            </thead>
            <?php
            $i=0;
            $selQry="select * from tbl_user u inner join tbl_location l on u.location_id=l.location_id inner join  tbl_place p on l.place_id=p.place_id inner join tbl_district d on p.district_id = d.district_id";
            $result=$conn->query($selQry);
            while($row=$result->fetch_assoc())
            {
                $i++;		
            ?>
            <tbody>
                <td>
                    <?php echo $i ?>
                </td>
                <td>
                    <?php echo $row['user_name'] ?>
                </td>
                <td>
                    <?php echo $row['user_email'] ?>
                </td>
                <td>
                    <?php echo $row['user_contact'] ?>
                </td>
                <td>
                    <?php echo $row['district_name'] ?>
                </td>
                <td>
                    <?php echo $row['place_name'] ?>
                </td>
                <td>
                    <?php echo $row['location_name'] ?>
                </td>
                <td><img src="../Assets/Files/UserDocs/<?php echo $row['user_photo'] ?>" class="img-fluid img-thumbnail"
                        alt=""></td>
                <td><?php 
                if($row['user_status'] == 1)
                {
                    ?>
                    <a href="UserList.php?uid=<?php echo $row['user_id']?>&sts=0" class="btn btn-danger ">Remove</a>
                    <?php
                }
                else
                {
                    ?>
                    <a href="UserList.php?uid=<?php echo $row['user_id']?>&sts=1" class="btn btn-success ">Active</a>
                    <?php
                }
                ?></td>

            </tbody>
            <?php
            }
            ?>
        </table>
    </div>
</body>

</html>
<?php
include("Foot.php");    
?>
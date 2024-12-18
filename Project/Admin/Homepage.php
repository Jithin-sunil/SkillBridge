<?php   
include("Head.php");


include("../Assets/Connection/Connection.php");

if(isset($_GET['uid']))
{
    $insQry="update tbl_user set user_status='".$_GET['sts']."' where user_id='".$_GET["uid"]."'";
    if($conn->query($insQry))
    {
        ?>
        <script>
            alert("User Status Updated");
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
   
    <style>
        .table-responsive {
            max-height: 500px;
            overflow-y: auto;
        }
        .table th, .table td {
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">User List</h6>
                <a href="UserList.php">Show All</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col"><input class="form-check-input" type="checkbox"></th>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Contact</th>
                            <th scope="col">District</th>
                            <th scope="col">Place</th>
                            <th scope="col">Location</th>
                            <th scope="col">Photo</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $selQry = "SELECT * FROM tbl_user u 
                                   INNER JOIN tbl_location l ON u.location_id = l.location_id 
                                   INNER JOIN tbl_place p ON l.place_id = p.place_id 
                                   INNER JOIN tbl_district d ON p.district_id = d.district_id LIMIT 5";
                        $result = $conn->query($selQry);
                        while($row = $result->fetch_assoc()) {
                            $i++;
                        ?>
                        <tr>
                            <td><input class="form-check-input" type="checkbox"></td>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row['user_name']; ?></td>
                            <td><?php echo $row['user_email']; ?></td>
                            <td><?php echo $row['user_contact']; ?></td>
                            <td><?php echo $row['district_name']; ?></td>
                            <td><?php echo $row['place_name']; ?></td>
                            <td><?php echo $row['location_name']; ?></td>
                            <td><img src="../Assets/Files/UserDocs/<?php echo $row['user_photo']; ?>" class="img-fluid img-thumbnail" alt=""></td>
                            <td>
                                <?php 
                                if($row['user_status'] == 1) {
                                    ?>
                                    <a href="UserList.php?uid=<?php echo $row['user_id']; ?>&sts=0" class="btn btn-danger btn-sm">Remove</a>
                                    <?php
                                } else {
                                    ?>
                                    <a href="UserList.php?uid=<?php echo $row['user_id']; ?>&sts=1" class="btn btn-success btn-sm">Activate</a>
                                    <?php
                                }
                                ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>



            <!-- Widgets Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 bg-light rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Calender</h6>
                                <a href="">Show All</a>
                            </div>
                            <div id="calender"></div>
                        </div>
                    </div>
                   
                </div>
            </div>
            <!-- Widgets End -->

<?php 
include('Foot.php');
?>
           
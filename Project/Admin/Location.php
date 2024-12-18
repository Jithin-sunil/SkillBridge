<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<?php
ob_start();
include("Head.php");

include("../Assets/Connection/Connection.php");
if(isset($_POST["submit"]))
{
	$location=$_POST["txt_location"];
	$Place=$_POST["sel_place"];
	
	$insQry="insert into tbl_location(place_id,location_name)values('".$Place."','".$location."')";
	if($conn->query($insQry))
	{
		?>
<script>
    alert("Data Inserted");
    window.location = "Location.php";
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
if(isset($_GET["did"]))
{
	$del="delete from tbl_location where location_id='".$_GET["did"]."'";
	if($conn->query($del))
    {
        ?>
<script>
    alert("Data Deleted");
    window.location = "Location.php";
</script>
<?php
    }
	
}

?>

<body>

    <div class="container">
        <form action="" method="post">
            <div class="form">
                <table class="table  table-bordered table-hover">
                    <tr>
                        <td>District</td>
                        <td><select name="sel_district" id="sel_district" onchange="getPlace(this.value)"
                                class="form-select" aria-label="Default select example">
                                <option value="">--Select--</option>
                                <?php
                            $selQry="select * from tbl_district";
                            $result=$conn->query($selQry);
                            while($row=$result->fetch_assoc())
                            {
                                ?>
                                <option value="<?php echo $row["district_id"]?>">
                                    <?php echo $row["district_name"]?>
                                </option>
                                <?php
                                }
                                ?>
                            </select></td>
                    </tr>
                    <tr>
                        <td>Place</td>
                        <td><select name="sel_place" id="sel_place" class="form-select"
                                aria-label="Default select example">
                                <option value="">--Select--</option>

                            </select></td>
                    </tr>
                    <tr>
                        <td>Location</td>
                        <td><input type="text" class="form-control"
                                title="Name Allows Only Alphabets,Spaces and First Letter Must Be Capital Letter"
                                pattern="^[A-Z]+[a-zA-Z ]*$" required autocomplete="off" name="txt_location" id="">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><input type="submit" name="submit" class="btn btn-primary"
                                value="Submit"></td>

                    </tr>
                </table>
            </div>
        </form>
        <table class="table  table-bordered table-hover">
             <thead>
                <th>#</th>
                <th>District</th>
                <th>Place</th>
                <th>Location </th>
                <th>Action</th>
            </thead>
            <?php
            $i=0;
            $selQry="select * from tbl_location l inner join  tbl_place p on l.place_id=p.place_id inner join tbl_district d on p.district_id = d.district_id";
            $result=$conn->query($selQry);
            while($row=$result->fetch_assoc())
            {
                $i++;		
            ?>
            <tbody>
                <td>
                    <?php echo $i?>
                </td>
                <td>
                    <?php echo $row["district_name"]?>
                </td>
                <td>
                    <?php echo $row["place_name"]?>
                </td>
                <td>
                    <?php echo $row["location_name"]?>
                </td>
                <td><a href="Location.php?did=<?php echo $row["location_id"]?>" class="btn btn-danger">Delete</a></td>
            </tbody>
            <?php
        }
        ?>

        </table>
    </div>

</body>

</html>
<script src="../Assets/JQ/jQuery.js"></script>
<script>
    function getPlace(did) {

        $.ajax({
            url: "../Assets/AjaxPages/AjaxPlace.php?did=" + did,
            success: function (result) {

                $("#sel_place").html(result);
            }
        });
    }

</script>
<?php
include("Foot.php")
?>
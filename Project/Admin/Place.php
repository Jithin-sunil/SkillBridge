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
	$District=$_POST["sel_district"];
	$Place=$_POST["txt_place"];
	
	$insQry="insert into tbl_place(district_id,place_name)values('".$District."','".$Place."')";
	if($conn->query($insQry))
	{
		?>
  <script>
    alert("Data Inserted");
    window.location="Place.php";
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
	$del="delete from tbl_place where place_id='".$_GET["did"]."'";
	if($conn->query($del))
    {
        ?>
        <script>
            alert("Data Deleted");
            window.location="Place.php";
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
                        <td><select name="sel_district" id="" class="form-select" aria-label="Default select example">
                            <option value="">--Select--</option>
                            <?php
                            $selQry="select * from tbl_district";
                            $result=$conn->query($selQry);
                            while($row=$result->fetch_assoc())
                            {
                                ?>
                                <option value="<?php echo $row["district_id"]?>"><?php echo $row["district_name"]?></option>
                                <?php
                                }
                                ?>
                        </select></td>
                    </tr>
                    <tr>
                        <td>Place</td>
                        <td><input type="text" class="form-control"
                                title="Name Allows Only Alphabets,Spaces and First Letter Must Be Capital Letter"
                                pattern="^[A-Z]+[a-zA-Z ]*$" required autocomplete="off" name="txt_place" id="">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><input type="submit" name="submit"  class="btn btn-primary"
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
                <th>Action</th>
            </thead>
            <?php
            $i=0;
            $selQry="select * from tbl_place p inner join tbl_district d on p.district_id = d.district_id";
            $result=$conn->query($selQry);
            while($row=$result->fetch_assoc())
            {
                $i++;		
            ?>
            <tbody>
                <td> <?php echo $i?></td>
                <td>  <?php echo $row["district_name"]?></td>
                <td>  <?php echo $row["place_name"]?></td>
                <td><a href="Place.php?did=<?php echo $row["place_id"]?>" class="btn btn-danger">Delete</a></td>
            </tbody>
            <?php
        }
        ?>

        </table>
    </div>

</body>

</html>
<?php
include("Foot.php")
?>
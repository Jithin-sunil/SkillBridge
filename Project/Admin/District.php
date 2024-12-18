<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>District</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<?php
ob_start();
include("Head.php");

include("../Assets/Connection/Connection.php");
if(isset($_POST["submit"]))
{
	$District=$_POST["txt_district"];
	
	$insQry="insert into tbl_district(district_name)values('".$District."')";
	if($conn->query($insQry))
	{
		?>
  <script>
    alert("Data Inserted");
    window.location="District.php";
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
	$del="delete from tbl_district where district_id='".$_GET["did"]."'";
	if($conn->query($del))
    {
        ?>
        <script>
            alert("Data Deleted");
            window.location="District.php";
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
                        <td><input type="text" class="form-control"
                                title="Name Allows Only Alphabets,Spaces and First Letter Must Be Capital Letter"
                                pattern="^[A-Z]+[a-zA-Z ]*$" required autocomplete="off" name="txt_district" id="">
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
                <th>Action</th>
            </thead>
            <?php
            $i=0;
            $selQry="select * from tbl_district";
            $result=$conn->query($selQry);
            while($row=$result->fetch_assoc())
            {
                $i++;		
            ?>
            <tbody>
                <td> <?php echo $i?></td>
                <td>  <?php echo $row["district_name"]?></td>
                <td><a href="District.php?did=<?php echo $row["district_id"]?>" class="btn btn-danger">Delete</a></td>
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
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
	$category=$_POST["sel_category"];
	$skill=$_POST["txt_skill"];
	
	$insQry="insert into tbl_skill(category_id,skill_name)values('".$category."','".$skill."')";
	if($conn->query($insQry))
	{
		?>
  <script>
    alert("Data Inserted");
    window.location="Skill.php";
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
	$del="delete from tbl_skill where skill_id='".$_GET["did"]."'";
	if($conn->query($del))
    {
        ?>
        <script>
            alert("Data Deleted");
            window.location="Skill.php";
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
                        <td>Category</td>
                        <td><select name="sel_category" id="" class="form-select" aria-label="Default select example">
                            <option value="">--Select--</option>
                            <?php
                            $selQry="select * from tbl_category";
                            $result=$conn->query($selQry);
                            while($row=$result->fetch_assoc())
                            {
                                ?>
                                <option value="<?php echo $row["category_id"]?>"><?php echo $row["category_name"]?></option>
                                <?php
                                }
                                ?>
                        </select></td>
                    </tr>
                    <tr>
                        <td>Skill</td>
                        <td><input type="text" class="form-control"
                                title="Name Allows Only Alphabets,Spaces and First Letter Must Be Capital Letter"
                                pattern="^[A-Z]+[a-zA-Z ]*$" required autocomplete="off" name="txt_skill" id="">
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
                <th>Category</th>
                <th>Skill</th>
                <th>Action</th>
            </thead>
            <?php
            $i=0;
            $selQry="select * from tbl_skill p inner join tbl_category d on p.category_id = d.category_id";
            $result=$conn->query($selQry);
            while($row=$result->fetch_assoc())
            {
                $i++;		
            ?>
            <tbody>
                <td> <?php echo $i?></td>
                <td>  <?php echo $row["category_name"]?></td>
                <td>  <?php echo $row["skill_name"]?></td>
                <td><a href="Skill.php?did=<?php echo $row["skill_id"]?>" class="btn btn-danger">Delete</a></td>
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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skill Bridge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<br><br><br>
<?php
ob_start();
include("Head.php");
include("../Assets/Connection/Connection.php");
if(isset($_POST["submit"]))
{
    
	$skill=$_POST["sel_skill"];
	
	$insQry="insert into tbl_userskills(skill_id,user_id)values('".$skill."','".$_SESSION['uid']."')";
	if($conn->query($insQry))
	{
		?>
<script>
    alert("Data Inserted");
    window.location = "MySkills.php";
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
	$del="delete from tbl_userskills where userskill_id='".$_GET["did"]."'";
	if($conn->query($del))
    {
        ?>
<script>
    alert("Data Deleted");
    window.location = "MySkills.php";
</script>
<?php
    }
	
}

?>
<!-- <style>
  td a, th a {
  color:#ffffff; /* replace with desired color */
}
</style> -->
<body>

    <div class="container mt-5 pt-5">
        <form action="" method="post">
            <div class="form">
                <table class="table  table-bordered table-hover">
                    <tr>
                        <td>Category</td>
                        <td><select name="sel_category" id="sel_category" onchange="getskill(this.value)"
                                class="form-select" aria-label="Default select example">
                                <option value="">--Select--</option>
                                <?php
                            $selQry="select * from tbl_category";
                            $result=$conn->query($selQry);
                            while($row=$result->fetch_assoc())
                            {
                                ?>
                                <option value="<?php echo $row["category_id"]?>">
                                    <?php echo $row["category_name"]?>
                                </option>
                                <?php
                                }
                                ?>
                            </select></td>
                    </tr>
                    <tr>
                        <td>Skill</td>
                        <td><select name="sel_skill" id="sel_skill" class="form-select"
                                aria-label="Default select example">
                                <option value="">--Select--</option>

                            </select></td>
                    </tr>
                    
                    <tr>
                        <td colspan="2" align="center"><input type="submit" name="submit" class="btn btn-primary"
                                value="Submit"></td>

                    </tr>
                </table>
            </div>
        </form>
        <div class="table-responsive">
        <table class="table  table-bordered table-hover">
             <thead>
                <th>#</th>
                <th>Category</th>
                <th>Skill</th>
                
                <th>Action</th>
            </thead>
            <?php
            $i=0;
            $selQry="select * from tbl_userskills l inner join  tbl_skill p on l.skill_id=p.skill_id inner join tbl_category d on p.category_id = d.category_id where user_id=".$_SESSION['uid'];
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
                    <?php echo $row["category_name"]?>
                </td>
                <td>
                    <?php echo $row["skill_name"]?>
                </td>
                
                <td><a href="MySkills.php?did=<?php echo $row["userskill_id"]?>" class="btn btn-danger">Delete</a></td>
            </tbody>
            <?php
        }
        ?>

        </table>
    </div>  
    </div>

</body>

<br><br><br><br><br><br>
<br><br><br><br><br><br>
</html>
<script src="../Assets/JQ/jQuery.js"></script>
<script>
    function getskill(did) {

        $.ajax({
            url: "../Assets/AjaxPages/AjaxSkill.php?did=" + did,
            success: function (result) {

                $("#sel_skill").html(result);
            }
        });
    }

</script>
<?php 
include("Foot.php");
?>

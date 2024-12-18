<?php
ob_start();

include("Head.php");
include("../Assets/Connection/Connection.php");
if(isset($_POST["txtsub"]))
{
	
	$title=$_POST["title"];
	$content=$_POST["content"];
	$insQry="insert into tbl_complaint(complaint_title,complaint_content,user_id,complaint_date)values('".$title."','".$content."','".$_SESSION["uid"]."',curdate())";
	
	if($conn->query($insQry))
	{
		?>
        <script>
		alert("Data Inserted");
		window.location="Complaint.php";
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
	$del="delete from tbl_complaint where complaint_id='".$_GET["did"]."'";
	if($conn->query($del))
    {
        ?>
        <script>
            alert("Data Deleted");
            window.location="Complaint.php";
        </script>
        <?php
    }
	
}


?>

<!DOCTYPE html>
<html lang="en">
<br><br><br>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Complaint</title>
</head>

<body>
    <div class="container mt-5 pt-5">
        <h2 class="text-center mb-4"> Complaint</h2>
        <form action="" method="POST">
           <table class="table  table-bordered table-hover">
                <tr>
                    <td colspan="2">
                        <label for="content" class="form-label">Title</label>
                       <input type="text" name="title" class="form-control" id="">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" name="content" id="content" rows="3" required></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center">
                        <input class="btn btn-primary" type="submit" value="Submit">
                    </td>
                </tr>
            </table>
        </form>
        <table class="table  table-bordered table-hover">
             <thead>
                <th>#</th>
                <th>Title</th>
                <th>Content</th>
                <th>Reply</th>
                <th>Action</th>
            </thead>
            <?php
            $i=0;
            $selQry="select * from tbl_complaint where user_id=".$_SESSION['uid'];
            $result=$conn->query($selQry);
            while($row=$result->fetch_assoc())
            {
                $i++;		
            ?>
            <tbody>
                <td> <?php echo $i?></td>
                <td>  <?php echo $row["complaint_title"]?></td>
                <td>  <?php echo $row["complaint_content"]?></td>
                <td><?php if($row['complaint_status']==1)
                {
                    echo $row['complaint_reply'];
                } 
                else
                {
                    echo "Not Replied";
                }
                ?> </td>
                <td><a href="Complaint.php?did=<?php echo $row["complaint_id"]?>" class="btn btn-danger">Delete</a></td>
            </tbody>
            <?php
        }
        ?>

        </table>
    </div>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0A9A1+bhYXOXwUOAm68O3p8fsn8Qct5K2CkGb9eFka8kQ9oF" crossorigin="anonymous"></script> -->
</body>
<br><br><br>
</html>
<?php 
include("Foot.php");
?>

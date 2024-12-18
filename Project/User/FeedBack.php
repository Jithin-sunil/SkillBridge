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

$selQry = "SELECT * FROM tbl_feedback f INNER JOIN tbl_user u ON f.user_id = u.user_id";
$result = $conn->query($selQry);
$row = $result->fetch_assoc()
?>

<!DOCTYPE html>
<html lang="en">
<br><br><br>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Complaint</title>
</head>
<br><br>
<body >
    <div class="container mt-5">
        <h2 class="text-center mb-4 text-white">Feedbacks</h2>
        <form action="" method="POST">
           <table class="table  table-bordered table-hover">
                <tr>
                    <td colspan="2">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" name="content" id="content" rows="3" required></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center">
                        <input class="btn btn-primary" type="submit" value="Submit" name="txtsub">
                    </td>
                </tr>
            </table>
        </form>

       <table class="table  table-bordered table-hover">
             <thead>
                <th>#</th>
                <th>User</th>
                <th>Content</th>
                <th>Date</th>
                <?php
               $sel = "SELECT * FROM tbl_feedback  where user_id =".$_SESSION['uid'];
               $result = $conn->query($sel);
                if ($res=$result->fetch_assoc()) {
                    echo '<th>Action</th>';
                }
                ?>
            </thead>

            <?php
            $i = 0;
            while ($row) {
                $i++;
                ?>
                <tbody>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php 
                        if ($_SESSION['uid'] == $row['user_id'])
                        {
                            echo "My Feedback";
                        }
                        else
                        {
                            echo $row["user_name"];
                        }
                        ?></td>
                        <td><?php echo $row["feedback_content"] ?></td>
                        <td><?php echo $row["feedback_date"] ?></td>

                        <?php
                       
                        if ($_SESSION['uid'] == $row['user_id']) {
                            ?>
                            <td>
                                <a href="feedback.php?did=<?php echo $row["feedback_id"] ?>" class="btn btn-danger">Delete</a>
                            </td>
                            <?php
                        }
                        ?>
                    </tr>
                </tbody>
                <?php
            }
            ?>
        </table>
    </div>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0A9A1+bhYXOXwUOAm68O3p8fsn8Qct5K2CkGb9eFka8kQ9oF" crossorigin="anonymous"></script> -->
</body>

<br><br><br><br><br><br>
<br><br><br><br><br><br>
</html>
<?php 
include("Foot.php");
?>

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
	$reply=$_POST["reply"];
	
    $insQry="update tbl_complaint set complaint_reply='".$reply."',complaint_status=1 where complaint_id='".$_GET["did"]."'";
    	if($conn->query($insQry))
	{
		?>
  <script>
    alert("Data Inserted");
    window.location="ViewComplaints.php";
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
<body>

    <div class="container">
        <form action="" method="post">
            <div class="form">
                <table class="table  table-bordered table-hover">
                    <tr>
                        <td>Reply</td>
                        <td colspan="2">
                        
                        <textarea class="form-control" name="reply" id="reply" rows="3" required></textarea>
                    </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><input type="submit" name="submit"  class="btn btn-primary"
                                value="Submit"></td>

                    </tr>
                </table>
            </div>
        </form>
        

      
    </div>

</body>

</html>
<?php
include("Foot.php")
?>
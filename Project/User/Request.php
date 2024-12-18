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
	$message = $_POST["txt_mesage"];
    $insQry="insert into tbl_request (request_message,request_date,user_id,userskill_id) values ('".$message."',curdate(),'".$_SESSION['uid']."','".$_GET['usid']."')";
    if($conn->query($insQry))
    {
        echo "<script>alert('Request Sent Successfully');window.location='MyRequest.php'</script>";
    }
	  
}


?>
<body>

    <div class="container mt-5">
        <form action="" method="post">
            <div class="form">
                <table class="table  table-bordered table-hover">
                    <tr>
                        <td>Message</td>
                        <td colspan="2">
                        
                        <textarea class="form-control" name="txt_mesage" id="txt_mesage" rows="3" required></textarea>
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
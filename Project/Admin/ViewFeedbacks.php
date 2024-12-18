<?php
ob_start();
include("Head.php");

include("../Assets/Connection/Connection.php");



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Complaint</title>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">FeedBacks</h2>
        
        <table class="table  table-bordered table-hover">
             <thead>
            <th>#</th>
                <th>User Name</th>
                <th>User Email</th>
                <th>Content</th>
                <th>Date</th>
               
            </thead>
            <?php
            $i=0;
            $selQry="select * from tbl_feedback c inner join tbl_user u on c.user_id=u.user_id ";
            $result=$conn->query($selQry);
            while($row=$result->fetch_assoc())
            {
                $i++;		
            ?>
            <tbody>
                <td> <?php echo $i?></td>
                <td><?php echo $row['user_name']?></td>
                <td><?php echo $row['user_email']?></td>
                
                <td>  <?php echo $row["feedback_content"]?></td>
                <td>  <?php echo $row["feedback_date"]?></td>
                
                
            </tbody>
            <?php
        }
        ?>

        </table>

        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0A9A1+bhYXOXwUOAm68O3p8fsn8Qct5K2CkGb9eFka8kQ9oF" crossorigin="anonymous"></script>
</body>

</html>
<?php
include("Foot.php")
?>
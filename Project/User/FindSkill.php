<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head> -->

<?php
ob_start();
include("Head.php");
include("../Assets/Connection/Connection.php");
?>
<br><br><br>
<body>

    <div class="container mt-5">
        <form action="" method="post">
            <div class="form-group">
                <table class="table  table-bordered table-hover">
                    <tr>
                        <td colspan="2"><label for="sel_category">Category:</label>
                            <select name="sel_category" id="sel_category" onchange="getskill(this.value)" class="form-select">
                                <option value="">--Select--</option>
                                <?php
                                $selQry = "SELECT * FROM tbl_category";
                                $result = $conn->query($selQry);
                                while ($row = $result->fetch_assoc()) {
                                ?>
                                    <option value="<?php echo $row["category_id"] ?>">
                                        <?php echo $row["category_name"] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </td>

                        <td><label for="sel_skill">Skill:</label>
                            <select name="sel_skill" id="sel_skill" class="form-select">
                                <option value="">--Select--</option>
                            </select>
                        </td>
                       
                    </tr>

                    <tr>
                        <td><label for="sel_district">District:</label>
                            <select name="sel_district" id="sel_district" onchange="getPlace(this.value)" class="form-select">
                                <option value="">--Select--</option>
                                <?php
                                $selQry = "SELECT * FROM tbl_district";
                                $result = $conn->query($selQry);
                                while ($row = $result->fetch_assoc()) {
                                ?>
                                    <option value="<?php echo $row["district_id"] ?>">
                                        <?php echo $row["district_name"] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </td>

                        <td><label for="sel_place">Place:</label>
                            <select name="sel_place" id="sel_place" onchange="getlocation(this.value)" class="form-select">
                                <option value="">--Select--</option>
                            </select>
                        </td>

                        <td><label for="sel_location">Location:</label>
                            <select name="sel_location" id="sel_location" class="form-select">
                                <option value="">--Select--</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="3" class="text-center">
                            <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                        </td>
                    </tr>
                </table>
            </div>
        </form>

        <!-- Table to display results -->
        <div class="table-responsive">
           <table class="table  table-bordered table-hover">
                 <thead>
                    <tr>
                        <th>#</th>
                        <th>User Photo</th>
                        <th>User Name</th>
                        <th>User Email</th>
                        <th>Category</th>
                        <th>Skill</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_POST["submit"])) {
                        $i = 0;
                        $selQry = "SELECT * FROM tbl_userskills l 
                                   INNER JOIN tbl_skill p ON l.skill_id = p.skill_id 
                                   INNER JOIN tbl_category d ON p.category_id = d.category_id 
                                   INNER JOIN tbl_user u ON u.user_id = l.user_id 
                                   WHERE l.skill_id = '" . $_POST['sel_skill'] . "'and  l.user_id != '".$_SESSION['uid']."'  or u.location_id = '" . $_POST['sel_location'] . "' and  l.user_id != '".$_SESSION['uid']."'";
                        $result = $conn->query($selQry);
                        while ($row = $result->fetch_assoc()) {
                            $i++;
                    ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><img src="../Assets/Files/UserDocs/<?php echo $row["user_photo"] ?>" class="img-thumbnail rounded w-50" alt="..."></td>
                                <td><?php echo $row["user_name"] ?></td>
                                <td><?php echo $row['user_email'] ?></td>
                                <td><?php echo $row["category_name"] ?></td>
                                <td><?php echo $row["skill_name"] ?></td>
                                <td>
                                    <a href="Chat.php?id=<?php echo $row["user_id"] ?>" class="btn btn-danger">Chat</a>
                                    <a href="Request.php?usid=<?php echo $row["userskill_id"] ?>" class="btn btn-danger">Request</a>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="../Assets/JQ/jQuery.js"></script>
    <script>
        function getskill(did) {
            $.ajax({
                url: "../Assets/AjaxPages/AjaxSkill.php?did=" + did,
                success: function(result) {
                    $("#sel_skill").html(result);
                }
            });
        }

        function getPlace(did) {
            $.ajax({
                url: "../Assets/AjaxPages/AjaxPlace.php?did=" + did,
                success: function(result) {
                    $("#sel_place").html(result);
                }
            });
        }

        function getlocation(pid) {
            $.ajax({
                url: "../Assets/AjaxPages/AjaxLocation.php?pid=" + pid,
                success: function(result) {
                    $("#sel_location").html(result);
                }
            });
        }
    </script>
</body>

<br><br><br><br><br><br>
<br><br><br><br><br><br>
</html>
<?php 
include("Foot.php");
?>

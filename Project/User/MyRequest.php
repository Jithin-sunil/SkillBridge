<?php
include("../Assets/Connection/Connection.php");
include("Head.php");

if (isset($_GET["aid"])) {
    $updQry = "update tbl_request set request_status=1 where request_id=" . $_GET['aid'];
    if ($conn->query($updQry)) {
        ?>
        <script>
            alert("Request Marked as Verified");
            window.location = "MyRequest.php";
        </script>
        <?php
    }
}
if (isset($_GET["rid"])) {
    $updQry = "update tbl_request set request_status=2 where request_id=" . $_GET['rid'];
    if ($conn->query($updQry)) {
        ?>
        <script>
            alert("Request Marked as Rejected");
            window.location = "MyRequest.php";
        </script>
        <?php
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyRequest</title>
</head>
<br><br><br><br>

<body>
    <div class="container mt-5">
        <h3>Sent Requests</h3>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Receiver Name</th>
                        <th>Contact</th>
                        <th>Skill</th>
                        <th>Message</th>
                        <th>Request Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    $userId = $_SESSION['uid'];

                    // Query to fetch sent requests
                    $sentQuery = "SELECT r.*, 
                                      receiver.user_name AS receiver_name, 
                                      receiver.user_contact, 
                                      s.skill_name 
                                  FROM tbl_request r 
                                  INNER JOIN tbl_userskills u ON r.userskill_id = u.userskill_id 
                                  INNER JOIN tbl_skill s on u.skill_id=s.skill_id
                                  INNER JOIN tbl_user receiver ON u.user_id = receiver.user_id 
                                  WHERE r.user_id = '$userId'";

                    $sentResult = $conn->query($sentQuery);

                    if ($sentResult->num_rows > 0) {
                        while ($row = $sentResult->fetch_assoc()) {
                            $i++;
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $row['receiver_name']; ?></td>
                                <td><?php echo $row['user_contact']; ?></td>
                                <td><?php echo $row['skill_name']; ?></td>
                                <td><?php echo $row['request_message']; ?></td>
                                <td><?php echo $row['request_date']; ?></td>
                                <td>
                                    <?php
                                    if ($row['request_status'] == 1) {
                                        echo "<span style='color: green;'>Accepted</span>";

                                        ?>
                                        <a href="Chat.php?id=<?php echo $row["user_id"] ?>" class="btn btn-danger">Chat</a>
                                        <?php


                                    } elseif ($row['request_status'] == 2) {
                                        echo "<span style='color: red;'>Rejected</span>";
                                    } else {
                                        echo "<span style='color: orange;'>Pending</span>";
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo "<tr><td colspan='7' style='text-align:center;'>No Sent Requests Found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <h3>Received Requests</h3>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Sender Name</th>
                        <th>Contact</th>
                        <th>Skill</th>
                        <th>Message</th>
                        <th>Request Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $j = 0;

                    // Query to fetch received requests
                    $receivedQuery = "SELECT r.*, 
                                          sender.user_name AS sender_name, 
                                          sender.user_contact, 
                                          s.skill_name 
                                      FROM tbl_request r 
                                      INNER JOIN tbl_userskills u ON r.userskill_id = u.userskill_id 
                                  INNER JOIN tbl_skill s on u.skill_id=s.skill_id

                                      INNER JOIN tbl_user sender ON r.user_id = sender.user_id 
                                      WHERE u.user_id = '$userId'";

                    $receivedResult = $conn->query($receivedQuery);

                    if ($receivedResult->num_rows > 0) {
                        while ($row = $receivedResult->fetch_assoc()) {
                            $j++;
                            ?>
                            <tr>
                                <td><?php echo $j; ?></td>
                                <td><?php echo $row['sender_name']; ?></td>
                                <td><?php echo $row['user_contact']; ?></td>
                                <td><?php echo $row['skill_name']; ?></td>
                                <td><?php echo $row['request_message']; ?></td>
                                <td><?php echo $row['request_date']; ?></td>
                                <td>
                                    <?php
                                    if ($row['request_status'] == 1) {
                                        echo "<span style='color: green;'>Accepted</span>";
                                    } elseif ($row['request_status'] == 2) {
                                        echo "<span style='color: red;'>Rejected</span>";
                                    } else {
                                        echo "<span style='color: orange;'>Pending</span>";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($row['request_status'] == 0) {
                                        // Show Accept and Reject buttons for the receiver
                                        ?>
                                        <a href="HandleRequest.php?aid=<?php echo $row['request_id']; ?>"
                                            class="btn btn-success btn-sm">Accept</a>
                                        <a href="HandleRequest.php?rid=<?php echo $row['request_id']; ?>"
                                            class="btn btn-danger btn-sm">Reject</a>
                                        <?php
                                    } else if ($row['request_status'] == 1) {
                                        ?>
                                            <a href="Chat.php?id=<?php echo $row["user_id"] ?>" class="btn btn-danger">Chat</a>
                                        <?php

                                    } else {
                                        echo "No Action";
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo "<tr><td colspan='8' style='text-align:center;'>No Received Requests Found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
<br><br><br><br><br>

</html>
<?php
include("Foot.php");
?>
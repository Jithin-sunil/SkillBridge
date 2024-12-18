<?php
include("../Assets/Connection/Connection.php");
include("SessionValidation.php");

$selQry = "SELECT c.chat_content, c.chat_datetime, u1.user_name AS from_username, u2.user_name AS to_username, 
u1.user_photo AS from_userphoto, u2.user_photo AS to_userphoto, u1.user_id AS from_uid, u2.user_id AS to_uid
FROM tbl_chat c
INNER JOIN tbl_user u1 ON (c.chat_fromuid = u1.user_id)
INNER JOIN tbl_user u2 ON (c.chat_touid = u2.user_id)
WHERE (u1.user_id = ".$_SESSION['uid']." AND u2.user_id = ".$_GET['id'].") OR (u1.user_id = ".$_GET['id']." AND u2.user_id = ".$_SESSION['uid'].")";
$rowdis = $conn->query($selQry);
while ($datadis = $rowdis->fetch_assoc()) {
    if ($datadis["from_uid"] == $_GET["id"]) {

?>

        <div class="chat-message is-received">
            <img src="../Assets/Files/UserDocs/<?php echo $datadis["from_userphoto"] ?>" alt="">
            <div class="message-block">
                <span><?php echo $datadis["from_username"] ?></span>
                <div class="message-text"><?php echo $datadis["chat_content"] ?></div>
            </div>
        </div>
        <div class="chat-message" style="margin: 0px; padding: 0px">

        </div>

    <?php
    } else{

    ?>
        <div class="chat-message is-sent">
            <img src="../Assets/Files/UserDocs/<?php echo $datadis["from_userphoto"] ?>" alt="">
            <div class="message-block">
                <span><?php echo $datadis["from_username"] ?></span>
                <div class="message-text"><?php echo $datadis["chat_content"] ?></div>
            </div>
        </div>
        <div class="chat-message" style="margin: 0px; padding: 0px">

        </div>
<?php
    }
}



?>
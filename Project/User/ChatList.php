<?php
include("../Assets/Connection/Connection.php");

include("Head.php");
$name='';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Untitled Document</title>
</head>


<body>

    <div class="container" align="center">
        <div class="chatlist">
            <div class="chats">
                
                <div class="title">
                    <h2>Messages</h2>
                </div>
                <?php
                $selchat = "select * from tbl_chatlist where from_id='".$_SESSION['uid']."' or to_id='".$_SESSION['uid']."'";
                $res=$conn->query($selchat);
                while($data=$res->fetch_assoc())
                {
                    if($data['chat_type']=='USER' && $data['from_id']!=$_SESSION['uid']){
                        $selUser="select * from tbl_user where user_id=".$data['from_id'];
                        $resUser=$conn->query($selUser);
                        $rowUser=$resUser->fetch_assoc();
                        $chatPath="Chat.php?id=".$data['from_id'];
                       echo $name=$rowUser['user_name'];
                        $photo=$rowUser['user_photo'];
                    }
                    else if($data['chat_type']=='USER' && $data['to_id']!=$_SESSION['uid']){
                        $selUser="select * from tbl_user where user_id=".$data['to_id'];
                        $resUser=$conn->query($selUser);
                        $rowUser=$resUser->fetch_assoc();
                        $chatPath="Chat.php?id=".$data['to_id'];
                        echo $name=$rowUser['user_name'];
                        $photo=$rowUser['user_photo'];
                    }
                    
                ?>
                <hr>
                <a href="<?php echo $chatPath ?>" class="chatlink">
                    <div class="msg">
                        <div class="chatphoto">
                            <img src="../Assets/Images/<?php echo $photo ?>" alt="avatar">
                        </div>
                        <div class="chat_details">
                            <div class="user_details">
                                <div class="name">
                                    <?php echo $name; ?>
                                </div>
                                <div class="message">
                                    <?php echo $data['chat_content']; ?>
                                </div>
                            </div>
                            <div class="datetime">
                                <?php echo $data['chat_datetime']; ?>
                            </div>
                        </div>
                    </div>
                </a>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

</body>


</html>
<?php 
include("Foot.php");
?>

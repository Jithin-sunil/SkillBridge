
<?php
$servername="localhost";
$username="root";
$password="";
$database="db_skillbridge";
$conn=mysqli_connect($servername,$username,$password,$database);
if(!$conn)
{
	die("connection failed:");
}
?>
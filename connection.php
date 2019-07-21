<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cu mess";
$conn=new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error)
{
	echo $conn->connect_error;
}
?>

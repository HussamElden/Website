<!DOCTYPE html>
<html>
<head>
	<title>DELETE category</title>
</head>

<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users";

$con = mysqli_connect($servername, $username, $password, $dbname);

if(isset($_GET['del']))
{
     $id=$_GET['del'];
     $sql = "DELETE from category where ID='$id'";

     $result=mysqli_query($con,$sql) or die("fail".mysql_error());
     echo "<meta http-equiv='refresh'content='0;url=categories.php'>";

}


?>
</body>
</html>
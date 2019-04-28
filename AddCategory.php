<!DOCTYPE html>
<html>
<head>
	<title>Add category</title>
</head>

<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users";

$con = mysqli_connect($servername, $username, $password, $dbname);

if(isset($_POST['submit']))
{


    $categoryname=$_POST['CategoryName'];



    $sql = "Insert INTO category(CategoryName) 
	 		 values('".$categoryname."')";
	 mysqli_query($con,$sql);
     echo "<meta http-equiv='refresh'content='0;url=categories.php'>";



}


?>


</body>
</html>
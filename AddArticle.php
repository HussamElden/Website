<!DOCTYPE html>
<html>
<head>
	<title>Add Article</title>
</head>
<body>

<?php
 if (!isset($_SESSION)){
	session_start();
  }
$con = new mysqli("localhost", "root", "","users");
if(isset($_POST['submit']))
{
	$Title = $_POST['Title'];
	if (!empty($_FILES['sora']['tmp_name']))
	$image= addslashes(file_get_contents($_FILES['sora']['tmp_name']));
 	$Details = $_POST['Details'];
	$categoryID= $_POST['Category'];
    
$sql = "Insert INTO articles (Article_title,Article,image,author,categoryID) 
	 values('".$Title."','".$Details."','".$image."','".$_SESSION['username']."','".$categoryID."')" ;
	 mysqli_query($con,$sql);
	 echo " <script> location.replace('myArticles.php'); </script>";
}
?>



</body>
</html>
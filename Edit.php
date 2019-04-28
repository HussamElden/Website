<html>
<head>
<title>
Editor
</title>

</head>


<body>

    <?php


$localhost = "localhost";
$username = "root";
$password = "";
$dbname = "users";

$conn = new mysqli ($localhost, $username, $password, $dbname);
if(isset($_POST['submit']))
{	
	
$id=$_POST['ID'];	
$title=$_POST['Title'];
$Article=$_POST['Details'];
$Author=$_POST['Author'];
if (!empty($_FILES['sora']['tmp_name']))
$Image= addslashes(file_get_contents($_FILES['sora']['tmp_name']));
	
$sql = "UPDATE articles SET Article_Title='$title',Article='$Article',author='$Author', image='$Image' WHERE id='$id'";
$result = mysqli_query($conn,$sql);
//echo "<meta http-equiv='refresh'content='0;url=myArticles.php'>";

	
}





?>


</body>



</html>

<!DOCTYPE html>
<html>
<head>
	<title>Edit category</title>
</head>

<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users";

$con = mysqli_connect($servername, $username, $password, $dbname);

if(isset($_GET['edit']))
{
  

}

if(isset($_POST['submit']))
{

     $id=$_POST['ID'];
  // echo "<script>alert('".$id."');</script>";
     $sql1 = "SELECT * from category where ID='$id'";
     $result1=mysqli_query($con,$sql1);
     $GLOBALS['row']=mysqli_fetch_row($result1);

    $newcat=$_POST['newcat'];
    $sql = "UPDATE category SET CategoryName='$newcat'WHERE ID='$id'";
    $result=mysqli_query($con,$sql);
    echo "<meta http-equiv='refresh'content='0;url=categories.php'>";


}


 



?>


<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}
</script>

</body>
</html>
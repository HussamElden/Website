<?php
$host="localhost";
$username="root";
$password="";
$databasename="users";

//$connect=mysqli_connect($host,$username,$password,$databasename);
$connect=mysqli_connect($host,$username,$password,$databasename);
//echo "<script type='text/javascript'>alert('A888AA');</script>";
//echo "<script type=text/javascript'> console.log('saeasdasfasf'); </script>";
//echo "<script type='text/javascript'>alert('A8aA');</script>";

if( !empty($_POST['id'])) 
{

 $row = $_POST['id'];

 mysqli_query( $connect , "DELETE FROM comments WHERE commentID='$row'");
 
 //mysqli_query("update comments set comment='$comment' where id='$row'");

 echo "success";
 exit();
}

?>



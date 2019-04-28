<?php
$host="localhost";
$username="root";
$password="";
$databasename="users";

$connect=mysqli_connect($host,$username,$password,$databasename);


if( !empty($_POST['id'])) 
{

 $row = $_POST['id'];
 $comment = $_POST['comment'];
 
 mysqli_query( $connect , "UPDATE comments SET comment='$comment' WHERE commentID='$row'");
 

 echo "success";
 exit();
}

?>



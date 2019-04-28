<?php 
if(!empty($_POST['id']))
{

$q = $_POST['id'];
$sender=$reciever=$articleID="";
$con = mysqli_connect('localhost','root','','users');

echo "<script> alert('".$q."') </script> ";

mysqli_select_db($con,"users");
$sql="SELECT MsgID,Msg,ArticleID,SenderUN,receiverUN FROM messages WHERE MsgID = '".$q."'";
$result = mysqli_query($con,$sql);
while($row = mysqli_fetch_array($result)) {
    $reciever=$row['SenderUN'];
    $sender=$row['receiverUN'];
    $articleID=$row['ArticleID'];
}

    $Message=$_POST['msg'];
    $sql2 = "INSERT INTO messages (Msg,ArticleID,SenderUN,receiverUN) VALUES ('".$Message."','".$articleID."','".$sender."','".$reciever."')";
    mysqli_query($con,$sql2); 

       
}
if(empty($_POST['id']))
{
    echo "<script> alert('empty') </script> ";
}

?>
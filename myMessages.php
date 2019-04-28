<html>
<?php include("navbar.php"); ?>

<head>
    <title> My messages </title>
    <link rel="stylesheet" type="text/css" href="myMessages/MyMessagesStyle1.css">
</head>
<body>

<div id="alertFail" class="alert alert-danger">
  Message was not sent<strong> Try Again!</strong>
</div>
<div id="alertSuccess" class="alert alert-success">
  <strong>Message sent successfully.</strong>
</div>

<?php  

if (!isset($_SESSION)){
    session_start();
  }
$conn = mysqli_connect("localhost", "root", "", "users");
$articleTitle = $articleImage = "";
if (isset($_GET['artId']))
  $articleID= $_GET['artId'];
debug($articleID);
$sql="SELECT Article_title, image FROM articles WHERE ID="."'".$articleID."'";
$result = mysqli_query($conn, $sql);
echo '<div id="container">';

while($row = mysqli_fetch_array($result))
{
    $articleTitle=$row["Article_title"];
    $articleImage=$row["image"];
    
    echo 
    '<br> <div id=articlediv>
    <img id="articleimg" src = "data: image/jpg; base64, '.base64_encode($articleImage).'"> 
    <a id="title">'. $articleTitle.'</a>
    </div> <br>';
}
$sql="SELECT MsgID,Msg,ArticleID,SenderUN FROM messages WHERE ArticleID="."'".$articleID."'"."AND receiverUN ="."'".$_SESSION['username']."' ORDER BY MsgID DESC";
$result = mysqli_query($conn, $sql);
echo ' <b> Messages </b> ';
if(mysqli_num_rows($result) > 0)
while($row = mysqli_fetch_array($result))
{
    $sender=$row["SenderUN"];
    $Msg=$row["Msg"];
    $ID=$row["MsgID"];
    echo 
    '<br> <div>
    <fieldset>
    <legend>'.$sender.'</legend>
    <p id="Msg">'. $Msg.'</p>
    <form  method=post>
    <textarea name=responsetxt class="responsetxt" id=responsetxt'.$ID.'></textarea>
    <button name=sendBtn class="btn" id='.$ID.' onclick="sendMsg(this.id);"> Send </button>
    </form>
    </fieldset> </div> <br>';
}
if(mysqli_num_rows($result) == 0)
{
    echo '<b id="noResult"> No Messages Found </b>';
}
echo "</div>";

function MsgFailorSuccess($id)
{
    echo "<script> 
            $('$id').fadeIn();
            $(document).ready( function() {
              $('$id').delay(1500).fadeOut();
            });
            </script>";
}


if(isset($_POST['sendBtn']))
{
    $Message=$_POST['responsetxt'];
    $Message=trim($Message);
    if(empty($Message))
    {
        MsgFailorSuccess('#alertFail');
    } 
    else 
    {
        MsgFailorSuccess('#alertSuccess');  
    }
    stopResub();
}
?>
    <script>
    function sendMsg(str) 
    {
        var msg=document.getElementById("responsetxt"+str).value;
        var id=str;
        msg=msg.trim();
        if (msg=="")
        { }
        else  {
    $.ajax({
      type:"post",
      url:"SendMsg.php",
      data:{
       id:id,
       msg:msg
     }, 
     success:function(response)
      {    }, 
      error:function(error){  }  
      });
        }
    }

    </script>
</body>

</html>

    
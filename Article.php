<!DOCTYPE html>
<html>
  <?php include("navbar.php"); ?>   
  <?php include("redirector.php"); ?>
<?php
if (!isset($_SESSION)){
    session_start();
  }

$message = $_SESSION['ID'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM `articles` WHERE ID = $message ";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_array($result);
$GLOBALS['author']= $row["author"];
$GLOBALS['Articlet']=$row["Article_title"];
$GLOBALS['Article']=$row["Article"];
$GLOBALS['image']=$row["image"];
$GLOBALS['id']=$row["ID"];
$catID=$row["categoryID"];
$sql = "SELECT date(date) FROM `articles` WHERE ID = $message ";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_array($result);
$GLOBALS['date']=$row[0];
$sql = "SELECT * FROM `articles` WHERE `categoryID` =$catID ";
$result = mysqli_query($conn, $sql);
$GLOBALS['array'] = array();
while($rowr=mysqli_fetch_array($result))
         {
           
            $array[]=$rowr;
           
         }
        
$msgErr="";

if(isset($_POST['submit']))
{  
    if(trim($_POST['comment']) == "")
{

echo "<script> alert('Invalid Input , You have to write something !') </script>";

}
    else {
     $C = $_POST['comment'];
 
    $username =  $_SESSION['username'];
    
     $sql3 = "Insert INTO comments
     (username,comment,articleID)
     values('".$username."','".$C."','".$id."')";
     mysqli_query($conn,$sql3);
}

}
//Get the Comment IDs !!!!
$CommentIDs = array();
$sql2 = "SELECT  commentID  FROM `comments`";
$result2 = mysqli_query($conn, $sql2);
while ($x = mysqli_fetch_array($result2)) {
    global $CommentIDs;
array_push($CommentIDs, $x[0]);
}

//Get the comment itself  !!!
$Comment = array();
$sql2 = "SELECT  comment  FROM `comments`";
$result2 = mysqli_query($conn, $sql2);
while ($x = mysqli_fetch_array($result2)) {
    global $Comment;
array_push($Comment, $x[0]);
}

// Get article names !!!
$CommentA= array();
$sql2 = "SELECT  articleID  FROM `comments`";
$result2 = mysqli_query($conn, $sql2);
while ($x = mysqli_fetch_array($result2)) {
    global $CommentA;
array_push($CommentA, $x[0]);
}


// Get usernames of written comments !!!
$Usernames = array();
$sql3 = "SELECT  username FROM `comments`";
$result3 = mysqli_query($conn, $sql3);
while ($x = mysqli_fetch_array($result3)) {
    global $Usernames;
array_push($Usernames, $x[0]);

}
?>
<head>
	<title><?php echo $Articlet?></title>
		<link rel="stylesheet" type="text/css" href="article/ArticleStyle.css"> 
        <script type="text/javascript" src="modify_records1.js"></script>
</head>
<script type="text/javascript">
// Validating Empty Field
function check_empty() {
if (document.getElementById('name').value == "" || document.getElementById('email').value == "" || document.getElementById('msg').value == "") {
alert("Fill All Fields !");
} else {
document.getElementById('form').submit();
alert("Form Submitted Successfully...");
}
}
//Function To Display Popup
function div_show($id) {
document.getElementById($id).style.display = "block";
}
//Function to Hide Popup
function div_hide($id){
document.getElementById($id).style.display = "none";
}
</script>
<body>

    <!-- Omar Anas was here -->
    <div id="alertFail" class="alert alert-danger">
  Message was not sent<strong> Try Again!</strong>
</div>
<div id="alertSuccess" class="alert alert-success">
  <strong>Message sent successfully.</strong>
</div>
<!-- Omar Anas was here -->
<div class = "All">
        <h1 style="margin-left:-90px;width:960px;text-align: center;"> <?php echo $Articlet?> </h1>
            <?php echo "<img class = 'NI1' src = 'data: image/jpg; base64, ".base64_encode($image)."' />" ;?> 
        <br>
        <br>
        <h5 class = "AuthorName">By  <?php echo $author?></h5>
        <br>
     <button id="SendMsgbtn" class="btn" onclick ="div_show('MessageBox')" > + Send a Message </button>
        <br>
        <h5 class = "Date"> <?php echo $date?> </h5>
        <p class = "Details"> <?php echo $Article?></p>   
    <h3 class = "related">More News</h3>
        <hr class="line">	

    <br>
    <br>

    </div>
    <div class = All2 >
       
        <?php echo "<img class = 'RI1 test' src = 'data: image/jpg; base64, ".base64_encode($array[0]['image'])."' />" ;?> 
        <p class="RH1" > <a <?php echo 'href="javascript: submitform('.$array[0]['ID'].')"';   ?> ><?php echo $array[0]['Article_title'] ?> </a> </p>
    <div class="TH" >
    <p class= "trending">  Trending  </p>
        <p id="TH"> <a <?php echo 'href="javascript: submitform('.$array[0]['ID'].')"';   ?> ><?php echo $array[0]['Article_title'] ?> </a></p>
        <p id="TH"> <a <?php echo 'href="javascript: submitform('.$array[1]['ID'].')"';   ?> ><?php echo $array[1]['Article_title'] ?> </a></p>
        <p id="TH"> <a <?php echo 'href="javascript: submitform('.$array[0]['ID'].')"';   ?> ><?php echo $array[2]['Article_title'] ?> </a></p>
        <p id="TH"> <a <?php echo 'href="javascript: submitform('.$array[1]['ID'].')"';   ?> ><?php echo $array[3]['Article_title'] ?> </a></p>
    </div>

        <p class = "RP" id = 'test'> <?php echo $array[0]['Article'] ?>
        <br>
        

        </p>

        <br>
        <br>
        <?php echo "<img class = 'RI1 ' src = 'data: image/jpg; base64, ".base64_encode($array[1]['image'])."' />" ;?> 
        <p class="RH1"> <a <?php echo 'href="javascript: submitform('.$array[1]['ID'].')"';   ?> ><?php echo $array[1]['Article_title'] ?> </a> </p>
        <p class = "RP"id = 'test'> <?php echo $array[1]['Article'] ?>
        <br>
        
    </div>
        <!-- Omar Anas was here -->
    <div id="MessageBox">
        <div id="popupMsg">
            <form class="MsgForm" method="post" name="MsgForm">

            <img class="close" width="30" height="30" src="pictures/close.png" onclick ="div_hide('MessageBox')">
            <h4>
            Write your message regarding any issue in the article:
            </h4>
            <b class="error"> <?php echo $msgErr; ?> </b>
            <textarea name="Messagetxt" class="Msgtxt"></textarea>
            <br>
            <br>
            <input value="Submit" type="submit" name="Msgsubmit" class="ebtn">
            <br><br>

            </form>
        </div>
    </div>
        <!-- Omar Anas was here -->
    <?php 
    // Omar Anas was here 
    if ($loggedIn)
    {
      echo '<script> $("#commmentBox").css("display","block");</script>';
      
   }
   if ($loggedIn &&  $_SESSION['userType']=='Reader')
   {
    echo '<script> $("#SendMsgbtn").css("display","inline-block");</script>';
   }
            function MsgFailorSuccess($id)
            {
                echo "<script> 
                        $('$id').fadeIn();
                        $(document).ready( function() {
                        $('$id').delay(1500).fadeOut();
                        });
                        </script>";
            }

            if(isset($_POST['Msgsubmit']))
            {
                $Message=$_POST['Messagetxt'];
                $Sender=$_SESSION['username'];
                $Message=trim($Message);
                if(empty($Message))
                {
                    MsgFailorSuccess('#alertFail');
                    stopResub();
                } 
            else 
                {
                   // echo "<script type='text/javascript'>alert('$author');</script>";
                    $sql = "INSERT INTO messages(Msg,ArticleID,SenderUN,receiverUN) VALUES ('".$Message."','".$id."','".$Sender."','".$author."')"; // 2nd parameter article session id 
                    mysqli_query($conn,$sql);
                    MsgFailorSuccess('#alertSuccess');  
                    stopResub();
                }
            }
                
    ?>
    <br><br>
    <h3 class = "Cing"> Comments</h3>

<div class="CommentSection">
    <hr class="line2">   
<br>

<form   id= "commmentBox" method="post" style="display: none;">   
<input type="text" class="comment" name="comment"  placeholder="Write a comment..">
<br><br>
<input value="Submit your comment" type="submit" name="submit" class="btn">
</form>


<!--  EDIT COMMENT HENA  -->
<div id="abc">
<div id="popupContact">
<!-- Contact Us Form -->
<form  class="editform" method="post" name="form">

<img class="close" width="30" height="30" src="pictures/close.png" onclick ="div_hide()">
<h4>
Write your new comment
</h4>
<textarea name="newcomment" class="newcomment"></textarea>
<br>
<br>
<input value="Submit" type="submit" name="editsubmit" class="ebtn">
<br><br>

</form>
</div>
</div>
<br>

    <?php 
$length = count($Usernames);  
  
   $length = count($CommentIDs);  
    if ($loggedIn)
    {
    ?>
  <script> $("#commmentBox").css("display","block");</script>

    <?php
    }
  if ($loggedIn &&  $_SESSION['userType']=='Reader')
   {

    ?>  
  <script> $("#SendMsgbtn").css("display","inline-block");</script>

    <?php
}
 for ($x = 0; $x <count($CommentIDs); $x++)    
   {

    if ($CommentA[$x] == $id) 
    {
    ?>
 <p class="aComment">

     <img src=" pictures/user.png" id="img<?php 
     echo $CommentIDs[$x];?>" width="40" height="40" > <span id="usern<?php 
     echo $CommentIDs[$x];?>"> <?php echo $Usernames[$x]  ?> </span> <br>   
      <span id= "Comment_val<?php echo $CommentIDs[$x];  ?>"> <?php echo $Comment[$x]  ?> </span><br> 
        <?php 
 if ($loggedIn)
    if ($_SESSION['username'] == $Usernames[$x])
    {
        ?>

    <input type="button" id="edit_button<?php 
     echo $CommentIDs[$x];?>" value='Edit' class =
     "btn" onclick= "edit_row('<?php echo $CommentIDs[$x] ?>')">
     <br>
     <button id="delete_button<?php echo $CommentIDs[$x];?>" type="submit" class="btn" onclick= "delete_row('<?php echo $CommentIDs[$x] ?>')"> Delete </button>
     
      <br>
     
     <button id="save_button<?php echo $CommentIDs[$x];?>" style="display:none;" type="submit"
      onclick="save_row('<?php echo $CommentIDs[$x];?>')" class="btn" name="save" > Save </button>
   <?php
}


   ?>
  <br>
  <br>
</p>

   <?php
}

}
   ?>

</div>

</body>

</html>  
<html>
<head>
<link rel="stylesheet" type="text/css" href="MyArticles/EditArticle.css">

  <?php include("navbar.php"); ?>  
  <?php include("redirector.php"); ?>
<title>MIU24</title>
<?php
if (!isset($_SESSION)){
    session_start();
  }

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
if(isset($_GET['edited']))
  {  
     $id=$_GET['edited'];

$sql = "SELECT * FROM `articles` WHERE ID = $id";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_array($result);
$GLOBALS['author']= $row["author"];
$GLOBALS['Articlet']=$row["Article_title"];
$GLOBALS['Article']=$row["Article"];
$GLOBALS['image']=$row["image"];
$GLOBALS['id']=$row["ID"];
$catID=$row["categoryID"];
        
    }

?>


</head>
<body>
<?php 
if(isset($_POST['submit']))
{
   
$t=$_POST['TITLE'];
echo "<script>alert('".$t."')</script>";
$content=$_POST['content'];
if (empty($_FILES['sora']['tmp_name']))
 $sql2 = "UPDATE articles SET Article_Title='$t',Article='$content' WHERE id='$id'";
if (!empty($_FILES['sora']['tmp_name']))
{
$sora= addslashes(file_get_contents($_FILES['sora']['tmp_name']));
$sql2 = "UPDATE articles SET Article_Title='$t',Article='$content',image='$sora' WHERE id='$id'";
}
mysqli_query($conn,$sql2);

if (!isset($_SESSION)){
    session_start();
  }


  $_SESSION['ID']=$id;
echo " <script> location.replace('article.php'); </script>";
}
 ?>
<form method="post" action="" enctype="multipart/form-data" id="x">
<div style="height:160pt" > NAV BAR</div>
<div class="all" > 
<input class="Title"  type="text" value="<?php echo $GLOBALS['Articlet']?>" name="TITLE" class="x">
<br>
<?php echo "<img class = 'editedimage' src = 'data: image/jpg; base64, ".base64_encode($GLOBALS['image'])."' />" ;?> 
<input class="choosefilefield" type="file" name="sora" accept="image/*" value="base64_encode($GLOBALS['image'])">
<br>

<br>
<br>
<br>
<br>
<textarea name="content" form="x" class="ArticleContent"><?php echo $GLOBALS['Article'] ?></textarea>
<br>
<input type="submit" name="submit" value="Confirm Edit" class="btn">
</div>
</form>
</body>

</html>
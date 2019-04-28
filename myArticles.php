<html>
<?php include("navbar.php");include("redirector.php"); ?>

<head>
    <title> My Articles </title>
 

    <link rel="stylesheet" type="text/css" href="MyArticles/MyArticlesStyle.css">
</head>
<body>


<?php  

if (!isset($_SESSION)){
    session_start();
  }
$conn = mysqli_connect("localhost", "root", "", "users");
$articleTitle = $articleImage = "";
if($_SESSION['userType']=='Editor'){
$sql="SELECT ID,Article_title, image FROM articles WHERE author="."'".$_SESSION['username']."'";
}else if ($_SESSION['userType']=='Reader'){
$sql="SELECT ID,Article_title, image FROM articles a INNER JOIN messages m ON a.ID=m.ArticleID 
      WHERE SenderUN="."'".$_SESSION['username']."' GROUP BY ID";
}
$result = mysqli_query($conn, $sql);
echo '<div id="Allarticles">';
echo '<h1> My Articles </h1>';
while($row = mysqli_fetch_array($result))
{
    $articleTitle=$row["Article_title"];
    $articleImage=$row["image"];
    $articleID=$row["ID"];

    echo '<br> <div id=articlediv>';
    echo "<img id = 'articleimg' src = 'data: image/jpg; base64, ".base64_encode($articleImage)."'>" ;
    echo "<a href= 'javascript: submitform(".$row['ID'].");' ><p id='title'>'". $articleTitle."'</p></a> ";
    echo '<a href=Mymessages.php?artId='.$articleID.'><button id=Reviewbtn class="btn" > Review Messages </button></a>';
    echo "<a href=DeleteArticle.php?del=$row[ID]> <button class=OtherBtns><img id=delpic src= 'pictures/delete.png' width='30' height='30'> </button> </a>";
    echo "<a href='EditArticle.php?edited=$row[ID]'><button type='button' class='OtherBtns'  data-toggle='modal' data-target='#myModalArticle'id='$row[ID]' onClick='reply_click(this.id)' ><img src='pictures/edit.png' width='20' height='20'></button></a>";
    echo '</div> '; 
    
}



if(mysqli_num_rows($result) == 0 && $_SESSION['userType']=='Reader')
{
    echo '<b id="noResult"> You have not send any message yet! </b>';
}
if(mysqli_num_rows($result) == 0 && $_SESSION['userType']=='Editor')
{
    echo '<b id="noResult"> You have not written any articles yet! </b>';
}
echo "<button type='button' id=addbtn  class=' OtherBtns' data-toggle='modal' data-target='#myModalArticle' onClick='add_click()' ><img src='pictures/add.png' width='20' height='20'class='center'></button>";

// echo "</div>";

?>
<script type="text/javascript">
    function reply_click(clicked_id)
    {
        document.getElementById('hhhh').value = ""+clicked_id;
        document.getElementById("form_id").action = "Edit.php";

    }

    });
    function add_click()
    {
        document.getElementById('addbutton').style.display = "block";
        document.getElementById("form_id").action = "AddArticle.php";
    }
    </script>

<div class='container'>
                         <!-- Trigger the modal with a button -->
 <div class='modal fade' id='myModalArticle' role='dialog'>
          <div class='modal-dialog'>
                             <!-- Modal content-->
            <div class='modal-content'>
             <div class='modal-header'>
              <button type='button' class='close' data-dismiss='modal'>&times;</button>
                           
                      </div>
                  <div class='modal-body'>
   <form  id= "form_id" method='POST' enctype = "multipart/form-data">
	<!-- <label> Title: <label> -->
    Title:<br>	<input class='titletxt' type='text'  name='Title' style='width:575px'><br>
	<!-- <label> Author <label> -->
	Details:<textarea rows="10" cols="78" name='Details'></textarea><br>
	<!-- <label> Image: <label> -->
    Image: <input type="file" name=sora><br>
    
    Category: 
    <select name="Category"> 
    <?php 
       
        $sql="SELECT * FROM `category`";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($result))
        { 
          echo "<option name=Category value=".$row['ID'].">".$row['CategoryName']."</option>";
        }
     ?>
     </select>
    <input type='hidden' id ='hhhh' name='ID'>
    <input type='submit' class="btn" value='Add' name='submit' id='addbutton' style="display:none; margin-top:-10px"><br> 
    
	</form>           
        </div>      
             </div>
             </div>
            </div>
           </div> 

</body>
</html>
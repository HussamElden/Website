<html>
<head>
<?php 
if (!isset($_SESSION)){
  session_start();
}
$ID ="";


    if (empty($_POST["name"])) {
        $nameErr = "wrong id";
      } else {
        $ID = $_POST["name"];
       
        $_SESSION["ID"] =  $ID;
        echo " <script> location.replace('article.php'); </script>";
      }

     

?>

</head>
<body>
<form name="myform"action="#" method="post">
 <input style="display: none;" id ="demo" type="text" name="name" value=""><br>


</form>

</body>
<script type="text/javascript">
function submitform(x)
{
    document.getElementById("demo").value =x;
      
    document.forms["myform"].submit();
}
</script>


</html>
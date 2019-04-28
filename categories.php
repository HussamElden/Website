<!DOCTYPE html>
<html>
<?php include("navbar.php"); ?> 
<?php include("redirector.php"); ?>
<?php
if(isset($_GET['catname']))
{

   $GLOBALS['catname']=$_GET['catname'];
   $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "users";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if (!$conn) {
         die("Connection failed: " . mysqli_connect_error());
         }
         $sql = "SELECT * FROM `articles` WHERE `categoryID` = (SELECT ID FROM category WHERE CategoryName = '$catname' )";
         $result = mysqli_query($conn, $sql);
         
         $GLOBALS['array'] = array();
         
         while($row=mysqli_fetch_array($result))
         {
           
            $array[]=$row;
           
         }
         if (mysqli_num_rows($result)==0) {
            echo"<script>alert('No Avaliable Articles !')</script>";
       echo "<meta http-equiv='refresh'content='0;url=test.php'>";



         }   
}


?>


<head>
	<title><?php echo $catname     ?></title>
	<link rel="stylesheet" type="text/css" href="categories/categories.css"> 


</head>
<body>
    <div style="height:90pt;"> NAVIGATION BAR </div>

     <h1 style = "margin-top:100px;margin-left:168px;font-weight:bolder"><?php echo $catname     ?></h1>

     <div class="wholediv">

<div class="firsst">
<?php echo "<img class = 'NI1' src = 'data: image/jpg; base64, ".base64_encode($array[0]["image"])."' height ='396px' width = '703px' />" ;?>
 	<a <?php echo 'href="javascript: submitform('.$array[0]['ID'].')"';   ?> class = "NewsHeaderL" ><?php echo $array[0]['Article_title'] ?> </a>
</div>

<div class="second">

<?php echo "<img class = 'NI2' src = 'data: image/jpg; base64, ".base64_encode($array[1]["image"])."'  />" ;?>
<a <?php echo 'href="javascript: submitform('.$array[1]['ID'].')"';   ?> class = "NewsHeaderL2" ><?php echo $array[1]['Article_title'] ?></a>

</div>
<div class="third">

<?php echo "<img class = 'NI2' src = 'data: image/jpg; base64, ".base64_encode($array[2]["image"])."'  />" ;?>
<a <?php echo 'href="javascript: submitform('.$array[2]['ID'].')"';   ?> class = "NewsHeaderL3" ><?php echo $array[2]['Article_title'] ?></a>
    </div>

  
</div>

<div class="secondwhole">

        <div class="forth">

        <?php echo "<img class = 'NI4' align='left' src = 'data: image/jpg; base64, ".base64_encode($array[3]["image"])."'  />" ;?>
               <br>
            <div class="klam "> <a <?php echo 'href="javascript: submitform('.$array[3]['ID'].')"';   ?> style = "" href=""><b><p class="test"><?php echo $array[3]['Article_title'] ?></p></a> <p class="forthH2 "><?php echo $array[3]['Article_title'] ?> </p>

                
            </div> 
        
            </div>
            <div class="forth">

        <?php echo "<img class = 'NI4' align='left' src = 'data: image/jpg; base64, ".base64_encode($array[4]["image"])."'  />" ;?>
               <br>
            <div class="klam"> <a <?php echo 'href="javascript: submitform('.$array[4]['ID'].')"';   ?>  href=""><b><p class="test"><?php echo $array[4]['Article_title'] ?></p></a> <p class="forthH2"><?php echo $array[4]['Article_title'] ?> </p>

                
            </div> 
        
            </div>
                                <div class="forth">

                    <?php echo "<img class = 'NI4' align='left' src = 'data: image/jpg; base64, ".base64_encode($array[5]["image"])."'  />" ;?>
                        <br>
                        <div class="klam"> <a <?php echo 'href="javascript: submitform('.$array[5]['ID'].')"';   ?> href=""><b><p class="test"><?php echo $array[5]['Article_title'] ?></p></a> <p class="forthH2"><?php echo $array[2]['Article_title'] ?> </p>

                           
                        </div> 

                        </div>
                    <div class="forth">

                <?php echo "<img class = 'NI4' align='left' src = 'data: image/jpg; base64, ".base64_encode($array[6]["image"])."'  />" ;?>
                    <br>
                    <div class="klam"> <a <?php echo 'href="javascript: submitform('.$array[6]['ID'].')"';   ?>  href=""><b><p class="test"><?php echo $array[6]['Article_title'] ?></p></a><p class="forthH2"><?php echo $array[2]['Article_title'] ?> </p>

                        
                    </div> 

                    </div>
                     
</div>

<h3 class="recentNewsH">More News </h3>
<hr class="line" style="margin-bottom:100px">

<div class="thirdwhole">
    

<div class="bottomshape">

   
     <a><?php echo "<img class = 'NI5'  src = 'data: image/jpg; base64, ".base64_encode($array[7]["image"])."'  />" ;?>   </a>               
     <div class="klam">  <b><a <?php echo 'href="javascript: submitform('.$array[7]['ID'].')"';   ?>><p class="test1"><?php echo $array[7]['Article_title'] ?></p></a> <p class="forthH3"><?php echo $array[3]['Article'] ?></p>
     </div> 

</div>               
<div class="bottomshape">

   
<a><?php echo "<img class = 'NI5'  src = 'data: image/jpg; base64, ".base64_encode($array[8]["image"])."'  />" ;?>   </a>               
<div class="klam">  <b><a <?php echo 'href="javascript: submitform('.$array[8]['ID'].')"';   ?> ><p class="test1"><?php echo $array[8]['Article_title'] ?></p></a> <p class="forthH3"><?php echo $array[4]['Article'] ?></p>
</div> 

</div>   

     </div>
     
    

     

</body>
</html>
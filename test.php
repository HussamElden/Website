<html>
<head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
        <link rel="stylesheet" href="main/mstyle.css">
<title>MIU 24</title>
 <?php include("navbar.php"); ?>  
<?php include("redirector.php"); ?>
<?php
                          $servername = "localhost";
                          $username = "root";
                          $password = "";
                          $dbname = "users";

                          $con = mysqli_connect($servername, $username, $password, $dbname);
                          if (!$con) {
                            die("Connection failed: " . mysqli_connect_error());
                        }
                          $sql = "SELECT * FROM `articles` ORDER BY date DESC ";

                         $result=mysqli_query($con,$sql);

                         
                         $GLOBALS['test']=array();
                         $counter=0;
                         while($row=mysqli_fetch_array($result))
                         {
                          $test[$counter]=$row;
                          $counter++;
                         
                         }
                         
                     ?>
</head>
<body>
    
            <div id="Main" class="container">
                    
                    <div id="myCarousel" class="carousel slide" data-ride="carousel" >
                      <!-- Indicators -->
                      <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                      </ol>
                  
                      <!-- Wrapper for slides -->
                      <div class="carousel-inner">
                        <div class="item active crop">
                          
                          <?php echo "<img  style='width:100%;' src = 'data: image/jpg; base64, ".base64_encode($test[0]['image'])."'  />" ;?> 
                          <div id="picnews" class="carousel-caption">
                                
                                <a <?php echo 'href="javascript: submitform('.$test[0]['ID'].')"';   ?>> <h2><?php echo $test[0]['Article_title'] ?> </h2>
                                    <br>
                                    <p id="test"><?php echo $test[0]['Article'] ?></p>
                                </a>
                               </div>
                        </div>
                  
                        <div class="item crop">
                        <?php echo "<img style='width:100%;''  src = 'data: image/jpg; base64, ".base64_encode($test[1]['image'])."' />" ;?> 
                          <div id="picnews" class="carousel-caption">
                              
                            <a <?php echo 'href="javascript: submitform('.$test[1]['ID'].')"';   ?>> <h2><?php echo $test[1]['Article_title'] ?></h2>
                                <br>
                                <p id="test"><?php echo $test[1]['Article'] ?></p>
                            </a>
                           </div>
                        </div>
                      
                        <div class="item crop">
                        <?php echo "<img style='width:100%;'  src = 'data: image/jpg; base64, ".base64_encode($test[2]['image'])."' />" ;?> 
                          <div id="picnews" class="carousel-caption">
                                
                          <a <?php echo 'href="javascript: submitform('.$test[2]['ID'].')"';   ?>> <h2><?php echo $test[2]['Article_title'] ?></h2>
                                <br>
                                <p id="test"><?php echo $test[2]['Article'] ?></p>
                            </a>
                           </div>
                        </div>
                      </div>
                      
    
                    </div>
                    <div id="bar">
                      <div id="subbar">
                        <a <?php echo 'href="javascript: submitform('.$test[3]['ID'].')"';   ?>  >
                        <div class = 'class' ><?php echo $test[3]['Article_title'] ?></div>
                            <?php echo "<img   src = 'data: image/jpg; base64, ".base64_encode($test[3]['image'])."' />" ;?> 
                          
                        </a>
                        
                        
                      </div>
                      <div id="subbar">
                      <a <?php echo 'href="javascript: submitform('.$test[4]['ID'].')"';   ?>  >
                            <div class = 'class' ><?php echo $test[4]['Article_title'] ?></div>
                            <?php echo "<img   src = 'data: image/jpg; base64, ".base64_encode($test[4]['image'])."' />" ;?> 
                          
                        </a>
                      </div>
                      <div id="subbar">
                      <a <?php echo 'href="javascript: submitform('.$test[5]['ID'].')"';   ?>  >
                            <div class = 'class' ><?php echo $test[5]['Article_title'] ?></div>
                            <?php echo "<img   src = 'data: image/jpg; base64, ".base64_encode($test[5]['image'])."' />" ;?> 
                          
                        </a>
                      </div>
                      <div  id="subbar">
                      <a <?php echo 'href="javascript: submitform('.$test[6]['ID'].')"';   ?>  >
                            <div class = 'class' ><?php echo $test[6]['Article_title'] ?></div>
                            <?php echo "<img   src = 'data: image/jpg; base64, ".base64_encode($test[6]['image'])."' />" ;?> 
                          
                        </a>
                      </div>
               
                    </div>
                  </div>
           
                  <div>

                  </div>
    
   
    
<br>

<script>
var prevScrollpos = window.pageYOffset;
window.onscroll = function() {
  var currentScrollPos = window.pageYOffset;
  if (prevScrollpos > currentScrollPos) {
    document.getElementById("MenuBar").style.top = "0";
  } else {
    document.getElementById("MenuBar").style.top = "-500px";
  }
  prevScrollpos = currentScrollPos;
} 
</script> 
</body>


</html>
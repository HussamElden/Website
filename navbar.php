<html>
<head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
        <link rel="stylesheet" href="navbar/teststyle2.css">


</head>
<body>

<?php  
include("redirector.php"); 
 if (!isset($_SESSION)){
   session_start();
 }
  
  $con = new mysqli("localhost", "root", "","users");
  $js=$js2="";
  $userFound= $loggedIn=false;
  $GLOBALS['UNerrTxt']="Username not found";
  $GLOBALS['PassErrTxt']="Incorrect Password";
  $GLOBALS['Unerr']="";
  $GLOBALS['PassError']="";
  function customError($errno,$errstr)
  {
    if ($errstr== $GLOBALS['PassErrTxt'])
    $GLOBALS['PassError']=$errstr;
    if ($errstr==  $GLOBALS['UNerrTxt'])
    $GLOBALS['Unerr']=$errstr;
   
  }
  set_error_handler("customError",E_USER_WARNING);
  
   if(isset($_POST['Login']))
   {
     $username = $_POST['username'];
     $password = $_POST['password'];
     
     $sql="SELECT username,password,TypeName from `user` Inner JOIN usertype on user.TypeID=usertype.TypeID";
     $result = mysqli_query($con,$sql);	
    
     if(mysqli_num_rows($result) > 0)
     {
         while($row = mysqli_fetch_array($result))
         {
            if ($username==$row['username'])
            {
               if ($password==$row['password'])
               {
                 
                 $_SESSION['username']=$username;
                 $_SESSION['password']=$password;
                 $_SESSION['userType']=$row['TypeName'];
                 $js= '<script> 
                 $("#LoginSignUpcontainer").hide(); 
                 $(".loggedindropdown").css("display","block"); 
                 </script>';
                 $_SESSION['js']=$js;
                 $loggedIn=true;
               }
               else if ($password!=$row['password'])
               {
               //  $PassError="Incorrect Password";
                 trigger_error( $GLOBALS['PassErrTxt'],E_USER_WARNING);
                 $js2= '<script> 
                 $("#dropdowncontentID").css("display","block"); 
                 </script>';
                // $_SESSION['js']=$js;
               }
              $userFound=true;
              $GLOBALS['Unerr']="";
             
            }
           
            if (!$userFound)
            {
            // $UNerror="Username not found";
             trigger_error($GLOBALS['UNerrTxt'],E_USER_WARNING);  
             $js2= '<script> 
             $("#dropdowncontentID").css("display","block"); 
             </script>';
             //$_SESSION['js']=$js;
            }
         }
      }
   }     
    
 if (!empty($_SESSION['username']))
{
  $_SESSION['js']= '<script> 
  $("#LoginSignUpcontainer").hide(); 
  $(".loggedindropdown").css("display","inline-block"); 
  </script>';
  $loggedIn=true;
}
 if (empty($_SESSION['username']))
  { 
    $_SESSION['js']="";
  }
  if(isset($_POST['signOut']))
  {
    session_destroy();
    $_SESSION['js']="";
    $loggedIn=false;
    echo " <script> location.replace('test.php'); </script>";
  }

  function debug($msg) { 
    echo "<script>console.log(".json_encode($msg).")</script>";
}
function stopResub()
{
    echo ' <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script> ';
}
stopResub();
?>

        <div id="MenuBar">
        <div class="card">
                <a class="logo" href="test.php"><img  src="pictures/logo.jpg" ></a>
                <a class="back" href="test.php"><img  src="pictures/logo.jpg" ></a>
              </div>
                <br><br><br>
                <ul id="MenuBar1" >
                    <li> <a class="first" href="test.php">Home</a>   <a> | </a> </li>
                    <li> <a href="categories.php?catname=World">  World </a>   <a> | </a> </li>
                    <li> <a href="categories.php?catname=Sports">  Sports </a>   <a> | </a> </li>
                    <li> <a href="categories.php?catname=Business">  Business</a>   <a> | </a> </li>
                   
                </ul>
              <ul id="MenuBar2">
                <li class="More"> <a>MORE</a>
                  <br>
                  <ul id="dropdown">
                   <?php
                          $servername = "localhost";
                          $username = "root";
                          $password = "";
                          $dbname = "users";
                          
                          $con = mysqli_connect($servername, $username, $password, $dbname);
                          
                          $sql = "SELECT * FROM `category` LIMIT 3,5";

                         $result=mysqli_query($con,$sql);

                         $countergded=0;

                         while($GLOBALS['row']=mysqli_fetch_array($result))
                         {

                          echo "<li class='nawas'>".'<a href=categories.php?catname='.$row['CategoryName'].'>'.$row['CategoryName'].'</a>';
                         if($loggedIn)    
                          if( $_SESSION['userType']=='Editor')
                          echo "<button class='addeditbutton'><a href='deletecat.php?del=$row[ID]'><img src= 'trash-circle-red-128.png' width='20' height='20'id='abas'></button>
                          </a><button type='button' class='addeditbutton'  data-toggle='modal' data-target='#myModal'id='$row[ID]' onClick='reply_click(this.id)' ><img src='pen.png' width='20' height='20'></button>";
                          echo "</li>";
                         }
                         if($loggedIn) 
                         if( $_SESSION['userType']=='Editor')
                         echo"<button type='button' class='addbtn' data-toggle='modal' data-target='#myModal2' ><img src='adding.png' width='20' height='20'class='center'></button>";                       
                     ?>

 
    
                  </ul>
                </li>
              </ul>
        
             <button class= "searchbtn"> <img  src="pictures/search.png" width="21px" height="20px"> </button>
             <input name="term" type="text" id="searchbar" onkeyup="getResult()" placeholder="Search Articles..." />
                    <ul id="result"></ul>
                    
              <div id="LoginSignUpcontainer">
                <div class="dropdownlogin">
             
                         <img src="pictures/login.png"> <span style=" color: rgb(235, 235, 235);font-size: 16px;">Login</span> 
                        
                        <div class="dropdown-content" id="dropdowncontentID" >
                            <form method="POST" action="">
                                <span> Username </span> <br>
                                <input type="text" name="username" class="txt" id="untxt" placeholder="Username">  <b class="error"> <?php echo $GLOBALS['Unerr'];  ?> </b> <br>
                                <span> Password </span> <br>
                                <input type="password" name="password"  class="txt" id="passtxt" placeholder="Password">  <b class="error"> <?php echo $GLOBALS['PassError'];  ?> </b>  <br> <br>
                                <input style="color:black; " type="submit" value="Login" name="Login" id="loginbtn"><br>
                                
                            </form>
                        </div>
                      
                    </div> 
                    <a href="Signup.php"><img src="pictures/signup.png" ><span> Sign Up </span> </a>
                </div>
                 
              <div class="loggedindropdown" >
                <img src="pictures/signup.png" ><span> <?php echo $_SESSION['username']; ?> </span>
               <div class="dropdown-content-User" >
                <form method="POST" action=""> 
                <input type="button" name="Articlesbtn" id="Articlesbtn" class="myBtn" value="My Articles"> 
                <input type="button" name="Messagesbtn" id="Messagesbtn" class="myBtn" value="My Messages"> 
                <br>
                <?php if( $_SESSION['userType']=='Editor') 
                echo '<script> $("#Articlesbtn").css("display","block"); </script> '; 
                else if ($_SESSION['userType']=='Reader')
                echo '<script> $("#Messagesbtn").css("display","block"); </script> '; 
                ?>
                 
                  <input type="submit" name="signOut" id="signOutbtn" value="Sign Out">
                </form>
               </div>
              </div>
                <?php echo $_SESSION['js']; echo $js2; ?> 
            </div>
             
            <div class='container'>
                         
                        
                                             <div class='modal fade' id='myModal' role='dialog'>
                           <div class='modal-dialog'>
                           
                             
                             <div class='modal-content'>
                               <div class='modal-header'>
                                 <button type='button' class='close' data-dismiss='modal'>&times;</button>
                           
                               </div>
                               <div class='modal-body'>
           <form action='editcat.php' method='POST' class='modalzz'>
           
                                                CategoryName: <input type='text' name='newcat'value=<?php echo$row['CategoryName']?>>    
                                                 <input type='hidden' id ='hhh' name='ID'>
                                                 <input type='submit' name= 'submit' value='Update'>

                                                 </form>            
                  
                             </div>
                           </div>
                         </div>
                            </div> 
                            
                            <div class='container'>
                         
                        
                                             <div class='modal fade' id='myModal2' role='dialog'>
                           <div class='modal-dialog'>
                           
                            
                             <div class='modal-content'>
                               <div class='modal-header'>
                                 <button type='button' class='close' data-dismiss='modal'>&times;</button>
                           
                               </div>
                               <div class='modal-body'>
           <form action='AddCategory.php' method='POST' class='modalzz'>

                         <input type="text" name="CategoryName">
                        <button type="submit" name="submit"> Add Category </button>
  </form>                            
                               </div>
                       
                             </div>
                           </div>
                         </div>
                            </div>
          
           

<script>
   function reply_click(clicked_id)
    {
       // alert(clicked_id);
        document.getElementById('hhh').value = ""+clicked_id;
    }
    $(document).ready(function(){
  $(".searchbtn").click(function(){
    
    $("#searchbar").fadeToggle("slow");
    
  });
});
    function getResult() 
		{
			$.ajax(
			{
				url: "backend-search.php",
				data:'term='+$("#searchbar").val(),
				type: "POST",
				success:function(data2)
				{
					$("#result").html(data2);
				}
			});
		}
document.getElementById("Articlesbtn").onclick = function () {
        location.href = "myArticles.php";
    };
    document.getElementById("Messagesbtn").onclick = function () {
        location.href = "myArticles.php";
    };

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
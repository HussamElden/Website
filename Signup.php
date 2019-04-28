 <?php include("navbar.php"); ?>

<html>
<head>
    <title> Registration </title>
    <link rel='stylesheet'  type='text/css' href='SignUp/DesignSignUp.css' >
</head>
<body>



<?php 
if (!isset($_SESSION))
{    session_start();
  }


$con = new mysqli("localhost", "root", "","users");
$username = $password =$confirmPassword=$ID="";
$Unerr =$Passerr=$confirmPasserr=$IDerr=$js=$js2 ="";
$EditorUnErr = $EditorPassErr = $EditorconfirmPassErr="";
$signUp=true;

 
if(isset($_POST['Readerbtn']))
{
    $username = $_POST['regusername'];
    $username=trim($username);
    $password = $_POST['regpassword'];
    $password=trim($password);
    $confirmPassword= $_POST['confirmPassword'];
    $confirmPassword=trim($confirmPassword);
    if (!empty($_FILES['idFile']['tmp_name']))
    {
        $ID= addslashes(file_get_contents($_FILES['idFile']['tmp_name']));
    }
    
    $sql="SELECT username FROM `user`";
    $result = mysqli_query($con,$sql);	
    if(mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_array($result))
        {
          try {
            if ($username==$row['username'])
            {
             // $Unerr="Username already taken";
             throw new Exception("Username already taken");        
            }
          }
           catch (Exception $e) {
           $Unerr=$e->getMessage();
           $signUp=false;
           }
        }
     }
   
     try {
        if (empty($confirmPassword))
        {
            // $confirmPasserr="Confirm your password";
            throw new Exception("Confirm your password");
        }
          
      if ($password!=$confirmPassword)
      {
         //$confirmPasserr="Password Doesn't match";
          throw new Exception("Passwords Doesn't match");
      }
      
    }
    catch (Exception $e) {
        $confirmPasserr=$e->getMessage();
        $signUp=false;
        }
     try {
        
     if (empty($username))
        {
           //  $Unerr="Username is required";
             throw new Exception("Username is required");
        }
    if (strlen($username) < 4)
    {
        // $Unerr="Username should be more than 4 charachters";
        throw new Exception("Username should be more than 4 charachters");
    }
    
  }
  catch (Exception $e) {
    $Unerr=$e->getMessage();
    $signUp=false;
    }

    try {
    
    if (empty($password))
    {
        // $Passerr="Please Fill Password";
        throw new Exception("Please Fill Password");
    }
    if (strlen($password) < 8)
    {
        //$Passerr="Password should be more than 8 charachters";
        throw new Exception("Password should be more than 8 charachters");
    }
   }
   catch (Exception $e) {
    $Passerr=$e->getMessage();
    $signUp=false;
    }
    try { 

    if (empty($_FILES['idFile']['tmp_name']))
    {
    // $IDerr="Please Upload your ID";
    throw new Exception("Please Upload your ID");
    }

    if ($_FILES['idFile']['size'] > 64000)
    {
        // $IDerr="File size shouldn't exceed 64 Kbytes";
        throw new Exception("File size shouldn't exceed 64 Kbytes");
    }
       }
     catch (Exception $e) {
        $IDerr=$e->getMessage();
        $signUp=false;
        }

      
    if($signUp==true) 
    {
    $sql="INSERT INTO user(username,password,id,TypeID) VALUES ('".$username."','".$password."','". $ID ."','1')";
    mysqli_query($con,$sql); 
    $_SESSION['username']=$username;
    $_SESSION['password']=$password;
    $_SESSION['userType']='Reader';
    echo " <script> location.replace('test.php'); </script>";
    }
}

if(isset($_POST['Editorbtn']))
{
    $username = $_POST['regusername'];
    $username=trim($username);
    $password = $_POST['regpassword'];
    $password=trim($password);
    $confirmPassword= $_POST['confirmPassword'];
    $confirmPassword=trim($confirmPassword);
    $sql="SELECT username FROM `user`";
    $result = mysqli_query($con,$sql);	

    if(mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_array($result))
        {
        try 
        {
            if ($username==$row['username'])
           {
            //$EditorUnErr="Username already taken";
            throw new Exception("Username already taken");
           }
          }   
          catch (Exception $e) {
            $EditorUnErr=$e->getMessage();
            $signUp=false;
            }
        }
     }
    
     try {

        if (empty($confirmPassword))
        {
            // $confirmPasserr="Confirm your password";
            throw new Exception("Confirm your password");
        }
          
      if ($password!=$confirmPassword)
      {
         //$confirmPasserr="Password Doesn't match";
          throw new Exception("Passwords Doesn't match");
      }
      
    }
    catch (Exception $e) {
        $EditorconfirmPassErr=$e->getMessage();
        $signUp=false;    
    }
     try {
        
     if (empty($username))
        {
           //  $Unerr="Username is required";
             throw new Exception("Username is required");
        }
    if (strlen($username) < 4)
    {
        // $Unerr="Username should be more than 4 charachters";
        throw new Exception("Username should be more than 4 charachters");
    }
    
  }
  catch (Exception $e) {
    $EditorUnErr=$e->getMessage();
    $signUp=false;
    }

    try {
    
    if (empty($password))
    {
        // $Passerr="Please Fill Password";
        throw new Exception("Please Fill Password");
    }
    if (strlen($password) < 8)
    {
        //$Passerr="Password should be more than 8 charachters";
        throw new Exception("Password should be more than 8 charachters");
    }
   }
   catch (Exception $e) {
    $EditorPassErr=$e->getMessage();
    $signUp=false;
    }

    $js2= '<script>  
    document.getElementById("Editor").style.display="block";
    document.getElementById("Reader").style.display="none";
    document.getElementById("readerbtn").style.backgroundColor="rgb(59, 168, 231)";
    document.getElementById("readerbtn").style.color="black";
    document.getElementById("editorbtn").style.backgroundColor="black";
    document.getElementById("editorbtn").style.color=" rgb(59, 168, 231)";
    </script>';

    debug($signUp);
    if($signUp==true) 
    {
    $sql="INSERT INTO user(username,password,id,TypeID) VALUES ('".$username."','".$password."','". $ID ."','2')";
    mysqli_query($con,$sql);
    $_SESSION['username']=$username;
    $_SESSION['password']=$password;
    $_SESSION['userType']='Editor';
    echo "<script> location.replace('test.php'); </script>";
    }
}

$pathname = $_SERVER['REQUEST_URI'];
debug ($pathname);
debug($loggedIn);

if(isset($_POST['Login']) && $loggedIn)
{
    echo "<script> location.replace('test.php'); </script>";
    debug("if login loggedin");
}
else if ($pathname == "/Website/Signup.php" && $loggedIn)
{
    $js='<script> 
    $(".loggedindropdown").hide(); 
    $("#LoginSignUpcontainer").css("display","block"); 
    </script>';
    session_destroy();
}


?>

<div class="box">
    <div class="tabs">
<button class="tabtn" id="readerbtn" onclick="openTab('readerbtn','Reader')"> <b>Reader</b></button>
<button class="tabtn" id="editorbtn" onclick="openTab('editorbtn','Editor')"> <b>Editor</b> </button>
</div>

<div id="Reader" class="content" style="display: block">

    <form enctype="multipart/form-data" method="POST" action="" id="form" >
        <span>Username</span>  <br>
        <input type="text" name="regusername" class="regtxt" id="rdrUntxt" placeholder="Username..."> <b class="error"> <?php echo $Unerr;  ?> </b> <br>
        <span> Password </span> <br>
        <input type="password" name="regpassword" class="regtxt" id="rdrpasstxt" placeholder="Password..."> <b class="error"> <?php echo $Passerr; ?> </b> <br> 
        <span> Confirm Password </span> <br>
        <input type="password" name="confirmPassword" class="regtxt" id="rdrconfirmpasstxt" placeholder="Confirm Password..."> <b class="error"> <?php echo $confirmPasserr; ?> </b> <br> 
        <span> Upload a copy of your ID/Passport </span> <br>
        <input type="file" name="idFile" id="file"/> <b class="error"> <?php echo $IDerr; ?> </b> <br><br>
        <input type="submit" value="Register" name="Readerbtn" id="reader" class="registerBtn"><br>
        
    </form>
</div>

<div id="Editor" class="content" >
    <form method="POST" action="">
        <span>Username</span> <br>
        <input type="text" name="regusername" class="regtxt" placeholder="Username..."> <b class="error"> <?php echo $EditorUnErr;  ?> </b> <br>
        <span> Password </span> <br>
        <input type="password" name="regpassword" class="regtxt" placeholder="Password..."> <b class="error"> <?php echo $EditorPassErr;  ?> </b> <br> 
        <span> Confirm Password </span> <br>
        <input type="password" name="confirmPassword" class="regtxt" placeholder="Confirm Password..."> <b class="error"> <?php echo $EditorconfirmPassErr;  ?> </b> <br> <br>
        <input type="submit" value="Register" name="Editorbtn" id="editor" class="registerBtn"><br>
       
    </form>
</div>

</div>

<?php echo $js2 ; echo $js; ?>

</body>


<script>

function openTab(btnId,contentclass)
{
  var i , contents ;
  contents= document.getElementsByClassName("content");
  if (btnId=='readerbtn') {
  document.getElementById('editorbtn').style.backgroundColor=" rgb(59, 168, 231)";
  document.getElementById('editorbtn').style.color=" black";
  document.getElementById('Editor').style.display="none";
  }
  if (btnId=='editorbtn') {
   document.getElementById('readerbtn').style.backgroundColor=" rgb(59, 168, 231)";
   document.getElementById('readerbtn').style.color=" black";
   document.getElementById('Reader').style.display="none";
  }
  document.getElementById(contentclass).style.display="block";
  document.getElementById(btnId).style.backgroundColor="black";
  document.getElementById(btnId).style.color=" rgb(59, 168, 231)";    
}
</script>
</html>
<?php
//  include("redirector.php"); 
$con = mysqli_connect("localhost", "root", "", "users");
$term =  $_POST['term'];
$sql = "SELECT `ID`,`Article_title`,`image` FROM `articles` 
        WHERE `Article_title`LIKE '%".$term."%' LIMIT 0,5 ";
        // echo $sql;
$result=mysqli_query($con,$sql);

if(!empty($term)){
    
        while($row=mysqli_fetch_array($result))
                 {
                   
                        echo"<li >"."<a href= 'javascript: submitform(".$row['ID'].");' ><img style='margin-left:-50px;color:black' 
                         src = 'data: image/jpg; base64, ".base64_encode($row["image"])."' height ='20px' width = '25px' />
                         "."<span>".$row['Article_title']."</span></a>". "</li>";
                    
                  
                 }
                 
    }
// close connection
mysqli_close($con);
?>

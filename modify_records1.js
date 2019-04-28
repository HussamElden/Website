function edit_row(id) //13
{

   var comment=document.getElementById("Comment_val"+id).innerHTML;
 document.getElementById("Comment_val"+id).innerHTML= 
   "<input style=color:red; type='text' id='Comment_text"+id+"'value='"+comment+"'>";
   document.getElementById("delete_button"+id).style.display = "none";
  document.getElementById("edit_button"+id).style.display="none";
  document.getElementById("save_button"+id).style.display="block";


};


function save_row(id)
{
 var comment=document.getElementById("Comment_text"+id).value;

if(comment == ""){

    alert("You have to write something");
}

else if(comment == " "){

    alert("You have to write something");
}


 //console.log("Console.log in save function")

// alert(comment);
else {
$.ajax({
  type:"post",
  url:"modify_records1.php",
  data:{
   id:id,
  comment:comment
     }, 
  success:function(response)
   {
  
      console.log("Success triggered");

    document.getElementById("Comment_val"+id).innerHTML=comment;
    document.getElementById("edit_button"+id).style.display="block";
    document.getElementById("delete_button"+id).style.display="block";
    document.getElementById("save_button"+id).style.display="none";
  
  }, 
  error:function(error){
  console.log(error);
}



 });
}
}
function delete_row(id)
{

$.ajax({
  type:"post",
  url:"delete_records1.php",
  data:{
   id:id,
  }, 
  success:function(response)
   {

document.getElementById("Comment_val"+id).style.display= "none";
    document.getElementById("edit_button"+id).style.display="none";
    document.getElementById("delete_button"+id).style.display="none";
    document.getElementById("img"+id).style.display="none";
    document.getElementById("usern"+id).style.display="none";
      
  }, 
  error:function(error){
  console.log("error triger");
}


 });
}
//;

 <?php
    ini_set('display_errors','off');
    if(isset($_FILES['image'])){
       $file_name = $_FILES['image']['name'];
       $file_size = $_FILES['image']['size'];
       $file_tmp = $_FILES['image']['tmp_name'];
       $file_type = $_FILES['image']['type'];
       $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
        $path = "CV/".$file_name;
        move_uploaded_file($file_tmp,$path);
   }
?>
<html>
    
    <head>
    <title>CV</title>
    </head>
    <body>
    <h1>Test ajout CV (pdf) pour le bonus</h1>

      <form action = "" method = "POST" enctype = "multipart/form-data">
         <input type = "file" name = "image" />
         <input type = "submit"/>
			
         <ul>
            <li>nom: <?php echo $_FILES['image']['name'];  ?>
            <li>taille: <?php echo $_FILES['image']['size'];  ?>
            <li>type: <?php echo $_FILES['image']['type'] ?>
         </ul>
			
      </form>
    
      
   </body>
</html>
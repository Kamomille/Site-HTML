<?php 
    include 'database.php';
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $id=intval($_GET['id']);
        $res = mysqli_query($connect,"SELECT * FROM authentification where id=$id;");
        $res = mysqli_fetch_assoc($res);
        
        
        echo '<form method="post" action="gestionSalarié.php">';
                echo '<table>';
                foreach($res as $key => $val){
                    echo'<tr>'
                       ."<td>$key</td>"
                       ."<td><input type='text' name='$key' value='$val'></td>"
                    .'</tr>'
                    .'<br/>';
                }
                echo '</table>';
                echo"<td><input type='submit'></td>";
                echo'</form>'
 ?>
    </body>
</html>

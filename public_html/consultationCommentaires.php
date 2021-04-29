 <?php
    include 'database.php';
    $check=false;

    if ($_POST!=NULL){
        
        foreach ($_POST as $key => $val){
            if($val=='supprimer'){
                $check=true;
            }
            break;
        }
        
        if ($check=true){
            foreach ($_POST as $key => $val){
                mysqli_query($connect,"DELETE FROM commentaire WHERE id=$key");   
            }
        }            
    }
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
    $sql="SELECT commentaire.id,nom,prenom,objet,message FROM commentaire JOIN authentification on authentification.id=personne ORDER BY commentaire.id DESC;";
    $res = mysqli_query($connect,$sql);
    $res = mysqli_fetch_all($res);
    var_dump($res);
    ?>
        <table border="1">
            <tr>
                <td>Sélection</td>
                <td>Autheur</td>
                <td>Objet</td>
                <td>Message</td>

                <td>Suppression</td>
            </tr>
<?php

            echo '<form action="consultationCommentaires.php" method="post">';
                foreach($res as $commentaire){
                
                    echo '<tr>';
                        echo "<td><input type='checkbox' name='$commentaire[0]' value='$commentaire[0]'</td>";
                        for($i=1;$i<sizeof($commentaire);$i++){
                            echo "<td>$commentaire[$i]</td>";
                        }
                        echo"<td><input type='submit' value='supprimer' name='$commentaire[0]'></td>";
                    echo '</tr>';
            }
        echo '</table>';
    echo '</form>';
?>
    </body>
</html>

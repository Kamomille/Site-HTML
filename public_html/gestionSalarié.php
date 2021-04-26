<!DOCTYPE html>
 <?php
    include 'database.php';
 ?>
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
    $res = $database-> query("SELECT mail,nom,prenom,fonction,contrat FROM authentification;");
    $res =$res->fetchall();
    ?>
        <table border="1">
            <tr>
                <td>Adresse mail</td>
                <td>Nom</td>
                <td>Prénom</td>
                <td>Fonction</td>
                <td>Type Contrat</td>
                <td>Modification</td>
                <td>Suppression</td>
            </tr>
<?php
            foreach($res as $personne){
                echo '<tr>';
                for($i=0;$i<sizeof($personne)/2;$i++){
                    echo"<td>$personne[$i]</td>";
                }
                echo"<td><a href=modification.php>Modification</a></td>";
                echo"<td><a href=suppression.php>Supression</a></td>";
                echo '</tr>';
            }
            
?>

    
        </table>

    </body>
</html>

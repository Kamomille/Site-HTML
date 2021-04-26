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
    $res = mysqli_query($connect,"SELECT id,mail,nom,prenom,fonction,contrat FROM authentification;");
    $res = mysqli_fetch_all($res);
    ?>
        <table border="1">
            <tr>
                <td></td>
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
                echo '<form action="gestionSalarié.php">';
                echo '<tr>';
                echo '<td><input type="checkbox" name="selection" id="$personne[0]"value="$personne[0]"/></td>';
                for($i=1;$i<sizeof($personne);$i++){
                    echo"<td>$personne[$i]</td>";
                }
                echo"<td><input type='submit' name=modification value='modification'></td>";
                echo"<td><input type='submit' name=supprimer value='supprimer'></td>";
                echo '</tr>';
                echo '</form>';
            }
            print_r($_POST)
            
?>

    
        </table>

    </body>
</html>

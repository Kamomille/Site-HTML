<!DOCTYPE html>
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
                mysqli_query($connect,"DELETE FROM authentification WHERE id=$key");   
            }
        }
        
        else {
            $id=intval($_POST['id']);
            foreach ($_POST as $key => $val){
                if ($val!=NULL){
                    mysqli_query($connect,"UPDATE authentification SET $key='$val' where id=$id");
                }
                
            }
            
        }
    }
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
    $res = mysqli_query($connect,"SELECT id,mail,nom,prenom,fonction,contrat,contratDurée_mois,embauche,congésRTT,congésPayés FROM authentification;");
    $res = mysqli_fetch_all($res);
    ?>
        <table border="1">
            <tr>
                <td>Sélection</td>
                <td>Adresse mail</td>
                <td>Nom</td>
                <td>Prénom</td>
                <td>Fonction</td>
                <td>Type Contrat</td>
                <td>Durée du contrat(mois)</td>
                <td>date d'embauche</td>
                <td>Congés RTT</td>
                <td>Congés payés</td>
                <td>Modification</td>
                <td>Suppression</td>
            </tr>
<?php
            echo '<form action="gestionSalarié.php" method="post">';
                foreach($res as $personne){
                
                    echo '<tr>';
                        echo "<td><input type='checkbox' name='$personne[0]' value='$personne[0]'</td>";
                        for($i=1;$i<sizeof($personne);$i++){
                            echo "<td>$personne[$i]</td>";
                        }
                        echo"<td><a href='http://localhost/projetSite_HTML/public_html/gestionSalarié_modifier_ajouter.php?id=$personne[0]'>Modifier</a></td>";
                        echo"<td><input type='submit' value='supprimer' name='$personne[0]'></td>";
                    echo '</tr>';
            }
            echo '<tr>';
            echo"<td><a href='http://localhost/projetSite_HTML/public_html/gestionSalarié_modifier_ajouter.php?id=0'>Ajouter</a></td>";
            echo '</tr>';
        echo '</table>';
    echo '</form>';
?>

    </body>
</html>

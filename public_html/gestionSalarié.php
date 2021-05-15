<!DOCTYPE html>
<?php
    session_start();
    include 'database.php';
    $check=false;

    if ($_POST!=NULL){
        
        foreach ($_POST as $key => $val){
            if($val=='supprimer'){
                $check=true;
            }
            break;
        }
        
        if ($check==true){
            foreach ($_POST as $key => $val){
                $req="DELETE FROM authentification WHERE id=?";
                $res= mysqli_prepare($connect, $req);
                $var= mysqli_stmt_bind_param($res,'s', $key);
                $var= mysqli_execute($res); 
                mysqli_stmt_close($res);
            }
        }
        
        else {
            $id=intval($_POST['id']);
            foreach ($_POST as $key => $val){
                if ($val!=NULL){
                    $req="UPDATE authentification SET ?=? where id=?";
                    $res= mysqli_prepare($connect, $req);
                    $var= mysqli_stmt_bind_param($res,'ssi', $key,$val,$id);
                    $var= mysqli_execute($res); 
                    mysqli_stmt_close($res);
                    
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
        
        $req="SELECT id,identifiant,nom,prenom,fonction,contrat,contratDuree_mois,embauche,congesRTT,congesPayes FROM authentification WHERE (fonction='enseignant' OR fonction='administration');";
        $result = mysqli_prepare($connect,$req);
        $var=mysqli_execute($result);
        mysqli_stmt_bind_result($result,$id,$identifiant,$nom,$prenom,$fonction,$contrat,$contratDuree_mois,$embauche,$congesRTT,$congesPayes);
        
        $res=[];

        while (mysqli_stmt_fetch($result)){
            $row=[strval($id),$identifiant,$nom,$prenom,$fonction,$contrat, strval($contratDuree_mois),$embauche,strval($congesRTT),strval($congesPayes)];
            array_push($res,$row);
    
        }
        
        
        mysqli_stmt_close($result);
        mysqli_close($connect);
        
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
<?php
                if ($_SESSION['role']=='Directeur'){
                    echo "<td>Modification</td>"
                    ."<td>Suppression</td>";
                }
?>
            </tr>
<?php
            
            echo '<form action="gestionSalarié.php" method="post">';
                foreach($res as $personne){
            
                    echo '<tr>';
                        echo "<td><input type='checkbox' name='$personne[0]' value='$personne[0]'</td>";
                        for($i=1;$i<sizeof($personne);$i++){
                            echo "<td>$personne[$i]</td>";
                        }
                        if ($_SESSION['role']=='Directeur'){
                            echo"<td><a href='http://localhost/projetSite_HTML/public_html/gestionSalarié_modifier.php?id=$personne[0]'>Modifier</a></td>";
                            echo"<td><input type='submit' value='supprimer' name='$personne[0]'></td>";
                        }
                    echo '</tr>';
            }
            if ($_SESSION['role']=='Directeur'){
                echo '<tr>';
                echo"<td><a href='http://localhost/projetSite_HTML/public_html/gestionSalarié_ajouter.php?id=0'>Ajouter</a></td>";
                echo '</tr>';
            }

        echo '</table>';
    echo '</form>';
?>

    </body>
</html>

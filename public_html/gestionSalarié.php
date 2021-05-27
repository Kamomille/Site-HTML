<!DOCTYPE html>
<?php
    session_start();
    include 'database.php';
    $check=false;

    if ($_POST!=NULL){
        
        foreach ($_POST as $key => $val){
            
            if($val=='supprimer'){
                echo"oui";
                $check=true;
                break;
            }
            
        }
        
        if ($check==true){
            echo"oui";
            foreach ($_POST as $key => $val){
                
                $req="DELETE FROM commentaire WHERE (personne=? OR destinataire=?)";
                $res= mysqli_prepare($connect, $req);
                $var= mysqli_stmt_bind_param($res,'ii', $key,$key);
                $var= mysqli_execute($res); 
                mysqli_stmt_close($res);
                
                $req="DELETE FROM congé WHERE personne=?";
                $res= mysqli_prepare($connect, $req);
                $var= mysqli_stmt_bind_param($res,'i', $key);
                $var= mysqli_execute($res); 
                mysqli_stmt_close($res);
                
                $req="DELETE FROM authentification WHERE id=?";
                $res= mysqli_prepare($connect, $req);
                $var= mysqli_stmt_bind_param($res,'i', $key);
                $var= mysqli_execute($res); 
                mysqli_stmt_close($res);
            
            }
        }
        
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="page.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <header>
            <img src="image\Esme_logo.png" class='esme'>     
            <h1 class="accueil">Gestion salariés</h1>  
            <img src="image\devise.jpg" class="devise">
        </header>
        
        <?php
        include("haut_page.php");
        
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
                <?php if ($_SESSION['role']=='directeur') echo '<th>Sélection</th>';?>
                
                <th>id</th>
                <th>Adresse mail</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Fonction</th>
                <th>Type Contrat</th>
                <th>Durée du contrat(mois)</th>
                <th>date d'embauche</th>
                <th>Congés RTT</th>
                <th>Congés payés</th>
<?php
                if ($_SESSION['role']=='directeur'){
                    echo "<th colspan=3>Opération</th>";

                }
?>
            </tr>
<?php
            
            echo '<form action="gestionSalarié.php" method="post">';
                foreach($res as $personne){
            
                    echo '<tr class="table">';
                    if($_SESSION['role']=='directeur'){
                        echo "<td class='table'><input type='checkbox' name='$personne[0]' value='$personne[0]'</td>";
                    }
                        for($i=0;$i<sizeof($personne);$i++){
                            echo "<td  class='table'>$personne[$i]</td>";
                        }
                        if ($_SESSION['role']=='directeur'){
                            echo"<td class='table'><a href='http://localhost/projetSite_HTML/public_html/gestionSalarié_modifier.php?id=$personne[0]'>Modifier</a></td>";
                            echo"<td class='table'><input type='submit' value='supprimer' name='$personne[0]'></td>";
                            echo"<td class='table'><a href='http://localhost/projetSite_HTML/public_html/CVcode/consultationCV.php?id=$personne[0]' class='table'>Afficher CV</a></td>";
                        }
                    echo '</tr>';
            }
            if ($_SESSION['role']=='directeur'){
                echo '<tr>';
                echo"<td colspan='14' class='table'><a href='http://localhost/projetSite_HTML/public_html/gestionSalarié_ajouter.php?id=0' class='table'>Ajouter</a></td>";
                echo '</tr>';
            }

        echo '</table>';
    echo '</form>';
?>

    </body>

    <?php include("pied_de_page.php"); ?>
    </body>
</html>
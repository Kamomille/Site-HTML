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
        
        if ($check=true){
            foreach ($_POST as $key => $val){
                mysqli_query($connect,"DELETE FROM commentaire WHERE id=$key");   
            }
        }            
    }
 ?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
    if ($_SESSION['role']=="Salarié"){
        $id=$_SESSION['id'];
        $sql="SELECT commentaire.id,personne,nom,prenom,mail,objet,message FROM commentaire JOIN authentification on authentification.id=personne WHERE authentification.id=$id ORDER BY commentaire.id DESC;";
        $res = mysqli_query($connect,$sql);
   
        if (mysqli_num_rows($res)>0){
            $res = mysqli_fetch_all($res);
            
            echo '<table border="1">'
                .'<tr>'
                    .'<td>Sélection</td>'
                    .'<td>Id</td>'
                    .'<td>Prénom</td>'
                    .'<td>Nom</td>'
                    .'<td>Mail</td>'
                    .'<td>Objet</td>'
                    .'<td>Message</td>'
                    .'<td>Supprimer</td>'
                    .'<td>Répondre</td>'
                .'</tr>';

                echo '<form action="consultationCommentaires.php" method="post">';
                    foreach($res as $commentaire){

                        echo '<tr>';
                            echo "<td><input type='checkbox' name='$commentaire[0]' value='$commentaire[0]'</td>";
                            for($i=1;$i<sizeof($commentaire);$i++){
                                echo "<td>$commentaire[$i]</td>";
                            }
                            echo"<td><input type='submit' value='supprimer' name='$commentaire[0]'></td>";
                            echo"<td><input type='submit' value='répondre' name='$commentaire[0]'></td>";
                        echo '</tr>';
                }
            echo '</table>';
            echo '</form>';
        }
    }
        
    else {

       $sql="SELECT commentaire.id,personne,nom,prenom,mail,objet,message FROM commentaire JOIN authentification on authentification.id=personne ORDER BY commentaire.id DESC;";
       $res = mysqli_query($connect,$sql);

       if (mysqli_num_rows($res)>0){

       $res = mysqli_fetch_all($res);


       echo '<table border="1">'
           .'<tr>'
               .'<td>Sélection</td>'
               .'<td>Id</td>'
               .'<td>Prénom</td>'
               .'<td>Nom</td>'
               .'<td>Mail</td>'
               .'<td>Objet</td>'
               .'<td>Message</td>'
               .'<td>Supprimer</td>'
               .'<td>Répondre</td>'
           .'</tr>';

           echo '<form action="consultationCommentaires.php" method="post">';
               foreach($res as $commentaire){

                   echo '<tr>';
                       echo "<td><input type='checkbox' name='$commentaire[0]' value='$commentaire[0]'</td>";
                       for($i=1;$i<sizeof($commentaire);$i++){
                           echo "<td>$commentaire[$i]</td>";
                       }
                       echo"<td><input type='submit' value='supprimer' name='$commentaire[0]'></td>";
                       echo"<td><a href='http://localhost/projetSite_HTML/public_html/contact.php?objet=$commentaire[5]'>Répondre</a></td>";
                   echo '</tr>';
               }
           echo '</table>';
           echo '</form>';  
       }
    }
?>
    </body>
</html>

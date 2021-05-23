
<html>
  <head>
    <title>CV</title>
    </head>
    <body>  
    <?php
    $id=$_GET['id'];
    include 'database.php';
    if($connect) {
        $req="SELECT CV FROM authentification WHERE id=$id;";
        $resultat = mysqli_prepare($connect,$req);
        mysqli_stmt_bind_result($resultat,$CV);
        $var= mysqli_execute($resultat);
        if($resultat == false) echo "Echec de l'exécution de la requête";
        else {
            while ( mysqli_stmt_fetch($resultat)){
                //$nomVar = "CV/".$id.".".$CV;
                $nomVar = "CV/".$CV;
            }
        }
        mysqli_stmt_close($resultat);
    }
    echo '<h1>CV de l\'employé numéro '.$id.'</h1>';
    ?>
    
    <iframe src="<?= $nomVar  ?>" width="100%" height="600px"></iframe>
  </body>
</html>
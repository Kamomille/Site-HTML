
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="afficher_CV.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <header>
            <img src="..\image\Esme_logo.png" class='esme'>     
            <h1 class="accueil">Gestion des congés</h1>  
            <img src="..\image\devise.jpg" class="devise">
        </header>
        <nav>
            <a class="nav" href="http://localhost/projetSite_HTML/public_html/menu.php">Menu</a>
            <a class="nav" href="http://localhost/projetSite_HTML/public_html/contact.php">Contact</a>
            <a class="nav" href="http://localhost/projetSite_HTML/public_html/consultationCommentaire_salarie.php">Commentaire</a>
            <a class="nav" href="http://localhost/projetSite_HTML/public_html/gestionProfil.php">Gestion de profil</a>
            <a class="nav" href="http://localhost/projetSite_HTML/public_html/gestionSalari%C3%A9.php">Gestion de salariés</a>
            <a class="nav" href="http://localhost/projetSite_HTML/public_html/gestionConges_salaries.php">Gestion de congé</a>
            <a class="nav" href="http://localhost/projetSite_HTML/public_html/deconnexion.php">Déconnexion</a>
        </nav>

        <body>  
        <?php
        $id=$_GET['id'];
        include '..\database.php';
        if($connect) {
            $req="SELECT CV FROM authentification WHERE id=$id;";
            $resultat = mysqli_prepare($connect,$req);
            mysqli_stmt_bind_result($resultat,$CV);
            $var= mysqli_execute($resultat);
            if($resultat == false) echo "Echec de l'exécution de la requête";
            else {
                while ( mysqli_stmt_fetch($resultat)){
                    $nomVar = "../CV/".$CV;
                }
            }
            mysqli_stmt_close($resultat);
        }
        if (strcmp($CV, '') == 0){
            echo '<h1>Le CV de l\'employé n\'est pas posté</h1>';
        }
        else {
            echo '<h1>CV de l\'employé numéro '.$id.'</h1>';
        }?>

            <iframe src="<?= $nomVar  ?>" width="100%" height="600px"></iframe>
      </body>


    </nav>
        </br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
    </body>
        </br></br><footer>
        <div class="footerinfo">
            <h5>À PROPOS DE L'ESME SUDRIA</h5>
            <p>Fondée en 1905, l’école d'ingénieurs ESME Sudria forme en 5 ans des ingénieurs pluridisciplinaires, prêts à relever les défis technologiques du XXIe siècle : la transition énergétique, les véhicules autonomes, la robotique, les réseaux intelligents, les villes connectées, la cyber sécurité, et les biotechnologies.Trois composantes font la modernité de sa pédagogie : l’importance de l’esprit d’innovation ; l’omniprésence du projet et de l’initiative ; une très large ouverture internationale, humaine et culturelle. Depuis sa création, près de 15 000 ingénieurs ont été diplômés. L'école délivre un diplôme reconnu par l'Etat et accrédité par la CTI.</p>
        </div>
        <ul>
            <li>contact@esme.fr</li>
            <li>01 56 20 62 00</li>
        </ul>
    </footer>
</html>
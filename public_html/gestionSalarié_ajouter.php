<?php 
    include 'database.php';
?>
<!DOCTYPE html>

<?php 
$erreur="";
foreach($_GET as $key =>$val){
    if ($val=="erreur") $erreur=$erreur.$key."," ;
}
if ($erreur!=""){
    $erreur=substr($erreur,0,-1);
    echo "<script>alert(\"Les champs $erreur sont incorrectes\")</script>";
}    
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="gestionSalarié_modifier_ajouter.css">
    </head>
    <body>
        <nav>
            <a href="http://localhost/projetSite_HTML/public_html/menu.php">Menu</a>
            <a href="http://localhost/projetSite_HTML/public_html/contact.php">Contact</a>
            <a href="http://localhost/projetSite_HTML/public_html/consultationCommentaire.php">Commentaire</a>
            <a href="http://localhost/projetSite_HTML/public_html/gestionProfil.php">Gestion de profil</a>
            <a href="http://localhost/projetSite_HTML/public_html/gestionSalari%C3%A9.php">Gestion de salariés</a>
            <a href="http://localhost/projetSite_HTML/public_html/gestionConges_salaries.php">Gestion de congé</a>
            <a href="http://localhost/projetSite_HTML/public_html/index.html">Déconnexion</a>

        </nav>
        <br>
        


<!-- ============================================================================ -->
<!--                                  Formulaire                                  -->
<!-- ============================================================================ -->

         <form method="post" action="gestionSalarié_vérification.php"  enctype = "multipart/form-data">

             <div class="CV">
                 <h2>CV</h2>
                 <label ><strong>Ajouter un CV</strong> </label>
                 <input type = "file" name = "image" />
                 <br><br> 
            </div>
             
            <div class="EtatCivil">
                <h2>Etat civil</h2>
                
                <label ><strong>Nom</strong> </label>
                <input type="text" name="nom" id="idtextnom" placeholder="Mon nom" required/>
                </br><label for="idLine">___________________________________________________________</label>
                
                <br><br>
                
                <label ><strong>Prénom</strong> </label>
                <input type="text" name="prenom" id="idtextnom" placeholder="Mon prénom" required/>  
                </br><label for="idLine">___________________________________________________________</label>
                
                <br><br>    
                
                <label ><strong>Nationalité</strong> </label>
                <input type="text" name="nationalite" id="idnationalité" placeholder="Ma nationalité" />
                </br><label for="idLine">___________________________________________________________</label>
                
                <br><br>     
                    
                <label ><strong>Age</strong> </label>
                <input type="text" name="age" id="idage" placeholder="Mon age" />  
                </br><label for="idLine">___________________________________________________________</label>
                
                <br><br>   
                
                <label for="idsexe" ><strong>sexe</strong> </label>
                <input type="radio" name="sexe" value="homme" />
                <label for="idsexe">homme </label>
                <input type="radio" name="sexe" value="femme" />
                <label for="idsexe">femme </label>
                <input type="radio" name="sexe" value="autre" checked/>
                <label for=idsexe>autre</label>
                
                <br><br>
                
                <label><strong>situation familiale</strong></label>
                <select name="situationFamiliale" >
                    <option value=></option>
                    <option value="pacsé">pacsé</option>
                    <option value="marié">marié</option>
                    <option value="célibataire">célibataire</option>
                    <option value="divorcé">divorcé</option>
                </select>
                
                <br><br>
                
            </div>
            
            <div class="Contact">
                <h2>Contact</h2>

                
                <label><strong>Adresse postale</strong> </label>
                </br></br><label><strong>Code postale</strong> </label>
                <input type='text' name='codePostal' placeholder='94200'>  
                </br><label for='idLine'>___________________________________________________________</label>
                </br><label><strong>Ville</strong> </label>
                <input type='text' name='Ville' placeholder='Ivry'>  
                </br><label for='idLine'>___________________________________________________________</label>
                </br><label><strong>Rue</strong> </label>
                <input type='text' name='Rue' placeholder='18 rue Molière'>  
                </br><label for='idLine'>___________________________________________________________</label>
                
                <br><br>
                
                <label for="idtéléphone"><strong>Téléphone</strong> </label>
                <input type="text" name="telephone" id="idTéléphone" placeholder="Mon numéro de téléphone" required/>
                </br><label for="idLine">___________________________________________________________</label>
                
                <br><br>
                
                
            </div>
         <div class="Fonction">
                <h2>Fonction</h2>
                <label><strong>Contrat</strong></label>
                <br><br>
                <label>CDD </label>
                <input type="radio" name="contrat" value="CDD" required/>
                <label>CDI </label>
                <input id="idCDI" type="radio" name="contrat" value="CDI" required/>
                </br></br>
                <label id=contrat ><strong>Durée du contrat en mois</strong> </label>
                <input type='text' name='contratDuree_mois' id='idcontrat' placeholder='Durée du contrat' required>
                </br><label for='idLine'>___________________________________________________________</label>
                
                <br><br>
                
                <label for="idfonction"><strong>Fonction :</strong> </label>
                <input type="radio" name="fonction" value="enseignant"  required/>  
                <label for="idfonction">Enseignant </label>
                <input type="radio" name="fonction" value="administration"  required/>
                <label for="idfonction">Personnel administratif</label>
                
                <br><br>
                
                <label for="idembauche"><strong>Date d\embauche</strong></label>
                <input type="date" name="embauche" id="idembauche"/>   
                
                <br><br>
                
            </div>
            <div>
                
                <input type="submit" name="Envoyer" id="idsubmit" class="submit"/>
            </div>
        </form>
        
    </body>
</html>
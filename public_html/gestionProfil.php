<?php 
session_start() ;
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="gestionProfil.css">
    </head>
    <body>
        <header>
            <img src="image\Esme_logo.png" class="esme">
            <h1 class="titre">Gestion de congé</h1>
        </header>
        <nav>
            <a href="contact.html">Contactez-nous</a>
            <a href="particulier.html">Particuliers</a> 
        </nav>
        <div class="mainLayout">
            <h1>nom prenom - Informations personnelles</h1>
            <table class="infoPerso">
                <tr>
                    <td>nom</td>
                    <td><?php echo $_SESSION['nom'] ?></td>
                </tr>
                <tr>
                    <td>prenom</td>
                    <td><?php echo $_SESSION['prenom'] ?></td>
                </tr>
                <tr>
                    <td>numéro de téléphone</td>
                    <td><?php echo $_SESSION['tel'] ?></td>
                </tr>
                <tr>
                    <td>mail</td>
                    <td><?php echo $_SESSION['mail'] ?></td>
                </tr>
                <tr>
                    <td>contrat</td>
                    <td><?php echo $_SESSION['contrat'] ?></td>
                </tr>
                <tr>
                    <td>adresse</td>
                    <td><?php echo $_SESSION['adresse'] ?></td>
                </tr>
                <tr>
                    <td>situation familliale</td>
                    <td><?php echo $_SESSION['situationFamiliale'] ?></td>
                </tr>
                <tr>
                    <td>âge</td> 
                    <td>$_SESSION['age']</td>
                </tr>

            </table>
        </div>
                


        
        <div>
            
        </div>
    </body>
</html>

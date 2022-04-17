<?php 
    session_start();
    require_once 'config.php'; // ajout connexion bdd 
   // si la session existe pas soit si l'on est pas connecté on redirige
    if(!isset($_SESSION['user'])){
        header('Location:index.php');
        die();
    }

    // On récupere les données de l'utilisateur
    $req = $bdd->prepare('SELECT * FROM utilisateurs WHERE token = ?');
    $req->execute(array($_SESSION['user']));
    $data = $req->fetch();  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des établissements</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;400&display=swap" rel="stylesheet">
</head>
<body>   
    <header>
        <img id="logo" src="medias/logo-hypnos.png">
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="etablissements.php">Etablissements</a></li> <!--admin-->
                <li><a href="suites.php">Suites</a></li> <!--gérants-->
                <li><a href="nos-suites.php">Nos suites</a></li> <!--catalogue-->
                <li><a href="reservations.php">Réservations</a></li>   <!--afficher?-->
                <li><a href="mes-reservations.php">Mes réservations</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <article>
            <section id="organizationList">
                <h2>Liste des établissements</h2>
                <div id="organizationOne">
                    <h3><a href="suitesE1.html">Hypnos Hotel</a></h3>
                    <img id="oOP1" src="medias/oop1.jpg">
                    <p>Adresse : 22 Rue D'arras, 62140 Hesdin, France</p><br/>
                    <p>L'Hypnos Hotel est situé au cœur d'Hesdin, dans le Nord Pas-de-Calais. 
                    Il propose un hébergement avec une salle de bains privative, un jardin et une connexion Wi-Fi gratuite.</p>
                    <p>Réservation via Booking : <a href="https://www.booking.com/hotel/fr/les-flandres.fr.html?aid=318615;label=New_French_FR_FR_21427174465-Pk3jEylX2FWP%2An3y4lDZiQS84604474585%3Apl%3Ata%3Ap1%3Ap2%3Aac%3Aap%3Aneg;sid=338ebb986e5869eb9d7e9dc90875713e;dest_id=-1432014;dest_type=city;dist=0;group_adults=2;group_children=0;hapos=1;hpos=1;no_rooms=1;req_adults=2;req_children=0;room1=A%2CA;sb_price_type=total;sr_order=popularity;srepoch=1650117430;srpvid=d4b2621ae6b50122;type=total;ucfs=1&#hotelTmpl">Hypnos hotel</a></p>
                </div>
                <div id="organizationTwo">
                    <h3><a href="suitesE2.html">Au bois dormant</a></h3>
                    <img id="oTP1" src="medias/otp1.jpg">
                    <p>Adresse : 8 rue du 8 Mai 1945, 62140 Huby-Saint-Leu, France</p>
                    <p>Les chambres comprennent un coin salon avec une télévision ainsi qu'une salle de bains privative pourvue d'un sèche-cheveux, 
                    d'articles de toilette gratuits et d'une douche. Vous disposerez d'un micro-ondes, d'un réfrigérateur et d'une bouilloire.</p>
                    <p>Réservation via Booking : <a href="https://www.booking.com/hotel/fr/au-bois-dormant-huby-saint-leu.fr.html?aid=318615&label=New_French_FR_FR_21427174465-Pk3jEylX2FWP*n3y4lDZiQS84604474585%3Apl%3Ata%3Ap1%3Ap2%3Aac%3Aap%3Aneg&sid=338ebb986e5869eb9d7e9dc90875713e&dest_id=-1432014&dest_type=city&dist=0&group_adults=2&group_children=0&hapos=4&hpos=4&no_rooms=1&req_adults=2&req_children=0&room1=A%2CA&sb_price_type=total&sr_order=popularity&srepoch=1650115521&srpvid=bb7a5e5ff9780015&type=total&ucfs=1&activeTab=main">Au Bois Dormant</a></p>
                </div>
            </section>
            <section id="organizationForm">
                <h2>Ajouter un établissement</h2>
                <form action="Class/etablissement.php" method="post">
                    <p>Nom de l'établissement : <input type="text" required="required" name="organizationName" /></p>
                    <p>Ville de l'établissement : <input type="text" required="required" name="organizationCity" /></p>
                    <p>Adresse de l'établissement : <input type="text" required="required" name="organizationAdress" /></p>
                    <p>Description de l'établissement: <input type="text" required="required" name="organizationDescription" /></p>
                    <p><input type="submit" value="Enregistré"></p>
                </form>
            </section>
        </article>
        <article>
            <section id="managerList">
                <h2>Liste des gérants</h2>

            </section>
            <section id="managerForm">
                <h2>Ajouter un gérant</h2>
                <form action="Class/gerant.php" method="post">
                    <p>Nom du gérant : <input type="text" required="required" name="managerLastname" /></p>
                    <p>Prénom du gérant : <input type="text" required="required" name="managerFirstname" /></p>
                    <p>Adresse e-mail du gérant : <input type="text" required="required" name="managerEmail" /></p>
                    <p>Mot de passe du gérant : <input type="text" required="required" name="managerPassword" /></p>
                    <p><input type="submit" value="Enregistré"></p>
                </form>
            </section>
        </article>
    </main>

    <footer>
        <ul>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="cgu.php">Conditions générales d'utilisation</a></li>
        </ul>
    </footer>
</body>
</html>
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
    <title>Hypnos</title>
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
            <section>
                
            </section>
            <section>
                <p>
                    
                </p>
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
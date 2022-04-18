<?php 
    session_start();
    require_once 'config.php'; // ajout connexion bdd 
   // si la session existe pas soit si l'on est pas connecté on redirige
    if(!isset($_SESSION['user'])){
        header('Location:index.php');
        die();
    }

    // On récupere les données de l'utilisateur
    $req = $pdo->prepare('SELECT * FROM users WHERE token = ?');
    $req->execute(array($_SESSION['user']));
    $data = $req->fetch();  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hypnos Hotel</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;400&display=swap" rel="stylesheet">
</head>
<body>
    
    <header>
        <?php
            try {
                if($data['role'] === 3) {
                    require_once 'components/header3.php';
                } if($data['role'] === 2) {
                    require_once 'components/header2.php';
                } if($data['role'] === 1) {
                    require_once 'components/header1.php';}
                } catch (Exception $e) {
                    echo 'Exception reçue : ',  $e->getMessage('Veuillez vous connecter !');
                }
        ?>
    </header>

    <main>
        <article>
            <section>
                <h3>Hypnos Hotel</h3>
                <img id="oOP1" src="medias/oop1.jpg">
                <p>Adresse : 22 Rue D'arras, 62140 Hesdin, France</p><br/>
                <p>L'Hypnos Hotel est situé au cœur d'Hesdin, dans le Nord Pas-de-Calais. 
                Il propose un hébergement avec une salle de bains privative, un jardin et une connexion Wi-Fi gratuite.</p>
                <p>Réservation via Booking : <a href="https://www.booking.com/hotel/fr/les-flandres.fr.html?aid=318615;label=New_French_FR_FR_21427174465-Pk3jEylX2FWP%2An3y4lDZiQS84604474585%3Apl%3Ata%3Ap1%3Ap2%3Aac%3Aap%3Aneg;sid=338ebb986e5869eb9d7e9dc90875713e;dest_id=-1432014;dest_type=city;dist=0;group_adults=2;group_children=0;hapos=1;hpos=1;no_rooms=1;req_adults=2;req_children=0;room1=A%2CA;sb_price_type=total;sr_order=popularity;srepoch=1650117430;srpvid=d4b2621ae6b50122;type=total;ucfs=1&#hotelTmpl">Hypnos hotel</a></p>
                <img id="oOP2" src="medias/oop2.jpg">
                <img id="oOP3" src="medias/oop3.jpg">
                <img id="oOP4" src="medias/oop4.jpg">
            </section>
        </article>
        <article>
            <section>
                
            </section>
        </article>
    </main>

    <footer>
        <?php
            require_once 'components/footer.php';
        ?>
    </footer>
</body>
</html>
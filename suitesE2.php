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
    <title>Hypnos</title>
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
        <?php
                    if($data['role'] >= 2) {
                        require_once 'components/suitesE1_form.php';
                        } else {echo 'Bienvenue Au Bois Dormant !';}
            ?>
            <section>
                <h3>Au Bois Dormant</h3>
                <img id="oOP1" src="medias/otp3.jpg">
                <p>Adresse : 22 Rue D'arras, 62140 Hesdin, France</p>
                <p>L'Hypnos Hotel est situé au cœur d'Hesdin, dans le Nord Pas-de-Calais. 
                Il propose un hébergement avec une salle de bains privative, un jardin et une connexion Wi-Fi gratuite.</p>
            </section>
        </article>
        <article>
            <section>
                <h2>Nos suites</h2>
                <?php
                $sql = "SELECT * FROM bedrooms WHERE hostelId = '4'";
   
                try{
                $stmt = $pdo->query($sql);
                 
                if($stmt === false){
                    die("Erreur");
                }
                 
                }catch (PDOException $e){
                    echo $e->getMessage();
                }
                ?>
                <table>
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Photo</th>
                            <th>Description</th>
                            <th>Prix fixe à la nuit</th>
                            <th>Photos</th>
                            <th>Photos</th>
                            <th>Lien de réservation booking</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                        <tr>
                            <td><?php echo addslashes($row['bedroomname']); ?></td>
                            <td><?php echo addslashes($row['picture']); ?></td>
                            <td><?php echo addslashes($row['descript']); ?></td>
                            <td><?php echo addslashes($row['price']); ?></td>
                            <td><?php echo addslashes($row['prictureOne']); ?></td>
                            <td><?php echo addslashes($row['prictureTwo']); ?></td>
                            <td><a href="<?php echo addslashes($row['booking']); ?>">Lien de réservation Booking</a></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </section>
        </article>
        <article>
            <section>
                <h3>Suite Royale</h3>
                <img src="medias/otp4.jpg">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eu interdum ligula. 
                    In hac habitasse platea dictumst. In porta leo libero, ut convallis diam maximus at. 
                    Sed pretium, nibh sed bibendum eleifend, risus nisl volutpat sapien, nec tempor ligula felis ut est.
                </p>
                <p>Prix par nuit: 129 euros.</p>
                <img src="medias/jacuzzi.jpg">
                <img src="medias/petitdej.jpg">
                <a href="https://booking.com">Lien de réservation via Booking</a>
                <h3>Suite Impériale</h3>
                <img src="medias/oop4.jpg">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eu interdum ligula. 
                    In hac habitasse platea dictumst. In porta leo libero, ut convallis diam maximus at. 
                    Sed pretium, nibh sed bibendum eleifend, risus nisl volutpat sapien, nec tempor ligula felis ut est.
                </p>
                <p>Prix par nuit: 129 euros.</p>
                <img src="medias/jacuzzi.jpg">
                <img src="medias/petitdej.jpg">
                <a href="https://booking.com">Lien de réservation via Booking</a>
                <h3>Suite Présidentielle</h3>
                <img src="medias/otp2.jpg">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eu interdum ligula. 
                    In hac habitasse platea dictumst. In porta leo libero, ut convallis diam maximus at. 
                    Sed pretium, nibh sed bibendum eleifend, risus nisl volutpat sapien, nec tempor ligula felis ut est.
                </p>
                <p>Prix par nuit: 129 euros.</p>
                <img src="medias/jacuzzi.jpg">
                <img src="medias/petitdej.jpg">
                <a href="https://booking.com">Lien de réservation via Booking</a>
            </section>
        </article>
        <article>
            
        </article>
    </main>

    <footer>
        <?php
            require_once 'components/footer.php';
        ?>
    </footer>
</body>
</html>
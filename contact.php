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
            <section>
                
            </section>
            <section>
                <p>
                   
                </p>
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
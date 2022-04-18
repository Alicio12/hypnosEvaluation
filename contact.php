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
            <div class="login-form">
            <?php 
                if(isset($_GET['reg_err']))
                {
                    $err = htmlspecialchars($_GET['reg_err']);

                    switch($err)
                    {
                        case 'success':
                            ?>
                                <div class="alert alert-danger">
                                    <strong>Succès</strong> demande envoyée
                                </div>
                            <?php
                            break;
                        case 'email':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> email non valide
                            </div>
                        <?php
                        break;

                        case 'email_length':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> email trop long
                            </div>
                        <?php 

                    }
                }
                ?>
            
            <form action="contact_traitement.php" method="post">
                <h2 class="text-center">Nous contacter</h2>       
                <div class="form-group">
                    <input type="text" name="lastname" class="form-control" placeholder="Nom" required="required" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="text" name="firstname" class="form-control" placeholder="Prenom" required="required" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email" required="required" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="radio" name="subject" class="form-control" required="required" value="Je souhaite poser une réclamation">
                    <label for="Je souhaite poser une réclamation">Je souhaite poser une réclamation</label>
                </div>
                <div class="form-group">
                    <input type="radio" name="subject" class="form-control" required="required" value="Je souhaite commander un service supplémentaire">
                    <label for="Je souhaite commander un service supplémentaire">Je souhaite commander un service supplémentaire</label>
                </div>
                <div class="form-group">
                    <input type="radio" name="subject" class="form-control" required="required" value="Je souhaite en savoir plus sur une suite">
                    <label for="Je souhaite en savoir plus sur une suite">Je souhaite en savoir plus sur une suite</label>
                </div>
                <div class="form-group">
                    <input type="radio" name="subject" class="form-control" required="required" value="J’ai un souci avec cette application">
                    <label for="J’ai un souci avec cette application">J’ai un souci avec cette application</label>
                </div>
                <div class="form-group">
                    <input type="text" name="message" class="form-control" placeholder="Contenu de votre message" required="required" autocomplete="off">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Envoyer</button>
                </div>   
            </form>
        </div>
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
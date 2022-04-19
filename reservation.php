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
                }
                } catch (Exception $e) {
                    echo 'Exception reçue : ',  $e->getMessage('Veuillez vous connecter !');
                }
        ?>
    </header>

    <main>
        <article>
        <section id="hostelForm">
                <h2>Ajouter un hotel</h2>
                <div class="login-form">
                    <?php 
                        if(isset($_GET['reg_err']))
                        {
                            $err = htmlspecialchars($_GET['reg_err']);
                            switch($err)
                            {
                                    case 'success':
                                ?>
                                <div class="alert alert-success">
                                    <strong>Succès</strong> enregistrement réussi !
                                </div>
                                <?php
                                    break;
                                    case 'email_length':
                                ?>
                                <div class="alert alert-danger">
                                    <strong>Erreur</strong> nom trop long
                                </div>
                                <?php
                                    break;
                                    case 'description_length':
                                ?>
                                <div class="alert alert-danger">
                                    <strong>Erreur</strong> description trop longue
                                </div>
                                <?php
                            }
                        }
                    ?>
            
                    <form action="etablissement_traitement.php" method="post">       
                        <div class="form-group">
                            <input type="text" name="lastname" class="form-control" placeholder="Nom" required="required" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input type="text" name="firstname" class="form-control" placeholder="Prénom" required="required" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Email" required="required" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input type="text" name="hostelname" class="form-control" placeholder="Hypnos Hotel" required="required" value="Hypnos Hotel">
                        </div>
                        <div class="form-group">
                            <input type="radio" name="bedroomname" class="form-control" required="required" value="Suite Royale">
                            <label for="Suite Royale">Suite Royale</label>
                        </div>
                        <div class="form-group">
                            <input type="radio" name="bedroomname" class="form-control" required="required" value="Suite Impériale">
                            <label for="Suite Impériale">Suite Impériale</label>
                        </div>
                        <div class="form-group">
                            <input type="radio" name="bedroomname" class="form-control" required="required" value="Suite Présidentielle">
                            <label for="Suite Présidentielle">Suite Présidentielle</label>
                        </div>
                        <?php
                            $mindate = date("Y-m-d");
                        ?>
                        <div>
                            <label>Date d'arrivée</label>
                            <input type="date" required id="res_date" name="datearrived" value="<?=date("Y-m-d")?>">
                        </div>
                        <div>
                            <label>Date de départ</label>
                            <input type="date" required id="res_date" name="datedeparture" value="<?=date("Y-m-d")?>">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Enregistrer l'hotel</button>
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
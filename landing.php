<?php 
    session_start();
    require_once 'config.php'; // ajout connexion bdd 
   // si la session existe pas soit si l'on est pas connecté on redirige
    if(!isset($_SESSION['user'])){
        header('Location:index.php');
        die();
    }

    // On récupere les données de l'utilisateur
    $req = $bdd->prepare('SELECT * FROM users WHERE token = ?');
    $req->execute(array($_SESSION['user']));
    $data = $req->fetch(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte</title>
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
                    <li><a href="index.html">Accueil</a></li>
                    <li><a href="etablissements.html">Etablissements</a></li> <!--admin-->
                    <li><a href="suites.html">Suites</a></li> <!--gérants-->
                    <li><a href="nos-suites.html">Nos suites</a></li> <!--catalogue-->
                    <li><a href="reservations.html">Réservations</a></li>   <!--afficher?-->
                    <li><a href="mes-reservations.html">Mes réservations</a></li>
                </ul>
            </nav>
        </header>
        <div class="container">
            <div class="col-md-12">
                <?php 
                        if(isset($_GET['err'])){
                            $err = htmlspecialchars($_GET['err']);
                            switch($err){
                                case 'current_password':
                                    echo "<div class='alert alert-danger'>Le mot de passe actuel est incorrect</div>";
                                break;

                                case 'success_password':
                                    echo "<div class='alert alert-success'>Le mot de passe a bien été modifié ! </div>";
                                break; 
                            }
                        }
                    ?>


                <div class="text-center">
                        <h1 class="p-5">Bonjour <?php echo $data['pseudo']; ?> !</h1>
                        <hr />
                        <a href="deconnexion.php" class="btn btn-danger btn-lg">Déconnexion</a>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#change_password">
                          Changer mon mot de passe
                        </button>
                </div>
            </div>
        </div>    

       

        

                                
        <!-- Modal -->
        <div class="modal fade" id="change_password" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Changer mon mot de passe</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                        <div class="modal-body">
                            <form action="layouts/change_password.php" method="POST">
                                <label for='current_password'>Mot de passe actuel</label>
                                <input type="password" id="current_password" name="current_password" class="form-control" required/>
                                <br />
                                <label for='new_password'>Nouveau mot de passe</label>
                                <input type="password" id="new_password" name="new_password" class="form-control" required/>
                                <br />
                                <label for='new_password_retype'>Re tapez le nouveau mot de passe</label>
                                <input type="password" id="new_password_retype" name="new_password_retype" class="form-control" required/>
                                <br />
                                <button type="submit" class="btn btn-success">Sauvegarder</button>
                            </form>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>

    </body>
    <footer>
            <ul>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="cgu.html">Conditions générales d'utilisation</a></li>
            </ul>
        </footer>
    </body>
</html>
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
            <section id="hostelForm">
                <h2>Ajouter une suite</h2>
                <p>Les champs marqués d'une * sont obligatoires !</p>
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
            
                    <form action="suitesE1_traitement.php" method="post">       
                        <div class="form-group">
                            <input type="text" name="bedroomname" class="form-control" placeholder="Nom de la suite*" required="required" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="pic1">Choisissez la photo de couverture:</label><br/>
                            <input type="file" id="pic1" name="picture" class="form-control" accept="image/png, image/jpeg">
                        </div>
                        <div class="form-group">
                            <input type="text" name="descript" class="form-control" placeholder="Description (200carac max)*" required="required" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input type="text" name="price" class="form-control" placeholder="Prix pour une nuit*" required="required" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="pic2">Choisissez une photo de galerie:</label><br/>
                            <input type="file" id="pic2" name="pictureOne" class="form-control" accept="image/png, image/jpeg">
                        </div>
                        <div class="form-group">
                            <label for="pic3">Choisissez une photo de galerie:</label><br/>
                            <input type="file" id="pic3" name="pictureTwo" class="form-control" accept="image/png, image/jpeg">
                        </div>
                        <div class="form-group">
                            <input type="text" name="booking" class="form-control" placeholder="Lien Booking*" required="required" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Enregistrer la suite</button>
                        </div>
                    </form>
                </div>
            </section>      
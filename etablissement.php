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
    <title>Gestion des établissements</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;400&display=swap" rel="stylesheet">
</head>
<body>   
    <header>
        <?php
            require_once 'components/header3.php'
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
                            <input type="text" name="hostelname" class="form-control" placeholder="Nom de l'hotel" required="required" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input type="text" name="adress" class="form-control" placeholder="Adresse" required="required" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input type="text" name="city" class="form-control" placeholder="Ville" required="required" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input type="text" name="description" class="form-control" placeholder="Description (200 caractères max)" required="required" autocomplete="off">
                        </div> 
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Enregistrer l'hotel</button>
                        </div>
                    </form>
                </div>
            </section>
            <section>
                <h2>Liste des hotels</h2>
                <?php
                $sql = "SELECT * FROM hostels";
   
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
                            <th>Adresse</th>
                            <th>Ville</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                        <tr>
                            <td><?php echo addslashes($row['hostelname']); ?></td>
                            <td><?php echo addslashes($row['adress']); ?></td>
                            <td><?php echo addslashes($row['city']); ?></td>
                            <td><?php echo addslashes($row['description']); ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </section>
        </article>
        <article>
            <section id="managerForm">
                <h2>Ajouter un gérant</h2>
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
                        <strong>Succès</strong> inscription réussie !
                    </div>
                    <?php
                        break;
                        case 'password':
                    ?>
                    <div class="alert alert-danger">
                        <strong>Erreur</strong> mot de passe différent
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
                        break;
                        case 'already':
                    ?>
                    <div class="alert alert-danger">
                        <strong>Erreur</strong> compte deja existant
                    </div>
                    <?php 

                    }
                }
                ?>
            
            <form action="manager_traitement.php" method="post">       
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
                    <input type="password" name="password" class="form-control" placeholder="Mot de passe" required="required" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="password" name="password_retype" class="form-control" placeholder="Re-tapez le mot de passe" required="required" autocomplete="off">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Enregistrer le gérant</button>
                </div>   
            </form>
        </div>
            </section>
            <section>
                <h2>Liste des utilisateurs</h2>
                <?php
                $sql = "SELECT * FROM Users";
   
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
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['lastname']); ?></td>
                            <td><?php echo htmlspecialchars($row['firstname']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['role']); ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <p>Légende des roles:<br/>
                    1 -> Utilisateur<br/>
                    2 -> Gérant<br/>
                    3 -> Administrateur<br/>
                </p>
            </section>
        </article>
        <article>
        <section>
                <h2>Nos demandes</h2>
                <?php
                $sql = "SELECT * FROM contact";
   
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
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Sujet</th>
                            <th>Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                        <tr>
                            <td><?php echo addslashes($row['lastname']); ?></td>
                            <td><?php echo addslashes($row['firstname']); ?></td>
                            <td><?php echo addslashes($row['email']); ?></td>
                            <td><?php echo addslashes($row['subject']); ?></td>
                            <td><?php echo addslashes($row['message']); ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
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
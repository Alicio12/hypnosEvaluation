<?php 
    require_once 'config.php'; // On inclu la connexion à la bdd

    // Si les variables existent et qu'elles ne sont pas vides
    if(!empty($_POST['lastname']) && !empty($_POST['firstname']) && !empty($_POST['email']) && !empty($_POST['hostelname']) && !empty($_POST['bedroomname']) && !empty($_POST['datearrived']) && !empty($_POST['datedeparture']))
    {
        // Patch XSS
        $lastname = htmlspecialchars($_POST['lastname']);
        $firstname = htmlspecialchars($_POST['firstname']);
        $email = htmlspecialchars($_POST['email']);
        $hostelname = htmlspecialchars($_POST['hostelname']);
        $bedroomname = htmlspecialchars($_POST['bedroomname']);
        $datearrived = htmlspecialchars($_POST['datearrived']);
        $datedeparture = htmlspecialchars($_POST['datedeparture']);

        // On vérifie si l'utilisateur existe
        $check = $pdo->prepare('SELECT email, password FROM users WHERE email = ?');
        $check->execute(array($email));
        $data = $check->fetch();
        $row = $check->rowCount();

        $email = strtolower($email); // on transforme toute les lettres majuscule en minuscule pour éviter que Foo@gmail.com et foo@gmail.com soient deux compte différents ..
        
        // Si la requete renvoie un 0 alors l'utilisateur n'existe pas 
        if($row == 0){ 
            if(strlen($email) <= 50){ // On verifie que la longueur du mail <= 50
                if(filter_var($email, FILTER_VALIDATE_EMAIL)){ // Si l'email est de la bonne forme
                    if($password === $password_retype){ // si les deux mdp saisis sont bon

                        // On hash le mot de passe avec Bcrypt, via un coût de 12
                        $cost = ['cost' => 12];
                        $password = password_hash($password, PASSWORD_BCRYPT, $cost);

                        // On insère dans la base de données
                        $insert = $pdo->prepare('INSERT INTO users(lastname, firstname, email, password, token, role) VALUES(:lastname, :firstname, :email, :password, :token, :role)');
                        $insert->execute(array(
                            'lastname' => $lastname,
                            'firstname' => $firstname,
                            'email' => $email,
                            'password' => $password,
                            'token' => bin2hex(openssl_random_pseudo_bytes(64)),
                            'role' => 2
                        ));
                        // On redirige avec le message de succès
                        header('Location:etablissement.php?reg_err=success');
                        die();
                    }else{ header('Location: etablissement.php?reg_err=password'); die();}
                }else{ header('Location: etablissement.php?reg_err=email'); die();}
            }else{ header('Location: etablissement.php?reg_err=email_length'); die();}
        }else{ header('Location: etablissement.php?reg_err=already'); die();}
    }
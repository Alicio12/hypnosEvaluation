<?php 
    require_once 'config.php'; // On inclu la connexion à la bdd

    // Si les variables existent et qu'elles ne sont pas vides
    if(!empty($_POST['lastname']) && !empty($_POST['firstname']) && !empty($_POST['email']) && !empty($_POST['subject']) && !empty($_POST['message']))
    {
        // Patch XSS
        $lastname = htmlspecialchars($_POST['lastname']);
        $firstname = htmlspecialchars($_POST['firstname']);
        $email = htmlspecialchars($_POST['email']);
        $subject = htmlspecialchars($_POST['subject']);
        $message = htmlspecialchars($_POST['message']);

            if(strlen($email) <= 50){ // On verifie que la longueur du mail <= 50
                if(filter_var($email, FILTER_VALIDATE_EMAIL)){ // Si l'email est de la bonne forme

                        // On insère dans la base de données
                        $insert = $pdo->prepare('INSERT INTO contact(lastname, firstname, email, subject, message) VALUES(:lastname, :firstname, :email, :subject, :message)');
                        $insert->execute(array(
                            'lastname' => $lastname,
                            'firstname' => $firstname,
                            'email' => $email,
                            'subject' => $subject,
                            'message' => $message
                        ));
                        // On redirige avec le message de succès
                        header('Location: contact.php?reg_err=success');
                        die();                    
                }else{ header('Location: contact.php?reg_err=email'); die();}
            }else{ header('Location: contact.php?reg_err=email_length'); die();}
    }
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
        
        
            if(strlen($email) <= 50){ // On verifie que la longueur du mail <= 50
                        // On insère dans la base de données
                        $insert = $pdo->prepare('INSERT INTO reservations(lastname, firstname, email, hostelname, bedroomname, datearrived, datedeparture, price) VALUES(:lastname, :firstname, :email, :hostelname, :bedroomname, :datearrived, :datedeparture, :price)');
                        $insert->execute(array(
                            'lastname' => $lastname,
                            'firstname' => $firstname,
                            'email' => $email,
                            'hostelname' => $hostelname,
                            'bedroomname' => $bedroomname,
                            'datearrived' => $datearrived,
                            'datedeparture' => $datedeparture,
                            'price' => ($datedeparture-$datearrived)*129
                        ));
                        // On redirige avec le message de succès
                        header('Location:suitesE2.php?reg_err=success');
                        die();
              }else{ header('Location: suitesE2.php?reg_err=email_length'); die();}
    }
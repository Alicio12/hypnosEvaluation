<?php 
    require_once 'config.php'; // On inclu la connexion à la bdd

    // Si les variables existent et qu'elles ne sont pas vides
    if(!empty($_POST["hostelname"]) && !empty($_POST["adress"]) && !empty($_POST["city"]) && !empty($_POST["description"]))
    {
        // Patch XSS
        $hostelname = htmlspecialchars($_POST["hostelname"]);
        $adress = htmlspecialchars($_POST["adress"]);
        $city = htmlspecialchars($_POST["city"]);
        $description = htmlspecialchars($_POST["description"]);
        
            if(strlen($hostelname) <= 50){ // On verifie que la longueur du nom <= 50
                if(strlen($description) <=200){
                        // On insère dans la base de données
                        $insert = $pdo->prepare('INSERT INTO hostels(hostelname, adress, city, description) VALUES(:hostelname, :adress, :city, :description)');
                        $insert->execute(array(
                            "hostelname" => $hostelname,
                            "adress" => $adress,
                            "city" => $city,
                            "description" => $description
                        ));
                        // On redirige avec le message de succès
                        header('Location:etablissement.php?reg_err=success');
                        die();
                }else{ header('Location: etablissement.php?reg_err=description_length'); die();}        
            }else{ header('Location: etablissement.php?reg_err=email_length'); die();}
    }
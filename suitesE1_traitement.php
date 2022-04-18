<?php 
    require_once 'config.php'; // On inclu la connexion à la bdd

    // Si les variables existent et qu'elles ne sont pas vides
    if(!empty($_POST["bedroomname"]) && !empty($_POST["picture"]) && !empty($_POST["descript"]) && !empty($_POST["price"]) && !empty($_POST["pictureOne"]) && !empty($_POST["prictureTwo"]) && !empty($_POST["booking"]))
    {
        // Patch XSS
        $bedroomname = htmlspecialchars($_POST["bedroomname"]);
        $picture = htmlspecialchars($_POST["picture"]);
        $descript = htmlspecialchars($_POST["descript"]);
        $price = htmlspecialchars($_POST["price"]);
        $pictureOne = htmlspecialchars($_POST["prictureOne"]);
        $pictureTwo = htmlspecialchars($_POST["prictureTwo"]);
        $booking = htmlspecialchars($_POST["booking"]);
        
            if(strlen($bedroomname) <= 50){ // On verifie que la longueur du nom <= 50
                if(strlen($descript) <=200){
                        // On insère dans la base de données
                        $insert = $pdo->prepare('INSERT INTO bedrooms(bedroomname, picture, descript, price, pictureOne, pictureTwo, booking) VALUES(:bedroomname, :picture, :descript, :price, :pictureOne, :pictureTwo, :booking)');
                        $insert->execute(array(
                            "bedroomname" => $bedroomname,
                            "picture" => $picture,
                            "descript" => $descript,
                            "price" => $price,
                            "pictureOne" => $pictureOne,
                            "pictureTwo" => $pictureTwo,
                            "booking" => $booking
                        ));
                        // On redirige avec le message de succès
                        header('Location:etablissement.php?reg_err=success');
                        die();
                }else{ header('Location: etablissement.php?reg_err=description_length'); die();}        
            }else{ header('Location: etablissement.php?reg_err=email_length'); die();}
    }
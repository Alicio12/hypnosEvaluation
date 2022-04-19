<?php 
    require_once 'config.php'; // On inclu la connexion à la bdd

    // Si les variables existent et qu'elles ne sont pas vides
    if(!empty($_POST["bedroomname"]) && !empty($_FILES["picture"]) && !empty($_POST["descript"]) && !empty($_POST["price"]) && !empty($_FILES["pictureOne"]) && !empty($_FILES["prictureTwo"]) && !empty($_POST["booking"]))
    {
        // Patch XSS
        $bedroomname = htmlspecialchars($_POST["bedroomname"]);
        //$picture = htmlspecialchars($_FILES["picture"]);
        $descript = htmlspecialchars($_POST["descript"]);
        $price = htmlspecialchars($_POST["price"]);
        //$pictureOne = htmlspecialchars($_FILES["prictureOne"]);
        //$pictureTwo = htmlspecialchars($_FILES["prictureTwo"]);
        $booking = htmlspecialchars($_POST["booking"]);

        $dossier = 'upload/';
        $fichier = basename($_FILES['picture']['name']);
        $taille_maxi = 100000;
        $taille = filesize($_FILES['picture']['tmp_name']);
        $extensions = array('.png', '.gif', '.jpg', '.jpeg');
        $extension = strrchr($_FILES['picture']['name'], '.'); 

        if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
        {
             $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...';
        }
        if($taille>$taille_maxi)
        {
             $erreur = 'Le fichier est trop gros...';
        }
        if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
        {
                    $fichier = strtr($fichier, 
                  'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
                  'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
             $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
             if(move_uploaded_file($_FILES['picture']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
             {
                  echo 'Upload effectué avec succès !';
             }
             else //Sinon (la fonction renvoie FALSE).
             {
                  echo 'Echec de l\'upload !';
             }
        }






        
            if(strlen($bedroomname) <= 50){ // On verifie que la longueur du nom <= 50
                if(strlen($descript) <=200){
                        // On insère dans la base de données
                        $insert = $pdo->prepare('INSERT INTO bedrooms(bedroomname, picture, descript, price, pictureOne, pictureTwo, booking, hostelId) VALUES(:bedroomname, :picture, :descript, :price, :pictureOne, :pictureTwo, :booking, :hostelId)');
                        $insert->execute(array(
                            "bedroomname" => $bedroomname,
                            "picture" => $fichier,
                            "descript" => $descript,
                            "price" => $price,
                            "pictureOne" => $pictureOne,
                            "pictureTwo" => $pictureTwo,
                            "booking" => $booking,
                            "hostelId" => 4
                        ));
                        // On redirige avec le message de succès
                        header('Location:suitesE1.php?reg_err=success');
                        die();
                }else{ header('Location: suitesE1.php?reg_err=description_length'); die();}        
            }else{ header('Location: suitesE1.php?reg_err=email_length'); die();}
    }
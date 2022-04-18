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
            require_once 'components/header.php';
        ?>
    </header>

    <main>
        <article>
            <section>
                <h2>Lorem Ipsum</h2>
                <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed efficitur, tortor id vehicula interdum, 
                felis magna eleifend nisi, id interdum ligula quam non justo. Cras quis ante in ex pretium feugiat eget in orci. 
                Suspendisse efficitur quis mi a auctor. Nulla aliquet dignissim porta. Aenean ac aliquet nulla, at feugiat arcu. 
                Pellentesque rhoncus fermentum leo ac placerat. Sed dignissim metus sit amet cursus ullamcorper. 
                Nulla vestibulum pulvinar sapien, eu mollis ipsum.
                </p>
            </section>
            <section>
                <h2>Lorem Ipsum</h2>
                <p>
                Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla facilisi. 
                Suspendisse in condimentum tortor. Mauris blandit finibus massa eu sodales. 
                Pellentesque placerat ornare purus ac pharetra. Aenean sit amet elementum dolor. 
                Aliquam erat volutpat. Nullam iaculis ut mi quis aliquam. Ut eu ligula eget ex tincidunt commodo. 
                Etiam consectetur elit a ipsum pulvinar pellentesque. Pellentesque id lacinia ligula. 
                Mauris iaculis molestie nulla, in lacinia lacus laoreet vitae. Donec lacinia fermentum lacus vel mattis. 
                Vivamus hendrerit erat eget lobortis egestas. Phasellus eu posuere urna, et suscipit velit.
                </p>
            </section>
            <section>
                <h2>Lorem Ipsum</h2>
                <p>
                Nulla et ultrices eros. Donec volutpat turpis nec lacus sodales, nec consequat turpis sagittis. 
                Nam enim tortor, vehicula in ante eu, accumsan ornare enim. Vivamus suscipit et purus ut bibendum. 
                Interdum et malesuada fames ac ante ipsum primis in faucibus. 
                Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. 
                Praesent consequat ultricies elit eu vulputate. In facilisis eros lectus, rhoncus sollicitudin nulla maximus sit amet. 
                Maecenas bibendum eros at ipsum auctor vulputate. Duis sagittis eu dui in aliquet.
                </p>
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
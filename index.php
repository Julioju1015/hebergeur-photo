<?php
    //Verif si image bien reçu
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
        //variables
        $error = 1;
        //verif taille
        if($_FILES['image']['size'] <= 3000000){
            
            //verif extension (pathinfo prend en parametre un chemin)
            $infosImage = pathinfo($_FILES['image']['name']);
            $extensionImage = $infosImage['extension'];
            $extensionArray = array('jpg','jpeg','gif', 'png');
            
            $adressVersImage = 'upload/'.time().rand().rand(). '.' .$extensionImage;
            //si $extensionImage appartien a notre $extensionArray
            if(in_array($extensionImage, $extensionArray)){
                move_uploaded_file($_FILES['image']['tmp_name'], $adressVersImage);
                $error = 0;

            }
        }
    }




?>

<!DOCTYPE html>
<html>
<head>
    <title>Hébergeur d'images</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h2>ImgHeberg</h2>
    </header>
    <!-- FORMULAIRE -->
        <div class="container"> 
            <article>

                <h1>Héberger une image</h1>

                <?php

                if(isset($error) && $error == 0){
                    echo '  <div id="cadreImage">
                                <img src="' . $adressVersImage . '" id="imageSend"/><br>
                            
                            <input type="text" value="lien-du-site/' .$adressVersImage. '"/>
                            </div>';
                }elseif(isset($error) && $error == 1){
                    echo 'Votre image ne peux pas etre envoyé, verifiez son extension et sa taille qui doit faire 3mo max.';
                }
                ?>

                <form action="index.php" method="POST" enctype="multipart/form-data">
                    <p>
                        <input type="file" name="image" required><br>
                        <input type="submit" name="sub" value="Héberges ton image">
                    </p>
            
                </form>
            
            
            
            </article>
        </div>



    



</body>



</html>
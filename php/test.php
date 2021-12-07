<?php
session_start();
// connexion à la BDD
$bdd = mysqli_connect('localhost','root','','livreor');
// requête pour recuperer les données du profil connecté
$user = $_SESSION['username'];
$req = mysqli_query($bdd,"SELECT * FROM utilisateurs WHERE login='$user'");
$res = mysqli_fetch_all($req,MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../asset/css/livre-or.css">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300&family=Outfit&family=Ubuntu:ital@1&display=swap" rel="stylesheet">
    <title>Profil</title>
    <style>
               .cardphoto{
               width: 50%;
               border-radius: 100px;
               height:100%;
               margin: 5%;
               border: 5px solid #1969CE;
               background-image: url(<?php echo $res[0]['imageprofil']; ?>);
               background-size: cover;
               }
               .cardphoto2{
               width: 100%;
               border-radius: 100px;
               height: 100%;
               margin: 0% 0% 1% 0%;
               border: none;;
               opacity: 0%;
               }
               .cardphoto2 input[type=file]{
                opacity: 0%;
                border: none;
                cursor: pointer;
               }
           </style>
</head>
<body>
    <?php
    require "header.php";
    ?>
    <main>
     
        <div class="contentprofil">

            <div class="cardprofil">
            
                <div class="minicardprofil">
                <img  src="../asset/images/profil.jpg" alt="">
                   <!-- PROFIL -->
               
                </div >

                <div class="minicardprofil">
                    <form action="" method="post" enctype="multipart/form-data">
                    <?php 
                     // Vérifier si le formulaire a été soumis
                     if(isset($_POST['upload'])){
              
                  // Vérifie si le fichier a été uploadé sans erreur.
                     if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
     
                      $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
                      $filename = $_FILES["photo"]["name"];
                      $filetype = $_FILES["photo"]["type"];
                      $filesize = $_FILES["photo"]["size"];

                  // Vérifie l'extension du fichier
                     $ext = pathinfo($filename, PATHINFO_EXTENSION);
                      if(!array_key_exists($ext, $allowed)) die("Erreur : Veuillez sélectionner un format de fichier valide.");

                     // Vérifie la taille du fichier - 5Mo maximum
                        $maxsize = 5 * 1024 * 1024;
                        if($filesize > $maxsize) die("Error: La taille du fichier est supérieure à la limite autorisée.");

                        // Vérifie le type MIME du fichier
                     if(in_array($filetype, $allowed)){
                     // Vérifie si le fichier existe avant de le télécharger.
                      if(file_exists("../asset/images/" . $_FILES["photo"]["name"])){
                        echo $_FILES["photo"]["name"] . " existe déjà.";
                     } else{
                      $path ='../asset/images/'.$filename;
                      mysqli_query($bdd,"UPDATE utilisateurs
                      SET imageprofil = '$path' WHERE login='$user'");
                      move_uploaded_file($_FILES["photo"]["tmp_name"], "../asset/images/" . $_FILES["photo"]["name"]);
                      header('location:profil.php');
                      echo "Votre fichier a été téléchargé avec succès.";
                     } 
                  } else{ echo "Error: Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer."; 
                     }
               } else{echo "Error: " . $_FILES["photo"]["error"];
                     }
                   }
                  if (!isset($_SESSION['username'])) {?>
                   <h1>Vous n'êtes pas connecté sur le site</h1>
                   <?php  }  ?>
                     
                </div >

                <div class="minicardprofil " >
                  <div class="formcard">
                    <?php 
                    if (isset($_SESSION['username'])) {?>
                        <form   action="" method="POST"  enctype="multipart/form-data">
                            <label><b>Photo de Profil </b></label>  
                           <div>
                                <div class="cardphoto"> 
                                <input class="cardphoto2" type="file" name="photo"> </div>
                                </div>   
                                <div class="flexprofil">
                                <input type="submit" name="upload" value="Upload">
                                </div>
                            </div>
                           <label><b>Login</b></label>  
                           
                           <div class="padding"> 
                              <input type="text" value="<?php echo $res[0]['login'] ?>" name="login" required>
                           </div>
                
                           <div class="padding">
                              <label><b>Mot de passe</b></label>
                           </div>
                           <div class="padding"> 
                              <input type="password" placeholder="Entrer le nouveau mot de passe" name="password" required>
                           </div>
                           <div class="padding">
                               <label><b>Confirmation du mot de passe</b></label>
                           </div>
                           <div class="padding"> 
                              <input type="password" placeholder="Confirmer le nouveau mot de passe" name="password2" required>
                           </div>
                           <div class="padding"> 
                              <input type="submit" id='submit' name="submit" value='EDITER' > 
                           </div> 
                           <?php 
                            // CONDITION DE L'EDITE
                                if (isset($_POST['submit'])) {
                                    $login = $_POST['login'];
                                    $pass = $_POST['password'];
                                    $pass2 = $_POST['password2'];
                                 if (!empty($login) && !empty($pass) && !empty($pass2)) {
                                      // requête pour garder le même login et ne pas utiliser un login déjà existant.
                                        $req2= mysqli_query($bdd,"SELECT * FROM utilisateurs WHERE login='$login'");
                                        $res2= mysqli_fetch_all($req2,MYSQLI_ASSOC);
                                        if (empty($res2) || $res2[0]['login'] == $user) {
                                             if ($pass2 == $pass) {
                                              mysqli_query($bdd,"UPDATE `utilisateurs` SET `login`='$login',`password`='$pass' WHERE login='$user'");
                                             $_SESSION['username'] = $login;
                                              header('location: #');
                                            }
                                    }else {
                                             echo'Impossible de changer les données, le login existe déjà.';
                                             }
                                             }else {
                                             echo 'Impossible de changer les données, remplissez tous les champs.';
                                            }
                                } ?>
                      </form>
                  <?php  }  ?>
                  </div>
              </div>
            </div>
        </div>

    </main>

    <?php
    require "footer.php";
    ?>
</body>
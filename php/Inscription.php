
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../asset/css/livre-or.css">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300&family=Outfit&family=Ubuntu:ital@1&display=swap" rel="stylesheet">
    <title>Accueil</title>
</head>
<body>
    <?php
    require "header.php";
    ?>
    <main>
        <section class="formcontent" >
            <div class="formcard">
               <!-- FORMULAIRE D'INSCRIPTION -->

               <?php 
           session_start();
            if (isset($_SESSION['username'])) {?>
                   <h1>Vous êtes déjà inscrit sur le site</h1>
                   <?php  }  ?>
                   
                   <?php 
            if (!isset($_SESSION['username'])) {?>
                <form   action="" method="POST">
                  <img width="40%" src="../asset/images/inscription.jpg" alt="">
                 <div class="padding">
                    <label><b>Login</b></label>
                 </div>
                 <div class="padding"> 
                    <input type="text" placeholder="Entrer le login d'utilisateur" name="login" required>
                 </div>
                
                 <div class="padding">
                    <label><b>Mot de passe</b></label>
                 </div>
                 <div class="padding"> 
                    <input type="password" placeholder="Entrer le mot de passe" name="password" required>
                 </div>
                 <div class="padding">
                    <label><b>Confirmation du mot de passe</b></label>
                 </div>
                 <div class="padding"> 
                    <input type="password" placeholder="Confirmer le mot de passe" name="password2" required>
                 </div>

                 <div class="padding"> 
                    <input type="submit" id='submit' name="submit" value='INSCRIPTION' > 
                 </div> 
                </form>
                <?php  }  ?>
                <?php 
                //  Connexion à la base de donnée.
                 
                 $bdd = mysqli_connect('localhost','root','','livreor');
                 // Requête d'inscription des utilisateurs dans la base de donnée.
                 if (isset($_POST['submit'])) {
                    $login = $_POST['login'];
                    $password = $_POST['password'];
                    $confpass = $_POST['password2'];
                 if (!empty($login) && !empty($password) && !empty($confpass)) {
                      // Requête pour ne pas inscrire plusieurs fois le même login 
                   $req = mysqli_query($bdd,"SELECT * FROM utilisateurs WHERE login='$login'");
                   $res= mysqli_fetch_all($req,MYSQLI_ASSOC); 
                   if (empty ($res[0]['login'])) {
                        // Requête pour verifier le mot de passe et sa confirmation 
                     if ($confpass == $password) {
                        mysqli_query($bdd,"INSERT INTO utilisateurs ( `login`,`password`) VALUES ('$login','$password')");
                        header('location:connexion.php');
                     }else {
                         echo 'Inscription impossible, confirmation du mot de passe incorrecte.';
                     }
                   }else {
                       echo ' Inscription impossible login déjà existant ';
                   }
                    
                 }else {
                     echo ' Inscription impossible,remplir tous les champs';
                 }
                }
                 

                 ?>
            </div>
        </section>

    </main>

    <?php
    require "footer.php";
    ?>
</body>
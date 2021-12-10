<?php
  session_start();
 //connexion à la base de donnée 
  $bdd = mysqli_connect('localhost','root','','livreor');
  $merror ='';
              if (isset($_POST['commenter'])) {
                $com = $_POST['commentaire'];
                  $id = $_SESSION['id'];
               if (!empty($com)) {
                  mysqli_query($bdd,"INSERT INTO commentaires (`commentaire`, `id-utilisateurs`, `date`) VALUES ('$com','$id',NOW())");
                  header('Location: livreor.php');
                }else {
                   $merror = 'Commentaire vide';
                }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../asset/css/livre-or.css">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300&family=Outfit&family=Ubuntu:ital@1&display=swap" rel="stylesheet">
    <title>Livre d'or</title>
</head>
<body>
    <?php
    require "header.php";
    ?>
    <main>
        <!-- LIVRE D'OR -->
      <section class="contentlo">
       <div class="contentcardlo">
          <div> <img src="../asset/images/Livreor.jpg" alt=""></div>
             <?php 
             
              $req = mysqli_query($bdd,"SELECT utilisateurs.id,utilisateurs.login,utilisateurs.imageprofil, commentaires.commentaire,commentaires.date
              FROM commentaires 
              INNER JOIN utilisateurs 
              ON commentaires.`id-utilisateurs` = utilisateurs.id ORDER BY commentaires.id DESC");
              $res = mysqli_fetch_all($req,MYSQLI_ASSOC);
  
              foreach ($res as $key => $value) { 
                $date = strtotime($value['date']);
                $datefr = date('d-m-Y H:i',$date);
                ?>
      
              <div class="contentcardlo2" > 

              <div class="cardlomini1"> 
              <div class="cardimg" >
                <img  class="imgsize2" src="<?php echo $value['imageprofil']; ?>" alt="">
              </div>
              <div class="cardlogin" >
                <h4><?php echo $value['login']; ?></h4>
              </div>
          </div>
          <div class="cardcom">
            <h6>Le : <?php echo $datefr; ?> </h6>
             <h5> Commentaire :</h5>
              <?php echo $value['commentaire']; ?>
          </div>
        </div>
            <?php } ?>
        </div>
        <?php
        require "commentaire.php";
        ?>
      </section>
     


    
    </main>
    <?php
    require "footer.php";
    ?>
</body>
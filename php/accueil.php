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
    session_start();
    require "header.php";
    ?>

    <main>
        <section class="flexmain">
            <div class="contentbvn">
            <?php
            if (isset($_SESSION['username'])) { ?>
                <h1> BIENVENUE  <span><?php echo $_SESSION['username'];?></span> SUR LE FANSITE DE ONE PIECE</h1>
                <p> Ce site à pour but de partager informations,actualités, news et autres sur l'Univers de One Piece.</p>
                <?php } ?>
                <?php
            if (!isset($_SESSION['username'])) { ?>
                <h1> BIENVENUE SUR LE FANSITE DE ONE PIECE</h1>
                <p> Ce site à pour but de partager informations,actualités, news et autres sur l'Univers de One Piece.</p>
                <?php } ?>
            </div>
        </section>
        <section class="contentmain">

            <div class="contentcard">
                <div>
                    <h1>ACTUALITES</h1>
                </div>
                <div class="contentflex">
                    <div class="cardmini1">
                        <img class="imgsize" src="../asset/images/actu2.png" alt="">
                    </div>
                    <div class="cardmini2">
                        <h3> ONE PIECE : SHANKS LE FILM OFFICIELLEMENT CONFIRMÉ !</h3>
                        <p> One Piece Film: Red est le 15e film One Piece à venir, qui sortira le 6 août 2022. Le film a été annoncé pour la première fois dans le numéro du 21 novembre 2021 du Weekly Shonen Jump en commémoration de la sortie de l'épisode 1000. </p>
                    </div>
                </div>
                <div class="contentflex">
                    <div class="cardmini1">
                        <img class="imgsize" src="../asset/images/actu3.png" alt="">
                    </div>
                    <div class="cardmini2">
                        <h3> ONE PIECE NETFLIX LIVE ACTION : LE CASTING RÉVÉLÉ !</h3>
                        <p> Le casting OFFICIEL de la série One Piece Netflix Live Action a enfin été annoncé !</p>
                    </div>
                </div>
                <div class="contentflex">
                    <div class="cardmini1">
                        <img class="imgsize" src="../asset/images/actu1.png" alt="">
                    </div>
                    <div class="cardmini2">
                        <h3> ONE PIECE EXHIBITION : COMMEMORANT DU 100e VOLUME !</h3>
                        <p>Une exposition événement commémorant la publication du 100e volume de One Piece se déroule actuellement à Tokyo.</p>
                    </div>
                </div>
            </div>
            <div class="contentcard2">
                <div>
                    <h1>DERNIERES VIDEOS</h1>
                </div>

                <div class="cardvideo">

                    <img class="imgsize" src="../asset/images/video3.png" alt="">

                    <h3> One Piece Chapitre 1033 : Shimotsuki Kôzaburô, l'ancêtre du clan ! </h3>
                </div>
                <div class="cardvideo">
                    <img class="imgsize" src="../asset/images/video2.png" alt="">

                    <h3> One Piece Chapitre 1032 : Onigashima sur le point de s'effondrer ?</h3>
                </div>
                <div class="cardvideo">
                    <img class="imgsize" src="../asset/images/video1.png" alt="">

                    <h3> One Piece Chapitre 1031 : Sanji contre Vinsmoke ! </h3>
                </div>
            </div>

        </section>

    </main>

    <?php
    require "footer.php";
    ?>
</body>

</html>
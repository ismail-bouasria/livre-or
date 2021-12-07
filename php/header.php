<!-- HEADER -->
    <header>
        <?php 
         if (isset($_SESSION['username'])) {
            if (isset($_POST['deconect'])) {
                session_destroy();
                header("location: accueil.php");
            }
        }
        
        ?>
        <section class="logosize">
            <img class="logosize" src="../asset/images/oplogo.png" alt="logodusite">
            <!-- MENU -->
            <nav>
                <section class="menuflex">
                    <section class="menucard"><a href="../index.php">Accueil</a></section>
                    <!-- PHP  CONDITIONS -->
                    <?php 
                            if (isset($_SESSION['username'])) { ?>
                    <section class="menucard">
                        <form action="" method="post">
                           
                            <input type="submit" name="deconect" value="Déconnexion" />
                        </form>
                       
                    </section>
                    <?php } ?>
                    <?php 
                            if (!isset($_SESSION['username'])) { ?>
                    <section class="menucard">
                        <a href="inscription.php">Inscription</a>
                    </section>
                    <?php } ?>
                    <?php 
                            if (!isset($_SESSION['username'])) { ?>
                    <section class="menucard">
                        <a href="connexion.php">Connexion</a>
                    </section>
                    <?php } ?>
                  <?php 
                            if (isset($_SESSION['username'])) { ?>
                    <section class="menucard"><a href="profil.php">Profil</a></section>
                    <?php } ?>
                    <section class="menucard"><a href="livreor.php">Livre d'or</a></section>
                </section>
            </nav>
        </section>
    </header>
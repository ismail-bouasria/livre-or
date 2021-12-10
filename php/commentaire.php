<div class="contentcom"> 
    <?php
         if (isset($_SESSION['id'])) { ?>
       
      
          <form action="" method="POST">
           <div class="padding"> 
             <label> Commentaires</label>
            </div>
           <div class="padding"> 
               <textarea name="commentaire" cols="50" rows="10"></textarea>
            </div>
           <div class="padding"> 
             <input type="submit" name="commenter" value="COMMENTER"> 
            </div>
          </form>
    <?php } else { ?>
        <h1>  Connectez vous pour pouvoir poster un commentaire !</h1>
    <?php } ?>
</div>
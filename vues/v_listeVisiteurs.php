 <div id="contenu">
      <h2>Les Salariés</h2>
      <h3>Salarié à sélectionner : </h3>
      <form action="index.php?uc=etatFrais&action=selectionnerMoisVisiteur" method="post">
      <div class="corpsForm">
         
      <p>
        <label for="lstVisiteur" accesskey="n">Salarié : </label>
        <select id="lstVisiteur" name="lstVisiteur">
            <?php
                foreach ($lesVisiteurs as $unVisiteur)
                {
                    $nom = $unVisiteur['nom'];
                    $prenom =  $unVisiteur['prenom'];
                    $idV = $unVisiteur['id'];
                    ?>
                    <option value="<?php echo $idV; ?>"> <?php echo $nom." ".$prenom; ?></option>
                    <?php 
                }
            ?>
        </select>
      </p>
      </div>
      <div class="piedForm">
      <p>
        <input id="ok" type="submit" value="Valider" size="20" />
        <input id="annuler" type="reset" value="Effacer" size="20" />
      </p> 
      </div>
        
      </form>
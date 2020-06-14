<?php
/**
 * File:
 * Author: X.Carrel
 * Date:
 **/

require_once "database.php";

// Lire les données dont la vue aura besoin pour créer le formulaire

$modules = selectMany("Select idModule, moduleFullName from module", []);

// et maintenant on peut construire le formulaire...
?>

<div>
    <form method="post" action="selectyear.php">
        Module: <select name="idModule">
            <?php foreach ($modules as $module) { ?>
                <option value="<?= $module['idModule'] ?>"><?= $module['moduleFullName'] ?></option>
            <?php } ?>
        </select>
        <input type="submit" name="store" value="Ok">
    </form>
</div>

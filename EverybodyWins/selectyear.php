<?php
/**
 * File:
 * Author: X.Carrel
 * Date:
 **/

require_once "database.php";

// Lire les données dont la vue aura besoin pour créer le formulaire

$idModule = $_POST['idModule']; // récupérer le module qui a été choisi à la page précédente

$quarters = selectMany("Select distinct idQuarter, quarterName 
                        from quarter 
                            inner join moduleInstance on fkQuarter = idQuarter
                        where fkModule = :module"
                    , ["module" => $idModule]);

// et maintenant on peut construire le formulaire...
?>

<div>
    <form method="post" action="changegrades.php">
        Trimestre: <select name="idQuarter">
            <?php foreach ($quarters as $quarter) { ?>
                <option value="<?= $quarter['idQuarter'] ?>"><?= $quarter['quarterName'] ?></option>
            <?php } ?>
        </select>
        <input type="hidden" name="idModule" value="<?= $idModule ?>">
        <input type="submit" name="store" value="Ok">
    </form>
</div>

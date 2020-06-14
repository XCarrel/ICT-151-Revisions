<?php
/**
 * File:
 * Author: X.Carrel
 * Date:
 **/

require_once "database.php";

$idModule = $_POST['idModule']; // récupérer le module qui a été choisi au début et retransmis par la page précédente
$idQuarter = $_POST['idQuarter']; // récupérer le trimestre qui a été choisi à la page précédente

$badgrades = selectMany("Select idGrade 
                        from grade 
                            inner join evaluation on fkEval=idEvaluation
                            inner join moduleInstance on fkModuleInstance=idModuleInstance
                        where fkModule = :module and fkQuarter = :quarter and gradeValue < 4"
                    , ["module" => $idModule, "quarter" => $idQuarter]);

// On peut maintenant changer les notes ...

foreach ($badgrades as $badgrade) {
    $idOfGradeToChange = $badgrade["idGrade"];
    execute("update grade set gradeValue = 4 where idGrade = :id",["id" => $idOfGradeToChange]);
}

// et maintenant on peut afficher un message de confirmation
?>

<div>
    <h1>Résultat</h1>
    <?php if (count($badgrades) > 0) { ?>
        <p><?= count($badgrades) ?> note(s) changée(s)</p>
    <?php } else { ?>
        <p>Aucune note changée</p>
    <?php } ?>
</div>
<a href="/">Retour</a>

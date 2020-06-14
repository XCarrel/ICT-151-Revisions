<?php
/**
 * File:
 * Author: X.Carrel
 * Date:
 **/
session_start();
require_once "database.php";

// Lire les données dont la vue aura besoin pour créer le formulaire

$students = selectMany("Select * from person where role=0", []);
$evals = selectMany("Select idEvaluation, testDescription, moduleShortName from evaluation 
	inner join moduleinstance on fkModuleInstance = idModuleInstance 
    inner join module on fkModule = idModule", []);

// récupérer le flash message s'il y en a un
if (isset($_SESSION['flashmessage'])) {
    $flashmessage = $_SESSION['flashmessage'];
    unset($_SESSION['flashmessage']);
}
// et maintenant on peut construire le formulaire...
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FlashMessage exo</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div>
    <?php if (isset($flashmessage)) { ?>
        <div class="flashmessage"><?= $flashmessage ?></div>
    <?php } ?>
    <form method="post" action="addgrade.php">
        Evaluation: <select name="idEval">
            <?php foreach ($evals as $eval) { ?>
                <option value="<?= $eval['idEvaluation'] ?>"><?= $eval['testDescription'] ?>, module <?= $eval['moduleShortName'] ?></option>
            <?php } ?>
        </select>
        <br>
        Elève: <select name="idStudent">
            <?php foreach ($students as $student) { ?>
                <option value="<?= $student['idPerson'] ?>"><?= $student['personFirstName'] ?> <?= $student['personLastName'] ?></option>
            <?php } ?>
        </select>
        <br>
        Note: <input type="text" name="gradeValue">
        <br>
        <input type="submit" name="store" value="Ok">
    </form>
</div>
</body>
</html>

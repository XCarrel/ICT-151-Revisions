<?php
/**
 * File:
 * Author: X.Carrel
 * Date:
 **/

require_once "database.php";
if (isset($_POST["store"])) {
    extract($_POST); // idEval, idStudent, $gradeValue
    $newGrade = insert("Insert into grade (gradeValue,fkStudent,fkEval) values (:grade,:student,:eval)",
        [
            "grade" => $gradeValue,
            "student" => $idStudent,
            "eval" => $idEval
        ]);
}

$students = selectMany("Select * from person where role=0", []);
$evals = selectMany("Select * from evaluation", []);
?>

<div>
    <p>Note ajoutée: <?= $newGrade ?></p>
</div>
<div>
    <form method="post">
        Evaluation: <select name="idEval">
            <?php foreach ($evals as $eval) { ?>
                <option value="<?= $eval['idEvaluation'] ?>"><?= $eval['testDescription'] ?></option>
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

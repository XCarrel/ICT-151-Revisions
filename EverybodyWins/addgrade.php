<?php
/**
 * File : addgrade.php
 * Author : X. Carrel
 * Created : 2020-06-14
 * Modified last :
 **/

require_once "database.php";

if (isset($_POST["store"])) { // Verify that the page is called after clicking on the form button, and not directly from the navigator's address bar
    extract($_POST); // $idEval, $idStudent, $gradeValue
    $newGrade = insert("Insert into grade (gradeValue,fkStudent,fkEval) values (:grade,:student,:eval)",
        [
            "grade" => $gradeValue,
            "student" => $idStudent,
            "eval" => $idEval
        ]);
}

?>
<h1>Résultat</h1>
<?php if ($newGrade > 0) { // La note a pu être créée puisqu'on a reçu un id en retour ?>
    <div>
        <p>La note ajoutée a l'id: <?= $newGrade ?></p>
    </div>
<?php } else { ?>
    <div>
        <p>Un problème est survenu</p>
    </div>
<?php } ?>
<a href="/">Retour</a>

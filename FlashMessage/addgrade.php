<?php
/**
 * File : addgrade.php
 * Author : X. Carrel
 * Created : 2020-06-14
 * Modified last :
 **/
session_start();

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

if ($newGrade > 0) { // La note a pu être créée puisqu'on a reçu un id en retour
    $_SESSION['flashmessage'] = "La note ajoutée a l'id: $newGrade";
} else {
    $_SESSION['flashmessage'] = "Un problème est survenu";
}

// et maintenant, qu'on a placé le message dans la session, on renvoie au navigateur une réponse qui lui dit de retourner à la racine du site
header('Location: /');
?>


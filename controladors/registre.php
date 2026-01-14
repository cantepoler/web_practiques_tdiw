<?php 

require_once __DIR__ . '/../models/connectaBD.php';
require_once __DIR__ . '/../models/usuaris.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = htmlentities($_POST['nom'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $adreca = htmlentities($_POST['adreca'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $poblacio = htmlentities($_POST['poblacio'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $cp = trim($_POST['cp']);

    if (empty($nom) || empty($email) || empty($password) || empty($adreca) || empty($poblacio) || empty($cp)) {
        echo "<script>alert('Tots els camps són obligatoris.'); window.history.back();</script>";
        exit();
    }

    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('El correu electrònic no és vàlid.'); window.history.back();</script>";
        exit();
    }

    else if (!filter_var($cp, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^\d{5}$/")))) {
        echo "<script>alert('El codi postal ha de tenir 5 dígits.'); window.history.back();</script>";
        exit();
    }

    $conn = connectaBD();
    $registrat = registrarUsuari($conn, $nom, $email, $password, $adreca, $poblacio, $cp);
    pg_close($conn);

    if ($registrat) {
        echo "<script>alert('Usuari registrat correctament!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error en el registre. Potser el correu ja existeix.'); window.history.back();</script>";
    } 
} else {

    include __DIR__ . '/../vistes/registre.php';
}
?>
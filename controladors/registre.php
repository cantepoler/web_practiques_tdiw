<?php 

require_once __DIR__ . '/../models/connectaBD.php';
require_once __DIR__ . '/../models/usuaris.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $adreca = $_POST['adreca'];
    $poblacio = $_POST['poblacio'];
    $cp = $_POST['cp'];

    $conn = connectaBD();
    $registrat = registrarUsuari($conn, $nom, $email, $password, $adreca, $poblacio, $cp);

    if ($registrat) {
        echo "<script>alert('Usuari registrat correctament!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error en el registre. Potser el correu ja existeix.'); window.history.back();</script>";
    } 
} else {

    include __DIR__ . '/../vistes/registre.php';
}
?>
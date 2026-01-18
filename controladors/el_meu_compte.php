<?php

require_once __DIR__ . '/../models/connectaBD.php';
require_once __DIR__ . '/../models/usuaris.php';

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Has d\\'iniciar sessió.'); window.location.href='index.php?accio=login';</script>";
    exit();
}

$usuari_id = $_SESSION['user_id'];
$conn = connectaBD();

$usuari = obtenirUsuariPerId($conn, $usuari_id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = htmlentities($_POST['nom'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $adreca = htmlentities($_POST['adreca'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $poblacio = htmlentities($_POST['poblacio'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $codi_postal = trim($_POST['codi_postal']);
    
    if (empty($nom) || empty($adreca) || empty($poblacio) || empty($codi_postal)) {
        $error = "Tots els camps són obligatoris.";
    } else if (!filter_var($codi_postal, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^\d{5}$/")))) {
        $error = "El codi postal ha de tenir 5 dígits.";
    } else {
        actualizarUsuari($conn, $usuari_id, $nom, $adreca, $poblacio, $codi_postal);
        
        $usuari = obtenirUsuariPerId($conn, $usuari_id);
        
        $success = "Informació actualitzada correctament.";
    }
    
    pg_close($conn);
} else {
    $error = "";
    $success = "";
}

include __DIR__ . '/../vistes/vista_el_meu_compte.php';

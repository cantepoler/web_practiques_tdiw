<?php

require_once __DIR__ . '/../models/connectaBD.php';
require_once __DIR__ . '/../models/comandes.php';

// Check authentication
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Has d\\'iniciar sessió per veure les meves compres.'); window.location.href='index.php?accio=login';</script>";
    exit();
}

$usuari_id = $_SESSION['user_id'];
$conn = connectaBD();

// Get order history
$comandes = obtenirHistorialCompres($conn, $usuari_id);

pg_close($conn);

include __DIR__ . '/../vistes/vista_historial_compres.php';

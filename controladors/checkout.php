<?php

require_once __DIR__ . '/../models/connectaBD.php';
require_once __DIR__ . '/../models/carret.php';
require_once __DIR__ . '/../models/usuaris.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page with message
    echo "<script>alert('Has d\\'iniciar sessió per poder realitzar la compra.'); window.location.href='index.php?accio=login';</script>";
    exit();
}

// Get user info
$usuari_id = $_SESSION['user_id'];
$conn = connectaBD();

// Get user details for address
$sql = "SELECT * FROM usuaris WHERE id = $1";
$result = pg_query_params($conn, $sql, [$usuari_id]);
$usuari = pg_fetch_all($result)[0];

// Get cart items
$carret = obtenirCarret($conn);
$total = obtenirTotalAmbConnexio($conn);

if (empty($carret)) {
    pg_close($conn);
    echo "<script>alert('El carret està buit.'); window.location.href='index.php?accio=llistar-categories';</script>";
    exit();
}

pg_close($conn);

include __DIR__ . '/../vistes/vista_confirmacio_compra.php';
?>

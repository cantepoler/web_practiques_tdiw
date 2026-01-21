<?php

require_once __DIR__ . '/../models/connectaBD.php';
require_once __DIR__ . '/../models/comandes.php';

// Get order ID from URL parameter
$comanda_id = $_GET['id'] ?? null;

if (!$comanda_id) {
    header("Location: " . BASE_URL . "/index.php?accio=llistar-categories");
    exit();
}

$conn = connectaBD();

// Get order details
$comanda = obtenirComandaPerId($conn, $comanda_id);
$detalls = obtenirDetallsComanda($conn, $comanda_id);

pg_close($conn);

include __DIR__ . '/../vistes/vista_resum_comanda.php';
?>

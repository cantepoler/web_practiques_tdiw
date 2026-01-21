<?php

require_once __DIR__ . '/../models/connectaBD.php';
require_once __DIR__ . '/../models/carret.php';
require_once __DIR__ . '/../models/comandes.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Mètode no permès']);
    exit();
}

// Check authentication
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'No has iniciat sessió']);
    exit();
}

$usuari_id = $_SESSION['user_id'];

if (!isset($_SESSION['carret']) || empty($_SESSION['carret'])) {
    echo json_encode(['success' => false, 'error' => 'El carret està buit']);
    exit();
}

$conn = connectaBD();

try {
    // Get user details
    $sql = "SELECT * FROM usuaris WHERE id = $1";
    $result = pg_query_params($conn, $sql, [$usuari_id]);
    $usuari = pg_fetch_all($result)[0];

    // Create order
    $comanda_id = crearComanda($conn, $usuari_id, $_SESSION['carret'], $usuari);

    // Clear cart
    buidarCarret();

    pg_close($conn);

    // Return success with order ID
    echo json_encode([
        'success' => true,
        'comanda_id' => $comanda_id
    ]);

} catch (Exception $e) {
    pg_close($conn);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}

<?php

require_once __DIR__ . '/../models/connectaBD.php';
require_once __DIR__ . '/../models/carret.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_producte = $_POST['id_producte'] ?? null;
    
    if (!$id_producte) {
        echo json_encode(['success' => false, 'error' => 'Paràmetres incorrectes']);
        exit();
    }
    
    eliminarDelCarret($id_producte);
    
    $conn = connectaBD();
    $total = obtenirTotalAmbConnexio($conn);
    $num_items = obtenirNumItems();
    pg_close($conn);
    
    echo json_encode([
        'success' => true,
        'total' => $total,
        'num_items' => $num_items
    ]);
} else {
    echo json_encode(['success' => false, 'error' => 'Mètode no permès']);
}
?>

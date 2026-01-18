<?php

require_once __DIR__ . '/../models/connectaBD.php';
require_once __DIR__ . '/../models/carret.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_producte = $_POST['id_producte'] ?? null;
    
    if (!$id_producte) {
        echo json_encode(['success' => false, 'error' => 'Producte no especificat']);
        exit();
    }
    
    $conn = connectaBD();
    
    // Verify product exists and is active
    $sql = "SELECT id FROM productes WHERE id = $1 AND actiu = true";
    $result = pg_query_params($conn, $sql, [$id_producte]);
    $producte = pg_fetch_all($result);
    
    if (!$producte) {
        pg_close($conn);
        echo json_encode(['success' => false, 'error' => 'El producte no existeix o no està disponible']);
        exit();
    }
    
    // Add to cart
    afegirAlCarret($conn, $id_producte);
    $num_items = obtenirNumItems();
    
    pg_close($conn);
    
    echo json_encode([
        'success' => true,
        'num_items' => $num_items
    ]);
} else {
    echo json_encode(['success' => false, 'error' => 'Mètode no permès']);
}
?>

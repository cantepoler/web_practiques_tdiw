<?php

require_once __DIR__ . '/../models/connectaBD.php';
require_once __DIR__ . '/../models/carret.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_producte = $_POST['id_producte'] ?? null;
    $quantitat = $_POST['quantitat'] ?? null;
    
    if (!$id_producte || $quantitat === null) {
        echo json_encode(['success' => false, 'error' => 'Paràmetres incorrectes']);
        exit();
    }
    
    $conn = connectaBD();
    
    // Get current quantity
    $quantitat_actual = $_SESSION['carret'][$id_producte] ?? 0;
    $nova_quantitat = $quantitat_actual + $quantitat;
    
    if ($nova_quantitat > 0) {
        actualitzarQuantitat($id_producte, $nova_quantitat);
        
        // Get product info
        $sql = "SELECT preu FROM productes WHERE id = $1 AND actiu = true";
        $result = pg_query_params($conn, $sql, [$id_producte]);
        $producte = pg_fetch_all($result);
        
        $subtotal = $producte[0]['preu'] * $nova_quantitat;
    } else {
        eliminarDelCarret($id_producte);
        $nova_quantitat = 0;
        $subtotal = 0;
    }
    
    $total = obtenirTotalAmbConnexio($conn);
    $num_items = obtenirNumItems();
    
    pg_close($conn);
    
    echo json_encode([
        'success' => true,
        'nova_quantitat' => $nova_quantitat,
        'subtotal' => $subtotal,
        'total' => $total,
        'num_items' => $num_items
    ]);
} else {
    echo json_encode(['success' => false, 'error' => 'Mètode no permès']);
}
?>

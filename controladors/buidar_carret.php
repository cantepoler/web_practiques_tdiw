<?php

require_once __DIR__ . '/../models/connectaBD.php';
require_once __DIR__ . '/../models/carret.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $buidarCarret();

    $conn = connectaBD();

    $num_items = 0;
    $total = 0;

    if (isset($_SESSION['carret']) && !empty($_SESSION['carret'])) {
        foreach ($_SESSION['carret'] as $id_producte => $quantitat) {
            $sql = "SELECT preu FROM productes WHERE id = $1 AND actiu = true";
            $result = pg_query_params($conn, $sql, [$id_producte]);
            $producte = pg_fetch_all($result);

            if ($producte) {
                $total += $producte[0]['preu'] * $quantitat;
                $num_items += $quantitat;
            }
        }
    }

    pg_close($conn);

    echo json_encode([
        'success' => true,
        'total' => $total,
        'num_items' => $num_items
    ]);
} else {
    echo json_encode(['success' => false, 'error' => 'Mètode no permès']);
}

<?php

require_once __DIR__ . '/../models/carret.php';

header('Content-Type: application/json');

$count = obtenirNumItems();

echo json_encode(['count' => $count]);
?>
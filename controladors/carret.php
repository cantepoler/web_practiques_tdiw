<?php

require_once __DIR__ . '/../models/connectaBD.php';
require_once __DIR__ . '/../models/carret.php';

$conn = connectaBD();
$carret = obtenirCarret($conn);
$total = obtenirTotalAmbConnexio($conn);

pg_close($conn);

include __DIR__ . '/../vistes/vista_carret.php';
?>

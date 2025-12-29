<?php
$cat = 1;
if (isset($_GET['categoria_id'])) {
    $cat = $_GET['categoria_id'];
}

include_once __DIR__."/../models/connectaBD.php";
include_once __DIR__."/../models/productes.php";

$conn = connectaBD();
$productes = getProductes($conn, $cat);

pg_close($conn);
include __DIR__."/../vistes/vista_productes.php";

?>
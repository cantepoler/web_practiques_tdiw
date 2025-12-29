<?php
$prod = 1;
if (isset($_GET['id'])) {
    $prod = $_GET['id'];
}

include_once __DIR__."/../models/connectaBD.php";
include_once __DIR__."/../models/productes.php";

$conn = connectaBD();
$producte = getProdById($conn, $prod);

pg_close($conn);
include __DIR__."/../vistes/vista_detall_producte.php";

?>
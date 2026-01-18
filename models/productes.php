<?php
function getProductes($conn, $cat) {
    $sql = "SELECT * FROM productes WHERE categoria_id = $1";
    $result = pg_query_params($conn, $sql, array($cat));
    $productes = pg_fetch_all($result);
    return $productes;
}

function getProdById($conn, $id) {
    $sql = "SELECT * FROM productes WHERE id = $1";
    $result = pg_query_params($conn, $sql, array($id));
    $producte = pg_fetch_all($result)[0];
    return $producte;
}
?>
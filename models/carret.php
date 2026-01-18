<?php

function obtenirCarret($conn) {
    if (!isset($_SESSION['carret']) || empty($_SESSION['carret'])) {
        return [];
    }
    
    $carret = [];
    foreach ($_SESSION['carret'] as $id_producte => $quantitat) {
        $sql = "SELECT id, nom, descripcio, preu, imatge FROM productes WHERE id = $1 AND actiu = true";
        $result = pg_query_params($conn, $sql, [$id_producte]);
        $producte = pg_fetch_all($result);
        
        if ($producte) {
            $producte[0]['quantitat'] = $quantitat;
            $producte[0]['subtotal'] = $producte[0]['preu'] * $quantitat;
            $carret[] = $producte[0];
        }
    }
    
    return $carret;
}

function afegirAlCarret($conn, $id_producte) {
    if (!isset($_SESSION['carret'])) {
        $_SESSION['carret'] = [];
    }
    
    if (isset($_SESSION['carret'][$id_producte])) {
        $_SESSION['carret'][$id_producte]++;
    } else {
        $_SESSION['carret'][$id_producte] = 1;
    }
    
    return $_SESSION['carret'][$id_producte];
}

function actualitzarQuantitat($id_producte, $quantitat) {
    if (!isset($_SESSION['carret'][$id_producte])) {
        return false;
    }
    
    if ($quantitat <= 0) {
        unset($_SESSION['carret'][$id_producte]);
        return true;
    }
    
    $_SESSION['carret'][$id_producte] = $quantitat;
    return true;
}

function eliminarDelCarret($id_producte) {
    if (isset($_SESSION['carret'][$id_producte])) {
        unset($_SESSION['carret'][$id_producte]);
        return true;
    }
    return false;
}

function buidarCarret() {
    unset($_SESSION['carret']);
}

function obtenirTotal() {
    $total = 0;
    if (isset($_SESSION['carret'])) {
        foreach ($_SESSION['carret'] as $id_producte => $quantitat) {
            // Need to get product info to calculate price
            // This will be called from controller with $conn
        }
    }
    return $total;
}

function obtenirTotalAmbConnexio($conn) {
    $total = 0;
    if (isset($_SESSION['carret']) && !empty($_SESSION['carret'])) {
        foreach ($_SESSION['carret'] as $id_producte => $quantitat) {
            $sql = "SELECT preu FROM productes WHERE id = $1 AND actiu = true";
            $result = pg_query_params($conn, $sql, [$id_producte]);
            $producte = pg_fetch_all($result);
            
            if ($producte) {
                $total += $producte[0]['preu'] * $quantitat;
            }
        }
    }
    return $total;
}

function obtenirNumItems() {
    if (!isset($_SESSION['carret']) || empty($_SESSION['carret'])) {
        return 0;
    }
    
    $total = 0;
    foreach ($_SESSION['carret'] as $quantitat) {
        $total += $quantitat;
    }
    
    return $total;
}
?>

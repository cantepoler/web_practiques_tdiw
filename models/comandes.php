<?php

function crearComanda($conn, $usuari_id, $carret, $usuari) {
    // Start transaction
    pg_query($conn, "BEGIN");

    try {
        // Get user address info
        $nom_client = $usuari['nom'];
        $adreca = $usuari['adreca'];
        $poblacio = $usuari['poblacio'];
        $codi_postal = $usuari['codi_postal'];

        // Calculate total
        $total = 0;
        foreach ($carret as $id_producte => $quantitat) {
            // Get product price
            $sql = "SELECT preu, nom, imatge FROM productes WHERE id = $1";
            $result = pg_query_params($conn, $sql, [$id_producte]);
            $producte = pg_fetch_all($result)[0];
            $total += $producte['preu'] * $quantitat;
        }

        // Insert order header
        $sql_comanda = "INSERT INTO comandes
            (usuari_id, total, nom_client, adreca, poblacio, codi_postal)
            VALUES ($1, $2, $3, $4, $5, $6)
            RETURNING id";
        $result = pg_query_params($conn, $sql_comanda,
            [$usuari_id, $total, $nom_client, $adreca, $poblacio, $codi_postal]);
        $comanda_id = pg_fetch_all($result)[0]['id'];

        // Insert order details
        foreach ($carret as $id_producte => $quantitat) {
            $sql_detall = "SELECT preu, nom, imatge FROM productes WHERE id = $1";
            $result = pg_query_params($conn, $sql_detall, [$id_producte]);
            $producte = pg_fetch_all($result)[0];

            $subtotal = $producte['preu'] * $quantitat;

            $sql_insert = "INSERT INTO detalls_comanda
                (comanda_id, producte_id, nom_producte, preu_unitat, quantitat, subtotal)
                VALUES ($1, $2, $3, $4, $5, $6)";
            pg_query_params($conn, $sql_insert,
                [$comanda_id, $id_producte, $producte['nom'], $producte['preu'], $quantitat, $subtotal]);
        }

        // Commit transaction
        pg_query($conn, "COMMIT");

        return $comanda_id;

    } catch (Exception $e) {
        pg_query($conn, "ROLLBACK");
        throw $e;
    }
}

function obtenirComandaPerId($conn, $comanda_id) {
    $sql = "SELECT * FROM comandes WHERE id = $1";
    $result = pg_query_params($conn, $sql, [$comanda_id]);
    $comanda = pg_fetch_all($result);
    
    if ($comanda) {
        return $comanda[0];
    }
    return null;
}

function obtenirDetallsComanda($conn, $comanda_id) {
    $sql = "SELECT d.*, p.imatge
              FROM detalls_comanda d
              LEFT JOIN productes p ON d.producte_id = p.id
              WHERE d.comanda_id = $1
              ORDER BY d.id";
    $result = pg_query_params($conn, $sql, [$comanda_id]);
    $detalls = pg_fetch_all($result);
    return $detalls;
}

function obtenirHistorialCompres($conn, $usuari_id) {
    $sql = "SELECT * FROM comandes
              WHERE usuari_id = $1
              ORDER BY data DESC";
    $result = pg_query_params($conn, $sql, [$usuari_id]);
    $comandes = pg_fetch_all($result);
    return $comandes;
}
?>

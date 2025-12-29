<?php
function registrarUsuari($conn, $nom, $email, $password, $adreca, $poblacio, $cp) {
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO usuaris (nom, email, password_hash, adreca, poblacio, codi_postal)
            VALUES ($1, $2, $3, $4, $5, $6)";
    $params = [$nom, $email, $password_hash, $adreca, $poblacio, $cp];
    $result = pg_query_params($conn, $sql, $params);

    return $result;
}
?>
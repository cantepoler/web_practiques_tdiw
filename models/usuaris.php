<?php
function registrarUsuari($conn, $nom, $email, $password, $adreca, $poblacio, $cp) {
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO usuaris (nom, email, password_hash, adreca, poblacio, codi_postal)
            VALUES ($1, $2, $3, $4, $5, $6)";
    $params = [$nom, $email, $password_hash, $adreca, $poblacio, $cp];
    $result = pg_query_params($conn, $sql, $params);

    return $result;
}

function getUser($conn, $email) {
    $sql = "SELECT * FROM usuaris WHERE email = $1";
    $params = [$email];
    $result = pg_query_params($conn, $sql, $params);
    $result = pg_fetch_all($result);
    
    return $result;
}

function loginUsuari($conn, $email, $password) {
    $sql = "SELECT * FROM usuaris WHERE email = $1";
    $result = pg_query_params($conn, $sql, [$email]);
    $usuaris = pg_fetch_all($result);
    
    if (empty($usuaris)) {
        return ['success' => false, 'error' => 'Credencials incorrectes'];
    }
    
    $usuari = $usuaris[0];
    
    if (!password_verify($password, $usuari['password_hash'])) {
        return ['success' => false, 'error' => 'Contrasenya incorrecta'];
    }
    
    return ['success' => true, 'usuari' => $usuari];
}

function obtenirUsuariPerId($conn, $usuari_id) {
    $sql = "SELECT * FROM usuaris WHERE id = $1";
    $result = pg_query_params($conn, $sql, [$usuari_id]);
    $usuaris = pg_fetch_all($result);
    
    if ($usuaris) {
        return $usuaris[0];
    }
    return null;
}

function actualizarUsuari($conn, $usuari_id, $nom, $adreca, $poblacio, $codi_postal, $imatge_perfil = null) {
    if ($imatge_perfil !== null) {
        $sql = "UPDATE usuaris SET nom = $1, adreca = $2, poblacio = $3, codi_postal = $4, imatge_perfil = $5 WHERE id = $6";
        $result = pg_query_params($conn, $sql, [$nom, $adreca, $poblacio, $codi_postal, $imatge_perfil, $usuari_id]);
    } else {
        $sql = "UPDATE usuaris SET nom = $1, adreca = $2, poblacio = $3, codi_postal = $4 WHERE id = $5";
        $result = pg_query_params($conn, $sql, [$nom, $adreca, $poblacio, $codi_postal, $usuari_id]);
    }
    
    return $result;
}
?>

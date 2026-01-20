<?php

require_once __DIR__ . '/../models/connectaBD.php';
require_once __DIR__ . '/../models/usuaris.php';

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Has d\\'iniciar sessió.'); window.location.href='index.php?accio=login';</script>";
    exit();
}

$usuari_id = $_SESSION['user_id'];
$conn = connectaBD();

$usuari = obtenirUsuariPerId($conn, $usuari_id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom']);
    $adreca = trim($_POST['adreca']);
    $poblacio = trim($_POST['poblacio']);
    $codi_postal = trim($_POST['codi_postal']);
    $imatge_perfil = null;
    
    if (empty($nom) || empty($adreca) || empty($poblacio) || empty($codi_postal)) {
        $error = "Tots els camps són obligatoris.";
    } else if (!filter_var($codi_postal, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^\d{5}$/")))) {
        $error = "El codi postal ha de tenir 5 dígits.";
    } else if (isset($_FILES['imatge_perfil']) && !empty($_FILES['imatge_perfil']['name'])) {
        $file = $_FILES['imatge_perfil'];
        
        if ($file['error'] !== UPLOAD_ERR_OK) {
            $error = "Error en pujar la imatge.";
        } else if ($file['size'] > 2 * 1024 * 1024) {
            $error = "La imatge és massa gran (màx 2MB).";
        } else {
            $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
            if (!in_array($file['type'], $allowedTypes)) {
                $error = "Només s'accepten imatges (JPEG, PNG, GIF, WebP).";
            } else {
                $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                $filename = 'perfil_' . $usuari_id . '_' . time() . '.' . $extension;
                $destination = FILES_ABSOLUTE_PATH . $filename;
                
                if (!move_uploaded_file($file['tmp_name'], $destination)) {
                    $error = "Error en desar la imatge.";
                } else {
                    $imatge_perfil = $filename;
                    
                    if (!empty($usuari['imatge_perfil']) && file_exists(FILES_ABSOLUTE_PATH . $usuari['imatge_perfil'])) {
                        unlink(FILES_ABSOLUTE_PATH . $usuari['imatge_perfil']);
                    }
                }
            }
        }
    }
    
    if (!isset($error)) {
        if (isset($_POST['eliminar_imatge'])) {
            if (!empty($usuari['imatge_perfil']) && file_exists(FILES_ABSOLUTE_PATH . $usuari['imatge_perfil'])) {
                unlink(FILES_ABSOLUTE_PATH . $usuari['imatge_perfil']);
            }
            actualizarUsuari($conn, $usuari_id, $nom, $adreca, $poblacio, $codi_postal, null);
        } else {
            actualizarUsuari($conn, $usuari_id, $nom, $adreca, $poblacio, $codi_postal, $imatge_perfil);
        }
        
        $usuari = obtenirUsuariPerId($conn, $usuari_id);
        $_SESSION['nom_usuari'] = $usuari['nom'];
        
        $success = "Informació actualitzada correctament.";
    }
    
    pg_close($conn);
} else {
    $error = "";
    $success = "";
}

include __DIR__ . '/../vistes/vista_el_meu_compte.php';

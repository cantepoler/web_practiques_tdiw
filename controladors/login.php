<?php

require_once __DIR__ . '/../models/connectaBD.php';
require_once __DIR__ . '/../models/usuaris.php';

$redirect = $_GET['redirect'] ?? 'llistar-categories';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    if (empty($email) || empty($password)) {
        echo json_encode(['success' => false, 'error' => "Has d'ompl tots els camps."]);
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'error' => "El correu electrònic no és vàlid."]);
        exit();
    } else {
        $conn = connectaBD();
        $resultat = loginUsuari($conn, $email, $password);
        pg_close($conn);
        
        if ($resultat['success']) {
            $_SESSION['user_id'] = $resultat['usuari']['id'];
            $_SESSION['nom_usuari'] = $resultat['usuari']['nom'];
            
            echo json_encode([
                'success' => true,
                'redirect' => $redirect
            ]);
            exit();
        } else {
            echo json_encode(['success' => false, 'error' => $resultat['error']]);
            exit();
        }
    }
}

include __DIR__ . '/../vistes/login.php';

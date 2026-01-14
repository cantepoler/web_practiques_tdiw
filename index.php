<?php
session_start();

define("BASE_URL", "https://tdiw-g5.deic-docencia.uab.cat");

// El recurs al que accedirem ens ho dirà la variable accio.
$accio = $_GET['accio'] ?? NULL;

switch ($accio) {
    case 'llistar-categories':
        include __DIR__."/recurs_llistat_categories.php";
        break;
    case 'llistar-productes':
        include __DIR__."/recurs_llistat_productes.php";
        break;
    case 'detall-producte' :
        include __DIR__."/recurs_detall_producte.php";
        break;
    case 'registre':
        include __DIR__."/recurs_registre.php";
        break;
    case 'login':
        include __DIR__."/recurs_login.php";
        break;
    case 'logout':
        include __DIR__."/recurs_logout.php";
        break;

    default:    
        include __DIR__."/recurs_llistat_categories.php";
        break;

    // Per a cada recurs diferent, hi haura un case. 
    // Hi haurà recursos pel menu d'usuari, per inciar sessió, etc.
}
?>
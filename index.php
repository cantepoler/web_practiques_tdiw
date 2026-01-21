<?php
session_start();

define("BASE_URL", $_ENV['BASE_URL'] ?? "https://tdiw-g5.deic-docencia.uab.cat");

define("FILES_ABSOLUTE_PATH", __DIR__ . '/uploadedFiles/');
define("FILES_PUBLIC_PATH", BASE_URL . '/uploadedFiles/');

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
    case 'carret':
        include __DIR__."/recurs_carret.php";
        break;
    case 'afegir-al-carret':
        include __DIR__."/recurs_afegir_al_carret.php";
        break;
    case 'actualitzar-carret':
        include __DIR__."/recurs_actualitzar_carret.php";
        break;
    case 'carret-count':
        include __DIR__."/recurs_carret_count.php";
        break;
    case 'eliminar-del-carret':
        include __DIR__."/recurs_eliminar_del_carret.php";
        break;
    case 'buidar-carret':
        include __DIR__."/recurs_buidar_carret.php";
        break;
    case 'checkout':
        include __DIR__."/recurs_checkout.php";
        break;
    case 'processar-comanda':
        include __DIR__."/recurs_processar_comanda.php";
        break;
    case 'confirmacio':
        include __DIR__."/recurs_confirmacio.php";
        break;
    case 'les-meves-compres':
        include __DIR__."/recurs_historial_compres.php";
        break;
    case 'el-meu-compte':
        include __DIR__."/recurs_el_meu_compte.php";
        break;

    default:
        include __DIR__."/recurs_llistat_categories.php";
        break;

    // Per a cada recurs diferent, hi haura un case.
    // Hi haurà recursos pel menu d'usuari, per inciar sessió, etc.
}
?>
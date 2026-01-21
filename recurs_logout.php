<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

session_unset();
session_destroy();

@session_start();
header("Location: " . BASE_URL . "/index.php?accio=llistar-categories");
exit();

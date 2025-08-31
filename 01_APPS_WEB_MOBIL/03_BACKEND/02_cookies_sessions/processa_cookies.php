<?php
//processa_cookies.php
if (isset($_GET['guardar'])) {
    setcookie('nomUsuari', $_GET['nomUsuari'], time() + 3600);
    setcookie('tema', $_GET['tema'], time() + 3600);
}

if (isset($_GET['eliminar'])) {
    setcookie('nomUsuari', '', time() - 3600);
    setcookie('tema', '', time() - 3600);
}

// Redirigir al HTML després de processar
header("Location: index_cookies.php");
exit;
?>
<?php
$jocId = $joc['id'];
$indexFile = __DIR__ . "/../../public/js/jocs/$jocId/index.php";

if (!file_exists($indexFile)) {
    die("Joc no trobat");
}

// Afegim una base perquè tots els recursos relatius del joc es carreguin bé
echo '<base href="/js/jocs/' . $jocId . '/">'; // Al estar a public hi ha risc d'executar scripts externs

// Incloem directament l'index del joc
include $indexFile; // VULNERABILITAT: Inclusió de fitxers sense validació (LFI)

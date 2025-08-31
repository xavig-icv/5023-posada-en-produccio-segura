<?php
// index_get.php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $nom = $_GET['nom'] ?? '';
  $preu = $_GET['preu'] ?? 0;
  $rol = $_GET['rol'] ?? 'usuari';

  echo "<h2>Resultats de la cerca</h2>";
  echo "<p>Nom del producte: $nom </p>";
  echo "<p>Preu: $preu € </p>";
}
?>
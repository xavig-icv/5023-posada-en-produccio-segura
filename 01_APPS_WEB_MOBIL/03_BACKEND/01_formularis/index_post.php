<?php
// index_post.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nom = $_POST['nom'] ?? '';
  $password = $_POST['password'] ?? '';
  $rol = $_POST['rol'] ?? 'usuari';

  echo "<h2>Resultats del login</h2>";
  echo "<p>Usuari: $nom </p>";
  echo "<p>Contrasenya: $password </p>";

  if ($rol === 'admin') {
    echo "<p>Rol: Administrador</p>";
  } else {
    echo "<p>Rol: Usuari</p>";
  }
}
?>
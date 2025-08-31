<!DOCTYPE html>
<html lang="ca">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Gestió de Cookies</title>
    <meta name="description" content="Processament de Formularis i Cookies" />
    <meta name="author" content="Xavi Garcia @xavig-icv" />
    <meta name="copyright" content="Xavi Garcia @xavig-icv" />
  </head>
  <body>
    <?php
    //index_cookies.php
    $nomUsuari = $_COOKIE['nomUsuari'] ?? '';
    $tema = $_COOKIE['tema'] ?? '';
    ?>
    <h2>Informació actual de les cookies</h2>
    <p>Nom Usuari: <?php echo $nomUsuari ?? ''; ?></p>
    <p>Tema: <?php echo $tema ?? ''; ?></p>
    <form method="GET" action="./processa_cookies.php">
      <label for="nomUsuari">Nom Usuari:</label>
      <input type="text" id="nomUsuari" name="nomUsuari" value="<?php echo $nomUsuari ?? ''; ?>">
      <label for="tema">Tema:</label>
      <select id="tema" name="tema">
        <option value="clar" <?php if($tema=='clar') echo 'selected'; ?>>Clar</option>
        <option value="fosc" <?php if($tema=='fosc') echo 'selected'; ?>>Fosc</option>
      </select>
      <button type="submit" name="guardar">Guardar preferències</button>
      <button type="submit" name="eliminar">Eliminar preferències</button>
    </form>
  </body>
</html>
<?php
// api_rudimentaria.php
require_once "./db_pdo.php";
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  if (isset($_GET['joc_id']) && isset($_GET['nivell'])) {
    // Vulnerabilitat: SQL Injection per concatenació directa de la variable a la query
    $jocId = $_GET['joc_id'];
    $nivell = $_GET['nivell'];
    $sql = "SELECT configuracio_json FROM nivells_joc WHERE joc_id = $jocId AND nivell = $nivell";
    $resultat = $pdo->query($sql);
    if ($resultat) {
        $dades = $resultat->fetch(PDO::FETCH_ASSOC);
        header('Content-Type: application/json');
        echo $dades['configuracio_json'];

    } else {
        http_response_code(500);
        echo json_encode(array("Error" => "Error a la consulta SQL. Joc o nivell inexistent."));
    }
  } else {
      http_response_code(400);
      echo json_encode(array("Error" => "S'ha d'especificar un id de joc i un nivell."));
  }
}
$pdo = null;
?>
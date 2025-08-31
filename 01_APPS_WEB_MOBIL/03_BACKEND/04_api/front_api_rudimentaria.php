<?php
//front_api_rudimentaria.php
//Simulem que la ruta del joc és http://IP_DE_LA_VM/jocs/1/index.php (vol dir que joc_id=1)
session_start();
if (isset($_SESSION['nivell'])) {
  $nivell = $_SESSION['nivell'];
} else {
  $nivell = 1;
}
$jocId = 1; 
//Modifiqueu la IP i també la ruta del fitxer de la api rudimentaria
$url = 'http://IP_DE_LA_VM/api_rudimentaria.php?joc_id=' . $jocId . '&nivell=' . $nivell;
$json = file_get_contents($url);
$dades = json_decode($json);

$vides = $dades->vides;
$maxPunts = $dades->puntsNivell;
$maxEnemics = $dades->maxEnemics;
$maxProjectils = $dades->maxProjectils;

echo "<script>";
echo "const nivell = " . $nivell . ";";
echo "console.log('Nivell: '+nivell);";
echo "const maxEnemics = " . $maxEnemics . ";";
echo "console.log('maxEnemics: '+maxEnemics);";
echo "const maxProjectils = " . $maxProjectils . ";";
echo "console.log('maxProjectils: '+maxProjectils);";
echo "const maxPunts = " . $maxPunts . ";";
echo "console.log('maxPunts: '+maxPunts);";
echo "let vides = " . $vides . ";";
echo "console.log('vides: '+vides);";
echo "</script>";
?>
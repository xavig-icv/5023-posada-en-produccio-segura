<?php
session_start();
if (!isset($_SESSION['nivell'])) {
    $_SESSION['nivell'] = 1; 
}
?>
<script>
//Simulem que la ruta del joc és http://IP_DE_LA_VM/jocs/1/index.php (vol dir que joc_id=1)
const jocId = 1; // Ex: segons la ruta del joc
let nivell = <?php echo $_SESSION['nivell']; ?>;

//Poseu correctament la ruta de la API al fet el fetch.
fetch(`http://IP_DE_LA_VM/api.php/jocs/${jocId}/nivells/${nivell}`)
  .then(res => res.json())
  .then(data => {
    console.log("Resposta API:", data);
    document.write(JSON.stringify(obj));

    //Assignar variables del joc
    const vides = data.vides;
    const maxPunts = data.puntsNivell;
    const maxEnemics = data.maxEnemics;
    const maxProjectils = data.maxProjectils;

    console.log(`Nivell: ${nivell}`);
    console.log(`Vides: ${vides}`);
    console.log(`MaxPunts: ${maxPunts}`);
    console.log(`MaxEnemics: ${maxEnemics}`);
    console.log(`MaxProjectils: ${maxProjectils}`);

    // Aquí ja pots fer servir aquestes dades dins el joc
    // Inicialitzar joc amb la configuració (crear objecte usuari amb les vides, etc.).
  })
  .catch(err => console.error("Error de la API:", err));
</script>
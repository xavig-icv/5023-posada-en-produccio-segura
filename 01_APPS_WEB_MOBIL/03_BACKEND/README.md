# Bloc 03. Backend amb PHP i MySQL

## Introducció Backend LAMP

En aquest bloc aprendrem a desenvolupar la part servidor de les aplicacions web utilitzant la pila de software LAMP (Linux, Apache, MySQL i PHP). Aquesta arquitectura és una de les més utilitzades arreu del món per crear aplicacions web dinàmiques i escalables.

**PHP**: El llenguatge de programació interpretat que s'executa al costat del servidor. Permet generar contingut web dinàmic, processar la lògica del negoci, interactuar amb bases de dades i donar resposta a les peticions dels usuaris generant contingut web personalitzat (HTML, CSS i JS).

**MySQL**: El sistema gestor de bases de dades relacionals (SGBD). S'encarrega d'emmagatzemar, organitzar i consultar la informació de l'aplicació, assegurant la integritat i disponibilitat de les dades.

**Apache**: El servidor web que gestiona les peticions HTTP dels usuaris. S'encarrega de servir a l'usuari el contingut estàtic (HTML, CSS, JS, imatges, etc.) i de redirigir les peticions a aplicacions dinàmiques (com PHP). Apache destaca per la seva flexibilitat i gran quantitat de mòduls que permeten ampliar les seves funcionalitats.

El backend és el **cervell invisible** de l'aplicació ja que permet:
- Processar i validar les dades enviades pel frontend (per exemple, a través de formularis).
- Gestionar l'autenticació i autorització d'usuaris per controlar l'accés a recursos interns.
- Interactuar amb bases de dades per consultar, emmagatzemar i actualitzar informació.
- Proporcionar APIs per disposar d'una comunicació efectiva amb el frontend.
- Implementar la lògica de negoci, per molt complexa que sigui, assegurant el correcte funcionament de l'app.

A continuació farem un repàs dels conceptes fonamentals de la programació amb PHP i com interactuar amb MySQL, i finalitzarem creant una petita API pel videojoc del Bloc 02. Es treballaran conceptes clau com la gestió de peticions HTTP, l'accés a bases de dades i la creació d'APIs.

> ⚠️ **ADVERTÈNCIA:** Es realitzaran configuracions PHP vulnerables de manera intencionada que seran auditades, explotades i corregides en el tema 03 - auditories de seguretat web.

## Conceptes Bàsics de PHP (Repàs)

### Variables i Constants

PHP utilitza el símbol `$` per declarar variables i la funció `define()` o `const` per constants.

```php
<?php
// Constants (el seu contingut no es podrà modificar)
define('MAX_VIDES', 3);
const NOM_JOC = "Shooter 2D"; //No es poden declarar dintre de funcions o condicions
const NUM_ENEMICS = 5;

// Variables (els seus valors i tipus poden canviar durant l'execució)
$punts = 0;
$nivell = 1;
$vides = MAX_VIDES;
// Modificació d'una variable
$punts = 50;
?>
```

### Tipus de Dades

PHP és dinàmic, determina automàticament el tipus de dada en funció del valor assignat. Els tipus principals són:

- **Tipus Primitius**: String, Integer, Float, Boolean
- **Tipus Compostos**: Array, Object
- **Tipus Especials**: NULL, Resource

```php
<?php
// Tipus Primitius
$nom = "Jugador";           // String
$punts = 50;                // Integer
$energia = 99.5;            // Float
$estaDisparant = false;     // Boolean

// Arrays indexats
$enemics = ["TieFighter", "StarDestroyer", "DeathStar"];
$puntuacions = [50, 100, 300];

// Array associatiu (similar a object literal de JavaScript)
$jugador = [
    'nom' => 'X-Wing',
    'vides' => 3,
    'punts' => 0,
    'energia' => 100,
    'posicio' => ['x' => 250, 'y' => 450],
    'armes' => ['laser', 'metralleta']
];

// NULL
$nickname = null;
?>
```

### Operadors Aritmètics, Relacionals i Lògics

**Operadors Aritmètics**: Idèntics a JavaScript amb algunes particularitats de PHP.
- `+` (Suma), `-` (Resta), `*` (Multiplicació), `/` (Divisió)
- `%` (Mòdul), `**` (Exponent)
- `++` (Increment), `--` (Decrement)
- `.` (Concatenació de strings)

**Operadors Relacionals**: Similars a JavaScript amb operadors addicionals.
- `==` (Igual), `===` (Idèntic), `!=` (Diferent), `!==` (No idèntic)
- `>`, `<`, `>=`, `<=`
- `<>` (Diferent - alternativa a `!=`)
- `<=>` (Spaceship operator - Retorna -1, 0 o 1 si és menor, igual o més gran)

**Operadors Lògics**: Inclou versions alternatives amb paraules.
- `&&` o `and` (AND), `||` o `or` (OR), `!` (NOT)
- `xor` (OR exclusiu, només és certa una o l'altre condició)

```php
<?php
// Aritmètics
$puntsTotal = $punts + ($bonus * $nivell);
$nom_complet = $nom . " " . $cognom; // Concatenació

// Relacionals
$haGuanyat = $punts >= $maxPunts;
$finalJoc = $nivell === MAX_NIVELLS;
$comparacio = $videsJugador <=> $videsEnemic; // Retorna -1, 0 o 1

// Lògics
$potAtacar = ($videsEnemic >= 0) && ($municio > 0);
$continuaJoc = ($punts >= 0) || $estaViu;
?>
```

### Estructures de Control Condicional

PHP comparteix la majoria d'estructures de control amb JavaScript, amb una sintaxi pràcticament idèntica.

```php
<?php
// (if-else)
if ($vides > 0 && $punts >= 50) {
    $vides--;
    $punts -= 50;
    //Comanda que mostra informació dinàmica per pantalla.
    echo "Continues jugant!";
} else {
    echo "Game Over! T'has quedat amb $vides vides.";
}

// (switch)
switch ($nivell) {
    case 1:
        $numEnemics = 5;
        $maxPunts = 100;
        break;
    case 2:
        $numEnemics = 10;
        $maxPunts = 200;
        break;
    default:
        $numEnemics = 3;
        $maxPunts = 50;
        break;
}

// (Operador ternari)
$missatge = ($vides >= 0) ? "Continua jugant" : "Game Over! :)";
$nomUsuari = ($usuari === null) ? "Jugador1" : $usuari;
?>
```

### Estructures de Control Iteratiu

PHP ofereix diverses opcions per realitzar bucles, també inclou opcions específiques per arrays.

```php
<?php
// (while)
$estaViu = true;
$numEnemics = 3;
$vides = 5;

while ($estaViu && $numEnemics > 0) {
    $numEnemics--;
    $vides--;
    if ($vides === 0) {
        $estaViu = false;
    }
}

// (for) tradicional
$posicioEnemic = 0;
for ($i = 0; $i < 10; $i++) {
    $posicioEnemic += 5;
}

// (foreach) per arrays indexats
$enemics = ["TieFighter", "StarDestroyer", "DeathStar"];
foreach ($enemics as $enemic) {
    echo "Enemic: $enemic\n";
}

// (foreach) per arrays associatius (amb clau i valor)
$puntuacions = ['facil' => 100, 'normal' => 200, 'dificil' => 500];
foreach ($puntuacions as $dificultat => $punts) {
    echo "Dificultat $dificultat: $punts punts\n";
}
?>
```

### Funcions i Procediments

Les funcions són blocs de codi que realitzen una tasca concreta, poden rebre paràmetres d'entrada i rentornar un resultat. Són independents del programa i es poden "cridar" en qualsevol punt del codi.

```php
<?php
// Funció tradicional
function calcularPuntuacio($punts, $temps, $nivell) {
    $puntsTotals = floor(($punts - $temps) * $nivell);
    return $puntsTotals;
}

// Arrow function
$nivell = fn($fps) => intval(1000 / $fps);

// Ús de funcions
$puntuacioFinal = calcularPuntuacio(500, 120, 2); //760
$fps = $nivell(60); //16
?>
```
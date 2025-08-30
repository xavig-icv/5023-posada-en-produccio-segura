# 07. Les APIs i la Comunicació amb el Frontend

Una **API** (Application Programming Interface) és un conjunt de regles, protocols i mecanismes que permeten la comunicació entre diferents aplicacions o components de software de manera estructurada encara que estiguin desenvolupades amb llenguatges de programació diferents. En el context del desenvolupament web, les APIs actuen com a pont entre el frontend (HTML, CSS i JavaScript) i el backend (PHP i Bases de Dades) permetent que es puguin intercanviar dades de manera eficient.

PHP és excel·lent per crear APIs robustes que poden servir dades a múltiples clients: aplicacions web, mòbils, etc. Una API ben dissenyada segueix **principis REST** (Representational State Transfer).

## Principis bàsics REST

REST (Representational State Transfer) és un estil arquitectònic que defineix com han de comunicar-se els sistemes o aplicacions web. Les APIs REST es basen en una sèrie de principis que les fan eficients i escalables:

1. **Recursos identificats per URIs**: Cada recurs de l'API (usuaris, productes, etc.) té una adreça pròpia.
2. **Mètodes HTTP**: Utilitza mètodes HTTP (GET, POST, PUT, DELETE) per operar sobre els recursos. 
3. **Peticions autodescriptives**: Cada petició HTTP inclou tota la informació necessària (mètode, headers i cos de la petició).
4. **Representació de la informació**: Els recursos es representen habitualment en formats com JSON ja que poden manipular fàcilment.
5. **Stateless**: El servidor no recorda l'estat de peticions anteriors. Cada petició del client al servidor ha de contenir tota la informació necessària perquè la pugui processar correctament (tokens o credencials per autenticar-se, etc.).
6. **Cacheable**: Les respostes han de ser cachejables (Cache-Control) per millorar el rendiment. Això permet que al realitzar peticions repetides es donin respostes més ràpides i així es redueix la càrrega al servidor.

## Les APIs REST

El tipus d’API més utilitzat avui dia és l’API RESTful. Com hem dit abans, REST (Representational State Transfer) és un conjunt de principis arquitectònics que permeten dissenyar APIs clares, escalables i fàcilment reutilitzables (el mateix backend ha de poder donar servei a una web, una app mòbil o una altra aplicació).

**Rutes significatives:**
Per exemple, `/api/jocs/3` en comptes de `/api/jocs.php?id=3`.

**Mètodes HTTP amb significat:**
- GET → obtenir dades
- POST → crear dades
- PUT/PATCH → modificar dades
- DELETE → eliminar dades

Exemple: `GET /api/jocs/10` => Obtenir dades del joc amb (ID 10)
Exemple: `GET /api/jocs/10/nivells/3` => Obtenir dades del joc amb (ID 10) i nivell (3)

**Codis d'estat HTTP**
- `200 OK` - La petició s'ha processat correctament.
- `201 Created` - La petició ha creat un nou recurs.
- `400 Bad Request` - La petició no és vàlida.
- `401 Unauthorized` - La petició requereix autenticació.
- `404 Not Found` - El recurs sol·licitat no s'ha trobat.
- `500 Internal Server Error` - Error intern del servidor.

**Respostes en JSON:** 
- És un format lleuger i universal, fàcil d’interpretar per qualsevol llenguatge.

Exemples de resposta JSON:
```json
// GET /api/jocs/10
{
    "id": 10,
    "nom": "Naus vs Ovnis",
    "descripcio": "Un emocionant joc d'acció espacial",
    "categories": ["Acció", "Espacial"]
}
```

```json
// GET /api/jocs/10/nivells/3
{
    "id": 10,
    "nom": "Naus vs Ovnis",
    "nivell": 3,
    "vides": 3,
    "maxProjectils": 6,
    "maxEnemics": 16,
    "puntsNivell": 800
}
```

> ⚠️ **ADVERTÈNCIA:** Es realitzaran configuracions vulnerables de manera intencionada que seran auditades, explotades i corregides al tema 03 - auditories de seguretat web.

## API Rudimentària (exemple bàsic)

### Fitxer de connexió (db_connect.php)
```php
<?php
// db_connect.php
// Dades de connexió
$servidor = 'IP_DE_LA_VM';
$bd = 'plataforma_videojocs';
$usuari = 'plataforma_user';
$contrasenya = '123456789a';

try {
    $pdo = new PDO("mysql:host=$servidor;dbname=$bd", $usuari, $contrasenya);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de connexió: " . $e->getMessage();
    exit();
}
```

### Fitxer de l'API (api_rudimentaria.php)

```php
<?php
// api_rudimentaria.php
require_once "./db_connect.php";
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
```

### Exemple de petició des del frontend (PHP que genera JS dinàmic)
```php
//Simulem que la ruta del joc és http://IP_DE_LA_VM/jocs/1/index.php (vol dir que joc_id=1)
session_start();
if (isset($_SESSION['nivell'])) {
  $nivell = $_SESSION['nivell'];
} else {
  $nivell = 1;
}
$jocId = 1; //Segons la ruta del joc
$url = 'http://IP_DE_LA_VM/api_rudimentaria.php?joc_id=' . $jocId . '&nivell=' . $nivell;
$json = file_get_contents($url);
$dades = json_decode($json);
foreach ($dades as $variable) {
  $vides = $variable->vides;
  $maxPunts = $variable->puntsNivell;
  $maxEnemics = $variable->maxEnemics;
  $maxProjectils = $variable->maxProjectils;
}
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
```

## API REST (exemple bàsic)

> Mantenim la connexió a bases de dades anterior.

```php
<?php
// api.php
require_once "./db_connect.php";

// Definim el tipus de resposta per a tota l'API
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // VULNERABILITAT: CORS permissiu a tothom

// Obtenim la URL sol·licitada
$uri = explode("/", trim($_SERVER['REQUEST_URI'], "/"));

// Ex: /api/jocs/1/nivells/3
// uri[0] = api, uri[1] = jocs, uri[2] = 1, uri[3] = nivells, uri[4] = 3

$method = $_SERVER['REQUEST_METHOD'];

if ($method === "GET") {
  // Validar estructura: /api.php/jocs/{id}/nivells/{nivell}
  if (count($uri) === 5 && $uri[1] === "jocs" && $uri[3] === "nivells") {
    $jocId = (int) $uri[2];
    $nivell = (int) $uri[4];

    // Exemple vulnerable a SQL Injection
    $sql = "SELECT configuracio_json FROM nivells_joc WHERE joc_id = $jocId AND nivell = $nivell";

    $resultat = $pdo->query($sql);

    if ($resultat && $fila = $resultat->fetch(PDO::FETCH_ASSOC)) {
        echo $fila['configuracio_json']; // Retornem directament el JSON guardat
    } else {
        http_response_code(404);
        echo json_encode(["error" => "Joc o nivell no trobat"]);
    }
  } else {
      http_response_code(400);
      echo json_encode(["error" => "Ruta no vàlida. Exemple: /api/jocs/1/nivells/3"]);
  }
} else {
    http_response_code(405); // Mètode no permès
    echo json_encode(["error" => "Mètode no suportat"]);
}

$pdo = null;
```

### Exemple de petició des del frontend (JavaScript amb fetch)

```javascript
//Simulem que la ruta del joc és http://IP_DE_LA_VM/jocs/1/index.php (vol dir que joc_id=1)
const jocId = 1; // Ex: segons la ruta del joc
let nivell = sessionStorage.getItem("nivell") || 1;

fetch(`http://IP_DE_LA_VM/api.php/jocs/${jocId}/nivells/${nivell}`)
  .then(res => res.json())
  .then(data => {
    console.log("Resposta API:", data);
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
```
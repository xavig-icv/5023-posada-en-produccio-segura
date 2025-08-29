# 04. Connexió amb Bases de Dades

La connexió a bases de dades és fonamental per crear aplicacions web dinàmiques que permetin emmagatzemar, recuperar i manipular informació. PHP proporciona diferents eines per connectar-se i treballar amb el SGBD MySQL, un dels sistemes gestors de bases de dades relacionals més utilitzat.

**MySQLi (MySQL Improved):** És una eina que permet la gestió específica de MySQL. Permet connexions procedurals (mysqli_connect) o orientades a objectes (new mysqli).

**PDO (PHP Data Objects):** És una interfície més moderna que permet treballar amb diferents tipus de bases de dades amb el mateix codi PHP. És l'opció recomanada per aplicacions que vulguin ser segures i escalables. Recomano el seu ús amb el que es denominen sentències preparades (prepared statement).

## Casos d’ús amb Bases de Dades

- Emmagatzemar **informació de l'usuari**: dades de registre, perfils, permisos i rols.
- Gestionar el **catàleg de productes** en aplicacions comercials (inventari, preus, categories, etc.).
- Gestió del **LMS i CMS:** gestió de cursos, usuaris, continguts, progrés, avaluacions, etc.
- **Fòrums i xarxes socials**: Missatges, grups, amistats, notificacions, timeline.
- Gestionar **preferències, configuracions i dades de jocs** de manera persistent.

> ⚠️ **ADVERTÈNCIA:** Es realitzaran configuracions de MySQL i PHP vulnerables de manera intencionada que seran auditades, explotades i corregides al tema 03 - auditories de seguretat web.

## Configuració: Creació de la Base de Dades i Connexió

Abans de realitzar una connexió amb el SGBD, necessitaràs tenir MySQL instal·lat i una base de dades creada. Aprofitarem la vinentesa per crear l'usuari i configurar la base de dades per al projecte del tema 01.

### Creació de la BD i les Taules (script.sql)

```sql
-- Crear base de dades
CREATE DATABASE plataforma_videojocs CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Crear usuari insegur per l'aplicació
CREATE USER 'plataforma_user'@'%' IDENTIFIED BY '123456789a';

-- Concedir tots els privilegis a la base de dades i de manera global (vulnerable)
GRANT ALL PRIVILEGES ON *.* TO 'plataforma_user'@'%' WITH GRANT OPTION;

-- Aplicar canvis
FLUSH PRIVILEGES;

-- Seleccionar la base de dades
USE plataforma_videojocs;

-- Taula d'usuaris
CREATE TABLE IF NOT EXISTS usuaris (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom_usuari VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    nom_complet VARCHAR(100),
    data_registre DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Taula de jocs
CREATE TABLE IF NOT EXISTS jocs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom_joc VARCHAR(50) NOT NULL,
    descripcio TEXT,
    puntuacio_maxima INT DEFAULT 0,
    nivells_totals INT DEFAULT 1,
    actiu BOOLEAN DEFAULT TRUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Taula de nivells dels jocs
CREATE TABLE IF NOT EXISTS nivells_joc (
    id INT PRIMARY KEY AUTO_INCREMENT,
    joc_id INT NOT NULL,
    nivell INT NOT NULL,
    nom_nivell VARCHAR(50),
    configuracio_json JSON NOT NULL,
    puntuacio_minima INT DEFAULT 0,
    FOREIGN KEY (joc_id) REFERENCES jocs(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Taula de progrés d'usuari
CREATE TABLE IF NOT EXISTS progres_usuari (
    id INT PRIMARY KEY AUTO_INCREMENT,
    usuari_id INT NOT NULL,
    joc_id INT NOT NULL,
    nivell_actual INT DEFAULT 1,
    puntuacio_maxima INT DEFAULT 0,
    partides_jugades INT DEFAULT 0,
    ultima_partida DATETIME,
    FOREIGN KEY (usuari_id) REFERENCES usuaris(id) ON DELETE CASCADE,
    FOREIGN KEY (joc_id) REFERENCES jocs(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Taula de partides
CREATE TABLE IF NOT EXISTS partides (
    id INT PRIMARY KEY AUTO_INCREMENT,
    usuari_id INT NOT NULL,
    joc_id INT NOT NULL,
    nivell_jugat INT NOT NULL,
    puntuacio_obtinguda INT NOT NULL,
    data_partida DATETIME DEFAULT CURRENT_TIMESTAMP,
    durada_segons INT DEFAULT 0,
    FOREIGN KEY (usuari_id) REFERENCES usuaris(id) ON DELETE CASCADE,
    FOREIGN KEY (joc_id) REFERENCES jocs(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

## Connexió a la Base de Dades (mysqli)

Per realitzar la connexió amb la base de dades MySQL utilitzant MySQLi es necessari conèixer les dades d'accés (host, usuari, contrasenya i nom de la base de dades).

### Fitxer de connexió (db_connect.php)
```php
<?php
// Dades de connexió
$host = "IP_DE_LA_VM";
$user = "plataforma_user";
$password = "123456789a";
$database = "plataforma_videojocs";

// Connexió MySQLi
$conn = new mysqli($host, $user, $password, $database);

// Comprovació de la connexió
if ($conn->connect_error) {
    die("Error de connexió: " . $conn->connect_error);
}

echo "La connexió a la BD s'ha realitzat amb èxit!";
```

## Operacions CRUD (Create, Read, Update, Delete)

CRUD és un acrònim que representa les quatre operacions bàsiques que es poden realitzar sobre una base de dades:  

1. **Create (Crear)**: INSERT -> Inserir nous registres a la base de dades.  
2. **Read (Llegir)**: SELECT -> Consultar o recuperar registres existents.  
3. **Update (Actualitzar)**: UPDATE -> Modificar registres existents.  
4. **Delete (Esborrar)**: DELETE -> Eliminar registres existents.  

Aquestes operacions són la base de qualsevol aplicació que treballi amb dades. A continuació, es mostren exemples pràctics amb **PHP i MySQLi**

## Create (INSERT) - Registrar un nou usuari

### Formulari de Registre (crear_usuari_form.php)
```html
<form action="./crear_usuari.php" method="POST">
  <label>Nom d'usuari: <input type="text" name="nom_usuari"></label><br>
  <label>Email: <input type="text" name="email"></label><br>
  <label>Password: <input type="text" name="password"></label><br>
  <button type="submit">Crear usuari</button>
</form>
```

### Processar Registre d'Usuari (crear_usuari.php)
```php
<?php
require "./db_connect.php";

if (isset($_POST['nom_usuari'], $_POST['email'], $_POST['password'])) {
  $nom_usuari = $_POST['nom_usuari'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $sql = "INSERT INTO usuaris (nom_usuari, email, password_hash) VALUES ('$nom_usuari', '$email', '$password')";
  $conn->query($sql);
  echo "Usuari afegit a la base de dades!";
  $conn->close();
}
?>
```

## Read (SELECT) - Consultar dades d'un usuari

### Formulari de Consulta (consultar_usuari_form.php)
```html
<form action="./consultar_usuari.php" method="GET">
  <label>ID Usuari: <input type="text" name="id"></label><br>
  <button type="submit">Consultar</button>
</form>
```

### Processar Consulta d'Usuari (consultar_usuari.php)
```php
<?php
require "./db_connect.php";

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "SELECT * FROM usuaris WHERE id = $id";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $usuari = $result->fetch_assoc();
    echo "<p>Nom d'usuari: " . $usuari['nom_usuari'] . "</p>";
    echo "<p>Email: " . $usuari['email'] . "</p>";
  } else {
    echo "<p>No s'ha trobat cap usuari.</p>";
  }
  $conn->close();
}
?>
```

# Update (UPDATE) – Modificar el nom d’un usuari

### Formulari d'Actualització (actualitzar_usuari_form.php)
```html
<form action="./actualitzar_usuari.php" method="POST">
  <label>ID Usuari: <input type="text" name="id"></label><br>
  <label>Nou Nom d'usuari: <input type="text" name="nom_usuari"></label><br>
  <button type="submit">Actualitzar</button>
</form>
```

### Processar Actualització d'Usuari (actualitzar_usuari.php)
```php
<?php
require "./db_connect.php";

if (isset($_POST['id'], $_POST['nom_usuari'])) {
  $id = $_POST['id'];
  $nom_usuari = $_POST['nom_usuari'];
  $sql = "UPDATE usuaris SET nom_usuari = '$nom_usuari' WHERE id = $id";
  $conn->query($sql);
  echo "<p>Nom d'usuari actualitzat!<p>";
  $conn->close();
}
?>
```

# Delete (DELETE) - Eliminar un usuari

### Formulari d'Eliminació (eliminar_usuari_form.php)
```html
<form action="./eliminar_usuari.php" method="POST">
  <label>ID Usuari: <input type="text" name="id"></label><br>
  <button type="submit">Eliminar</button>
</form>
```

### Processar Eliminació d'Usuari (eliminar_usuari.php)
```php
<?php
if (isset($_POST['id'])) {
  $id = $_POST['id'];
  $sql = "DELETE FROM usuaris WHERE id = $id";
  $conn->query($sql);
  echo "<p>Usuari eliminat!<p>";
  $conn->close();
}
?>
```

## Bones Pràctiques de Seguretat amb BBDD (PHP + MySQL)

- Validar i sanitaritzar totes les dades que entren a la base de dades.
- Utilitzar consultes preparades (prepared statements) amb PDO o MySQLi per prevenir SQL Injection.
- Limitar permisos d’usuari de base de dades només al necessari per cada aplicació.
- Gestionar errors i excepcions sense mostrar informació sensible a l’usuari final.
- Fer còpies de seguretat periòdiques i mantenir connexions xifrades quan sigui possible.

`Validar i sanitaritzar` totes les dades d’entrada abans de fer cap consulta.

```php
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
```

Utilitzar sempre consultes preparades (`prepared statements`) amb PDO o MySQLi.

```php
$stmt = $pdo->prepare("SELECT * FROM usuaris WHERE email = :email");
$stmt->execute([':email' => $email]);
```

No utilitzar `addslashes()` ni concatenar dades directament en les consultes SQL.

Aplicar `hashing robust` a les contrasenyes (mai guardar-les en pla)

```php
$hash = password_hash($password, PASSWORD_DEFAULT);
$verificacio = password_verify($password, $hash);
```

Aplicar el `principi del menor privilegi`. L’usuari de la BBDD de l’aplicació ha de tenir només permisos estrictament necessaris (per exemple, SELECT, INSERT, UPDATE, DELETE, però no DROP ni GRANT) i que només pugui accedir a aquella Base de Dades i no a la resta de Bases de Dades existents.

`Gestionar errors` de manera segura: no mostrar informació sensible de la BBDD a l’usuari final.

```php
try {
    $pdo->query("SELECT ...");
} catch (PDOException $e) {
    error_log($e->getMessage()); // Log intern
    echo "Error en el sistema. Torna-ho a intentar més tard."; // Missatge genèric
}
```

`Tancar connexions` quan no siguin necessàries per evitar fugues de recursos.

```php
$pdo = null; // Tancar connexió
```

Fer `còpies de seguretat periòdiques` de la base de dades i emmagatzemar-les de forma segura.

Utilitzar `connexions xifrades (SSL/TLS)` si la BBDD és remota (mysqli_ssl_set() o paràmetres SSL amb PDO).

Evitar mostrar `dades sensibles` directament (per ex. escapar sempre la sortida amb htmlspecialchars() quan es mostren dades d’usuari).

No utilitzar `usuaris i contrasenyes per defecte` tant usuaris "admin" de la web com de la BBDD (no fer ús de root sense contrasenya).

Rotació periòdica de contrasenyes de BBDD i mantenir-les fora del codi font (`fitxers .env o variables d’entorn`).
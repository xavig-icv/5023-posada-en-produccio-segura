# 02. Gestió de Formularis i Dades

La **gestió de formularis** és una de les tasques més importants que ha de realitzar el desenvolupador web al backend. A través dels formularis els usuaris poden enviar informació al servidor: dades de registre d'usuari, dades per iniciar sessió, dades de contacte, comentaris en un post, text per realitzar cerques, etc, filtres de categories, etc.

Quan es realitza l'enviament, el servidor web rep les dades i les pot processar i emmagatzemar. PHP ofereix mecanismes senzills i potents per dur a terme aquestes tasques.

PHP proporciona eines integrades per capturar, processar i validar aquestes dades de manera eficient. No obstant això, **és importantíssim implementar validacions i controls de seguretat adequats** per protegir l'aplicació contra atacs com injeccions SQL, XSS i altres vulnerabilitats com el CSRF.

Tanmateix, la gestió d'informació no és només un procés de rebre i guardar la informació. Cal realitzar un **procés de validació i sanitització de les dades** per assegurar-se que aquestes siguin segures per l'aplicació.

Per tant, la gestió de formularis combina dos aspectes fonamentals:
- Funcionalitat: És necessari fer ús de formularis per permetre la interacció entre l'usuari i l'aplicació.
- Seguretat: És necessari tractar les dades rebudes per garantir la integritat i confidencialitat de les dades.

## Mètodes HTTP: GET i POST

Els formularis HTML poden utilitzar diferents mètodes per enviar dades al servidor. Els més comuns són **GET** i **POST**, cadascun amb les seves característiques i usos. Depenent del tipus d'acció a realitzar, es pot triar un mètode o un altre.

### Mètode GET

El mètode GET envia les dades del formulari afegint-les al final de la URL. Això fa que siguin visibles a la barra d’adreces del navegador, això permet tenir enllaços que es poden compartir, però també fa que sigui un mètode menys segur. S’utilitza principalment per a cerques i altres consultes on la informació no és sensible.

**Característiques del mètode GET:**
- Les dades s'envien a través de la URL, per tant són visibles (`formulari_get.php?cerca=laptop&categoria=tecnologia&preu_max=1500`)
- És pot compartir fàcilment com un enllaç (normalment són cerques amb filtres en una web).
- Es pot guardar com a marcador i les dades es guarden a l'historial del navegador
- **No és segur per enviar dades sensibles** tot i utilitzar el protocol HTTPS.

### Mètode POST

El mètode POST envia les dades dins del cos de la petició HTTP (no apareixen a la URL). Això el fa més adequat per a enviar informació privada com registres d'usuaris o inicis de sessió. També s'utilitza per formularis amb molta quantitat de dades o accions que modifiquen el contingut al servidor.

**Característiques del mètode POST:**
- Envia les dades al cos de la petició HTTP (no es mostren a la URL).
- No hi ha una limitació de mida d'informació a enviar.
- No es pot guardar com a marcador i No apareix a l'historial amb les dades
- **Més adequat per enviar dades sensibles** si s'utilitza el protocol HTTPS.

> ⚠️ **ADVERTÈNCIA:** Es realitzaran configuracions PHP vulnerables de manera intencionada que seran auditades, explotades i corregides al tema 03 - auditories de seguretat web.

### (Formulari GET) index_get.html 

```html
<!-- Formulari GET -->
<form action="./formulari_get.php" method="GET">
    <label for="nom">Nom del producte:</label>
    <input type="text" id="nom" name="nom" required>
    <label for="preu">Preu (€):</label>
    <input type="text" id="preu" name="preu" required>
    <button type="submit">Enviar</button>
  </form>
```

### (Processament GET) index_get.php 

**Atenció:** No es realitza una comprovació ni validació de les dades rebudes, només es mostren els resultats per pantalla.

PHP proporciona arrays superglobals per accedir a les dades enviades des del frontend. Aquests arrays estan disponibles en qualsevol àmbit sense necessitat de declarar-los.

- **$_SERVER**: Conté informació sobre el client, la petició actual i l'entorn del servidor (molt útil).
- **$_GET**: Conté totes les dades enviades mitjançant el mètode GET (paràmetres URL).
- **$_POST**: Conté totes les dades enviades mitjançant el mètode POST (cos de la petició).

```php
<?php
// formulari_get.php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $nom = $_GET['nom'] ?? '';
    $preu = $_GET['preu'] ?? 0;
    $rol = $_GET['rol'] ?? 'usuari';

    echo "<h2>Resultats de la cerca</h2>";
    echo "<p>Nom del producte: $nom </p>";
    echo "<p>Preu: $preu € </p>";
}
?>
```

### (Formulari POST) index_post.html

```html
<!-- Formulari POST -->
<form action="./formulari_post.php" method="POST">
    <label for="nom">Usuari:</label>
    <input type="text" id="nom" name="nom" required>
    <label for="password">Contrasenya:</label>
    <input type="password" id="password" name="password" required>
    <input type="hidden" name="rol" value="usuari">
    <button type="submit">Enviar</button>
</form>
```

### (Processament POST) index_post.php

**Atenció:** No es realitza una comprovació ni validació de les dades rebudes, només es mostren els resultats per pantalla.

```php
<?php
// formulari_post.php
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
```

## Validació de Dades: Client i Servidor

La validació de dades és essencial per mantenir la integritat i la seguretat d'una aplicació. És fonamental entendre els tipus de validacions:

### Validació al client (HTML5/JS)

- Es fa directament al navegador de l’usuari.
- Millora l’experiència d’usuari (evita enviar dades incorrectes abans de fer la petició).
- Exemples: camps obligatoris (required), comprovació de formats (type="email"), missatges en temps real d’errors.
- Limitació: Es pot desactivar o manipular fàcilment amb eines com DevTools o un proxy com Burp Suite.

### Validació al servidor (PHP)

- Es fa quan les dades arriben al servidor.
- És obligatòria per seguretat: minimitza el risc d'explotació de vulnerabilitats SQL, XSS, sobreescriptura de rols, etc.
- L’usuari no la pot evitar, tret que aconsegueixi comprometre el servidor.
- Exemple: comprovar que un número està dins d’un rang, verificar rols/permissions, validar formats amb funcions de sanitització, etc.

## Accions i Funcions de Validació i Sanitització amb PHP

### Comptabilitzar el nombre de paràmetres rebuts

`**count($_GET)` o `count($_POST)`** Verifica que s’han rebut el número de camps de formularis esperats.

### Existeix una variable o es buida

`**isset($variable)**` Comprova si una variable està definida i no és `null`.

`**empty($variable)**` Retorna `true` si la variable és buida.

### Escapat de caràcters especials

`**htmlspecialchars($string, ENT_QUOTES, 'UTF-8')**` Converteix els caràcters especials `<`, `>`, `"`, `'` en entitats HTML.

`**htmlentities($string, ENT_QUOTES, 'UTF-8')**` Similar a `htmlspecialchars`, però converteix tots els caràcters especials.

### Eliminació d’espais en blanc

`**trim($string)**` Elimina espais en blanc al principi i final de la cadena.

`**ltrim($string)**` i `**rtrim($string)**` Elimina espais en blanc només al principi (`ltrim`) o al final (`rtrim`) de la cadena.

### Validació amb expressions regulars

`**preg_match($pattern, $string)**` Comprova formats específics: noms, telèfons, codi postal, etc.

`**preg_replace($pattern, $replacement, $string)**` Permet substituir o eliminar patrons no desitjats d’una cadena.

### Filtres integrats de PHP

`**filter_var($valor, FILTER_VALIDATE_EMAIL)**` Valida un email.

`**filter_var($valor, FILTER_VALIDATE_URL)**` Valida una URL.

`**filter_input(INPUT_POST, 'camp', FILTER_SANITIZE_STRING)**` Sanititza directament dades de formularis.

`**filter_input_array(INPUT_POST, $arrayFiltres)**` Sanititza múltiples camps alhora segons els filtres definits.

### Comprovació de tipus i Conversió de tipus

`**is_numeric($valor)**` Verifica que el valor és un número o cadena numèrica.

`**is_int($valor)**`, `**is_float($valor)**`, `**is_string($valor)**`, `**is_bool($valor)**` Comprova que el valor sigui del tipus esperat.

`**(int)$variable**`, `**(float)$variable**`, `**(string)$variable**` Garantir que les dades tenen el tipus esperat abans de processar-les.

### Gestió d'arrays

`**is_array($variable)**` Comprova si és un array.

`**in_array($valor, $array)**` Comprova si un valor existeix dins d’un array.

`**count($array)**` Comprova el número d’elements d’un array.

### Altres funcions útils de sanitització

`**strip_tags($string)**` Elimina etiquetes HTML i PHP.

`**addslashes($string)**` Escapa cometes simples, dobles i backslashes (però vigilar amb les injeccions SQL).

### Gestió d’errors i missatges

Comprovar que les dades compleixen els requisits i, si no, generar errors clars per a l’usuari.

Registrar errors al servidor per auditories de seguretat.
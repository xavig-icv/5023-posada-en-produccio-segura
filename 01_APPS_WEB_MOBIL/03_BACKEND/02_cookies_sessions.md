# 02. Gestió de Cookies i Sessions

Les **cookies** i les **sessions** són eines molt importants per mantenir l'estat i la informació dels usuaris entre diferents peticions HTTP (i que no es perdi l'informació al navegar d'una pàgina a una altra). Com que HTTP és un protocol sense estat (stateless), aquestes tecnologies permeten emmagatzemar les preferències dels usuaris (cookies) i gestionar usuaris autenticats de manera segura (sessions) sense que aquests hagin d'introduir les seves preferències o credencials d'inici de sessió per cada nova pàgina que visiten.

- **Cookies:** Dades que s'emmagatzemen al navegador del client. Són útils per recordar preferències, configuracions o dades lleugeres.  
- **Sessions:** Dades que s'emmagatzemen al servidor. Permeten mantenir informació sensible com identificadors o rols d'usuari, sense exposar-les al client.

## Casos d'ús amb Cookies i Sessions

**Cookies:**
- **Preferències d'usuari**: Idioma, tema (fosc/clar), configuració de visualització
- **Cistella de compra**: Mantenir productes seleccionats a un ecommerce
- **Configuracions de jocs**: Volum, controls, dificultat personalitzada

**Sessions:**
- **Autenticació d'usuaris**: Mantenir usuaris loginats durant la navegació
- **Permisos i rols**: Controlar accés a diferents àrees de l'aplicació
- **Protecció CSRF**: Tokens de seguretat per validar formularis

> ⚠️ **ADVERTÈNCIA:** Es realitzaran configuracions PHP vulnerables de manera intencionada que seran auditades, explotades i corregides al tema 03 - auditories de seguretat web.

## Cookies amb PHP

Les cookies són petits fitxers de text que s'emmagatzemen al navegador de l'usuari i s'envien automàticament amb cada petició al mateix domini. Permeten recordar la informació entre diferents visites o pàgines. PHP proporciona funcions integrades per crear, llegir i eliminar cookies de manera senzilla.

### (Formulari de Cookies) index_cookies.php

```html
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
```

### (Processament de Cookies) processa_cookies.php

```php
<?php
//processa_cookies.php
if (isset($_GET['guardar'])) {
    setcookie('nomUsuari', $_GET['nomUsuari'], time() + 3600);
    setcookie('tema', $_GET['tema'], time() + 3600);
}

if (isset($_GET['eliminar'])) {
    setcookie('nomUsuari', '', time() - 3600);
    setcookie('tema', '', time() - 3600);
}

// Redirigir al HTML després de processar
header("Location: index_cookies.php");
exit;
?>
```

## Sessions amb PHP

Les sessions permeten guardar informació de l’usuari al servidor i mantenir-la entre diferents peticions. PHP assigna un identificador únic (PHPSESSID) que s’envia al client via cookie per vincular les peticions de l'usuari amb la sessió corresponent.

### (Formulari de Login) index_sessions.php

```php
<?php
//index_sessions.php
session_start();

// Si ja hi ha sessió iniciada, redirigir a la pàgina de perfil
if (isset($_SESSION['errors'])) {
  echo $_SESSION['errors'];
} else if(isset($_SESSION['usuari'])) {
    echo "Iniciada la sessió amb l'usuari" . $_SESSION['usuari'] . ", redirigint a perfil.php...";
}
?>

<h2>Login Usuari</h2>
<form method="POST" action="./processa_sessions.php">
  <label for="usuari">Usuari:</label>
  <input type="text" id="usuari" name="usuari" required>
  <label for="password">Contrasenya:</label>
  <input type="password" id="password" name="password" required>
  <button type="submit" name="login">Entrar</button>
</form>
```

### (Processament Login) processa_sessions.php

```php
<?php
//processa_sessions.php
session_start();

// Login de proves: només un usuari i password fixos
$usuariCorrecte = "pep";
$passwordCorrecte = "1234";

if(isset($_POST['login'])) {
    $usuari = $_POST['usuari'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if($usuari === $usuariCorrecte && $password === $passwordCorrecte) {
        $_SESSION['usuari'] = $usuari;
        unset($_SESSION['errors']);
    } else {
        $_SESSION['errors'] = "<p>Usuari o contrasenya incorrectes!</p>";
        unset($_SESSION['usuari']);
    }
    header("Location: index_sessions.php");
    exit;
}
?>
```

## Ús de Cookies i Sessions (Seguretat)

- Les cookies poden ser manipulades per l'usuari, per tant mai s'haurien d'utilitzar per emmagatzemar dades crítiques sense protecció.  
- Les sessions generen un identificador únic que es guarda en una cookie (`PHPSESSID` per defecte) i permet a PHP relacionar les peticions amb l'usuari correcte.  
- És recomanable utilitzar `session_start()` només quan és necessari i protegir les sessions amb `session_regenerate_id()` per evitar robatoris de sessió (session hijacking i session fixation).  
- Per a cookies sensibles, utilitzar les opcions `HttpOnly`, `Secure` i `SameSite` per minimitzar atacs CSRF.  

### Gestió de Sessions

`session_start()` Inicia una sessió o recupera una sessió existent. Ha de cridar-se al principi del document abans que l'HTML.

`session_regenerate_id(true)` Genera un nou ID de sessió per protegir contra session hijacking i session fixation.

`$_SESSION['nom'] = $valor;` Permet guardar informació de l'usuari a la sessió de manera segura (nom, rol, IP, etc.).

`$valor = $_SESSION['nom'];` Recupera dades emmagatzemades a la sessió de manera consistent entre peticions (entre pàgines).

`$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];` Guarda la IP del client per validar la sessió en futures peticions.

`$_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];` Guarda el User-Agent per detectar canvis sospitosos d'una sessió.

`unset($_SESSION['nom']);` Elimina variables específiques de la sessió actual.

`session_unset();` Elimina totes les variables de sessió però manté la sessió iniciada.

`session_destroy();` Finalitza la sessió, útil per tancar sessió (logout).

### Gestió de Cookies

Assegura que les cookies sensibles són només accessibles pel servidor (HttpOnly), enviades només via HTTPS (Secure) i amb restriccions SameSite per reduir riscos CSRF.

```php
setcookie(
    'nomCookie', 
    'valor', 
    [
        'expires' => time()+3600,
        'path' => '/', 
        'domain' => 'domini.cat', // Domini actual
        'secure' => true, // Només HTTPS
        'httponly' => true, // No accessible via JavaScript
        'samesite' => 'Strict' // Protecció contra CSRF
    ]
);
```
`$_COOKIE['nomCookie']` Permet llegir el valor de cookies de manera segura.

`setcookie('nomCookie', '', time() - 3600);` Expira la cookie immediatament per eliminar-la del navegador (1h abans de l'hora actual).

`session_set_cookie_params()` Defineix les opcions de les cookies de sessió abans de fer `session_start()` per millorar la seguretat.

```php
session_set_cookie_params([
    'lifetime' => 3600,
    'path' => '/',
    'domain' => 'domini.cat',
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Strict'
]);
```

`isset($_SESSION['rol']);` Comprova que les dades de sessió existeixen abans d'utilitzar-les.

`is_numeric($_SESSION['id']);` Comprova que les dades de la sessió són del tipus esperat.

**Evitar l'ús no autoritzat:** Validar que la IP del client i el User-Agent coincideixen amb els emmagatzemats a la sessió.

Utilitzar `htmlspecialchars()` en qualsevol sortida que intervinguin dades de sessió o cookies per evitar XSS.

Implementar `CSRF tokens` per a formularis sensibles: `$_SESSION['csrf_token'] = bin2hex(random_bytes(32));`

Configuracions PHP addicionals amb ini_set() per millorar la seguretat de sessions:
- `session.use_strict_mode = 1` només accepta ID de sessió generats pel servidor.

- `session.cookie_httponly = 1` cookies de sessió no accessibles via JS.

- `session.cookie_secure = 1` només accepta connexions HTTPS.

Registrar temps d’inici de sessió i **forçar el tancament de la sessió** després de X minuts de inactivitat.

### Resum de Vulnerabilitats

```
// VULNERABILITAT 1: Cookies sense protecció
Cookies enviades sense HttpOnly, Secure o SameSite poden ser robades o manipulades via XSS o CSRF.

// VULNERABILITAT 2: Session fixation
L'ID de sessió no es regenera després del login, permetent que un atacant fixi l'ID i accedeixi a la sessió.

// VULNERABILITAT 3: Sessions sense expiració
Sessions que no tenen temps límit permeten l'accés indefinit si l'usuari deixa el dispositiu desatès.

// VULNERABILITAT 4: Informació sensible en cookies
Guardar contrasenyes, tokens o rol d'usuari directament en cookies sense encriptació.

// VULNERABILITAT 5: No verificar origen de cookies
No comprovar IP, User-Agent o token de sessió pot permetre usuaris no autoritzats a reutilitzar cookies.

// VULNERABILITAT 6: XSS a través de dades de sessió
Mostrar contingut de $_SESSION o $_COOKIE directament al HTML sense escapament (htmlspecialchars).

// VULNERABILITAT 7: CSRF (Cross-Site Request Forgery)
Formularis que modifiquen dades sense verificar un token CSRF poden ser explotats per atacar un usuari autenticat.

// VULNERABILITAT 8: Robatori de sessió via sniffing
Sessions enviades sense HTTPS poden ser interceptades en xarxes no segures.

// VULNERABILITAT 9: Enumeració d’usuaris
Missatges d’error massa específics poden revelar quins usuaris existeixen al sistema.

// VULNERABILITAT 10: No controlar l’inici de sessió concurrent
Múltiples sessions actives amb el mateix usuari sense control poden ser un vector d’atac.

// VULNERABILITAT 11: Dades persistents en navegador
Guardar informació crítica en localStorage o sessionStorage sense protecció.
```
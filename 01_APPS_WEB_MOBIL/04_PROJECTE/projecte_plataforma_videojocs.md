# PROJECTE - PLATAFORMA DE VIDEOJOCS WEB

El projecte del TEMA 1 té com a objectiu dissenyar i desenvolupar una plataforma web de videojocs (frontend i backend) utilitzant HTML, CSS, JS, PHP i SQL. Al TEMA 5, s'haurà de realitzar el desplegament de l'aplicació de manera segura en un entorn de producció real (creant i configurant els diferents contenidors de Docker), realitzant l'auditoria de seguretat web corresponent i corregint les vulnerabilitats detectades.

## 1. INTRODUCCIÓ

Una empresa de videojocs indie vol crear una plataforma web per als seus jugadors. Actualment disposen de jocs independents però els volen centralitzar en una única plataforma on els usuaris puguin registrar-se, jugar, competir entre ells i realitzar el seguiment de les seves puntuacions. Per això, necessiten una aplicació web que integri els següents elements:

- **Un sistema web** on els usuaris puguin registrar-se, iniciar sessió i visualitzar els jocs disponibles.
- **Una plataforma de jocs** permeti accedir i jugar als diferents videojocs desenvolupats en JavaScript.
- **Un sistema de puntuació** que emmagatzemi el progrés i les puntuacions de cada jugador per cada joc.
- **Una classificació** que mostri els millors jugadors de cadascun dels jocs de la plataforma.
- **Una API** amb els valors per inicialitzar la partida d'un joc segons el nivell actual de cada usuari.
- **Un sistema de desplegament segur** utilitzant contenidors Docker i scripts de posada en producció.

**Durada del projecte a l'aula**: Projecte anual (12h Tema 1 + 8h Tema 3 + 12h hores Tema 5)

**Format/Organització**: Per parelles.

**Presentació**: Demostració funcional + documentació tècnica

## 2. OBJECTIUS DEL PROJECTE

- Comprendre l'arquitectura d'aplicacions web modernes (frontend - API - backend).
- Crear un model entitat relació i gestionar una base de dades relacional.
- Desenvolupar un projecte en equip amb les tecnologies HTML, CSS, JavaScript, PHP i MySQL.
- Implementar un sistema d'autenticació amb sessions PHP i comprendre la funcionalitat de les Cookies.
- Crear una petita API per realitzar la comunicació entre el frontend i el backend.
- Realitzar auditories de seguretat i implementar mesures de seguretat contra vulnerabilitats web (SQLi, XSS, CSRF, etc).
- Realitzar el desplegament de l'aplicació en un entorn de producció amb contenidors Docker.

## 3. ELEMENTS A ELABORAR I LLIURAR

### Desenvolupament:
- **1. Base de dades MySQL** amb el model ER complet (usuaris, jocs, nivells dels jocs, classificacions, etc.)
- **2. Frontend HTML i CSS** amb una interfície d'usuari minimalista, moderna i intuïtiva.
- **3. Un Videojoc o més amb JavaScript** que permetin diferents nivells de dificultat.
- **4. Backend PHP** amb un sistema de sessions, sistema CRUD de BBDD i una API funcional per la gestió dels jocs.

- **Sistema d'autenticació** amb registre, login, logout i perfil d'usuari.
- **API** de consulta que retorni un conjunt de paràmetres segons el joc, l'usuari i el nivell.
- **Classificació** amb una taula amb el rànking dels millors jugadors per cada joc actiu.
- **Desplegament** en un sistema de contenidors en xarxa.


### Documentació:
- Model Entitat-Relació de la base de dades i script SQL.
- Documentació de l'API com s'utilitza (endpoints, paràmetres, format de les respostes, etc.)
- Codi font en Github funcional, estructurat i comentat adequadament.
- Petit informe d'auditoria amb les vulnerabilitats detectades i les correccions aplicades.

### Presentació:
- Demostració funcional de la plataforma (registre, login, sessions, jocs, puntuacions, etc.)
- Anàlisi i explotació de vulnerabilitats (realitzar auditoria de seguretat i implementar mesures de seguretat contra vulnerabilitats web)
- Posada en producció segura (desplegament de la solució en un sistema de contenidors en xarxa)

## 4. ESPECIFICACIONS TÈCNIQUES

### Stack tecnològic:
- **Frontend**: HTML5, CSS3, JavaScript ES6+
- **Backend**: PHP 8.x amb sessions natives
- **Base de dades**: MySQL/MariaDB
- **Servidor web**: Apache/Nginx

### Requisits funcionals:
- **Registre i login** d'usuaris amb validacions al frontend i al backend.
- **Gestió del perfil** visualització i modificació de les dades dels usuaris.
- **Biblioteca de jocs** accessible només pels usuaris autenticats a la plataforma.
- **Seguiment de nivells** per cada usuari i joc s'emmagatzema el nivell actual i la puntuació.
- **Classificació per joc** que s'ha d'actualitzar en temps real segons el progrés dels usuaris.
- **API** encarregada d'obtenir la configuració inicial dels jocs segons l'usuari i el nivell.

### Requisits d'arquitectura:
- **Un contenidor frontend web** (Nginx/Apache) - nginx:alpine o httpd:alpine
- **Un contenidor backend API** (PHP + API) - php:apache
- **Un contenidor base de dades** (MySQL/MariaDB) - mariadb:latest o mysql:8.0

## 5. PROPOSTA MODEL ENTITAT-RELACIÓ

### Taules principals:

```sql
-- Taula d'usuaris
CREATE TABLE usuaris (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom_usuari VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    nom_complet VARCHAR(100),
    data_registre DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Taula de jocs
CREATE TABLE jocs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom_joc VARCHAR(50) NOT NULL,
    descripcio TEXT,
    puntuacio_maxima_possible INT,
    nivells_totals INT DEFAULT 1,
    actiu BOOLEAN DEFAULT TRUE
);

-- Taula de nivells dels jocs
CREATE TABLE nivells_joc (
    id INT PRIMARY KEY AUTO_INCREMENT,
    joc_id INT NOT NULL,
    nivell INT NOT NULL,
    nom_nivell VARCHAR(50),
    configuracio_json JSON NOT NULL,
    puntuacio_minima_acces INT DEFAULT 0,
    FOREIGN KEY (joc_id) REFERENCES jocs(id) ON DELETE CASCADE
);

-- Taula de progrés d'usuari
CREATE TABLE progres_usuari (
    id INT PRIMARY KEY AUTO_INCREMENT,
    usuari_id INT NOT NULL,
    joc_id INT NOT NULL,
    nivell_actual INT DEFAULT 1,
    puntuacio_maxima INT DEFAULT 0,
    partides_jugades INT DEFAULT 0,
    ultima_partida DATETIME,
    FOREIGN KEY (usuari_id) REFERENCES usuaris(id) ON DELETE CASCADE,
    FOREIGN KEY (joc_id) REFERENCES jocs(id) ON DELETE CASCADE
);

-- Taula de partides
CREATE TABLE partides (
    id INT PRIMARY KEY AUTO_INCREMENT,
    usuari_id INT NOT NULL,
    joc_id INT NOT NULL,
    nivell_jugat INT NOT NULL,
    puntuacio_obtinguda INT NOT NULL,
    data_partida DATETIME DEFAULT CURRENT_TIMESTAMP,
    durada_segons INT,
    FOREIGN KEY (usuari_id) REFERENCES usuaris(id) ON DELETE CASCADE,
    FOREIGN KEY (joc_id) REFERENCES jocs(id) ON DELETE CASCADE
);
```

### Relacions:
- Un **usuari** pot tenir molts **progres_usuari** (1 → N)
- Un **joc** pot tenir molts **nivells_joc** (1 → N)
- Un **usuari** pot jugar moltes **partides** (1 → N)
- Una **partida** està associada a un usuari i un joc específic

## 6. DETALLS DE L'API

### Endpoints dels jocs:
```
GET  /api/jocs                    → Llistar jocs disponibles (per verificar funcionalitat)
GET  /api/jocs/{id}/config        → Obtenir la configuració del joc de l'usuari actual
POST /api/jocs/{id}/puntuacio     → Guardar la puntuació d'una partida de l'usuari actual
GET  /api/jocs/{id}/classificacio → Classificació d'un joc concret
GET  /api/jocs/{id}/estadistiques → Estadístiques d'un usuari concret (id usuari)
```

### Exemple de la resposta JSON d'un nivell d'un joc:
```json
{
  "nivell": 2,
  "enemics": 3,
  "projectils": 6,
  "vides": 3,
  "punts": 600
}
```
## 7. JOCS A DESENVOLUPAR

### **Joc d'exemple - Naus vs Ovnis (introducció al DOM i la programació web)**
**Mecànica**: El jugador controla una nau espacial que ha d'evitar col·lisionar amb els ovnis i els ha de llençar projectils per destruir-los quan apareixen a la pantalla.
**Controls**: Fletxes per moure (a dalt i a baix) i l'espai per disparar.
**Objectiu**: Destruir tots els ovnis sense perdre les vides i passar al següent nivell.

### **Joc secundari (desenvolupament individual o per grups)**:

#### **1. Snake Clàssic**
- **Nivell 1**: Velocitat lenta, sense obstacles i mida màxima de la serp 10.
- **Nivell 2**: Velocitat lenta, sense obstacles i mida màxima de la serp 20.
- **Nivell 3**: Velocitat lenta, sense obstacles i mida màxima de la serp 30.
- **Nivell 4**: Velocitat mitjana amb obstacles fixes i mida màxima de la serp 20.
- **Nivell 5**: Velocitat mitjana amb obstacles fixes i mida màxima de la serp 30.
- **Nivell 6**: Velocitat mitjana amb obstacles fixes i mida màxima de la serp 50.
- **Nivell 7**: Velocitat alta amb obstacles aleatoris a la pantalla i mida màxima de la serp 30.
- **Nivell 8**: Velocitat alta amb obstacles aleatoris a la pantalla i mida màxima de la serp 50.
- **Nivell 9**: Velocitat alta amb obstacles aleatoris a la pantalla i mida màxima de la serp 70.
- **Nivell 10**: Velocitat alta amb obstacles aleatoris a la pantalla i sense mida màxima de la serp.

#### **2. Memory Game**

#### **3. Maze Game (laberint)**

#### **4. Atrapa Objectes o Esquiva Objectes**

#### **5. Quiz Game (preguntes i respostes)**

#### **6. Simon Says (de colors)**

#### **7. Flappy Bird**

#### **8. Pong o Ping Pong***

#### **9. Runner 2D amb salts**

#### **10. Plataformes 2D estil Mario**

## 8. FASES DEL PROJECTE (30 hores a l'aula)

### **Fase 1: Planificació i Adaptació de la Base de Dades** (2 hores)

- **Lectura detallada** de l'enunciat i resolució de dubtes sobre els requeriments.
- **Escollir el joc** a desenvolupar de la llista proposada o proposar un de diferent.
- **Planificació Kanban** amb quines tasques heu de realitzar i com les distribuiu entre el grup.
- **Adaptar el model ER i l'esquema SQL** segons les necessitats dels vostres requeriments afegits.
- **Inserir dades de prova** per facilitar el desenvolupament i les verificacions.

**Lliurament**:
- Cronograma detallat del projecte
- Justificació de les tasques escollides
- Justificació del joc escollit
- Diagrama ER actualitzat
- Script SQL de creació de la base de dades (pot entregar-se a la Fase 4)
- Script SQL amb dades de prova (pot entregar-se a la Fase 4)

### **Fase 3: Desenvolupament del Frontend** (8 hores)

- **Crear la interfície HTML i CSS** amb totes les pàgines inicialment necessàries.
- **Simular l'enviament de dades** fent ús de formularis HTML cap el backend.
- **Desenvolupar el videojoc** en JS i simular la inicialització d'un nivell amb un JSON de prova.
- **Implementar la lògica JavaScript** per interactuar amb l'API que es desenvoluparà amb PHP.

**Pantalles mínimes**:
- Pàgina d'inici (login + registre)
- Plataforma de jocs (perfil d'usuari + jocs disponibles)
- Pantalla del joc desenvolupat
- Classificació del joc

**Lliurament**:
- Codi HTML, CSS i JavaScript
- Videojoc funcional amb la inicialització d'un JSON de prova.

### **Fase 4: Desenvolupament del Backend PHP** (10 hores)

- **Configurar l'estructura** de carpetes del projecte PHP.
- **Implementar el sistema d'autenticació** amb sessions PHP.
- **Crear les funcions de base de dades** per a cada entitat.
- **Desenvolupar l'API** amb els endpoints especificats.

**Funcionalitats mínimes**:
- Registre i login d'usuaris
- Gestió de sessions PHP
- CRUD bàsic per a usuaris (jocs només si és possible, sinó inserir manualment).
- API endpoint per obtenir les variabels d'inicialització dels diferents nivells d'un joc.
- API endpoint per guardar puntuacions o utilitzar formularis per inserir les dades al finalitzar la partida.

**Lliurament**:
- Codi PHP estructurat i comentat
- Documentació de l'API desenvolupada
- Proves bàsiques de funcionament


### **Fase 5: Integració, Auditoria i Desplegament** (8 hores)

- **Connectar completament** el frontend amb el backend.
- **Auditar la seguretat** de l'aplicació contra vulnerabilitats SQLi, XSS, CSRF, etc.
- **Crear diferents contenidors** pel frontend, la API i el backend.
- **Configurar una xarxa virtual Docker** per la comunicació entre els contenidors.
- **Configurar el Desplegament** o orquestració del sistema amb Docker Compose.

**Proves mínimes a realitzar**:
- Registre i login d'usuaris.
- Funcionament correcte del joc amb els diferents nivells.
- Emmagatzematge de puntuacions i actualització de la classificació del joc.
- Validar la seguretat de l'aplicació amb proves d'injecció SQL, XSS i CSRF.
- Verificar la comunicació entre els diferents contenidors.

**Lliurament**:
- Aplicació completa funcional
- Informe de proves realitzades
- Documentació d'instal·lació i configuració (desplegament)

### **Fase 6: Documentació i Presentació** (2 hores)

- **Finalitzar la documentació** tècnica del projecte.
- **Preparar la demostració** del funcionament de la plataforma.
- **Redactar conclusions** sobre el desenvolupament del projecte.

**Lliurament final**:
- Codi complet comentat i estructurat
- Documentació tècnica completa
- Presentació funcional (5-10 minuts)

## 9. CRITERIS D'AVALUACIÓ

### **Funcionalitat (40%)**:
- Sistema de registre i d'autenticació segur i auditat.
- Videojoc funcional amb tots els nivells proposats als requeriments.
- API operativa per la inicialització de cada joc segons l'usuari.
- Base de dades correctament adaptada i amb dades suficients per la seva valoració.
- Classificació de cada joc i puntuacions individuals actualitzades en temps real per cada usuari.
- Cada servei funciona correctament en el seu contenidor Docker.

### **Codi i arquitectura (30%)**:
- Estructura del projecte clara i organitzada.
- Codi net, comentat i seguint bones pràctiques.
- Separació adequada del frontend i el backend.
- Gestió òptima de les dades i gestió d'errors adequada.
- La xarxa Docker està funciona correctament i els contenidors es comuniquen entre ells.
- La orquestració del sistema amb Docker Compose està ben configurada i documentada.

### **Interfície i experiència d'usuari (20%)**:
- Disseny atractiu i professional
- Navegació intuïtiva (menús i perfil d'usuari)
- Experiència del joc fluida (jugabilitat i mecàniques)

### **Documentació i presentació (10%)**:
- Documentació tècnica completa
- Model ER correcte i justificat
- Presentació oral convincent
- Conclusions coherents i reflexió sobre la seguretat de la plataforma

## Checklist de Seguretat

### Transport i Headers
- [ ] **HTTPS configurat** redirecció HTTP→HTTPS i ús de certificats no autosignats (Let's Encrypt amb renovació automàtica)
- [ ] **Headers de seguretat** (HSTS, CSP, X-Frame-Options, X-Content-Type-Options, Referrer-Policy, Permissions-Policy)
- [ ] **CORS limitat** a origens vàlids per l'ús de l'API

### Autenticació i Sessions
- [ ] **Autenticació robusta**: password_hash (bcrypt), política de contrasenyes (longitud, complexitat i historial), 2FA amb Google Auth, bloqueig del compte per número d'intents repetits, etc.
- [ ] **Sessions i cookies segures** (Secure, HttpOnly, SameSite flags, regenerar session_id al fer login, timeouts i logout per inactivitat)
- [ ] **Logout funcional** amb destrucció de la sessió.
- [ ] **Tokens CSRF** en formularis i l'API (login, canvi de password, registre, etc.).

### Validació i Escapar caràcters especials
- [ ] **Validació de tots els inputs** TOTES les dades introduïdes per l'usuari (al client i al servidor).
- [ ] **Escapada d'outputs** prevenint l'ús de caràcters especials (htmlspecialchars) per prevenir XSS. 
- [ ] **Prepared statements** amb consultes parametritzades per totes les queries SQL (cap concatenació d'inputs a SQL)
- [ ] **Rate limiting a mida** Per endpoints de l'API, login o registre per la protecció contra atacs de força bruta (control per IP, per usuari, per endpoint, etc.).
- [ ] **Protecció file uploading** (restriccions de mida, extensió (tipus MIME), escaneig del contingut (màgic numbers), emmagatzematge fora del webroot, etc).

### Base de Dades
- [ ] **Usuaris de BD específic per la app** amb permisos mínims (mai root). 
- [ ] **NO exposar ports** com el port 3306 externament (BD només a la xarxa interna de Docker)
- [ ] **Backups automàtics i restauracions comprovades** amb backups xifrats i amb la regla 3-2-1.

### Configuració del Servidor
- [ ] **Variables sensibles** en fitxers .env (fora del repositori) i .gitignore configurat.
- [ ] **Errors handling** missatges d'error genèrics. Els logs d'errors detallats només al servidor.
- [ ] **Logging centralitzat i monitoratge** (mètriques i alertes): Prometheus/Grafana/Loki/Zabbix, etc.

### Infraestructura
- [ ] **Contenidors no-root** executats amb usuaris específics amb limitació de recursos i health checks.
- [ ] **Secrets gestionats fora del repositori** (.env durant el desenvolupant i Docker secrets o Vault en producció).
- [ ] **Estratègia de rotació de claus i secrets** revocació i desplegament segur de secrets.
- [ ] **Restriccions de la xarxa Docker** separar els serveis per xarxes (frontend reverse proxy → backend → db "interna")

### DevOps i Testing
- [ ] **CI/CD segur**: Dependabot/actualitzacions, GitHub/GitLab Code Scanning, SAST (SonarQube / Snyk) i tests automàtics
- [ ] **Escaneig d'imatges i dependències** (Trivy, Snyk) periòdic; actualitzar imatges amb tags concrets (no utilitzar :latest)
- [ ] **Tests automatitzats**: unit test, integració i E2E (PHPUnit, Jest, Cypress/Playwright)

## RECURSOS

### Editors i Extensions
- [VS Code i Extensions (Enllaç Intern)](./../01_INTRO_WEB/02_vscode_extensions.md) - Visual Studio Code i Extensions Recomanades
- [PHPStorm](https://www.jetbrains.com/phpstorm/) - IDE específic per PHP de JetBrains
- [Sublime Text](https://www.sublimetext.com/) - Editor lleugere i ràpid

### Desenvolupament web (Frontend)
- [MDN Web Docs](https://developer.mozilla.org/) - JavaScript, HTML, CSS, APIs web (documentació oficial Mozilla)
- [W3C Web Standards](https://www.w3.org/standards/) - Estàndards web
- [Can I Use](https://caniuse.com/) - Compatibilitat de funcionalitats entre navegadors
- [Web.dev](https://web.dev/) - Guies de millors pràctiques per Google
- [HTML Living Standard](https://html.spec.whatwg.org/) - Especificació HTML
- [CSS Working Group](https://www.w3.org/Style/CSS/) - Especificacions CSS
- [ECMAScript Specification](https://tc39.es/ecma262/) - Especificació JavaScript

### Desenvolupament web (Backend)
- [PHP Manual oficial](https://www.php.net/manual/en/) - Documentació completa de PHP
- [PHP Standards Recommendations (PSR)](https://www.php-fig.org/psr/) - Estàndards de codificació PHP
- [Composer](https://getcomposer.org/) - Gestor de dependències per PHP
- [PHP Security Guide](https://www.php.net/manual/en/security.php) - Guia de seguretat PHP

### Bases de dades
- [MySQL Documentation](https://dev.mysql.com/doc/) - Guies i referències de MySQL
- [MariaDB Knowledge Base](https://mariadb.com/kb/en/) - Documentació de MariaDB

### Bases de dades: Eines de gestió
- [phpMyAdmin](https://www.phpmyadmin.net/) - Interfície web per MySQL/MariaDB
- [MySQL Workbench](https://www.mysql.com/products/workbench/) - Eina visual per MySQL
- [Adminer](https://www.adminer.org/) - Alternativa lleugera a phpMyAdmin

### Criptografia i autenticació
- [PHP password_hash (Argon2/Bcrypt)](https://www.php.net/manual/en/function.password-hash.php) - Funcions de hash PHP
- [PHP OpenSSL](https://www.php.net/manual/en/book.openssl.php) - Extensions de criptografia PHP
- [pragmarx/google2fa](https://github.com/antonioribeiro/google2fa) - Implementació 2FA/TOTP per PHP
- [Firebase JWT PHP](https://github.com/firebase/php-jwt) - Biblioteca JWT oficial per PHP
- [OWASP Authentication Cheat Sheet](https://cheatsheetseries.owasp.org/cheatsheets/Authentication_Cheat_Sheet.html)
- [NIST Cybersecurity Framework](https://www.nist.gov/cyberframework) - Estàndards oficials de seguretat

### Gestió de secrets i variables d'entorn
- [HashiCorp Vault](https://www.vaultproject.io/) - Gestor de secrets empresarial
- [Docker Secrets](https://docs.docker.com/engine/swarm/secrets/) - Gestió nativa de secrets en Docker
- [phpdotenv](https://github.com/vlucas/phpdotenv) - Gestió de variables d'entorn per PHP
- [12-Factor App Config](https://12factor.net/config) - Metodologia per la configuració

### Prevenció d'injeccions SQL
- [PDO prepare (PHP)](https://www.php.net/manual/en/pdo.prepare.php) - Documentació PDO
- [MySQLi prepared statements](https://www.php.net/manual/en/mysqli.quickstart.prepared-statements.php) - Alternativa oficial
- [OWASP SQL Injection Prevention](https://cheatsheetseries.owasp.org/cheatsheets/SQL_Injection_Prevention_Cheat_Sheet.html)

### Validació i Sanitització
- [PHP Filter Functions](https://www.php.net/manual/en/book.filter.php) - Funcions de validació PHP
- [Respect/Validation](https://respect-validation.readthedocs.io/) - Biblioteca de validació robusta per PHP
- [HTML Purifier](http://htmlpurifier.org/) - Sanitització segura d'HTML
- [OWASP Input Validation Cheat Sheet](https://cheatsheetseries.owasp.org/cheatsheets/Input_Validation_Cheat_Sheet.html)

### Rate Limiting i Protecció
- [Redis](https://redis.io/) - Base de dades en memòria per sessions i rate limiting
- [RateLimiter PHP](https://github.com/touhonoob/RateLimiter) - Rate limiting amb Redis
- [Fail2Ban](https://www.fail2ban.org/) - Protecció contra atacs de força bruta (el recomano)
- [iptables Documentation](https://netfilter.org/documentation/) - Firewall a nivell de sistema (recomano la configuració)

### Servidors Web i Reverse Proxy
- [Apache HTTP Server](https://httpd.apache.org/) - Servidor web (el recomano al backend amb php)
- [Nginx](https://nginx.org/) - Servidor web oficial d'alt rendiment (recomano al frontend com reverse proxy)
- [Apache Security Tips](https://httpd.apache.org/docs/2.4/misc/security_tips.html) - Guia de seguretat d'Apache
- [Nginx Security Controls](https://nginx.org/en/docs/http/ngx_http_secure_link_module.html) - Mòduls de seguretat Nginx
- [HAProxy](https://www.haproxy.org/) - Load balancer i reverse proxy (el recomano).
- [Traefik](https://traefik.io/) - Reverse proxy modern amb SSL automàtic

### Seguretat SSL/TLS
- [Let's Encrypt](https://letsencrypt.org/) - Certificats SSL gratuïts
- [Certbot](https://certbot.eff.org/) - Client Let's Encrypt
- [Mozilla SSL Configuration Generator](https://ssl-config.mozilla.org/) - Configuració SSL
- [Security Headers](https://securityheaders.com/) - Verificació headers de seguretat
- [OpenSSL Documentation](https://www.openssl.org/docs/) - Documentació OpenSSL

### Gestió d'APIs i Testing
- [Postman](https://www.postman.com/) - Plataforma per testing d'APIs
- [Insomnia](https://insomnia.rest/) - Client REST alternativa a Postman
- [Swagger/OpenAPI](https://swagger.io/) - Especificació per documentar APIs
- [curl Documentation](https://curl.se/docs/) - Eina (navegador) de línia de comandes per HTTP

### Control de Versions
- [Git](https://git-scm.com/) - Sistema de control de versions
- [GitHub](https://github.com/) - Plataforma de repositoris Git
- [GitLab](https://gitlab.com/) - Plataforma amb CI/CD integrat
- [Git Documentation](https://git-scm.com/doc) - Documentació completa Git
- [Pro Git Book](https://git-scm.com/book) - Llibre oficial gratuït de Git
- [Git Cheat Sheet](https://education.github.com/git-cheat-sheet-education.pdf) - Referència Git

### Docker i Containerització
- [Docker Documentation](https://docs.docker.com/) - Documentació oficial completa
- [Docker Hub](https://hub.docker.com/) - Registre de contenidors Docker
- [Docker Compose](https://docs.docker.com/compose/) - Orquestració de contenidors Docker
- [Docker Best Practices](https://docs.docker.com/develop/dev-best-practices/) - Guia oficial
- [Docker Security](https://docs.docker.com/engine/security/) - Documentació de seguretat en Docker
- [Docker Networks](https://docs.docker.com/network/) - Documentació de xarxes Docker
- [Watchtower](https://containrrr.dev/watchtower/) - Actualització automàtica de contenidors

### Docker: Imatges base oficials
- [PHP Official Image](https://hub.docker.com/_/php) - Imatge PHP
- [Apache Official Image](https://hub.docker.com/_/httpd) - Imatge Apache
- [Nginx Official Image](https://hub.docker.com/_/nginx) - Imatge Nginx
- [MariaDB Official Image](https://hub.docker.com/_/mariadb) - Imatge MariaDB
- [MySQL Official Image](https://hub.docker.com/_/mysql) - Imatge MySQL
- [Redis Official Image](https://hub.docker.com/_/redis) - Imatge Redis
- [Alpine Linux](https://hub.docker.com/_/alpine) - Imatges lleugeres
- [Ubuntu](https://hub.docker.com/_/ubuntu) - Imatge Ubuntu

### Testing i Qualitat del Codi
- [PHPUnit](https://phpunit.de/) - Framework de testing per PHP
- [Jest](https://jestjs.io/) - Framework de testing per JavaScript
- [Cypress](https://www.cypress.io/) - Framework de testing E2E
- [Playwright](https://playwright.dev/) - Framework E2E de Microsoft
- [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) - Eina per estàndards de codi PHP
- [PHPStan](https://phpstan.org/) - Anàlisi estàtic de codi per PHP
- [ESLint](https://eslint.org/) - Linter per JavaScript

### Escaneig de Vulnerabilitats
- [Burp Suite Community](https://portswigger.net/burp/communitydownload) - Proxy i pentesting manual
- [OWASP ZAP](https://www.zaproxy.org/) - Proxy i pentesting automatitzat
- [sqlmap](https://sqlmap.org/) - Eina per detectar SQL injection
- [SonarQube](https://www.sonarqube.org/) - Plataforma d'anàlisi de qualitat del codi
- [Snyk](https://snyk.io/) - Escàner de dependències vulnerables
- [Trivy](https://trivy.dev/) - Escàner de vulnerabilitats en contenidors
- [Dependabot](https://github.com/dependabot) - Actualització automàtica GitHub
- [OWASP Dependency-Check](https://owasp.org/www-project-dependency-check/) - Escàner OWASP

### Monitoring i Logging
- [Prometheus](https://prometheus.io/) - Sistema de monitoratge de sistemes
- [Grafana](https://grafana.com/) - Plataforma de visualització de dades de monitorització
- [Loki](https://grafana.com/oss/loki/) - Agregació de logs by Grafana
- [ELK Stack](https://www.elastic.co/elk-stack) - Stack ELK (Elasticsearch, Logstash, Kibana)
- [Zabbix](https://www.zabbix.com/) - Plataforma de monitoratge empresarial
- [Syslog](https://tools.ietf.org/html/rfc3164) - Protocol de logging /var/log/syslog
- [systemd Journal](https://www.freedesktop.org/software/systemd/man/systemd-journald.service.html) - Sistema de logs Linux

### Backup i Recuperació
- [mysqldump](https://dev.mysql.com/doc/refman/8.0/en/mysqldump.html) - Eina per realitzar backups MySQL/MariaDB
- [rsync](https://rsync.samba.org/) - Eina de sincronització (la recomano).
- [Restic](https://restic.net/) - Backup amb xifratge
- [Borg Backup](https://www.borgbackup.org/) - Backup amb deduplicació

### Eines de desplegament i CI/CD
- [GitHub Actions](https://docs.github.com/en/actions) - CI/CD amb GitHub
- [GitLab CI/CD](https://docs.gitlab.com/ee/ci/) - CI/CD amb GitLab
- [Jenkins](https://www.jenkins.io/) - Servidor d'automatització CI/CD
- [GitHub Security Features](https://docs.github.com/en/code-security) - Seguretat a GitHub
- [GitLab Security](https://docs.gitlab.com/ee/user/application_security/) - Seguretat a GitLab

### File Upload Security
- [PHP File Upload](https://www.php.net/manual/en/features.file-upload.php) - Documentació oficial PHP per file uploading
- [OWASP File Upload Cheat Sheet](https://cheatsheetseries.owasp.org/cheatsheets/File_Upload_Cheat_Sheet.html) - Guia oficial d'OWASP per File Uploading
- [libmagic PHP (fileinfo)](https://www.php.net/manual/en/book.fileinfo.php) - Detecció del MIME type

### Estàndards i Millors Pràctiques
- [OWASP Top 10](https://owasp.org/www-project-top-ten/) - Top 10 oficial de vulnerabilitats web
- [OWASP Cheat Sheet Series](https://cheatsheetseries.owasp.org/) - Guies oficials de seguretat
- [SANS Secure Coding Practices](https://www.sans.org/white-papers/2172/) - Pràctiques oficials de codificació segura
- [CWE (Common Weakness Enumeration)](https://cwe.mitre.org/) - Enumeració oficial de debilitats de seguretat
- [CVE (Common Vulnerabilities and Exposures)](https://cve.mitre.org/) - Base de dades oficial de vulnerabilitats

### Tutorials i Recursos d'Aprenentatge
- [Docker for Beginners](https://docker-curriculum.com/) - Tutorial complet de Docker
- [Dockerizing PHP Applications](https://www.digitalocean.com/community/tutorials/how-to-containerize-a-php-application-for-development-with-docker-compose) - Tutorial específic PHP i contenidors
- [Mozilla Developer Network Learning](https://developer.mozilla.org/en-US/docs/Learn) - Recursos oficials d'aprenentatge web
- [PHP: The Right Way](https://phptherightway.com/) - Guia de millors pràctiques amb PHP
- [Awesome PHP](https://github.com/ziadoz/awesome-php) - Llista de recursos PHP
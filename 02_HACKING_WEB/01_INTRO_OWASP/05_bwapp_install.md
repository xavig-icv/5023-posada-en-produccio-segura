# 05. Instal·lació de Bee-Box + bWAPP (buggy Web Application)

Bee Box és una màquina virtual amb un entorn LAMP plena de vulnerabilitats que disposa d'una aplicació web bWAPP (buggy Web Application) desenvolupada amb PHP intencionadament vulnerable que planteja més de 100 vulnerabilitats o escenaris per pràcticar el pentesting web.

- **Versió**: bWAPP 2.2 (última versió estable)
- **Vulnerabilitats**: 100+ bugs diferents
- **Stack**: PHP + MySQL (LAMP en el nostre cas)
- **Creador**: Malik Mesellem (itsecgames.com)

### **Complementa DVWA i Juice Shop**

| Aplicació      | Enfocament               | Nivell             |
| -------------- | ------------------------ | ------------------ |
| **DVWA**       | Vulnerabilitats bàsiques | Principiant        |
| **Juice Shop** | Apps modernes (SPA, API) | Intermig           |
| **bWAPP**      | Catàleg exhaustiu        | Practicar variants |

## Descàrrega del Disc Virtual de Bee Box

**Web oficial**: [http://www.itsecgames.com/](http://www.itsecgames.com/)

**Descàrrega directa**:

- **bWAPP OVA**: [SourceForge - Bee Box](https://sourceforge.net/projects/bwapp/files/bee-box/)
- **Mida**: 1.1 GB (7z)
- **Format**: .vmdk

## Importació a VirtualBox

### **Pas 1: Crear la màquina i importar el VMDK a Virtualbox**

**Crear una nova màquina**

- VM Name: Bee-Box
- ISO Image: Not selected
- OS Version: Ubuntu 12.10 (32 bits)
- RAM: 2048 MB
- CPU: 1 core
- Use and existing hard disk: bee-box.vmdk

### **Pas 2: Configurar la xarxa**

#### **Opcions de xarxa**

**Opció A: NAT Network** (Recomanada i a la mateixa xarxa que el Kali Linux)

- La VM pot sortir a Internet
- Host pot accedir a la VM
- Màquines d'altres xarxes NO poden accedir

**Opció B: Adaptador Pont** (Per disposar d'accés des de la xarxa cablejada del centre)

- La VM obté IP de la xarxa local
- Accessible des de qualsevol màquina de la xarxa
- Menys segur (tot i que és dintre del centre)

### **Pas 3: Iniciar la VM**

1. **Seleccionar la VM `bWAPP`**

2. **Veure la IP assignada**
   - La VM mostrarà la seva IP a la pantalla de login
   - Format: `bee-box login: (IP: 172.16.33.x)`

## Credencials per defecte

### **Sistema operatiu (Ubuntu)**

| Usuari | Password |
| ------ | -------- |
| `bee`  | `bug`    |
| `root` | `bug`    |

### **bWAPP (aplicació web)**

| Usuari   | Password | Rol           |
| -------- | -------- | ------------- |
| `bee`    | `bug`    | Administrador |
| `A.I.M.` | `bug`    | Usuari normal |

### **MySQL**

| Usuari  | Password |
| ------- | -------- |
| `root`  | `bug`    |
| `bwapp` | `bug`    |

## Accedir a bWAPP

1. **Saber la IP de la VM**

   - Visible a la pantalla de login
   - Exemple: `172.16.33.X`

2. **Accedir a bWAPP**:

   ```
   http://IP_DE_LA_VM/bWAPP/
   ```

3. **Login**:
   - **Username**: `bee`
   - **Password**: `bug`

## Configurar el nivell de seguretat

**Clic a "Set your security level"** (menú superior dret)

**Escollir nivell**:

- **Low**: Cap protecció (començar aquí)
- **Medium**: Proteccions bàsiques
- **High**: Proteccions avançades

## Vulnerabilitats disponibles

### **A1 - Injection**

- SQL Injection (GET/POST/Search/Login/etc.)
- OS Command Injection
- PHP Code Injection
- Server-Side Includes (SSI) Injection
- XML/XPath Injection
- LDAP Injection
- iFrame Injection
- Mail Header Injection

### **A2 - Broken Auth & Session Management**

- Broken Authentication - CAPTCHA Bypassing
- Broken Authentication - Forgotten Function
- Broken Authentication - Insecure Login Forms
- Broken Authentication - Logout Management
- Broken Authentication - Password Attacks
- Broken Authentication - Weak Passwords
- Session Management - Administrative Portals
- Session Management - Cookies (HTTPOnly)
- Session Management - Cookies (Secure)
- Session Management - Session ID in URL
- Session Management - Strong Sessions

### **A3 - Cross-Site Scripting (XSS)**

- XSS - Reflected (GET/POST/URL/etc.)
- XSS - Stored (Blog/Cookies/etc.)
- XSS - DOM-Based

### **A4 - Insecure Direct Object References**

- IDOR - Change Secret
- IDOR - Reset Secret
- IDOR - Order Tickets

### **A5 - Security Misconfiguration**

- Cross-Domain Policy File
- Cross-Origin Resource Sharing
- Host Header Attack (Cache Poisoning)
- Host Header Attack (Reset Poisoning)
- Information Disclosure - Headers
- Information Disclosure - Robots File
- XML External Entity (XXE)

### **A6 - Sensitive Data Exposure**

- Base64 Encoding
- Clear Text HTTP
- Credentials over HTTP
- BEAST/CRIME/BREACH Attacks
- Heartbleed Vulnerability
- Host Header SSL Attack
- Man-in-the-Middle Attack
- SSL 2.0 Deprecated Protocol
- Text Files

### **A7 - Missing Function Level Access Control**

- Directory Traversal - Directories
- Directory Traversal - Files
- Host Header Attack (Reset Poisoning)
- Insecure WebDAV Configuration
- Local File Inclusion
- Remote File Inclusion
- Restrict Device Access
- Restrict Folder Access
- Server Side Request Forgery (SSRF)

### **A8 - Cross-Site Request Forgery (CSRF)**

- CSRF (Change Password)
- CSRF (Change Secret)
- CSRF (Transfer Amount)

### **A9 - Using Components with Known Vulnerabilities**

- Buffer Overflow (Local)
- Buffer Overflow (Remote)
- Drupal SQL Injection (Drupageddon)
- Heartbleed Vulnerability (SSL/TLS)
- PHP CGI Remote Code Execution
- PHP Eval Function
- phpMyAdmin BBCode Tag XSS
- Shellshock Vulnerability (CGI)

### **A10 - Unvalidated Redirects & Forwards**

- Unvalidated Redirects & Forwards (1, 2, 3)

### **Altres vulnerabilitats**

- Broken Authentication - Admin Portal
- ClickJacking
- HTML Injection - Reflected (GET/POST/URL)
- AJAX/JSON/jQuery Issues
- Denial-of-Service Attacks
- Insecure FTP Configuration
- Insecure SNMP Configuration
- Insecure WebDAV Configuration
- PHP Code Injection

**Total**: 100+ vulnerabilitats úniques!

## Comparativa amb DVWA

| Característica      | DVWA                    | bWAPP               |
| ------------------- | ----------------------- | ------------------- |
| **Vulnerabilitats** | ~10                     | 100+                |
| **Variants**        | Poques                  | Moltes              |
| **Nivells**         | Low/Med/High/Impossible | Low/Med/High        |
| **Documentació**    | Bàsica                  | Molt detallada      |
| **Interfície**      | Simple                  | Més completa        |
| **Bugs poc comuns** | No                      | Sí (XXE, LDAP, SSI) |
| **Millor per**      | Començar                | Aprofundir          |

## Recursos addicionals

### **Documentació oficial**

- **Web oficial**: [http://www.itsecgames.com/](http://www.itsecgames.com/)
- **Manual PDF**: Inclòs a la VM a `/home/bee/bWAPP/`
- **SourceForge**: [https://sourceforge.net/projects/bwapp/](https://sourceforge.net/projects/bwapp/)

### **Tutorials i writeups**

- **YouTube**: Buscar "bWAPP walkthrough"
- **Blog posts**: Múltiples writeups disponibles online
- **OWASP**: Recomanacions i guies

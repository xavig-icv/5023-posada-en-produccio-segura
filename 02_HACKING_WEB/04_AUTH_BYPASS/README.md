# Bloc 04. Introducció a la vulnerabilitat Authorization Bypass

La vulnerabilitat **Broken Access Control** o **Authorization Bypass** (Trencament de l'Autorització) és una vulnerabilitat que es produeix quan una aplicació web **no verifica correctament els permisos d'un usuari ja autenticat** abans de permetre-li accedir a recursos o executar accions. Això permet a un atacant accedir a funcionalitats o dades per a les quals no té autorització, suplantar altres usuaris o escalar privilegis dins de l'aplicació.

## Authentication vs Authorization

A anterior sessions us he comentat que és fonamental entendre la diferència:

- **Autenticació. Qui ets?** Accés mitjançant login amb usuari i contrasenya
- **Autorització. Què pots fer?** Un cop autenticat, amb el rol d'usuari que tinguis, quines són les accions que tens permeses i quines no.

## Vectors d'atac a l'autorització

Els atacants poden fer bypass de l'autorització fent ús de diverses tècniques:

### **1. Modificant paràmetres de la URL**

- IDs d'objectes directes (IDOR)
- Paràmetres de rol o altres permisos manipulables
- Paths d'accés que es poden predir

**Exemple d'IDOR**:

```
https://web.cat/perfil?user_id=123   → Veure el teu perfil
https://web.cat/perfil?user_id=433   → Veure perfil d'un altre usuari (IDOR!)
```

### **2. Tokens i cookies**

- JWT (JSON Web Tokens) que permeten canviar el rol o l'ID d'usuari
- Cookies que guarden el rol d'usuari o de permisos en text pla
- Session tokens sense verificació al servidor (permet modificar i reutilitzar)

**Exemple**:

```http
Cookie: role=user → Modificar a: role=admin
```

### **3. Headers HTTP**

- Headers personalitzats amb informació de rol o permisos
- Headers com X-User-Role, X-Admin, etc. que es poden manipular.
- Headers que es poden afegir o modificar i alterin el procés d'autorització.

**Exemple**:

```http
GET /admin HTTP/1.1
X-User-Role: admin    ← Afegit per l'atacant
```

### **4. Mètodes HTTP**

- GET vs POST vs PUT vs DELETE. Ús d'altres mètodes per saltar-se les restriccions.
- PATCH, OPTIONS, HEAD. Mètodes que poden permetre consultar informació o descobrir funcionalitats de l'aplicació.
- Bypass de restriccions fent ús d'un mètode diferent a l'esperat per l'aplicació.

**Exemple**:

```
GET /admin    → 403 Forbidden
POST /admin   → 200 OK (bypass!)
```

## Tipus de vulnerabilitats d'autorització

### **1. IDOR (Insecure Direct Object References)**

Accés a recursos (fitxers, perfils, documents, etc.) d'altres usuaris simplement modificant un identificador.

**Exemples vulnerables**:

```
GET /api/invoice/123     → Factura pròpia
GET /api/invoice/124     → Factura d'un altre usuari (IDOR!)

GET /download?file=myfoto.jpg           → Foto meva de perfil
GET /download?file=../../../etc/passwd  → Fitxer intern del sistema (Directory traversal!)
```

### **2. Path Traversal / LFI / RFI**

Accedir a fitxers o directoris fora del path autoritzat.

**Exemples**:

```
GET /download?file=report.pdf             → OK
GET /download?file=../config/database.php → Vulnerabilitat!
GET /download?file=../../../../etc/passwd → Vulnerabilitat!
```

**Variants de Path Traversal amb encoding**:

```
../        → Sense encoding
..%2f      → URL encoding
..%252f    → Double URL encoding
..%c0%af   → UTF-8 overlong encoding
```

### **3. File Upload**

Pujar al servidor fitxers maliciosos que poden executar-se

```
Input: shell.php (webshell bàsica)
Upload: /var/www/html/uploads/shell.php
Accés: http://servidor.cat/uploads/shell.php?cmd=whoami
Resultat: Execució de comandes al servidor!
```

### **4. Role-Based Access Control (RBAC) Bypass**

Manipular o saltar-se els controls basats en rols.

**Exemple amb cookie**:

```http
Cookie: user_role=customer → Modificar a: user_role=admin
```

**Exemple amb JWT**:

```json
{
  "user": "pepet",
  "role": "user"
}
→ Modificar a:
{
  "user": "pepet",
  "role": "admin"
}
```

### **5. JWT (JSON Web Token) Attacks**

**JWT Format**:

```
header.payload.signature
eyJhbGc...  .  eyJ1c2Vy...  .  SflKxwRJ...
```

**Atacs comuns**:

**a) Algorithm Confusion (No indicar cap algorisme)**:

```json
// Header original
{
  "alg": "HS256",
  "typ": "JWT"
}

// Modificat per l'atacant
{
  "alg": "none",   ← Cap signatura!
  "typ": "JWT"
}
```

**b) Weak Signing Key**:

```
Secret: "secret123"  ← Massa feble, es pot fer força bruta
```

**c) JWT Injection**:

```json
// Payload original
{
  "user": "pepet",
  "role": "user"
}

// Modificat
{
  "user": "pepet",
  "role": "admin",    ← Canviat!
  "admin": true       ← Afegit!
}
```

### **6. HTTP Verb Tampering**

Canviar el mètode HTTP per saltar-se les restriccions.

**Exemple**:

```http
GET /admin HTTP/1.1      → 403 Forbidden

POST /admin HTTP/1.1     → 200 OK (Bypass!)

PUT /admin HTTP/1.1      → 200 OK (Bypass!)

DELETE /admin HTTP/1.1   → 200 OK (Bypass!)
```

### **7. Parameter Pollution**

Enviar múltiples vegades el mateix paràmetre amb diferents valors.

**Exemple**:

```
GET /transfer?amount=100&amount=1000&to=attacker
```

**Comportament segons el tipus de servidor**:

- Apache: Primer valor (100)
- PHP: Últim valor (1000)
- Node.js: Array [100, 1000]

### **8. Missing Function Level Access Control**

L'aplicació disposa de funcionalitats ocultes però no estàn protegides.

**Exemple**:

```
https://app.com/user/dashboard     → Accessible per users
https://app.com/admin/dashboard    → Ocult però NO protegit!
```

**Descobriment per força bruta**:

- Directory fuzzing (gobuster, ffuf, wfuzz)
- Verificar el JavaScript per trobar endpoints ocults

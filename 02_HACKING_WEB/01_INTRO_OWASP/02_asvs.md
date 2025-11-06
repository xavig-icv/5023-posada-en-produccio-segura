# 02. Application Security Verification Standard (ASVS)

## 2.1 Què és ASVS?

L'Application Security Verification Standard (ASVS) és un estàndard obert desenvolupat per OWASP que defineix un conjunt de requisits de seguretat per aplicacions web. El seu objectiu és definir una base comuna que permeti verificar el nivell de seguretat d'una aplicació mitjançant un conjunt de proves o auditories estructurades.

L'ASVS descriu controls de seguretat funcionals i no funcionals, organitzats per nivells de criticitat, i fa de a guia tant per a desenvolupadors com per a auditors de seguretat.

### **Objectius d'ASVS:**

- Establir un marc de referència estandarditzat per avaluar la seguretat de les aplicacions.
- Definir nivells de verificació o criticitat (1, 2 i 3) adaptats al risc i el tipus de dades (tipus de dades sensibles).
- Proporcionar uns requisits específics, mesurables i verificables per a cada àrea de seguretat.
- Ser independent de la tecnologia o el llenguatge (es pot aplicar en qualsevol entorn de desenvolupament).
- Facilitar la comunicació i els objectius dels equips o actors implicats (desenvolupadors, auditors i clients).

### **Versió actual: ASVS 5.0 (2025)**

- Inclou 17 categories amb diferents requisits de seguretat (V1, V2, V3 ... V17).
- Disposa aproximadament de 350 controls de verificació, classificats segons el nivell de seguretat.
- Dona suport a arquitectures modernes (APIs, microserveis, entorns al núvol, etc.).

Exemple: https://github.com/OWASP/ASVS/blob/master/5.0/OWASP_Application_Security_Verification_Standard_5.0.0_en.pdf

```
V6.2.1 (associat al nivell 1)

V6 → Categoria 6: Authentication
.2 → Subcategoria: Password Security
.1 → Primer requisit d'aquesta subcategoria: Verify that user set passwords are at least 8 characters in length although a
minimum of 15 characters is strongly recommended.
```

## 2.2 Els 3 nivells de verificació ASVS

L'ASVS defineix 3 nivells de verificació de seguretat en funció de la criticitat, la sensibilitat de les dades i l'exposició o l'abast de l'aplicació. Aquests nivells permeten ajustar l'esforç i la profunditat de les proves segons el risc real del sistema.

- Nivell 1: Aplicació de baix risc (ús d'escàners automàtics i proves bàsiques de seguretat)
- Nivell 2: Aplicació de mig risc (auditoria manual i revisió inicial del codi font)
- Nivell 3: Aplicació d'alt risc (pentesting avançat, revisió completa del codi font i anàlisi de tota l'arquitectura, el disseny)

### **Level 1: Oportunistic**

**Descripció**: Està orientat a aplicacions de baix risc o d'ús intern, on l'impacte d'una explotació és limitat o dificil que es pugui produïr. L'objectiu d'aquest nivell és avaluar els errors de seguretat més comuns i evidents, generalment relacionats amb les vulnerabilitats de l'OWASP Top 10 fent ús d'escàners automàtics o scripts que avaluen la seguretat bàsica de l'aplicació.

**Característiques principals**:

- Escaneig automàtic: La gran majoria de les proves es poden realitzar amb eines o scripts.
- Testing de caixa negra: No cal conèixer l'aplicació (ni el codi font ni el funcionament intern del sistema o serveis en ús).
- Eines típiques: OWASP ZAP, Burp Suite Scanner, Nikto, Nessus, Gobuster, etc.
- Temps estimat: Aproximadament 1-5 dies, segons l'abast i la complexitat de l'aplicació.

**Aplicacions òptimes pel nivell 1**:

- Aplicacions internes, d'ús limitat i que no gestionen dades sensibles.
- Prototips o aplicacions en fase de demo.
- Sistemes, serveis o mòduls accessibles externament però de baix impacte per a l'organització.

**Cobertura del nivell 1**:

- Vulnerabilitats que es recullen a l'OWASP Top 10 (XSS, SQLi, IDOR, SSRF, etc.).
- Configuracions insegures (atacs de força bruta bàsics, fitxers exposats al servidor web o credencials per defecte).

**Limitacions**:

- No permet detectar vulnerabilitats complexes o de lògica de negoci
- No avalua els controls de seguretat interns o de codi font.
- Pot generar falsos positius o reportar resultats incomplets.

**Exemple de requisits Nivell 1**:

```
V1.2.4 - Verify that data selection or database queries (e.g., SQL, HQL, NoSQL, Cypher) use parameterized queries, ORMs, entity frameworks, or are otherwise protected from SQL Injection and other database injection attacks.

V1.2.5 -  Verify that the application protects against OS command injection and that operating system calls use parameterized OS queries or use contextual command line output encoding

V5.2.1 -  Verify that the application will only accept files of a size which it can process without causing a loss of performance or a denial of service attack

V6.2.2 - Verify that users can change their password.
```

### **Level 2: Standard** **(Objectiu del mòdul)**

**Descripció**: El Nivell 2 de l'OWASP ASVS representa el nivell de seguretat recomanat per a la majoria d'aplicacions comercials o corporatives que processen dades personals o informació sensible. Aquest nivell combina tècniques de pentesting manual amb eines automatitzades per garantir el descobriment de vulnerabilitats o errors en la lògica de negoci.

**Característiques**:

- Metodologia híbrida: Combina el test d'intrusió manual amb eines automatitzades.
- Testing de caixa gris ó blanca: Accés parcial o total al codi font, els serveis i les configuracions de l'aplicació.
- Pentesting expert: Intervenció d'un professional de seguretat certificat (OSCP, OSWE, PNPT, eJPT, eCPPTv2 , etc.).
- Temps estimat: Entre 5 i 15 dies segons l'abast i la complexitat de l'aplicació.

**Aplicacions òptimes pel nivell 2**:

- Aplicacions web o mòbils amb dades personals o sensibles.
- Plataformes e-commerce amb passarel·la de pagament externa (com Redsys).
- Solucions SaaS B2B i portals corporatius (Magento, Shopify, Wordpress amb Woocommerce, etc.).
- Aplicacions empresarials (ERPs o CRMs) fets a mida o desenvolupats per petites i mitjanes empreses.

**Cobertura del nivell 2**:

- Totes les vulnerabilitats que es recullen a l'OWASP Top 10
- Gestió de sessions avançada: robustesa dels session ID, rotació, etc.
- Control d'accés exhaustiu (revisió de rols, permisos i possibilitat d'escalada horitzontal/vertical).
- Validació i satinitzat d'entrades/sortides de dades segons context (HTML, JS, URL, SQL, JSON, etc.).
- Validació de la lògica de negoci (exemple: procés de compra, canvi de contrasenya, etc.)

**Metodologia específica del Nivell 2**:

1. **Reconeixement (Reconnaissance o Information Gathering)**: Identificar els actius de l'obectiu a través d'un reconeixement passiu i actiu (OSINT, DNS Discovery, Port Scanning, Platform Identification, Web Discovery (links i contingut), Data Breaches, etc.)
2. **Enumeració (Scanning and Enumeration)**: Escaneig de ports oberts pels protocols TCP i UDP i descobriment dels serveis i les seves versions operatives (nmap, amass, etc.). Enumeració dels actius i recursos (noms d'usuari, noms de les màquines, serveis de xarxa operatius, URLs, etc.) amb eines com el Spider de Burpsuite o atac de força bruta de directoris amb Gobuster.
3. **Escàners Automàtics i Testing Manual**: Realitzar una prova inicial amb escàners automàtics com Nessus, Nikto, OpenVAS, Wapiti, Skipfish, OWASP ZAP, WPScan, etc. Posteriorment realitzar anàlisis manual de cada servei i versió identificat cercant vulnerabilitats conegudes en sistemes com https://www.cvedetails.com o fent proves manuals per explotar vulnerabilitats del OWASP Top 10.
4. **Testing de la Lògica de Negoci**: Avaluar totes les funcionalitats (fluxos de la lògica del negoci). Realitzar proves de "casos d'abús" per verificar escalades de privilegis no autoritzades o comportaments inesperats de l'aplicació.

**Exemple de requisits Nivell 2**:

```
V1.2.6 - Verify that the application protects against LDAP injection vulnerabilities, or that specific security controls to prevent LDAP injection have been implemented

V1.2.9 - Verify that the application escapes special characters in regular expressions (typically using a backslash) to prevent them from being misinterpreted as metacharacters.

V3.3.2 - Verify that each cookie's 'SameSite' attribute value is set according to the purpose of the cookie, to limit exposure to user interface redress attacks and browser‑based request forgery attacks, commonly known as cross‑site request forgery (CSRF).

V4.1.2 - Verify that only user‑facing endpoints (intended for manual web‑browser access) automatically redirect from HTTP to HTTPS, while other services or endpoints do not implement transparent redirects.
```

**Eines recomanades Nivell 2**:

- Burp Suite Professional (ambs els plugins intruder, repeater, extender, etc.)
- OWASP ZAP amb plugins i scripts personalitzats.
- Static Analysis (SAST): Semgrep, SonarQube, CodeQL.
- Software Composition Analysis (SCA): Dependency-Check, Trivy, Snyk.
- Revisió manual del codi font: Git diff review, VS Code + plugins de seguretat.

### **Level 3: Advanced**

**Descripció**: El Nivell 3 representa un model d'avaluació avançada de la seguretat en aplicacions crítiques. L'objectiu és garantir la seguretat completa de l'arquitectura (els components de l'aplicació), el codi, la infraestructura i les dades (altament sensibles). S'avaluen fluxos de negoci complexos i integracions crítiques entre diferents aplicacions com poden ser les APIs. Es combina els testing manual profund amb la revisió del codi font i l'arquitectura, i simulacions d'atac avançades amb eines d'un cost molt elevat.

**Característiques**:

- Testing Exhaustiu i integral: S'avalua l'explotació de totes les vulnerabilitats i de tota la lògica de negoci.
- Testing de caixa blanca: Es disposa d'un accés complet al codi font, les configuracions, servidors i serveis.
- Equip multidisciplinari: Pentesters seniors, arquitectes de seguretat, analistes de criptografia, etc. (Purple Team).
- Temps estimat: 15-30 dies, segons l'abast, la complexitat i les integracions de l'aplicació.

**Aplicacions adequades**:

- Aplicacions bancàries i de serveis financers
- Aplicacions de salut amb dades mèdiques sensibles
- Aplicacions del Govern o infraestructures crítiques (sistemes SCADA).
- Plataformes amb arquitectura distribuïda o microserveis crítics.

**Cobertura**:

- Tot el que hi ha al Nivell 2
- Revisió arquitectural completa (relació entre components, intercanvi de dades i controls de seguretat)
- Threat modeling exhaustiu i identificació de vectors d'atac específics
- Revisió integral del codi font (SAST) amb eines automàtiques i manuals
- Reversing (Ghidra) en aplicacions mòbils o executables crítics
- Revisió d'implementacions d'algorismes criptogràfics i protocols de seguretat
- Anàlisi de seguretat de la infraestructura física o en entorns al núvol
- Simulacions d'atac per validar la detecció i la resposta (Purple Team)

**Metodologia Level 3**:

**Architecture review**: Revisió de disseny i arquitectura
**Threat modeling**: Identificació de amenaces específiques
**Full code review**: Anàlisi estàtic complet (SAST)
**Comprehensive manual testing**: Testing exhaustiu
**Cryptographic review**: Validació d'implementacions crypto
**Infrastructure assessment**: Seguretat de infraestructura
**Red team exercises**: Simulacions d'atac avançades

1. Architecture review

- Revisió completa de l'arquitectura (disseny) de l'aplicació i la seva infraestructura.
- Validació dels diferents serveis (controls de confiança mínima, gestió de secrets i fluxos de dades).

2. Threat modeling

- Identificació de possibles amenaces, vectors d'atac i possible impacte.
- Classificació dels riscos segons la probabilitat i impacte, amb referència a OWASP ASVS.

3. Full code review (SAST)

- Revisió completa del codi font i components crítics.
- Detecció de vulnerabilitats OWASP Top 10, lògica de negoci, errades criptogràfiques i errors de configuració.
- Ús d'eines automàtiques com SonarQube, Semgrep, CodeQL, Checkmarx combinades amb la revisió manual del codi font.

4. Comprehensive manual testing

- Testing manual exhaustiu incloent casos d'abús i circumstàncies inesperades.
- Proves d'integració, proves d'APIs, proves de sessions i controls d'accés avançats (IDOR, etc.).

5. Cryptographic review

- Validació de claus, secrets, certificats i protocols.
- Revisió d'algoritmes i pràctiques: TLS, mTLS, xifrat simètric i assimètric, hashing amb algorismes actuals, etc.

6. Infrastructure assessment

- Revisió de la seguretat dels servidors, els serveis, les xarxes, infraestructura al núvol, etc.
- Validació de controls de seguretat perimetral, monitorització, logs, enviament d'alertes, incident response, etc.

7. Red Team (Advanced simulations) en conjunció amb un Blue Team.

- Simulacions d'atac controlades amb l'objectiu de provar defenses, detecció i resposta de l'organització.
- Inclou tècniques de phishing, lateral movement entre equips o usuaris, compromís de secrets, accés privilegiat, persistència i covering tracks.

**Cost i temps estimat**:

- Cost: 3-10x més que el Nivell 2
- Temps: 3-6 setmanes per aplicació mitjana
- Equip: 3-5 professionals especialitzats

## 3.3 Categories de requisits ASVS 5.0

ASVS 5.0 organitza els requisits en 17 categories:

| ID      | Categoria                                     |
| ------- | --------------------------------------------- |
| **V1**  | Encoding and Sanitization                     |
| **V2**  | Validation and Business Logic                 |
| **V3**  | Web Frontend Security                         |
| **V4**  | API and Web Service Security                  |
| **V5**  | File Handling                                 |
| **V6**  | Authentication                                |
| **V7**  | Session Management                            |
| **V8**  | Authorization (Access Control)                |
| **V9**  | Self‑Contained Tokens                         |
| **V10** | OAuth and OpenID Connect                      |
| **V11** | Cryptography                                  |
| **V12** | Secure Communications                         |
| **V13** | Configuration and Deployment Security         |
| **V14** | Infrastructure and Platform Security          |
| **V15** | Secure Coding Architecture and Implementation |
| **V16** | Security Logging and Error Handling           |
| **V17** | WebRTC and Real‑Time Communications           |

## 3.4 Com aplicar ASVS al projecte de la plataforma de videojocs vulnerable

### **Objectiu: ASVS Nivells 1 i 2**

**Enfocament pràctic**:

1. Identificar els requisits aplicables al projecte
2. Verificar cada requisit durant l'auditoria
3. Documentar si "compleix" o "no compleix" el requisit
4. Proposar millores i modificar el codi font per corregir les vulnerabilitats

**Exemple pràctic amb el projecte de videojocs vulnerable**:

`V2.2.1 - Verify that all user inputs in authentication flows (username, password, email) are validated for length, allowed characters, and format.`

- Compleix: Si el backend comprova que els noms d'usuari tenen entre 3 i 20 caràcters i només lletres, números i caràcters permesos.
- No compleix: Si només es fa validació al frontend amb JavaScript i el backend accepta qualsevol entrada.

`V6.2.1 - Authentication: Passwords i credencials`

- Compleix si validem la complexitat i longitud mínima al backend (mínim 8 caràcters i 15 recomanats)
- No compleix si només validem al frontend o no fem hashing segur.

`V7.1.3 - Session Management: Tokens de sessió`

- Compleix si els tokens són generats amb l'entropia adequada i es regeneren en login/logout (session_regenerate_id() o JWT amb secret fort)
- No compleix si usem sessions per defecte sense proteccions addicionals

`V8.1.1 - Authorization: Control d'accés`

- Compleix si cada endpoint o pàgina comprova permisos i rols de l'usuari al servidor
- No compleix si només confiem en ocultar opcions al frontend o fem comprovacions només en algunes pàgines.

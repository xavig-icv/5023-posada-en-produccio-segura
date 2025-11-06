# Tema 02 - Hacking Web

## Objectiu del tema

En aquest tema es realitza una introducció a la detecció, explotació i correcció de vulnerabilitats web seguint l'estàndard **OWASP Top 10** i metodologies utilitzades en plataformes de **Bug Bounty**. L'alumnat aprendrà a identificar i explotar les vulnerabilitats més comunes tant de forma manual com amb eines automatitzades. Els coneixements adquirits li serviran per realitzar una auditoria de seguretat web del seu projecte desenvolupat al Tema 1 i també realitzar les correcions en el codi font per corregir les vulnerabilitats trobades.

**Durada total**: 36 hores (26h vulnerabilitats + 10h auditoria del projecte)  
**Resultats d'aprenentatge**: RA2 i RA3

## Temes i distribució d'hores

| Tema                                            | Hores | Descripció                                                                          |
| ----------------------------------------------- | ----- | ----------------------------------------------------------------------------------- |
| **01. Introducció a les vulnerabilitats web**   | 2     | OWASP Top 10, metodologia d'auditoria, instal·lació DVWA i bWAPP, reconeixement web |
| **02. A1 - SQL Injection**                      | 4     | Tipus (Union, Boolean, Time-based, Error-based), explotació manual i amb SQLmap     |
| **03. A1 - Command Injection**                  | 2     | Identificació, explotació amb metacaràcters, reverse shells amb netcat              |
| **04. A1 - Cross-Site Scripting (XSS)**         | 4     | XSS Reflected/Stored/DOM, session hijacking, keylogger JS, bypass de filtres        |
| **05. A2 - Broken Authentication**              | 2     | Brute force, session management flaws, cookie manipulation, password reset          |
| **06. A3 - Authorization Bypass**               | 2     | Privilege escalation vertical/horizontal, JWT manipulation, RBAC bypass             |
| **07. A4 - Broken Access Control (IDOR)**       | 2     | Insecure Direct Object References, directory traversal, HTTP methods bypass         |
| **08. A5 - Session Management + CSRF**          | 2     | Session fixation/hijacking, CSRF tokens bypass, cookie security, open redirect      |
| **09. A6 - Sensitive Data Exposure**            | 2     | Informació sensible exposada, directory listing, backup files, repositoris Git      |
| **10. A7 - Server-Side Request Forgery (SSRF)** | 2     | SSRF identification, blind SSRF, cloud metadata exploitation, port scanning         |
| **11. A8 - File Upload Vulnerabilities**        | 2     | Bypass de validacions, web shells, polyglot files, ZIP bombs                        |
| **12. A9 - Local/Remote File Inclusion**        | 2     | LFI/RFI exploitation, log poisoning, PHP wrappers, directory traversal              |
| **13. A10 - Known Vulnerabilities + Logging**   | 2     | Vulnerability scanners, CVE database, Metasploit, Exploit-DB                        |
| **14. Auditoria del projecte propi**            | 10    | Aplicació de tècniques apreses al projecte del Tema 1                               |

## Resultats d'aprenentatge esperats

- Identificar les vulnerabilitats més comunes en aplicacions web segons l'estàndard OWASP Top 10, reconeixent els riscos associats a cada cas.
- Analitzar l'impacte real de vulnerabilitats en entorns de producció, considerant escenaris pràctics d'explotació i afectació.
- Classificar els riscos de seguretat utilitzant metodologies reconegudes (com les utilitzades en programes de Bug Bounty) i estàndards com l'OWASP ASVS Level 2.
- Explorar vulnerabilitats de forma manual i automatitzada per entendre el funcionament dels vectors d'atac (XSS, SQLi, CSRF, etc.).
- Utilitzar eines d'escaneig i test d'intrusió per detectar vulnerabilitats en aplicacions web en fase de desenvolupament o desplegades.
- Analitzar codi font (PHP/JavaScript) per identificar punts febles relacionats amb la validació d'inputs, gestió d'autenticació o configuracions insegures.
- Aplicar mesures de correcció i bones pràctiques de seguretat per mitigar vulnerabilitats en aplicacions web.
- Desenvolupar un informe tècnic i professional de les vulnerabilitats trobades, indicant el risc, l'evidència, i les recomanacions de millora.

# 01. OWASP Top 10 - Vulnerabilitrats Web (2021)

## **A01:2021 - Broken Access Control** (Autorització)

**Risc**: `CRITICAL`
**Abans**: A05:2017 - Broken Access Control

**Descripció**: Una aplicació disposa de "Broken Access Control" perquè no es realitzen les polítiques d'autorització (restriccions d'accés) adequades. Això permet a usuaris no autoritzats accedir a recursos (funcionalitats o informació restringida). Un atacant que realitza l'explotació d'aquest tipus de vunlerabilitat podria visualitzar, modificar i/o eliminar recursos els quals no està autoritzat, fins i tot obtenir més privilegis que els que disposa actualment.

El problema principal és d'autorització i no d'autenticació ja que que l'usuari ja ha iniciat sessió a la plataforma. Si la plataforma disposa de diverses funcionalitats pot haver-hi algun control que falli i pot repercutir en perdre el control de tota l'aplicació o el robatori de dades sensibles.

**Exemples**:

- IDOR (Insecure Direct Object References) Accés directe a recursos utilitzant identificadors (id) que es poden modificar.
- Bypass de controls d'autorització. S'ometen comprovacions per accedir a certes funcionalitat o dades.
- Privilege escalation (horizontal i vertical). Accedir a funcionalitats i dades d'un usuari normal o d'un administrador.
- Directory traversal. Accedir a fitxers sensibles del servidor fent ús de rutes manipulades.

**Impacte**: Accés no autoritzat a dades sensibles, modificació/eliminació de dades.

- Exposició de dades sensibles (dades personals, informes, configuracions, backups, etc.).
- Modificació o eliminació de recursos per part d'usuaris no autoritzats.
- Accions crítiques d'usuaris sense permís (eliminar comptes, pujar fitxers maliciosos, accedir a panells d'administració, etc.).
- Es considera crítica perquè pot portar a comprometre tot el sistema si es realitza una correcta explotació.

## **A02:2021 - Cryptographic Failures** (Xifratge)

**Risc**: `CRITICAL`
**Abans**: A03:2017 - Sensitive Data Exposure

**Descripció**: Una aplicació presenta la vulnerabilitat "Cryptographic Failures" quan no aplica correctament els mecanismes de protecció criptogràfica per dades sensibles (durant el trànsit de dades o dades en repòs). Els principals problemes són: falta de xifratge, ús d'algoritmes insegurs o obsolets (xifratge dèbil), o per una mala gestió de les claus criptogràfiques.

Un atacant que exploti aquest tipus de vulnerabilitat pot interceptar o accedir a informació confidencial com contrasenyes, dades personals, números de targetes, etc. Això és un risc que afecta directament la (CID) confidencialitat, integritat i disponibilitat de la informació. Com diria el Pau, aquesta mala acció pot tenir repercussions legals i de seguretat, especialment en entorns que gestionen dades personals i financeres o de salut.

**Exemples**:

- Transmissió de dades sense TLS/SSL i amb HTTP i no HTTPS.
- Algorismes de xifratge obsolets (MD5, SHA1, DES), etc.
- Gestió incorrecta de claus criptogràfiques (claus curtes o predibles i baixa rotació de claus).
- Passwords emmagatzemades en text pla, o un hash poc robust.

**Impacte**: Exposició de dades confidencials (passwords, targetes, dades personals, bakcups, informes, etc.).

## **A03:2021 - Injection** (Injecció)

**Risc**: `CRITICAL`
**Abans**: A01:2017 - Injection

**Descripció**: Una aplicació és vulnerable a "Injeccions de Codi" quan no valida ni filtra correctament les dades d'entrada, i aquestes dades són interpretades pel sistema com a comandes vàlides del S.O. o del programari en execució. Això permet a un atacant injectar codi maliciós que pot alterar el comportament natural de l'aplicació, accedir i modificar la informació de la base de dades, executar comandes al servidor o fins i tot injectar codi al navegador d'altres usuaris.

**Tipus d'injeccions**:

- **SQL i NoSQL Injection**: Manipulació de consultes SQL i NoSQL (amb JSON).
- **Command Injection**: Execució de comandes del Sistema Operatiu
- **LDAP Injection**: Manipulació de consultes LDAP
- **Cross-Site Scripting (XSS)**: Inserir codi maliciós HTML o JavaScript.

**Impacte**: Accés no autoritzat i/o modificació de BBDD, execució de codi remot (RCE), suplantació da la identitat d'altres usuaris o compromís total del sistema.

## **A04:2021 – Insecure Design** (Disseny Insegur)

**Risc**: `HIGH`
**Abans**: Nova categoria afegida al 2021

**Descripció**: Una aplicació presenta "Insecure Design" quan la seva arquitectura o disseny no planteja els principis de seguretat des del seu plantejament inicial (abans de construir-se). Aquesta vulnerabilitat no és produeix per un error de codi concret, sinó per una falta de controls de seguretat a la fase de disseny (hi ha una manca de validacions, polítiques de seguretat, límitacions d'ús o d'accés, etc).

El problema d'aquest tipus d'aplicacions és estructural. Com no s'ha realitzat un anàlisis de riscos ni s'han realitzat auditories de seguretat i testing durant el procés de desenvolupament de l'aplicació, aquesta sembla funcionar correctament ja que realitza la seva funció però és "estructuralment vulnerable".

**Exemples**:

- Falta de threat modeling (conèixer els principals vectors d'atac de l'aplicació)
- Arquitectura sense "defensa en profunditat" (només es valora una capa, l'externa per exemple)
- No es limiten els recursos (intents d'autenticació, mida màxima d'arxius, número de peticions a l'aplicació)
- No considerar casos d'abús (no valorar que una funcionalitat pugui realitzar accions fora del seu ús)

**Impacte**: Vulnerabilitats estructurals impossibles de corregir sense un redisseny de tota l'aplicació. Això permet arribar a l'explotació de diverses vulnerabilitats (SQLi, XSS, CSRF, etc.) per un disseny insegur de base.

## **A05:2021 - Security Misconfiguration** (Configuració Insegura)

**Risc**: `HIGH`
**Abans**: A06:2017 - Security Misconfiguration

**Descripció**: Una aplicació presenta la vulnerabilitat "Security Misconfiguration" quan els seus elementso components (servidors, serveis, bases de dades, frameworks o dependències) estan configurats de manera incorrecta o es deixa la configuració per defecte. Aquest tipus d'error és molt comú, ja que pot aparèixer a nivell d'aplicació o de la infraestructura (error del desenvolupador o de l'administrador de sistemes).

A les configuracions insegures podriem incloure: la manca d'actualitzacions del programari, l'exposició d'informació sensible mostrant missatges d'error molt detallats, o la presència de serveis en xarxa o funcionalitats innecessàries que augmenten les opcions d'atac.

**Exemples**:

- Credencials per defecte no modificades
- Missatges d'error amb informació sensible (de l'aplicació o del codi font)
- Funcionalitats innecessàries habilitades (mode debug, serveis i funcions de proves)
- Headers de seguretat no configurats (CSP, CORS, etc).
- Software desactualitzat (llibreries o dependències que disposen de vulnerabilitats)
- Directoris interns accessibles (.git, backups, logs, admin, etc.)

**Impacte**: Aquest tipus de vulnerabilitat pot permetre a un atacant identificar tecnologies utilitzades, fer ús de credencials per defecte, accedir a panells d'administració, descobrir informació sensible, o fins i tot executar codi remot si combina la configuració insegura amb altres vulnerabilitats.

## **A06:2021 - Vulnerable and Outdated Components** (Vulnerabilitats Conegudes)

**Risc**: `HIGH`
**Abans**: A09:2017 - Using Components with Known Vulnerabilities

**Descripció**: Ús de llibreries, frameworks o components amb vulnerabilitats conegudes.

Una aplicació és vulnerable a "Vulnerable and Outdated Components" quan utilitza llibreries, frameworks, mòduls, dependències o components de tercers que ja no es mantenen o disposen de vulnerabilitats conegudes (públiques). Sovint, tot i disposar d'actualitzacions, hi ha components no s'actualitzen a les seves últimes versions i disposen de vulnerabilitats públiques CVEs (Common Vulnerabilities and Exposures) que es poden explotar.

Els atacants aprofiten aquestes vulnerabilitats públiques per comprometre aplicacions que encara utilitzen versions vulnerables del programari. Com que molts entorns moderns depenen de centenars de pluguins (programes de tercers), la falta d'un procés de manteniment, actualització i d'inventari de components pot deixar el sistema exposat sense que els administradors en siguin conscients.

**Exemples**:

- Ús de llibreries o plugins amb vulnerabilitats conegudes (CVE's no corregits)
- Dependències sense actualitzar o que ja no reben suport del fabricant o de la comunitat
- Manca d'un procés manteniment i actualitzacions de seguretat regular.

**Impacte**: Aquesta vulnerabilitat aprofita l'ús de components externs que utilitza l'aplicació: CMS, LMS, dependències de JS o llibreries de tercers, per explotar vulnerabilitrats conegudes. Per exemple: injectar codi en dependències o plugins vulnerables, obtenir informació sensible o comprometre totalment l'aplicació o el servidor.

## **A07:2021 - Identification and Authentication Failures** (Identificació - Autenticació i Autorització)

**Risc**: `HIGH`
**Abans**: A02:2017 - Broken Authentication

**Descripció**: Una aplicació presenta la vulnerabilitat "Identification and Authentication Failures" quan implementa de manera insegura els mecanismes d'autenticació i autorització d'usuaris o gestió de les seves sessions. Aquest tipus d'errades permeten a un atacant accedir indegudament a comptes d'usuaris legítims, suplantar la seva identitat o disposar del control d'una sessió activa d'un usuari.

Aquestes problemàtiques poden aparèixer per una manca de control en la creació i validació de contrasenyes, una gestió de sessions deficient (identificadors previsibles, sessions no invalidades correctament), o la manca de mesures addicionals de control com l'autenticació de doble factor o multifactor (2FA/MFA).

**Exemples**:

- Atacs de força bruta (Brute force) sense cap tipus de limitació ni bloqueig
- Contrasenyes febles permeses o reutilitzades sense cap tipus de requisit de complexitat
- Identificadors de sessió (Session IDs) que es poden predir o no regenerats després de l'autenticació
- Session fixation, un atacant fa que la víctima utilitzi el seu "Session ID" per iniciar sessió i així el pot suplantar
- L'aplicació no fa ús de 2FA/MFA per iniciar sessió o realitzar accions sensibles (authenticator, correu, sms al telèfon, etc.)

**Impacte**: Un atacant pot explotar aquestes vulnerabilitats fent ús de tècniques com brute force, credential stuffing, o robant cookies de sessió per accedir al compte d'una víctima i obtenir dades personals o recursos interns emmagatzemats a l'aplicació. Si aconsegueix un accés com adminsitrador pot fins i tot comprometre l'aplicació o el servidor explotant altres vulnerabilitats conegudes.

## **A08:2021 - Software and Data Integrity Failures** (Manipulació de la Informació)

**Risc**: `HIGH`
**Abans:** Nova categoria afegida al 2021

**Descripció**: Una aplicació presenta la vulnerabilitat "Software and Data Integrity Failures" quan no implementa mecanismes adequats per garantir que el programari, les dades o els processos de l'aplicació no hagin estat modificats de manera no autoritzada.

Aquesta vulnerabilitat és molt comuna en entorns on es fan servir components externs, biblioteques de tercers, sistemes d'actualització automàtica o sistemes d'integració contínua (CI/CD). Si algún component no verifica la integritat i l'autenticitat del codi o de les dades, un atacant podria injectar codi maliciós o alterar processos interns, afectant a tota la de la cadena de subministrament, això es denomina "Supply Chain Attack".

**Exemples**:

- Insecure deserialization (manipulació de dades serialitzades)
- CI/CD pipeline sense validació (executa codi automàticament o realitza el desplegament sense verificarció)
- Auto-updates sense verificació de signatures (descarrega i instal·la codi no verificat)
- Dependency confusion attacks (instal·la paquets amb el mateix nom però de fonts o repositoris diferents a l'original)

**Impacte**: Aquesta vulnerabilitat aprofita comprometre els components externs per: modificar o corrompre dades crítiques, distribuir programari maliciós a altres usuaris i injectar codi maliciós per aconseguir una execució remota de codi (RCE) al servidor.

## **A09:2021 – Security Logging and Monitoring Failures** (Monitorització i Logs)

**Risc**: `MEDIUM`
**Abans**: A10:2017 - Insufficient Logging & Monitoring

**Descripció**: Una aplicació o sistema presenta la vulnerabilitat "Security Logging and Monitoring Failures" quan no disposa de mecanismes adequats per monitorar, registrar i enviar alertes sobre activitats que poden afectar a la seguretat.

Aquesta vulnerabilitat pot produir-se quan hi ha una manca de registres (logs) d'esdeveniments crítics i la falta d'alertes automàtiques que permetin detectar i respondre ràpidament davant d'un intent d'atac. És molt important disposar d'una visió general dels esdeveniments que es produeixen per poder identificar accessos no autoritzats, exposició de dades sensibles o errors interns abans que el problema sigui greu.

**Exemples**:

- Esdeveniments que no es registren (connexions fallides, canvis de permisos o accions administratives que no queden reflectides)
- Logs insuficients o sense context (registres que no inclouen informació clau com: l'usuari, la IP, el timestamp, l'acció, etc.)
- No hi ha un sistema d'alertes (el sistema no notifica intents d'atac o accions sospitoses dels usuaris)
- Logs no protegits contra manipulació (fitxers de registre accessibles o modificables per usuaris no autoritzats)

**Impacte**: Aquesta vulnerabilitat no és relaciona amb un tipus d'atac per si mateixa, però permet realitzar accions il·lícites sense conseqüències (ja que pot endarrerir la detecció i la resposta davant de possibles atacs). També fa impossible reconstruir els fets i investigar un atac que s'ha realitzat sobre l'aplicació o la infraestructura.

## **A10:2021 – Server-Side Request Forgery (SSRF)** (Peticions del Servidor)

**Risc**: `MEDIUM`
**Abans:** Nova categoria afegida al 2021

**Descripció**: Una vulnerabilitat de tipus "Server-Side Request Forgery (SSRF)" es produeix quan una aplicació permet que l'usuari controli o manipuli part d'una petició que el servidor realitza a altres recursos (externs o interns), sense validar adequadament a qui va dirigida o quin és el contingut d'aquesta petició.

Això permet que un atacant obligui al servidor a fer sol·licituds no autoritzades a serveis interns o serveis de tercers (serveis web, bases de dades, serveis cloud, etc.). Els SSRF poden permetre exposar dades internes, accedir a recursos de la xarxa interna i, en alguns casos, realitzar una execució remota de codi.

**Exemples**:

- Accés a recursos interns (serveis en localhost, bases de dades internes, serveis d'administració, etc.)
- Escaneig de ports intern (per descobrir serveis interns que no són visibles des de l'exterior)
- Bypass de firewalls (fent peticions a sistemes interns que no es poden fer peticions des de l'exterior)

**Impacte**: Aquesta vulnerabilitat pot permetre a un atacant accedir a la xarxa interna i serveis o recursos protegits, exposar dades sensibles o credencials, evitar els controls de seguretat externs interposats pels firewalls, i combinar-se amb altres vulnerabilitats per aconseguir una execució remota de codi (RCE).

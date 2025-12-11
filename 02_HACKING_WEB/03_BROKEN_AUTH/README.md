# Bloc 03. Introducció a la vulnerabilitat Broken Authentication

El "trencament de l'autenticació" és una vulnerabilitat que es produeix quan una aplicació web **no implementa correctament els mecanismes d'autenticació i gestió de sessions**, permetent a un atacant comprometre contrasenyes, tokens de sessió o altres vulnerabilitats i convertir-se de manera temporal o permanent en altres usuaris de l'aplicació.

## Vectors d'atac en l'autenticació

Els atacants poden comprometre l'autenticació fent ús de diversos punts d'entrada:

**1. Formulari de login**

- Camps d'usuari i contrasenya (sense protecció)
- Absència de rate limiting (límit d'intents)
- Missatges d'error que revelen informació (user enumeration)

**2. Gestió de sessions**

- Cookies de sessió amb valors que es poden predir
- Tokens que no expiren o tenen molta durada
- Sessions que no s'eliminen al tancar la sessió

**3. Recuperació de contrasenyes**

- Tokens reinici de contrasenyes predibles o reutilitzables
- Preguntes de seguretat febles
- Enllaços de recuperació que no expiren

**4. Credencials per defecte**

- Usuaris administratius amb contrasenyes no modificades i per defecte
- Comptes de proves (testing) en producció
- Credencials introduïdes directament al codi (hardcoded)

## Tipus de vulnerabilitats d'autenticació

- Atac de Força Bruta (Brute Force Attack) - Provar sistemàticament múltiples combinacions d'usuari/contrasenya fins trobar les credencials correctes.

- Enumeració d'Usuaris (User Enumeration) - Aconseguir esbrinar quins usuaris existeixen al sistema analitzant les respostes de l'aplicació.

- Contrasenyes Febles (Weak Password Policy) - L'aplicació permet als usuaris crear contrasenyes febles que són fàcils d'endevinar o trencar.

- Session Fixation - L'atacant força a la víctima a iniciar sessió utilitzant un ID de sessió conegut per l'atacant.

- Session Hijacking - Robar un identificador de sessió vàlid per suplantar l'identitat d'un usuari autenticat (ja hem vist una opció amb XSS Injection).

- Insecure Session Management - Sessions sense data d'expiració, Sessions no invalidades al logout, Múltiples sessions concurrents, Cookie sense flags de seguretat als headers

- Password Reset Vulnerabilities - Tokens o codis de validació predibles, que no expiren, que es poden reutilitzar o que el paràmetre es pot manipular.

- Manca de 2FA o MFA - L'aplicació només utilitza un factor d'autenticació (normalment la contrasenya), fent-la vulnerable si aquest factor es compromet.

- Credencials Exposats (Credential Exposure) - Exposició directament al codi (hardcodes), a fitxers de logs, com a paràmetres de la URL, comunicació sense xifrar

## Què busquem?

- Control total del compte de la víctima (Account Takeover): permet a un atacant accedir a l'aplicació i operar com si fos l'usuari legítim.

- Robatori de credencials: obtenir contrasenyes, tokens de sessió o qualsevol dada d'autenticació que permeti suplantar la identitat de l'usuari.

- Escalada de privilegis (Privilege Escalation): aconseguir ouna sessió d'un compte d'administrador o un rol amb més permisos que l'usuari normal.

- Accés no autoritzat a informació sensible (Data Breach): exposar dades personals, confidencials o crítiques de l'organització.

- Realització d'accions fraudulentes (Financial Loss): provocar pèrdues econòmiques mitjançant transaccions o accions malicioses.

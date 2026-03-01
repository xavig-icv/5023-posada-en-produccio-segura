# Tema 05 - Desplegament Segur d'Aplicacions Web

## Objectiu del tema

En aquest tema es desenvolupa un **pipeline complet de desplegament automatitzat** d'aplicacions web utilitzant **Docker i GitHub Actions**. L'alumnat aprendrà a containeritzar aplicacions web (Frontend + Backend/API + Base de dades), orquestrar múltiples serveis amb Docker Compose i automatitzar el procés de construcció i desplegament des d'un entorn de desenvolupament fins a un servidor de producció simulat.

Els coneixements adquirits permetran desplegar de forma segura i professional l'aplicació web desenvolupada al Tema 1, aplicant millors pràctiques DevSecOps i preparant-la per un entorn de producció real.

**Durada total**: 20 hores (14h teoria/pràctica + 6h desplegament projecte)
**Resultats d'aprenentatge**: RA5

L'alumnat treballarà amb dues màquines virtuals Debian amb Docker instal·lat:

- VM Desenvolupament: Màquina local (VirtualBox) per desenvolupar, provar i construir contenidors
- VM Producció: Màquina al Proxmox del centre (xarxa local) on es desplegarà l'aplicació de forma automatitzada

Aquest esquema simula un entorn real de desenvolupament → producció, on els canvis es despleguen automàticament mitjançant GitHub Actions.

Com que les VMs de producció no estan exposades a Internet, utilitzarem **GitHub Actions self-hosted runners** que s'executen directament a cada VM de producció. Això permet que GitHub Actions pugui desplegar aplicacions a VMs que només tenim accés des de la xarxa local del centre.

## Temes i distribució d'hores

| Tema                                               | Hores | Descripció                                                                                        |
| -------------------------------------------------- | ----- | ------------------------------------------------------------------------------------------------- |
| **01. Introducció a Docker i Containerització**    | 3     | Conceptes de containerització, arquitectura Docker, comandes bàsiques, primer contenidor          |
| **02. Dockerfile i construcció d'imatges**         | 2     | Sintaxi Dockerfile, millors pràctiques, construcció d'imatges personalitzades, `.dockerignore`    |
| **03. Docker Compose i orquestració**              | 3     | Orquestració multi-contenidor, `docker-compose.yml`, xarxes i volums, variables d'entorn          |
| **04. Xarxes, volums i persistència**              | 2     | Tipus de xarxes Docker, segmentació, gestió de volums, backup i restore                           |
| **05. Configuració segura i HTTPS**                | 2     | SSL/TLS, Nginx reverse proxy, headers de seguretat, resource limits, gestió de secrets            |
| **06. Git workflow i preparació per CI/CD**        | 2     | Branching strategy, `.gitignore`, estructura de repositori, documentació                          |
| **07. GitHub Actions i desplegament automatitzat** | 3     | CI/CD pipeline, build automàtic, push a registre, deploy via SSH o self-hosted runner a producció |
| **08. Desplegament del projecte propi**            | 6     | Aplicació dels coneixements al projecte del Tema 1, desplegament complet a producció              |

## Resultats d'aprenentatge esperats

- Comprendre les diferències entre virtualització i containerització, identificant els avantatges de Docker per al desplegament d'aplicacions web.
- Utilitzar Docker per crear, gestionar i executar contenidors de forma eficient i segura, aplicant millors pràctiques de construcció d'imatges.
- Crear fitxers Dockerfile optimitzats per a aplicacions web amb PHP, Apache/Nginx i bases de dades MySQL/MariaDB.
- Orquestrar aplicacions multi-contenidor utilitzant Docker Compose, definint serveis, xarxes i volums de forma adequada.
- Configurar xarxes Docker per segmentar i aïllar components de l'aplicació (frontend, backend, base de dades), aplicant el principi de menor privilegi.
- Implementar persistència de dades amb volums Docker i crear estratègies de backup i restore per bases de dades.
- Configurar HTTPS i SSL/TLS utilitzant Nginx com a reverse proxy, aplicant headers de seguretat i configuracions per a producció.
- Gestionar secrets i variables d'entorn de forma segura, evitant exposar credencials en el codi font o repositoris Git.
- Utilitzar Git amb una estratègia de branching professional, organitzant el codi per facilitar la col·laboració i el desplegament.
- Instal·lar i configurar self-hosted runners de GitHub Actions en servidors sense accés directe des d'Internet.
- Implementar pipelines CI/CD amb GitHub Actions i self-hosted runners per automatitzar el desplegament d'aplicacions web.
- Desplegar aplicacions web de forma automatitzada utilitzant Docker i GitHub Actions, executant el desplegament localment a la VM de producció.
- Documentar adequadament els processos de construcció i desplegament, creant guies tècniques per a altres desenvolupadors.
- Aplicar principis DevSecOps en tot el cicle de vida del desplegament, des de la construcció d'imatges fins a la monitorització en producció.
- Resoldre problemes comuns de desplegament (ports, permisos, xarxes, recursos) aplicant tècniques de troubleshooting i anàlisi de logs.

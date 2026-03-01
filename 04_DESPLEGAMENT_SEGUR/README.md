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

## Temes i distribució d'hores

| Tema                                               | Hores | Descripció                                                                                   |
| -------------------------------------------------- | ----- | -------------------------------------------------------------------------------------------- |
| **01. Introducció a Docker i Containerització**    | 3     | Conceptes de containerització, arquitectura Docker, comandes bàsiques, primer contenidor     |
| **02. Dockerfile i construcció d'imatges**         | 2     | Sintaxi Dockerfile, millors pràctiques, construcció d'imatges personalitzades, .dockerignore |
| **03. Xarxes Docker**                              | 2     | Tipus de xarxes, comunicació entre contenidors, aïllament, DNS intern                        |
| **04. Volums i persistència de dades**             | 2     | Named volumes, bind mounts, backup/restore, permisos                                         |
| **05. Docker Compose i orquestració**              | 3     | Orquestració multi-contenidor, docker-compose.yml, xarxes i volums, variables d'entorn       |
| **06. Git workflow i self-hosted runner**          | 2     | Branching strategy, .gitignore, instal·lació i configuració del self-hosted runner           |
| **07. GitHub Actions i desplegament automatitzat** | 3     | CI/CD pipeline amb self-hosted runner, build automàtic, desplegament local                   |
| **08. Desplegament del projecte propi**            | 6     | Aplicació dels coneixements al projecte del Tema 1, desplegament complet a producció         |

## Resultats d'aprenentatge esperats

- Comprendre les diferències entre virtualització i containerització, identificant els avantatges de Docker per al desplegament d'aplicacions web.
- Utilitzar Docker per crear, gestionar i executar contenidors de forma eficient i segura, aplicant millors pràctiques de construcció d'imatges.
- Crear fitxers Dockerfile optimitzats per a aplicacions web amb PHP, Apache/Nginx i bases de dades MySQL/MariaDB.
- Configurar i gestionar xarxes Docker per segmentar i aïllar components de l'aplicació (frontend, backend, base de dades).
- Comprendre la comunicació entre contenidors utilitzant DNS intern de Docker i noms de servei.
- Implementar persistència de dades amb volums Docker (named volumes i bind mounts).
- Crear estratègies de backup i restore per bases de dades i aplicacions.
- Orquestrar aplicacions multi-contenidor utilitzant Docker Compose, definint serveis, xarxes i volums de forma adequada.
- Configurar HTTPS i SSL/TLS utilitzant Nginx com a reverse proxy, aplicant headers de seguretat i configuracions per a producció.
- Gestionar secrets i variables d'entorn de forma segura, evitant exposar credencials en el codi font o repositoris Git.
- Utilitzar Git amb una estratègia de branching professional, organitzant el codi per facilitar la col·laboració i el desplegament.
- Instal·lar i configurar self-hosted runners de GitHub Actions en servidors sense accés directe des d'Internet.
- Implementar pipelines CI/CD amb GitHub Actions i self-hosted runners per automatitzar el desplegament d'aplicacions web.
- Desplegar aplicacions web de forma automatitzada utilitzant Docker i GitHub Actions, executant el desplegament localment a la VM de producció.
- Documentar adequadament els processos de construcció i desplegament, creant guies tècniques per a altres desenvolupadors.
- Aplicar principis DevSecOps en tot el cicle de vida del desplegament, des de la construcció d'imatges fins a la monitorització en producció.
- Resoldre problemes comuns de desplegament (ports, permisos, xarxes, recursos) aplicant tècniques de troubleshooting i anàlisi de logs.

## Arquitectura de l'aplicació desplegada

L'aplicació web que es desplegarà segueix una arquitectura de tres capes containeritzada amb reverse proxy:

```
┌──────────────────────────────────────────────┐
│         NGINX (Reverse Proxy + SSL)          │
│              Port 80/443                     │
└────────────────┬─────────────────────────────┘
                 │
        ┌────────┴─────────┐
        │                  │
        ▼                  ▼
┌──────────────┐   ┌──────────────┐
│   FRONTEND   │   │   BACKEND    │
│  (HTML/CSS)  │   │  PHP + API   │
│    Nginx     │   │  Apache/PHP  │
└──────────────┘   └───────┬──────┘
                           │
                           ▼
                   ┌──────────────┐
                   │   DATABASE   │
                   │ MySQL/MariaDB│
                   └──────────────┘
```

**Xarxes Docker:**

- `frontend-network`: Nginx <--> Frontend/Backend (xarxa pública)
- `backend-network`: Backend <--> Database (xarxa privada, aïllada)

**Volums Docker:**

- `db-data`: Persistència de la base de dades
- `app-logs`: Logs de l'aplicació

Cada component s'executa en un contenidor independent, comunicant-se a través de xarxes Docker internes i utilitzant volums per persistència de dades.

## Projecte final: Desplegament complet

L'entregable final del tema consisteix en el desplegament automatitzat de l'aplicació web desenvolupada al Tema 1 (plataforma de videojocs) amb els següents requisits:

**Desenvolupament (VM local VirtualBox)**:

- ✅ Docker Compose amb nginx (reverse proxy) + frontend + api/backend + database
- ✅ Xarxes Docker separades per capes (frontend-network, backend-network)
- ✅ HTTPS configurat amb certificat SSL (autosignat per desenvolupament)
- ✅ Volums per persistència de dades de la base de dades
- ✅ Fitxer .env amb variables d'entorn (mai al repositori)
- ✅ Script de backup de la base de dades funcional
- ✅ Dockerfile per cada servei personalitzat

**Repositori GitHub**:

- ✅ Estructura de carpetes organitzada (frontend/, backend/, database/, nginx/)
- ✅ .gitignore correcte (sense .env, secrets, volums Docker)
- ✅ README.md amb documentació completa de l'aplicació i instruccions de desplegament
- ✅ docker-compose.yml per desenvolupament i docker-compose.prod.yml per producció
- ✅ .github/workflows/deploy.yml amb el pipeline CI/CD

**Self-Hosted Runner (VM Producció)**:

- ✅ GitHub Actions Runner instal·lat i configurat com a servei systemd
- ✅ Runner registrat al repositori personal de GitHub
- ✅ Runner actiu i escoltant jobs de GitHub Actions
- ✅ Permisos correctes per executar Docker sense sudo

**Pipeline CI/CD (GitHub Actions)**:

- ✅ Workflow que es dispara amb push a main
- ✅ Build automàtic de les imatges Docker
- ✅ Push de les imatges a GitHub Container Registry (GHCR)
- ✅ Pull de les imatges actualitzades al self-hosted runner
- ✅ Desplegament amb docker compose up -d
- ✅ Verificació bàsica del desplegament (health check)

**Producció (VM Proxmox)**:

- ✅ Aplicació accessible des de la xarxa del centre (HTTP/HTTPS)
- ✅ Base de dades amb persistència correcta
- ✅ Logs accessibles per debugging
- ✅ Headers de seguretat configurats en Nginx
- ✅ Resource limits configurats per cada contenidor
- ✅ Desplegament automàtic funcional amb cada push a GitHub

### Documentació requerida

L'alumnat haurà de crear i lliurar:

1. **README.md del projecte**: Descripció de l'aplicació, arquitectura, tecnologies, instruccions de desplegament local i producció
2. **Diagrama d'arquitectura**: Esquema visual dels contenidors, xarxes i volums
3. **Guia d'instal·lació del runner**: Passos per instal·lar i configurar el self-hosted runner
4. **Guia de desplegament**: Passos detallats per desplegar l'aplicació des de zero
5. **Documentació de l'API de jocs**: Endpoints, mètodes HTTP, autenticació, exemples de peticions
6. **Procediments de backup/restore**: Scripts i instruccions per backup i recuperació de dades

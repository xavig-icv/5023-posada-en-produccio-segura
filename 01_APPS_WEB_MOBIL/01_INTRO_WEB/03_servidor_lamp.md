# 03. Instal·lació Servidor LAMP

    > ⚠️ **ADVERTÈNCIA**: Aquesta és una configuració per defecte amb paràmetres estàndard i que inencionadament pot contenir configuracions vulnerables. Només es podria utilitzar en entorns de desenvolupament. Aquesta instal·lació serà auditada i millorada al tema 3 - auditoria de seguretat web i modificada al tema 5 - desplegament en contenidors Docker en xarxa.

## Índex

1. [Instal·lació VirtualBox](#1-installació-virtualbox)
2. [Importació Ubuntu Server OVA](#2-importació-ubuntu-server-ova)
3. [Configuració inicial del sistema](#3-configuració-inicial-del-sistema)
4. [Instal·lació Apache](#4-installació-apache)
5. [Instal·lació PHP](#5-installació-php)
6. [Instal·lació MySQL](#6-installació-mysql)
7. [Configuració de permisos web](#7-configuració-de-permisos-web)
8. [Verificació final del sistema](#8-verificació-final-del-sistema)

---

## 1. Instal·lació VirtualBox

### Actualització del sistema

Primer actualitzem els repositoris del sistema:

```bash
sudo apt update
sudo apt upgrade
```

### Instal·lació de VirtualBox

Instal·lem VirtualBox des dels repositoris oficials:

```bash
sudo apt install virtualbox virtualbox-ext-pack
```

### Verificació de la instal·lació

Comprovem que VirtualBox s'ha instal·lat correctament:

```bash
vboxmanage --version
```

---

## 2. Importació Ubuntu Server OVA

### Descàrrega l'OVA

> Descarregar la màquina d'Ubuntu Server a l'enllaç: [UBUNTU SERVER OVA](https://drive.google.com/file/d/1VXNAoeM6f-mpB7Iz9EGOYkIISgtqY1Ro/)

### Importació de l'OVA

Des de VirtualBox GUI:

1. Obrir VirtualBox
2. Fitxer → Importar servei virtualitzat
3. Seleccionar l'arxiu OVA descarregat
4. Configurar la VM amb els paràmetres per defecte
5. Importar

### Configuració de xarxa

Configurar l'adaptador de xarxa com a "Adaptador pont" per obtenir IP automàtica via DHCP.

---

## 3. Configuració inicial del sistema

### Actualització del sistema Ubuntu Server

Un cop iniciada la VM, actualitzem el sistema:

```bash
sudo apt update
sudo apt upgrade
```

### Instal·lació i configuració SSH

Instal·lem el servidor SSH per permetre connexions remotes:

```bash
sudo apt install openssh-server
```

Comprovem que SSH s'ha iniciat correctament:

```bash
sudo systemctl status ssh
```

Verifiquem que SSH està escoltant pel port 22 (port per defecte):

```bash
sudo ss -plutn | grep :22
```

Assegurem que SSH s'iniciï automàticament:

```bash
sudo systemctl enable ssh
```

Obtenir la IP que permetrà connectar-nos remotament des del nostre ordinador:

```bash
ip a
```

Des de la màquina host (la vostra màquina física), connecteu-vos via SSH:

```bash
# Substituir IP_DE_LA_VM per la IP obtinguda anteriorment
# Substituir USUARI per el nom del teu usuari de la VM
ssh USUARI@IP_DE_LA_VM
```

Verificar la connexió SSH a la màquina servidor:

```bash
# Veure informació del sistema
uname -a
```

> ⚠️ **IMPORTANT:** No sortir de la connexió SSH (mantenir-se sempre connectat al servidor per seguir el tutorial).

## 4. Instal·lació Apache

### Instal·lació del servidor web Apache

Instal·lem Apache amb la configuració per defecte:

```bash
sudo apt install apache2
```

### Verificació del servei Apache

Comprovem que Apache s'ha iniciat correctament:

```bash
sudo systemctl status apache2
```

### Verificació dels ports d'Apache

Verifiquem que Apache està escoltant al port 80:

```bash
sudo ss -plutn | grep :80
```

### Habilitació d'Apache a l'arrencada

Assegurem que Apache s'iniciï automàticament:

```bash
sudo systemctl enable apache2
```

### Test de la pàgina per defecte

Obtenim la IP de la màquina i comprovem la pàgina per defecte:

```bash
ip addr show
# Navegar a http://IP_DE_LA_VM per veure la pàgina per defecte d'Apache
```

---

## 5. Instal·lació PHP

### Instal·lació de PHP i mòduls necessaris

Instal·lem PHP amb els mòduls necessaris per al projecte web:

```bash
sudo apt install php libapache2-mod-php php-mysql php-mysqli php-json php-curl php-mbstring php-gd
```

### Verificació de la instal·lació PHP

Comprovem la versió de PHP instal·lada i la ruta del fitxer de configuració i d'inicialització de PHP:

```bash
php -v

php --ini
```

### Configuració PHP per fer-la més vulnerable

Editem el fitxer de configuració per fer-lo menys segur (per l'auditoria posterior):

```bash
sudo nano /etc/php/8.X/apache2/php.ini
```

Modifiquem aquests paràmetres per fer la configuració per un **entorn de desenvolupament** (només de proves):

```ini
display_errors = On
display_startup_errors = On
expose_php = On
log_errors = Off
allow_url_fopen = On
```

### Creació d'un fitxer phpinfo per verificació

Creem un fitxer per comprovar la configuració de PHP:

```bash
echo "<?php phpinfo(); ?>" | sudo tee /var/www/html/info.php
```

### Reiniciar Apache per aplicar canvis

Reiniciem Apache per aplicar la configuració de PHP:

```bash
sudo systemctl restart apache2
```

### Verificació del servei Apache després dels canvis

```bash
sudo systemctl status apache2
```

### Test de PHP

Naveguem a `http://IP_DE_LA_VM/info.php` per veure la informació de PHP.

---

## 6. Instal·lació MySQL

### Instal·lació del servidor MariaDB/MySQL

Instal·lem MariaDB/MySQL Server amb configuració per defecte:

```bash
sudo apt install mariadb-server
```

### Verificació del servei MySQL

Comprovem que MySQL s'ha iniciat correctament:

```bash
sudo systemctl status mariadb
```

### Verificació dels ports de MySQL

Verifiquem que MySQL està escoltant al port 3306:

```bash
sudo ss -plutn | grep :3306
```

### Habilitar MySQL a l'arrencada del servidor

Assegurem que MySQL s'iniciï automàticament:

```bash
sudo systemctl enable mariadb
```

### Accés a MySQL

Accedim a MySQL com a root sense password:

```bash
sudo mysql -u root -p
```

Dins de MySQL, executem:

```sql
SHOW DATABASES;

CREATE DATABASE plataformaweb;

-- Crear un usuari per a l'aplicació web amb una password insegura i accés desde qualsevol IP (també podeu fer servir root)
CREATE USER 'usuariweb'@'%' IDENTIFIED BY 'password123';

-- Donar tots els privilegis a l'usuari web sobre totes les bases de dades i taules (configuració insegura només per desenvolupament)
GRANT ALL PRIVILEGES ON *.* TO 'usuariweb'@'%';

FLUSH PRIVILEGES;

EXIT;
```

### Configuració per accés remot a MySQL

Editem el fitxer de configuració de MySQL/MariaDB per permetre connexions remotes:

```bash
sudo nano /etc/mysql/mariadb.conf.d/50-server.cnf
```

Busquem la línia bind-address i la comentem o canviem per acceptar connexions de qualsevol IP:

```bash
# bind-address = 127.0.0.1
bind-address = 0.0.0.0
```

Reiniciem el servei de per aplicar els canvis:

```bash
sudo systemctl restart mysql
```

Verifiquem que el servei de MySQL escolta per totes les interfícies (loopback i enp0s3)

```bash
sudo ss -plutn | grep :3306
```

### Test de connexió amb l'usuari creat

Provem la connexió amb el nou usuari en local i en remot:

```bash
# Localment en el servidor
mysql -u usuariweb -p
# Introduir password: password123

# Remotament des del teu ordinador
mysql -u usuariweb -p -h IP_DE_LA_VM
# Introduir password: password123
```

Un cop dins de MySQL:

```sql
SHOW DATABASES;

-- Llistar tots els usuaris i des d'on es poden connectar
SELECT User, Host FROM mysql.user;

-- Veure els privilegis de l'usuariweb
SHOW GRANTS FOR 'usuariweb'@'%';

EXIT;
```

## 7. Configuració de permisos web

### No modifiquem la configuració del propietari de la carpeta arrel de la pàgina web

L'usuari per defecte de la carpeta web és ROOT.

```bash
ls -la /var/www/html
```

### No modifiquem la configuració de permisos de la carpeta web

Com el propietari és ROOT, l'usuari Apache (www-data) no podrà escriure a la carpeta.
No podrà pujar fitxer (uploads), enregistrar logs, guardar fitxer dinàmicament, caché o sessions PHP, etc.
Durant el desenvolupament inicial haureu de plantejar com podeu solucionar aquest problema.

```bash
#sudo chmod -R 755 /var/www/html
```

## 8. Verificació final del sistema

### Test de tots els serveis

Comprovem que tots els serveis estan actius:

```bash
# SSH
sudo systemctl status ssh

# Apache
sudo systemctl status apache2

# MySQL
sudo systemctl status mysql

# Verificació de ports
sudo ss -plutn | grep -E ':22|:80|:3306'
```

### Test de la pàgina web per defecte d'Apache

Naveguem a `http://IP_DE_LA_VM` per veure la pàgina per defecte d'Apache.

### Test de PHP

Naveguem a `http://IP_DE_LA_VM/info.php` per verificar que PHP funciona correctament.

> **RECORDATORI**: Aquesta configuració conté configuracions per defecte i vulnerabilitats intencionades que seran identificades i corregides durant l'auditoria de seguretat web del Tema 3.

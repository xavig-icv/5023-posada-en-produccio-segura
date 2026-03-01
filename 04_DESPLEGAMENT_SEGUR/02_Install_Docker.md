# 02. Instal·lació i verificació de Docker

Descarrega la màquina: [Descarregar Debian amb Docker](https://drive.google.com/file/d/1YGUw6wQffa21Ket8jyjlnQByQ0dX8BUS/)

## Connexió per SSH i actualització de repositoris i paquets

```bash
# Iniciar sessió amb usuari/usuari
ssh usuari@IP_DE_LA_VM
# root/ciber
su root

# Actualització de repositoris i paquets
apt update
apt ugprade

# Instal·lar el paquet de sudo
apt install sudo

# Afegir a l'usuari al grup de sudo
/usr/sbin/usermod -aG sudo usuari
exit
```

### Instal·lació de l'ecosistema de Docker

Manual del repositori oficial: [Manual Oficial Docker Debian](https://docs.docker.com/engine/install/debian/)

```bash
# Dependències per la instal·lació de Docker
sudo apt install ca-certificates curl gnupg

# Configuració del repositori oficial (clau GPG de Docker)
sudo install -m 0755 -d /etc/apt/keyrings
sudo curl -fsSL https://download.docker.com/linux/debian/gpg -o /etc/apt/keyrings/docker.asc
sudo chmod a+r /etc/apt/keyrings/docker.asc

# Afegir el repositori a Apt sources list:
sudo tee /etc/apt/sources.list.d/docker.sources <<EOF
Types: deb
URIs: https://download.docker.com/linux/debian
Suites: $(. /etc/os-release && echo "$VERSION_CODENAME")
Components: stable
Signed-By: /etc/apt/keyrings/docker.asc
EOF

# Actualitzar els repositoris
sudo apt update

# Instal·lació dels paquets de l'ecosistema de Docker
sudo apt install docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin
```

### Verificar la instal·lació

```bash
# Comprovar versió de Docker
sudo docker --version

# Comprovar versió de Docker Compose
sudo docker compose version

# Comprovar que el servei està actiu
sudo systemctl status docker

# Verificar adaptador docker0 (xarxa virtual interna dels contenidors)
ip a
```

### Afegir l'usuari al grup docker

Per executar Docker **sense sudo** i permet l'autocompletat:

```bash
# Afegir el teu usuari al grup docker
sudo usermod -aG docker $USER

# Tancar sessió i tornar a iniciar
exit
# (torna a connectar-te per SSH)

# Verificar que ja pots executar docker sense sudo
docker ps
```

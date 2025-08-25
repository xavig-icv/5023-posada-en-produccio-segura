# 04. Configuració de Remote Development a VS Code

## Instal·lació de l'extensió Remote Development

1. Obrir VS Code
2. Anar a Extensions (`Ctrl+Shift+X`)
3. Buscar "Remote Development"
4. Instal·lar l'extensió de Microsoft

## Configuració de la connexió SSH remota al servidor

1. Obrir Command Palette (`Ctrl+Shift+P`)
2. Buscar i seleccionar: `Remote-SSH: Connect to Host...`
3. Seleccionar `Configure SSH Hosts...`
4. Triar el fitxer de configuració (normalment `~/.ssh/config`)

Afegir la configuració SSH:

```
Host ubuntu-server
    HostName IP_DE_LA_VM
    User USUARI_VM
    Port 22
```

## Connexió remota a la VM des de VS Code

1. Command Palette (`Ctrl+Shift+P`)
2. `Remote-SSH: Connect to Host...`
3. Seleccionar `ubuntu-server`
4. Seleccionar la plataforma del servidor remot `Linux`
5. Introduir la password quan es sol·lici
6. Esperar que VS Code estableixi la connexió i instal·li VS Code Server.

## Verificació de la connexió remota

0. Obrir Remote Explorer (al menú esquerra i verificar que hi ha un tunel SSH: `ubuntu-server:connected`)
1. Obrir terminal integrat (`Ctrl`+`ñ`)
2. Executar comandes de verificació:

```bash
# Verificar que estem a la VM
hostname

# Confirmar la ubicació actual
pwd
```

## Obrir la carpeta web del servidor

1. `File` → `Open Folder...`
2. Navegar a `/var/www/html`
3. Seleccionar la carpeta i clicar `OK`
4. Si demana permisos, introduir la password

## Verificació de l'accés i edició a la carpeta web

```bash
# Des del terminal integrat de VS Code
ls -la /var/www/html/
```

## Test d'edició remota (crear un fitxer per verificar l'edició remota)

1. Crear un nou fitxer: `test.html`
2. Com denega la creació del fitxer un error molt comú és donar permisos totals per tots els usuaris.

```bash
#Atenció! Configuració vulnerable. Molts desenvolupadors la fan de manera imprudent.
sudo chmod 777 -R /var/www/html
```

3. Ara si, crear el fitxer: `test.html`
4. Afegir-hi contingut:

```html
<h1>Connexió remota funcionant amb Remote Development!</h1>
```

5. Guardar el fitxer (`Ctrl+S`)
6. Verificar des del navegador: `http://IP_DE_LA_VM/test.html`
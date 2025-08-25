# 02. Extensions per Visual Studio Code

| Extensió                         | Desenvolupador       | Funció principal                                       | Estatus        |
|----------------------------------|----------------------|--------------------------------------------------------|----------------|
| **Remote Development**           | Microsoft            | Obrir projectes remots com si fossin locals.           | ✅ Recomanat  |
| **Live Server**                  | Ritwick Dey          | Llança un servidor local amb auto-recarrega.           | ✅ Recomanat  |
| **Live Share**                   | Microsoft            | Col·laboració remota en temps real.                    | ✅ Oficial    |
| **HTML CSS Support**             | ecmel                | Intellisense per CSS dins de fitxers HTML.             | ✅ Recomanat  |
| **Auto Complete Tag**            | Jun Han              | Completa i modifica etiquetes HTML automàticament.     | ✅ Recomanat  |
| **Prettier - Code formatter**    | prettier             | Formatador de codi per mantenir un estil uniforme.     | ✅ Recomanat  |
| **Path Intellisense**            | Christian Kohler     | Autocompleta rutes de fitxers.                         | ✅ Recomanat  |
| **Image Preview**                | Kiss Tamás           | Mostra imatges en miniatura en hover.                  | ⚠️ Opcional   |
| **Open in Browser**              | TechER               | Obre fitxers HTML al navegador.                        | ⚠️ Opcional   |
| **Color Highlight**              | Sergii N             | Mostra els valors de color dins del codi.              | ✅ Recomanat  |
| **CSS Peek**                     | Pranay Prakash       | Permet veure el CSS relacionat amb l'HTML.             | ✅ Recomanat  |
| **Error Lens**                   | Alexander            | Ressalta errors i advertències dins del codi.          | ✅ Recomanat  |

## JavaScript i snippets

| Extensió                                | Desenvolupador         | Funció principal                               | Estatus       |
|-----------------------------------------|------------------------|------------------------------------------------|-------------- |
| **ESLint**                              | Microsoft              | Analitza i mostra errors/avisos de JavaScript. | ✅ Oficial   |
| **Console Ninja**                       | Wallaby.js             | Mostra la sortida de consola dins l'editor.    | ✅ Recomanat |
| **JavaScript (ES6) code snippets**      | xabikos                | Snippets per JS ES6.                           | ✅ Recomanat |

## PHP i Backend

| Extensió                    | Desenvolupador    | Funció principal                                    | Estatus      |
|-----------------------------|-------------------|-----------------------------------------------------|--------------|
| **PHP Intelephense**        | Ben Mewburn       | IntelliSense complet per PHP.                       | ✅ Recomanat |
| **PHP Debug**               | Xdebug            | Depuració de PHP amb Xdebug.                        | ✅ Recomanat |
| **PHP DocBlocker**          | Neil Brayfield    | Genera automàticament comentaris PHPDoc.            | ✅ Recomanat |
| **PHP CS Fixer**            | junstyle          | Formatació automàtica de codi PHP.                  | ✅ Recomanat |
| **phpstan**                 | SanderRonde       | Anàlisi estàtica de codi PHP (error highlighting).  | ✅ Recomanat |

## Base de dades i MySQL

| Extensió                    | Desenvolupador    | Funció principal                                    | Estatus      |
|-----------------------------|-------------------|-----------------------------------------------------|--------------|
| **MySQL**                   | Database Client   | Client MySQL integrat a VS Code.                    | ✅ Recomanat |

## API i Testing

| Extensió                    | Desenvolupador    | Funció principal                                    | Estatus      |
|-----------------------------|-------------------|-----------------------------------------------------|--------------|
| **Thunder Client**          | Thunder Client    | Client API REST integrat (am una GUI).              | ✅ Recomanat |
| **REST Client**             | Huachao Mao       | Envia peticions HTTP (s'ha d'escriure petició HTTP) | ⚠️ Opcional  |
| **PHPUnit Test Explorer**   | Recca0120         | Executa i visualitza tests PHPUnit.                 | ✅ Recomanat |
| **Jest**                    | Orta              | Framework JavaScript per Unit i Integration tests.  | ✅ Recomanat |
| **Jest Runner**             | firsttris         | Executa tests Jest directament des de l'editor.     | ✅ Recomanat |

## Docker i Contenidors

| Extensió                    | Desenvolupador    | Funció principal                                    | Estatus     |
|-----------------------------|-------------------|-----------------------------------------------------|-------------|
| **Docker**                  | ms-azuretools     | Integració amb Docker Engine des de l'editor.       | ✅ Oficial  |
| **Docker Compose**          | Microsoft         | Suport per treballar amb docker-compose.yml.        | ✅ Oficial  |


## Control de versions

| Extensió       | Desenvolupador   | Funció principal                             | Estatus      |
|----------------|------------------|----------------------------------------------|--------------|
| **GitLens**    | GitKraken        | Amplia les funcionalitats de Git a VS Code.  | ✅ Recomanat |

## Auditories de seguretat i qualitat

| Extensió                    | Desenvolupador    | Funció principal                                    | Estatus     |
|-----------------------------|-------------------|-----------------------------------------------------|-------------|
| **SonarQube for IDE**       | SonarSource       | Detecta problemes de seguretat i qualitat de codi.  | ✅ Recomanat |

## Altres

| Extensió             | Desenvolupador | Funció principal                                 | Estatus     |
|----------------------|----------------|--------------------------------------------------|-------------|
| **Project Templates**| canhion        | Crear plantilles de projecte personalitzades.    | ⚠️ Opcional |

## Com instal·lar una extensió

1. Obre VS Code.
2. Ves a la pestanya **Extensions** (icona de blocs o `Ctrl+Shift+X`).
3. Cerca el nom de l'extensió.
4. Sel·leccionar i prèmer el botó **Install**.

També es pot fer via terminal:

```bash
code --install-extension id.extensio
```
# 01. El Document Object Model (DOM)

El DOM és la representació d'un document HTML. Aquest es pot visualitzar com un arbre d'elements o nodes. Els navegadors proporcionen una API per interactuar amb els elements HTML del DOM fent ús de JavaScript.
Aquestes interaccions permeten modificar l'estructura HTML, estil CSS i el contingut del document de manera dinàmica. També permet donar resposta als esdeveniments generats per l'usuari (clics, moviments del ratolí, entrades de teclat, etc.).

## Manipulació dinàmica del DOM

Al carregar la pàgina web es genera l'objecte DOCUMENT que emmagatzema tot el contingut HTML de la pàgina web. Amb Javascript podem accedir als seus mètodes i propietats per interactuar amb els elements de la pàgina. 

Sobre els elements HTML es poden realitzar les següents accions:
- Seleccionar elements
- Modificar el elements existents
    - El contingut
    - Els estils CSS
    - Els atributs i les classes
- Afegir elements nous
- Eliminar elements existents

### 1. Selecció d'Elements

```javascript
//(querySelector) Seleccionar un únic element HTML (si hi ha diversos iguals escull el primer)
const jugador = document.querySelector('#jugador');

// (querySelectorAll) Seleccionar un conjunt d'elements HTML i els recull en un vector (Array).
const vectorEnemics = document.querySelectorAll('.enemic');
```

### 2. Modificació d'Elements

#### Modificació del Contingut (`textContent`)
```javascript
// Modificar contingut HTML (mètode molt utilitzat i insegur si és mostren dades introduïdes per l'usuari)   
divNomUsuari.innerHTML = `<p>Nom: ${nomUsuari}</p>`;

// Modificar el contingut de text d'un element (mètode segur)
divNomUsuari.textContent = `Nom: ${nomUsuari}`;
divNivell.textContent = `Nivell: ${nivell}`;
```

#### Modificació d'Estils (`style` amb `setProperty`, `getProperty`i `removeProperty`)

```javascript
// Modificar estils CSS
jugador.style.setProperty('left', `${posicioX}px`); //Afegir o modificar una propietat CSS
jugador.style.setProperty('top', `${posicioY}px`);
jugador.style.getPropertyValue('left'); //Obtenir el valor d'una propietat CSS
vectorEnemic[0].style.removeProperty('box-shadow');
vectorEnemic[0].style.backgroundColor = 'red'; //Mètode antic, vàlid però s'ha de fer servir camelCase
```

#### Modificació de Classes (`classList` amb `add`, `remove`, `toggle` i `contains`)

```javascript
jugador.classList.add('estilsJugador'); // Afegir una classe
projectil.classList.remove('actiu'); // Eliminar una classe
boss.classList.toggle('superpoder'); //Sinó existeix l'afegeix i si existeix l'elimina
jugador.classList.contains('estilsJugador'); //Comprova si existeix la classe a la llista
```
#### Modificació d'Atributs (`getAttribute`, `setAttribute`, `removeAttribute`, `hasAttribute` i `toggleAttribute`)

```javascript
// Afegir o eliminar atributs
jugador.getAttribute('src'); //Obtenir l'atribut d'un element
jugador.setAttribute('src', './naus/starfighter.webp'); //Afegeix o modifica un atribut
jugador.hasAttribute('src'); // Comprovar si existeix l'atribut
jugador.toggleAttribute('id', 'nauAmbEscut'); //Ex: mostrar un shadow brillant amb CSS
jugador.removeAttribute('id');
```

### 3. Creació i Eliminació d'Elements

#### Crear Elements, Afegir al DOM i Eliminar Elements (`createElement`, `append` i `remove`)

```javascript
// Crear un nou element, afegir-lo al DOM i eliminar-lo.
const enemic = document.createElement('div'); // Crea l'element DIV
pantalla.append(enemic); // Afegeix l'element DIV al final del contenidor "pantalla"
enemic.remove(); // Elimina l'element DIV
```

Exemples de com crear elements, afegir-los al DOM i eliminar-los.

```javascript
//Exemple funció crear per crear un element i afegir-lo al DOM
function crearEnemic(x, y) {
    const enemic = document.createElement('div');
    enemic.classList.add('enemic');
    enemic.style.left = `${x}px`;
    enemic.style.top = `${y}px`;
    pantalla.append(enemic); //Amb "prepend" l'afegiria al principi del contenidor "pantalla"
    return enemic;
}

let posicioX = 500;
let posicioY = 100;
const primerEnemic = crearEnemic(posicioX, posicioY); //Crear l'enemic i obtenir la referència per la seva gestió

// Eliminar un element del DOM
function eliminarEnemic(enemic, posicioX) {
    if (posicioX <= 0) {
        enemic.remove();
    } else {
        posicioX -= 10;
        enemic.style.left = `${posicioX}px`;
    }
}

for (let i = 0; i < 50; i++) {
    eliminarEnemic(primerEnemic, posicioX);
}
```
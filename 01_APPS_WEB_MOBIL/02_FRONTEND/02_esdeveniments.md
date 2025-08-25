# 02. Esdeveniments de l'Usuari

Els esdeveniments són accions que es produeixen a la pàgina web i que poden ser detectades per JavaScript. Aquests esdeveniments poden ser generats per:
- **L'usuari**: clics o moviments del ratolí i tecles premudes
- **El navegador**: càrrega completa del HTML, finalitza una animació CSS, es redimensiona la finestra del navegador, etc. 

La gestió d'esdeveniments al frontend és fonamental perquè permet:
- Respondre a les accions de l’usuari en temps real.
- Donar una resposta pràcticament immediata.
- Crear una UX (experiència d’usuari) més dinàmica i interactiva.

## Gestió d'esdeveniments

JavaScript proporciona diversos mètodes per gestionar els esdeveniments. El mètode modern i recomanat és `addEventListener()` que permet: 

- Afegir múltiples "funcions d'escolta" sobre el mateix element.
- Es pot generar íntegrament amb JS. Manté el codi separat de l’HTML (millor organització).
- Ofereix diferents opcions (capturar un esdeveniment, eliminar-lo, etc.).

### Tipus d'esdeveniments comuns

| Esdeveniment | Descripció                                            |
| ------------ | ----------------------------------------------------- |
| `click`      | Quan l’usuari fa clic amb el ratolí.                  |
| `dblclick`   | Quan l’usuari fa doble clic.                          |
| `mousedown`  | Quan l’usuari prem el botó del ratolí.                |
| `mouseup`    | Quan l’usuari deixa de prem el botó del ratolí.       |
| `mouseover`  | Quan el ratolí passa per sobre d'un element.          |
| `mouseout`   | Quan el ratolí surt de l’element.                     |
| `keydown`    | Quan l’usuari prem una tecla.                         |
| `keyup`      | Quan l'usuari deixa anar una tecla.                   |
| `submit`     | Quan s’envia un formulari.                            |
| `load`       | Quan la pàgina o un recurs han carregat completament. |
| `resize`     | Quan es canvia la mida de la finestra.                |

### Exemple bàsic d'esdeveniment de ratolí (`click`)

Capturar el clic amb ratolí sobre un botó. 

```html
<button id="boto-inici">A jugar!</button>
```

```javascript
const boto = document.querySelector("#boto-inici");
boto.addEventListener('click', () => {
  alert('El jugador ha iniciat el joc!');
});
```

### Exemple d'esdeveniment de ratolí amb gestió de l'esdeveniment (`click` amb `event`)

Capturar el clic amb ratolí sobre la pantalla i gestionar l'esdeveniment.

```html
<div id="pantalla-joc"></div>
```

```css
#pantalla-joc {
  background-color: lightblue;
  width: 100vw;
  height: 100vh;
}
```

```javascript
const pantalla = document.querySelector('#pantalla-joc');

pantalla.addEventListener('click', (eventRatoli) => {
  console.log(`Clic a la posició: ${eventRatoli.clientX}, ${eventRatoli.clientY}`);
  console.log(eventRatoli); //Podem veure el contingut de l'esdeveniment
});
```

### Exemple d'esdeveniments de teclat (`keydown` amb `event`)

Capturar la tecla premuda per l'usuari i gestionar l'esdeveniment.

```javascript
const teclesCounter = {
  ArrowUp: 0,
  ArrowDown: 0,
  Space: 0
}
document.addEventListener('keydown', (eventTeclat) => {  
  switch(eventTeclat.code) {
    case 'ArrowUp': // Moure al jugador cap a amunt
      teclesCounter.ArrowUp++;
      console.log("Tecla amunt (ArrowUp) premuda.");
    break;
    case 'ArrowDown': // Moure al jugador cap a avall
      teclesCounter.ArrowDown++;
      console.log("Tecla avall (ArrowDown) premuda.");
    break;
    case 'Space': // Disparar o atacar
      teclesCounter.Space++;
      console.log("Tecla espai (Space) premuda.");
    break;
  }
});
```
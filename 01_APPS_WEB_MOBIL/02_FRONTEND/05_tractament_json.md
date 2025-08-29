# 05. Integració de JSON amb JavaScript

JSON (**JavaScript Object Notation**) és un format lleuger i estandaritzat per a l'intercanvi de dades entre diferents aplicacions. Cada cop és més utilitzat en entorns de desenvolupament web perquè és simple i compatible amb pràcticament tots els llenguatges de programació.

Tot i que el seu nom inclou "JavaScript" i s'integra de manera natural amb JS, no està lligat al llenguatge, sinó que **és un estàndard universal per intercanviar informació entre aplicacions web**, APIS i altres sistemes d'informació.

## Casos d'ús amb JSON

JSON és una gran eina perquè es comuniquin aplicacions que "parlen" diferents llenguatges, com pot ser el frontend web i el backend. S'utilitza molt utilitzat en processos de comunicació amb serveis web ja que permet obtenir dades dinàmiques en funció de la consulta que es realitzi. Per exemple:
- Botiga online: Emmagatzemar i intercanviar informació de productes (nom, preu, categoria, stock disponible).
- Configuració de videojocs: Guardar els nivells, personatges desbloquejats, puntuacions i opcions de configuració del jugador (idioma, volum, controls).
- Dispositius IoT: Configuracions i estats d’aparells connectats (llum, temperatura, consum d’energia).
- Aplicacions mòbils: Sincronitzar dades d’usuari com preferències, historial de cerca o llistes de desitjos.
- Xarxes socials: Compartir dades com missatges, llistes d’amics, notificacions i preferències de privacitat.
- Educació online: Guardar informació de cursos, lliçons, progressos i qualificacions de l’alumnat.

## Estructura i Sintaxi de JSON

JSON es basa en dues estructures principals:

`Objectes`: col·leccions de claus i valors (com un diccionari).

`Arrays`: llistes ordenades de valors.

Els tipus de dades suportats són:
- `string` → text entre cometes dobles "...".
- `number` → enters o decimals.
- `boolean` → true o false.
- `null` → valor buit.
- `object` → col·lecció de claus i valors.
- `array` → llista de valors ordenats.

Exemple d'un JSON (recuperar la informació de productes d'un ecommerce)

```json
{
  "productes": [
    {
      "id": 101,
      "nom": "Portàtil Lenovo ThinkPad",
      "descripcio": "CPU i7-13300, Memòria 32GB RAM, Disc 1TB SSD.",
      "preu": 799.90,
      "stock": 12,
      "categories": ["ordinadors", "portàtils", "tecnologia"]
    },
    {
      "id": 102,
      "nom": "Smartphone Samsung Galaxy",
      "descripcio": "Pantalla 6.5'', CPU Exynos 2100, 128GB d'emmagatzematge.",
      "preu": 699,
      "stock": 25,
      "categories": ["telèfons", "smartphones", "tecnologia"]
    }
  ]
}
```

## Conversió de JSON a Objecte JavaScript i viceversa

Per poder fer servir la informació d'un JSON en JavaScript, cal convertir-la en un objecte JavaScript. Això es pot fer mitjançant la funció `JSON.parse()`, que transforma una cadena JSON en un objecte.

Per poder enviar un objecte JavaScript com a JSON, s'ha de convertir a cadena fent ús de `JSON.stringify()`.

Exemple de conversions:

```javascript
// Conversió de JSON a Objecte JavaScript
const textJSON = `{
  "nom": "Pepet",
  "vides": 3,
  "punts": 1200
}`;

const jugador = JSON.parse(textJSON);

console.log(jugador.nom);   // Pepet
console.log(jugador.vides); // 3
```

```javascript
// Conversió d'Objecte JavaScript a JSON
const jugador = {
  nom: "Pepet",
  vides: 3,
  punts: 1200
};

const textJSON = JSON.stringify(jugador);

console.log(textJSON);
```

## Simulació d'una API: Fitxers JSON i processament amb JavaScript

Exemple de com carregar i processar un fitxer JSON mitjançant `fetch()` per extreure informació i emmagatzemar-la en variables pel seu ús en el programa.

### Fitxer nivell1.json

```json
{
  "nivell": 1,
  "maxPunts": 100,
  "maxAsteroides": 100,
  "variablesJugador": { 
    "vides": 3,
    "velocitat": 5
  },
  "variablesEnemics": {
    "vides": 1,
    "velocitat": 5,
    "maxEnemics": 12
  }
}
```

### Processar el JSON amb fetch()

```javascript
fetch('./nivell1.json')
  .then(response => {
    if (!response.ok) {
      throw new Error('Error al carregar el fitxer JSON :(');
    }
    return response.json();
  })
  .then(data => {
    console.log(data);
    // Processar les dades del nivell
    console.log(`Nivell: ${data.nivell}`);
    console.log(`Max Punts: ${data.maxPunts}`);
    console.log(`Max Asteroides: ${data.maxAsteroides}`);
    console.log(`Vides del Jugador: ${data.variablesJugador.vides}`);
    console.log(`Velocitat dels Enemics: ${data.variablesEnemics.velocitat}`);
    
    // (Destructuració) Aquí es poden utilitzar aquestes dades per configurar el joc
    const { nivell, maxPunts, maxAsteroides, variablesJugador, variablesEnemics } = data;
    console.log(nivell, maxPunts, maxAsteroides, variablesJugador, variablesEnemics);

    //Si abans creàvem el jugador així:
    // Constructor: nom, vides, velocitat, posicio, ample, alt
    const jugador = new Jugador("Pepito", 3, 15, {x: 100, y: 300}, 150, 100);
    //Ara fem ús de les variables carregades del JSON
    const jugador1 = new Jugador(
      "Pepito",
      variablesJugador.vides,
      variablesJugador.velocitat,
      { x: 100, y: 300 },
      150,
      100
    );
  })
  .catch(error => {
    console.error('Error:', error);
  });
  ```
# 03. Programació Orientada a Objectes

La Programació Orientada a Objectes (POO) és un paradigma que es basa el desenvolupament de programes en la creació i gestió d’elements independents denominats "objectes", simulant objectes del món real. Cada objecte es responsable d’unes tasques específiques i mitjançant la creació d’objectes i la interacció entre objectes avança l’execució del programa.

Actualment, JavaScript suporta la POO tant amb el sistema de "prototips" tradicional com amb la sintaxi moderna de classes introduïda en ES6.

La Programació Orientada a Objectes (POO) és un paradigma de programació que basa el desenvolupament de programes en la creació i gestió d'uns elements independents anomenats "objectes", que simulen entitats del món real. Cada objecte és responsable d'unes tasques concretes i, mitjançant la interacció entre ells, avança l'execució del programa.

En JavaScript, la POO es pot aplicar de dues maneres:
- El sistema de prototips, on es crea un Object Literal prototip i els altres hereten d'aquest prototip.
- La sintaxi moderna de classes (introduïda a ES6), més propera a altres llenguatges i que recomano.

## Fonament de la Programació Orientada a Objectes

### L'Abstracció: 

És la capacitat de representar una entitat del món real en una forma simplificada dins del codi. Això s’aconsegueix definint classes que modelen característiques (propietats) i comportaments (mètodes) dels objectes i amagant els detalls innecessaris o complexos.

#### Una Classe: 

És una plantilla que permet crear objectes. Defineix l’estructura de l’objecte a partir de definir unes característiques i comportaments.

#### Un Objecte: 

És una instància d’una classe (element creat a partir d'una classe). Representa una entitat del món real i disposa d’unes característiques (propietats) i uns comportaments (mètodes) associats. Cada objecte pot tenir valors de propietats diferents però comparteixen els mateixos mètodes definits a la classe.

### L’Encapsulat: 

És el mecanisme per amagar els detalls interns d’un objecte (propietats i mètodes), exposant únicament una interfície per poder interactuar-hi. Mitjançant mètodes i propietats privades es controla l’accés a les propietats i mètodes d’un objecte. L’encapsulat garanteix la integritat de les dades i permet ocultar la seva implementació (el codi) del seu ús extern. 

### L’Herència: 

Permet definir noves classes a partir de classes ja existents (classe Parent). Les noves classes (subclasses) hereten les propietats i mètodes de la classe pare. També poden afegir noves funcionalitats o modificar el comportament heretat. L’herència es útil per la reutilització de codi i establir una jerarquia de classes.

### El Polimorfisme: 

És la capacitat que disposa un objecte per respondre o comportar-se de manera diferent a una mateixa acció o mètode (en funció del context).  Això permet a un mètode amb el mateix nom realitzar diferents tasques en funció de la classe que l'implementi. Aquest procés s’implementa mitjançant l’herència i la possiiblitat de sobreescriure mètodes a les subclasses.

## Declaració de Classes

**Mètode constructor**: És un mètode especial que s’executa automàticament al crear un objecte. Serveix per inicialitzar de les propietats de l’objecte.

**Propietats**: Variables que representen les característiques o l'estat d’un objecte. Poden ser tipus de dades com números, booleans, cadenes, arrays, altres objectes, etc.

**Mètodes**: Funcions que defineixen el comportament d’un objecte. Poden rebre paràmetres d’entrada, retornar resultats i manipular les propietats de l’objecte.

```javascript
// Declaració d'una classe
class Jugador {
  constructor(nom, vides) {  // mètode constructor
    this.nom = nom;          // propietat
    this.vides = vides;
    this.posicio = 100;
    this.punts = 0;
  }

  moureJugador() {           // mètode públic
    this.posicio += 5;
  }
}
```
## Instanciació i Gestió d'Objectes

```javascript
// Instanciació d'una classe
const jugador1 = new Jugador('Pepet', 3);
const jugador2 = new Jugador('Lucky', 5);

// Accés a propietats i ús de mètodes
console.log(`Nom Jugador 1:${jugador1.nom}`);
console.log(`Nom Jugador 2:${jugador2.nom}`);

jugador1.moureJugador();
jugador1.vides--;

for (let i = 0; i < 5; i++) {
  jugador2.moureJugador();
}

console.log(`Vides Jugador 1:${jugador1.vides}`);
console.log(`Posicio Jugador 2:${jugador2.posicio}`);
```

## Herència i Polimorfisme

```javascript
// Classe base que representa un personatge del joc
class Entitat {
  constructor(nom, vides, posicio) {
    this.nom = nom;
    this.vides = vides;
    this.posicio = posicio;
  }

  moure() {
    this.posicio.x += 1;
    this.posicio.y += 1;
  }
}

// Herència: Jugador hereta propietats i mètodes d'Entitat
class Jugador extends Entitat {
  constructor(nom, vides, posicio) {
    super(nom, vides, posicio);  // crida al constructor de la classe base
    this.punts = 0;              // propietat específica de Jugador
  }

// Polimorfisme: Jugador redefineix el mètode moure() de la classe base
  moure() {
    this.posicio.y += 1; // Moviment vertical
  }

  // Mètode propi del Jugador
  sumarPunts(enemic) {
    this.punts += 10;
    enemic.vides--;
  }
}

// Herència: Enemic hereta propietats i mètodes d'Entitat
class Enemic extends Entitat {
  constructor(nom, vides, nivell) {
    super(nom, vides);
    this.nivell = nivell; // propietat específica de Enemic
  }

// Polimorfisme: Enemic redefineix el mètode moure() de la classe base
  moure() {
    this.posicio.x -= 1; // Moviment horitzontal
  }

  // Mètode propi de l'Enemic
  atacar(jugador) {
    jugador.vides--;
    jugador.punts = jugador.punts - this.nivell;
  }
}

const jugador = new Jugador('Jugador1', 3, { x: 100, y: 100 });
const enemic = new Enemic('Enemic1', 2, { x: 300, y: 500 }, 1);

jugador.moure();
enemic.moure();

jugador.sumarPunts(enemic);
enemic.atacar(jugador);

console.log(`Vides Jugador: ${jugador.vides} i Posició: ${jugador.posicio.y}`);
console.log(`Vides Enemic: ${enemic.vides} i Posició: ${enemic.posicio.x}`);
```
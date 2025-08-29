# Bloc 02. Frontend amb HTML, CSS i JavaScript

## Introducció

En aquest bloc aprendrem a combinar les 3 tecnologies bàsiques del frontend.

**HTML**: El llenguatge de marques que defineix l'estructura i semàntica del contingut (l'esquelet del web).

**CSS**: El llenguatge d'estils CSS que defineix l'estil visual del contingut (el disseny del web).

**JavaScript**: El llenguatge de programació que permet modificar el contingut dinàmicament i interactuar amb l'usuari (el cervell del web).

Ens centrarem en descobrir el potencial del **JavaScript modern (ES6+)** per crear aplicacions web interactives. JavaScript és el llenguatge que dona vida al frontend, permet: 
- Capturar esdeveniments i donar resposta a accions de l'usuari
- Manipular el contingut dinàmicament i en temps real.
- Comunicar-se amb el backend fent ús de formularis o APIs.

Farem un repàs dels conceptes fonamentals de programació i finalitzarem amb la creació d'un petit videojoc web. Es treballaran conceptes clau com la manipulació del DOM, la gestió d'esdeveniments, la programació orientada a objectes, el tractament de JSON i el consum d'APIs.

## Conceptes Bàsics de JavaScript (Repàs)

### Variables i Constants

JavaScript utilitza les paraules reservades `let`, `const` per declarar variables i constants.

```javascript
// Constants (el seu contingut no es podrà modificar)
const MAX_VIDES = 3;
const NOM_JOC = "Shooter 2D";
const NUM_ENEMICS = 5;

// Variables (els seus valors assignats i tipus poden canviar durant l'execució)
let punts = 0;
let nivell = 1;
let vides = MAX_VIDES;
punts = 50;
```

### Tipus de Dades

JavaScript és dinàmic, determina automàticament el tipus de dada en funció del valor assignat a les constants o variables. Aquests poden ser:

- **Tipus de dades Primitius**: String, Number, Boolean, Null, Undefined
- **Tipus de dades Compostes**: Arrays, Functions, Dates, etc.

```javascript
// Tipus Primitius
let nom = "Jugador";       // String
let punts = 50;            // Number  
let estaDisparant = false; // Boolean
let nickname = null;       // Null
let velocitat;             // Undefined

// Vectors (Arrays)
const enemics = ["TieFighter", "StarDestroyer", "DeathStar"];
const puntuacions = [50, 100, 300];

// Objecte literal (Objectes simples creats pel desenvolupador)
const jugador = {
    nom: "X-Wing",
    vides: 3,
    punts: 0,
    energia: 100,
    posicio: { x: 250, y: 450 }, // "posició" seria un altre objecte
    armes: ["laser", "metralleta"]
};
```

### Operadors Aritmètics, Relacionals i Lògics

**Operadors Aritmètics**: Permeten realitzar operacions matemàtiques amb valors numèrics, constants i variables.
- `+` (Suma): Suma dos valors.
- `-` (Resta): Resta dos valors.
- `*` (Multiplicació): Multiplica dos valors.
- `/` (Divisió): Divideix dos valors.
- `%` (Mòdul): Retorna el residu de la divisió entre dos valors.
- `**` (Exponent): Eleva un valor a una potència.
- `++` (Increment): Augmenta el valor d'una variable en 1.
- `--` (Decrement): Disminueix el valor d'una variable en 1.
- `+` (Concatenació strings): Antic mètode per concatenar cadenes.

**Operadors Relacionals**: Permeten comparar valors. Determina si el resultat de l'operació és cert o fals.
- `==` (Igual a): Comprova si dos valors són iguals (només té en compte el valor).
- `===` (Igual a estricte): Comprova si dos valors són exactament iguals (el valor i el tipus).
- `!=` (Difererent de): Comprova si dos valors no són iguals (només té en compte el valor).
- `!==` (Diferent de estricte): Comprova si dos valors no són iguals (el valor i el tipus).
- `>` (Més gran que): Comprova si el primer valor és més gran que el segon valor.
- `<` (Menys que): Comprova si el primer valor és més petit que el segon valor.
- `>=` (Més gran o igual que): Comprova si el primer valor és més gran o igual que el segon valor.
- `<=` (Menys o igual que): Comprova si el primer valor és menor o igual que el segon valor.

**Operadors Lògics**: Permeten combinar condicions i determinar el seu resultat final (cert o fals).
- `&&` (AND): Verifica si les condicions són certes. Retorna cert o fals en cas contrari.
- `||` (OR): Verifica si com a mínim una condició és certa. Retorna cert o fals en cas contrari.
- `!` (NOT): Inverteix el valor d'una condició. Retorna cert si la condició és falsa i viceversa.

```javascript
// Aritmètics
let puntsTotal = punts + (bonus * nivell);
let videsTotals = vides - errades;
const statusJugador = "Pepet: " + puntsTotal;

// Relacionals
let haGuanyat = punts >= puntsPerfecte;
let finalJoc = nivell === MAX_NIVELLS;

// Lògics
let potAtacar = vides >= 0 && municio > 0;
let negacio = !estaViu;
let continuaJoc = punts >= 0 || estaViu;
```

### Estructures de Control Condicional

Javascript pot prendre decisions de quin bloc de codi executar en funció del resultat d'operacions aritmètiques, relacionals i lògiques.

```javascript
// (if) Executa el bloc de codi si es compleix la condició
// (else) Executa el bloc de codi si no es compleix la condició
if (vides > 0 && punts >= 50) {
    vides--;
    punts -= 50;
} else {
    //Comanda que mostra informació i dades de l'aplicació a la consola del desenvolupador
    console.log(`Game Over! T'has quedat amb ${vides} vides.`);
}

// (switch) Estructura condicional de casos
// Executa el bloc de codi segons el valor assignat a la variable 
switch (nivell) {
    case 1:
        numEnemics = 5;
        maxPunts = 100;
        break;
    case 2:
        numEnemics = 10;
        maxPunts = 200;
        break;
    default:
        numEnemics = 3;
        maxPunts = 50;
}

// (Operador ternari) - Assigna un valor si es compleix la condició sinó assigna un altre valor.
const missatge = (vides > 0) ? "Estàs viu" : "Has mort";
const nomUsuari = (usuari === null) ? "Jugador1" : usuari;
```

### Estructures de Control Iteratiu

Javascript pot repetir l'execució d'un bloc de codi fins que es compleixi una condició o es realitzi un número determinat d'iteracions (també es denominen bucles).

```javascript
// (while) Executa un bloc de codi repetidament fins que es compleixi una condició
let estaViu = true;
let numEnemics = 3;
let vides = 5;
while (estaViu && numEnemics > 0) {
    numEnemics--;
    vides--;
    if (vides === 0) {
        estaViu = false;
    }
}

// (for) Executa un bloc de codi repetidament un número determinat de vegades
let posicioEnemic = 0;
for (let i = 0; i < 10; i++) {
    posicioEnemic += 5;
}

// (forEach) Executa un bloc de codi per a cada element d'un vector
const enemics = ["TieFighter", "StarDestroyer", "DeathStar"];
enemics.forEach((enemic) => {
    console.log(`Enemic: ${enemic}`);
});

// (for .. in) Executa un bloc de codi per a cada clau d'un objecte (simula un array associatiu)
const puntuacions = { "facil": 100, "normal": 200, "dificil": 500 };

for (const dificultat in puntuacions) {
  console.log(dificultat, puntuacions[dificultat]);
}
```

### Funcions i Procediments

Les funcions són blocs de codi que realitzen una tasca concreta, poden rebre paràmetres d'entrada i rentornar un resultat. Són independents del programa i es poden "cridar" en qualsevol punt del codi.

```javascript
// Funció tradicional
function calcularPuntuacio(punts, temps, nivell) {
    let puntsTotals = Math.floor((punts - temps) * nivell);
    return puntsTotals;
}

// Arrow function
const calcularPuntuacio = (punts, temps, nivell) => Math.floor((punts - temps) * nivell);
```
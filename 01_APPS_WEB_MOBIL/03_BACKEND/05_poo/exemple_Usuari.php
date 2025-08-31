<?php
// exemple_Usuari.php
class Usuari {
    // Propietats (variables de la classe)
    public string $nom;
    public string $email;
    private string $rol;
    protected DateTime $data_registre;

    // Constant de classe (compartida per totes les instàncies)
    const ROL_ADMIN = 'admin';
    const ROL_USUARI = 'usuari';
    const MAX_USUARIS = 100;

    // Propietat estàtica (compartida entre tots els objectes)
    private static int $total_usuaris = 0;

    // Constructor - s'executa quan es crea un objecte
    public function __construct(string $nom, string $email, string $rol) {
       // Verificar que no arriba al màxim d'usuaris en memòria (100) abans de crear un nou usuari
        if (self::$total_usuaris >= self::MAX_USUARIS) {
            throw new Exception("No es poden crear més usuaris. Hi ha un límit de " . self::MAX_USUARIS . " usuaris.");
        }
        // Inicialitzar les variables en cas de no haver arribat al màxim d'usuaris
        $this->nom = $nom;
        $this->email = $email;
        $this->rol = $rol;
        $this->data_registre = new DateTime();
        self::$total_usuaris++;
        echo "<p>S'ha creat l'usuari " . self::$total_usuaris . " : {$this->nom}</p>";
    }
    
    // Mètode públic (accessible des de fora de la classe)
    public function obtenirDades(): array {
        if ($this->validarEmail($this->email)) { //Ús d'un mètode privat dins la classe.
            return [
                'nom' => $this->nom,
                'email' => $this->email,
                'registre' => $this->data_registre->format('Y-m-d H:i:s'),
                'rol' => $this->rol
            ];
        }
        return [];
    }
    
    // Mètode privat (només accessible dins la classe)
    private function validarEmail(string $email): bool {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
    
    // Mètode protegit (accessible en classes derivades o dins la classe)
    protected function obtenirRol(): string {
        return $this->rol;
    }
    
    // Mètode estàtic (no necessita instància de la classe)
    public static function crearUsuariProves(): self {
        $noms = ['Pep', 'Pepet', 'Pepito', 'Pepe'];
        $nom = $noms[array_rand($noms)];
        $email = strtolower($nom). rand(1, 1000) . '@domini.cat';

        return new self($nom, $email, self::ROL_USUARI);
    }
    
    // Destructor - s'executa quan l'objecte es destrueix
    public function __destruct() {
        echo "<p>L'usuari {$this->nom} s'ha eliminat de la memòria</p>";
    }
}

// Exemple d'ús de la classe
echo "<h1>Programació Orientada a Objectes amb PHP - Classe Usuari</h1>";

// Creació d'objectes
$usuari1 = new Usuari('Joanet Garcia', 'joan@domini.cat', Usuari::ROL_USUARI);
$usuari2 = new Usuari('Marieta VolaVola', 'maria@domini.cat', Usuari::ROL_ADMIN);

// Utilització de mètodes
echo "<h2>Dades dels usuaris:</h2>";

print_r($usuari1->obtenirDades());
print_r($usuari2->obtenirDades());

// Modificar propietats públiques
$usuari1->nom = 'Joan Garcia';

// Mostrar les constants de classe
echo "<p>Tipus d'usuari admin: " . Usuari::ROL_ADMIN . "</p>";

// Crear usuari amb el mètode estàtic (per proves o seeders)
$usuari3 = Usuari::crearUsuariProves();
print_r($usuari3->obtenirDades());

// Creació d'usuaris fins al màxim permès (100)
$usuaris = [];
try {
    for ($i = 0; $i < 100; $i++) {
        $usuari = new Usuari("Usuari $i", "usuari$i@domini.cat", Usuari::ROL_USUARI);
        array_push($usuaris, $usuari);
    }
} catch (Exception $e) {
    echo "<p>Error: " . $e->getMessage() . "</p>";
}
?>
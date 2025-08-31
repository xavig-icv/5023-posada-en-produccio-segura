<?php
require_once 'config/database.php';

class UsuariModel
{
    public $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    // VULNERABILITAT: SQL Injection
    public function login($email, $password)
    {
        $sql = "SELECT * FROM usuaris WHERE email = '$email'";
        $stmt = $this->pdo->query($sql);
        $usuari = $stmt->fetch(PDO::FETCH_ASSOC);

        // VULNERABILITAT: Comparació de password insegura
        if ($usuari && $usuari['password_hash'] === md5($password)) {
            return $usuari;
        }
        return false;
    }

    // VULNERABILITAT: SQL Injection i validació insuficient
    public function crear($nomUsuari, $email, $password, $nomComplet)
    {
        // Sense validació adequada
        $passwordHash = md5($password); // VULNERABILITAT: Hash feble

        $sql = "INSERT INTO usuaris (nom_usuari, email, password_hash, nom_complet) 
                VALUES ('$nomUsuari', '$email', '$passwordHash', '$nomComplet')";

        return $this->pdo->exec($sql);
    }

    // VULNERABILITAT: IDOR (Insecure Direct Object Reference)
    public function obtenirUsuari($id)
    {
        $sql = "SELECT * FROM usuaris WHERE id = $id";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // VULNERABILITAT: Exposició de dades sensibles
    public function obtenirRanking()
    {
        $sql = "SELECT u.nom_usuari, u.email, u.nom_complet, 
                       SUM(p.puntuacio_obtinguda) as puntuacio_total
                FROM usuaris u 
                LEFT JOIN partides p ON u.id = p.usuari_id 
                GROUP BY u.id 
                ORDER BY puntuacio_total DESC";

        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

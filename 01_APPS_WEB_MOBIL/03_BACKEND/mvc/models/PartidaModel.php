<?php
require_once 'config/database.php';

class PartidaModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    // VULNERABILITAT: SQL Injection i falta de validació
    public function guardarPartida($usuariId, $jocId, $puntuacio, $durada)
    {
        $sql = "INSERT INTO partides (usuari_id, joc_id, nivell_jugat, puntuacio_obtinguda, durada_segons) 
                VALUES ($usuariId, $jocId, 1, $puntuacio, $durada)";

        return $this->pdo->exec($sql);
    }

    // VULNERABILITAT: IDOR - pot veure partides d'altres usuaris
    public function obtenirPartides($usuariId)
    {
        $sql = "SELECT p.*, j.nom_joc 
                FROM partides p 
                JOIN jocs j ON p.joc_id = j.id 
                WHERE p.usuari_id = $usuariId 
                ORDER BY p.data_partida DESC";

        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

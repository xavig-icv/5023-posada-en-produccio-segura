<?php
require_once 'config/database.php';

class JocModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function obtenirJocsActius()
    {
        $sql = "SELECT * FROM jocs WHERE actiu = 1";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // VULNERABILITAT: IDOR
    public function obtenirJoc($id)
    {
        $sql = "SELECT * FROM jocs WHERE id = $id";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

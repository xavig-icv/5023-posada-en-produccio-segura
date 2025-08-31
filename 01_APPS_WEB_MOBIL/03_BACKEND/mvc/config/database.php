<?php
// VULNERABILITAT: Credencials hardcoded i exposades
class Database
{
    private static $host = 'localhost';
    private static $dbname = 'plataforma_videojocs';
    private static $username = 'plataforma_user';
    private static $password = '123456789a';

    public static function getConnection()
    {
        try {
            // VULNERABILITAT: Sense SSL i configuració insegura
            $pdo = new PDO(
                "mysql:host=" . self::$host . ";dbname=" . self::$dbname,
                self::$username,
                self::$password,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
            return $pdo;
        } catch (PDOException $e) {
            // VULNERABILITAT: Exposició d'informació sensible
            die("Error de connexió: " . $e->getMessage());
        }
    }
}

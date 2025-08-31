<?php
class Session
{
    public static function start()
    {
        if (session_status() == PHP_SESSION_NONE) {
            // VULNERABILITAT: Sessions insegures
            ini_set('session.cookie_httponly', '0'); // JavaScript pot accedir
            ini_set('session.cookie_secure', '0');   // HTTP (no HTTPS)
            session_start();
        }
    }

    public static function set($key, $value)
    {
        self::start();
        $_SESSION[$key] = $value;
    }

    public static function get($key)
    {
        self::start();
        return $_SESSION[$key] ?? null;
    }

    public static function isLoggedIn()
    {
        return self::get('usuari_id') !== null;
    }

    // VULNERABILITAT: Logout insegur
    public static function logout()
    {
        self::start();
        unset($_SESSION['usuari_id']); // No destrueix completament la sessió
    }
}

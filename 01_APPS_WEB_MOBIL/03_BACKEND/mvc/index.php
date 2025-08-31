<?php
// Incloure els fitxers per gestionar les rutes i controlar les sessions d'usuari
require_once 'core/Router.php';
require_once 'core/Session.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/JocController.php';
require_once 'controllers/UsuariController.php';

// VULNERABILITAT: Headers de seguretat absents

$router = new Router(); // Emmagatzema les rutes i redirigeix peticions GET i POST al controlador corresponent

// DEFINICIÓ DE RUTES (Cada ruta disposa de la URL, el Controlador i el Mètode que s'executa)
// Rutes d'autenticació
$router->get('/login', 'AuthController', 'mostrarLogin');
$router->post('/login', 'AuthController', 'login');
$router->get('/registre', 'AuthController', 'mostrarRegistre');
$router->post('/registre', 'AuthController', 'registre');
$router->get('/logout', 'AuthController', 'logout');

// Rutes de jocs
$router->get('/', 'JocController', 'llistaJocs');
$router->get('/jocs', 'JocController', 'llistaJocs');
$router->get('/jugar', 'JocController', 'jugar');
$router->post('/guardar-puntuacio', 'JocController', 'guardarPuntuacio');

// Rutes d'usuari
$router->get('/perfil', 'UsuariController', 'perfil');
$router->get('/ranking', 'UsuariController', 'ranking');

// REP PETICIONS DE L'USUARI: Detecta el mètode HTTP i la ruta i redirigeix al controlador corresponent, sinó mostra un error.
$router->dispatch();

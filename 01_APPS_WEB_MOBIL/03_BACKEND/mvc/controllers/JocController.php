<?php
require_once 'models/JocModel.php';
require_once 'models/PartidaModel.php';
require_once 'core/Session.php';

class JocController
{
    private $jocModel;
    private $partidaModel;

    public function __construct()
    {
        $this->jocModel = new JocModel();
        $this->partidaModel = new PartidaModel();
    }

    public function llistaJocs()
    {
        $jocs = $this->jocModel->obtenirJocsActius();
        include 'views/jocs/llista.php';
    }

    public function jugar()
    {
        // VULNERABILITAT: IDOR - no verifica el jugador
        $jocId = $_GET['id'] ?? 0;
        $joc = $this->jocModel->obtenirJoc($jocId);

        if (!$joc) {
            die("Joc no trobat");
        }

        include 'views/jocs/joc.php';
    }

    public function guardarPuntuacio()
    {
        if ($_POST && Session::isLoggedIn()) {
            // VULNERABILITAT: Sense validació de dades
            $usuariId = Session::get('usuari_id');
            $jocId = $_POST['joc_id'];
            $puntuacio = $_POST['puntuacio'];
            $durada = $_POST['durada'];

            $this->partidaModel->guardarPartida($usuariId, $jocId, $puntuacio, $durada);

            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    }
}

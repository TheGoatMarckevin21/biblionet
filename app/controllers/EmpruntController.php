<?php
require_once '../app/models/Emprunt.php';
require_once '../app/models/Adherent.php';
require_once '../app/models/Livre.php';

class EmpruntController extends Controller {
    private $empruntModel;

    public function __construct() {
        $this->empruntModel = new Emprunt();
    }

    // Afficher la liste des emprunts
    public function index() {
        $emprunts = $this->empruntModel->all();
        $this->render('emprunts/index', ['emprunts' => $emprunts]);
    }

    // Afficher le formulaire d'ajout d'emprunt
    public function create() {
        $adherentModel = new Adherent();
        $livreModel = new Livre();
        
        $adherents = $adherentModel->all();
        $livres = $livreModel->all();
        
        $this->render('emprunts/form', [
            'title' => 'Enregistrer un emprunt',
            'adherents' => $adherents,
            'livres' => $livres
        ]);
    }

    // Enregistrer l'emprunt soumis via le formulaire
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id_adherent'        => htmlspecialchars(trim($_POST['id_adherent'])),
                'id_livre'           => htmlspecialchars(trim($_POST['id_livre'])),
                'date_emprunt'       => date('Y-m-d'),
                'date_retour_prevue' => htmlspecialchars(trim($_POST['date_retour_prevue']))
            ];

            if ($this->empruntModel->create($data)) {
                header('Location: /emprunts');
                exit();
            }
        }
    }

    // Valider le retour d'un livre
    public function retourner($id) {
        $this->empruntModel->retourner($id);
        header('Location: /emprunts');
        exit();
    }
}
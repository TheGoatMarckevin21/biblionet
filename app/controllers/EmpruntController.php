<?php
require_once dirname(__DIR__) . '/models/Emprunt.php';
require_once dirname(__DIR__) . '/models/Adherent.php';
require_once dirname(__DIR__) . '/models/Livre.php';

class EmpruntController extends Controller {
    private $empruntModel;

    public function __construct() {
        $this->requireAuth();
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
        $livres = array_filter($livreModel->all(), fn($l) => $l['disponibles'] > 0);
        
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
                'adherent_id'  => (int)($_POST['adherent_id'] ?? 0),
                'livre_id'     => (int)($_POST['livre_id'] ?? 0),
                'date_emprunt' => !empty($_POST['date_emprunt']) ? trim($_POST['date_emprunt']) : date('Y-m-d')
            ];

            if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $data['date_emprunt'])) {
                $data['date_emprunt'] = date('Y-m-d');
            }

            $error = $this->empruntModel->create($data);
            if ($error === null) {
                $this->flash('success', 'Emprunt enregistré.');
                $this->redirect('emprunts');
            }
            $this->flash('danger', $error);
            $this->redirect('emprunts/create');
        }
    }

    // Valider le retour d'un livre
    public function retourner($id) {
        $this->empruntModel->retourner((int)$id);
        $this->redirect('emprunts');
    }
}

<?php
require_once dirname(__DIR__) . '/models/Adherent.php';

class AdherentController extends Controller {
    private $adherentModel;

    public function __construct() {
        $this->requireAuth();
        $this->adherentModel = new Adherent();
    }

    public function index() {
        $adherents = $this->adherentModel->all();
        $this->render('adherents/index', ['adherents' => $adherents]);
    }

    public function create() {
        $this->render('adherents/form', ['title' => 'Ajouter un adhérent']);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom' => trim($_POST['nom'] ?? ''),
                'prenom' => trim($_POST['prenom'] ?? ''),
                'classe' => trim($_POST['classe'] ?? ''),
                'telephone' => trim($_POST['telephone'] ?? '')
            ];

            if ($this->adherentModel->create($data)) {
                $this->redirect('adherents');
            }
        }
    }

    public function edit($id) {
        $adherent = $this->adherentModel->find($id);
        if (!$adherent) {
            $this->redirect('adherents');
        }
        $this->render('adherents/form', [
            'title' => 'Modifier l\'adhérent',
            'adherent' => $adherent
        ]);
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom' => trim($_POST['nom'] ?? ''),
                'prenom' => trim($_POST['prenom'] ?? ''),
                'classe' => trim($_POST['classe'] ?? ''),
                'telephone' => trim($_POST['telephone'] ?? '')
            ];

            if ($this->adherentModel->update($id, $data)) {
                $this->redirect('adherents');
            }
        }
    }

    public function delete($id) {
        $this->adherentModel->delete($id);
        $this->redirect('adherents');
    }
}